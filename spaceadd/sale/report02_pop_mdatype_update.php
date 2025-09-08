<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$yearmon = $jsonInput['yearmon'] ;

$sql1= " delete 
         from   tb_mdatype_stock  
         where yearmon  =  {$jsonInput['yearmon'] }    ";
sql_query($sql1);

$arr = $jsonInput['media']  ;
foreach ($arr as $key => $vals) {
    $sql = " insert into tb_mdatype_stock 
            set yearmon = '{$yearmon }' ,
                mda_type_code = '{$vals['mda_type_code'] }'  ,
                mda_unitprc = {$vals['mda_unitprc'] }  ,
                mda_cnt = {$vals['mda_cnt'] }  , 
                bigo = '{$vals['bigo']}'    ,
                entr_dt = now(),
                entr_prsn ='{$member['mb_no']}' " ;
    $result = sql_query($sql);
    if ($result) $cont_mda_seq = sql_insert_id();
}

$value = array('yearmon'=>yearmon);
echo json_encode($value);
?>