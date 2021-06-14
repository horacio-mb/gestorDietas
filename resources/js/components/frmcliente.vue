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
                    <td>Apellido Paterno</td>
                    <td><input type="text" v-model="apellido_paterno" placeholder="Apellidos Paterno"></td>
                </tr>
                 <tr>
                    <td>Apellido Materno</td>
                    <td><input type="text" v-model="apellido_materno" placeholder="Apellidos Materno"></td>
                </tr>
                <tr>
                    <td>Fecha de Nacimiento</td>
                    <td><input type="date" v-model="fecha_nacimiento" placeholder="Fecha Nacimiento"></td>
                </tr>
                 <tr>
                    <td>Correo</td>
                    <td><input type="email" v-model="correo" placeholder="Correo Cliente"></td>
                </tr>
                 <tr>
                    <td>Telefono</td>
                    <td><input type="text" v-model="telefono" placeholder="Telefono Cliente"></td>
                </tr>
                 <tr>
                    <td>Sexo</td>
                    
                    <td><input type="radio"  v-model="sexo" value="m"><label>Masculino</label><br>
                    <input type="radio"  v-model="sexo" value="f"><label>Femenino</label></td>
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
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Fecha Nacimiento</th>
        <th>Correo</th>
        <th>Telefono</th>
        <th>Sexo</th>
        <th>Opciones</th>
        </thead>
        <tbody>
            <tr v-for="cliente in arrayCliente" :key="cliente.id">
                <td v-text="cliente.id"></td>
                <td v-text="cliente.nombre"></td>
                <td v-text="cliente.apellido_paterno"></td>
                <td v-text="cliente.apellido_materno"></td>
                <td v-text="cliente.fecha_nacimiento"></td>
                <td v-text="cliente.correo"></td>
                <td v-text="cliente.telefono"></td>
                <td v-text="cliente.sexo"></td>
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
        apellido_paterno : '',
        apellido_materno : '',
        fecha_nacimiento : '',
        correo : '',
        telefono : '',
        sexo : '',
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
                'apellido_paterno': this.apellido_paterno,
                'apellido_materno': this.apellido_materno,
                'fecha_nacimiento': this.fecha_nacimiento,
                'correo': this.correo,
                'telefono': this.telefono,
                'sexo': this.sexo
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
                'apellido_paterno': this.apellido_paterno,
                'apellido_materno': this.apellido_materno,
                'fecha_nacimiento': this.fecha_nacimiento,
                'correo': this.correo,
                'telefono': this.telefono,
                'sexo': this.sexo,
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
            this.apellido_paterno=data['apellido_paterno'];
            this.apellido_materno=data['apellido_materno'];
            this.fecha_nacimiento=data['fecha_nacimiento'];
            this.correo=data['correo'];
            this.telefono=data['telefono'];
            this.sexo=data['sexo'];

       },
        nuevo(){
                this.id_cliente =0;
                this.nombre = '';
                this.apellido_paterno = '';
                this.apellido_materno = '';
                this.fecha_nacimiento = '';
                this.correo = '';
                this.telefono = '';
                this.sexo = '';
                this.buscar = '';
      },
   },
   mounted(){
       this.listar(this.buscar);
   }
}
</script>