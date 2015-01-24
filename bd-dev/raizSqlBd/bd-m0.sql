/*--------------------------------------------------------*/
/*-----------SQL MODULO COBRANZAS STARTSOFT---------------*/
/*--------------------------------------------------------*/

alter table tipo_cambio
add column idTipCambio int(10) not null primary key auto_increment first; #old

alter table tipo_cambio
add column idTipCambio int(10) not null unique auto_increment first; #old

alter table ventas
add column idVentas int(10) not null unique auto_increment first; #old

select idTipCambio,tipocamb_compra,tipocamb_venta from tipo_cambio where idTipCambio=(select distinct last_insert_id() from tipo_cambio); #old

# añadir formato FP(Por facturar) a la tupla - tipo_de_documento

# añadir formato FN(factura cancelada) a la tupla - tipo_de_documento

# añadir formato FP(factura pediente) a la tupla - tipo_de_documento

# añadir formato FA(factura anulada) a la tupla - tipo_de_documento

# añadir columna idVentas a en tupla - ventas

# añadir columna idTipCambio a la tupla - tipo_cambio

# crear parametro de borrado co_l_delete

alter table ventas
add column co_l_delete char(1) after co_l_exonerado;


#-----FACTURA----------------
create table jn_factura(
co_id_fac int(11) primary key auto_increment not null,
est_idEst int(11),
co_c_subdi varchar(25),
co_d_fecha date,
co_c_clien varchar(11),
co_c_tpdoc varchar(2),
co_c_docum varchar(21),
co_c_moned varchar(2),
co_n_igv double(20,2),
co_n_igvus double(20,2),
co_n_tasa double(10,2),
co_n_monto double(20,2),
co_n_mtous double(20,2),
co_a_glosa varchar(30),
co_a_movim varchar(30)
);

#----DETALLE_FACTURA---------
create table jn_detalle_factura(
det_idDetFac int(11) primary key auto_increment not null,
co_id_fac int(11),
det_des varchar(50),
det_cant int(11),
det_pre_uni double(20,2),
det_total double(20,2)
);

#----ADELANTO FACTURA-------
create table jn_adelanto_factura(
ade_idAde int(11) primary key auto_increment not null,
co_id_fac int(11),
comp_idComp int(11),
ade_montAde double(20,2)
);

#------COMPROBANTE ADELANTO---------------
create table jn_comprobante(
comp_idComp int(11) primary key auto_increment not null,
tip_idTipComp varchar(2),
cuen_idCuenBan varchar(2),
comp_descrip varchar(50)
);

#-------TIPO COMPROBANTE-------------
/*
	create table tipo_comprobante(
	tip_idTipComp int(11) primary key auto_increment not null,
	tip_desTip varchar(50)
	)
*/

#---------ESTADO FACTURA------------------------
create table jn_estado_factura(
est_idEst int(11) primary key auto_increment not null,
est_des varchar(50)
);

alter table jn_detalle_factura
add constraint pk_co_id_fac foreign key (co_id_fac) references jn_factura(co_id_fac);

alter table jn_adelanto_factura
add constraint pk_co_id_fac2 foreign key (co_id_fac) references jn_factura(co_id_fac);

alter table jn_factura
add constraint pk_est_idEst foreign key (est_idEst) references jn_estado_factura(est_idEst);


 


