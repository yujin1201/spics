<?php
include_once('./_common.php');

$sql = " 
SELECT
    a.cont_seq,
    a.cont_nm,
    a.cont_type_code,
    (select comm_cd_nm from tb_code where comm_cd = a.cont_type_code and comm_type_cd ='BAB') cont_type_nm ,
    a.mda_type,
    a.cont_yearmon,
    a.cont_stat,
    (select comm_cd_nm from tb_code where comm_cd = a.cont_stat and comm_type_cd ='BAC') cont_stat_nm ,
    a.cli_seq,  
    (select comp_nm from tb_comp where comp_seq = a.cli_seq) cli_nm ,
    a.agncy_seq,
    (select comp_nm from tb_comp where comp_seq = a.agncy_seq) agncy_nm ,
    a.rep_seq,
    (select comp_nm from tb_comp where comp_seq = a.rep_seq) rep_nm ,
    a.sale_prsn,
    (select mb_name from g5_member where mb_no = a.sale_prsn) sale_prsn_nm ,
    a.cont_st_dt,
    a.cont_ed_dt,
    a.cont_amt,  
    b.fin_seq,
   b.cont_seq,
   b.adj_yearmon,
   b.sell_amt,
   b.agnt_cmms_rt,
   b.cnsg_cmms_rt,
   b.agnt_cmms_amt,
   b.cnsg_cmms_amt,
   b.adj_yn,
   b.adj_dt,
   b.adj_num,
   b.bill_dt,
   b.bill_yn,
   b.bill_rsv,
   b.send_dt,
   b.stl_condi_code,
   b.stl_condi_cntnts,
   b.tret_yn,
   b.bigo, 
   (select comm_cd_nm from tb_code where comm_cd = b.stl_condi_code and comm_type_cd ='BAD') stl_condi_nm,
   (select mb_name from g5_member where mb_no = ifnull(b.updt_prsn, b.entr_prsn)) entr_prsn_nm,
   date_format(ifnull(b.updt_dt, b.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt
FROM
    tb_cont a, tb_cont_fin b
where a.cont_seq = b.cont_seq 
    and a.cont_stat not in ('BAC01','BAC02')

    ";

if(isset($_GET['sch_name']) &&  $_GET['sch_name'] != ''){
   $sql .= " and a.cont_nm like '%{$_GET['sch_name']}%'";
}
if(isset($_GET['adj_yearmon']) &&  $_GET['adj_yearmon'] != ''){
   $sql .= " and b.adj_yearmon  = '{$_GET['adj_yearmon']}'   ";
}
if(isset($_GET['cont_stat']) &&  $_GET['cont_stat'] != ''){
   $sql .= " and a.cont_stat  = '{$_GET['cont_stat']}'";
}

$sql .= " order by b.adj_yearmon desc,  ifnull(a.updt_dt, a.entr_dt) desc ";

$result = sql_query_json($sql); //질의.
echo $result ;
?>


