
<?php
ini_set('display_errors', 1);
session_start();
include('include/comun.php');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Dev</title>

<!--<base href="http://localhost/opencart/admin/" />-->
<link rel="stylesheet" type="text/css" href="styles/jquery-ui-1.8.9.custom.css" />
<link rel="stylesheet" type="text/css" href="<?=get_style($_SESSION['SIS'][5])?>" />

<!-- Icono del sitio -->
<link href='images/logo1.png' rel='shortcut icon' type='image/png'>

<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/sistema.js"></script>
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.bgiframe-2.1.2.js"></script>
<!--<script type="text/javascript" src="js/jquery.autocomplete.pack.js"></script>-->
<script type="text/javascript" src="js/superfish/js/superfish.js"></script>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>

<!--
<script type="text/javascript" >
	function zoom() 
	{
            document.body.style.transform = "scale(0.9)";
        }
</script>
-->

<?php 

require_once('FirePHPCore/FirePHP.class.php'); 
ob_start();

/*
	$firephp = FirePHP::getInstance(true);
   $var = array('i'=>10, 'j'=>20);
   $firephp->log($var, 'Iterators');
*/

?>

<body>
<form action="" name="form_login" method="post" target="_blank">
<input type="hidden" name="username" value="admin">
<input type="hidden" name="passwd" value="admin">    
<input type="hidden" name="password" value="admin">    
</form>
<div id="container">
<div id="header">
  <div class="div1">
    <div class="div2"><?=get_logo($_SESSION['SIS'][5])?></div>
        <div class="div3">
            Sistema de Gesti&oacute;n Empresarial .:. TEC-ERP v.1.0 </br>
		<?php
		if($_SESSION['SIS'][3]>0){
		?>
		 <img src="images/lock.png" alt="" style="position: relative; top: 3px;" />
		 &nbsp;Ha iniciado sesi&oacute;n como 
		 <span>
		 <?php echo strtoupper($_SESSION['SIS'][1]);?>
		 </span><br>
		 <b><?php echo $_SESSION['SIS'][6];?></b>
		 <b><?php print getPerfil($_SESSION['SIS'][3],'perfil_nombre');?></b>
		 <?php } ?>
		 
		 
		</div>
      </div>
    
    
<?php   
    menu_lista($_SESSION['SIS'][3]);	
?>

<script type="text/javascript">
		
		$(document).ready(function() {
			$('#menu > ul').superfish({
				hoverClass	 : 'sfHover',
				pathClass	 : 'overideThisToUse',
				delay		 : 0,
				animation	 : {height: 'show'},
				speed		 : 'normal',
				autoArrows   : false,
				dropShadows  : false, 
				disableHI	 : false, 
				onInit		 : function(){},
				onBeforeShow : function(){},
				onShow		 : function(){},
				onHide		 : function(){}
			});
			
			$('#menu > ul').css('display', 'block');
		});
		
		function getURLVar(urlVarName) {
			var urlHalves = String(document.location).toLowerCase().split('?');
			var urlVarValue = '';
			
			if (urlHalves[1]) {
				var urlVars = urlHalves[1].split('&');
		
				for (var i = 0; i <= (urlVars.length); i++) {
					if (urlVars[i]) {
						var urlVarPair = urlVars[i].split('=');
						
						if (urlVarPair[0] && urlVarPair[0] == urlVarName.toLowerCase()) {
							urlVarValue = urlVarPair[1];
						}
					}
				}
			}
			
			return urlVarValue;
		} 
		
		$(document).ready(function(){
			route = getURLVar('menu_id');	
			if (!route) {
		            $('#menu_6').addClass('selected');
			} else {
				part = route.split('/');
				
				url = part[0];
				
				if (part[1]) {
					url += '/' + part[1];
				}		
				$('a[href*=\'menu_id=' + url + '&\']').parents('li[id]').addClass('selected');
			}
		                
		        
		});
		
		setTimeout("Alertas(1,0)",1000);
		
		
</script>

</div>
  
<div id="content">  
	<?php   
	   menu_navegacion($_REQUEST['menu_id']);    
	   Pagina($_GET['menu'],$_SESSION['SIS'][3]);
	?>           
</div>


</div>

<div id="footer">ERP &copy; 2011 Todos los derechos reservados.<br />Version 1.0</div>

<!--<div id="fixed-bar">
<ul id="menu_pie"><li title="Ok">1</li><li>2</li></ul>
</div>-->

</body>

</html>