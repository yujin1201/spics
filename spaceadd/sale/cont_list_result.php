<?php
include_once('./_common.php');

$sql = "SELECT
    a.cont_seq,
    a.cont_nm,
    a.cont_type_code,
    ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_type_code and comm_type_cd ='BAB'), '')  cont_type_nm ,
    a.mda_type,
    a.cont_yearmon,
    a.cont_stat,
    ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_stat and comm_type_cd ='BAC'), '')  cont_stat_nm ,
    a.cli_seq,  
    ifnull(b.comp_nm , '')  cli_nm ,
    a.agncy_seq,
    ifnull( c.comp_nm , '')  agncy_nm ,
    a.rep_seq,
    ifnull((select comp_nm from tb_comp where comp_seq = a.rep_seq), '')  rep_nm ,
    a.sale_prsn,
    ifnull((select mb_name from g5_member where mb_no = a.sale_prsn), '')  sale_prsn_nm ,
    a.cont_st_dt,
    a.cont_ed_dt,
    a.cont_amt,
    a.bigo,
    a.entr_prsn,
    ifnull((select mb_name from g5_member where mb_no = ifnull(nullif(a.updt_prsn,''), a.entr_prsn)), '')  entr_prsn_nm,
    date_format(ifnull(a.updt_dt, a.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt , 
    a.updt_dt ,
    a.cont_sale_type , 
     ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_sale_type and comm_type_cd ='BAK'), '')  cont_sale_type_nm ,
    ifnull((select sum(out_amt) from tb_cont_fin where cont_seq = a.cont_seq), 0)  out_amt  ,
    ifnull((select sum(in_amt) from tb_cont_fin where cont_seq = a.cont_seq), 0)  in_amt,
    ifnull((select sum(out_amt)-sum(in_amt) from tb_cont_fin where cont_seq = a.cont_seq), 0)  profit_amt
 , ifnull(( select group_concat(y.comm_cd_nm) from tb_cont_mdatype x, tb_code y   where a.cont_seq = x.cont_seq   and x.mda_type_code  = y.comm_cd and y.comm_type_cd ='AAB'      ), '') mda_nm
FROM
    tb_cont a, tb_comp b ,  tb_comp c  

where b.comp_seq = a.cli_seq  and b.comp_type='AAC01'  
   and c.comp_seq = a.agncy_seq  and c.comp_type='AAC03'  
   and a.cont_st_dt  <= '{$_GET['to_date']}'  
   and a.cont_ed_dt >= '{$_GET['fr_date']}' 

    ";
/*
if(isset($_GET['sch_name']) &&  $_GET['sch_name'] != ''){
        $sql .= " and cont_nm like '%{$_GET['sch_name']}%'";
}
if(isset($_GET['fr_date']) &&  $_GET['fr_date'] != ''){
    $sql .= " and cont_yearmon  between '{$_GET['fr_date']}' and '{$_GET['to_date']}' ";
}

if(isset($_GET['cli_seq']) &&  $_GET['cli_seq'] != ''){
    $sql .= " and cli_seq =  {$_GET['cli_seq']}";
}
if(isset($_GET['agncy_seq']) &&  $_GET['agncy_seq'] != ''){
    $sql .= " and agncy_seq =  {$_GET['agncy_seq']}";
}
*/
if(isset($_GET['cli_nm']) &&  $_GET['cli_nm'] != ''){
    $sql .= " and b.comp_nm  like  '%{$_GET['cli_nm']}%'  ";
}
if(isset($_GET['agncy_nm']) &&  $_GET['agncy_nm'] != ''){
    $sql .= " and c.comp_nm  like  '%{$_GET['agncy_nm']}%'  ";
}

if(isset($_GET['sale_prsn']) &&  $_GET['sale_prsn'] != ''){
    $sql .= " and sale_prsn =  {$_GET['sale_prsn']}";
}
//계약구분
if(isset($_GET['cont_type_code']) &&  $_GET['cont_type_code'] != ''){
    $sql .= " and cont_type_code =  '{$_GET['cont_type_code']}' ";
}
//매체 포함 여부
if(isset($_GET['mda_type_code']) &&  $_GET['mda_type_code'] != ''){
    $sql .= " and exists (   select '1' from tb_cont_mdatype x  where a.cont_seq = x.cont_seq   and x.mda_type_code = '{$_GET['mda_type_code']}' )  ";
}


//송출제외, 영업이하는 본인 계약만 조회
/*
if($member['mb_level'] <=  6  &&  $member['mb_level'] !=4  ){
    $sql .= " and sale_prsn =  {$member['mb_no']}";
}
*/
$sql .= " order by ifnull(a.updt_dt, a.entr_dt) desc, cont_yearmon desc,  a.entr_dt desc ";

$result = sql_query_json($sql); //질의.
echo $result ;
?>


