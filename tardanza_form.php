<?php
include "include/comun.php";
//if($_POST['Submit']){
//if (move_uploaded_file($_FILES['file']['tmp_name'],'data/data.csv')) {    
//    $fp = fopen ( "data/data.csv" , "r" ); 
//    while (( $data = fgetcsv ( $fp , 1000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...
//        $i = 0; 
//        foreach($data as $row) {
//    
//        //$data[0]= codigo
//        //$data[5]= total
//        $sql="select trab_tardanza('I','".$data[0]."','".$_POST['ano_id']."','".$_POST['mes_id']."','".$data[5]."')";
//        //mysql_query($sql);
//        echo $sql."<br>";
//        }
//   
//    } 
//    fclose ( $fp );
//} else {
//    echo "Error, no se pudo cargar el archivo.";
//}
//                
//}
?>
<div class="ContentF">
<table width="100%" class="form">  
  <tr>
    <td width="25%">A&ntilde;o</td>
    <td><select name="ano_id" id="ano_id"><?=periodo_ddl(date("Y"),1,0);?></select>    </td>
  </tr>
  <tr>
    <td>Mes</td>
    <td><label>
      <select name="mes_id" id="mes_id"><?=mes_ddl(date("m"))?></select>
    </label></td>
  </tr>
  <tr>
    <td>Archivo</td>
    <td><div id="file_source" class="file">Seleccionar archivo</div></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="button" name="subir" id="subir" value="Aceptar" />
    <input type="button" name="Submit2" value="Cancelar" /></td>
  </tr>
</table>
</div>
<script language="javascript">
	var sube=new AjaxUpload('#file_source', {
            action: 'ajax.php?a=upload_tardanza',
            name:'file',
            autoSubmit: false,
            responseType: 'json',
            onChange: function(file, ext) {                 
                $('#file_source').html(file);                
            },
            onSubmit : function(file , ext){
                if(ext!='csv'){
                    alert("Solo se permiten archivos '.csv'");
                    return false
                }else{
                //Paso de paramentro adicionales (POST)
                    this.setData({                    
                        ano:$('#ano_id option:selected').val(),
                        mes:$('#mes_id option:selected').val()                    
                    });
                    $('#file_source').append('<img src="images/loading.gif" id="loading" style="padding-left: 5px;" />');
                }
            },
            onComplete: function(file, json){
                if (json.success) {                                        
                    window.location.reload();
		}
		if (json.error) {
                    $('#loading').remove();
                    alert(json.error);
		}
            }
    });
    jQuery('#subir').click(function(){                    
    	sube.submit();
        return false;
    });	    
</script>