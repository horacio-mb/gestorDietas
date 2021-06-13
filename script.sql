create table cuestionario(
idCuestionario int AUTO_INCREMENT primary key,
enfermedadBase varchar(30),
anteFamiliares varchar(50),
consumoAlcohol int,
consumoTabaco int,
consumoCafe int,
consumoMedicamentos varchar(50),
comidasDia int,
actividadFisica int,
id_fichaMedicaint not null,
foreign key(id_fichaMedica) references ficha_medica(idFichaMedica)
);

create table dia_rutina(
idDiaRutina int AUTO_INCREMENT primary key,
diaSemana varchar(30),
idGestRutina int not null,
foreign key(idGestRutina) references gest_rutina(idGestRutina)
);

create table dia_Dieta(
idDiaDieta int AUTO_INCREMENT primary key,
diaSemana varchar(30),
idGestDieta int not null,
foreign key(idGestDieta) references gest_dieta(idGestDieta)
);

create table comida(
idComida int auto_increment primary key,
descripcion varchar(150),
kcal float,
idTipoComida int not null,
foreign key(idTipoComida) references tipo_comida(idTipoComida)
);

create table dieta_comida(
idDiaDieta int not null,
idComida int not null,
porcion int,
cantidad int,
primary key(idDiaDieta,idComida),
foreign key(idDiaDieta) references dia_Dieta(idDiaDieta),
foreign key(idComida) references comida(idComida)
);

create table rutina_ejercicio(
idDiaRutina int not null,
idEjercicio int not null,
repeticiones int,
ronda int, 
primary key(idDiaRutina,idEjercicio),
foreign key(idDiaRutina) references dia_rutina(idDiaRutina),
foreign key(idEjercicio) references ejercicio(idEjercicio)
);
