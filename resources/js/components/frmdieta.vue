<template>
    <main>
        <div class="container">
            <!-- Busqueda de dietas -->
            <template v-if="listado==1">
                <center>
                    <h3>Busqueda de Dietas</h3>
                    <input type="text" v-model="buscar" placeholder="Nombre Cliente">
                    <button type="button" @click="listar(buscar)">Buscar por Nombre</button><br>
                    <a href="#" @click="mostrarDetalle()">Volver</a>
                    <br>
                    <br>
                    <table border="1">
                        <thead>
                            <th>IdDieta</th>
                            <table>Nombre Dieta</table>
                            <th>Cliente</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Opcion</th>
                        </thead>
                        <tbody>
                            <tr v-for="dieta in arrayDieta" :key="dieta.id">
                                <td v-text="dieta.id"></td>
                                <td v-text="dieta.nombre"></td>
                                <td v-text="dieta.nombreC +' '+dieta.apellidos"></td>
                                <td v-text="dieta.fechaInicio"></td>
                                <td v-text="dieta.fechaFinal"></td>
                                <td>
                                    <a href="#" @click="modificarDetalle(dieta.id)">Seleccionar</a>                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </template>

            <!-- Registro de DietaComida -->
            <template v-else-if="listado==0">
                <center>
                    <h3>Registro de Dietas</h3>
                    <form action="" method="POST">
                        <table>
                            <tr>
                                <td>Nombre dieta</td>
                                <td><input type="text" v-model="nombreDieta"></td>
                            </tr>
                            <tr>
                                <td>Fecha Inicio</td>
                                <td><input type="date" v-model="fecha_inicio_dieta"></td>
                            </tr>
                            <tr>
                                <td>Fecha Final</td>
                                <td><input type="date" v-model="fecha_final_dieta"></td>
                            </tr>
                            <tr>
                                <td>Cliente</td>
                                <td><input type="text" v-model="cliente" placeholder="Agregar Cliente..."></td>
                                <a href="#" @click="frmBuscarCliente()" data-toggle="modal" data-target="#modalCliente">Buscar cliente</a>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" @click="frmBuscarComida()" data-toggle="modal" data-target="#modalComida">Agregar comida</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <label v-text="respt"></label>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                            </tr>
                        </thead>
                        <tbody v-if="arrayDietaComida.length">
                            <tr v-for="(detalle,index) in arrayDietaComida" :key="detalle.id">
                                <td><a href="#" @click="eliminarDetalle(index)">Quitar</a></td>
                                <td v-text="detalle.producto"></td>
                                <td v-text="detalle.precio"></td>
                                <td>
                                    <span style="color:red;" v-show="detalle.cantidad>detalle.stock">Stock: {{detalle.stock}}</span>
                                    <input type="number" v-model="detalle.cantidad">
                                </td>
                                <td>{{detalle.preciov = detalle.precio*detalle.cantidad}}</td>
                            </tr>
                            <tr style="background-color: #CEECF5;">
                                <td colspan="4" align="right"><strong>Total Neto: bs</strong></td>
                                <td>{{total = calcularTotal}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <button type="button" @click="nuevo()">Nuevo</button>
                    <button type="button" @click="guardarVenta()">Guardar</button>
                    <button type="button" @click="modificarVenta()">Modificar</button>
                    <button type="button" @click="anularVenta()">Eliminar</button>
                    <button type="button" @click="buscarVenta()">Buscar</button>
                </center>
            </template>

            <!-- Detalle de registro de venta -->
            <template v-else-if="listado==2">
                <center>
                    <h3>Busqueda de Ventas</h3>
                    <table>
                        <tr>
                            <td><b>IDVenta:</b></td>
                            <td>{{id_venta}}</td>
                        </tr>
                        <tr>
                            <td><b>IDCliente:</b></td>
                            <td>{{id_cliente}}</td>
                        </tr>
                        <tr>
                            <td><b>Cliente:</b></td>
                            <td>{{cliente}}</td>
                        </tr>
                        <tr>
                            <td><b>FechaVenta:</b></td>
                            <td>{{fecha_venta}}</td>
                        </tr>
                    </table>
                    <br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody v-if="arrayDetalle.length">
                            <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                                <td v-text="detalle.producto.descripcion"></td>
                                <td v-text="detalle.producto.precio"></td>
                                <td v-text="detalle.cantidad"></td>
                                <td v-text="detalle.preciov"></td>
                            </tr>
                            <tr style="background-color: #CEECF5;">
                                <td colspan="3" align="right"><strong>Total Neto: bs</strong></td>
                                <td>{{total}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" @click="ocultarDetalle()">Cerrar</button>
                </center>
            </template>
        </div>

        <!-- Inicio Modal frmBuscarCliente -->
        <div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de clientes</h4>
                        <button type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarC" placeholder="Nombre ó Empresa">
                                    <button type="button" @click="buscarCliente(buscarC)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Empresa</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    <td v-text="cliente.id"></td>
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.apellidos"></td>
                                    <td v-text="cliente.empresa"></td>
                                    <td v-text="cliente.telefono"></td>
                                    <td v-text="cliente.direccion"></td>
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarCliente(cliente)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarCliente -->

        <!-- Inicio Modal frmBuscarProducto -->
        <div class="modal fade" id="modalProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Seleccion uno o varios productos</h4>
                        <button type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarP" placeholder="Descripcion">
                                    <button type="button" @click="buscarProducto(buscarP)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Descripcion</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Categoria</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="producto in arrayProducto" :key="producto.id">
                                    <td v-text="producto.id"></td>
                                    <td v-text="producto.descripcion"></td>
                                    <td v-text="producto.precio"></td>
                                    <td v-text="producto.stock"></td>
                                    <td v-text="producto.nom_categoria"></td>
                                    <td><a href="#" @click="seleccionarProducto(producto)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarProducto -->
    </main>
</template>

<script>
export default {
    data(){
        return{
            listado : 0,
            fecha_venta : '',
            arrayCliente: [],
            buscarC : '',
            cliente : '',
            id_cliente : 0,
            arrayProducto : [],
            buscarP : '',
            errorMsj : '',
            producto: '',
            id_producto : 0,
            preciov : 0.0,
            cantidad : 0,
            stock : 0,
            respt : '',
            arrayDetalle : [],
            total : 0.0,
            buscar : '',
            arrayDieta : [],
            id_venta : 0
        }
    },
    computed:{
        calcularTotal: function(){
            var resultado = 0.0;
            for(var i=0;i<this.arrayDetalle.length;i++){
                resultado = resultado + (this.arrayDetalle[i].precio*this.arrayDetalle[i].cantidad);
            }
            return resultado;
        }
    },
    methods:{
        frmBuscarCliente(){
            this.arrayCliente = [];
            this.buscarC ='';
        },
        frmBuscarProducto(){
            this.arrayProducto = [];
            this.buscarP ='';
            this.errorMsj = '';
        },
        buscarCliente(buscarC){
            let me = this;
            var url='/cliente/selectCliente?filtro=' + buscarC;
            axios.get(url).then(function(response){
                me.arrayCliente= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },
        seleccionarCliente(data=[]){
            this.id_cliente = data['id'];
            this.cliente=data['nombre']+' '+ data['apellidos'];
        },
        buscarProducto(buscarP){
            let me = this;
            var url='/producto/selectProducto?buscar=' + buscarP;
            axios.get(url).then(function(response){
                me.arrayProducto= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },
        encuentra(id){
            var sw=0;
            for(var i=0;i<this.arrayDetalle.length;i++){
                if(this.arrayDetalle[i].id_producto==id){
                    sw=true;
                }
            }
            return sw;
        },
        seleccionarProducto(data=[]){
            let me = this;
            if(me.encuentra(data['id'])){
                this.errorMsj='Ya se encuentra agregado...'
            }
            else{
                me.arrayDetalle.push({
                    id_producto: data['id'],
                    producto : data['descripcion'],
                    cantidad : 1,
                    precio : data['precio'],
                    preciov : 0.0,
                    stock : data['stock']
                });
            }
        },
        eliminarDetalle(index){
            let me = this;
            me.arrayDetalle.splice(index,1);
        },
        nuevo(){
            this.id_cliente = 0;
            this.cliente = '';
            this.fecha_venta = '';
            this.total = 0.0;
            this.id_producto = 0;
            this.producto = '';
            this.cantidad = 0;
            this.preciov = 0.0;
            this.stock = 0;
            this.arrayDetalle = [];
            this.errorMsj = '';
            this.respt='';
        },
        guardarVenta(){
            let me = this;
            axios.post('/venta/registrar',{
                fecha : this.fecha_venta,
                monto : this.total,
                id_cliente: this.id_cliente,
                data : this.arrayDetalle
            }).then(function (response) {
                me.respt = 'Venta Registrada...!';
            }).catch(function (error) {
                console.log(error);
            });   
        },
        listar(buscar){
            let me = this;
            var url='/venta?buscar=' + buscar;
            axios.get(url).then(function(response){
                me.arrayVenta= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },
        buscarVenta(){
            this.listado=1;
            this.listar('');
        },
        mostrarDetalle(){
            let me = this;
            me.listado=0;
            me.respt = '';
            me.total = 0.0;
            me.id_producto = 0;
            me.producto = '';
            me.cantidad = 0;
            me.preciov = 0.0;
            me.cliente = '';
            me.fecha_venta='';
            me.id_cliente = 0;
            me.arrayDetalle = [];
        },
        verVenta(id){
            let me = this;
            me.listado=2;
            let arrayVentaT=[];
            var url='/venta/obtenerCabecera?id=' + id;
            axios.get(url).then(function(response){
                arrayVentaT =response.data.venta;
                console.log(arrayVentaT);
                me.cliente=arrayVentaT.nombre +' '+arrayVentaT.apellidos;
                me.id_venta=arrayVentaT.id;
                me.id_cliente=arrayVentaT.id_cliente;
                me.fecha_venta=arrayVentaT.fecha
                me.total=arrayVentaT.monto;
            })
            .catch(function(error){
                console.log(error);
            });

            var url1 = '/venta/obtenerDetalles?id='+id;
            axios.get(url1).then(function (response) {
                me.arrayDetalle = response.data.detalle;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        anularVenta(){
            let me = this;
            axios.put('/venta/anular',{
                'id': this.id_venta
            }).then(function (response) {
                // me.listar('');
                me.respt = 'Venta Eliminada...!';
            }).catch(function (error) {
                console.log(error);
            });
        },
        ocultarDetalle(){
            this.listado=1;
            this.listar('');
        },
        modificarDetalle(id){
            let me = this;
            me.listado=0;
            this.respt='';
            let arrayVentaT=[];
            var url='/venta/obtenerCabecera?id=' + id;
            axios.get(url).then(function(response){
                arrayVentaT =response.data.venta;
                console.log(arrayVentaT);
                me.cliente=arrayVentaT.nombre +' '+arrayVentaT.apellidos;
                me.id_venta=arrayVentaT.id;
                me.id_cliente=arrayVentaT.id_cliente;
                me.fecha_venta=arrayVentaT.fecha
                me.total=arrayVentaT.monto;
            })
            .catch(function(error){
                console.log(error);
            });

            var url1 = '/venta/obtenerDetalles2?id='+id;
            axios.get(url1).then(function (response) {
                me.arrayDetalle = response.data.detalle;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        modificarVenta(){
            let me = this;
            axios.put('detalle/eliminar',{
                id: this.id_venta
            }).then(function(error){
                //
            }).catch(function(error){
                console.log(error);
            }); 

            axios.put('/venta/modificar',{
                fecha : this.fecha_venta,
                monto : this.total,
                id_cliente: this.id_cliente,
                id : this.id_venta,
                data : this.arrayDetalle
            }).then(function (response) {
                me.respt = 'Venta Modificada...!';
            }).catch(function (error) {
                console.log(error);
            });
        }
    },
    mounted(){
        this.listar(this.buscar); 
    }
}
</script>