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
                        <i class="fa fa-align-justify"></i> Usuarios
                        <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                         <export-excel
                            class   = "button btn btn-success"
                            :data   = arraypersonaEx
                            worksheet = "Usuarios"
                            name    = "usuarios.xls">
                            Excel
                            </export-excel>
                            <export-excel
                            class   = "button btn btn-success"
                            :data   = arraypersonaEx
                            type="csv"
                            name    = "usuarios.xls">
                            csv
                        </export-excel>
                        <button type="button" @click="cargarPdf()" class="btn btn-info">
                            <i class="icon-doc"></i>&nbsp;PDF
                    </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="num_documento">Numero Documento</option>
                                      <option value="email">Correo Electronico</option>
                                      <option value="usuario">Usuario</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <div class='table-responsive'>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Tipo documento</th>
                                    <th>Numero documento</th>
                                    <th>Telefono</th>
                                    <th>Correo electronico</th>
                                    <th>Usuario</th>
                                    <th>Rol</th>
                                    <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arraypersona" :key="persona.id">
                                    <td>
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="persona.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarUsuario(persona.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarUsuario(persona.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="persona.nombre"></td>
                                    <td v-text="arrayTipoId[persona.tipo_id-1].nombre"></td>
                                    <td v-text="persona.num_documento"></td>
                                    <td v-text="persona.telefono"></td>
                                    <td v-text="persona.email"></td>
                                    <td v-text="persona.usuario"></td>
                                    <td v-text="persona.rol"></td>
                                    <td>
                                        <div v-if="persona.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
                                        </div>                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1"> 
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg"  role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre del persona">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Tipo Identificacion</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="tipo_id">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="tipoId in arrayTipoId" :key="tipoId.id" :value="tipoId.id" v-text="tipoId.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>                            

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Numero documento de identificacion</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="num_documento"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                   
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="telefono"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="number-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion"  class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Correo electronico</label>
                                    <div class="col-md-9">
                                        <input type="email" v-model="email" class="form-control" placeholder="Ingrese su correo electronico">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Usuario(*)</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control" placeholder="Nombre de usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Password(*)</label>
                                    <div class="col-md-9">
                                        <input type="password" v-model="password" class="form-control" placeholder="Password de acceso">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Rol(*)</label>
                                    <div class="col-md-9">
                                      <select class="form-control" v-model="idrol">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="rol in arrayRol" :key="rol.id" :value="rol.id" v-text="rol.nombre" ></option>
                                      </select>  
                                    </div>
                                </div>
                                                                 
                                <div v-show="errorpersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjpersona" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data(){
            return{
                persona_id:0,
                nombre:'',
                tipo_id:0,
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '',
                usuario:'',
                password:'',
                idrol:0,  
                arraypersona: [],
                arraypersonaEx: [],
                modal: 0,
                tituloModal : '',
                tipoAccion:0,
                errorpersona : 0,
                errorMostrarMsjpersona:[],
                pagination:{
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset:3,
                criterio: 'nombre',
                buscar: '',
                arrayTipoId : [], 
                arrayRol:[],          
            }
        },
        computed:{
            isActived:function(){
                return this.pagination.current_page;
            },
            pagesNumber:function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from=1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray=[];
                while(from <= to){
                    pagesArray.push(from);
                    from ++;
                }
                return pagesArray;
            }
        },
        methods: {
            listarPersona(page,buscar,criterio){
                this.selectTipoId();
                let me =this;
                var url ='user?page='+page + '&buscar='+buscar+'&criterio='+criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraypersona= respuesta.personas.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            listarPersonaEx(){
                let me =this;
                var url ='user/excel';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arraypersonaEx= respuesta.personas;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectTipoId(){
                let me =this;
                var url ='tipoId/selectTipoId';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayTipoId= respuesta.tipoIds;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me =this;
                var url ='rol/selectRol';
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayRol= respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza a la pagina actual
                me.pagination.current_page = page;
                //Envia la peticion para visualizar la data de esa pagina
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona(){
            if(this.validarPersona()){
                return;
            }
            let me=this;
            axios.post('user/registrar',{
                'nombre':this.nombre,
                'tipo_id':this.tipo_id,
                'num_documento':this.num_documento,
                'telefono':this.telefono,
                'direccion':this.direccion,
                'email':this.email,
                'usuario':this.usuario,
                'password':this.password,
                'idrol':this.idrol 
                
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });

        },
        cargarPdf(){
                window.open('http://gestion.asofrut.org/user/listarPdf');
            },
            actualizarPersona(){
            if(this.validarPersona()){
                return;
            }
            let me=this;
            axios.put('user/actualizar',{
                'nombre':this.nombre,
                'tipo_id':this.tipo_id,
                'num_documento':this.num_documento,
                'telefono':this.telefono,
                'direccion':this.direccion,
                'email':this.email,
                'usuario':this.usuario,
                'password':this.password,
                'idrol':this.idrol, 
                'id':this.persona_id
            }).then(function (response) {
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        desactivarUsuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
            title: 'Esta seguro de desactivar este usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                    let me=this;
                    axios.put('user/desactivar',{
                        'id':id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swalWithBootstrapButtons.fire(
                            'Desactivado!',
                            'El usuario ha sido desactivado con exito.',
                            'success'
                        )
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                
            }
            })
        },
            activarUsuario(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })
            swalWithBootstrapButtons.fire({
            title: 'Esta seguro de activar esta usuario?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                    let me=this;
                    axios.put('user/activar',{
                        'id':id
                    }).then(function (response) {
                        me.listarPersona(1,'','nombre');
                        swalWithBootstrapButtons.fire(
                            'Activado!',
                            'El usuario ha sido activado con exito.',
                            'success'
                        )
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                
            }
            })
        },          
            validarPersona(){
            this.errorpersona=0;
            this.errorMostrarMsjpersona=[];

            if(!this.nombre) this.errorMostrarMsjpersona.push("El nombre de la persona no puede estar vacío ");
            if(this.tipo_id==0)this.errorMostrarMsjpersona.push("Seleccione un tipo de documento.");
            if(!this.num_documento) this.errorMostrarMsjpersona.push("Ingrese un numero de documento valido");
            if(!this.telefono) this.errorMostrarMsjpersona.push("Ingrese un numero de telefono valido sin lineas ni puntos");
            if(!this.email) this.errorMostrarMsjpersona.push("Ingrese un correo electronico valido");
            if(!this.usuario) this.errorMostrarMsjpersona.push("El nombre de usuario no puede estar vacío ");
            if(!this.password) this.errorMostrarMsjpersona.push("El password no puede estar vacío ");
            if(this.tipo_id==0)this.errorMostrarMsjpersona.push("Seleccione un rol para el usuario.");
            if(this.errorMostrarMsjpersona.length) this.errorpersona=1;

            return this.errorpersona;
        },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre = '';
                this.tipo_id= 0;
                this.num_documento = '';
                this.telefono = '';
                this.direccion='';
                this.email = '';
                this.usuario='';
                this.password='';
                this.idrol=0;
		        this.errorpersona=0;
        },
            abrirModal(modelo,accion,data = []){
            switch (modelo) {
                case "persona":
                {    
                switch (accion) {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Usuario';
                        this.nombre = '';
                        this.tipo_id= 0;
                        this.num_documento = '';
                        this.telefono = ''; 
                        this.direccion='';
                        this.email = '';
                        this.usuario='';
                        this.password='';
                        this.idrol=0;
                        this.tipoAccion=1;
                        break;
                    }    
                    case 'actualizar':
                    {
                        this.modal=1;
                        this.tituloModal='Actualizar Usuario';
                        this.tipoAccion=2;
                        this.persona_id=data['id'];
                        this.nombre = data['nombre'];
                        this.tipo_id= data['tipo_id'];
                        this.num_documento =data ['num_documento'];
                        this.telefono = data['telefono'];
                        this.direccion=data['direccion'];
                        this.email = data['email'];
                        this.usuario = data['usuario'];
                        this.password=data['password'];
                        this.idrol=data['idrol'];
                        break;
                    }       
                }
                }
            }
            this.selectTipoId();
            this.selectRol();
           
        }
        },        
        mounted() {
           this.listarPersona(1,this.buscar,this.criterio);
           this.listarPersonaEx();
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
        display:flex;
        justify-content: center;
    }
    .text-error{
        color:red !important;
        font-weight: bold;
    }
    .modal-dialog{
    overflow-y: initial !important
    }
    .modal-body{
    height: 250px;
    overflow-y: auto;
    }
</style>