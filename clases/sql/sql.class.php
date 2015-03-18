<?php 
class sql
{

//------------------------------------//
//-----------SQL OPERACIONES----------// 
//------------------------------------//

/*-------------------------------------------------------------*/
	# SQL MODULO RECLAMOS
/*-------------------------------------------------------------*/

	public function tbl_trabajador()
	{
		$sql="select * from trabajador";
		return $sql;
	}

	public function getPerfil($id)
	{
		$sql="select perfil_nombre from perfil where perfil_id='".$id."'";
		return $sql;
	}

	public function getTipReclamo()
	{
		$sql="select idTipReclamo,desTipReclamo from tbrecla_tipo_reclamo";
		return $sql;
	}

	public function getTrabVendedor()
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vendedor,per.persona_id 
				from persona as per,trabajador as trab,perfil as perf where per.persona_id=trab.persona_id and
				trab.perfil_id = perf.perfil_id and (perf.perfil_id=6 or perf.perfil_id=2) and trab.empresa_id=1 and per.bestado=1";
		return $sql;
	}

	public function getTrabVendRecla()
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vendedor,per.persona_id 
				from persona as per,trabajador as trab,perfil as perf where per.persona_id=trab.persona_id and
				trab.perfil_id = perf.perfil_id and perf.perfil_id!=6 and trab.empresa_id=1";
		return $sql;
	}

	public function getTrabxId($id)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vendedor
				from persona as per,trabajador as trab,perfil as perf where per.persona_id=trab.persona_id and
				trab.perfil_id = perf.perfil_id and trab.trabajador_id='".$id."'";
		return $sql;
	}

	public function getEmpCliente()
	{
		$sql="select distinct emp.emp_nombre,emp.empresa_id from empresa as emp,empresa_perfil as perf,anfi_empresa as anf
				where anf.empresa_id=emp.empresa_id and anf.emp_perfil_id=perf.empresa_perfil_id and anf.emp_perfil_id=1";
		return $sql;
	}

	public function getContacxCli($cli)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as contacto,per.persona_id
				from persona as per,contacto as contac,empresa as emp where contac.persona_id=per.persona_id and 
				contac.empresa_id=emp.empresa_id and emp.emp_nombre='".$cli."'";
		return $sql;
	}

	public function getEmailxId($id)
	{
		$sql="select pers_mail from persona where persona_id='".$id."'";
		return $sql;
	}

	public function insertRecla($tip,$fech,$contac,$recep,$respon,$respon2,$enviResp,$enviResp2,$des,$acci,$acciReli,$adjuRecla,$esta,$idEmp,$correPor,$obsId)
	{
		$sql="insert into tbrecla_reclamo(idTipReclamo,fechReclamo,idContacReclamo,idPersoReclamo,idRespoReclamo,idRespoReclamo2,enviRespo,enviRespo2,desReclamo,acciReclamo,
				acciReliReclamo,adjuReclamo,idEstaReclamo,idEmpReclamo,correPor,detObsId) values ('".$tip."','".$fech."','".$contac."','".$recep."','".$respon."','".$respon2."',
				'".$enviResp."','".$enviResp2."','".$des."','".$acci."','".$acciReli."','".$adjuRecla."','".$esta."','".$idEmp."','".$correPor."','".$obsId."')";
		return $sql;
	}

	public function getTipReclamoxId($id)
	{
		$sql="select idTipReclamo,desTipReclamo from tbrecla_tipo_reclamo where idTipReclamo='".$id."'";
		return $sql;
	}

	public function getContacxClixId($cli,$id)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as contacto,per.persona_id
				from persona as per,contacto as contac,empresa as emp where contac.persona_id=per.persona_id and 
				contac.empresa_id=emp.empresa_id and contac.empresa_id and emp.emp_nombre='".$cli."' and 
				contac.persona_id='".$id."'";
		return $sql;
	}

	public function getTrabVendedorxId($id)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vendedor,per.persona_id 
				from persona as per,trabajador as trab,perfil as perf where per.persona_id=trab.persona_id and
				trab.perfil_id = perf.perfil_id and (perf.perfil_id!=6 or perf.perfil_id=6 )  and trab.empresa_id=1 and trab.persona_id='".$id."'";
		return $sql;
	}

	public function ActEmailResp($id,$email)
	{
		$sql="update persona set pers_mail='".$email."' where persona_id='".$id."'";
		return $sql;
	}

	public function ActEstaReclaAcep($id)
	{
		$sql="update tbrecla_reclamo set idEstaReclamo=2  where tbrecla_reclamo_id='".$id."'" ;
		return $sql;
	}

	public function ActEstaReclaRecha($id)
	{
		$sql="update tbrecla_reclamo set idEstaReclamo=3 where tbrecla_reclamo_id='".$id."'" ;
		return $sql;
	}

	public function ActEstaReclaSolu($id,$acciReli)
	{
		$sql="update tbrecla_reclamo set idEstaReclamo=4,acciReliReclamo=concat(acciReliReclamo,'\n','".$acciReli."') where tbrecla_reclamo_id='".$id."'" ;
		return $sql;
	}

	public function ActCerrarRecla($id)
	{
		$sql="update tbrecla_reclamo set idEstaReclamo=5 where tbrecla_reclamo_id='".$id."'" ;
		return $sql;
	}

	public function getRecla($id,$filtro,$filtro2,$filtro3,$filtro4,$filtro5)
	{
		$sql="select * from tbrecla_reclamo 
				where (idPersoReclamo='".$id."' or '".$id."'=46 ) and 
				(idEstaReclamo='".$filtro."' or 
				idEstaReclamo='".$filtro2."' or 
				idEstaReclamo='".$filtro3."' or
				idEstaReclamo='".$filtro4."' or 
				idEstaReclamo='".$filtro5."') order by fechReclamo";
		return $sql;
	}

	public function getReclaTod($id)
	{
		$sql="select * from tbrecla_reclamo 
				where (idPersoReclamo='".$id."' or '".$id."'=46 ) and 
				(idEstaReclamo=1 or 
				idEstaReclamo=6 or 
				idEstaReclamo=2 or
				idEstaReclamo=3 or 
				idEstaReclamo=4) order by fechReclamo";
		return $sql;
	}

	public function getReclaxCli($cli,$id,$filtro,$filtro2,$filtro3,$filtro4,$filtro5)
	{
		$sql="select distinct recla.tbrecla_reclamo_id,
				recla.idTipReclamo,
				recla.idPersoReclamo,
				recla.idRespoReclamo,
				recla.idEstaReclamo,
				recla.idContacReclamo,
				recla.idProceReclamo,
				recla.idEmpReclamo,
				recla.desReclamo,
				recla.acciReclamo,
				recla.fechReclamo,
				recla.bestado 
				from 
				tbrecla_reclamo as recla 
				inner join contacto as contac on recla.idContacReclamo=contac.persona_id
				inner join empresa as emp on contac.empresa_id=emp.empresa_id 
				where 
				emp.emp_nombre like '%".$cli."%' and
				(recla.idPersoReclamo='".$id."' or '".$id."'=46 ) and 
				(recla.idEstaReclamo='".$filtro."' or recla.idEstaReclamo='".$filtro2."' or recla.idEstaReclamo='".$filtro3."'
				or recla.idEstaReclamo='".$filtro4."' or recla.idEstaReclamo='".$filtro5."') 
				order by fechReclamo";
		return $sql;
	}

	public function getReclaxResp($resp,$id,$filtro,$filtro2,$filtro3,$filtro4,$filtro5)
	{
		$sql="select * 
				from 
				tbrecla_reclamo as recla 
				inner join persona as per on recla.idRespoReclamo=per.persona_id 
				where 
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) like '%".$resp."%' and 
				(recla.idPersoReclamo='".$id."'  or '".$id."'=46 ) and 
				(recla.idEstaReclamo='".$filtro."' or 
				recla.idEstaReclamo='".$filtro2."' or 
				recla.idEstaReclamo='".$filtro3."' or
				recla.idEstaReclamo='".$filtro4."' or 
				recla.idEstaReclamo='".$filtro5."') order by fechReclamo";
		return $sql;
	}

	public function getContacxId($id)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as contacto,per.persona_id
				from persona as per where per.persona_id='".$id."'";
		return $sql;
	}

	public function getEstaRecla($id)
	{
		$sql="select desEstaReclamo from tbrecla_estado_reclamo where idEstaReclamo='".$id."'";
		return $sql;
	}

	public function getIdxCli($cli)
	{
		$sql="select empresa_id from empresa where emp_nombre='".$cli."'";
		return $sql;
	}

	public function getClixContacxCli($idCli)
	{
		$sql="select emp.emp_nombre as empresa,emp.emp_ruc as ruc from empresa as emp where emp.empresa_id='".$idCli."'";
		return $sql;
	}

	public function getDatReclaxId($id,$dat)
	{
		$sql="select ". $dat ." from tbrecla_reclamo where tbrecla_reclamo_id='".$id."'";
		return $sql;
	}

/*---------------------------[*]--------------------------------*/

/*--------------------------------------------------------------*/
	# SQL MODULO VISITAS
/*--------------------------------------------------------------*/

	public function insertVisi($idVende,$fechIni,$fechFin)
	{
		$sql="insert into tbvisi_visita(idVendeVisita,fechIniVisi,fechFinVisi) values ('".$idVende."','".$fechIni."','".$fechFin."')";
		return $sql;
	}

	//Change Query Visi

	public function insertDetVisi($idVisi,$idContac,$obs,$idCli,$obsPen,$dire,$dirOrig,$fechVisi,$montVisi)
	{
		$sql="insert into tbvisi_detalle_visita(tbvisi_visita_id,idContacVisita,obsVisita,idEmpVisita,obsPenVisita,direVisi,dirVisiOrig,fechVisi,montVisi) values 
				('".$idVisi."','".$idContac."','".$obs."','".$idCli."','".$obsPen."','".$dire."','".$dirOrig."','".$fechVisi."','".$montVisi."')";
		return $sql;
	}

	public function getDetVisixId($id)
	{
		$sql="select * from tbvisi_detalle_visita where tbvisi_visita_id='".$id."'";
		return $sql;
	}

	public function getVisitas()
	{
		$sql="select * from tbvisi_visita";
		return $sql;
	}

	public function getVisitasxId($idVisi)
	{
		$sql="select * from tbvisi_visita where tbvisi_visita_id='".$idVisi."'";
		return $sql;
	}

	public function getVisitasxFechxCli($fech,$cli)
	{
		$sql="select distinct
				visi.tbvisi_visita_id,
				visi.idVendeVisita,
				visi.fechIniVisi,
				visi.fechFinVisi 
				from tbvisi_visita as visi,tbvisi_detalle_visita as detVisi,empresa as emp where  
				visi.tbvisi_visita_id=detVisi.tbvisi_visita_id and detVisi.idEmpVisita=emp.empresa_id and 
				emp.emp_nombre='".$cli."' and ('".$fech."' between visi.fechIniVisi and visi.fechFinVisi)";
		return $sql;
	}

	public function getVisitasxFechxVen($fech,$ven)
	{
		$sql="select distinct
				visi.tbvisi_visita_id,
				visi.idVendeVisita,
				visi.fechIniVisi,
				visi.fechFinVisi 
				from tbvisi_visita as visi,tbvisi_detalle_visita as detVisi,persona as per where  
				visi.idVendeVisita=per.persona_id and visi.tbvisi_visita_id=detVisi.tbvisi_visita_id
				and ('".$fech."' between visi.fechIniVisi and visi.fechFinVisi) and visi.idVendeVisita='".$ven."'";
		return $sql;
	}

	public function getVisitasxFechxClixVen($fech,$cli,$ven)
	{
		$sql="select distinct
				visi.tbvisi_visita_id,
				visi.idVendeVisita,
				visi.fechIniVisi,
				visi.fechFinVisi 
				from tbvisi_visita as visi,tbvisi_detalle_visita as detVisi,empresa as emp,persona as per where  
				visi.idVendeVisita=per.persona_id and visi.tbvisi_visita_id=detVisi.tbvisi_visita_id and 
				detVisi.idEmpVisita=emp.empresa_id and emp.emp_nombre='".$cli."' and ('".$fech."' between 
				visi.fechIniVisi and visi.fechFinVisi) and visi.idVendeVisita='".$ven."'";
		return $sql;
	}

	public function getVisitasxFech($fech)
	{
		$sql="select * from tbvisi_visita where '".$fech."' between fechIniVisi and fechFinVisi";
		return $sql;
	}

	public function getVisitasxCli($cli)
	{
		$sql="select distinct
				visi.tbvisi_visita_id,
				visi.idVendeVisita,
				visi.fechIniVisi,
				visi.fechFinVisi 
				from tbvisi_visita as visi,tbvisi_detalle_visita as detVisi,empresa as emp where  
				visi.tbvisi_visita_id=detVisi.tbvisi_visita_id and detVisi.idEmpVisita=emp.empresa_id and 
				emp.emp_nombre='".$cli."'";
		return $sql;
	}

	public function getVisitasxVen($ven)
	{
		$sql="select distinct
			 	visi.tbvisi_visita_id,
				visi.idVendeVisita,
				visi.fechIniVisi,
				visi.fechFinVisi
				from tbvisi_visita as visi inner join persona as per on visi.idVendeVisita=per.persona_id where 
				visi.idVendeVisita='".$ven."'";
		return $sql;
	}

	public function getYearVisitas()
	{
		$sql="select distinct year(fechIniVisi) as fechaIni from tbvisi_visita";
		return $sql;
	}

	/*Query visitas plus*/

	public function insertDetPasaj($idVisi,$pasDes,$pasMont)
	{
		$sql="INSERT INTO `tbvisi_detPasj`(`tbvisi_visita_id`, `tbvisi_des`, `tbvisi_mont`) 
				VALUES ('".$idVisi."','".$pasDes."','".$pasMont."')";
		return $sql;
	}

	public function getDetPasj($idVisi)
	{
		$sql="SELECT `tbvisi_detPasjId`, `tbvisi_visita_id`, `tbvisi_des`, `tbvisi_mont` FROM `tbvisi_detPasj` 
				WHERE `tbvisi_visita_id`='".$idVisi."'";
		return $sql;
	}

	/*[]*/

/*---------------------------[*]--------------------------------*/

/*---------------------------------------------------------------*/
	# SQL MODULOS
/*----------------------------------------------------------------*/

	public function insertPersona($nom,$ap1,$ap2,$tel,$email)
	{
		$sql="insert into persona (pers_nombres,pers_apepat,pers_apemat,pers_telefono,pers_mail,pers_nacionalidad,
				pers_sexo_id,pers_dir_ubigeo) values ('".$nom."','".$ap1."','".$ap2."','".$tel."','".$email."',0,0,0)";
		return $sql;
	}

	public function insertContac($idPer,$idCli)
	{
		$sql="insert into contacto (persona_id,empresa_id) values ('".$idPer."','".$idCli."')";
		return $sql;
	}

	public function getEmailxNom($nomPer)
	{
		$sql="select pers_mail from persona where concat(pers_nombres,' ',pers_apepat,' ',pers_apemat)='".$nomPer."'";
		return $sql;
	}

	public function updateEmailxPer($nomPer,$email)
	{
		$sql="update persona set pers_mail='".$email."' where concat(pers_nombres,' ',pers_apepat,' ',pers_apemat)='".$nomPer."'";
		return $sql;
	}

	public function updateCoti($fechAdju,$impTipId,$idMone,$cotEst,$cotPri,$cotDes,$cotFechEmi,$cotFechVen,$cotRefe,$idContac,$idCli,$idCoti,$cotCond,$condPre,$condPlaz,$condPag,$condLug,$condGara,$condVali,$condPena,$condFian,$cot_prob)
	{
		$sql="update cotizacion set cliente_id='".$idCli."',contacto_id='".$idContac."',cot_referencia='".$cotRefe."',
				cot_fec_emis='".$cotFechEmi."',cot_fec_venc='".$cotFechVen."',cot_descrip='".$cotDes."',cot_prioridad_id='".$cotPri."',
				cot_estado_id='".$cotEst."',moneda_id='".$idMone."',imp_tipo_costo_id='".$impTipId."',cot_fec_adj='".$fechAdju."',
				cot_cc_id='".$cotCond."',cot_cond_precios='".$condPre."',cot_cond_plazo_ent='".$condPlaz."',cot_cond_forma_pago='".$condPag."',
				cot_cond_lugar_ent='".$condLug."',cot_cond_garantia='".$condGara."',cot_cond_validez='".$condVali."',cot_cond_penalidad='".$condPena."',
				cot_cond_carta_fianza='".$condFian."',cot_probabilidad='".$cot_prob."' where cotizacion_id='".$idCoti."'";
		return $sql;
	}

	public function updateCotiProye($idCoti,$nomProye)
	{
		$sql="update cotizacion as coti,proyecto as proye set proye.proy_nombre='".$nomProye."' where coti.proyecto_id=proye.proyecto_id and 
				coti.cotizacion_id='".$idCoti."'";
		return $sql;
	}

	public function getReclaxId($id)
	{
		$sql="select * from tbrecla_reclamo where tbrecla_reclamo_id='".$id."'";
		return $sql;
	}

	public function updateReclaxId($tip,$fech,$contac,$recep,$respon,$respon2,$enviRespo,$enviRespo2,$des,$acci,$acciReli,$adjuRecla,$esta,$idEmp,$idRecla,$correPor,$obsId)
	{ 
		$sql="update tbrecla_reclamo set 
				idTipReclamo='".$tip."',
				fechReclamo='".$fech."',
				idContacReclamo='".$contac."',
				idPersoReclamo='".$recep."',
				idRespoReclamo='".$respon."',
				idRespoReclamo2='".$respon2."',
				enviRespo='".$enviRespo."',
				enviRespo2='".$enviRespo2."',
				desReclamo='".$des."',
				acciReclamo='".$acci."',
				acciReliReclamo='".$acciReli."',
				adjuReclamo='".$adjuRecla."',
				idEstaReclamo='".$esta."',
				idEmpReclamo='".$idEmp."',
				correPor='".$correPor."',
				detObsId='".$obsId."' 
				where 
				tbrecla_reclamo_id='".$idRecla."'";
		return $sql;
	}

	public function getMoneda()
	{
		$sql="select * from moneda";
		return $sql;
	}

	public function updateVisiGastos($idVisi,$moneId,$monPasa,$monHospe,$monAli,$monTrans,$correVisi)
	{
		$sql="update tbvisi_visita set moneda_id='".$moneId."',pasaVisi='".$monPasa."',hospeVisi='".$monHospe."',alimeVisi='".$monAli."',
				transInterVisi='".$monTrans."',visiCorre='".$correVisi."' where tbvisi_visita_id='".$idVisi."'";
		return $sql;
	}

	public function insertEmp($ruc,$emp,$email,$web,$dire,$tel)
	{
		$sql="insert into empresa (emp_ruc,emp_nombre,emp_email,emp_web,emp_direccion,emp_telef) values ('".$ruc."',
				'".$emp."','".$email."','".$web."','".$dire."','".$tel."')";
		return $sql;	
	}

	public function insertAnfEmp($idEmp)
	{
		$sql="insert into anfi_empresa (empresa_id_padre,empresa_id,emp_perfil_id,bestado) values ('1','".$idEmp."','1','1')";
		return $sql;
	}

	public function getMonedaxId($idEmp)
	{
		$sql="select mon.mon_sigla from moneda as mon,tbvisi_visita as visi where mon.moneda_id=visi.moneda_id 
				and tbvisi_visita_id='".$idEmp."'";
		return $sql;
	}

	public function deleteDetVisixId($idVisi)
	{
		$sql="delete from tbvisi_detalle_visita where tbvisi_visita_id='".$idVisi."'";
		return $sql;
	}

	public function deleteVisixId($idVisi)
	{
		$sql="delete from tbvisi_visita where tbvisi_visita_id='".$idVisi."'";
		return $sql;
	}

	public function getRucCli($cli)
	{
		$sql="select emp_ruc from empresa where emp_nombre='".$cli."'";
		return $sql;
	}

	public function getTipDoc()
	{
		$sql="select * from tbcu_tipdoc";
		return $sql;
	}

	public function getBancos()
	{
		$sql="select distinct ban.banco_nombre,ban.banco_id from banco as ban inner join cuenta as cuen on ban.banco_id=cuen.banco_id 
				where cuen.bestado=1";
		return $sql;
	}

	public function getCuentaxId($idBanco)
	{
		$sql="select cuenta_id,cuenta_nro from v_cuenta where banco_id='".$idBanco."'";
		return $sql;
	}

	public function getEstCuen()
	{
		$sql="select * from  tbcu_esta";
		return $sql;
	}

	public function insertCuxCobra($idCli,$numCom,$idMone,$tipDoc,$impor,$des,$fecha)
	{
		$sql="INSERT INTO `tbcu_cuxcobra`(`idEmpCli`, `numCompro`, `idTipMone`, `idTipDoc`, `impor`, `descrip`, `fecha`) 
				VALUES ('".$idCli."','".$numCom."','".$idMone."','".$tipDoc."','".$impor."','".$des."','".$fecha."')";
		return $sql;
	}

	public function updateCuxCobra($idCli,$numCom,$idMone,$tipDoc,$impor,$des,$fecha,$idCu)
	{
		$sql="UPDATE `tbcu_cuxcobra` set `idEmpCli`='".$idCli."', `numCompro`='".$numCom."', `idTipMone`='".$idMone."', 
				`idTipDoc`='".$tipDoc."',`impor`='".$impor."',`descrip`='".$des."', `fecha`='".$fecha."' where idCuxCobra='".$idCu."'";
		return $sql;
	}

	public function insertDetCuen($idCu,$fech,$mon,$idBan,$idEst)
	{
		$sql="INSERT INTO `tbcu_det_cuxcobra`(`idCuxCobra`, `fecha`, `monto`, `idCuBanco`, `idCuEstado`) VALUES 
				('".$idCu."','".$fech."','".$mon."','".$idBan."','".$idEst."')";
		return $sql;
	}

	public function updateDetCuen($idCu,$fech,$mon,$idBan,$idEst,$idDet)
	{
		$sql="UPDATE `tbcu_det_cuxcobra` set `idCuxCobra`='".$idCu."', `fecha`='".$fech."', `monto`='".$mon."', 
				`idCuBanco`='".$idBan."', `idCuEstado`='".$idEst."' where idDetxCobra='".$idDet."'";
		return $sql;
	}

	public function getEstCuxId($idEst)
	{
		$sql="select descrip from tbcu_esta where idCuEstado='".$idEst."'";
		return $sql;
	}

	public function getBancoxId($idCu)
	{
		$sql="select ban.banco_nombre,cuen.cuenta_nro from banco as ban,v_cuenta cuen where 
				ban.banco_id=cuen.banco_id and cuen.cuenta_id='".$idCu."'";
		return $sql;
	}

	public function getCuxCobra()
	{
		$sql="SELECT * FROM `tbcu_cuxcobra`";
		return $sql;
	}

	public function getCuxCobraxRuc($ruc)
	{
		$sql="SELECT cuen.`idCuxCobra`, cuen.`idEmpCli`, cuen.`numCompro`, cuen.`idTipMone`, cuen.`idTipDoc`, cuen.`impor`, 
				cuen.`descrip`, cuen.`fecha` FROM `tbcu_cuxcobra` as cuen,empresa as emp WHERE cuen.idEmpCli=emp.empresa_id
				and emp.emp_ruc='".$ruc."'";
		return $sql;
	}

	public function getCuxCobraxCli($cli)
	{
		$sql="SELECT cuen.`idCuxCobra`, cuen.`idEmpCli`, cuen.`numCompro`, cuen.`idTipMone`, cuen.`idTipDoc`, cuen.`impor`, 
				cuen.`descrip`, cuen.`fecha` FROM `tbcu_cuxcobra` as cuen,empresa as emp WHERE cuen.idEmpCli=emp.empresa_id
				and emp.emp_nombre like '%".$cli."%'";
		return $sql;
	}

	public function getCuxCobraxId($idCu)
	{
		$sql="SELECT * FROM `tbcu_cuxcobra` where idCuxCobra='".$idCu."'";
		return $sql;
	}

	public function getDocCuxId($idTip)
	{
		$sql="SELECT * FROM `tbcu_tipdoc` where idTipDoc='".$idTip."'";
		return $sql;
	}

	public function getMonxId($idMon)
	{
		$sql="select mon.mon_sigla from moneda as mon where mon.moneda_id='".$idMon."'";
		return $sql;
	}

	public function getCuentaxIdBan($idBan)
	{
		$sql="select distinct cuen.cuenta_nro,cuen.cuenta_id from v_cuenta as cuen,tbcu_det_cuxcobra as detxcobra, 
				banco as ban where cuen.banco_id=ban.banco_id and cuen.banco_id='".$idBan."' and cuen.bestado=1";
		return $sql;
	}

	public function getDetCuenxId($idCu)
	{
		$sql="SELECT detCu.idDetxCobra,detCu.idCuxCobra, detCu.fecha, detCu.monto, detCu.idCuBanco, detCu.idCuEstado
				FROM tbcu_det_cuxcobra AS detCu INNER JOIN tbcu_cuxcobra AS cu ON detCu.idCuxCobra = cu.idCuxCobra
				WHERE cu.idCuxCobra='".$idCu."'";
		return $sql;
	}

	public function eliDetCuxCob($idDet)
	{
		$sql="delete from tbcu_det_cuxcobra where idDetxCobra='".$idDet."'";
		return $sql;
	}

	public function getDetCuxId($idDet)
	{
		$sql="SELECT * FROM `tbcu_det_cuxcobra` WHERE idDetxCobra='".$idDet."'";
		return $sql;
	}

	public function getIdBanxIdCu($idDet)
	{
		$sql="select cuen.banco_id from v_cuenta as cuen,tbcu_det_cuxcobra as cuxcob where cuxcob.idCuBanco=cuen.cuenta_id
				and cuxcob.idDetxCobra='".$idDet."'";
		return $sql;
	}

	public function getSumCuCance($idCu)
	{
		$sql="select sum(detCu.monto) as sumCance from tbcu_cuxcobra as cuen inner join tbcu_det_cuxcobra as detCu
				on cuen.idCuxCobra=detCu.idCuxCobra where cuen.idCuxCobra='".$idCu."' and detCu.idCuEstado=2";
		return $sql;
	}

	public function getCuenxPagxFech($fechIni,$fechFin)
	{
		$sql="select let.letra_monto as mont,mone.mon_sigla as mone,let.letra_id as letId,emp.emp_nombre as empre,
				DATE_FORMAT(let.letra_fec_ini,'%d-%m-%y') as fechEmi,DATE_FORMAT(let.letra_fec_ini,'%y') as fechEmiYear 
				from letra as let inner join empresa as emp on emp.empresa_id=let.proveedor_id inner join moneda as mone 
				on mone.moneda_id=let.moneda_id where let.letra_tipo_id=2 and (let.letra_fec_ini between '".$fechIni."' 
				and '".$fechFin."') and let.bestado=1";
		return $sql;
	}

	public function getCuenxPag()
	{
		$sql="select let.letra_monto as mont,mone.mon_sigla as mone,let.letra_id as letId,emp.emp_nombre as empre,
				DATE_FORMAT(let.letra_fec_ini,'%d-%m-%y') as fechEmi,DATE_FORMAT(let.letra_fec_ini,'%y') as fechEmiYear 
				from letra as let inner join empresa as emp on emp.empresa_id=let.proveedor_id inner join moneda as mone 
				on mone.moneda_id=let.moneda_id where let.letra_tipo_id=2 and let.bestado=1";
		return $sql;
	}

	public function getDetProf($id)
	{
		$sql="select prof.imp_prof_nro as codProf,mone.mon_sigla as moneda,prod.prod_nombre as nomProd,profDet.prod_cantidad as cantProf,profDet.precio_fin as preUni,
				profDet.prod_almacen_valor as gasAlmacen,profDet.prod_fob_valor,profDet.prod_cif_valor,profDet.prod_nac_valor 
				from imp_proforma_detalle as profDet,producto as prod,moneda as mone,imp_proforma as prof where 
				profDet.imp_proforma_id='".$id."' and prod.producto_id=profDet.producto_id and mone.moneda_id=prof.moneda_id and 
				profDet.imp_proforma_id=prof.imp_proforma_id";
		return $sql;
	}

	public function getDetGast($id)
	{
		$sql="select imp_prof_gasto_nombre as gasto,imp_prof_gasto_valor as gastoVal from
				imp_prof_gasto as gast,imp_proforma_detalle as detProf where detProf.imp_proforma_id='".$id."' 
				and detProf.imp_prof_det_id=gast.imp_prof_det_id and gast.bestado=1";
		return $sql;
	}
	 
	public function getGeneProf2($id)
	{
		$sql="select distinct
				proye.proy_nombre as titProye,
				emp.emp_nombre as clien,
				proye.proy_nombre as proyec, 
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vende, 
				cotiz.cot_nro as numCoti 
				from 
				proyecto as proye,
				empresa as emp,
				persona as per,
				imp_proforma as prof,
				trabajador as trab,
				cotizacion as cotiz 
				where 
				cotiz.cotizacion_id='".$id."' and
				prof.cotizacion_id=cotiz.cotizacion_id and 
				cotiz.proyecto_id=proye.proyecto_id and 
				prof.cliente_id=emp.empresa_id and
				prof.operador_id_atiende=trab.trabajador_id and
				trab.persona_id=per.persona_id";
		return $sql;
	}

	public function getDetProf2($idCoti)
	{
		#round((cotiz.cot_margen/100)*(profDet.precio_fin*profDet.prod_cantidad),2) as marVen, # redondear decimales
		$sql="select distinct
				prod.prod_nombre as proNom,
				'n' as exwork,
				'n' as fob,
				'n' as cif,
				'n' as ddp, 
				'n' as gasAdi,
				cotDet.pro_precio_compra*cotDet.pro_cantidad as cosTot,
				cotDet.pro_precio_compra as cosUni,
				cotDet.cot_det_margen as marVenPor,
				cotDet.pro_precio_venta as preUni,
				cotDet.pro_precio_venta*cotDet.pro_cantidad as preTot,
				cotiz.cot_cond_plazo_ent as plazEnt,
				cotiz.cot_cond_forma_pago as formPag
				from
				imp_proforma as prof,
				cotizacion as cotiz,
				cot_detalle as cotDet,
				producto as prod
				where
				cotiz.cotizacion_id='".$idCoti."' and
				cotiz.cotizacion_id=cotDet.cotizacion_id and
				cotiz.cotizacion_id=prof.cotizacion_id and
				prod.producto_id=cotDet.producto_id and
			   cotiz.bestado=1 and cotDet.bestado=1 
			   GROUP BY cotDet.pro_precio_venta";
		return $sql;
	}

	public function getDetProf3($idCoti)
	{
		$sql="select
				prof.imp_proforma_id as profId,
				sum(profDet.prod_ew_valor) as exwork,
				sum(profDet.prod_fob_valor) as fob,
				sum(profDet.prod_cif_valor) as cif,
				sum(profDet.prod_cif_valor+profDet.prod_nac_valor) as ddp
				from
				imp_proforma_detalle as profDet,
				imp_proforma as prof,
				cotizacion as cotiz
				where
				cotiz.cotizacion_id='".$idCoti."' and
				cotiz.cotizacion_id=prof.cotizacion_id and
				prof.imp_proforma_id=profDet.imp_proforma_id and
			   cotiz.bestado=1 and profDet.bestado=1
			   GROUP BY prof.imp_proforma_id";
		return $sql;
	}

	public function getDetProf4($idProf)
	{
		$sql="select
				sum(profGast.imp_prof_gasto_valor) as gasAdi
				from
				imp_proforma as prof,
				imp_proforma_detalle as profDet,
				imp_prof_gasto as profGast
				where
				prof.imp_proforma_id='".$idProf."' and
				prof.imp_proforma_id=profDet.imp_proforma_id and
			   (profDet.imp_prof_det_id=profGast.imp_prof_det_id 
			   or profGast.imp_prof_gasto_valor=0) and
			   profGast.bestado=1 GROUP BY prof.imp_proforma_id";
		return $sql;
	}

	public function getDirexEmp($emp)
	{
		$sql="select emp_direccion as dire from empresa where emp_nombre='".$emp."'";
		return $sql;
	}

	public function getEmpxRucDes($emp)
	{
		$sql="select empresa_id as idEmp from empresa where concat(emp_ruc,' - ',emp_nombre)='".$emp."'";
		return $sql;
	}

/*---------------------------[*]----------------------------------*/

/*-----------------------------------------------------------------*/
	# SQL MODULO DE OBSERVACION
/*-----------------------------------------------------------------*/

	public function getConforObs($tab,$val,$clav)
	{
		$sql="select ".$val." as valConfor,".$clav." as idConfor from ".$tab;
		return $sql; 
	}

	public function getNumFormat()
	{
		$sql="select * from tbobs_format";
		return $sql;
	}

	public function getVerFormat()
	{
		$sql="select * from tbobs_versi";
		return $sql;
	}

	public function getPagFormat()
	{
		$sql="select * from tbobs_pag";
		return $sql;
	}

	public function insertObs(	$idTipObs,$idRespCarg,$idConforImp,$idConforEfec,$idConforAc,
										$idUsuSesi,$idEmp,$idContac,$idCodFormat,$idCodVersi,$idCodPag,$fechContro,
										$acciCorre,$fechLim,$fechVeri,$fechAcorVeri,$fechVeriEfec,$fechEfecSati,
										$eviObje,$fechCie,$fechSegui,$desObser)
	{
		$sql="INSERT INTO `tbobs_observ`(`idTipObs`, `idRespCarg`, `idConforImp`, `idConforEfec`, 
				`idConforAc`, `idUsuSesi`, `idEmp`, `idContac`, `idCodFormat`, `idCodVersi`, `idCodPag`, `fechContro`, `acciCorre`, 
				`fechLim`, `fechVeri`, `fechAcorVeri`, `fechVeriEfec`, `fechEfecSati`, `eviObje`, `fechCie`, `fechSegui`,
				`desObserv`) VALUES 
				('".$idTipObs."','".$idRespCarg."','".$idConforImp."','".$idConforEfec."','".$idConforAc."',
				'".$idUsuSesi."','".$idEmp."','".$idContac."','".$idCodFormat."','".$idCodVersi."','".$idCodPag."','".$fechContro."',
				'".$acciCorre."','".$fechLim."','".$fechVeri."','".$fechAcorVeri."','".$fechVeriEfec."','".$fechEfecSati."',
				'".$eviObje."','".$fechCie."','".$fechSegui."','".$desObser."')";
				
		return $sql;
	}

	public function updateObs($idInsert,$idGene)
	{
		$sql="update tbobs_observ set numInfor='".$idGene."' where idObserv='".$idInsert."'";
		return $sql;
	}

	public function getObsRecla()
	{
		$sql="SELECT 
				obsRecla.idObserv AS idObs,
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.acciCorre AS correc, 
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				versi.desVersi AS regis, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, '-' AS acci
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				inner join tbobs_versi as versi on versi.idCodVersi=obsRecla.idCodVersi
				WHERE obsRecla.idTipObs =1";
		return $sql;
	}

	public function getObsReclaxCod($cod)
	{
		$sql="SELECT
				obsRecla.idObserv AS idObs, 
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.acciCorre AS correc, 
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				versi.desVersi AS regis, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, '-' AS acci
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				inner join tbobs_versi as versi on versi.idCodVersi=obsRecla.idCodVersi
				WHERE obsRecla.idTipObs =1 and obsRecla.numInfor='".$cod."'";
		return $sql;
	}

	public function getObsReclaxCli($cli)
	{
		$sql="SELECT 
				obsRecla.idObserv AS idObs,
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.acciCorre AS correc, 
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				versi.desVersi AS regis, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, '-' AS acci
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				inner join tbobs_versi as versi on versi.idCodVersi=obsRecla.idCodVersi
				WHERE obsRecla.idTipObs =1 and cli.emp_nombre like '%".$cli."%'";
		return $sql;
	}

	public function deleteObsReclaxId($id)
	{
		$sql="delete from tbobs_observ where idObserv='".$id."'";
		return $sql;
	}

	public function getObsReclaxIdObs($idObs)
	{
		$sql="select * 
				from tbobs_observ as obsRecla
				WHERE 
				obsRecla.idTipObs=1 and 
				obsRecla.idObserv='".$idObs."'";
		return $sql;
	}

	public function updateObsReclaxId($idObs,$idTipObs,$idRespCarg,$idConforImp,$idConforEfec,$idConforAc,
												$idUsuSesi,$idEmp,$idContac,$idCodFormat,$idCodVersi,$idCodPag,$fechContro,
												$acciCorre,$fechLim,$fechVeri,$fechAcorVeri,$fechVeriEfec,$fechEfecSati,
												$eviObje,$fechCie,$fechSegui,$desObser)
	{
		$sql="update tbobs_observ 
				set 
				idTipObs='".$idTipObs."',
				idRespCarg='".$idRespCarg."',
				idConforImp='".$idConforImp."', 
				idConforEfec='".$idConforEfec."',
				idConforAc='".$idConforAc."', 
				idUsuSesi='".$idUsuSesi."', 
				idEmp='".$idEmp."', 
				idContac='".$idContac."',
				idCodFormat='".$idCodFormat."', 
				idCodVersi='".$idCodVersi."',
				idCodPag='".$idCodPag."', 
				fechContro='".$fechContro."',
				acciCorre='".$acciCorre."',
				fechLim='".$fechLim."', 
				fechVeri='".$fechVeri."', 
				fechAcorVeri='".$fechAcorVeri."',
				fechVeriEfec='".$fechVeriEfec."',
				fechEfecSati='".$fechEfecSati."', 
				eviObje='".$eviObje."',
				fechCie='".$fechCie."',
				fechSegui='".$fechSegui."',
				desObserv='".$desObser."' 
				where 
				idObserv='".$idObs."'";
		return $sql;
	}

	public function geneReporObsRecla($idObs)
	{
		$sql="SELECT 
				obsRecla.idObserv AS idObs,
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.acciCorre AS correc,
				obsRecla.eviObje as eviObje,
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				versi.desVersi AS regis, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, '-' AS acci,
				obsRecla.fechLim as fechLim,
				obsRecla.fechVeri as fechVeri,
				obsRecla.fechAcorVeri as fechAcorVeri,
				obsRecla.fechVeriEfec as fechVeriEfec,
				obsRecla.fechEfecSati as fechEfecSati,
				obsRecla.fechCie as fechCie,
				obsRecla.fechSegui as fechSegui,
				conforImp.desConfir as desConforImp,
				conforImp2.desConfir as desConforEfec,
				conforImp3.desConfir as desConforAc 
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				inner join tbobs_versi as versi on versi.idCodVersi=obsRecla.idCodVersi
				inner join tbobs_conforimp as conforImp on obsRecla.idConforImp=conforImp.idConforImp
				inner join tbobs_conforimp as conforimp2 on obsRecla.idConforEfec=conforimp2.idConforImp
				inner join tbobs_conforimp as conforimp3 on obsRecla.idConforAc=conforimp3.idConforImp
				WHERE obsRecla.idTipObs =1 and obsRecla.idObserv='".$idObs."'";
		return $sql;
	}

	public function insertObsQue($idTipObs,$idRespCarg,$idUsuSesi,$idEmp,$idContac,$fechContro,
										  $desObserv,$soluInme)
	{
		$sql="INSERT INTO `tbobs_observ`(`idTipObs`,`idRespCarg`,`idUsuSesi`,`idEmp`, 
				`idContac`,`fechContro`,`desObserv`,`soluInme`) 
				VALUES 
				('".$idTipObs."','".$idRespCarg."','".$idUsuSesi."','".$idEmp."','".$idContac."','".$fechContro."',
				'".$desObserv."','".$soluInme."')";
		return $sql;
	}

	public function getObsQueja()
	{
		$sql="SELECT 
				obsRecla.idObserv AS idObs,
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.soluInme AS soluInme,
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, 
				'-' AS acci
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				WHERE obsRecla.idTipObs =2";
		return $sql;
	}

	public function getObsQuejaxCod($cod)
	{
		$sql="SELECT 
				obsRecla.idObserv AS idObs,
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.soluInme AS soluInme,
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, 
				'-' AS acci
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				WHERE obsRecla.idTipObs=2 and obsRecla.numInfor='".$cod."'";
		return $sql;
	}

	public function getObsQuejaxCli($cli)
	{
		$sql="SELECT 
				obsRecla.idObserv AS idObs,
				obsRecla.numInfor AS codNum, 
				obsRecla.desObserv AS desSitu, 
				obsRecla.soluInme AS soluInme,
				cli.emp_nombre AS cliEmp, 
				concat( per.pers_nombres, ' ', per.pers_apepat ) AS contac, 
				concat( per2.pers_nombres, ' ', per2.pers_apepat ) AS respo, 
				'-' AS docAsoc, 
				obsRecla.fechContro AS controFre, 
				'-' AS acci
				FROM tbobs_observ AS obsRecla
				INNER JOIN empresa AS cli ON cli.empresa_id = obsRecla.idEmp
				INNER JOIN persona AS per ON per.persona_id = obsRecla.idContac
				INNER JOIN persona AS per2 ON per2.persona_id = obsRecla.idRespCarg
				WHERE obsRecla.idTipObs=2 and cli.emp_nombre like '%".$cli."%'";
		return $sql;
	}

	public function getObsQuexIdObs($idObs)
	{
		$sql="select * from tbobs_observ as obsRecla
				WHERE 
				obsRecla.idTipObs=2 and 
				obsRecla.idObserv='".$idObs."'";
		return $sql;
	}

	public function updateObsQue($idObserv,$idTipObs,$idRespCarg,$idUsuSesi,$idEmp,$idContac,$fechContro,
										  $desObserv,$soluInme)
	{
		$sql="UPDATE tbobs_observ set
				`idTipObs`='".$idTipObs."',
				`idRespCarg`='".$idRespCarg."',
				`idUsuSesi`='".$idUsuSesi."',
				`idEmp`='".$idEmp."', 
				`idContac`='".$idContac."',
				`fechContro`='".$fechContro."',
				`desObserv`='".$desObserv."',
				`soluInme`='".$soluInme."' 
				 where idObserv='".$idObserv."'";
		return $sql;
	}

/*---------------------------[*]------------------------------------*/

/*-------------------------------------------------------------------*/
	# SQL MODULO DE REPORTE DE COBRANZAS
/*-------------------------------------------------------------------*/

	public function getTipDocSf()
	{

		$sql="select tipdoc_codigo,tipdoc_descripcion from tipos_de_documentos";
		return $sql;
	}

	public function getSubDiaSf()
	{
		$sql="select subdiar_codigo,subdiar_descripcion from subdiarios";
		return $sql;		
	}

	public function getCobFacSf($fil)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and 
				ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxFechSf($fil,$fechIni,$fechFin)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ( ven.co_d_fechavto between '".$fechIni."' and '".$fechFin."' ) 
				and ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxFechxDocSf($fil,$fechIni,$fechFin,$doc)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ( ven.co_d_fechavto between '".$fechIni."' and '".$fechFin."' ) 
				and ven.co_l_delete=1 and ven.co_c_docum='".$doc."' group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxFechxDocxRucSf($fil,$fechIni,$fechFin,$doc,$ruc)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ( ven.co_d_fechavto between '".$fechIni."' and '".$fechFin."' ) and 
				ven.co_c_docum='".$doc."' and ven.co_c_clien='".$ruc."' 
				and ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxDocxRucSf($fil,$doc,$ruc)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ven.co_c_docum='".$doc."' and 
				ven.co_c_clien='".$ruc."' 
				and ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxFechxRucSf($fil,$fechIni,$fechFin,$ruc)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ( ven.co_d_fechavto between '".$fechIni."' and '".$fechFin."' ) and 
				ven.co_c_clien='".$ruc."' 
				and ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxDocSf($fil,$doc)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ven.co_c_docum='".$doc."' 
				and ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getCobFacxRucSf($fil,$ruc)
	{
		$sql="select
				ven.idVentas as idVen,
				date_format(ven.co_d_fecha,'%d/%m/%Y') as fechPag,
				date_format(ven.co_d_fechavto,'%d/%m/%Y') as fechPagVto,
				ven.co_a_glosa as numFac,
				concat(anex.anex_descripcion,' - ',ven.co_a_movim) as clie,
				ven.co_n_monto as importSole,
				ven.co_n_mtous as importDola,
				'' as adelan,
				'' as reten,
				'' as factuSole,
				'' as factuDola,
				'' as observ,
				ven.co_c_moned as mone,
				ven.co_n_igv as igvn,
				ven.co_n_igvus as igve
				from ventas as ven
				inner join anexo as anex on ven.co_c_clien=anex.anex_ruc
				where 
				ven.co_c_tpdoc='".$fil."' and ven.co_l_anula!=1 and 
				anex.tipoanex_codigo=02 and ven.co_c_clien='".$ruc."'
				and ven.co_l_delete=1 group by ven.idVentas";
		return $sql;
	}

	public function getTipCambActSf()
	{
		$sql="select 
			  *,date_format(TIPOCAMB_FECHA,'%d/%m/%Y') as fechCamb
			  from 
			  tipo_cambio";
		return $sql;
	}

	public function getMoneSf()
	{
		$sql="select tipomon_codigo,tipomon_simbolo from tipo_moneda";
		return $sql;
	}

	public function getCliSf()
	{
		$sql="select anex_ruc,anex_descripcion from anexo where tipoanex_codigo='02'";
		return $sql;
	}

	public function insertEmpSf($anexCodigo,$anexRuc,$anexDes,$anexDire,$anexTel)
	{
		$sql="insert into anexo (anex_codigo,anex_ruc,anex_descripcion,anex_direccion,anex_telefono,tipoanex_codigo) values 
			  ('".$anexCodigo."','".$anexRuc."','".$anexDes."','".$anexDire."','".$anexTel."','02')";
		return $sql;
	}

	public function getRucxProv($prov)
	{
		$sql="select anex_ruc from anexo where anex_descripcion ='".$prov."'";
		return $sql;
	}

	public function insertCobran($valTipCob,$fechPagCob,$valFac,
								 $valRuc,$valMovi,$valImpon,
								 $valImponus,$valRetenn,$valRetenus,
								 $valMone,$docum,$fechVto)
	{
		$sql="insert into 
			  ventas 
			  (co_c_tpdoc,
			   co_d_fecha,
			   co_a_glosa,
			   co_c_clien,
			   co_a_movim,
			   co_n_monto,
			   co_n_mtous,
			   co_n_igv,
			   co_n_igvus,
			   co_c_moned,
			   co_c_docum,
			   co_d_fechavto,
			   co_l_delete) 
			   values 
			('".$valTipCob."','".$fechPagCob."','".$valFac."',
			 '".$valRuc."','".$valMovi."','".$valImpon."',
			 '".$valImponus."','".$valRetenn."','".$valRetenus."',
			 '".$valMone."','".$docum."','".$fechVto."','1')";
		return $sql;
	}

	public function updateTipCamb($fechCamb,$cambComp,$cambVent)
	{
		$sql="update tipo_cambio set 
				tipocamb_fecha='".$fechCamb."',
				tipocamb_compra='".$cambComp."',
				tipocamb_venta='".$cambVent."' 
				where 
				idTipCambio=422";
		return $sql;
	}

	public function getVentCobran($idVent)
	{
		$sql="select *,date_format(CO_D_FECHA,'%Y-%m-%d') as fechIng,date_format(CO_D_FECHAVTO,'%Y-%m-%d') as fechVto
				from ventas where idVentas='".$idVent."'";
		return $sql;
	}

	public function getDesAnexo($ruc)
	{
		$sql="select 
			  anex.anex_descripcion as desCli
			  from
			  anexo as anex
			  where 
			  anex.anex_ruc='".$ruc."'";
		return $sql;
	}

	public function updateCobran($valTipCob,$fechPagCob,$valFac,
								 $valRuc,$valMovi,$valImpon,
								 $valImponus,$valRetenn,$valRetenus,
								 $valMone,$docum,$fechVto,$idVen)
	{
		$sql="update 
			  ventas
			  set
			  co_c_tpdoc='".$valTipCob."',
			   co_d_fecha='".$fechPagCob."',
			   co_a_glosa='".$valFac."',
			   co_c_clien='".$valRuc."',
			   co_a_movim='".$valMovi."',
			   co_n_monto='".$valImpon."',
			   co_n_mtous='".$valImponus."',
			   co_n_igv='".$valRetenn."',
			   co_n_igvus='".$valRetenus."',
			   co_c_moned='".$valMone."',
			   co_c_docum='".$docum."',
			   co_d_fechavto='".$fechVto."'
			   where
			   idVentas='".$idVen."'";
		return $sql;
	} 

	public function deleteCobran($idCob)
	{
		$sql="update ventas set co_l_delete=0 where idVentas='".$idCob."'";
		return $sql;
	}

	public function updateTipCobran($idCobran,$idTip)
	{
		$sql="update ventas set co_c_tpdoc='".$idTip."' where idVentas='".$idCobran."'";
		return $sql;
	}

	public function jn_getFactCance()
	{
		#$sql="select * from ventas where co_l_anula!=1";
		$sql="select 
				*,
				anexo.anex_descripcion as razCli
				from ventas 
				inner join anexo on ventas.co_c_clien=anexo.anex_codigo
				where co_l_anula!=1";
		return $sql;
	}

	public function jn_getFactCancexRuc($ruc)
	{
		#$sql="select * from ventas where co_l_anula!=1 and co_c_clien='".$ruc."'";
		$sql="select 
				*,
				anexo.anex_descripcion as razCli
				from ventas 
				inner join anexo on ventas.co_c_clien=anexo.anex_codigo
				where co_l_anula!=1 and co_c_clien='".$ruc."'";
		return $sql;
	}

	public function jn_getAnexCli()
	{
		$sql="select anex_codigo,anex_descripcion from anexo where tipoanex_codigo=02";
		return $sql;
	}

	public function jn_getTipDoc()
	{
		$sql="select tipdoc_codigo,tipdoc_descripcion from tipos_de_documentos";
		return $sql;
	}

/*---------------------------[*]--------------------------------------*/

/*--------------------------------------------------------------------*/
	# SQL MODULO VACACIONES
/*--------------------------------------------------------------------*/

	public function vaca_areTrab()
	{
		$sql="select trab_funcion_id,trab_funcion_nombre from trab_funcion";
		return $sql;
	}

	public function vaca_trabAdm()
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,per.persona_id
			  from persona as per inner join trabajador as trab on trab.persona_id=per.persona_id 
			  inner join trab_funcion as are on are.trab_funcion_id=trab.trab_funcion_id where are.trab_funcion_id=2
			  and trab.empresa_id=1";
		return $sql;
	}

	public function vaca_trabxAr($area)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,per.persona_id
			  from persona as per inner join trabajador as trab on trab.persona_id=per.persona_id 
			  inner join trab_funcion as are on are.trab_funcion_id=trab.trab_funcion_id where are.trab_funcion_id='".$area."'
			  and trab.empresa_id=1";
		return $sql;
	}

	public function vaca_periAn()
	{
		$sql="SELECT `vaca_perioAn_id` , `vaca_anPeri`, `vaca_desPeri` FROM `vaca_perioan` where vaca_perioAn_id!=5 and vaca_estado_id=1";
		return $sql;
	}

	public function vaca_asigVaca($vaca_mesGocIni,$vaca_mesGocFin,$vaca_trabId,$vaca_userAdm,$vaca_fechAuto,$vaca_perioAn_id,$vaca_areTrab,$vaca_numFinSem)
	{
		$sql="INSERT INTO `vaca_vaca`(`vaca_mesGocIni`, `vaca_mesGocFin`, `vaca_trabId`, `vaca_userAdm`, 
			`vaca_fechAuto`, `vaca_perioAn_id`,`vaca_areTrab`,`vaca_numFinSem`) VALUES ('".$vaca_mesGocIni."','".$vaca_mesGocFin."','".$vaca_trabId."',
			'".$vaca_userAdm."','".$vaca_fechAuto."','".$vaca_perioAn_id."','".$vaca_areTrab."','".$vaca_numFinSem."')";
		return $sql;
	}

	public function vaca_periAsig($vaca_vaca_id)
	{
		$sql="SELECT date_format(`vaca_mesGocIni`,'%Y') as periAsig FROM `vaca_vaca` where `vaca_vaca_id`='".$vaca_vaca_id."'";
		return $sql;
	}

	public function vaca_setPeriVaca($vaca_vaca_id,$periAsig)
	{
		$sql="UPDATE `vaca_vaca` SET `vaca_perioAn_id`='".$periAsig."' WHERE `vaca_vaca_id`='".$vaca_vaca_id."'";
		return $sql;
	}

	public function vaca_getPeriId($periAn)
	{
		$sql="SELECT (`vaca_perioAn_id`) as idPeriAn FROM `vaca_perioan` WHERE `vaca_anPeri`='".$periAn."'";
		return $sql;
	}

	public function vaca_periTrab($trabId)
	{
		$sql="SELECT
				vaca.vaca_vaca_id,
				vaca.vaca_mesGocIni,
				peri.vaca_anPeri,
				DATEDIFF(vaca.`vaca_mesGocFin`,vaca.`vaca_mesGocIni`)+1 as diGoc,
				(case when (DATEDIFF(vaca.`vaca_mesGocFin`,CURDATE())<0) then '0' 
				 else DATEDIFF(vaca.`vaca_mesGocFin`,CURDATE())+1 end) as diPen,
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as trab,
				vaca.vaca_forCal as forCal, vaca.vaca_numFinSem as numFinSem 
				 FROM 
				 `vaca_vaca` as vaca,persona as per,vaca_perioan as peri 
				 where per.persona_id=vaca.vaca_trabId and
				 vaca.vaca_perioAn_id=peri.vaca_perioAn_id
				 and peri.vaca_anPeri='2012' and vaca_areTrab='2' and vaca_trabId='".$trabId."'";
		return $sql;
	}

	public function vaca_periTrabxTrab($trabId,$peri)
	{
		$sql="SELECT
				vaca.vaca_vaca_id,
				vaca.vaca_mesGocIni,
				peri.vaca_anPeri,
				peri.vaca_desPeri,
				DATEDIFF(vaca.`vaca_mesGocFin`,vaca.`vaca_mesGocIni`)+1 as diGoc,
				(case when (DATEDIFF(vaca.`vaca_mesGocFin`,CURDATE())<0) then '0' 
				 else DATEDIFF(vaca.`vaca_mesGocFin`,CURDATE())+1 end) as diPen,
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as trab,
				vaca.vaca_forCal as forCal, vaca.vaca_numFinSem as numFinSem
				 FROM 
				 `vaca_vaca` as vaca,persona as per,vaca_perioan as peri,trabajador as trab 
				 where per.persona_id=vaca.vaca_trabId 
				 and vaca.vaca_perioAn_id=peri.vaca_perioAn_id
				 and peri.vaca_perioAn_id='".$peri."' 
				 and vaca.vaca_trabId=per.persona_id 
				 and per.persona_id=trab.persona_id 
				 and trab.trabajador_id='".$trabId."'";
		return $sql;
	}

	public function vaca_periTrabxFil($vaca_trabId,$vaca_perioAn_id)
	{
		$sql="SELECT
				vaca.vaca_vaca_id,
				vaca.vaca_mesGocIni,
				peri.vaca_anPeri,
				peri.vaca_desPeri,
				DATEDIFF(vaca.vaca_mesGocFin,vaca.vaca_mesGocIni)+1 as diGoc,
				(case when (DATEDIFF(vaca.vaca_mesGocFin,CURDATE())<0) then '0' 
				 else DATEDIFF(vaca.vaca_mesGocFin,CURDATE())+1 end) as diPen,
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as trab,
				vaca.vaca_forCal as forCal, vaca.vaca_numFinSem as numFinSem
				 FROM 
				 vaca_vaca as vaca,persona as per,vaca_perioan as peri 
				 where per.persona_id=vaca.vaca_trabId 
				 and vaca.vaca_perioAn_id=peri.vaca_perioAn_id
				 and vaca.vaca_trabId='".$vaca_trabId."' 
				 and vaca.vaca_perioAn_id='".$vaca_perioAn_id."'";
		return $sql;
	}

	public function vaca_periTrabxAre($vaca_areId,$vaca_perioAn_id)
	{
		$sql="SELECT
				vaca.vaca_vaca_id,
				vaca.vaca_mesGocIni,
				peri.vaca_anPeri,
				peri.vaca_desPeri,
				DATEDIFF(vaca.vaca_mesGocFin,vaca.vaca_mesGocIni)+1 as diGoc,
				(case when (DATEDIFF(vaca.vaca_mesGocFin,CURDATE())<0) then '0' 
				 else DATEDIFF(vaca.vaca_mesGocFin,CURDATE())+1 end) as diPen,
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as trab,
				vaca.vaca_forCal as forCal, vaca.vaca_numFinSem as numFinSem
				 FROM 
				 vaca_vaca as vaca,persona as per,vaca_perioan as peri 
				 where per.persona_id=vaca.vaca_trabId 
				 and vaca.vaca_perioAn_id=peri.vaca_perioAn_id 
				 and vaca.vaca_areTrab='".$vaca_areId."'
				 and vaca.vaca_perioAn_id='".$vaca_perioAn_id."'";
		return $sql;
	}

	public function vaca_detFechGoc($vaca_vaca_id)
	{
		$sql="SELECT date_format(vaca_mesGocIni,'%d/%m/%Y') as vaca_mesGocIni,
			  date_format(vaca_mesGocFin,'%d/%m/%Y') as vaca_mesGocFin FROM 
			  `vaca_vaca` where vaca_vaca_id='".$vaca_vaca_id."'";
		return $sql;
	}

	public function vaca_eliVacaxId($idVaca)
	{
		$sql="delete from vaca_vaca where vaca_vaca_id='".$idVaca."'";
		return $sql;
	}

	public function vaca_evaAsigTrab($trabId,$fechEva)
	{
		$sql="select * from vaca_vaca where vaca_trabId='".$trabId."' and ( '".$fechEva."' between vaca_mesGocIni and vaca_mesGocFin)";
		return $sql;
	}

	public function vaca_getTrabAsig($areTrab,$anPeri)
	{
		$sql="SELECT distinct vaca_trabId,vaca_perioAn_id FROM `vaca_vaca` where vaca_areTrab='".$areTrab."' and vaca_perioAn_id='".$anPeri."'";
		return $sql;
	}

	public function vaca_getTrabAsigEsp($valTrab,$anPeri)
	{
		$sql="SELECT distinct vaca_trabId,vaca_perioAn_id FROM `vaca_vaca` where vaca_trabId='".$valTrab."' and vaca_perioAn_id='".$anPeri."'";
		return $sql;
	}

	public function vaca_getPeriAn($anPeri)
	{
		$sql="SELECT vaca_desPeri,vaca_perioAn_id FROM `vaca_perioan` where vaca_perioAn_id='".$anPeri."' and vaca_perioAn_id!='5' and vaca_estado_id=1";
		return $sql;
	}

	public function vaca_getPeriAnxTod()
	{
		$sql="SELECT vaca_desPeri,vaca_perioAn_id,vaca_estado_id FROM `vaca_perioan` where vaca_perioAn_id!='5' and vaca_estado_id=1";
		return $sql;
	}

	public function vaca_getPeriAnxCom()
	{
		$sql="SELECT vaca_desPeri,vaca_perioAn_id,vaca_estado_id FROM `vaca_perioan` where vaca_perioAn_id!='5'";
		return $sql;
	}

	public function vaca_getVacaIni($trabId)
	{
		/*$sql="select trab.trab_fec_ini as fechOri,date_format(DATE_ADD(trab.trab_fec_ini,INTERVAL 1 YEAR),'%d/%m/%Y') as fechModi 
			  from persona as per,trabajador as trab where per.persona_id=trab.persona_id and per.persona_id='".$trabId."'";*/

		$sql="select trab.trab_fec_ini as fechOri,trab.trab_fec_ini as fechModi 
			  from persona as per,trabajador as trab where per.persona_id=trab.persona_id and per.persona_id='".$trabId."'";
		return $sql;
	}

	public function vaca_getFechPost($fech,$anAp)
	{
		$sql="select date_format(DATE_ADD('".$fech."',INTERVAL '".$anAp."' YEAR),'%d/%m/%Y') as fechModi";
		return $sql;
	}

	public function vaca_getVacaInixUser($trabId)
	{
		/*$sql="select trab.trab_fec_ini as fechOri,date_format(DATE_ADD(trab.trab_fec_ini,INTERVAL 1 YEAR),'%d/%m/%Y') as fechModi 
			  from persona as per,trabajador as trab where trab.trabajador_id='".$trabId."'";*/

		$sql="select trab.trab_fec_ini as fechOri,trab.trab_fec_ini as fechModi 
			  from persona as per,trabajador as trab where trab.trabajador_id='".$trabId."'";
		return $sql;
	}

	public function vaca_evaDiHab($perId,$trabId)
	{
		$sql="select sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1-vaca_numFinSem) as sumDi from vaca_vaca where vaca_perioAn_id='".$perId."' 
				and vaca_trabId='".$trabId."'";
		return $sql;
	}

	public function vaca_evaDiHabOpu($perId,$trabId)
	{
		$sql="select sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1) as sumDi from vaca_vaca where vaca_perioAn_id='".$perId."' 
				and vaca_trabId='".$trabId."'";
		return $sql;
	}

	public function vaca_actForCalNu($valFor,$trabId,$periAn)
	{
		$sql="update vaca_vaca set vaca_forCal='".$valFor."' where vaca_trabId='".$trabId."' and vaca_perioAn_id='".$periAn."'";
		return $sql;
	}

	public function vaca_actForCal($valFor,$trabId,$periAn,$vacaId,$numFinSem)
	{
		$sql="update vaca_vaca set vaca_forCal='".$valFor."',vaca_numFinSem='".$numFinSem."' where vaca_trabId='".$trabId."' 
			and vaca_perioAn_id='".$periAn."' and vaca_vaca_id='".$vacaId."'";
		return $sql;
	}

	public function vaca_veriExiAsig($periAn,$trabId)
	{
		$sql="select count(*) as contVaca from vaca_vaca where vaca_perioAn_id='".$periAn."' and vaca_trabId='".$trabId."'";
		return $sql;
	}

	public function vaca_getForCal($trabId,$perId)
	{
		$sql="SELECT distinct vaca_forCal as forCal FROM `vaca_vaca` where vaca_trabId='".$trabId."' and vaca_perioAn_id='".$perId."'";
		return $sql;
	}

	public function vaca_getForCalxTrab($trabId,$perId)
	{
		$sql="SELECT distinct vaca.vaca_forCal as forCal FROM `vaca_vaca` as vaca,persona as per,trabajador as trab 
			  where vaca.vaca_trabId=per.persona_id and  per.persona_id=trab.persona_id and trab.trabajador_id='".$trabId."' 
			  and vaca_perioAn_id='".$perId."'";
		return $sql;
	}

	public function vaca_evaIteraPeri($trabId,$perId)
	{
		$sql="select 
				case 
				when (isNull(sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1-vaca_numFinSem))) then '1'
				when ((sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1-vaca_numFinSem))<vaca_forCal) then '1'
				when ((sum(DATEDIFF(`vaca_mesGocFin`,`vaca_mesGocIni`)+1-vaca_numFinSem))=vaca_forCal) then '2' 
				else '0' end as sumDi 
				from vaca_vaca where  vaca_trabId='".$trabId."' and vaca_perioAn_id='".$perId."'";
		return $sql;
	}

	public function vaca_inserPerNu($anIni,$desPer)
	{
		$sql="insert into vaca_perioan(vaca_anPeri,vaca_desPeri,vaca_estado_id) 
			  values ('".$anIni."','".$desPer."','1')";
		return $sql;
	}

	public function vaca_inacTodPer()
	{
		$sql="update vaca_perioan set vaca_estado_id='2'";
		return $sql;
	}

	public function vaca_actPerxId($perId)
	{
		$sql="update vaca_perioan set vaca_estado_id='1' where vaca_perioAn_id='".$perId."'";
		return $sql;
	}

	public function vaca_testNomMes($fechIni,$fechFin)
	{
		$sql="select DATEDIFF('".$fechFin."','".$fechIni."')+1 as difDias,'".$fechIni."' as fechIni,'".$fechFin."' as fechFin";
		return $sql;
	}

	public function vaca_testIncreFech($fechIni,$increDi)
	{
		$sql="select DATE_ADD('".$fechIni."',INTERVAL '".$increDi."' DAY) as fechIncre,DAYNAME(DATE_ADD('".$fechIni."',INTERVAL '".$increDi."' DAY)) as nomDia";
		return $sql;
	}

	public function vaca_extVacPerxTrab($trabId,$perId)
	{
		$sql="select vaca_vaca_id,vaca_mesGocIni,vaca_mesGocFin from vaca_vaca where vaca_trabId='".$trabId."' and vaca_perioAn_id='".$perId."'";
		return $sql;
	}

/*--------------------------[*]----------------------------------------*/

/*----------------------------------------------------------------------*/
	# SQL MODULO CENTRO DE COSTOS 
/*----------------------------------------------------------------------*/

	public function cc_flCotiAdju()
	{
		$sql="select cotizacion_id,cot_nro from cotizacion where cot_estado_id='2' and empresa_id='1' and bestado=1";
		return $sql;
	}

	public function cc_prodCatalog()
	{
		$sql="SELECT producto_id,prod_nombre,prod_descrip FROM `producto` where marca_id>0 and modelo_id>0 
				and empresa_id='1' and bestado='1' and prod_clasificacion_id='1'";
		return $sql;
	}

	public function cc_servCatalog()
	{
		$sql="SELECT producto_id,prod_nombre,prod_descrip FROM `producto` where prod_descrip!='' and empresa_id='1' and bestado='1' 
				and prod_clasificacion_id='2'";
		return $sql;
	}

	public function cc_empProv()
	{
		$sql="select distinct emp.emp_nombre,emp.empresa_id from empresa as emp,empresa_perfil as perf,anfi_empresa as anf
				where anf.empresa_id=emp.empresa_id and anf.emp_perfil_id=perf.empresa_perfil_id and anf.emp_perfil_id=2 
				and (anf.empresa_id_padre='1' or anf.empresa_id_padre='2') and emp.bestado=1";
		return $sql;
	}

	public function cc_geneFl($fl)
	{
		$sql="SELECT emp.emp_nombre,coti.cot_descrip,coti.cot_nro,proye.proy_nombre,coti.cotizacion_id as cotiId,coti.moneda_id,
				(select round(sum(cotDet.pro_cantidad*cotDet.pro_precio_venta),2) 
				from cot_detalle as cotDet 
				where cotDet.bestado=1 
				and cotDet.cotizacion_id=cotiId) as totCoti 
				FROM cotizacion as coti,empresa as emp,proyecto as proye WHERE coti.cot_nro='".$fl."' 
				and coti.cliente_id=emp.empresa_id and coti.proyecto_id=proye.proyecto_id";
		return $sql;
	}

	public function cc_detFl($cotiId)
	{
		$sql="SELECT
			cotDet.cot_detalle_id as cotDetId,
			cotDet.cotizacion_id,
			cotDet.pro_descripcion,
			prod.producto_id as prodId,
			(select marca_id from producto where producto_id=prodId) as marcaId,
			(select modelo_id from producto where producto_id=prodId) as modeloId,
			prodClas.prod_clasif_nombre as clasiNom,
			prod.prod_clasificacion_id,
			prod.prod_nombre,
			prod.producto_id,
			(select mm_nombre from mm where mm_id=marcaId) as marca,
			(select mm_nombre from mm where mm_id=modeloId) as modelo,
			(select distinct emp.emp_nombre from empresa as emp,imp_proforma_detalle as profDet,cot_detalle as cotDet,imp_proforma as prof
			where emp.empresa_id=prof.proveedor_id and prof.imp_proforma_id=profDet.imp_proforma_id and profDet.cot_detalle_id=cotDetId) as proveedor,
			(select distinct emp.empresa_id from empresa as emp,imp_proforma_detalle as profDet,cot_detalle as cotDet,imp_proforma as prof
			where emp.empresa_id=prof.proveedor_id and prof.imp_proforma_id=profDet.imp_proforma_id and profDet.cot_detalle_id=cotDetId) as proveedorId,
			mone.mon_sigla,
			mone.moneda_id,
			cotDet.pro_cantidad as cant,
			cotDet.pro_precio_venta as preUni,
			cotDet.pro_subtotal as subTot,
			'' as plazo
			FROM 
			cot_detalle as cotDet, 
			producto as prod,
			moneda as mone,
			prod_clasificacion as prodClas
			WHERE 
			cotDet.cotizacion_id ='".$cotiId."' and
			cotDet.producto_id=prod.producto_id and
			cotDet.bestado=1 and
			cotDet.moneda_id=mone.moneda_id and
			prod.prod_clasificacion_id=prodClas.prod_clasificacion_id;";
		return $sql;
	}

	public function cc_clasiProdServ()
	{
		$sql="select prod_clasificacion_id as clasId,prod_clasif_nombre as clasNom from prod_clasificacion";
		return $sql;
	}

	public function cc_prodxId($prodId)
	{
		$sql="select prod_nombre from producto where producto_id='".$prodId."'";
		return $sql;
	}

	public function cc_clasiProdxId($clasifId)
	{
		$sql="select prod_clasif_nombre from prod_clasificacion where prod_clasificacion_id='".$clasifId."'";
		return $sql;
	}

	public function cc_provexId($proveId)
	{
		$sql="select emp_nombre from empresa where empresa_id='".$proveId."'";
		return $sql;
	}

	public function cc_monexId($moneId)
	{
		$sql="select mon_sigla from moneda where moneda_id='".$moneId."'";
		return $sql;
	}

	public function cc_marcaModelxId($prodId)
	{
		$sql="select producto_id as prodId,
			(select marca_id from producto where producto_id=prodId) as marcaId,
			(select modelo_id from producto where producto_id=prodId) as modeloId,
			(select mm_nombre from mm where mm_id=marcaId) as marca,
			(select mm_nombre from mm where mm_id=modeloId) as modelo 
			from producto 
			where 
			producto_id='".$prodId."'";
		return $sql;
	}

	public function cc_getMone()
	{
		$sql="SELECT moneda_id,mon_sigla FROM `moneda`";
		return $sql;
	}

	public function cc_geneComp($provId,$proyeId,$opeId,$moneId,$pcId,$fechIni,$tipDoc)
	{
		$sql="insert into compras (proveedor_id,proyecto_id,compra_tipo_id,bestado,empresa_id,operador_id,moneda_id,pc_id,comp_fecha_ini,
			comp_estado_id,empresa_id_invoice,empresa_id_delivery) values 
			('".$provId."','".$proyeId."','".$tipDoc."','1','1','".$opeId."','".$moneId."','".$pcId."','".$fechIni."','1','1','1')";
		return $sql;
	}

	public function cc_prefiDoc($idDoc)
	{
		$sql="select docu_tipo_prefijo from documento_tipo where documento_tipo_id='".$idDoc."'";
		return $sql;
	}

	public function cc_geneCorreComp($idComp,$numCorre,$cli)
	{
		$sql="update compras set comp_nro='".$numCorre."',
			comp_marks=concat('Electrowerke S.A',' ','".$numCorre."',' ','CALLAO - PERU',' ','".$cli."') where 
			compras_id='".$idComp."'";
		return $sql;
	}

	public function cc_idProyexNom($proyNom)
	{
		$sql="select proyecto_id from proyecto where proy_nombre='".$proyNom."'";
		return $sql;
	}

	public function cc_idFlxNom($flNom)
	{
		$sql="select cotizacion_id from cotizacion where cot_nro like '%".$flNom."%'";
		return $sql;
	}

	public function cc_geneDetComp($compId,$prodId,$cant,$preVent,$moneId,$prodDes)
	{
		$sql="insert into compras_detalle(compras_id,producto_id,prod_cantidad,prod_precio_venta,moneda_id,bestado,
				comp_det_adjudicado,prod_descripcion) values ('".$compId."','".$prodId."','".$cant."','".$preVent."','".$moneId."',
				'1','1','".$prodDes."')";
		return $sql;
	}

	public function cc_aliasProd($prodId,$prodDes)
	{
		$sql="update producto set prod_alias='".$prodDes."'' where producto_id='".$prodId."'";
		return $sql;
	}

	public function cc_geneCentCost($idProye,$idFl,$flMulti,$idCli,$ocCli,$ocFechCli,$montCoti,$moneId,$fileAdju)
	{
		$sql="insert into cc_centcost(cc_idProye,cc_cotiFlId,cc_cotiFlMulti,cc_idCliEmp,cc_ocCli,cc_ocFechCli,cc_montCoti,cc_moneId,cc_idEstApe,cc_fileAdju) values 
			('".$idProye."','".$idFl."','".$flMulti."','".$idCli."','".$ocCli."','".$ocFechCli."','".$montCoti."','".$moneId."','1','".$fileAdju."')";
		return $sql;
	}

	public function cc_correCentCost($idCentCost,$idCorreCost)
	{
		$sql="update cc_centcost set cc_correCenCost='".$idCorreCost."' where cc_centCostId='".$idCentCost."'";
		return $sql;
	}

	public function cc_costCreadTod()
	{
		$sql="SELECT 
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
				inner join cotizacion as coti on cc.cc_cotiFlId=coti.cotizacion_id";
		return $sql;
	}

	public function cc_costCreadxFil($desFl)
	{
		$sql="SELECT 
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
				where coti.cot_nro='".$desFl."'";
		return $sql;
	}

	public function cc_flCotiCentCost()
	{
		$sql="SELECT distinct coti.cot_nro FROM cc_centcost as cc,cotizacion as coti where cc.cc_cotiFlId=coti.cotizacion_id";
		return $sql;
	}

	public function cc_idClixNom($des)
	{
		$sql="SELECT empresa_id as idCli FROM `empresa` where emp_nombre like '%".$des."%'";
		return $sql;
	}

	public function cc_geneDetCentCost($idCentCost,$idEstCost,$tipOrd,$provId,$moneId,$plazo,$desOrd)
	{
		$sql="insert into cc_detcentcost(cc_centCostId,cc_idEstCost,cc_tipOrden,cc_provId,cc_moneId,cc_plazo,cc_desOrd)
		values('".$idCentCost."','".$idEstCost."','".$tipOrd."','".$provId."','".$moneId."','".$plazo."','".$desOrd."')";
		return $sql;
	}

	public function cc_pcCentCost()
	{
		$sql="SELECT cc_correCenCost as pcCentCost FROM `cc_centcost`";
		return $sql;
	}

	public function cc_pcCentCostTod()
	{
		$sql="SELECT 
				centCost.cc_centCostId as idCent,
				centCost.cc_correCenCost as correCen,
				coti.cot_nro as correCot,
				centCost.cc_idCliEmp as idCli,
				estApe.cc_desEstApe as desEstApe,
				centCost.cc_moneId as moneId,
				centCost.cc_idEstApe as idEstApe,
				(select mon_sigla from moneda where moneda_id=moneId) as desMone,
				centCost.cc_montCoti as montCoti,
				(select count(*) from cc_detcentcost where cc_centCostId=idCent) as cantOrd
				FROM 
				cc_centcost as centCost,
				cotizacion as coti,
				cc_estaapeproye as estApe
				where 
				centCost.cc_cotiFlId=coti.cotizacion_id and 
				centCost.cc_idEstApe=estApe.cc_idEstApe";
		return $sql;
	}

	public function cc_pcCentCostxFil($filt)
	{
		$sql="SELECT 
				centCost.cc_centCostId as idCent,
				centCost.cc_correCenCost as correCen,
				coti.cot_nro as correCot,
				centCost.cc_idCliEmp as idCli,
				estApe.cc_desEstApe as desEstApe,
				centCost.cc_moneId as moneId,
				centCost.cc_idEstApe as idEstApe,
				(select mon_sigla from moneda where moneda_id=moneId) as desMone,
				centCost.cc_montCoti as montCoti,
				(select count(*) from cc_detcentcost where cc_centCostId=idCent) as cantOrd
				FROM 
				cc_centcost as centCost,
				cotizacion as coti,
				cc_estaapeproye as estApe
				where 
				centCost.cc_cotiFlId=coti.cotizacion_id and 
				centCost.cc_idEstApe=estApe.cc_idEstApe and 
				centCost.cc_idEstApe='".$filt."'";
		return $sql;
	}

	public function cc_centCostGene()
	{
		$sql="SELECT cenCost.cc_detCentCostId,cenCost.cc_tipOrden,cenCost.cc_desOrd FROM cc_detcentcost as cenCost
				where cenCost.cc_idEstCost>0";
		return $sql;
	}

	public function cc_detCenCost($estaOrd,$idCenCost)
	{
		#concat('Accion(U,500,400,persona_form,0,138',comp.compras_id,'59,compras,compras_id=',comp.compras_id,')')
		#concat('Accion(U,500,400,persona_form,0,90,',comp.compras_id,'53,compras,compras_id=',comp.compras_id,')')

		$sql="SELECT 
			detCenCost.cc_detCentCostId,
			detCenCost.cc_tipOrden,
			detCenCost.cc_desOrd,
			detCenCost.cc_ocGeneId,
			detCenCost.cc_provId,
			comp.compras_id as compId,
			(case
				when (LEFT(comp.comp_nro, 2)='OC') then
				'OC'
				else 
				'EW'
			end) as sufiDoc 
			FROM 
			cc_detcentcost as detCenCost,
			compras as comp 
			where 
			detCenCost.cc_idEstCost='".$estaOrd."' and 
			detCenCost.cc_centCostId='".$idCenCost."' and 
			comp.comp_nro=detCenCost.cc_ocGeneId and 
			comp.bestado=1";
		return $sql;
	}

	public function cc_detCenCostNoGen($estaOrd,$idCenCost)
	{
		$sql="SELECT detCenCost.cc_detCentCostId,detCenCost.cc_tipOrden,detCenCost.cc_desOrd,detCenCost.cc_ocGeneId,detCenCost.cc_provId 
				FROM cc_detcentcost as detCenCost where detCenCost.cc_idEstCost='".$estaOrd."' and detCenCost.cc_centCostId='".$idCenCost."'";
		return $sql;
	}


	public function cc_getDetCentCostxId($idDetCen)
	{
		$sql="SELECT 
				detCent.cc_provId as provId,
				centCost.cc_idProye as proyeId,
				detCent.cc_moneId as moneId,
				centCost.cc_centCostId as pcId,
				centCost.cc_ocFechCli as ocFechCli,
				detCent.cc_tipOrden as tipDoc 
				FROM 
				cc_detcentcost as detCent,
				cc_centcost as centCost 
				where 
				detCent.cc_detCentCostId='".$idDetCen."' 
				and 
				detCent.cc_centCostId=centCost.cc_centCostId";
		return $sql;
	}

	public function cc_actEstOrde($idDet,$correComp)
	{
		$sql="update cc_detcentcost set cc_idEstCost=1,cc_ocGeneId='".$correComp."' where cc_detCentCostId='".$idDet."'";
		return $sql;
	}

	public function cc_getCentCostxId($idCen)
	{
		$sql="SELECT 
				centCost.cc_correCenCost as pcVal,
				coti.cot_nro as flVal,
				emp.emp_nombre as cliEmp,
				proye.proy_nombre as proyNom,
				centCost.cc_ocCli as ocCli,
				centCost.cc_cotiFlMulti as flMulti,
				centCost.cc_ocFechCli as ocCliFech,
				centCost.cc_montCoti as montCoti,
				centCost.cc_moneId as moneId,
				centCost.cc_fileAdju as fileAdju,
				estaProy.cc_desEstApe as estApe
				FROM 
				cc_centcost as centCost,
				cotizacion as coti,
				empresa as emp,
				proyecto as proye,
				cc_estaapeproye as estaProy 
				where 
				centCost.cc_cotiFlId=coti.cotizacion_id and 
				centCost.cc_idProye=proye.proyecto_id and  
				centCost.cc_idCliEmp=emp.empresa_id and 
				estaProy.cc_idEstApe=centCost.cc_idEstApe and 
				centCost.cc_centCostId='".$idCen."'";
		return $sql;
	}

	public function cc_getDetProyexId($idCen)
	{
		$sql="SELECT
				cc_tipPre as tipPre,
				`cc_detCentCostId` as idDet, 
				`cc_centCostId`, 
				`cc_tipOrden` as tipDoc, 
				`cc_provId` as proveId, 
				`cc_moneId` as moneId, 
				`cc_plazo` as plazo, 
				`cc_ocGeneId`, 
				`cc_idEstCost`, 
				`cc_desOrd` as desOrd,
				`cc_ocGeneId` as correOrd,
				LEFT(`cc_ocGeneId`, 2) as sufiOrd,
				(select compras_id from compras where comp_nro=correOrd) as compId, 
				(select cs_cotiservId from cs_cotiserv where cs_correServ=correOrd) as servId,
				(select tbvisi_visita_id from tbvisi_visita where visiCorre=correOrd) as visiId,
				(select (case when isNull(sum(prod_cantidad*prod_precio_venta)) then round('0',2) 
				else sum(prod_cantidad*prod_precio_venta) end)  as totOrd from compras_detalle where compras_id=compId ) as totOrd,
				(select (case when isNull(sum(cs_totDetCoti)) then round('0',2) 
				else sum(cs_totDetCoti) end) as totOrdServ from cs_detcotiserv where cs_cotiServId=servId ) as totOrdServ,
				(select (case when isNull(pasaVisi+hospeVisi+alimeVisi+transInterVisi) then round('0',2) 
				else (pasaVisi+hospeVisi+alimeVisi+transInterVisi) end) as totVisiServ from tbvisi_visita where tbvisi_visita_id=visiId ) as totVisiVen,
				(SELECT imp_tc_nombre FROM `imp_tipo_costo` where imp_tipo_costo_id=tipPre ) as  tipPreci
				FROM `cc_detcentcost` WHERE `cc_idEstCost`>0 and `cc_centCostId`='".$idCen."'";
		return $sql;
	}

	public function cc_getDetProyexIdDet($idDetCent)
	{
		$sql="SELECT `cc_detCentCostId`, `cc_centCostId`, `cc_tipOrden`, `cc_provId`, `cc_moneId`, `cc_plazo`, `cc_ocGeneId`, 
			`cc_idEstCost`, `cc_desOrd` FROM `cc_detcentcost` WHERE `cc_idEstCost`>0 and `cc_detCentCostId`='".$idDetCent."'";
		return $sql;
	}

	public function cc_updateDetProye($idDetCent,$idTip,$idProv,$idMone,$plazDi,$desOrd)
	{
		$sql="update  `cc_detcentcost` set `cc_tipOrden`='".$idTip."', `cc_provId`='".$idProv."', `cc_moneId`='".$idMone."', 
			`cc_plazo`='".$plazDi."', `cc_desOrd`='".$desOrd."'  WHERE  `cc_detCentCostId`='".$idDetCent."';";
		return $sql;
	}

	public function cc_deleteDetProyexId($idDet)
	{
		$sql="delete from cc_detcentcost where cc_detCentCostId='".$idDet."'";
		return $sql;
	}

	public function cc_EliDetCentCost($idCent)
	{
		$sql="delete from cc_detcentcost where cc_centCostId='".$idCent."'";
		return $sql;
	}

	public function cc_EliCentCost($idCent)
	{
		$sql="delete from cc_centcost where cc_centCostId='".$idCent."'";
		return $sql;
	}

	public function cc_updateCompGene($correOrd,$tipDoc,$proveId,$moneId)
	{
		$sql="update compras set compra_tipo_id='".$tipDoc."',proveedor_id='".$proveId."',moneda_id='".$moneId."'
				where comp_nro='".$correOrd."'";
		return $sql;
	}

	public function cc_getCorreOrdxId($idDet)
	{
		$sql="select cc_ocGeneId from cc_detcentcost where cc_detCentCostId='".$idDet."'";
		return $sql;
	}

	public function cc_updateMoneDetComp($valCorreComp,$moneId)
	{
		$sql="update compras_detalle as compDet,compras as comp set compDet.moneda_id='".$moneId."' where comp.comp_nro='".$valCorreComp."'
				and comp.compras_id=compDet.compras_id";
		return $sql;
	}

	public function cc_totConverOrd($idCentCost)
	{
		$sql="select 
				cc_centCostId as idCentCost,
				(select sum(compDet.prod_cantidad*compDet.prod_precio_venta) from compras as comp,compras_detalle as compDet,cc_detcentcost as detCent 
				where comp.pc_id=idCentCost and comp.compras_id=compDet.compras_id and comp.moneda_id=1 and 
				detCent.cc_ocGeneId=comp.comp_nro) as totSoles,
				(select sum(compDet.prod_cantidad*compDet.prod_precio_venta) from compras as comp,compras_detalle as compDet,cc_detcentcost as detCent 
				where comp.pc_id=idCentCost and comp.compras_id=compDet.compras_id and comp.moneda_id=2 and 
				detCent.cc_ocGeneId=comp.comp_nro) as totDolares,
				(select sum(compDet.prod_cantidad*compDet.prod_precio_venta) from compras as comp,compras_detalle as compDet,cc_detcentcost as detCent 
				where comp.pc_id=idCentCost and comp.compras_id=compDet.compras_id and comp.moneda_id=3 and
				detCent.cc_ocGeneId=comp.comp_nro) as totHebros
				from cc_centcost 
				where cc_centCostId='".$idCentCost."'";
		return $sql;	
	}

	public function cc_inabCentCost()
	{
		$sql="update cc_centcost set cc_idEstApe='2'";
		return $sql;
	}

	public function cc_habCentCost($idCent)
	{
		$sql="update cc_centcost set cc_idEstApe='1' where cc_centCostId='".$idCent."'";
		return $sql;
	}

	public function cc_actuCentCost($idCent,$ocCli,$fechCli,$totCli,$mone,$fileAdju)
	{
		$sql="update cc_centcost set cc_ocCli='".$ocCli."',cc_ocFechCli='".$fechCli."',cc_montCoti='".$totCli."',
				cc_moneId='".$mone."',cc_fileAdju='".$fileAdju."' where cc_centCostId='".$idCent."'";
		return $sql;
	}

	public function cc_closeProye($idCent)
	{
		$sql="update cc_centCost set cc_idEstApe='2' where cc_centCostId='".$idCent."'";
		return $sql;
	}

	public function cc_getEstProy($idCent)
	{
		$sql="select 
				estProye.cc_desEstApe as estaProye 
				from 
				cc_centcost as cenCost,
				cc_estaapeproye as estProye
				where 
				cenCost.cc_idEstApe=estProye.cc_idEstApe and 
				cenCost.cc_centCostId='".$idCent."'";
		return $sql;
	}

	public function cc_getEstCent()
	{
		$sql="select cc_idEstApe as idEstApe,cc_desEstApe as desEstApe from cc_estaapeproye";
		return $sql;
	}

	public function cc_adjuAgre($idCent)
	{
		$sql="SELECT cc_fileAdju FROM `cc_centcost` where cc_centCostId='".$idCent."'";
		return $sql;
	}

	//-----------------------------23/06/2014-------------------------------------------------------

	public function cc_visiFil_obtener($idVend)
	{
		$sql="CALL cc_visiFil_obtener('".$idVend."')";
		return $sql;
	}

	public function cc_perEw_capturar()
	{
		$sql="CALL cc_perEw_capturar()";
		return $sql;
	}

	//----------------------------24/06/2014----------------------------------------------------------------------

	public function cc_visiCent_asociar($idCent,$mone,$correVisi)
	{
		$sql="select cc_visiCent_asociar('".$idCent."','".$mone."','".$correVisi."') as response";
		return $sql;
	}

	//New update 22/12/2014

	#PROCEDURE

		//C
		//R
		//U
		//D

	#UPDATE

		//C
			public function cc_flCent_cre($cc_alias)
			{
				$sql="select cc_flCent_cre('".$cc_alias."') as response";
				return $sql;
			}

			public function cc_proyeCent_cre($proyDes)
			{
				$sql="select cc_proyeCent_cre('".$proyDes."') as response";
				return $sql;
			}

			public function cc_centAnu_cre($correCent,
												$flId,
												$idCli,
												$idProye,
												$fechCli)
			{
				$sql="select cc_centAnu_cre('".$correCent."',
												'".$flId."',
												'".$idCli."',
												'".$idProye."',
												'".$fechCli."') as response";
				return $sql;
			}
		//R
			public function cc_empxId_re($idEmp)
			{
				$sql="select cc_empxId_re('".$idEmp."') as response";
				return $sql;
			}
		//U
		//D

/*-------------------------[*]-------------------------------------------*/

/*------------------------------------------------------------------------*/ 
	# SQL MODULO MOVIMIENTO PERSONAL  
/*------------------------------------------------------------------------*/

	public function mp_arexUser($id)
	{
		$sql="select funTrab.trab_funcion_nombre as funDes from trabajador as trab inner join trab_funcion as funTrab 
				on trab.trab_funcion_id=funTrab.trab_funcion_id where trab.trabajador_id='".$id."'";
		return $sql;
	}

	public function mp_movPer($userId,$areId,$fechsali,$fechRetor,$hourSali,$hourRetor,$centCostId)
	{
		$sql="insert into mp_movi(mp_userPerId,mp_areTrabId,mp_fechSali,mp_fechRetor,mp_hourSali,mp_hourRetor,mp_tipAprobId,mp_ubiPerId,mp_centCostId) 
			values ('".$userId."','".$areId."','".$fechsali."','".$fechRetor."','".$hourSali."','".$hourRetor."','3','1','".$centCostId."')";
		return $sql;
	}

	public function mp_detMovPer($movId,$motiv,$ubi,$det)
	{
		$sql="insert into mp_detmov(mp_moviId,mp_motiv,mp_ubi,mp_det) values ('".$movId."','".$motiv."','".$ubi."','".$det."')";
		return $sql;
	}

	public function mp_areTrabxId($trabId)
	{
		$sql="select trab.trabajador_id as trabId,trabFun.trab_funcion_id as areId from trabajador as trab 
			inner join trab_funcion as trabFun on trab.trab_funcion_id=trabFun.trab_funcion_id
			where trab.trabajador_id='".$trabId."'";
		return $sql;
	}

	public function mp_movPerShow()
	{
		$sql="select 
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
				group by movPer.mp_moviId order by movPer.mp_moviId desc";
		return $sql;
	}

	public function mp_movPerShowxTrabFech($fechSali,$perId)
	{
		$sql="select 
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
				where movPer.mp_fechSali='".$fechSali."' and per.persona_id='".$perId."'
				group by movPer.mp_moviId order by movPer.mp_moviId desc";
		return $sql;
	}

	public function mp_movPerShowxTrab($perId)
	{
		$sql="select 
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
				where per.persona_id='".$perId."'
				group by movPer.mp_moviId order by movPer.mp_moviId desc";
		return $sql;
	}

	public function mp_movPerShowxAreFech($fechSali,$areId)
	{
		$sql="select 
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
				where movPer.mp_fechSali='".$fechSali."' and trab.trab_funcion_id='".$areId."'
				group by movPer.mp_moviId order by movPer.mp_moviId desc";
		return $sql;
	}

	public function mp_movPerShowxAre($areId)
	{
		$sql="select 
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
				ubiPer.mp_classUbi as classUbi,
				(select sum(mp_montGat) from mp_gastmov where mp_moviId=item and mp_moneId=1 ) as totSol,
				(select sum(mp_montGat) from mp_gastmov where mp_moviId=item and mp_moneId=2) as totDol,
				(select sum(mp_montGat) from mp_gastmov where mp_moviId=item and mp_moneId=3) as totHeb
				from mp_movi as movPer
				inner join trabajador as trab on trab.trabajador_id=movPer.mp_userPerId
				inner join trab_funcion as trabFun on trabFun.trab_funcion_id=trab.trab_funcion_id
				inner join persona as per on per.persona_id=trab.persona_id
				inner join mp_tipaprob as tipAprob on movPer.mp_tipAprobId=tipAprob.mp_tipAprobId
				inner join mp_ubiper as ubiPer on ubiPer.mp_ubiPerId=movPer.mp_ubiPerId
				where trab.trab_funcion_id='".$areId."'
				group by movPer.mp_moviId order by movPer.mp_moviId desc";
		return $sql;
	}

	public function mp_detMovShow($idMov)
	{
		$sql="select 
				detMov.mp_detMovId as item,
				detMov.mp_motiv as motiv,
				detMov.mp_ubi as ubi,
				detMov.mp_det as det,
				(select count(mp_detMovId) from mp_validdetmov where mp_detMovId=item and mp_tipAprobId=1 ) as cantVali,
				(select count(mp_detMovId) from mp_validdetmov where mp_detMovId=item and mp_tipAprobId=2 ) as rechaVali
				from mp_detmov as detMov where detMov.mp_moviId='".$idMov."'";
		return $sql;
	}

	public function mp_validDetMov($fechValid,$detMovId,$tipAprov,$userAdm)
	{
		$sql="insert into mp_validdetmov(mp_fechValid,mp_detMovId,mp_tipAprobId,mp_userAdmId)
			values ('".$fechValid."','".$detMovId."','".$tipAprov."','".$userAdm."');";
		return $sql;
	}

	public function mp_validAdm($detId,$aprobId)
	{
		$sql="SELECT tipAprob.mp_desTipAprob as desAprob,
			concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as userAdm,
			validDet.mp_fechValid as fechVali  
			FROM mp_validdetmov as validDet,
			trabajador as trab,
			persona as per,
			mp_tipaprob as tipAprob
			where validDet.mp_tipAprobId='".$aprobId."' and 
			validDet.mp_detMovId='".$detId."' and
			trab.trabajador_id=validDet.mp_userAdmId and
			trab.persona_id=per.persona_id and
			tipAprob.mp_tipAprobId=validDet.mp_tipAprobId";
		return $sql;
	}

	public function mp_aprobGereAre()
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,
				per.persona_id as perId from persona as per where persona_id in ('608','360','490','394')";
		return $sql;
	}

	public function mp_aprobGereFinan()
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,
				per.persona_id as perId from persona as per where persona_id in ('24','394','360')";
		return $sql;
	}

	public function mp_aprobGereGene()
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as persona,
				per.persona_id as perId 
				from persona as per 
				where persona_id in ('24','287')";
		return $sql;
	}

	public function mp_pruebConf()
	{
		$sql="select 
			mp_desPrueb as pruebConf,
			mp_pruebConfirId as confId 
			from mp_pruebconfir";
		return $sql;
	}

	public function mp_validAprobMov($idMov,$ope,$arrAprov,$ind)
	{
		switch($ope)
		{
			case '1':
				$sql="delete from mp_movconfir where mp_moviId='".$idMov."'";
			break;

			case '2':
				$sql="insert into mp_movconfir (mp_perGerenId,mp_pruebConfirId,mp_areAprobId,mp_moviId) 
						values ('".$arrAprov[$ind]."','".$arrAprov[$ind+1]."','".$arrAprov[$ind+2]."','".$idMov."')";
			break;

			case '3':
				$sql="update mp_movi set mp_tipAprobId='1',mp_ubiPerId='2' where mp_moviId='".$idMov."'";
			break;

			default:
			break;
		}

		return $sql;
	}

	public function mp_cancelAprobMov($idMov,$ope)
	{

		switch($ope)
		{

			case '1':
				$sql="delete from mp_movconfir where mp_moviId='".$idMov."'";
			break;

			case '2':
				$sql="update mp_movi set mp_tipAprobId='2' where mp_moviId='".$idMov."'";
			break;

			default:
			break;

		}

		return $sql;
	}

	public function mp_mesMov()
	{
		$sql="select distinct
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
				from mp_movi as movi";
		return $sql;
	}

	public function mp_anMov()
	{
		$sql="select distinct 
				date_format( movi.mp_fechSali, '%Y' ) as anVal
				from mp_movi as movi";
		return $sql;
	}

	public function mp_centCost()
	{
		$sql="SELECT 
			    centCost.cc_centCostId as centId,
			    centCost.cc_correCenCost as centCost,
			    proy.proy_nombre 
			    FROM 
			    cc_centcost as centCost,
			    cotizacion as coti,
			    proyecto as proy
			    where 
			    coti.cotizacion_id=centCost.cc_cotiFlId and 
			    coti.proyecto_id=proy.proyecto_id";
		return $sql;
	}

	public function mp_confirRetor($idMov)
	{
		$sql="update mp_movi set mp_ubiPerId='1',mp_fechRetor=CURDATE(),mp_hourRetor=TIME_FORMAT(CURTIME(),'%h:%i:%s %p')
				where mp_moviId='".$idMov."'";
		return $sql;
	}

	public function mp_ubiTrabAct()
	{
		$sql="select
				trab.trabajador_id as trabId,
				trab.trab_funcion_id as funId,
				concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as trabEmp,
				(select trab_funcion_nombre from trab_funcion where trab_funcion_id=funId) as areTrab,
				'en empresa' as ubiTrab 
				from persona as per 
				inner join trabajador as trab on per.persona_id=trab.persona_id and trab.bestado=1";
		return $sql;
	}

	public function mp_repMovPerxFil($mesMov,$anMov)
	{
		$sql="select 
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
			where date_format(movPer.mp_fechSali,'%m')='".$mesMov."' and date_format(movPer.mp_fechSali,'%Y')='".$anMov."'
			and movPer.mp_tipAprobId=1 
			group by movPer.mp_moviId order by movPer.mp_moviId desc";
		return $sql;
	}

	public function mp_detPermiMov($idMov)
	{
		$sql="select
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
			movConfir.mp_moviId='".$idMov."'";
		return $sql;
	}

	public function mp_movxPer($userId)
	{
		$sql="select
				mp_moviId as moviId
				from mp_movi as movi
				where 
				movi.mp_userPerId='".$userId."' and 
				movi.mp_ubiPerId='2'";
		return $sql;
	}

	public function mp_addDetGast($desGast,$moneId,$monGas,$movId)
	{
		$sql="insert into mp_gastmov (mp_desGast,mp_moneId,mp_montGat,mp_moviId) 
				values ('".$desGast."','".$moneId."','".$monGas."','".$movId."')";
		return $sql;
	}

	public function mp_detGastxId($idMov)
	{
		$sql="select 
				gasMov.mp_gastMovId as item,
				gasMov.mp_desGast as desGast,
				mone.mon_sigla as monSig,
				gasMov.mp_montGat as montGast
				from
				mp_gastmov as gasMov
				inner join moneda as mone on gasMov.mp_moneId=mone.moneda_id
				inner join mp_movi as movi on gasMov.mp_moviId=movi.mp_moviId
				where gasMov.mp_moviId='".$idMov."'";
		return $sql;
	}

	public function mp_deleDetGast($idDet)
	{
		$sql="delete from mp_gastmov where mp_gastMovId='".$idDet."'";
		return $sql;
	}

/*-------------------------[*]--------------------------------------------*/

/*------------------------------------------------------------------------*/
	# SQL MODULO COTIZACION DE SERVICIOS
/*------------------------------------------------------------------------*/

	public function cs_respComer()
	{
		$sql="select 
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as respComer,
				per.persona_id as respComerId
				from 
				trabajador as trab,
				persona as per
				where
				per.persona_id=trab.persona_id and
				trab.trab_funcion_id=1 and trab.empresa_id=1";
		return $sql;
	}

	public function cs_priorCoti()
	{
		$sql="select 
				cotPrior.cot_prioridad_nombre as priorNom,
				cotPrior.cot_prioridad_id as priorId
				from
				cot_prioridad as cotPrior;";
		return $sql;
	}

	public function cs_estCoti()
	{
		$sql="SELECT
				cotEst.cot_estado_nombre as cotEstNom,
				cotEst.cot_estado_id as cotEstId
				from cot_estado as cotEst";
		return $sql;
	}

	public function cs_empCLi()
	{
		$sql=sql::getEmpCliente();
		return $sql;
	}

	public function cs_geneCotiServ($ope,$param)
	{
		if($ope==1)
		{
			$sql="insert into cs_cotiserv (cs_fechCoti,cs_cliId,cs_respComerId,cs_desServ,cs_priorId,cs_estServId,cs_moneId,cs_respoTecniId,cs_tipDocServId) 
				values 
				('".$param['cs_fechCoti']."',
				'".$param['cs_cliId']."',
				'".$param['cs_respComerId']."',
				'".$param['cs_desServ']."',
				'".$param['cs_priorId']."',
				'".$param['cs_estServId']."',
				'".$param['cs_moneId']."',
				'".$param['cs_respoTecniId']."',
				'1')";
		}
		elseif($ope==2)
		{
			$sql="update cs_cotiserv 
				set cs_correServ='".$param['cs_correServ']."' 
				where cs_cotiServId='".$param['cs_cotiServId']."'";
		}
		elseif ($ope==3) 
		{
			$sql="insert into cs_condicotiserv (cs_cotiServId,cs_garanCond,cs_reqCond,cs_tiemEje) values ('".$param['cs_cotiServId']."','','','')";
		}
		else
		{
			$excep="No se solcito ninguna operacion";
		}

		return $sql;
	}

	public function cs_correServxId($idCot)
	{
		$sql="select cs_correServ as correServ from cs_cotiserv where cs_cotiServId='".$idCot."'";
		return $sql;
	}

	public function cs_detGenServ($idCoti)
	{
		$sql="SELECT *,cs_cliId as cliId,(select emp_nombre as empNom from empresa where empresa_id=cliId) as empDes 
			FROM `cs_cotiserv` where cs_cotiServId='".$idCoti."'";
		return $sql;
	}

	public function cs_actuCotServ($ope,$param)
	{
		if($ope==1)
		{
			$sql="update cs_cotiserv set 
				cs_fechCoti='".$param['fechCoti']."',
				cs_cliId='".$param['cliId']."',
				cs_respComerId='".$param['respComerId']."',
				cs_desServ='".$param['desServ']."',
				cs_priorId='".$param['priorId']."',
				cs_estServId='".$param['estServId']."',
				cs_moneId='".$param['moneId']."'	
				where 
				cs_cotiServId='".$param['cotiServId']."'";
		}
		elseif ($ope==2) 
		{
			$sql="update cs_condicotiserv set 
				cs_reqCond='".$param['reqCond']."',
				cs_tiemEje='".$param['tiemEje']."',
				cs_garanCond='".$param['garanCond']."',
				cs_condPag='".$param['condPag']."',
				cs_tiemVali='".$param['tiemVali']."'
				where 
				cs_cotiServId='".$param['cotiServId']."'";
		}
		else
		{
			$excep="No se solicito ninguna operacion";
		}

		return $sql;
	}

	public function cs_condServCoti($cotiServId)
	{
		$sql="select cs_reqCond as reqCond,cs_tiemEje as tiemEje,cs_garanCond as garanCond,cs_condPag as condPag,cs_tiemVali as tiemVali
				from cs_condicotiserv where cs_cotiServId='".$cotiServId."'";
		return $sql;
	}

	public function cs_addCotServ($desDetCoti,$unidDetCoti,$preUniDet,$cantDetCoti,$totDetCoti,$cotiServId,$detTip)
	{
		$sql="insert into cs_detcotiserv (cs_desDetCoti,cs_unidDetCoti,cs_preUniDet,cs_cantDetCoti,cs_totDetCoti,cs_cotiServId,cs_tipDetServId) 
				values ('".$desDetCoti."','".$unidDetCoti."','".$preUniDet."','".$cantDetCoti."','".$totDetCoti."','".$cotiServId."','".$detTip."')";
		return $sql;
	}

	public function cs_detCotServ($idCotServ)
	{
		$sql="select 
				cs_detCotiServId as detCotiServId,
				cs_tipDetServId as tipDetServId,
				(select cs_desTipDes from cs_tipdetserv where cs_tipDetServId=tipDetServId) as desTipDet,
				cs_desDetCoti as desDetCoti,
				cs_unidDetCoti as unidDetCoti,
				cs_preUniDet as preUniDet,
				cs_cantDetCoti as cantDetCoti,
				cs_totDetCoti as totDetCoti
				from
				cs_detcotiserv
				where
				cs_cotiServId='".$idCotServ."'";
		return $sql;
	}

	public function cs_detCotServxTip($idCotServ,$tipDet)
	{
		$sql="select 
				cs_detCotiServId as detCotiServId,
				cs_tipDetServId as tipDetServId,
				(select cs_desTipDes from cs_tipdetserv where cs_tipDetServId=tipDetServId) as desTipDet,
				cs_desDetCoti as desDetCoti,
				cs_unidDetCoti as unidDetCoti,
				cs_preUniDet as preUniDet,
				cs_cantDetCoti as cantDetCoti,
				cs_totDetCoti as totDetCoti
				from
				cs_detcotiserv
				where
				cs_cotiServId='".$idCotServ."' and
				cs_tipDetServId='".$tipDet."'";
		return $sql;
	}

	public function cs_detCotServxId($idDetCot)
	{
		$sql="select 
				cs_detCotiServId as detCotiServId,
				cs_desDetCoti as desDetCoti,
				cs_unidDetCoti as unidDetCoti,
				cs_preUniDet as preUniDet,
				cs_cantDetCoti as cantDetCoti,
				cs_totDetCoti as totDetCoti,
				cs_tipDetServId as tipDetServId 
				from
				cs_detcotiserv
				where
				cs_detCotiServId='".$idDetCot."'";
		return $sql;
	}

	public function cs_deleDetCot($idDetCot)
	{
		$sql="delete from cs_detcotiserv where cs_detCotiServId='".$idDetCot."'";
		return $sql;
	}

	public function cs_CotServTod()
	{
		$sql="select
				cotiServ.cs_cotiServId as item,
				cotiServ.cs_correServ as fs,
				cotiServ.cs_fechCoti as fech,
				emp.emp_nombre as empre,
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as respo,
				cotiServ.cs_desServ as des,
				priori.cot_prioridad_nombre as priori,
				esta.cot_estado_nombre as esta,
				(select sum(cs_totDetCoti) from cs_detcotiserv where cs_cotiServId=item ) as tot,
				cotiServ.cs_moneId as moneId,
				(select mon_sigla from moneda where moneda_id=moneId) as moneDes,
				cotiServ.cs_respoTecniId as respoTecniId,
				(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) 
					from trabajador as trab 
					inner join persona as per 
					on trab.persona_id=per.persona_id
					where trab.trabajador_id=respoTecniId) as respoTecni
				from
				cs_cotiserv as cotiServ,
				empresa as emp,
				persona as per,
				cot_prioridad as priori,
				cot_estado as esta
				where
				emp.empresa_id=cotiServ.cs_cliId and
				cotiServ.cs_respComerId=per.persona_id and
				priori.cot_prioridad_id=cotiServ.cs_priorId and
				esta.cot_estado_id=cotiServ.cs_estServId and
				cotiServ.cs_tipDocServId=1 order by item desc";
		return $sql;
	}

	public function cs_CotServxId($idCotServ)
	{
		$sql="select
				cotiServ.cs_cotiServId as item,
				cotiServ.cs_correServ as fs,
				date_format(cotiServ.cs_fechCoti,'%d/%m/%Y') as fech,
				emp.emp_nombre as empre,
				concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as respo,
				cotiServ.cs_desServ as des,
				priori.cot_prioridad_nombre as priori,
				esta.cot_estado_nombre as esta,
				(select sum(cs_totDetCoti) from cs_detcotiserv where cs_cotiServId=item ) as tot,
				(select sum(cs_totDetCoti) from cs_detcotiserv where cs_cotiServId=item and cs_tipDetServId=1) as totServ,
				(select sum(cs_totDetCoti) from cs_detcotiserv where cs_cotiServId=item and cs_tipDetServId=2) as totMat,
				cotiServ.cs_moneId as moneId,
				(select mon_nombre from moneda where moneda_id=moneId) as moneDes,
				(select mon_sigla from moneda where moneda_id=moneId) as moneSig,
				cotiServ.cs_respoTecniId as respoTecniId,
				(select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) 
					from trabajador as trab 
					inner join persona as per 
					on trab.persona_id=per.persona_id
					where trab.trabajador_id=respoTecniId) as respoTecni
				from
				cs_cotiserv as cotiServ,
				empresa as emp,
				persona as per,
				cot_prioridad as priori,
				cot_estado as esta
				where
				emp.empresa_id=cotiServ.cs_cliId and
				cotiServ.cs_respComerId=per.persona_id and
				priori.cot_prioridad_id=cotiServ.cs_priorId and
				esta.cot_estado_id=cotiServ.cs_estServId and 
				cotiServ.cs_cotiServId='".$idCotServ."'";
		return $sql;
	}

	public function cs_getMone()
	{
		$sql=sql::cc_getMone();
		return $sql;
	}

	public function cs_actuDetCoti($detDes,$detUnid,$detPreUni,$detCant,$totDetCoti,$idCotDet,$detTip)
	{
		$sql="update cs_detcotiserv set cs_desDetCoti='".$detDes."',cs_unidDetCoti='".$detUnid."',cs_preUniDet='".$detPreUni."',
				cs_cantDetCoti='".$detCant."',cs_totDetCoti='".$totDetCoti."',cs_tipDetServId='".$detTip."' where cs_detCotiServId='".$idCotDet."'";
		return $sql;
	}

	public function cs_getTipServ()
	{
		$sql="SELECT * FROM `cs_tipdetserv`";
		return $sql;
	}

/*-------------------------[*]---------------------------------------------*/

/*------------------------------------------------------------------------*/
	# SQL MODULO ORDEN SERVICIOS
/*------------------------------------------------------------------------*/

	public function os_geneOrdServ($userId,$pcId,$tipDoc)
	{
		$sql="insert into cs_cotiserv(cs_respoTecniId,cs_pcId,cs_tipDocServId) values ('".$userId."','".$pcId."','".$tipDoc."')";
		return $sql;
	}

	public function os_geneCorreOrdServ($idOrd,$correOrd)
	{
		$sql="update cs_cotiserv set cs_correServ='".$correOrd."' where cs_cotiServId='".$idOrd."'";
		return $sql;
	}

	public function os_getFsxFl($cotiFl)
	{
		$sql="select fsId from cotizacion where cot_nro='".$cotiFl."'";
		return $sql;
	}

	public function os_getDatGenFs($valFsId)
	{
		$sql="select
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
				cotiServ.cs_cotiServId='".$valFsId."'";
		return $sql;
	}

	public function os_getDetFs($cotiFl)
	{
		$sql="select 
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
				cot.cot_nro='".$cotiFl."' and
				cotDet.bestado=1 and 
				cotDet.cs_tipDocServId=1";
		return $sql;
	}

	public function os_getCondFs($valFsId)
	{
		$sql="select
				condiCoti.cs_reqCond as requi,
				condiCoti.cs_tiemEje as tiemEje,
				condiCoti.cs_garanCond as garan,
				condiCoti.cs_condPag as condi,
				condiCoti.cs_tiemVali as tiemVali
				from cs_condicotiserv as condiCoti
				where condiCoti.cs_cotiServId='".$valFsId."'";
		return $sql;
	}

	public function os_actuGenFs($fechCoti,$cliId,$respComerId,$moneId,$desServ,$priorId,$estServId,$osId)
	{
		$sql="update cs_cotiserv as cotiServ
				set
				cotiServ.cs_fechCoti='".$fechCoti."',
				cotiServ.cs_cliId='".$cliId."',
				cotiServ.cs_respComerId='".$respComerId."',
				cotiServ.cs_moneId='".$moneId."',
				cotiServ.cs_desServ='".$desServ."',
				cotiServ.cs_priorId='".$priorId."',
				cotiServ.cs_estServId='".$estServId."'
				where cotiServ.cs_cotiServId='".$osId."'";
		return $sql;
	}

	public function os_actuGenFsBlan($desServ,$osId)
	{
		$sql="update cs_cotiserv as cotiServ
				set
				cotiServ.cs_desServ='".$desServ."'
				where cotiServ.cs_cotiServId='".$osId."'";
		return $sql;
	}

	public function os_setDetFs($des,$tipDet,$unid,$cantDet,$preUni,$totDet,$idOs)
	{
		$sql="insert into 
				cs_detcotiserv (cs_desDetCoti,cs_tipDetServId,cs_unidDetCoti,cs_cantDetCoti,cs_preUniDet,cs_totDetCoti,cs_cotiServId) 
				values ('".$des."','".$tipDet."','".$unid."','".$cantDet."','".$preUni."','".$totDet."','".$idOs."')";
		return $sql;
	}

	public function os_setCondiFs($reqCond,$tiemEje,$garanCond,$condPag,$tiemVali,$idOs)
	{
		$sql="insert into cs_condicotiserv (cs_reqCond,cs_tiemEje,cs_garanCond,cs_condPag,cs_tiemVali,cs_cotiServId) 
				values ('".$reqCond."','".$tiemEje."','".$garanCond."','".$condPag."','".$tiemVali."','".$idOs."')";
		return $sql;
	}

	public function os_getPcId($idOrd)
	{
		$sql="select cs_pcId from cs_cotiserv where cs_cotiServId='".$idOrd."'";
		return $sql;
	}

	public function os_actuOrdCread($cliId,$moneId,$detCentId)
	{
		$sql="update cc_detcentcost set cc_provId='".$cliId."',cc_moneId='".$moneId."' where cc_detCentCostId='".$detCentId."'";
		return $sql;
	}

	public function os_getCorreOs($cotiServId)
	{
		$sql="select cs_correServ as correServ from cs_cotiserv where cs_cotiServId='".$cotiServId."'";
		return $sql;
	}

	public function os_actuOsRef($cliId,$moneId,$valCorre)
	{
		$sql="update cc_detcentcost set cc_provId='".$cliId."',cc_moneId='".$moneId."' where cc_ocGeneId='".$valCorre."'";
		return $sql;
	}

	public function os_totMontxMone($pcId)
	{
		$sql="select
				distinct
				cotiServ.cs_pcId as pcId,
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
				cotiServ.cs_pcId='".$pcId."'";
		return $sql;
	}

/*-------------------------[*]--------------------------------------------*/

/*------------------------------------------------------------------------*/
	# SQL MODULO COTIZACION DE EQUIPOS
/*------------------------------------------------------------------------*/

	public function ce_getFsCoti()
	{
		$sql="select cs_correServ,cs_cotiServId from cs_cotiserv where cs_tipDocServId=1;";
		return $sql;
	}

	public function ce_getFsDetxId($idFs)
	{
		$sql="select 
				cs_detCotiServId as itemDet,
				cs_cotiServId as item,
				cs_desDetCoti as des,
				(select cs_moneId from cs_cotiserv where cs_cotiServId=item ) as moneId,
				(select mon_sigla from moneda where moneda_id=moneId) as mone,
				cs_unidDetCoti as unid,
				cs_preUniDet as preUnit,
				cs_cantDetCoti as cant,
				cs_totDetCoti as tot,
				cs_tipDetServId as tipDet
				from cs_detcotiserv 
				where 
				cs_cotiServId='".$idFs."'";
		return $sql;
	}

	public function ce_asocFs($cotiId,$fsId)
	{
		$sql="update `cotizacion` set fsId='".$fsId."' where cotizacion_id='".$cotiId."'";
		return $sql;
	}

	public function ce_incluDesProd($empId,$esta,$alias,$nom,$des)
	{
		$sql="insert into producto set empresa_id='".$empId."',bestado='".$esta."',prod_alias='".$alias."',prod_nombre='".$nom."',prod_descrip='".$des."'";
		return $sql;
	}

	public function ce_setDetFs($prodId,$moneId,$unid,$preUnitVen,$preUnitCom,$cant,$tot,$tipDoc,$cotiId,$prodClasi,$prodDes,$tipDet,$cotOrden)
	{
		$sql="insert into cot_detalle (producto_id,moneda_id,cs_unid,pro_precio_compra,pro_precio_venta,pro_cantidad,
				pro_subtotal,cs_tipDocServId,cotizacion_id,prod_clasificacion_id,pro_descripcion,cs_tipDetServId,cot_det_orden) 
				values ('".$prodId."','".$moneId."','".$unid."','".$preUnitVen."','".$preUnitCom."','".$cant."','".$tot."',
				'".$tipDoc."','".$cotiId."','".$prodClasi."','".$prodDes."','".$tipDet."','".$cotOrden."')";
		return $sql;
	}

	public function ce_evaTamItems($cotId)
	{
		$sql="SELECT count(*) as contItems FROM `cot_detalle` WHERE `cotizacion_id`='".$cotId."' and bestado=1";
		return $sql;
	}

/*-------------------------[*]--------------------------------------------*/

/*------------------------------------------------------------------------*/
	# SQL MODULO VISITAS
/*-------------------------------------------------------------------------*/

	# ADITIONAL SQL QUERY

	public function visi_getCorre($idVisi)
	{
		$sql="select visiCorre from tbvisi_visita where tbvisi_visita_id='".$idVisi."'";
		return $sql;
	}

	public function visi_asociCent($mone,$correVisi)
	{
		$sql="insert into cc_detcentcost (cc_centCostId,cc_tipOrden,cc_provId,cc_moneId,cc_ocGeneId,cc_idEstCost)
				values (110,4,1,'".$mone."','".$correVisi."',1)";
		return $sql;
	}

	public function visi_getParamRepor($idVisi)
	{
		$sql="SELECT fechIniVisi,fechFinVisi,idVendeVisita as vendId, 
				(select concat(per.pers_nombres,' ',per.pers_apemat,' ',per.pers_apepat) as vend from
				persona as per where per.persona_id=vendId) as vend
				FROM `tbvisi_visita` where tbvisi_visita_id='".$idVisi."'";
		return $sql;
	}

	public function visi_totMontxMone($pcId)
	{
		$sql="select distinct
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
				cc_centCostId='".$pcId."'";
		return $sql;
	}

	public function visi_reporVisiCent($idCent)
	{
		$sql="select
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
				detCent.cc_centCostId='".$idCent."' and
				detCent.cc_ocGeneId=visi.visiCorre";
		return $sql;
	}

	public function visi_userxId($idUser)
	{
		$sql="select concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as user from trabajador as trab
				inner join persona as per on trab.trabajador_id='".$idUser."' where trab.persona_id=per.persona_id";
		return $sql;
	}

	public function visi_centCostxId($centId)
	{
		$sql="select cc_correCenCost as correCent from cc_centcost where cc_centCostId='".$centId."'";
		return $sql;
	}

/*-------------------------[*]----------------------------------------------*/

/*--------------------------------------------------------------------------*/
	# FLUJO PROBABLE SQL [fp_sql]
/*--------------------------------------------------------------------------*/

	public function fp_userVend()
	{
		$sql="select 
			concat(per.pers_nombres,' ',per.pers_apepat,' ',per.pers_apemat) as vend,
			trab.trabajador_id as vendId 
			from persona as per
			inner join trabajador as trab
			on per.persona_id=trab.persona_id 
			where trab.trabajador_id in (46,40,3,5,53,52,50);";
		return $sql;
	}

	public function fp_cotiAct($opId)
	{
		$sql="select
			coti.cotizacion_id as cotiId,
			coti.cot_nro as fl,
			emp.emp_nombre as cliente,
			proy.proy_nombre as proyecto,
			mone.mon_sigla as mone,
			round(round(sum(cotDet.pro_cantidad*cotDet.pro_precio_venta),0),2) as monto,
			(select concat(fian.fp_fianPor,'%',' ',tipFian.fp_tipFianDes) from fp_fian as fian,fp_tipFian as tipFian where fian.fp_tipFianId=1
			and fian.fp_cotiId=cotiId and fian.fp_tipFianId=tipFian.fp_tipFianId) as fianAde,
			(select concat(fian.fp_fianPor,'%',' ',tipFian.fp_tipFianDes) from fp_fian as fian,fp_tipFian as tipFian where fian.fp_tipFianId=2
			and fian.fp_cotiId=cotiId and fian.fp_tipFianId=tipFian.fp_tipFianId) as fianFiel
			from cotizacion as coti
			inner join cot_detalle as cotDet on coti.cotizacion_id=cotDet.cotizacion_id
			inner join proyecto as proy on coti.proyecto_id=proy.proyecto_id
			inner join empresa as emp on coti.cliente_id=emp.empresa_id
			inner join moneda as mone on coti.moneda_id=mone.moneda_id
			where coti.operador_id='".$opId."' and coti.bestado=1 and cotDet.bestado=1 and cot_estado_id=4
			group by coti.cotizacion_id";
		return $sql;
	}

	public function fp_cleanFian($cotiId)
	{
		$sql="delete from fp_fian where fp_cotiId='".$cotiId."'";
		return $sql;
	}

	public function fp_nuevFian($fianPor,$tipFian,$cotiId)
	{
		$sql="insert into fp_fian (fp_fianPor,fp_tipFianId,fp_cotiId) values ('".$fianPor."','".$tipFian."','".$cotiId."')";
		return $sql;
	}

	public function fp_flujProb($cotiId)
	{
		$sql="select
			coti.cotizacion_id as cotiId,
			coti.cot_nro as fl,
			emp.emp_nombre as cliente,
			proy.proy_nombre as proyecto,
			mone.mon_sigla as mone,
			round(round(sum(cotDet.pro_cantidad*cotDet.pro_precio_venta),0),2) as monto,
			coti.cot_probabilidad as prob,
			date_format(coti.cot_fec_adj,'%d/%m/%Y') as probFech,
			(select concat(tipFian.fp_tipFianDes,' ',fian.fp_fianPor,'%',' ','CONTRATO') from fp_fian as fian,fp_tipFian as tipFian where fian.fp_tipFianId=1
			and fian.fp_cotiId=cotiId and fian.fp_tipFianId=tipFian.fp_tipFianId) as fianAde,
			(select fian.fp_fianPor from fp_fian as fian,fp_tipFian as tipFian where fian.fp_tipFianId=1 and fian.fp_cotiId=cotiId and fian.fp_tipFianId=tipFian.fp_tipFianId) 
			as fianAdePor,
			(select concat('FC',' ',fian.fp_fianPor,'%',' ','CONTRATO') from fp_fian as fian,fp_tipFian as tipFian where fian.fp_tipFianId=2
			and fian.fp_cotiId=cotiId and fian.fp_tipFianId=tipFian.fp_tipFianId) as fianFiel,
			(select fian.fp_fianPor from fp_fian as fian,fp_tipFian as tipFian where fian.fp_tipFianId=2 and fian.fp_cotiId=cotiId and fian.fp_tipFianId=tipFian.fp_tipFianId) 
			as fianFielPor
			from cotizacion as coti
			inner join cot_detalle as cotDet on coti.cotizacion_id=cotDet.cotizacion_id
			inner join proyecto as proy on coti.proyecto_id=proy.proyecto_id
			inner join empresa as emp on coti.cliente_id=emp.empresa_id
			inner join moneda as mone on coti.moneda_id=mone.moneda_id
			where coti.cotizacion_id in (".$cotiId.") and coti.bestado=1 and cotDet.bestado=1 and cot_estado_id=4
			group by coti.cotizacion_id";
		return $sql;
	}

/*-------------------------[*]-----------------------------------------------*/

/*---------------------------------------------------------------------------*/
	# SEGUIMIENTO CENTRO SQL [scc_sql]
/*---------------------------------------------------------------------------*/

	public function scc_centCost()
	{
		$sql="CALL scc_centCost()";
		return $sql;
	}

	public function scc_geneSegui($idCent)
	{
		$sql="select scc_geneSegui('".$idCent."') as response";
		return $sql;
	}

	public function scc_seguiGen()
	{
		$sql="CALL scc_seguiGen()";
		return $sql;
	}

	public function scc_eliSegui($codSegui)
	{
		$sql="select scc_eliSegui('".$codSegui."') as response";
		return $sql;
	}

	public function scc_datGenSegui($idSegui)
	{
		$sql="CALL scc_datGenSegui('".$idSegui."')";
		return $sql;
	}

	public function scc_ordSeguiCent($idSegui)
	{
		$sql="CALL scc_ordSeguiCent('".$idSegui."')";
		return $sql;
	}

	public function scc_datOrdComp($idOrd)
	{
		$sql="CALL scc_datOrdComp('".$idOrd."')";
		return $sql;
	}

	public function scc_tipAdelSegui()
	{
		$sql="CALL scc_tipAdelSegui()";
		return $sql;
	}

	public function scc_adelOrdSegui($tipAdelId,$adelFech,$adelDes,$seguiCentId,$compOrdId)
	{
		$sql="select scc_adelOrdSegui('".$tipAdelId."','".$adelFech."','".$adelDes."','".$seguiCentId."','".$compOrdId."') as response";
		return $sql;
	}

	public function scc_detAdelOrd($idSegui,$idOrd)
	{
		$sql="CALL scc_detAdelOrd('".$idSegui."','".$idOrd."')";
		return $sql;
	}

	public function scc_eliAdelSegui($idAdel)
	{
		$sql="select scc_eliAdelSegui('".$idAdel."') as response";
		return $sql;
	}

	public function scc_adelSeguixId($idAdel)
	{
		$sql="CALL scc_adelSeguixId('".$idAdel."')";
		return $sql;
	}

	public function scc_actuAdelxId($idAdel,$tipAdel,$fechAdel,$desAdel)
	{
		$sql="select scc_actuAdelxId('".$idAdel."','".$tipAdel."','".$fechAdel."','".$desAdel."') as response";
		return $sql;
	}

	public function scc_geneSeguiOrd($idSegui,$idOrd)
	{
		$sql="select scc_geneSeguiOrd('".$idSegui."','".$idOrd."') as response";
		return $sql;
	}

	public function scc_seguiOrdProye($idSegui,$idOrd)
	{
		$sql="CALL scc_seguiOrdProye('".$idSegui."','".$idOrd."')";
		return $sql;
	}

	public function scc_evaExiSegui($idSegui,$idOrd)
	{
		$sql="select scc_evaExiSegui('".$idSegui."','".$idOrd."') as response";
		return $sql;
	}

	public function scc_valiSeguiOrd($idValid,$rowAten)
	{
		$sql="select scc_valiSeguiOrd('".$idValid."','".$rowAten."') as response";
		return $sql;
	}

	public function scc_reverValiSegui($idValid,$rowAten)
	{
		$sql="select scc_reverValiSegui('".$idValid."','".$rowAten."') as response";
		return $sql;
	}

	public function scc_seguiOrdPlaz($idSegui)
	{
		$sql="CALL scc_seguiOrdPlaz('".$idSegui."')";
		return $sql;
	}

	public function scc_evaExisAdel($idSegui,$idOrd,$idTipAdel)
	{
		$sql="select scc_evaExisAdel('".$idSegui."','".$idOrd."','".$idTipAdel."') as response";
		return $sql;
	}

	public function scc_actFechaReal($fechReal,$compId)
	{
		$sql="select scc_actFechaReal('".$fechReal."','".$compId."') as response";
		return $sql;
	}

	public function scc_actuPlazFab($plazfab,$compId)
	{
		$sql="select scc_actuPlazFab('".$plazfab."','".$compId."') as response";
		return $sql;
	}

	public function scc_valiFlujAdel($seguiId,$ordId,$tipAdel)
	{
		$sql="select scc_valiFlujAdel('".$seguiId."','".$ordId."','".$tipAdel."') as response";
		return $sql;
	}

	public function scc_valiGeneSegui($idCent)
	{
		$sql="select scc_valiGeneSegui('".$idCent."') as response";
		return $sql;
	}

	public function scc_plazAdi_actu($diAd,$segId)
	{
		$sql="select scc_plazAdi_actu('".$diAd."','".$segId."') as response";
		return $sql;
	}

	public function scc_plazOrd_actu($ordId,$plazDia,$tipPlaz) # 08/08/2014
	{
		$sql="select scc_plazOrd_actu('".$ordId."','".$plazDia."','".$tipPlaz."') as response";
		return $sql;
	}

/*-------------------------[*]------------------------------------------------*/

/*----------------------------------------------------------------------------*/
	# CALENDARIO DE EVENTOS [ce_json]
/*----------------------------------------------------------------------------*/

	public function ce_perEw_listar()
	{
		$sql="CALL ce_perEw_listar()";
		return $sql;
	}

	public function ce_evenEw_agregar($ce_persoEmpId,$ce_funAreId,$ce_fechIni,$ce_fechFin,$ce_horaEvenIni,$ce_horaEvenFin,$ce_desEven,$ce_checkVali)
	{
		$sql="select ce_evenEw_agregar(
										'".$ce_persoEmpId."',
										'".$ce_funAreId."',
										'".$ce_fechIni."',
										'".$ce_fechFin."',
										'".$ce_horaEvenIni."',
										'".$ce_horaEvenFin."',
										'".$ce_desEven."',
										'".$ce_checkVali."'
										) as response";
		return $sql;
	}

	public function ce_evenPer_capturar()
	{
		$sql="CALL ce_evenPer_capturar()";
		return $sql;
	}

	public function ce_evenxId_traer($idEven)
	{
		$sql="CALL ce_evenxId_traer('".$idEven."')";
		return $sql;	
	}

	public function ce_evenxId_actualizar($evenId,$perId,$funId,$fechIni,$fechFin,$horaIni,$horaFin,$evenDes,$checkVali)
	{
		$sql="select ce_evenxId_actualizar('".$evenId."',
											'".$perId."',
											'".$funId."',
											'".$fechIni."',
											'".$fechFin."',
											'".$horaIni."',
											'".$horaFin."',
											'".$evenDes."',
											'".$checkVali."') as response";
		return $sql;
	}

	public function ce_evenxId_eliminar($evenId)
	{
		$sql="select ce_evenxId_eliminar('".$evenId."') as response";
		return $sql;
	}

	public function ce_evenxId_capturar($perId)
	{
		$sql="CALL ce_evenxId_capturar('".$perId."')";
		return $sql;
	}

	public function ce_evenRepi_vali($fechini,$fechFin,$horaIni,$horaFin,$perId,$evenId)
	{
		$sql="select ce_evenRepi_vali('".$fechini."','".$fechFin."','".$horaIni."','".$horaFin."','".$perId."','".$evenId."') as response";
		return $sql;
	}

	public function ce_evenExis_vali($persoId,$fechIni,$fechFin,$evenId)
	{
		$sql="select ce_evenExis_vali('".$persoId."','".$fechIni."','".$fechFin."','".$evenId."') as response";
		return $sql;
	}

/*-------------------------[*]-------------------------------------------------*/

/*-----------------------------------------------------------------------------*/
	# SQL MODULO COTIZACION - UPDATE
/*-----------------------------------------------------------------------------*/

	/* MODULO DE COTIZACION [cot_sql] */

	public function cot_checkVali($valActi,$idCoti,$tare)
	{
		$sql="select cot_checkVali('".$valActi."','".$idCoti."','".$tare."') as response";
		return $sql;
	}

/*-------------------------[*]-------------------------------------------------*/

/*------------------------------------------------------------------------------*/
	# SQL MODULO NUMERO DE SERIE
/*------------------------------------------------------------------------------*/

	/* FUNCIONAL->MODULO COMPRAS NUMERO DE SERIE [sn_] */

	public function sn_desProd_obte($idDetComp)
	{
		$sql="select sn_desProd_obte('".$idDetComp."') as response";
		return $sql;
	}

	public function sn_numSeri_agre($idDetComp,$fechAlm,$fechIng,$numSeri,$eliEsta)
	{
		$sql="select sn_numSeri_agre('".$idDetComp."','".$fechAlm."','".$fechIng."','".$numSeri."','".$eliEsta."') as response";
		return $sql;
	}

	public function sn_numSeri_eli($numSeriId)
	{
		$sql="select sn_numSeri_eli('".$numSeriId."') as response";
		return $sql;
	}

	public function sn_numSerixId_obte($idDetComp)
	{
		$sql="CALL sn_numSerixId_obte('".$idDetComp."')";
		return $sql;
	}

	public function sn_desCan_obte($idDetComp)
	{
		$sql="CALL sn_desCan_obte('".$idDetComp."')";
		return $sql;
	}

	public function sn_numSerixId_eli($idDetComp)
	{
		$sql="select sn_numSerixId_eli('".$idDetComp."') as response";
		return $sql;
	}

/*-------------------------[*]---------------------------------------------------*/

/*-------------------------------------------------------------------------------*/
	# SQL MODULO LINEA DE PRODUCTOS - UPDATE
/*-------------------------------------------------------------------------------*/

	#[lp_] -> Linea de productos

	public function lp_obteSubClasi()
	{
		$sql="CALL lp_obteSubClasi()";
		return $sql;
	}

	public function lp_obteCatexid($idSubClasi)
	{
		$sql="CALL lp_obteCatexid('".$idSubClasi."')";
		return $sql;
	}

	public function lp_obteTipxId($catId)
	{
		$sql="CALL lp_obteTipxId('".$catId."')";
		return $sql;
	}

	public function lp_obteMarModxId($idTip)
	{
		$sql="CALL lp_obteMarModxId('".$idTip."')";
		return $sql;
	}

	public function lp_obteProdxid($idMar,$idMod,$idTip,$idCat,$idSub)
	{
		$sql="CALL lp_obteProdxid('".$idMar."','".$idMod."','".$idTip."','".$idCat."','".$idSub."')";
		return $sql;
	}

	public function lp_imporProd($idProd)
	{
		$sql="select lp_imporProd('".$idProd."') as response";
		return $sql;
	}

	public function lp_listLineProd($desBus,$tare,$ewId)
	{
		$sql="CALL lp_listLineProd('".$desBus."','".$tare."','".$ewId."')";
		return $sql;
	}

	public function lp_eliLineProd($idLine)
	{
		$sql="select lp_eliLineProd('".$idLine."') as response";
		return $sql;
	}

	public function lp_iniConfStock($idLineProd)
	{
		$sql="CALL lp_iniConfStock('".$idLineProd."')";
		return $sql;
	}

	public function lp_actuConfStock($stockMin,$stockMax,$precioUnit,$moneId,$lineId)
	{
		$sql="select lp_actuConfStock('".$stockMin."','".$stockMax."','".$precioUnit."','".$moneId."','".$lineId."') as response";
		return $sql;
	}

	public function lp_iniMone()
	{
		$sql="CALL lp_iniMone()";
		return $sql;
	}

	public function lp_movExis_eva($idLine)
	{
		$sql="select lp_movExis_eva('".$idLine."') as response";
		return $sql;
	}

	#| lp_ - 14/10/2014 |

	public function lp_ingreMar_vali($mar)
	{
		$sql="select lp_ingreMar_vali('".$mar."') as response";
		return $sql;
	}

/*-----------------------------[*]------------------------------------------------*/

/*--------------------------------------------------------------------------------*/
	# SQL MODULO KARDEX - UPDATE
/*---------------------------------------------------------------------------------*/

		#[kd_] Kardex

		public function kd_geneMovKardx($tipMov,$ewCompId,$almcId,$kardxEmp,$transId,$kardxFech,$tipDoc,$kardxDoc,$kardxDes,$desti,$numFac,$facEmis)
		{
			$sql="select kd_geneMovKardx('".$tipMov."',
										'".$ewCompId."',
										'".$almcId."',
										'".$kardxEmp."',
										'".$transId."',
										'".$kardxFech."',
										'".$tipDoc."', 
										'".$kardxDoc."',
										'".$kardxDes."',
										'".$desti."',
										'".$numFac."',
										'".$facEmis."') as response";
			return $sql;
		}

		public function kd_correMov_obte($idkardx)
		{
			$sql="select kd_correMov_obte('".$idkardx."') as response";
			return $sql;
		}

		public function kd_tipMov_obte()
		{
			$sql="CALL kd_tipMov_obte()";
			return $sql;
		}

		public function kd_emp_obte($perfEmp)
		{
			$sql="CALL kd_emp_obte('".$perfEmp."')";
			return $sql;
		}

		public function kd_obteSubClasi()
		{
			$sql="CALL kd_obteSubClasi()";
			return $sql;
		}

		public function kd_obteCatexid($idSubClasi)
		{
			$sql="CALL kd_obteCatexid('".$idSubClasi."')";
			return $sql;
		}

		public function kd_obteTipxId($catId)
		{
			$sql="CALL kd_obteTipxId('".$catId."')";
			return $sql;
		}

		public function kd_obteMarModxId($idTip)
		{
			$sql="CALL kd_obteMarModxId('".$idTip."')";
			return $sql;
		}

		public function kd_obteProdxid($idMar,$idCat,$idSub)
		{
			$sql="CALL kd_obteProdxid('".$idMar."','".$idCat."','".$idSub."')";
			return $sql;
		}

		public function kd_detKard_agre($kdxId,$prodId,$preUni,$kdxCant,$kd_almcId,$kd_obsItem)
		{
			$sql="select kd_detKard_agre('".$kdxId."','".$prodId."','".$preUni."','".$kdxCant."','".$kd_almcId."','".$kd_obsItem."') as response";
			return $sql;
		}

		public function kd_detKardxid($kdxId)
		{
			$sql="CALL kd_detKardxid('".$kdxId."')";
			return $sql;
		}

		public function kd_geneMov_upd($kdxId,$tipMov,$kdxEmp,$kdxFech,$tipDoc,$kdxDoc,$kdxDes,$kdxMone,$almcId,$desti,$transId,$numFac,$facEmis,$ewCompId)
		{
			$sql="select kd_geneMov_upd('".$kdxId."',
										'".$tipMov."',
										'".$kdxEmp."',
										'".$kdxFech."',
										'".$tipDoc."',
										'".$kdxDoc."',
										'".$kdxDes."',
										'".$kdxMone."',
										'".$almcId."',
										'".$desti."',
										'".$transId."',
										'".$numFac."',
										'".$facEmis."',
										'".$ewCompId."') as response";
			return $sql;
		}

		public function kd_eliDetMov($idKdxDet)
		{
			$sql="select kd_eliDetMov('".$idKdxDet."') as response";
			return $sql;
		}

		public function kd_iniGenKardx($kardxId)
		{
			$sql="CALL kd_iniGenKardx('".$kardxId."')";
			return $sql;
		}

		public function kd_iniMoneMov($kardxId)
		{
			$sql="select kd_iniMoneMov('".$kardxId."') as response";
			return $sql;
		}

		public function kd_histKardx($idTipMov)
		{
			$sql="CALL kd_histKardx('".$idTipMov."')";
			return $sql;
		}

		public function kd_actuStockLine($idLineProd,$tipMov,$cant)
		{
			$sql="select kd_actuStockLine('".$idLineProd."','".$tipMov."','".$cant."') as response";
			return $sql;
		}

		public function kd_reverStock($tipMov,$idDet)
		{
			$sql="select kd_reverStock('".$tipMov."','".$idDet."') as response";
			return $sql;
		}

		public function kd_marLine_obte($catId)
		{
			$sql="CALL kd_marLine_obte('".$catId."')";
			return $sql;
		}

		public function kd_movKardx_eli($kardxId)
		{
			$sql="select kd_movKardx_eli('".$kardxId."') as response";
			return $sql;
		}

		public function kd_stockAgru_obte($idProd)
		{
			$sql="CALL kd_stockAgru_obte('".$idProd."')";
			return $sql;
		}

		public function kd_glosaMov_actu($idDet,$glosaDes,$itemCorre,$unid,$chkProd,$desProd)
		{
			$sql="select kd_glosaMov_actu('".$idDet."','".$glosaDes."','".$itemCorre."','".$unid."','".$chkProd."','".$desProd."') as response";
			return $sql;
		}

		public function kd_nuevTrans_crear($transNom,$transApe,$transDni,$transRuc,$transDomi)
		{
			$sql="select kd_nuevTrans_crear('".$transNom."','".$transApe."','".$transDni."','".$transRuc."','".$transDomi."') as response";
			return $sql;
		}

		public function kd_trans_cap()
		{
			$sql="CALL kd_trans_cap()";
			return $sql;
		}

		public function kd_seriTot_cap($lineId)
		{
			$sql="CALL kd_seriTot_cap('".$lineId."')";
			return $sql;
		}

		public function kd_empTrans_crear($empNom,$ruc,$dire,$tel)
		{
			$sql="select kd_empTrans_crear('".$empNom."','".$ruc."','".$dire."','".$tel."') as response";
			return $sql;
		}

		public function kd_empTrans_obte()
		{
			$sql="CALL kd_empTrans_obte";
			return $sql;
		}

		public function kd_ewComp_cap()
		{
			$sql="CALL kd_ewComp_cap";
			return $sql;
		}

		public function kd_numExis_vali($numSeri,$lineId)
		{
			$sql="select kd_numExis_vali('".$numSeri."','".$lineId."') as response";
			return $sql;
		}

		public function kd_notPend_cap($tipMov) //new1! --
		{
			$sql="CALL kd_notPend_cap('".$tipMov."')";
			return $sql;
		}

		public function kd_detNot_cap($notId) //new1! --
		{
			$sql="CALL kd_detNot_cap('".$notId."')";
			return $sql;
		}

		public function kd_ingMov_vali($kardxId) //new2! OK
		{
			$sql="select kd_ingMov_vali('".$kardxId."') as response";
			return $sql;
		}

		public function kd_atenNot_confir($idNot,$usuAten) //new3! --
		{
			$sql="select kd_atenNot_confir('".$idNot."','".$usuAten."') as response";
			return $sql;
		}

/*------------------------[*]------------------------------------------------------*/

/*---------------------------------------------------------------------------------*/
	# SQL MODULO LINEA DE PRODUCTO - UPDATE
/*---------------------------------------------------------------------------------*/

	/*UI NUEVO PRODUCTO PERSISTENCIA [lp_] */

	public function lp_lineProd_ingre($subId,$cateId,$marId,$nomEspa,$nomIngle,$desProd,$stockMin,$stockMax)
	{
		$sql="select lp_lineProd_ingre('".$subId."','".$cateId."','".$marId."','".$nomEspa."','".$nomIngle."','".$desProd."','".$stockMin."','".$stockMax."') as response";
		return $sql;
	}

	public function lp_subClasi_nuev($subNom)
	{
		$sql="select lp_subClasi_nuev('".$subNom."') as response";
		return $sql;
	}

	public function lp_cate_nuev($subId,$catNom)
	{
		$sql="select lp_cate_nuev('".$subId."','".$catNom."') as response";
		return $sql;
	}

	public function lp_tip_nuev($catId,$tipNom)
	{
		$sql="select lp_tip_nuev('".$catId."','".$tipNom."') as response";
		return $sql;
	}

	public function lp_marProd_mos()
	{
		$sql="CALL lp_marProd_mos()";
		return $sql;
	}

	public function lp_marMod_nuev($marId,$tipId,$modNom,$modAlias)
	{
		$sql="select lp_marMod_nuev('".$marId."','".$tipId."','".$modNom."','".$modAlias."') as response";
		return $sql;
	}

	public function lp_mar_nuev($marNom,$marAlias)
	{
		$sql="select lp_mar_nuev('".$marNom."','".$marAlias."') as response";
		return $sql;
	}

	public function lp_marxCat_obte()
	{
		$sql="CALL lp_marxCat_obte()";
		return $sql;
	}

	public function lp_prodCread_ini($idLine)
	{
		$sql="CALL lp_prodCread_ini('".$idLine."')";
		return $sql;
	}

	public function lp_prodCread_actu($idLine,$idSub,$idCat,$idMar,$nomEspa,$nomIngle,$des,$stockMin,$stockMax)
	{
		$sql="select lp_prodCread_actu('".$idLine."','".$idSub."','".$idCat."','".$idMar."','".$nomEspa."','".$nomIngle."','".$des."','".$stockMin."','".$stockMax."') as response";
		return $sql;
	}

/*--------------------------[*]-----------------------------------------------------*/

/*----------------------------------------------------------------------------------*/
	# SQL MODULO KARDEX - UPDATE
/*----------------------------------------------------------------------------------*/

	// UI NUMERO DE SERIE ENTRADA PERSISTENCIA [kd_]

	public function kd_numSeri_ingre($detKadxId,$desProd,$numSeri,$almcId)
	{

		$sql="select kd_numSeri_ingre('".$detKadxId."','".$desProd."','".$numSeri."','".$almcId."') as response";
		return $sql;

	}

	public function kd_seriMov_mos($detKdxId)
	{
		$sql="CALL kd_seriMov_mos('".$detKdxId."')";
		return $sql;
	}

	public function kd_seriMov_eli($detMovId)
	{
		$sql="select kd_seriMov_eli('".$detMovId."') as response";
		return $sql;
	}

	public function kd_serixDet_cap($idDet)
	{
		$sql="CALL kd_serixDet_cap('".$idDet."')";
		return $sql;
	}

	public function kd_serixId_eli($idSeri)
	{
		$sql="select kd_serixId_eli('".$idSeri."') as response";
		return $sql;
	}

/*----------------------------------------------------------------------------------*/

/*----------------------------------------------------------------------------------*/
	# SQL MODULO KARDEX - UPDATE		
/*----------------------------------------------------------------------------------*/

	// UI NUMERO DE SERIE SALIDA PERSISTENCIA [kd_]

	public function kd_numSeri_mos($idDetMov)
	{
		$sql="CALL kd_numSeri_mos('".$idDetMov."')";
		return $sql;
	}

	public function kd_movSeri_add($detKardxId,$idNumSeri,$kd_almcId,$estaStock)
	{
		$sql="select kd_movSeri_add('".$detKardxId."','".$idNumSeri."','".$kd_almcId."','".$estaStock."') as response";
		return $sql;
	}

	public function kd_seriStock_regre($detMovId)
	{
		$sql="select kd_seriStock_regre('".$detMovId."') as response";
		return $sql;
	}

	public function kd_serixProd_cap($prodId,$almcId)
	{
		$sql="CALL kd_serixProd_cap('".$prodId."','".$almcId."')";
		return $sql;
	}

	public function kd_seriStock_actu($idSeri,$tipMov,$idDetKardx)
	{
		$sql="select kd_seriStock_actu('".$idSeri."','".$tipMov."','".$idDetKardx."') as response";
		return $sql;
	}

	public function kd_almEmp_cap()
	{
		$sql="CALL kd_almEmp_cap()";
		return $sql;
	}

/*--------------------------------[*]-----------------------------------------------*/

/*----------------------------------------------------------------------------------*/
	# SQL MODULO KARDEX - UPDATE
/*----------------------------------------------------------------------------------*/

	//REPORTE INVENTARIO PERSISTENCIA [kd_]


	public function kd_lineProd_sub($subId)
	{
		$sql="CALL kd_lineProd_sub('".$subId."')";
		return $sql;
	}

	public function kd_lineProd_cate($catId)
	{
		$sql="CALL kd_lineProd_cate('".$catId."')";
		return $sql;
	}

	public function kd_lineProd_tip($tipId)
	{
		$sql="CALL kd_lineProd_tip('".$tipId."')";
		return $sql;
	}

	public function kd_lineProd_marMod($marId,$modId)
	{
		$sql="CALL kd_lineProd_marMod('".$marId."','".$modId."')";
		return $sql;
	}

	public function kd_lineProdOrd_obte()
	{
		$sql="CALL kd_lineProdOrd_obte()";
		return $sql;
	}

	# 11/08/2014

	public function kd_marxTip_obte($tipId)
	{
		$sql="CALL kd_marxTip_obte('".$tipId."')";
		return $sql;
	}

	public function kd_modxTipMar_obte($tipId,$marId)
	{
		$sql="CALL kd_modxTipMar_obte('".$tipId."','".$marId."')";
		return $sql;
	}

	public function kd_lineProd_mar($marId)
	{
		$sql="CALL kd_lineProd_mar('".$marId."')";
		return $sql;
	}

	public function kd_lineProd_mod($modId)
	{
		$sql="CALL kd_lineProd_mod('".$modId."')";
		return $sql;
	}

/*-------------------------------[*]-------------------------------------------------*/

/*------------------------------------------------------------------------------------*/
	# SQL MODULO KARDEX - UPDATE
/*------------------------------------------------------------------------------------*/

	public function kd_genEnt_obte($empId,$fechIni,$fechFin,$tipMov,$filMov)
	{
		$sql="CALL kd_genEnt_obte('".$empId."','".$fechIni."','".$fechFin."','".$tipMov."','".$filMov."')";
		return $sql;
	}

	public function kd_todEnt_obte($fechIni,$fechFin,$tipMov,$filMov)
	{
		$sql="CALL kd_todEnt_obte('".$fechIni."','".$fechFin."','".$tipMov."','".$filMov."')";
		return $sql;
	}

	# 16/10/2014

	public function lp_lineProdxEw_obte($ewId)
	{
		$sql="CALL lp_lineProdxEw_obte('".$ewId."')";
		return $sql;
	}

/*------------------------------[*]----------------------------------------------------*/

/*--------------------------------------------------------------------------------------*/
	# SQL MODULO NOTA DE PEDIDO
/*--------------------------------------------------------------------------------------*/

	public function np_prodxLine_obte($idLine)
	{
		$sql="CALL np_prodxLine_obte('".$idLine."')";
		return $sql;
	}

	public function np_notPed_crear($usuId,$cliId,$fech,$obs,$des,$ref,$tipMov,$fechConfir,$hourConfir)
	{
		$sql="select np_notPed_crear('".$usuId."','".$cliId."','".$fech."','".$obs."','".$des."',
									'".$ref."','".$tipMov."','".$fechConfir."','".$hourConfir."') as response";
		return $sql;
	}

	public function np_detNot_ingre($notPedId,$lineId,$cant)
	{
		$sql="select np_detNot_ingre('".$notPedId."','".$lineId."','".$cant."') as response";
		return $sql;
	}

	public function np_estaNot_cap()
	{
		$sql="CALL np_estaNot_cap()";
		return $sql;
	}

	public function np_notPed_lis($esta,$tipMov)
	{
		$sql="CALL np_notPed_lis('".$esta."','".$tipMov."')";
		return $sql;
	}

	public function np_genNot_cap($idDet)
	{
		$sql="CALL np_genNot_cap('".$idDet."')";
		return $sql;
	}

	public function np_detNot_cap($notId)
	{
		$sql="CALL np_detNot_cap('".$notId."')";
		return $sql;
	}

	public function np_notPed_actu($cliId,$fech,$obs,$des,$ref,$esta,$notId,$tipMov,$fechConfir,$hourConfir)
	{
		$sql="select np_notPed_actu('".$cliId."','".$fech."','".$obs."','".$des."','".$ref."',
									'".$esta."','".$notId."','".$tipMov."','".$fechConfir."',
									'".$hourConfir."') as response";
		return $sql;
	}

	public function np_detNot_eli($idDet)
	{
		$sql="select np_detNot_eli('".$idDet."') as response";
		return $sql;
	}

	public function np_notPed_eli($idNot)
	{
		$sql="select np_notPed_eli('".$idNot."') as response";
		return $sql;
	}

	public function np_tipMov_cap()
	{
		$sql="CALL np_tipMov_cap()";
		return $sql;
	}

	public function np_trabOpe_cap()
	{
		$sql="CALL np_trabOpe_cap()";
		return $sql;
	}

	public function np_emailPer_obte($perId)
	{
		$sql="CALL np_emailPer_obte('".$perId."')";
		return $sql;
	}

	public function np_mailPer_edit($perId,$email)
	{
		$sql="select np_mailPer_edit('".$perId."','".$email."') as response";
		return $sql;
	}

/*-----------------------------[*]-------------------------------------------------------*/

/*---------------------------------------------------------------------------------------*/
	# SQL MODULO PROYECTO
/*---------------------------------------------------------------------------------------*/

	public function cot_nuevProye_crear($proyNom,$empId,$cliId,$fechAdju,$usuResp)
	{
		$sql="select cot_nuevProye_crear('".$proyNom."','".$empId."','".$cliId."','".$fechAdju."','".$usuResp."') as response";
		return $sql;
	}

	public function cot_proyCoti_list($empId,$filtro,$resp,$desProye)
	{
		$sql="CALL cot_proyCoti_list('".$empId."','".$filtro."','".$resp."','".$desProye."')";
		return $sql;
	}

	public function cot_cotixProye_listar($proyeId,$estaId)
	{
		$sql="CALL cot_cotixProye_listar('".$proyeId."','".$estaId."')";
		return $sql;
	}

	public function cot_respComer_listar()
	{
		$sql="CALL cot_respComer_listar()";
		return $sql;
	}

	public function cot_estaCot_listar()
	{
		$sql="CALL cot_estaCot_listar()";
		return $sql;
	}

	public function cot_cotiProye_cont($empId,$proyeId,$estaId)
	{
		$sql="select cot_cotiProye_cont('".$empId."','".$proyeId."','".$estaId."') as response";
		return $sql;
	}

	public function cot_ediProy_ini($proyeId,$empId)
	{
		$sql="CALL cot_ediProy_ini('".$proyeId."','".$empId."')";
		return $sql;
	}

	public function cot_proye_edit($idProye,$proyNom,$cliId,$fechAdju)
	{
		$sql="select cot_proye_edit('".$idProye."','".$proyNom."','".$cliId."','".$fechAdju."') as response";
		return $sql;
	}

	public function cot_ediProye_restri($idProye,$usuActi)
	{
		$sql="select cot_ediProye_restri('".$idProye."','".$usuActi."') as response";
		return $sql;
	}

	public function cot_nuevUsuFin_crear($empNom,$ruc,$dire,$tel,$mail)
	{
		$sql="select cot_nuevUsuFin_crear('".$empNom."','".$ruc."','".$dire."','".$tel."','".$mail."') as response";
		return $sql;
	}

/*-------------------------------------[*]------------------------------------------------*/

/*----------------------------------------------------------------------------------------*/
	# SQL MODULO RECLAMO - UPDATE
/*----------------------------------------------------------------------------------------*/

	# 31/07/2014 - old

	public function recla_adjuRut($id)
	{
		$sql="select adjuReclamo from tbrecla_reclamo where tbrecla_reclamo_id='".$id."'";
		return $sql;
	}

	# 12/08/2014 - new

	public function recla_tipObs()
	{
		$sql="select tipObsId as id,desObs as tip from tbrecla_tipObs";
		return $sql;
	}

	public function recla_obsxTip($tip)
	{
		$sql="select detObsId as id,desDetObs as des from tbrecla_detObs where tipObsId='".$tip."'";
		return $sql;
	}

	public function recla_obsTipxId($obsId)
	{
		$sql="select detObsId as idObs,tipObsId as tipObs from tbrecla_detObs
				where detObsId='".$obsId."'";
		return $sql;
	}

/*--------------------------------------[*]------------------------------------------------*/

/*-----------------------------------------------------------------------------------------*/
	# SQL MODULO CENTRO DE COSTO - UPDATE (FINANZAS)
/*-----------------------------------------------------------------------------------------*/

	//Procedure

	public function finan_docFinan_list()
	{
		$sql="CALL finan_docFinan_list()";
		return $sql;
	}

	public function finan_tipDoc_list($docId)
	{
		$sql="CALL finan_tipDoc_list('".$docId."')";
		return $sql;
	}

	public function finan_opeBanTem_obte($centTemp,$tipCent)
	{
		$sql="CALL finan_opeBanTem_obte('".$centTemp."','".$tipCent."')";
		return $sql;
	}

	public function finan_moneOpe_obte()
	{
		$sql="CALL finan_moneOpe_obte()";
		return $sql;
	}

	public function finan_totComi_calcu($idCent,$tipCent)
	{
		$sql="CALL finan_totComi_calcu('".$idCent."','".$tipCent."')";
		return $sql;
	}

	public function finan_cartVenc_alert()
	{
		$sql="CALL finan_cartVenc_alert()";
		return $sql;
	}

	#New [...]

	public function finan_obteCentCost()
	{
		$sql="CALL finan_obteCentCost()";
		return $sql;
	}

	public function finan_datCentxId($centId)
	{
		$sql="CALL finan_datCentxId('".$centId."')";
		return $sql;
	}

	public function finan_opeProye_obte($periOpe,$estaOpe)
	{
		$sql="CALL finan_opeProye_obte(".$periOpe.",".$estaOpe.")";
		return $sql;
	}

	public function finan_opeProyexId_obte($opeId)
	{
		$sql="CALL finan_opeProyexId_obte('".$opeId."')";
		return $sql;
	}

	public function finan_adjuOpeXId_obte($opeId)
	{
		$sql="CALL finan_adjuOpeXId_obte('".$opeId."')";
		return $sql;
	}

	public function finan_periOpe_obte()
	{
		$sql="CALL finan_periOpe_obte()";
		return $sql;
	}

	public function finan_estaOpe_obte()
	{
		$sql="CALL finan_estaOpe_obte()";
		return $sql;
	}

	//Function

	public function finan_cenCost_cre()
	{
		$sql="select finan_cenCost_cre() as response";
		return $sql;
	}

	public function finan_openBanTem_cre($tipDocId,$centTemp,$tipCent)
	{
		$sql="select finan_openBanTem_cre('".$tipDocId."','".$centTemp."','".$tipCent."') as response";
		return $sql;
	}

	public function finan_opeBanTem_eli($opeBancaId,$tipCent)
	{
		$sql="select finan_opeBanTem_eli('".$opeBancaId."','".$tipCent."') as response";
		return $sql;
	}

	public function finan_opeBanTem_actu($moneId,$monto,$fechCli,$fechDoc,$opeIdBan,$tipCent,$fechIni,$tasAnu,$comisInte,$estaVenci,$estaEntre,$correOpe)
	{
		$sql="select finan_opeBanTem_actu('".$moneId."','".$monto."','".$fechCli."','".$fechDoc."','".$opeIdBan."','".$tipCent."',
											'".$fechIni."',
											'".$tasAnu."',
											'".$comisInte."',
											'".$estaVenci."',
											'".$estaEntre."',
											'".$correOpe."') as response";
		return $sql;
	}

	public function finan_opeTemReal_grab($cenTemp,$cenReal)
	{
		$sql="select finan_opeTemReal_grab('".$cenTemp."','".$cenReal."') as response";
		return $sql;
	}

	public function finan_comisInte_calcu($opeBancaId,$tipCent)
	{
		$sql="select finan_comisInte_calcu('".$opeBancaId."','".$tipCent."') as response";
		return $sql;
	}

	public function finan_opeBan_reno($idOpeBan,$tipCent)
	{
		$sql="select finan_opeBan_reno('".$idOpeBan."','".$tipCent."') as response";
		return $sql;
	}

	public function finan_renoMax_cap($idOpeBan,$tipCent)
	{
		$sql="select finan_renoMax_cap('".$idOpeBan."','".$tipCent."') as response";
		return $sql;
	}

	#new 11/02/2015 - open

	public function finan_opeProye_crear($centId)
	{
		$sql="select finan_opeProye_crear('".$centId."') as response";
		return $sql;
	}

	public function finan_opeProye_actu($idOpeProye,$centId)
	{
		$sql="select finan_opeProye_actu('".$idOpeProye."','".$centId."') as response";
		return $sql;
	}

	public function finan_centProye_eva($centId)
	{
		$sql="select finan_centProye_eva('".$centId."') as response";
		return $sql;
	}

	public function finan_opeProye_eli($opeId)
	{
		$sql="select finan_opeProye_eli('".$opeId."') as response";
		return $sql;
	}

	public function finan_docOpe_adju($opeProyeId,
										$numDocAdju,
										$adjuDes,
										$adjuDoc)
	{
		$sql="select finan_docOpe_adju('".$opeProyeId."',
										'".$numDocAdju."',
										'".$adjuDes."',
										'".$adjuDoc."') as response";
		return $sql;
	}

	#new 11/02/2015 - open
	#	 12/02/2015
	#    13/02/2015

	public function finan_adjuOpe_eli($adjuOpeId)
	{
		$sql="select finan_adjuOpe_eli('".$adjuOpeId."') as response";
		return $sql;
	}

	public function finan_opeProye_cerrar($opeId)
	{
		$sql="select finan_opeProye_cerrar('".$opeId."') as response";
		return $sql;
	}

	public function finan_opeProye_ope($opeId)
	{
		$sql="select finan_opeProye_ope('".$opeId."') as response";
		return $sql;
	}


/*--------------------------------------[*]------------------------------------------------*/

/*-----------------------------------------------------------------------------------------*/
	# SQL MODULO GESTION DOCUMENTARIA
/*-----------------------------------------------------------------------------------------*/

	#PROCEDURE

		public function gd_estaGest_cap()
		{
			$sql="CALL gd_estaGest_cap()";
			return $sql;
		}

		public function gd_estaRut_cap()
		{
			$sql="CALL gd_estaRut_cap()";
			return $sql;
		}

		public function gd_respoRut_cap()
		{
			$sql="CALL gd_respoRut_cap()";
			return $sql;
		}

		public function gd_gestDocxLim($limIni,$limFin,$estaId,$fechGest)
		{
			$sql="CALL gd_gestDocxLim('".$limIni."','".$limFin."','".$estaId."','".$fechGest."')";
			return $sql;
		}

		public function gd_gestDocxId_cap($gestId)
		{
			$sql="CALL gd_gestDocxId_cap('".$gestId."')";
			return $sql;
		}

		public function gd_rutxId_cap($rutId)
		{
			$sql="CALL gd_rutxId_cap('".$rutId."')";
			return $sql;
		}

		public function gd_rutxLim_cap($limIni,$limFin,$estaId,$fechRut)
		{
			$sql="CALL gd_rutxLim_cap('".$limIni."','".$limFin."','".$estaId."','".$fechRut."')";
			return $sql;
		}

		public function gd_detRutxId_cap($rutId)
		{
			$sql="CALL gd_detRutxId_cap('".$rutId."')";
			return $sql;
		}

	#FUNCTION

		public function gd_gestDoc_cread($doc,$gest,$fech,$hora,$lugar,$usuId,$estaGest,$lati,$longi)
		{
			$sql="select gd_gestDoc_cread('".$doc."',
										  '".$gest."',
										  '".$fech."',
										  '".$hora."',
										  '".$lugar."',
										  '".$usuId."',
										  '".$estaGest."',
										  '".$lati."',
										  '".$longi."') as response";
			return $sql;
		}

		public function gd_gestDoc_cont($estaId,$fechGest)
		{
			$sql="select gd_gestDoc_cont('".$estaId."',
										'".$fechGest."') as response";
			return $sql;
		}

		public function gd_gestDoc_edit($idGest,$doc,$gest,$fech,$hora,$lugar,$estaGest)
		{
			$sql="select gd_gestDoc_edit('".$idGest."',
										'".$doc."',
										'".$gest."',
										'".$fech."',
										'".$hora."',
										'".$lugar."',
										'".$estaGest."') as response";
			return $sql;
		}

		public function gd_gestDoc_eli($idGest)
		{
			$sql="select gd_gestDoc_eli('".$idGest."') as response";
			return $sql;
		}

		public function gd_gestFechxEsta_cont($fechGest,$estaGest)
		{
			$sql="select gd_gestFechxEsta_cont('".$fechGest."','".$estaGest."') as response";
			return $sql;
		}

		public function gd_rutGest_cread($respId,$admId,$estaRutId,$fechRut,$hourRut)
		{
			$sql="select gd_rutGest_cread('".$respId."','".$admId."','".$estaRutId."','".$fechRut."','".$hourRut."') 
					as response";
			return $sql;
		}

		public function gd_rutGest_cont($estaId,$fechRut)
		{
			$sql="select gd_rutGest_cont('".$estaId."','".$fechRut."') as response";
			return $sql;
		}

		public function gd_rutGest_actu($rutId,$estaRutId,$fechRut,$hourRut,$respId)
		{
			$sql="select gd_rutGest_actu('".$rutId."','".$estaRutId."','".$fechRut."','".$hourRut."','".$respId."') as response";
			return $sql;
		}

		public function gd_rutGest_eli($rutId)
		{
			$sql="select gd_rutGest_eli('".$rutId."') as response";
			return $sql;
		}

		public function gd_rutGest_det($rutId,$gestDocId)
		{
			$sql="select gd_rutGest_det('".$rutId."','".$gestDocId."') as response";
			return $sql;
		}

		public function gd_detRutxId_eli($detRutId)
		{
			$sql="select gd_detRutxId_eli('".$detRutId."') as response";
			return $sql;
		}

		/*
		public function gd_detRutxId_cap($rutId)
		{
			$sql="select gd_detRutxId_cap('".$rutId."') as response";
			return $sql;
		}
		*/

		public function gd_detRutxId_concre($rutId,$estaGest)
		{
			$sql="select gd_detRutxId_concre('".$rutId."','".$estaGest."') as response";
			return $sql;
		}

		public function gd_rutxId_concre($rutId)
		{
			$sql="select gd_rutxId_concre('".$rutId."') as response";
			return $sql;
		}


/*--------------------------------------[*]------------------------------------------------*/

/*-----------------------------------------------------------------------------------------*/
	# SQL MODULO NO CONFORMIDAD
/*-----------------------------------------------------------------------------------------*/

	#PROCEDURE

		#Query Read [Parametros|Entidad] :: c[R]ud
		
			public function nc_centCost_obte()
			{
				$sql="CALL nc_centCost_obte()";
				return $sql;
			}

			public function nc_detec_obte()
			{
				$sql="CALL nc_detec_obte()";
				return $sql;
			}

			public function nc_procAfect_obte()
			{
				$sql="CALL nc_procAfect_obte()";
				return $sql;
			}

			public function nc_tipObs_obte()
			{
				$sql="CALL nc_tipObs_obte()";
				return $sql;
			}

			public function nc_tipNoConfor_obte()
			{
				$sql="CALL nc_tipNoConfor_obte()";
				return $sql;
			}

			public function nc_estaConfor_obte()
			{
				$sql="CALL nc_estaConfor_obte()";
				return $sql;
			}

			public function nc_ingAsig_obte()
			{
				$sql="CALL nc_ingAsig_obte()";
				return $sql;
			}

			public function nc_datCent_obte($centId)
			{
				$sql="CALL nc_datCent_obte('".$centId."')";
				return $sql;
			}

			public function nc_ordexCent_obte($centId)
			{
				$sql="CALL nc_ordexCent_obte('".$centId."')";
				return $sql;
			}

			public function nc_detxOrd_obte($ordId)
			{
				$sql="CALL nc_detxOrd_obte('".$ordId."')";
				return $sql;
			}

			//New update 14/01/2015 - CLOSE
			public function nc_noConfor_obte($fechRecep,$estaConfor,$limIni,$limFin,$obsId,$oriObs)
			{
				$sql="CALL nc_noConfor_obte('".$fechRecep."','".$estaConfor."','".$limIni."','".$limFin."','".$obsId."','".$oriObs."')";
				return $sql;
			}

			public function nc_noConforxId_obte($conforId)
			{
				$sql="CALL nc_noConforxId_obte('".$conforId."')";
				return $sql;
			}

			public function nc_infoAdju_obte($conforId)
			{
				$sql="CALL nc_infoAdju_obte('".$conforId."')";
				return $sql;
			}

			public function nc_detEquipxId_obte($conforId)
			{
				$sql="CALL nc_detEquipxId_obte('".$conforId."')";
				return $sql;
			}

			public function nc_medCorrec_obte($conforId)
			{
				$sql="CALL nc_medCorrec_obte('".$conforId."')";
				return $sql;
			}

			public function nc_medxId_ini($medId)
			{
				$sql="CALL nc_medxId_ini('".$medId."')";
				return $sql;
			}

			//New update 23/12/2014 - CLOSE

			public function nc_obs_obte()
			{
				$sql="CALL nc_obs_obte()";
				return $sql;
			}

			public function nc_tipConfxId_obte($idObs)
			{
				$sql="CALL nc_tipConfxId_obte('".$idObs."')";
				return $sql;
			}

			//New update 12/01/2014 - CLOSE

			public function nc_medPrev_obte($conforId)
			{
				$sql="CALL nc_medPrev_obte('".$conforId."')";
				return $sql;
			}

			public function nc_medPrevxId_obte($medId)
			{
				$sql="CALL nc_medPrevxId_obte('".$medId."')";
				return $sql;
			}


			# **New update 14/01/2015** - CLOSE

			public function nc_oriObs_obte()
			{
				$sql="CALL nc_oriObs_obte()";
				return $sql;
			}


	#FUNCTION

		#Query Create [Entidad|Calculo] :: [C]rud

			public function nc_noConfor_cre($centId,
											$detecId,
											$procId,
											$tipObs,
											$estaConfor,
											$fechRecep,
											$desConfor,
											$respInme,
											$fechCie,
											$tipConfor,
											$medPrev,
											$obsId,
											$oriObs,
											$tipObsFrm)
			{
				$sql="select nc_noConfor_cre('".$centId."',
											'".$detecId."',
											'".$procId."',
											'".$tipObs."',
											'".$estaConfor."',
											'".$fechRecep."',
											'".$desConfor."',
											'".$respInme."',
											'".$fechCie."',
											'".$tipConfor."',
											'".$medPrev."',
											'".$obsId."',
											'".$oriObs."',
											'".$tipObsFrm."') as response";
				return $sql;
			}

			//New update 14/01/2015 - CLOSE
			public function nc_noConforxFil_cont($fechRecep,$estaConfor,$obsId,$oriObs)
			{
				$sql="select nc_noConforxFil_cont('".$fechRecep."','".$estaConfor."','".$obsId."','".$oriObs."') as response";
				return $sql;
			}

			public function nc_infoNoConfor_adju($conforId,
												 $desAdju,
												 $fileAdju)
			{
				$sql="select nc_infoNoConfor_adju('".$conforId."',
												 '".$desAdju."',
												 '".$fileAdju."') as response";
				return $sql;
			}

			public function nc_detEquip_cre($conforId,$detCompId)
			{
				$sql="select nc_detEquip_cre('".$conforId."','".$detCompId."') as response";
				return $sql;
			}

			public function nc_medCorre_cre($conforId,
											$medDes,
											$respMed,
											$fechCorrec,
											$ingAsig)
			{
				$sql="select nc_medCorre_cre('".$conforId."',
										'".$medDes."',
										'".$respMed."',
										'".$fechCorrec."',
										'".$ingAsig."') as response";
				return $sql;
			}


			public function nc_perxId_obte($idTrab)
			{
				$sql="select nc_perxId_obte('".$idTrab."') as response";
				return $sql;
			}

			//New update 08/01/2015 - CLOSE

			public function nc_medPrev_cre($noConforId,$desPrev,$fechPrev)
			{
				$sql="select nc_medPrev_cre('".$noConforId."','".$desPrev."','".$fechPrev."') as response";
				return $sql;
			}

		#Query Update [Entidad|] :: cr[U]d

			public function nc_noConfor_edit($conforId,
											 $centId,
											 $detectId,
											 $proceId,
											 $tipObs,
											 $tipConfor,
											 $estaConfor,
											 $desConfor,
											 $fechRecep,
											 $respInme,
											 $fechCie,
											 $medPrev,
											 $obsId,
											 $oriObs,
											 $tipObsFrm)
			{
				$sql="select nc_noConfor_edit('".$conforId."',
											 '".$centId."',
											 '".$detectId."',
											 '".$proceId."',
											 '".$tipObs."',
											 '".$tipConfor."',
											 '".$estaConfor."',
											 '".$desConfor."',
											 '".$fechRecep."',
											 '".$respInme."',
											 '".$fechCie."',
											 '".$medPrev."',
											 '".$obsId."',
											 '".$oriObs."',
											 '".$tipObsFrm."') as response";
				return $sql;
			}

			public function nc_medCorrec_edit($medId,
												$medDes,
												$fechCorrec,
												$ingAsig,
												$medResp)
			{
				$sql="select nc_medCorrec_edit('".$medId."',
												'".$medDes."',
												'".$fechCorrec."',
												'".$ingAsig."',
												'".$medResp."') as response";
				return $sql;
			}

			public function nc_porcexTip_obte($tipPorce,$idTip,$fechIni,$fechFin)
			{
				$sql="select nc_porcexTip_obte('".$tipPorce."',
												'".$idTip."',
												'".$fechIni."',
												'".$fechFin."') as response";
				return $sql;
			}

			//New update 12/01/2015 - OPEN

			public function nc_medPrev_edit($idMed,$desPrev,$fechPrev)
			{
				$sql="select nc_medPrev_edit('".$idMed."','".$desPrev."','".$fechPrev."') as response";
				return $sql;
			}

		#Query Delete [Entidad] :: cru[D]

			public function nc_infoAdju_borra($adjuId)
			{
				$sql="select nc_infoAdju_borra('".$adjuId."') as response";
				return $sql;
			}

			public function nc_detEquip_borra($equiId)
			{
				$sql="select nc_detEquip_borra('".$equiId."') as response";
				return $sql;
			}

			public function nc_medCorrec_borra($medId)
			{
				$sql="select nc_medCorrec_borra('".$medId."') as response";
				return $sql;
			}

			public function nc_noConfor_borrar($conforId)
			{
				$sql="select nc_noConfor_borrar('".$conforId."') as response";
				return $sql;
			}

			//New update 12/01/2015 - OPEN

			public function nc_medPrevxId_borra($medId)
			{
				$sql="select nc_medPrevxId_borra('".$medId."') as response";
				return $sql;
			}


	#New 26/02/2015 - PROD

		/*
		********************************
		* Iniciar tipo de tratamientos
		********************************
		*/

		public function nc_tipTrat_ini()
		{
			$sql="CALL nc_tipTrat_ini()";
			return $sql;
		}

		/*
		*******************************
		* Iniciar autorizaciones
		*******************************
		*/

		public function nc_autoTrat_ini()
		{
			$sql="CALL nc_autoTrat_ini()";
			return $sql;
		}

		/*
		*******************************
		* Crear tratamiento
		*******************************
		*/

		public function nc_tratNoConfor_crea($noConforId,$tiptrat,$tratOpi,$tratAuto)
		{
			$sql="select nc_tratNoConfor_crea('".$noConforId."',
												'".$tiptrat."',
												'".$tratOpi."',
												'".$tratAuto."') as response";
			return $sql;
		}

		/*
		*******************************************
		* Iniciar tratamientos no conformidad
		*******************************************
		*/

		public function nc_tratNoConfor_ini($noConforId)
		{
			$sql="CALL nc_tratNoConfor_ini('".$noConforId."')";
			return $sql;
		}

		/*
		*******************************
		* Eliminar tratamiento
		*******************************
		*/

		public function nc_tratNoConfor_eli($tratId)
		{
			$sql="select nc_tratNoConfor_eli('".$tratId."') as response";
			return $sql;
		}

		/*
		**********************************************
		* Iniciar tratamientos no conformidad por id
		**********************************************
		*/

		public function nc_tratNoConforxId_ini($tratId)
		{
			$sql="CALL nc_tratNoConforxId_ini('".$tratId."')";
			return $sql;
		}

		/*
		*******************************
		* Editar tratamiento
		*******************************
		*/

		public function nc_tratNoConfor_edit($tratId,$tratTip,$tratOpi,$tratAuto)
		{
			$sql="select nc_tratNoConfor_edit('".$tratId."','".$tratTip."','".$tratOpi."','".$tratAuto."') as response";
			return $sql;
		}

	#New 11/03/2015 - PROD

		/*
		*-----------------------------------------
		* Iniciar numeros de serie de productos #
		*-----------------------------------------
		*/

		public function nc_numSeriProd_ini()
		{
			$sql="CALL nc_numSeriProd_ini()";
			return $sql;
		}

		/*
		*-----------------------------
		* Obtener producto por serie #
		*------------------------------
		*/

		public function nc_serixProd_obte($seriId)
		{
			$sql="CALL nc_serixProd_obte('".$seriId."')";
			return $sql;
		}

		/*
		*----------------------------------------
		* Iniciar cliente productos no conforme #
		*----------------------------------------
		*/

		public function nc_cliProdNc_ini()
		{
			$sql="CALL nc_cliProdNc_ini()";
			return $sql;
		}

		/*
		*----------------------------------------
		* Iniciar proveedor productos no conforme #
		*----------------------------------------
		*/

		public function nc_provProdNc_ini()
		{
			$sql="CALL nc_provProdNc_ini()";
			return $sql;
		}

		/*
		*----------------------------------------
		* Iniciar tipo tratamiento de productos #
		*----------------------------------------
		*/

		public function nc_tratTipProd_ini()
		{
			$sql="CALL nc_tratTipProd_ini()";
			return $sql;
		}

		/*
		*----------------------------------------------
		* Iniciar acciones a ejecutar  #
		*-----------------------------------------------
		*/

		public function nc_acciEje_ini()
		{
			$sql="CALL nc_acciEje_ini()";
			return $sql;
		}

		/*
		*----------------------------------------------
		* Iniciar autorizaciones producto no conforme  #
		*------------------------------------------------
		*/

		public function nc_autoNc_ini()
		{
			$sql="CALL nc_autoNc_ini()";
			return $sql;
		}

		/*
		*----------------------------------------------
		* guardar producto no conforme #
		*----------------------------------------------
		*/

		public function nc_prodNc_guar($seri,
										$prod,
										$cant,
										$fech,
										$cli,
										$prov,
										$des,
										$correc,
										$tratProd,
										$ejeAcci,
										$regPor,
										$autoPor,
										$noConforId,
										$ncOtro)
		{
			$sql="select nc_prodNc_guar('".$seri."',
										'".$prod."',
										'".$cant."',
										'".$fech."',
										'".$cli."',
										'".$prov."',
										'".$des."',
										'".$correc."',
										'".$tratProd."',
										'".$ejeAcci."',
										'".$regPor."',
										'".$autoPor."',
										'".$noConforId."',
										'".$ncOtro."') as response";
			return $sql;
		}

		/*
		*---------------------------------------------
		* listar producto no conforme #
		*----------------------------------------------
		*/

		public function nc_prodNoConfor_list($conforId)
		{
			$sql="CALL nc_prodNoConfor_list('".$conforId."')";
			return $sql;
		}

		/*
		*--------------------------------------------
		* iniciar producto no conforme por id #
		*--------------------------------------------
		*/

		public function nc_prodNcxId_ini($prodNcId)
		{
			$sql="CALL nc_prodNcxId_ini('".$prodNcId."')";
			return $sql;
		}

		/*
		*----------------------------------------------
		* actualizar producto no conforme por id #
		*----------------------------------------------
		*/

		public function nc_prodNc_actu($seri,
										$prod,
										$cant,
										$fech,
										$cli,
										$prov,
										$des,
										$correc,
										$tratProd,
										$ejeAcci,
										$regPor,
										$autoPor,
										$noConforId,
										$ncOtro,
										$prodNcId)
		{
			$sql="select nc_prodNc_actu('".$seri."',
								 '".$prod."',
								 '".$cant."',
								 '".$fech."',
								 '".$cli."',
								 '".$prov."',
								 '".$des."',
								 '".$correc."',
								'".$tratProd."',
								'".$ejeAcci."',
								'".$regPor."',
								'".$autoPor."',
								'".$noConforId."',
								'".$ncOtro."',
								'".$prodNcId."') as response";
			return $sql;
		}

		/*
		*------------------------------------------------
		* eliminar tratamiento de productos por id
		*------------------------------------------------
		*/

		public function nc_tratProd_eli($tratProdId)
		{
			$sql="select nc_tratProd_eli('".$tratProdId."') as response";
			return $sql;
		}

/*------------------------------------[*]--------------------------------------------------*/

/*----------------------------------------------------------------------------------------*/
	# SQL MODULO VISITAS - UPDATE
/*----------------------------------------------------------------------------------------*/

	#PROCEDURE - CRUD

		//C
		//R
			public function vi_visixVend_obte($idVende,$fechVisi)
			{
				$sql="CALL vi_visixVend_obte('".$idVende."','".$fechVisi."')";
				return $sql;
			}

			public function vi_visixId_ini($idVisi)
			{
				$sql="CALL vi_visixId_ini('".$idVisi."')";
				return $sql;
			}

			public function vi_visiGenxId_obte($idVisi)
			{
				$sql="CALL vi_visiGenxId_obte('".$idVisi."')";
				return $sql;
			}
		//U
		//D

	#FUNCTIONS - CRUD

		//C
			public function vi_detVi_cre($idVisi,$idContac,$obs,$idCli,$obsPen,$dire,$dirOrig,$fechVisi,$montVisi)
			{
				$sql=sql::insertDetVisi($idVisi,
										$idContac,
										$obs,
										$idCli,
										$obsPen,
										$dire,
										$dirOrig,
										$fechVisi,
										$montVisi);
				return $sql;
			}
		//R
			public function vi_contactxId_obte($idContac)
			{
				$sql="select vi_contactxId_obte('".$idContac."') as response";
				return $sql;
			}
		//U

			public function vi_visiGen_actu($fechIni,
											$fechFin,
											$moneId,
											$pasaVisi,
											$hospeVisi,
											$alimeVisi,
											$transInter,
											$visiId)
			{
				$sql="select vi_visiGen_actu('".$fechIni."',
											'".$fechFin."',
											'".$moneId."',
											'".$pasaVisi."',
											'".$hospeVisi."',
											'".$alimeVisi."',
											'".$transInter."',
											'".$visiId."') as response";
				return $sql;
			}

			public function vi_detGast_actu($detVisiId,$montVisi)
			{
				$sql="select vi_detGast_actu('".$detVisiId."','".$montVisi."') as response";
				return $sql;
			}


		//D

			public function vi_detVisi_borra($idDet)
			{
				$sql="select vi_detVisi_borra('".$idDet."') as response";
				return $sql;
			}

			public function vi_visiResp_borra($visiId)
			{
				$sql="select vi_visiResp_borra('".$visiId."') as response";
				return $sql;
			}

/*----------------------------------[*]---------------------------------------------------*/

/*----------------------------------------------------------------------------------------*/
	# SQL MODULO KARDEX - UPDATE
/*----------------------------------------------------------------------------------------*/


	#PROCEDURE

		//C
		//R

			public function kd_prodxNum_read($numSeri)
			{
				$sql="CALL kd_prodxNum_read('".$numSeri."')";
				return $sql;
			}

			public function kd_histNum_read($numSeri)
			{
				$sql="CALL kd_histNum_read('".$numSeri."')";
				return $sql;
			}

			public function kd_numSeri_read()
			{
				$sql="CALL kd_numSeri_read()";
				return $sql;
			}
			
		//U
		//D

	#FUNCTION

		//c
		//R
		//U
		//D

/*----------------------------------[*]--------------------------------------------------*/

/*---------------------------------------------------------------------------------------*/
	# SQL MODULO CENTRO COSTOS - UPDATE( Asignacion Centros ) - CLOSE
/*---------------------------------------------------------------------------------------*/

	#PROCEDURE

		//C
		//R
			function cc_ordEmp_obte($empId)
			{
				$sql="CALL cc_ordEmp_obte('".$empId."')";
				return $sql;
			}

			function cc_centEmp_obte($empId)
			{
				$sql="CALL cc_centEmp_obte('".$empId."')";
				return $sql;
			}

			function cc_centDest_obte($empId)
			{
				$sql="CALL cc_centDest_obte('".$empId."')";
				return $sql;
			}

			function cc_ordxOrd_obte($empId,$ordId)
			{
				$sql="CALL cc_ordxOrd_obte('".$empId."','".$ordId."')";
				return $sql;
			}

			function cc_ordxCent_obte($empId,$centId)
			{
				$sql="CALL cc_ordxCent_obte('".$empId."','".$centId."')";
				return $sql;
			}
		//U
		//D

	#FUNCTIONS

		//C
		//R
		//U
			function cc_ordxDest_actu($centDest,$ordId)
			{
				$sql="select cc_ordxDest_actu('".$centDest."','".$ordId."') as response";
				return $sql;
			}
		//D

/*----------------------------------[*]--------------------------------------------------*/

/*---------------------------------------------------------------------------------------*/
	# SQL MODULO COTIZACION - UPDATE( Ordenar Items ) - CLOSE
/*---------------------------------------------------------------------------------------*/

	#PROCEDURE

			#C
			#R
			#U
			#D

	#FUNCTION

		#c
		#R
		#U
			public function cot_itemCot_ord($detId,$ordVal)
			{
				$sql="select cot_itemCot_ord('".$detId."','".$ordVal."') as response";
				return $sql;
			}
		#D

/*----------------------------------[*]--------------------------------------------------*/

/*---------------------------------------------------------------------------------------*/
	# SQL MODULO CUMPLEAÑOS TRABAJADOR
/*---------------------------------------------------------------------------------------*/

	#PROCEDURE

		//New update 16/01/2015 - Open

		public function ct_trabEw_obte()
		{
			$sql="CALL ct_trabEw_obte()";
			return $sql;
		}

	#FUNCTION

/*----------------------------------[*]--------------------------------------------------*/

}

?>