<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de venta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        width: 100px;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
        background: #2183E3;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facarticulo thead{
        padding: 20px;
        background: #2183E3;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #gracias{
        text-align: center; 
        }
    </style>
    <body>
        @foreach($comercializacion as $c)
        <header>
            <div id="logo">
                <img src="img/logo.png" alt="asofrut" id="imagen">
            </div>
            <div id="datos">
                <p id="encabezado">
                    <b>Asofrut</b><br>Colombia, Cauca, Toribío, B/ El centro, Cra 2 esquina<br>Telefono:+ 057 322 648 61 36<br>Email:servicioalcliente@asofrut.org<br>
                    areacomercial@asofrut.org
                </p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <th id="fac">Productor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Sr(a). {{$c->nombre_persona}}<br>
                            Documento: {{$c->num_documento}}<br>
                            Dirección: {{$c->direccion}}<br>
                            Teléfono: {{$c->telefono}}<br>
                            Email: {{$c->email}}</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv" align="left">
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$c->fechaVenta}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        @endforeach
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">
                            <th>Producto</th>
                            <th>Valor Unitario</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                    @foreach($productoComercializacion as $ventaC)
                        <tr>
                            <td>{{$ventaC->nombre_producto}}</td>
                            <td>{{$ventaC->valorUnitario}}</td>
                            <td>{{$ventaC->cantidad}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <br>
                    <br>
                    <tfoot align="center">                  
                    @foreach($comercializacion as $v)
                        <tr>
                            <th></th>
                            <th></th>
                            <td></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Total Unidades</th>
                            <td>{{$v->totalUnidades}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Total Neto</th>
                            <td>{{$v->totalVenta}}</td>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
    </body>
</html>