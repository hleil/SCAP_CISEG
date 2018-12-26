CREATE USER 'cic_scap'@'localhost' IDENTIFIED BY 'Ciseg;2018';
GRANT ALL PRIVILEGES ON scap.* TO 'cic_scap'@'localhost';
FLUSH PRIVILEGES;

use scap;

INSERT INTO CATROL (rol) VALUES ('Administrador');
INSERT INTO CATROL (rol) VALUES ('Responsable de evaluación');
INSERT INTO CATROL (rol) VALUES ('Evaluador');
INSERT INTO CATROL (rol) VALUES ('Validador');


INSERT INTO CATESTATUSUSR (estatus) VALUES ('Activo');
INSERT INTO CATESTATUSUSR (estatus) VALUES ('Inactivo');

INSERT INTO CATESTATUSACTIVO (estatus) VALUES ('Activo');
INSERT INTO CATESTATUSACTIVO (estatus) VALUES ('Terminada');

INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Administrador','admin@admin.com',SHA2('ciseg', 256),0,NOW(),1,1);

INSERT INTO CATMETODOLOGIA (metodologia) VALUES ('OWASP');
INSERT INTO CATMETODOLOGIA (metodologia) VALUES ('OSSTMM');

INSERT INTO CATTIPOPRUEBA (tipoPrueba) VALUES ('Revisión de configuraciones');
INSERT INTO CATTIPOPRUEBA (tipoPrueba) VALUES ('Seguridad y calidad');

INSERT INTO CATESTATUSPRUEBA (estatus) VALUES ('Activo');
INSERT INTO CATESTATUSPRUEBA (estatus) VALUES ('En proceso');
INSERT INTO CATESTATUSPRUEBA (estatus) VALUES ('Terminada');

INSERT INTO CATESTATUSCASOPRUEBA (estatus) VALUES ('Activo');
INSERT INTO CATESTATUSCASOPRUEBA (estatus) VALUES ('En proceso');
INSERT INTO CATESTATUSCASOPRUEBA (estatus) VALUES ('Terminada');
INSERT INTO CATESTATUSCASOPRUEBA (estatus) VALUES ('Rechazada');
INSERT INTO CATESTATUSCASOPRUEBA (estatus) VALUES ('En validación');

INSERT INTO CATIPOREVCONFIGURACION (revision) VALUES ('Firmware');
INSERT INTO CATIPOREVCONFIGURACION (revision) VALUES ('Sistema Operativo');
INSERT INTO CATIPOREVCONFIGURACION (revision) VALUES ('Gestor de base de datos');
INSERT INTO CATIPOREVCONFIGURACION (revision) VALUES ('Servidor HTTP');

INSERT INTO CATTIPOSCAP (nombreTipo) VALUES ('Análisis estático de código');
INSERT INTO CATTIPOSCAP (nombreTipo) VALUES ('Análisis de funcionalidad');

INSERT INTO CATSEVERSQSCAP (nombreSeveridad) VALUES ('Informativa');
INSERT INTO CATSEVERSQSCAP (nombreSeveridad) VALUES ('Menor');
INSERT INTO CATSEVERSQSCAP (nombreSeveridad) VALUES ('Mayor');
INSERT INTO CATSEVERSQSCAP (nombreSeveridad) VALUES ('Crítica');
INSERT INTO CATSEVERSQSCAP (nombreSeveridad) VALUES ('Blocker');


INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Autenticación');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Autorización');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Administración de configuración');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Protección de datos y almacenamiento');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Validación de datos');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Manejo de errores y excepciones');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Administración de usuarios y sesiones');
INSERT INTO CATTIPOAMESCAP (nombreAmenaza) VALUES ('Auditoria y login');

INSERT INTO CATCATESCAP (nombreCategoria) VALUES ('Vulnerabilidad');
INSERT INTO CATCATESCAP (nombreCategoria) VALUES ('Bug');
INSERT INTO CATCATESCAP (nombreCategoria) VALUES ('Punto crítico de seguridad');
INSERT INTO CATCATESCAP (nombreCategoria) VALUES ('Debilidad de diseño');

INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Eleazar Aguirre Anaya','eaguirre@cic.ipn.mx',SHA2('Scap;2018', 256),1,NOW(),2,1);
INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Miguel Hernández Hernández','hegumi@hotmail.com',SHA2('Scap;2018', 256),1,NOW(),3,1);
INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Byron González Flores','byronemail7@gmail.com',SHA2('Scap;2018', 256),1,NOW(),3,1);
INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Luis Macedo Santiago','lumacs13@gmail.com',SHA2('Scap;2018', 256),1,NOW(),3,1);
INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Armando Díaz Peláez','c.armando.diaz.p@gmail.com',SHA2('Scap;2018', 256),1,NOW(),3,1);
INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Ivan Sánchez','isc.ivan.sanchez@gmail.com',SHA2('Scap;2018', 256),1,NOW(),4,1);
INSERT INTO TAUSRSCAP (nombre,correo,contrasena,primerLogin,fAlta,rol,estatus) VALUES ('Antonio Ocampo','fenix@engineer.com',SHA2('Scap;2018', 256),1,NOW(),4,1);


