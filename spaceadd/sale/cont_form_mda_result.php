<?php
include_once('./_common.php');

$sql_where = ""
;if(isset($_GET['op_yn']) &&  $_GET['op_yn'] != ''){
    $sql_where .= " and a.op_yn = '{$_GET['op_yn']}'";
}
if(isset($_GET['stop_date']) &&  $_GET['stop_date'] != ''){
    $sql_where .= " and  '{$_GET['stop_date']}' <= a.ed_dt ";
}

$sql = " SELECT
        a.cont_mda_seq,
        a.cont_seq,
        a.mda_comp_seq,
        (select comp_nm from tb_comp where comp_seq = a.mda_comp_seq) mda_comp_nm ,
        a.prod_seq,
        a.account_cnt,
        a.equip_cnt,
        a.guarant_pos,
        a.multi_yn,
        a.st_dt,
        a.ed_dt,
        a.act_st_time,
        a.act_ed_time,
        a.report_yn ,
        a.report_opt,
        case when a.report_yn ='Y' then a.toss_dt else '' end  toss_dt,
        a.mg_report_yn, 
        case when a.mg_report_yn ='Y' then a.mg_report else '' end  mg_report, 
        a.bigo,
        a.entr_prsn, 
        a.op_yn , 
        a.asg_use_yn ,
        a.bns_yn, 
        b.mda_nm  ,
        ifnull(b.mda_amt, 0) mda_amt,
        ifnull(b.ins_cnt, 0) ins_cnt,
        c.m1_nm , 
        c.full_nm  ,
        ( select comm_cd_nm from tb_code where comm_cd = a.report_opt  and comm_type_cd ='BAF' ) report_opt_nm    
       , case when date_format(now(), '%Y%m%d' ) >= a.st_dt then 'Y' else 'N' end opdt_yn
       , (select mb_name from g5_member where mb_no = ifnull(nullif(a.updt_prsn,''), a.entr_prsn) ) entr_prsn_nm
       , date_format(ifnull(a.updt_dt, a.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt 
 
   FROM 
    tb_cont_mda a, tb_comp_mda b , vi_media c 
 where a.cont_seq ={$_GET['cont_seq']}  
    and a.prod_seq = b.prod_seq
    and c.mda_seq = b.mda_seq
    {$sql_where}
 order by a.st_dt desc, a.cont_mda_seq desc  ";
$result = sql_query_json($sql); //질의.
echo $result ;
?>


