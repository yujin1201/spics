<?php
include_once('../_common.php');

$sql =  "
    SELECT mtrl_seq, a.comp_seq, b.comp_nm, a.mtrl_nm, a.mtrl_sec, a.use_yn, prod_type
         , c.comm_cd_nm as prod_type_nm , indst_lrg_knd_cd, indst_mdl_knd_cd, indst_sml_knd_cd
         , insp_no, a.bigo, a.entr_prsn, a.entr_dt, a.updt_prsn, a.updt_dt 
     FROM tb_mtrl a , tb_comp b, tb_code c 
     where a.comp_seq=b.comp_seq 
       and a.prod_type=c.comm_cd 
       and b.comp_type='AAC01' 
       and a.use_yn ='Y' 
     ";

if(isset($_GET['cli_seq']) &&  $_GET['cli_seq'] > 0){
    $sql .= "and b.comp_seq = '{$_GET['cli_seq']}'";
}
if(isset($_GET['mtrl_nm']) &&  $_GET['mtrl_nm'] != ''){
  $sql .= "and a.mtrl_nm like '%{$_GET['mtrl_nm']}%'";
}
if(isset($_GET['mtrl_sec']) &&  $_GET['mtrl_sec'] != ''){
    $sql .= "and a.mtrl_sec  = {$_GET['mtrl_sec']} ";
}
$sql .=" order by mtrl_seq desc ";
$result = sql_query_json($sql);
echo $result;
?>


