<template>
    <main>
        <div class="container">
            <!-- Busqueda de dietas -->
            <template v-if="listado==1">
                <center>
                    <h3>Busqueda de Dietas</h3>
                    <input type="text" v-model="buscar" placeholder="Nombre Cliente">
                    <button class="btn btn-primary" type="button" @click="buscarNombre(buscar)">Buscar por Nombre</button><br>
                    <a href="#" @click="mostrarDetalle()">Volver</a>
                    <br>
                    <br>
                    <table class="table table-dark table-hover" border="1">
                        <thead>
                            <th>IdGestDieta</th>
                            <th>Cliente</th>                           
                            <th>Fecha Inicio</th>
                            <th>Fecha Final</th>
                            <th>Tipo</th>
                            <th>Opcion</th>
                        </thead>
                        <tbody>
                            <tr v-for="dieta in arrayDieta" :key="dieta.id">
                                <td v-text="dieta.id"></td>
                                <td v-text="dieta.nom_cliente +' '+dieta.apellido"></td>
                                <td v-text="dieta.fechaInicio"></td>
                                <td v-text="dieta.fechaFinal"></td>
                                <td v-text="dieta.tipo"></td>
                                <td>
                                    <a href="#" @click="seleccionarDieta(dieta)">Seleccionar</a>                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </template>

            <!-- Registro de DietaComida -->
            <template v-else-if="listado==0">
                <h3>Gestionar Dieta</h3>
                <form action="" method="post">
                    <table>
                        <tr>
                            <td>Ficha Medica de Cliente</td>
                            <td><input  class="form-control" type="text" v-model="cliente" placeholder="Cliente"></td>
                            <a href="#" @click="frmBuscarFicha()" data-toggle="modal" data-target="#modalFicha">Buscar ficha</a>
                        </tr>
                        <tr>
                            <td>Fecha Inicio</td>
                            <td><input class="form-control" type="date" v-model="fecha_inicio_dieta"></td>
                        </tr>
                        <tr>
                                <td>Fecha Final</td>
                                <td><input class="form-control" type="date" v-model="fecha_final_dieta"></td>
                        </tr>
                        <tr>
                                <td>Tipo dieta</td>
                                <td><input class="form-control" type="text" v-model="TipoDieta"></td>
                        </tr>
                    </table>
                </form>
                
                <br>
                <h4>Lunes:</h4><a href="#" @click="frmBuscarComida()" data-toggle="modal" data-target="#modelLunes">Agregar comida</a>
                <table class="table table-dark table-hover" border="1">
                    <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                                <th>Kcal</th>
                                <th>Porción</th>
                                <th>Cantidad</th>
                            </tr>
                    </thead>
                    <tbody v-if="arrayLunes.length">
                        <tr v-for="(detalle,index) in arrayLunes" :key="detalle.id">
                            <td><a href="#" @click="eliminarLunes(index)">Quitar</a></td>
                            <td v-text="detalle.comida"></td>
                            <td v-text="detalle.distribucion"></td>
                            <td v-text="detalle.kcal"></td>
                            <td>
                                <input type="number" v-model="detalle.porcion">
                            </td>
                            <td>
                                <input type="number" v-model="detalle.cantidad">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h4>Martes:</h4><a href="#" @click="frmBuscarComida()" data-toggle="modal" data-target="#modalMartes">Agregar comida</a>
                <table class="table table-dark table-hover" border="1">
                    <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                                <th>Kcal</th>
                                <th>Porción</th>
                                <th>Cantidad</th>
                            </tr>
                    </thead>
                    <tbody v-if="arrayMartes.length">
                        <tr v-for="(detalle,index) in arrayMartes" :key="detalle.id">
                            <td><a href="#" @click="eliminarMartes(index)">Quitar</a></td>
                            <td v-text="detalle.comida"></td>
                            <td v-text="detalle.distribucion"></td>
                            <td v-text="detalle.kcal"></td>
                            <td>
                                <input type="number" v-model="detalle.porcion">
                            </td>
                            <td>
                                <input type="number" v-model="detalle.cantidad">
                            </td>
                        </tr>
                    </tbody>                    
                </table>
                <br>
                <h4>Miercoles:</h4><a href="#" @click="frmBuscarComida()" data-toggle="modal" data-target="#modalMiercoles">Agregar comida</a>
                <table class="table table-dark table-hover" border="1">
                    <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                                <th>Kcal</th>
                                <th>Porción</th>
                                <th>Cantidad</th>
                            </tr>
                    </thead>
                    <tbody v-if="arrayMiercoles.length">
                        <tr v-for="(detalle,index) in arrayMiercoles" :key="detalle.id">
                            <td><a href="#" @click="eliminarMiercoles(index)">Quitar</a></td>
                            <td v-text="detalle.comida"></td>
                            <td v-text="detalle.distribucion"></td>
                            <td v-text="detalle.kcal"></td>
                            <td>
                                <input type="number" v-model="detalle.porcion">
                            </td>
                            <td>
                                <input type="number" v-model="detalle.cantidad">
                            </td>
                        </tr>
                    </tbody>                    
                </table>
                <br>
                <h4>Jueves:</h4><a href="#" @click="frmBuscarComida()" data-toggle="modal" data-target="#modalJueves">Agregar comida</a>
                <table class="table table-dark table-hover" border="1">
                    <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                                <th>Kcal</th>
                                <th>Porción</th>
                                <th>Cantidad</th>
                            </tr>
                    </thead>
                    <tbody v-if="arrayJueves.length">
                        <tr v-for="(detalle,index) in arrayJueves" :key="detalle.id">
                            <td><a href="#" @click="eliminarJueves(index)">Quitar</a></td>
                            <td v-text="detalle.comida"></td>
                            <td v-text="detalle.distribucion"></td>
                            <td v-text="detalle.kcal"></td>
                            <td>
                                <input type="number" v-model="detalle.porcion">
                            </td>
                            <td>
                                <input type="number" v-model="detalle.cantidad">
                            </td>
                        </tr>
                    </tbody>                    
                </table>
                <br>
                <h4>Viernes:</h4><a href="#" @click="frmBuscarComida()" data-toggle="modal" data-target="#modalViernes">Agregar comida</a>
                <table class="table table-dark table-hover" border="1">
                    <thead>
                            <tr>
                                <th>Opcion</th>
                                <th>Comida</th>
                                <th>Distribucion</th>
                                <th>Kcal</th>
                                <th>Porción</th>
                                <th>Cantidad</th>
                            </tr>
                    </thead>
                    <tbody v-if="arrayViernes.length">
                        <tr v-for="(detalle,index) in arrayViernes" :key="detalle.id">
                            <td><a href="#" @click="eliminarViernes(index)">Quitar</a></td>
                            <td v-text="detalle.comida"></td>
                            <td v-text="detalle.distribucion"></td>
                            <td v-text="detalle.kcal"></td>
                            <td>
                                <input type="number" v-model="detalle.porcion">
                            </td>
                            <td>
                                <input type="number" v-model="detalle.cantidad">
                            </td>
                        </tr>
                    </tbody>                    
                </table>
                <center>
                    <h3 v-text="respt"></h3>
                    <table>
                        <td colspan="3">
                            <button class="btn btn-primary" type="button" @click="nuevo()">Nuevo</button>
                            <button class="btn btn-success" type="button" @click="guardar()">Guardar</button>
                            <button class="btn btn-primary" type="button" @click="modificar()">Modificar</button>
                            <button class="btn btn-danger" type="button" @click="eliminar()">Eliminar</button>
                            <button class="btn btn-success" type="button" @click="buscarDieta()">Buscar</button>
                        </td>
                    </table>
                </center>
            </template>
            
        </div>
    <!-- Inicio Modal frmBuscarFicha -->
        <div class="modal fade" id="modalFicha" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Busqueda de Ficha Medica por cliente</h4>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarC" placeholder="Nombre">
                                    <button class="btn btn-primary" type="button" @click="buscarFicha(buscarC)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-dark table-hover" border="1">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Fecha Consulta</th>
                                    <th>Peso Actual</th>
                                    <th>Altura Actual</th>
                                    <th>IMC</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ficha in arrayFicha" :key="ficha.id">
                                    <td v-text="ficha.id"></td>
                                    <td v-text="ficha.nom_cliente"></td>
                                    <td v-text="ficha.fecha_consulta"></td>
                                    <td v-text="ficha.pesoActual"></td>
                                    <td v-text="ficha.alturaActual"></td>
                                    <td v-text="ficha.imc"></td>
                                    <td><a href="#" data-dismiss="modal" @click="seleccionarFicha(ficha)">Seleccionar</a></td>
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
        <!-- Fin Modal frmBuscarFicha --> 
        <!-- Inicio Modal frmBuscarComidaLunes -->
        <div class="modal fade" id="modelLunes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Lunes: Seleccione una o varias comidas</h4>
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarComid" placeholder="Distribucion">
                                    <button class="btn btn-primary" type="button" @click="buscarComida(buscarComid)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table class="table table-dark table-hover"  border="1">
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
                                    <td><a href="#" @click="seleccionarLunes(comida)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarComidaLunes -->
        <!-- Inicio Modal frmBuscarComidaMartes -->
        <div class="modal fade" id="modalMartes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Martes: Seleccione una o varias comidas</h4>
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarComid" placeholder="Distribucion">
                                    <button class="btn btn-primary" type="button" @click="buscarComida(buscarComid)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table class="table table-dark table-hover"  border="1">
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
                                    <td><a href="#" @click="seleccionarMartes(comida)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarComidaMartes -->
        <!-- Inicio Modal frmBuscarComidaMiercoles -->
        <div class="modal fade" id="modalMiercoles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Miercoles: Seleccione una o varias comidas</h4>
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarComid" placeholder="Distribucion">
                                    <button class="btn btn-primary" type="button" @click="buscarComida(buscarComid)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table class="table table-dark table-hover"  border="1">
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
                                    <td><a href="#" @click="seleccionarMiercoles(comida)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarComidaMiercoles -->
        <!-- Inicio Modal frmBuscarComidaJueves -->
        <div class="modal fade" id="modalJueves" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Jueves: Seleccione una o varias comidas</h4>
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarComid" placeholder="Distribucion">
                                    <button class="btn btn-primary" type="button" @click="buscarComida(buscarComid)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table class="table table-dark table-hover"  border="1">
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
                                    <td><a href="#" @click="seleccionarJueves(comida)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarComidaJueves -->
        <!-- Inicio Modal frmBuscarComidaViernes -->
        <div class="modal fade" id="modalViernes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Viernes: Seleccione una o varias comidas</h4>
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <input type="text" v-model="buscarComid" placeholder="Distribucion">
                                    <button class="btn btn-primary" type="button" @click="buscarComida(buscarComid)">Buscar</button>
                                </div>
                            </div>
                        </div>
                        <label for="" v-text="errorMsj"></label>
                        <table class="table table-dark table-hover"  border="1">
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
                                    <td><a href="#" @click="seleccionarViernes(comida)">Seleccionar</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger"  type="button" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal frmBuscarComidaViernes -->
    </main>
</template>
<script>
export default {
    data(){
        return{
            listado : 0,
            TipoDieta:'',
            fecha_inicio_dieta : '',
            fecha_final_dieta:'',
            arrayCliente: [],
            buscarC : '',
            cliente : '',
            arrayComida : [],
            buscarComid : '',
            errorMsj : '',
            id_comida:'',
            distribucion:'',
            respt : '',
            arrayLunes:[],
            arrayMartes:[],
            arrayMiercoles:[],
            arrayJueves:[],
            arrayViernes:[],
            total : 0.0,
            buscar : '',
            arrayDieta : [],
            id_comida:'',
            comida:'',
            id_gest_dieta : 0,
            arrayFicha:[],
            id_ficha:0,
            
        }
    },
    // volar esta mierda
    computed:{
    },
    methods:{
        frmBuscarFicha(){
            this.arrayFicha = [];
            this.buscarC ='';
        },
        frmBuscarComida(){
            this.arrayComida = [];
            this.buscarComid ='';
            this.errorMsj = '';
        },
        buscarFicha(buscarC){
            let me = this;
            var url='/fichamedica?buscar=' + buscarC;
            axios.get(url).then(function(response){
                me.arrayFicha= response.data;
            })
            .catch(function(error){
                console.log(error);
            });
        },
        seleccionarFicha(data=[]){
            this.id_ficha = data['id'];
            this.cliente=data['nom_cliente']+' '+ data['apellido'];
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
        encuentraLunes(id){
            var sw=0;
            for(var i=0;i<this.arrayLunes.length;i++){
                if(this.arrayLunes[i].id_comida==id){
                    sw=true;
                }
            }
            return sw;
        },
        encuentraMartes(id){
            var sw=0;
            for(var i=0;i<this.arrayMartes.length;i++){
                if(this.arrayMartes[i].id_comida==id){
                    sw=true;
                }
            }
            return sw;
        },
        encuentraMiercoles(id){
            var sw=0;
            for(var i=0;i<this.arrayMiercoles.length;i++){
                if(this.arrayMiercoles[i].id_comida==id){
                    sw=true;
                }
            }
            return sw;
        },
        encuentraJueves(id){
            var sw=0;
            for(var i=0;i<this.arrayJueves.length;i++){
                if(this.arrayJueves[i].id_comida==id){
                    sw=true;
                }
            }
            return sw;
        },
        encuentraViernes(id){
            var sw=0;
            for(var i=0;i<this.arrayViernes.length;i++){
                if(this.arrayViernes[i].id_comida==id){
                    sw=true;
                }
            }
            return sw;
        },

        seleccionarLunes(data=[]){
            let me = this;
            if(me.encuentraLunes(data['id'])){
                this.errorMsj='Ya se encuentra agregado...'
            }else{
                me.arrayLunes.push({
                    id_comida: data['id'],
                    comida : data['descripcion'],
                    kcal:data['kcal'],
                    porcion:1,
                    cantidad:1,
                    distribucion : data['nom_comida']
                });
            this.errorMsj='Agregado...'
            }        
        },      
         seleccionarMartes(data=[]){
            let me = this;
            if(me.encuentraMartes(data['id'])){
                this.errorMsj='Ya se encuentra agregado...'
            }else{
                me.arrayMartes.push({
                    id_comida: data['id'],
                    comida : data['descripcion'],
                    kcal:data['kcal'],
                    porcion:1,
                    cantidad:1,
                    distribucion : data['nom_comida']
                });
            this.errorMsj='Agregado...'
            }        
        },
        seleccionarMiercoles(data=[]){
            let me = this;
            if(me.encuentraMiercoles(data['id'])){
                this.errorMsj='Ya se encuentra agregado...'
            }else{
                   me.arrayMiercoles.push({
                    id_comida: data['id'],
                    comida : data['descripcion'],
                    kcal:data['kcal'],
                    porcion:1,
                    cantidad:1,
                    distribucion : data['nom_comida']
                });
            this.errorMsj='Agregado...'
            }
             
        },
        seleccionarJueves(data=[]){
            let me = this;
            if(me.encuentraJueves(data['id'])){
                this.errorMsj='Ya se encuentra agregado...'
            }else{
                me.arrayJueves.push({
                    id_comida: data['id'],
                    comida : data['descripcion'],
                    kcal:data['kcal'],
                    porcion:1,
                    cantidad:1,
                    distribucion : data['nom_comida']
                });
            this.errorMsj='Agregado...'
            }               
        },
        seleccionarViernes(data=[]){
            let me = this;
            if(me.encuentraViernes(data['id'])){
                this.errorMsj='Ya se encuentra agregado...'
            }else{
                me.arrayViernes.push({
                    id_comida: data['id'],
                    comida : data['descripcion'],
                    kcal:data['kcal'],
                    porcion:1,
                    cantidad:1,
                    distribucion : data['nom_comida']
                });
            this.errorMsj='Agregado...'
            }          
        },
        eliminarLunes(index){
            let me = this;
            me.arrayLunes.splice(index,1);
        },
        eliminarMartes(index){
            let me = this;
            me.arrayMartes.splice(index,1);
        },
        eliminarMiercoles(index){
            let me = this;
            me.arrayMiercoles.splice(index,1);
        },
        eliminarJueves(index){
            let me = this;
            me.arrayJueves.splice(index,1);
        },
        eliminarViernes(index){
            let me = this;
            me.arrayViernes.splice(index,1);
        },
        nuevo(){
            this.id_ficha='';
            this.id_gest_dieta='';
            this.fecha_inicio_dieta = '';
            this.fecha_final_dieta='';
            this.TipoDieta = '';
            this.cliente = '';
            this.id_comida='';
            this.descripcion='';
            this.arrayLunes=[];
            this.arrayMartes=[];
            this.arrayMiercoles=[];
            this.arrayJueves=[];
            this.arrayViernes=[];
            this.arrayDietaComida = [];
            this.errorMsj = '';
            this.respt='';
        },
        guardar(){
            let me = this;
            axios.post('/gestdieta/registrar',{
                idFichaMedica: this.id_ficha,
                fechaInicio : this.fecha_inicio_dieta,
                fechaFinal: this.fecha_final_dieta,
                tipo:this.TipoDieta,
                dataLunes: this.arrayLunes,
                dataMartes: this.arrayMartes,
                dataMiercoles: this.arrayMiercoles,
                dataJueves: this.arrayJueves,
                dataViernes: this.arrayViernes,
                
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
        buscarNombre(buscar){
            let me = this;
            var url='/gestdieta/buscarnombre?buscar=' + buscar;
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
        seleccionarDieta(data=[]){
            let me = this;
            console.log(data);
            me.listado=0;
            this.respt='';
            this.id_ficha=data['idFichaMedica'];
            this.id_gest_dieta=data['id'];
            this.fecha_inicio_dieta = data['fechaInicio'];
            this.fecha_final_dieta=data['fechaFinal'];
            this.TipoDieta = data['tipo'];
            this.cliente = data['nom_cliente']+' '+data['apellido'];
            let arrayDietaT=[];
            var url='/gestdieta/obtnerdia?id=' +this.id_gest_dieta+'&dia=lunes';
            axios.get(url).then(function(response){
                me.arrayLunes=response.data;
                
            })
            .catch(function(error){
                console.log(error);
            })
            url='/gestdieta/obtnerdia?id=' +this.id_gest_dieta+'&dia=martes';
            axios.get(url).then(function(response){
                me.arrayMartes=response.data;
                
            })
            .catch(function(error){
                console.log(error);
            })
            url='/gestdieta/obtnerdia?id=' +this.id_gest_dieta+'&dia=miercoles';
            axios.get(url).then(function(response){
                me.arrayMiercoles=response.data;
                
            })
            .catch(function(error){
                console.log(error);
            })
            url='/gestdieta/obtnerdia?id=' +this.id_gest_dieta+'&dia=jueves';
            axios.get(url).then(function(response){
                me.arrayJueves=response.data;
                
            })
            .catch(function(error){
                console.log(error);
            })
            url='/gestdieta/obtnerdia?id=' +this.id_gest_dieta+'&dia=viernes';
            axios.get(url).then(function(response){
                me.arrayViernes=response.data;
                
            })
            .catch(function(error){
                console.log(error);
            })

        },
        modificarDetalle(id){
            let me = this;
            me.listado=0;
            this.respt='';
            let arrayDietaT=[];
            var url='/gestdieta/obtnercabecera?id=' + id;
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
            axios.put('/detalle/eliminar',{
                id: this.id_gest_dieta
            }).then(function(error){
                //
            }).catch(function(error){
                console.log(error);
            }); 

            axios.put('/dieta/modificar',{
                id: this.id_gest_dieta,
                idFichaMedica: this.id_ficha,
                fechaInicio : this.fecha_inicio_dieta,
                fechaFinal: this.fecha_final_dieta,
                tipo:this.TipoDieta,
                dataLunes: this.arrayLunes,
                dataMartes: this.arrayMartes,
                dataMiercoles: this.arrayMiercoles,
                dataJueves: this.arrayJueves,
                dataViernes: this.arrayViernes,
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