<?php

//Utilidades PHP

/*----------------------------------------------------------------------------*/
	// np_
/*----------------------------------------------------------------------------*/

	// enviar email con libreria PHPMAILER
	function np_enviEmail($msjTit,$msjSub,$msjAlt,$msjBod,$arrDesti)
	{
		$mail=new PHPMailer();

		$mail->IsSMTP();                           // telling the class to use SMTP
		$mail->Host       = "smtp.gmail.com";      // SMTP server
		#$mail->SMTPDebug  = 2;                    // enables SMTP debug information (for testing)
		   		                                   // 1 = errors and messages
		      	                                   // 2 = messages only
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "electrowerkeserver@gmail.com";  // GMAIL username
		$mail->Password   = "electro123";                    // GMAIL password
		
		$mail->SetFrom('jose.fernandez@electrowerke.com.pe', $msjTit);
		
		$mail->AddReplyTo("jose.fernandez@electrowerke.com.pe",$msjTit);
		
		$mail->Subject    = $msjSub;
		
		$mail->AltBody    = $msjAlt; // optional, comment out and test
		
		$mail->MsgHTML($msjBod);
		
		$mail->IsHTML(true);
	    $mail->CharSet = 'UTF-8';

	    $arrEmail=array();
	    $arrEmail=$arrDesti;

	    for($i=0;$i<count($arrEmail);$i++)
	    {
	    	$mail->AddAddress($arrEmail[$i],$arrEmail[$i]);
	    }

	    if(!$mail->Send()) 
	    {
		  #echo "Mailer Error: " . $mail->ErrorInfo;
		  $msj=6;
		} 
		else 
		{
		  #echo "Message sent!";
		  $msj=1;
		}

		return $msj;
	}

/*-------------------[*]------------------------------------------------------*/

/*----------------------------------------------------------------------------*/
	// gd_
/*----------------------------------------------------------------------------*/

	// obtener hora con data intervalo 1 hora
	function gd_getHourSimple($hourId)
	{
		$hourDes="";
		$dataHora=array(0=>array('hourId'=>'6:00:00',
							'hourDes'=>'6:00 am'),
						1=>array('hourId'=>'7:00:00',
								'hourDes'=>'7:00 am'),
						2=>array('hourId'=>'8:00:00',
								'hourDes'=>'8:00 am'),
						3=>array('hourId'=>'9:00:00',
								'hourDes'=>'9:00 am'),
						4=>array('hourId'=>'10:00:00',
								'hourDes'=>'10:00 am'),
						5=>array('hourId'=>'11:00:00',
								'hourDes'=>'11:00 am'),
						6=>array('hourId'=>'12:00:00',
								'hourDes'=>'12:00 am'),
						7=>array('hourId'=>'13:00:00',
								'hourDes'=>'1:00 pm'),
						8=>array('hourId'=>'14:00:00',
								'hourDes'=>'2:00 pm'),
						9=>array('hourId'=>'15:00:00',
								'hourDes'=>'3:00 pm'),
						10=>array('hourId'=>'16:00:00',
								'hourDes'=>'4:00 pm'),
						11=>array('hourId'=>'17:00:00',
								'hourDes'=>'5:00 pm'),
						12=>array('hourId'=>'18:00:00',
								'hourDes'=>'6:00 pm'),
						13=>array('hourId'=>'19:00:00',
								'hourDes'=>'7:00 pm'),
						);

		foreach ($dataHora as $data) 
		{
			# code...
			if($data['hourId']==$hourId)
			{
				$hourDes=$data['hourDes'];
			}
		}

		return $hourDes;
	}

	// data intervalo simple 1 hora
	function gd_dataHourSimple()
	{
		$dataHour=array(0=>array('hourId'=>'6:00:00',
						'hourDes'=>'6:00 am'),
				1=>array('hourId'=>'7:00:00',
						'hourDes'=>'7:00 am'),
				2=>array('hourId'=>'8:00:00',
						'hourDes'=>'8:00 am'),
				3=>array('hourId'=>'9:00:00',
						'hourDes'=>'9:00 am'),
				4=>array('hourId'=>'10:00:00',
						'hourDes'=>'10:00 am'),
				5=>array('hourId'=>'11:00:00',
						'hourDes'=>'11:00 am'),
				6=>array('hourId'=>'12:00:00',
						'hourDes'=>'12:00 am'),
				7=>array('hourId'=>'13:00:00',
						'hourDes'=>'1:00 pm'),
				8=>array('hourId'=>'14:00:00',
						'hourDes'=>'2:00 pm'),
				9=>array('hourId'=>'15:00:00',
						'hourDes'=>'3:00 pm'),
				10=>array('hourId'=>'16:00:00',
						'hourDes'=>'4:00 pm'),
				11=>array('hourId'=>'17:00:00',
						'hourDes'=>'5:00 pm'),
				12=>array('hourId'=>'18:00:00',
						'hourDes'=>'6:00 pm'),
				13=>array('hourId'=>'19:00:00',
						'hourDes'=>'7:00 pm'),
				);

		return $dataHour;
	}

	// data prioridad rango de dias
	function gd_dataPriori()
	{
		$dataPriori=array(0=>array('prioriDay'=>7,
									'prioriLim'=>999,
									'prioriDes'=>"<span class='gd_priBaj' >Baja</span>"),
						  1=>array('prioriDay'=>2,
						  			'prioriLim'=>7,
						  			'prioriDes'=>"<span class='gd_priMed' >Media</span>"),
						  2=>array('prioriDay'=>-999,
						  			'prioriLim'=>2,
						  			'prioriDes'=>"<span class='gd_priAlt' >Alta</span>"));

		return $dataPriori;
	}

	// obtener prioridad de dias 
	function gd_evaPriori($difDay,$dataPriori)
	{
		$prioriDes="";
		$prioPrev=0;

		foreach ($dataPriori as $data) 
		{
			if($difDay>=$data['prioriDay'] and $difDay<=$data['prioriLim'])
			{
				$prioriDes=$data['prioriDes'];
			}
		}

		return $prioriDes;
	}

/*----------------------------------[*]---------------------------------------*/

/*----------------------------------------------------------------------------*/
	// nc_
/*----------------------------------------------------------------------------*/
 
	// adjuntar archivo
	function nc_subirImagen($ficheroName,$ficheroTmp,$ficheroSize,$ficheroType,$raiz)
	{
		  if(is_uploaded_file($ficheroTmp)) 
		  { 
				// verifica haya sido cargado el archivo

				if(move_uploaded_file($ficheroTmp, "../adjuntos/".$raiz."/".$ficheroName)) 
				{ 
						// se coloca en su lugar final 
						//echo "<b>Upload exitoso!. Datos:</b><br>"; 
						//echo "Nombre: <i><a href=\"".$ficheroName."\">".$ficheroName."</a></i><br>"; 
						$ruta= "adjuntos/".$raiz."/".$ficheroName;
						//echo "Tipo MIME: <i>".$ficheroType."</i><br>"; 
						//echo "Peso: <i>".$ficheroSize." bytes</i><br>"; 
						//echo "<br><hr><br>"; 
				}
		  }
		  else
		  {
				$ruta=null;
		  }

		  return $ruta;
	}

/*----------------------------------------------------------------------------*/
	// cc_
/*----------------------------------------------------------------------------*/

	// obtener periodos actuales
	function cc_periActu_obte()
	{
		$dataAnu=Array();
		$anuIni=date('Y');
		$anuFin=$anuIni-10;

		for($i=0;$i<=10;$i++)
		{
			$dataAnu[$i]['anuId']=$anuIni-$i;
			$dataAnu[$i]['anuDes']=$anuIni-$i;
		}

		return $dataAnu;

	}

/*----------------------[*]---------------------------------------------------*/

?>