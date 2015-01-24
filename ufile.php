<?
include("config.php");

function valida_tipo($file='',$archivo=''){
    switch(substr($file,-3)){
        case "php":
	case ".js":
	case "tml":
	case "htm":
	case "sql":
	case "inc":
        case "doc":
        case "xls":
        case "sql":
        case "pdf":
        case "gif":
        case "png":
        case "bmp":
        case "jpg":
        case "txt":
        case "css":
            return '<a href="abrir_file.php?nombre='.$file.'&file='.$archivo.'">'.$file.'</a>';
            break;
        default:
            return $file;
            break;
    }
}

$result=mysql_query("SELECT ope_pass FROM operadores WHERE ope_tipo_id='1' LIMIT 1");




if($result){
	$row=mysql_fetch_array($result);
	/* Now we free up the result and continue on with our script */
	mysql_free_result($result);
}

if($row[0]==$_POST[clave]){
	$path=$_POST[ruta];
	if($path) {
		for($x=1;$x<4;$x++){
			$subio=false;
		    	if(is_uploaded_file($_FILES['archivo'.$x]['tmp_name'])){
			      copy($_FILES['archivo'.$x]['tmp_name'],$path."\\".$_FILES['archivo'.$x]['name']);
		      	$subio = true;
		    	}
			if($subio){
		    		$obs.= "$x.- El archivo ".$_FILES['archivo'.$x]['name']." subio con exito<br>";
			} else {
		    		$obs.=($_FILES['archivo'.$x]['name']>'')? "El archivo ".$_FILES['archivo'.$x]['name']." no cumple con las reglas establecidas<br>":'';
			}
		}
	}
}else{

	$obs="<font color='red'><b>Contrase�a Incorrecta</b></font>";
}

?>
<form method="POST" enctype="multipart/form-data" name="form1">
<table align="center" width="70%">
<tr>
<td>
<fieldset>
<legend>Subir Archivos</legend>
<table style="margin:10px">
<tr>
<td width="10%">&nbsp;</td>
<td>Clave</td><td><input type="password" name="clave" id="clave" size="10" value="<?=$_POST['clave']?>"></td> 
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td>Ruta</td><td><select name="ruta" id="ruta" onChange="document.form1.submit()" >
<?

$path=getcwd();
if (!isset($path))
		$path=".";
		$dir_handle = opendir($path) or die("Unable to open $path");
		echo "<option value=''></option>";
                $sel=($path==$_POST['ruta'])?"selected":"";
		echo "<option value='$path' ".$sel.">$path</option>";
		while ($file = readdir($dir_handle)) {
			
			if ($file != "." && $file != "..") { 
				if (is_dir($path."\\".$file)) { 
					$ruta=$path."\\".$file;
                                        $sel=($ruta==$_POST['ruta'])?"selected":"";
					echo "<option value='$ruta' ".$sel.">$ruta</option>";
				}
			}
		}
		closedir($dir_handle)?>
		</select></td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td>Archivo 1</td><td><input name="archivo1" size="60" type="file" id="archivo1" value=""></td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td>Archivo 2</td><td><input name="archivo2" size="60" type="file" id="archivo2" value=""></td>
</tr>
<tr>
<td width="10%">&nbsp;</td>
<td>Archivo 3</td><td><input name="archivo3" size="60" type="file" id="archivo3" value=""></td>
</tr>
<tr>
<td colspan="3" style="width:100%;height:100px;border:solid 1px;"><b>Observacion:</b><br><?=$obs?></td>
</tr>
<tr>
<td colspan="3" align="center">
<input name="boton" type="submit" id="boton" value="Enviar">
<input type="button" value="Cerrar" onClick="window.close();">
</td>
</tr>
</table>
</fieldset>

</td>
</tr>
</table>
<?
if(($row[0]==$_POST['clave'])&&($_POST['ruta'])){


	  $path = $_POST['ruta'];

    // Abrir la carpeta
    $dir_handle = @opendir($path) or die("No se puede abrir $path");
	
echo '<table width="70%" align="center"><tr><td><fieldset><legend>'.$path.'</legend>';

    // Leer los archivos
	$dir=array();
	echo '<table style="margin:10px" cellpading="0" cellspacing="0" border="1" width="90%" align="center"><tr align="center"><td>nombre</td><td>Tamaño</td><td>tipo</td><td>Fecha</td></tr>';
    while ($file = readdir($dir_handle)) {

    if($file == "." || $file == ".." || $file == "index.php" )
	
        continue;
        $archivo=$path.chr(92).$file;
	echo '<tr><td>'.valida_tipo($file,$archivo).'</td><td>'.filesize($archivo).'</td><td align="center">'.filetype($archivo).'</td><td>'.date("d F Y H:i:s",filemtime($archivo)).'</td></tr>';
    }

    // Cerrar
    closedir($dir_handle);
echo '</table></fieldset></td></tr></table>';
}

?> 
</form>