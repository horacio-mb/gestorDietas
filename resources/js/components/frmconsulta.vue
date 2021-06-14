<template>
    <main>
    <div class="container">
        <h3>Consulta Médica</h3>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Nombre Cliente</td>
                    <td><input type="text" v-model="cliente" placeholder="Agregar Cliente"></td>
                    <a href="#" @click="frmBuscarCliente()" data-toggle="modal" data-target="#modalCliente">Buscar cliente</a>
                </tr>
                <tr>
                    <td>Fecha Consulta</td>
                    <td><input type="date" v-model="fecha" placeholder="Fecha Consulta"></td>
                </tr>
                <tr>
                    <td>Fecha Reconsulta</td>
                    <td><input type="date" v-model="fecha_reconsulta" placeholder="Fecha Reconsulta"></td>
                </tr>
                <tr>
                <td colspan="3">
                    <button class="btn btn-primary" type="button" @click="nuevo()">Nuevo</button>
                    <button class="btn btn-success" type="button" @click="guardar()">Guardar</button>
                    <button class="btn btn-primary" type="button" @click="modificar()">Modificar</button>
                    <button class="btn btn-danger" type="button" @click="eliminar()">Eliminar</button>
                </td>
                </tr>
            </table>
            <br>
            <table>
                <tr>
                    <td>Buscar por Cliente</td>
                </tr>
                <tr>
                    <td><input type="text" v-model="buscarcli" placeholder="Nombre Cliente"></td>
                    <button class="btn btn-success" type="button" @click="listar(buscarcli)">Buscar</button>
                
                </tr>
            </table>
            <br>

            <table>
                <tr>
                    <td>Buscar consultas por rango de fecha</td>
                </tr>
                <tr>
                    <td>Fecha Inicio</td>
                    <td><input type="date" v-model="fecha_inicio" ></td>
                </tr>
                <tr>
                    <td>Fecha Fin</td>
                    <td><input type="date" v-model="fecha_fin" ></td>
                </tr>
                <tr>
                    <button class="btn btn-success" type="button" @click="buscarfechas(fecha_inicio,fecha_fin)">Buscar</button>
                </tr>
            </table>
        </form>
        <br>
        <br>
        <table class="table table-dark table-hover" border="2">
        <thead>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Fecha</th>
        <th>Fecha Reconsulta</th>
        <th>Opciones</th>
        </thead>
        <tbody>
            <tr v-for="consulta in arrayConsulta" :key="consulta.id">
                <td v-text="consulta.id"></td>
                <td v-text="consulta.nom_cliente"></td>
                <td v-text="consulta.apellido"></td>
                <td v-text="consulta.fecha"></td>
                <td v-text="consulta.fecha_reconsulta"></td>
                 <td><a href="#" @click="llenar(consulta)">Seleccionar</a></td>
            </tr>
        </tbody>
    </table>
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
                                    <input type="text" v-model="buscarC" placeholder="Nombre">
                                    <button class="btn btn-primary" type="button" @click="buscarCliente(buscarC)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-dark table-hover" border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                    <td v-text="cliente.id"></td>
                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.apellido_paterno"></td>
                                    <td v-text="cliente.apellido_materno"></td>
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

    </main>
</template>

<script> 
export default{
 data(){
    return {
        id_consulta : 0,
        id_cliente:0,
        id_usuario:1,
        nom_cliente:'',
        fecha : '',
        fecha_reconsulta : '',
        fecha_inicio:'',
        fecha_fin:'',
        arrayConsulta : [],
        arrayCliente:[],
        buscar:'',
        buscarC : '',
        cliente : '',
        buscarcli:'',
    }
  },
  methods: {
      frmBuscarCliente(){
            this.arrayCliente = [];
            this.buscarC ='';
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
        //buscarcli
        
        seleccionarCliente(data=[]){
            this.id_cliente = data['id'];
            this.cliente=data['nombre']+' '+ data['apellido_paterno'];
        },
        llenar(data=[]){
            this.id_consulta=data['id'];
            this.fecha=data['fecha'];
            this.fecha_reconsulta=data['fecha_reconsulta'];
            this.id_cliente=data['id_cliente'];
            this.id_usuario=data['id_usuario'];
            this.cliente=data['nom_cliente']+' '+ data['apellido'];

       },
        listar(buscar){
            let me = this;
            var url= '/consulta?buscar=' +buscar;
            axios.get(url).then(function(response){
                me.arrayConsulta = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       buscarfechas(fecha_inicio,fecha_fin){
           let me = this;
           var url= '/consulta/fechas?fecha_inicio=' +fecha_inicio+'&fecha_fin='+fecha_fin;
           axios.get(url).then(function(response){
                me.arrayConsulta = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       buscarCliente2(buscarcli){
           let me = this;
           var url= '/consulta/selectConsulta?buscar=' +buscarcli;
           axios.get(url).then(function(response){
                me.arrayConsulta = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       guardar(){
            let me= this;
            axios.post('/consulta/registrar',{
                'fecha': this.fecha,
                'fecha_reconsulta': this.fecha_reconsulta,
                'id_cliente':this.id_cliente,
                'id_usuario':1
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });
       },
       modificar(){
            let me= this;
            axios.put('/consulta/modificar',{
                'fecha': this.fecha,
                'fecha_reconsulta': this.fecha_reconsulta,
                'id_cliente':this.id_cliente,
                'id_usuario':1,
                'id': this.id_consulta,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            }); 
       },
       eliminar(){
            let me= this;
            axios.put('/consulta/eliminar',{
                'id': this.id_consulta
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });  
       },
        nuevo(){
                this.fecha = '';
                this.fecha_reconsulta = '';
                this.id_cliente = 0;
                this.id_consulta = 0;
                this.buscar = '';
                this.cliente ='';
      },
    },
   mounted(){
       this.listar(this.buscar);
   }
}
</script>