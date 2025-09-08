<?php
include_once('./_common.php');

$sql = " 
SELECT
    a.cont_seq,
    a.cont_nm,
    a.cont_type_code,
    ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_type_code and comm_type_cd ='BAB'),'')  cont_type_nm ,
    a.mda_type,
    a.cont_yearmon,
    a.cont_stat,
    ifnull((select comm_cd_nm from tb_code where comm_cd = a.cont_stat and comm_type_cd ='BAC'),'')  cont_stat_nm ,
    a.cli_seq,  
    ifnull((select comp_nm from tb_comp where comp_seq = a.cli_seq),'')  cli_nm ,
    a.agncy_seq,
    ifnull((select comp_nm from tb_comp where comp_seq = a.agncy_seq),'')  agncy_nm ,
    a.rep_seq,
    ifnull((select comp_nm from tb_comp where comp_seq = a.rep_seq),'')  rep_nm ,
    a.sale_prsn,
    ifnull((select mb_name from g5_member where mb_no = a.sale_prsn),'')  sale_prsn_nm ,
    a.cont_st_dt,
    a.cont_ed_dt,
    a.cont_amt,  
    b.fin_seq,
   b.cont_seq,
   b.adj_type_code ,
   ifnull((select comm_cd_nm from tb_code where comm_cd = b.adj_type_code ),'')  adj_type_nm ,
   b.adj_yearmon,
   b.sell_amt,
   ifnull(b.out_amt,0) out_amt ,
   ifnull(b.in_amt ,0) in_amt,
    CASE WHEN b.inout_type  ='ABD02'  THEN b.agnt_cmms_rt  ELSE  null  END   agnt_cmms_rt   ,
   b.cnsg_cmms_rt,
   b.agnt_cmms_amt,
   b.cnsg_cmms_amt,
   b.rep_cmms_rt,
   b.rep_cmms_amt, 
   b.adj_yn,
   b.adj_dt,
   b.adj_num,
   b.bill_dt,
   b.bill_yn,
   b.bill_rsv,
   b.bill_snd,  
   b.send_dt,
   b.out_dt ,
   b.stl_condi_code,
   b.stl_condi_cntnts,
   b.tret_yn,
   b.bigo, 
   (select comm_cd_nm from tb_code where comm_cd = b.inout_type  ) inout_type_nm , 
   c.comp_nm  rsv_comp_nm  ,   
   c.busi_no rsv_busi_no ,
   c.busi_nm  rsv_busi_nm  ,
   d.comp_nm  snd_comp_nm ,
   d.busi_no snd_busi_no ,
   d.busi_nm  snd_busi_nm  ,
   ifnull((select comm_cd_nm from tb_code where comm_cd = b.stl_condi_code and comm_type_cd ='BAD'),'')  stl_condi_nm,
   ifnull((select mb_name from g5_member where mb_no = ifnull(nullif(b.updt_prsn,''), b.entr_prsn)) ,'') entr_prsn_nm,
   date_format(ifnull(b.updt_dt, b.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt ,
   case when a.cont_stat='BAC03' and date_format(ifnull(a.updt_dt, a.entr_dt), '%Y-%m-%d ' )  <= (CURDATE()-INTERVAL 7 DAY) then 'Y' else 'N' end adj_chk  ,
   ifnull(( select group_concat(y.comm_cd_nm) from tb_cont_mdatype x, tb_code y   where a.cont_seq = x.cont_seq   and x.mda_type_code  = y.comm_cd and y.comm_type_cd ='AAB'      ), '') mda_nm_list
FROM
    tb_cont a, tb_cont_fin b
    left outer join tb_comp c  on c.comp_seq = b.rsv_comp_seq 
    left outer join tb_comp d  on d.comp_seq = b.snd_comp_seq 
where a.cont_seq = b.cont_seq 
    and a.cont_stat not in ('BAC01','BAC02')

    ";

if(isset($_GET['sch_name']) &&  $_GET['sch_name'] != ''){
   $sql .= " and a.cont_nm like '%{$_GET['sch_name']}%'";
}
if(isset($_GET['fr_date']) &&  $_GET['fr_date'] != ''){
   $sql .= " and b.adj_yearmon  between '{$_GET['fr_date']}'  and '{$_GET['to_date']}'  ";
}
if(isset($_GET['cont_stat']) &&  $_GET['cont_stat'] != ''){
   $sql .= " and a.cont_stat  = '{$_GET['cont_stat']}'";
}
if(isset($_GET['adj_type_code']) &&  $_GET['adj_type_code'] != ''){
   $sql .= " and b.adj_type_code  = '{$_GET['adj_type_code']}'";
}
if(isset($_GET['inout_type']) &&  $_GET['inout_type'] != ''){
   $sql .= " and b.inout_type  = '{$_GET['inout_type']}'";
}
//영업(6) 이하는 본인것만 가능
if($member['mb_level'] <=  6   ){
    $sql .= " and a.sale_prsn =  {$member['mb_no']}";
}

$sql .= " order by b.adj_yearmon desc,  ifnull(a.updt_dt, a.entr_dt) desc ";

$result = sql_query_json($sql); //질의.
echo $result ;
?>


