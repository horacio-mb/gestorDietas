<template>
    <div class="container">
        <h3>Registro de Ejercicios</h3>
        <form action="" method="POST">
            <table>

                <tr>
                    <td>Nombre</td>
                    <td><input type="text" v-model="nombre" placeholder="Nombre"></td>

                </tr>
                <tr>
                    <td>Descripcion</td>
                    <td><input type="text" v-model="descripcion" placeholder="Descripcion"></td>

                </tr>

                <tr>
                    <td>Id Tipo Ejercicio</td>
                    <td>
                        <select v-model="id_tipo_ejercicio">
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="tipo_ejercicio in arrayTipoEjercicio" :key="tipo_ejercicio.id" :value="tipo_ejercicio.id"
                            v-text="tipo_ejercicio.nombre"></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button class="btn btn-primary" type="button" @click="nuevo()">Nuevo</button>
                        <button class="btn btn-success" type="button" @click="guardar()">Guardar</button>
                        <button class="btn btn-primary" type="button" @click="modificar()">Modificar</button>
                        <button  class="btn btn-danger" type="button" @click="eliminar()">Eliminar</button>
                    </td>
                </tr>
            </table>
            <input type="text" v-model="buscar" placeholder="Nombre Ejercicio">
            <button class="btn btn-primary" type="button" @click="listar(buscar)">Buscar por Nombre</button>
        </form>
        <br>
        <br>
        <table class="table table-dark table-hover" border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Tipo de Ejercicio</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="ejercicio in arrayEjercicio" :key="ejercicio.id">
                    <td v-text="ejercicio.id"></td>
                    <td v-text="ejercicio.nombre"></td>
                    <td v-text="ejercicio.descripcion"></td>
                     <td v-text="ejercicio.nom_tipo_ejercicio"></td>
                    <td><a href="#" @click="llenar(ejercicio)">Seleccionar</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script> 
    export default{
        data(){
            return{
                nombre :'',
                descripcion :'',
                id_tipo_ejercicio : 0,
                id_ejercicio : 0,
                nom_tipo_ejercicio :'',
                buscar :'',
                arrayEjercicio:[],
                arrayTipoEjercicio:[]

            }
        },
        methods:{
            listar(buscar){
                let me = this;
                 var url='/ejercicio?buscar=' + buscar;
                axios.get(url).then(function(response){
                    me.arrayEjercicio= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectTipoEjercicio(){
                let me = this;
                axios.get('/tipo_ejercicio/selectTipoEjercicio').then(function(response){
                    me.arrayTipoEjercicio= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('/ejercicio/registrar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id_tipo_ejercicio' : this.id_tipo_ejercicio
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('/ejercicio/modificar',{
                    'nombre': this.nombre,
                    'descripcion': this.descripcion,
                    'id_tipo_ejercicio' : this.id_tipo_ejercicio,
                    'id': this.id_ejercicio
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.put('/ejercicio/eliminar',{
                    'id': this.id_ejercicio
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            llenar(data=[]){
                this.id_ejercicio=data['id'];
                this.nombre=data['nombre'];
                this.descripcion=data['descripcion'];
                this.id_tipo_ejercicio=data['id_tipo_ejercicio'];
            },
            nuevo(){
                this.nombre = '';
                this.descripcion = '';
                this.id_tipo_ejercicio=0;
            },

        },
        mounted(){
            this.listar(this.buscar);
            this.selectTipoEjercicio();
        }
    }
</script>