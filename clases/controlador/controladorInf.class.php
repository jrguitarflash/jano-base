<?php #print "hello world controlador inferior"; ?>
<?php

	if( (isset($_GET['menu'])) and (isset($_POST['accion'])) ) 
	{
		switch($_GET['menu'])
		{
			/*-----------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR RECLAMOS
			/*----------------------------------------------------------------------------------------*/

				case 'reclamo_form':

					if($_POST['accion']=='enviar') 
					{
						ini_set('max_execution_time', 300);

						$sql=sql::getIdxCli($_POST['filCli']);
						$idCli=negocio::getVal($sql,'empresa_id');
						
						$sql=sql::getTipReclamoxId($_POST['tip']);
						$tip=negocio::getVal($sql,'desTipReclamo');
						
						$sql=sql::getContacxClixId($_POST['filCli'],$_POST['contac'][0]);
						$contac=negocio::getVal($sql,'contacto');
						
						$sql=sql::getTrabVendedorxId($_POST['respo']);
						$sr=negocio::getVal($sql,'vendedor');

						// RESPONSABLE 2

						$sql=sql::getTrabVendedorxId($_POST['respo2']);
						$sr2=negocio::getVal($sql,'vendedor');

						// EVALUAR CHECKBOX DE ENVIO
						$estaEnviArr=Array();
						$estaEnviArr[0]=0;
						$estaEnviArr[1]=0;


						for($i=0;$i<count($_POST['enviRespo']);$i++)
						{
							if($_POST['enviRespo'][$i]==1)
							{
								$estaEnviArr[$_POST['enviRespo'][$i]-1]=1;
							}
							else if($_POST['enviRespo'][$i]==2)
							{
								$estaEnviArr[$_POST['enviRespo'][$i]-1]=1;
							}
							else
							{
								$excep="Ningun estado de envio activo";
							}
						}

						// EVALUAR NOMBRES DE ENVIO

						if($estaEnviArr[0]==0)
						{
							$sr='';
						}

						if($estaEnviArr[1]==0)
						{
							$sr2='';
						}

						/*
						$valAdju=negocio::subirImagen($_FILES['adjunt']['name'],$_FILES['adjunt']['tmp_name'],$_FILES['adjunt']['size'],$_FILES['adjunt']['type']);
						$valAdju=$valAdju." ".negocio::subirImagen($_FILES['adjunt2']['name'],$_FILES['adjunt2']['tmp_name'],$_FILES['adjunt2']['size'],$_FILES['adjunt2']['type']);
						$valAdju=$valAdju." ".negocio::subirImagen($_FILES['adjunt3']['name'],$_FILES['adjunt3']['tmp_name'],$_FILES['adjunt3']['size'],$_FILES['adjunt3']['type']);
						*/

						$sql=sql::recla_adjuRut($_GET['id']);
						$valAdjuIni=negocio::getVal($sql,'adjuReclamo');
						$valAdju=$valAdjuIni;
						$valRut="";
						$valAdjuEmail="";

						if($_FILES['adjunt']['size'][0]>0)
						{

							for($i=0;$i<count($_FILES['adjunt']['name']);$i++)
							{
								if($i==0)
								{
									$valAdju=$valAdjuIni;
									$valRut=negocio::subirImagen($_FILES['adjunt']['name'][$i],$_FILES['adjunt']['tmp_name'][$i],$_FILES['adjunt']['size'][$i],$_FILES['adjunt']['type'][$i]);
									$valAdju=$valAdju.'|'.$valRut;
									$valAdjuEmail=$valAdjuEmail.'|'.$valRut;
								}
								else
								{
									$valRut=negocio::subirImagen($_FILES['adjunt']['name'][$i],$_FILES['adjunt']['tmp_name'][$i],$_FILES['adjunt']['size'][$i],$_FILES['adjunt']['type'][$i]);
									$valAdju=$valAdju.'|'.$valRut;
									$valAdjuEmail=$valAdjuEmail.'|'.$valRut;
								}

							}

						}

						$valAdjuArr=Array();
						$valAdjuArr=explode('|',$valAdjuEmail);
						
						$correPor=$_POST['emailRecep']." ".$_POST['emailRespo']." ".$_POST['emailRespo2'];
							
							#$acci=$_POST['acci']." ".strftime("%H:%M:%S", time())." ".date('d-m-Y');
							#$acci=$_POST['acci']." ".strftime("%I:%M:%S", time())." ".date('d-m-Y');
							#$acci=$_POST['acci']." ".date("h:i:s", time())." ".date('d-m-Y');
							#$acci=$_POST['acci']." ".date("g:i:s-a-d/m/Y");

						$acci=$_POST['acci'];
						$acci=negocio::reorAcci($acci);
						
						$sql=sql::insertRecla($_POST['tip'],
												$_POST['fech'],
												$_POST['contac'][0],
												$_SESSION['SIS'][2],
												$_POST['respo'],
												$_POST['respo2'],
												$estaEnviArr[0],
												$estaEnviArr[1],
												$_POST['desRecla'],
												$acci,
												$_POST['acciReli'],
												$valAdju,
												1,
												$idCli,
												$correPor,
												$_POST['recla_obs']);
						$filAfecIn=negocio::setData($sql);	
						
						$idConfir=negocio::getInsertId();

						// EVALUAR EMAIL ACTIVOS PARA USUARIO
						$emailArr=array("emailRespo","emailRespo2");

						for($i=0;$i<2;$i++)
						{
							if($estaEnviArr[$i]==0)
							{
								$_POST[$emailArr[$i]]='';
							}
						}

						// ENVIO EMAIL
						
						if(isset($_POST['recla_checkEmail']))
						{
							$respEmail=setEmail($_POST['desRecla'],
												$acci,$_POST['acciReli'],
												$idConfir,
												$tip,
												$_POST['fech'],
												$_POST['filCli'],
												$contac,
												$sr,
												$sr2,
												$_POST['emailRecep'],
												$_POST['emailRespo'],
												$_POST['emailRespo2'],
												$valAdjuArr);
						}
						else
						{
							$respEmail=0;
						}

						//$respEmail=0;

						// ACTUALIZAR RECLAMO

						$sql=sql::updateReclaxId($_POST['tip'],
												$_POST['fech'],
												$_POST['contac'][0],
												$_SESSION['SIS'][2],
												$_POST['respo'],
												$_POST['respo2'],
												$estaEnviArr[0],
												$estaEnviArr[1],
												$_POST['desRecla'],
												$acci,
												$_POST['acciReli'],
												$valAdju,
												$respEmail,
												$idCli,
												$idConfir,
												$correPor,
												$_POST['recla_obs']);
						
						$filAfecAct=negocio::setData($sql);
						
						$respEmail=negocio::veriEnvio($respEmail);
						$msjNoti=$filAfecIn." Reclamo añadido y ".$respEmail." al responsable asignado";
						
						print msjNotifi($msjNoti);
						
						#print "recep:".$_POST['emailRecep']." / resp:".$_POST['emailRespo'];
					}
					else if($_POST['accion']=='enviar2') 
					{
						print_r($_FILES['adjunt']['tmp_name']);
						print_r($_FILES['adjunt']['name']);
						print_r($_FILES['adjunt']['type']);
						print_r($_FILES['adjunt']['size']);
						$valAdju=negocio::subirImagen($_FILES['adjunt']['name'],$_FILES['adjunt']['tmp_name'],$_FILES['adjunt']['size'],$_FILES['adjunt']['type']);
					}
					else 
					{
						$excep= "email no enviado";
					}

				break;
				
				case 'reclamo_edit':
				
					if($_POST['accion']=='enviar') 
					{
						ini_set('max_execution_time', 300);

						$sql=sql::getIdxCli($_POST['filCli']);
						$idCli=negocio::getVal($sql,'empresa_id');

						$idConfir=negocio::getInsertId();

						$sql=sql::getTipReclamoxId($_POST['tip']);
						$tip=negocio::getVal($sql,'desTipReclamo');

						$sql=sql::getContacxClixId($_POST['filCli'],$_POST['contac'][0]);
						$contac=negocio::getVal($sql,'contacto');

						$sql=sql::getTrabVendedorxId($_POST['respo']);
						$sr=negocio::getVal($sql,'vendedor');

						// RESPONSABLE 2

						$sql=sql::getTrabVendedorxId($_POST['respo2']);
						$sr2=negocio::getVal($sql,'vendedor');


						// EVALUAR CHECKBOX DE ENVIO

						$estaEnviArr=Array();
						$estaEnviArr[0]=0;
						$estaEnviArr[1]=0;


						for($i=0;$i<count($_POST['enviRespo']);$i++)
						{
							if($_POST['enviRespo'][$i]==1)
							{
								$estaEnviArr[$_POST['enviRespo'][$i]-1]=1;
							}
							else if($_POST['enviRespo'][$i]==2)
							{
								$estaEnviArr[$_POST['enviRespo'][$i]-1]=1;
							}
							else
							{
								$excep="Ningun estado de envio activo";
							}
						}

						// EVALUAR NOMBRES DE ENVIO

						if($estaEnviArr[0]==0)
						{
							$sr='';
						}

						if($estaEnviArr[1]==0)
						{
							$sr2='';
						}


						/*
							$valAdju=negocio::subirImagen($_FILES['adjunt']['name'],$_FILES['adjunt']['tmp_name'],$_FILES['adjunt']['size'],$_FILES['adjunt']['type']);
							$valAdju2=negocio::subirImagen($_FILES['adjunt2']['name'],$_FILES['adjunt2']['tmp_name'],$_FILES['adjunt2']['size'],$_FILES['adjunt2']['type']);
							$valAdju3=negocio::subirImagen($_FILES['adjunt3']['name'],$_FILES['adjunt3']['tmp_name'],$_FILES['adjunt3']['size'],$_FILES['adjunt3']['type']);	
							$valAdju=negocio::veriSubiImg($valAdju,$_POST['rutaImgRecla']);
							$valAdju2=negocio::veriSubiImg($valAdju2,$_POST['rutaImgRecla2']);
							$valAdju3=negocio::veriSubiImg($valAdju3,$_POST['rutaImgRecla3']);
						*/

						$sql=sql::recla_adjuRut($_GET['id']);
						$valAdjuIni=negocio::getVal($sql,'adjuReclamo');
						$valAdju=$valAdjuIni;
						$valRut="";
						$valAdjuEmail="";

						if($_FILES['adjunt']['size'][0]>0)
						{

							for($i=0;$i<count($_FILES['adjunt']['name']);$i++)
							{
								if($i==0)
								{
									$valAdju=$valAdjuIni;
									$valRut=negocio::subirImagen($_FILES['adjunt']['name'][$i],$_FILES['adjunt']['tmp_name'][$i],$_FILES['adjunt']['size'][$i],$_FILES['adjunt']['type'][$i]);
									$valAdju=$valAdju.'|'.$valRut;
									$valAdjuEmail=$valAdjuEmail.'|'.$valRut;
								}
								else
								{
									$valRut=negocio::subirImagen($_FILES['adjunt']['name'][$i],$_FILES['adjunt']['tmp_name'][$i],$_FILES['adjunt']['size'][$i],$_FILES['adjunt']['type'][$i]);
									$valAdju=$valAdju.'|'.$valRut;
									$valAdjuEmail=$valAdjuEmail.'|'.$valRut;
								}

							}

						}

						# $valAdju=$valAdju.' '.$valAdju2.' '.$valAdju3;

						$correPor=$_POST['emailRecep']." ".$_POST['emailRespo']." ".$_POST['emailRespo2'];

						$valAdjuArr=Array();
						$valAdjuArr=explode('|',$valAdjuEmail);

						$acci=negocio::reorAcci2($_POST['acci'],$_POST['acci2']);

						// EVALUAR EMAIL ACTIVOS PARA USUARIO
						$emailArr=array("emailRespo","emailRespo2");

						for($i=0;$i<2;$i++)
						{
							if($estaEnviArr[$i]==0)
							{
								$_POST[$emailArr[$i]]='';
							}
						}

						// ENVIO DE EMAIL

						if(isset($_POST['recla_checkEmail']))
						{
						$respEmail=setEmail($_POST['desRecla'],
													$acci,
													$_POST['acciReli'],
													$_GET['id'],
													$tip,
													$_POST['fech'],
													$_POST['filCli'],
													$contac,
													$sr,
													$sr2,
													$_POST['emailRecep'],
													$_POST['emailRespo'],
													$_POST['emailRespo2'],
													$valAdjuArr);
						}
						else
						{
							$respEmail=0;
						}
						
						// ACTUALIZACION DE RECLAMO
						
						$sql=sql::updateReclaxId($_POST['tip'],
												$_POST['fech'],
												$_POST['contac'][0],
												$_SESSION['SIS'][2],
												$_POST['respo'],
												$_POST['respo2'],
												$estaEnviArr[0],
												$estaEnviArr[1],
												$_POST['desRecla'],
												$acci,
												$_POST['acciReli'],
												$valAdju,
												$respEmail,
												$idCli,
												$_GET['id'],
												$correPor,
												$_POST['recla_obs']);

						$filAfec=negocio::setData($sql);
						
						$respEmail=negocio::veriEnvio($respEmail);
						$msjNoti=$filAfec." Reclamo añadido y ".$respEmail." al responsable asignado";
						
						print msjNotifi($msjNoti);
						
						#print "recep:".$_POST['emailRecep']." / resp:".$_POST['emailRespo'];

					}
					else if($_POST['accion']=='enviar2') 
					{
						print $_FILES['adjunt']['name'];
					}
					else
					{
						$excep= "email no enviado";
					}
				
				break;
			
			/*------------------[*]--------------------------------------------------------------------*/

			/*-----------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR VISITAS
			/*-----------------------------------------------------------------------------------------*/

				case 'visita_reporte':

					if($_POST['accion']=='enviar' and $_GET['id']==0) 
					{
						$sql=sql::insertVisi($_SESSION['SIS'][10],
											$_POST['txtFechIni'],
											$_POST['txtFechFin']);
						$contVisi=negocio::setData($sql);
						
						$idVisi=negocio::getInsertId();

						// CORRELATIVO VISITAS
						$valCorreVisi="VI-".str_pad(1000+$idVisi,4,'0',STR_PAD_LEFT);

						// ASOCIAR VISITA A CENTRO DE COSTO
						$sql=sql::visi_asociCent($_POST['sltMone'],$valCorreVisi);
						$filAfect=negocio::getData($sql);
						
						// nuevo requerimiento solicitado de gastos
						
						$sql=sql::updateVisiGastos(
							$idVisi,$_POST['sltMone'],
							$_POST['txtPasa'],$_POST['txtHospe'],
							$_POST['txtAli'],
							$_POST['txtTrans'],
							$valCorreVisi
							);
							
						$contGast=negocio::setData($sql);
						
						$arrayVisi=sizeof($_SESSION['detVisiFin']);
						$contVisi=0;
						
					  // ------ AddDetalle Pasajes Arrays -----------------

					   	$detPasMontArr=explode("|",$_POST['detPasMont'][0]);
					   	$indMont=0;

					  //----------------------[*]-------------------------//
						
						for($i=1;$i<=$arrayVisi;$i++) 
						{
							$sql=sql::getIdxCli($_SESSION['detVisiFin'][$i]['empresa']);
							$idCli=negocio::getVal($sql,'empresa_id');						
							
							$sql=sql::insertDetVisi(
									$idVisi,$_SESSION['detVisiFin'][$i]['contacto'],
									$_SESSION['detVisiFin'][$i]['observacion'],
									$idCli,$_SESSION['detVisiFin'][$i]['observacionPen'],
									$_SESSION['detVisiFin'][$i]['direccion'],
									$_SESSION['detVisiFin'][$i]['dirOrig'],
									$_SESSION['detVisiFin'][$i]['fechVisi'],
									$detPasMontArr[$indMont++]
									);
									
							$contVisi=$contVisi+negocio::setData($sql);
						}
					
						$msjNoti=$contVisi." visitas añadidas correctamente";
						print msjNotifi($msjNoti);
						
						#$arrayDetVisi=sizeof($_SESSION['detVisiFin']);
						#print_r($_SESSION['detVisiFin']);
						unset($_SESSION['detVisiFin']);
						
						$sql=sql::getTrabVendedorxId($_SESSION['SIS'][10]);
						$valTrab=negocio::getVal($sql,'vendedor');

					   // ------ AddDetalle Pasajes Arrays -----------------

						   #$detPasDesArr=explode("|",$_POST['detPasDes'][0]);
						   #$detPasMontArr=explode("|",$_POST['detPasMont'][0]);

						   /*
						   $firephp = FirePHP::getInstance(true);
						   $firephp->log($detPasDesArr, 'arr1');
						   $firephp->log($detPasMontArr, 'arr2');
						   */

						   /*
						   for($i=0;$i<count($detPasDesArr);$i++)
						   {
						   		$sql=sql::insertDetPasaj($idVisi,$detPasDesArr[$i],$detPasMontArr[$i]);
						   		$valDetPasj=negocio::setData($sql);
						   }
						   */

					   //----------------------[*]-------------------------//

						
						
						print "<script type='text/javascript'>
									setReporVisi(".$idVisi.",'".$_POST['txtFechIni']."','".$_POST['txtFechFin']."','".$valTrab."');
								</script>";						
					}
					else if($_POST['accion']=='enviar' and $_GET['id']>0)
					{
						//print "accion editar visitar";

						$sql=sql::vi_visiGen_actu($_POST['txtFechIni'],
											$_POST['txtFechFin'],
											$_POST['sltMone'],
											$_POST['txtPasa'],
											$_POST['txtHospe'],
											$_POST['txtAli'],
											$_POST['txtTrans'],
											$_GET['id']);

						$visiAfect=negocio::getVal($sql,'response');

						//detalle monto pasaje
						$detPasMontArr=explode("|",$_POST['detPasMont'][0]);
						$indMont=0;

						//detalle de visitas
						desconectar();
						conectar();

						$sql=sql::vi_visixId_ini($_GET['id']);
						$dataVisi=negocio::getData($sql);

						foreach($dataVisi as $data)
						{

							//actualizacion detalle gasto
							desconectar();
							conectar();

							$sql=sql::vi_detGast_actu($data['idDet'],$detPasMontArr[$indMont]);
							$detAfect=negocio::getVal($sql,'response');
							$indMont++;
						}

						//mensaje de notificacion
						$msjNoti=$visiAfect." visitas añadidas correctamente";
						print msjNotifi($msjNoti);

						//obtener vendedor
						desconectar();
						conectar();

						$sql=sql::getTrabVendedorxId($_SESSION['SIS'][10]);
						$valTrab=negocio::getVal($sql,'vendedor');

						print "<script type='text/javascript'>

									setReporVisi(".$_GET['id'].",
												'".$_POST['txtFechIni']."',
												'".$_POST['txtFechFin']."',
												'".$valTrab."');

								</script>";	
					}
					else 
					{
						$excep= 'visitas no añadidas';
					}

				break;

			/*-------------------[*]--------------------------------------------------------------------*/

			/*------------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR CUENTAS
			/*-----------------------------------------------------------------------------------------*/
			
				case 'cuentax_form':
						
						if($_POST['accion']=='enviar') 
						{
							
							$sql=sql::getIdxCli($_POST['filCli']);
							$idCli=negocio::getVal($sql,'empresa_id');							
								
							$sql=sql::insertCuxCobra($idCli,$_POST['txtCompro'],$_POST['slcMone'],$_POST['slcDoc'],$_POST['txtImpor'],$_POST['txaDes'],$_POST['txtFechCu']);
							$cueAfect=negocio::setData($sql);
							
							$idCuen=negocio::getInsertId();
							
							$arrayCuen=sizeof($_SESSION['detCuenFin']);
							$cuenDetAfect=0;
						
						
							for($i=1;$i<=$arrayCuen;$i++) 
							{						
								
								$sql=sql::insertDetCuen($idCuen,$_SESSION['detCuenFin'][$i]['fecha'],$_SESSION['detCuenFin'][$i]['monto'],$_SESSION['detCuenFin'][$i]['cuenta'],$_SESSION['detCuenFin'][$i]['estado']);
								$cuenDetAfect=$cuenDetAfect+negocio::setData($sql);
							}
						
							unset($_SESSION['detCuenFin']);
							
							$cueAfect=$cueAfect." cuenta por cobrar añadida correctamente";
							print msjNotifi($cueAfect);
						}
						else 
						{
							$excep= 'cuenta no añadidas';
						}					
						
				break;
				
				case 'cuentax_edit':
				
						if($_POST['accion']=='enviar') 
						{
							
							$sql=sql::getIdxCli($_POST['filCli']);
							$idCli=negocio::getVal($sql,'empresa_id');							
								
							$sql=sql::updateCuxCobra($idCli,$_POST['txtCompro'],$_POST['slcMone'],$_POST['slcDoc'],$_POST['txtImpor'],$_POST['txaDes'],$_POST['txtFechCu'],$_GET['idCu']);
							$cueAfect=negocio::setData($sql);
							
							$cueAfect=$cueAfect." cuenta por cobrar editada correctamente";
							print msjNotifi($cueAfect);
										
						}
						else 
						{
							$excep= 'cuenta no editadas';
						}		
				
				break;

			/*-------------------[*]--------------------------------------------------------------------*/

			/*-------------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR OBSERVACION
			/*------------------------------------------------------------------------------------------*/
			
				case 'obsr_form':
						if($_POST['accion']=='enviar') 
						{
							$sql=sql::getIdxCli($_POST['filCli']);	
							$idEmp=negocio::getVal($sql,'empresa_id');		
							
							$sql=sql::insertObs(
										1,
										$_POST['slcResp'],
										$_POST['rdImpSati'],
										$_POST['rdEfecSati'],
										$_POST['rdAc'],
										$_SESSION['SIS'][2],
										$idEmp,
										$_POST['contac'][0],
										$_POST['slcNumFormat'],
										$_POST['slcVerFormat'],
										$_POST['slcPagFormat'],
										$_POST['txtFechContro'],
										$_POST['txaEviCorre'],
										$_POST['txtFechLi'],
										$_POST['txtFechVeriImp'],
										$_POST['txtFechAcor'],
										$_POST['txtFechVeriEfec'],
										$_POST['txtFecEfecSatis'],
										$_POST['txaEviObje'],
										$_POST['txtFechNoConf'],
										$_POST['txtFechSegAud'],
										$_POST['txaDesObs']);
										
							$obsAfect=negocio::setData($sql);
							$idInsert=negocio::getInsertId();
							
							$idGene="CA-".str_pad($idInsert,5,'0',STR_PAD_LEFT);
							
							$sql=sql::updateObs($idInsert,$idGene);
							$obsActAfect=negocio::setData($sql);
										
							$obsAfect=$obsAfect." formato de control añadido correctamente";
							print msjNotifi($obsAfect);						
							
							/*$firephp = FirePHP::getInstance(true);
						   $firephp->log($idGene, 'id');*/

						}
						else 
						{
							$excep= 'cuenta no añadidas';
						}
				break;
				
				case 'obsr_edit':
				
						if($_POST['accion']=='enviar') 
						{
							$sql=sql::getIdxCli($_POST['filCli']);	
							$idEmp=negocio::getVal($sql,'empresa_id');		
							
							$sql=sql::updateObsReclaxId(
										$_GET['id'],
										1,
										$_POST['slcResp'],
										$_POST['rdImpSati'],
										$_POST['rdEfecSati'],
										$_POST['rdAc'],
										$_SESSION['SIS'][2],
										$idEmp,
										$_POST['contac'][0],
										$_POST['slcNumFormat'],
										$_POST['slcVerFormat'],
										$_POST['slcPagFormat'],
										$_POST['txtFechContro'],
										$_POST['txaEviCorre'],
										$_POST['txtFechLi'],
										$_POST['txtFechVeriImp'],
										$_POST['txtFechAcor'],
										$_POST['txtFechVeriEfec'],
										$_POST['txtFecEfecSatis'],
										$_POST['txaEviObje'],
										$_POST['txtFechNoConf'],
										$_POST['txtFechSegAud'],
										$_POST['txaDesObs']);
										
							$obsAfect=negocio::setData($sql);
							
							$obsAfect=$obsAfect." formato de control actualizado correctamente";
							print msjNotifi($obsAfect);
						}
						else 
						{
							$excep= 'cuenta no editadas';
						}		
				
				break;
				
				case 'obsq_form':
				
						if($_POST['accion']=='enviar') 
						{
							$sql=sql::getIdxCli($_POST['filCli']);	
							$idEmp=negocio::getVal($sql,'empresa_id');
							
							$sql=sql::insertObsQue(
													  2,
													  $_POST['slcResp'],
													  $_SESSION['SIS'][2],
													  $idEmp,
													  $_POST['contac'][0],
													  $_POST['txtFechContro'],
													  $_POST['txaDesObs'],
													  $_POST['txaSoluInme']
												  );
														  
							$QueAfec=negocio::setData($sql);
							$idInsert=negocio::getInsertId();
							
							$idGene="QUE-".str_pad($idInsert,5,'0',STR_PAD_LEFT);
							
							$sql=sql::updateObs($idInsert,$idGene);
							$QueAfec=negocio::setData($sql);
							
							$QueAfec=$QueAfec." Queja añadida correctamente";
							print msjNotifi($QueAfec);
						}
						else 
						{
							$excep= 'reclamo no editado';
						}
					
				break;
				
				case 'obsq_edit':
				
						if($_POST['accion']=='enviar') 
						{
							
							$sql=sql::getIdxCli($_POST['filCli']);	
							$idEmp=negocio::getVal($sql,'empresa_id');
							
							$sql=sql::updateObsQue(
														  $_GET['id'],
														  2,
														  $_POST['slcResp'],
														  $_SESSION['SIS'][2],
														  $idEmp,
														  $_POST['contac'][0],
														  $_POST['txtFechContro'],
														  $_POST['txaDesObs'],
														  $_POST['txaSoluInme']);
														  
							$QueAfec=negocio::setData($sql);
							
							$QueAfec=$QueAfec." Queja editada correctamente";
							print msjNotifi($QueAfec);
							
						}
						else 
						{
							$excep= 'queja no editada';
						}		
				
				break;

			/*-----------------------[*]-----------------------------------------------------------------*/

			/*------------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR VACACIONES
			/*------------------------------------------------------------------------------------------*/

				case 'vaca_asig':

						if($_POST['accion']=='enviar')
						{

							$numFinSem=negocio::evaFolCal($_POST['diHabil'],$_POST['txtFechGozIni'],$_POST['txtFechGozFin']);

							$sql=sql::vaca_asigVaca($_POST['txtFechGozIni'],$_POST['txtFechGozFin'],$_POST['slcTrab'],$_SESSION['SIS'][2],strftime( "%Y/%m/%d", time()),$_POST['slcPeri'],$_POST['slcAre'],$numFinSem);
							$numFilAfec1=negocio::setData($sql);

							/*
								$idInserAsig=negocio::getInsertId();

								$sql=sql::vaca_periAsig($idInserAsig);
								$valPeriAsig=negocio::getVal($sql,'periAsig');

								$sql=sql::vaca_getPeriId($valPeriAsig);
								$valIdPeri=negocio::getVal($sql,'idPeriAn');
							*/

							/*
								$firephp = FirePHP::getInstance(true);
								$firephp->log($sql, 'valor:');
							*/

							/*
								$sql=sql::vaca_setPeriVaca($idInserAsig,$valIdPeri);
								$numFilAfec2=negocio::setData($sql);
							*/

							$sql=sql::vaca_actForCalNu($_POST['diHabil'],$_POST['slcTrab'],$_POST['slcPeri']);
							$numFilAfec2=negocio::setData($sql);

							# adaptacion de forma de calculo por si cambia

							$sql=sql::vaca_extVacPerxTrab($_POST['slcTrab'],$_POST['slcPeri']);
							$dataVac=negocio::getData($sql);

							foreach ($dataVac as $data) 
							{

								$numFinSem=negocio::evaFolCal($_POST['diHabil'],$data['vaca_mesGocIni'],$data['vaca_mesGocFin']);

								$sql=sql::vaca_actForCal($_POST['diHabil'],$_POST['slcTrab'],$_POST['slcPeri'],$data['vaca_vaca_id'],$numFinSem);
								$numFilAfec1=negocio::setData($sql);
							}

							$noti=$numFilAfec1.' '.'Vacación Asignada correctamente';
							$msjNoti=msjNotifi($noti);
							print $msjNoti;
						}
						else if($_POST['accion']=='enviar2')
						{

							$sql=sql::vaca_extVacPerxTrab($_POST['slcTrab'],$_POST['slcPeri']);
							$dataVac=negocio::getData($sql);

							foreach ($dataVac as $data) 
							{

								$numFinSem=negocio::evaFolCal($_POST['diHabil'],$data['vaca_mesGocIni'],$data['vaca_mesGocFin']);

								$sql=sql::vaca_actForCal($_POST['diHabil'],$_POST['slcTrab'],$_POST['slcPeri'],$data['vaca_vaca_id'],$numFinSem);
								$numFilAfec1=negocio::setData($sql);
							}

							$sql=sql::vaca_veriExiAsig($_POST['slcPeri'],$_POST['slcTrab']);
							$valContVaca=negocio::getVal($sql,'contVaca');

							$noti=negocio::evaExisVacaAsig($numFilAfec1,$valContVaca);
							$msjNoti=msjNotifi($noti);

							print $msjNoti;
						}
						else
						{
							$excep='vacacion no asignada';
						}
				break;

				case 'vaca_apPer':

						if($_POST['accion']=='enviar')
						{
							$sql=sql::vaca_getPeriAnxTod();
							$dataPerTot=negocio::getData($sql);

							$valUltPer=$dataPerTot[count($dataPerTot)-1]['vaca_desPeri'];
							#print $valUltPer;

							$dataUltPer=Array();
							$dataUltPer=explode("-",$valUltPer);

							#print $dataUltPer[0];
							#print $dataUltPer[1];

							$anIni=$dataUltPer[0]+1;
							$desPer=($dataUltPer[0]+1).'-'.($dataUltPer[1]+1);
							$sql=sql::vaca_inserPerNu($anIni,$desPer);
							$filAfect=negocio::setData($sql);

							$msj=$filAfect.' '.'Periodo generado correctamente';
							$notifi=negocio::msjNotifi($msj);
							print $notifi;

						}
						else if($_POST['accion']=='enviar2')
						{
							$sql=sql::vaca_inacTodPer();
							$filAfect=negocio::setData($sql);
							$filCont=0;

							for($i=0;$i<count($_POST['chkEstPer']);$i++)
							{
								$sql=sql::vaca_actPerxId($_POST['chkEstPer'][$i]);
								$filAfec=negocio::setData($sql);
								$filCont=$filCont+$filAfec;
							}

							$msj=$filCont.' '.'Periodo activandos correctamente';
							$notifi=negocio::msjNotifi($msj);
							print $notifi;
						}
						else
						{
							$exep="No se efectuo accion en periodos";
						}

				break;

			/*------------------------[*]----------------------------------------------------------------*/

			/*-------------------------------------------------------------------------------------------*/ 
				# CONTROLADORES INFERIOR PARA LA VISTA DE CENTRO DE COSTOS
			/*-------------------------------------------------------------------------------------------*/

				case 'cc_cosPro':
					
						if($_POST['accion']=='enviar')
						{


							/* CAPTURAMOS ID DE PROYECTO Y ID DE FL */
							$sql=sql::cc_idProyexNom($_POST['txaProye']);
							$idProye=negocio::getVal($sql,'proyecto_id');

							$sql=sql::cc_idFlxNom($_POST['cotiFl']);
							$idFl=negocio::getVal($sql,'cotizacion_id');

							/* GENERAMOS COMPRA SIN CORRELATIVO */
							$sql=sql::cc_geneComp($_POST['txtProveId2'],$idProye,$_SESSION['SIS'][2],$_POST['txtMone2'],$idFl,$_POST['ocFechCli'],1);
							$filAfect=negocio::setData($sql);

							/* GENERAMOS CORRELATIVO */
							$idFilAfect=negocio::getInsertId();
							$sql=sql::cc_prefiDoc(5);
							$prefiDoc=negocio::getVal($sql,'docu_tipo_prefijo');
							$idCorreComp=$prefiDoc.'-'.str_pad($idFilAfect,4,'0',STR_PAD_LEFT).'-1';
							$sql=sql::cc_geneCorreComp($idFilAfect,$idCorreComp);
							$filAfect2=negocio::setData($sql);

							/* INICIAMOS SESSION DE DETALLE ORDEN */
							
							$arrDetOrd=Array();
							$arrDetOrd=$_SESSION['arrCotiFl'];
							unset($_SESSION['arrCotiFl']);

							for($i=0;$i<count($arrDetOrd);$i++)
							{
								$sql=sql::cc_geneDetComp(
														$idFilAfect,
														$arrDetOrd[$i]['producto_id'],
														$arrDetOrd[$i]['cant'],
														$arrDetOrd[$i]['preUni'],
														$_POST['txtMone2'],
														$arrDetOrd[$i]['pro_descripcion']
														);
								$filAfect3=negocio::setData($sql);
							}

							/* GENERAR MATCH CENTRO DE COSTO */
							$sql=sql::cc_geneCentCost($idFl,$idFilAfect);
							$filAfect4=negocio::setData($sql);

							/* GENERAR CORRELATIVO CENTRO DE COSTO */
							$idFilAfect=negocio::getInsertId();
							$idCorreCost='PC-'.str_pad($idFilAfect,4,'0',STR_PAD_LEFT);
							$sql=sql::cc_correCentCost($idFilAfect,$idCorreCost);
							$filAfect5=negocio::setData($sql);	
							

							$notifi=$filAfect." Orden de compra nacional generada correctamente..!";
							print negocio::msjNotifi($notifi);
							
						}
						else if($_POST['accion']=='enviar2')
						{

							/* CAPTURAMOS ID DE PROYECTO Y ID DE FL */
							$sql=sql::cc_idProyexNom($_POST['txaProye']);
							$idProye=negocio::getVal($sql,'proyecto_id');

							$sql=sql::cc_idFlxNom($_POST['cotiFl']);
							$idFl=negocio::getVal($sql,'cotizacion_id');

							/* GENERAMOS COMPRA SIN CORRELATIVO */
							$sql=sql::cc_geneComp($_POST['txtProveId2'],$idProye,$_SESSION['SIS'][2],$_POST['txtMone2'],$idFl,$_POST['ocFechCli'],2);
							$filAfect=negocio::setData($sql);

							/* GENERAMOS CORRELATIVO */
							$idFilAfect=negocio::getInsertId();
							$sql=sql::cc_prefiDoc(3);
							$prefiDoc=negocio::getVal($sql,'docu_tipo_prefijo');
							$idCorreComp=$prefiDoc.'-'.str_pad($idFilAfect,4,'0',STR_PAD_LEFT).'-1';
							$sql=sql::cc_geneCorreComp($idFilAfect,$idCorreComp);
							$filAfect2=negocio::setData($sql);

							/* INICIAMOS SESSION DE DETALLE ORDEN */
							
							$arrDetOrd=Array();
							$arrDetOrd=$_SESSION['arrCotiFl'];
							unset($_SESSION['arrCotiFl']);

							for($i=0;$i<count($arrDetOrd);$i++)
							{
								$sql=sql::cc_geneDetComp(
														$idFilAfect,
														$arrDetOrd[$i]['producto_id'],
														$arrDetOrd[$i]['cant'],
														$arrDetOrd[$i]['preUni'],
														$_POST['txtMone2'],
														$arrDetOrd[$i]['pro_descripcion']
														);
								$filAfect3=negocio::setData($sql);
							}

							/* GENERAR MATCH CENTRO DE COSTO */
							$sql=sql::cc_geneCentCost($idFl,$idFilAfect);
							$filAfect4=negocio::setData($sql);

							/* GENERAR CORRELATIVO CENTRO DE COSTO */
							$idFilAfect=negocio::getInsertId();
							$idCorreCost='PC-'.str_pad($idFilAfect,4,'0',STR_PAD_LEFT);
							$sql=sql::cc_correCentCost($idFilAfect,$idCorreCost);
							$filAfect5=negocio::setData($sql);						
							

							$notifi=$filAfect." Orden de compra internacional generada correctamente..!";
							print negocio::msjNotifi($notifi);

						}
						else if($_POST['accion']=='enviar3')
						{

							/* INICIAR FL MULTIPLE */
							$flMulti="";

							for($i=0;$i<count($_POST['cc_flMulti']);$i++)
							{
								if($i==0)
								{
									$flMulti=$_POST['cc_flMulti'][$i];
								}
								else
								{
									$flMulti=$flMulti."|".$_POST['cc_flMulti'][$i];
								}
							}

							/* CAPTURAMOS ID DE PROYECTO,ID DE FL Y ID CLIENTE */
							$sql=sql::cc_idProyexNom($_POST['txaProye2']);
							$idProye=negocio::getVal($sql,'proyecto_id');

							$sql=sql::cc_idFlxNom($_POST['cotiFl']);
							$idFl=negocio::getVal($sql,'cotizacion_id');

							$sql=sql::cc_idClixNom($_POST['txaCli2']);
							$idCli=negocio::getVal($sql,'idCli');

							/* OBTENER RUTA DE IMAGEN A ADJUNTAR */
							$rutImg='';
							for($i=0;$i<count($_FILES['adjOrdCli']['name']);$i++)
							{
								if($i==0)
								{
									$rutImg=negocio::subirImagen($_FILES['adjOrdCli']['name'][$i],$_FILES['adjOrdCli']['tmp_name'][$i],$_FILES['adjOrdCli']['size'][$i],$_FILES['adjOrdCli']['type'][$i]);
								}
								else
								{
									$rutImg=$rutImg.' '.negocio::subirImagen($_FILES['adjOrdCli']['name'][$i],$_FILES['adjOrdCli']['tmp_name'][$i],$_FILES['adjOrdCli']['size'][$i],$_FILES['adjOrdCli']['type'][$i]);
								}
							}

							/* GENERAR MATCH CENTRO DE COSTO */
							$sql=sql::cc_geneCentCost($idProye,$idFl,$flMulti,$idCli,$_POST['txtOcCli'],$_POST['ocFechCli'],$_POST['totCoti'],$_POST['txtMone2'],$rutImg);
							$filAfect=negocio::setData($sql);

							/* GENERAR CORRELATIVO CENTRO DE COSTO */
							$idFilAfect=negocio::getInsertId();
							$idCorreCost='PC-'.str_pad($idFilAfect,4,'0',STR_PAD_LEFT);
							$sql=sql::cc_correCentCost($idFilAfect,$idCorreCost);
							$filAfect2=negocio::setData($sql);

							/* INICIAMOS SESSION DE DETALLE ORDEN */
							
							$arrDetOrd=Array();
							$arrDetOrd=$_SESSION['arrCotiFl'];
							unset($_SESSION['arrCotiFl']);
							$contOrd=0;

							for($i=0;$i<count($arrDetOrd);$i++)
							{
								$sql=sql::cc_geneDetCentCost(
														$idFilAfect,
														2,
														$arrDetOrd[$i]['tipDoc'],
														$arrDetOrd[$i]['proveId'],
														$arrDetOrd[$i]['moneId'],
														$arrDetOrd[$i]['plazo'],
														$arrDetOrd[$i]['desOrd']
														);
								$filAfect3=negocio::setData($sql);

								/* GENERAR OC/EW/OS DE CENTRO DE COSTO */

								$idFilAfect3=negocio::getInsertId();
								$sql=sql::cc_getDetCentCostxId($idFilAfect3);
								$dataDetCent=negocio::getData($sql);

								if($dataDetCent[0]['tipDoc']==1 or $dataDetCent[0]['tipDoc']==2)
								{
									/* GENERAMOS COMPRA SIN CORRELATIVO SI TIPO ES 1 O 2 */
									$sql=sql::cc_geneComp(
															$dataDetCent[0]['provId'],
															$dataDetCent[0]['proyeId'],
															$_SESSION['SIS'][2],
															$dataDetCent[0]['moneId'],
															$dataDetCent[0]['pcId'],
															$dataDetCent[0]['ocFechCli'],
															$dataDetCent[0]['tipDoc']
														);
									$filAfect4=negocio::setData($sql);
									$idFilAfect4=negocio::getInsertId();
								}
								else
								{
									/* GENERAMOS ORDEN SERVICIO SIN CORRELATIVO SI TIPO ES 3 */
									$sql=sql::os_geneOrdServ(
																$_SESSION['SIS'][2],
																$dataDetCent[0]['pcId'],
																2
															);
									$filAfect4=negocio::setData($sql);
									$idFilAfect4=negocio::getInsertId();

									# Flujo para obtener fs y enviarla al os
									
										/* obtener fs a partir de fl */
											#$sql=sql::os_getFsxFl($_POST['cotiFl']);
											#$valFsId=negocio::getVal($sql,'fsId');

										/* obtener datos generales de fs */
											#$sql=sql::os_getDatGenFs($valFsId);
											#$dataGenFs=negocio::getData($sql);

										/* obtener detalle de fs */
											#$sql=sql::os_getDetFs($_POST['cotiFl']);
											#$dataDetFs=negocio::getData($sql);

										/* obtener condiciones de fs */
											#$sql=sql::os_getCondFs($valFsId);
											#$dataCondFs=negocio::getData($sql);

										/* enviar datos generales de fs a os */

										#foreach($dataGenFs as $data)

											#{
												/*
													$sql=sql::os_actuGenFs($data['fech'],
																			$data['cli'],
																			$data['respComer'],
																			$data['mone'],
																			$data['des'],
																			$data['priori'],
																			$data['esta'],
																			$idFilAfect4);
													$filAfect5=negocio::setData($sql);
												*/

												$sql=sql::os_actuGenFsBlan('',
																			$idFilAfect4);
												$filAfect5=negocio::setData($sql);

											/* actualizar datos generales de os en cc  */
												#$sql=sql::os_actuOrdCread($data['cli'],$data['mone'],$idFilAfect);
												#$filAfect11=negocio::setData($sql);

												
												/*
													$firephp = FirePHP::getInstance(true);
												    $firephp->log($sql, 'sql');
											    */
											    
											#}

										/* enviar detalle de fs a os */

											/*
											foreach($dataDetFs as $data)
											{
												$sql=sql::os_setDetFs($data['pro_descripcion'],
																	$data['cs_tipDetServId'],
																	$data['cs_unid'],
																	$data['pro_cantidad'],
																	$data['pro_precio_venta'],
																	$data['pro_subtotal'],
																	$idFilAfect4);
												$filAfect6=negocio::setData($sql);
											}
											*/


										/* enviar condiciones de fs a os */
											/*
											if(count($dataCondFs)>0)
											{
												foreach($dataCondFs as $data)
												{
													$sql=sql::os_setCondiFs($data['requi'],
																		$data['tiemEje'],
																		$data['garan'],
																		$data['condi'],
																		$data['tiemVali'],
																		$idFilAfect4);
													$filAfect7=negocio::setData($sql);
												}
											}
											else
											{*/
												$sql=sql::os_setCondiFs('',
																		'',
																		'',
																		'',
																		'',
																		$idFilAfect4);
												$filAfect7=negocio::setData($sql);
											#}

								}

								/* GENERAMOS CORRELATIVO */

									#$idFilAfect4=negocio::getInsertId();
									$valPrefi=negocio::evaPrefiTip($dataDetCent[0]['tipDoc']);
									$sql=sql::cc_prefiDoc($valPrefi);
									$prefiDoc=negocio::getVal($sql,'docu_tipo_prefijo');
									$idCorreComp=$prefiDoc.'-'.str_pad($idFilAfect4,4,'0',STR_PAD_LEFT).'-1';

								if($dataDetCent[0]['tipDoc']==1 or $dataDetCent[0]['tipDoc']==2)
								{
									/* GENERAMOS CORRELATIVO DE COMPRA */
									$sql=sql::cc_geneCorreComp($idFilAfect4,$idCorreComp,$_POST['txaCli2']);
									$filAfect8=negocio::setData($sql);
								}
								else
								{
									/* GENERAMOS CORRELATIVO DE ORDEN */
									$sql=sql::os_geneCorreOrdServ($idFilAfect4,$idCorreComp);
									$filAfect9=negocio::setData($sql);
								}

								/* ACTUALIZAR ESTADO DE ORDENES */
								$sql=sql::cc_actEstOrde($idFilAfect3,$idCorreComp);
								$filAfect10=negocio::setData($sql);

								$contOrd++;

							}

							/*
							$firephp = FirePHP::getInstance(true);
						    $firephp->log($arrayOrd, 'id');
						    */

							$notifi=$filAfect." Centro de costo generado correctamente..!";
							print negocio::msjNotifi($notifi);


							/**********************************************************/
					 			# MODULO FINANZAS & CENTRO DE COSTO - CONTROLADOR SUP
					 		/**********************************************************/

							$centReal=$idFilAfect;
							$centTemp=$_POST['finan_centTemp'];

							$sql=sql::finan_opeTemReal_grab($centTemp,$centReal);
							$filAfect11=negocio::getVal($sql,'response');

							//---------------------------o--------------------------------

							/* DIRECCIONAR AL CENTRO DE COSTO CREADO */
							print "<script type='text/javascript' >cc_direNuevCent('".$idFilAfect."');</script>";
						}
						else
						{
							$exep="No se efectuo accion en costo del proyecto";
						}

				break;

				case 'cc_cosCread':

					if($_POST['accion']=='enviar4')
					{

							/* CONTADOR ORDENES A GENERAR */
							$contOrd=0;

							/* RECORRER ARRAY DE ORDENES CON CHECK */

							for($i=0;$i<count($_POST['noGeneOrd']);$i++)
							{
								$sql=sql::cc_getDetCentCostxId($_POST['noGeneOrd'][$i]);
								$dataDetCent=negocio::getData($sql);

								/* GENERAMOS COMPRA SIN CORRELATIVO */
								$sql=sql::cc_geneComp(
														$dataDetCent[0]['provId'],
														$dataDetCent[0]['proyeId'],
														$_SESSION['SIS'][2],
														$dataDetCent[0]['moneId'],
														$dataDetCent[0]['flId'],
														$dataDetCent[0]['ocFechCli'],
														$dataDetCent[0]['tipDoc']
													);
								$filAfect=negocio::setData($sql);

								/* GENERAMOS CORRELATIVO */
								$idFilAfect=negocio::getInsertId();
								$valPrefi=negocio::evaPrefiTip($dataDetCent[0]['tipDoc']);
								$sql=sql::cc_prefiDoc($valPrefi);
								$prefiDoc=negocio::getVal($sql,'docu_tipo_prefijo');
								$idCorreComp=$prefiDoc.'-'.str_pad($idFilAfect,4,'0',STR_PAD_LEFT).'-1';
								$sql=sql::cc_geneCorreComp($idFilAfect,$idCorreComp);
								$filAfect2=negocio::setData($sql);

								/* ACTUALIZAR ESTADO DE ORDENES */
								$sql=sql::cc_actEstOrde($_POST['noGeneOrd'][$i],$idCorreComp);
								$filAfect3=negocio::setData($sql);

								$contOrd++;

							}

								$notifi=$contOrd." Ordenes de Compras generadas correctamente..!";
								print negocio::msjNotifi($notifi);

					}
					else if($_POST['accion']=='enviar5')
					{
						/* INHABILITAR TODOS LOS CENTROS DE COSTOS  */
						$sql=sql::cc_inabCentCost();
						$filAfect=negocio::setData($sql);

						/* HABILITAR LOS CENTROS DE COSTOS SELECCIONADOS */
						$contFilAfect2=0;
						for($i=0;$i<count($_POST['estProye']);$i++)
						{
							$sql=sql::cc_habCentCost($_POST['estProye'][$i]);
							$filAfect2=negocio::setData($sql);
							$contFilAfect2=$contFilAfect2+$filAfect2;
						}

							$notifi=$contFilAfect2." Centros de costos actualizados correctamente..!";
							print negocio::msjNotifi($notifi);
					}
					else
					{
						$exep="No se genero ninguna orden compra";
					}

				break;

				case 'cc_asigPro':

					if($_POST['accion']=='enviar6')
					{

						$sql=sql::cc_adjuAgre($_GET['idCen']);
						$valAdju=negocio::getVal($sql,'cc_fileAdju');

						$firephp = FirePHP::getInstance(true);
						$firephp->log($valAdju, 'valor:');

						/* OBTENER RUTA DE IMAGEN A ADJUNTAR */
						$rutImg=$valAdju;
						for($i=0;$i<count($_FILES['adjOrdCli']['name']);$i++)
						{
							if($rutImg=='')
							{
								$rutImg=negocio::subirImagen($_FILES['adjOrdCli']['name'][$i],$_FILES['adjOrdCli']['tmp_name'][$i],$_FILES['adjOrdCli']['size'][$i],$_FILES['adjOrdCli']['type'][$i]);
							}
							else
							{
								$rutImg=$rutImg.' '.negocio::subirImagen($_FILES['adjOrdCli']['name'][$i],$_FILES['adjOrdCli']['tmp_name'][$i],$_FILES['adjOrdCli']['size'][$i],$_FILES['adjOrdCli']['type'][$i]);
							}
						}

						$sql=sql::cc_actuCentCost($_GET['idCen'],$_POST['txtOcCli'],$_POST['ocFechCli'],$_POST['totCoti'],$_POST['txtMone2'],$rutImg);
						$filAfect=negocio::setData($sql);

						$notifi=$filAfect." Centros de costos guardado correctamente..!";
						print negocio::msjNotifi($notifi);

					}
					else if($_POST['accion']=='enviar7')
					{
						$sql=sql::cc_closeProye($_GET['idCen']);
						$filAfect=negocio::setData($sql);

						$notifi=$filAfect." Proyecto cerrado correctamente..!";
						print negocio::msjNotifi($notifi);

					}
					else
					{
						$exep="No se guardo ningun centro de costo";
					}

				break;

			/*---------------------------[*]---------------------------------------------------------------*/

			/* ------------------------------------------------------------------------------------------ */
		 		# CONTROLADOR INFERIOR DEL MODULO DE MOVIMIENTO DE PERSONAL
		 	/* ----------------------------------------------------------------------------------------- */

				case 'mp_movPer':

					if($_POST['accion']=='enviar1')
					{

						$sql=sql::mp_areTrabxId($_SESSION['SIS'][2]);
						$dataTrab=negocio::getData($sql);

						$userId=$dataTrab[0]['trabId'];
						$areId=$dataTrab[0]['areId'];

						$sql=sql::mp_movPer($userId,$areId,$_POST['mp_fechSali'],$_POST['mp_fechRetor'],$_POST['mp_hourSali'],$_POST['mp_hourRetor'],$_POST['mp_centCostId']);
						$filAfect1=negocio::setData($sql);
						$idFilAfect=negocio::getInsertId();

						$arrDetMov=Array();
						$arrDetMov=$_SESSION['arrMovPer'];
						unset($_SESSION['arrMovPer']);

						for($i=0;$i<count($arrDetMov);$i++)
						{
							$sql=sql::mp_detMovPer($idFilAfect,$arrDetMov[$i]['motiv'],$arrDetMov[$i]['ubi'],$arrDetMov[$i]['det']);
							$filAfect2=negocio::setData($sql);
						}

						$notifi=$filAfect1." Movimiento creado correctamente..!";
						print negocio::msjNotifi($notifi);
					}
					else
					{
						$excep="No se guardo ningun movimiento de personal";
					}

				break;

			/*----------------------------[*]------------------------------------------------------------*/

			/*-------------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR DEL MODULO COTIZACION DE SERVICIOS
			/*------------------------------------------------------------------------------------------*/

				case 'cs_genCot':

					if($_POST['accion']=='enviar1')
					{
						$param=Array();

						$param['cs_fechCoti']=$_POST['cs_fechCot'];
						$param['cs_cliId']=$_POST['cs_empId'];
						$param['cs_respComerId']=$_POST['cs_respComer'];
						$param['cs_desServ']=$_POST['cs_desServ'];
						$param['cs_priorId']=$_POST['cs_priorCot'];
						$param['cs_estServId']=$_POST['cs_estServ'];
						$param['cs_moneId']=$_POST['cs_moneId'];
						$param['cs_respoTecniId']=$_SESSION['SIS'][2];

						$sql=sql::cs_geneCotiServ(1,$param);
						$filAfect1=negocio::setData($sql);
						$filAfectId1=negocio::getInsertId();

						$correCorServ='FS'.'-'.str_pad($filAfectId1,4,'0',STR_PAD_LEFT);

						$param=Array();

						$param['cs_correServ']=$correCorServ;
						$param['cs_cotiServId']=$filAfectId1;

						$sql=sql::cs_geneCotiServ(2,$param);
						$filAfect2=negocio::setData($sql);

						$sql=sql::cs_geneCotiServ(3,$param);
						$filAfect3=negocio::setData($sql);

						$notifi=$filAfect1." Cotizacion creada correctamente...!";
						print negocio::msjNotifi($notifi);

						$url="index.php?menu_id=133&menu=cs_espeCot";
						$param="&id=".$filAfectId1;
						print "<script type='text/javascript' >
									cs_direGen('".$url."','".$param."')
								</script>";
					}
					else
					{
						$excep="No se genero la cotizacion de servicio";
					}

				break;

			/*----------------------------[*]------------------------------------------------------------*/

			/* ---------------------------------------------------------------------------------------- */
				# CONTROLADOR SEGUIMIENTO DE CENTRO DE COSTO [scc_controInf] 
			/* ---------------------------------------------------------------------------------------- */

				case 'scc_creadSegui':

					if($_POST['accion']=='scc_geneSegui')
					{
						$sql=sql::scc_valiGeneSegui($_POST['accionId']);
						$filAfect2=negocio::getVal($sql,'response');

						desconectar();
						conectar();

						if($filAfect2==0)
						{
							$sql=sql::scc_geneSegui($_POST['accionId']);
							$filAfect1=negocio::getVal($sql,'response');
							print $filAfect1;
						}
						else
						{
							$msj="<div class=success>El Centro de costo ya tiene generado un seguimiento...!</div>";
							print $msj;
						}

						/*
							$firephp = FirePHP::getInstance(true);
							$firephp->log('hi', 'id');
						*/
					}
					else if($_POST['accion']=='scc_eliSegui')
					{
						$sql=sql::scc_eliSegui($_POST['accionId']);
						$filAfect1=negocio::getVal($sql,'response');
						print $filAfect1;
					}
					else
					{
						$excep="No se genero seguimiento de centro de costos";
					}

				break;

			/*-----------------------------[*]-----------------------------------------------------------*/

			/*------------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR NOTA DE PEDIDO
			/*-------------------------------------------------------------------------------------------*/

				case 'np_nuevNot':

					if($_POST['accion']=='np_geneNot')
					{
						#code
						$sql=sql::np_notPed_crear($_SESSION['SIS'][2],
					 							$_POST['np_cliId'],
					 							$_POST['np_fech'],
					 							$_POST['np_obs'],
					 							$_POST['np_des'],
					 							$_POST['np_ref'],
					 							$_POST['np_tipMov'],
					 							$_POST['np_fechConfir'],
					 							$_POST['np_hourConfir']);
						 $filAfect1=negocio::getVal($sql,'response');

						 //print $filAfect1;

						 #enviar nota de pedido
						 $msjTit="Nota de Pedido";
						 $msjSub="email de prueba";
						 $msjAlt="email de prueba";
						 $msjBod="email de prueba";
						 $arrDesti=array();
						 $arrDesti=$_POST['np_emailDesti'];

						 # detalle de nota de pedido
						 desconectar();
						 conectar();
						 $sql=sql::np_genNot_cap($filAfect1);
						 $dataGen=negocio::getData($sql);

						 $msjBod="<p>La Nota de Pedido Generada tiene la siguiente informacion:</p>";
						 $msjBod.="<strong>N° Nota:&nbsp;</strong>".$dataGen[0]['cod']."<br>";
						 $msjBod.="<strong>Empresa:&nbsp;</strong>".$dataGen[0]['cli']."<br>";
						 $msjBod.="<strong>Fecha creacion:&nbsp;</strong>".$dataGen[0]['fech']."<br>";
						 $msjBod.="<strong>Fecha Atencion:&nbsp;</strong>".$dataGen[0]['fechConfir']."<br>";
						 $msjBod.="<strong>Hora Atencion:&bnsp;</strong>".$dataGen[0]['hourConfir']."<br>";
						 $msjBod.="<strong>Descripcion:&nbsp;</strong>".$dataGen[0]['des']."<br>";
						 $msjBod.="<strong>Referencia:&nbsp;</strong>".$dataGen[0]['ref']."<br>";
						 $msjBod.="<strong>Observacion:&nbsp;</strong>".$dataGen[0]['obs']."<br>";
						 $msjBod.="<strong>Estado:&nbsp;</strong>".$dataGen[0]['estaDes']."<br>";
						 $msjBod.="<strong>Tipo:&nbsp;</strong>".$dataGen[0]['desTip'];

						 /*
						 $firephp = FirePHP::getInstance(true);
						 $firephp->log($dataGen, 'valor:');
						 */

						 $enviEmail=np_enviEmail($msjTit,$msjSub,$msjAlt,$msjBod,$arrDesti);


						 if($filAfect1>0)
						 {

						 	isset($_SESSION['detNot']) ? $detNot=$_SESSION['detNot'] : $detNot=array();

						 	foreach($detNot as $detNot)
						 	{
						 		desconectar();
						 		conectar();

						 		$sql=sql::np_detNot_ingre($filAfect1,
						 								$detNot['idLine'],
						 								$detNot['cant']);

						    	$filAfect2=negocio::getVal($sql,'response');
						 	}

						 	unset($_SESSION['detNot']);
						 	unset($_SESSION['puntNot']);

						 	print "<div class='success' >Nota de pedido generado correctamente...!</div>";
						 }
						 else
						 {
						 	print "<div class='success' >Nota de pedido no generada...!</div>";
						 }

					}
					else
					{
						$excep="No se genero nota de pedido";
					}

				break;

				case 'np_listNot':

				break;

				case 'np_detNot':

					if($_POST['accion']=='np_actuNot')
					{
						$sql=sql::np_notPed_actu($_POST['np_cliId'],
												$_POST['np_fech'],
												$_POST['np_obs'],
												$_POST['np_des'],
												$_POST['np_ref'],
												$_POST['np_estaNot'],
												$_GET['id'],
												$_POST['np_tipMov'],
												$_POST['np_fechConfir'],
												$_POST['np_hourConfir']);

						$filAfect1=negocio::getVal($sql,'response');

						#enviar nota de pedido
						 $msjTit="Nota de Pedido";
						 $msjSub="email de prueba";
						 $msjAlt="email de prueba";
						 $msjBod="email de prueba";
						 $arrDesti=array();
						 $arrDesti=$_POST['np_emailDesti'];

						 # detalle de nota de pedido
						 desconectar();
						 conectar();
						 $sql=sql::np_genNot_cap($_GET['id']);
						 $dataGen=negocio::getData($sql);

						 $msjBod="<p>La Nota de Pedido Generada tiene la siguiente informacion:</p>";
						 $msjBod.="<strong>N° Nota:&nbsp;</strong>".$dataGen[0]['cod']."<br>";
						 $msjBod.="<strong>Empresa:&nbsp;</strong>".$dataGen[0]['cli']."<br>";
						 $msjBod.="<strong>Fecha:&nbsp;</strong>".$dataGen[0]['fech']."<br>";
						 $msjBod.="<strong>Fecha Atencion:&nbsp;</strong>".$dataGen[0]['fechConfir']."<br>";
						 $msjBod.="<strong>Hora Atencion:&nbsp;</strong>".$dataGen[0]['hourConfir']."<br>";
						 $msjBod.="<strong>Descripcion:&nbsp;</strong>".$dataGen[0]['des']."<br>";
						 $msjBod.="<strong>Referencia:&nbsp;</strong>".$dataGen[0]['ref']."<br>";
						 $msjBod.="<strong>Observacion:&nbsp;</strong>".$dataGen[0]['obs']."<br>";
						 $msjBod.="<strong>Estado:&nbsp;</strong>".$dataGen[0]['estaDes']."<br>";
						 $msjBod.="<strong>Tipo:&nbsp;</strong>".$dataGen[0]['desTip'];

						 /*
						 $firephp = FirePHP::getInstance(true);
						 $firephp->log($dataGen, 'valor:');
						 */

						 $enviEmail=np_enviEmail($msjTit,$msjSub,$msjAlt,$msjBod,$arrDesti);

						if($filAfect1>0)
						{
							print "<div class='success' >Nota de pedido actualizado correctamente...!</div>";
						}
						else
						{
						 	print "<div class='success' >Nota de pedido no actualiza...!</div>";
						}
					}
					else
					{
						$excep="No se genero nota de pedido";
					}

				break;

			/*-------------------------------[*]----------------------------------------------------------*/


			/*--------------------------------------------------------------------------------------------*/
				# CONTROLADOR INFERIOR NO CONFORMIDADES
			/*--------------------------------------------------------------------------------------------*/

				case 'jano_ctrl':


				break;

			/*-----------------------------------[*]------------------------------------------------------*/

			/*
				case 'reporte_xcobrar':
				break;

				case 'factura_cance':
			 	break;
		 	*/
			
			default:
			break;
		}
	}

?>