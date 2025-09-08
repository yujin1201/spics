<?php
include_once('./_common.php');

$sql = "SELECT mtrl_seq, a.comp_seq, b.comp_nm, a.mtrl_nm, a.mtrl_sec, a.use_yn, prod_type, c.comm_cd_nm as prod_type_nm , indst_lrg_knd_cd, indst_mdl_knd_cd, indst_sml_knd_cd
, insp_no, a.bigo, a.entr_prsn, a.entr_dt, a.updt_prsn, a.updt_dt 
FROM tb_mtrl a , tb_comp b, tb_code c where a.comp_seq=b.comp_seq and a.prod_type=c.comm_cd and a.del_yn='N' ";

if(isset($_GET['idx']) &&  $_GET['idx'] > 0){
    $sql .= "and comp_seq = '{$_GET['idx']}'";
}

if(isset($_GET['search_str']) &&  $_GET['search_str'] != ''){
    if($_GET['sfl'] == 'comp_nm'){
        $sql .= "and comp_nm like '%{$_GET['search_str']}%'";
    }else if($_GET['sfl'] == 'mtrl_nm'){
        $sql .= "and mtrl_nm like '%{$_GET['search_str']}%'";
    }else if($_GET['sfl'] == 'all'){
        $sql .= "and ( mtrl_nm like '%{$_GET['search_str']}%' or comp_nm like '%{$_GET['search_str']}%') ";
    }
}

if(isset($_GET['comp_type']) &&  $_GET['comp_type'] != ''){
    $sql .= "and comp_type = '{$_GET['comp_type']}'";
}

if(isset($_GET['prod_type']) &&  $_GET['prod_type'] != ''){

    $sql .= "and prod_type = '{$_GET['prod_type']}'";

}

 $sql .=" order by mtrl_seq desc ";




$result = sql_query($sql); //질의.

$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>


