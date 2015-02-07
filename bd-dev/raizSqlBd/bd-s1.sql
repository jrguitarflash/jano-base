/*-------------------------------------------------------------------------------------------------------*/
	#SQL MODULO RECLAMOS
/*-------------------------------------------------------------------------------------------------------*/

	/*
		tbrecla_reclamo
		tbrecla_tipo_reclamo
		tbrecla_proceso_reclamo
		tbrecla_estado_reclamo
		tbrecla_personal
		tbrecla_cargo_personal
		tbrecla_contacto
		tbrecla_cliente
	*/

	/*
		EJEMPLO CREAR VISTA:
		-------------------
		CREATE VIEW prueba AS 
		(
		SELECT *
		FROM tabla
		);
	*/

	/*-----------------------------------------*/
		# TABLE RECLAMO
	/*-----------------------------------------*/

	create table tbrecla_reclamo
	(
	tbrecla_reclamo_id int(10) primary key auto_increment not null,
	idTipReclamo int(10),
	idPersoReclamo int(10),
	idRespoReclamo int(10),
	idEstaReclamo int(10),
	idContacReclamo int(10),
	idProceReclamo int(10),
	idEmpReclamo int(10),
	desReclamo varchar(2000),
	acciReclamo varchar(2000),
	acciReliReclamo varchar(2000),
	adjuReclamo varchar(200),
	fechReclamo date,
	bestado char(1),
	correPor varchar(200),
	detObsId int(11)
	);

	---------------------------------------- MODIFICACION ----------------------------------------
	alter table tbrecla_reclamo #old
	add idRespoReclamo2 int(10) after idRespoReclamo;

	alter table tbrecla_reclamo #old
	add enviRespo int(10) after idRespoReclamo2, 
	add enviRespo2 int(10) after enviRespo;

	alter table tbrecla_reclamo add desEmpReclamo varchar(200) after idProceReclamo; # old

	alter table tbrecla_reclamo add acciReliReclamo varchar(2000) after acciReclamo; #old

	alter table tbrecla_reclamo add adjuReclamo varchar(200) after acciReliReclamo; #old

	alter table tbrecla_reclamo add idEmpReclamo int(10) after idProceReclamo; # old

	alter table tbrecla_reclamo add fechReclamo date after acciReclamo; # old

	alter table tbrecla_reclamo add idRespoReclamo int(10) after idPersoReclamo; # old

	alter table tbrecla_reclamo add bestado char(1) after fechReclamo; # old

	alter table tbrecla_reclamo add desReclamo varchar(2000) after idProceReclamo; # old

	alter table tbrecla_reclamo change desEmpReclamo idEmpReclamo int(10); # old

	alter table tbrecla_reclamo add correPor varchar(200) after bestado; #old

	alter table tbrecla_reclamo add detObsId int(11) after correPor; #new


	--------------------------------------------- RESTRICCION -------------------------------------------------
	alter table tbrecla_reclamo #old
	add constraint fk_idTipReclamo foreign key (idTipReclamo) references tbrecla_tipo_reclamo(idTipReclamo),
	add constraint fk_idEstaReclamo foreign key (idEstaReclamo) references tbrecla_estado_reclamo(idEstaReclamo);
	#add constraint fk_idProceReclamo foreign key (idProceReclamo) references tbrecla_proceso_reclamo(idProceReclamo);

	alter table tbrecla_reclamo #new
	add constraint fk_detObsId foreign key (detObsId) references tbrecla_detObs(detObsId);

	/*-----------------------------------------*/
		# TABLE TIPO
	/*-----------------------------------------*/

	create table tbrecla_tipo_reclamo
	(
	idTipReclamo int(10) primary key auto_increment not null,
	desTipReclamo varchar(50)
	);

	---------------- CONSTANTES -------------------------
	/* 
		Tipos:
		--------
		garantia
		postventa
	*/

	/*--------------------------------------------*/
		# TABLE ESTADO
	/*-------------------------------------------*/

	create table tbrecla_estado_reclamo
	(
	idEstaReclamo int(10) primary key auto_increment not null,
	desEstaReclamo varchar(50)
	);

	------------------------- CONSTANTES ------------------------------
	/* 
		Estados:
		--------
		enviado
		aceptado
		rechazado
		por confirmar
		solucionado
		no enviado
	*/

	/*---------------------------------------------*/
		# TABLE TIPO DE OBSERVACION
	/*--------------------------------------------*/

	create table tbrecla_tipObs
	(
		tipObsId int(11) auto_increment not null primary key,
		desObs varchar(25)
	);

	------------------- CONSTANTES ------------------------
	/*
		tipos:
		------
			externo
			interno
	*/

	/*-----------------------------------------------*/
		# TABLE DETALLE OBSERVACION
	/*-----------------------------------------------*/

	create table tbrecla_detObs
	(
		detObsId int(11) auto_increment not null primary key,
		tipObsId int(11),
		desDetObs varchar(25)
	);

	-------------------- CONSTANTES ---------------------------------
	/*
		externo:
		--------
			queja
			reclamo

		interno:
		--------
			inspeccion
			auditoria
			reporte

	*/

	----------------------RESTRICCIONES--------------------------------------------

	alter table tbrecla_detObs #new
	add constraint fk_tipObsId foreign key (tipObsId) references tbrecla_tipObs(tipObsId);

	/*-----------------------------------------------*/
		# PERSISTENCIA
	/*-----------------------------------------------*/

	create table tbrecla_proceso_reclamo
	(
	idProceReclamo int(10) primary key auto_increment not null,
	desProceReclamo varchar(50)
	);

	select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vendedor,per.persona_id 
	from persona as per,trabajador as trab,perfil as perf where per.persona_id=trab.persona_id and
	trab.perfil_id = perf.perfil_id and perf.perfil_id=6;

	select emp.emp_nombre,emp.empresa_id from empresa as emp,empresa_perfil as perf,anfi_empresa as anf
	where anf.empresa_id=emp.empresa_id and anf.emp_perfil_id=perf.empresa_perfil_id and 
	anf.emp_perfil_id=1;

	select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as contacto,per.persona_id
	from persona as per,contacto as contac,empresa as emp where contac.persona_id=per.persona_id and 
	contac.empresa_id and emp.emp_nombre='ALE CONTRATISTAS S.A.';

	select 
	/*
		recla.tbrecla_reclamo_id,
		recla.idTipReclamo,
		recla.idPersoReclamo,
		recla.idRespoReclamo,
		recla.idEstaReclamo,
		recla.idContacReclamo,
		recla.idProceReclamo,
		recla.desReclamo,
		recla.acciReclamo,
		recla.fechReclamo,
		recla.bestado
	*/ 
	* from tbrecla_reclamo as recla inner join contacto as contac on recla.idContacReclamo=contac.contacto_id
	inner join empresa as emp on contac.empresa_id=emp.empresa_id where emp.emp_nombre like "%min%";

	select 
	/*
		recla.tbrecla_reclamo_id,
		recla.idTipReclamo,
		recla.idPersoReclamo,
		recla.idRespoReclamo,
		recla.idEstaReclamo,
		recla.idContacReclamo,
		recla.idProceReclamo,
		recla.desReclamo,
		recla.acciReclamo,
		recla.fechReclamo,
		recla.bestado
	*/ 
	* from tbrecla_reclamo as recla inner join persona as per on recla.idRespoReclamo=per.persona_id where 
	concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) like '%alex%';

	select * from tbvisi_visita where tbvisi_visita_id=12; #old

	select mon.mon_nombre from moneda as mon,tbvisi_visita as visi where mon.moneda_id=visi.moneda_id 
	and tbvisi_visita_id=1; #old

	# query reporte reclamos

			SELECT 
			recla.desReclamo as des,
			recla.acciReclamo as acciOrde,
			recla.acciReliReclamo as acciReli,
			recla.fechReclamo as fechRecla,
			emp.emp_nombre as empNom,
			concat(per2.pers_nombres,' ',per2.pers_apepat,
				  ' ',per2.pers_apemat) as recep,
			concat(per1.pers_nombres,' ',per1.pers_apepat,
				  ' ',per1.pers_apemat) as respo
			FROM 
			`tbrecla_reclamo` as recla,
			empresa as emp,
			persona as per1,
			persona as per2,
			trabajador as trab
			where 
			emp.empresa_id=recla.idEmpReclamo and
			recla.idPersoReclamo=trab.trabajador_id and
			trab.persona_id=per2.persona_id and
			recla.idRespoReclamo=per1.persona_id;

	# obtener los tipos de observacion de reclamos [recla_tipObs]

			select
			tipObsId as id,
			desObs as tip
			from tbrecla_tipObs;

	# obtener las observaciones por el tipo de observacion [recla_obsxTip]

			select
			detObsId as id,
			desDetObs as des
			from tbrecla_detObs where tipObsId=1;

	# obtener el id de la observacion y el tipo [recla_obsTipxId]

			select
			detObsId as idObs,
			tipObsId as tipObs
			from tbrecla_detObs
			where detObsId='';

/*-------------------------------[*]---------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	#SQL MODULO VISITAS
/*-------------------------------------------------------------------------------------------------------*/

	/*
		tbvisi_visita
		tbvisi_detalle_visita
	*/

	create table tbvisi_visita
	(
		tbvisi_visita_id int(10) not null auto_increment primary key,
		idVendeVisita int(10),
		fechIniVisi date,
		fechFinVisi date,
		moneda_id int(10),
		/* nuevos campos para requerimiento*/
		pasaVisi double(20,2),
		hospeVisi double(20,2),
		alimeVisi double(20,2),
		transInterVisi double(20,2)
	);

	create table tbvisi_detalle_visita
	(
		idDetVisita int(10) not null auto_increment primary key,
		tbvisi_visita_id int(10),
		idContacVisita char(50),
		idEmpVisita int(10),
		#desEmpVisita varchar(200),
		obsVisita varchar(2000),
		obsPenVisita varchar(2000),
		direVisi varchar(200)
	);

	/*--------------- Add table detalle pasaje a modelo -------------------------*/

	create table tbvisi_detPasj
	(
		tbvisi_detPasjId int(10) not null auto_increment primary key,
		tbvisi_visita_id int(10),
		tbvisi_des varchar(200),
		tbvisi_mont decimal(10,2)
	);

	/* -----------------------------[*]------------------------------------------ */

	/*----------Add columns fecha & direccion----------*/

	alter table tbvisi_detalle_visita
	add dirVisiOrig varchar(200) after direVisi,
	add fechVisi date after direVisiOrig;

	/*-------------------------------------------------*/

	/*----------------- Add column mont to table detail visita  -------------------*/

	alter table tbvisi_detalle_visita
	add montVisi decimal(10,2) after fechVisi;

	/*------------------[*]------------------------*/


	alter table  tbvisi_detalle_visita
	add constraint fk_tbvisi_visita_id foreign key(tbvisi_visita_id) references tbvisi_visita(tbvisi_visita_id);

	alter table tbvisi_detalle_visita add desEmpvisita varchar(200) after idContacVisita; #old

	alter table tbvisi_detalle_visita change desEmpvisita desEmpVisita varchar(200); #old

	alter table tbvisi_detalle_visita add idEmpVisita int(10) after idContacVisita; #old

	alter table tbvisi_detalle_visita add obsPenVisita varchar(2000) after obsVisita; #old

	alter table tbvisi_detalle_visita change obsVisitaPen obsPenVisita varchar(2000);	#old

	alter table tbvisi_detalle_visita change idContacVisita idContacVisita char(50);	#old

	select pers_mail from persona where concat(pers.nombres,' ',pers.apepat,' ',pers.apemat)='Ulises Ubillus Galarreta'; #old

	alter table tbvisi_visita add moneda_id int(10) after fechFinVisi; #old

	alter table tbvisi_visita add pajaVisi double(20,2) after moneda_id; #old

	alter table tbvisi_visita add hospeVisi double(20,2) after pajaVisi; #old

	alter table tbvisi_visita add alimeVisi double(20,2) after hospeVisi; #old

	alter table tbvisi_visita add transInterVisi double(20,2) after alimeVisi; #old

	alter table tbvisi_visita change pajaVisi pasaVisi double(20,2); #old

	update tbvisi_visita set moneda_id=1,pasaVisi=20,hospeVisi=20,alimeVisi=20,
	transInterVisi=20 where tbvisi_visita_id=8; #old

	insert into empresa (emp_ruc,emp_nombre,emp_email,emp_web,emp_direccion,emp_telef) values ('1223','jose','ss','ss','ss','ss'); #old

	alter table tbvisi_visita add direVisi varchar(200) after transInterVisi; #old

	alter table tbvisi_visita drop column direVisi; #old

	alter table tbvisi_detalle_visita add direVisi varchar(200) after obsPenVisita; #old


	# query reporte visitas

			select
			detVisi.obsVisita as obs,
			detVisi.obsPenVisita as obsPen,
			detVisi.direVisi as dire,
			emp.emp_nombre as emp,
			concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vend
			from 
			tbvisi_detalle_visita as detVisi,
			empresa as emp,
			tbvisi_visita as visi,
			persona as per
			where 
			detVisi.idEmpVisita=emp.empresa_id
			and detVisi.obsVisita!='ee' and
			visi.tbvisi_visita_id=detVisi.tbvisi_visita_id and
			visi.idVendeVisita=per.persona_id;

	/* PERSISTENCIA VISITAS */

		# PROCEDURE - CRUD

			/*C*/
			/*R*/

				# obtener visitas por vendedor [vi_visixVend_obte] -> OK

					DELIMITER $$
					create procedure vi_visixVend_obte($idVende int(11),$fechVisi date)
					COMMENT 'obtener visitas por vendedor'
					BEGIN
						/* vars */
						set @id=$idVende;
						set @fech=$fechVisi;
						set @fechValid=DATEDIFF($fechVisi,Now());

						if ISNULL(@fechValid) then

							/* obte visi */
							SELECT 
							tbvisi_visita_id as vi_visiId,
							fechIniVisi as vi_fechIni,
							fechFinVisi as vi_fechFin,
							visiCorre as vi_corre,
							(select concat(per.pers_nombres,' ',per.pers_apepat) from persona as per where 
							 idVendeVisita=per.persona_id) as vi_resp
							FROM `tbvisi_visita` as visi where idVendeVisita=$idVende;

						else

							/* obte visi */
							SELECT 
							tbvisi_visita_id as vi_visiId,
							fechIniVisi as vi_fechIni,
							fechFinVisi as vi_fechFin,
							visiCorre as vi_corre,
							(select concat(per.pers_nombres,' ',per.pers_apepat) from persona as per where 
							 idVendeVisita=per.persona_id) as vi_resp
							FROM `tbvisi_visita` as visi where idVendeVisita=$idVende and
							($fechVisi between fechIniVisi and fechFinVisi);

						end if;

					end;

				# iniciar visita por id [vi_visixId_ini] -> OK

					DELIMITER $$
					create procedure vi_visixId_ini($idVisi int(11))
					COMMENT 'iniciar visita por id'
					BEGIN
						/*vars*/

						/*ini visi*/

						SELECT 
						idDetVisita as idDet,
						(select emp_nombre from empresa where empresa_id=det.idEmpVisita) as empresa,
						idContacVisita as contacto,
						obsVisita as obsActi,
						obsPenVisita as obsPen,
						fechVisi as vi_fechVi,
						dirVisiOrig as vi_dirOri,
						direVisi as vi_dirEmp
						FROM `tbvisi_detalle_visita` as det where tbvisi_visita_id=$idVisi;

					end;

				# obtener visita general por id [vi_visiGenxId_obte]

					DELIMITER $$
					create procedure vi_visiGenxId_obte($idVisi int(11))
					COMMENT 'obtener visita general por id'
					BEGIN
						/*vars*/

						/*obte visi*/
						select * from tbvisi_visita where tbvisi_visita_id=$idVisi;

					end;

			/*U*/
			/*D*/


		# FUNCTION - CRUD

			/*C*/

				# ingresar detalle de visitas [vi_detVi_cre] -> OK

					# reutilizable
			
			/*R*/

				# obtener contacto por id [vi_contactxId_obte] -> OK

					DELIMITER $$
					create function vi_contactxId_obte($idContac int(11))
					RETURNS varchar(50)
					COMMENT 'obtener contacto por id'
					BEGIN
						/*vars*/
						declare $contacDes varchar(50);

						/*obte contact*/
						set $contacDes=(select concat(per.pers_nombres,' ',per.pers_apepat) 
										from persona as per where persona_id=$idContac);

						/*return*/
						return $contacDes;

					end;

			/*U*/

				# actualizar datos generales visita [vi_visiGen_actu] -> OK

					DELIMITER $$
					create function vi_visiGen_actu($fechIni date,
													$fechFin date,
													$moneId int(11),
													$pasaVisi decimal(10,2),
													$hospeVisi decimal(10,2),
													$alimeVisi decimal(10,2),
													$transInter decimal(10,2),
													$visiId int(11))
					RETURNS int(11)
					COMMENT 'actualizar datos generales visita'
					BEGIN

						/*vars*/
						declare $rowAfect int(11);

						/*actu visi gen*/
						update tbvisi_visita set fechIniVisi=$fechIni,
												 fechFinVisi=$fechFin,
												 moneda_id=$moneId,
												 pasaVisi=$pasaVisi,
												 hospeVisi=$hospeVisi,
												 alimeVisi=$alimeVisi,
												 transInterVisi=$transInter
												 where tbvisi_visita_id=$visiId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

				# actualizar detalle gastos visita [vi_detGast_actu]

					DELIMITER $$
					create function vi_detGast_actu($detVisiId int(11),$montVisi decimal(10,2))
					RETURNS int(11)
					COMMENT 'actualizar detalle gastos visita'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*actu det gast*/
						update tbvisi_detalle_visita set montVisi=$montVisi where idDetVisita=$detVisiId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;
					end;

			/*D*/

				# borrar detalle visita [vi_detVisi_borra] -> OK

					DELIMITER $$
					create function vi_detVisi_borra($idDet int(11))
					RETURNS int(11)
					COMMENT 'borrar detalle visita'
					BEGIN

						/*vars*/
						declare $rowAfect int(11);

						/*borra det visi*/
						delete from tbvisi_detalle_visita where idDetVisita=$idDet;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

				# borrar visita de responsable [vi_visiResp_borra]

					DELIMITER $$
					create function vi_visiResp_borra($visiId int(11))
					RETURNS int(11)
					COMMENT 'borrar visita de responsable'
					BEGIN

						/*vars*/
						declare $rowAfect int(11);

						/*borra visi*/
						delete from tbvisi_visita where tbvisi_visita_id=$visiId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

/*-----------------------------[*]-----------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	#SQL MODULO COTIZACIONES
/*-------------------------------------------------------------------------------------------------------*/

	UPDATE `tec-erp-2`.`tabla` SET `reg_accion1` = '2' WHERE `tabla`.`tabla_id` =205;

/*--------------------------[*]--------------------------------------------------------------------------*/

/* ------------------------------------------------------------------------------------------------------*/
	#SQL ESTRUCTURA RECURSO Y TRABAJADOR
/*-------------------------------------------------------------------------------------------------------*/

	/*
		omitir para creacion: CHARACTER SET latin1
		cambiar orden de creacion de vistas v_recurso y v_trabajador
	*/

	CREATE TABLE IF NOT EXISTS `recurso`;
	CREATE TABLE IF NOT EXISTS `trabajador`;

/*-------------------------[*]---------------------------------------------------------------------------*/

/* ------------------------------------------------------------------------------------------------------*/
	#SQL PARAMETROS COTIZACION ADJUDICADA
/*-------------------------------------------------------------------------------------------------------*/

	/*

		rotulos editados:
				cot_nro -> FL
				fecha -> fecha adjudica
				cot_fec -> cot_fec_adj | DATE_FORMAT(cot_fec_emis,'%d-%m-%y') -> DATE_FORMAT(cot_fec_adj,'%d-%m-%y')

		rotulos nuevos:

				moneda_id
				total

		columna de activacion:
		
				tbl_col_orden_lst
				

	*/

/*-------------------------------------------------------------------------------------------------------*/
	#SQL MODULO CUENTAS POR COBRAR
/*-------------------------------------------------------------------------------------------------------*/

	create table tbcu_cuxcobra(
		idCuxCobra int(10) not null auto_increment primary key,
		idEmpCli int(10),
		numCompro char(25),
		idTipMone int(10),
		idTipDoc int(10),
		impor decimal(20,2),
		descrip varchar(2000),
		fecha date
	);

	create table tbcu_det_cuxcobra(
		idDetxCobra int(10) not null auto_increment primary key,
		idCuxCobra int(10),
		fecha date,
		monto decimal(20,2),
		idCuBanco int(10),
		idCuEstado int(10)
	);

	create table tbcu_tipdoc
	(
		idTipDoc int(10) not null auto_increment primary key,
		descrip varchar(50)
	);

	create table tbcu_esta
	(
		idCuEstado int(10) not null auto_increment primary key,
		descrip varchar(50)
	);

	alter table tbcu_det_cuxcobra
	add constraint pk_idCuxCobra foreign key (idCuxCobra) references tbcu_cuxcobra(idCuxCobra),
	add constraint pk_idCuEstado foreign key (idCuEstado) references tbcu_esta(idCuEstado);

	alter table tbcu_cuxcobra
	add constraint pk_idTipDoc foreign key (idTipDoc) references tbcu_tipdoc(idTipDoc);

	/*  
		tipDoc:
		-------
				factura,
				boleta,
				ticket,
				por facturar,
				cuotas,
				letras

		estaCuen:
		---------
				pendiente,
				cancelado
	*/
 
	
	select distinct cuen.cuenta_nro,cuen.cuenta_id from v_cuenta as cuen,tbcu_det_cuxcobra as detxcobra, 
	banco as ban where cuen.banco_id=ban.banco_id and cuen.banco_id=1;

	SELECT * FROM `tbcu_cuxcobra` where idCuxCobra=1;

/*----------------------------------[*]------------------------------------------------------------------*/

/* ------------------------------------------------------------------------------------------------------*/
	#ESTRUCTURA SQL DEL MODULO OBSERVACION
/*-------------------------------------------------------------------------------------------------------*/ 

	/*
		- id de la tupla observacion -> (idObs) ! pk ----------------------------------------------------[OK]
		- tipo de observacion: reclamo, queja -> (idTipObs)----------------------------------------------[OK]  
		- correlativo informe -> (numInfor) ! generado a partir del pk-----------------------------------[OK]
		- fecha de control -> (fechContro)---------------------------------------------------------------[OK]
		- acciones correctivas / preventivas -> (acciCorre)----------------------------------------------[OK]
		- responsable a cargo -> (idRespCarg) ! fk de la tupla persona-----------------------------------[OK]
		- fecha limite para completar la accion correctiva / preventiva -> (fechLim)---------------------[OK]
		- fecha de verificacion de implementacion -> (fechVeri) -----------------------------------------[OK]
		- implementacion satisfactoria: si,no -> (idConforImp)-------------------------------------------[OK]
		- fecha acordada para verificacion -> (fechAcorVeri) --------------------------------------------[OK]
		- fecha de verificacion de efectividad -> (fechVeriEfec) ----------------------------------------[OK]
		- efectividad satisfactoriia: si,no -> (idConforEfec) ! fk de la tupla conformidad---------------[OK]
		- fecha de efectividad satisfatoria -> (fechEfecSati) -------------------------------------------[OK]
		- evidencia objetiva -> (eviObje) ---------------------------------------------------------------[OK]
		- fecha cierre no conformidad -> (fechCie) ------------------------------------------------------[OK]
		- fecha seguimiento de auditoria interna -> (fechSegui) -----------------------------------------[OK]
		- ac efectiva : si,no -> (idConforAc) -> ! fk de la tupla conformidad ---------------------------[OK]
		- codigo de formato -> (idCodFormat) ! fk de la tupla Formato -----------------------------------[OK]
		- versiones de documento -> (idCodVersi) ! fk de la tupla version -------------------------------[OK]
		- paginas de documento -> (idCodPag) ! fk de la tupla paginas -----------------------------------[OK]
	*/

	#-----------------------------------------------------------------------------------------------------

	/*
		- comentario -> (comen) -------------------------------------------------------------------------[OK]
		- solucion inmediata -> (soluInme) --------------------------------------------------------------[OK]
		- cliente -> (idEmp) -> fk de la tupla empresa --------------------------------------------------[OK]
		- contacto -> (idContac) -> fk de la tupla persona-----------------------------------------------[OK]
	*/

	#------------------------------------------------------------------------------------------------------

	/*
		- id del usuario que inicio la sesion -> (idUsuSesi) --------------------------------------------[OK]
	*/

	/*
		NOMBRES  TUPLAS DEL MODULO OBSERVACION: 
		---------------------------------------
		- tbobs_observ
		- tbobs_tip_observ
		- tbobs_conforImp
		- tbobs_conforEfec
		- tbobs_conforAc
		- tbobs_format
		- tbobs_versi
		- tbobs_pag


		TUPLAS USADAS YA CREADAS:
		-------------------------
		- empresa
		- persona
		- trabajador
		- contacto
	*/

	create table  tbobs_observ(
	idObserv int(10) primary key not null auto_increment,
	idTipObs int(10),
	numInfor char(20),
	idRespCarg int(10),
	idConforImp int(10),
	idConforEfec int(10),
	idConforAc int(10),
	idUsuSesi int(10),
	idEmp int(10),
	idContac int(10),
	idCodFormat int(10),
	idCodVersi int(10),
	idCodPag int(10),
	fechContro date,
	acciCorre varchar(2000),
	fechLim date,
	fechVeri date,
	fechAcorVeri date,
	fechVeriEfec date,
	fechEfecSati date,
	eviObje varchar(2000),
	fechCie date,
	fechSegui date,
	desObserv varchar(1000),
	soluInme varchar(1500)
	);

	create table tbobs_conforImp(
	idConforImp int(10) primary key not null auto_increment,
	desConfir char(2)
	);

	create table tbobs_conforEfec(
	idConforEfec int(10) primary key not null auto_increment,
	desConfir char(2)
	);

	create table tbobs_conforAc(
	idConforAc int(10) primary key not null auto_increment,
	desConfir char(2)
	);

	create table tbobs_tip_observ(
	idTipObserv int(10) primary key not null auto_increment,
	desTipObser varchar(20)
	);

	create table tbobs_format(
	idCodFormat int(10) primary key not null auto_increment,
	correCodFormat char(15)
	);

	create table tbobs_versi(
	idCodVersi int(10) primary key not null auto_increment,
	desVersi varchar(20)
	);

	create table tbobs_pag(
	idCodPag int(10) primary key not null auto_increment,
	numPag int(10)
	);

	/*------ Restricciones ------*/

	alter table tbobs_observ
	add constraint fk_idConforImp foreign key (idConforImp) references tbobs_conforImp(idConforImp),
	add constraint fk_idConforEfec foreign key (idConforEfec) references tbobs_conforEfec(idConforEfec),
	add constraint fk_idConforAc foreign key (idConforAc) references tbobs_conforAc(idConforAc),
	add constraint fk_idTipObs foreign key (idTipObs) references tbobs_tip_observ(idTipObserv),
	add constraint fk_idCodFormat foreign key (idCodFormat) references tbobs_format(idCodFormat),
	add constraint fk_idCodVersi foreign key (idCodVersi) references tbobs_versi(idCodVersi),
	add constraint fk_idCodPag foreign key (idCodPag) references tbobs_pag(idCodPag);

	alter table tbobs_observ change comen desObserv varchar(1000);

	/*
		tbobs_conforImp
			- si
			- no
		tbobs_conforEfec
			-si
			-no
		tbobs_conforAc
			-si
			-no
		tbobs_tip_observ
			-reclamo
			-queja
	*/

/*---------------------------------[*]-------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	#ANALISIS DE CAMPOS DEL MODULO REPORTES DE COMPRAS
/*-------------------------------------------------------------------------------------------------------*/

	/*
		item:
			des:pk autogenerado
		N° de orden:
			des:fk ew 
		tipo de pedido:
			des:fk tip(local,internacional)
		fecha de ew:
			des:fecha
		proveedor:
			des:fk prov 
		cliente:
			des:fk cli
		equipo:
			des:fk prod
		monto de orden de compra:
			des:monto oc
		monto del ew:
			des:monto ew
		inc ote rms:
			des:fk tip(cif,fob)
		fecha de entrega al cliente:
			des:fecha entrega
		fecha de embarque:
			des:fecha embarque
		fecha de llegada:
			des:fecha llegada
		comentario:
			des:comentario
		riesgo de retraso:
			des:riesgo retraso
		N° FL:
			des:fk FL
		fwdr:
			des:
		estado:
			des:fk estado(entrega,entragdo)
		ing. a cargo:
			des:fk personal
	*/

	SELECT *
	FROM `compras`
	WHERE comp_nro LIKE '%EW%';

	SELECT *
	FROM `compras`
	WHERE comp_nro LIKE '%EW%' and date_format(comp_fecha_ini,'%Y')=2013;

	SELECT * , empresa.emp_nombre
	FROM `compras` , empresa
	WHERE compras.comp_nro LIKE '%EW%'
	AND date_format( comp_fecha_ini, '%Y' ) =2013
	AND empresa.empresa_id = compras.proveedor_id;


	SELECT distinct comp.compras_id as Item,emp.emp_nombre as cliente, comp.comp_nro as EW, 
	date_format( comp.comp_fecha_ini, '%d/%m/%Y' ) as fecha, (
	CASE
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =1
	)
	THEN 'ENERO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =2
	)
	THEN 'FEBRERO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =3
	)
	THEN 'MARZO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =4
	)
	THEN 'ABRIL'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =5
	)
	THEN 'MAYO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =6
	)
	THEN 'JUNIO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =7
	)
	THEN 'JULIO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =8
	)
	THEN 'AGOSTO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =9
	)
	THEN 'SETIEMBRE'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =10
	)
	THEN 'OCTUBRE'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =11
	)
	THEN 'NOVIEMBRE'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =12
	)
	THEN 'DICIEMBRE'
	ELSE ''
	END
	) AS mes, format(sum( prod_precio_venta ),2) AS monto,mon_sigla as mon,
	(case
	when (mon.moneda_id=1) then format(sum( prod_precio_venta/2.808),2)
	when (mon.moneda_id=2) then format(sum( prod_precio_venta ),2)
	when (mon.moneda_id=3) then format((sum(prod_precio_venta)/0.731035),2) else '' end) AS montoDolares,
	'$' as moneDolar
	FROM `compras` AS comp, empresa AS emp, compras_detalle AS detComp,moneda as mon
	WHERE (comp.comp_nro LIKE '%OC-2014%' or comp.comp_nro LIKE '%EW-2014%')
	AND (date_format( comp.comp_fecha_ini, '%Y' ) =2013 or date_format( comp.comp_fecha_ini, '%Y' ) =2014)
	AND emp.empresa_id = comp.proveedor_id
	AND comp.compras_id = detComp.compras_id
	and detComp.moneda_id=mon.moneda_id
	and CHAR_LENGTH(comp.comp_nro)=14
	and detComp.bestado=1
	and comp.bestado=1
	group BY comp.compras_id order by emp.emp_nombre;

	# agregar el campo prod_descripcion_obre

	alter table compras_detalle add prod_descripcion_obra varchar(100) after `comp_det_adjudicado`;

/*--------------------------------[*]--------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	#MODULO DE COTIZACIONES
/*-------------------------------------------------------------------------------------------------------*/


	/* PRECALCULO */

	select
				prof.imp_prof_nro as numFl,
				prof.imp_proforma_id as codFl
				from
				imp_proforma_detalle as profDet,
				imp_proforma as prof,
				cotizacion as cotiz,
				cot_detalle as cotDet
				where
				cotiz.cotizacion_id=1488 and
				cotiz.cotizacion_id=cotDet.cotizacion_id and
				cotDet.cot_detalle_id=profDet.cot_detalle_id and
				profDet.imp_proforma_id=prof.imp_proforma_id and
			   	cotiz.bestado=1 and (profDet.bestado=1 or profDet.bestado=null)
			   	GROUP BY cotDet.cot_detalle_id;


	select
				#prof.imp_proforma_id as profId,
				sum(profDet.prod_ew_valor) as exwork,
				sum(profDet.prod_fob_valor) as fob,
				sum(profDet.prod_cif_valor) as cif,
				sum(profDet.prod_cif_valor+profDet.prod_nac_valor) as ddp
				from
				imp_proforma_detalle as profDet,
				imp_proforma as prof,
				cotizacion as cotiz
				where
				cotiz.cotizacion_id=1488 and
				cotiz.cotizacion_id=prof.cotizacion_id and
				profDet.imp_proforma_id=prof.imp_proforma_id and
			   	cotiz.bestado=1 and (profDet.bestado=1 or profDet.bestado=null)
			   	GROUP BY prof.imp_proforma_id;


	select
				#prof.imp_proforma_id as profId,
				sum(profDet.prod_ew_valor) as exwork,
				sum(profDet.prod_fob_valor) as fob,
				sum(profDet.prod_cif_valor) as cif,
				sum(profDet.prod_cif_valor+profDet.prod_nac_valor) as ddp
				from
				imp_proforma_detalle as profDet,
				imp_proforma as prof,
				cotizacion as cotiz
				where
				cotiz.cotizacion_id=prof.cotizacion_id and
				profDet.imp_proforma_id=prof.imp_proforma_id and
				prof.imp_proforma_id=1130 and
			   	cotiz.bestado=1 and (profDet.bestado=1 or profDet.bestado=null)
			   	GROUP BY prof.imp_proforma_id;

	/* FL DE COTIZACIONES */

	SELECT coti.cot_nro, coti.cot_fec_emis, emp.emp_nombre, proye.proy_nombre,
	concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vende,
	(CASE
	WHEN (
	date_format( coti.cot_fec_emis, '%m' ) =1
	)
	THEN 'ENERO'
	WHEN (
	date_format( coti.cot_fec_emis, '%m' ) =2
	)
	THEN 'FEBRERO'
	ELSE ''
	END
	) AS mes,
	cotEst.cot_estado_nombre as cotEstDes
	FROM `cotizacion` AS coti
	INNER JOIN cot_estado as cotEst ON coti.cot_estado_id=cotEst.cot_estado_id
	INNER JOIN proyecto AS proye ON coti.proyecto_id = proye.proyecto_id
	INNER JOIN empresa AS emp ON coti.cliente_id = emp.empresa_id
	inner join trabajador as trab on trab.trabajador_id=coti.operador_id
	inner join persona as per on trab.persona_id=per.persona_id
	WHERE date_format( coti.cot_fec_emis, '%Y' ) = '2014' and coti.empresa_id=1
	and coti.bestado=1 and date_format( coti.cot_fec_emis, '%m' )>=1;

	/* redonde que detalle de cotizaciones */

		# round(pro_precio_venta)

	/* FLUJO NUEVA VERSION DE COTIZACION */

		# obtener la cotizacion por id y añadirla

		# obtener correlativo y modificar version

		# actualizar version con correlativo nuevo

		# obtener detalle de cotizacion por id

	/* FLUJO NUEVA SERIE DE COTIZACION */

	/* Añadir ROW probabilidad a tupla cotizacion */

		alter table cotizacion
		add cot_probabilidad decimal(10,2) after cot_fec_adj;

	/* New update 07/01/2015 - CLOSE */

		#PROCEDURE

			#C
			#R
			#U
			#D

		#FUNCTION

			#c
			#R
			#U
				#Ordenar items de cotizacion [cot_itemCot_ord] -> OK

					DELIMITER $$
					create function cot_itemCot_ord($detId int(11),$ordVal int(11))
					RETURNS int(11)
					COMMENT 'Ordenar items de cotizacion'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*ord items*/
						update cot_detalle as det set det.cot_det_orden=$ordVal where cot_detalle_id=$detId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;
					end;
			#D


/*------------------------------[*]----------------------------------------------------------------------*/
	
/* ------------------------------------------------------------------------------------------------------*/
	#ACTUALIZACION DEL MODULO DE ORDER DE COMPRAS
/* ------------------------------------------------------------------------------------------------------*/

	# añadir campo descuento a formulario ordenes

	# añadir el campo coti_fl en compras

		alter table compras 
		add column coti_fl int(10) after comp_version;

/*-------------------------------------------------------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------*/
	# MODULO VACACIONES
/* -------------------------------------------------------------------------------------------------------*/

	/*
		vaca_perioAn
			- 2012,2013,2014,2015
		vaca_area
			- administracion
			- comercial
			- tecnica
		vaca_vaca
			- mes goze ini
			- mes goze fin
			- trabajador
			- administrador que autorizo
			- fecha de autorizacion
			- periodo
			- areTrab
		vaca_traba
			- area
		vaca_estado
			- activo
			- inactivo

		Edicion, actualizacion y cambios de tablas

			# 1. añadir el registro "TECNICO" en tupla (trab_funcion)
	*/

	create table vaca_perioAn(
		vaca_perioAn_id int(11) primary key auto_increment not null,
		vaca_anPeri int(4),
		vaca_desPeri varchar(50),
		vaca_estado_id int(11)
	);

	create table vaca_vaca(
		vaca_vaca_id int(11) primary key auto_increment not null,
		vaca_mesGocIni date,
		vaca_mesGocFin date,
		vaca_trabId int(11),
		vaca_userAdm int(11),
		vaca_fechAuto date,
		vaca_perioAn_id int(11),
		vaca_areTrab int(11),
		vaca_forCal int(11),
		vaca_numFinSem int(11)
	);

	create table vaca_estado(
		vaca_estado_id int(11) primary key auto_increment not null,
		vaca_estDescrip varchar(15)
	);

	# restriccion foreing key "vaca_estado"
	alter table vaca_perioAn
	add constraint pk_vaca_estado_id foreign key (vaca_estado_id) references vaca_estado(vaca_estado_id);

	# restriccion foreign key "vaca_vaca"
	alter table vaca_vaca
	add constraint pk_vaca_perioAn_id foreign key (vaca_perioAn_id) references vaca_perioAn(vaca_perioAn_id);

	# cambio del nombre del campo 'vaca_tabId'
	alter table vaca_vaca change vaca_tabId vaca_trabId int(11);

	# añadir nuevo campo 'vaca_perioAn_id'
	alter table vaca_vaca add vaca_areTrab int(11) after vaca_perioAn_id;
	alter table vaca_vaca add vaca_areTrab int(11) first;

	# añadir campo de forma de calculo
	alter table vaca_vaca add vaca_forCal int(11) after vaca_areTrab;

	# añadir campo estado vacaciones
	alter table vaca_perioAn add vaca_estado_id int(11) after vaca_desPeri;


	/* Periodo de Trabajador */
	SELECT
	vaca.vaca_mesGocIni,
	peri.vaca_anPeri,
	DATEDIFF(vaca.`vaca_mesGocFin`,vaca.`vaca_mesGocIni`) as diGoc,
	(case when (DATEDIFF(vaca.`vaca_mesGocFin`,CURDATE())<0) then '0' 
	 else DATEDIFF(vaca.`vaca_mesGocFin`,CURDATE()) end) as diPen,
	concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as trab
	 FROM 
	 `vaca_vaca` as vaca,persona as per,vaca_perioan as peri 
	 where per.persona_id=vaca.vaca_trabId and
	 vaca.vaca_perioAn_id=peri.vaca_perioAn_id
	 and peri.vaca_anPeri='2012';

	# adicionar un año a fecha
		select vaca_mesGocIni as fechOri,DATE_ADD(vaca_mesGocIni,INTERVAL 1 YEAR) as fechModi from vaca_vaca where vaca_vaca_id=22;

		select trab.trab_fec_ini as fechOri,date_format(DATE_ADD(trab.trab_fec_ini,INTERVAL 1 YEAR),'%d/%m/%Y') as fechModi 
		from persona as per,trabajador as trab 
		where per.persona_id=trab.persona_id and per.persona_id=18;

	# sql para evaluar dias de vacaciones asignados a trabajador 
		select sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1) as sumDi from vaca_vaca where vaca_perioAn_id='3' and vaca_trabId='448';

	# sql obtener la forma de calculo
		SELECT distinct vaca_forCal FROM `vaca_vaca` where vaca_trabId='448' and vaca_perioAn_id='3';

	# sql evaluar si existen dias asignados en el periodo
		select case when (isNull(sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1))) then '0' 
		else sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1) end as sumDi 
		from vaca_vaca where  vaca_trabId='360' and vaca_perioAn_id='3';

		select 
		case 
		when (isNull(sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1))) then '0'
		when ((sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1))<vaca_forCal) then sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1) 
		else sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1) end as sumDi 
		from vaca_vaca where  vaca_trabId='360' and vaca_perioAn_id='3';

	# sql evaluar dias habiles y no habiles
		select DATEDIFF('2014-03-31','2014-03-01')+1 as difDias,'2014-03-01' as fechIni,'2014-03-31' as fechFin;

	# sql incrementar dia y obtener nombre del dia
		select DATE_ADD('2014-03-31',INTERVAL 1 DAY) as fechIncre,DAYNAME(DATE_ADD('2014-03-31',INTERVAL 1 DAY)) as nomDia;

/*-----------------------------[*]------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------*/
	# MODULO EMPRESA 
/*--------------------------------------------------------------------------------------------------------*/

	# reporte de clientes y proveedores

	SELECT distinct emp.emp_ruc,emp.emp_nombre,emp.emp_web,emp.emp_direccion,emp.emp_telef,perf.nombre 
	FROM `empresa` as emp,
	anfi_empresa as anf,
	empresa_perfil as perf
	where 
	anf.empresa_id=emp.empresa_id and
	perf.empresa_perfil_id=anf.emp_perfil_id;

/*-------------------------[*]----------------------------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------*/
	# MODULO CENTRO DE COSTO
/* -------------------------------------------------------------------------------------------------------*/

	 	/*

		FL->sg,mf,sgc
		OC->ew,oc 

		Centro de costo
		----------------
		correlativo centro de costo: pc-0075
		cotizacion: fl
		nombre del cliente
		producto:item,producto,cantidad,total,proveedor,plazo,total  
		monto
		o/c cliente externo
		o/c fecha cliente
		fecha o/c
		generar ew int
		generar ew nac
		generar ew o/s

		centro de costo -> oc o ew
		--------------------------
		ew
		pc
		proveedor
		producto:item,producto,cantidad,total,proveedor,plazo,total

		centro de costo ( resultado ) -> o/c, cuanto gasto, cuanto gano
		centro de costo ( resultado ) -> conocer la rentabilidad de los productos

		*/

		# Obtener las marcas y modelos de productos
		select concat((select m.mm_alias from mm m where (m.mm_id=mm.mm_id_padre)),'. ',mm.mm_nombre) as marca_modelo,
		(select m.mm_alias from mm m where (m.mm_id=mm.mm_id_padre)) as marca,mm.mm_nombre as modelo from mm where (mm.mm_id_padre > 0);

		# Obtener FL adjudicadas de electrowerke 
		select cotizacion_id,cot_nro from cotizacion where cot_estado_id='2' and empresa_id='1' and bestado=1;

		# Obtener todos los productos validos
		SELECT prod_nombre FROM `producto` where marca_id>0 and modelo_id>0 and empresa_id=1 and bestado=1;

		SELECT prod_nombre FROM `producto` where empresa_id=1;

		# obtener general de fl  
		SELECT emp.emp_nombre,coti.cot_descrip,coti.cot_nro,proye.proy_nombre,coti.cotizacion_id  FROM cotizacion as coti,empresa as emp,proyecto as proye
		WHERE coti.cot_nro LIKE '%FL-12-0248-3%' and coti.cliente_id=emp.empresa_id and coti.proyecto_id=proye.proyecto_id;

		# obtener detalle de fl
		SELECT
		cotDet.cot_detalle_id as cotDetId,
		cotDet.cotizacion_id,
		prod.producto_id as prodId,
		(select marca_id from producto where producto_id=prodId) as marcaId,
		(select modelo_id from producto where producto_id=prodId) as modeloId,
		prodClas.prod_clasif_nombre,
		prod.prod_nombre,
		(select mm_nombre from mm where mm_id=marcaId) as marca,
		(select mm_nombre from mm where mm_id=modeloId) as modelo,
		(select distinct emp.emp_nombre from empresa as emp,imp_proforma_detalle as profDet,cot_detalle as cotDet,imp_proforma as prof
		where emp.empresa_id=prof.proveedor_id and prof.imp_proforma_id=profDet.imp_proforma_id and profDet.cot_detalle_id=cotDetId) as proveedor,
		mone.mon_sigla,
		cotDet.pro_cantidad as cant,
		cotDet.pro_precio_venta as preUni,
		cotDet.pro_subtotal as subTot
		FROM 
		cot_detalle as cotDet, 
		producto as prod,
		moneda as mone,
		prod_clasificacion as prodClas
		WHERE 
		cotDet.cotizacion_id = 442 and
		cotDet.producto_id=prod.producto_id and
		cotDet.bestado=1 and
		cotDet.moneda_id=mone.moneda_id and
		prod.prod_clasificacion_id=prodClas.prod_clasificacion_id;

		# obtener clasificacion de productos y servicios
		select prod_clasificacion_id as clasId,prod_clasif_nombre as clasNom from prod_clasificacion;

		# obtener id y sigla de moneda
		SELECT moneda_id,mon_sigla FROM `moneda`;

		# MATCH FL,OC,CC 
		
		/*

			id pk centro de costo -> cc_cenCostId
			correlativo centro de costo -> cc_correCenCost
			id fk fl cotizacion -> cc_cotiFlId
			id fk oc generada -> cc_ocGeneId

			cc_centCost
				- cc_centCostId (PK)
				- cc_correCenCost (CLV)
				- cc_cotiFlId (FK)
				- cc_idCliEmp (FK)
				- cc_idProye (FK)
				- cc_ocCli
				- cc_ocFechCli

			cc_detCentCost
				- cc_detCentCostId (PK)
				- cc_centCostId (FK)
				- cc_tipOrden
				- cc_provId
				- cc_moneId
				- cc_plazo
				- cc_ocGeneId
				- cc_estaOrd
				- cc_desOrd

			cc_estaCentCost
				- cc_idEstCost
				- cc_desEstCost

			cc_estaApeProye
				- cc_idEstApe
				- cc_desEstApe

		*/

		# version 1
		create table cc_centCost(
			cc_centCostId int(11) primary key not null auto_increment,
			cc_correCentCost char(15),
			cc_cotiFlId int(11),
			cc_ocGeneId int(11)
		);

		# version 2

		create table cc_centCost
		(
			cc_centCostId int(11) primary key not null auto_increment, # PK
			cc_correCenCost char(15), # CL
			cc_cotiFlId int(11),
			cc_idCliEmp int(11),
			cc_idProye int(11),
			cc_ocCli varchar(25),
			cc_ocFechCli date,
			cc_montCoti decimal(20,2),
			cc_moneId int(11),
			cc_idEstApe int(11),
			empresa_id int(10) default '1',
			bestado int(10) default '1',
			cc_fileAdju varchar(200) default '',
			cc_ocfechEntre date
		);

		alter table cc_centcost
		add cc_cotiFlIdMulti varchar(1200) after cc_cotiFlId;

		create table cc_detCentCost(
			cc_detCentCostId int(11) primary key not null auto_increment, # PK
			cc_centCostId int(11), # FK
			cc_tipOrden	int(11),
			cc_provId	int(11),
			cc_moneId	int(11),
			cc_plazo	int(11),
			cc_ocGeneId	char(15),
			cc_idEstCost	int(11), # FK
			cc_desOrd	varchar(70),
			cc_tipPre int(11)
		);

		create table cc_estaCentCost
		(
			cc_idEstCost int(11) primary key not null auto_increment, # PK
			cc_desEstCost varchar(70)
		);

		create table cc_estaApeProye
		(
			cc_idEstApe int(11) primary key not null auto_increment, # PK
			cc_desEstApe varchar(20)
		);

		# Restricciones

		alter table cc_detCentCost
		add constraint fk_cc_centCostId foreign key (cc_centCostId) references cc_centCost(cc_centCostId),
		add constraint fk_cc_idEstCost foreign key (cc_idEstCost) references cc_estaCentCost(cc_idEstCost);

		alter table cc_centCost
		add constraint fk_cc_idEstApe foreign key (cc_idEstApe) references cc_estaApeProye(cc_idEstApe);
		

		# obtener costos creados y correlativos pc,fl,oc_ew
		SELECT 
		cc.cc_centCostId as item,
		cc.cc_correCentCost as pc,
		coti.cot_nro as fl,
		coti.cotizacion_id as flId,
		comp.comp_nro as oc_ew,
		comp.compras_id as oc_ew_id,
		(case
		when (LEFT(comp.comp_nro, 2)='OC') then
		concat('GenerarOCLPDF(',comp.compras_id,')')
		else 
		concat('GenerarOCPDF(',comp.compras_id,')')
		end) as popDetOc
		FROM cc_centcost as cc 
		inner join compras as comp on cc.cc_ocGeneId=comp.compras_id 
		inner join cotizacion as coti on cc.cc_cotiFlId=coti.cotizacion_id;


		# obtener fl de centro de costos
		SELECT distinct coti.cot_nro FROM cc_centcost as cc,cotizacion as coti where cc.cc_cotiFlId=coti.cotizacion_id;

		# obtener centro de costos por fl
		SELECT 
			cc.cc_centCostId as item,
			cc.cc_correCentCost as pc,
			coti.cot_nro as fl,
			coti.cotizacion_id as flId,
			comp.comp_nro as oc_ew,
			comp.compras_id as oc_ew_id,
			(case
			when (LEFT(comp.comp_nro, 2)='OC') then
			concat('GenerarOCLPDF(',comp.compras_id,')')
			else 
			concat('GenerarOCPDF(',comp.compras_id,')')
			end) as popDetOc
			FROM cc_centcost as cc 
			inner join compras as comp on cc.cc_ocGeneId=comp.compras_id 
			inner join cotizacion as coti on cc.cc_cotiFlId=coti.cotizacion_id
			where coti.cot_nro='FL-12-0243-2';

		# obtener idCli por nombre
		SELECT empresa_id as idCli FROM `empresa` where emp_nombre='TECSUR S.A.';

		# enviar set detalle de proyecto creado
		insert into cc_detcentcost(cc_centCostId,cc_idEstCost,cc_tipOrden,cc_provId,cc_moneId,cc_plazo,cc_desOrd)
		values('','','','','','','');

		# obtener correlativos centro de costos
		SELECT cc_correCenCost FROM `cc_centcost`;

		# obtener pc centro de costo general
		SELECT 
		centCost.cc_centCostId as idCent,
		centCost.cc_correCenCost as correCen,
		coti.cot_nro as cotNum
		FROM cc_centcost as centCost,cotizacion as coti
		where centCost.cc_cotiFlId=coti.cotizacion_id;

		# obtener ordenes por generar de centro de costo 
		SELECT cenCost.cc_detCentCostId,cenCost.cc_tipOrden,cenCost.cc_desOrd FROM cc_detcentcost as cenCost
		where cenCost.cc_idEstCost='2';

		# obtener detalle de centro de costos por generar
		SELECT detCenCost.cc_detCentCostId,detCenCost.cc_tipOrden,detCenCost.cc_desOrd FROM cc_detcentcost as detCenCost
		where detCenCost.cc_idEstCost='2' and detCenCost.cc_centCostId='4';

		# obtener detalle de centro de costos por id detalle
		SELECT detCent.cc_provId,centCost.cc_idProye,detCent.cc_moneId,centCost.cc_cotiFlId,centCost.cc_ocFechCli,detCent.cc_tipOrden 
		FROM cc_detcentcost as detCent,cc_centcost as centCost where detCent.cc_detCentCostId='12' and detCent.cc_centCostId=centCost.cc_centCostId;

		# cambiar detalle por generar a generados
		update cc_detcentcost set cc_idEstCost=1 where cc_detCentCostId='';

		# obtener detalle general de centro de costo
		SELECT centCost.cc_correCenCost as pcVal,coti.cot_nro as flVal,emp.emp_nombre as cliEmp,proye.proy_nombre as proyNom,
		centCost.cc_ocCli as ocCli,centCost.cc_ocFechCli as ocCliFech FROM cc_centcost as centCost,cotizacion as coti,empresa as emp,
		proyecto as proye where centCost.cc_cotiFlId=coti.cotizacion_id and centCost.cc_idProye=proye.proyecto_id
		and  centCost.cc_idCliEmp=emp.empresa_id and centCost.cc_centCostId=12;


		# obtener detalle espefico de centro de costo por id centro
		SELECT `cc_detCentCostId`, `cc_centCostId`, `cc_tipOrden`, `cc_provId`, `cc_moneId`, `cc_plazo`, `cc_ocGeneId`, 
		`cc_idEstCost`, `cc_desOrd` FROM `cc_detcentcost` WHERE `cc_idEstCost`=2 and `cc_centCostId`='9';

		# obtener detalle espefico de centro de costo por id detalle centro
		SELECT `cc_detCentCostId`, `cc_centCostId`, `cc_tipOrden`, `cc_provId`, `cc_moneId`, `cc_plazo`, `cc_ocGeneId`, 
		`cc_idEstCost`, `cc_desOrd` FROM `cc_detcentcost` WHERE `cc_idEstCost`=2 and `cc_centCostId`='' and `cc_detCentCostId`='';

		# editar detalle especifico de centro de costo
		update  `cc_detcentcost` set `cc_tipOrden`='', `cc_provId`='', `cc_moneId`='', `cc_plazo`='', 
		`cc_desOrd`=''  WHERE  `cc_detCentCostId`='';

		# borrar detalle centro de costo por id detalle
		delete from cc_detcentcost where cc_detCentCostId='35';

		# obtener moneda de fl
		SELECT coti.moneda_id as moneId FROM `cotizacion` as coti where coti.cot_nro='FL-12-0243-2';

		# obtener total de cotizacion por id
		select sum(cotDet.pro_cantidad*cotDet.pro_precio_venta) as totCoti from cot_detalle as cotDet where cotDet.bestado=1 
		and cotDet.cotizacion_id=5;

		# añadir columna monto y moneda a tupla centro de costo
		alter table cc_centCost
		add cc_montCoti decimal(20,2) after cc_ocFechCli,
		add cc_moneId int(11) after cc_montCoti;

		# añadir columna estado apertura en tupla centro de costo
		alter table cc_centCost
		add cc_idEstApe int(11) after cc_moneId;

		# activar todos los centros de costos
		update cc_centcost set cc_idEstApe=1;

		# modificar campo coti_fl de compras [NEW COLUMN COMPRAS]
		alter table compras change coti_fl pc_id int(10);
		alter table compras add comp_plazo int(11) after pc_id;

		# añadir campo empresa_id a centro de costos
		alter table cc_centcost
		add empresa_id int(10) default '1' after cc_idEstApe;

		# añadir el campo bestado a centro de costo
		alter table cc_centcost
		add bestado int(10) default '1' after empresa_id;

		# obtener monto por tipo de moneda y convertirlo total a dolares
		select 
		cc_centCostId as idCentCost,
		(select sum(compDet.prod_cantidad*compDet.prod_precio_venta) from compras as comp,compras_detalle as compDet 
		where comp.pc_id=idCentCost and comp.compras_id=compDet.compras_id and comp.moneda_id=1 ) as totSoles,
		(select sum(compDet.prod_cantidad*compDet.prod_precio_venta) from compras as comp,compras_detalle as compDet 
		where comp.pc_id=idCentCost and comp.compras_id=compDet.compras_id and comp.moneda_id=2 ) as totDolares,
		(select sum(compDet.prod_cantidad*compDet.prod_precio_venta) from compras as comp,compras_detalle as compDet 
		where comp.pc_id=idCentCost and comp.compras_id=compDet.compras_id and comp.moneda_id=3 ) as totHebros
		from cc_centcost 
		where cc_centCostId='44';

		# actualizar detalle de centro de costo al actualizar compra
		update cc_detcentcost as detCent,compras as comp set detCent.cc_provId='',detCent.cc_moneId=''
		where comp.comp_nro=detCent.cc_ocGeneId and comp.compras_id='';

		# sql adaptado para funciones de compras locales e internacionales 
		# [PROCEDIMIENTOS Y FUNCIONES PARA UPDATE DE COMPRAS]

			/* actualizar detalle de centro de costos */
			update cc_detcentcost as detCent,compras as comp set 
			detCent.cc_provId=$proveedor_id,
			detCent.cc_moneId=$moneda_id
			where comp.comp_nro=detCent.cc_ocGeneId and 
			comp.compras_id=$compras_id;

		# actualizar centro de costo que ya fue generado
		update cc_centcost set cc_ocCli='',cc_ocFechCli='',cc_montCoti='',cc_moneId=''
		where cc_centCostId='';

		# reporte de compras para la gestion comercial
		select 
		'' as item,
		'' as numOrden,
		'' as tipPedi,
		'' as fechEw,
		'' as prov,
		'' as cli,
		'' as equip,
		'' as montOrd,
		'' as montEw,
		'' as incoter,
		'' as fechEntCli,
		'' as fechEmbar,
		'' as fechLleg,
		'' as comenSegui,
		'' as riesg,
		'' as numFl,
		'' as fwdr,
		'' as estaDes,
		'' as ingCarg;

		# añadir columna de archivo adjunto a centro de costo
		alter table cc_centCost
		add cc_fileAdju varchar(200) default '' after bestado;

		alter table cc_centCost
		change cc_fileAdju cc_fileAdju varchar(200);

		# obtener estado actua de centro de costo
		select 
		estProye.cc_desEstApe as estaProye 
		from 
		cc_centcost as cenCost,
		cc_estaapeproye as estProye
		where 
		cenCost.cc_idEstApe=estProye.cc_idEstApe and 
		cenCost.cc_centCostId=56;

		# iniciar estados apertura de centro de costos
		select cc_idEstApe as idEstApe,cc_desEstApe as desEstApe from cc_estaapeproye;

		# Obtener los usuario que se logearon hoy en el jano
		select operador_id as opId,(select trab_usuario from trabajador where trabajador_id=opId ) as user 
		from acceso_log where date(acc_log_fecha_ini) between '2014-04-01' and '2014-04-01';


		/* 
			Añadir detalle de la nueva version a centro de costo 
			[PROCEDIMIENTO ALMACENADO / FUNCIONES PARA NEW VERSION COMPRAS]
		*/
	
		set $idCent=(select pc_id from compras where compras_id=$compras_id);

		insert into cc_detcentcost(cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_plazo,cc_ocGeneId,cc_idEstCost,cc_desOrd)
		select $idCent,compra_tipo_id,proveedor_id,moneda_id,'0',get_nro($empresa_id,'OCI',$compras_id_origen),'1','' from
		compras where compras_id=$compras_id;

		/*

			declare $idCent int(11);
			declare $idCompVer int(11);
			declare $correGene char(25);

			SET $compras_id_origen=$compras_id;
			set $idCompVer=$compras_id;
			set $correGene=get_nro($empresa_id,'OCI',$compras_id_origen);

			set $idCent=(select pc_id from compras where compras_id=$idCompVer);

			insert into cc_detcentcost(cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_plazo,cc_ocGeneId,cc_idEstCost,cc_desOrd,cc_tipPre)
			select $idCent,compra_tipo_id,proveedor_id,moneda_id,'0',$correGene,'1','',tipo_precio_id from
			compras where compras_id=$idCompVer;

		*/

		# añadir tipo de precio id a detalle de centro de costo
		alter table cc_detcentcost add cc_tipCost int(11) after cc_desOrd;
		alter table cc_detcentcost change cc_tipCost cc_tipPre int(11);

		# consultar tipo de precio por identified
		SELECT imp_tc_nombre tipPrec FROM `imp_tipo_costo` where imp_tipo_costo_id='3';

		# inciar correlativo centro de costo en 1000
		alter table cc_centcost auto_increment=1000;

		# añadir campo "fecha de entrega" a centro de costo
		alter table cc_centcost add cc_ocFechEntre date after cc_fileAdju;

		/* New update 22/12/2014 */
		/* New Update 05/01/2014 */

		#PROCEDURE

			/*C*/
			/*R*/

				/* 22/12/2014 */

				/* 05/01/2014 - CLOSE */

					/* obtener ordenes de empresa [cc_ordEmp_obte] -> OK */

						DELIMITER $$
						create procedure cc_ordEmp_obte($empId int(11))
						COMMENT 'obtener ordenes de empresa'
						BEGIN

							/*vars*/

							/*obte ords*/
							select
							comp.comp_nro as cc_asigOrig,
							comp.compras_id as cc_asigOrigId
							from
							compras as comp
							where 
							comp.empresa_id=$empId and
							comp.bestado=1;

						end;

					/* obtener centros de empresa [cc_centEmp_obte] -> OK */

						DELIMITER $$
						create procedure cc_centEmp_obte($empId int(11))
						COMMENT 'obtener centros de empresa'
						BEGIN

							/*vars*/

							/*obte centros*/
							select
							cc.cc_correCenCost as cc_asigOrig,
							cc.cc_centCostId as cc_asigOrigId
							from
							cc_centcost as cc
							where
							cc.empresa_id=$empId and
							cc.bestado=1;

						end;

					/* obtener centros de empresa [cc_centDest_obte] -> OK */

						DELIMITER $$
						create procedure cc_centDest_obte($empId int(11))
						COMMENT 'obtener centros de empresa'
						BEGIN

							/*vars*/

							/*obte centros*/
							select
							cc.cc_correCenCost as cc_asigDest,
							cc.cc_centCostId as cc_asigDestId
							from
							cc_centcost as cc
							where
							cc.empresa_id=$empId and
							cc.bestado=1;

						end;

					/* obtener ordenes por ordenes [cc_ordxOrd_obte] -> OK */

						DELIMITER $$
						create procedure cc_ordxOrd_obte($empId int(11),$ordId int(11))
						COMMENT 'obtener ordenes por ordenes'
						BEGIN
							/*vars*/

							/*obte ord por ord*/
							select
							comp.compras_id as compId,
							comp.comp_nro as compNro,
							comp.comp_fecha_ini as fechIni,
							(select emp_nombre from empresa where empresa_id=comp.proveedor_id) as provDes
							from compras as comp
							where 
							comp.compras_id=$ordId and
							comp.empresa_id=$empId and
							comp.bestado=1;

						end;

					/* obtener ordenes por centro [cc_ordxCent_obte] -> OK */

						DELIMITER $$
						create procedure cc_ordxCent_obte($empId int(11),$centId int(11))
						COMMENT 'obtener ordenes por centro'
						BEGIN
							/*vars*/

							/*obte por centro*/
							select
							comp.compras_id as compId,
							comp.comp_nro as compNro,
							comp.comp_fecha_ini as fechIni,
							(select emp_nombre from empresa where empresa_id=comp.proveedor_id) as provDes
							from compras as comp,cc_detcentcost as detCent
							where 
							comp.pc_id=$centId and
							comp.empresa_id=$empId and
							comp.comp_nro=detCent.cc_ocGeneId and
							comp.bestado=1;

						end;

			/*U*/
			/*D*/

		#FUNCTION

			/*C*/

				/* 22/12/2014 */

					# create fl centro en cotizacion [cc_flCent_cre] -> OK

						DELIMITER $$
						create function cc_flCent_cre($cc_alias varchar(50))
						RETURNS int(11)
						COMMENT 'crear fl centro en cotizacion'
						BEGIN
							/*vars*/
							declare $idAfect int(11);

							/*cre fl centro*/
							insert into cotizacion (cot_nro) values ($cc_alias);

							/*id afect*/
							set $idAfect=(select LAST_INSERT_ID());

							/*return*/
							return $idAfect;
						end;

					# create proyecto centro [cc_proyeCent_cre] -> OK

						DELIMITER $$
						create function cc_proyeCent_cre($proyDes varchar(200))
						RETURNS int(11)
						COMMENT 'crear proyecto centro'
						BEGIN
							/*vars*/
							declare $idAfect int(11);

							/*cre proye centro*/
							insert into proyecto(proy_nombre) values ($proyDes);

							/*id afect*/
							set $idAfect=(select LAST_INSERT_ID());

							/*return*/
							return $idAfect;
						end;

					# create centro anual [cc_centAnu_cre] -> OK

						DELIMITER $$
						create function cc_centAnu_cre($correCent char(15),
															$flId int(11),
															$idCli int(11),
															$idProye int(11),
															$fechCli date)
						RETURNS int(11)
						COMMENT 'crear centro anual'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*cre cent*/
							insert into cc_centcost(cc_correCenCost,
													cc_cotiFlId,
													cc_idCliEmp,
													cc_idProye,
													cc_ocFechCli,
													bestado,
													cc_idEstApe) 
							values($correCent,
										$flId,
										$idCli,
										$idProye,
										$fechCli,
										1,
										1);

							/*row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;
						end;

			/*R*/

				/* 22/12/2014 */

					# read empresa por id [cc_empxId_re] -> OK

					DELIMITER $$
					create function cc_empxId_re($idEmp int(11))
					RETURNS varchar(75)
					COMMENT 'read empresa por id'
					BEGIN
						/*vars*/
						declare $empDes varchar(75);

						/*re empresa*/
						set $empDes=(select emp_nombre from empresa where empresa_id=$idEmp);

						/*return*/
						return $empDes;
					end;

			/*U*/

				/* 05/01/2014 - CLOSE */

					/* actualizar orden x centro destino [cc_ordxDest_actu] -> OK */

						DELIMITER $$
						create function cc_ordxDest_actu($centDest int(11),$ordId int(11))
						RETURNS int(11)
						COMMENT 'actualizar orden x centro destino'
						BEGIN

							/*vars*/
							declare $rowAfect int(11);

							/*actu ord x cent dest*/
							update
							compras as comp,
							cc_detcentcost as detCent
							set 
							comp.pc_id=$centDest,
							detCent.cc_centCostId=$centDest
							where 
							comp.compras_id=$ordId and
							comp.comp_nro=detCent.cc_ocGeneId;

							/*rowAfect*/
							set rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;

						end;

			/*D*/

/*------------------------------[*]-----------------------------------------------------------------------*/

/* -------------------------------------------------------------------------------------------------------*/
	# MODULO DE MOVIMIENTO DE PERSONAL
/* -------------------------------------------------------------------------------------------------------*/

	/* TUPLAS PARAMETRICAS I

		mp_pruebconfir
			- firma
			- correo

		mp_tipaprob
			- aprobado
			- cancelado
			- pendiente

		mp_areaprob
			- Area
			- A&F	
			- General

	*/

	/* TUPLAS PARAMETRICAS II

		mp_ubiPer
			- en empresa
			- fuera de empresa

	*/

	create table mp_movi (
    mp_moviId int(11) primary key auto_increment not null,
    mp_userPerId int(11),
    mp_fechSali date,
    mp_areTrabId int(11),
    mp_fechRetor date,
	mp_hourSali varchar(15),
	mp_hourRetor varchar(15),
	mp_ubiPerId int(11),
	mp_centCostId int(11),
	mp_tipAprobId int(11)
	);


	create table mp_detMov (
    mp_detMovId int(11) primary key auto_increment not null,
    mp_moviId int(11),
    mp_motiv varchar(300),
    mp_ubi varchar(300),
    mp_det varchar(1200)
	);

	create table mp_tipAprob (
    mp_tipAprobId int(11) primary key auto_increment not null,
    mp_desTipAprob varchar(50),
	mp_imagEst varchar(50)
	);


	create table mp_validDetMov (
    mp_validDetMovId int(11) primary key auto_increment not null,
    mp_detMovId int(11),
    mp_userAdmId int(11),
    mp_tipAprobId int(11),
    mp_fechValid datetime
	);

	/* table prueba de confirmacion */
	create table mp_pruebConfir(
	mp_pruebConfirId int(11) primary key auto_increment not null,
	mp_desPrueb varchar(50)
	);

	/* crear tupla  movimiento confirmacion */
	create table mp_movConfir(
	mp_movConfirId int(11) primary key auto_increment not null,
	mp_moviId int(11),
	mp_pruebConfirId int(11),
	mp_perGerenId int(11),
	mp_areAprobId int(11)
	);

	/* crear tupla area de aprobacion */
	create table mp_areAprob(
	mp_areAprobId int(11) primary key auto_increment not null,
	mp_desAreAprob varchar(25)
	);

	create table mp_ubiPer
	(
		mp_ubiPerId int(11) primary key auto_increment not null,
		mp_desUbi varchar(25),
		mp_classUbi varchar(15)
	);

	create table mp_gastMov
	(
		mp_gastMovId int(11) primary key auto_increment not null,
		mp_moviId int(11),
		mp_moneId int(11),
		mp_desGast varchar(150),
		mp_montGat decimal(10,2)
	);

	# Restricciones--------------------------------------------------------------------------------------------------

	alter table mp_detMov
	add constraint fk_mp_moviId foreign key(mp_moviId) references mp_movi(mp_moviId);

	alter table mp_validDetMov
	add constraint fk_mp_detMovId foreign key (mp_detMovId) references mp_detMov(mp_detMovId),
	add constraint fk_mp_tipAprobId foreign key (mp_tipAprobId) references mp_tipAprob(mp_tipAprobId);

	/* añadir restriccion a movimiento */
	alter table mp_movi
	add constraint fk2_mp_tipAprobId foreign key (mp_tipAprobId) references mp_tipaprob(mp_tipAprobId);

	/* restriccion para movimiento confirmacion */
	alter table mp_movConfir
	add constraint pk2_mp_moviId foreign key (mp_moviId) references mp_movi(mp_moviId),
	add constraint pk_mp_pruebConfirId foreign key(mp_pruebConfirId) references mp_pruebConfir(mp_pruebConfirId),
	add constraint pk_mp_areAprobId foreign key(mp_areAprobId) references mp_areAprob(mp_areAprobId);

	alter table mp_movi
	add constraint pk_mp_ubiPerId foreign key (mp_ubiPerId) references mp_ubiPer(mp_ubiPerId);

	alter table mp_gastMov
	add constraint fk3_mp_moviId foreign key (mp_moviId) references mp_movi(mp_moviId);

	# ----------------------------------------------------------------------------------------------------------------
	# cambios y añadidos ---------------------------------------------------------------------------------------------

	alter table mp_tipaprob add mp_imagEst varchar(50) after mp_desTipAprob;

	alter table mp_movi 
	add mp_hourSali varchar(10) after mp_fechRetor,
	add mp_hourRetor varchar(10) after mp_hourSali;

	/* añadir campo validacion a movimiento */
	alter table mp_movi
	add mp_tipAprobId int(11) after mp_userPerId;

	/* cambiar alias de columna en movimiento confirmacion */
	alter table mp_movconfir
	change mp_movId mp_moviId int(11);

	/* 

	añadir columna ubi en movimientos
	crear tupla ubicacion
	crear restriccion de ubicacion en movimientos

	*/

	alter table mp_movi
	add mp_ubiPerId int(11) after mp_userPerId;

	/* 
		crear tupla gastos
		crear restricciones de movimientos en gastos

	*/

	/* añadir estilo a ubicacion */
	alter table mp_ubiPer
	add mp_classUbi varchar(15) after mp_ubiPerId;

	/* añadir columna centro de costo */
	alter table mp_movi
	add mp_centCostId int(11) after mp_userPerId;

	# --------------------------------------------------------------------------------------------------------------------

	# añadir movimiento general de personal
	insert into mp_movi(mp_userPerId,mp_areTrabId,mp_fechSali,mp_fechRetor) values ('','','','');

	# añadir detalle de movimiento de personal
	insert into mp_detmov(mp_moviId,mp_motiv,mp_ubi,mp_det) values (1,'','','');

	# obtener trabajador y area de personal
	select 
	trab.trabajador_id as trabId,
    trabFun.trab_funcion_id as areId from
    trabajador as trab
	inner join trab_funcion as trabFun ON trab.trab_funcion_id = trabFun.trab_funcion_id
	where trab.trabajador_id = '11';

	# obtener movimientos de personal 
	select movPer.mp_moviId as item,
    concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as user,
    trabFun.trab_funcion_nombre as are,
    movPer.mp_fechSali as fechSali,
    movPer.mp_fechRetor as fechRetor,
    (select count(mp_moviId) from mp_detmov where mp_moviId = item) as cantMov
	from mp_movi as movPer
	inner join mp_detmov as detMov ON detMov.mp_moviId = movPer.mp_moviId
	inner join trabajador as trab ON trab.trabajador_id = movPer.mp_userPerId
	inner join trab_funcion as trabFun ON trabFun.trab_funcion_id = trab.trab_funcion_id
	inner join persona as per ON per.persona_id = trab.persona_id 
	group by movPer.mp_moviId
	order by movPer.mp_moviId desc;

	# obtener detalle de movimiento por id
	select detMov.mp_detMovId as item,
    detMov.mp_motiv as motiv,
    detMov.mp_ubi as ubi,
    detMov.mp_det as det,
    (select count(mp_detMovId) from mp_validdetmov where mp_detMovId = item) as cantVali
	from mp_detmov as detMov where detMov.mp_moviId = '3';

	# validar movimientos seleccionado
	insert into mp_validdetmov(mp_fechValid,mp_detMovId,mp_tipAprobId,mp_userAdmId)
	values ('',1,1,'');

	# obtener validaciones aceptadas
	SELECT 
    tipAprob.mp_desTipAprob as desAprob,
    concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as userAdm,
    validDet.mp_fechValid as fechVali
	FROM mp_validdetmov as validDet,
    trabajador as trab,
    persona as per,
    mp_tipaprob as tipAprob
	where
    validDet.mp_tipAprobId = 1
	and validDet.mp_detMovId = 4
	and trab.trabajador_id = validDet.mp_userAdmId
	and trab.persona_id = per.persona_id
	and tipAprob.mp_tipAprobId = validDet.mp_tipAprobId;

	# obtener validaciones rechazadas
	SELECT tipAprob.mp_desTipAprob as desAprob,
    concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as userAdm,
    validDet.mp_fechValid as fechVali
	FROM
    mp_validdetmov as validDet,
    trabajador as trab,
    persona as per,
    mp_tipaprob as tipAprob
	where
    validDet.mp_tipAprobId = 2
	and validDet.mp_detMovId = 4
	and trab.trabajador_id = validDet.mp_userAdmId
	and trab.persona_id = per.persona_id
	and tipAprob.mp_tipAprobId = validDet.mp_tipAprobId;

	/* obtener aprobacion gerente area */
	select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,
	per.persona_id as perId 
	from persona as per 
	where persona_id in ('608','360','490','394');

	/* obtener aprobacion area de finanza */
	select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,
	per.persona_id as perId 
	from persona as per 
	where persona_id in ('24','394','360');

	/* obtener aprobacion area general */
	select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,
	per.persona_id as perId 
	from persona as per 
	where persona_id in ('24','287');


	/* Aprobar movimiento */

	delete from mp_tipAprobId where mp_moviId='';

	insert into mp_movconfir (mp_perGerenId,mp_pruebConfirId,mp_areAprobId,mp_moviId) 
	values ('','','','');
	
	update mp_movi set mp_tipAprobId='1' where mp_moviId='';


	/* Cancelar movimiento */

	delete from mp_tipAprobId where mp_moviId='';

	update mp_movi set mp_tipAprobId='2' where mp_moviId='';


	/* Obtener los meses de movimientos añadidos */
	select distinct
	(
	CASE
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =1
	)
	THEN 'ENERO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =2
	)
	THEN 'FEBRERO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =3
	)
	THEN 'MARZO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =4
	)
	THEN 'ABRIL'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =5
	)
	THEN 'MAYO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =6
	)
	THEN 'JUNIO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =7
	)
	THEN 'JULIO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =8
	)
	THEN 'AGOSTO'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =9
	)
	THEN 'SETIEMBRE'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =10
	)
	THEN 'OCTUBRE'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =11
	)
	THEN 'NOVIEMBRE'
	WHEN (
	date_format( movi.mp_fechSali, '%m' ) =12
	)
	THEN 'DICIEMBRE'
	ELSE ''
	END
	) AS mesDes,date_format( movi.mp_fechSali, '%m' ) as mesId
	from mp_movi as movi;
 
	/* Obtener los meses de movimientos añadidos */

	select distinct 
	date_format( movi.mp_fechSali, '%y' ) as anVal
	from mp_movi as movi;

	/* Obtener los centros de costos de proyectos */
    SELECT 
    centCost.cc_centCostId as centId,
    centCost.cc_correCenCost as centCost,
    proy.proy_nombre 
    FROM 
    cc_centcost as centCost,
    cotizacion as coti,
    proyecto as proy
    where 
    coti.cotizacion_id=centCost.cc_cotiFlId and 
    coti.proyecto_id=proy.proyecto_id;

	/* obtener hora en formato pm y am */
	select TIME_FORMAT(CURTIME(),'%h:%i:%s %p');

	/* confirmar retorno de movimiento */
	update mp_movi set mp_ubiPerId='1',mp_fechRetor=CURDATE(),mp_hourRetor=TIME_FORMAT(CURTIME(),'%h:%i:%s %p')
	where mp_moviId='16';

	/* obtener todos los trabajadores */

	select
	trab.trab_funcion_id as funId,
	concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as trabEmp,
	(select trab_funcion_nombre from trab_funcion where trab_funcion_id=funId) as areTrab,
	'en empresa' as ubiTrab 
	from persona as per 
	inner join trabajador as trab on per.persona_id=trab.persona_id and trab.bestado=1;

	/* obtener todos los trabajadores y ubicacion */

	select concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as trabEmp,'en empresa' as ubiTrab from persona as per 
	inner join trabajador as trab on per.persona_id=trab.persona_id and trab.bestado=1;

	/* obtener los movimientos por mes y fecha para reporte */
	select 
	movPer.mp_moviId as item,
	concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as user,
	trabFun.trab_funcion_nombre as are,
	movPer.mp_fechSali as fechSali,
	movPer.mp_fechRetor as fechRetor,
	movPer.mp_hourSali as hourSali,
	movPer.mp_hourRetor as hourRetor,
	(select count(mp_moviId) from mp_detmov where mp_moviId=item) as cantMov,
	tipAprob.mp_imagEst as imagEst,
	tipAprob.mp_desTipAprob as desEst,
	ubiPer.mp_desUbi as desUbi,
	ubiPer.mp_classUbi as classUbi  
	from mp_movi as movPer
	inner join trabajador as trab on trab.trabajador_id=movPer.mp_userPerId
	inner join trab_funcion as trabFun on trabFun.trab_funcion_id=trab.trab_funcion_id
	inner join persona as per on per.persona_id=trab.persona_id
	inner join mp_tipaprob as tipAprob on movPer.mp_tipAprobId=tipAprob.mp_tipAprobId
	inner join mp_ubiper as ubiPer on ubiPer.mp_ubiPerId=movPer.mp_ubiPerId
	where date_format(movPer.mp_fechSali,'%m')='04' and date_format(movPer.mp_fechSali,'%Y')='2014' 
	group by movPer.mp_moviId order by movPer.mp_moviId desc;

	/* obtener detalle de movimientos para reporte */
		#

	/* obtener detalle de permisos de movimintos para reporte */
	select
	concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as user,
	areAprob.mp_desAreAprob as desAprob,
	pruebConfir.mp_desPrueb as desPrueb
	from 
	mp_movconfir as movConfir,
	mp_pruebConfir as pruebConfir,
	mp_areaprob as areAprob,
	persona as per
	where
	movConfir.mp_pruebConfirId=pruebConfir.mp_pruebConfirId and
	movConfir.mp_areAprobId=areAprob.mp_areAprobId and
	movConfir.mp_perGerenId=per.persona_id and
	movConfir.mp_moviId='17';

	/* movimiento de personal por filtro personal cuya ubicacion sea fuera de empresa */
	/* obtener detalle de movimientos */
	select
	mp_moviId as moviId
	from mp_movi as movi
	where 
	movi.mp_userPerId='' and 
	movi.mp_ubiPerId='2';

	/* obtener datos de trabajadores  */

	select funTrab.trab_funcion_nombre as funDes 
	from trabajador as trab 
	inner join trab_funcion as funTrab ON trab.trab_funcion_id = funTrab.trab_funcion_id
	where trab.trabajador_id = '1';

	/* GESTIONAR RENDICION DE MOVIMIENTO */

	/* añadir detalle de gasto del movimiento de trabajador */
	insert into mp_gastmov (mp_desGast,mp_moneId,mp_montGat,mp_moviId) values ('','','','');

	/* obtener detalle de gasto por item movimiento */
	select 
	gasMov.mp_gastMovId,
	gasMov.mp_desGast,
	mone.mon_sigla,
	gasMov.mp_montGat
	from
	mp_gastmov as gasMov
	inner join moneda as mone on gasMov.mp_moneId=mone.moneda_id
	inner join mp_movi as movi on gasMov.mp_moviId=movi.mp_moviId
	where gasMov.mp_moviId='';

	/* borrar detalle de movimiento por id detalle gasto */
	delete from mp_gastmov where mp_gastMovId='';

/*---------------------------[*]--------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------*/
	# COTIZACION DE SERVICIOS
/*--------------------------------------------------------------------------------------------------------*/

	/*

	#---Modelo conceptual de datos--------------------------------------------------------------------------------------------

			# MODELO CONCEPTUAL

			cs_cotiServ
				- cs_cotiServId // PK
				- cs_cliId // FK
				- cs_respComerId // FK #
				- cs_priorId // FK #
				- cs_estServId // FK #
				- cs_correServ
				- cs_desServ
				- cs_fechCoti

			cs_detCotiServ
				- cs_detCotiServId // PK
				- cs_cotiServId // FK
				- cs_desDetCoti
				- cs_unitDetCoti
				- cs_cantDetCoti
				- cs_totDetCoti

			cs_condiCotiServ
				- cs_condiCotiServId // PK
				- cs_cotiServId // FK
				- cs_reqCond
				- cs_tiemEje
				- cs_garanCond

			cs_tipDocServ
		
				-cs_tipDocServId # PK
				-cs_desTipDoc
		
			cs_tipDetServ

				-cs_tipDetServId # PK
				-cs_desTipDes

	#-----------------------------------------------------------------------------------------------

	*/

	#---Modelo de datos-----------------------------------------------------------------------------------------------
		create table cs_cotiServ
		(
			cs_cotiServId  int(11)  primary key auto_increment not null, # PK
			cs_cliId  int(11), # FK
			cs_respComerId  int(11), # FK #
			cs_priorId  int(11), # FK #
			cs_estServId  int(11), # FK #
			cs_correServ char(15),
			cs_desServ varchar(1200),
			cs_fechCoti date,
			cs_moneId int(11),
			cs_respoTecniId int(11),
			cs_tipDocServId int(11),
			cs_pcId int(11),
			cs_tipDetServId int(11)
		);

		create table cs_detCotiServ
		(
			cs_detCotiServId int(11) primary key auto_increment not null, # PK
			cs_cotiServId int(11), # FK
			cs_desDetCoti varchar(1200),
			cs_unidDetCoti varchar (200),
			cs_preUniDet decimal(10,2),
			cs_cantDetCoti int(10),
			cs_totDetCoti decimal(10,2),
			cs_tipDetServId int(11)
		);


		create table cs_condiCotiServ
		(
			cs_condiCotiServId int(11) primary key auto_increment not null, # PK
			cs_cotiServId int(11), # FK
			cs_reqCond varchar(1200),
			cs_tiemEje varchar(700),
			cs_garanCond varchar(700),
			cs_condPag varchar(700),
			cs_tiemVali varchar(200)
		);

		create table cs_tipDocServ
		(
			/*
				cotizacion de servicio
				orden de servicio
			*/
			cs_tipDocServId int(11) primary key auto_increment not null, # PK
			cs_desTipDoc varchar(25)
		);

		create table cs_tipDetServ
		(
			/*
				servicio
				materiales
			*/
			cs_tipDetServId int(11) primary key auto_increment not null, # PK
			cs_desTipDes varchar(25)
		);
	#--------------------------------------------------------------------------------------------------

	#--Restricciones------------------------------------------------------------------------------------------------
		alter table cs_detCotiServ
		add constraint fk_cs_cotiServId foreign key (cs_cotiServId) references cs_cotiServ(cs_cotiServId);

		alter table cs_condiCotiServ
		add constraint fk2_cs_cotiServId foreign key (cs_cotiServId) references  cs_cotiServ(cs_cotiServId);

		alter table cs_cotiServ
		add constraint fk_cs_tipDocServId foreign key (cs_tipDocServId) references cs_tipDocServ(cs_tipDocServId);

		alter table cs_detCotiServ
		add constraint fk2_cs_tipDetServId foreign key (cs_tipDetServId) references cs_tipDetServ(cs_tipDetServId);
	#--------------------------------------------------------------------------------------------------


	#--Cambios y Añadidos-------------------------------------------------------------------------------------------------------

		# añadir columna moneda id en cotizacion
		alter table cs_cotiserv
		add cs_moneId int(11) after cs_respComerId;

		# añadir columna condiciones de pago en condiciones
		alter table cs_condiCotiServ
		add cs_condPag varchar(700) after cs_garanCond; 

		# añadir columna identificador moneda
		alter table cs_cotiServ
		add cs_respoTecniId int(11) after cs_moneId;

		# añadir columna tipo de documento
		alter table cs_cotiServ
		add cs_tipDocServId int(11) after cs_respoTecniId;

		# añadir columna centro de costo
		alter table cs_cotiServ
		add cs_pcId int(11) after cs_tipDocServId;

		# añadir columna tipo detalle
		alter table cs_detCotiServ
		add cs_tipDetServId int(11) after cs_totDetCoti;

		# añadir tiempo de validez a condiciones
		alter table cs_condiCotiServ
		add cs_tiemVali varchar(200) after cs_condPag;

	#---------------------------------------------------------------------------------------------------------


	#---Persistencias-----------------------------------------------------------------------------------------------------------

		# obtener responsables de comercial
		select 
		concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as respComer,
		per.persona_id as respComerId
		from 
		trabajador as trab,
		persona as per
		where
		per.persona_id=trab.persona_id and
		trab.trab_funcion_id=1;

		# obtener prioridades
		select 
		cotPrior.cot_prioridad_nombre as priorNom,
		cotPrior.cot_prioridad_id as priorId
		from
		cot_prioridad as cotPrior;

		# obtener estados
		SELECT
		cotEst.cot_estado_nombre as cotEstNom,
		cotEst.cot_estado_id as cotEstId
		from cot_estado as cotEst;

		# generar cotizacion de servicio
		insert into cs_cotiserv (cs_fechCoti,cs_cliId,cs_respComerId,cs_desServ,cs_priorId,cs_estServId) 
		values ('','','','','','');

		# generar correlativo de orden de servicio
		update cs_cotiserv set cs_correServ='' where cs_cotiServId='';

		# obtener correlativo de cotizacion por identificador
		select cs_correServ as correServ from cs_cotiserv where cs_cotiServId=7;

		# obtener cotizacion servicio por identificador
		SELECT *,cs_cliId as cliId,(select emp_nombre as empNom from empresa where empresa_id=cliId) as empDes FROM `cs_cotiserv`
		where cs_cotiServId='';

		# generar condicion de cotizacion de servicio por identificador de cotizacion
		insert into cs_condicotiserv (cs_cotiServId,cs_garanCond,cs_reqCond,cs_tiemEje) values ('','','','');

		# actualizar general de cotizacion
		update cs_cotiserv set cs_fechCoti='',cs_cliId='',cs_respComerId='',cs_desServ='',cs_priorId='',cs_estServId=''	
		where cs_cotiServId='';

		# actualizar condiciones de cotizacion
		update cs_condicotiserv set cs_reqCond='',cs_tiemEje='',cs_garanCond=''
		where cs_cotiServId='';

		# obtener condiciones de cotizacion de servicio
		select cs_reqCond as reqCond,cs_tiemEje as tiemEje,cs_garanCond as garanCond
		from cs_condicotiserv where cs_cotiServId='';

		# añadir nuevo detalle de cotizacion de servicio
		insert into cs_detcotiserv (cs_desDetCoti,cs_unidDetCoti,cs_preUniDet,cs_cantDetCoti,cs_totDetCoti,cs_cotiServId) 
		values ('','','','','',7);

		# obtener detalle de cotizacion servicio por identificador
		select 
		cs_detCotiServId as detCotiServId,
		cs_desDetCoti as desDetCoti,
		cs_unidDetCoti as unidDetCoti,
		cs_preUniDet as preUniDet,
		cs_cantDetCoti as cantDetCoti,
		cs_totDetCoti as totDetCoti
		from
		cs_detcotiserv
		where
		cs_detCotiServId='';

		# Eliminar detalle de cotizacion por identificador propio
		delete from cs_detcotiserv where cs_detCotiServId='';

		# obtener cotizaciones de servicios generadas
		select
		cotiserv.cs_cotiServId as item,
		cotiserv.cs_correServ as fs,
		cotiserv.cs_fechCoti as fech,
		concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as respo,
		cotiserv.cs_desServ as des,
		priori.cot_prioridad_nombre as priori,
		esta.cot_estado_nombre as esta,
		(select sum(cs_totDetCoti) from cs_detcotiserv where cs_cotiServId=item ) as tot
		from
		cs_cotiserv as cotiserv,
		empresa as emp,
		persona as per,
		cot_prioridad as priori,
		cot_estado as esta
		where
		emp.empresa_id=cotiServ.cs_cliId and
		cotiServ.cs_respComerId=per.persona_id and
		priori.cot_prioridad_id=cotiServ.cs_priorId and
		esta.cot_estado_id=cotiServ.cs_estServId;

		# actualizar detalle de cotizacion por id
		update cs_detcotiserv set cs_desDetCoti='',cs_unidDetCoti='',cs_preUniDet='',cs_cantDetCoti='',
		cs_totDetCoti='' where cs_detCotiServId='';

		# obtener tipo detalle de servicio
		SELECT * FROM `cs_tipdetserv`;
		

	#--------------------------------------------------------------------------------------------------------------

/*---------------------------------------[*]--------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------------*/
	# MODULO DE ORDENES DE SERVICIOS
/*--------------------------------------------------------------------------------------------------------*/


	/*--Modelo conceptual-------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

	/*--Modelo de datos---------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

	/*--Restricciones-----------------------------------------------------------------------------*/
	/*-------------------------------------------------------------------------------------------*/

	/*--Cambios y añadidos-------------------------------------------------------------------------*/

		# añadir registro ordenes servicios a la tupla -> documento_tipo [OK]
		# añadir condicion a la funcion de capa negocio -> evaPrefiTip [OK]
		# añadir campo identificador centro de costo en tupla -> cs_cotiServ [OK]
		# cambiar condicion en funcion de capa negocio -> evaTipMone [OK]
		# añadir condicion en funcion de capa negocio -> evaTipDocOrd [OK]
		# añadir funcion js en gestionador de centro de costos -> cs_visuDetCot [OK]
		# modificar la instruccion de la capa sql -> cc_getDetProyexId [OK]
		# añadir funcion a capa de negocio -> evaMontxTip [OK]
		# modificar funcion de la capa sql -> cc_getDetProyexId [OK]
		# modificacion de flujo de creacion de centro de costo -> ?
		# modificacion de flujo de generacion de ordenes en centro creado -> ?
		# modificacion de flujo de controlador superior para vista, totales de ordenes de servicio -> cc_asigPro 
		# modificar funcion query de capa sql -> cc_totConverOrd [OK]
		

	/*--------------------------------------------------------------------------------------------*/

	/*--Persistencia------------------------------------------------------------------------------*/

		# Generar una orden de servicio sin correltivo
		insert into cs_cotiserv(cs_respoTecniId,cs_pcId,cs_tipDocServId) values ('','','');

		# Generar correlativo de orden de servicio generada
		update cs_cotiserv set cs_correServ='' where cs_cotiServId='';

		# Flujo para obtener fs y enviarla al os

			/* obtener fs a partir de fl */
			select fsId from cotizacion where cot_nro='';
			
			/* obtener datos generales de fs */
			select
			'' as os,
			'' as cc,
			cotiServ.cs_fechCoti as fech,
			cotiServ.cs_cliId as cli,
			cotiServ.cs_respComerId as respComer,
			cotiServ.cs_moneId as mone,
			cotiServ.cs_desServ as des,
			cotiServ.cs_priorId as priori,
			cotiServ.cs_estServId as esta
			from 
			cs_cotiserv as cotiServ
			where 
			cotiServ.cs_cotiServId='';

			/* obtener detalle de fs */
			select 
			cotDet.pro_descripcion,
			cotDet.cs_tipDetServId,
			cotDet.cs_tipDocServId,
			cotDet.cs_unid,
			cotDet.pro_cantidad,
			cotDet.pro_precio_venta,
			cotDet.pro_subtotal 
			from 
			cot_detalle as cotDet
			inner join cotizacion as cot on cot.cotizacion_id=cotDet.cotizacion_id
			where
			cot.cot_nro='' and
			cotDet.bestado=1 and 
			cotDet.cs_tipDocServId=1;

			/* obtener condiciones de fs */
			select
			condiCoti.cs_reqCond as requi,
			condiCoti.cs_tiemEje as tiemEje,
			condiCoti.cs_garanCond as garan,
			condiCoti.cs_condPag as condi,
			condiCoti.cs_tiemVali as tiemVali
			from cs_condicotiserv as condiCoti
			where condiCoti.cs_cotiServId='';

			/* crear el os con su correlativo */

			/* enviar datos generales de fs a os */
			update cs_cotiserv as cotiServ
			set
			cotiServ.cs_fechCoti='',
			cotiServ.cs_cliId='',
			cotiServ.cs_respComerId='',
			cotiServ.cs_moneId='',
			cotiServ.cs_desServ='',
			cotiServ.cs_priorId='',
			cotiServ.cs_estServId=''
			where cotiServ.cs_cotiServId='';

			/* enviar detalle de fs a os */
			insert into 
			cs_detcotiserv (cs_desDetCoti,cs_tipDetServId,cs_unidDetCoti,cs_cantDetCoti,cs_preUniDet,cs_totDetCoti,cs_cotiServId) 
			values ('','','','','','','');

			/* enviar condiciones de fs a os */
			insert into cs_condicotiserv (cs_reqCond,cs_tiemEje,cs_garanCond,cs_condPag,cs_tiemVali,cs_cotiServId) 
			values ('','','','','','');

			/* obtener el pc-id por el coti-id */
			select cs_pcId from cs_cotiserv where cs_cotiServId='';

			/* actualizar datos generales de orden de servicios en centro de costo */
			update cc_detcentcost set cc_provId='',cc_moneId='' where cc_detCentCostId='';
			
			/* obtener total de fs en fl  */
				# modificacion directa en capa

			/* obtener correlativo de orden por id de orden */
			select cs_correServ as correServ from cs_cotiserv where cs_cotiServId='';

			/* actualizar datos generales de orden de servicios en centro de costo */
			update cc_detcentcost set cc_provId='',cc_moneId='' where cc_ocGeneId='';

			/* obtener los totales de ordenes de servicio */
			select
			distinct
			cotiServ.cs_pcId as pcId,
			#cotiServ.cs_moneId as tipMon,
			(select sum(detServ.cs_totDetCoti) from cs_cotiserv as cotiServ,cs_detcotiserv as detServ,cc_detcentcost as detCent 
			where cotiServ.cs_pcId=pcId and cotiServ.cs_moneId=1 and cotiServ.cs_cotiServId=detServ.cs_cotiServId and
			detCent.cc_ocGeneId=cotiServ.cs_correServ) as montSolServ,
			(select sum(detServ.cs_totDetCoti) from cs_cotiserv as cotiServ,cs_detcotiserv as detServ,cc_detcentcost as detCent 
			where cotiServ.cs_pcId=pcId and cotiServ.cs_moneId=2 and cotiServ.cs_cotiServId=detServ.cs_cotiServId and
			detCent.cc_ocGeneId=cotiServ.cs_correServ) as montDolServ,
			(select sum(detServ.cs_totDetCoti) from cs_cotiserv as cotiServ,cs_detcotiserv as detServ,cc_detcentcost as detCent 
			where cotiServ.cs_pcId=pcId and cotiServ.cs_moneId=3 and cotiServ.cs_cotiServId=detServ.cs_cotiServId and 
			detCent.cc_ocGeneId=cotiServ.cs_correServ ) as montHebServ
			from
			cs_cotiserv as cotiServ
			inner join cc_detcentcost as detCent on cotiServ.cs_correServ=detCent.cc_ocGeneId
			where
			cotiServ.cs_pcId='';
		
	/*-------------------------------------------------------------------------------------------*/

/*--------------------------------[*]---------------------------------------------------------------------*/


/*-------------------------------------------------------------------------------------------------------*/
	# MODULO DE COTIZACIONES DE EQUIPOS
/*-------------------------------------------------------------------------------------------------------*/

	/*----cambios y añadidos-------------------------------------------------------------*/

		# añadir opcion de importacion de fs
		# añadir popup para importacion de fs

		# añadir fsId en cotizacion
			alter table cotizacion
			add fsId int(11) after cot_nro;
		
		# añadir columna tipo de documento en detalle cotizacion
		# añadir columna unidad en detalle cotizacion
			alter table cot_detalle
			add cs_tipDocServId int(11) after producto_id,
			add cs_unid varchar(25) after cs_tipDocServId;

		# añadir columna de tipo de detalle ejem:servicio,materiales
			alter table cot_detalle
			add cs_tipDetServId int(11) after cs_tipDocServId; 

	/*----------------------------------------------------------------------------------*/

	/*--Persistencia--------------------------------------------------------------------------------*/

		# obtener las fs de cotizaciones de servicios
		select cs_correServ,cs_cotiServId from cs_cotiserv where cs_tipDocServId=1;

		# obtener el detalle de la fs
		select 
		cs_detCotiServId as itemDet,
		cs_cotiServId as item,
		cs_desDetCoti as des,
		(select cs_moneId from cs_cotiserv where cs_cotiServId=item ) as moneId,
		(select mon_sigla from moneda where moneda_id=moneId) as mone,
		cs_unidDetCoti as unid,
		cs_preUniDet as preUnit,
		cs_cantDetCoti as cant,
		cs_totDetCoti as tot
		from cs_detcotiserv 
		where 
		cs_cotiServId=28;

		# /* Asociar el fs en el fl */
		update `cotizacion` set fsId='' where cotizacion_id='';

		# /* Incluir el detalle del fs en el detalle del fl de data obtenida */
		insert into cot_detalle (producto_id,moneda_id,cs_unid,pro_precio_compra,pro_precio_venta,pro_cantidad,
		pro_subtotal,cs_tipDocServId,cotizacion_id,prod_clasificacion_id,pro_descripcion,cs_tipDetServId) values 
		('','','','','','','','','','','','');

		/* Incluir descripcion de data como productos nuevos */
		insert producto set empresa_id='',bestado='1',prod_alias='',prod_nombre='',prod_descrip='';

		/* Evaluar tamaño de items actual de detalle cotizacion */
		SELECT count(*) as contItems FROM `cot_detalle` WHERE `cotizacion_id` = 503 and bestado=1;

		/* Reporte de Pre-Calculo Version 2.0 -> 06/05/2014 */
		select
		cotDet.cot_detalle_id as cotDetId,
		cotDet.producto_id as prodId,
		cotDet.cot_det_orden as item,
		(select prod_nombre from producto where producto_id=prodId) as prodDes,
		(select prod_ew_valor from imp_proforma_detalle where cot_detalle_id=cotDetId) as exwork,
		(select prod_fob_valor from imp_proforma_detalle where cot_detalle_id=cotDetId) as fob,
		(select prod_cif_valor from imp_proforma_detalle where cot_detalle_id=cotDetId) as cif,
		(select prod_nac_valor from imp_proforma_detalle where cot_detalle_id=cotDetId) as nac,
		(select  cif+nac ) as ddp,
		(select imp_prof_det_id from imp_proforma_detalle where cot_detalle_id=cotDetId ) as profIdDet,
		(select sum(imp_prof_gasto_valor) from imp_prof_gasto where imp_prof_det_id=profIdDet and bestado=1) as gas,
		cotDet.pro_cantidad as cant,
		cotDet.pro_precio_compra as costUnid,
		(select costUnid*cant) as costTot,
		cotDet.cot_det_margen as margVent,
		cotDet.pro_precio_venta as preUnid,
		(select preUnid*cant) as preTot
		from
		cot_detalle as cotDet
		where
		cotDet.cotizacion_id=1498 and cotDet.bestado=1
		order by cotDet.cot_detalle_id asc;

		/* Reporte Pre-Calculo Gastos */
		select
		sum(impGast.imp_prof_gasto_valor) as gas
		from
		imp_proforma_detalle as impDet
		inner join imp_prof_gasto as impGast on impDet.imp_prof_det_id=impGast.imp_prof_det_id
		where
		impDet.cot_detalle_id='' and  impGast.bestado=1;

		/* Reporte Pre-Calculo Monto Total */
		select 
		sum(pro_subtotal) as total,
		moneda_id as moneId,
		(select mon_sigla from moneda where moneda_id=moneId) as sig
		from cot_detalle 
		where cotizacion_id='1498' and bestado=1;

	/*----------------------------------------------------------------------------------*/

/*----------------------------------[*]------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# CENTRO DE COSTO DE GASTO DE VENTAS
/*-------------------------------------------------------------------------------------------------------*/

	/*
		# Crear el centro de costo que contendra los gastos de visitas con CC-7012-2014 [OK]
			# generar centro de costo
			# generar fl
			# generar proyecto

		# generar un visita pero tbm que se asocie a centro de costo
			# añadir campo correlativo a visitas visiCorre -> visi_getCorre
	*/

		alter table tbvisi_visita
		add visiCorre char(15) after idVendeVisita;

	/*
		# modificacion de funcion capa negocio -> evaMontxTip
		# modificacion de funcion capa negocio -> evaTipDocOrd
		# modificar funcion de capa sql -> cc_getDetProyexId
		# cambio flujo creacion visita
			# correlativo visita
			# funcion de capa sql -> updateVisiGastos
			# correlativo correcto en reporte visita
			# asociar visita a centro de costo -> visi_asociCent
	*/
		insert into cc_detcentcost (cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_ocGeneId,cc_idEstCost)
		values (110,4,1,'','',1);
	/*
			# actualizar correlativos de visitas
			# modificar funcion de capa de negocio -> cs_evaIdOrd
			# añadir funcion popup2 a gestionador -> cc_gesti
			# añadir funcion  visi_geneRep que genere reporte a gestionador -> cc_gesti 
			# añadir el popup2 en la vista de centro de costos -> cc_asigPro
			# capturar id,fecha ini,fecha fin,vendedor de visita -> visi_getParamRepor
	*/
		SELECT fechIniVisi,fechFinVisi,idVendeVisita FROM `tbvisi_visita` where tbvisi_visita_id='';

	/*

			# añadir query en capa sql -> visi_totMontxMone
	*/

		select distinct
		cc_centCostId as pcId,
		(select sum(visi.pasaVisi+visi.hospeVisi+visi.alimeVisi+visi.transInterVisi) from tbvisi_visita as visi
		inner join cc_detcentcost as detCent on visi.visiCorre=detCent.cc_ocGeneId where detCent.cc_centCostId=pcId and visi.moneda_id=1) as totSolVisi,
		(select sum(visi.pasaVisi+visi.hospeVisi+visi.alimeVisi+visi.transInterVisi) from tbvisi_visita as visi
		inner join cc_detcentcost as detCent on visi.visiCorre=detCent.cc_ocGeneId where detCent.cc_centCostId=pcId and visi.moneda_id=2) as totDolVisi,
		(select sum(visi.pasaVisi+visi.hospeVisi+visi.alimeVisi+visi.transInterVisi) from tbvisi_visita as visi
		inner join cc_detcentcost as detCent on visi.visiCorre=detCent.cc_ocGeneId where detCent.cc_centCostId=pcId and visi.moneda_id=3) as totHebVisi
		from
		cc_detcentcost
		where
		cc_centCostId='';

	/*
			# actualizar calculo de totales en centro de costos detalle y su carga de ajax
			# actualizar calculo totales en carga ajax de historial centros de costos
			# query para obtener reporte detallado de visitas asociados a centro de costos
	*/

			select
			visi.idVendeVisita as vendId,
			visi.moneda_id as monId,
			(select concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) from persona as per where per.persona_id=vendId) as vend,
			(select mon_sigla from moneda where moneda_id=monId) as moneSigla,
			visi.fechIniVisi as fechIni,
			visi.fechFinVisi as fechFin,
			(visi.hospeVisi+visi.alimeVisi+visi.pasaVisi+visi.transInterVisi) as cosTot,
			visi.visiCorre as refe
			from
			tbvisi_visita as visi,
			cc_detcentcost as detCent
			where
			detCent.cc_centCostId='110' and
			detCent.cc_ocGeneId=visi.visiCorre;


	/*
			# plantilla para generar reporte de visitas en centro de costos -> cc_reporVisiCent
			# añadir query a capa sql para obtener usuario -> visi_userxId 
	*/

			select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as user from trabajador as trab
			inner join persona as per on trab.trabajador_id='' where trab.persona_id=per.persona_id;

	/*
			# añadir query en capa sql para obtener centro de costo -> visi_centCostxId
	*/

			select cc_correCenCost as correCent from cc_centcost where cc_centCostId='92';

/*--------------------------------------[*]--------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# TABLA DINAMICA DE CENTRO DE COSTO
/*-------------------------------------------------------------------------------------------------------*/

	/*
		Notas:
			- 1 o mas fechas por cada adelanto del cliente
			- 1 o mas fecha por cada adelanto al proveedor
	*/

	/*
		#CC 
		#N° orden
		#Fecha de orden
		Proveedor
		Cliente
		Equipo/Servicio
		Monto CC
		Monto Ordenes
		Incoterm
		Plazo de entrega
		Fecha pago adelanto del cliente
		Fecha pago adelanto proveedor
		Fecha de aprobacion planos
		Fecha entrega cliente
	
	--------------------------------------------------------------------

		Fecha Elaboracion de fabricacion
		Fecha Envio de planos a proveedor
		Fecha de pago de adelanto
		Fecha de entrega de equipo
		Fecha arrivo de equipo
		Fecha de transporte del equipo
	*/

	/* - STRUCTURA DE DE DATOS ----------------------------------------------------------------- */

	/*
		scc_seguiCent
			- scc_seguiCentId PK
			- scc_centCostId
			- scc_adelanCliId FK
			- scc_adelanProvId FK
			- scc_fechAprobPlan
			- scc_fechEntreCli
	*/

	/*
		scc_adelanCliProv
			- scc_adelanCliProvId
			- scc_seguiCentId
			- scc_tipAdelanId
			- scc_fechAdelan
			- scc_moneAdelanId
			- scc_totAdelan
	*/

	/*
		scc_tipAdelan
			- scc_tipAdelanId
			- scc_desTipAdelan
	*/

	/*
		scc_validSegui
			- scc_validSeguiId
			- scc_seguiCentId
			-
			- scc_tipValidId
			- scc_fechValid
	*/

	/*
		scc_tipValid
			- scc_tipValidId
			- scc_desTipValid
	*/

	/*
		scc_estaValid
			- scc_estaValidId
			- scc_desEstaValid	
	*/

	/*-------------------------------------------------*/
		# TABLE SEGUIMIENTO DE CENTRO DE COSTO
	/*-------------------------------------------------*/

		create table scc_seguiCent 
		(
				scc_seguiCentId int(11) primary key not null auto_increment, #PK
				scc_seguiCentCorre char(15),
				scc_seguiCentEstado int(11),
				#--------------------------
				scc_centCostId int(11) #FK
		);

		#--------------------MODIFICACION------------------------------------
		alter table scc_seguiCent
		add scc_seguiCentEstado int(11) after scc_seguiCentCorre;


	/*----------------------------------------------------*/
		# TABLE ADELANTOS
	/*----------------------------------------------------*/

		create table scc_adelan
		(
				scc_adelanId int(11) primary key not null auto_increment, #PK
				scc_adelanFech date,
				scc_adelanDes varchar(150),
				scc_adelanEstado int(11),
				#-----------------------------
				scc_seguiCentId int(11), #FK
				scc_compOrdId int(11), #FK
				scc_tipAdelId int(11) #FK
		);

		#--------------------MODIFICACION----------------------------------
		alter table scc_adelan
		add scc_adelanEstado int(11) after scc_adelanDes;

	/*----------------------------------------------*/
		# TABLE TIPO DE ADELANTOS
	/*----------------------------------------------*/

		create table scc_tipAdel
		(
			/*
				pago adelanto cliente
				pago adelanto proveedor
				aprobacion de planos
				entrega estimada a cliente
				otros
			*/
			scc_tipAdelId int(11) primary key not null auto_increment, #PK
			scc_tipAdelDes varchar(70),
			scc_tipAdelValid int(11)
		);

		#--------------------MODIFICACION--------------------------------
		alter table scc_tipAdel
		add scc_tipAdelValid int(11) after scc_tipAdelDes;

		#---------------------RESTRICCION---------------------------------
		alter table scc_adelan
		add constraint fk_scc_seguiCentId foreign key (scc_seguiCentId) references scc_seguiCent(scc_seguiCentId),
		add constraint fk_scc_tipAdelId foreign key (fk_scc_tipAdelId) references fk_scc_tipAdel(fk_scc_tipAdelId);

	/*-----------------------------------------*/
		# TABLE VALIDACION DE SEGUIMIENTO
	/*----------------------------------------*/

		create table scc_validSegui
		(
			scc_validSeguiId int(11) primary key not null auto_increment, #PK
			scc_validSeguiFech date,
			#------------------------------
			scc_seguiCentId int(11), #FK
			scc_compOrdId int(11), #FK
			scc_tipValidId int(11), #FK 
			scc_estaValidId int(11), #FK
			scc_estGenId int(11) #FK
		);

		#-------------------MODIFICACION------------------------------
		alter table scc_validSegui
		change scc_validSeguiDes scc_validSeguiFech date;

		#---------------------RESTRICCION-------------------------------------------
		alter table scc_validSegui
		add constraint fk2_scc_seguiCentId foreign key (scc_seguiCentId) references scc_seguiCent(scc_seguiCentId),
		add constraint fk_scc_tipValidId foreign key (scc_tipValidId) references scc_tipValid(scc_tipValidId),
		add constraint fk_scc_estaValidId foreign key (scc_estaValidId) references scc_estaValid(scc_estaValidId),
		add constraint fk_scc_estGenId foreign key (scc_estGenId) references scc_estaGen(scc_estGenId);

	/*---------------------------------------------*/
		# TABLE ESTADO DE GENERACION
	/*--------------------------------------------*/

		create table scc_estaGen
		(
			/*
				generado
				no generado
			*/
			scc_estGenId int(11) primary key not null auto_increment, #PK
			scc_estGenDes varchar(50)
		);

	/*------------------------------------------------*/
		# TABLE TIPO DE VALIDACION
	/*------------------------------------------------*/
	
		create table scc_tipValid
		(	
			/*
				Envio de planos del proveedor
				Aprobacion de planos del cliente
				Adelanto del cliente
				Envio de planos aprobados al proveedor
				Pago de adelanto al proveedor
				Inicio de fabricacion
				Recepcion de protocolos de prueba
				Validacion de protocolos
				Entrega de equipo
				Arrivo de equipo al puerto de callao
				Nacionalización y entrega en nuestros almacenes
				Control de calidad interno
				Entrega final de los equipos en sus almacenes
				Salida almacén EW cliente
			*/
			scc_tipValidId int(11) primary key not null auto_increment, #PK
			scc_tipValidDes varchar(50)
		);

	/*--------------------------------------------*/
		# TABLE ESTADO DE VALIDACION
	/*--------------------------------------------*/
	
		create table scc_estaValid
		(
			/*
				validado
				pendiente
			*/
			scc_estaValidId int(11) primary key not null auto_increment, #PK
			scc_estaValidDes varchar(50),
			scc_estaValidRutImg varchar(150)
		);

	/* TABLE COMPRAS [EXISTE] */

		alter table compras
		add comp_fechReal date after comp_plazo; 

		alter table compras
		add comp_plazoFabri int(11) after comp_fechReal;

		alter table compras
		add comp_plazoInter int(11) after comp_fechReal,
		add comp_plazoExter int(11) after comp_plazoInter;

	/* TABLE CENTRO DE COSTO [EXISTE] */

		alter table cc_centcost
		add cc_termDay int(11) default 0 after cc_fileAdju;
	
	
	/* - RESTRICCIONES ------------------------------------------------------------------------- */
	 

	/* FLOW'S VIEWS AND RESOURCES */

		/*
			Vistas:
					nombre: scc_creadSegui
					descripcion: creacion de seguimiento
					detalle: 
							- usuario:
								ingresa a la vista
								filtra centros de costos
								selecciona centro de costo
								genera seguimiento de centro
								visualiza el centro generado

					nombre: scc_detSegui
					descripcion: detalle de seguimiento
					detalle:
							- usuario:
								ingresa a la vista
								visualiza informacion general de centro
								ingresa adelantos de proveedor o cliente
								valida proceso de seguimiento

			Sub-Vistas:

			Javascript:
					name: scc_gesti

			Css:
					name: scc_deco

			Ajax:

					name:scc_detSegui_ajax

			Json:
					name: scc_creadSegui_json
					name: scc_detSegui_json

			images:
					name:scc_detail

					name:scc_segui

					name:scc_gene
			negocio:
					name:scc_negocio

			sql:
					name:scc_sql

			controller up:

					name:scc_controSup

			controller down:

					name:scc_controInf

			reporte:
					
					name:scc_repSeguiCent

	*/

	/*- PERSISTENCIA ----------------------------------------------------------------------------*/

	# actualizar correlativos de centro de costos [test]
		update cc_centcost set 
		cc_correCenCost=concat('CC-',LPAD(cc_centCostId, 5, '0' ))
		where cc_centCostId!=110;

	# obtener centro de costos abiertos [scc_centCost] ####### OK #######
		select
		centCost.cc_correCenCost,
		centCost.cc_centCostId,
		centCost.cc_idProye as idProye,
		(select proy_nombre from proyecto where proyecto_id=idProye) as desProye
		from
		cc_centcost as centCost
		where
		centCost.cc_idEstApe=1;

		# [PROCEDURE]
			DELIMITER $$ 
			CREATE PROCEDURE scc_centCost()
			BEGIN
			/* Centro costos */
			COMMENT 'Centro de costos'
			select 
			centCost.cc_correCenCost as centVal,
			centCost.cc_centCostId as centId
			from cc_centcost as centCost
			where centCost.cc_idEstApe=1;
			END;
		
	# generar seguimiento de centro de costo [scc_geneSegui] ########## OK #############
		insert into scc_seguiCent (scc_centCostId) values ('');

		update scc_seguiCent set scc_seguiCentCorre='' where scc_centCostId='';

		# [FUNCTION]
			DELIMITER $$
			CREATE FUNCTION scc_geneSegui($centId int(11))
			RETURNS varchar(50)
			COMMENT 'Generacion de seguimiento'
			BEGIN
			/* Generacion de seguimiento */
			declare $msj varchar(50);
			declare $codSegui int(11);
			declare $tamCorre int(11);
			declare $correSegui char(15);
			declare $cantRow int(11);

			insert into scc_seguiCent (scc_centCostId,scc_seguiCentEstado) values ($centId,1);

			set $codSegui=(select LAST_INSERT_ID());
			set $tamCorre=(select length($codSegui));

			if($tamCorre>5) then
				set $tamCorre=$tamCorre;
			else
				set $tamCorre=5;
			end if;

			set $correSegui=(select concat('SC-',LPAD($codSegui,$tamCorre,'0')));

			update scc_seguiCent set scc_seguiCentCorre=$correSegui where scc_seguiCentId=$codSegui;

			set $cantRow=(select ROW_COUNT());
			set $msj=(select concat('<div class=success>','Filas afectadas:',' ',$cantRow,'</div>'));

			RETURN $msj;
			END;

	# seguimiento generado de centro de costo [scc_seguiGen] ######### OK ############

		select
		seguiCent.scc_seguiCentId as item,
		seguiCent.scc_seguiCentCorre as sc,
		cent.cc_correCenCost as cc
		from
		scc_seguiCent as seguiCent,
		cc_centcost as cent
		where
		seguiCent.scc_centCostId=cent.cc_centCostId;

		# [PROCEDURE]

		CREATE PROCEDURE scc_seguiGen()
		COMMENT 'Seguimiento de centro de costo'
		BEGIN
		/* Seguimiento de centro de costo */
		select
		seguiCent.scc_seguiCentId as item,
		seguiCent.scc_seguiCentCorre as sc,
		cent.cc_correCenCost as cc,
		proye.proy_nombre as proyecto
		from
		scc_seguiCent as seguiCent,
		cc_centcost as cent,
		proyecto as proye
		where
		seguiCent.scc_centCostId=cent.cc_centCostId and
		proye.proyecto_id=cent.cc_idProye and seguiCent.scc_seguiCentEstado=1;
		end;

	# eliminar seguimiento de centro de costos [scc_eliSegui] ######### OK ############

		update scc_seguiCent set scc_seguiCentEstado=0 where scc_seguiCentId='';

		# [FUNCTION]

		DELIMITER $$
		CREATE FUNCTION scc_eliSegui($codSegui int(11))
		RETURNS varchar(50)
		COMMENT 'Eliminar seguimiento de centro'
		BEGIN
		/* Eliminar seguimiento de centro */
		declare $msj varchar(50);
		declare $rowAfect int(11);
		update scc_seguiCent set scc_seguiCentEstado=0 where scc_seguiCentId=$codSegui;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		return $msj;	
		end;

	# obtener datos generales de seguimiento de centro de costo [scc_datGenSegui] ######## OK #########

		select
		seguiCent.scc_seguiCentCorre as sc,
		centCost.cc_correCenCost as cc,
		emp.emp_nombre as cliente,
		proye.proy_nombre as proyecto,
		centCost.cc_montCoti as monto,
		mone.mon_sigla as moneda,
		centCost.cc_ocFechCli as fechIni,
		centCost.cc_ocFechEntre as fechEntre
		from scc_seguiCent as seguiCent
		inner join cc_centcost as centCost on seguiCent.scc_centCostId=centCost.cc_centCostId
		inner join empresa as emp on emp.empresa_id=centCost.cc_idCliEmp
		inner join proyecto as proye on proye.proyecto_id=centCost.cc_idProye
		inner join moneda as mone on mone.moneda_id=centCost.cc_moneId
		where seguiCent.scc_seguiCentId=37;

		# [PROCEDURE]

		DELIMITER $$
		CREATE PROCEDURE scc_datGenSegui($idSegui int(11))
		COMMENT 'datos generales de seguimiento'
		BEGIN
		/* Datos generales de seguimiento */
		select
		seguiCent.scc_seguiCentCorre as sc,
		centCost.cc_correCenCost as cc,
		emp.emp_nombre as cliente,
		proye.proy_nombre as proyecto,
		centCost.cc_montCoti as monto,
		mone.mon_sigla as moneda,
		centCost.cc_ocFechCli as fechIni,
		centCost.cc_ocFechEntre as fechEntre,
		centCost.cc_termDay as termDay
		from scc_seguiCent as seguiCent
		inner join cc_centcost as centCost on seguiCent.scc_centCostId=centCost.cc_centCostId
		inner join empresa as emp on emp.empresa_id=centCost.cc_idCliEmp
		inner join proyecto as proye on proye.proyecto_id=centCost.cc_idProye
		inner join moneda as mone on mone.moneda_id=centCost.cc_moneId
		where seguiCent.scc_seguiCentId=$idSegui;
		end;

	# obtener ordenes de seguimiento de centro de costo [scc_ordSeguiCent] ########### OK ###########

		select
		comp.comp_nro as ordDes,
		comp.compras_id as ordId
		from scc_seguiCent as seguiCent 
		inner join cc_centcost as centCost on centCost.cc_centCostId=seguiCent.scc_centCostId 
		inner join cc_detcentcost as detCent on detCent.cc_centCostId=centCost.cc_centCostId
		inner join compras as comp on comp.comp_nro=detCent.cc_ocGeneId
		where seguiCent.scc_seguiCentId=40;

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE scc_ordSeguiCent($idSegui int(11))
		COMMENT 'Ordenes de seguimiento de centro'
		BEGIN
		/* Ordenes de seguimiento de centro */
		select
		comp.comp_nro as ordDes,
		comp.compras_id as ordId
		from scc_seguiCent as seguiCent 
		inner join cc_centcost as centCost on centCost.cc_centCostId=seguiCent.scc_centCostId 
		inner join cc_detcentcost as detCent on detCent.cc_centCostId=centCost.cc_centCostId
		inner join compras as comp on comp.comp_nro=detCent.cc_ocGeneId
		where seguiCent.scc_seguiCentId=$idSegui;
		end;			

	# obtener datos de orden de compra [scc_datOrdComp] ########## OK ##############

		select
		emp.emp_nombre as proveedor,
		comp.tipo_precio_id as tipPrecId,
		(select imp_tc_nombre from imp_tipo_costo where imp_tipo_costo_id=tipPrecId) as incoterm,
		comp.comp_plazo as plazoEntre,
		format(sum(compDet.prod_cantidad*compDet.prod_precio_venta),2) as monto,
		mone.mon_sigla as moneda, 
		proye.proy_nombre as equipServ,
		comp.comp_plazoFabri as plazFab,
		comp.comp_plazoInter as plazInter,
		comp.comp_plazoExter as plazExter 
		from compras as comp
		inner join compras_detalle as compDet on compDet.compras_id=comp.compras_id
		inner join empresa as emp on emp.empresa_id=comp.proveedor_id
		inner join moneda as mone on mone.moneda_id=comp.moneda_id
		inner join proyecto as proye on proye.proyecto_id=comp.proyecto_id
		where comp.compras_id=370 and compDet.bestado=1;

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE scc_datOrdComp($idOrd int(11))
		COMMENT 'Datos de orden de compras'
		BEGIN
		/* Datos de orden de compras */
		select
		emp.emp_nombre as proveedor,
		comp.tipo_precio_id as tipPrecId,
		(select imp_tc_nombre from imp_tipo_costo where imp_tipo_costo_id=tipPrecId) as incoterm,
		comp.comp_plazo as plazoEntre,
		(
			case  
			when isNull(format(sum(compDet.prod_cantidad*compDet.prod_precio_venta),2))
			then '' else format(sum(compDet.prod_cantidad*compDet.prod_precio_venta),2)
			end
		) as monto,
		(
			case
			when isNull(mone.mon_sigla)
			then '' else mone.mon_sigla
			end
		) as moneda, 
		proye.proy_nombre as equipServ,
		comp.comp_plazoFabri as plazFab,
		comp.comp_plazoInter as plazInter,
		comp.comp_plazoExter as plazExter
		from compras as comp
		inner join compras_detalle as compDet on compDet.compras_id=comp.compras_id
		inner join empresa as emp on emp.empresa_id=comp.proveedor_id
		inner join moneda as mone on mone.moneda_id=comp.moneda_id
		inner join proyecto as proye on proye.proyecto_id=comp.proyecto_id
		where comp.compras_id=$idOrd and compDet.bestado=1;
		end;

	# Obtener tipos de adelantos para seguimiento de centro [scc_tipAdelSegui] ####### OK #########

		select
		tipAdel.scc_tipAdelDes as tipAdelDes,
		tipAdel.scc_tipAdelId as tipAdelId
		from scc_tipAdel as tipAdel;

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE scc_tipAdelSegui()
		COMMENT 'tipos de adelantos para seguimiento'
		BEGIN
		/* tipos de adelantos para seguimiento */
		select
		tipAdel.scc_tipAdelDes as tipAdelDes,
		tipAdel.scc_tipAdelId as tipAdeId
		from scc_tipAdel as tipAdel;
		end;

	# Añadir adelanto de la orden del seguimiento [scc_adelOrdSegui] ####### OK ##########

		 insert into scc_adelan (scc_tipAdelId,scc_adelanFech,scc_adelanDes,scc_adelanEstado,scc_seguiCentId,scc_compOrdId) 
		 values ('','','',1,'','');

		 # [FUNCTION]
		 DELIMITER $$
		 CREATE FUNCTION scc_adelOrdSegui($tipAdelId int(11),$adelFech date,$adelDes varchar(200),$seguiCentId int(11),$compOrdId int(11))
		 RETURNS varchar(50)
		 COMMENT 'Añadir adelanto de la orden'
		 BEGIN
		 declare $rowAfect int(11);
		 declare $msj varchar(50);
		 insert into scc_adelan (scc_tipAdelId,scc_adelanFech,scc_adelanDes,scc_adelanEstado,scc_seguiCentId,scc_compOrdId) 
		 values ($tipAdelId,$adelFech,$adelDes,1,$seguiCentId,$compOrdId);
		 set $rowAfect=(select ROW_COUNT());
		 set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		 return $msj;
		 END;

	# obtener detalle de adelantos de la orden del seguimiento [scc_detAdelOrd] ######## OK ##########

		select
		tipAdel.scc_tipAdelDes as tipAdel,
		adel.scc_adelanFech as fechAdel,
		adel.scc_adelanDes as desAdel
		from scc_adelan as adel
		inner join scc_tipAdel as tipAdel on tipAdel.scc_tipAdelId=adel.scc_tipAdelId
		where adel.scc_seguiCentId='' and adel.scc_compOrdId='';

		# [PROCEDURE] -> [OK]
		DELIMITER $$
		CREATE PROCEDURE scc_detAdelOrd($idSegui int(11),$idOrd int(11))
		COMMENT 'detalle de adelantos de la orden'
		BEGIN
		select
		adel.scc_adelanId as idAdel,
		tipAdel.scc_tipAdelDes as tipAdel,
		adel.scc_adelanFech as fechAdel,
		adel.scc_adelanDes as desAdel,
		tipAdel.scc_tipAdelId as ordTip
		from scc_adelan as adel
		inner join scc_tipAdel as tipAdel on tipAdel.scc_tipAdelId=adel.scc_tipAdelId
		where adel.scc_seguiCentId=$idSegui and adel.scc_compOrdId=$idOrd and adel.scc_adelanEstado=1;
		end;

	# eliminar adelanto de seguimiento de centro de costo [scc_eliAdelSegui] ########## OK ########

		update scc_adelan set scc_adelanEstado=0 where scc_adelanId='';

		# [FUNCTION] -> [OK]
		DELIMITER $$
		CREATE FUNCTION scc_eliAdelSegui($idAdel int(11))
		RETURNS varchar(50)
		COMMENT 'eliminar adelanto de seguimiento'
		BEGIN
		declare $msj varchar(50);
		declare $rowAfect int(11);
		update scc_adelan set scc_adelanEstado=0 where scc_adelanId=$idAdel;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		return $msj;
		end;

	# obtener adelanto del seguimiento de la orden por id [scc_adelSeguixId] ######### OK ###########

		select
		scc_adelanId as idAdel,
		scc_tipAdelId as tipId,
		scc_adelanFech as fechAdel,
		scc_adelanDes as desAdel
		from
		scc_adelan
		where
		scc_adelanId='';


		# [PROCEDURE] -> [OK]
		DELIMITER $$
		CREATE PROCEDURE scc_adelSeguixId($idAdel int(11))
		COMMENT 'obtener adelanto del seguimiento'
		BEGIN
		select
		scc_adelanId as idAdel,
		scc_tipAdelId as tipId,
		scc_adelanFech as fechAdel,
		scc_adelanDes as desAdel
		from
		scc_adelan
		where
		scc_adelanId=$idAdel;
		end;

	# actualizar adelanto del seguimiento de la orden por id [scc_actuAdelxId] ######## OK ###########

		update 
		scc_adelan set scc_tipAdelId='',
		scc_adelanFech='',
		scc_adelanDes='' where scc_adelanId='';
		
		# [FUNCTION] -> [OK]
		DELIMITER $$
		CREATE FUNCTION scc_actuAdelxId($idAdel int(11),$tipAdel int(11),$fechAdel date,$desAdel varchar(150))
		RETURNS varchar(50)
		COMMENT 'actualizar adelanto del seguimiento'
		BEGIN
		declare $msj varchar(50);
		declare $rowAfect int(11);
		update 
		scc_adelan set scc_tipAdelId=$tipAdel,
		scc_adelanFech=$fechAdel,
		scc_adelanDes=$desAdel 
		where scc_adelanId=$idAdel;
		set $rowAfect=(select ROW_COUNT());	
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		return $msj;
		end;

	# generar seguimiento de orden de compra del proyecto [scc_geneSeguiOrd] ######## OK ##########

		insert into scc_validSegui(scc_seguiCentId,scc_compOrdId,scc_tipValidId,scc_estaValidId) 
		select '','',scc_tipValidId,2 from scc_tipValid;

		# [FUNCTION] -> [OK]
		DELIMITER $$
		CREATE FUNCTION scc_geneSeguiOrd($idSegui int(11),$idOrd int(11))
		RETURNS varchar(50)
		COMMENT 'generar seguimiento de orden de compra'
		BEGIN
		declare $msj varchar(50);
		declare $rowAfect int(11);
		insert into scc_validSegui(scc_seguiCentId,scc_compOrdId,scc_tipValidId,scc_estaValidId) 
		select $idSegui,$idOrd,scc_tipValidId,2 from scc_tipValid;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		return $msj;
		end;
		
	# evaluar si la orden de compra ya  genero seguimiento [scc_evaExiSegui] ########## OK ##########

		select count(*) as contSegui from scc_validSegui where scc_compOrdId='' and scc_seguiCentId='';

		# [FUNCTION] -> [OK]
		DELIMITER $$
		CREATE FUNCTION scc_evaExiSegui($idSegui int(11),$idOrd int(11))
		RETURNS int(11)
		COMMENT 'evaluar si la orden de compra ya  genero seguimiento'
		BEGIN
		declare $contSegui int(11);
		set $contSegui=(select count(*) from scc_validSegui where scc_compOrdId=$idOrd and scc_seguiCentId=$idSegui);
		return $contSegui;
		end;

	# validar seguimiento de orden compra [scc_valiSeguiOrd] ######## OK ###########

		update scc_validSegui set scc_tipValidId=1 where scc_validSeguiId='';

		# [FUNCTION] -> [OK]
		DELIMITER $$
		CREATE FUNCTION scc_valiSeguiOrd($idValid int(11),$rowAten int(11))
		RETURNS varchar(50)
		COMMENT 'validar seguimiento de orden compra'
		BEGIN
		declare $msj varchar(50);
		declare $rowAfect int(11);
		update scc_validSegui set scc_estaValidId=1,scc_validSeguiFech=date_format(NOW(),'%Y/%m/%d') 
		where scc_validSeguiId=$idValid;
		set $rowAfect=(select ROW_COUNT() );
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect+$rowAten,'</div>'));
		return $msj;
		end;

	# revertir validacion de seguimiento de orden de compra [scc_reverValiSegui] ####### OK ########

		update scc_validSegui set scc_tipValidId=2 where scc_validSeguiId=''; 

		# [FUNCTION] -> [OK]
		DELIMITER $$
		CREATE FUNCTION scc_reverValiSegui($idValid int(11),$rowAten int(11))
		RETURNS varchar(50)
		COMMENT 'revertir validacion de seguimiento de orden'
		BEGIN
		declare $msj varchar(50);
		declare $rowAfect int(11);
		update scc_validSegui set scc_estaValidId=2,scc_validSeguiFech=date_format('000-00-00','%Y/%m/%d') 
		where scc_validSeguiId=$idValid;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect+$rowAten,'</div>'));
		return $msj;
		end;

	# obtener seguimiento de orden de compra del proyecto [scc_seguiOrdProye] ######## OK ########

		select 
		validSegui.scc_validSeguiId as idValid,
		tipValid.scc_tipValidDes as tipValid,
		estaValid.scc_estaValidRutImg as rutImg,
		estaValid.scc_estaValidDes as estaValid,
		validSegui.scc_validSeguiFech as fechValid
		from 
		scc_validSegui as validSegui,
		scc_tipValid as tipValid,
		scc_estaValid as estaValid
		where
		validSegui.scc_tipValidId=tipValid.scc_tipValidId
		and estaValid.scc_estaValidId=validSegui.scc_estaValidId
		and validSegui.scc_compOrdId='' 
		and validSegui.scc_seguiCentId='';

		# [PROCEDURE] -> [OK]
		DELIMITER $$
		CREATE PROCEDURE scc_seguiOrdProye($idSegui int(11),$idOrd int(11))
		COMMENT 'obtener seguimiento de orden de compra'
		BEGIN
		select 
		validSegui.scc_validSeguiId as idValid,
		tipValid.scc_tipValidDes as tipValid,
		estaValid.scc_estaValidRutImg as rutImg,
		estaValid.scc_estaValidDes as estaValid,
		validSegui.scc_validSeguiFech as fechValid
		from 
		scc_validSegui as validSegui,
		scc_tipValid as tipValid,
		scc_estaValid as estaValid
		where
		validSegui.scc_tipValidId=tipValid.scc_tipValidId
		and estaValid.scc_estaValidId=validSegui.scc_estaValidId
		and validSegui.scc_compOrdId=$idOrd 
		and validSegui.scc_seguiCentId=$idSegui;
		end;

	# seguimiento del plazo de las ordenes  [scc_seguiOrdPlaz] ######### OK ##########

		select
		seguiCent.scc_seguiCentId as idSegui,
		comp.comp_nro as ordDes,
		comp.compras_id as ordId,
		comp.comp_plazo as plazo,
		(select count(*) from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=3 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as contAprobPlan,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=3 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as FechAprobPlan,
		(select count(*) from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=5 
		and scc_adelanEstado=1
		and scc_seguiCentId=idSegui) as contAprobPag,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=5 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as FechAprobPag,
		(select (case when (contAprobPlan>0 and contAprobPag>0) 
		then (select case when (FechAprobPlan>FechAprobPag) then date_add(FechAprobPlan,interval plazo day) else date_add(FechAprobPag,interval plazo day) end ) else 0 end) ) as fechEntre,
		date_format(NOW(),'%Y-%m-%d') as fechaActual,
		(select if(DATEDIFF(fechEntre,fechaActual)<0,0,DATEDIFF(fechEntre,fechaActual)) ) as diasVencer,
		(select if(DATEDIFF(fechEntre,fechaActual)<0,DATEDIFF(fechEntre,fechaActual)*-1,0) ) as diasVencidos
		from scc_seguiCent as seguiCent 
		inner join cc_centcost as centCost on centCost.cc_centCostId=seguiCent.scc_centCostId 
		inner join cc_detcentcost as detCent on detCent.cc_centCostId=centCost.cc_centCostId
		inner join compras as comp on comp.comp_nro=detCent.cc_ocGeneId
		where seguiCent.scc_seguiCentId=50;

		#[PROCEDURE]

		DELIMITER $$
		CREATE PROCEDURE scc_seguiOrdPlaz($seguiId int(11))
		COMMENT 'seguimiento del plazo de las ordenes'
		BEGIN
		declare $avenciSem int(11);
		declare $venciSem int(11);
		set $avenciSem=0;
		set $venciSem=0;	
		select
		centCost.cc_termDay as termDay,
		seguiCent.scc_seguiCentId as idSegui,
		seguiCent.scc_seguiCentCorre as correCent,
		centCost.cc_correCenCost as centVal,
		centCost.cc_idProye as idProye,
		(select proy_nombre from proyecto where proyecto_id=idProye) as desProye,
		comp.comp_nro as ordDes,
		comp.compras_id as ordId,
		comp.comp_plazoInter as plazInter,
		comp.comp_plazoExter as plazExter,
		centCost.cc_ocFechCli as fechIni,
		(select if(isnull(centCost.cc_ocFechEntre),'000-00-00',centCost.cc_ocFechEntre)) as fechFin,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=1) as s1,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=2) as s2,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=3) as s3,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=4) as s4,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=5) as s5,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=6) as s6,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=7) as s7,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=8) as s8,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=9) as s9,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=10) as s10,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=11) as s11,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=12) as s12,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=13) as s13,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=14) as s14,						
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=1) as f1,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=2) as f2,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=3) as f3,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=4) as f4,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=5) as f5,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=6) as f6,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=7) as f7,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=8) as f8,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=9) as f9,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=10) as f10,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=11) as f11,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=12) as f12,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=13) as f13,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId and scc_seguiCentId=idSegui and scc_adelanEstado=1 and scc_tipAdelId=14) as f14,
		comp.comp_plazo as plazoIni,
		comp.comp_plazoFabri as plazoFab,
		(select if(isnull(plazoIni),0,plazoIni)) as plazo,
		(select if (isnull(plazoFab),0,plazoFab)) as plazoFabri,
		# Plazos de entrega al cliente
		(select count(*) from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=4 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as contAprobPlan,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=4 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as FechAprobPlan,
		(select count(*) from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=5 
		and scc_adelanEstado=1
		and scc_seguiCentId=idSegui) as contAprobPag,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=5 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as FechAprobPag,
		# Plazos de entrega al proveedor
		(select count(*) from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=4 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as contPlanosProv,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=4 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as fechPlanosProv,
		(select count(*) from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=5 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as contPagoProv,
		(select scc_adelanFech from scc_adelan where scc_compOrdId=ordId 
		and scc_tipAdelId=5 
		and scc_adelanEstado=1 
		and scc_seguiCentId=idSegui) as fechPagoProv,
		# Evaluacion de fechas para cliente v.1
		(select (case when (contAprobPlan>0 and contAprobPag>0) 
		then (select case when (FechAprobPlan>FechAprobPag) then FechAprobPlan else FechAprobPag end ) else 0 end) ) as fechParti,
		(select (case when (contAprobPlan>0 and contAprobPag>0) 
		then (select case when (FechAprobPlan>FechAprobPag) then date_add(FechAprobPlan,interval plazo day) else date_add(FechAprobPag,interval plazo day) end ) else 0 end) ) as fechEntreEsti,
		# Evaluacion de fechas para proveedor v.1
		(select (case when (contPlanosProv>0 and contPagoProv>0) 
		then (select case when (fechPlanosProv>fechPagoProv) then fechPlanosProv else fechPagoProv end ) else 0 end) ) as fechProvParti,
		(select (case when (contPlanosProv>0 and contPagoProv>0) 
		then (select case when (fechPlanosProv>fechPagoProv) then date_add(fechPlanosProv,interval plazoFabri day) else date_add(fechPagoProv,interval plazoFabri day) end ) else 0 end) ) as fechProvEsti,
		# ---------------------------------------------------------------------------------------------
		# Evaluacion de fechas para clientes v.2
		comp.comp_fechReal as fechRealIni,						
		(select if(isnull(fechRealIni),date_format('000-00-00','%Y-%m-%d'),fechRealIni)) as fechReal,
		(select if(fechEntreEsti>fechReal,fechEntreEsti,fechReal)) as fechEntre,
		# Evaluacion de fechas para proveedor v.2
		comp.comp_fechReal as fechRealIniProv,						
		(select if(isnull(fechRealIniProv),date_format('000-00-00','%Y-%m-%d'),fechRealIniProv)) as fechRealProv,
		(select if(fechProvEsti>fechRealProv,fechProvEsti,fechRealProv)) as fechEntreProv,
		# ----------------------------------------------------------------------
		date_format(NOW(),'%Y-%m-%d') as fechaActual,
		# ----------------------------------------------------------------------
		# Evaluacion de fechas para clientes v.3
		(select if(DATEDIFF(fechEntre,fechaActual)<0,0,DATEDIFF(fechEntre,fechaActual)) ) as diasVencer,
		(select if(DATEDIFF(fechEntre,fechaActual)<0,DATEDIFF(fechEntre,fechaActual)*-1,0) ) as diasVencidos,
		(select TIMESTAMPADD(DAY,(0-WEEKDAY(fechaActual)),fechaActual)) as fechRangIni,  
		(select TIMESTAMPADD(DAY,(6-WEEKDAY(fechaActual)),fechaActual)) as fechRangFin,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_adelanEstado=1
		and scc_seguiCentId=idSegui) as valiItoTot,
		(select if(fechaActual>=fechRangIni and fechaActual<=fechRangFin and fechaActual<=fechEntre and fechEntre<=fechRangFin and valiItoTot<6,$avenciSem+1,$avenciSem)) as avenciSem,
		(select if(diasVencidos>0 and valiItoTot<6,$venciSem+1,$venciSem)) as venciSem,
		# Evaluacion de fechas para proveedor v.3
		(select if(DATEDIFF(fechEntreProv,fechaActual)<0,0,DATEDIFF(fechEntreProv,fechaActual)) ) as diasVencerProv,
		(select if(DATEDIFF(fechEntreProv,fechaActual)<0,DATEDIFF(fechEntreProv,fechaActual)*-1,0) ) as diasVencidosProv,
		(select TIMESTAMPADD(DAY,(0-WEEKDAY(fechaActual)),fechaActual)) as fechRangIni2,  
		(select TIMESTAMPADD(DAY,(6-WEEKDAY(fechaActual)),fechaActual)) as fechRangFin2,
		(select count(*) from scc_adelan where scc_compOrdId=ordId and scc_adelanEstado=1
		and scc_seguiCentId=idSegui) as valiItoTot2,
		(select if(fechaActual>=fechRangIni2 and fechaActual<=fechRangFin2 and fechaActual<=fechEntreProv and fechEntreProv<=fechRangFin2 and valiItoTot2<6,$avenciSem+1,$avenciSem)) as avenciSemProv,
		(select if(diasVencidosProv>0 and valiItoTot2<6,$venciSem+1,$venciSem)) as venciSemProv
		from scc_seguiCent as seguiCent 
		inner join cc_centcost as centCost on centCost.cc_centCostId=seguiCent.scc_centCostId 
		inner join cc_detcentcost as detCent on detCent.cc_centCostId=centCost.cc_centCostId
		inner join compras as comp on comp.comp_nro=detCent.cc_ocGeneId
		where seguiCent.scc_seguiCentId=$seguiId order by idSegui ASC;
		end;

	# evaluar si la orden ya tiene un adelanto [scc_evaExisAdel] ####### OK #############

		select
		count(*)
		from 
		scc_adelan
		where
		scc_adelanEstado=1 and
		scc_compOrdId='' and
		scc_seguiCentId='' and
		scc_tipAdelId='';

		# [FUNCTION]

		DELIMITER $$
		CREATE FUNCTION scc_evaExisAdel($idSegui int(11),$idOrd int(11),$idTipAdel int(11))
		RETURNS int(11)
		COMMENT 'evaluar si la orden ya tiene un adelanto'
		BEGIN
		declare $contAdel int(11);
		set $contAdel=(select count(*) from scc_adelan where scc_adelanEstado=1 and scc_compOrdId=$idOrd and
		scc_seguiCentId=$idSegui and scc_tipAdelId=$idTipAdel);
		return $contAdel;
		end;

	# actualizar fecha de entrega real de la orden de compra [scc_actFechaReal] ######## OK ##########

		update compras set comp_fechReal='' where compras_id='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION scc_actFechaReal($fechReal date,$compId int(11))
		RETURNS varchar(50)
		COMMENT 'actualizar fecha de entrega real'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(50);
		update compras set comp_fechReal=$fechReal where compras_id=$compId;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		return $msj;
		end;

	# actualizar plazo de fabricacion de la orden [scc_actuPlazFab] ########### OK #############

		update compras set comp_plazoFabri='' where compras_id='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION scc_actuPlazFab($plazfab int(11),$compId int(11))
		RETURNS varchar(50)
		COMMENT 'actualizar plazo de fabricacion de la orden'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(50);
		update compras set comp_plazoFabri=$plazfab where compras_id=$compId;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>','Filas afectadas: ',$rowAfect,'</div>'));
		return $msj;
		end;

	# validar flujo de adelantos de ordenes [scc_valiFlujAdel] ########### OK ##############

		# parametro de validacion esperado
		select scc_tipAdelValid as tipAdelValid from scc_tipAdel where scc_tipAdelId='';

		# parametro de validacion actual
		select sum(scc_tipAdelId) as valiAct from scc_adelan where scc_adelanEstado=1 and  scc_seguiCentId='' and scc_compOrdId=''

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION scc_valiFlujAdel($seguiId int(11),$ordId int(11),$tipAdel int(11))
		RETURNS int(11)
		COMMENT 'validar flujo de adelantos de ordenes'
		BEGIN
		declare $validReque int(11);
		declare $validAct int(11);
		declare $valiResul int(11);
		set $validReque=(select scc_tipAdelValid as tipAdelValid from scc_tipAdel where scc_tipAdelId=$tipAdel);
		set $validAct=(select if(isnull(sum(scc_tipAdelId)),0,sum(scc_tipAdelId)) as valiAct from scc_adelan where scc_adelanEstado=1 and  scc_seguiCentId=$seguiId and scc_compOrdId=$ordId);

		if($validAct=$validReque) then
			set $valiResul=1;
		else
			set $valiResul=0;
		end if;
		return $valiResul;
		end;

	# validar creacion de centro de costo [scc_valiGeneSegui] ############# OK ################


		select count(scc_seguiCentId) from scc_seguiCent where scc_seguiCentEstado=1 and scc_centCostId='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION scc_valiGeneSegui($idCent int(11))
		RETURNS int(11) 
		COMMENT 'validar creacion de centro de costo'
		BEGIN
		declare $cantValid int(11);
		set $cantValid=(select if(isnull(count(scc_seguiCentId)),0,count(scc_seguiCentId)) from scc_seguiCent where scc_seguiCentEstado=1 and scc_centCostId=$idCent);
		return $cantValid;
		end;

	# actualizar plazo adicional del proyecto [scc_plazAdi_actu] ############ OK #################

		update cc_centcost as cc inner join scc_seguiCent as scc on scc.scc_centCostId=cc.cc_centCostId  
		set cc.cc_termDay='' where scc.scc_seguiCentId='';

		# [FUNCTION]

		DELIMITER $$
		CREATE FUNCTION scc_plazAdi_actu($diAd int(11),$segId int(11))
		RETURNS varchar(50)
		COMMENT 'actualizar plazo adicional del proyecto'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(50);
		update cc_centcost as cc inner join scc_seguiCent as scc on scc.scc_centCostId=cc.cc_centCostId  
		set cc.cc_termDay=$diAd where scc.scc_seguiCentId=$segId;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat('<div class=success>',"Filas afectas: ",$rowAfect,"</div>"));
		return $msj;
		end;

	# actualizar plazo de ordenes [scc_plazOrd_actu] ########## OK ############

		DELIMITER $$
		create function scc_plazOrd_actu($ordId int(11),$plazDia int(11),$tipPlaz int(11))
		RETURNS int(11)
		COMMENT 'actualizar plazo de ordenes'
		BEGIN
			declare $rowAfect int(11);
			
			#code
			CASE $tipPlaz

				WHEN 1 THEN

				update compras set `comp_plazoInter`=$plazDia where `compras_id`=$ordId;

				WHEN 2 THEN

				update compras set `comp_plazoExter`=$plazDia where `compras_id`=$ordId;

			END CASE;

			set $rowAfect=(select ROW_COUNT());

			return $rowAfect;

		end;


	/*- ANOTACIONES ---------------------------------------------------------------------------- */

	/*
		Alertas de seguimiento de ordenes del proyecto:
			- Esta semana vence ordenes en el seguimiento x1,x2,x3
			- El seguimiento x1,x2,x3 tiene ordenes vencidas
	*/

/*----------------------------------[*]------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# PROBABILIDAD Y FECHA LIMITE POR COTIZACION
/*-------------------------------------------------------------------------------------------------------*/

	# VERSION I

			/*
				cotizacion
				probabilidad: valor,fecha limite
				usuario
				cliente
				proyecto
				monto
				moneda
				estado: activas,referencial
				---------------------------------------------------------

				vistas:
					nombre: [existe] detalle cotizacion
					descripcion: especificacion de probabilidad y fechas
					detalle:
							usuario vendedor:
								- ingresa a la vista
								- selecciona opcion de nueva probabilidad
								- ingresa probabilidad y fecha estimada
								- guardar probabilidad

					nombre: [no existe] reporte de probabilidades
					descripcion: reporte de probabilidades por usuario
					detalle:
							usuario jefe:
								- ingresa a la vista
								- elige el usuario
								- genera reporte

			*/

	# VERSION II ( FLUJO PROYECTADO DE INGRESOS Y EGRESOS )

			/*
				Notas:
					- Las ventas probables deben ser agrupadas por vendedor
					- Cada venta probable puede tener una fianza de tipo adelanto o fiel cumplimiento

			*/

			/*
				cliente
				total
				proyecto
				probabilidad
				mes probable
				fianza (adelanto,fiel cumplimiento)

				--------------------------------------------------

				vistas:
					nombre: fp_fluProIn
					descripcion: flujo proyectado de ingresos 
					detalle:
						usuario finanza:
							- ingresa a la vista flujo proyectado ingresos
							- selecciona el usuario el cual desea visualizar sus cotizaciones activas
							- visualiza las cotizaciones del usuario seleccionado
							- elige las cotizaciones que desea tomar en cuenta para generar el flujo
							- define el tipo de fianza a aplicar y los porcentajes
							- visualiza el flujo proyectado

					nombre: fp_reporFluj
					descripcion: reporte generado de flujo

				javascript
					nombre: fp_gesti

				css
					nombre: fp_deco

				subvista
					nombre: fp_cotAct
					descripcion: cotizaciones activas

					nombre: fp_conFian
					descripcion: configuracion de fianza

			*/

	/*- AÑADIDOS Y CAMBIOS ----------------------------------------------------------------------*/

	/*- PERSISTENCIA ----------------------------------------------------------------------------*/

	/*- ANOTACIONES ---------------------------------------------------------------------------- */

	/*-------------------------------------------------------------------------------------------*/
		# MODULO CALENDARIO DE EVENTOS [ce_]
	/*-------------------------------------------------------------------------------------------*/

	/*- ESTRUCTURA -----------------------------------------------------------------------------------*/
	
		/*
			DATA:
				personal de empresa [ce_persoEw]
				fecha inicial [ce_fechIni]
				fecha final [ce_fechFin]
				hora de evento [ce_horEven]
				descripcion de evento [ce_desEven]

				ce_calenEven
					ce_calenEvenId [PK]
					ce_persoEmpId [FK]
					-------------------
					ce_fechIni
					ce_fechFin
					ce_horaEven

			TABLES:
				ce_calenEven	

				
			VIEW:
				item:1
				name:ce_calenEven
				subViews:ce_calenPlugin

				item:2
				name:ce_myCalen
				subViews:ce_evenVisu,ce_frmEven

				item:3
				name:ce_previewCal

			JS:
				item:1
				name:ce_gesti
			CSS:
				item:1
				name:ce_css
			AJAX:
				item:1
				name:ce_ajax
			JSON:
				item:1
				name:ce_json
			SQL:
				item:1
				name:ce_sql

			BUSSINESS:
				item:1
				name:ce_bussiness

			CONTROLLER UP:
				item:1
				name:ce_controllerUp

			CONTROLLER DOWN:
				item:1
				name:ce_controllerDown
		*/

	/*- MODELO ----------------------------------------------------------------------------------*/

			create table ce_calenEven
			(
				ce_calenEvenId int(11) primary key not null auto_increment,
				ce_persoEmpId int(11),
				ce_funAreId int(11),
				ce_empId int(11),
				#-------------------
				ce_fechIni date,
				ce_fechFin date,
				ce_horaEvenIni time,
				ce_horaEvenFin time,
				ce_desEven varchar(400),
				ce_eliEven int(11),
				ce_checkVaca int(11) default 0
			);

			alter table ce_calenEven
			add ce_funAreId int(11) after ce_persoEmpId;

			alter table ce_calenEven
			add ce_empId int(11) after ce_funAreId;

			alter table ce_calenEven
			change ce_horaEven ce_horaEvenIni time,
			add ce_horaEvenFin time after ce_horaEvenIni;

			alter table ce_calenEven
			add ce_desEven varchar(400) after ce_horaEvenFin;

			alter table ce_calenEven
			add ce_eliEven int(11) after ce_desEven;

			alter table ce_calenEven
			add ce_checkVaca int(11) default 0 after ce_eliEven;

	/*- RESTRICCIONES ---------------------------------------------------------------------------*/
	/*- PERSISTENCIA --------------------------------------------------------------------------- */

	# listar personal de ew [ce_perEw_listar] ### OK

		select 
		concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as perEw,
		per.persona_id as perId
		from persona as per
		inner join trabajador as trab on per.persona_id=trab.persona_id
		where trab.empresa_id=1 and trab.bestado=1
		order by per.pers_nombres asc;

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE ce_perEw_listar()
		COMMENT 'listar personal de ew'
		BEGIN
		select 
		concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as perEw,
		per.persona_id as perId,
		trab.trab_funcion_id as trabId
		from persona as per
		inner join trabajador as trab on per.persona_id=trab.persona_id
		where trab.empresa_id=1 and trab.bestado=1
		order by per.pers_nombres asc;
		end;

	# agregar evento de personal ew [ce_evenEw_agregar] ### OK

		insert into ce_calenEven(ce_persoEmpId,ce_funAreId,ce_empId,ce_fechIni,ce_fechFin,ce_horaEvenIni,ce_horaEvenFin,ce_checkVaca) 
		values ('','','','','','','','');

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION ce_evenEw_agregar($ce_persoEmpId int(11),$ce_funAreId int(11),$ce_fechIni date,$ce_fechFin date,$ce_horaEvenIni time,$ce_horaEvenFin time,$ce_desEven varchar(400),$ce_checkVaca int(11))
		RETURNS varchar(50)
		COMMENT 'agregar evento de personal ew'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(50);
		insert into ce_calenEven(ce_persoEmpId,ce_funAreId,ce_empId,ce_fechIni,ce_fechFin,ce_horaEvenIni,ce_horaEvenFin,ce_desEven,ce_eliEven,ce_checkVaca) 
		values ($ce_persoEmpId,$ce_funAreId,1,$ce_fechIni,$ce_fechFin,$ce_horaEvenIni,$ce_horaEvenFin,$ce_desEven,1,$ce_checkVaca);
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat($rowAfect,' ','Evento añadido con exito'));
		return $msj;
		end;

	# capturar eventos de personal ew [ce_evenPer_capturar] ### OK

		select
		calEv.ce_calenEvenId as evenId,
		calEv.ce_persoEmpId as perId,
		(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) from persona as per where per.persona_id=perId) as perEw,
		calEv.ce_funAreId as funId,
		calEv.ce_fechIni as fechIni,
		calEv.ce_fechFin as fechFin,
		calEv.ce_horaEvenIni as hourIni,
		calEv.ce_horaEvenFin as hourFin,
		calEv.ce_desEven as desEven
		from ce_calenEven as calEv;

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE ce_evenPer_capturar()
		COMMENT 'capturar eventos de personal ew'
		BEGIN
		select
		calEv.ce_calenEvenId as evenId,
		calEv.ce_persoEmpId as perId,
		(select concat(ce_firstLet_convert(per.pers_nombres),' ',ce_firstLet_convert(per.pers_apepat),' ',ce_firstLet_convert(per.pers_apemat) from persona as per where per.persona_id=perId) as perEw,
		calEv.ce_funAreId as funId,
		calEv.ce_fechIni as fechIni,
		calEv.ce_fechFin as fechFin,
		calEv.ce_horaEvenIni as hourIni,
		calEv.ce_horaEvenFin as hourFin,
		calEv.ce_desEven as desEven,
		calEv.ce_checkVaca as checkVaca
		from ce_calenEven as calEv where calEv.ce_eliEven=1;
		end;

	# capturar eventos por id de personal ew [ce_evenxId_capturar] ### OK

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE ce_evenxId_capturar($perId int(11))
		COMMENT 'capturar eventos por id de personal ew'
		BEGIN
		select
		calEv.ce_calenEvenId as evenId,
		calEv.ce_persoEmpId as perId,
		(select concat(ce_firstLet_convert(per.pers_nombres),' ',ce_firstLet_convert(per.pers_apepat),' ',ce_firstLet_convert(per.pers_apemat) from persona as per where per.persona_id=perId) as perEw,
		calEv.ce_funAreId as funId,
		calEv.ce_fechIni as fechIni,
		calEv.ce_fechFin as fechFinn,
		(select if(fechIni<fechFinn,DATE_ADD(fechFinn,INTERVAL 1 DAY),fechFinn)) as fechFin,
		calEv.ce_horaEvenIni as hourIni,
		calEv.ce_horaEvenFin as hourFin,
		calEv.ce_desEven as desEven,
		calEv.ce_checkVaca as checkVaca
		from ce_calenEven as calEv where calEv.ce_eliEven=1 and
		calEv.ce_persoEmpId=$perId;
		end;


	# traer evento de personal ew por id [ce_evenxId_traer] ### OK

		select
		calEv.ce_calenEvenId as evenId,
		calEv.ce_persoEmpId as perId,
		(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) from persona as per where per.persona_id=perId) as perEw,
		calEv.ce_funAreId as funId,
		calEv.ce_fechIni as fechIni,
		calEv.ce_fechFin as fechFin,
		calEv.ce_horaEvenIni as hourIni,
		calEv.ce_horaEvenFin as hourFin,
		calEv.ce_desEven as desEven
		from ce_calenEven as calEv where calEv.ce_calenEvenId='';

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE ce_evenxId_traer($idEven int(11))
		COMMENT 'traer evento de personal ew por id'
		BEGIN
		select
		calEv.ce_calenEvenId as evenId,
		calEv.ce_persoEmpId as perId,
		(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) from persona as per where per.persona_id=perId) as perEw,
		calEv.ce_funAreId as funId,
		calEv.ce_fechIni as fechIni,
		calEv.ce_fechFin as fechFin,
		calEv.ce_horaEvenIni as hourIni,
		calEv.ce_horaEvenFin as hourFin,
		calEv.ce_desEven as desEven,
		calEv.ce_checkVaca as checkVaca
		from ce_calenEven as calEv where calEv.ce_calenEvenId=$idEven;
		end;

	# actualizar evento de personal ew por id [ce_evenxId_actualizar] ### OK

		update ce_calenEven set 
		ce_persoEmpId='',
		ce_funAreId='',
		ce_fechIni='',
		ce_fechFin='',
		ce_horaEvenIni='',
		ce_horaEvenFin='',
		ce_desEven=''
		where
		ce_calenEvenId='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION ce_evenxId_actualizar($evenId int(11),$perId int(11),$funId int(11),$fechIni date,$fechFin date,$horaIni time,$horaFin time,$evenDes varchar(400),$checkVaca int(11))
		RETURNS varchar(50)
		COMMENT 'actualizar evento de personal ew por id'
		BEGIN
		declare $msj varchar(50);
		declare $rowAfect int(11);
		update ce_calenEven set 
		ce_persoEmpId=$perId,
		ce_funAreId=$funId,
		ce_fechIni=$fechIni,
		ce_fechFin=$fechFin,
		ce_horaEvenIni=$horaIni,
		ce_horaEvenFin=$horaFin,
		ce_desEven=$evenDes,
		ce_checkVaca=$checkVaca
		where
		ce_calenEvenId=$evenId;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat($rowAfect,' ','Evento actualizado con exito'));
		return $msj;
		end;

	# eliminar evento de personal ew por id [ce_evenxId_eliminar] ### OK

		update ce_calenEven set ce_eliEven=0 where ce_calenEvenId='';

		# [FUNCTION]

		DELIMITER $$
		CREATE FUNCTION ce_evenxId_eliminar($evenId int(11))
		RETURNS varchar(50)
		COMMENT 'eliminar evento de personal ew por id'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(50);
		update ce_calenEven set ce_eliEven=0 where ce_calenEvenId=$evenId;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat($rowAfect,' ','Evento eliminado con exito'));
		return $msj;
		end;

	# convert first caracter in upper [ce_firstLet_convert] ### OK

		# [FUNCTION]

		DELIMITER $$
		CREATE FUNCTION ce_firstLet_convert($cad varchar(200))
		RETURNS varchar(200)
		COMMENT 'convert first caracter in upper'
		BEGIN
		declare $converCad varchar(200);
		set $converCad=(select CONCAT(UCASE(LEFT($cad, 1)),LCASE(SUBSTRING($cad, 2))));
		return $converCad;
		end;

	# validar eventos que se repitan [ce_evenRepi_vali] ### OK

		select count(*) as valVeri from ce_calenEven as ce where 
		(( 'fechini' between ce.ce_fechIni and ce.ce_fechFin ) or
		('fechFin' between ce.ce_fechIni and ce.ce_fechFin )) 
		and
		(('horaIni' between ce.ce_horaEvenIni and ce.ce_horaEvenFin) or   
		('horaFin' between ce.ce_horaEvenIni and ce.ce_horaEvenFin))
		and
		ce.ce_persoEmpId='persoId'
		and
		ce.ce_eliEven=1;

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION ce_evenRepi_vali($fechini date,$fechFin date,$horaIni time,$horaFin time,$perId int(11))
		RETURNS int(11)
		COMMENT 'validar eventos que se repitan'
		BEGIN
		declare $valVeri int(11); 
		set $valVeri=(select count(*) as valVeri from ce_calenEven as ce where 
		(( $fechini between ce.ce_fechIni and ce.ce_fechFin ) or
		($fechFin between ce.ce_fechIni and ce.ce_fechFin )) 
		and
		(($horaIni between ce.ce_horaEvenIni and ce.ce_horaEvenFin) or   
		($horaFin between ce.ce_horaEvenIni and ce.ce_horaEvenFin) or
		($horaIni<ce.ce_horaEvenIni and $horaFin>$horaFin))
		and
		ce.ce_persoEmpId=$perId
		and
		ce.ce_eliEven=1);
		return $valVeri;
		end;

	# validar ingreso de actividad con vacaciones existentes [ce_evenExis_vali]

		select count(*) from ce_calenEven where ce_eliEven=1 and ce_persoEmpId='' and 
		( ('' between ce_fechIni and ce_fechFin ) or ( '' between ce_fechIni and ce_fechFin ) );

		DELIMITER $$
		create function ce_evenExis_vali($persoId int(11),$fechIni date,$fechFin date,$idEven int(11))
		RETURNS int(11)
		COMMENT 'validar ingreso de actividad con vacaciones existentes'
		BEGIN
			declare $flagVali int(11);
			set $flagVali=(select count(*) from ce_calenEven where ce_eliEven=1 and ce_persoEmpId=($persoId and 
			( ($fechIni between ce_fechIni and ce_fechFin ) or ($fechFin between ce_fechIni and ce_fechFin ) ) and
			ce_calenEvenId!=$idEven );

			return $flagVali;
		end;


	/*- NOTAS -----------------------------------------------------------------------------------*/

/*-----------------------------------------[*]-----------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# CENTRO DE COSTO -> REQUERIMIENTO AMPUTACION DE VISITAS [cc_]
/*-------------------------------------------------------------------------------------------------------*/

	/*-ESTRUCTURA--------------------------------------------------------------------------------*/

		/*

			DATA:

			TABLES:

			VIEW:

			JS:

			CSS:

			AJAX:
			    cc_ajax

			JSON:
				cc_json

			SQL:

			CONTROLLER UP:

			CONTROLLER DOWN:

			BUSINESS:

		*/

	/*-MODELO------------------------------------------------------------------------------------*/
	/*-RESTRICCIONES-----------------------------------------------------------------------------*/

		# obtener visita por filtro personal ew [cc_visiFil_obtener]

		SELECT
		tbvisi_visita_id as idVisi,
		idVendeVisita as idVend,
		(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) from trabajador as trab,persona as per where per.persona_id=idVend and trab.persona_id=per.persona_id) as perEw,
		fechIniVisi as fech,
		moneda_id as moneId,
		(select mon_sigla from moneda where moneda_id=moneId) as moneSigla,
		(pasaVisi+hospeVisi+alimeVisi) as mont
		from tbvisi_visita where idVendeVisita='' order by idVisi DESC;

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE cc_visiFil_obtener($idVend int(11))
		COMMENT 'obtener visita por filtro personal ew'
		BEGIN
		SELECT
		tbvisi_visita_id as idVisi,
		visiCorre as visiCorre,
		idVendeVisita as idVend,
		(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) from trabajador as trab,persona as per where per.persona_id=idVend and trab.persona_id=per.persona_id) as perEw,
		fechIniVisi as fech,
		moneda_id as moneId,
		(select mon_sigla from moneda where moneda_id=moneId) as moneSigla,
		(pasaVisi+hospeVisi+alimeVisi) as mont
		from tbvisi_visita where idVendeVisita=$idVend order by idVisi DESC;
		end;

		# capturar personal ew con perfil ventas [cc_perEw_capturar]

		select 
		concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vend,
		per.persona_id as vendId
		from persona as per
		inner join trabajador as trab
		on per.persona_id=trab.persona_id 
		where trab.trabajador_id in (46,40,3,5,53,52,50,68);

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE cc_perEw_capturar()
		COMMENT 'capturar personal ew con perfil ventas'
		BEGIN
		select 
		concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vend,
		per.persona_id as vendId
		from persona as per
		inner join trabajador as trab
		on per.persona_id=trab.persona_id 
		where trab.trabajador_id in (46,40,3,5,53,52,50,68);
		end;

		# asociar visita a centro de costo [cc_visiCent_asociar]

		insert into cc_detcentcost (cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_ocGeneId,cc_idEstCost)
		values (110,4,1,'".$mone."','".$correVisi."',1);

		# [FUNCTION]

		DELIMITER $$
		CREATE FUNCTION cc_visiCent_asociar($idCent int(11),$mone int(11),$correVisi char(15))
		RETURNS int(11)
		COMMENT 'asociar visita a centro de costo'
		BEGIN
		declare $rowAfect int(11);
		insert into cc_detcentcost (cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_ocGeneId,cc_idEstCost)
		values ($idCent,4,1,$mone,$correVisi,1);
		set $rowAfect=(select ROW_COUNT());
		return $rowAfect;
		end;



		/*-PERSISTENCIA------------------------------------------------------------------------------*/
		/*-NOTAS-------------------------------------------------------------------------------------*/

/*-----------------------------------------[*]-----------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# MODULO COTIZACIONES
/*-------------------------------------------------------------------------------------------------------*/

	# redondear totales cotizaciones para arriba [cot_redonArrib]

	DELIMITER $$
	CREATE FUNCTION cot_redonArrib($valor decimal(10,2))
	RETURNS decimal(10,2)
	COMMENT 'redondear totales cotizaciones para arriba'
	BEGIN
	declare $a decimal(10,2);
	declare $b decimal(10,2);
	declare $c decimal(10,2);
	declare $tot decimal(10,2);
	set $a=round($valor,0);
	set $b=$valor;
	set $c=$b-$a;

	if($c>=0) then
		set $tot=$a+1;
	else
		set $tot=$a;
	end if;
	return $tot;
	end;

	# iniciar check de validez o actualizar activacion de condiciones [cot_checkVali]

	select checkVali from cotizacion where cotizacion_id='';

	update cotizacion set checkVali=0 where cotizacion_id='';

	DELIMITER $$
	CREATE FUNCTION cot_checkVali($valActi int(11),$idCoti int(11),$tare varchar(10))
	RETURNS int(11)
	COMMENT 'iniciar check de validez o actualizar activacion de condiciones'
	BEGIN
	declare $rowAfect int(11);
	case $tare
	    when 'INI' then
	    	set $rowAfect=(select checkVali from cotizacion where cotizacion_id=$idCoti);							
	    when 'ACT' then
	        update cotizacion set checkVali=$valActi where cotizacion_id=$idCoti;
	        set $rowAfect=(select ROW_COUNT());
	    else
	    	set $rowAfect=0;
	    end case;
	return $rowAfect;
	end;


	/*-STRUCTURE-------------------------------------------------------------*/

		/*
			JSON:
				item1:cot_json
		*/	

	/*-MODEL-----------------------------------------------------------------*/
	/*-RESTRICCION-----------------------------------------------------------*/
	/*-PERSISTENCE-----------------------------------------------------------*/
	/*-ANOTATION-------------------------------------------------------------*/

	/*-- TABLE COTIZACION ---------------------------------------------------*/

	 alter table cotizacion
	 add  checkVali int(11) default 1 after cot_fec_adj; 


	/* consolidado de visitas por filtros */
	select
	visi.idVendeVisita as vendId,
	visi.moneda_id as monId,
	(select concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) from persona as per where per.persona_id=vendId) as vend,
	(select mon_sigla from moneda where moneda_id=monId) as moneSigla,
	visi.fechIniVisi as fechIni,
	visi.fechFinVisi as fechFin,
	(visi.hospeVisi+visi.alimeVisi+visi.pasaVisi+visi.transInterVisi) as cosTot,
	visi.visiCorre as refe
	from
	tbvisi_visita as visi,
	cc_detcentcost as detCent
	where
	detCent.cc_centCostId='1017' and
	visi.idVendeVisita='842' and
	( visi.fechIniVisi between '2014-05-01' and '2014-05-31' ) and
	( visi.fechFinVisi between '2014-05-01' and '2014-05-31' ) and
	detCent.cc_ocGeneId=visi.visiCorre and 
	visi.idVendeVisita>0 order by refe asc;

	/* consolidado visitas de totales por moneda y filtros */
	select distinct
	cc_centCostId as pcId,
	(select sum(visi.pasaVisi+visi.hospeVisi+visi.alimeVisi+visi.transInterVisi) from tbvisi_visita as visi
	inner join cc_detcentcost as detCent on visi.visiCorre=detCent.cc_ocGeneId 
	where detCent.cc_centCostId=pcId and 
	visi.moneda_id=1 and
	visi.idVendeVisita='842' and
	( visi.fechIniVisi between '2014-05-01' and '2014-05-31' ) and
	( visi.fechFinVisi between '2014-05-01' and '2014-05-31' ) ) as totSolVisi,
	(select sum(visi.pasaVisi+visi.hospeVisi+visi.alimeVisi+visi.transInterVisi) from tbvisi_visita as visi
	inner join cc_detcentcost as detCent on visi.visiCorre=detCent.cc_ocGeneId 
	where detCent.cc_centCostId=pcId 
	and visi.moneda_id=2 and
	visi.idVendeVisita='842' and
	( visi.fechIniVisi between '2014-05-01' and '2014-05-31' ) and
	( visi.fechFinVisi between '2014-05-01' and '2014-05-31' ) ) as totDolVisi,
	(select sum(visi.pasaVisi+visi.hospeVisi+visi.alimeVisi+visi.transInterVisi) from tbvisi_visita as visi
	inner join cc_detcentcost as detCent on visi.visiCorre=detCent.cc_ocGeneId 
	where detCent.cc_centCostId=pcId 
	and visi.moneda_id=3 and
	visi.idVendeVisita='842' and
	( visi.fechIniVisi between '2014-05-01' and '2014-05-31' ) and
	( visi.fechFinVisi between '2014-05-01' and '2014-05-31' ) ) as totHebVisi
	from
	cc_detcentcost
	where
	cc_centCostId='';

	/* Reporte de Ordenes OC/EW 27-05-2014  */

	SELECT distinct 
	comp.compras_id as Item,
	emp.emp_nombre as proveedor,
	comp.pc_id as pcId,
	(select emp2.emp_nombre as cliente
	from
	cc_centcost as cent,
	empresa as emp2
	where 
	cent.cc_centCostId=pcId
	and cent.cc_idCliEmp=emp2.empresa_id) as cliente,
	comp.comp_nro as EW, 
	date_format( comp.comp_fecha_ini, '%d/%m/%Y' ) as fecha, (
	CASE
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =1
	)
	THEN 'ENERO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =2
	)
	THEN 'FEBRERO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =3
	)
	THEN 'MARZO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =4
	)
	THEN 'ABRIL'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =5
	)
	THEN 'MAYO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =6
	)
	THEN 'JUNIO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =7
	)
	THEN 'JULIO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =8
	)
	THEN 'AGOSTO'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =9
	)
	THEN 'SETIEMBRE'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =10
	)
	THEN 'OCTUBRE'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =11
	)
	THEN 'NOVIEMBRE'
	WHEN (
	date_format( comp.comp_fecha_ini, '%m' ) =12
	)
	THEN 'DICIEMBRE'
	ELSE ''
	END
	) AS mes, format(sum( detComp.prod_precio_venta*detComp.prod_cantidad ),2) AS monto,mon_sigla as mon
	/*(case
	when (mon.moneda_id=1) then format(sum( prod_precio_venta/2.808),2)
	when (mon.moneda_id=2) then format(sum( prod_precio_venta ),2)
	when (mon.moneda_id=3) then format((sum(prod_precio_venta)/0.731035),2) else '' end) AS montoDolares,
	'$' as moneDolar*/
	FROM 
	`compras` AS comp, 
	empresa AS emp, 
	compras_detalle AS detComp,
	moneda as mon
	WHERE (comp.comp_nro LIKE '%OC-2014%' or comp.comp_nro LIKE '%EW-2014%')
	AND (date_format( comp.comp_fecha_ini, '%Y' ) =2014 or date_format( comp.comp_fecha_ini, '%Y' ) =2014)
	AND emp.empresa_id = comp.proveedor_id
	AND comp.compras_id = detComp.compras_id
	and detComp.moneda_id=mon.moneda_id
	and CHAR_LENGTH(comp.comp_nro)=14
	and detComp.bestado=1
	and comp.bestado=1
	group BY comp.compras_id order by comp.compras_id;

/*--------------------------------------[*]--------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# FUNCIONAL->MODULE FOR ADD SERIAL NUMBER IN ORDER PRODUCTS [sn_]
/*-------------------------------------------------------------------------------------------------------*/

	/* ANNOTATION */

		/*
			- Crear la accion numero de serie
		*/

	/* STRUCTURE */

		/*
			html
				view: detalle de ordenes
				sub-view: numero de series [sn_numSeri]
			css
			js
			json
			ajax
			php_sql
			php_bussiness
			php_controller_up
			php_controller_down
		*/

	/* MODEL */

		/*

		*/

		create table sn_numSeri
		(
			sn_numSeriId int(11) primary key not null auto_increment, #PK
			sn_fechAlm date,
			sn_fechIng date,
			sn_numSeri char(25),
			sn_eliEsta int(11), 
			#--------------------
			sn_idDetComp int(11) #FK
		);

		/* TABLE DETALLE COMPRAS */

		alter table compras_detalle
		add comp_numSeri char(25) after prod_alias;


	/* RESTRICCION */

		/*

		*/

	/* PERSISTENCE */

		/*

		*/

		#  obtener descripcion del producto para numeros de serie [sn_desProd_obte]

		select prod.prod_nombre from compras_detalle as detComp,producto as prod where detComp.comp_detalle_id='' and 
		detComp.producto_id=prod.producto_id;

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION sn_desProd_obte($idDetComp int(11))
		RETURNS text
		COMMENT 'obtener descripcion del producto para numeros de serie'
		BEGIN
		declare $prodDes text;
		set $prodDes=(select prod.prod_nombre from compras_detalle as detComp,producto as prod where detComp.comp_detalle_id=$idDetComp and 
		detComp.producto_id=prod.producto_id);
		return $prodDes;
		end;

		# obtener descripcion y cantidad de producto para numeros de serie [sn_desCan_obte]

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE sn_desCan_obte($idDetComp int(11))
		COMMENT 'obtener descripcion y cantidad de producto para numeros de serie'
		BEGIN
		select prod.prod_nombre,detComp.prod_cantidad from 
		compras_detalle as detComp,
		producto as prod 
		where 
		detComp.comp_detalle_id=$idDetComp and 
		detComp.producto_id=prod.producto_id;
		end;

		# agregar numero de serie de producto [sn_numSeri_agre]

		insert into sn_numSeri(sn_idDetComp,sn_fechAlm,sn_fechIng,sn_numSeri,sn_eliEsta) values('','','','','');

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION sn_numSeri_agre($idDetComp int(11),$fechAlm date,$fechIng date,$numSeri char(25),$eliEsta int(11))
		RETURNS varchar(250)
		COMMENT 'agregar numero de serie de producto'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(250);
		insert into sn_numSeri(sn_idDetComp,sn_fechAlm,sn_fechIng,sn_numSeri,sn_eliEsta) values($idDetComp,$fechAlm,$fechIng,$numSeri,$eliEsta);
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat("<div class='success' >",$rowAfect," Numero de serie agregado con exito",'</div>'));
		return $msj;
		end;

		# actualizar numero de serie de producto [sn_numSeri_actu]

		update sn_numSeri set sn_idDetComp='',sn_fechAlm='',sn_fechIng='',sn_numSeri='',$eliEsta=''
		where sn_numSeriId='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION sn_numSeri_actu($idDetComp int(11),$fechAlm date,$fechIng date,$numSeri char(25),$eliEsta int(11))
		RETURNS varchar(50)
		COMMENT 'actualizar numero de serie de producto'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(50);
		insert into sn_numSeri(sn_idDetComp,sn_fechAlm,sn_fechIng,sn_numSeri,sn_eliEsta) values($idDetComp,$fechAlm,$fechIng,$numSeri,$eliEsta);
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat("<div class='success' >",$rowAfect," Numero de serie actualizado con exito",'</div>'));
		return $msj;
		end;

		# eliminar numero de serie de producto [sn_numSeri_eli]

		update sn_numSeri set eliEsta=0 where sn_numSeriId='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION sn_numSeri_eli($numSeriId int(11))
		RETURNS varchar(250)
		COMMENT 'eliminar numero de serie de producto'
		BEGIN
		declare $rowAfect int(11);
		declare $msj varchar(250);
		update sn_numSeri set sn_eliEsta=0 where sn_numSeriId=$numSeriId;
		set $rowAfect=(select ROW_COUNT());
		set $msj=(select concat("<div class='success' >",$rowAfect," Numero de serie eliminado con exito",'</div>'));
		return $msj;
		end;

		# obtener numeros de serie de produtos [sn_numSerixId_obte]

		select 
		numSeri.sn_numSeriId as numSeri,
		numSeri.sn_fechIng as fechIng,
		numSeri.sn_fechAlm as fechAlm,
		numSeri.sn_eliEsta as eliEsta
		from sn_numSeri as numSeri where sn_idDetComp='';

		# [PROCEDURE]
		DELIMITER $$
		CREATE PROCEDURE sn_numSerixId_obte($idDetComp int(11))
		COMMENT 'obtener numero de serie de produtos'
		BEGIN
		select 
		numSeri.sn_numSeriId as numSeriId,
		numSeri.sn_numSeri as numSeri,
		numSeri.sn_fechIng as fechIng,
		numSeri.sn_fechAlm as fechAlm,
		numSeri.sn_eliEsta as eliEsta
		from sn_numSeri as numSeri where sn_idDetComp=$idDetComp and numSeri.sn_eliEsta=1;
		end;

		# eliminar numeros de serie por numero de serie por id [sn_numSerixId_eli]

		update sn_numSeri set sn_eliEsta=0 where sn_idDetComp='';

		# [FUNCTION]
		DELIMITER $$
		CREATE FUNCTION sn_numSerixId_eli($idDetComp int(11))
		RETURNS int(11)
		COMMENT 'eliminar numeros de serie por numero de serie por id'
		BEGIN
		declare $rowAfect int(11);
		update sn_numSeri set sn_eliEsta=0 where sn_idDetComp=$idDetComp;
		set $rowAfect=(select ROW_COUNT());
		return $rowAfect;
		end;

/*-----------------------------------[*]-----------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# MODULO DE ALMACEN
/*-------------------------------------------------------------------------------------------------------*/

	/*

		NOTES:

		note 1:

		1. Creacion de la vista linea de productos [lp_lineProd] -- ok
		2. Crear subvista de importacion de productos [lp_imporProd] -- ok
		3. Crear archivo js [lp_gesti] -- ok
		4. crear bloque css [lp_css] -- ok
		5. iniciar sub-clasificacion en controlador up -- ok
		6. crear procedure obtener sub-clasificion de productos [lp_obteSubClasi] -- ok
		7. instanciar procedure [lp_obteSubClasi] en sql --ok
		9. crear procedure obtener categoria por id sub-clasificacion [lp_obteCatexid] -- ok
		10. crear archivo ajax [lp_ajax] -- ok
		11. crear funcion ajax para carga de categorias [lp_cargCate_ajax] -- ok
		12. crear procedure obtener tipo por categoria id [lp_obteTipxId] -- ok
		13. crear procedure obtener marca-modelo por tipo id [lp_obteMarModxId] -- ok
		14. crear procedure obtener productos por marca y modelo id [lp_obteProdxid] -- ok
		15. crear modelo de linea de productos -- ok
		16. crear campo flag en productos -- ok

		note 2:

		17. crear function importar producto [lp_imporProd] -- ok
		18. crear procedure listar linea de productos [lp_listLineProd] -- ok
		19. instanciar persistencia en la capa de presentacion -- ok
		20. crear function para eliminar linea de producto [lp_eliLineProd] -- ok
		21. instanciar persistencia en capa de presentacion -- ok
		22. modificar modelo de linea de productos con stocks,precios y moneda -- ok
		23. vista para busqueda de productos -- ok
		24. opcion y subvista de configurar stocks [lp_confStock] -- ok
		25. añadir procedure de busqueda en linea de productos -- ok

		note 3:

		26. persistencia de busqueda de linea de productos en presentacion -- ok
		27. añadir dato cantidad de productos actuales en presentacion -- ok
		28. crear persistencia cantidad de productos en linea [lp_obteCantLine] -- ok
		29.	crear subvista configuracion de stock [lp_confStock] -- ok
		30. crear function para agregar configuracion de stock [lp_addConfStock] -- ok
		31. crear procedure para iniciar configuracion de stock [lp_iniConfStock] -- ok
		32. crear function para actualizar configuracion de stock [lp_actuConfStock] -- ok

		note 4:

		33. persistencia: crear persistencia de configuracion de stock en routines añadir,actualizar,iniciar -- ok
		34. presentacion: iniciar checkbox seleccionado en subvista configuracion de stock -- ok
		35. presentacion: añadir configuracion de stock -- ok
		36. persistencia: crear persistencia para inciar monedas [lp_iniMone] -- ok
		37. presentacion: iniciar monedas -- ok

		note 5:

		38. presentacion: crear vista lista general de kardex [kd_listKardx] -- ok
		39. presentacion: crear bloque de estilos [kd_css] -- ok
		40. presentacion: crear archivo js [kd_gesti] -- ok
		41. modelo: crear modelo de datos para kardex -- ok

		note 6:

		42. presentacion: crear vista kardex generado [kd_geneKardx] --
		43.	persistencia: generar movimiento kardex [kd_geneMovKardx] --
		44. persistencia: obtener correlativo de movimiento [kd_correMov_obte] --
		45.	persistencia: obtener los tipos de movimientos [kd_tipMov_obte] --
		46. persistencia: obtener empresas clientes o proveedores [kd_emp_obte] --
		47. persistencia: agregar datos generales de movimiento [kd_geneMov_agre] --
		48. persistencia: crear filtros de linea de productos [] --


		ESTRUCTURA:

			vista

				lp_lineProd

				kd_listKardx
				kd_nuevKardx

			sub-vista

				lp_lineProd->lp_imporProd
				lp_lineProd->lp_confStock

			js

				lp_gesti

				kd_gesti

			css

				lp_css

				kd_css

			ajax

				lp_ajax

				kd_ajax

			json

				lp_json

				kd_json

			negocio

				lp_negocio

				kd_negocio

			controller up

				lp_ctrlUp

				kd_ctrlUp

			controller down

				lp_ctrlDown

				kd_ctrlDown	

			sql

				lp_sql

				kd_sql

		MODELO:

			-------------------------------------------------------------------------------
			################################# LINEA DE PRODUCTOS ##########################
			-------------------------------------------------------------------------------

			-----------------------------------
			// Linea de productos de productos
			-----------------------------------

				create table lp_lineProd
				(
					lp_lineProdId int(11) auto_increment not null primary key,
					lp_codLineProd char(25),
					lp_idProd int(11),
					lp_estaEli int(11) default 1,
					lp_stockMin int(11) default 0,
					lp_stockMax int(11) default 0,
					lp_stockActu int(11) default 0,
					lp_precioUnit decimal(25,2),
					lp_moneId int(11)
				);

				----------------------MODIFICACIONES----------------------------------
				alter table lp_lineProd
				add lp_estaEli int(11) default 1 after lp_idProd;

				alter table lp_lineProd
				add lp_stockMin int(11) after lp_estaEli,
				add lp_stockMax int(11) after lp_stockMin,
				add lp_stockActu int(11) after lp_stockMax,
				add lp_precioUnit decimal(25,2) after lp_stockActu,
				add lp_moneId int(11) after lp_precioUnit;
				----------------------------------------------------------------------

			------------------------
			// Tabla producto
			------------------------

				alter table producto
				add flagLinea int(11) default 0 after ubigeo_id

			---------------------------------------------------------------

			------------------------------------------------------------------------
			############################### KARDEX #################################
			--------------------------------------------------------------------------

			------------------------NOTAS DE MODELO--------------------------------------

			tipos de movimientos: entrada y salida 
			tipos de documento: boleta,factura y guia de remision

			kardex:

				id // PK
				tipo de movimiento // FK
				tipo de documento // FK
				numero de documento
				fecha
				descripcion
				empresa //FK
				moneda
				total

			detalle kardex:

				id // PK
				producto // FK
				precio unitario
				cantidad

			------------------------------------------------------------------------------

			------------------------------------
			// Tipo de Movimiento
			------------------------------------

				create table kd_tipMov
				(
					kd_tipMovId int(11) not null auto_increment primary key, #PK
					kd_tipMovDes varchar(200)
				);

				------------CONSTANTES------------
				entrada
				salida
				movimiento interno New!
				---------------------------------

			--------------------------------------
			// Tipo de Documento
			--------------------------------------

				create table kd_tipDoc
				(
					kd_tipDocId int(11) not null auto_increment primary key, #PK
					kd_tipDocDes varchar(200),
					kd_tipDocAbrev varchar(50)
				);

				-------------CONSTANTES-------------------
				boleta
				factura
				dua
				-------------------------------

			-----------------------------------
			// Kardex general
			-----------------------------------

				create table kd_kardx
				(
					kd_kardxId int(11) not null auto_increment primary key, #PK
					kd_kardxNro char(25),
					kd_tipMov int(11), #FK
					kd_tipDoc int(11), #FK
					kd_kardxDoc char(25),
					kd_kardxFech date,
					kd_kardxDes varchar(200),
					kd_kardxEmp int(11), #FK
					kd_kardxMone int(11), #FK
					kd_kardxTot decimal(25,2),
					kd_confirMov int(11) default 0,
					kd_almcId int(11)
				);

				-------------------------------------RESTRICCION----------------------------------------------------
				alter table kd_kardx
				add constraint fk_kd_tipMov foreign key (kd_tipMov) references kd_tipMov(kd_tipMovId),
				add constraint fk_kd_tipDoc foreign key (kd_tipDoc) references kd_tipDoc(kd_tipDocId);

				alter table kd_kardx
				add constraint fk_kd_almcId foreign key (kd_almcId) references kd_almcEmp(kd_almcId);

				alter table kd_kardx
				add constraint fk_kd_transId foreign key (kd_transId) references kd_trans(kd_transId); New!
				-----------------------------------------------------------------------------------------------------

				-------------------------------------MODIFICACIONES------------------------------------------------------------------
				alter table kd_kardx
				add kd_kardxNro char(25) after kd_kardxId;

				alter table kd_kardx
				add kd_confirMov int(11) default 0 after kd_kardxTot;

				alter table kd_kardx
				add kd_almcId int(11) after kd_confirMov;

				alter table kd_kardx
				add kd_desti text after kd_almcId,
				add kd_transId int(11) after kd_desti,
				add kd_numFac char(15) after kd_transId,
				add kd_FacEmis date after kd_numFac;

				alter table kd_kardx drop foreign key fk_kd_transId; 

				alter table kd_kardx
				add kd_ewCompId int(11) after kd_FacEmis;

				alter table kd_kardx
				add kd_fechGen datetime default '2014-09-19 17:00:00' after kd_almcId; new!

				--------------------------------------------------------------------------------------------------------


			-----------------------------------
			// Detalle de Kardex
			-----------------------------------

				create table kd_detKardx
				(
					kd_detKardxId int(11) not null auto_increment primary key, #PK
					kd_kardxId int(11), #FK
					kd_detKardxProd int(11), #FK
					kd_detKardxPreUni decimal(25,2),
					kd_detKardxCant int(11),
					kd_almcId int(11),
					kd_glosaDes text
				);

				--------------------------------RESTRICCION---------------------------------------------------
				alter table kd_detKardx
				add constraint fk_kd_kardxId foreign key (kd_kardxId) references kd_kardx(kd_kardxId);
				---------------------------------------------------------------------------------------------

				--------------------------------MODIFICACION---------------------------------------------------
				alter table kd_detKardx
				add kd_almcId int(11) after kd_detKardxCant;

				alter table kd_detKardx
				add kd_glosaDes text after kd_almcId,
				add itemCorre char(15) after kd_glosaDes;

				alter table kd_detKardx
				add kd_unid char(15) after kd_glosaDes,
				add kd_chkProd int(1) after kd_unid,
				add kd_desProd varchar(200) after kd_chkProd; New!
				-----------------------------------------------------------------------------------------------

			-------------------------------
			// Numero de serie de producto
			-------------------------------	

				create table kd_numSeri
				(
					kd_numSeriId int(11) auto_increment not null primary key,
					kd_numSeri char(50),
					kd_prodId int(11),
					kd_fechIngre date,
					kd_desProd	varchar(200),
					kd_estaStockId int(11),
					kd_almcId int(11)
				);

				-------------------------MODIFICACION------------------------------------------------
				alter table kd_numSeri
				add kd_numSeri char(50) after kd_numSeriId;

				alter table kd_numSeri
				add kd_estaStockId int(11) after kd_desProd;

				alter table kd_numSeri
				add kd_almcId int(11) after kd_estaStockId; New!
				-------------------------------------------------------------------------------------

				-------------------------RESTRICCION--------------------------------------------------
				alter table kd_numSeri
				add constraint fk2_kd_estaStockId foreign key (kd_estaStockId) references kd_estaStock(kd_estaStockId);

				alter table kd_numSeri
				add constraint fk2_kd_almcId foreign key (kd_almcId) references kd_almcEmp(kd_almcId); New!
				--------------------------------------------------------------------------------------

			---------------------------------
			// Movimiento de Numero de serie
			---------------------------------

				create table kd_movNumSeri
				(
					kd_movNumSeriId int(11) auto_increment not null primary key,
					kd_detKardxId int(11),
					kd_numSeriId int(11)
				);

				------------------------MODIFICACION--------------------------------------------------------------
				alter table kd_movNumSeri
				add kd_estaStockId int(11) after kd_numSeriId; 
				--------------------------------------------------------------------------------------------------

				------------------------RESTRICCION---------------------------------------------------------------

				alter table kd_movNumSeri
				add constraint fk_kd_numSeriId foreign key (kd_numSeriId) references kd_numSeri(kd_numSeriId), 
				add constraint fk_kd_detKardxId foreign key (kd_detKardxId) references  kd_detKardx(kd_detKardxId);
				
				---------------------------------------------------------------------------------------------------

			--------------------------------------
			// Estado de numero de serie en stock
			--------------------------------------

				create table kd_estaStock
				(
					kd_estaStockId int(11) primary key not null auto_increment,
					kd_desEsta varchar(50)
				);

				------------------------CONSTANTES-----------------------------
				en stock
				fuera stock
				---------------------------------------------------------------

			---------------------------------------
			// Almacenes de empresa
			---------------------------------------

				create table kd_almcEmp
				(
					kd_almcId int(11) primary key not null auto_increment,
					kd_almcDes varchar(50)
				);

				--------------------------MODIFICACION-----------------------------
				alter table kd_almcEmp
				add kd_almcUbi text after kd_almcDes;
				-------------------------------------------------------------------

			---------------------------------------
			// Transportista New!
			---------------------------------------

				create table kd_trans
				(
					kd_transId int(11) primary key not null auto_increment,
					kd_transNom varchar(25),
					kd_transApe varchar(50),
					kd_transDni char(15),
					kd_transRuc char(15),
					kd_transDomi text
				);

		--------------------------------------------------------------------------------
		############################### NOTA DE PEDIDO #################################
		--------------------------------------------------------------------------------

		--------------------- NOTAS DEL MODELO ----------------------------

		estado de la nota del pedido: si fue atendido o no

		datos generales con respecto al usuario creador,
		cliente,ruc,fecha,descripcion,referencia,observaciones y correlativo de la nota

		detalle de la nota especificando item del producto y cantidades

		vistas lista,nuevo y detalle de nota

		acciones nuevo,guardar,actualizar y eliminar nota
		
		-------------------------------------------------------------------

			----------------------------------------
			// Nota de Pedido [np_notPed]
			----------------------------------------

				create table np_notPed
				(
					np_notPedId int(11) primary key not null auto_increment, #PK
					np_usuId int(11),    #FK
					np_cliId int(11),    #FK
					np_correNot char(15),  
					np_fech date,     
					np_obs text,
					np_des varchar(300),
					np_ref varchar(150),
					np_estaNotId int(11), #FK
					np_tipMov int(11),
					np_usuAten int(11),
					np_fechAten datetime,
					np_fechConfir date,
					np_hourConfir char(15)

				);

				-----------------RESTRICCION---------------------
				alter table np_notPed
				add constraint fk_np_estaNotId foreign key (np_estaNotId) references np_estaNot(np_estaNotId);

				-------------------------------------------------

				-----------------MODIFICACION--------------------
				alter table np_notPed
				add np_estaNotId int(11) after np_ref;

				alter table np_notPed
				add np_tipMov int(11) after np_estaNotId;

				alter table np_notPed
				add np_usuAten int(11) after np_tipMov,
				add np_fechAten datetime after np_usuAten; # new!

				alter table np_notPed
				add np_fechConfir date after np_fechAten; #new!

				alter table np_notPed
				add np_hourConfir confirm after np_fechConfir; #new!
				-------------------------------------------------

			----------------------------------------
			// Detalle de Nota de Pedido [np_detNot]
			----------------------------------------

				create table np_detNot
				(
					np_detNotId	int(11) primary key not null auto_increment, #PK
					np_notPedId int(11), #FK
					np_lineId   int(11), #FK
					np_cantProd int(11)
				);

				-------------RESTRICCION------------------------------
				alter table np_detNot
				add constraint fk_np_notPedId foreign key (np_notPedId) references np_notPed(np_notPedId);
				------------------------------------------------------

			----------------------------------------
			// Estado de Nota de Pedido [np_estaNot]
			----------------------------------------

				create table np_estaNot
				(
					np_estaNotId int(11) primary key not null auto_increment,  #PK
					np_desNot varchar(20), #FK
					np_imgEsta varchar(50)
				);

				----------------CONSTANTES----------------
				atendido
				pendiente
				------------------------------------------

				----------------MODIFICACION--------------
				alter table np_estaNot
				add np_imgEsta varchar(50) after np_desNot;
				-------------------------------------------

		------------------------------------
		********* PERSISTENCIA ************
		------------------------------------

		*/

			---------------------------------------------------------------------
			#################### NOTA DE PEDIDO ############################# 
			---------------------------------------------------------------------

			# obtener producto por linea [np_prodxLine_obte] 

			# [PROCEDURE]

			  DELIMITER $$
			  create procedure np_prodxLine_obte($idLine int(11))
			  COMMENT 'obtener producto por linea'
			  BEGIN
					#code
					select
					lineProd.lp_lineProdId as id,
					(select GROUP_CONCAT(kd_numSeri SEPARATOR '<br>') 
					from kd_numSeri where kd_estaStockId=1 and kd_prodId=id) as numSeriStock, 
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					tip.prod_tipo_nombre as tip,
					mar.mm_nombre as mar,
					model.mm_nombre as model,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					mm as model on prod.modelo_id=model.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and 
					lineProd.lp_lineProdId=$idLine order by sub;
			  end;

			  # crear nota de pedido [np_notPed_crear]

			  # [FUNCTION]

			  DELIMITER $$
			  create function np_notPed_crear($usuId int(11),$cliId int(11),$fech date,$obs text,$des varchar(200),$ref varchar(50))
			  RETURNS int(11)
			  COMMENT 'crear nota de pedido'
			  BEGIN

			  	declare $codNot int(11);
				declare $tamCod int(11);
				declare $correNot char(25);
				declare $rowAfect int(11);

			  	#code

			  	# insertar nota de pedido
			  	insert into np_notPed (np_usuId,np_cliId,np_correNot,np_fech,np_obs,np_des,np_ref,np_estaNotId) 
			  	values ($usuId,$cliId,'',$fech,$obs,$des,$ref,1);

			  	set $codNot=(select LAST_INSERT_ID());
			  	set $tamCod=(select length($codNot));

			  	if($tamCod>5) then
				set $tamCod=$tamCod;
				else
				set $tamCod=5;
				end if;

				set $correNot=(select concat('NOT-',LPAD($codNot,$tamCod,'0')));

				# actualizar nota de pedido
				update np_notPed set np_correNot=$correNot where np_notPedId=$codNot;

				# retornar filas afectadas
				set $rowAfect=(select ROW_COUNT());

				return $codNot;
			  
			  end;

			  # ingresar detalle de nota [np_detNot_ingre]

			  # [FUNCTION]

			  DELIMITER $$
			  create function np_detNot_ingre($notPedId int(11),$lineId int(11),$cant int(11))
			  RETURNS int(11)
			  COMMENT 'ingresar detalle de nota'
			  BEGIN
			  	  #code
			  	  declare $rowAfect int(11);

			  	  insert into np_detNot(np_notPedId,np_lineId,np_cantProd) values($notPedId,$lineId,$cant);
			  	  set $rowAfect=(select ROW_COUNT());
			  	  
			  	  return $rowAfect;
			  end;

			  # listar notas de pedidos [np_notPed_lis]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_notPed_lis($esta int(11))
			  COMMENT 'listar notas de pedidos'
			  BEGIN

			  	   #code

	  	   			SELECT
	  	   			np_notPedId as id,
					np_correNot as cod,
					np_cliId as cliId,
					(select emp_nombre from empresa where empresa_id=cliId) as cli,
					np_fech as fech,
					np_des as des,
					np_ref as ref,
					np_obs as obs,
					np_estaNotId as estaId,
					(select np_imgEsta from np_estaNot where np_estaNotId=estaId)as esta
					FROM `np_notPed`
					where np_estaNotId=$esta;

			  end;

			  # capturar estados de nota de pedido [np_estaNot_cap]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_estaNot_cap()
			  COMMENT 'capturar estados de nota de pedido'
			  BEGIN
			  		#code
			  		SELECT np_desNot as desNot,np_estaNotid as estaId 
			  		FROM `np_estaNot`;
			  end;

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_notPed_lis($esta int(11))
			  COMMENT 'listar notas de pedidos'
			  BEGIN

			  	   #code

	  	   			SELECT
	  	   			np_notPedId as id,
					np_correNot as cod,
					np_cliId as cliId,
					(select emp_nombre from empresa where empresa_id=cliId) as cli,
					np_fech as fech,
					np_des as des,
					np_ref as ref,
					np_obs as obs,
					np_estaNotId as estaId,
					(select np_imgEsta from np_estaNot where np_estaNotId=estaId)as esta
					FROM `np_notPed`
					where np_estaNotId=$esta;

			  end;

			  # capturar general de nota [np_genNot_cap]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_genNot_cap($idDet int(11))
			  COMMENT 'capturar detalle de nota'
			  BEGIN
			  		#code

			  		SELECT
	  	   			np_notPedId as id,
					np_correNot as cod,
					np_cliId as cliId,
					(select emp_nombre from empresa where empresa_id=cliId) as cli,
					np_fech as fech,
					np_des as des,
					np_ref as ref,
					np_obs as obs,
					np_estaNotId as estaId,
					(select np_imgEsta from np_estaNot where np_estaNotId=estaId)as esta
					FROM `np_notPed`
					where np_notPedId=$idDet;
			  		
			  end;

			  # capturar detalle de nota [np_detNot_cap]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_detNot_cap($notId int(11))
			  COMMENT 'capturar detalle de nota'
			  BEGIN

					#code
					select
					lineProd.lp_lineProdId as id,
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					mar.mm_nombre as mar,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					(select count(*) from kd_numSeri where kd_estaStockId=1 and kd_prodId=id) as stockActu2,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla,
					detNot.np_cantProd as cantDet
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					inner join
					np_detNot as detNot on detNot.np_lineId=lineProd.lp_lineProdId
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1
					and detNot.np_notPedId=$notId order by id;

			  end;

			  # actualizar nota de pedido [np_notPed_actu]

			  # [PROCEDURE]

			  DELIMITER $$
			  create function np_notPed_actu($cliId int(11),$fech date,$obs varchar(200),$des text,$ref varchar(50),$esta int(11),$notId int(11))
			  RETURNS int(11)
			  COMMENT 'actualizar nota de pedido'
			  BEGIN
			  		#code
			  		declare $rowAfect int(11);

			  		update np_notPed set 
			  			np_cliId=$cliId,
			  			np_fech=$fech,
			  			np_obs=$obs,
			  			np_des=$des,
			  			np_ref=$ref,
			  			np_estaNotId=$esta
			  			where np_notPedId=$notId;

			  		set $rowAfect=(select ROW_COUNT());

			  		return $rowAfect;
			  end;

			  # eliminar detalle de nota [np_detNot_eli]

			  # [FUNCTION]

			  DELIMITER $$
			  create function np_detNot_eli($idDet int(11))
			  RETURNS int(11)
			  COMMENT 'eliminar detalle de nota'
			  BEGIN
			  		#code
			  		declare $rowAfect int(11);

			  		delete from np_detNot where np_detNotId=$idDet;

			  		set $rowAfect=(select ROW_COUNT());

			  		return $rowAfect;
			  end;

			  # eliminar nota de pedido [np_detNot_eli]

			  # [FUNCTION]

			  DELIMITER $$
			  create function np_notPed_eli($idNot int(11))
			  RETURNS int(11)
			  COMMENT 'eliminar detalle de nota'
			  BEGIN
			  		#code
			  		declare $rowAfect int(11);

			  		delete from np_notPed where np_notPedId=$idNot;

			  		set $rowAfect=(select ROW_COUNT());

			  		return $rowAfect;
			  end;

			  # capturar tipo de movimiento [np_tipMov_cap]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_tipMov_cap()
			  COMMENT 'capturar tipo de movimiento'
			  BEGIN
			  	#code
			  	select kd_tipMovId as tipId,kd_tipMovDes as tipDes
			  	from kd_tipMov;
			  end;

			  # capturar trabajadores de perfil operario [np_trabOpe_cap]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_trabOpe_cap()
			  COMMENT 'capturar trabajadores de perfil operario'
			  BEGIN
			  		#code
			  		select
					concat(per.pers_nombres,' ',per.pers_apepat) as pers,
					per.pers_mail as email
					from persona as per,trabajador as trab where per.persona_id=trab.persona_id and 
					(trab.trabajador_id IN(57,63,18,45)) and trab.bestado=1;
			  end;

			  DELIMITER $$
			  create procedure np_trabOpe_cap()
			  COMMENT 'capturar trabajadores de perfil operario'
			  BEGIN
			  		#code
			  		select
			  		per.persona_id as perId,
					concat(per.pers_nombres,' ',per.pers_apepat) as pers,
					per.pers_mail as email
					from persona as per,trabajador as trab where 
					per.persona_id=trab.persona_id and per.pers_estado_id=1 and
					per.bestado=1 and trab.bestado=1 and trab.empresa_id=1 and
					trab_estado_id=1;
			  end;

			  # editar email de personal [np_mailPer_edit]

			  # [FUNCTION]

			  DELIMITER $$
			  create function np_mailPer_edit($perId int(11),$email varchar(50))
			  RETURNS int(11)
			  COMMENT 'editar email de personal'
			  BEGIN
			  		#code
			  		declare $rowAfect int(11);
			  		update persona set pers_mail=$email where persona_id=$perId;

			  		set $rowAfect=(select ROW_COUNT());

			  		return $rowAfect;
			  end;

			  # obtener email de persona [np_emailPer_obte]

			  # [PROCEDURE]

			  DELIMITER $$
			  create procedure np_emailPer_obte($perId int(11))
			  COMMENT 'obtener email de persona'
			  BEGIN
			  		#code
			  		select 
			  			concat(pers_nombres,' ',pers_apepat) as perNom,
			  			pers_mail as perEmail
			  			from persona where persona_id=$perId;
			  end;



			---------------------------------------------------------------------
			##################### LINEA DE PRODUCTOS ########################
			---------------------------------------------------------------------

			# [PROCEDURE] -> lp_obteSubClasi

			select prod_subclasif_nombre as subClasi,prod_subclasif_id as subClasiId from prod_subclasif where 
			prod_clasificacion_id=1 and bestado=1
			
			DELIMITER $$
			create procedure lp_obteSubClasi()
			COMMENT 'crear procedure obtener sub-clasificion de productos'
			BEGIN
			select prod_subclasif_nombre as subClasi,prod_subclasif_id as subClasiId from prod_subclasif where 
			prod_clasificacion_id=1 and bestado=1;
			end;

			# [PROCEDURE] -> lp_obteCatexid

			select prod_cat_nombre as catDes,prod_categoria_id as catId from prod_categoria where bestado=1 and 
			prod_subclasif_id='';

			DELIMITER $$
			create procedure lp_obteCatexid($idSubClasi int(11))
			COMMENT 'crear procedure obtener categoria por id sub-clasificacion'
			BEGIN
			select prod_cat_nombre as catDes,prod_categoria_id as catId from prod_categoria where bestado=1 and 
			prod_subclasif_id=$idSubClasi;
			end;

			# [PROCEDURE] -> lp_obteTipxId

			select prod_tipo_nombre as tipDes,prod_tipo_id as tipId from prod_tipo where bestado=1 and prod_categoria_id='';

			DELIMITER $$
			create procedure lp_obteTipxId($catId int(11))
			COMMENT 'crear procedure obtener tipo por categoria id'
			BEGIN
			select prod_tipo_nombre as tipDes,prod_tipo_id as tipId from prod_tipo where bestado=1 and 
			prod_categoria_id=$catId;
			end;

			# [PROCEDURE] -> lp_obteMarModxId

			select 
			mm_nombre as modelo,
			mm_id_padre as idPad,
			mm_id as idMod,
			(select mm_nombre from mm where mm_id=idPad) as marca,
			(select concat(marca,' - ',modelo)) as marModel
			from mm where mm_id_padre>0 and prod_tipo_id='' and bestado=1;

			DELIMITER $$
			create procedure lp_obteMarModxId($idTip int(11))
			COMMENT 'crear procedure obtener marca-modelo por tipo id'
			BEGIN
			select distinct
			mm_nombre as modelo,
			mm_id_padre as idPad,
			mm_id as idMod,
			(select mm_nombre from mm where mm_id=idPad) as marca,
			(select concat(marca,' - ',modelo)) as marModel
			from mm where mm_id_padre>0 and prod_tipo_id=$idTip and bestado=1 group by marModel;
			end;

			# [PROCEDURE] -> lp_obteProdxid

			select producto_id as prodId,prod_nombre as prodNom,prod_alias as prodAli,prod_descrip as prodDes
			where marca_id='' and modelo_id='';

			DELIMITER $$
			create procedure lp_obteProdxid($idMar int(11),$idMod int(11),$idTip int(11),$idCat int(11),$idSub int(11))
			COMMENT 'crear procedure obtener productos por marca y modelo id'
			BEGIN
			select 
			producto_id as prodId,
			prod_nombre as prodNom,
			prod_alias as prodAli,
			prod_descrip as prodDes,
			ubigeo_id as ubiId,
			(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId) as ubiDes 
			from producto where marca_id=$idMar and modelo_id=$idMod and prod_tipo_id=$idTip and prod_categoria_id=$idCat 
			and prod_subclasif_id=$idSub and flagLinea=0;
			end;

			# [FUNCTION] -> lp_imporProd

			CREATE FUNCTION lp_imporProd($idProd int(11))
			RETURNS int(11)
			COMMENT 'crear function importar producto'
			BEGIN

			declare $codLine int(11);
			declare $tamCod int(11);
			declare $correLine char(25);
			declare $rowAfect int(11);

			insert into lp_lineProd(lp_idProd) values ($idProd);

			set $codLine=(select LAST_INSERT_ID());
			set $rowAfect=(select ROW_COUNT());
			set $tamCod=(select length($codLine));

			if($tamCod>5) then
			set $tamCod=$tamCod;
			else
			set $tamCod=5;
			end if;

			set $correLine=(select concat('PROD-',LPAD($codLine,$tamCod,'0')));

			update lp_lineProd set lp_codLineProd=$correLine where lp_lineProdId=$codLine;

			update producto set flagLinea=1 where producto_id=$idProd;

			return $rowAfect;

			end;

			# [PROCEDURE] -> lp_listLineProd


			select
			prod.codLineProd as cod,
			cate.prod_cat_nombre as cat,
			tip.prod_tipo_nombre as tip,
			mar.mm_nombre as mar,
			model.mm_nombre as model,
			prod.prod_nombre as nomEspa,
			prod.prod_alias as nomIngle,
			prod.ubigeo_id as ubiId,
			(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
			prod_descrip as des
			from 
			producto as prod
			inner join
			prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id,
			inner join
			prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id,
			inner join
			mm as mar on prod.marca_id=mar.mm_id,
			inner join
			lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
			where
			prod.bestado=1 and prod.flagLinea=1;

			DELIMITER $$
			CREATE PROCEDURE lp_listLineProd($desBus varchar(25),$tare varchar(25))
			COMMENT 'crear procedure listar linea de productos'
			BEGIN

			CASE $tare
			
			WHEN 'todo' THEN

				select
				lineProd.lp_lineProdId as id,
				lineProd.lp_codLineProd as cod,
				subClasi.prod_subclasif_nombre as sub,
				cate.prod_cat_nombre as cat,
				tip.prod_tipo_nombre as tip,
				mar.mm_nombre as mar,
				model.mm_nombre as model,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.ubigeo_id as ubiId,
				(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
				prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax,
				lineProd.lp_stockActu as stockActu,
				lineProd.lp_precioUnit as preciUnit,
				lineProd.lp_moneId as moneId,
				(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
				from 
				producto as prod
				inner join
				prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
				inner join
				prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
				inner join
				prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
				inner join
				mm as mar on prod.marca_id=mar.mm_id
				inner join
				mm as model on prod.modelo_id=model.mm_id
				inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				where
				prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1;

			WHEN 'filtro' THEN

				declare $filBus varchar(25);
				set $filBus=(select concat("%",$desBus,"%"));

				select
				lineProd.lp_lineProdId as id,
				lineProd.lp_codLineProd as cod,
				subClasi.prod_subclasif_nombre as sub,
				cate.prod_cat_nombre as cat,
				tip.prod_tipo_nombre as tip,
				mar.mm_nombre as mar,
				model.mm_nombre as model,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.ubigeo_id as ubiId,
				(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
				prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax,
				lineProd.lp_stockActu as stockActu,
				lineProd.lp_precioUnit as preciUnit,
				lineProd.lp_moneId as moneId,
				(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
				from 
				producto as prod
				inner join
				prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
				inner join
				prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
				inner join
				prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
				inner join
				mm as mar on prod.marca_id=mar.mm_id
				inner join
				mm as model on prod.modelo_id=model.mm_id
				inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				where
				prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and 
				subClasi.prod_subclasif_nombre like $filBus;

			END CASE;
				
			end;
			

			# [FUNCTION] -> lp_eliLineProd

			# obtener id producto de linea
			select `lp_idProd` from lp_lineProd where `lp_lineProdId`='';

			# actualizar campo de flagLinea de producto
			update producto set flagLinea=0 where producto_id='';

			# eliminar linea de producto
			update lp_lineProd set lp_estaEli=0 where lp_lineProdId='';

			DELIMITER $$
			create function lp_eliLineProd($idLine int(11))
			RETURNS int(11)
			COMMENT 'crear function para eliminar linea de producto'
			BEGIN
			declare $idProd int(11);
			declare $rowAfect int(11);
			set $idProd=(select `lp_idProd` from lp_lineProd where `lp_lineProdId`=$idLine);
			update producto set flagLinea=0 where producto_id=$idProd;
			update lp_lineProd set lp_estaEli=0 where lp_lineProdId=$idLine;
			set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# [FUNCTION] -> lp_obteCantLine

			# obtener cantidad de productos en line
			select count(*) from lp_lineProd where lp_estaEli=1;

			DELIMITER $$
			create function lp_obteCantLine()
			RETURNS int(11)
			COMMENT 'crear subvista configuracion de stock'
			BEGIN
			declare $cantLine int(11);
			set $cantLine=select count(*) from lp_lineProd where lp_estaEli=1;
			return 
			end;

			# [FUNCTION] -> [lp_addConfStock]

			# agregar configuracion de stock a linea
			insert lp_lineProd(lp_stockMin,lp_stockMax,lp_precioUnit,lp_moneId) values ('','','','') where lp_lineProdId='';

			create function lp_addConfStock($stockMin,$stockMax,$preUni,$moneId)
			RETURNS int(11)
			COMMENT 'crear procedure para agregar configuracion de stock'
			BEGIN
			insert lp_lineProd(lp_stockMin,lp_stockMax,lp_precioUnit,lp_moneId) values 
			($stockMin,$stockMax,$preUni,$moneId) where lp_lineProdId='';
			end;

			# [PROCEDURE] -> [lp_iniConfStock]

			# iniciar configuracion de stock
			select
			lineProd.lp_lineProdId as id,
			lineProd.lp_codLineProd as cod,
			subClasi.prod_subclasif_nombre as sub,
			cate.prod_cat_nombre as cat,
			tip.prod_tipo_nombre as tip,
			mar.mm_nombre as mar,
			model.mm_nombre as model,
			prod.prod_nombre as nomEspa,
			prod.prod_alias as nomIngle,
			prod.ubigeo_id as ubiId,
			(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
			prod.prod_descrip as des,
			lineProd.lp_stockMin as stockMin,
			lineProd.lp_stockMax as stockMax,
			lineProd.lp_stockActu as stockActu,
			lineProd.lp_precioUnit as preciunit,
			lineProd.lp_moneId as moneid
			from 
			producto as prod
			inner join
			prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
			inner join
			prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
			inner join
			prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
			inner join
			mm as mar on prod.marca_id=mar.mm_id
			inner join
			mm as model on prod.modelo_id=model.mm_id
			inner join
			lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
			where
			prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and 
			lineProd.lp_lineProdId='';

			DELIMITER $$
			create procedure lp_iniConfStock($idLineProd int(11))
			COMMENT 'crear procedure para iniciar configuracion de stock'
			BEGIN
				select
				lineProd.lp_lineProdId as id,
				lineProd.lp_codLineProd as cod,
				subClasi.prod_subclasif_nombre as sub,
				cate.prod_cat_nombre as cat,
				tip.prod_tipo_nombre as tip,
				mar.mm_nombre as mar,
				model.mm_nombre as model,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.ubigeo_id as ubiId,
				(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
				prod.prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax,
				lineProd.lp_stockActu as stockActu,
				lineProd.lp_precioUnit as preciunit,
				lineProd.lp_moneId as moneid
				from 
				producto as prod
				inner join
				prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
				inner join
				prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
				inner join
				prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
				inner join
				mm as mar on prod.marca_id=mar.mm_id
				inner join
				mm as model on prod.modelo_id=model.mm_id
				inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				where
				prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and 
				lineProd.lp_lineProdId=$idLineProd;
			end;

			# [FUNCTION] -> lp_actuConfStock

			# actualizar configuracion stock
			update lp_lineProd set lp_stockMin='',lp_stockMax='',lp_stockActu='',lp_precioUnit='',lp_moneId='' 
			where lp_lineProdId='';

			DELIMITER $$
			create function lp_actuConfStock($stockMin int(11),$stockMax int(11),$precioUnit decimal(25,2),$moneId int(11),$lineId int(11))
			RETURNS int(11)
			COMMENT 'crear function para actualizar configuracion de stock'
			BEGIN
			declare $rowAfect int(11);
			update lp_lineProd set lp_stockMin=$stockMin,lp_stockMax=$stockMax,
			lp_precioUnit=$precioUnit,lp_moneId=$moneId
			where lp_lineProdId=$lineId;
			set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# [PROCEDURE] -> lp_iniMone

			# iniciar tipos de moneda
			select
			mon_sigla as monSig,
			moneda_id as monId
			from
			moneda;

			DELIMITER $$
			create procedure lp_iniMone()
			COMMENT 'iniciar tipos de moneda'
			BEGIN
				select
				mon_sigla as monSig,
				moneda_id as monId
				from
				moneda;
			end;

			# evaluar si producto tiene movimiento [lp_movExis_eva] !New

			DELIMITER $$
			create function lp_movExis_eva($idLine int(11))
			RETURNS int(11)
			COMMENT 'evaluar si producto tiene movimiento'
			BEGIN
				#code
				declare $valEva int(11);

				set $valEva=(select count(*) from
				lp_lineProd as line,
				kd_numSeri as numSeri
				where 
				line.lp_lineProdId=numSeri.kd_prodId and
				numSeri.kd_prodId=$idLine);

				return $valEva;
			end;

			# agregar id almacen barbones por defecto !New

			update kd_numSeri set kd_almcid=1;



			-----------------------------------------------------------------------------
			/**************** 30/07/2014 [ UI - Nuevo Productos ]***********************/
			-----------------------------------------------------------------------------

			# mostrar marcas de productos [lp_marProd_mos] ###### OK ########

			DELIMITER $$
			create procedure lp_marProd_mos()
			COMMENT 'mostrar marcas de productos'
			BEGIN
				select mm_id,mm_nombre from mm where bestado=1 and mm_id_padre=0;
			end;

			# Ingresar nueva linea de productos [lp_lineProd_ingre] ### OK ##

			DELIMITER $$
			create function lp_lineProd_ingre($subId int(11),$cateId int(11),$marId int(11),$nomEspa varchar(150),$nomIngle varchar(150),$desProd text,$stockMin int(11),$stockMax int(11))
			RETURNS int(11)
			COMMENT 'Ingresar nueva linea de productos'
			BEGIN
			declare $rowAfect int(11);
			declare $idProd int(11);
			declare $codLine int(11);
			declare $tamCod int(11);
			declare $correLine char(25);

				/* code sql */
				insert into producto(prod_subclasif_id,prod_categoria_id,marca_id,prod_nombre,prod_alias,prod_descrip) 
				values ($subId,$cateId,$marId,$nomEspa,$nomIngle,$desProd);

				set $idProd=(select LAST_INSERT_ID());

				insert into lp_lineProd(lp_idProd,lp_stockMin,lp_stockMax) values ($idProd,$stockMin,$stockMax);

				set $codLine=(select LAST_INSERT_ID());
				set $rowAfect=(select ROW_COUNT());
				set $tamCod=(select length($codLine));

				if($tamCod>5) then
				set $tamCod=$tamCod;
				else
				set $tamCod=5;
				end if;

				set $correLine=(select concat('PROD-',LPAD($codLine,$tamCod,'0')));

				update lp_lineProd set lp_codLineProd=$correLine where lp_lineProdId=$codLine;

				update producto set flagLinea=1 where producto_id=$idProd;

			return $rowAfect;

			end;

			# Nueva sub-clasificacion [lp_subClasi_nuev] ##### OK ######

			DELIMITER $$
			create function lp_subClasi_nuev($subNom varchar(50))
			RETURNS int(11)
			COMMENT 'Nueva sub-clasificacion'
			BEGIN
			declare $rowAfect int(11);
				# code sql
				insert into prod_subclasif(`prod_clasificacion_id`,`prod_subclasif_nombre`,`bestado`) values (1,$subNom,1);
				set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# Nueva categoria [lp_cate_nuev] #### OK #####

			DELIMITER $$
			create function lp_cate_nuev($subId int(11),$catNom varchar(50))
			RETURNS int(11)
			COMMENT 'Nueva categoria'
			BEGIN
			declare $rowAfect int(11);
				# code sql
				insert into prod_categoria (prod_subclasif_id,prod_cat_nombre,bestado) 
				values ($subId,$catNom,1);
				set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# Nuevo tipo [lp_tip_nuev] #### OK #####

			DELIMITER $$
			create function lp_tip_nuev($catId int(11),$tipNom varchar(50))
			RETURNS int(11)
			COMMENT 'Nuevo tipo'
			BEGIN
				declare $rowAfect int(11);
				# code sql
				insert into prod_tipo(`prod_categoria_id`,`prod_tipo_nombre`,`bestado`) values ($catId,$tipNom,1);
				set $rowAfect=(select ROW_COUNT());
				return $rowAfect;
			end;

			# Nueva marca modelo [lp_marMod_nuev] ### OK ####

			DELIMITER $$
			create function lp_marMod_nuev($marId int(11),$tipId int(11),$modNom varchar(50),$modAlias varchar(50))
			RETURNS int(11)
			COMMENT 'Nueva marca modelo'
			BEGIN
			declare $rowAfect int(11);
				# code sql
				insert into mm(mm_id_padre,prod_tipo_id,mm_nombre,mm_alias,bestado) 
				values ($marId,$tipId,$modNom,$modAlias,1);
				set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# Nueva marca [lp_mar_nuev] ##### OK ########

			DELIMITER $$
			create function lp_mar_nuev($marNom varchar(50),$marAlias varchar(50))
			RETURNS int(11)
			COMMENT 'Nueva marca'
			BEGIN
			declare $rowAfect int(11);
				# code sql
				insert into mm(prod_tipo_id,mm_id_padre,mm_nombre,mm_alias,bestado) values (0,0,$marNom,$marAlias,1);
				set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# Obtener marca por categoria [lp_marxCat_obte] ##### OK #######

			select distinct
			m2.mm_id_padre,
			m1.mm_alias,
			m1.mm_nombre
			from mm as m1,mm as m2,producto as prod,lp_lineProd as lineProd
			where m2.mm_id_padre!=0 and
			m2.mm_id_padre=m1.mm_id and
			m2.prod_categoria_id=2;

			DELIMITER $$
			create procedure lp_marxCat_obte()
			COMMENT 'Obtener marca por categoria'
			BEGIN
				select distinct mm_id,mm_nombre from mm where bestado=1 and mm_id_padre=0 order by mm_nombre ASC;
				/*
					select distinct
					m2.mm_id_padre,
					m1.mm_alias,
					m1.mm_nombre
					from mm as m1,mm as m2,producto as prod,lp_lineProd as lineProd
					where m2.mm_id_padre!=0 and
					m2.mm_id_padre=m1.mm_id and
					m2.prod_categoria_id=$catId;
				*/
			end;

			# Obtener productos creados para edicion [lp_prodCread_ini]

			DELIMITER $$
			create procedure lp_prodCread_ini($idLine int(11))
			COMMENT 'Obtener productos creados para edicion'
			BEGIN
				#code
				select
				prod.prod_subclasif_id as idSubClasi,
				prod.prod_categoria_id as idCat,
				prod.marca_id as idMar,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax
				from 
				lp_lineProd as lineProd inner join
				producto as prod on lineProd.lp_idProd=prod.producto_id
				where lineProd.lp_lineProdId=$idLine;
			end;

			# Actualizar productos creados en linea [lp_prodCread_actu]

			DELIMITER $$
			create function lp_prodCread_actu($idLine int(11),$idSub int(11),$idCat int(11),$idMar int(11),$nomEspa varchar(150),$nomIngle varchar(150),$des text,$stockMin int(11),$stockMax int(11))
			RETURNS int(11)
			COMMENT 'Actualizar productos creados en linea'
			BEGIN
				#code
				declare $rowAfect int(11);

				update 
				lp_lineProd as lineProd,
				producto as prod
				set
				prod.prod_subclasif_id=$idSub,
				prod.prod_categoria_id=$idCat,
				prod.marca_id=$idMar,
				prod.prod_nombre=$nomEspa,
				prod.prod_alias=$nomIngle,
				prod.prod_descrip=$des,
				lineProd.lp_stockMin=$stockMin,
				lineProd.lp_stockMax=$stockMax
				where
				lineProd.lp_idProd=prod.producto_id and
				lineProd.lp_lineProdId=$idLine;

				set $rowAfect=(SELECT ROW_COUNT());

				return $rowAfect;

			end;



			-------------------------------------------------------------------------
			############################### KARDEX #################################
			-------------------------------------------------------------------------

			#[FUNCTION]-> kd_geneMovKardx -> OK

			DELIMITER $$

			CREATE FUNCTION kd_geneMovKardx($tipMov int(11))
			RETURNS int(11)
			COMMENT 'generar movimiento kardex'
			BEGIN

			declare $codKardx int(11);
			declare $tamCod int(11);
			declare $correKardx char(25);
			declare $rowAfect int(11);

			insert into kd_kardx(kd_kardxNro,kd_tipMov) values ('-',$tipMov) ;

			set $codKardx=(select LAST_INSERT_ID());
			set $rowAfect=(select ROW_COUNT());
			set $tamCod=(select length($codKardx));

			if($tamCod>5) then
			set $tamCod=$tamCod;
			else
			set $tamCod=5;
			end if;

			set $correKardx=(select concat('MOV-',LPAD($codKardx,$tamCod,'0')));

			update kd_kardx set kd_kardxNro=$correKardx where kd_kardxId=$codKardx;

			return $codKardx;

			end;

			# [FUNCTION] -> kd_correMov_obte -> OK

			DELIMITER $$
			create function kd_correMov_obte($idkardx int(11))
			RETURNS char(25)
			COMMENT 'obtener correlativo de movimiento'
			BEGIN
			declare $correKardx char(25);
			set $correKardx=(select kd_kardxNro from kd_kardx where kd_kardxId=$idkardx);
			return $correkardx;
			end;


			# [PROCEDURE] -> kd_tipMov_obte -> OK

			DELIMITER $$
			create procedure kd_tipMov_obte()
			COMMENT 'obtener tipo de movimiento'
			BEGIN
			SELECT kd_tipMovDes as des,kd_tipMovId as id FROM `kd_tipMov`;
			end;


			# [PROCEDURE] -> kd_emp_obte -> OK

			DELIMITER $$
			create procedure kd_emp_obte($perfEmp varchar(15))
			COMMENT 'obtener empresas clientes o proveedores'
			BEGIN

			CASE ($perfEmp)

			WHEN 'cli' then
			# CLIENTES

			select distinct
			emp.emp_nombre as empDes,
			emp.empresa_id as empId
			from
			empresa as emp inner join
			anfi_empresa as anfi on emp.empresa_id=anfi.empresa_id  inner join
			empresa_perfil as perf on anfi.emp_perfil_id=perf.empresa_perfil_id
			where
			anfi.bestado=1 and perf.empresa_perfil_id=1;

			WHEN 'prov' then
			# PROVEEDORES

			select distinct
			emp.emp_nombre as empDes,
			emp.empresa_id as empId
			from
			empresa as emp inner join
			anfi_empresa as anfi on emp.empresa_id=anfi.empresa_id  inner join
			empresa_perfil as perf on anfi.emp_perfil_id=perf.empresa_perfil_id
			where
			anfi.bestado=1 and perf.empresa_perfil_id=2;

			WHEN 'tod' then
			# TODOS

			select distinct
			emp.emp_nombre as empDes,
			emp.empresa_id as empId
			from
			empresa as emp inner join
			anfi_empresa as anfi on emp.empresa_id=anfi.empresa_id  inner join
			empresa_perfil as perf on anfi.emp_perfil_id=perf.empresa_perfil_id
			where
			anfi.bestado=1;

			END CASE;

			end;

			# [FUNCTION] -> kd_geneMov_upd -> OK

			DELIMITER $$
			create function kd_geneMov_upd($kdxId int(11),$tipMov int(11),$kdxEmp int(11),$kdxFech date,$tipDoc int(11),$kdxDoc char(25),$kdxDes varchar(200),$kdxMone int(11))
			RETURNS int(11)
			COMMENT 'actualizar movimiento general'
			BEGIN
			declare $rowAfect int(11);
			update `kd_kardx` set 
			kd_tipMov=$tipMov,
			kd_kardxEmp=$kdxEmp,
			kd_kardxFech=$kdxFech,
			kd_tipDoc=$tipDoc,
			kd_kardxDoc=$kdxDoc,
			kd_kardxDes=$kdxDes,
			kd_kardxMone=$kdxMone
			where kd_kardxId=$kdxId;

			set $rowAfect=(select ROW_COUNT());

			return $rowAfect;
			end;

			# [PROCEDURE] -> kd_obteSubClasi -> OK

			select prod_subclasif_nombre as subClasi,prod_subclasif_id as subClasiId from prod_subclasif where 
			prod_clasificacion_id=1 and bestado=1
			
			DELIMITER $$
			create procedure kd_obteSubClasi()
			COMMENT 'crear procedure obtener sub-clasificion de productos'
			BEGIN
			select distinct 
			subClasi.prod_subclasif_nombre as subClasi,
			subClasi.prod_subclasif_id as subClasiId 
			from prod_subclasif as subClasi inner join 
			producto as prod on prod.prod_subclasif_id=subClasi.prod_clasificacion_id inner join 
			lp_lineProd as line on line.lp_idProd=prod.producto_id  
			where 
			subClasi.prod_clasificacion_id=1 and 
			subClasi.bestado=1 and
			prod.flagLinea=1 and
			line.lp_estaEli=1;
			end;

			# [PROCEDURE] -> kd_obteCatexid -> OK

			select prod_cat_nombre as catDes,prod_categoria_id as catId from prod_categoria where bestado=1 and 
			prod_subclasif_id='';

			DELIMITER $$
			create procedure kd_obteCatexid($idSubClasi int(11))
			COMMENT 'crear procedure obtener categoria por id sub-clasificacion'
			BEGIN
			select distinct
			cat.prod_cat_nombre as catDes,
			cat.prod_categoria_id as catId 
			from prod_categoria as cat inner join
			producto as prod on prod.prod_categoria_id=cat.prod_categoria_id inner join
			lp_lineProd as line on line.lp_idProd=prod.producto_id
			where 
			cat.bestado=1 and 
			cat.prod_subclasif_id=$idSubClasi and
			prod.flagLinea=1 and
			line.lp_estaEli=1;
			end;


			# [PROCEDURE] -> kd_obteTipxId -> OK

			select prod_tipo_nombre as tipDes,prod_tipo_id as tipId from prod_tipo where bestado=1 and prod_categoria_id='';

			DELIMITER $$
			create procedure kd_obteTipxId($catId int(11))
			COMMENT 'crear procedure obtener tipo por categoria id'
			BEGIN
			select distinct
			tip.prod_tipo_nombre as tipDes,
			tip.prod_tipo_id as tipId 
			from prod_tipo as tip inner join
			producto as prod on prod.prod_tipo_id=tip.prod_tipo_id inner join
			lp_lineProd as line on line.lp_idProd=prod.producto_id
			where 
			tip.bestado=1 and 
			tip.prod_categoria_id=$catId and
			prod.flagLinea=1 and
			line.lp_estaEli=1;
			end;

			# [PROCEDURE] -> kd_obteMarModxId -> OK

			select 
			mm_nombre as modelo,
			mm_id_padre as idPad,
			mm_id as idMod,
			(select mm_nombre from mm where mm_id=idPad) as marca,
			(select concat(marca,' - ',modelo)) as marModel
			from mm where mm_id_padre>0 and prod_tipo_id='' and bestado=1;

			DELIMITER $$
			create procedure kd_obteMarModxId($idTip int(11))
			COMMENT 'crear procedure obtener marca-modelo por tipo id'
			BEGIN
			select distinct
			marMod.mm_nombre as modelo,
			marMod.mm_id_padre as idPad,
			marMod.mm_id as idMod,
			(select mm_nombre from mm where mm_id=idPad) as marca,
			(select concat(marca,' - ',modelo)) as marModel
			from mm as marMod 
			inner join
			producto as prod on 
			prod.prod_tipo_id=marMod.prod_tipo_id 
			and prod.modelo_id=marMod.mm_id and 
			prod.marca_id=marMod.mm_id_padre  
			inner join
			lp_lineProd as line on line.lp_idProd=prod.producto_id 
			where 
			marMod.mm_id_padre>0 and 
			marMod.prod_tipo_id=$idTip and 
			marMod.bestado=1 and
			prod.flagLinea=1 and
			line.lp_estaEli=1
			group by line.lp_idProd;
			end;

			# [FUNCTION] -> kd_detKard_agre -> OK

			DELIMITER $$
			create function kd_detKard_agre($kdxId int(11),$prodId int(11),$preUni decimal(25,2),$kdxCant int(11))
			RETURNS int(11)
			COMMENT 'agregar detalle kardex'
			BEGIN
			declare rowAfect int(11);
			insert into 
			kd_detKardx(`kd_kardxId`,`kd_detKardxProd`,`kd_detKardxPreUni`,`kd_detKardxCant`) 
			values($kdxId,$prodId,$preUni,$KdxCant);
			set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# [PROCEDURE] -> kd_obteProdxid -> OK

			DELIMITER $$
			create procedure kd_obteProdxid($idMar int(11),$idCat int(11),$idSub int(11))
			COMMENT 'crear procedure obtener productos por marca y modelo id'
			BEGIN
			select
			lineProd.lp_lineProdId as id,
			lineProd.lp_codLineProd as cod,
			subClasi.prod_subclasif_nombre as sub,
			cate.prod_cat_nombre as cat,
			mar.mm_nombre as mar,
			prod.prod_nombre as nomEspa,
			prod.prod_alias as nomIngle,
			prod.ubigeo_id as ubiId,
			(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
			prod_descrip as des,
			lineProd.lp_stockMin as stockMin,
			lineProd.lp_stockMax as stockMax,
			lineProd.lp_stockActu as stockActu,
			(select count(*) from kd_numSeri where kd_estaStockId=1 and kd_prodId=id) as stockActu2,
			lineProd.lp_precioUnit as preciUnit,
			lineProd.lp_moneId as moneId,
			(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
			from 
			producto as prod
			inner join
			prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
			inner join
			prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
			inner join
			mm as mar on prod.marca_id=mar.mm_id
			inner join
			lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
			where
			prod.bestado=1 and 
			prod.flagLinea=1 and 
			lineProd.lp_estaEli=1 and
			prod.prod_subclasif_id=$idSub and
			prod.prod_categoria_id=$idCat and 
			prod.marca_id=$idMar;
			end;


			# [PROCEDURE] -> kd_detKardxid -> OK

			DELIMITER $$
			create procedure kd_detKardxid($kdxId int(11))
			COMMENT 'crear procedure obtener productos por marca y modelo id'
			BEGIN
			select
			lineProd.lp_lineProdId as id,
			lineProd.lp_codLineProd as cod,
			subClasi.prod_subclasif_nombre as sub,
			cate.prod_cat_nombre as cat,
			mar.mm_nombre as mar,
			prod.prod_nombre as nomEspa,
			prod.prod_alias as nomIngle,
			prod.ubigeo_id as ubiId,
			(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
			prod_descrip as des,
			lineProd.lp_stockMin as stockMin,
			lineProd.lp_stockMax as stockMax,
			lineProd.lp_stockActu as stockActu,
			lineProd.lp_precioUnit as preciUnit,
			lineProd.lp_moneId as moneId,
			(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla,
			detKardx.kd_detKardxPreUni as kdxPreUni,
			detKardx.kd_detKardxCant as kdxCant,
			detKardx.kd_detKardxId as detKardxId
			from 
			producto as prod
			inner join
			prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
			inner join
			prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
			inner join
			mm as mar on prod.marca_id=mar.mm_id
			inner join
			lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
			inner join
			kd_detKardx as detKardx on lineProd.lp_lineProdId=detKardx.kd_detKardxProd
			where
			prod.bestado=1 and 
			prod.flagLinea=1 and 
			lineProd.lp_estaEli=1 and
			detKardx.kd_kardxId=$kdxId
			end;


			# [FUNCTION] -> [kd_eliDetMov] -> OK

			DELIMITER $$
			create function kd_eliDetMov($idKdxDet int(11))
			RETURNS int(11)
			COMMENT 'Eliminar detalle de movimiento'
			BEGIN
			declare $rowAfect int(11);

			#borrar movimiento de numeros de serie
			delete from kd_movNumSeri where kd_detKardxId=$idKdxDet;
			
			#borrar item del detalle movimiento
			delete from kd_detKardx where kd_detKardxId=$idKdxDet;
			set $rowAfect=(select ROW_COUNT());
			return $rowAfect;
			end;

			# [PROCEDURE] -> [kd_iniGenKardx] -> OK

			DELIMITER $$
			create procedure kd_iniGenKardx($kardxId int(11))
			COMMENT 'Iniciar general de kardex'
			BEGIN
			select
			kd_tipMov as tipMov,
			kd_kardxEmp as empId,
			(select emp_nombre from empresa where empresa_id=empId) as empDes,
			kd_kardxFech as fechMov,
			kd_tipMov as tipDoc,
			kd_kardxDoc as numDoc,
			kd_kardxDes as desMov,
			kd_kardxMone as moneMov
			from kd_kardx where kd_kardxId=$kardxId;
			end;

			# [FUNCTION] -> [kd_iniMoneMov] -> OK

			DELIMITER $$
			create function kd_iniMoneMov($kardxId int(11))
			RETURNS varchar(10)
			COMMENT 'Iniciar moneda de movimiento'
			BEGIN
			declare $monKardx varchar(10);
			declare $moneId int(11);
			set $moneId=(select kd_kardxMone as moneId from kd_kardx where kd_kardxId=$kardxId);
			set $monKardx=(select mon_sigla from moneda where moneda_id=$moneId);
			return $monKardx;
			end;

			# [PROCEDURE] -> [kd_histKardx] -> OK

			DELIMITER $$
			create procedure kd_histKardx($filTipMov int(11))
			COMMENT 'Lista historica de kardex'
			BEGIN

			CASE ($filTipMov)

			when 1 then

			select
			kd_kardxId as id,
			kd_kardxNro as cod,
			kd_kardxDoc as numDoc,
			kd_tipDoc as tipDocId,
			(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDocId) as tipDocDes,
			kd_kardxFech as fechMov,
			kd_tipMov as tipMovId,
			(select kd_tipMovDes from kd_tipMov where kd_tipMovId=tipMovId) as tipMovDes,
			kd_kardxDes as desMov,
			kd_kardxEmp as empId,
			(select emp_nombre from empresa where empresa_id=empId) as empDes,
			kd_kardxMone as moneId,
			(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
			(select sum(kd_detKardxPreUni*kd_detKardxCant) from kd_detKardx where kd_kardxId=id) as tot
			from kd_kardx where kd_tipMov=1;

			when 2 then

			select
			kd_kardxId as id,
			kd_kardxNro as cod,
			kd_kardxDoc as numDoc,
			kd_tipDoc as tipDocId,
			(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDocId) as tipDocDes,
			kd_kardxFech as fechMov,
			kd_tipMov as tipMovId,
			(select kd_tipMovDes from kd_tipMov where kd_tipMovId=tipMovId) as tipMovDes,
			kd_kardxDes as desMov,
			kd_kardxEmp as empId,
			(select emp_nombre from empresa where empresa_id=empId) as empDes,
			kd_kardxMone as moneId,
			(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
			(select sum(kd_detKardxPreUni*kd_detKardxCant) from kd_detKardx where kd_kardxId=id) as tot
			from kd_kardx where kd_tipMov=2;

			end case;
			
			end;

			# [FUNCTION] -> [kd_actuStockLine] ## OK

			DELIMITER $$
			create function kd_actuStockLine($idLineProd int(11),$tipMov int(11),$cant int(11))
			RETURNS int(11)
			COMMENT 'Actualizar stock de linea de productos'
			BEGIN
			declare $stockActu int(11);
			declare $rowAfect int(11) default 0;
			
			CASE ($tipMov)
			
			WHEN 1 then

				update lp_lineProd set lp_stockActu=lp_stockActu+$cant where lp_lineProdId=$idLineProd;
				set $rowAfect=(select ROW_COUNT());

			WHEN 2 then

				set $stockActu=(select lp_stockActu from lp_lineProd where lp_lineProdId=$idLineProd);

				if($stockActu>=$cant) then
					update lp_lineProd set lp_stockActu=lp_stockActu-$cant where lp_lineProdId=$idLineProd;
					set $rowAfect=(select ROW_COUNT()); 
				else
					set $rowAfect=$rowAfect;
				end if;

			end case;

			return $rowAfect;

			end;

			# [FUNCTION] -> [kd_reverStock] ## OK

			DELIMITER $$
			create function kd_reverStock($tipMov int(11),$idDet int(11))
			RETURNS int(11)
			COMMENT 'Revetir stock de detalle de moviminto'
			BEGIN
			declare $idProdMov int(11);
			declare $cantMov int(11);
			declare $rowAfect int(11) default 0;

			set $idProdMov=(select kd_detKardxProd from kd_detKardx where kd_detKardxId=$idDet);
			set $cantMov=(select kd_detKardxCant from kd_detKardx where kd_detKardxId=$idDet);


			CASE ($tipMov)

			WHEN 1 THEN

				update lp_lineProd set lp_stockActu=lp_stockActu-$cantMov where lp_lineProdId=$idProdMov;
				set $rowAfect=(select ROW_COUNT());

			WHEN 2 THEN

				update lp_lineProd set lp_stockActu=lp_stockActu+$cantMov where lp_lineProdId=$idProdMov;
				set $rowAfect=(select ROW_COUNT());

			END CASE;

			return $rowAfect;

			end;

			# capturar detalle de movimiento ## OK

			select
			group_concat(concat(prod.prod_nombre,' ','-',' ',mm.mm_nombre,'(',detKardx.kd_detKardxCant,')') separator '\n')
			from
			kd_detKardx as detKardx,
			lp_lineProd as line,
			producto as prod,
			mm as mm
			where
			detKardx.kd_kardxId=99 and
			detKardx.kd_detKardxProd=line.lp_lineProdId and
			line.lp_idProd=prod.producto_id and
			prod.marca_id=mm.mm_id;

			# eliminar movimiento de kardex [kd_movKardx_eli] ## OK

			DELIMITER $$
			create function kd_movKardx_eli($kardxId int(11))
			RETURNS int(11)
			COMMENT 'eliminar movimiento de kardex'
			BEGIN
				declare $flagFun int(11);
				delete from kd_kardx where kd_kardxId=$kardxId;
				set $flagFun=(select ROW_COUNT());
				return $flagFun;
			end;

			# obtener stock agrupados por almacen [kd_stockAgru_obte] ## OK

			select distinct
			kd_almcId as almcId,
			kd_almcDes as almcDes,
			group_concat(concat(kd_almcDes,'(',(select count(*) from kd_numSeri where kd_prodId=4 and kd_estaStockId=1 and kd_almcId=almcId ),')') 
			SEPARATOR '<br>' ) as ubiEmp
			from kd_almcEmp;

			DELIMITER $$
			create procedure kd_stockAgru_obte($idProd int(11))
			COMMENT 'obtener stock agrupados por almacen'
			BEGIN
				select distinct
				kd_almcId as almcId,
				kd_almcDes as almcDes,
				group_concat(concat(kd_almcDes,'(',(select count(*) from kd_numSeri where kd_prodId=$idProd and kd_estaStockId=1 and kd_almcId=almcId ),')') 
				SEPARATOR '<br>' ) as ubiEmp
				from kd_almcEmp group by almcId;
			end;

			# query adecuada para reporte guia de remision

			# QUERY ESTRUCTURA GUIA REMISION GENERAL
			
			select
			(select kd_kardxEmp from kd_kardx where kd_kardxId=$P{p1}) as idEmp,
			(select emp_nombre from empresa where empresa_id=idEmp) as empDes,
			(select emp_ruc from empresa where empresa_id=idEmp) as empRuc,
			(select  kd_kardxFech from kd_kardx where kd_kardxId=$P{p1}) as fechMov,
			(select  kd_kardxDoc from kd_kardx where kd_kardxId=$P{p1}) as numDoc,
			(select SUBSTRING_INDEX(numDoc, '-', 1)) as numGui1,
			(select SUBSTRING_INDEX(numDoc, '-', -1)) as numGui2,
			(select  kd_tipDoc from kd_kardx where kd_kardxId=$P{p1}) as tipDoc,
			(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDoc) as tipDocDes,
			detKardx.kd_glosaDes as glosaDes,
			detKardx.itemCorre as itemCorre,
			(select  kd_desti from kd_kardx where kd_kardxId=$P{p1}) as desti,
			(select  kd_transId from kd_kardx where kd_kardxId=$P{p1}) as transId,
			(select concat(kd_transNom,' ',kd_transApe) from kd_trans where kd_transId=transId) as transDes,
			(select  kd_numFac from kd_kardx where kd_kardxId=$P{p1}) as numFacp,
			(select  kd_FacEmis from kd_kardx where kd_kardxId=$P{p1}) as facEmisp,
			(select if(facEmisp='0000-00-00'),'',facEmisp) as facEmis,
			(select if(numFacp='-','',numFacp)) as numFacp,
			(select emp_nombre from empresa where empresa_id=transId) as transEmp,
			(select emp_ruc from empresa where empresa_id=transId) as transRuc,
			(select emp_direccion from empresa where empresa_id=transId) as transDire,
			(select kd_almcId from kd_kardx where kd_kardxId=$P{p1}) as almcId,
			(select kd_almcUbi from kd_almcEmp where kd_almcId=almcId) as almcUbi,
			lineProd.lp_lineProdId as id,
			lineProd.lp_codLineProd as cod,
			subClasi.prod_subclasif_nombre as sub,
			cate.prod_cat_nombre as cat,
			mar.mm_nombre as mar,
			prod.prod_nombre as nomEspap,
			prod.prod_alias as nomIngle,
			prod.ubigeo_id as ubiId,
			(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
			prod_descrip as des,
			lineProd.lp_stockMin as stockMin,
			lineProd.lp_stockMax as stockMax,
			lineProd.lp_stockActu as stockActu,
			lineProd.lp_precioUnit as preciUnit,
			lineProd.lp_moneId as moneId,
			(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla,
			detKardx.kd_detKardxPreUni as kdxPreUni,
			detKardx.kd_detKardxCant as kdxCant,
			detKardx.kd_detKardxId as detKardxId,
			(select REPEAT('&nbsp;',50)) as marg,
			(select GROUP_CONCAT(kd_numSeri SEPARATOR '<br>') from
			kd_numSeri as numSeri,kd_movNumSeri as movSeri where
			numSeri.kd_prodId=id and
			numSeri.kd_numSeriId=movSeri.kd_numSeriId and
			movSeri.kd_detKardxId=detKardxId) as numSeriMov,
			(select GROUP_CONCAT(kd_numSeri SEPARATOR "\n\n") from
			kd_numSeri as numSeri,kd_movNumSeri as movSeri where
			numSeri.kd_prodId=id and
			numSeri.kd_numSeriId=movSeri.kd_numSeriId and
			movSeri.kd_detKardxId=detKardxId) as numSeriMov2,
			detKardx.kd_unid as unid,
			detKardx.kd_chkProd as chkProd,
			detKardx.kd_desProd as desProd,
			(select if(chkProd=0,nomEspap,desProd) ) as nomEspa
			from
			producto as prod
			inner join
			prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
			inner join
			prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
			inner join
			mm as mar on prod.marca_id=mar.mm_id
			inner join
			lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
			inner join
			kd_detKardx as detKardx on lineProd.lp_lineProdId=detKardx.kd_detKardxProd
			where
			prod.bestado=1 and
			prod.flagLinea=1 and
			lineProd.lp_estaEli=1 and
			detKardx.kd_kardxId=$P{p1};

			# actualizar glosa de guia de remision [kd_glosaMov_actu]

			DELIMITER $$
			create function kd_glosaMov_actu($idDet int(11),$glosaDes text,$itemCorre char(15))
			RETURNS int(11)
			COMMENT 'actualizar glosa de guia de remision'
			BEGIN
				declare $rowAfect int(11);
				#code
				update kd_detKardx set 
				kd_glosaDes=$glosaDes,
				itemCorre=$itemCorre 
				where 
				kd_detKardxId=$idDet;
				set $rowAfect=(select ROW_COUNT());
				return $rowAfect;
			end;

			# crear nuevo transportista [kd_nuevTrans_crear]

			DELIMITER $$
			create function kd_nuevTrans_crear($transNom varchar(25),$transApe varchar(50),$transDni char(15),$transRuc char(15),$transDomi text)
			RETURNS int(11)
			COMMENT 'crear nuevo transportista'
			BEGIN
				#code
				declare $rowAfect int(11);
				insert into kd_trans set kd_transNom=$transNom,kd_transApe=$transApe,kd_transDni=$transDni,kd_transRuc=$transRuc,
				kd_transDomi=$transDomi;
				set $rowAfect=(select ROW_COUNT());
				return $rowAfect;
			end;

			# capturar transportistas [kd_trans_cap]

			DELIMITER $$
			create procedure kd_trans_cap()
			COMMENT 'capturar transportistas'
			BEGIN
				#code
				select 
				concat(kd_transNom,' ',kd_transApe) as transDes,
				kd_transId as transId 
				from kd_trans;
			end;

			# crear una nueva empresa de transporte [kd_empTrans_crear]

			DELIMITER $$
			create function kd_empTrans_crear($empNom varchar(70),$ruc char(11),$dire varchar(250),$tel char(25))
			RETURNS int(11)
			COMMENT 'crear una nueva empresa de transporte'
			BEGIN

				#code
				declare $idEmp int(11);
				declare $idPerf int(11) default 3;
				declare $rowAfect int(11);

				insert into empresa(emp_nombre,emp_ruc,emp_direccion,emp_telef) values ($empNom,$ruc,$dire,$tel);

				set $idEmp=(select LAST_INSERT_ID());

				insert into anfi_empresa(empresa_id_padre,empresa_id,emp_perfil_id,bestado) values(1,$idEmp,$idPerf,1);

				set $rowAfect=(select ROW_COUNT());

				return $rowAfect;

			end;

			# obtener empresas de transportes [kd_empTrans_obte]

			DELIMITER $$
			create procedure kd_empTrans_obte()
			COMMENT 'obtener empresas de transportes'
			BEGIN
				select distinct
				emp.emp_nombre as empDes,
				emp.empresa_id as empId
				from
				empresa as emp inner join
				anfi_empresa as anfi on emp.empresa_id=anfi.empresa_id  inner join
				empresa_perfil as perf on anfi.emp_perfil_id=perf.empresa_perfil_id
				where
				anfi.bestado=1 and perf.empresa_perfil_id=3 and
				anfi.empresa_id_padre=1;
			end;

			# capturar ew de compras [kd_ewComp_cap]

			DELIMITER $$
			create procedure kd_ewComp_cap()
			COMMENT 'capturar ew de compras'
			BEGIN
				#code
				select comp_nro,compras_id from compras where bestado=1 and empresa_id=1
				and LEFT(comp_nro, 2)='EW';
			end;

			# validar numero de serie existentes [kd_numExis_vali]

			# [FUNCTION]

			create function kd_numExis_vali($numSeri char(25),$lineId int(11))
			RETURNS int(11)
			BEGIN
				#code
				declare $rowAfect int(11);

				set $rowAfect=(select count(*) from kd_numSeri where kd_numSeri=$numSeri and 
				kd_prodId=$lineId and kd_estaStockId=1);
				
				return $rowAfect;
			end;

			# capturar notas de pedidos pendientes [kd_notPend_cap] new!->np_

			# [PROCEDURE]

			DELIMITER $$
			create procedure kd_notPend_cap()
			COMMENT 'capturar notas de pedidos pendientes'
			BEGIN
				#code
				select np_correNot as correNot,np_notPedId as notId from np_notPed where np_estaNotId=1;
			end;

			# capturar detalle de nota de pedido [kd_detNot_cap] new!->np_

			# [PROCEDURE]

			DELIMITER $$
			create procedure kd_detNot_cap($notId int(11))
			COMMENT 'capturar detalle de nota de pedido'
			BEGIN
				#code
				select
				lineProd.lp_lineProdId as id,
				lineProd.lp_codLineProd as cod,
				subClasi.prod_subclasif_nombre as sub,
				cate.prod_cat_nombre as cat,
				mar.mm_nombre as mar,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.ubigeo_id as ubiId,
				(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
				prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax,
				lineProd.lp_stockActu as stockActu,
				(select count(*) from kd_numSeri where kd_estaStockId=1 and kd_prodId=id) as stockActu2,
				lineProd.lp_precioUnit as preciUnit,
				lineProd.lp_moneId as moneId,
				(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
				from 
				producto as prod
				inner join
				prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
				inner join
				prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
				inner join
				mm as mar on prod.marca_id=mar.mm_id
				inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				inner join
				np_detNot as detNot on detNot.np_lineId=lineProd.lp_idProd
				where
				prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
				detNot.np_notPedId=$notId;
			end; 
			

			# validar ingreso de detalle a movimiento [kd_ingMov_vali] new!->kd_

			# [FUNCTION]

			DELIMITER $$
			create function kd_ingMov_vali($kardxId int(11))
			RETURNS int(11)
			BEGIN
				#code
				declare $horas int(11);
				declare $flag int(1);

				set $horas=SELECT SEC_TO_TIME(TIMESTAMPDIFF(SECOND, kd_fechGen,Now())) as horas
				from kd_kardx where kd_kardxId=$kardxId;

				if  $horas>5 then
					set $flag=1;
				else
					set $flag=0;
				end if;

				return $flag; 
			end;

			# confirmar atencion de nota de pedido [kd_atenNot_confir] new!->np_

			# [FUNCTION]

			DELIMITER $$
			create function kd_atenNot_confir($idNot int(11))
			RETURNS int(11)
			COMMENT 'confirmar atencion de nota de pedido'
			BEGIN
				#code
				declare $rowAfect int(11);
				
				update np_notPed set np_estaNotId=2 where np_notPedId=$idNot;
				
				set $rowAfect=(select ROW_COUNT());

				return $rowAfect;
			end;




			----------------------------------------------------------------------------
			/********** 30/07/2014 *** [ UI - Numero de serie de entrada ] ************/
			----------------------------------------------------------------------------

			# Ingresar numero de serie [kd_numSeri_ingre] ######## OK #########

			DELIMITER $$
			create function kd_numSeri_ingre($detKardxId int(11),$desProd varchar(200),$numSeri char(50),$kd_almcId int(11))
			RETURNS int(11)
			COMMENT 'Ingresar numero de serie'
			BEGIN
			declare $rowAfect int(11);
			declare $idNumSeri int(11);
			declare $prodLineId int(11);
				# code
				set $prodLineId=(select kd_detKardxProd from kd_detKardx where kd_detKardxId=$detKardxId);

				insert into kd_numSeri(kd_prodId,kd_fechIngre,kd_desProd,kd_estaStockId,kd_numSeri,kd_almcId) values ($prodLineId,date_format(NOW(),'%Y-%m-%d'),$desProd,1,$numSeri,$kd_almcId);
				set $idNumSeri=(select LAST_INSERT_ID());

				insert into kd_movNumSeri(kd_detKardxId,kd_numSeriId) values ($detKardxId,$idNumSeri);
				
				set $rowAfect=(select ROW_COUNT());
				
				return $rowAfect;
			end;

			# Mostrar numero de serie de movimiento [kd_seriMov_mos] ######## OK #########

			DELIMITER $$
			create procedure kd_seriMov_mos($detKdxId int(11))
			COMMENT 'Mostrar numero de serie de movimiento'
			BEGIN
				# code
				select
				movSeri.kd_movNumSeriId as movSeriId,
				numSeri.kd_numSeri as numSeri,
				numSeri.kd_desProd as desSeri
				from
				kd_numSeri as numSeri
				inner join kd_movNumSeri as movSeri on numSeri.kd_numSeriId=movSeri.kd_numSeriId
				inner join kd_detKardx as detKardx on  movSeri.kd_detKardxId=detKardx.kd_detKardxId
				where detKardx.kd_detKardxId=$detKdxId;
			end;


			# Eliminar numero de serie [kd_seriMov_eli] ######## OK #############

			DELIMITER $$
			create function kd_seriMov_eli($detMovId int(11))
			RETURNS int(11)
			COMMENT 'Eliminar numero de serie'
			BEGIN
				# code
				declare $rowAfect int(11);
				declare $numSeriId int(11);

				set $numSeriId=(select `kd_numSeriId` from kd_movNumSeri where `kd_movNumSeriId`=$detMovId);

				delete from kd_movNumSeri where kd_movNumSeriId=$detMovId;

				delete from kd_numSeri where `kd_numSeriId`=$numSeriId;
				
				set $rowAfect=(select ROW_COUNT());
				
				return $rowAfect;
			end;

			# Obtener marca de categoria en linea [kd_marLine_obte] ######## OK ##############

			DELIMITER $$
			create procedure kd_marLine_obte($catId int(11))
			COMMENT 'Obtener marca de categoria en linea'
			BEGIN
				#code
				select distinct
				prod.marca_id as marId,
				(select mm_nombre from mm where mm_id=marId) as marDes
				from
				producto as prod inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				where 
				prod.flagLinea=1 and 
				lineProd.lp_estaEli=1 and
				prod.prod_categoria_id=$catId;
			end;

			# capturar numeros de serie por detMov [kd_serixDet_cap] ### OK

			DELIMITER $$
			create procedure kd_serixDet_cap($idDet int(11))
			COMMENT 'capturar numeros de serie por detMov'
			BEGIN
				#code
				select kd_numSeriId as seriId from kd_movNumSeri
				where kd_detKardxId=$idDet;
			end;

			# eliminar numero serie por idSeri [kd_serixId_eli] ### OK

			DELIMITER $$
			create function kd_serixId_eli($idSeri int(11))
			RETURNS int(11)
			COMMENT 'eliminar numero serie por idSeri'
			BEGIN
				#code
				declare $rowAfect int(11);
				delete from kd_numSeri where kd_numSeriId=$idSeri;
				set $rowAfect=(select ROW_COUNT());
				return $rowAfect;
			end;

			# capturar almacenes de empresa [kd_almEmp_cap] !New

			DELIMITER $$
			create procedure kd_almEmp_cap()
			COMMENT 'capturar almacenes de empresa'
			BEGIN
				SELECT kd_almcId as almId,kd_almcDes as almDes FROM `kd_almcEmp`;
			end;




			----------------------------------------------------------------------------
			/************ 31/07/2014 *** [ UI - Numero de serie de salida ] ************/
			----------------------------------------------------------------------------

			# Añadir movimiento de serie [kd_movSeri_aña] #### OK #####

			DELIMITER $$
			create function kd_movSeri_aña($detKardxId int(11),$idNumSeri int(11))
			RETURNS int(11)
			COMMENT 'Añadir movimiento de serie'
			BEGIN
				declare $rowAfect int(11);

				insert into kd_movNumSeri(kd_detKardxId,kd_numSeriId) values ($detKardxId,$idNumSeri);
				
				update kd_numSeri set kd_estaStockId=2 where kd_numSeriId=$idNumSeri;
				
				set $rowAfect=(select ROW_COUNT());
				
				return $rowAfect;
			end;

			# Regresar serie a stock [kd_seriStock_regre] #### OK ####

			DELIMITER $$
			create function kd_seriStock_regre($detMovId int(11))
			RETURNS int(11)
			COMMENT 'Regresar serie a stock'
			BEGIN
				declare $numSeriId int(11);
				declare $rowAfect int(11);

				set $numSeriId=(select `kd_numSeriId` from kd_movNumSeri where `kd_movNumSeriId`=$detMovId);

				# eliminar de movimiento
				delete from kd_movNumSeri where kd_movNumSeriId=$detMovId;
				
				# regresar estado a stock
				update kd_numSeri set `kd_estaStockId`=1 where kd_numSeriId=$numSeriId;

				set $rowAfect=(select ROW_COUNT());

				return $rowAfect;
			end;


			# Mostrar numero de serie de producto en stock [kd_numSeri_mos] #### OK #####

				DELIMITER $$
				create procedure kd_numSeri_mos($idDetMov int(11))
				COMMENT 'Mostrar numero de serie de producto en stock'
				BEGIN
					declare $prodId int(11);
					declare $rowAfect int(11);

					set $prodId=(select kd_detKardxProd from kd_detKardx where kd_detKardxId=$idDetMov);

					select `kd_numSeriId`,`kd_numSeri`,`kd_desProd`
					from kd_numSeri where `kd_prodId`=$prodId and `kd_estaStockId`=1;

				end;


			# Mostrar numero de serie de movimiento [] #### OK #####

				# EXISTE.....!

			# Capturar numeros de serie en stock por producto [kd_serixProd_cap] #### OK #####

			select kd_numSeriId,kd_numSeri,kd_estaStockId from kd_numSeri where kd_prodId='' and kd_estaStockId=1;

			DELIMITER $$
			create procedure kd_serixProd_cap($prodId int(11))
			COMMENT 'Capturar numeros de serie en stock por producto'
			BEGIN
				#code
				select kd_numSeriId,kd_numSeri,kd_estaStockId from kd_numSeri 
				where kd_prodId=$prodId and kd_estaStockId=1;
			end;

			# actualizar estado de numero serie a stock [kd_seriStock_actu]

			DELIMITER $$
			create function kd_seriStock_actu($idSeri int(11))
			RETURNS int(11)
			COMMENT 'actualizar estado de numero serie a stock'
			BEGIN
				#code
				declare $rowAfect int(11);
				update kd_numSeri set kd_estaStockId=2 where kd_numSeriId=$idSeri;
				set $rowAfect=(select ROW_COUNT());
				return $rowAfect;
			end;

			# capturar todos los numeros de serie por producto [kd_seriTot_cap]

			DELIMITER $$
			create procedure kd_seriTot_cap($prodId int(11))
			COMMENT 'capturar todos los numeros de serie por producto'
			BEGIN
				#code
				select kd_numSeriId,kd_numSeri,kd_estaStockId from kd_numSeri 
				where kd_prodId=$prodId and kd_estaStockId=1;
			end;

			---------------------------------------------------------------------------
			/*********** 04/08/2014 **** [ UI - Reporte de Inventario ] ***************/
			----------------------------------------------------------------------------


			# obtener linea de produtos por sub-clasificacion  [kd_lineProd_sub] ####### OK #####

				DELIMITER $$
				create procedure kd_lineProd_sub($subId int(11))
				COMMENT 'obtener linea de produtos por sub-clasificacion'
				BEGIN
					#code
					select
					lineProd.lp_lineProdId as id,
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					tip.prod_tipo_nombre as tip,
					mar.mm_nombre as mar,
					model.mm_nombre as model,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					mm as model on prod.modelo_id=model.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
					subClasi.prod_subclasif_id=$subId;
				end;

			# obtener linea de produtos por categoria  [kd_lineProd_cate] ######## OK ############

				DELIMITER $$
				create procedure kd_lineProd_cate($catId int(11))
				COMMENT 'obtener linea de produtos por categoria'
				BEGIN
					#code
					select
					lineProd.lp_lineProdId as id,
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					tip.prod_tipo_nombre as tip,
					mar.mm_nombre as mar,
					model.mm_nombre as model,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					mm as model on prod.modelo_id=model.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
					cate.prod_categoria_id=$catId;
				end;

			# obtener linea de produtos por tipo  [kd_lineProd_tip] ############ OK #################

				DELIMITER $$
				create procedure kd_lineProd_tip($tipId int(11))
				COMMENT 'obtener linea de produtos por tipo'
				BEGIN
					#code
					select
					lineProd.lp_lineProdId as id,
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					tip.prod_tipo_nombre as tip,
					mar.mm_nombre as mar,
					model.mm_nombre as model,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					mm as model on prod.modelo_id=model.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
					tip.prod_tipo_id=$tipId;
				end;

			# obtener linea de produtos por marMod  [kd_lineProd_marMod] ######## OK #############

				DELIMITER $$
				create procedure kd_lineProd_marMod($marId int(11),$modId int(11))
				COMMENT 'obtener linea de produtos por marMod'
				BEGIN
					#code
					select
					lineProd.lp_lineProdId as id,
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					tip.prod_tipo_nombre as tip,
					mar.mm_nombre as mar,
					model.mm_nombre as model,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					mm as model on prod.modelo_id=model.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
					mar.mm_id=$marId and model.mm_id=$modId;
				end;

			# obtener linea de productos orden por clasificacion [kd_lineProdOrd_obte] ####### OK ########

				DELIMITER $$
				create procedure kd_lineProdOrd_obte()
				COMMENT 'obtener linea de productos orden por clasificacion'
				BEGIN
					#code
					select
					lineProd.lp_lineProdId as id,
					lineProd.lp_codLineProd as cod,
					subClasi.prod_subclasif_nombre as sub,
					cate.prod_cat_nombre as cat,
					tip.prod_tipo_nombre as tip,
					mar.mm_nombre as mar,
					model.mm_nombre as model,
					prod.prod_nombre as nomEspa,
					prod.prod_alias as nomIngle,
					prod.ubigeo_id as ubiId,
					(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
					prod_descrip as des,
					lineProd.lp_stockMin as stockMin,
					lineProd.lp_stockMax as stockMax,
					lineProd.lp_stockActu as stockActu,
					lineProd.lp_precioUnit as preciUnit,
					lineProd.lp_moneId as moneId,
					(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
					from 
					producto as prod
					inner join
					prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
					inner join
					prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
					inner join
					prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
					inner join
					mm as mar on prod.marca_id=mar.mm_id
					inner join
					mm as model on prod.modelo_id=model.mm_id
					inner join
					lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
					where
					prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 order by sub;
				end;

			# Obtener marcas por tipo de producto [kd_marxTip_obte] ####### OK ##########

				select distinct
				m2.mm_id_padre,
				m1.mm_alias
				from mm as m1,mm as m2
				where m2.mm_id_padre!=0 and
				m2.mm_id_padre=m1.mm_id and
				m2.prod_tipo_id=9;

				DELIMITER $$
				create procedure kd_marxTip_obte($tipId int(11))
				COMMENT 'Obtener marcas por tipo de producto'
				BEGIN
					#code
					select distinct
					m2.mm_id_padre,
					m1.mm_alias,
					m1.mm_nombre
					from mm as m1,mm as m2,producto as prod,lp_lineProd as lineProd
					where m2.mm_id_padre!=0 and
					m2.mm_id_padre=m1.mm_id and
					m2.prod_tipo_id=$tipId and
					m2.prod_tipo_id=prod.prod_tipo_id and
					m2.mm_id_padre=prod.marca_id and
					prod.producto_id=lineProd.lp_idProd and
					lineProd.lp_estaEli=1;
				end;

			# Obtener modelo por tipo y marca de producto [kd_modxTipMar_obte] ######## OK  ##############

				select distinct
				m2.mm_id,
				m2.mm_alias
				from mm as m1,mm as m2
				where 
				m2.mm_id_padre!=0 and
				m2.mm_id_padre=608 and
				m2.mm_id_padre=m1.mm_id and
				m2.prod_tipo_id=9;

				DELIMITER $$
				create procedure kd_modxTipMar_obte($tipId int(11),$marId int(11))
				COMMENT 'Obtener modelo por tipo y marca de producto'
				BEGIN
					#code
					select distinct
					m2.mm_id,
					m2.mm_alias,
					m2.mm_nombre
					from mm as m1,mm as m2,producto as prod,lp_lineProd as lineProd
					where 
					m2.mm_id_padre!=0 and
					m2.mm_id_padre=$marId and
					m2.mm_id_padre=m1.mm_id and
					m2.prod_tipo_id=$tipId and
					m2.mm_id=prod.modelo_id and
					prod.producto_id=lineProd.lp_idProd and
					lineProd.lp_estaEli=1;
				end;

			# obtener linea de produtos por marca  [kd_lineProd_mar] ######## OK ############

			DELIMITER $$
			create procedure kd_lineProd_mar($marId int(11))
			COMMENT 'obtener linea de produtos por marca'
			BEGIN
				#code
				select
				lineProd.lp_lineProdId as id,
				lineProd.lp_codLineProd as cod,
				subClasi.prod_subclasif_nombre as sub,
				cate.prod_cat_nombre as cat,
				tip.prod_tipo_nombre as tip,
				mar.mm_nombre as mar,
				model.mm_nombre as model,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.ubigeo_id as ubiId,
				(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
				prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax,
				lineProd.lp_stockActu as stockActu,
				lineProd.lp_precioUnit as preciUnit,
				lineProd.lp_moneId as moneId,
				(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
				from 
				producto as prod
				inner join
				prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
				inner join
				prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
				inner join
				prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
				inner join
				mm as mar on prod.marca_id=mar.mm_id
				inner join
				mm as model on prod.modelo_id=model.mm_id
				inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				where
				prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
				mar.mm_id=$marId;
			end;

			# obtener linea de produtos por modelo  [kd_lineProd_mod] ### OK ###

			DELIMITER $$
			create procedure kd_lineProd_mod($modId int(11))
			COMMENT 'obtener linea de produtos por modelo'
			BEGIN
				#code
				select
				lineProd.lp_lineProdId as id,
				lineProd.lp_codLineProd as cod,
				subClasi.prod_subclasif_nombre as sub,
				cate.prod_cat_nombre as cat,
				tip.prod_tipo_nombre as tip,
				mar.mm_nombre as mar,
				model.mm_nombre as model,
				prod.prod_nombre as nomEspa,
				prod.prod_alias as nomIngle,
				prod.ubigeo_id as ubiId,
				(select ubigeo_nombre from ubigeo where ubigeo_id=ubiId ) as ori,
				prod_descrip as des,
				lineProd.lp_stockMin as stockMin,
				lineProd.lp_stockMax as stockMax,
				lineProd.lp_stockActu as stockActu,
				lineProd.lp_precioUnit as preciUnit,
				lineProd.lp_moneId as moneId,
				(select mon_sigla from moneda where moneda_id=moneId ) as mon_sigla
				from 
				producto as prod
				inner join
				prod_subclasif as subClasi on prod.prod_subclasif_id=subClasi.prod_subclasif_id
				inner join
				prod_categoria as cate on prod.prod_categoria_id=cate.prod_categoria_id
				inner join
				prod_tipo as tip on prod.prod_tipo_id=tip.prod_tipo_id
				inner join
				mm as mar on prod.marca_id=mar.mm_id
				inner join
				mm as model on prod.modelo_id=model.mm_id
				inner join
				lp_lineProd as lineProd on prod.producto_id=lineProd.lp_idProd
				where
				prod.bestado=1 and prod.flagLinea=1 and lineProd.lp_estaEli=1 and
				model.mm_id=$modId;
			end;

			---------------------------------------------------------------------------
			/*********** 04/08/2014 **** [ UI - Reporte de Movimiento ] ***************/
			----------------------------------------------------------------------------

			# Movimiento entradas	

				# obtener movimiento general de entradas de empresa [kd_genEnt_obte] ## OK ##

					DELIMITER $$
					create procedure kd_genEnt_obte($empId int(11),$fechIni date,$fechFin date,$tipMov int(11),$filMov varchar(15))
					COMMENT 'obtener movimiento general de entradas de empresa'
					BEGIN

						CASE ($filMov)

						WHEN 'fil' THEN
						
						#code
						select
						kd_kardxId as id,
						kd_kardxNro as cod,
						kd_kardxDoc as numDoc,
						kd_tipDoc as tipDocId,
						(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDocId) as tipDocDes,
						kd_kardxFech as fechMov,
						kd_tipMov as tipMovId,
						(select kd_tipMovDes from kd_tipMov where kd_tipMovId=tipMovId) as tipMovDes,
						kd_kardxDes as desMov,
						kd_kardxEmp as empId,
						(select emp_nombre from empresa where empresa_id=empId) as empDes,
						kd_kardxMone as moneId,
						(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
						(select sum(kd_detKardxPreUni*kd_detKardxCant) from kd_detKardx where kd_kardxId=id) as tot
						from kd_kardx 
						where kd_tipMov=$tipMov and kd_kardxEmp=$empId and (kd_kardxFech between $fechIni and $fechFin);

						WHEN 'tod' THEN

						#code
						select
						kd_kardxId as id,
						kd_kardxNro as cod,
						kd_kardxDoc as numDoc,
						kd_tipDoc as tipDocId,
						(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDocId) as tipDocDes,
						kd_kardxFech as fechMov,
						kd_tipMov as tipMovId,
						(select kd_tipMovDes from kd_tipMov where kd_tipMovId=tipMovId) as tipMovDes,
						kd_kardxDes as desMov,
						kd_kardxEmp as empId,
						(select emp_nombre from empresa where empresa_id=empId) as empDes,
						kd_kardxMone as moneId,
						(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
						(select sum(kd_detKardxPreUni*kd_detKardxCant) from kd_detKardx where kd_kardxId=id) as tot
						from kd_kardx 
						where kd_kardxEmp=$empId and (kd_kardxFech between $fechIni and $fechFin);

						END CASE; 

					end;

				# obtener movimiento general de todas las empresas [kd_todEnt_obte] ## OK ##

					DELIMITER $$
					create procedure kd_todEnt_obte($fechIni date,$fechFin date,$tipMov int(11),$filMov varchar(15))
					COMMENT 'obtener movimiento general de todas las empresas'
					BEGIN

						CASE ($filMov)

						WHEN 'fil' THEN

						#code
						select
						kd_kardxId as id,
						kd_kardxNro as cod,
						kd_kardxDoc as numDoc,
						kd_tipDoc as tipDocId,
						(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDocId) as tipDocDes,
						kd_kardxFech as fechMov,
						kd_tipMov as tipMovId,
						(select kd_tipMovDes from kd_tipMov where kd_tipMovId=tipMovId) as tipMovDes,
						kd_kardxDes as desMov,
						kd_kardxEmp as empId,
						(select emp_nombre from empresa where empresa_id=empId) as empDes,
						kd_kardxMone as moneId,
						(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
						(select sum(kd_detKardxPreUni*kd_detKardxCant) from kd_detKardx where kd_kardxId=id) as tot
						from kd_kardx 
						where kd_tipMov=$tipMov and (kd_kardxFech between $fechIni and $fechFin);

						WHEN 'tod' THEN

						#code
						select
						kd_kardxId as id,
						kd_kardxNro as cod,
						kd_kardxDoc as numDoc,
						kd_tipDoc as tipDocId,
						(select kd_tipDocAbrev from kd_tipDoc where kd_tipDocId=tipDocId) as tipDocDes,
						kd_kardxFech as fechMov,
						kd_tipMov as tipMovId,
						(select kd_tipMovDes from kd_tipMov where kd_tipMovId=tipMovId) as tipMovDes,
						kd_kardxDes as desMov,
						kd_kardxEmp as empId,
						(select emp_nombre from empresa where empresa_id=empId) as empDes,
						kd_kardxMone as moneId,
						(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
						(select sum(kd_detKardxPreUni*kd_detKardxCant) from kd_detKardx where kd_kardxId=id) as tot
						from kd_kardx 
						where kd_kardxFech between $fechIni and $fechFin;
					
					end;

				# obtener movimiento detalle de entradas ## OK ##

					#[EXISTE]

			# Movimiento salidas

				/*-----------------------------| MODULO ALMACEN (lp_) - 14/10/2014 |----------------------------------------*/

				# validar el ingreso de marcas [lp_ingreMar_vali]

				DELIMITER $$
				create function lp_ingreMar_vali($mar varchar(70))
				RETURNS int(11)
				COMMENT 'validar el ingreso de marcas'
				BEGIN
					#code
					declare $rowAfect int(11);
					set $rowAfect=(select count(*) from mm where mm_nombre=$mar and bestado=1);
					return $rowAfect;
				end;

				/*-----------------------------| MODULO ALMACEN (kd_) - 16/10/2014 |----------------------------------------*/

				# obtener linea de productos de detalle ew [lp_lineProdxEw_obte]

				# [PROCEDURE]

				DELIMITER $$
				create procedure lp_lineProdxEw_obte(ewId int(11))
				COMMENT 'obtener linea de productos de detalle ew'
				BEGIN
					#code
					select lp_lineProdId from compras_detalle where compras_id=ewId and bestado=1;
				end;

				# generar movimiento kardex [kd_geneMovKardx] 

				# [FUNCTION] 

				DELIMITER $$

				CREATE FUNCTION kd_geneMovKardx($tipMov int(11),$ewCompId int(11),$almcId int(11),
				$kardxEmp int(11),$transId int(11),$kardxFech date,$tipDoc int(11),$kardxDoc char(25),
				$kardxDes varchar(200),$desti text,$numFac char(15),$facEmis date)

				RETURNS int(11)
				COMMENT 'generar movimiento kardex'
				BEGIN

				declare $codKardx int(11);
				declare $tamCod int(11);
				declare $correKardx char(25);
				declare $rowAfect int(11);

				insert into kd_kardx(kd_kardxNro,kd_tipMov) values ('-',$tipMov) ;

				set $codKardx=(select LAST_INSERT_ID());
				set $rowAfect=(select ROW_COUNT());
				set $tamCod=(select length($codKardx));

				if($tamCod>5) then
				set $tamCod=$tamCod;
				else
				set $tamCod=5;
				end if;

				set $correKardx=(select concat('MOV-',LPAD($codKardx,$tamCod,'0')));

				update kd_kardx set 
				kd_kardxNro=$correKardx,
				kd_ewCompId=$ewCompId,
				kd_almcId=$almcId,
				kd_kardxEmp=$kardxEmp,
				kd_transId=$transId,
				kd_kardxFech=$kardxFech,
				kd_tipDoc=$tipDoc,
				kd_kardxDoc=$kardxDoc,
				kd_kardxDes=$kardxDes,
				kd_desti=$desti,
				kd_numFac=$numFac,
				kd_FacEmis=$facEmis
				where kd_kardxId=$codKardx;

				return $codKardx;

				end;

		#New update 29/12/2014

			/*PROCEDURE*/

				#C
				#R
					/*read producto por numero de serie [kd_prodxNum_read] */

						DELIMITER $$
						create procedure kd_prodxNum_read($numSeri char(50))
						COMMENT 'read producto por numero de serie'
						BEGIN

							/*vars*/

							/*read prod x num*/
							select
							line.lp_codLineProd as codigo,
							(select mm_nombre from mm as mar where mar.mm_id=prod.marca_id) as marca,
							prod.prod_nombre as nomEspa,
							prod.prod_descrip as descrip,
							seri.kd_numSeri as seri
							from kd_numSeri as seri 
							inner join lp_lineProd as line on seri.kd_prodId=line.lp_lineProdId
							inner join producto as prod on line.lp_idProd=prod.producto_id where
							seri.kd_numSeri=$numSeri;

						end;

					/*read ew,referencia y observacion de numero de serie [kd_histNum_read] */

						DELIMITER $$
						create procedure kd_histNum_read($numSeri char(50))
						COMMENT 'read ew,referencia y observacion de numero de serie'
						BEGIN

							/*vars*/

							/*read hist x num*/
							select
							kardx.kd_kardxId as kardxId,



							kardx.kd_kardxNro as cod,
							(select kd_tipMovDes from kd_tipMov as tip where tip.kd_tipMovId=kardx.kd_tipMov) as mov,
							kardx.kd_fechCrea as fechCre,
							(select emp_nombre from empresa as emp where emp.empresa_id=kardx.kd_kardxEmp) as emp,
							(select comp_nro from compras as comp where comp.compras_id=kardx.kd_ewCompId) as ew,
							kardx.kd_refEw as ref,
							kardx.kd_kardxDes as obs,
							seri.kd_numSeri as num
							from 
							kd_numSeri as seri, 
							kd_movNumSeri as mov, 
							kd_detKardx as det, 
							kd_kardx as kardx 
							where
						    seri.kd_numSeriId=mov.kd_numSeriId and
						    mov.kd_detKardxId=det.kd_detKardxId and
						    det.kd_kardxId=kardx.kd_kardxId and
						    seri.kd_numSeri=$numSeri
						    order by kardx.kd_kardxId;

						end;
				
					/*read numeros de series [kd_numSeri_read] */

						DELIMITER $$
						create procedure kd_numSeri_read()
						COMMENT 'read numeros de series'
						BEGIN

							/*vars*/

							/*read num seri*/
							select
							seri.kd_numSeriId as kd_numSeriId,
							seri.kd_numSeri as kd_numSeri
							from kd_numSeri as seri;

						end;

				#U
				#D

			/*FUNCTION*/

				#C
				#R
				#U
				#D

/*-----------------------------------[*]-----------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# MODULOS
/*-------------------------------------------------------------------------------------------------------*/

	/*

		NOTES:

		ESTRUCTURA:

			vista

			sub-vista

			js

			css

			ajax

			json

			negocio

			controller up

			controller down

			sql

		MODELO:

		RESTRICCIONES:

		PERSISTENCIA:

	*/

/*--------------------------------------------[*]--------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# PROYECTO
/*-------------------------------------------------------------------------------------------------------*/

	-------------------------------
	// PROYECTO
	-------------------------------

		--------------------ESTRUCTURA--------------------------
		--------------------------------------------------------

		--------------------CONSTANTES--------------------------
		--------------------------------------------------------

		------------------MODIFICACIONES------------------------
		alter table proyecto
		add proy_cliId int(11) after empresa_id,
		add proy_fechAdju date after proy_cliId;

		alter table proyecto
		add proy_estaCot int(11) after proy_fechAdju;

		alter table proyecto
		add proy_usuResp int(11) after proy_estaCot;
		--------------------------------------------------------

		-------------------RESTRICCIONES------------------------
		--------------------------------------------------------


	---------------------------------------------------------------------------------------------------*/

	/*--------------|PERSISTENCIA PROYECTO|--------------------------*/

	# crear nuevo proyecto de cotizaciones [cot_nuevProye_crear] -> [OK]

		# [FUNCTION]

		DELIMITER $$
		create function cot_nuevProye_crear($proyNom varchar(200),$empId int(11),$cliId int(11),$fechAdju date)
		RETURNS int(11)
		COMMENT 'crear nuevo proyecto de cotizaciones'
		BEGIN

			#vars
			declare $rowAfect int(11);
			#code
			insert into proyecto(proy_nombre,empresa_id,proy_cliId,proy_fechAdju,proy_estaCot) 
			values ($proyNom,$empId,$cliId,$fechAdju,1);

			set $rowAfect=(select ROW_COUNT());

			return $rowAfect;
		
		end;


	# listar proyectos  de cotizaciones [cot_proyCoti_list] -> [OK]

		# [PROCEDURE]

		DELIMITER $$
		create procedure cot_proyCoti_list($empId int(11))
		COMMENT 'listar proyectos  de cotizaciones'
		BEGIN
			#code
			select
			proyecto_id as proyeId,
			proy_nombre,
			proy_cliId,
			(select emp_nombre from empresa where empresa_id=proy_cliId) as proy_desCli,
			proy_fechAdju,
			proy_usuResp as usuResp,
			(select concat(LEFT(per.pers_nombres,1),'',LEFT(per.pers_apepat,1)) from trabajador as trab,persona as per where
			trab.trabajador_id=usuResp and trab.persona_id=per.persona_id) as iniUsu
			from
			proyecto
			where
			empresa_id=$empId and 
			bestado=1 and 
			proy_estaCot=1;
		end;

	# listar cotizaciones por proyectos [cot_cotixProye_listar] -> [OK]

		# [PROCEDURE]

		DELIMITER $$
		create procedure cot_cotixProye_listar($proyeId int(11))
		COMMENT 'listar cotizaciones por proyectos'
		BEGIN
			#code
			select
			cot_nro as fl,
			cliente_id,
			(select emp_nombre from empresa where empresa_id=cliente_id) as desCli,
			proyecto_id as proyeId,
			(select proy_nombre from proyecto where proyecto_id=proyeId) as desProye
			from 
			cotizacion where bestado=1 and cot_estado=4 and proyecto_id=$proyeId;
		end;


	# listar responsables del area comercial [cot_respComer_listar] -> [OK]

		# [PROCEDURE]

		DELIMITER $$
		create procedure cot_respComer_listar()
		COMMENT 'listar responsables del area comercial'
		BEGIN
			#code
			select 
			trab.trabajador_id as trabId,
			concat(per.pers_nombres,' ',per.pers_apepat) as desPer 
			from trabajador as trab,
			persona as per where trab.persona_id=per.persona_id and
			trab.bestado=1 and trab.trab_estado_id=1 and trab.perfil_id=6 and 
			(trab.trabajador_id!=51 and trab.trabajador_id!=48 and trab.trabajador_id!=42 and trab.trabajador_id!=36);
		end;

	# listar estados de cotizaciones [cot_estaCot_listar] -> [OK]

		# [PROCEDURE]

		DELIMITER $$
		create procedure cot_estaCot_listar()
		COMMENT 'listar estados de cotizaciones'
		BEGIN
			#code
			select 
			cot_estado_nombre as desEsta,
			cot_estado_id as idEsta
			from cot_estado
			where cot_estado_id in(4,2,1);
		end;

	# contar todas las cotizaciones del proyecto [cot_cotiProye_cont] -> [OK]

		# [FUNCTION]

		DELIMITER $$
		create function cot_cotiProye_cont($empId int(11),$proyeId int(11),$estaId int(11))
		RETURNS int(11)
		COMMENT 'contar todas las cotizaciones del proyecto' 
		BEGIN
			#code
			declare cantCoti int(11);

			set cantCoti=(select count(*) from cotizacion where 
						  empresa_id=$empId and proyecto_id=$proyeId 
						  and bestado=1 and cot_estado_id=$estaId);

			return cantCoti;

		end;

	# editar proyecto de cotizacion [cot_proye_edit] -> [OK]

		# [FUNCTION]

		DELIMITER $$
		create function cot_proye_edit($idProye int(11),$proyNom varchar(200),$cliId int(11),$fechAdju date)
		RETURNS int(11)
		COMMENT 'editar proyecto de cotizacion'
		BEGIN
			#code
			declare $rowAfect int(11);

			update proyecto set 
			proy_nombre=$proyNom,
			proy_cliId=$cliId,
			proy_fechAdju=$fechAdju
			where proyecto_id=$idProye;

			set $rowAfect=(select ROW_COUNT());

			return $rowAfect;
		end;

	# iniciar edicion de proyecto [cot_ediProy_ini] -> [OK]

		# [PROCEDURE]

		DELIMITER $$
		create procedure cot_ediProy_ini($proyeId int(11),$empId int(11))
		COMMENT 'iniciar edicion de proyecto'
		BEGIN
			#code
			select
			proyecto_id as proyeId,
			proy_nombre,
			proy_cliId,
			(select emp_nombre from empresa where empresa_id=proy_cliId) as proy_desCli,
			proy_fechAdju,
			proy_usuResp as usuResp,
			(select concat(LEFT(per.pers_nombres,1),'',LEFT(per.pers_apepat,1)) from trabajador as trab,persona as per where
			trab.trabajador_id=usuResp and trab.persona_id=per.persona_id) as iniUsu
			from
			proyecto
			where
			empresa_id=$empId and 
			bestado=1 and 
			proy_estaCot=1 and
			proyecto_id=$proyeId;
		end;

	# restringir edicion de proyecto a usuarios [cot_ediProye_restri] -> [OK]

		# [FUNCTION]

		DELIMITER $$
		create function cot_ediProye_restri($idProye int(11),$usuActi int(11))
		RETURNS int(11)
		COMMENT 'restringir edicion de proyecto a usuarios'
		BEGIN
			#code
			declare $idUsu int(11);
			declare $valRestri int(1);

			set $idUsu=(select proy_usuResp from proyecto where proyecto_id=$idProye);

			if $idUsu=$usuActi then
				set $valRestri=1;
			else
				set $valRestri=0;
			end if;

			return $valRestri; 
		end;

	# crear una nueva empresa usuario final [cot_nuevUsuFin_crear] -> [OK]

		DELIMITER $$
		create function cot_nuevUsuFin_crear($empNom varchar(70),$ruc char(11),$dire varchar(250),$tel char(25),$mail varchar(70))
		RETURNS int(11)
		COMMENT 'crear una nueva empresa usuario final'
		BEGIN
			#code
			declare $idEmp int(11);
			declare $idPerf int(11) default 4;
			declare $rowAfect int(11);

			insert into empresa(emp_nombre,emp_ruc,emp_direccion,emp_telef,emp_email,bestado) values ($empNom,$ruc,$dire,$tel,$mail,1);

			set $idEmp=(select LAST_INSERT_ID());

			insert into anfi_empresa(empresa_id_padre,empresa_id,emp_perfil_id,bestado) values(1,$idEmp,$idPerf,1);

			set $rowAfect=(select ROW_COUNT());

			return $rowAfect;
	    end;

/*----------------------------------[*]------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	#MODULO DE ORDEN DE COMPRA
/*-------------------------------------------------------------------------------------------------------*/

	/*

	------------------
	Notas del Modelo:
	------------------


	--------------
	Modelo
	--------------

		-------------------
		Compras
		-------------------

			------- Table -------------
			------- Restricciones -----
			------- Modificaciones ----
			------- Constantes --------

		-------------------
		Detalle Compras
		-------------------

			------- Table -------------
			------- Restricciones -----
			------- Modificaciones ----

			alter table compras_detalle
			add lp_lineProdId int(11);

			------- Constantes --------

	*/

	/*

	------------------
	Persistencia
	------------------

	# crear vista de linea de productos

		create view v_lp_lineProd as
		(
		    select
		    lineProd.lp_lineProdId as lineId,
		    prod.producto_id as prodId,
		    prod.prod_nombre as prodNom,
		    prod.prod_descrip as prodDes,
		    (select prod.marca_id from producto where producto_id=prodId) as prodMarId,
		    (select mm_nombre from mm where mm_id=prodMarId) as prodMarDes,
		    (select concat(prodMarDes,' ',prodNom,' ',prodDes)) as lineDes,
		    (select 1) as bestado
		    from 
		    lp_lineProd as lineProd,
		    producto as prod
		    where lineProd.lp_estaEli=1 and
		    lineProd.lp_idProd=prod.producto_id
		    
		);

	*/

/*---------------------------------[*]-------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# MODULO DE FINANZAS
/*-------------------------------------------------------------------------------------------------------*/


	/* MODELO DE DATOS */

		# table temporal bancaria [finan_opeBanca_tmp] -> [OK]

			create table finan_opeBanca_tmp
			(
				finan_opeBancaId int(11) auto_increment not null primary key, #PK
				finan_docId int(11), #FK 
				finan_tipDoc int(11), #FK
				finan_correOpe char(25),
				finan_versiReno int(11),
				cc_centCostId int(11), #FK--
				finan_fechIni date,
				finan_fechVenCli date,
				finan_fechVenDoc date,
				finan_mone int(11),
				finan_monto decimal(10,2),
				finan_comisInte decimal(10,2),
				finan_tasaComis decimal(10,2),
				finan_estaVenci int(1),
				finan_estaEntre int(1)
			);

			# Modificacion

				alter table finan_opeBanca_tmp
				add finan_tasaComis decimal(10,2) after finan_comisInte;

				alter table finan_opeBanca_tmp
				add finan_correOpe char(25) after finan_tipDoc;

				alter table finan_opeBanca_tmp
				add finan_versiReno int(11) after finan_correOpe;

				alter table finan_opeBanca_tmp
				add finan_estaVenci int(1) after finan_tasaComis,
				add finan_estaEntre int(1) after finan_estaVenci;

		# table temporal centro de costo [finan_centCost_tmp] -> [OK]

			create table finan_centCost_tmp
			(
				finan_centCostId int(11) auto_increment not null primary key, #PK
				finan_centCostDes varchar(50)
			);

			# Modificaciones
				alter table finan_centCost_tmp
				add finan_centCostDes varchar(50) after finan_centCostId; 

		# table operacion bancaria [finan_opeBanca] -> [OK]

			create table finan_opeBanca
			(
				finan_opeBancaId int(11) auto_increment not null primary key, #PK
				finan_docId int(11), #FK 
				finan_tipDoc int(11), #FK
				finan_correOpe char(25),
				finan_versiReno int(11),
				cc_centCostId int(11), #FK--
				finan_fechIni date,
				finan_fechVenCli date,
				finan_fechVenDoc date,
				finan_mone int(11),
				finan_monto decimal(10,2),
				finan_comisInte decimal(10,2),
				finan_tasaComis decimal(10,2),
				finan_estaVenci int(1),
				finan_estaEntre int(1)
			);

			# Restricciones

				alter table finan_opeBanca
				add constraint finan_docId_fk2 foreign key (finan_docId) references finan_doc(finan_docId),
				add constraint finan_tipDoc_fk foreign key (finan_tipDoc) references finan_tipDoc(finan_tipDoc);

			# Modificacion

				alter table finan_opeBanca
				add finan_tasaComis decimal(10,2) after finan_comisInte;

				alter table finan_opeBanca
				add finan_correOpe char(25) after finan_tipDoc;

				alter table finan_opeBanca
				add finan_versiReno int(11) after finan_correOpe;

				alter table finan_opeBanca
				add finan_estaVenci int(1) after finan_tasaComis,
				add finan_estaEntre int(1) after finan_estaVenci;

		# table documento [finan_doc] -> [OK]

			create table finan_doc
			(
				finan_docId int(11) auto_increment not null primary key, #PK
				finan_docDes varchar(200),
				finan_docAlias char(25)
			);

			# Restricciones

		# table tipo de documento [finan_tipDoc] -> [OK]

			create table finan_tipDoc
			(
				finan_tipDoc int(11) auto_increment not null primary key, #PK
				finan_docId int(11), #FK
				finan_tipDocDes varchar(200),
				finan_tipDocAlias char(25)
			);

			# Restricciones

			alter table finan_tipDoc
			add constraint finan_docId_fk foreign key (finan_docId) references finan_doc(finan_docId);

		# table operacion bancaria proyecto -> [finan_opeProye] [...OK]

			create table finan_opeProye
			(
				finan_opeProyeId int(11) primary key auto_increment,
				finan_opeProyeCorre char(25),
				cc_centCostId int(11)
			);

		# table adjuntos de operaciones -> [finan_adjuOpe] [...]

			create table finan_adjuOpe
			(
				finan_adjuOpeId int(11) primary key auto_increment not null,
				finan_opeProyeId int(11),
				finan_numDocAdju char(25),
				finan_adjuDes varchar(200),
				finan_adjuDoc varchar(1200)
			);

	/* PERSISTENCIAS */

		#[PROCEDURE]

			# listar documentos financieros [finan_docFinan_list] -> [OK]

				DELIMITER $$
				create procedure finan_docFinan_list()
				COMMENT 'listar documentos financieros'
				BEGIN
					#code
					select
					finan_docId as docId,
				    finan_docAlias as docAlias,
				    finan_docDes as docDes
				    from finan_doc;
				end;

			# listar tipo de documentos financieros [finan_tipDoc_list] -> [OK]

				DELIMITER $$
				create procedure finan_tipDoc_list($docId int(11))
				COMMENT 'listar tipo de documentos financieros'
				BEGIN
					#code
					select 
					finan_tipDoc as tipDoc,
					finan_tipDocAlias as tipDocAlias
					from finan_tipDoc
					where finan_docId=$docId;
				end;

			# obtener operacion bancaria temporal [finan_opeBanTem_obte] -> [OK]

				DELIMITER $$
				create procedure finan_opeBanTem_obte($centTemp int(11),$tipCent int(11))
				COMMENT 'obtener operacion bancaria temporal'
				BEGIN
					#code
					if $tipCent=1 then

						select
						finan_opeBancaId as opeBancaId,
						finan_docId as docId,
						(select finan_docDes from finan_doc where finan_docId=docId) as docDes,
						finan_tipDoc as tipDoc,
						(select finan_tipDocAlias from finan_tipDoc where finan_tipDoc=tipDoc) as tipDocDes,
						finan_mone as mone,
						finan_monto as monto,
						finan_fechVenCli as fechVenCli,
						finan_fechVenDoc as fechVenDoc,
						finan_comisInte as comisInte,
						finan_correOpe as correOpe
						from
						finan_opeBanca_tmp
						where cc_centCostId=$centTemp order by finan_correOpe;

					else if $tipCent=2 then

						select
						finan_opeBancaId as opeBancaId,
						finan_docId as docId,
						(select finan_docDes from finan_doc where finan_docId=docId) as docDes,
						finan_tipDoc as tipDoc,
						(select finan_tipDocAlias from finan_tipDoc where finan_tipDoc=tipDoc) as tipDocDes,
						finan_mone as mone,
						finan_monto as monto,
						finan_fechVenCli as fechVenCli,
						finan_fechVenDoc as fechVenDoc,
						finan_comisInte as comisInte
						from
						finan_opeBanca
						where cc_centCostId=$centTemp order by finan_correOpe;

					end if;
				end;

			# obtener monedas para operaciones bancarias [finan_moneOpe_obte] -> [OK]

				DELIMITER $$
				create procedure finan_moneOpe_obte()
				COMMENT 'obtener monedas para operaciones bancarias'
				BEGIN
					#code
					select 
					moneda_id as moneId,
					mon_sigla as monSigla
					from
					moneda;
				end;

			# obtener centro de costos [finan_obteCentCost] -> [... - OK]

				DELIMITER $$
				create procedure finan_obteCentCost()
				COMMENT 'obtener centro de costos'
				BEGIN
					select nc_centCost_obte();
				end;

			# obtener datos centro por id [finan_datCentxId] -> [... - OK]

				DELIMITER $$
				create procedure finan_datCentxId($centId int(11))
				COMMENT 'obtener datos centro por id'
				BEGIN

					select
					(select distinct proy_nombre from proyecto where proyecto_id=cent.cc_idProye ) as nc_proye,
					(select group_concat(proveedor_id separator ',') from compras where pc_id=cent.cc_centCostId group by pc_Id ) as nc_proveId,
					(select group_concat(emp_nombre) from empresa where empresa_id in (nc_proveId) ) as nc_proveDes,
					(select distinct emp_nombre from empresa where empresa_id=cent.cc_idCliEmp) as nc_cli,
					(select distinct cot.operador_id from cotizacion as cot where cotizacion_id=cent.cc_cotiFlId ) as ingRespId,
					(select concat('Ing. ',pers_completo) from v_trabajador where trabajador_id=ingRespId) as ingRespDes,
					(select count(*) from compras where pc_id=cent.cc_centCostId) as cantProv,
					(select mon_sigla from moneda where moneda_id=cent.cc_moneId) as moneDes,
					cent.cc_montCoti as montCoti,
					cent.cc_ocFechCli as fechCli
					from cc_centcost as cent where cent.cc_centCostId=$centId;

				end;

			# obtener operacion de proyecto por id [finan_opeProyexId_obte] -> [... - OK]

				DELIMITER $$
				create procedure finan_opeProyexId_obte($opeId int(11))
				COMMENT 'obtener operacion de proyecto'
				BEGIN

					/* vars */

					/* opeProye por id */
					select 
					*,
					(select cc_idProye from cc_centcost where cc_centCostId=opeProye.cc_centCostId ) as proyId,
					(select proy_nombre from proyecto where proyecto_id=proyId ) as proyDes,
					(select cc_correCenCost from cc_centcost where cc_centCostId=opeProye.cc_centCostId) as cc_des,
					(select concat(cc_des,' - ',proyDes)) as centDes 
					 from finan_opeProye as opeProye where finan_opeProyeId=$opeId;

				end;

			# obtener operaciones de proyecto [finan_opeProye_obte] -> [... - Ok]

				DELIMITER $$
				create procedure finan_opeProye_obte()
				COMMENT 'obtener operaciones de proyecto'
				BEGIN

					/*operaciones bancarias*/
					SELECT *,
					(select cc_correCenCost from cc_centcost where cc_centCostId=opeProye.cc_centCostId) as cc_des,
					(select cc_idProye from cc_centcost where cc_centCostId=opeProye.cc_centCostId) as cc_idProye,
					(select proy_nombre from proyecto where proyecto_id=cc_idProye) as proye_nom,
					(select cc_idCliEmp from cc_centcost where cc_centCostId=opeProye.cc_centCostId) as cc_cliId,
					(select emp_nombre from empresa where empresa_id=cc_cliId) as cli_des,
					(select count(*) from finan_opeBanca where cc_centCostId=opeProye.cc_centCostId) as cant_ope
					FROM `finan_opeProye` as opeProye;

				end;

		# [FUNCTION]

			# crear centro de costo temporal [finan_cenCost_cre] -> [OK]

				DELIMITER $$
				create function finan_cenCost_cre()
				RETURNS int(11)
				COMMENT 'crear centro de costo temporal'
				BEGIN
					#code
					declare $id int(11);
					insert into finan_centCost_tmp(finan_centCostDes) values('temp');
					set $id=(select LAST_INSERT_ID());
					return $id;
				end;

			# crear operacion bancaria temporal [finan_openBanTem_cre] -> [OK]

				DELIMITER $$
				create function finan_openBanTem_cre($tipDocId int(11),$centTemp int(11))
				RETURNS int(11)
				COMMENT 'crear operacion bancaria temporal'
				BEGIN
					#code
					declare $rowAfect int(11);
					declare $docId int(11);
					
					set $docId=(select finan_docId from finan_tipDoc where finan_tipDoc=$tipDocId);
					
					insert into finan_opeBanca_tmp(finan_docId,finan_tipDoc,finan_fechIni,cc_centCostId) 
					values($docId,$tipDocId,Now(),$centTemp);

					set $rowAfect=(select ROW_COUNT());

					return $rowAfect;
				end;

			# eliminar operacion bancaria temporal [finan_opeBanTem_eli] -> [OK]

				DELIMITER $$
				create function finan_opeBanTem_eli($opeBancaId int(11))
				RETURNS int(11)
				COMMENT 'eliminar operacion bancaria temporal'
				BEGIN
					#code
					declare $rowAfect int(11);
					delete from finan_opeBanca_tmp where finan_opeBancaId=$opeBancaId;
					set $rowAfect=(select ROW_COUNT());

					return $rowAfect;
				end;

			# actualizar operacion bancaria temporal [finan_opeBanTem_actu] -> [OK]

				DELIMITER $$
				create function finan_opeBanTem_actu($moneId int(11),$monto decimal(10,2),$fechCli date,$fechDoc date,$opeIdBan int(11),$fechIni date,
													$tasAnu decimal(10,2),$comisInte decimal(10,2),$estaVenci int(1),$estaEntre int(1))
				RETURNS int(11)
				COMMENT 'actualizar operacion bancaria temporal'
				BEGIN
					#code
					declare $rowAfect int(11);

					update finan_opeBanca_tmp
					set
					finan_mone=$moneId,
					finan_monto=$monto,
					finan_fechVenCli=$fechCli,
					finan_fechVenDoc=$fechDoc,
					finan_fechIni=$fechIni,
					finan_tasaComis=$tasAnu,
					finan_comisInte=$comisInte,
					finan_estaVenci=$estaVenci,
					finan_estaEntre=$estaEntre
					where
					finan_opeBancaId=$opeIdBan;

					set $rowAfect=(select ROW_COUNT());

					return $rowAfect;
				end;

			# grabar operacion temporal a operacion real [finan_opeTemReal_grab] -> [OK]

				DELIMITER $$
				create function finan_opeTemReal_grab($cenTemp int(11),$cenReal int(11))
				RETURNS int(11)
				COMMENT 'grabar operacion temporal a operacion real'
				BEGIN
					#code
					declare $rowAfect int(11);

					insert into finan_opeBanca(finan_opeBancaId,
											   finan_docId,
											   finan_tipDoc,
											   cc_centCostId,
											   finan_fechIni,
											   finan_fechVenCli,
											   finan_fechVenDoc,
											   finan_mone,
											   finan_monto,
											   finan_comisInte)
					select finan_opeBancaId,
						   finan_docId,
						   finan_tipDoc,
						   $cenReal,
						   finan_fechIni,
						   finan_fechVenCli,
						   finan_fechVenDoc,
						   finan_mone,
						   finan_monto,
						   finan_comisInte from finan_opeBanca_tmp
						   where cc_centCostId=$cenTemp;

					set $rowAfect=(select ROW_COUNT());

					return $rowAfect;
				end;

			# calcular comision de interes [finan_comisInte_calcu] -> [OK]

				DELIMITER $$
				create function finan_comisInte_calcu($opeBancaId int(11),$tipCent int(11))
				RETURNS int(11)
				COMMENT 'calcular comision de interes'
				BEGIN
					#code
					declare $tasAnu decimal(10,2);
					declare $fechVenci date;
					declare $fechEmis date;
					declare $imporFian decimal(10,2);
					declare $comisInte decimal(10,2);
					declare $rowAfect int(11);

					if $tipCent=1 then

						set $tasAnu=(select finan_tasaComis from finan_opeBanca_tmp where finan_opeBancaId=$opeBancaId);
						set $fechVenci=(select finan_fechVenDoc from finan_opeBanca_tmp where finan_opeBancaId=$opeBancaId);
						set $fechEmis=(select finan_fechIni from finan_opeBanca_tmp where finan_opeBancaId=$opeBancaId);
						set $imporFian=(select finan_monto from finan_opeBanca_tmp where finan_opeBancaId=$opeBancaId);

						set $comisInte=(($tasAnu/100)/360)*(DATEDIFF($fechVenci,$fechEmis))*$imporFian;

						update finan_opeBanca_tmp
						set finan_comisInte=$comisInte where finan_opeBancaId=$opeBancaId;

					elseif $tipCent=2 then

						set $tasAnu=(select finan_tasaComis from finan_opeBanca where finan_opeBancaId=$opeBancaId);
						set $fechVenci=(select finan_fechVenDoc from finan_opeBanca where finan_opeBancaId=$opeBancaId);
						set $fechEmis=(select finan_fechIni from finan_opeBanca where finan_opeBancaId=$opeBancaId);
						set $imporFian=(select finan_monto from finan_opeBanca where finan_opeBancaId=$opeBancaId);

						set $comisInte=(($tasAnu/100)/360)*(DATEDIFF($fechVenci,$fechEmis))*$imporFian;

						update finan_opeBanca
						set finan_comisInte=$comisInte where finan_opeBancaId=$opeBancaId;

					end if;

					set $rowAfect=(select ROW_COUNT());
						
					return $rowAfect;								
				end;

			# calcular totales de comision de interes [finan_totComi_calcu] -> [OK]

				DELIMITER $$
				create procedure finan_totComi_calcu($idCent int(11),$tipCent int(11))
				COMMENT 'calcular totales de comision de interes'
				BEGIN
					#code

					if $tipCent=1 then

					select
					(select round(sum(finan_comisInte),2) from finan_opeBanca_tmp where finan_mone=1 and cc_centCostId=$idCent ) as totSoles,
					(select round(sum(finan_comisInte),2) from finan_opeBanca_tmp where finan_mone=2 and cc_centCostId=$idCent ) as totDolares,
					(select round(sum(finan_comisInte),2) from finan_opeBanca_tmp where finan_mone=3 and cc_centCostId=$idCent ) as totHebros;

					elseif $tipCent=2 then

					select
					(select round(sum(finan_comisInte),2) from finan_opeBanca where finan_mone=1 and cc_centCostId=$idCent ) as totSoles,
					(select round(sum(finan_comisInte),2) from finan_opeBanca where finan_mone=2 and cc_centCostId=$idCent ) as totDolares,
					(select round(sum(finan_comisInte),2) from finan_opeBanca where finan_mone=3 and cc_centCostId=$idCent ) as totHebros;

					end if;

				end;

			# renovar operacion bancaria [finan_opeBan_reno] -> [OK]

				DELIMITER $$
				create function finan_opeBan_reno($idOpeBan int(11),$tipCent int(11))
				RETURNS int(11)
				COMMENT 'renovar operacion bancaria'
				BEGIN
					#code
					declare $versiReno int(11);
					declare $correOpe char(25);
					declare $rowAfect int(11);

					if $tipCent=1 then

						set $correOpe=(select finan_correOpe from finan_opeBanca_tmp where finan_opeBancaId=$idOpeBan);

						set $versiReno=(SELECT if(isnull(max(finan_versiReno)),1,max(finan_versiReno)+1) FROM 
						finan_opeBanca_tmp WHERE finan_correOpe=$correOpe);

						insert into finan_opeBanca_tmp(finan_docId,finan_tipDoc,finan_correOpe,finan_versiReno,cc_centCostId,
						finan_fechIni,finan_fechVenCli,finan_fechVenDoc,finan_mone,finan_monto,finan_comisInte,finan_tasaComis)
						select
						finan_docId,
						finan_tipDoc,
						finan_correOpe,
						$versiReno,
						cc_centCostId,
						finan_fechIni,
						finan_fechVenCli,
						finan_fechVenDoc,
						finan_mone,
						finan_monto,
						finan_comisInte,
						finan_tasaComis
						from
						finan_opeBanca_tmp
						where finan_opeBancaId=$idOpeBan;


					elseif $tipCent=2 then

						set $correOpe=(select finan_correOpe from finan_opeBanca where finan_opeBancaId=$idOpeBan);

						set $versiReno=(SELECT if(isnull(max(finan_versiReno)),2,max(finan_versiReno)+1) FROM 
						finan_opeBanca WHERE finan_correOpe=$correOpe);

						insert into finan_opeBanca(finan_docId,finan_tipDoc,finan_correOpe,finan_versiReno,cc_centCostId,
						finan_fechIni,finan_fechVenCli,finan_fechVenDoc,finan_mone,finan_monto,finan_comisInte,finan_tasaComis)
						select
						finan_docId,
						finan_tipDoc,
						finan_correOpe,
						$versiReno,
						cc_centCostId,
						finan_fechIni,
						finan_fechVenCli,
						finan_fechVenDoc,
						finan_mone,
						finan_monto,
						finan_comisInte,
						finan_tasaComis
						from
						finan_opeBanca
						where finan_opeBancaId=$idOpeBan;

					end if;

					set $rowAfect=(select ROW_COUNT());

					return $rowAfect;

				end;

			# capturar valor renovacion maxima de operacion [finan_renoMax_cap] -> [OK]

				DELIMITER $$
				create function finan_renoMax_cap($idOpeBan int(11),$tipCent int(11))
				RETURNS int(11)
				COMMENT 'capturar valor renovacion maxima de operacion'
				BEGIN
					#code
					declare $correOpe char(25);
					declare $versiReno int(11);

					if $tipCent=1 then

						set $correOpe=(select finan_correOpe from finan_opeBanca_tmp where finan_opeBancaId=$idOpeBan);

						set $versiReno=(SELECT if(isnull(max(finan_versiReno)),0,max(finan_versiReno)) FROM 
						finan_opeBanca_tmp WHERE finan_correOpe=$correOpe);

					elseif $tipCent=2 then

						set $correOpe=(select finan_correOpe from finan_opeBanca where finan_opeBancaId=$idOpeBan);

						set $versiReno=(SELECT if(isnull(max(finan_versiReno)),0,max(finan_versiReno)) FROM 
						finan_opeBanca WHERE finan_correOpe=$correOpe);

					end if;

					return $versiReno;
				end;

			# obtener centro de costos con cartas de fianza pendientes [finan_centCart_obte] [OK]

				DELIMITER $$
				create procedure finan_centCart_obte()
				COMMENT 'obtener centro de costos con cartas de fianza pendientes'
				BEGIN
					#code
					select distinct cc_centCostId 
					from finan_opeBanca 
					where 
					(isnull(finan_estaVenci) or finan_estaVenci=0) or 
					(isnull(finan_estaEntre) or finan_estaEntre=0);
				end; 

			# capturar carta de fianzas pendientes de centro de costo [finan_carFianCent_captu] [OK]

				DELIMITER $$
				create procedure finan_carFianCent_captu()
				COMMENT 'capturar carta de fianzas pendientes de centro de costo'
				BEGIN
					#code
				end;

			# alertar las cartas fianzas que vencen en 7 dias [finan_cartVenc_alert] -> [OK]

				DELIMITER $$
				create procedure finan_cartVenc_alert()
				COMMENT 'alertar las cartas fianzas que vencen en 7 dias'
				BEGIN
					#code
					select
					cc_centCostId as centCost,
					(select cc_correCenCost from cc_centcost where cc_centCostId=centCost) as correCent,
					finan_correOpe,
					finan_versiReno,
					(select finan_docDes from finan_doc where finan_docId=opeBanca.finan_docId) as docDes,
					(select finan_tipDocAlias from finan_tipDoc where finan_tipDoc=opeBanca.finan_tipDoc) as tipDocDes,
					date_format(Now(),'%Y-%m-%d') as fechActu,
					finan_fechVenDoc as fechDoc,
					finan_fechVenCli as fechEntre,
					(select DATEDIFF(fechDoc,fechActu)) as difDoc,
					(select DATEDIFF(fechEntre,fechActu)) as difEntre,
					finan_estaVenci as estaVenci,
					finan_estaEntre as estaEntre,
					(select if(estaVenci=1,'finalizado',concat('vecimiento doc. pendiente con plazo actual de ',difDoc,' dias'))) as alertDoc,
					(select if(estaEntre=1,'finalizado',concat('vencimiento entrega pendiente con plazo actual de ',difEntre,' dias'))) as alertEntre
					from finan_opeBanca as opeBanca
					where
					((isnull(finan_estaVenci) or finan_estaVenci=0) or 
					(isnull(finan_estaEntre) or finan_estaEntre=0))
					and
					if(isnull(finan_versiReno),0,finan_versiReno)=(select if(isnull(max(finan_versiReno)),0,max(finan_versiReno)) 
					from finan_opeBanca 
					where finan_correOpe=opeBanca.finan_correOpe)
					and
					(DATEDIFF(finan_fechVenDoc,now())<=7 
					or 
					DATEDIFF(finan_fechVenCli,now())<=7)
					and
					finan_correOpe is not null;
				end;

			# crear operacion de proyecto [finan_opeProye_crear] -> [... - OK]

				DELIMITER $$
				create function finan_opeProye_crear($centId int(11))
				RETURNS int(11)
				COMMENT 'crear operacion de proyecto'
				BEGIN

					/*vars*/
					declare $idAfect int(11);
					declare $rowAfect int(11);
					declare $correOpe char(25);

					/*nueva operacion*/
					insert into finan_opeProye(cc_centCostId) values($centId);

					/*id afect*/
					set $idAfect=(select LAST_INSERT_ID());

					/*nuevo correlativo*/
					set $correOpe=nc_correNoConfor_cre($idAfect,'OPE');  

					/*update operacion*/
					update finan_opeProye set finan_opeProyeCorre=$correOpe where finan_opeProyeId=$idAfect;

					/*row afect*/
					set $rowAfect=(select ROW_COUNT());

					/* evalua row afect */
					if $rowAfect>0 then

						set $rowAfect=$idAfect;

					end if;

					/*return*/
					return $rowAfect;

				end;

			# actualizar operacion de proyecto [finan_opeProye_actu] -> [...]

				DELIMITER $$
				create function finan_opeProye_actu($idOpeProye int(11),$centId int(11))
				RETURNS int(11)
				COMMENT 'actualizar operacion de proyecto'
				BEGIN

					/* vars */
					declare $rowAfect int(11);

					/* actu ope proye */
					update finan_opeProye set cc_centCostId=$centId 
					where finan_opeProyeId=$idOpeProye;

					/* rowfect */
					set $rowAfect=(select ROW_COUNT());

					/* return */
					return $rowAfect;

				end;

			# adjuntar documento de operacion [finan_docOpe_adju] -> [...]

				DELIMITER $$
				create function finan_docOpe_adju($opeProyeId int(11),numDocAdju char(25),
				$adjuDes varchar(200),
				$adjuDoc varchar(1200))
				RETURNS int(11)
				COMMENT 'adjuntar documento de operacion'
				BEGIN

					/* vars */
					declare rowAfect int(11);

					/* adjuntar doc */ 
					insert into finan_adjuOpe 
					(finan_opeProyeId,
					finan_numDocAdju,
					finan_adjuDes,
					finan_adjuDoc) 
					values
					($opeProyeId,
					numDocAdju,
					$adjuDes,
					$adjuDoc);

				end;

/*----------------------------------[*]------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# MODULO GESTION DE DOCUMENTOS
/*-------------------------------------------------------------------------------------------------------*/

	/* MODELO DE DATOS */

		# table gestion documentaria [gd_gestDoc] -> OK

			create table gd_gestDoc
			(
				gd_gestDocId int(11) primary key not null auto_increment, #PK
				gd_doc varchar(50), # documentos
				gd_gest text, # gestion
				gd_fech date, # fecha
				gd_hora time, # hora
				gd_lugar varchar(200), # lugar
				gd_usuId int(11), #usuario FK_
				gd_estaGest int(11), #estado FK
				gd_latitud decimal(20,15), #latitud
				gd_longitud decimal(20,15) #longitud
			);

			# Restricciones
			alter table gd_gestDoc
			add constraint gd_estaGest_fk foreign key (gd_estaGest) references gd_estaGest(gd_estaGest);

		# table estado gestion [gd_gestDoc] -> OK

			create table gd_estaGest
			(
				gd_estaGest int(11) primary key not null auto_increment, #PK
				gd_desEsta varchar(50)
			)

			 /* constantes
					- pendientes
					- finalizados
			 */

		# table rutas [gd_ruta] -> OK

			create table gd_ruta
			(
				gd_rutaId int(11) primary key not null auto_increment, #PK
				gd_respId int(11), #responsable FK_
				gd_admId int(11), #administrador FK_
				gd_correRut char(25), #correlativo
				gd_estaRutId int(11), #estado FK
				gd_fechRut date,
				gd_hourRut time
			);

			#Modificacion
			alter table gd_ruta
			add gd_fechRut date after gd_estaRutId;

			alter table gd_ruta
			add gd_hourRut time after gd_fechRut;

			#Restricciones
			alter table gd_ruta
			add constraint gd_estaRutId_fk foreign key (gd_estaRutId) references gd_estaRut(gd_estaRutId);

		# table detalle de ruta [gd_detRuta] -> OK

			create table gd_detRuta
			(
				gd_detRutaId int(11) primary key not null auto_increment, #PK
				gd_rutaId int(11), #FK
				gd_gestDocId int(11) #FK
			);

			#Restriccion
			alter table gd_detRuta
			add constraint gd_gestDocId_fk foreign key (gd_gestDocId) references gd_gestDoc(gd_gestDocId),
			add constraint gd_rutaId_fk foreign key (gd_rutaId) references gd_ruta(gd_rutaId);

		# table estado rutas [gd_estaRut] -> OK

			create table gd_estaRut
			(
				gd_estaRutId int(11) primary key not null auto_increment, #PK
				gd_desEsta varchar(50)
			);

			/*
				constantes
					-asignadas
					-concretadas
			*/

	/* PERSISTENCIA */

		# [PROCEDURE]

			# admin

				#gestiones

					# capturar gestion documentaria por id [gd_gestDocxId_cap] -> OK

						DELIMITER $$
						create procedure gd_gestDocxId_cap($gestId int(11))
						COMMENT 'capturar gestion documentaria por id'
						BEGIN
							/*#vars*/

							/*#get gest doc*/
							select *,
									(select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes 
							from gd_gestDoc as gestDoc where gd_gestDocId=$gestId;
						end;

					# capturar gestion documentaria por limit [gd_gestDocxLim] -> OK

						DELIMITER $$
						create procedure gd_gestDocxLim($limIni int(11),$limFin int(11),$estaId int(11),$fechGest date)
						COMMENT 'capturar gestion documentaria por limit'
						BEGIN

							/*#vars*/

							/*#gest doc por limit*/

							/*
							select *,
								   (select gd_desEsta from gd_estaGest where gd_estaGest=gestDoc.gd_estaGest) as desEsta,
								   (select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes
							from gd_gestDoc as gestDoc limit $limIni,$limFin;
							*/

							set @esta=$estaId;
							set @ini=$limIni;
							set @fin=$limFin;
							set @fech=$fechGest;

							set @fechValid=DATEDIFF($fechGest,NOW());

							if  ISNULL(@fechValid) then

							PREPARE STMT FROM 'select *,
											   (select gd_desEsta from gd_estaGest where gd_estaGest=gestDoc.gd_estaGest) as desEsta,
											   (select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes,
											   (select DATEDIFF(gd_fech,Now())) as prioDay
												from gd_gestDoc as gestDoc where gd_estaGest=?  limit ?,?';

							EXECUTE STMT USING @esta,@ini,@fin;

							else

							PREPARE STMT FROM 'select *,
											   (select gd_desEsta from gd_estaGest where gd_estaGest=gestDoc.gd_estaGest) as desEsta,
											   (select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes,
											   (select DATEDIFF(gd_fech,Now())) as prioDay
												from gd_gestDoc as gestDoc where gd_estaGest=? and gd_fech=?  limit ?,?';

							EXECUTE STMT USING @esta,@fech,@ini,@fin;

							end if;

						end;

					# capturar estados de gestion [gd_estaGest_cap] -> OK

						DELIMITER $$
						create procedure gd_estaGest_cap()
						COMMENT 'capturar estados de gestion'
						BEGIN
							/*#vars*/

							/*#cap estados*/
							SELECT * FROM `gd_estaGest`;
						end;

				#rutas

					# capturar estados de ruta [gd_estaRut_cap] -> OK

						DELIMITER $$
						create procedure gd_estaRut_cap()
						COMMENT 'capturar estados de ruta'
						BEGIN
							/*#vars*/

							/*#cap esta rut*/
							select * from gd_estaRut;
						end;

					# capturar responsables de rutas [gd_respoRut_cap] -> OK

						DELIMITER $$
						create procedure gd_respoRut_cap()
						COMMENT 'capturar responsables de rutas'
						BEGIN
							/*#vars*/

							/*#get resp rut*/
							select
									concat(per.pers_nombres,' ',per.pers_apepat) as perDes,
									trab.trabajador_id as trabId
								from
								persona as per
								inner join trabajador as trab on per.persona_id=trab.persona_id
								inner join perfil as perf on trab.perfil_id=perf.perfil_id
								where perf.perfil_alias='RG';
						end;

					# capturar rutas por limit [gd_rutxLim_cap] -> OK

						DELIMITER $$
						create procedure gd_rutxLim_cap($limIni int(11),$limFin int(11),$estaId int(11),$fechRut date)
						COMMENT 'capturar rutas por limit'
						BEGIN
							/*#vars*/
							set @esta=$estaId;
							set @ini=$limIni;
							set @fin=$limFin;
							set @fech=$fechRut;

							set @fechValid=DATEDIFF($fechRut,NOW());

							/*#cap rut por limit*/
							if  ISNULL(@fechValid) then

							PREPARE STMT FROM 'select *,
									(select group_concat(gest.gd_gest) from gd_gestDoc as gest 
									 inner join gd_detRuta as det on det.gd_gestDocId=gest.gd_gestDocId
									 where det.gd_rutaId=rut.gd_rutaId) as desRut,
									(select trab_usuario from trabajador where trabajador_id=rut.gd_admId) as rutAdm,
									(select trab_usuario from trabajador where trabajador_id=rut.gd_respId) as rutResp,
									(select gd_desEsta from gd_estaRut where gd_estaRutId=rut.gd_estaRutId) as estaRut
									 from gd_ruta as rut where gd_estaRutId=? limit ?,?';

							EXECUTE STMT USING @esta,@ini,@fin;

							else

							PREPARE STMT FROM 'select *,
									(select group_concat(gest.gd_gest) from gd_gestDoc as gest 
									 inner join gd_detRuta as det on det.gd_gestDocId=gest.gd_gestDocId
									 where det.gd_rutaId=rut.gd_rutaId) as desRut,
									(select trab_usuario from trabajador where trabajador_id=rut.gd_admId) as rutAdm,
									(select trab_usuario from trabajador where trabajador_id=rut.gd_respId) as rutResp,
									(select gd_desEsta from gd_estaRut where gd_estaRutId=rut.gd_estaRutId) as estaRut
									 from gd_ruta as rut where gd_fechRut=? and gd_estaRutId=? limit ?,?';

							EXECUTE STMT USING @fech,@esta,@ini,@fin;

							end if;

						end;

					# capturar rutas por id [gd_rutxId_cap] -> OK

						DELIMITER $$
						create procedure gd_rutxId_cap($rutId int(11))
						COMMENT 'capturar rutas por id'
						BEGIN
							/*vars*/

							/*captu ruta por id*/
							select *,
									(select gd_desEsta from gd_estaRut where gd_estaRutId=rut.gd_estaRutId) as desEsta 
							from gd_ruta as rut where gd_rutaId=$rutId;

						end;

					# capturar detalle rutas por id [gd_detRutxId_cap] OK

						DELIMITER $$
						create procedure gd_detRutxId_cap($rutId int(11))
						COMMENT 'capturar detalle rutas por id'
						BEGIN
							/*vars*/

							/*cap det ruta*/
							select
								*,
								gest.gd_gestDocId as item,
								gest.gd_doc as doc,
								gest.gd_gest as ges,
								gest.gd_lugar as lug,
								gest.gd_fech as fech,
								(select trab_usuario from trabajador where trabajador_id=gest.gd_usuId) as usuDes,
								(select gd_desEsta from gd_estaGest where gd_estaGest=gest.gd_estaGest) as desEsta
								from gd_detRuta as det
								inner join gd_gestDoc as gest on
								det.gd_gestDocId=gest.gd_gestDocId
								where det.gd_rutaId=$rutId and 
								(gest.gd_estaGest=3 or gest.gd_estaGest=2);
						end;

			# usu

				#gestiones

					# capturar gestion documentaria limit por usuario [gd_gestDocLimxUsu_cap] #!

						DELIMITER $$
						create procedure gd_gestDocxUsu_cap($limIni int(11),$limFin int(int),$usuId int(11),$estaGest int(11),$fechGest date)
						COMMENT 'capturar gestion documentaria limit por usuario'
						BEGIN
							/*#vars*/

							/*#get gest doc*/

							/*
							select *,
								   (select gd_desEsta from gd_estaGest where gd_estaGest=gestDoc.gd_estaGest) as desEsta,
								   (select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes
							from gd_gestDoc as gestDoc where gd_usuId=$usuId limit $limIni,$limFin;
							*/

							
							set @fech=$fechGest;
							set @esta=$estaGest;
							set @usu=$usuId;
							set @ini=$limIni;
							set @fin=$limFin;

							if $fechGest='' then

								PREPARE STMT FROM 'select *,
													   (select gd_desEsta from gd_estaGest where gd_estaGest=gestDoc.gd_estaGest) as desEsta,
													   (select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes
												from gd_gestDoc as gestDoc where gd_estaGest=? and gd_usuId=? limit ?,?';
								EXECUTE STMT USING @esta,@usu,@ini,@fin;

							else

								PREPARE STMT FROM 'select *,
													   (select gd_desEsta from gd_estaGest where gd_estaGest=gestDoc.gd_estaGest) as desEsta,
													   (select trab_usuario from trabajador where trabajador_id=gestDoc.gd_usuId) as usuDes
												from gd_gestDoc as gestDoc where gd_fech=? and gd_estaGest=? and gd_usuId=? limit ?,?';
								EXECUTE STMT USING @fech,@esta,@usu,@ini,@fin;

							end if;

						end;

				#rutas

		# [FUNCTIONS]

			# admin

				#gestiones

					# crear gestion documentaria [gd_gestDoc_cread] -> OK

						DELIMITER $$
						create function gd_gestDoc_cread($doc varchar(50),
														$gest text,
														$fech date,
														$hora time,
														$lugar varchar(200),
														$usuId int(11),
														$estaGest int(11),
														$lati decimal(20,15),
														$longi decimal(20,15))
						RETURNS int(11)
						COMMENT 'crear gestion documentaria'
						BEGIN
							/*#vars*/
							declare $rowAfect int(11);
							declare $idAfect int(11);

							/*#insert gesti docu*/
							
							insert into gd_gestDoc(gd_doc,
											gd_gest,
											gd_fech,
											gd_hora,
											gd_lugar,
											gd_usuId,
											gd_estaGest,
											gd_latitud,
											gd_longitud) 
							values($doc,
									$gest,
									$fech,
									$hora,
									$lugar,
									$usuId,
									$estaGest,
									$lati,
									$longi);

							/*# get row afect*/

							set $idAfect=(select LAST_INSERT_ID());

							/*#return val*/

							return $idAfect;

						end;

					# editar gestion documentaria [gd_gestDoc_edit] -> OK

						DELIMITER $$
						create function gd_gestDoc_edit($idGest int(11),$doc varchar(50),$gest text,$fech date,$hora time,$lugar varchar(200),$estaGest int(11))
						RETURNS int(11)
						COMMENT 'editar gestion documentaria'
						BEGIN
							/*#vars*/
							declare $rowAfect int(11);

							/*# update gest docu*/
							update gd_gestDoc set gd_doc=$doc,
													gd_gest=$gest,
													gd_fech=$fech,
													gd_hora=$hora,
													gd_lugar=$lugar,
													gd_estaGest=$estaGest
											  where gd_gestDocId=$idGest;
							/*# filas afectadas*/
							set $rowAfect=(select ROW_COUNT());

							/*# return val*/
							return $idGest;

						end;

					# eliminar gestion documentaria [gd_gestDoc_eli] -> OK

						DELIMITER $$
						create function gd_gestDoc_eli($idGest int(11))
						RETURNS int(11)
						COMMENT 'eliminar gestion documentaria'
						BEGIN
							/*#vars*/
							declare $rowAfect int(11);

							/*#del gest doc*/
							delete from gd_gestDoc where gd_gestDocId=$idGest;

							/*#row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*#return*/
							return $rowAfect;
						end;

					# contar gestiones documentarias [gd_gestDoc_cont] -> OK

						DELIMITER $$
						create function gd_gestDoc_cont($estaId int(11),$fechGest date)
						RETURNS int(11)
						COMMENT 'contar gestiones documentarias'
						BEGIN
							/*#vars*/
							declare $contGest int(11);

							set @fechValid=DATEDIFF($fechGest,NOW());

							/*#cont gest doc*/
							if ISNULL(@fechValid) then
								set $contGest=(select count(*) as cont from gd_gestDoc where gd_estaGest=$estaId);
							else
								set $contGest=(select count(*) as cont from gd_gestDoc where gd_fech=$fechGest and
												gd_estaGest=$estaId);
							end if;

							/*#return val*/
							return $contGest;
						end;

					# contar gestiones documentarias por fecha y estado [gd_gestFechxEsta_cont] -> OK

						DELIMITER $$
						create function gd_gestFechxEsta_cont($fechGest date,$estaGest int(11))
						RETURNS int(11)
						COMMENT 'contar gestiones documentarias pendientes actual'
						BEGIN
							#vars
							declare $contGest int(11);

							#cont gest x fech
							set $contGest=(select count(*) from gd_gestDoc where gd_fech=$fechGest and gd_estaGest=$estaGest);

							#return
							return $contGest;
						end;

				#rutas

					# crear ruta de gestiones [gd_rutGest_cread] OK

						DELIMITER $$
						create function gd_rutGest_cread($respId int(11),$admId int(11),$estaRutId int(11),$fechRut date,$hourRut time)
						RETURNS int(11)
						COMMENT 'crear ruta de gestiones'
						BEGIN
							/*#vars*/
							declare $rowAfect int(11);
							declare $idAfect int(11);

							/*insertar ruta*/
							insert into gd_ruta(gd_respId,gd_admId,gd_estaRutId,gd_fechRut,gd_hourRut) 
							values ($respId,$admId,$estaRutId,$fechRut,$hourRut); 

							/*id afectado*/
							set $idAfect=(select LAST_INSERT_ID());

							/*insertar correlativo*/
							update gd_ruta set gd_correRut=gd_correRut_gene($idAfect,'RUT') where 
							gd_rutaId=$idAfect;

							/*rows Afectadas*/
							/*set $idAfect=(select ROW_COUNT());*/

							/*#return*/
							return $idAfect;

						end;

					# generar correlativo ruta [gd_correRut_gene] OK

						DELIMITER $$
						create function gd_correRut_gene($rutId int(11),$preCorre varchar(15))
						RETURNS char(25)
						COMMENT 'generar correlativo ruta'
						BEGIN
							/*#vars*/
							declare $corre char(25);
							declare $tamCod int(11);

							/*#evaluar correlativo*/
							set $tamCod=(select length($rutId));

							if $tamCod>5 then
								set $tamCod=$tamCod;
							else
								set $tamCod=5;
							end if;

							set $corre=(select concat($preCorre,'-',LPAD($rutId,$tamCod,'0')));

							/*#retornar*/
							return $corre;

						end;

					# detallar ruta de gestiones [gd_rutGest_det] OK

						DELIMITER $$
						create function gd_rutGest_det($rutId int(11),$gestDocId int(11))
						RETURNS int(11)
						COMMENT 'detallar ruta de gestiones'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);
							declare $idAfect int(11);

							/*insertar detalle ruta*/
							insert into gd_detRuta(gd_rutaId,gd_gestDocId) values($rutId,$gestDocId);

							/*id Afectado*/
							/*set $id=(select LAST_INSERT_ID());*/

							/*pasar estado de gestiones en ruta*/
							update gd_gestDoc set gd_estaGest=3 where gd_gestDocId=$gestDocId;

							/*row afectado*/
							set $rowAfect=(select ROW_COUNT());

							/*retornar*/
							return $rowAfect;

						end;

					# contar rutas de gestiones [gd_rutGest_cont] OK

						DELIMITER $$
						create function gd_rutGest_cont($estaId int(11),$fechRut date)
						RETURNS int(11)
						COMMENT 'contar rutas de gestiones'
						BEGIN
							/*vars*/
							declare $contRut int(11);

							set @fechValid=DATEDIFF($fechRut,NOW());

							/*#cont gest doc*/
							if ISNULL(@fechValid) then
								set $contRut=(select count(*) from gd_ruta where gd_estaRutId=$estaId);
							else
								set $contRut=(select count(*) from gd_ruta where gd_fechRut=$fechRut and
												gd_estaRutId=$estaId);
							end if;

							/*#return*/
							return $contRut;

						end;

					# actualizar ruta de gestiones [gd_rutGest_actu] OK

						DELIMITER $$
						create function gd_rutGest_actu($rutId int(11),$estaRutId int(11),$fechRut date,$hourRut time,$respId int(11))
						RETURNS int(11)
						COMMENT 'actualizar ruta de gestiones'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*edit rut id*/
							update gd_ruta set gd_respId=$respId,
												gd_estaRutId=$estaRutId,
												gd_fechRut=$fechRut,
												gd_hourRut=$hourRut where gd_rutaId=$rutId;

							/*rowAfect*/
							set $rowAfect=(select ROW_COUNT());

							/*returns*/
							return $rutId;
						end;

					# eliminar ruta de gestiones [gd_rutGest_eli] OK

						DELIMITER $$
						create function gd_rutGest_eli($rutId int(11))
						RETURNS int(11)
						COMMENT 'eliminar ruta de gestiones'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*eli rut*/
							delete from gd_ruta where gd_rutaId=$rutId;

							/*row afect*/
							set $rowAfect=(select ROW_COUNT()); 

							/*return*/
							return $rowAfect;
						end;

					# eliminar detalle de ruta por id [gd_detRutxId_eli] OK

						DELIMITER $$
						create function gd_detRutxId_eli($detRutId int(11))
						RETURNS int(11)
						COMMENT 'eliminar detalle de ruta por id'
						BEGIN

							/*vars*/
							declare $idGest int(11);
							declare $rowAfect int(11);

							/*obte id gest*/
							set $idGest=(select gd_gestDocId from gd_detRuta where gd_detRutaId=$detRutId);

							/*envi pen gest*/
							update gd_gestDoc set gd_estaGest=1 where gd_gestDocId=$idGest;

							/*eli detalle rut*/
							delete from gd_detRuta where gd_detRutaId=$detRutId;

							/*row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;

						end;

					# concretar detalle de ruta por id [gd_detRutxId_concre] OK

						DELIMITER $$
						create function gd_detRutxId_concre($rutId int(11),$estaGest int(11))
						RETURNS int(11)
						COMMENT 'concretar detalle de ruta por id'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*concre*/
							update gd_detRuta as det 
							inner join gd_gestDoc as gest on det.gd_gestDocId=gest.gd_gestDocId
							set gest.gd_estaGest=$estaGest where det.gd_rutaId=$rutId;

							/*row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;
						end;

					# concretar ruta por id [gd_rutxId_concre] OK

						DELIMITER $$
						create function gd_rutxId_concre($rutId int(11))
						RETURNS int(11)
						COMMENT 'concretar ruta por id'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*concre rut por id*/
							update gd_ruta set gd_estaRutId=2 where gd_rutaId=$rutId;

							/* row afect */
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;

						end;

			# respo

				#gestiones

				#rutas

/*-------------------------------------------------------------------------------------------------------*/
	# MODULO NO CONFORMIDADES
/*-------------------------------------------------------------------------------------------------------*/

	/* MODELO DE DATOS */

		/* Table No Conformidad [nc_noConfor] */

			create table nc_noConfor
			(
				nc_noConforId int(11) primary key not null auto_increment, #PK
				nc_nro char(25),
				nc_detecId int(11), #FK
				nc_procAfectId int(11), #FK
				nc_tipObsId int(11), #FK
				nc_tipNoConforId int(11), #FK
				nc_estaConforId int(11), #FK
				nc_centProyeId int(11), #FK--
				nc_des text,
				nc_fechRecep date,
				nc_respInme text,
				nc_fechCie date,
				nc_medPrev text,
				nc_obsId int(11),
				nc_oriObs varchar(50)
			);

			#Restricciones
				alter table nc_noConfor
				add constraint nc_detecId_fk foreign key (nc_detecId) references nc_detec(nc_detecId),
				add constraint nc_procAfectId_fk foreign key (nc_procAfectId) references nc_procAfect(nc_procAfectId),
				add constraint nc_tipObsId_fk foreign key (nc_tipObsId) references nc_tipObs(nc_tipObsId),
				add constraint nc_tipNoConforId_fk foreign key (nc_tipNoConforId) references nc_tipNoConfor(nc_tipNoConforId);

			#Modificacion
				alter table nc_noConfor
				add nc_medPrev text after nc_fechCie;

				#New Update 26/12/2014 - CLOSE

				alter table nc_noConfor
				add nc_obsId int(11) after nc_medPrev;

				#New update 14/01/2014 - CLOSE

				alter table nc_noConfor
				add nc_oriObs varchar(50) after nc_obsId;

		/* Table Deteccion [nc_detec] */

			create table nc_detec
			(
				nc_detecId int(11) primary key not null auto_increment, #PK
				nc_des varchar(50)
			);

			# Constantes
			/*
				- autodetectado
				- auditoria
				- com cliente
				- inspeccion
			*/

		/* Table Proceso Afectado [nc_procAfect] */

			create table nc_procAfect
			(
				nc_procAfectId int(11) primary key not null auto_increment, #PK
				nc_des varchar(50)
			);

			# Constantes
			/*
				- administrativo
				- comercial
				- logistico
				- tecnico
			*/

		/* Table Tipo observacion [nc_tipObs] */

			create table nc_tipObs
			(
				nc_tipObsId int(11) primary key not null auto_increment, #PK
				nc_des varchar(25)
			);

			# Constantes
			/*
				- falla sgc
				- queja
				- reclamo
				- post-venta
			*/

		/* Table Tipo No Conformidad [nc_tipNoConfor] */

			create table nc_tipNoConfor
			(
				nc_tipNoConforId int(11) primary key not null auto_increment, #PK
				nc_des varchar(50)
			);

			# Constantes
			/*
				- no aplica
				- demora entrega
				- incumplimiento estandares ew
				- incumplimiento ley
				- falla de equipo
			*/

			# Modificacion
				alter table nc_tipNoConfor
				add nc_obsId int(11) after nc_des;

		/* Table Estado Conformidad [nc_estaConfor] */

			create table nc_estaConfor
			(
				nc_estaConforId int(11) primary key not null auto_increment, #PK
				nc_des varchar(50)
			);

			#constantes
			/*
				- solucionado
				- en proceso
				- no atendido
			*/

		/* Table Medidas Correctivas [nc_medCorrec] */

			create table nc_medCorrec
			(
				nc_medCorrecId int(11) primary key not null auto_increment, #PK
				nc_noConforId int(11), #FK
				nc_medCorrecDes varchar(1500),
				nc_fechCorrec date,
				nc_ingAsig varchar(2000),
				nc_respMed varchar(1500)
			);

			#Restricciones
				alter table nc_medCorrec
				add constraint nc_noConforId_fk foreign key (nc_noConforId) references nc_noConfor(nc_noConforId);

			#Modificacion
				alter table nc_medCorrec
				add nc_respMed varchar(1500) after nc_ingAsig;

		/* Table Equipos de Proyecto [nc_equiProye] */

			create table nc_equiProye
			(
				nc_equiProyeId int(11) primary key not null auto_increment, #PK
				nc_noConforId int(11), #FK
				nc_detCompId int(11) #FK--
			);

			#Restricciones
				alter table nc_equiProye
				add constraint nc_noConforId_fk2 foreign key (nc_noConforId) references nc_noConfor(nc_noConforId);

			#Modificacion
				alter table nc_equiProye
				add nc_detCompId int(11) after nc_noConforId;

		/* Table adjuntos de informes [nc_adjuInfo]  */

			create table nc_adjuInfo
			(
				nc_adjuInfoId int(11) primary key not null auto_increment, #PK
				nc_noConforId int(11), #PK
				nc_desAdju varchar(150),
				nc_fileAdju varchar(200)
			);

			#Restricciones
				alter table nc_adjuInfo
				add constraint nc_noConforId_fk3 foreign key (nc_noConforId) references nc_noConfor(nc_noConforId);

		/* Table observacion [nc_obs] */

			create table nc_obs
			(
				nc_obsId int(11) primary key not null auto_increment, #PK
				nc_obsDes varchar(50)
			);

	/*** New update 08/01/2015 - CLOSE ***/

		/* Table Medidas Preventivas [nc_medPreven] */

			create table nc_medPreven
			(
				nc_medPrevId int(11) primary key not null auto_increment,
				nc_noConforId int(11), #FK
				nc_medPrevDes varchar(1500),
				nc_medPrevFech date 
			);

			#Restricciones

				alter table nc_medPreven
				add constraint nc_noConforId_fk4 foreign key (nc_noConforId) references nc_noConfor(nc_noConforId);

	/*** New update 14/01/2015 - CLOSE ***/

		/* Table Origen de observacion [nc_oriObs] */

			create table nc_oriObs
			(
				nc_oriObsId int(11) primary key not null auto_increment, #PK
				nc_oriObsDes varchar(150) 
			);



	/* PERSISTENCIA */

		#PROCEDURE

			#Query Read [Parametros|Entidad] - [c[R]ud]

					#_obtener deteccion [nc_detec_obte]
						DELIMITER $$
						create procedure nc_detec_obte()
						COMMENT 'obtener deteccion'
						BEGIN
							/*obte detec*/
							select
								nc_des as nc_detecDes,
								nc_detecId as nc_detecVal
							from nc_detec;
						end;

					#_obtener proceso afectado [nc_procAfect_obte]
						DELIMITER $$
						create procedure nc_procAfect_obte()
						COMMENT 'obtener proceso afectado'
						BEGIN
							/*obte proce afect*/
							select 
							 nc_des as nc_proceDes,
							 nc_procAfectId as nc_proceVal
							 from nc_procAfect;
						end;

					#_obtener tipo de observacion [nc_tipObs_obte]
						DELIMITER $$
						create procedure nc_tipObs_obte()
						COMMENT 'obtener tipo de observacion'
						BEGIN
							/* obte tip obs */
							select 
								nc_des as nc_obsDes,
								nc_tipObsId as nc_obsVal
								 from nc_tipObs;
						end;

					#_obtener tipo de no conformidad [nc_tipNoConfor_obte]
						DELIMITER $$
						create procedure nc_tipNoConfor_obte()
						COMMENT 'obtener tipo de no conformidad'
						BEGIN
							/* obte tip no confor */
							select 
							 nc_des as nc_tipConfDes,
							 nc_tipNoConforId as nc_tipConfVal
							 from nc_tipNoConfor;
						end;

					#_obtener estado conformidad [nc_estaConfor_obte]
						DELIMITER $$
						create procedure nc_estaConfor_obte()
						COMMENT 'obtener estado conformidad'
						BEGIN
							/* obte esta confor */
							select
								nc_des as nc_estaConforDes, 
								nc_estaConforId as nc_estaConforVal 
							from nc_estaConfor;
						end;

					#_obtener centro de costos [nc_centCost_obte]

						DELIMITER $$
						create procedure nc_centCost_obte()
						COMMENT 'obtener centro de costos'
						BEGIN
							/* obte centcost */
							select
							cc_centCostId as nc_ccId,
							cc_correCenCost as nc_ccNum,
							cc_idProye as nc_proyId,
							(select proy_nombre from proyecto where proyecto_id=nc_proyId) as nc_proyNom,
							(select concat(ccNum,'-',proyNom)) as nc_ccDes
							from cc_centcost where bestado=1;
						end;

					#_obtener ingenieros asignados [nc_ingAsig_obte]

						DELIMITER $$
						create procedure nc_ingAsig_obte()
						COMMENT 'obtener ingenieros asignados'
						BEGIN
							/* ing asig */
							select distinct
							concat('Ing. ',per.pers_nombres,' ',per.pers_apepat) as nc_ingAsig,
							trab.trabajador_id as nc_trabId
							from persona as per,trabajador as trab,contacto as contac
							where 
							per.persona_id=trab.persona_id and 
							(trab.trabajador_id=contac.trabajador_id or trab.persona_id=contac.persona_id) and
							contac.cont_comercial=1 and 
							trab.empresa_id=1 and
							trab.bestado=1 and
							(trab.trabajador_id!=1 and
							trab.trabajador_id!=17 and
							trab.trabajador_id!=58 and
							trab.trabajador_id!=34 and
							trab.trabajador_id!=23 and
							trab.trabajador_id!=39 and
							trab.trabajador_id!=47 and
							trab.trabajador_id!=73);
						end;

					#_obtener datos de centro [nc_datCent_obte]

						DELIMITER $$
						create procedure nc_datCent_obte($centId int(11))
						COMMENT 'obtener datos de centro'
						BEGIN
							/*vars*/

							/*dat proye*/
							select
							(select distinct proy_nombre from proyecto where proyecto_id=cent.cc_idProye ) as nc_proye,
							(select group_concat(proveedor_id separator ',') from compras where pc_id=cent.cc_centCostId group by pc_Id ) as nc_proveId,
							(select group_concat(emp_nombre) from empresa where empresa_id in (nc_proveId) ) as nc_proveDes,
							(select distinct emp_nombre from empresa where empresa_id=cent.cc_idCliEmp) as nc_cli,
							(select distinct cot.operador_id from cotizacion as cot where cotizacion_id=cent.cc_cotiFlId ) as ingRespId,
							(select concat('Ing. ',pers_completo) from v_trabajador where trabajador_id=ingRespId) as ingRespDes,
							(select count(*) from compras where pc_id=cent.cc_centCostId) as cantProv
							from cc_centcost as cent where cent.cc_centCostId=$centId;

						end;

					#_obtener ordenes por centro de costo [nc_ordexCent_obte]

						DELIMITER $$
						create procedure nc_ordexCent_obte($centId int(11))
						COMMENT 'obtener ordenes por centro de costo'
						BEGIN

							/*vars*/
							select comp_nro as nc_nroComp,
								   compras_id as nc_CompId
							from compras where pc_id=$centId;

						end;

					#_obtener detalle orden por orden [nc_detxOrd_obte]

						DELIMITER $$
						create procedure nc_detxOrd_obte($ordId int(11))
						COMMENT 'obtener detalle orden por orden'
						BEGIN

							/*det ord*/
							select
							compDet.comp_detalle_id as nc_detId,
							compDet.comp_detalle_id as nc_compId,
							(select prod_nombre from producto where producto_id=compDet.producto_id) as nc_prodDes,
							(select emp.emp_nombre from compras as comp,empresa as emp where comp.compras_id=$ordId and 
							comp.proveedor_id=emp.empresa_id) as nc_provDes
							from  compras_detalle as compDet where compDet.compras_id=$ordId;

						end;

					#_obtener no conformidades por filtro [nc_noConfor_obte]

						DELIMITER $$
						create procedure nc_noConfor_obte($fechRecep date,$estaConfor int(11),$limIni int(11),$limFin int(11),$obsId int(11))
						COMMENT 'obtener no conformidades por filtro'
						BEGIN
							/*vars*/
							declare $cont int(11);
							set @fechRecep=$fechRecep;
							set @estaConfor=$estaConfor;
							set @fechValid=DATEDIFF($fechRecep,NOW());
							set @obsId=$obsId;

							/*parametros*/
							set @limIni=$limIni;
							set @limFin=$limFin;

							/*obte no confor*/
							if ISNULL(@fechValid) then

								PREPARE STMT FROM 'select
								nc_noConforId,
								nc_nro,
								nc_fechRecep,
								nc_des,
								(select nc_des from nc_estaConfor where nc_estaConforId=confor.nc_estaConforId) as nc_estaConfor
								from nc_noConfor as confor where nc_estaConforId=? and nc_obsId=? order by nc_noConforId ASC limit ?,?';

								EXECUTE STMT USING @estaConfor,@obsId,@limIni,@limFin;
							
							else

								PREPARE STMT FROM 'select
								nc_noConforId,
								nc_nro,
								nc_fechRecep,
								nc_des,
								(select nc_des from nc_estaConfor where nc_estaConforId=confor.nc_estaConforId) as nc_estaConfor
								from nc_noConfor as confor where nc_estaConforId=? and nc_obsId=? and nc_fechRecep=? order by 
								nc_noConforId ASC limit ?,?';

								EXECUTE STMT USING @estaConfor,@obsId,@fechRecep,@limIni,@limFin;

							end if;

						end;

					#_obtener no conformidad por id [nc_noConforxId_obte]

						DELIMITER $$
						create procedure nc_noConforxId_obte($conforId int(11))
						COMMENT 'obtener no conformidad por id'
						BEGIN

							/*vars*/

							/*obte no confor*/
							select 
							*,
							(select proye.proy_nombre from cc_centcost as cent,proyecto as proye where cent.cc_centCostId=confor.nc_centProyeId
							and cent.cc_idproye=proye.proyecto_id) as proyeDes
							from nc_noConfor as confor where nc_noConforId=$conforId;

						end;

					#_obtener informes adjunto [nc_infoAdju_obte]

						DELIMITER $$
						create procedure nc_infoAdju_obte($conforId int(11))
						COMMENT 'obtener informes adjunto'
						BEGIN

							/*vars*/

							/*obte adju*/
							select 
							* from
							nc_adjuInfo where nc_noConforId=$conforId;

							/*return*/

						end;

					#_obtener detalle de equipos por id [nc_detEquipxId_obte]

						DELIMITER $$
						create procedure nc_detEquipxId_obte($conforId int(11))
						COMMENT 'obtener detalle de equipos por id'
						BEGIN
							/*vars*/

							/*det equip*/
							select 
							equip.nc_equiProyeId as equipId,
							(select prod_nombre from producto where producto_id=compDet.producto_id) as prodDes,
							(select emp_nombre from empresa where empresa_id=comp.proveedor_id) as provDes
							from 
							nc_equiProye as equip,
							compras_detalle as compDet,
							compras as comp
							where 
							equip.nc_noConforId=$conforId and
							equip.nc_detCompId=compDet.comp_detalle_id and
							compDet.compras_id=comp.compras_id;

						end;

					#_obtener medidas correctivas [nc_medCorrec_obte]

						DELIMITER $$
						create procedure nc_medCorrec_obte($conforId int(11))
						COMMENT 'obtener medidas correctivas'
						BEGIN
							/*vars*/

							/*obte med*/
							SELECT `nc_medCorrecId`, 
									`nc_noConforId`, 
									`nc_medCorrecDes`, 
									`nc_fechCorrec`, 
									`nc_ingAsig`, 
									`nc_respMed` FROM `nc_medCorrec` WHERE nc_noConforId=$conforId;

						end;

					#_iniciar medida por id [nc_medxId_ini]

						DELIMITER $$
						create procedure nc_medxId_ini($medId int(11))
						COMMENT 'iniciar medida por id'
						BEGIN

							/*vars*/

							/*obte med x id*/
							select * from nc_medCorrec where nc_medCorrecId=$medId;

						end;

				#New update 26/12/2014 - CLOSE

					#_obtener observaciones [nc_obs_obte]

						DELIMITER $$
						create procedure nc_obs_obte()
						COMMENT 'obtener observaciones'
						BEGIN
							/*obte obs*/
							select * from nc_obs;
						end;

					#_obtener tipo conformidad por id [nc_tipConfxId_obte]

						DELIMITER $$
						create procedure nc_tipConfxId_obte($idObs int(11))
						COMMENT 'obtener tipo conformidad por id'
						BEGIN
							/*vars*/

							/*obte confor*/
							select * from nc_tipNoConfor where nc_obsId=$idObs;
						end;

				# **New update 08/01/2015** - CLOSE
				#			   12/01/2015

					# obtener medida preventiva por id [nc_medPrevxId_obte] -> OK

						DELIMITER $$
						create procedure nc_medPrevxId_obte($medId int(11))
						COMMENT 'obtener medida preventiva por id'
						BEGIN
							/*vars*/

							/*obte med prev*/
							select * from nc_medPreven where nc_medPrevId=$medId;

						end;

					# obtener medida preventiva por confor [nc_medPrev_obte] -> OK

						DELIMITER $$
						create procedure nc_medPrev_obte($conforId int(11))
						COMMENT 'obtener medida preventiva por confor'
						BEGIN

							/*vars*/

							/*obte med prev*/
							select * from nc_medPreven where nc_noConforId=$conforId;

						end;

				# **New update 14/01/2015** - CLOSE

					#obtener origen de observaciones [nc_oriObs_obte]

						DELIMITER $$
						create procedure nc_oriObs_obte()
						COMMENT 'obtener origen de observaciones'
						BEGIN
							/*vars*/

							/*obte orig*/
							select 
							nc_oriObsId as oriId,
							nc_oriObsDes as oriDes
							from nc_oriObs;
						end;


			#Query Create [Entidad|Calculo] - [[C]rud]

				#_crear correlativo no conformidad [nc_correNoConfor_cre]

					DELIMITER $$
					create function nc_correNoConfor_cre($conforId int(11),$preCorre varchar(15))
					RETURNS char(25)
					COMMENT 'crear correlativo no conformidad'
					BEGIN
						
						/*#vars*/
						declare $corre char(25);
						declare $tamCod int(11);

						/*#evaluar correlativo*/
						set $tamCod=(select length($conforId));

						if $tamCod>5 then
							set $tamCod=$tamCod;
						else
							set $tamCod=5;
						end if;

						set $corre=(select concat($preCorre,'-',LPAD($conforId,$tamCod,'0')));

						/*#retornar*/
						return $corre;

					end;

				#_crear no conformidad [nc_noConfor_cre]

					DELIMITER $$
					create function nc_noConfor_cre($centId int(11),
						$detecId int(11),
						$procId int(11),
						$tipObs int(11),
						$estaConfor int(11),
						$fechRecep date,
						$desConfor text,
						$respInme text,
						$fechCie date,
						$tipConfor int(11),
						$medPrev text,
						$obsId int(11)),

					RETURNS int(11)
					COMMENT 'crear no conformidad'
					BEGIN

						/* vars */
						declare $idAfect int(11);
						declare $correConfor char(25);
						declare $rowAfect int(11);
						declare $valReturn int(11);
						declare $rowEva int(11);

						/* crear no conformidad */
						insert into nc_noConfor(nc_centProyeId,
												nc_detecId,
												nc_procAfectId,
												nc_tipObsId,
												nc_tipNoConforId,
												nc_estaConforId,
												nc_fechRecep,
												nc_des,
												nc_respInme,
												nc_fechCie,
												nc_medprev,
												nc_obsId)
						values($centId,
							   $detecId,
							   $procId,
							   $tipObs,
							   $tipConfor,
							   $estaConfor,
							   $fechRecep,
							   $desConfor,
							   $respInme,
							   $fechCie,
							   $medPrev,
							   $obsId);


						/* row afect */
						set $rowEva=(select ROW_COUNT());
						

						if $rowEva>0 then

							/*id afect*/
							set $idAfect=(select LAST_INSERT_ID());
							/*´gene corre*/
							set $correConfor=(select nc_correNoConfor_cre($idAfect,'NC'));
							/* update corre */
							update nc_noConfor set nc_nro=$correConfor where nc_noConforId=$idAfect;
							/* rowAfect */
							set $rowAfect=(select ROW_COUNT());
							/*val return*/
							set $valReturn=$idAfect;

						else

							set $valReturn=$rowEva;

						end if;

						/* return */
						return $valReturn;

					end;

				#_contar no conformidades por filtro [nc_noConforxFil_cont]

					DELIMITER $$
					create function nc_noConforxFil_cont($fechRecep date,$estaConfor int(11),$obsId int(11))
					RETURNS int(11)
					COMMENT 'contar no conformidades por filtro'
					BEGIN

						/*vars*/
						declare $cont int(11);
						set @fechRecep=$fechRecep;
						set @estaConfor=$estaConfor;
						set @fechValid=DATEDIFF($fechRecep,NOW());
						set @obsId=$obsId;


						/*cont no confor*/
						if ISNULL(@fechValid) then
							set $cont=(select count(*) from nc_noConfor where nc_estaConforId=$estaConfor and nc_obsId=$obsId);
						else
							set $cont=(select count(*) from nc_noConfor where nc_fechRecep=$fechRecep and nc_estaConforId=$estaConfor and nc_obsId=$obsId);
						end if;

						/*return*/
						return $cont;

					end;

				#_adjuntar informe no conformidad [nc_infoNoConfor_adju]

					DELIMITER $$
					create function nc_infoNoConfor_adju($conforId int(11),
														$desAdju varchar(150),
														$fileAdju varchar(200)
														)
					RETURNS int(11)
					COMMENT 'adjuntar informe no conformidad'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*adju file*/
						insert into nc_adjuInfo(nc_noConforId,
												nc_desAdju,
												nc_fileAdju) values 
									($conforId,
									$desAdju,
									$fileAdju);

						/* row afect */
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

				#_crear detalle de equipos [nc_detEquip_cre]

					DELIMITER $$
					create function nc_detEquip_cre($conforId int(11),$detCompId int(11))
					RETURNS int(11)
					COMMENT 'crear detalle de equipos'
					BEGIN

						/*vars*/
						declare $rowAfect int(11);

						/*cre det equip*/
						insert into nc_equiProye(nc_noConforId,nc_detCompId)
						values ($conforId,$detCompId);

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

				#_crear medida correctiva [nc_medCorre_cre]

					DELIMITER $$
					create function nc_medCorre_cre($conforId int(11),
													$medDes varchar(1500),
													$respMed varchar(1500),
													$fechCorrec date,
													$ingAsig varchar(2000))
					RETURNS int(11)
					COMMENT 'crear medida correctiva'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);
						declare $idAfect int(11);
						declare $valResp int(11);

						/*cre med*/
						insert into nc_medCorrec(nc_noConforId,
												nc_medCorrecDes,
												nc_respMed,
												nc_fechCorrec,
												nc_ingAsig) values
												($conforId,
												$medDes,
												$respMed,
												$fechCorrec,
												$ingAsig);

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*id med*/
						set $idAfect=(select LAST_INSERT_ID());

						/*eva afect*/
						if $rowAfect>0 then

							set $valResp=$idAfect;
						
						else

							set $valResp=$rowAfect;

						end if;

						/*return*/
						return $valResp;
					end;

				#_obtener persona por id trabajador [nc_perxId_obte]

					DELIMITER $$
					create function nc_perxId_obte($idTrab int(11))
					RETURNS varchar(200)
					COMMENT 'obtener persona por id trabajador'
					BEGIN
						/*vars*/
						declare $ingAsig varchar(200);

						/*obte ing asig*/
						set $ingAsig=(select concat('Ing.',per.pers_nombres,' ',per.pers_apepat) as ingAsig from trabajador as trab,
						persona as per where per.persona_id=trab.persona_id and trab.trabajador_id=$idTrab);

						/*return*/
						return $ingAsig;
					end;

				#_obtener porcentaje por tipo de campo [nc_porcexTip_obte]

					DELIMITER $$
					create function nc_porcexTip_obte($tipPorce int(11),$idTip int(11),$fechIni date,$fechFin date)
					RETURNS decimal(10,2)
					COMMENT 'obtener porcentaje por tipo de campo'
					BEGIN
						/*vars*/
						declare $valPorce decimal(10,2);
						declare $totConfor int(11);
						declare $totxTip int(11);

						/*tot confor*/
						set $totConfor=(select count(*) from nc_noConfor where nc_fechRecep between $fechIni and $fechFin);

						/*calcu porce x tip*/
						CASE $tipPorce

							WHEN 1 THEN

								set $totxTip=(select count(*) from nc_noConfor where 
												(nc_fechRecep between $fechIni and $fechFin) and 
												nc_detecId=$idTip);
								set $valPorce=(($totxTip/$totConfor)*100);

							WHEN 2 THEN

								set $totxTip=(select count(*) from nc_noConfor where 
												(nc_fechRecep between $fechIni and $fechFin) and 
												nc_procAfectId=$idTip);
								set $valPorce=(($totxTip/$totConfor)*100);
							
							WHEN 3 THEN

								set $totxTip=(select count(*) from nc_noConfor where 
												(nc_fechRecep between $fechIni and $fechFin) and 
												nc_tipObsId=$idTip);
								set $valPorce=(($totxTip/$totConfor)*100);
							
							WHEN 4 THEN

								set $totxTip=(select count(*) from nc_noConfor where 
												(nc_fechRecep between $fechIni and $fechFin) and 
												nc_tipNoConforId=$idTip);
								set $valPorce=(($totxTip/$totConfor)*100);
							
							WHEN 5 THEN

								set $totxTip=(select count(*) from nc_noConfor where 
												(nc_fechRecep between $fechIni and $fechFin) and 
												nc_estaConforId=$idTip);
								set $valPorce=(($totxTip/$totConfor)*100);

							WHEN 6 THEN

								set $totxTip=(select count(*) from nc_noConfor where 
												(nc_fechRecep between $fechIni and $fechFin) and 
												nc_obsId=$idTip);
								set $valPorce=(($totxTip/$totConfor)*100);
							
							ELSE

							BEGIN

							END;

						END CASE;

						return $valPorce;
					end;

				# ** New update 08/01/2015 - CLOSE **

					# crear medida preventiva [nc_medPrev_cre] -> OK

						DELIMITER $$
						create function nc_medPrev_cre($noConforId int(11),$desPrev varchar(1500),$fechPrev date)
						RETURNS int(11)
						COMMENT 'crear medida preventiva'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*cre med prev*/
							insert into nc_medPreven(nc_noConforId,nc_medPrevDes,nc_medPrevFech) 
							values ($noConforId,$desPrev,$fechPrev);

							/*row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;
						end;

			#Query Update [Entidad] - [cr[U]d]

				#_editar no conformidad por id [nc_noConfor_edit]

					DELIMITER $$
					create function nc_noConfor_edit($conforId int(11),
													$centId int(11),
													$detectId int(11),
													$proceId int(11),
													$tipObs int(11),
													$tipConfor int(11),
													$estaConfor int(11),
													$desConfor text,
													$fechRecep date,
													$respInme text,
													$fechCie date,
													$medPrev text,
													$obsId int(11)
													)
					RETURNS int(11)
					COMMENT 'actualizar no conformidad por id'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*actu no confor*/
						UPDATE `nc_noConfor` SET 
						`nc_centProyeId`=$centId,
						`nc_detecId`=$detectId,
						`nc_procAfectId`=$proceId,
						`nc_tipObsId`=$tipObs,
						`nc_tipNoConforId`=$tipConfor,
						`nc_estaConforId`=$estaConfor,
						`nc_des`=$desConfor,
						`nc_fechRecep`=$fechRecep,
						`nc_respInme`=$respInme,
						`nc_fechCie`=$fechCie,
						`nc_medPrev`=$medPrev,
						`nc_obsId`=$obsId WHERE nc_noConforId=$conforId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*eva row afect*/
						if $rowAfect>0 then
							set $rowAfect=$conforId;
						end if;

						/*return*/
						return $rowAfect;

					end;

				#_editar medida correctiva por id [nc_medCorrec_edit]

					DELIMITER $$
					create function nc_medCorrec_edit($medId int(11),
														$medDes varchar(1500),
														$fechCorrec date,
														$ingAsig varchar(2000),
														$medResp varchar(1500))
					RETURNS int(11)
					COMMENT 'editar medida correctiva por id'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*edit med*/
						UPDATE `nc_medCorrec` SET `nc_medCorrecDes`=$medDes,
												`nc_fechCorrec`=$fechCorrec,
												`nc_ingAsig`=$ingAsig,
												`nc_respMed`=$medResp 
												WHERE `nc_medCorrecId`=$medId;

						/* row afect */
						set $rowAfect=(select ROW_COUNT());
						
						/*return*/
						return $rowAfect;
					end; 

				# ** New update 08/01/2015 - CLOSE **

					#  editar medida preventiva [nc_medPrev_edit] -> OK

						DELIMITER $$
						create function nc_medPrev_edit($idMed int(11),$desPrev varchar(1500),$fechPrev date)
						RETURNS int(11)
						COMMENT 'editar medida preventiva'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*edit prev*/
							update nc_medPreven set nc_medPrevDes=$desPrev,nc_medPrevFech=$fechPrev 
							where nc_medPrevId=$idMed; 

							/*row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;
						end;

			#Query Delete [Entidad] - [cru[D]]

				#_borrar informe adjunto [nc_infoAdju_borra]

					DELIMITER $$
					create function nc_infoAdju_borra($adjuId int(11))
					RETURNS int(11)
					COMMENT 'borrar informe adjunto'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*borra file adju*/
						delete from nc_adjuInfo where nc_adjuInfoId=$adjuId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

				#_borrar detalle de equipo [nc_detEquip_borra]

					DELIMITER $$
					create function nc_detEquip_borra($equiId int(11))
					RETURNS int(11)
					COMMENT 'borrar detalle de equipo'
					BEGIN

						/*vars*/
						declare $rowAfect int(11);

						/*borra det*/

						delete from nc_equiProye where nc_equiProyeId=$equiId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;

					end;

				#_borrar medida correctiva [nc_medCorrec_borra]

					DELIMITER $$
					create function nc_medCorrec_borra($medId int(11))
					RETURNS int(11)
					COMMENT 'borrar medida correctiva'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*borra med*/
						delete from nc_medCorrec where nc_medCorrecId=$medId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;
					end;

				# borrar no conformidad [nc_noConfor_borrar]

					DELIMITER $$
					create function nc_noConfor_borrar($conforId int(11))
					RETURNS int(11)
					COMMENT 'borrar no conformidad'
					BEGIN
						/*vars*/
						declare $rowAfect int(11);

						/*borra no confor*/
						delete from nc_noConfor where nc_noConforId=$conforId;

						/*row afect*/
						set $rowAfect=(select ROW_COUNT());

						/*return*/
						return $rowAfect;
					end;

				# ** New Update 08/01/2015 - CLOSE **

					# borrar medida preventiva por id [nc_medPrevxId_borra] -> OK

						DELIMITER $$
						create function nc_medPrevxId_borra($medId int(11))
						RETURNS int(11)
						COMMENT 'borrar medida preventiva por id'
						BEGIN
							/*vars*/
							declare $rowAfect int(11);

							/*borra med*/
							delete from nc_medPreven where nc_medPrevId=$medId;

							/*row afect*/
							set $rowAfect=(select ROW_COUNT());

							/*return*/
							return $rowAfect;
						end;


/*-------------------------------------------------------------------------------------------------------*/
	# MODULO SALUDO CUMPLEAÑOS TRABAJADOR [ct]
/*-------------------------------------------------------------------------------------------------------*/


	/* PERSISTENCIA */

		#PROCEDURE

			#New update 16/01/2015 - Open

				# obtener trabajadores de empresa ew [ct_trabEw_obte]

				DELIMITER $$
				create procedure ct_trabEw_obte()
				COMMENT 'obtener trabajadores de empresa ew'
				BEGIN

					/*vars*/

					/*obte trab ew*/
					select 
					concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as trabEw,
					per.pers_mail as trabEmail,
					per.pers_fecnac as trabFechNac,
					date_format(per.pers_fecnac,'%d-%M') as trabFecAbrev,
					date_format(per.pers_fecnac,'%d') as cumpDay,
					date_format(per.pers_fecnac,'%m') as cumpMes
					from 
					trabajador as trab,
					persona as per 
					where 
					trab.bestado=1 and 
					trab.trab_estado_id=1 and 
					trab.empresa_id=1 and
					per.persona_id=trab.persona_id and
					per.bestado=1 and per.pers_estado_id=1;

				end;

		#FUNCTION

/*----------------------------------------------[*]------------------------------------------------------*/

/*-------------------------------------------------------------------------------------------------------*/
	# EJEMPLOS
/*-------------------------------------------------------------------------------------------------------*/

	/* Ejemplo: como hacer un insert select   */
		insert into cc_detcentcost (cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_ocGeneId)
		select 1017,4,1,moneda_id,visiCorre from tbvisi_visita;

	/* Ejemplo: obtener la diferencia de una consulta */
		SELECT distinct
		visi.tbvisi_visita_id as visiId,
		visi.visiCorre
		from tbvisi_visita as visi
		where
		visi.tbvisi_visita_id not in (select tbvisi_visita_id from tbvisi_detalle_visita);

	/* Ejemplo: concatenar masivo de consulta */
		SELECT distinct
		GROUP_CONCAT(visi.visiCorre)
		from tbvisi_visita as visi
		where
		visi.tbvisi_visita_id not in (select tbvisi_visita_id from tbvisi_detalle_visita);

	/* Ejemplo: eliminar masivo concatenado de consulta */
		delete from cc_detcentcost where
		cc_ocGeneId in ('VI-1038','VI-1039','VI-1040','VI-1065','VI-1082','VI-1101','VI-1109','VI-1121','VI-1128','VI-1141','VI-1152');

	/* Ejemplo: Generar correlativo */

		select LPAD( 99, 5, '0' );

	/* Ejemplo: Mostrar estado de procedimientos y funciones */

		SHOW PROCEDURE STATUS LIKE '%scc%';
		SHOW FUNCTION STATUS LIKE '%scc%';

	/* Ejemplo: Mostrar estado general de BD */

		SHOW STATUS;

	/* Ejemplo: comentar una rutina procedure */

		DELIMITER $$
		CREATE PROCEDURE proc_name()
		COMMENT 'this is my comment'
		BEGIN
		/*here comes my voodoo*/
		END $$
		DELIMITER ;

	/* Ejemplo: mostrar columns de information shema */

		SHOW columns FROM information_schema.routines;

	/* Ejemplo: consultar campos de shema routines */
		
		SELECT specific_name,routine_definition,routine_type FROM information_schema.routines where routine_schema='tec-erp-2-dev';
		# definition no se puedo consultar [error al obtener.....!]
		SELECT specific_name,routine_type FROM information_schema.routines where routine_schema='tec-erp-2-dev';

	/* Ejemplo: obtener routines de bd especifica por filtro */

		SELECT routine_name,routine_schema,routine_type FROM information_schema.routines where routine_schema='tec-erp-2-dev';

		select routine_name,routine_schema,routine_type from information_schema.routines where routine_schema='tec-erp-2-dev' 
		and routine_name like '%scc%';

	/* Ejemplo: incrementar item en mysql */

		SET @numero=0;
		SELECT @numero:=@numero+1 AS `posicion`, `Emails`.* FROM `Emails`;

	/* Ejemplo: obtener hora actual */

		select date_format(NOW(),'%H:%i:%s');

	/* Ejemplo: obtener fecha actual */
		
		select date_format(NOW(),'%d/%m/%Y');

	/* Ejemplo: fecha actual */
		
		SELECT date_format(CURDATE(),'%d/%m/%Y');

	/* Ejemplo: Restar fecha y hora */
		
		SELECT DATE_SUB('1998-01-01 00:00:00',INTERVAL '1 1:1:1' DAY_SECOND);
		#-> '1997-12-30 22:58:59'

	/* Ejemplo: Sumar fecha y hora */
		SELECT DATE_ADD('1997-12-31 23:59:59',INTERVAL '1:1' MINUTE_SECOND);
		#-> '1998-01-01 00:01:00'

	/* Ejemplo: obtener diferencia de dias */
		
		SELECT DATEDIFF('1997-12-31 23:59:59','1997-12-30');

	/* Ejemplo: obtener fecha */
		SELECT DATE('2003-12-31 01:02:03');
		#-> '2003-12-31'

	/* Ejemplo: obtener hora */
		SELECT TIME('2003-12-31 01:02:03');
		#-> ''01:02:03'

	/* Ejemplo: evaluando operacion time */
		
		select case when time((TIME('23:30:00')+TIME('05:00:00')))>24 then 
		time((TIME('23:30:00')+TIME('05:00:00')-TIME('24:00:00'))) else 
		time((TIME('23:30:00')+TIME('05:00:00'))) end;

	/* Ejemplo: primer dia y ultimo dia de la semana */

		SELECT MAKEDATE(YEAR(NOW()),(1*7)),
		TIMESTAMPADD(DAY,(0-WEEKDAY(MAKEDATE(YEAR(NOW()),(1*7)))), 
		MAKEDATE(YEAR(NOW()),(1*7))) as PrimerDiaSemana,  
		TIMESTAMPADD(DAY,(6-WEEKDAY(MAKEDATE(YEAR(NOW()),(1*7)))), 
		MAKEDATE(YEAR(NOW()),(1*7))) as UltimoDiaSemana;

	/* Ejemplo: fecha separada */

		SELECT WEEKOFYEAR('2012-10-14') as Semana, 
		(WEEKDAY('2012-10-14')+1) as DiaSemana,
		DAYOFYEAR('2012-10-14') as DiaAnno, 
		DAYNAME('2012-10-14') as NombreDia,
		TIMESTAMPADD(DAY,(0-WEEKDAY('2012-10-14')),'2012-10-14') as PrimerDiaSemana,  
		TIMESTAMPADD(DAY,(6-WEEKDAY('2012-10-14')),'2012-10-14') as UltimoDiaSemana;

	/* Ejemplo: Rango de semana de determinada fecha */

		select 
		TIMESTAMPADD(DAY,(0-WEEKDAY('2014-06-10')),'2014-06-10') as PrimerDiaSemana,  
		TIMESTAMPADD(DAY,(6-WEEKDAY('2014-06-10')),'2014-06-10') as UltimoDiaSemana;

	/* Ejemplo: converter string in uppercase */
		select upper("string");
		select ucase("string");

	/* Ejemplo: converter string in lower */
		select lower("string");
		select lcase("string");

	/* Ejemplo: convert first caracter in upper */
		
		select CONCAT(UCASE(LEFT("cesar nicho", 1)),SUBSTRING("cesar nicho", 2));

	/* Ejemplo: hacer un update con inner join */
		UPDATE business AS b
		INNER JOIN business_geocode AS g ON b.business_id = g.business_id
		SET b.mapx = g.latitude,
		  b.mapy = g.longitude
		WHERE  (b.mapx = '' or b.mapx = 0) and
		  g.latitude > 0;

	/* Ejemplo: concatenar grupo de registros */
		
		select GROUP_CONCAT(sn_numSeri SEPARATOR '<br>');

	/* Ejemplo: crear un contador en sql */
	    SELECT
       (@a:=@a+1) contador,
       ...lista de campos...
       FROM tuTabla JOIN (SELECT @a:= 0) T

    /* Ejemplo: borrar una restriccion  */
    	
    	alter table mitabla drop foreign key nombre_indice_32d640;

    /* Ejemplo: separar correlativo de guia para formato final */
    	
    	select SUBSTRING_INDEX('0001-12345', '-', 1) as numGui1,SUBSTRING_INDEX('0001-12345', '-', -1) as numGui2;

    /* Ejemplo: obtener tamaño de cadena */
        select comp_nro,compras_id from compras where bestado=1 and empresa_id=1
		and LEFT(comp_nro, 2)='EW';

	/* Ejemplo: borrar registros con inner join */
		delete detNot
		from np_notPed as notPed 
		inner join np_detNot as detNot 
		where
		notPed.np_correNot='' and
		detNot.np_notPedid=notPed.np_notPedId;

	/* Ejemplo: convertir a mayuscula */
		
		update tabla set campo=UPPER(campo) where 1

	/* Ejemplo: convertir a minuscula */
		
		update tabla set campo=LOWER(campo) where 1

	/* Ejemplo: resumir tamaño de texto */

		select CONCAT(SUBSTRING('gestion de tramites financieros', 1, 12))

	/* Ejemplo: query dinamic en mysql */

		SET @skip=1;
		SET @rows=5;

		PREPARE STMT FROM 'SELECT * FROM table LIMIT ?, ?';
		EXECUTE STMT USING @skip, @rows;

	/*Ejemplo: uso de if en query*/

		SELECT IF(1>2,2,3);

	/*Ejemplo: reinicar auto_increment*/

		alter table nc_noConfor auto_increment=1;

/*---------------------------------------------[*]-------------------------------------------------------*/
				
				

			

		

	






	
	
	
	



