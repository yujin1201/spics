<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$cont_seq = $jsonInput['cont_seq'] ;

$sql1= " delete from   tb_cont_mdatype  
             where cont_seq  =  {$jsonInput['cont_seq'] }    ";
sql_query($sql1);

$arr = $jsonInput['media']  ;
foreach ($arr as $key => $vals) {
    $sql = " insert into tb_cont_mdatype 
        set cont_seq = {$vals['cont_seq'] } ,
            mda_type_code = '{$vals['mda_type_code'] }'  ,
            mda_amt = {$vals['mda_amt'] }  , 
            mda_cmms_amt = {$vals['mda_cmms_amt'] }  ,
            mda_cost = {$vals['mda_amt'] } - {$vals['mda_cmms_amt'] }  ,
            bigo = '{$vals['bigo']}'    ,
            entr_dt = now(),
            entr_prsn ='{$member['mb_no']}' " ;
    $result = sql_query($sql);
    if ($result) $cont_mda_seq = sql_insert_id();
}
$value = array('cont_seq' => $cont_seq );
echo json_encode($value);
?>