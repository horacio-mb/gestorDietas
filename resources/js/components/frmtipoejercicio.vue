<template>
    <div class="container">
        <h3>Registro de Tipo de Ejercicio</h3>
        <form action="" method="POST">
            <table>
                <tr>
                   <td>Nombre</td>
                   <td><input type="text" v-model="nombre" placeholder="Nombre Tipo Ejercicio"></td>
                </tr>
                <tr>
                <td colspan="3">
                    <button  class="btn btn-primary" type="button" @click="nuevo()">Nuevo</button>
                    <button class="btn btn-success" type="button" @click="guardar()">Guardar</button>
                    <button class="btn btn-primary" type="button" @click="modificar()">Modificar</button>
                    <button class="btn btn-danger" type="button" @click="eliminar()">Eliminar</button>
                </td>
                </tr>  
            </table>
            <input type="text" v-model="buscar" placeholder="Tipo de Ejercicio">
            <button class="btn btn-primary" type="button" @click="listar(buscar)"> Buscar por nombre </button>
            <br>
            <br>
        </form>
          <table class="table table-dark table-hover" border="2">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="tipo_ejercicio in arrayTipoEjercicio" :key="tipo_ejercicio.id">
                    <td v-text="tipo_ejercicio.id"></td>
                    <td v-text="tipo_ejercicio.nombre"></td>
                    <td><a href="#" @click="llenar(tipo_ejercicio)">Seleccionar</a></td>

                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data () {
            return{
                nombre:'',
                id_tipo_ejercicio:0,
                buscar : '',
                arrayTipoEjercicio:[]
            }
        },
        methods: {
            listar(buscar){
                let me =this;
                var url='/tipo_ejercicio?buscar=' +buscar;
                axios.get(url).then(function(response){
                    me.arrayTipoEjercicio= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me= this;
                axios.post('/tipo_ejercicio/registrar',{
                    'nombre': this.nombre
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });
            },
            modificar(){
                let me = this;
                axios.put('/tipo_ejercicio/modificar',{
                    'nombre': this.nombre,
                    'id':this.id_tipo_ejercicio
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.put('/tipo_ejercicio/eliminar',{
                    'id': this.id_tipo_ejercicio
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
             llenar(data=[]){
                this.id_tipo_ejercicio=data['id'];
                this.nombre=data['nombre'];
            },
             nuevo(){
                this.nombre ='';
            },
        },
        mounted() {
            this.listar(this.buscar);
        }
    }
</script>