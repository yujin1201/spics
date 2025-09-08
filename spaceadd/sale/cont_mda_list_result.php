<?php
include_once('./_common.php');

if(strlen($_GET['fr_date']) == 6 ){
    $sdate =  "'".$_GET['fr_date']."01' " ;
    $edate =  "date_format(LAST_DAY('{$_GET['to_date']}01') , '%Y%m%d' )  " ;
}else{
    $sdate = "'".$_GET['fr_date']."'" ;
    $edate = "'".$_GET['to_date']."'"    ;
}

$sql = "  
SELECT
    a.cont_mda_seq,
    a.cont_seq,
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
    date_format(ifnull(a.updt_dt, a.entr_dt), '%Y-%m-%d %H:%i' ) entr_dt,
    ifnull((select mb_name from g5_member where mb_no = ifnull(nullif(a.updt_prsn,''), a.entr_prsn)), '')  entr_prsn_nm,
    a.updt_prsn,  
    a.op_yn ,
    ifnull(( select comm_cd_nm from tb_code where comm_cd = a.report_opt  and comm_type_cd ='BAF' ), '')  report_opt_nm  ,    
    ifnull(( select group_concat(t.mtrl_nm ) from tb_cont_mtrl s, tb_mtrl t where a.cont_mda_seq = s.cont_mda_seq and s.mtrl_seq = t.mtrl_seq  ), '')  mtrl_nm  
    , case when date_format(now(), '%Y%m%d' ) >= a.st_dt then 'Y' else 'N' end opdt_yn ,
    b.cont_nm,
    b.cont_type_code,
    b.mda_type,
    b.cont_yearmon,
    b.cont_stat,
    ifnull((select comm_cd_nm from tb_code where comm_cd = b.cont_stat and comm_type_cd ='BAC'), '')  cont_stat_nm ,
    b.cli_seq,  
    ifnull((select comp_nm from tb_comp where comp_seq = b.cli_seq), '')  cli_nm ,
    b.agncy_seq,
    ifnull((select comp_nm from tb_comp where comp_seq = b.agncy_seq), '')  agncy_nm ,
    b.rep_seq,
    ifnull((select comp_nm from tb_comp where comp_seq = b.rep_seq), '')  rep_nm ,
    b.sale_prsn,
    ifnull((select mb_name from g5_member where mb_no = b.sale_prsn) , '')  sale_prsn_nm ,
    b.cont_st_dt,
    b.cont_ed_dt,
    b.cont_amt, 
    ifnull((select sum(sell_amt) from tb_cont_fin where b.cont_seq = cont_seq),0) tot_sell_amt  
    , c.mda_nm 
    , c.comp_seq mda_comp_seq
    , ifnull((select comp_nm from tb_comp where comp_seq = c.comp_seq ), '')  mda_comp_nm
    , d.full_nm  
    , d.m1_nm, d.m2_nm, d.m3_nm
    , e.bigo bigo2
    , e.bigo_seq 
 FROM 
    tb_cont b , tb_comp_mda c, vi_media  d,tb_cont_mda a
    left outer join tb_cont_mda_bigo e on a.cont_mda_seq = e.cont_mda_seq
 where a.cont_seq = b.cont_seq  
   and a.prod_seq = c.prod_seq 
   and c.mda_seq = d.mda_seq   
     and ( 
             a.st_dt between {$sdate} and {$edate}   
         or  a.ed_dt    between {$sdate} and {$edate}  
         or  ( a.st_dt < {$sdate} and a.ed_dt > {$edate}    )
         ) 
";



/*
if(isset($_GET['fr_date']) &&  $_GET['fr_date'] != ''){
    $sql .= " and b.cont_yearmon  between '{$_GET['fr_date']}' and '{$_GET['to_date']}'  ";
}
*/
if(isset($_GET['op_yn']) &&  $_GET['op_yn'] != ''){
    $sql .= " and a.op_yn ='Y'   ";
}

if(isset($_GET['comp_seq']) &&  $_GET['comp_seq'] != ''){
    $sql .= " and c.comp_seq =  {$_GET['comp_seq']}  ";
}

if(isset($_GET['mda_seq']) &&  $_GET['mda_seq'] != ''){
    $sql .= " and c.mda_seq  =  {$_GET['mda_seq']}  ";
}
if(isset($_GET['cont_stat']) &&  $_GET['cont_stat'] != ''){
    $sql .= " and b.cont_stat  = '{$_GET['cont_stat']}'";
}


//송출제외, 영업이하는 본인 계약만 조회
if( $member['mb_level'] <=  6  &&  $member['mb_level'] !=4  ){
    $sql .= " and b.sale_prsn =  {$member['id']} ";
}
$sql .= "  order by ifnull(a.updt_dt, a.entr_dt) desc, b.cont_seq desc ,  a.st_dt desc, a.cont_mda_seq desc   ";
 


$result = sql_query_json($sql); //질의.
echo $result ;

?>
