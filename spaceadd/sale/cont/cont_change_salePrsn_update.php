<?php
$sub_menu = "200140";
include_once('../_common.php');
include_once('../cont_form_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );
$chng_sale_prsn = $jsonInput['chng_sale_prsn'] ;

$err = "" ;
$errFlag = ""  ;


$arr = $jsonInput['cont']  ;
foreach ($arr as $key => $vals) {
    $sql = " update tb_cont  
        set sale_prsn = {$chng_sale_prsn} 
          , updt_dt = now()
          , updt_prsn ={$member['mb_no']}  
        where cont_seq = {$vals['cont_seq'] } " ;
    $result = sql_query($sql);
}
echo json_encode($chng_sale_prsn);
?>