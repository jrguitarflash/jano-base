/*--------------------------------------------------------*/
create table tbrecla_reclamo (
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
    bestado char(1)
);

create table tbrecla_tipo_reclamo (
    idTipReclamo int(10) primary key auto_increment not null,
    desTipReclamo varchar(50)
);

create table tbrecla_proceso_reclamo (
    idProceReclamo int(10) primary key auto_increment not null,
    desProceReclamo varchar(50)
);

create table tbrecla_estado_reclamo (
    idEstaReclamo int(10) primary key auto_increment not null,
    desEstaReclamo varchar(50)
);

alter table tbrecla_reclamo
add constraint fk_idTipReclamo foreign key (idTipReclamo) references tbrecla_tipo_reclamo(idTipReclamo),
add constraint fk_idEstaReclamo foreign key (idEstaReclamo) references tbrecla_estado_reclamo(idEstaReclamo);
select 
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) as vendedor,
    per.persona_id
from
    persona as per,
    trabajador as trab,
    perfil as perf
where
    per.persona_id = trab.persona_id
        and trab.perfil_id = perf.perfil_id
        and perf.perfil_id = 6;

select 
    emp.emp_nombre, emp.empresa_id
from
    empresa as emp,
    empresa_perfil as perf,
    anfi_empresa as anf
where
    anf.empresa_id = emp.empresa_id
        and anf.emp_perfil_id = perf.empresa_perfil_id
        and anf.emp_perfil_id = 1;

select 
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) as contacto,
    per.persona_id
from
    persona as per,
    contacto as contac,
    empresa as emp
where
    contac.persona_id = per.persona_id
        and contac.empresa_id
        and emp.emp_nombre = 'ALE CONTRATISTAS S.A.';

select 
    *
from
    tbrecla_reclamo as recla
        inner join
    contacto as contac ON recla.idContacReclamo = contac.contacto_id
        inner join
    empresa as emp ON contac.empresa_id = emp.empresa_id
where
    emp.emp_nombre like '%min%';

select 
    *
from
    tbrecla_reclamo as recla
        inner join
    persona as per ON recla.idRespoReclamo = per.persona_id
where
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) like '%alex%';

alter table tbrecla_reclamo add desEmpReclamo varchar(200) after idProceReclamo; # old

alter table tbrecla_reclamo add acciReliReclamo varchar(2000) after acciReclamo; #old

alter table tbrecla_reclamo add adjuReclamo varchar(200) after acciReliReclamo; #old

alter table tbrecla_reclamo add idEmpReclamo int(10) after idProceReclamo; # old

alter table tbrecla_reclamo add fechReclamo date after acciReclamo; # old

alter table tbrecla_reclamo add idRespoReclamo int(10) after idPersoReclamo; # old

alter table tbrecla_reclamo add bestado char(1) after fechReclamo; # old

alter table tbrecla_reclamo add desReclamo varchar(2000) after idProceReclamo; # old

alter table tbrecla_reclamo change desEmpReclamo idEmpReclamo int(10);select 
    *
from
    tbvisi_visita
where
    tbvisi_visita_id = 12;select 
    mon.mon_nombre
from
    moneda as mon,
    tbvisi_visita as visi
where
    mon.moneda_id = visi.moneda_id
        and tbvisi_visita_id = 1; #old

alter table tbrecla_reclamo add correPor varchar(200) after bestado;SELECT 
    recla.desReclamo as des,
    recla.acciReclamo as acciOrde,
    recla.acciReliReclamo as acciReli,
    recla.fechReclamo as fechRecla,
    emp.emp_nombre as empNom,
    concat(per2.pers_nombres,
            ' ',
            per2.pers_apepat,
            ' ',
            per2.pers_apemat) as recep,
    concat(per1.pers_nombres,
            ' ',
            per1.pers_apepat,
            ' ',
            per1.pers_apemat) as respo
FROM
    `tbrecla_reclamo` as recla,
    empresa as emp,
    persona as per1,
    persona as per2,
    trabajador as trab
where
    emp.empresa_id = recla.idEmpReclamo
        and recla.idPersoReclamo = trab.trabajador_id
        and trab.persona_id = per2.persona_id
        and recla.idRespoReclamo = per1.persona_id;


/*---------------------------------------------------------------------------------*/
create table tbvisi_visita (
    tbvisi_visita_id int(10) not null auto_increment primary key,
    idVendeVisita int(10),
    fechIniVisi date,
    fechFinVisi date,
    moneda_id int(10),
    pasaVisi double (20 , 2 ),
    hospeVisi double (20 , 2 ),
    alimeVisi double (20 , 2 ),
    transInterVisi double (20 , 2 )
);

create table tbvisi_detalle_visita (
    idDetVisita int(10) not null auto_increment primary key,
    tbvisi_visita_id int(10),
    idContacVisita char(50),
    idEmpVisita int(10),
    obsVisita varchar(2000),
    obsPenVisita varchar(2000),
    direVisi varchar(200)
);


alter table  tbvisi_detalle_visita
add constraint fk_tbvisi_visita_id foreign key(tbvisi_visita_id) references tbvisi_visita(tbvisi_visita_id);

alter table tbvisi_detalle_visita add desEmpvisita varchar(200) after idContacVisita; #old

alter table tbvisi_detalle_visita change desEmpvisita desEmpVisita varchar(200); #old

alter table tbvisi_detalle_visita add idEmpVisita int(10) after idContacVisita; #old

alter table tbvisi_detalle_visita add obsPenVisita varchar(2000) after obsVisita; #old

alter table tbvisi_detalle_visita change obsVisitaPen obsPenVisita varchar(2000);	#old

alter table tbvisi_detalle_visita change idContacVisita idContacVisita char(50);	select 
    pers_mail
from
    persona
where
    concat(pers.nombres,
            ' ',
            pers.apepat,
            ' ',
            pers.apemat) = 'Ulises Ubillus Galarreta'; #old

alter table tbvisi_visita add moneda_id int(10) after fechFinVisi; #old

alter table tbvisi_visita add pajaVisi double(20,2) after moneda_id; #old

alter table tbvisi_visita add hospeVisi double(20,2) after pajaVisi; #old

alter table tbvisi_visita add alimeVisi double(20,2) after hospeVisi; #old

alter table tbvisi_visita add transInterVisi double(20,2) after alimeVisi; #old

alter table tbvisi_visita change pajaVisi pasaVisi double(20,2);update tbvisi_visita 
set 
    moneda_id = 1,
    pasaVisi = 20,
    hospeVisi = 20,
    alimeVisi = 20,
    transInterVisi = 20
where
    tbvisi_visita_id = 8; #old

insert into empresa (emp_ruc,emp_nombre,emp_email,emp_web,emp_direccion,emp_telef) values ('1223','jose','ss','ss','ss','ss'); #old

alter table tbvisi_visita add direVisi varchar(200) after transInterVisi; #old

alter table tbvisi_visita drop column direVisi; #old

alter table tbvisi_detalle_visita add direVisi varchar(200) after obsPenVisita;select 
    detVisi.obsVisita as obs,
    detVisi.obsPenVisita as obsPen,
    detVisi.direVisi as dire,
    emp.emp_nombre as emp,
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) as vend
from
    tbvisi_detalle_visita as detVisi,
    empresa as emp,
    tbvisi_visita as visi,
    persona as per
where
    detVisi.idEmpVisita = emp.empresa_id
        and detVisi.obsVisita != 'ee'
        and visi.tbvisi_visita_id = detVisi.tbvisi_visita_id
        and visi.idVendeVisita = per.persona_id;


/*------------------------------------------------------------------*/
UPDATE `tec-erp-2`.`tabla` 
SET 
    `reg_accion1` = '2'
WHERE
    `tabla`.`tabla_id` = 205;

/* ------------------------------------------------------------------- */
CREATE TABLE IF NOT EXISTS `recurso`;
CREATE TABLE IF NOT EXISTS `trabajador`;

/* ---------------------------------------------------------------- */
create table tbcu_cuxcobra (
    idCuxCobra int(10) not null auto_increment primary key,
    idEmpCli int(10),
    numCompro char(25),
    idTipMone int(10),
    idTipDoc int(10),
    impor decimal(20 , 2 ),
    descrip varchar(2000),
    fecha date
);

create table tbcu_det_cuxcobra (
    idDetxCobra int(10) not null auto_increment primary key,
    idCuxCobra int(10),
    fecha date,
    monto decimal(20 , 2 ),
    idCuBanco int(10),
    idCuEstado int(10)
);

create table tbcu_tipdoc (
    idTipDoc int(10) not null auto_increment primary key,
    descrip varchar(50)
);

create table tbcu_esta (
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
 
	
select distinct
    cuen.cuenta_nro, cuen.cuenta_id
from
    v_cuenta as cuen,
    tbcu_det_cuxcobra as detxcobra,
    banco as ban
where
    cuen.banco_id = ban.banco_id
        and cuen.banco_id = 1;

SELECT 
    *
FROM
    `tbcu_cuxcobra`
where
    idCuxCobra = 1;


/* ---------------------------------------------------------------------------------------*/
create table tbobs_observ (
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

create table tbobs_conforImp (
    idConforImp int(10) primary key not null auto_increment,
    desConfir char(2)
);

create table tbobs_conforEfec (
    idConforEfec int(10) primary key not null auto_increment,
    desConfir char(2)
);

create table tbobs_conforAc (
    idConforAc int(10) primary key not null auto_increment,
    desConfir char(2)
);

create table tbobs_tip_observ (
    idTipObserv int(10) primary key not null auto_increment,
    desTipObser varchar(20)
);

create table tbobs_format (
    idCodFormat int(10) primary key not null auto_increment,
    correCodFormat char(15)
);

create table tbobs_versi (
    idCodVersi int(10) primary key not null auto_increment,
    desVersi varchar(20)
);

create table tbobs_pag (
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


SELECT 
    *
FROM
    `compras`
WHERE
    comp_nro LIKE '%EW%';

SELECT 
    *
FROM
    `compras`
WHERE
    comp_nro LIKE '%EW%'
        and date_format(comp_fecha_ini, '%Y') = 2013;

SELECT 
    *, empresa.emp_nombre
FROM
    `compras`,
    empresa
WHERE
    compras.comp_nro LIKE '%EW%'
        AND date_format(comp_fecha_ini, '%Y') = 2013
        AND empresa.empresa_id = compras.proveedor_id;


SELECT distinct
    comp.compras_id as Item,
    emp.emp_nombre as cliente,
    comp.comp_nro as EW,
    date_format(comp.comp_fecha_ini, '%d/%m/%Y') as fecha,
    (CASE
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 1) THEN 'ENERO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 2) THEN 'FEBRERO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 3) THEN 'MARZO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 4) THEN 'ABRIL'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 5) THEN 'MAYO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 6) THEN 'JUNIO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 7) THEN 'JULIO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 8) THEN 'AGOSTO'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 9) THEN 'SETIEMBRE'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 10) THEN 'OCTUBRE'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 11) THEN 'NOVIEMBRE'
        WHEN (date_format(comp.comp_fecha_ini, '%m') = 12) THEN 'DICIEMBRE'
        ELSE ''
    END) AS mes,
    format(sum(prod_precio_venta), 2) AS monto,
    mon_sigla as mon,
    (case
        when
            (mon.moneda_id = 1)
        then
            format(sum(prod_precio_venta / 2.808),
                2)
        when (mon.moneda_id = 2) then format(sum(prod_precio_venta), 2)
        when
            (mon.moneda_id = 3)
        then
            format((sum(prod_precio_venta) / 0.731035),
                2)
        else ''
    end) AS montoDolares,
    '$' as moneDolar
FROM
    `compras` AS comp,
    empresa AS emp,
    compras_detalle AS detComp,
    moneda as mon
WHERE
    (comp.comp_nro LIKE '%OC-2014%'
        or comp.comp_nro LIKE '%EW-2014%')
        AND (date_format(comp.comp_fecha_ini, '%Y') = 2013
        or date_format(comp.comp_fecha_ini, '%Y') = 2014)
        AND emp.empresa_id = comp.proveedor_id
        AND comp.compras_id = detComp.compras_id
        and detComp.moneda_id = mon.moneda_id
        and CHAR_LENGTH(comp.comp_nro) = 14
        and detComp.bestado = 1
        and comp.bestado = 1
group BY comp.compras_id
order by emp.emp_nombre;

# agregar el campo prod_descripcion_obre

alter table compras_detalle add prod_descripcion_obra varchar(100) after `comp_det_adjudicado`;


/*----------------------------------------------------------------*/
select 
    prof.imp_prof_nro as numFl, prof.imp_proforma_id as codFl
from
    imp_proforma_detalle as profDet,
    imp_proforma as prof,
    cotizacion as cotiz,
    cot_detalle as cotDet
where
    cotiz.cotizacion_id = 1488
        and cotiz.cotizacion_id = cotDet.cotizacion_id
        and cotDet.cot_detalle_id = profDet.cot_detalle_id
        and profDet.imp_proforma_id = prof.imp_proforma_id
        and cotiz.bestado = 1
        and (profDet.bestado = 1
        or profDet.bestado = null)
GROUP BY cotDet.cot_detalle_id;


select 
    sum(profDet.prod_ew_valor) as exwork,
    sum(profDet.prod_fob_valor) as fob,
    sum(profDet.prod_cif_valor) as cif,
    sum(profDet.prod_cif_valor + profDet.prod_nac_valor) as ddp
from
    imp_proforma_detalle as profDet,
    imp_proforma as prof,
    cotizacion as cotiz
where
    cotiz.cotizacion_id = 1488
        and cotiz.cotizacion_id = prof.cotizacion_id
        and profDet.imp_proforma_id = prof.imp_proforma_id
        and cotiz.bestado = 1
        and (profDet.bestado = 1
        or profDet.bestado = null)
GROUP BY prof.imp_proforma_id;


select 
    sum(profDet.prod_ew_valor) as exwork,
    sum(profDet.prod_fob_valor) as fob,
    sum(profDet.prod_cif_valor) as cif,
    sum(profDet.prod_cif_valor + profDet.prod_nac_valor) as ddp
from
    imp_proforma_detalle as profDet,
    imp_proforma as prof,
    cotizacion as cotiz
where
    cotiz.cotizacion_id = prof.cotizacion_id
        and profDet.imp_proforma_id = prof.imp_proforma_id
        and prof.imp_proforma_id = 1130
        and cotiz.bestado = 1
        and (profDet.bestado = 1
        or profDet.bestado = null)
GROUP BY prof.imp_proforma_id;

/* FL DE COTIZACIONES */

SELECT 
    coti.cot_nro,
    coti.cot_fec_emis,
    emp.emp_nombre,
    proye.proy_nombre,
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) as vende,
    (CASE
        WHEN (date_format(coti.cot_fec_emis, '%m') = 1) THEN 'ENERO'
        WHEN (date_format(coti.cot_fec_emis, '%m') = 2) THEN 'FEBRERO'
        ELSE ''
    END) AS mes,
    cotEst.cot_estado_nombre as cotEstDes
FROM
    `cotizacion` AS coti
        INNER JOIN
    cot_estado as cotEst ON coti.cot_estado_id = cotEst.cot_estado_id
        INNER JOIN
    proyecto AS proye ON coti.proyecto_id = proye.proyecto_id
        INNER JOIN
    empresa AS emp ON coti.cliente_id = emp.empresa_id
        inner join
    trabajador as trab ON trab.trabajador_id = coti.operador_id
        inner join
    persona as per ON trab.persona_id = per.persona_id
WHERE
    date_format(coti.cot_fec_emis, '%Y') = '2014'
        and coti.empresa_id = 1
        and coti.bestado = 1
        and date_format(coti.cot_fec_emis, '%m') >= 1;

# redonde que detalle de cotizaciones
	#round(pro_precio_venta)

/* -------------------------------------------------------------- */
/*  ACTUALIZACION DEL MODULO DE ORDER DE COMPRAS */
/* -------------------------------------------------------------- */

# añadir campo descuento a formulario ordenes

# añadir el campo coti_fl en compras

	alter table compras 
	add column coti_fl int(10) after comp_version;

/* ----------------------------------------------------------------------- */
	create table vaca_perioAn (
    vaca_perioAn_id int(11) primary key auto_increment not null,
    vaca_anPeri int(4),
    vaca_desPeri varchar(50),
    vaca_estado_id int(11)
);

create table vaca_vaca (
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

create table vaca_estado (
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
    DATEDIFF(vaca.`vaca_mesGocFin`,
            vaca.`vaca_mesGocIni`) as diGoc,
    (case
        when (DATEDIFF(vaca.`vaca_mesGocFin`, CURDATE()) < 0) then '0'
        else DATEDIFF(vaca.`vaca_mesGocFin`, CURDATE())
    end) as diPen,
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) as trab
FROM
    `vaca_vaca` as vaca,
    persona as per,
    vaca_perioan as peri
where
    per.persona_id = vaca.vaca_trabId
        and vaca.vaca_perioAn_id = peri.vaca_perioAn_id
        and peri.vaca_anPeri = '2012';

select 
    vaca_mesGocIni as fechOri,
    DATE_ADD(vaca_mesGocIni,
        INTERVAL 1 YEAR) as fechModi
from
    vaca_vaca
where
    vaca_vaca_id = 22;

	select 
    trab.trab_fec_ini as fechOri,
    date_format(DATE_ADD(trab.trab_fec_ini,
                INTERVAL 1 YEAR),
            '%d/%m/%Y') as fechModi
from
    persona as per,
    trabajador as trab
where
    per.persona_id = trab.persona_id
        and per.persona_id = 18;

select 
    sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1) as sumDi
from
    vaca_vaca
where
    vaca_perioAn_id = '3'
        and vaca_trabId = '448';

SELECT distinct
    vaca_forCal
FROM
    `vaca_vaca`
where
    vaca_trabId = '448'
        and vaca_perioAn_id = '3';

select 
    case
        when (isNull(sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1))) then '0'
        else sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1)
    end as sumDi
from
    vaca_vaca
where
    vaca_trabId = '360'
        and vaca_perioAn_id = '3';

	select 
    case
        when (isNull(sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1))) then '0'
        when ((sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1)) < vaca_forCal) then sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1)
        else sum(DATEDIFF(`vaca_mesGocFin`, `vaca_mesGocIni`) + 1)
    end as sumDi
from
    vaca_vaca
where
    vaca_trabId = '360'
        and vaca_perioAn_id = '3';

select 
    DATEDIFF('2014-03-31', '2014-03-01') + 1 as difDias,
    '2014-03-01' as fechIni,
    '2014-03-31' as fechFin;

select 
    DATE_ADD('2014-03-31', INTERVAL 1 DAY) as fechIncre,
    DAYNAME(DATE_ADD('2014-03-31', INTERVAL 1 DAY)) as nomDia;

/*---------------------------------------------------------*/
	SELECT distinct
    emp.emp_ruc,
    emp.emp_nombre,
    emp.emp_web,
    emp.emp_direccion,
    emp.emp_telef,
    perf.nombre
FROM
    `empresa` as emp,
    anfi_empresa as anf,
    empresa_perfil as perf
where
    anf.empresa_id = emp.empresa_id
        and perf.empresa_perfil_id = anf.emp_perfil_id;

/* -------------------------------------------------------- */
	select 
    concat((select 
                    m.mm_alias
                from
                    mm m
                where
                    (m.mm_id = mm.mm_id_padre)),
            '. ',
            mm.mm_nombre) as marca_modelo,
    (select 
            m.mm_alias
        from
            mm m
        where
            (m.mm_id = mm.mm_id_padre)) as marca,
    mm.mm_nombre as modelo
from
    mm
where
    (mm.mm_id_padre > 0);

	select 
    cotizacion_id, cot_nro
from
    cotizacion
where
    cot_estado_id = '2' and empresa_id = '1'
        and bestado = 1;

	SELECT 
    prod_nombre
FROM
    `producto`
where
    marca_id > 0 and modelo_id > 0
        and empresa_id = 1
        and bestado = 1;

	SELECT 
    prod_nombre
FROM
    `producto`
where
    empresa_id = 1;

	SELECT 
    emp.emp_nombre,
    coti.cot_descrip,
    coti.cot_nro,
    proye.proy_nombre,
    coti.cotizacion_id
FROM
    cotizacion as coti,
    empresa as emp,
    proyecto as proye
WHERE
    coti.cot_nro LIKE '%FL-12-0248-3%'
        and coti.cliente_id = emp.empresa_id
        and coti.proyecto_id = proye.proyecto_id;

	SELECT 
    cotDet.cot_detalle_id as cotDetId,
    cotDet.cotizacion_id,
    prod.producto_id as prodId,
    (select 
            marca_id
        from
            producto
        where
            producto_id = prodId) as marcaId,
    (select 
            modelo_id
        from
            producto
        where
            producto_id = prodId) as modeloId,
    prodClas.prod_clasif_nombre,
    prod.prod_nombre,
    (select 
            mm_nombre
        from
            mm
        where
            mm_id = marcaId) as marca,
    (select 
            mm_nombre
        from
            mm
        where
            mm_id = modeloId) as modelo,
    (select distinct
            emp.emp_nombre
        from
            empresa as emp,
            imp_proforma_detalle as profDet,
            cot_detalle as cotDet,
            imp_proforma as prof
        where
            emp.empresa_id = prof.proveedor_id
                and prof.imp_proforma_id = profDet.imp_proforma_id
                and profDet.cot_detalle_id = cotDetId) as proveedor,
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
    cotDet.cotizacion_id = 442
        and cotDet.producto_id = prod.producto_id
        and cotDet.bestado = 1
        and cotDet.moneda_id = mone.moneda_id
        and prod.prod_clasificacion_id = prodClas.prod_clasificacion_id;

	select 
    prod_clasificacion_id as clasId,
    prod_clasif_nombre as clasNom
from
    prod_clasificacion;

	SELECT 
    moneda_id, mon_sigla
FROM
    `moneda`;

	create table cc_centCost (
    cc_centCostId int(11) primary key not null auto_increment,
    cc_correCentCost char(15),
    cc_cotiFlId int(11),
    cc_ocGeneId int(11)
);

		create table cc_centCost (
    cc_centCostId int(11) primary key not null auto_increment,
    cc_correCenCost char(15),
    cc_cotiFlId int(11),
    cc_idCliEmp int(11),
    cc_idProye int(11),
    cc_ocCli varchar(25),
    cc_ocFechCli date,
    cc_montCoti decimal(20 , 2 ),
    cc_moneId int(11),
    cc_idEstApe int(11),
    empresa_id int(10) default '1',
    bestado int(10) default '1',
    cc_fileAdju varchar(200) default ''
);

		create table cc_detCentCost (
    cc_detCentCostId int(11) primary key not null auto_increment,
    cc_centCostId int(11),
    cc_tipOrden int(11),
    cc_provId int(11),
    cc_moneId int(11),
    cc_plazo int(11),
    cc_ocGeneId char(15),
    cc_idEstCost int(11),
    cc_desOrd varchar(70),
    cc_tipPre int(11)
);

		create table cc_estaCentCost (
    cc_idEstCost int(11) primary key not null auto_increment,
    cc_desEstCost varchar(70)
);

		create table cc_estaApeProye (
    cc_idEstApe int(11) primary key not null auto_increment,
    cc_desEstApe varchar(20)
);

		# Restricciones

		alter table cc_detCentCost
		add constraint fk_cc_centCostId foreign key (cc_centCostId) references cc_centCost(cc_centCostId),
		add constraint fk_cc_idEstCost foreign key (cc_idEstCost) references cc_estaCentCost(cc_idEstCost);

		alter table cc_centCost
		add constraint fk_cc_idEstApe foreign key (cc_idEstApe) references cc_estaApeProye(cc_idEstApe);
		

	SELECT 
    cc.cc_centCostId as item,
    cc.cc_correCentCost as pc,
    coti.cot_nro as fl,
    coti.cotizacion_id as flId,
    comp.comp_nro as oc_ew,
    comp.compras_id as oc_ew_id,
    (case
        when (LEFT(comp.comp_nro, 2) = 'OC') then concat('GenerarOCLPDF(', comp.compras_id, ')')
        else concat('GenerarOCPDF(', comp.compras_id, ')')
    end) as popDetOc
FROM
    cc_centcost as cc
        inner join
    compras as comp ON cc.cc_ocGeneId = comp.compras_id
        inner join
    cotizacion as coti ON cc.cc_cotiFlId = coti.cotizacion_id;


	SELECT distinct
    coti.cot_nro
FROM
    cc_centcost as cc,
    cotizacion as coti
where
    cc.cc_cotiFlId = coti.cotizacion_id;

	SELECT 
    cc.cc_centCostId as item,
    cc.cc_correCentCost as pc,
    coti.cot_nro as fl,
    coti.cotizacion_id as flId,
    comp.comp_nro as oc_ew,
    comp.compras_id as oc_ew_id,
    (case
        when (LEFT(comp.comp_nro, 2) = 'OC') then concat('GenerarOCLPDF(', comp.compras_id, ')')
        else concat('GenerarOCPDF(', comp.compras_id, ')')
    end) as popDetOc
FROM
    cc_centcost as cc
        inner join
    compras as comp ON cc.cc_ocGeneId = comp.compras_id
        inner join
    cotizacion as coti ON cc.cc_cotiFlId = coti.cotizacion_id
where
    coti.cot_nro = 'FL-12-0243-2';

	SELECT 
    empresa_id as idCli
FROM
    `empresa`
where
    emp_nombre = 'TECSUR S.A.';

	# enviar set detalle de proyecto creado
	insert into cc_detcentcost(cc_centCostId,cc_idEstCost,cc_tipOrden,cc_provId,cc_moneId,cc_plazo,cc_desOrd)
	values('','','','','','','');

	SELECT 
    cc_correCenCost
FROM
    `cc_centcost`;

	SELECT 
    centCost.cc_centCostId as idCent,
    centCost.cc_correCenCost as correCen,
    coti.cot_nro as cotNum
FROM
    cc_centcost as centCost,
    cotizacion as coti
where
    centCost.cc_cotiFlId = coti.cotizacion_id;

	SELECT 
    cenCost.cc_detCentCostId,
    cenCost.cc_tipOrden,
    cenCost.cc_desOrd
FROM
    cc_detcentcost as cenCost
where
    cenCost.cc_idEstCost = '2';

	SELECT 
    detCenCost.cc_detCentCostId,
    detCenCost.cc_tipOrden,
    detCenCost.cc_desOrd
FROM
    cc_detcentcost as detCenCost
where
    detCenCost.cc_idEstCost = '2'
        and detCenCost.cc_centCostId = '4';

	SELECT 
    detCent.cc_provId,
    centCost.cc_idProye,
    detCent.cc_moneId,
    centCost.cc_cotiFlId,
    centCost.cc_ocFechCli,
    detCent.cc_tipOrden
FROM
    cc_detcentcost as detCent,
    cc_centcost as centCost
where
    detCent.cc_detCentCostId = '12'
        and detCent.cc_centCostId = centCost.cc_centCostId;

	update cc_detcentcost 
set 
    cc_idEstCost = 1
where
    cc_detCentCostId = '';

	SELECT 
    centCost.cc_correCenCost as pcVal,
    coti.cot_nro as flVal,
    emp.emp_nombre as cliEmp,
    proye.proy_nombre as proyNom,
    centCost.cc_ocCli as ocCli,
    centCost.cc_ocFechCli as ocCliFech
FROM
    cc_centcost as centCost,
    cotizacion as coti,
    empresa as emp,
    proyecto as proye
where
    centCost.cc_cotiFlId = coti.cotizacion_id
        and centCost.cc_idProye = proye.proyecto_id
        and centCost.cc_idCliEmp = emp.empresa_id
        and centCost.cc_centCostId = 12;


	SELECT 
    `cc_detCentCostId`,
    `cc_centCostId`,
    `cc_tipOrden`,
    `cc_provId`,
    `cc_moneId`,
    `cc_plazo`,
    `cc_ocGeneId`,
    `cc_idEstCost`,
    `cc_desOrd`
FROM
    `cc_detcentcost`
WHERE
    `cc_idEstCost` = 2
        and `cc_centCostId` = '9';

	SELECT 
    `cc_detCentCostId`,
    `cc_centCostId`,
    `cc_tipOrden`,
    `cc_provId`,
    `cc_moneId`,
    `cc_plazo`,
    `cc_ocGeneId`,
    `cc_idEstCost`,
    `cc_desOrd`
FROM
    `cc_detcentcost`
WHERE
    `cc_idEstCost` = 2
        and `cc_centCostId` = ''
        and `cc_detCentCostId` = '';

	update `cc_detcentcost` 
set 
    `cc_tipOrden` = '',
    `cc_provId` = '',
    `cc_moneId` = '',
    `cc_plazo` = '',
    `cc_desOrd` = ''
WHERE
    `cc_detCentCostId` = '';

	delete from cc_detcentcost 
where
    cc_detCentCostId = '35';

	SELECT 
    coti.moneda_id as moneId
FROM
    `cotizacion` as coti
where
    coti.cot_nro = 'FL-12-0243-2';

	select 
    sum(cotDet.pro_cantidad * cotDet.pro_precio_venta) as totCoti
from
    cot_detalle as cotDet
where
    cotDet.bestado = 1
        and cotDet.cotizacion_id = 5;

	# añadir columna monto y moneda a tupla centro de costo
	alter table cc_centCost
	add cc_montCoti decimal(20,2) after cc_ocFechCli,
	add cc_moneId int(11) after cc_montCoti;

	# añadir columna estado apertura en tupla centro de costo
	alter table cc_centCost
	add cc_idEstApe int(11) after cc_moneId;

	update cc_centcost 
set 
    cc_idEstApe = 1;

	# modificar campo coti_fl de compras [NEW COLUMN COMPRAS]
	alter table compras change coti_fl pc_id int(10);
	alter table compras add comp_plazo int(11) after pc_id;

	# añadir campo empresa_id a centro de costos
	alter table cc_centcost
	add empresa_id int(10) default '1' after cc_idEstApe;

	# añadir el campo bestado a centro de costo
	alter table cc_centcost
	add bestado int(10) default '1' after empresa_id;

	select 
    cc_centCostId as idCentCost,
    (select 
            sum(compDet.prod_cantidad * compDet.prod_precio_venta)
        from
            compras as comp,
            compras_detalle as compDet
        where
            comp.pc_id = idCentCost
                and comp.compras_id = compDet.compras_id
                and comp.moneda_id = 1) as totSoles,
    (select 
            sum(compDet.prod_cantidad * compDet.prod_precio_venta)
        from
            compras as comp,
            compras_detalle as compDet
        where
            comp.pc_id = idCentCost
                and comp.compras_id = compDet.compras_id
                and comp.moneda_id = 2) as totDolares,
    (select 
            sum(compDet.prod_cantidad * compDet.prod_precio_venta)
        from
            compras as comp,
            compras_detalle as compDet
        where
            comp.pc_id = idCentCost
                and comp.compras_id = compDet.compras_id
                and comp.moneda_id = 3) as totHebros
from
    cc_centcost
where
    cc_centCostId = '44';

	update cc_detcentcost as detCent,
    compras as comp 
set 
    detCent.cc_provId = '',
    detCent.cc_moneId = ''
where
    comp.comp_nro = detCent.cc_ocGeneId
        and comp.compras_id = '';

	update cc_detcentcost as detCent,
    compras as comp 
set 
    detCent.cc_provId = $proveedor_id,
    detCent.cc_moneId = $moneda_id
where
    comp.comp_nro = detCent.cc_ocGeneId
        and comp.compras_id = $compras_id;

	update cc_centcost 
set 
    cc_ocCli = '',
    cc_ocFechCli = '',
    cc_montCoti = '',
    cc_moneId = ''
where
    cc_centCostId = '';

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

	select 
    estProye.cc_desEstApe as estaProye
from
    cc_centcost as cenCost,
    cc_estaapeproye as estProye
where
    cenCost.cc_idEstApe = estProye.cc_idEstApe
        and cenCost.cc_centCostId = 56;

	select 
    cc_idEstApe as idEstApe, cc_desEstApe as desEstApe
from
    cc_estaapeproye;

	select 
    operador_id as opId,
    (select 
            trab_usuario
        from
            trabajador
        where
            trabajador_id = opId) as user
from
    acceso_log
where
    date(acc_log_fecha_ini) between '2014-04-01' and '2014-04-01';


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

	SELECT 
    imp_tc_nombre tipPrec
FROM
    `imp_tipo_costo`
where
    imp_tipo_costo_id = '3';

	# inciar correlativo centro de costo en 1000
	alter table cc_centcost auto_increment=1000;


	/* ----------------------------------------------------- */
		create table mp_movi (
    mp_moviId int(11) primary key auto_increment not null,
    mp_userPerId int(11),
    mp_fechSali date,
    mp_areTrabId int(11),
    mp_fechRetor date
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
    mp_desTipAprob varchar(50)
);


	create table mp_validDetMov (
    mp_validDetMovId int(11) primary key auto_increment not null,
    mp_detMovId int(11),
    mp_userAdmId int(11),
    mp_tipAprobId int(11),
    mp_fechValid datetime
);

	# Restricciones
	alter table mp_detMov
	add constraint fk_mp_moviId foreign key(mp_moviId) references mp_movi(mp_moviId);

	alter table mp_validDetMov
	add constraint fk_mp_detMovId foreign key (mp_detMovId) references mp_detMov(mp_detMovId),
	add constraint fk_mp_tipAprobId foreign key (mp_tipAprobId) references mp_tipAprob(mp_tipAprobId);

	select 
    funTrab.trab_funcion_nombre as funDes
from
    trabajador as trab
        inner join
    trab_funcion as funTrab ON trab.trab_funcion_id = funTrab.trab_funcion_id
where
    trab.trabajador_id = '1';

	# añadir movimiento general de personal
	insert into mp_movi(mp_userPerId,mp_areTrabId,mp_fechSali,mp_fechRetor) values ('','','','');

	# añadir detalle de movimiento de personal
	insert into mp_detmov(mp_moviId,mp_motiv,mp_ubi,mp_det) values (1,'','','');

	select 
    trab.trabajador_id as trabId,
    trabFun.trab_funcion_id as areId
from
    trabajador as trab
        inner join
    trab_funcion as trabFun ON trab.trab_funcion_id = trabFun.trab_funcion_id
where
    trab.trabajador_id = '11';

	select 
    movPer.mp_moviId as item,
    concat(per.pers_nombres,
            ' ',
            per.pers_apepat,
            ' ',
            per.pers_apemat) as user,
    trabFun.trab_funcion_nombre as are,
    movPer.mp_fechSali as fechSali,
    movPer.mp_fechRetor as fechRetor,
    (select 
            count(mp_moviId)
        from
            mp_detmov
        where
            mp_moviId = item) as cantMov
from
    mp_movi as movPer
        inner join
    mp_detmov as detMov ON detMov.mp_moviId = movPer.mp_moviId
        inner join
    trabajador as trab ON trab.trabajador_id = movPer.mp_userPerId
        inner join
    trab_funcion as trabFun ON trabFun.trab_funcion_id = trab.trab_funcion_id
        inner join
    persona as per ON per.persona_id = trab.persona_id
group by movPer.mp_moviId
order by movPer.mp_moviId desc;


	select 
    detMov.mp_detMovId as item,
    detMov.mp_motiv as motiv,
    detMov.mp_ubi as ubi,
    detMov.mp_det as det,
    (select 
            count(mp_detMovId)
        from
            mp_validdetmov
        where
            mp_detMovId = item) as cantVali
from
    mp_detmov as detMov
where
    detMov.mp_moviId = '3';

	# validar movimientos seleccionado
	insert into mp_validdetmov(mp_fechValid,mp_detMovId,mp_tipAprobId,mp_userAdmId)
	values ('',1,1,'');

	SELECT 
    tipAprob.mp_desTipAprob as desAprob,
    concat(per.pers_nombres,
            ' ',
            per.pers_apemat,
            ' ',
            per.pers_apepat) as userAdm,
    validDet.mp_fechValid as fechVali
FROM
    mp_validdetmov as validDet,
    trabajador as trab,
    persona as per,
    mp_tipaprob as tipAprob
where
    validDet.mp_tipAprobId = 1
        and validDet.mp_detMovId = 4
        and trab.trabajador_id = validDet.mp_userAdmId
        and trab.persona_id = per.persona_id
        and tipAprob.mp_tipAprobId = validDet.mp_tipAprobId;

	SELECT 
    tipAprob.mp_desTipAprob as desAprob,
    concat(per.pers_nombres,
            ' ',
            per.pers_apemat,
            ' ',
            per.pers_apepat) as userAdm,
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


	
	
	
	



