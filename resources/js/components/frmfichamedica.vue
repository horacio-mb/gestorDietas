<template>
   <main>
    <div class="container">
        <h3>Ficha Médica</h3>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Consulta del cliente</td>
                    <td><input class="form-control" type="text" v-model="cliente" placeholder="Consulta"></td>
                    <a href="#" @click="frmBuscarConsulta()" data-toggle="modal" data-target="#modalConsulta">Buscar consulta</a>
                </tr>
                <tr>
                    <td>Peso Inicial</td>
                    <td><input class="form-control" type="text" v-model="peso_incial" placeholder="Kg"></td>
                </tr>
                <tr>
                    <td>Peso Actual</td>
                    <td><input class="form-control" type="text" v-model="peso_actual" placeholder="Kg"></td>
                </tr>
                <tr>
                    <td>Altura Inicial</td>
                    <td><input class="form-control" type="text" v-model="altura_inicial" placeholder="cm"></td>
                </tr>
                <tr>
                    <td>Altura Actual</td>
                    <td><input class="form-control" type="text" v-model="altura_actual" placeholder="cm"></td>
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
                    <td>Buscar consultas por cliente</td>
                    <td><input class="form-control" type="text" v-model="buscarC" placeholder="Cliente"></td>
                
                    <button class="btn btn-success" type="button" @click="listar(buscarC)">Buscar</button>
                </tr>
            </table>
            
            <table>
                <tr>
                    <td>Buscar Ficha por rango de fecha</td>
                </tr>
                <tr>
                    <td>Fecha Inicio</td>
                    <td><input class="form-control" type="date" v-model="fecha_inicio" ></td>
                </tr>
                <tr>
                    <td>Fecha Fin</td>
                    <td><input class="form-control" type="date" v-model="fecha_fin" ></td>
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
        <th>Cliente</th>
        <th>Fecha Consulta</th>
        <th>Peso Inicial</th>
        <th>Peso Actual</th>
        <th>Altura Inicial</th>
        <th>Altura Actual</th>
        <th>IMC</th>
        <th>Opciones</th>
        </thead>  
        <tbody>
            <tr v-for="ficha_medica in arrayFicha" :key="ficha_medica.id">
                <td v-text="ficha_medica.id"></td>
                <td v-text="ficha_medica.nom_cliente"></td>
                <td v-text="ficha_medica.fecha_consulta"></td>
                <td v-text="ficha_medica.pesoInicial"></td>
                <td v-text="ficha_medica.pesoActual"></td>
                <td v-text="ficha_medica.alturaInicial"></td>
                <td v-text="ficha_medica.alturaActual"></td>
                <td v-text="ficha_medica.imc"></td>
                <td><a href="#" @click="llenar(ficha_medica)">Seleccionar</a></td>
            </tr>
        </tbody> 
        </table>
    </div>
     <!-- Inicio Modal frmBuscarConsulta -->
        <div class="modal fade" id="modalConsulta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de Consulta por cliente</h4>
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
                                    <th>Apellido</th>
                                    <th>Fecha</th>
                                    <th>Fecha Reconsulta</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="consulta in arrayConsulta" :key="consulta.id">
                                    <td v-text="consulta.id"></td>
                                    <td v-text="consulta.nom_cliente"></td>
                                    <td v-text="consulta.apellido"></td>
                                    <td v-text="consulta.fecha"></td>
                                    <td v-text="consulta.fecha_reconsulta"></td>
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarConsulta(consulta)">Seleccionar</a></td>
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
        <!-- Fin Modal frmBuscarConsulta -->    
    </main> 
</template>
<script> 
export default{
 data(){
    return {
        peso_incial:'',
        peso_actual:'',
        altura_inicial:'',
        altura_actual:'',
        imc:0,
        id_ficha_medica:0,
        id_consulta : 0,
        fecha_consulta:'',
        id_cliente:0, 
        nom_cliente:'',
        arrayConsulta : [],
        arrayFicha:[],
        arrayCliente:[],
        buscar:'',
        buscarC : '',
        cliente : '',
        fecha_inicio:'',
        fecha_fin:'',
    }
  },
  methods: {
      frmBuscarCliente(){
            this.arrayCliente = [];
            this.buscarC ='';
        },
        frmBuscarConsulta(){
            this.arrayConsulta = [];
            this.buscarC ='';
        },
        buscarCliente(buscarC){
            let me = this;
            var url='/consulta?buscar=' + buscarC;
            axios.get(url).then(function(response){
                me.arrayConsulta= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },
        seleccionarConsulta(data=[]){
            this.id_consulta = data['id'];
            this.cliente=data['nom_cliente']+' '+ data['apellido'];
        },
        listar(buscar){
            let me = this;
            var url= '/fichamedica?buscar=' +buscar;
            axios.get(url).then(function(response){
                me.arrayFicha = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       buscarfechas(fecha_inicio,fecha_fin){
           let me = this;
           var url= '/fichamedica/fechas?fecha_inicio=' +fecha_inicio+'&fecha_fin='+fecha_fin;
           axios.get(url).then(function(response){
                me.arrayFicha = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       guardar(){
            let me= this;
            axios.post('/fichamedica/registrar',{
                'pesoInicial': this.peso_incial,
                'pesoActual': this.peso_actual,
                'alturaInicial':this.altura_inicial,
                'alturaActual':this.altura_actual,
                'id_consulta':this.id_consulta,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });
       },
       modificar(){
            let me= this;
            axios.put('/fichamedica/modificar',{
                'pesoInicial': this.peso_incial,
                'pesoActual': this.peso_actual,
                'alturaInicial':this.altura_inicial,
                'alturaActual':this.altura_actual,
                'id_consulta':this.id_consulta,
                'id': this.id_ficha_medica,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            }); 
       },
       eliminar(){
            let me= this;
            axios.put('/fichamedica/eliminar',{
                'id': this.id_ficha_medica
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });  
       },
       llenar(data=[]){
            this.id_ficha_medica=data['id'];
            this.cliente=data['nom_cliente']+' '+ data['apellido'];
            this.peso_incial=data['pesoInicial'];
            this.peso_actual=data['pesoActual'];
            this.altura_inicial=data['alturaInicial'];
            this.altura_actual=data['alturaActual'];
            this.imc=0;
            this.id_consulta=data['id_consulta'];
            
       },
        nuevo(){
                this.nom_cliente='';
                this.id_ficha_medica=0;
                this.altura_inicial='';
                this.altura_actual='';
                this.peso_incial='';
                this.peso_actual='';
                this.imc=0;
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