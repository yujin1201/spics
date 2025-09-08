<?php
include_once('../_common.php');

$sql = "SELECT comp_seq, comp_nm 
             , comp_type, busi_no
             , rep_nm1
             , busi_sts, deal_sts_code
             , psrn_nm
			 , busi_nm
             ,(select comm_cd_nm from tb_code where comm_cd = comp_type) as comp_type_nm
             , (select comm_cd_nm from tb_code where comm_cd = deal_sts_code) as deal_sts_nm  
             , entr_prsn, entr_dt, updt_prsn, updt_dt, mda_type 
        FROM tb_comp where  del_yn='N'  and deal_sts_code ='BAA01'  ";
if(isset($_GET['idx']) &&  $_GET['idx'] > 0){
    $sql .= "and comp_seq = '{$_GET['idx']}'";
}
if(isset($_GET['stx']) &&  $_GET['stx'] != ''){
    if($_GET['sfl'] == 'comp_nm'){
        $sql .= "and ( comp_nm like '%{$_GET['stx']}%'   or busi_nm    like '%{$_GET['stx']}%'   ) ";
    }
    if($_GET['sfl'] == 'rep_nm'){
        $sql .= "and rep_nm1  like '%{$_GET['stx']}%'";
    }
    if($_GET['sfl'] == 'mb_name'){
        $sql .= "and psrn_nm like '%{$_GET['stx']}%'";
    }
}
if(isset($_GET['compType']) &&  $_GET['compType'] != ''){
    $sql .= "and comp_type like '{$_GET['compType']}%'";
}
$sql .= " order by comp_nm, busi_nm ";
$result = sql_query_json($sql);
echo $result;
?>


