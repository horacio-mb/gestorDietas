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
                <a @click="menu=0" class="navbar-brand" href="#">Inicio</a>
                <div>
                    <ul class="navbar-nav mr-auto">
                        <li @click="menu=1">
                            <a class="nav-link" href="#">Tipo de Comida</a>
                        </li>
                        <li @click="menu=2">
                            <a class="nav-link" href="#">Comida</a>
                        </li>
                        <li @click="menu=3">
                            <a class="nav-link" href="#">Clientes</a>
                        </li>
                        <li @click="menu=4">
                            <a class="nav-link" href="#">Dietas</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- Menu Principal -->
            <template v-if="menu==0">
                <b><div class="bg-2"> <center>
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
                <frmcliente></frmcliente>
            </template>
            <template v-if="menu==4">
                <br><br>
                <frmdieta></frmdieta>
            </template>
            <!-- Fin Menu Principal --> 
        </div>
    </div>
    <script src="js/app.js"></script>
    
</body>
</html>