<?php
include_once('./_common.php');

$sql = "SELECT comp_seq, comp_nm,(select comm_cd_nm from tb_code where comm_cd = comp_type) as comp_type_nm,
 comp_type, busi_no, corp_no, rep_nm1, rep_nm2, tel_no, fax_no, zipcode, addr1, addr2,addr3, busi_sts, item, chrg_nm, chrg_no, chrg_email, psrn_nm, psrn_no, psrn_email, fin_nm, fin_no, fin_email
, deal_sts_code, (select comm_cd_nm from tb_code where comm_cd = deal_sts_code) as deal_sts_nm ,  deal_ocur_dt, rep_indst_div
, bill_type, (select comm_cd_nm from tb_code where comm_cd = bill_type) as bill_type_nm,  bigo, entr_prsn, entr_dt, updt_prsn, updt_dt, mda_type FROM tb_comp where 1=1 AND del_yn='N' ";

if(isset($_GET['idx']) &&  $_GET['idx'] > 0){
    $sql .= "and comp_seq = '{$_GET['idx']}'";
}

if(isset($_GET['search_str']) &&  $_GET['search_str'] != ''){
    if($_GET['sfl'] == 'comp_nm'){
        $sql .= "and comp_nm like '%{$_GET['search_str']}%'";
    }
}

if(isset($_GET['comp_type']) &&  $_GET['comp_type'] != ''){
    $sql .= "and comp_type = '{$_GET['comp_type']}'";
}

if(isset($_GET['deal_sts_code']) &&  $_GET['deal_sts_code'] != ''){
    if($_GET['deal_sts_code'] == 'BAANOT'){
        $sql .= "and deal_sts_code != 'BAA01'";
    }else{
        $sql .= "and deal_sts_code = '{$_GET['deal_sts_code']}'";
    }
}

 $sql .=" order by comp_seq desc ";




$result = sql_query($sql); //질의.

$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>


