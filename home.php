<?php
$reg=empresa::edit('S',$_SESSION['SIS'][5]);
?>
<script language="javascript">
    function jgrafico(valor){
        $(document).ready(function() {
            $("#grafico").attr("src","images/estadistica/"+valor+".png");
        });
    }
</script>
<div class="box">
    <div class="heading">
      <h1><img src="images/home.png" alt="" /> Tablero de Control</h1>
    </div>
    <div class="content">
      <div class="overview">
      	<?=tablero_lista($_SESSION['SIS'][3],'L');?>        
      </div>              
        
      <div class="statistic">
      	<?=tablero_lista($_SESSION['SIS'][3],'R');?> 
      </div>
                                            
      <div class="latest">
      	<?=tablero_lista($_SESSION['SIS'][3],'B');?> 
      </div>
      <!--<?= print_r($_SESSION['SIS']); ?>-->
    </div>
  </div>
<script language="javascript">
$('#ui-tabs').tabs(); 
</script>