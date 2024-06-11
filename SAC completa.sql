/*DROP DATABASE SAC;*/
CREATE DATABASE SAC;

USE SAC;

CREATE TABLE usuario(
	cedula VARCHAR(20) NOT NULL,
		CONSTRAINT usuario_cedula_pk PRIMARY KEY (cedula),
		CONSTRAINT usuario_cedula_unique UNIQUE (cedula),
		CONSTRAINT usuario_cedula_ck CHECK 
        (cedula RLIKE ('^[0][0-9][-][0-9][0-9][0-9][-][0-9][0-9][0-9][0-9]$')
		 OR cedula RLIKE ('^[1][0-3][-][0-9][0-9][0-9][-][0-9][0-9][0-9][0-9]$')
		 OR cedula RLIKE ('^[E][-][8][-][0-9][0-9][0-9][0-9][-][0-9][0-9]$')
		 OR cedula RLIKE ('^[0-9][-][0-9][0-9][0-9][-][0-9][0-9][0-9][0-9]$')
		 OR cedula RLIKE ('^[0][0-9][-][0-9][0-9][0-9][-][0-9][0-9][0-9]$')
		 OR cedula RLIKE ('^[1][0-3][-][0-9][0-9][0-9][-][0-9][0-9][0-9]$')
		 OR cedula RLIKE ('^[0-9][-][0-9][0-9][0-9][-][0-9][0-9][0-9]$')
		 OR cedula RLIKE ('^[2][0][-][0-9][0-9][-][0-9][0-9][0-9][0-9]$')),
         
    correoUsuario VARCHAR(100) NOT NULL,
		CONSTRAINT usuario_correo_unique UNIQUE (correoUsuario),
        CONSTRAINT usuario_correo_ck CHECK (correoUsuario RLIKE ('.@.')),
    contrasena VARCHAR(100) NOT NULL,
		CONSTRAINT usuario_contrasena_ck CHECK (contrasena RLIKE ('.[A-Z].') and contrasena RLIKE ('.[0-9].')),
    nombre VARCHAR(50) NOT NULL,
	apellido VARCHAR(50) NOT NULL,
	sexo CHAR(1) NOT NULL,
		CONSTRAINT usuario_sexo_ck CHECK 
        (sexo RLIKE ('M') OR sexo RLIKE ('F')),
	fechaNacimiento DATE NOT NULL,
    celular VARCHAR(9),
		CONSTRAINT usuario_celular_ck CHECK 
        (celular RLIKE ('^[0-9][0-9][0-9][0-9][-][0-9][0-9][0-9][0-9]$')),
	provincia VARCHAR(50),
    ciudad VARCHAR(50),
    direccion VARCHAR(50),
    
    tipoUsuario INT NOT NULL,
		CONSTRAINT usuario_tipoUsuario_ck CHECK
        (tipoUsuario RLIKE (0) OR tipoUsuario RLIKE (1))
);


CREATE TABLE doctor(
	idDoctor INT AUTO_INCREMENT,
		CONSTRAINT doctor_idDoctor_pk PRIMARY KEY (idDoctor),
    cedula VARCHAR(20) NOT NULL,
		CONSTRAINT doctor_cedula_unique UNIQUE (cedula),
		CONSTRAINT doctor_cedula_fk FOREIGN KEY (cedula)
		REFERENCES usuario (cedula) ON DELETE CASCADE
);


CREATE TABLE paciente(
	idPaciente INT AUTO_INCREMENT,
		CONSTRAINT paciente_idPaciente_pk PRIMARY KEY (idPaciente),
	cedula VARCHAR(20) NOT NULL,
		CONSTRAINT paciente_cedula_unique UNIQUE (cedula),
		CONSTRAINT paciente_cedula_fk FOREIGN KEY (cedula)
		REFERENCES usuario (cedula) ON DELETE CASCADE
);


CREATE TABLE cita(
	idCita INT AUTO_INCREMENT NOT NULL,
		CONSTRAINT cita_idCita_pk PRIMARY KEY (idCita),
    cedulaP VARCHAR(20) NOT NULL,
		CONSTRAINT cita_cedulaP_fk FOREIGN KEY (cedulaP)
		REFERENCES paciente (cedula) ON DELETE CASCADE,
	cedulaD VARCHAR(20),
		CONSTRAINT cita_cedulaD_fk FOREIGN KEY (cedulaD)
		REFERENCES doctor(cedula) ON DELETE CASCADE ON UPDATE CASCADE,
	estadoCita VARCHAR(25) DEFAULT 'PENDIENTE',
		CONSTRAINT cita_estadoCita_ck CHECK 
        (estadoCita RLIKE ('PENDIENTE') OR estadoCita RLIKE ('REALIZADA')),
	descripcion LONGTEXT,
	fechaCita DATE NOT NULL,
    horaCita TIME NOT NULL
);

CREATE TABLE consulta(
	idConsulta INT AUTO_INCREMENT,
		CONSTRAINT consulta_idConsulta_pk PRIMARY KEY (idConsulta),
	cedulaP VARCHAR(20) NOT NULL,
		CONSTRAINT consulta_cedulaP_fk FOREIGN KEY (cedulaP)
		REFERENCES paciente (cedula) ON DELETE CASCADE,
	idCita INT,
		CONSTRAINT consulta_idCita_fk FOREIGN KEY (idCita)
        REFERENCES cita (idCita) ON DELETE CASCADE,
	tipoConsulta VARCHAR(10),
		CONSTRAINT consulta_tipoConsulta_ck CHECK 
        (tipoConsulta RLIKE ('CITA') OR tipoConsulta RLIKE ('URGENCIA')),
	
	fechaConsulta DATETIME DEFAULT CURRENT_TIMESTAMP,
	motivoConsulta LONGTEXT,
    medicamentosRecetados LONGTEXT
);


/*-----------------------------INSERT----------------------------*/
/*-----------------------------INSERT----------------------------*/
/*-----------------------------INSERT----------------------------*/
/*-----------------------------INSERT----------------------------*/
/*-----------------------------INSERT----------------------------*/

INSERT INTO usuario (cedula, correoUsuario, contrasena, nombre, apellido, sexo, fechaNacimiento,celular,provincia,ciudad,dirreccion,tipoUsuario)
VALUES 
/*USUARIOS DOCTORES*/
('8-901-1234','jonesy.ramirez@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Jonesy','Ramirez','M',STR_TO_DATE('01-04-1992', '%d-%m-%Y'),'1111-1111','Panama','Panama','Panama',0),
('8-902-1234','sadie.adler@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Sadie','Adler','F',STR_TO_DATE('12-01-1996', '%d-%m-%Y'),'1111-1111','Panama','Panama','Panama',0),
('8-903-1234','arthur.morgan@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Arthur','Morgan','M',STR_TO_DATE('15-11-1995', '%d-%m-%Y'),'1111-1111','Panama','Panama','Panama',0),

/*USUARIOS PACIENTES*/
('8-990-1234','kevin.barria@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Kevin','Barria','M',STR_TO_DATE('28-06-2002', '%d-%m-%Y'),'1111-1111','Panama','Panama','Pedregal',1),
('8-971-1222','alma.benitez@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Alma','Benitez','F',STR_TO_DATE('28-11-1994', '%d-%m-%Y'),'1111-1111','Panama','Panama','Mañanitas',1),
('2-222-2222','jorge.veliz@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Jorge','Veliz','M',STR_TO_DATE('26-03-1996', '%d-%m-%Y'),'1111-1111','Panama','Chorrera','AlgunLugarChorrera',1),
('3-333-3333','aaron.ledezma@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Aaron','Ledezma','M',STR_TO_DATE('03-01-2002', '%d-%m-%Y'),'1111-1111','Panama','Chorrera','AlgunLugarChorrera',1),
('4-444-4444','miguel.rios@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Miguel','Rios','M',STR_TO_DATE('16/09/2001', '%d/%m/%Y'),'1111-1111','Panama','San Miguelito','Calle Caliente',1),
('5-555-5555','eduardo.lore@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Eduardo','Lore','M',STR_TO_DATE('13/05/2001', '%d/%m/%Y'),'1111-1111','Panama','Panama','Don Bosco',1),
('6-666-6666','geovani.herrera@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Geovani','Herrera','M',STR_TO_DATE('07/04/2000', '%d/%m/%Y'),'1111-1111','Panama','Panama','Don Bosco',1),
('7-777-7777','daniela.aparicio@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Daniela','Aparicio','F','2003/12/07','1111-1111','Panama','Arraijan','AlgunLugarArraijan',1),
('8-888-8888','vanessa.sens@utp.ac.pa','202cb962ac59075b964b07152d234b70', 'Vanessa','Sens','F','2001-06-26','1111-1111','Panama','Cocle','Penonome',1);

INSERT INTO doctor (cedula) VALUES
('8-901-1234'),
('8-902-1234'),
('8-903-1234');

INSERT INTO paciente (cedula) VALUES
('8-990-1234'),
('8-971-1222'),
('2-222-2222'),
('3-333-3333'),
('4-444-4444'),
('5-555-5555'),
('6-666-6666'),
('7-777-7777'),
('8-888-8888');

/*
SELECT * FROM cita;
SELECT * FROM consulta;
SELECT * FROM doctor;
SELECT * FROM paciente;
SELECT * FROM usuario;
*/
/*-----------------------------PROCEDIMIENTOS----------------------------*/
/*-----------------------------PROCEDIMIENTOS----------------------------*/
/*-----------------------------PROCEDIMIENTOS----------------------------*/
/*-----------------------------PROCEDIMIENTOS----------------------------*/
/*-----------------------------PROCEDIMIENTOS----------------------------*/
/*PROCEDIMIENTO PARA LOGUEAR DOCTOR (PARA APLICACION WEB)*/
DELIMITER //
CREATE  PROCEDURE login_doctor(
				IN vcorreo VARCHAR(100),
				IN vcontrasena VARCHAR(50))
BEGIN
        IF((vcorreo RLIKE '.[@].') AND (vcontrasena RLIKE ('.[A-Z].') and vcontrasena RLIKE ('.[0-9].'))) 
		THEN
			SELECT d.idDoctor, u.cedula, u.correoUsuario,u.contrasena, u.nombre, u.apellido FROM usuario as u
            JOIN doctor AS d ON u.cedula = d.cedula
				WHERE u.correoUsuario = vcorreo AND u.contrasena = vcontrasena AND u.tipoUsuario = 0;
        ELSE
        SELECT('debe ingresar los campos correctamente') AS "mensaje";
        END IF;
END //
delimiter ;

/*CALL login_doctor('jonesy.ramirez@utp.ac.pa','202cb962ac59075b964b07152d234b70');*/

/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA INSERTAR UNA CITA (PARA APLICACION MOVIL)*/
DELIMITER //
CREATE PROCEDURE insertar_Cita(
				IN vCedulaPaciente VARCHAR(20),
                IN vCedulaDoctor VARCHAR(20),
                IN vDescripcion LONGTEXT,
                IN vFechaCita DATE,
                IN vHoraCita TIME)
BEGIN
	DECLARE pacienteExiste INT;
    DECLARE doctorExiste INT;
		SET pacienteExiste = (SELECT COUNT(*) FROM paciente WHERE cedula = vCedulaPaciente);
		SET doctorExiste = (SELECT COUNT(*) FROM doctor WHERE cedula = vCedulaDoctor);
        
        IF pacienteExiste > 0 THEN
			IF doctorExiste > 0 THEN
				INSERT INTO cita (cedulaP, cedulaD,descripcion, fechaCita, horaCita) VALUES
				(vCedulaPaciente,vCedulaDoctor,vDescripcion,vFechaCita,vHoraCita);
                SELECT('Cita Ingresada Correctamente') AS 'MENSAJE';
            ELSE
				SELECT('El Doctor Seleccionado No Existe') AS 'MENSAJE';
            END IF;
        ELSE
			SELECT('El Paciente Seleccionado No Existe') AS 'MENSAJE';
        END IF;
END //

/*
FLUJO FELIZ

PASO 2:
CITA INSERTADA POR PACIENTE KEVIN BARRIA
CALL insertar_Cita('8-990-1234','8-901-1234','jaqueca o migraña creo','2022/11/30','09:00');

PASO 6:
CITA INSERTADA POR PACIENTE ALMA BENITEZ
CALL insertar_Cita('8-971-1222','8-901-1234','ando vomitando','2022/11/30','10:00');
*/


/*
CITAS ADICIONALES
CALL insertar_Cita('2-222-2222','8-901-1234','Fiebre Alta','2022/12/1','9:00');
CALL insertar_Cita('3-333-3333','8-901-1234','Escalofrios','2022/12/1','10:00');
CALL insertar_Cita('4-444-4444','8-901-1234','Jaqueca','2022/12/1','11:00');
CALL insertar_Cita('5-555-5555','8-901-1234','Resfriado','2022/12/2','10:00');
CALL insertar_Cita('6-666-6666','8-901-1234','Tos','2022/12/2','09:00');

CALL insertar_Cita('7-777-7777','8-902-1234','Dolores de cabeza','2022/12/1','09:00');
CALL insertar_Cita('8-888-8888','8-902-1234','Mareos','2022/12/1','10:00');
CALL insertar_Cita('5-555-5555','8-902-1234','Congestion Nasal','2022/12/2','14:00');
CALL insertar_Cita('6-666-6666','8-902-1234','Dolores De Cabeza fuertes','2022/12/1','14:00');

CALL insertar_Cita('4-444-4444','8-903-1234','Tos y fiebre','2022/12/01','10:00');
CALL insertar_Cita('3-333-3333','8-903-1234','Malestar estomacal','2022/12/01','09:00');
*/

/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA MOSTRAR CITAS DE UN DOCTOR (PARA APLICACION WEB)*/
DELIMITER //
CREATE PROCEDURE mostrarCitas(
				IN vCedulaDoctor VARCHAR(20))
BEGIN
	SELECT c.idCita as Cita, CONCAT(u.nombre,' ',u.apellido)AS NombrePaciente, c.descripcion as Descripcion, c.estadoCita as EstadoCita, c.horaCita as Hora, c.fechaCita as Fecha
	FROM cita as c 
    JOIN usuario as u ON u.cedula = c.cedulaP
	WHERE c.cedulaD = vCedulaDoctor
    ORDER BY DATE(c.fechaCita) ASC, c.horaCita ASC, c.estadoCita ASC;
END //

/*

PASO 10: Mostrar las citas del Doctor Jonesy
CALL mostrarCitas('8-901-1234');


CALL mostrarCitas('8-902-1234');

*/

/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA MOSTRAR CONSULTA DE UNA CITA (PARA APLICACION WEB)*/
DELIMITER //
CREATE PROCEDURE mostrarConsulta(IN vID INT)
BEGIN
	SELECT u.nombre as Nombre, u.apellido AS Apellido, c.cedulaP AS Cedula
    FROM cita as c
    JOIN usuario as u ON u.cedula = c.cedulaP
    WHERE c.idCita = vID;
END //

/*

Paso 11: Mostrar los datos de la cita seleccionada en la pantalla consulta
CALL mostrarConsulta(1);

*/

/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA CREAR CONSULTA CON CITA (PARA APLICACION WEB)*/
DELIMITER //
CREATE PROCEDURE crearConsultaConCitas(
					IN vidCita INT,
					IN vcedulaP VARCHAR(20),
                    IN vmotivoConsulta LONGTEXT,
                    IN vmedicamentosRecetados LONGTEXT)
BEGIN
	DECLARE citaExiste INT;
		SET citaExiste = (SELECT COUNT(*) FROM cita WHERE idCita = vidCita);
    IF citaExiste > 0 THEN
		INSERT INTO consulta(cedulaP,idCita,tipoConsulta,motivoConsulta,medicamentosRecetados)
		VALUES (vcedulaP,vidCita,'CITA',vmotivoConsulta,vmedicamentosRecetados);
        UPDATE cita SET estadoCita = 'REALIZADA' WHERE idCita = vidCita;
        SELECT('CONSULTA INSERTADA CORRECTAMENTE') AS 'MENSAJE';
    ELSE
		SELECT('El Cita Seleccionado No Existe') AS 'MENSAJE';
	END IF;
END //


/*

PASO 12: El doctor empieza a llenar la cita del paciente Kevin Barria. Llena el Motivo de Consulta y la Receta.
CALL crearConsultaConCitas(1,'8-990-1234','Vino por Migraña. Debido a muchas tares y estrés','Tu receta es tomar Fosfo B12');


*/

/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA CREAR CONSULTA SIN CITA (PARA APLICACION WEB)*/
DELIMITER //
CREATE PROCEDURE crearConsultaSinCitas(
					IN vcedulaP VARCHAR(20),
                    IN vmotivoConsulta LONGTEXT,
                    IN vmedicamentosRecetados LONGTEXT)
BEGIN
	DECLARE pacienteExiste INT;
		SET pacienteExiste = (SELECT COUNT(*) FROM paciente WHERE cedula = vcedulaP);
    IF pacienteExiste > 0 THEN
		INSERT INTO consulta(cedulaP,tipoConsulta,motivoConsulta,medicamentosRecetados)
		VALUES (vcedulaP,'URGENCIA',vmotivoConsulta,vmedicamentosRecetados);
        SELECT('CONSULTA INSERTADA CORRECTAMENTE') AS 'MENSAJE';
    ELSE
		SELECT('El Paciente Seleccionado No Existe') AS 'MENSAJE';
	END IF;
END //

/*


CONSULTAS SIN CITA ADICIONALES. PRUEBA PARA RELLENAR HISTORIAL
CALL crearConsultaSinCitas('8-990-1234','Esto es una prueba de Consulta sin Cita 1','Esta es una receta 1 para paciente Kevin');
CALL crearConsultaSinCitas('8-990-1234','Esto es una prueba de Consulta sin Cita 2','Esta es una receta 2 para paciente Kevin');
CALL crearConsultaSinCitas('8-990-1234','Esto es una prueba de Consulta sin Cita 3','Esta es una receta 3 para paciente Kevin');

CALL crearConsultaSinCitas('8-971-1222','Esto es una prueba de Consulta sin Cita 1','Esta es una receta 1 para paciente Alma');
CALL crearConsultaSinCitas('8-971-1222','Esto es una prueba de Consulta sin Cita 2','Esta es una receta 2 para paciente Alma');
CALL crearConsultaSinCitas('8-971-1222','Esto es una prueba de Consulta sin Cita 3','Esta es una receta 3 para paciente Alma');
*/


/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA MOSTRAR HISTORIAL DE UN PACIENTE (PARA APLICACION WEB Y MOVIL)*/
DELIMITER //
CREATE PROCEDURE mostrarHistorialPaciente(IN vcedulaP INT)
BEGIN
	SELECT co.idConsulta AS IDConsulta,CONCAT(u.nombre,' ',u.apellido)AS NombrePaciente, u.cedula as Cedula, co.fechaConsulta as Fecha,
			c.descripcion as Motivo,co.motivoConsulta as NotaDoctor, co.medicamentosRecetados as Receta
FROM consulta as co
JOIN usuario as u ON u.cedula = co.cedulaP
JOIN cita as c ON c.cedulaP = co.cedulaP
WHERE u.cedula = vcedulaP;
END //


/*

Paso 14 y 15b: El doctor podrá ver el historial de cualquier paciente. Y el paciente podrá ver su propio historial

HISTORIAL DEL PACIENTE KEVIN BARRIA
CALL mostrarHistorialPaciente('8-990-1234')

HISTORIAL DEL PACIENTE ALMA BENITEZ
CALL mostrarHistorialPaciente('8-971-1222')

*/



/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*-------------------------------------------------------------------------------------*/
/*PROCEDIMIENTO PARA MOSTRAR LAS CITAS DE UN PACIENTE (PARA APLICACION MOVIL)*/
DELIMITER //
CREATE PROCEDURE mostrarCitasPaciente(IN vcedulaP INT)
BEGIN
	SELECT CONCAT(u.nombre,' ',u.apellido)AS NombreDoctor, c.descripcion as Descripcion, c.fechaCita as Fecha,
			c.horaCita as Hora, c.estadoCita as Estado
	FROM cita as c
	JOIN usuario as u ON u.cedula = c.cedulaD
	WHERE c.cedulaP = vcedulaP;
END //

/*

PASO 3 Y 7: Paciente revisa sus citas en la aplicación desde la pantalla de Citas y verá los datos de la cita que ingreso.
//Citas del Paciente Kevin Barria
CALL mostrarCitasPaciente('8-990-1234');

//Citas del Paciente Alma Benitez
CALL mostrarCitasPaciente('8-971-1222');

*/








