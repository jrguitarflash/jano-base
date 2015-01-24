 <?php #print "hello world controlador superior"; ?>
<?php

	if(isset($_GET['menu'])) 
	{
		switch($_GET['menu'])
		{

			/*-----------------------------------------------------------------------------*/
				# CONTROLLER UP RECLAMOS
			/*-----------------------------------------------------------------------------*/

				case 'reclamo_form':

					// INICIAR TIPO DE OBSERVACION

					$sql=sql::recla_tipObs();
					$dataTipObs=negocio::getData($sql);
					$tipObs="";

					foreach ($dataTipObs as $data) 
					{
						# code...
						$tipObs.="<option value='".$data['id']."' >".$data['tip']."</option>";
					}

					// INICIAR CAMPOS DE RECLAMO
				
					$sql=sql::getTipReclamo();
					$dataTipRecla=negocio::getData($sql);
					
					$date = new DateTime();
					$date->modify('-5 hour');
					$fecha=$date->format('Y-m-d');
					
					$sql=sql::getTrabVendRecla();
					$dataTrabVende=negocio::getData($sql);
					
					$sql=sql::getTrabxId($_SESSION['SIS'][2]);
					$usuario=negocio::getVal($sql,'vendedor');
					$sql=sql::getEmailxNom($usuario);
					$email=negocio::getVal($sql,'pers_mail');
					$email=negocio::veriEmailxNom($email);
					
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);			

				break;
				
				
				case 'reclamo_edit':

					// INICIAR TIPO DE OBSERVACION

					$sql=sql::recla_tipObs();
					$dataTipObs=negocio::getData($sql);
					$tipObs="";

					foreach ($dataTipObs as $data) 
					{
						# code...
						$tipObs.="<option value='".$data['id']."' >".$data['tip']."</option>";
					}

					// CAPTURAR CAMPO DE RECLAMO
				
					$sql=sql::getTipReclamo();
					$dataTipRecla=negocio::getData($sql);
					
					$date = new DateTime();
					$date->modify('-5 hour');
					$fecha=$date->format('Y-m-d');
					
					$sql=sql::getTrabVendRecla();
					$dataTrabVende=negocio::getData($sql);
					
					$sql=sql::getTrabxId($_SESSION['SIS'][2]);
					$usuario=negocio::getVal($sql,'vendedor');

					$sql=sql::getEmailxNom($usuario);
					$email=negocio::getVal($sql,'pers_mail');
					$email=negocio::veriEmailxNom($email);
					
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					// INICIALIZADOR DE DATOS PARA EDICION
					
					$sql=sql::getReclaxId($_GET['id']);
					$dataRecla=negocio::getData($sql);
					
					#print_r($dataRecla);
					$idTip=$dataRecla[0]['idTipReclamo'];

					$sql=sql::getClixContacxCli($dataRecla[0]['idEmpReclamo']);
					$nomCli=negocio::getVal($sql,'empresa');
					
					$sql=sql::getContacxId($dataRecla[0]['idContacReclamo']);
					$nomContac=negocio::getVal($sql,'contacto');
					$idContac=$dataRecla[0]['idContacReclamo'];
					
					$sql=sql::getContacxCli($nomCli);
					$dataContac=negocio::getData($sql);

					$idResp=$dataRecla[0]['idRespoReclamo'];
					$idResp2=$dataRecla[0]['idRespoReclamo2'];
					
					$sql=sql::getEmailxId($idResp);
					$valEmail=negocio::getVal($sql,'pers_mail');
					$valEmail=negocio::veriEmailxNom($valEmail);

					$sql=sql::getEmailxId($idResp2);
					$valEmail2=negocio::getVal($sql,'pers_mail');
					$valEmail2=negocio::veriEmailxNom($valEmail2);

					$sql=sql::getDatReclaxId($_GET['id'],'desReclamo');
					$desRecla=negocio::getVal($sql,'desReclamo');		
					
					$sql=sql::getDatReclaxId($_GET['id'],'acciReclamo');
					$desAcciRecla=negocio::getVal($sql,'acciReclamo');
					
					$sql=sql::getDatReclaxId($_GET['id'],'acciReliReclamo');
					$desAcciReliRecla=negocio::getVal($sql,'acciReliReclamo');
					$rutImgRecla=$dataRecla[0]['adjuReclamo'];
					$rutImgRecla=negocio::veriRutImg($rutImgRecla);
					$rutImgRecla=explode('|',$rutImgRecla);

					// OBTENER IDS DE OBSERVACION

					$sql=sql::recla_obsTipxId($dataRecla[0]['detObsId']);
					$dataObs=negocio::getData($sql);
					$cadObs=$dataObs[0]['tipObs']."|".$dataObs[0]['idObs']; 

					// PROPIEDAD DE ESTADO DE ENVIO
					$estaProp=Array();
					$estaProp[0]='';
					$estaProp[1]='';

					$nomCamp=array("enviRespo","enviRespo2");

					for($i=0;$i<2;$i++)
					{

						if($dataRecla[0][$nomCamp[$i]]==1)
						{
							$estaProp[$i]='checked';
						}
						else
						{
							$excep="No estado de envio iniciado";
						}

					}

					#print_r($estaProp);
					
					#print($idTip);

					// adjuntos de reclamo
					$cadAdju="";
					for($i=0;$i<count($rutImgRecla);$i++)
					{
						$cadAdju.="<li><a href='".$rutImgRecla[$i]."' target='_blank' >".$rutImgRecla[$i]."</a></li>";
					}
					
					$desReclaHist=explode("\n",$desAcciRecla);
					
					$desAcciReliReclaHist=explode("\n",$desAcciReliRecla);

				break;
				
				case 'reclamo_lista':
					
					if(isset($_POST['opci'])) 
					{		
						switch($_POST['opci']) 
						{
							case 'cli':
								$sql=sql::getReclaxCli($_POST['des'],$_SESSION['SIS'][2],$_GET['filtro'],$_GET['filtro2'],$_GET['filtro3'],$_GET['filtro4'],$_GET['filtro5']);
								$dataRecla=negocio::getData($sql);
							break;
							
							case 'respo':
								$sql=sql::getReclaxResp($_POST['des'],$_SESSION['SIS'][2],$_GET['filtro'],$_GET['filtro2'],$_GET['filtro3'],$_GET['filtro4'],$_GET['filtro5']);
								$dataRecla=negocio::getData($sql);
							break;
							
							case 'tod':
								$sql=sql::getRecla($_SESSION['SIS'][2],$_GET['filtro'],$_GET['filtro2'],$_GET['filtro3'],$_GET['filtro4'],$_GET['filtro5']);
								$dataRecla=negocio::getData($sql);
							break;					
						}
					}
					else
					{
						$sql=sql::getRecla($_SESSION['SIS'][2],$_GET['filtro'],$_GET['filtro2'],$_GET['filtro3'],$_GET['filtro4'],$_GET['filtro5']);
						$dataRecla=negocio::getData($sql);				
					}
				break;

			/*----------------------------------[*]-----------------------------------------*/
			
			/*------------------------------------------------------------------------------*/
				# CONTROLLER UP VISITAS
			/*------------------------------------------------------------------------------*/

				case 'visita_reporte':
				
					if(is_array($_SESSION['detVisi'])) 
					{			
						$detVisi=$_SESSION['detVisi'];
						$i=0;			
						
						foreach($detVisi as $detVisi)
						{
							$i++;
							$_SESSION['detVisiFin'][$i]['indice']=$detVisi['indice'];
							$_SESSION['detVisiFin'][$i]['empresa']=$detVisi['empresa'];
							$_SESSION['detVisiFin'][$i]['contacto']=$detVisi['contactoConcat'];
							$_SESSION['detVisiFin'][$i]['observacion']=$detVisi['observacion'];
							$_SESSION['detVisiFin'][$i]['observacionPen']=$detVisi['observacionPen'];
							$_SESSION['detVisiFin'][$i]['direccion']=$detVisi['direccion'];

							//------ Add fecha & direccion ------//
							$_SESSION['detVisiFin'][$i]['fechVisi']=$detVisi['fechVisi'];
							$_SESSION['detVisiFin'][$i]['dirOrig']=$detVisi['dirOrig'];
							//-------------[*]------------------//

						}
					}
				
					unset($_SESSION['detVisi']);
					unset($_SESSION['indice']);
					//echo "visita reporte";
					
					$sql=sql::getTrabVendedor();
					$dataTrabVende=negocio::getData($sql);	
					
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getMoneda();
					$dataMoney=negocio::getData($sql);

					//datos generales de visita
					
					desconectar();
					conectar();

					$sql=sql::vi_visiGenxId_obte($_GET['id']);
					$dataVisiGen=negocio::getData($sql);

					if(count($dataVisiGen)>0)
					{
						$fechIni=$dataVisiGen[0]['fechIniVisi'];
						$fechFin=$dataVisiGen[0]['fechFinVisi'];
					}
					else
					{
						$fechIni=negocio::getFechActual();
						$fechFin=negocio::getFechActual();
					}

					desconectar();
					conectar();
									
				break;
				
				case 'historial_visita':
				
					/*
					$sql=sql::getVisitas();
					$dataVisi=negocio::getData($sql);
					*/	
					$dataVisi=array();		
						
					$sql=sql::getYearVisitas();
					$dataVisiFech=negocio::getData($sql);
					
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getTrabVendedor();
					$dataTrabVende=negocio::getData($sql);
					
					//print_r($dataVisiFech);
								
				break;

				case 'vi_visiIng_lst':

					$sql=sql::getTrabVendedorxId($_SESSION['SIS'][10]);
					$valTrab=negocio::getVal($sql,'vendedor');

				break;

			/*--------------------[*]--------------------------------------------------------*/
			
			/*-------------------------------------------------------------------------------*/
				# CONTROLLER UP CUENTAS
			/*-------------------------------------------------------------------------------*/

				case 'cuentax_form':
				
					if(is_array($_SESSION['detCuen'])) 
					{			
						$detCuen=$_SESSION['detCuen'];
						$i=0;			
						
						foreach($detCuen as $detCuen)
						{
							$i++;
							$_SESSION['detCuenFin'][$i]['indice']=$detCuen['indice'];
							$_SESSION['detCuenFin'][$i]['cuenta']=$detCuen['cuenta'];
							$_SESSION['detCuenFin'][$i]['fecha']=$detCuen['fecha'];
							$_SESSION['detCuenFin'][$i]['monto']=$detCuen['monto'];
							$_SESSION['detCuenFin'][$i]['estado']=$detCuen['estado'];

						}
					}
				
					unset($_SESSION['detCuen']);
					unset($_SESSION['indice']);
				
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getMoneda();
					$moneda=negocio::getData($sql);
					
					$sql=sql::getTipDoc();
					$documentos=negocio::getData($sql);
					
					$sql=sql::getBancos();
					$bancos=negocio::getData($sql);
					
					$sql=sql::getCuentaxId(1);
					$cuenta=negocio::getData($sql);
					
					$sql=sql::getEstCuen();
					$estados=negocio::getData($sql);
					
				break;
				
				case 'cuenta_xcobrar':
					
					
					if(isset($_POST['opci'])) 
					{		
						switch($_POST['opci']) 
						{
							case 'ruc':
								$sql=sql::getCuxCobraxRuc($_POST['des']);
								$cuenxCobra=negocio::getData($sql);
							break;
							
							case 'cli':
								$sql=sql::getCuxCobraxCli($_POST['des']);;
								$cuenxCobra=negocio::getData($sql);
							break;
							
							case 'tod':
								$sql=sql::getCuxCobra();
								$cuenxCobra=negocio::getData($sql);
							break;					
						}
					}
					else
					{
							$sql=sql::getCuxCobra();
							$cuenxCobra=negocio::getData($sql);				
					}						
					
				break;
				
				case 'cuentax_edit':
				
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getMoneda();
					$moneda=negocio::getData($sql);
					
					$sql=sql::getTipDoc();
					$documentos=negocio::getData($sql);
					
					$sql=sql::getBancos();
					$bancos=negocio::getData($sql);
					
					$sql=sql::getCuentaxId(1);
					$cuenta=negocio::getData($sql);
					
					$sql=sql::getEstCuen();
					$estados=negocio::getData($sql);
					
					/* inicializando parametros de cuenta a editar */
					
					$sql=sql::getCuxCobraxId($_GET['idCu']);
					$cuentax=negocio::getData($sql);
					
					foreach($cuentax as $data)
					{
						$sql=sql::getClixContacxCli($data['idEmpCli']);
						$empCli=negocio::getVal($sql,'empresa');
						$empRuc=negocio::getVal($sql,'ruc');
						
						$fecha=$data['fecha'];
						$numCompro=$data['numCompro'];
						$idTipMon=$data['idTipMone'];
						$idTipDoc=$data['idTipDoc'];
						$impor=$data['impor'];
						$descrip=$data['descrip'];
						
					}
				
					/*  inicializando parametros de detalle de cuenta a editar */
					
					$sql=sql::getDetCuenxId($_GET['idCu']);
					$detCuen=negocio::getData($sql);
				
				break;
				
				case 'letra_reporte':
				
					if($_GET['menu_id']==71) 
					{
						
						if(isset($_POST['opci'])) 
						{	
							switch($_POST['opci']) 
							{
								
							case 'tod':											
							$sql=sql::getCuenxPag();
							$dataCuenxPag=negocio::getData($sql);
							break;
							
							case 'fech':
							$sql=sql::getCuenxPagxFech($_POST['fechIni'],$_POST['fechFin']);
							$dataCuenxPag=negocio::getData($sql);
							break;						
											
							}
						}		
						else
						{
							$sql=sql::getCuenxPag();
							$dataCuenxPag=negocio::getData($sql);
						}		
					}
					else 
					{
						$exception="ningun menu para iniciar";
					}			
				
				break;

			/*---------------------[*]--------------------------------------------------------*/

			/*---------------------------------------------------------------------------------*/
				# CONTROLLER UP OBSERVACION
			/*---------------------------------------------------------------------------------*/
			
				case 'obsr_form':
				
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getTrabVendRecla();
					$dataTrabVende=negocio::getData($sql);
					
					$sql=sql::getConforObs('tbobs_conforimp','desConfir','idConforImp');
					$dataConfor=negocio::getData($sql);
					
					$sql=sql::getNumFormat();
					$dataNumFormat=negocio::getData($sql);
					
					$sql=sql::getVerFormat();
					$dataVerFormat=negocio::getData($sql);
					
					$sql=sql::getPagFormat();
					$dataPagFormat=negocio::getData($sql);	
				
				break;
				
				case 'obsr_list':
				
					if(isset($_POST['opci'])) 
					{
						switch($_POST['opci']) 
						{
							case 'cod':
								$sql=sql::getObsReclaxCod($_POST['des']);
								$dataObsRecla=negocio::getData($sql);
							break;
							
							case 'cli':
								$sql=sql::getObsReclaxCli($_POST['des']);
								$dataObsRecla=negocio::getData($sql);
							break;
							
							case 'tod':
								$sql=sql::getObsRecla($_POST['des']);
								$dataObsRecla=negocio::getData($sql);
							break;
						}
					}
					else 
					{
							$sql=sql::getObsRecla();
							$dataObsRecla=negocio::getData($sql);					
					}
				break;
				
				case 'obsr_edit':
				
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getTrabVendRecla();
					$dataTrabVende=negocio::getData($sql);
					
					$sql=sql::getConforObs('tbobs_conforimp','desConfir','idConforImp');
					$dataConfor=negocio::getData($sql);
					
					$sql=sql::getNumFormat();
					$dataNumFormat=negocio::getData($sql);
					
					$sql=sql::getVerFormat();
					$dataVerFormat=negocio::getData($sql);
					
					$sql=sql::getPagFormat();
					$dataPagFormat=negocio::getData($sql);
					
					$sql=sql::getObsReclaxIdObs($_GET['id']);
					$dataObsRe=negocio::getData($sql);
					
					$sql=sql::getClixContacxCli($dataObsRe[0]['idEmp']);
					$cli=negocio::getVal($sql,'empresa');
					
					$sql=sql::getContacxCli($cli);
					$dataContac=negocio::getData($sql);
					
					$idContac=$dataObsRe[0]['idContac'];
					
					$idRespo=$dataObsRe[0]['idRespCarg'];
					
					$numGene=$dataObsRe[0]['numInfor'];
					
					$desObserv=$dataObsRe[0]['desObserv'];
					
					$acciCorre=$dataObsRe[0]['acciCorre'];
					
					$fechContro=$dataObsRe[0]['fechContro'];
					
					$fechLim=$dataObsRe[0]['fechLim'];
					
					$fechVeri=$dataObsRe[0]['fechVeri'];
					
					$fechAcorVeri=$dataObsRe[0]['fechAcorVeri'];
					
					$fechVeriEfec=$dataObsRe[0]['fechVeriEfec'];
					
					$fechEfecSati=$dataObsRe[0]['fechEfecSati'];
					
					$eviObje=$dataObsRe[0]['eviObje'];
					
					$fechCie=$dataObsRe[0]['fechCie'];
					
					$fechSegui=$dataObsRe[0]['fechSegui'];
					
					$idConforImp=$dataObsRe[0]['idConforImp'];
					
					$idConforEfec=$dataObsRe[0]['idConforEfec'];
					
					$idConforAc=$dataObsRe[0]['idConforAc'];
					
					/*$firephp = FirePHP::getInstance(true);
					$firephp->log($dataObsRe[0]['idEmp'], 'cli');*/
				
				break;
				
				case 'obsq_form':
				
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getTrabVendRecla();
					$dataTrabVende=negocio::getData($sql);	
				
				break;
				
				case 'obsq_list':
				
					if(isset($_POST['opci'])) 
					{
						switch($_POST['opci']) 
						{
							case 'cod':
								$sql=sql::getObsQuejaxCod($_POST['des']);
								$dataObsQueja=negocio::getData($sql);
							break;
							
							case 'cli':
								$sql=sql::getObsQuejaxCli($_POST['des']);
								$dataObsQueja=negocio::getData($sql);
							break;
							
							case 'tod':
								$sql=sql::getObsQueja();
								$dataObsQueja=negocio::getData($sql);
							break;
						}
					}
					else 
					{
							$sql=sql::getObsQueja();
							$dataObsQueja=negocio::getData($sql);					
					}			
					
				break;
				
				case 'obsq_edit':
				
					$sql=sql::getObsQuexIdObs($_GET['id']);
					$dataObsQueja=negocio::getData($sql);
					
					$fechQue=$dataObsQueja[0]['fechContro'];
					
					$sql=sql::getClixContacxCli($dataObsQueja[0]['idEmp']);
					$cli=negocio::getVal($sql,'empresa');
					
					$sql=sql::getEmpCliente();
					$clientes=negocio::getData($sql);
					
					$sql=sql::getContacxCli($cli);
					$dataContac=negocio::getData($sql);
					
					$sql=sql::getTrabVendRecla();
					$dataTrabVende=negocio::getData($sql);
					
					$idContac=$dataObsQueja[0]['idContac'];
					
					$idRespo=$dataObsQueja[0]['idRespCarg'];
					
					$desObserv=$dataObsQueja[0]['desObserv'];
					
					$soluInme=$dataObsQueja[0]['soluInme'];
					
					/*
						$firephp = FirePHP::getInstance(true);
						$firephp->log($dataObsQueja, 'array');
					*/		
				
				break;

			/*---------------------------[*]----------------------------------------------------*/
			
			/*---------------------------------------------------------------------------------*/
				# CONTROLLER UP COBRANZAS
			/*---------------------------------------------------------------------------------*/
			
				case 'reporte_xcobrar':

					mysql_close();
					include('conf2.php');

					$sql=sql::getTipDocSf();
					$dataTipDoc=negocio::getData($sql);

					$sql=sql::getSubDiaSf();
					$dataSubDi=negocio::getData($sql);

					$sql=sql::getTipCambActSf();
					$dataTipCam=negocio::getData($sql);

					$cambCompra=$dataTipCam[count($dataTipCam)-1]['TIPOCAMB_COMPRA'];
					$cambVenta=$dataTipCam[count($dataTipCam)-1]['TIPOCAMB_VENTA'];
					$cambFecha=$dataTipCam[count($dataTipCam)-1]['fechCamb'];

					$sql=sql::getMoneSf();
					$dataMone=negocio::getData($sql);

					$sql=sql::getCliSf();
					$dataCli=negocio::getData($sql);

					if(isset($_POST['opci']))
					{
						switch($_POST['opci'])
						{
							case 'FT':
								if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc' and $_POST['filCheck'][2]=='ruc')
								{
									$sql=sql::getCobFacxFechxDocxRucSf('FT',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else if($_POST['filCheck'][0]=='doc' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxDocxRucSf('FT',$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc')
								{
									$sql=sql::getCobFacxFechxDocSf('FT',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxFechxRucSf('FT',$_POST['fechIni'],$_POST['fechFin'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else if ($_POST['filCheck'][0]=='fech') 
								{
									$sql=sql::getCobFacxFechSf('FT',$_POST['fechIni'],$_POST['fechFin']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else if($_POST['filCheck'][0]=='doc')
								{
									$sql=sql::getCobFacxDocSf('FT',$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else if($_POST['filCheck'][0]=='ruc')
								{
									$sql=sql::getCobFacxRucSf('FT',$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
								}
								else
								{
									$sql=sql::getCobFacSf('FT');
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
									$tipCob="FT";
									#print $_POST['filCheck'][0];
									#print $_POST['filCheck'][1];
									#print $_POST['filCheck'][2];
								}
							break;

							case 'FN':
								if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc' and $_POST['filCheck'][2]=='ruc')
								{
									$sql=sql::getCobFacxFechxDocxRucSf('FN',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else if($_POST['filCheck'][0]=='doc' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxDocxRucSf('FN',$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc')
								{
									$sql=sql::getCobFacxFechxDocSf('FN',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxFechxRucSf('FN',$_POST['fechIni'],$_POST['fechFin'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else if ($_POST['filCheck'][0]=='fech') 
								{
									$sql=sql::getCobFacxFechSf('FN',$_POST['fechIni'],$_POST['fechFin']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else if($_POST['filCheck'][0]=='doc')
								{
									$sql=sql::getCobFacxDocSf('FN',$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else if($_POST['filCheck'][0]=='ruc')
								{
									$sql=sql::getCobFacxRucSf('FN',$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS POR FACTURAR";
									$tipCob="FN";
								}
								else
								{
								$sql=sql::getCobFacSf('FN');
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS POR FACTURAR";
								$tipCob="FN";
								}
							break;

							case 'FP':
								if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc' and $_POST['filCheck'][2]=='ruc')
								{
									$sql=sql::getCobFacxFechxDocxRucSf('FP',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else if($_POST['filCheck'][0]=='doc' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxDocxRucSf('FP',$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc')
								{
									$sql=sql::getCobFacxFechxDocSf('FP',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxFechxRucSf('FP',$_POST['fechIni'],$_POST['fechFin'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else if ($_POST['filCheck'][0]=='fech') 
								{
									$sql=sql::getCobFacxFechSf('FP',$_POST['fechIni'],$_POST['fechFin']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else if($_POST['filCheck'][0]=='doc')
								{
									$sql=sql::getCobFacxDocSf('FP',$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else if($_POST['filCheck'][0]=='ruc')
								{
									$sql=sql::getCobFacxRucSf('FP',$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
									$tipCob="FP";
								}
								else
								{
								$sql=sql::getCobFacSf('FP');
								$dataVenFac=negocio::getData($sql);
								$resulTipCob="COBRANZAS FACTURADAS PENDIENTES";
								$tipCob="FP"; 
								}
							break;

							case 'FA':
							if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc' and $_POST['filCheck'][2]=='ruc')
								{
									$sql=sql::getCobFacxFechxDocxRucSf('FA',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else if($_POST['filCheck'][0]=='doc' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxDocxRucSf('FA',$_POST['numDoc'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='doc')
								{
									$sql=sql::getCobFacxFechxDocSf('FA',$_POST['fechIni'],$_POST['fechFin'],$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else if($_POST['filCheck'][0]=='fech' and $_POST['filCheck'][1]=='ruc')
								{
									$sql=sql::getCobFacxFechxRucSf('FA',$_POST['fechIni'],$_POST['fechFin'],$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else if ($_POST['filCheck'][0]=='fech') 
								{
									$sql=sql::getCobFacxFechSf('FA',$_POST['fechIni'],$_POST['fechFin']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else if($_POST['filCheck'][0]=='doc')
								{
									$sql=sql::getCobFacxDocSf('FA',$_POST['numDoc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else if($_POST['filCheck'][0]=='ruc')
								{
									$sql=sql::getCobFacxRucSf('FA',$_POST['txtRuc']);
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
								else
								{
									$sql=sql::getCobFacSf('FA');
									$dataVenFac=negocio::getData($sql);
									$resulTipCob="COBRANZAS FACTURADAS ANULADAS";
									$tipCob="FA";
								}
							break;

							case'':

									$dataVenFac=Array();
									$tipCob="";
									$resulTipCob="NINGUN FILTRO COBRANZA SELECCIONADO";

							break;

							default:
							break;
						}
					}
					else
					{
						/*
						$sql=sql::getCobFacSf('FT');
						$dataVenFac=negocio::getData($sql);
						$resulTipCob="COBRANZAS FACTURADAS COBRADAS";
						$tipCob="FT";
						*/
						
						$dataVenFac=Array();
						$tipCob="";
						$resulTipCob="NINGUN FILTRO COBRANZA SELECCIONADO";
					}

					
						/*$firephp = FirePHP::getInstance(true);
						$firephp->log($dataMone, 'valor:');*/
					
				break;

				case 'factura_cance':

					mysql_close();
					include('conf2.php');


					if(isset($_POST['cliFacCan']) and $_POST['cliFacCan']!='Todos' )
					{

						$sql=sql::jn_getFactCancexRuc($_POST['cliFacCan']);
						$dataFacCance=negocio::getData($sql);

						$sql=sql::jn_getAnexCli();
						$dataAnexCli=negocio::getData($sql);

						$dataAnexCli[count($dataAnexCli)-1]['anex_codigo']='Todos';
						$dataAnexCli[count($dataAnexCli)-1]['anex_descripcion']='Todos';

						for($i=0;$i<count($dataAnexCli);$i++)
						{
							if ($dataAnexCli[$i]['anex_codigo']==$_POST['cliFacCan']) 
							{
								$dataAnexCli[$i]['propSelec']='selected';
							}
							else
							{
								$dataAnexCli[$i]['propSelec']='';
							}
						}

					}
					else
					{
						$sql=sql::jn_getFactCance();
						$dataFacCance=negocio::getData($sql);

						$sql=sql::jn_getAnexCli();
						$dataAnexCli=negocio::getData($sql);

						$dataAnexCli[count($dataAnexCli)-1]['anex_codigo']='Todos';
						$dataAnexCli[count($dataAnexCli)-1]['anex_descripcion']='Todos';

						for($i=0;$i<count($dataAnexCli);$i++)
						{
							if ($i==count($dataAnexCli)-1) 
							{
								$dataAnexCli[$i]['propSelec']='selected';
							}
							else
							{
								$dataAnexCli[$i]['propSelec']='';
							}
						}

					}

			 	
			 	break;

			 	case 'documento_cob':

			 		mysql_close();
					include('conf2.php');

			 		$sql=sql::jn_getTipDoc();
			 		$dataTipDoc=negocio::getData($sql);

			 	break;

		 	/*-------------------------[*]------------------------------------------------------*/

		 	/*----------------------------------------------------------------------------------*/
		 		# CONTROLLER UP VACACIONES
		 	/*-----------------------------------------------------------------------------------*/

			 	case 'vaca_asig':

			 		$sql=sql::vaca_areTrab();
			 		$dataAreTrab=negocio::getData($sql);

			 		/*$firephp = FirePHP::getInstance(true);
					$firephp->log($dataAreTrab, 'valor:');*/

					$sql=sql::vaca_trabAdm();
					$dataTrabAdm=negocio::getData($sql);

					for($i=0;$i<count($dataAreTrab);$i++)
					{
						if($dataAreTrab[$i]['trab_funcion_id']==2)
						{
							$dataAreTrab[$i]['propSelec']='selected';
						}
						else
						{
							$dataAreTrab[$i]['propSelec']='';
						}
					}

					$sql=sql::vaca_periAn();
					$dataPeriAn=negocio::getData($sql);

			 	break;

			 	case 'vaca_period':
			 		
			 		$sql=sql::vaca_areTrab();
			 		$dataAreTrab=negocio::getData($sql);

					$sql=sql::vaca_trabAdm();
					$dataTrabAdm=negocio::getData($sql);

					for($i=0;$i<count($dataAreTrab);$i++)
					{
						if($dataAreTrab[$i]['trab_funcion_id']==2)
						{
							$dataAreTrab[$i]['propSelec']='selected';
						}
						else
						{
							$dataAreTrab[$i]['propSelec']='';
						}
					}

					$indTod=count($dataTrabAdm);

					$dataTrabAdm[$indTod]['persona']='Todos';
					$dataTrabAdm[$indTod]['persona_id']='Todos';

					for($i=0;$i<count($dataTrabAdm);$i++)
					{
						if($dataTrabAdm[$i]['persona']=='Todos')
						{
							$dataTrabAdm[$i]['propSelec']='selected';
						}
						else
						{
							$dataTrabAdm[$i]['propSelec']='';
						}
					}

					$sql=sql::vaca_periAn();
					$dataPeriAn=negocio::getData($sql);

					$indTod=count($dataPeriAn);

					$dataPeriAn[$indTod]['vaca_perioAn_id']='Todos';
					$dataPeriAn[$indTod]['vaca_desPeri']='Todos';

					/*$firephp = FirePHP::getInstance(true);
					$firephp->log($dataPeriAn, 'valor:');*/

					for($i=0;$i<count($dataPeriAn);$i++)
					{
						if($dataPeriAn[$i]['vaca_perioAn_id']==1)
						{
							$dataPeriAn[$i]['propSelec']='selected';
						}
						else
						{
							$dataPeriAn[$i]['propSelec']='';
						}
					}

					$sql=sql::vaca_getTrabAsig('2','1');
					$dataTrabAsig=negocio::getData($sql);

					$sql=sql::vaca_getPeriAn('1');
					$valPeri=negocio::getVal($sql,'vaca_desPeri');

					/*
					$sql=sql::vaca_PeriTrab();
					$dataPeriTrab=negocio::getData($sql);
					*/

			 	break;

			 	case 'vaca_puser':

					$sql=sql::vaca_periAn();
					$dataPeriAn=negocio::getData($sql);

					$indTod=count($dataPeriAn);

					$dataPeriAn[$indTod]['vaca_perioAn_id']='Todos';
					$dataPeriAn[$indTod]['vaca_desPeri']='Todos';

					/*$firephp = FirePHP::getInstance(true);
					$firephp->log($dataPeriAn, 'valor:');*/

					for($i=0;$i<count($dataPeriAn);$i++)
					{
						if($dataPeriAn[$i]['vaca_perioAn_id']==1)
						{
							$dataPeriAn[$i]['propSelec']='selected';
						}
						else
						{
							$dataPeriAn[$i]['propSelec']='';
						}
					}

					$sql=sql::vaca_PeriTrabxTrab($_SESSION['SIS'][2],'1');
					$dataPeriTrab=negocio::getData($sql);

					$sql=sql::vaca_getPeriAn('1');
					$valPeri=negocio::getVal($sql,'vaca_desPeri');

					$sql=sql::vaca_getVacaInixUser($_SESSION['SIS'][2]);
					$valFechIni=negocio::getVal($sql,'fechModi');

					$sql=sql::vaca_getForCalxTrab($_SESSION['SIS'][2],'1');
					$valForCal=negocio::getVal($sql,'forCal');
			 		
			 	break;

			 	case 'vaca_apPer':

			 		$sql=sql::vaca_getPeriAnxCom();
			 		$dataPerAn=negocio::getData($sql);

			 		for($i=0;$i<count($dataPerAn);$i++) 
			 		{
			 			if($dataPerAn[$i]['vaca_estado_id']==1)
			 			{
			 				$dataPerAn[$i]['prop']='checked';
			 			}
			 			else
			 			{
			 				$dataPerAn[$i]['prop']='';	
			 			}
			 		}

			 	break;

		 	/*-------------------[*]--------------------------------------------------------------*/

		 	/*-------------------------------------------------------------------------------------*/  
		 		# CONTROLADOR DEL MODULO CENTRO DE COSTOS
		 	/*-------------------------------------------------------------------------------------*/

			 	case 'cc_cosPro':

			 		$sql=sql::cc_clasiProdServ();
			 		$dataProdServ=negocio::getData($sql);

			 		$sql=sql::cc_getMone();
			 		$dataMone=negocio::getData($sql);

			 		$dataTipComp=array(
			 							0=>array(
			 								'tipCompId'=>1,
			 								'tipCompDes'=>'OC'
			 								),
			 							1=>array(
			 								'tipCompId'=>2,
			 								'tipCompDes'=>'EW'
			 								),
			 							2=>array(
			 								'tipCompId'=>3,
			 								'tipCompDes'=>'OS'
			 								)
			 						 );

			 		$fechOcAct=date("Y-m-d");

			 		# ELIMINAR SESION ARRAY DE ORDENES 

			 		unset($_SESSION['arrCotiFl']);

			 		//print_r($dataTipComp);

			 		/**********************************************************/
			 			# MODULO FINANZAS & CENTRO DE COSTO - CONTROLADOR SUP
			 		/**********************************************************/

				 		$opeBanca=file_get_contents('templateFinanzas/finan_opeBanca.html');

				 		$sql=sql::finan_docFinan_list();
				 		$dataDocFinan=negocio::getData($sql);
				 		$html_docFinan="";

				 		//iterar documentos bancarios
				 		foreach ($dataDocFinan as $data) 
				 		{
				 			desconectar();
				 			conectar();

				 			$sql=sql::finan_tipDoc_list($data['docId']);
				 			$dataTipDoc=negocio::getData($sql);
				 			$tipDoc_html="";

				 			foreach($dataTipDoc as $data2)
				 			{
				 				$tipDoc_html.="<li>
				 									<input type='checkbox' name='finan_tipDoc[]' id='finan_tipDoc' value='".$data2['tipDoc']."' >".$data2['tipDocAlias']."
				 								</li>";
				 			}

				 			$docFinan_html.="<li>
											".$data['docDes']."
											<ul>
												".$tipDoc_html."
											</ul>
										</li>";
				 		}

				 		//iniciar centro de costo temporal
				 		desconectar();
				 		conectar();
				 		$sql=sql::finan_cenCost_cre();
				 		$centroId=negocio::getVal($sql,'response');

				 		//renderizado
				 		$search=array('[DOCUMENTOS]','[CENTRO]');
				 		$replace=array($docFinan_html,$centroId);
				 		$opeBanca=str_replace($search,$replace,$opeBanca);

			 		/*-------------------------------o---------------------------------*/

			 	break;

			 	case 'cc_cosCread':

			 		/*
				 		if($_POST['cotiFl']!='')
				 		{
				 			$sql=sql::cc_costCreadxFil($_POST['cotiFl']);
					 		$dataCostCread=negocio::getData($sql);

				 		}
				 		else if($_POST['cotiFl']=='')
				 		{
				 			$sql=sql::cc_costCreadTod();
					 		$dataCostCread=negocio::getData($sql);
				 		}
				 		else
				 		{
				 			$sql=sql::cc_costCreadTod();
					 		$dataCostCread=negocio::getData($sql);
				 		}
			 		*/

				 		$sql=sql::cc_pcCentCostTod();
				 		$dataCenCost=negocio::getData($sql);

				 		/* EVALUAR CENTROS DE COSTOS APERTURADOS */
				 		for($i=0;$i<count($dataCenCost);$i++)
				 		{
				 			if($dataCenCost[$i]['idEstApe']==1)
				 			{
				 				$dataCenCost[$i]['propEstApe']='checked';
				 			}
				 			else
				 			{
				 				$dataCenCost[$i]['propEstApe']='';
				 			}
				 		}

				 		$sql=sql::cc_getEstCent();
				 		$dataEstCent=negocio::getData($sql);

				 		$indEst=count($dataEstCent);

				 		$dataEstCent[$indEst]['idEstApe']='todos';
				 		$dataEstCent[$indEst]['desEstApe']='todos';

			 	break;

			 	case 'cc_asigPro':

			 		$sql=sql::cc_getCentCostxId($_GET['idCen']);
			 		$dataCentGrl=negocio::getData($sql);

			 		// OBTENER ARRAY FL MULTI
			 		$arrFlMulti=explode("|",$dataCentGrl[0]['flMulti']);
			 		$listFlMuti="";

			 		for($i=0;$i<count($arrFlMulti);$i++)
			 		{
			 			if($i==0)
			 			{
			 				$listFlMuti="<li>".$arrFlMulti[$i]."</li>";
			 			}
			 			else
			 			{
			 				$listFlMuti=$listFlMuti."<li>".$arrFlMulti[$i]."</li>";
			 			}
			 		}


			 		$sql=sql::cc_getDetProyexId($_GET['idCen']);
			 		$dataDetCentCost=negocio::getData($sql);

			 		$sql=sql::cc_getMone();
			 		$dataMone=negocio::getData($sql);

			 		for($i=0;$i<count($dataMone);$i++)
			 		{
			 			if($dataMone[$i]['moneda_id']==$dataCentGrl[0]['moneId'])
			 			{
			 				$dataMone[$i]['mone_ini']='selected';
			 			}
			 			else
			 			{
			 				$dataMone[$i]['mone_ini']='';
			 			}	
			 		}

			 		$dataTipComp=array(
			 							0=>array(
			 								'tipCompId'=>1,
			 								'tipCompDes'=>'OC'
			 								),
			 							1=>array(
			 								'tipCompId'=>2,
			 								'tipCompDes'=>'EW'
			 								),
			 							2=>array(
			 								'tipCompId'=>3,
			 								'tipCompDes'=>'OS'
			 								)
			 						 );

			 		$fechOcAct=date("Y-m-d");

			 		# ELIMINAR SESION ARRAY DE ORDENES 

			 		unset($_SESSION['arrCotiFl']);

			 		// print_r($dataTipComp);

			 		/* CONVERSION DE TOTALES A DOLARES Y SOLES */
			 		$sql=sql::cc_totConverOrd($_GET['idCen']);
			 		$dataConverTot=negocio::getData($sql);

			 		/* INICIAR TOTALES ORDENES DE SERVICIOS */
			 		$sql=sql::os_totMontxMone($_GET['idCen']);
			 		$dataTotServ=negocio::getData($sql);

					/* INICIAR TOTALES VISITAS */
					$sql=sql::visi_totMontxMone($_GET['idCen']);
					$dataTotVisi=negocio::getData($sql);		 		

			 		/*
				 		$totSolesArr=negocio::evaConverTot('soles',$dataConverTot[0]['totSoles']);
				 		$totDolArr=negocio::evaConverTot('dolar',$dataConverTot[0]['totDolares']);
				 		$totHebArr=negocio::evaConverTot('hebros',$dataConverTot[0]['totHebros']);
			 		*/

			 		/*
				 		$totGastProyeDol=$totSolesArr[0]['totDol']+$totDolArr[0]['totDol']+$totHebArr[0]['totDol'];
				 		$totGastProyeSol=$totSolesArr[0]['totSol']+$totDolArr[0]['totSol']+$totHebArr[0]['totSol'];
			 		*/

				 	/* TOTALES DE ORDENES */
			 		$totSolOrd=negocio::evaNullTot($dataConverTot[0]['totSoles']);
			 		$totDolOrd=negocio::evaNullTot($dataConverTot[0]['totDolares']);
			 		$totHebOrd=negocio::evaNullTot($dataConverTot[0]['totHebros']);

			 		/* TOTALES DE SERVICIOS */
			 		$totSolServ=negocio::evaNullTot($dataTotServ[0]['montSolServ']);
			 		$totDolServ=negocio::evaNullTot($dataTotServ[0]['montDolServ']);
			 		$totHebServ=negocio::evaNullTot($dataTotServ[0]['montHebServ']);

			 		/* TOTALES DE VISITAS */
			 		$totSolVisi=negocio::evaNullTot($dataTotVisi[0]['totSolVisi']);
			 		$totDolVisi=negocio::evaNullTot($dataTotVisi[0]['totDolVisi']);
			 		$totHebVisi=negocio::evaNullTot($dataTotVisi[0]['totHebVisi']);

			 		/* TOTALES DEFINIDOS EN CENTRO DE COSTOS */
			 		$totSol=$totSolOrd+$totSolServ+$totSolVisi;
			 		$totDol=$totDolOrd+$totDolServ+$totDolVisi;
			 		$totHeb=$totHebOrd+$totHebServ+$totHebVisi;	

			 		$arrAdju=Array();
			 		$arrAdju=explode(" ",$dataCentGrl[0]['fileAdju']);

			 		/**********************************************************/
			 			# MODULO FINANZAS & CENTRO DE COSTO - CONTROLADOR SUP
			 		/**********************************************************/

				 		$opeBanca=file_get_contents('templateFinanzas/finan_opeBanca.html');

				 		$sql=sql::finan_docFinan_list();
				 		$dataDocFinan=negocio::getData($sql);
				 		$html_docFinan="";

				 		//iterar documentos bancarios
				 		foreach ($dataDocFinan as $data) 
				 		{
				 			desconectar();
				 			conectar();

				 			$sql=sql::finan_tipDoc_list($data['docId']);
				 			$dataTipDoc=negocio::getData($sql);
				 			$tipDoc_html="";

				 			foreach($dataTipDoc as $data2)
				 			{
				 				$tipDoc_html.="<li>
				 									<input type='checkbox' name='finan_tipDoc[]' id='finan_tipDoc' value='".$data2['tipDoc']."' >".$data2['tipDocAlias']."
				 								</li>";
				 			}

				 			$docFinan_html.="<li>
											".$data['docDes']."
											<ul>
												".$tipDoc_html."
											</ul>
										</li>";
				 		}

				 		//iniciar centro de costo temporal
				 		/*
				 		desconectar();
				 		conectar();
				 		$sql=sql::finan_cenCost_cre();
				 		$centroId=negocio::getVal($sql,'response');
				 		*/
				 		$centroId='';

				 		//renderizado
				 		$search=array('[DOCUMENTOS]','[CENTRO]');
				 		$replace=array($docFinan_html,$centroId);
				 		$opeBanca=str_replace($search,$replace,$opeBanca);

			 		/*-------------------------------[*]---------------------------------*/

			 	break;

			 	case 'cc_centAnu_ape':

			 		$dataAnu=cc_periActu_obte();

			 		//obtener empresa por id
			 		$sql=sql::cc_empxId_re($_SESSION['SIS'][5]);
			 		$emp=negocio::getVal($sql,'response');

			 	break;

		 	/*---------------------[*]--------------------------------------------------------------*/

		 	/* ------------------------------------------------------------------------------------- */
		 		# CONTROLADOR SUPERIOR DEL MODULO DE MOVIMIENTO DE PERSONAL
		 	/* ------------------------------------------------------------------------------------- */

			 	case 'mp_movPer':
			 		
			 		/* LIMPIAR ARRAY SESION */
			 		unset($_SESSION['arrMovPer']);

			 		/* INICIALIZAR AREA DE TRABAJADOR */
			 		$sql=sql::mp_arexUser($_SESSION['SIS'][2]);
			 		$valAre=negocio::getVal($sql,'funDes');

			 		$sql=sql::mp_centCost();
			 		$dataCentCost=negocio::getData($sql);

			 	break;

			 	case 'mp_valiMov':

			 		 $sql=sql::mp_movPerShow();
			 		 $dataMovPer=negocio::getData($sql);

			 		 $sql=sql::mp_aprobGereAre();
			 		 $dataGereAre=negocio::getData($sql);

			 		 $sql=sql::mp_aprobGereFinan();
			 		 $dataGereFinan=negocio::getData($sql);

			 		 $sql=sql::mp_aprobGereGene();
			 		 $dataGereGene=negocio::getData($sql);

			 		 $sql=sql::mp_pruebConf();
			 		 $dataPrueb=negocio::getData($sql);

			 		 /* QUERY MODULO VACACION */
			 		 $sql=sql::vaca_areTrab();
			 		 $dataAreTrab=negocio::getData($sql);

			 		 $sql=sql::vaca_trabxAr(1);
					 $dataTrabAdm=negocio::getData($sql);

					$sql=sql::cc_getMone();
			 		$dataMone=negocio::getData($sql);

			 	break;

			 	case 'mp_reporMov':

			 		$sql=sql::mp_mesMov();
			 		$dataMesMov=negocio::getData($sql);

			 		$sql=sql::mp_anMov();
			 		$dataAnMov=negocio::getData($sql);

			 	break;

		 	/*--------------------[*]-----------------------------------------------------------------*/

		 	/*----------------------------------------------------------------------------------------*/
		 		# CONTROLADOR SUPERIOR DEL MODULO DE COTIZACION DE SERVICIOS
		 	/*----------------------------------------------------------------------------------------*/

			 	case 'cs_genCot':

			 		$sql=sql::cs_respComer();
			 		$dataRespComer=negocio::getData($sql);

			 		$sql=sql::cs_priorCoti();
			 		$dataPrior=negocio::getData($sql);

			 		$sql=sql::cs_estCoti();
			 		$dataEst=negocio::getData($sql);

			 		$sql=sql::cs_empCLi();
			 		$dataCli=negocio::getData($sql);

			 		$sql=sql::cs_getMone();
			 		$dataMone=negocio::getData($sql);

			 		/*
			 		$firephp = FirePHP::getInstance(true);
					$firephp->log($dataCli, 'data:');
					*/

			 	break;

			 	case 'cs_espeCot':

			 		$sql=sql::cs_respComer();
			 		$dataRespComer=negocio::getData($sql);

			 		$sql=sql::cs_priorCoti();
			 		$dataPrior=negocio::getData($sql);

			 		$sql=sql::cs_estCoti();
			 		$dataEst=negocio::getData($sql);

			 		$sql=sql::cs_empCLi();
			 		$dataCli=negocio::getData($sql);

			 		$sql=sql::cs_getMone();
			 		$dataMone=negocio::getData($sql);

			 		$sql=sql::cs_getTipServ();
			 		$dataTipServ=negocio::getData($sql);

			 		/* CORRELATIVO GENERADO */
			 		$sql=sql::cs_correServxId($_GET['id']);
			 		$correVal=negocio::getVal($sql,'correServ');

			 		/* DETALLE GENERAL COTIZACION */
			 		$sql=sql::cs_detGenServ($_GET['id']);
			 		$dataCotiDet=negocio::getData($sql);

			 		/* INICIAR CONDICIONES DE SERVICIO */
			 		$sql=sql::cs_condServCoti($_GET['id']);
			 		$dataCondServ=negocio::getData($sql);

			 		foreach($dataCondServ as $data)
			 		{
			 			$reqCond=$data['reqCond'];
			 			$tiemEje=$data['tiemEje'];
			 			$garanCond=$data['garanCond'];
			 			$condPag=$data['condPag'];
			 			$tiemVali=$data['tiemVali'];
			 		}

			 		foreach($dataCotiDet as $data)
			 		{
			 			$fecha=$data['cs_fechCoti'];
			 			$cliDes=$data['empDes'];
			 			$cliId=$data['cliId'];
			 			$descrip=$data['cs_desServ'];
			 			$respComerId=$data['cs_respComerId'];
			 			$priorId=$data['cs_priorId'];
			 			$estServId=$data['cs_estServId'];
			 			$moneId=$data['cs_moneId'];
			 		}

			 		/* EVALUAR INICIO DE RESPONSABLE COMERCIAL */
			 		$dataRespComer=negocio::cs_evaIniComb($dataRespComer,$respComerId,"respComerId");

			 		/* EVALUAR INICIO DE PRIORIDAD */
			 		$dataPrior=negocio::cs_evaIniComb($dataPrior,$priorId,"priorId");

			 		/* EVALUAR INICIO DE ESTADO */
			 		$dataEst=negocio::cs_evaIniComb($dataEst,$estServId,"cotEstId");

			 		/* EVALUAR INICIO DE ESTADO */
			 		$dataMone=negocio::cs_evaIniComb($dataMone,$moneId,"moneda_id");

			 		/*
			 		$firephp = FirePHP::getInstance(true);
					$firephp->log($dataRespComer, 'data:');
					*/
					

			 	break;

			 	case 'cs_lisCot':

			 		$sql=sql::cs_CotServTod();
			 		$dataCotServ=negocio::getData($sql);

			 	break;

		 	/*--------------------[*]-----------------------------------------------------------------*/

		 	/*----------------------------------------------------------------------------------------*/
		 		# COTIZACION SUPERIOR DEL MODULO ORDEN DE SERVICIO
		 	/*----------------------------------------------------------------------------------------*/

			 	case 'os_espeOrd':

			 		$sql=sql::cs_respComer();
			 		$dataRespComer=negocio::getData($sql);

			 		$sql=sql::cs_priorCoti();
			 		$dataPrior=negocio::getData($sql);

			 		$sql=sql::cs_estCoti();
			 		$dataEst=negocio::getData($sql);

			 		$sql=sql::cs_empCLi();
			 		$dataCli=negocio::getData($sql);

			 		$sql=sql::cs_getMone();
			 		$dataMone=negocio::getData($sql);

			 		$sql=sql::cs_getTipServ();
			 		$dataTipServ=negocio::getData($sql);

			 		/* CORRELATIVO GENERADO */
			 		$sql=sql::cs_correServxId($_GET['id']);
			 		$correVal=negocio::getVal($sql,'correServ');

			 		/* DETALLE GENERAL COTIZACION */
			 		$sql=sql::cs_detGenServ($_GET['id']);
			 		$dataCotiDet=negocio::getData($sql);

			 		/* INICIAR CONDICIONES DE SERVICIO */
			 		$sql=sql::cs_condServCoti($_GET['id']);
			 		$dataCondServ=negocio::getData($sql);

			 		foreach($dataCondServ as $data)
			 		{
			 			$reqCond=$data['reqCond'];
			 			$tiemEje=$data['tiemEje'];
			 			$garanCond=$data['garanCond'];
			 			$condPag=$data['condPag'];
			 			$tiemVali=$data['tiemVali'];
			 		}

			 		foreach($dataCotiDet as $data)
			 		{
			 			$fecha=$data['cs_fechCoti'];
			 			$cliDes=$data['empDes'];
			 			$cliId=$data['cliId'];
			 			$descrip=$data['cs_desServ'];
			 			$respComerId=$data['cs_respComerId'];
			 			$priorId=$data['cs_priorId'];
			 			$estServId=$data['cs_estServId'];
			 			$moneId=$data['cs_moneId'];
			 		}

			 		/* EVALUAR INICIO DE RESPONSABLE COMERCIAL */
			 		$dataRespComer=negocio::cs_evaIniComb($dataRespComer,$respComerId,"respComerId");

			 		/* EVALUAR INICIO DE PRIORIDAD */
			 		$dataPrior=negocio::cs_evaIniComb($dataPrior,$priorId,"priorId");

			 		/* EVALUAR INICIO DE ESTADO */
			 		$dataEst=negocio::cs_evaIniComb($dataEst,$estServId,"cotEstId");

			 		/* EVALUAR INICIO DE ESTADO */
			 		$dataMone=negocio::cs_evaIniComb($dataMone,$moneId,"moneda_id");

			 		/* OBTENER EL PC-ID POR COTI-ID  */
			 		$sql=sql::os_getPcId($_GET['id']);
			 		$pcId=negocio::getVal($sql,'cs_pcId');

			 	break;

			 	/* FLUJO PROBABLE CONTROLADOR SUPERIOR [fp_controSup] */

			 	case 'fp_flujProbIn':

			 		$sql=sql::fp_userVend();
			 		$data_userVend=negocio::getData($sql);
			 	
			 	break;

		 	/*--------------------[*]----------------------------------------------------------------*/

		 	/* -------------------------------------------------------------------------------------*/
		 		# CONTROLADOR SEGUIMIENTO DE CENTRO DE COSTO [scc_controSup] 
		 	/* ------------------------------------------------------------------------------------ */

			 	case 'scc_creadSegui':

			 		$sql=sql::scc_seguiGen();
			 		$data_seguiGen=negocio::getData($sql);

			 	break;

			 	case 'scc_detSegui':

			 		$sql=sql::scc_datGenSegui($_GET['id']);
			 		$data_datGenSegui=negocio::getData($sql);

			 		foreach($data_datGenSegui as $data)
			 		{
			 			$sc=$data['sc'];
			 			$cc=$data['cc'];
			 			$cliente=$data['cliente'];
			 			$proyecto=$data['proyecto'];
			 			$monto=$data['monto'];
			 			$moneda=$data['moneda'];
			 			$fechIni=$data['fechIni'];
			 			$fechEntre=$data['fechEntre'];
			 			$termDay=$data['termDay'];
			 		}

			 		desconectar();
			 		conectar();

			 		$sql=sql::scc_ordSeguiCent($_GET['id']);
			 		$data_ordSeguiCent=negocio::getData($sql);

			 		desconectar();
			 		conectar();

			 		$sql=sql::scc_tipAdelSegui();
			 		$data_tipAdelSegui=negocio::getData($sql);

			 		desconectar();
			 		conectar();

			 		$sql=sql::scc_seguiOrdPlaz($_GET['id']);
			 		$data_seguiOrdPlaz=negocio::getData($sql);


			 	break;

		 	/*--------------------[*]--------------------------------------------------------------*/

		 	/*-------------------------------------------------------------------------------------*/
		 		# Controller Up Modulo Almacen
		 	/*-------------------------------------------------------------------------------------*/

			 	# [lp_] -> Linea de Productos

			 	case 'lp_lineProd':
		 			
			 		$sql=sql::lp_obteSubClasi();
			 		$dataSubClasi=negocio::getData($sql);

			 		desconectar();
			 		conectar();

			 		$sql=sql::lp_iniMone();
			 		$dataMone=negocio::getData($sql);

		 		break;

		 		# [kd_] -> Kardex

		 		case 'kd_geneKardx':

	 				$sql=sql::kd_correMov_obte($_GET['id']);
	 				$correMov=negocio::getVal($sql,'response');

	 				desconectar();
	 				conectar();

	 				$sql=sql::kd_tipMov_obte();
	 				$dataTipMov=negocio::getData($sql);

	 				desconectar();
	 				conectar();

	 				$sql=sql::lp_iniMone();
			 		$dataMone=negocio::getData($sql);

			 		desconectar();
			 		conectar();

			 		$sql=sql::kd_obteSubClasi();
			 		$dataSubClasi=negocio::getData($sql);

			 		//capturar nota de pedidos pendientes
			 		desconectar();
			 		conectar();
			 		$sql=sql::kd_notPend_cap(1);
			 		$dataNot=negocio::getData($sql);
	 			
	 			break;

	 			case 'kd_geneKardxs':

	 				$sql=sql::kd_correMov_obte($_GET['id']);
	 				$correMov=negocio::getVal($sql,'response');

	 				desconectar();
	 				conectar();

	 				$sql=sql::kd_tipMov_obte();
	 				$dataTipMov=negocio::getData($sql);

	 				desconectar();
	 				conectar();

	 				$sql=sql::lp_iniMone();
			 		$dataMone=negocio::getData($sql);

			 		desconectar();
			 		conectar();

			 		$sql=sql::kd_obteSubClasi();
			 		$dataSubClasi=negocio::getData($sql);

			 		//capturar nota de pedidos pendientes
			 		desconectar();
			 		conectar();
			 		$sql=sql::kd_notPend_cap(2);
			 		$dataNot=negocio::getData($sql);
	 			
	 			break;

	 			case 'kd_geneKardxi':

	 				$sql=sql::kd_correMov_obte($_GET['id']);
	 				$correMov=negocio::getVal($sql,'response');

	 				desconectar();
	 				conectar();

	 				$sql=sql::kd_tipMov_obte();
	 				$dataTipMov=negocio::getData($sql);

	 				desconectar();
	 				conectar();

	 				$sql=sql::lp_iniMone();
			 		$dataMone=negocio::getData($sql);

			 		desconectar();
			 		conectar();

			 		$sql=sql::kd_obteSubClasi();
			 		$dataSubClasi=negocio::getData($sql);

			 		//capturar nota de pedidos pendientes
			 		desconectar();
			 		conectar();
			 		$sql=sql::kd_notPend_cap(3);
			 		$dataNot=negocio::getData($sql);
	 			
	 			break;

	 			case 'kd_listKardx':

	 				$sql=sql::kd_histKardx(1);
	 				$dataHistKardx=negocio::getData($sql);

	 			break;

	 			case 'kd_repAlm':

					# code...
	 				$sql=sql::kd_obteSubClasi();
			 		$dataSubClasi=negocio::getData($sql);
			 		$subClasi="";

			 		foreach($dataSubClasi as $data)
			 		{
			 			$subClasi.="<option value='".$data['subClasiId']."' >".$data['subClasi']."</option>";
			 		}

			 		desconectar();
	 				conectar();

	 				$sql=sql::kd_tipMov_obte();
	 				$dataTipMov=negocio::getData($sql);
	 				$tipMov="";

	 				foreach ($dataTipMov as $data) 
	 				{
	 					$tipMov.="<option value=".$data['id'].">".$data['des']."</option>";
	 				}

				break;

				case 'kd_prevGuia':

					// CABECERA GUIA DE REMISION

					$sql=sql::kd_iniGenKardx($_GET['id']);
					$dataGenKardx=negocio::getData($sql);

					desconectar();
					conectar();

					foreach($dataGenKardx as $data)
					{
						$numMov=$data['kardxNro'];
						$tipMov=$data['tipMovDes'];
						$fechMov=$data['fechMov'];
						$numDoc=$data['tipDocDes']."-".$data['numDoc'];
						$emp=$data['empDes'];
						$ruc=$data['empRuc'];
						$des=$data['desti'];
						$trans=$data['transDes'];

						//factura
						$numFac=$data['numFac'];
						$facEmis=$data['facEmis'];

						//ubicacion
						$almcUbi=$data['almcUbi'];
					}

					// DETALLE DE GUIA DE REMISION

					$sql=sql::kd_detKardxid($_GET['id']);
					$dataDetKardx=negocio::getData($sql);
					$ind=1;
					$acum=1;

				break;

			/*-----------------------[*]----------------------------------------------------------*/

			/*------------------------------------------------------------------------------------*/
				# CONTROLLER UP NOTA DE PEDIDO
			/*------------------------------------------------------------------------------------*/

				case 'np_nuevNot':

					unset($_SESSION['detNot']);
					unset($_SESSION['puntNot']);

					//iniciar tipo de movimientos
					desconectar();
					conectar();
					$sql=sql::np_tipMov_cap();
					$dataTip=negocio::getData($sql);

					//iniciar destinatarios
					desconectar();
					conectar();
					$sql=sql::np_trabOpe_cap();
					$dataDesti=negocio::getData($sql);

				break;

				case 'np_listNot':

					//iniciar estado de nota de pedido
					$sql=sql::np_estaNot_cap();
					$dataEst=negocio::getData($sql);

					//iniciar tipo de movimientos
					desconectar();
					conectar();
					$sql=sql::np_tipMov_cap();
					$dataTip=negocio::getData($sql);

				break;

				case 'np_detNot':

					//obtener detalle de nota
					desconectar();
					conectar();
					$sql=sql::np_genNot_cap($_GET['id']);
					$dataNot=negocio::getData($sql);

					//iniciar data general de nota
					$cod=$dataNot[0]['cod'];
					$cliId=$dataNot[0]['cliId'];
					$cli=$dataNot[0]['cli'];
					$fech=$dataNot[0]['fech'];
					$fechConfir=$dataNot[0]['fechConfir'];
					$des=$dataNot[0]['des'];
					$ref=$dataNot[0]['ref'];
					$obs=$dataNot[0]['obs'];
					$estaId=$dataNot[0]['estaId'];
					$tipId=$dataNot[0]['tipMov'];
					$hourConfir=$dataNot[0]['hourConfir'];

					//iniciar estado de nota de pedido
					desconectar();
					conectar();
					$sql=sql::np_estaNot_cap();
					$dataEst=negocio::getData($sql);

					//iniciar tipo de movimientos
					desconectar();
					conectar();
					$sql=sql::np_tipMov_cap();
					$dataTip=negocio::getData($sql);

					//iniciar destinatarios
					desconectar();
					conectar();
					$sql=sql::np_trabOpe_cap();
					$dataDesti=negocio::getData($sql);

				break;

			/*-------------------[*]---------------------------------------------------------------*/


			/*-------------------------------------------------------------------------------------*/
				# CONTROLLER UP PROYECTO DE COTIZACION
			/*-------------------------------------------------------------------------------------*/

				case 'cot_proyeCot':

					//obtener responsables del area comercial
					$sql=sql::cot_respComer_listar();
					$dataResp=negocio::getData($sql);

					//obtener estados de cotizaciones
					desconectar();
					conectar();

					$sql=sql::cot_estaCot_listar();
					$dataEsta=negocio::getData($sql);

				break;

			/*------------------[*]-----------------------------------------------------------------*/

			/*---------------------------------------------------------------------------------------*/
				# CONTROLLER UP GESTION DOCUMENTARIA 
			/*---------------------------------------------------------------------------------------*/

				case 'gd_listGestAdmin':

					$sql=sql::gd_estaGest_cap();
					$dataEstaGest=negocio::getData($sql);

				break;

				case 'gd_fichGestAdmin':

					$sql=sql::gd_estaGest_cap();
					$dataEstaGest=negocio::getData($sql);

					$dataHora= gd_dataHourSimple();

				break;

				case 'gd_listGestUser':

					$sql=sql::gd_estaGest_cap();
					$dataEstaGest=negocio::getData($sql);

				break;

				case 'gd_fichGestUser':

					$sql=sql::gd_estaGest_cap();
					$dataEstaGest=negocio::getData($sql);

					$dataHora=gd_dataHourSimple();

				break;

				case 'gd_listRutAdmin':

					$sql=sql::gd_estaRut_cap();
					$dataEstaRut=negocio::getData($sql);

				break;

				case 'gd_listRutResp':

					$sql=sql::gd_estaRut_cap();
					$dataEstaRut=negocio::getData($sql);

				break;

				case 'gd_showRutAdmin':

					$dataHora= gd_dataHourSimple();

					$sql=sql::gd_respoRut_cap();
					$dataResp=negocio::getData($sql);

				break;

				case 'gd_fichRutAdmin':

					$dataHora= gd_dataHourSimple();

					$sql=sql::gd_respoRut_cap();
					$dataResp=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::gd_estaRut_cap();
					$dataEstaRut=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::gd_estaGest_cap();
					$dataEstaGest=negocio::getData($sql);

				break;

			/*--------------------[*]-----------------------------------------------------------------*/


			/*----------------------------------------------------------------------------------------*/
				# CONTROLLER UP NO CONFORMIDADES
			/*----------------------------------------------------------------------------------------*/

				case 'nc_noConform_frm':

					$sql=sql::nc_detec_obte();
					$dataDetec=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_procAfect_obte();
					$dataProc=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_tipObs_obte();
					$dataTipObs=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_tipNoConfor_obte();
					$dataTipConf=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_estaConfor_obte();
					$dataEstaConfor=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_ingAsig_obte();
					$dataIngAsig=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_obs_obte();
					$dataObs=negocio::getData($sql);

					# **New update 14/01/2015** - CLOSE

					desconectar();
					conectar();

					$sql=sql::nc_oriObs_obte();
					$dataOri=negocio::getData($sql);

				break;

				case 'nc_noConform_lst':

					$sql=sql::nc_estaConfor_obte();
					$dataEstaConfor=negocio::getData($sql);

					desconectar();
					conectar();

					$sql=sql::nc_obs_obte();
					$dataObs=negocio::getData($sql);

					# **New update 14/01/2015** - CLOSE

					desconectar();
					conectar();

					$sql=sql::nc_oriObs_obte();
					$dataOri=negocio::getData($sql);

				break;

			/*--------------------------------------[*]-----------------------------------------------*/

			/*----------------------------------------------------------------------------------------*/
				# CONTROLADOR UP CUMPLEAÑOS TRABAJADOR
			/*----------------------------------------------------------------------------------------*/

				case 'ct_lstTrab':

					$sql=sql::ct_trabEw_obte();
					$dataTrab=negocio::getData($sql);
					$ind=1;

				break;

			/*-----------------------------------------------------------------------------------------*/

			default:
			break;
		}
	}

?>