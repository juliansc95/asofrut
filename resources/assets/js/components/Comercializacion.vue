<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Comercializacion
                        <button type="button" @click="mostrarDetalle()" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                        <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Reporte Total
                        </button>
                        <button type="button" @click="reporteDiario()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;Reporte Diario
                        </button>
                         <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayVentaEx
                        worksheet = "Comercializacion"
                        name    = "comercializacion.xls">
                        Excel
                        </export-excel>
                        <export-excel
                        class   = "button btn btn-success"
                        :data   = arrayVentaEx
                        type="csv"
                        name    = "comercializacion.xls">
                        csv
                        </export-excel>
                    </div>
                    <!-- Listado-->
                    <template v-if="listado==1">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="personas">Nombre</option>
                                      <option value="fechaVenta">Fecha-Hora</option>
                                      <option value="totalUnidades">cantidad total</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarComer(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarComer(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Productor</th>
                                        <th>Fecha</th>
                                        <th>Total Unidades</th>
                                        <th>Total($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="venta in arrayVenta" :key="venta.id">
                                        <td>
                                            <button type="button" @click="verVenta(venta.id)" class="btn btn-success btn-sm">
                                            <i class="icon-eye"></i>
                                            </button> &nbsp;
                                             <button type="button" @click="pdfVenta(venta.id)" class="btn btn-info btn-sm">
                                            <i class="icon-doc"></i>
                                            </button> &nbsp;
                                        <td v-text="venta.nombre_persona"></td>
                                        <td v-text="venta.fechaVenta"></td>
                                        <td v-text="venta.totalUnidades"></td>
                                        <td v-text="venta.totalVenta"></td>
                                    </tr>                                
                                </tbody>
                            </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    </template>
                    <!--Fin Listado-->
                    <!-- Detalle-->
                    <template v-else-if="listado==0">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                   <label for="text-input">Productor</label>
                                    <select class="form-control" v-model="productor_id" @click="getSaldo(productor_id)" @change="getSaldo(productor_id)">
                                        <option value="0" disabled>Seleccione</option>
                                        <option v-for="productor in arrayProductor" :key="productor.id" :value="productor.id" v-text="productor.nombre" ></option>
                                    </select>  
                                </div>
                            </div>
                             <div class="col-md-4">
                                <div class="form-group">
                                    <label>Otro</label>
                                    <input type="text" class="form-control" v-model="otro">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div v-show="errorVenta" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjVenta" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Producto<span style="color:red;" v-show="productosComers_id==0">(*Seleccione)</span></label>
                                    <div class="form-inline">
                                        <input type="text" class="form-control" v-model="codigo" @keyup.enter="buscarCategoria()" placeholder="Ingrese categoria">
                                        <button @click="abrirModal()" class="btn btn-primary">...</button>
                                        <input type="text" readonly class="form-control" v-model="categoria">
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click="agregarDetalle()" class="btn btn-success form-control btnagregar"><i class="icon-plus"></i></button>
                                </div>
                            </div>
                        </div>
                         <div class="form-group row border">
                            <div class="col-md-4">                               
                                <label>Saldo Comercializacion</label>  
                                <div class="form-group">
                                <div v-if="!arraySaldo.length">
                                     <input type="number" value=0 disabled> 
                                </div>
                                <div>
                                <input type="number" v-for="saldo in arraySaldo" :key="saldo.id" :value="saldo.saldo" v-text="saldo.saldo" disabled>  
                                </div>
                                </div>       
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Valor Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                                            <td>
                                                <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </td>
                                            <td  v-text="detalle.categoria">
                                            </td>
                                            <td>
                                            <input v-model="detalle.cantidad" type="number" class="form-control">
                                            </td>
                                            <td v-text="detalle.valorUnitario">
                                            </td>
                                            <td>
                                                $ {{(detalle.subtotal=detalle.valorUnitario*detalle.cantidad).toFixed(0)}}
                                            </td>    
                                        </tr>
                                         <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Unidades:</strong></td>
                                            <td> {{(totalUnidades=calculartotalUnidades)}}</td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="4" align="right"><strong>Total Neto:</strong></td>
                                            <td>$ {{(totalVenta=calcularTotal).toFixed(0)}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="5">
                                                NO hay productos agregados
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" @click="registrarVenta()">Registrar Venta</button>
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- Fin Detalle-->
                    <!-- Ver ingreso -->
                    <template v-else-if="listado==2">
                    <div class="card-body">
                        <div class="form-group row border">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Productor</label>
                                    <p v-text="productor"></p>
                                </div>
                            </div>
                              <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Otro</label>
                                    <p v-text="otro"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <p v-text="fechaVenta"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row border">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Valor Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody v-if="arrayDetalle.length">
                                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                            <td v-text="detalle.nombre_producto">
                                            </td>
                                            <td v-text="detalle.cantidad">
                                            </td>
                                            <td v-text="detalle.valorUnitario">
                                            </td>
                                            <td>
                                                $ {{(detalle.subtotal=detalle.valorUnitario*detalle.cantidad).toFixed(0)}}
                                            </td>
                                        </tr>
                                        <tr style="background-color: #CEECF5;">
                                            <td colspan="3" align="right"><strong>Total Neto:</strong></td>
                                            <td v-text="totalVenta"></td>
                                        </tr>
                                    </tbody>
                                    <tbody v-else>
                                        <tr>
                                            <td colspan="4">
                                                NO hay categorias agregadas
                                            </td>
                                        </tr>
                                    </tbody>                                    
                                </table>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarDetalle()" class="btn btn-secondary">Cerrar</button>
                                
                            </div>
                        </div>
                    </div>
                    </template>
                    <!-- fin ver ingreso -->
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-3" v-model="criterioA">
                                        <option value="nombre">Nombre</option>
                                        <option value="valorUnitario">Valor Unitario</option>
                                        </select>
                                        <input type="text" v-model="buscarA" @keyup.enter="listarCategoria(buscarA,criterioA)" class="form-control" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarCategoria(buscarA,criterioA)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Opciones</th>
                                            <th>Nombre</th>
                                            <th>Valor Unitario</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="categoria in arrayCategoriaMoras" :key="categoria.id">
                                            <td>
                                                <button type="button" @click="agregarDetalleModal(categoria)" class="btn btn-success btn-sm">
                                                <i class="icon-check"></i>
                                                </button>
                                            </td>
                                            <td v-text="categoria.nombre"></td>
                                            <td v-text="categoria.valorUnitario"></td>
                                        </tr>                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                   
                </div>   
               
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    import vSelect from 'vue-select';
    export default {
        data (){
            return {
                venta_id: 0,
                productor_id:0,
                productor:'',
                otro:'',
                linea_id:0,
                linea:'',            
                lugarVenta_id:0,
                lugarVenta:'',
                totalUnidades:0.0,
                totalVenta:0.0,
                totalImpuesto: 0.0,
                totalParcial: 0.0,
                arrayVenta : [],
                arrayVentaEx : [],
                arrayProductor: [],
                arrayLugarVenta: [],
                arrayLinea:[],
                arrayDetalle : [],
                listado:1,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorVenta : 0,
                errorMostrarMsjVenta : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'personas',
                buscar : '',
                criterioA:'nombre',
                buscarA: '',
                arrayCategoriaMoras: [],
                arraySaldo:[],
                productosComers_id: 0,
                categoria:'',
                codigo:0,
                cantidad:0,
                valorUnitario: 0,
                ValorDonacion: 0,
                valorTransporte:0,
                valorAsohof:0,
                valorCuatroPorMil:0,
                totalSinDescuento:0,
                totalDonacion:0,
                totalTransporte:0,
                totalAsohof:0,
                totalCuatroXmil:0,
                subtotal:0,
                estado:'',
                fechaVenta:'',
            }
        },
        components: {
            vSelect
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            calcularTotal: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado=resultado+(this.arrayDetalle[i].valorUnitario*this.arrayDetalle[i].cantidad)-
                   this.totalDonacion-this.totalTransporte-this.totalAsohof-this.totalCuatroXmil
                }
                               
                return resultado;
            },
             calculartotalUnidades: function(){
                var resultado=0.0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    resultado =Number(resultado)+Number(this.arrayDetalle[i].cantidad)
                }
                               
                return resultado;
                
            },
            calcularTotalDonacion: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayCategoriaMoras[0].ValorDonacion)*Number(this.arrayDetalle[i].cantidad));                              
                 }
                return resultado;               
            },
            calcularTotalTransporte: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayCategoriaMoras[0].valorTransporte)*Number(this.arrayDetalle[i].cantidad));                              
                 }
                return resultado;               
            },
            calcularTotalAsohof: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayDetalle[i].valorUnitario)*Number(this.arrayDetalle[i].cantidad)*Number(this.arrayCategoriaMoras[0].valorAsohof));                              
                 }
                return resultado;               
            },
            calcularTotalCuatroXmil: function(){
                var resultado=0.0;
                 for(var i=0;i<this.arrayDetalle.length;i++){
                resultado =Number(resultado)+(Number(this.arrayDetalle[i].valorUnitario)*Number(this.arrayDetalle[i].cantidad)*Number(this.arrayCategoriaMoras[0].valorCuatroPorMil));                              
                 }
                return resultado;               
            },
           
        },
        methods : {
            listarComer (page,buscar,criterio){
                let me=this;
                var url= 'comercializacion?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayVenta = respuesta.comercializacion.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarComerEx (){
                let me=this;
                var url= 'comercializacion/excel';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayVentaEx = respuesta.comercializacion;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
           selectProductor(){
                let me =this;
                var url ='productor/selectProductor';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayProductor= respuesta.personas;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            selectLinea(search,loading){
                let me=this;
                loading(true)

                var url= 'linea/selectLinea2?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayLinea=respuesta.lineas;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosLinea(val1){
                let me = this;
                me.loading = true;
                me.linea_id = val1.id;
            },
            selectLugarVenta(search,loading){
                let me=this;
                loading(true)

                var url= 'lugarVenta/selectLugarVenta2?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q: search
                    me.arrayLugarVenta=respuesta.lugarVentas;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
             getSaldo(id){
                let me =this;
                var url ='abono/'+id;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraySaldo= respuesta.saldo;
                })
                .catch(function (error) {
                    console.log(error);
                })
            },
            getDatosLugarVenta(val1){
                let me = this;
                me.loading = true;
                me.lugarVenta_id = val1.id;
            },
            buscarCategoria(){
                let me=this;
                var url= 'producto/buscarCategoria?filtro=' + me.codigo;

                axios.get(url).then(function (response) {
                   var respuesta= response.data;
                    me.arrayCategoriaMoras = respuesta.categoriaMoras;
                   
                    if (me.arrayCategoriaMoras.length>0){
                        me.categoria=me.arrayCategoriaMoras[0]['nombre'];
                        me.productosComers_id=me.arrayCategoriaMoras[0]['id'];
                        me.valorUnitario=me.arrayCategoriaMoras[0]['valorUnitario'];
                    }
                    else{
                        me.categoria='No existe categoria';
                        me.productosComers_id=0;
                        me.valorUnitario=0;
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pdfVenta(id){
                window.open('http://gestion.asofrut.org/comercializacion/pdf/'+id);
                //window.open('http://localhost/asofrut/public/comercializacion/pdf/'+id);
            },
            cargarPdf(){
                window.open('http://gestion.asofrut.org/comercializacion/listarPdf');
                //window.open('http://localhost/asofrut/public/comercializacion/listarPdf');
            },
            reporteDiario(){
                window.open('http://gestion.asofrut.org/comercializacion/listarDiario');
                //window.open('http://localhost/asofrut/public/comercializacion/listarDiario');

            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarComer(page,buscar,criterio);
            },
            encuentra(id){
                var sw=0;
                for(var i=0;i<this.arrayDetalle.length;i++){
                    if(this.arrayDetalle[i].productosComers_id==id){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarDetalle(index){
                let me = this;
                me.arrayDetalle.splice(index, 1);
            },
            agregarDetalle(){
                let me=this;
                if(me.productosComers_id==0){
                }
                else{
                    if(me.encuentra(me.productosComers_id)){
                        swal.fire({
                            type: 'error',
                            title: 'Error...',
                            text: 'Este producto ya se encuentra agregado!',
                            })
                    }
                    else{
                      
                       me.arrayDetalle.push({
                            productosComers_id: me.productosComers_id,
                            cantidad: me.cantidad,
                            valorUnitario:me.valorUnitario,
                            });
                        me.productosComers_id=0;
                        me.cantidad=0;
                        me.valorUnitario=0;    
                    }
                    
                }

                

            },
            agregarDetalleModal(data =[]){
                let me=this;
                if(me.encuentra(data['id'])){
                        swal.fire({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esta categoria ya se encuentra agregada!',
                            })
                    }
                    else{
                       me.arrayDetalle.push({
                            productosComers_id: data['id'],
                            categoria: data['nombre'],
                            valorUnitario:data['valorUnitario'],
                            subtotal:data['subtotal'],
                            cantidad: 1,
                        }); 
                    }
            },
            listarCategoria (buscar,criterio){
                let me=this;
                var url= 'producto/listarCategoria?buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCategoriaMoras = respuesta.productos.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            verificarSaldo(){
                if(this.arraySaldo.length == 0){
                    return 0;
                }
                else{
                    return this.arraySaldo[0].saldo;
                }
            },
             verificarAbono(){
                if(this.arraySaldo.length == 0){
                    return 0;
                }
                else{
                    return this.arraySaldo[0].valorAbonado;
                }
            },
            registrarVenta(){
                if (this.validarComercializacion()){
                    return;
                }
                
                let me = this;
                axios.post('comercializacion/registrar',{
                    'productor_id': this.productor_id,
                    'otro':this.otro,
                    'totalVenta':this.totalVenta,
                    'saldo' : Number(this.totalVenta) +this.verificarSaldo(),
                    'valorAbonado':this.verificarAbono(),
                    'totalUnidades' : this.totalUnidades,
                    'data': this.arrayDetalle

                }).then(function (response) {
                    me.listado=1;
                    me.listarComer(1,'','personas');
                    me.productor_id=0;
                    me.otro='';
                    me.totalVenta=0;
                    me.totalUnidades=0;
                    
                    me.productosComers_id=0;
                    me.categoria='';
                    me.cantidad=0;
                    me.valorUnitario=0;
                    me.totalDonacion=0;
                    me.totalTransporte=0;
                    me.totalAsohof=0;
                    me.totalCuatroXmil=0;
                    me.codigo='';
                    me.arrayDetalle=[];
                    window.open('http://gestion.asofrut.org/comercializacion/pdf/'+response.data.id);

                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarComercializacion(){
                this.errorVenta=0;
                this.errorMostrarMsjVenta =[];

                if (this.productor_id==0) this.errorMostrarMsjVenta.push("Seleccione un Productor");
                if (this.arrayDetalle.length<=0) this.errorMostrarMsjVenta.push("Ingrese un producto");

                if (this.errorMostrarMsjVenta.length) this.errorVenta = 1;

                return this.errorVenta;
            },
            mostrarDetalle(){
                let me=this;
                me.listado=0;

                me.idproveedor=0;
                me.tipo_comprobante='BOLETA';
                me.serie_comprobante='';
                me.num_comprobante='';
                me.impuesto=0.18;
                me.total=0.0;
                me.idarticulo=0;
                me.articulo='';
                me.cantidad=0;
                me.precio=0;
                me.arrayDetalle=[];
            },
            ocultarDetalle(){
                this.listado=1;
            },
            verVenta(id){
                let me=this;
                me.listado=2;
                
                //Obtener los datos del ingreso
                var arrayVentaT=[];
                var url= 'comercializacion/obtenerCabecera?id=' + id;
                
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    arrayVentaT = respuesta.comercializacion;
                    me.productor = arrayVentaT[0]['nombre_persona'];
                    me.otro = arrayVentaT[0]['otro'];
                    me.totalVenta=arrayVentaT[0]['totalVenta'];
                    me.totalUnidades=arrayVentaT[0]['totalUnidades'];
                    me.fechaVenta=arrayVentaT[0]['fechaVenta'];
                })
                .catch(function (error) {
                    console.log(error);
                });

                //Obtener los datos de los detalles 
                var urld= 'comercializacion/obtenerDetalles?id=' + id;
                
                axios.get(urld).then(function (response) {
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta.productoComercializacion;
                })
                .catch(function (error) {
                    console.log(error);
                });               
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
            }, 
            abrirModal(){               
                this.arrayCategoriaMoras=[];
                this.modal = 1;
                this.tituloModal = 'Seleccione uno o varios productos';
            },
            desactivarVenta(id){
               swal.fire({
                title: 'Esta seguro de anular esta venta?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarComer(1,'','personas');
                        swal.fire(
                        'Anulado!',
                        'La venta ha sido anulada con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
             pasarFacturacion(id){
               swal.fire({
                title: 'Esta seguro de pasar al estado de Tramite de Facturacion?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/pasarFacturacion',{
                        'id': id
                    }).then(function (response) {
                        me.listarComer(1,'','personas');
                        swal.fire(
                        'Tramite Facturacion!',
                        'La venta ha pasado al siguiente estado con exito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
              pasarDisponiblePago(id){
               swal.fire({
                title: 'Esta seguro de pasar al estado de Disponible para pago?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/pasarDisponiblePago',{
                        'id': id
                    }).then(function (response) {
                        me.listarComer(1,'','personas');
                        swal.fire(
                        'Disponible para pago!',
                        'La venta ha pasado al siguiente estado con exito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
               pasarPagado(id){
               swal.fire({
                title: 'Esta seguro de pasar al estado de pagado?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('venta/pasarPagado',{
                        'id': id
                    }).then(function (response) {
                        me.listarComer(1,'','personas');
                        swal.fire(
                        'Pagado!',
                        'La venta ha pasado al siguiente estado con exito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
        },
        mounted() {
            this.selectProductor();
            this.getSaldo(this.productor_id);
            this.listarComer(1,this.buscar,this.criterio);
            this.listarComerEx();
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    @media (min-width: 600px) {
        .btnagregar {
            margin-top: 2rem;
        }
    }
    .modal-dialog{
    overflow-y: initial !important
    }
    .modal-body{
    height: 250px;
    overflow-y: auto;
    }

</style>
