<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestor de Dietas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="css/app.css" rel="stylesheet">

</head>
<body>
    <div id="app">
        <div class="app-body">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">               
                <div>
                    <ul class="navbar-nav mr-auto">
                        <li @click="menu=0">
                            <a class="navbar-brand" href="#">Inicio</a>
                        </li>
                        <li @click="menu=1">
                            <a class="nav-link" href="#">Tipo de Comida</a>
                        </li>
                        <li @click="menu=2">
                            <a class="nav-link" href="#">Comida</a>
                        </li>
                        <li @click="menu=3">
                            <a class="nav-link" href="#">Tipo de Ejercicio</a>
                            </li>
                            
                            <li @click="menu=4">
                            <a class="nav-link" href="#">Ejercicio</a>
                            </li>
                        <li @click="menu=5">
                            <a class="nav-link" href="#">Clientes</a>
                        </li>
                        <li @click="menu=6">
                            <a class="nav-link" href="#">Consulta</a>
                        </li>
                        <li @click="menu=7">
                            <a class="nav-link" href="#">Ficha Médica</a>
                        </li>
                        <li @click="menu=8">
                            <a class="nav-link" href="#">Gestionar Dieta</a>
                        </li>
                        <li @click="menu=9">
                            <a class="nav-link" href="#">Gestionar Rutina</a>
                        </li>
                        <li @click="menu=10">
                            <a class="nav-link" href="#">Dietas</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Menu Principal -->
            <template v-if="menu==0">
                <center>
                    <h1 class="t-stroke-shadow"><HR> <br> <br> SISTEMA <br> DE GESTIÓN <BR> DE DIETAS <br>
                    <br>
                <br>
            <img src="https://www.upsa.edu.bo/images/logo-upsa.jpg"> </center> 
            </template>

            <template v-if="menu==1">
                <br><br>
                <frmtipocomida></frmtipocomida>
                
            </template>
            <template v-if="menu==2">
                <br><br>
                <frmcomida></frmcomida>
            </template>           
            <template v-if="menu==3">
                <br><br>
                <frmtipoejercicio></frmtipoejercicio>
            </template>
            <template v-if="menu==4">
                <br><br>
                <frmejercicio></frmejercicio>
            </template>
            <template v-if="menu==5">
                <br><br>
                <frmcliente></frmcliente>
            </template>
            <template v-if="menu==6">
                <br><br>
                <frmconsulta></frmconsulta>
            </template>
            <template v-if="menu==7">
                <br><br>
                <frmfichamedica></frmfichamedica>
            </template>
            <template v-if="menu==8">
                <br><br>
                <frmgestdieta></frmgestdieta>
            </template>
            <template v-if="menu==9">
                <br><br>
                <frmgestrutina></frmgestrutina>
            </template>
            <template v-if="menu==10">
                <br><br>
                <frmdieta></frmdieta>
            </template>
            <!-- Fin Menu Principal --> 
        </div>
    </div>
    <script src="js/app.js"></script>
    
</body>
</html>