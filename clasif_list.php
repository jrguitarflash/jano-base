<form name="form1" action="index.php?menu=empresa_list" method="post">
<input type="hidden" name="perfil" value="<?=$_GET['perfil']?>">
<div class="box">
	<div class="heading">
    	<h1>Clasificacion</h1>
	  	<div class="buttons">
			<a class="button" href="index.php?menu=empresa_form&a=I&id=0&a=I&perfil=<?=(int)$_GET['perfil']?>"><span style="width:50px;">Insertar</span></a>
			<a class="button"><span style="width:50px;">Eliminar</span></a>
			<a class="button" onclick="GetIds();//abrir('pers_perfil.php?ids=','P',300,150);"><span style="width:50px;">Perfil</span></a>
		</div>
    </div>
    <div class="content">
	<div id="clasif" style="float:left;width:25%;height:400px;border:solid gray 1px;overflow:auto">
    <?=clasifx_lista();?>  
	</div>
	<div id="lista" style="float:right;width:73%;padding:4px;height:400px;border:solid gray 1px;overflow:auto">
	<?=producto_clasifx();?>
	</div>
    </div>
</div>
</form>