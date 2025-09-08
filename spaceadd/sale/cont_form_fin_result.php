<?php
include_once('./_common.php');

$sql = "SELECT
            a.fin_seq 
        , a.cont_seq 
        , a.adj_yearmon 
        , a.inout_type 
        , a.adj_type_code 
        , a.sell_amt 
        , a.out_amt 
        , a.in_amt 
        , a.rsv_comp_seq 
        , a.snd_comp_seq 
        , CASE WHEN a.inout_type  ='ABD02'  THEN a.agnt_cmms_rt  ELSE  null  END   agnt_cmms_rt  
        , a.cnsg_cmms_rt 
        , a.agnt_cmms_amt 
        , a.cnsg_cmms_amt 
        , a.rep_cmms_rt 
        , a.rep_cmms_amt 
        , a.adj_yn 
        , a.adj_dt 
        , a.adj_num 
        , a.bill_dt 
        , a.bill_yn 
        , a.bill_rsv 
        , a.bill_snd 
        , a.send_dt 
        , a.out_dt 
        , a.stl_condi_code 
        , a.stl_condi_cntnts 
        , a.tret_yn 
        , a.bigo 
        , a.entr_prsn 
        , date_format(ifnull(a.updt_dt, a.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt
        , a.updt_prsn 
        , a.updt_dt
        , (select comm_cd_nm from tb_code where comm_cd = a.inout_type  ) inout_type_nm 
        , (select comm_cd_nm from tb_code where comm_cd = a.adj_type_code  ) adj_type_nm   
        , ifnull((select comp_nm from tb_comp where comp_seq = a.rsv_comp_seq), '')  rsv_comp_nm  
        , ifnull((select comp_nm from tb_comp where comp_seq = a.snd_comp_seq), '')  snd_comp_nm 
        ,(select comm_cd_nm from tb_code where comm_cd = a.stl_condi_code  ) stl_condi_nm  
        ,(select mb_name from g5_member where mb_no = ifnull(nullif(a.updt_prsn,''), a.entr_prsn) ) entr_prsn_nm  
        FROM
            tb_cont_fin a
        where  cont_seq  = {$_GET['cont_seq']}
        order by adj_yearmon desc 
    ";

$result = sql_query_json($sql); //질의.
echo $result ;
?>


