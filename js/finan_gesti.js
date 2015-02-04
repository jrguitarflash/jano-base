//load modulo financiero
window.onload=function()
{
	view=document.getElementById('finan_view').value;

	switch(view)
	{

		case 'finan_lstOpe':

			//eventos
			$('#finan_opeNuev').click(function(mievento) // new
			{
				url="index.php";
				param="menu_id=162";
				param+="&menu=finan_frmOpe";
				gd_direPagParam(url,param);	
			});

		break;

		case 'finan_frmOpe':


			//inicio de tabs
				$(function() 
				{
					$( "#tabs" ).tabs();
				});

			//eventos
			$('#finan_opeVol').click(function(mievento)
			{
				url="index.php";
				param="menu_id=162";
				param+="&menu=finan_lstOpe";
				gd_direPagParam(url,param);	
			});

		break;

		default:
		break;

	}

}