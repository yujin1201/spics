<?php
include_once('./_common.php');
$sql_where ="";
if(isset($_GET['use_yn']) &&  $_GET['use_yn'] != ''){
    $sql_where .= " where use_yn = '{$_GET['use_yn']}'";
}
$sql = " 
 SELECT
    comm_seq,
    comm_cd,
    comm_type_cd,
    comm_cd_nm,
    up_comm_seq,
    ord,
    use_yn,
    bigo1,
    bigo2,
    bigo3,
    entr_prsn,
    entr_dt,
    updt_prsn,
    updt_dt,
    comm_seq  org_comm_seq
FROM tb_code
 {$sql_where}
order by comm_type_cd, ord, comm_cd ";
$result = sql_query_json($sql); //질의.
echo $result ;
?>


