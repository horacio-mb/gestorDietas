<template>
    <main>
        <div class="container">
            <!-- Busqueda de dietas -->
            <template v-if="listado==1">
                <center>
                    <h3>Busqueda de Dietas</h3>
                    <input type="text" v-model="buscar" placeholder="Nombre Cliente">
                    <button class="btn btn-primary" type="button" @click="listar(buscar)">Buscar por Nombre</button><br>
                    <a href="#" @click="mostrarDetalle()">Volver</a>
                    <br>
                    <br>
                    <table class="table table-dark table-hover" border="1">
                        <thead>
                            <th>IdDieta</th>
                            <th>Nombre Dieta</th>
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
                    <table  class="table table-dark table-hover" border="1">
                        <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                            </tr>
                        </thead>
                        <tbody v-if="arrayDietaComida.length">
                            <tr v-for="(comida,tipo_comida,index) in arrayDietaComida" :key="comida.id">
                                <td><a href="#" @click="eliminarComida(index)">Quitar</a></td>
                                <td v-text="comida.comida"></td>
                                <td v-text="comida.distribucion"></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <button class="btn btn-primary" type="button" @click="nuevo()">Nuevo</button>
                    <button class="btn btn-success" type="button" @click="guardarDieta()">Guardar</button>
                    <button class="btn btn-danger" type="button" @click="anularDieta()">Eliminar</button>
                    <button class="btn btn-primary" type="button" @click="buscarDieta()">Buscar</button>
                </center>
            </template>

            <!-- Detalle de registro de Dieta -->
            <template v-else-if="listado==2">
                <center>
                    <h3>Busqueda de Dietas</h3>
                    <table>
                        <tr>
                            <td><b>IdDieta:</b></td>
                            <td>{{id_dieta}}</td>
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
                            <td><b>Fecha Inicio:</b></td>
                            <td>{{fecha_inicio_dieta}}</td>
                        </tr>
                        <tr>
                            <td><b>Fecha Final:</b></td>
                            <td>{{fecha_final_dieta}}</td>
                        </tr>
                    </table>
                    <br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Comida</th>
                                <th>Distribucion</th>
                            </tr>
                        </thead>
                        <tbody v-if="arrayDietaComida.length">
                            <tr v-for="detalle in arrayDietaComida" :key="detalle.id">
                                <td v-text="detalle.comida"></td>
                                <td v-text="detalle.nomC"></td>
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
                        <button class="btn btn-danger" type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarC" placeholder="Nombre o coreo">
                                    <button class="btn btn-primary" type="button" @click="buscarCliente(buscarC)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-dark table-hover" border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    <td v-text="cliente.id"></td>
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.apellidos"></td>
                                    <td v-text="cliente.correo"></td>
                                    <td v-text="cliente.telefono"></td>
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarCliente(cliente)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarCliente -->

        <!-- Inicio Modal frmBuscarComida -->
        <div class="modal fade" id="modalComida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Seleccione una o varias comidas</h4>
                        <button type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarComid" placeholder="Distribucion">
                                    <button type="button" @click="buscarComida(buscarComid)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table border="1">
                            <thead>
                                <tr>
                                    
                                    <th>Descripcion</th>
                                    <th>Distribucion</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="comida in arrayComida" :key="comida.id">
                                    <td v-text="comida.descripcion"></td>
                                    <td v-text="comida.nom_comida"></td>
                                    <td><a href="#" @click="seleccionarComida(comida)">Seleccionar</a></td>
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
        <!-- Fin Modal frmBuscarComida -->
    </main>
</template>

<script>
export default {
    data(){
        return{
            listado : 0,
            nombreDieta:'',
            fecha_inicio_dieta : '',
            fecha_final_dieta:'',
            arrayCliente: [],
            buscarC : '',
            cliente : '',
            id_cliente : 0,
            arrayComida : [],
            buscarComid : '',
            errorMsj : '',
            id_comida:'',
            distribucion:'',
            respt : '',
            arrayDietaComida:[],
            total : 0.0,
            buscar : '',
            arrayDieta : [],
            id_comida:'',
            comida:'',
            id_dieta : 0
        }
    },
    // volar esta mierda
    computed:{
    },
    methods:{
        frmBuscarCliente(){
            this.arrayCliente = [];
            this.buscarC ='';
        },
        frmBuscarComida(){
            this.arrayComida = [];
            this.buscarComid ='';
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
        buscarComida(buscarComid){
            let me = this;
            var url='/comida/selectComida?buscar=' + buscarComid;
            axios.get(url).then(function(response){
                me.arrayComida= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },

        seleccionarComida(data=[]){
            let me = this;
                me.arrayDietaComida.push({
                    id_comida: data['id'],
                    comida : data['descripcion'],
                    distribucion : data['nom_comida']
                });
            this.errorMsj='Agregado...'
        },
        eliminarComida(index){
            let me = this;
            me.arrayDietaComida.splice(index,1);
        },
        nuevo(){
            this.nombreDieta='',
            this.fecha_inicio_dieta = '',
            this.fecha_final_dieta='',
            this.id_cliente = 0;
            this.cliente = '';
            this.id_comida='',
            this.descripcion='',
            this.arrayDietaComida = [];
            this.errorMsj = '';
            this.respt='';
        },
        guardarDieta(){
            let me = this;
            axios.post('/dieta/registrar',{
                nombre : this.nombreDieta,
                fechaInicio : this.fecha_inicio_dieta,
                fechaFinal: this.fecha_final_dieta,
                id_cliente: this.id_cliente,
                data : this.arrayDietaComida
            }).then(function (response) {
                me.respt = 'Dieta Registrada...!';
            }).catch(function (error) {
                console.log(error);
            });   
        },
        listar(buscar){
            let me = this;
            var url='/dieta?buscar=' + buscar;
            axios.get(url).then(function(response){
                me.arrayDieta= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },
        buscarDieta(){
            this.listado=1;
            this.listar('');
        },
        mostrarDetalle(){
            let me = this;
            me.listado=0;
            me.respt = '';

            me.id_comida = 0;
            me.comida = '';
            me.fecha_inicio_dieta = '',
            me.fecha_final_dieta='',
            me.cliente = '';
            me.fecha_venta='';
            me.id_cliente = 0;
            me.arrayDietaComida = [];
        },
        verDieta(id){
            let me = this;
            me.listado=2;
            let arrayDietaT=[];
            var url='/dieta/obtenerCabecera?id=' + id;
            axios.get(url).then(function(response){
                arrayDietaT =response.data.dieta;
                console.log(arrayDietaT);
                me.cliente=arrayDietaT.nombrec +' '+arrayDietaT.apellidos;
                me.id_dieta=arrayDietaT.id;
                me.id_cliente=arrayDietaT.id_cliente;
                me.fecha_inicio_dieta=arrayDietaT.fechaInicio;
                me.fecha_final_dieta=arrayDietaT.fechaFinal;
            })
            .catch(function(error){
                console.log(error);
            });

            var url1 = '/dieta/obtenerDetalles?id='+id;
            axios.get(url1).then(function (response) {
                me.arrayDietaComida = response.data.detalle;
            })
            .catch(function (error) {
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
            let arrayDietaT=[];
            var url='/dieta/obtenerCabecera?id=' + id;
            axios.get(url).then(function(response){
                arrayDietaT =response.data.dieta;
                console.log(arrayDietaT);
                me.id_dieta=arrayDietaT.id;
                me.nombreDieta=arrayDietaT.nombre;
                me.cliente=arrayDietaT.nombrec +' '+arrayDietaT.apellidos;
                me.id_dieta=arrayDietaT.id;
                me.id_cliente=arrayDietaT.id_cliente;
                me.fecha_inicio_dieta=arrayDietaT.fechaInicio;
                me.fecha_final_dieta=arrayDietaT.fechaFinal;
            })
            .catch(function(error){
                console.log(error);
            });

            var url1 = '/dieta/obtenerDetalles2?id='+id;
            axios.get(url1).then(function (response) {
                me.arrayDietaComida = response.data.detalle;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        modificarDieta(){
            let me = this;
            axios.put('detalle/eliminar',{
                id: this.id_dieta
            }).then(function(error){
                //
            }).catch(function(error){
                console.log(error);
            }); 

            axios.put('/dieta/modificar',{
                nombre: this.nombreDieta,
                fechaInicio : this.fecha_inicio_dieta,
                fechaFinal : this.fecha_final_dieta,
                id_cliente: this.id_cliente,
                id : this.id_dieta,
                data : this.arrayDietaComida
            }).then(function (response) {
                me.respt = 'Dieta Modificada...!';
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