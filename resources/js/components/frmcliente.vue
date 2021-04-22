<template>
    <div class="container">
        <h3>Registro de Cliente</h3>
        <form action="" method="POST">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td><input type="text" v-model="nombre" placeholder="Nombre Cliente"></td>
                </tr>
                 <tr>
                    <td>Apellidos</td>
                    <td><input type="text" v-model="apellidos" placeholder="Apellidos Cliente"></td>
                </tr>
                 <tr>
                    <td>Correo</td>
                    <td><input type="text" v-model="correo" placeholder="Correo Cliente"></td>
                </tr>
                 <tr>
                    <td>Telefono</td>
                    <td><input type="text" v-model="telefono" placeholder="Telefono Cliente"></td>
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
            <input type="text" v-model="buscar" placeholder="Nombre Cliente">
            <button class="btn btn-primary" type="button" @click="listar(buscar)">Buscar por Nombre</button>
        </form>
        <br>
        <br>
        <table class="table table-dark table-hover" border="2">
        <thead>
        <th>Id</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>Opciones</th>
        </thead>
        <tbody>
            <tr v-for="cliente in arrayCliente" :key="cliente.id">
                <td v-text="cliente.id"></td>
                <td v-text="cliente.nombre"></td>
                <td v-text="cliente.apellidos"></td>
                <td v-text="cliente.correo"></td>
                <td v-text="cliente.telefono"></td>
                 <td><a href="#" @click="llenar(cliente)">Seleccionar</a></td>
            </tr>
        </tbody>
    </table>
    </div>
</template>

<script>
export default{
 data(){
    return {
        id_cliente : 0,
        nombre : '',
        apellidos : '',
        correo : '',
        telefono : '',
        buscar:'',
        arrayCliente : []
    }
  },
  methods:{
      listar(buscar){
            let me = this;
            var url= '/cliente?buscar=' +buscar;
            axios.get(url).then(function(response){
                me.arrayCliente = response.data;  
            })
            .catch(function(error){
                console.log(error);
            })
       },
       guardar(){
            let me= this;
            axios.post('/cliente/registrar',{
                'nombre': this.nombre,
                'apellidos': this.apellidos,
                'correo': this.correo,
                'telefono': this.telefono
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });
       },
       modificar(){
            let me= this;
            axios.put('/cliente/modificar',{
                'nombre': this.nombre,
                'apellidos': this.apellidos,
                'correo': this.correo,
                'telefono': this.telefono,
                'id': this.id_cliente
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            }); 
       },
       eliminar(){
            let me= this;
            axios.put('/cliente/eliminar',{
                'id': this.id_cliente
            }).then(function(error){
                me.listar('');
            }).catch(function(error){
                console.log(error);
            });  
       },
       llenar(data=[]){
            this.id_cliente=data['id'];
            this.nombre=data['nombre'];
            this.apellidos=data['apellidos'];
            this.correo=data['correo'];
            this.telefono=data['telefono'];

       },
        nuevo(){
                this.nombre = '';
                this.apellidos = '';
                this.correo = '';
                this.telefono = '';
                this.buscar = '';
      },
   },
   mounted(){
       this.listar(this.buscar);
   }
}
</script>