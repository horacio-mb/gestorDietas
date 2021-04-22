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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
                <b>Sistema de Gestión de Dietas</b>
            </template>

            <template v-if="menu==1">
                
                <frmtipocomida></frmtipocomida>
                
            </template>
            <template v-if="menu==2">
                <br><br>
                
            </template>
            <template v-if="menu==3">
                <br><br>
                
            </template>
            <template v-if="menu==4">
                <frmdieta></frmdieta>
            </template>
            <!-- Fin Menu Principal --> 
        </div>
    </div>
    <script src="js/app.js"></script>
    
</body>
</html>