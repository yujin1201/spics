<?php
$sub_menu = "100400";
include_once('./_common.php');
include_once('./cont_form_common.php');
$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$cont_seq = $jsonInput['cont_seq'] ;

//계약정보 복사 등록
$sql ="  insert into tb_cont (
            cont_nm, cont_type_code, mda_type, cont_yearmon, cont_stat, cli_seq, agncy_seq, rep_seq, sale_prsn, cont_st_dt, cont_ed_dt
            , cont_amt, deal_type_code, brnd_nm, campgn_nm, bigo, entr_prsn, entr_dt, bf_cont_seq     
          )
         select
          concat('[복사]', cont_nm) cont_nm
        , cont_type_code
        , mda_type
        , replace('{$jsonInput['c_cont_yearmon']}', '-','') cont_yearmon
        , 'BAC01'  cont_stat
        , cli_seq
        , agncy_seq
        , rep_seq
        , sale_prsn
        , replace('{$jsonInput['c_cont_st_dt']}', '-','') cont_st_dt
        , replace('{$jsonInput['c_cont_ed_dt']}', '-','') cont_ed_dt
        , cont_amt
        , deal_type_code
        , brnd_nm
        , campgn_nm
        , bigo
        , '{$member['mb_no']}' entr_prsn
        , now()  entr_dt 
        , cont_seq
       from tb_cont
       where cont_seq = {$cont_seq}  " ;
      $result = sql_query($sql );
     if($result)  $new_cont_seq  = sql_insert_id();

   //계약상품
    $sql2 ="
        insert into tb_cont_mda
        (
           cont_seq, mda_comp_seq, prod_seq, account_cnt, equip_cnt, guarant_pos, multi_yn, mtrl_sec, st_dt, ed_dt, act_st_time, act_ed_time, report_yn, report_opt, toss_dt
         , mg_report_yn, mg_report, mda_cmms_rt, mda_cmms_amt, op_yn, asg_use_yn, bns_yn, bigo, entr_prsn, entr_dt, bf_cont_mda_seq
        )
        select 
          b.cont_seq
        , a.mda_comp_seq
        , a.prod_seq
        , a.account_cnt
        , a.equip_cnt
        , a.guarant_pos
        , a.multi_yn
        , a.mtrl_sec
        , b.cont_st_dt st_dt 
        , b.cont_ed_dt ed_dt 
        , a.act_st_time
        , a.act_ed_time
        , '{$jsonInput['c_report_yn']}' report_yn 
        , a.report_opt
        , replace('{$jsonInput['c_toss_dt']}', '-','')  toss_dt
        , '{$jsonInput['c_mg_report_yn']}' mg_report_yn
        , replace('{$jsonInput['c_mg_report']}', '-','') mg_report 
        , a.mda_cmms_rt
        , a.mda_cmms_amt
        , a.op_yn
        , a.asg_use_yn
        , a.bns_yn
        , a.bigo
        , '{$member['mb_no']}'  entr_prsn
        , now()  entr_dt 
        , a.cont_mda_seq 
        from  tb_cont_mda a, tb_cont b 
        where a.cont_seq = {$cont_seq }  
          and a.cont_seq = b.bf_cont_seq 
          and b.cont_seq = {$new_cont_seq} 
    " ;
    $result = sql_query($sql2 );

    //소재
    $sql3="
         insert into tb_cont_mtrl
         ( cont_mda_seq, mtrl_seq, bigo, st_dt, ed_dt, entr_prsn, entr_dt )
        select   
          c.cont_mda_seq
        , a.mtrl_seq
        , a.bigo
        , c.st_dt
        , c.ed_dt
        , '{$member['mb_no']}' entr_prsn
        , now() entr_dt
        From tb_cont_mtrl  a, tb_cont_mda b, tb_cont_mda c 
        where a.cont_mda_seq = b.cont_mda_seq 
           and a.cont_mda_seq = c.bf_cont_mda_seq
           and b.cont_seq = {$cont_seq }  
           and c.cont_seq ={$new_cont_seq} 
    " ;
   $result = sql_query($sql3 );

   $sql4="
    insert into tb_cont_excpt
     ( cont_mda_seq, comp_seq, entr_prsn, entr_dt )
   select
       c.cont_mda_seq
       , a.comp_seq
       , '{$member['mb_no']}' entr_prsn
       , now() entr_dt
    From tb_cont_excpt  a, tb_cont_mda b, tb_cont_mda c 
    where a.cont_mda_seq = b.cont_mda_seq
    and a.cont_mda_seq = c.bf_cont_mda_seq
    and b.cont_seq = {$cont_seq }   
    and c.cont_seq = {$new_cont_seq} 
   ";
  $result = sql_query($sql4 );

   $value = array('cont_seq'=>$new_cont_seq);
   echo json_encode($value);
?>