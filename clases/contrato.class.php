<?php
class contrato{
    function edit($accion,$id){
        switch($accion){
            case 'S':
                $sql="SELECT*,
                      (select uc_delimeter(pers_completo,' ',true)as pers_completo from v_trabajador where trabajador_id=contrato.trabajador_id)as trabajador,
                      (select pers_direccion from v_trabajador where trabajador_id=contrato.trabajador_id)as trabajador_direccion,
                      (select pers_dni from v_trabajador where trabajador_id=contrato.trabajador_id)as trabajador_dni,
                      (select pers_completo from v_trabajador where trabajador_id=contrato.trabajador_id_representante)as representante,
                      (select pers_dni from v_trabajador where trabajador_id=contrato.trabajador_id_representante)as representante_dni,
                      DATE_FORMAT(cont_fecha,'%d de %M del %Y')as cont_fecha,
                      DATE_FORMAT(cont_fec_ini,'%d de %M del %Y')as cont_fec_ini,
                      DATE_FORMAT(cont_fec_fin,'%d de %M del %Y')as cont_fec_fin,
                      concat(cont_remuneracion,' (00/100) nuevos soles ')as cont_remuneracion,
                      get_fecha(cont_fec_ini,cont_fec_fin)as cont_duracion,
                      (select cont_for_contenido from contrato_formato where cont_for_id=contrato.cont_for_id)as formato
                      FROM contrato where bestado='1' and contrato_id=".(int)$id;
                $result=mysql_query($sql) or Msg_error($sql);
                $row=mysql_fetch_array($result,1);
                return $row;
                break;                      
        }

    }
}
?>
