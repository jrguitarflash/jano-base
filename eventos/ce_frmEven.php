<!DOCTYPE HTML>
<html>
	<head>
		<title>Eventos</title>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >

	    <link rel="stylesheet" href="../libJquery/timerUi/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css" type="text/css" />
	    <link rel="stylesheet" href="../libJquery/timerUi/jquery.ui.timepicker.css?v=0.3.3" type="text/css" />

	    <script type="text/javascript" src="../libJquery/timerUi/include/jquery-1.9.0.min.js"></script>
	    <script type="text/javascript" src="../libJquery/timerUi/include/ui-1.10.0/jquery.ui.core.min.js"></script>
	    <script type="text/javascript" src="../libJquery/timerUi/include/ui-1.10.0/jquery.ui.widget.min.js"></script>
	    <script type="text/javascript" src="../libJquery/timerUi/include/ui-1.10.0/jquery.ui.tabs.min.js"></script>
	    <script type="text/javascript" src="../libJquery/timerUi/include/ui-1.10.0/jquery.ui.position.min.js"></script>

	    <script type="text/javascript" src="../libJquery/timerUi/jquery.ui.timepicker.js?v=0.3.3"></script>

	    <script type="text/javascript" src="../libJquery/timerUi/plusone.js"></script>

	    <script type="text/javascript" src="../libJquery/calendarUi/jquery-ui.js" ></script>

	    <script type="text/javascript">


              window.onload=function()
              {
                ce_json1();
                ce_oculNoti('success');
              }

              $(document).ready(function() 
              {
                  loadFormEvent();
                  loadCalendar('');
                  loadCalendar(2)
                  ce_iniAcci(document.getElementById('ce_tareEven').value,document.getElementById('ce_idEven').value);
              });

              function ce_enviCampVaca()
              {
                  if(document.getElementById('checkVali').checked)
                  {
                    document.getElementById('timepicker_disable').value="00:00:00";
                    document.getElementById('timepicker_disable2').value="00:00:00";
                    document.getElementById('desEven').value="Vacaciones";                    
                  }
                  else
                  {
                    document.getElementById('timepicker_disable').value="";
                    document.getElementById('timepicker_disable2').value="";
                    document.getElementById('desEven').value="";
                  }
              }

              function ce_evaCheckIni(val)
              {
                if(val==1)
                {
                  prop=true;
                }
                else
                {
                  prop=false;
                }
                return prop;
              }

              function ce_evaCheckVali(id)
              {
                insCheck=document.getElementById(id);
                if(insCheck.checked)
                {
                  val=1;
                }
                else
                {
                  val=0;
                } 
                return val;
              }

              function ce_iniAcci(tare,id)
              {
                  if(tare=='editEven')
                  {
                    document.getElementById('ce_add').style.display="none";
                    document.getElementById('ce_actu').style.display="block";
                    document.getElementById('ce_eli').style.display="block";
                    ce_json3(id);
                  }
                  else
                  {
                    document.getElementById('ce_add').style.display="block";
                    document.getElementById('ce_actu').style.display="none";
                    document.getElementById('ce_eli').style.display="none";
                  }
              }

              function loadCalendar(inst)
              {
            
        				$( "#datepicker"+inst ).datepicker({
        				showOn: "button",
        				buttonImage: "../images/calendar-green.gif",
        				buttonImageOnly: true,
        				dateFormat:'yy-m-d'
        				});

              }

               function ce_oculNoti(id)
               {
                  document.getElementById(id).style.display="none";
               }

               function ce_evaTare(tare)
               {
                  if(tare==1)
                  {
                    homework="ce_evenEw_agregar";
                  }
                  else if(tare==2)
                  {
                    homework="ce_evenxId_actualizar";
                  }
                  else if(tare==3)
                  {
                    homework="ce_evenxId_eliminar";
                  }
                  else
                  {
                    homework="Ninguna tarea asiganada";
                  }

                  return homework;
               }

               function ce_json4() //ce_evenxId_actualizar
               {
                  param="json=ce_evenxId_actualizar";
                  $.getJSON('../json/ce_json.php?'+param,{format: "json"}, function(data) 
                  {

                  });
               }

               function ce_json3(id) //ce_evenxId_traer
               {

                  param="json=ce_evenxId_traer";
                  param=param+"&evenId="+id;
                  $.getJSON('../json/ce_json.php?'+param,{format: "json"}, function(data) 
                  {
                      //alert("Loading...");
                      //document.getElementById('perEw').value=data[0]['perEw'];
                      //document.getElementById('perId').value=data[0]['perId'];
                      //document.getElementById('funcId').value=data[0]['funId'];
                      document.getElementById('datepicker').value=data[0]['fechIni'];
                      document.getElementById('datepicker2').value=data[0]['fechFin'];
                      document.getElementById('timepicker_disable').value=data[0]['hourIni'];
                      document.getElementById('timepicker_disable2').value=data[0]['hourFin'];
                      document.getElementById('desEven').value=data[0]['desEven'];
                      document.getElementById('checkVali').checked=ce_evaCheckIni(data[0]['checkVaca']);
                  });
               }

                function ce_json2(tare) //ce_evenEw_agregar | ce_evenxId_actualizar
                {

                    tare=ce_evaTare(tare);

                    valid=5;

                    if(document.getElementById('desEven').value!="")
                    {
                      valid--;
                    }

                    insInput=document.getElementsByTagName('input');
                    for(i=0;i<insInput.length;i++)
                    {
                        var node=insInput[i];
                        if (node.getAttribute('type') == 'text') 
                        {
                            // do something here with a <input type="text" .../>
                            // we alert its value here
                            if(node.value!="")
                            {
                              valid--;
                            }
                            else
                            {
                              valid;
                            }
                        }
                    }

                    console.log(valid);
                    

                    if(valid==0)
                    {
                    param="checkVali="+ce_evaCheckVali('checkVali');
                    param=param+"&evenId="+document.getElementById('ce_idEven').value;
                    param=param+"&persoEmpId=";//+document.getElementById('perId').value;
                    param=param+"&funAreId=";//+document.getElementById('funcId').value;
                    param=param+"&fechIni="+document.getElementById('datepicker').value;
                    param=param+"&fechFin="+document.getElementById('datepicker2').value;
                    param=param+"&horaEvenIni="+document.getElementById('timepicker_disable').value;
                    param=param+"&horaEvenFin="+document.getElementById('timepicker_disable2').value;
                    param=param+"&desEven="+document.getElementById('desEven').value;
                    param=param+"&json="+tare;
                    $.getJSON('../json/ce_json.php?'+param,{format: "json"}, function(data) 
                    {
                        if(data[0]==1)
                        {
                          alert(data[1]);
                        }
                        else if(data[0]==2)
                        {
                          alert(data[1]);
                        }
                        else
                        {
                          insInput=document.getElementsByTagName('input');
                          for(i=0;i<insInput.length;i++)
                          {
                              var node=insInput[i];
                              if (node.getAttribute('type') == 'text') 
                              {
                                  // do something here with a <input type="text" .../>
                                  // we alert its value here
                                  node.value="";
                              }
                          }
                          document.getElementById('desEven').value="";

                          //document.getElementById('')
                          document.getElementById('success').innerHTML='<img class="icon ic_s_success" alt="" title="" src="../images/success.png"></img>'+data[0];
                          document.getElementById('success').style.display="block";
                          setTimeout('ce_oculNoti("success")',2100);

                          setTimeout('window.close()',2100);
                          window.opener.refreshCalendar();
                        }

                    });
                    }
                    else
                    {
                      alert("Por favor llenar todos los campos del formulario para enviar su evento...!");
                    }
                }

                function ce_json1() //ce_perEw_listar
                {
                    availableTags2=[];

                    param="json=ce_perEw_listar";
                    $.getJSON('../json/ce_json.php?'+param,{format: "json"}, function(data) 
                    {
                      for(i=0;i<data.length;i++)
                      {
                        //console.log(data[i]['prod_nombre']);

                        //availableTags2[i]['key']=data[i]['producto_id'];
                        //availableTags2[i]['value']=data[i]['prod_nombre'];
                        
                        //availableTags2.add(data[i]['producto_id'],data[i]['prod_nombre']);
                        availableTags2.push({key:data[i]['perId'],func:data[i]['trabId'],value:data[i]['perEw']});

                        //availableTags2[i]['key']=data[i]['producto_id'];
                        //availableTags2[i]['value']=data[i]['prod_nombre'];

                      }

                        console.log(availableTags2);

                        /*
                          var availableTags = [
                          {key: "1",value: "NAME 1"},{key: "2",value: "NAME 2"},{key: "3",value: "NAME 3"},{key: "4",value: "NAME 4"},{key: "5",value: "NAME 5"}
                           ];
                        */

                        $( "#perEw" ).autocomplete(
                        {
                          //source: availableTags2

                            minLength: 0,
                            source: availableTags2,
                            focus: function( event, ui ) {
                              $( "#perEw" ).val( ui.item.value );
                              return false;
                            },
                            select: function( event, ui ) {
                              $( "#perEw" ).val( ui.item.value );
                              $( "#perId" ).val( ui.item.key );
                              $( "#funcId" ).val( ui.item.func );
                       
                              return false;
                            } 
                        });

                      });  
                }

                function testPopup()
                {
                  window.opener.testPopup();
                }

                function loadFormEvent()
                {

                    $('#timepicker_disable_inline').timepicker({
                    showNowButton: true,
                      showCloseButton: true,
                      showDeselectButton: true
                    });

                    $('#timepicker_disable_inline2').timepicker({
                      showNowButton: true,
                        showCloseButton: true,
                        showDeselectButton: true
                    });

                    $('#timepicker_disable').timepicker({
                      showLeadingZero: false,
                      showOn: 'both',
                        button: '.timepicker_disable_button_trigger'
                    });

                      $('#timepicker_disable2').timepicker({
                      showLeadingZero: false,
                      showOn: 'both',
                        button: '.timepicker_disable_button_trigger2'
                    });


                    $('#btn_disable_tp').click(function() {
                        $('#timepicker_disable_inline').timepicker('disable');
                        $('#timepicker_disable').timepicker('disable');
                    });
                    $('#btn_enable_tp').click(function() {
                        $('#timepicker_disable_inline').timepicker('enable');
                        $('#timepicker_disable').timepicker('enable');
                    });

                    $('#btn_disable_tp2').click(function() {
                        $('#timepicker_disable_inline2').timepicker('disable');
                        $('#timepicker_disable2').timepicker('disable');
                    });
                    $('#btn_enable_tp2').click(function() {
                        $('#timepicker_disable_inline2').timepicker('enable');
                        $('#timepicker_disable2').timepicker('enable');
                    });

                }



          </script>

          <style type="text/css">

          		#hour
          		{
          			width: 16px; 
          			height:16px; 
          			background: url(../libJquery/timerUi/include/ui-1.10.0/ui-lightness/images/ui-icons_222222_256x240.png) -80px, -96px;
  		            display: inline-block;
  		            border-radius: 2px; 
  		            border: 1px solid #222222; 
  		            margin-top: 3px; 
  		            cursor:pointer
          		}

              #hour2
              {
                width: 16px;
                height: 16px;
                background: url('../libJquery/timerUi/include/ui-1.10.0/ui-lightness/images/ui-icons_222222_256x240.png') repeat scroll -80px center, none repeat scroll -96px center transparent;
                display: inline-block;
                border-radius: 2px;
                border: 1px solid #222;
                margin-top: 3px;
                cursor: pointer;
              }

          		#contentEvent
          		{
          			background-color:none;
          			width:100%;
          			height:auto;
          			text-align: center;
          		}

          		#frmEvent
          		{
          			width:70%;
          			text-align: center;
          			/*background-color:#E3E3E3;*/
          			height:550px;
          			margin:0px auto 0px auto;
          			border-radius: 5px;
          			/*box-shadow:inset 0 3px 8px black;*/
                border:2px solid silver;
          		}

          		body
          		{
          			/*background: url('../images/eventCalendar.jpg');*/
          		}

          		label
          		{
          			float: left;
          			clear:left;
          			margin:20px;
          			margin-bottom:0px;
          			float: left; 
          			width:110px;
          			text-align: left;
          		}

          		input
          		{
          			float: left;
          		}

          		.in
          		{
          			float: left;
          			margin: 20px;
          		}

          		textarea
          		{
          			float: left;
          		}

          		h2
          		{
          			top:20px;
          			position: relative;
          		}

              div.success
              {
                margin: 0.5em 0px 1.3em;
                border: 1px solid;
                background-repeat: no-repeat;
                background-position: 10px 50%;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0px 1px 1px #FFF inset;
                color: #000;
                background-color: #EBF8A4;
                border-color: #A2D246;
                text-align: left;
                font-family: sans-serif;
              }

              #success
              {
                display: none;
              }

              .ce_decoAcci
              {
                font-weight: bold;
                border-radius: 5px;
                font-size: 9pt;
              }

          </style>

	</head>
	<body>
		<div id="contentEvent" >
			<div id="frmEvent">
          <input id="ce_idEven" type="hidden" value="<?php print $_GET['ce_evenId']; ?>" >
          <input id="ce_tareEven" type="hidden"  value="<?php print $_GET['ce_tare']; ?>" >
          <div class="success" id="success" >
            <img class="icon ic_s_success" alt="" title="" src="../images/success.png"></img>
          </div>
					<h2>PROGRAMACIÓN DE ACTIVIDADES</h2>
          <!--
  					<label>Personal:</label>
  					<input type="text" class="in" id="perEw">
            <input type="hidden" class="in" id="perId">
            <input type="hidden" class="in" id="funcId">
          -->
					<label>Fecha inicial:</label>
					<span class="in" >
						<input type="text" id="datepicker" value="<?php print $_GET['ce_fechIni']; ?>">
					</span>
					<label>Fecha Final:</label>
					<span class="in" >
						<input type="text" id="datepicker2" value="<?php print $_GET['ce_fechFin']; ?>" >
					</span>
					<label type="text" id="">Hora Inicial:</label>
					<span class="in" >
						<input type="text" style="width: 70px" id="timepicker_disable" />
						<div class="timepicker_disable_button_trigger" id="hour"></div>
					</span>
          <label type="text" id="">Hora Final:</label>
          <span class="in" >
            <input type="text" style="width: 70px" id="timepicker_disable2" />
            <div class="timepicker_disable_button_trigger2" id="hour2"></div>
          </span>
					<label>Descripcion:</label>
					<textarea class="in" id="desEven" ></textarea>
          <label>Vacaciones</label>
          <input type="checkbox" class="in" id="checkVali" onclick="ce_enviCampVaca();" >
          <label></label>
          <button class="in ce_decoAcci" id="ce_add" onclick="ce_json2('1');" >Añadir</button>
          <button class="in ce_decoAcci" id="ce_actu" onclick="ce_json2('2');">Actualizar</button>
          <button class="in ce_decoAcci" id="ce_eli" onclick="ce_json2('3');">Eliminar</button>
          <!--<a href="Javascript:testPopup();">test</a>-->
			</div>
		</div>
	</body>
</html>