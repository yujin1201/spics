<?php
include_once('./_common.php');

$sql = "SELECT mtrl_seq, comp_seq, a.mtrl_nm, a.mtrl_sec, a.use_yn, prod_type, comm_cd_nm as prod_type_nm,  indst_lrg_knd_cd
     , a.indst_mdl_knd_cd, a.indst_sml_knd_cd, a.insp_no, a.bigo, a.entr_prsn, a.entr_dt, a.updt_prsn, a.updt_dt 
   FROM tb_mtrl a , tb_code b where a.prod_type = b.comm_cd and del_yn='N'";

if(isset($_GET['comp_seq']) &&  $_GET['comp_seq'] > 0){
    $sql .= "and comp_seq = '{$_GET['comp_seq']}'";
}

if(isset($_GET['mtrl_seq']) &&  $_GET['mtrl_seq'] > 0){
    $sql .= "and mtrl_seq = '{$_GET['mtrl_seq']}'";
}

$result = sql_query($sql); //질의.

$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>