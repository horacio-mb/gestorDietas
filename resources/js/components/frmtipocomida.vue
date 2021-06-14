<template>
    <div class="container">
        <h3>Registro de tipos de comida</h3>
        <form action="" method="POST">
            <table>
                <tr>
                   <td>Nombre</td>
                   <td><input class="form-control" type="text" v-model="nombre" placeholder="Nombre Tipo Comida"></td>
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
            <br><br>
            <table>
                <tr>
                    <td>
                        <input class="form-control" type="text" v-model="buscar" placeholder="Tipo de Comida">
                    </td>
                    <td>
                        <button class="btn btn-success" type="button" @click="listar(buscar)"> Buscar por nombre </button>
                    </td>
                </tr>
            </table>
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
                <tr v-for="tipo_comida in arrayTipoComida" :key="tipo_comida.id">
                    <td v-text="tipo_comida.id"></td>
                    <td v-text="tipo_comida.nombre"></td>
                    <td><a href="#" @click="llenar(tipo_comida)">Seleccionar</a></td>

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
                id_tipo_comida:0,
                buscar : '',
                arrayTipoComida:[]
            }
        },
        methods: {
            listar(buscar){
                let me =this;
                var url='/tipo_comida?buscar=' +buscar;
                axios.get(url).then(function(response){
                    me.arrayTipoComida= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me= this;
                axios.post('/tipo_comida/registrar',{
                    'nombre': this.nombre
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });
            },
            modificar(){
                let me = this;
                axios.put('/tipo_comida/modificar',{
                    'nombre': this.nombre,
                    'id':this.id_tipo_comida
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.put('/tipo_comida/eliminar',{
                    'id': this.id_tipo_comida
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
             llenar(data=[]){
                this.id_tipo_comida=data['id'];
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