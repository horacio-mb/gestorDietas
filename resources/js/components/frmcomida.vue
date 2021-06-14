<template>
    <div class="container">
        <h3>Registro de Comidas</h3>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Descripcion</td>
                    <td><input type="text" v-model="descripcion" placeholder="Descripcion"></td>

                </tr>

                <tr>
                    <td>Calorias</td>
                    <td><input type="text" v-model="kcal" placeholder="kcal"></td>

                </tr>
                <tr>
                    <td>Id Tipo Comida</td>
                    <td>
                        <select v-model="id_tipo_comida">
                            <option value="0" disabled>Seleccione</option>
                            <option v-for="tipo_comida in arrayTipoComida" :key="tipo_comida.id" :value="tipo_comida.id"
                            v-text="tipo_comida.nombre"></option>
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
            <input type="text" v-model="buscar" placeholder="Descripcion comida">
            <button class="btn btn-primary" type="button" @click="listar(buscar)">Buscar por Descripcion</button>
        </form>
        <br>
        <br>
        <table class="table table-dark table-hover" border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Descripcion</th>
                    <th>Calorias</th>
                    <th>Tipo de Comida</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="comida in arrayComida" :key="comida.id">
                    <td v-text="comida.id"></td>
                    <td v-text="comida.descripcion"></td>
                    <td v-text="comida.kcal"></td>
                    <td v-text="comida.nom_comida"></td>
                    <td><a href="#" @click="llenar(comida)">Seleccionar</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script> 
    export default{
        data(){
            return{
                descripcion :'',
                kcal : 0,
                id_tipo_comida : 0,
                id_comida : 0,
                nomb_tipo_comida :'',
                buscar :'',
                arrayComida:[],
                arrayTipoComida:[]

            }
        },
        methods:{
            listar(buscar){
                let me = this;
                 var url='/comida?buscar=' + buscar;
                axios.get(url).then(function(response){
                    me.arrayComida= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            selectTipoComida(){
                let me = this;
                axios.get('/tipo_comida/selectTipoComida').then(function(response){
                    me.arrayTipoComida= response.data;
                })
                .catch(function(error){
                    console.log(error);
                });
            },
            guardar(){
                let me = this;
                axios.post('/comida/registrar',{
                    'descripcion': this.descripcion,
                    'kcal':this.kcal,
                    'id_tipo_comida' : this.id_tipo_comida
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });               
            },
            modificar(){
                let me = this;
                axios.put('/comida/modificar',{
                    'descripcion': this.descripcion,
                    'kcal':this.kcal,
                    'id_tipo_comida' : this.id_tipo_comida,
                    'id': this.id_comida
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            eliminar(){
                let me = this;
                axios.put('/comida/eliminar',{
                    'id': this.id_comida
                }).then(function(error){
                    me.listar('');
                }).catch(function(error){
                    console.log(error);
                });  
            },
            llenar(data=[]){
                this.id_comida=data['id'];
                this.descripcion=data['descripcion'];
                this.kcal=data['kcal'];
                this.id_tipo_comida=data['id_tipo_comida'];
            },
            nuevo(){
                this.descripcion = '';
                this.kcal = 0;
                this.id_tipo_comida=0;
            },

        },
        mounted(){
            this.listar(this.buscar);
            this.selectTipoComida();
        }
    }
</script>