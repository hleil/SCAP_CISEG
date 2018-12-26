INSERT INTO TAACTIVOSCAP (nombre,fInicio,fFin,propietarioActivo,comentarios,version,fAlta,responsable,estatus) VALUES ('SABER','2019-01-01','2019-02-01','CIC IPN','Evaluación anual 2018','3',NOW(),'2',1);
INSERT INTO TAPRUEBASCAP (fInicio,fFin,fAlta,metodologia,tipoPrueba,estatus,idActivo) VALUES ('2019-01-01','2020-01-01',NOW(),2,1,1,1);
INSERT INTO TAUSRSCAP_TAPRUEBASCAP VALUES (7,1);

INSERT INTO TAREVCONFIGURACION (fabricante,producto,version,edicion,idPrueba,tipoRevision) VALUES ('Red Hat','Enterprise Linux Server','7.5','Enterprise',1,2);
INSERT INTO TAREVCONFIGURACION (fabricante,producto,version,edicion,idPrueba,tipoRevision) VALUES ('MariaDB','MariaDB for Linux','15.1','Community',1,3);


INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del sistema de archivos','Asegúrese de que el montaje de los sistemas de archivos cramfs esté deshabilitado','Se verifica que el sistema operativo no tuviera montado el sistema de archivos cramfs.',NOW(),1,1,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del sistema de archivos','Asegúrese de que el montaje de los sistemas de archivos cramfs esté deshabilitado','Se verifica que el sistema operativo no tuviera montado el sistema de archivos cramfs.',NOW(),1,1,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del sistema de archivos','Asegúrese de que el montaje de los sistemas de archivos freevxfs esté deshabilitado','Se verifica que el sistema operativo no tuviera montado el sistema de archivos freevxfs.',NOW(),1,1,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del sistema de archivos','Asegúrese de que el montaje de los sistemas de archivos freevxfs esté deshabilitado','Se verifica que el sistema operativo no tuviera montado el sistema de archivos freevxfs.',NOW(),1,1,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del nivel del sistema operativo','Cuenta con privilegios mínimos dedicados','Se verifica que el usuario para el sistema del SABER no tuviera privilegios de administración sobre el gestor de la base de datos.',NOW(),1,2,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del nivel del sistema operativo','Cuenta con privilegios mínimos dedicados','Se verifica que el usuario para el sistema del SABER no tuviera privilegios de administración sobre el gestor de la base de datos.',NOW(),1,2,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del nivel del sistema operativo','Historial de comandos de MySQL','Se verifica que no existiera el archivo que guarda el historial de las sentencias ejecutadas en el gestor de la base de datos.',NOW(),1,2,0);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,contadorRevision) VALUES ('Configuración del nivel del sistema operativo','Historial de comandos de MySQL','Se verifica que no existiera el archivo que guarda el historial de las sentencias ejecutadas en el gestor de la base de datos.',NOW(),1,2,0);



INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,entrada,resultado,resultadoPrueba,comentariosValidador,contadorRevision) VALUES ('Permisos de File System','Permisos asignados a la carpeta de la variable Datadir','Se verifica que los archivos y carpetas correspondientes a la variable datadir tuvieran configurados los permisos de lectura y escritura únicamente al usuario de MySQL',NOW(),4,2,'Entrada','Resultado','Correcto','Comentario del revisor',2);
INSERT INTO TACASOPRUEBACONFSCAP (grupo,titulo,descripcion,fAlta,estatus,revConfiguracion,entrada,resultado,resultadoPrueba,comentariosValidador,contadorRevision) VALUES ('Permisos de File System','Permisos asignados a la carpeta de la variable Datadir','Se verifica que los archivos y carpetas correspondientes a la variable datadir tuvieran configurados los permisos de lectura y escritura únicamente al usuario de MySQL',NOW(),4,2,'Entrada','Resultado','Correcto','Comentario del revisor',2);


INSERT INTO TAUSRCONFSCAP VALUES (3,1);
INSERT INTO TAUSRCONFSCAP VALUES (4,2);

INSERT INTO TAUSRCONFSCAP VALUES (3,3);
INSERT INTO TAUSRCONFSCAP VALUES (4,4);

INSERT INTO TAUSRCONFSCAP VALUES (3,5);
INSERT INTO TAUSRCONFSCAP VALUES (4,6);

INSERT INTO TAUSRCONFSCAP VALUES (3,7);
INSERT INTO TAUSRCONFSCAP VALUES (4,8);


INSERT INTO TAUSRCONFSCAP VALUES (3,9);
INSERT INTO TAUSRCONFSCAP VALUES (4,10);


