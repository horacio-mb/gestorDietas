<template>
    <main>
    <div class="container">
        <h3>Cuestionario </h3>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Ficha Medica del Cliente</td>
                    </tr>
                    <tr>
                    <td><input class="form-control" type="text" v-model="nombrecliente" placeholder="Ficha Medica"></td>
                    <a href="#" @click="frmBuscarFichaMedica()" data-toggle="modal" data-target="#modalFichaMedica">Buscar Ficha Medica</a>
                </tr>
               <br>
                <tr>
                    <td>1.  ¿Sufre usted de alguna enfermedad de base?</td>
                    
                </tr>
                <tr>
                    <td><input type="text" v-model="enfermedadBase" placeholder="Rellenar"></td>
                </tr>
                <br>
                 <tr>
                    <td>2.  ¿En su familia existe algun antecedente acerca de alguna enfermedad?</td>
                    
                </tr>
                <tr>
                    <td><input type="text" v-model="anteFamiliares" placeholder="Rellenar"></td>
                </tr>


                <br>
                 <tr>
                    <td>3.  ¿Con que frecuencia consume alcohol?</td>
                 </tr>
                 <tr>  
                    <td>
                    <input type="radio"  v-model="consumoAlcohol" value=4><label>Siempre</label><br>
                    <input type="radio"  v-model="consumoAlcohol" value=3><label>Frecuentemente</label><br>
                    <input type="radio"  v-model="consumoAlcohol" value=2><label>A veces</label><br>
                    <input type="radio"  v-model="consumoAlcohol" value=1><label>Casi Nunca</label><br>
                    <input type="radio"  v-model="consumoAlcohol" value=0><label>Nunca</label><br>
                    
                    </td>
                </tr>
                <br>

                <tr>
                    <td>4.  ¿Con que frecuencia consume tabaco?</td>
                </tr>
                <tr>
                    <td>
                    <input type="radio"  v-model="consumoTabaco" value=4><label>Siempre</label><br>
                    <input type="radio"  v-model="consumoTabaco" value=3><label>Frecuentemente</label><br>
                    <input type="radio"  v-model="consumoTabaco" value=2><label>A veces</label><br>
                    <input type="radio"  v-model="consumoTabaco" value=1><label>Casi Nunca</label><br>
                    <input type="radio"  v-model="consumoTabaco" value=0><label>Nunca</label><br>
                    
                    </td>
                </tr>
                <br>
                <tr>
                    <td>5.  ¿Con que frecuencia consume cafe?</td>
                </tr>
                <tr>   
                    <td>
                    <input type="radio"  v-model="consumoCafe" value=4><label>Siempre</label><br>
                    <input type="radio"  v-model="consumoCafe" value=3><label>Frecuentemente</label><br>
                    <input type="radio"  v-model="consumoCafe" value=2><label>A veces</label><br>
                    <input type="radio"  v-model="consumoCafe" value=1><label>Casi Nunca</label><br>
                    <input type="radio"  v-model="consumoCafe" value=0><label>Nunca</label><br>
                    
                    </td>
                </tr>

                <br>
                <tr>
                    <td>6.  ¿Usted ingiere algun medicamento recetado?</td>
                </tr>
                <tr>
                    <td><input type="text" v-model="consumoMedicamentos" placeholder="Rellenar"></td>
                </tr>

                <br>

               <tr>
                    <td>7.  ¿Cuantas comidas acostumbra a consumir en el transcurso del dia?</td>
               </tr>
               <tr>
                    <td>
                    <input type="radio"  v-model="comidasDia" value=0><label>0</label><br>
                    <input type="radio"  v-model="comidasDia" value=1><label>1-2</label><br>
                    <input type="radio"  v-model="comidasDia" value=2><label>3-5</label><br>
                    <input type="radio"  v-model="comidasDia" value=3><label>6 o mas</label><br>
                    </td>
                </tr>
                
                <br>

                 <tr>
                    <td>8.  ¿Cuantas veces a la semana realiza alguna actividad fisica?</td>
                 </tr>
                 <tr>   
                    <td>
                    <input type="radio"  v-model="actividadFisica" value=0><label>0</label><br>
                    <input type="radio"  v-model="actividadFisica" value=1><label>1-2</label><br>
                    <input type="radio"  v-model="actividadFisica" value=2><label>3-5</label><br>
                    <input type="radio"  v-model="actividadFisica" value=3><label>6 o mas</label><br>
                    </td>
                </tr>
        </table>
        <table>
                <br>
                <tr>
                    <td colspan="3"> 
                      <button class="btn btn-primary" type="button" @click="nuevo()">Nuevo</button> 
                      <button class="btn btn-success" type="button" @click="guardar()">Guardar</button> 
                      <button class="btn btn-danger" type="button" @click="eliminar()">Eliminar</button> 
                      <button class="btn btn-primary" type="button" @click="modificar()">Modificar</button>
                    </td>
                </tr>
            </table>
            <input type="text" v-model="buscar" placeholder="Nombre Cliente">
            <button class="btn btn-primary" type="button" @click="listar(buscar)">Buscar cliente por Nombre</button>
        </form>
        <br>
        <br>
        <table class="table table-dark table-hover" border="2">
        <thead>
        <th>Id</th>
        <th>Cliente</th>
        <th>Enfermedad de base</th>
        <th>Antecedes Familiar</th>
        <th>Consumo de Alcohol</th>
        <th>Consumo de Tabaco </th>
        <th>Consumo de Cafe</th>
        <th>Consumo de Medicamentos </th>
        <th>Cant. comidas al dia</th>
        <th>Actividad Fisica </th>
        <th>Opciones</th>
        </thead>
        <tbody>
            <tr v-for="cuestionario in arrayCuestionario" :key="cuestionario.id">
                <td v-text="cuestionario.id"></td>
                <td v-text="cuestionario.nom_cliente"></td>
                <td v-text="cuestionario.enfermedadBase"></td>
                <td v-text="cuestionario.anteFamiliares"></td>
                <td v-text="cuestionario.consumoAlcohol"></td>
                <td v-text="cuestionario.consumoTabaco"></td>
                <td v-text="cuestionario.consumoCafe"></td>
                <td v-text="cuestionario.consumoMedicamentos"></td>
                <td v-text="cuestionario.comidasDia"></td>
                <td v-text="cuestionario.actividadFisica"></td>
                 <td><a href="#" @click="llenar(cuestionario)">Seleccionar</a></td>
            </tr>
        </tbody>
    </table>
    </div>
    <!-- Inicio Modal frmBuscarFichaMedica -->
        <div class="modal fade" id="modalFichaMedica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de Ficha Medica por Cliente</h4>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarFM" placeholder="Nombre">
                                    <button class="btn btn-primary" type="button" @click="buscarFichaMedica(buscarFM)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-dark table-hover" border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Peso Inicial</th>
                                    <th>Peso Actual</th>
                                    <th>Altura Inicial</th>
                                    <th>Altura Actual</th>
                                    <th>IMC</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ficha_medica in arrayFichaMedica" :key="ficha_medica.id">
                                    <td v-text="ficha_medica.id"></td>
                                    <td v-text="ficha_medica.nom_cliente"></td>
                                    <td v-text="ficha_medica.apellido"></td>
                                    <td v-text="ficha_medica.pesoInicial"></td>
                                    <td v-text="ficha_medica.pesoActual"></td>
                                    <td v-text="ficha_medica.alturaInicial"></td>
                                    <td v-text="ficha_medica.alturaActual"></td>
                                    <td v-text="ficha_medica.imc"></td>
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarFichaMedica(ficha_medica)">Seleccionar</a></td>
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
        <!-- Fin Modal frmBuscarFichaMedica -->     
    </main>
</template>

<script>
export default{
 data(){
    return {
        id_cuestionario : 0,
        peso_inicial: '',
        peso_actual: '',
        altura_inicial: '',
        altura_actual:'',
        imc:0,
        id_fichaMedica:0,
        nom_cliente:'',
        nombrecliente: '',
        arrayConsulta:[],
        arrayFichaMedica:[],
        arrayCuestionario:[],
        buscar:'',
        buscarFM : '',
        cliente : '',
        fecha_inicio:'',
        fecha_fin:'',
        enfermedadBase:'',
        anteFamiliares: '',
        consumoAlcohol: '',
        consumoTabaco: '',
        consumoCafe: '',
        consumoMedicamentos: '',
        comidasDia: '',
        actividadFisica: '',
        Opciones : '',
        arrayCliente : []
    }
  },
  methods:{
      frmBuscarCliente(){
          this.arrayCliente = [];
          this.buscarFM = '';
      },

       frmBuscarFichaMedica(){
            this.arrayConsulta = [];
            this.buscarFM ='';
        },

        buscarFichaMedica(buscarFM){
            let me = this;
            var url = '/fichamedica?buscar='+buscarFM;
            axios.get(url).then(function(response){
                me.arrayFichaMedica=response.data;
            })
            .catch(function(error){
                console.loog(error);
            })
        },

        seleccionarFichaMedica(data=[]){
            this.id_fichaMedica = data['id'];
            this.nombrecliente=data['nom_cliente']+' '+ data['apellido'];
        },


      listar(buscar){
            let me = this;
            var url= '/cuestionario?buscar=' +buscar;
            axios.get(url).then(function(response){
                me.arrayCuestionario = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       guardar(){
           let me=this;
           axios.post('/cuestionario/registrar',{
               'enfermedadBase':this.enfermedadBase,
               'anteFamiliares':this.anteFamiliares,
               'consumoAlcohol':this.consumoAlcohol,
               'consumoTabaco':this.consumoTabaco,
               'consumoCafe':this.consumoCafe,
               'consumoMedicamentos':this.consumoMedicamentos,
               'comidasDia':this.comidasDia,
               'actividadFisica':this.actividadFisica,
               'id_fichaMedica':this.id_fichaMedica,
           }).then(function(error){
               me.listar('');
           }).catch(function(error){
               console.log(error);
           });
       },
       modificar(){
            let me= this;
            axios.put('/cuestionario/modificar',{
                'enfermedadBase': this.enfermedadBase,
                'anteFamiliares': this.anteFamiliares,
                'consumoAlcohol': this.consumoAlcohol,
                'consumoTabaco': this.consumoTabaco,
                'consumoCafe': this.consumoCafe,
                'consumoMedicamentos': this.consumoMedicamentos,
                'comidasDia': this.comidasDia,
                'actividadFisica': this.actividadFisica,
                'id_fichaMedica':this.id_fichaMedica,
                'id':this.id_cuestionario,
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            }); 
       },
       eliminar(){
            let me= this;
            axios.put('/cuestionario/eliminar',{
                'id': this.id_cuestionario
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });  
       },
       llenar(data=[]){
            this.id_cuestionario=data['id'];
            this.nombrecliente=data['nom_cliente']+' '+data['apellido'];
            this.peso_incial=data['pesoInicial'];
            this.peso_actual=data['pesoActual'];
            this.altura_inicial=data['alturaInicial'];
            this.altura_actual=data['alturaActual'];
            this.imc=0;
            this.id_fichaMedica=data['id_fichaMedica'];
            this.enfermedadBase=data['enfermedadBase'];
            this.anteFamiliares=data['anteFamiliares'];
            this.consumoAlcohol=data['consumoAlcohol'];
            this.consumoTabaco=data['consumoTabaco'];
            this.consumoCafe=data['consumoCafe'];
            this.consumoMedicamentos=data['consumoMedicamentos'];
            this.comidasDia=data['comidasDia'];
            this.actividadFisica=data['actividadFisica'];

       },
        nuevo(){
                this.nom_cliente= '',
                this.id_cuestionario =0;
                this.altura_inicial='';
                this.altura_actual='';
                this.peso_incial='';
                this.peso_actual='';
                this.imc=0;
                this.id_fichaMedica = 0;
                this.buscar = '';
                this.cliente ='';
                this.enfermedadBase = '',
                this.anteFamiliares = '',
                this.consumoAlcohol = '',
                this.consumoTabaco = '',
                this.consumoCafe = '',
                this.consumoMedicamentos = '',
                this.comidasDia ='',
                this.actividadFisica = '',
                this.buscar = '';
      },
   },
   mounted(){
       this.listar(this.buscar);
   }
}
</script>