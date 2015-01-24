  /*

	1. Crear tupla con motores de almacenamiento MyISAM e InnoDB

		CREATE TABLE customers (a INT, b CHAR (20), INDEX (a)) ENGINE=InnoDB;
		CREATE TABLE customers (a INT, b CHAR (20), INDEX (a)) TYPE=InnoDB;

		CREATE TABLE customers (a INT, b CHAR (20), INDEX (a)) ENGINE=MyISAM;
		CREATE TABLE customers (a INT, b CHAR (20), INDEX (a)) TYPE=MyISAM;
	
	2. crear base de datos con collation distintos

		cotejamientos:

			utf8_general_ci
			utf8_spanish_ci

			latin1_general_ci
			latin1_spanish_ci

		CREATE DATABASE dbname CHARACTER SET utf8 COLLATE utf8_general_ci;

	3. charset disponibles para aplicar a tuplas o bd

		charset:
				utf8
				latin1
				ASCII

		collation:
				utf8_unicode_ci
				latin1_general_cs
				ascii_general_ci

		-- Creamos la tabla:
		CREATE TABLE IF NOT EXISTS collationTests (
			name01 CHAR(5) CHARSET utf8 COLLATE utf8_unicode_ci,
			name02 CHAR(5) CHARSET latin1 COLLATE latin1_general_cs,
			name03 CHAR(5) CHARSET ASCII COLLATE ascii_general_ci,
			name04 CHAR(5) CHARSET utf8 COLLATE utf8_bin,
			name05 CHAR(5) CHARSET latin1 COLLATE latin1_bin,
			name06 CHAR(5) CHARSET ASCII COLLATE ascii_bin,
		) ENGINE=MyISAM;

		-- Insertamos algunos datos:
		INSERT INTO collationTests VALUES ('Ñandú','Ñandú','Nandu','Ñandú','Ñandú','Nandu');

	4. mostrar los charset o collation disponibles via comandos

		-- Mostrar los CHARSETs instalados:
		SHOW CHARACTER SET;
		-- Mostrar COLLATIONS instalados:
		SHOW COLLATION;

	5. explicacion de algunos collation

		latin1_spanish_ci : utilizada en windows pero no comunmente para todos los caracteres
		utf8_spanish_ci : utilizado para el español tradicional
		utf8_spanish2_ci : utilizado para el español moderno

	6. crear base de datos

		# create database inves1;

	7. explicacion de tipos de cotejamiento myisam

		InnoDB

		# Soporte de transacciones
		# Bloqueo de registros
		# Nos permite tener las características ACID (Atomicity, Consistency, Isolation and Durability: Atomicidad, Consistencia, 
			Aislamiento y Durabilidad en español), garantizando la integridad de nuestras tablas.
		# Es probable que si nuestra aplicación hace un uso elevado de INSERT y UPDATE notemos un aumento de rendimiento 
			con respecto a MyISAM.
		# InnoDB dota a MySQL de un motor de almacenamiento transaccional (conforme a ACID) con capacidades de commit (confirmación), 
			rollback (cancelación) y recuperación de fallos
		# InnoDB realiza bloqueos a nivel de fila y también proporciona funciones de lectura consistente sin bloqueo al estilo 
			Oracle en sentencias SELECT


		MyISAM

		# Mayor velocidad en general a la hora de recuperar datos.
		# Recomendable para aplicaciones en las que dominan las sentencias SELECT ante los INSERT / UPDATE.
		# Ausencia de características de atomicidad ya que no tiene que hacer comprobaciones de la 
			integridad referencial, ni bloquear las tablas para realizar las operaciones, esto nos lleva 
			como los anteriores puntos a una mayor velocidad.

	8. create tupla en bd

		# create table inves1_trab(
			inves1_trabId int(11) auto_increment not null,
			inves1_trabNom varchar(25),
			inves1_trabAre varchar(25),
			inves1_trabEdad int(10)
		)

	9. crear una vista

		# CREATE VIEW inves1_trab_view AS (
			SELECT *
			FROM inves1_trab
			)

	10. crear un procedimiento almacenado

		# DELIMITER $$
 
			CREATE PROCEDURE  ProcedimientoInsertar
			(
			in Nombre varchar(50),
			in Telefono varchar(50)
			)
			BEGIN
			insert into contactos(nombre,telefono) values(Nombre,Telefono);
			END

	11. crear una funcion

		#   delimiter $$
			CREATE FUNCTION cuadrado (s SMALLINT) RETURNS SMALLINT
			RETURN s*s;
			delimiter

	12. seleccionar base de datos para empezar a usar

		# use inves1;

	13. añadir registros a tupla

		# insert into inves1_trab(inves1_trabNom,inves1_trabAre,inves1_trabEdad) values ('jaime','comercial',35);

	14. obtener registros de tupla

		# select * from inves1_trab;

	15. llamar a un procedimiento almacenado

		# CALL ProcedimientoInsertar('Valor del campo nombre','Valor del campo Telefono')
	
	16. llamar a funcion

		# SELECT cuadrado(2);

	17. crear un loop

		DELIMITER $$
		CREATE PROCEDURE doiterate($p1 int(11))
		BEGIN
		declare $x int(11);
		label1: LOOP
		SET $p1 = $p1 + 1;
		IF $p1 < 10 THEN
		ITERATE label1;
		END IF;
		LEAVE label1;
		END LOOP label1;
		SET $x = $p1;
		select $x;
		END;

	18. crear un repeat

		DELIMITER $$
		CREATE PROCEDURE dorepeat($p1 int(11))
    	BEGIN
		declare $x int(11);
		SET $x = 0;
		REPEAT
		SET $x = $x + 1;
		UNTIL $x > $p1 END REPEAT;
		select $x;
		END;

	19. crear un while

		DELIMITER $$
		CREATE PROCEDURE dowhile()
		BEGIN
		  DECLARE $v1 INT DEFAULT 5;
		  WHILE $v1 > 0 DO
		    SET $v1 = $v1 - 1;
		  END WHILE;
		END;

	20. crear un trigger

		// creamos nuestras tuplas

			CREATE TABLE test1(a1 INT);
			CREATE TABLE test2(a2 INT);
			CREATE TABLE test3(a3 INT NOT NULL AUTO_INCREMENT PRIMARY KEY);
			CREATE TABLE test4(
			  a4 INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
			  b4 INT DEFAULT 0
			);

		// creamos nuestro trigger

			CREATE TRIGGER testref BEFORE INSERT ON test1
			FOR EACH ROW BEGIN
			    INSERT INTO test2 SET a2 = NEW.a1;
			    DELETE FROM test3 WHERE a3 = NEW.a1;  
			    UPDATE test4 SET b4 = b4 + 1 WHERE a4 = NEW.a1;
			END

		// creamos nuestros insert

			INSERT INTO test3 (a3) VALUES 
			(NULL), (NULL), (NULL), (NULL), (NULL), 
			(NULL), (NULL), (NULL), (NULL), (NULL);

			INSERT INTO test4 (a4) VALUES 
			(0), (0), (0), (0), (0), (0), (0), (0), (0), (0);

		// creamos nuestro test1 para activar el trigger

			mysql> INSERT INTO test1 VALUES 
	    	(1), (3), (1), (7), (1), (8), (4), (4);

	21. creacion y uso de cursores

		Ejem1:
		------
		CREATE PROCEDURE curdemo()
		BEGIN
		  DECLARE done INT DEFAULT 0;
		  DECLARE a CHAR(16);
		  DECLARE b,c INT;
		  DECLARE cur1 CURSOR FOR SELECT id,data FROM test.t1;
		  DECLARE cur2 CURSOR FOR SELECT i FROM test.t2;
		  DECLARE CONTINUE HANDLER FOR SQLSTATE '02000' SET done = 1;

		  OPEN cur1;
		  OPEN cur2;

		  REPEAT
		    FETCH cur1 INTO a, b;
		    FETCH cur2 INTO c;
		    IF NOT done THEN
		       IF b < c THEN
		          INSERT INTO test.t3 VALUES (a,b);
		       ELSE
		          INSERT INTO test.t3 VALUES (a,c);
		       END IF;
		    END IF;
		  UNTIL done END REPEAT;

		  CLOSE cur1;
		  CLOSE cur2;
		END

		Ejem2:
		------
		CREATE PROCEDURE ejemplo()
		BEGIN -- abrimos el procedure

		   -- se declaran las variables a usar
		   DECLARE a INT;
		   DECLARE b CHAR(6);

		   -- se declara un cursor que navegara por el resultado de la consulta 
		   DECLARE cursor1 CURSOR FOR SELECT id,nombre FROM usuarios;


		  OPEN cursor1; -- se abre el cursor

		    -- ... parte del procedimiento
		    REPEAT -- comenzamos las iteraciones para movernos entre los registros

		     -- almacenamos el id y el nombre del registro actual, en las variables a y b
		     FETCH cursor1 INTO a, b;

		    UNTIL expresion END REPEAT;-- salimos del ciclo
		         -- ... resto del codigo, el que hacer con esas dos variables (a y b)

		  -- cerramos el cursor 
		  CLOSE cursor1;

		-- cerramos el procedure
		END//

	22. Uso de case en procedure

		CREATE PROCEDURE p()
		  BEGIN
		    DECLARE v INT DEFAULT 1;

		    CASE v
		      WHEN 2 THEN SELECT v;
		      WHEN 3 THEN SELECT 0;
		      ELSE
		        BEGIN
		        END;
		    END CASE;
		  END;

	23. Uso de case en query

		mysql> SELECT CASE WHEN 1>0 THEN 'true' ELSE 'false' END;

	24. Uso de "IF" en query

		SELECT IF(1<2,'yes','no');

	25. Uso de "IF" en procedure

		IF n > m THEN 
			SET s = '>';
	    ELSEIF n = m THEN 
	    	SET s = '=';
	    ELSE 
	    	SET s = '<';
	    END IF;
	
	26. Crear evento

		CREATE EVENT myevent
	    ON SCHEDULE
	      EVERY 6 HOUR
	    COMMENT 'A sample comment.'
	    DO
	      UPDATE myschema.mytable SET mycol = mycol + 1;

	27. eliminar una vista

		DROP VIEW view_name

	28. mostrar vista

		SHOW CREATE VIEW v_lp_lineProd

	29. aumentar capacidad de variable group_concat

		SET SESSION group_concat_max_len = 10000;
		SET GLOBAL group_concat_max_len = 10000;
*/

use inves1; 

create table inves1_trab
(
	inves1_trabId int(11) primary key auto_increment not null,
	inves1_trabNom varchar(25),
	inves1_trabAre varchar(15),
	inves1_trabEdad int(10)
) 	ENGINE=MyISAM;

insert into inves1_trab(inves1_trabNom,inves1_trabAre,inves1_trabEdad) values ('jaime','comercial',35);
insert into inves1_trab(inves1_trabNom,inves1_trabAre,inves1_trabEdad) values ('dany','comercial',30);

select * from inves1_trab;

CREATE VIEW inves1_trab_view AS 
(
	SELECT *
	FROM inves1_trab
);


DELIMITER $$ 
CREATE PROCEDURE  inves1_sp2_insert
(
in trabNom varchar(25),
in trabAre varchar(15),
in trabEdad int(10)
)
BEGIN
insert into inves1_trab(inves1_trabNom,inves1_trabAre,inves1_trabEdad) values(trabNom,trabAre,trabEdad);
END;
$$ DELIMITER

CALL inves1_sp_insert('cesar','calidad',30);

DELIMITER $$
CREATE FUNCTION hello_world()
  RETURNS TEXT
  LANGUAGE SQL
BEGIN
  RETURN 'Hello World';
END;
$$ DELIMITER

SELECT hello_world();

DELIMITER $$
CREATE FUNCTION cuadrado(s SMALLINT) 
	RETURNS SMALLINT
BEGIN
	RETURN s*s;
END;
$$



