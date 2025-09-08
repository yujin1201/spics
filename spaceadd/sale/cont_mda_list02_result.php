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
SELECT a.*
      , concat('id', cont_mda_seq ) id 
      , concat( st_dt_str , '-', cli_nm, '-', cont_nm, '-',cont_stat_nm , '-' , mda_comp_nm , '-' , cont_mda_seq, '-', a.st_dt ,'~',a.ed_dt, '-',@rownum) subject 
      , date_format(str_to_date(  concat(  a.mda_dt,  '0100')  , '%Y%m%d%H%i%s'), '%Y-%m-%d %H:%i' )    stdttm  
      , date_format(str_to_date(  concat(  a.mda_dt,  '2359')  , '%Y%m%d%H%i%s'), '%Y-%m-%d %H:%i' )   eddttm    
      , @rownum:=@rownum+1 rnum 
      , true  allDay 
From ( 
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
        ifnull(( select comm_cd_nm from tb_code where comm_cd = a.report_opt  and comm_type_cd ='BAF' ), '')  report_opt_nm  ,    
        ifnull(( select group_concat(t.mtrl_nm ) from tb_cont_mtrl s, tb_mtrl t where a.cont_mda_seq = s.cont_mda_seq and s.mtrl_seq = t.mtrl_seq  ), '')  mtrl_nm  
        , case when date_format(now(), '%Y%m%d' ) >= a.st_dt then 'Y' else 'N' end opdt_yn ,
        b.cont_nm,
        b.cont_type_code,
        b.mda_type,
        b.cont_yearmon,
        b.cont_stat,
        ifnull((select comm_cd_nm from tb_code where comm_cd = b.cont_stat and comm_type_cd ='BAC'), '')  cont_stat_nm , 
        ifnull((select comp_nm from tb_comp where comp_seq = b.cli_seq), '')  cli_nm , 
        ifnull((select comp_nm from tb_comp where comp_seq = b.agncy_seq), '')  agncy_nm , 
        ifnull((select comp_nm from tb_comp where comp_seq = b.rep_seq), '')  rep_nm , 
        ifnull((select mb_name from g5_member where mb_no = b.sale_prsn) , '')  sale_prsn_nm ,
        b.cont_st_dt,
        b.cont_ed_dt,
        b.cont_amt, 
        ifnull((select sum(sell_amt) from tb_cont_fin where b.cont_seq = cont_seq),0) tot_sell_amt  
        , c.mda_nm 
        , c.comp_seq mda_comp_seq
        , ifnull((select comp_nm from tb_comp where comp_seq = c.comp_seq ), '')  mda_comp_nm 
        , case when a.st_dt between {$sdate} and {$edate} then 'Y' else 'N' end st_dt_yn
        , case when a.st_dt between {$sdate} and {$edate} then  '[시작]' else '[종료]'  end st_dt_str
        , case when a.st_dt between {$sdate} and {$edate} then  a.st_dt else a.ed_dt  end mda_dt        
       
     FROM 
       tb_cont_mda a,  tb_cont b , tb_comp_mda c 
     where a.cont_seq = b.cont_seq  
       and a.prod_seq = c.prod_seq 
        
       and a.op_yn ='Y' 
         and ( 
                 a.st_dt between {$sdate} and {$edate}   
             or  a.ed_dt    between {$sdate} and {$edate}
             )
    ";


    if(isset($_GET['comp_seq']) &&  $_GET['comp_seq'] != ''){
        $sql .= " and c.comp_seq =  {$_GET['comp_seq']}  ";
    }

    if(isset($_GET['mda_seq']) &&  $_GET['mda_seq'] != ''){
        $sql .= " and  (  c.mda_seq  =  {$_GET['mda_seq']}   or  exists  ( select  1  from   vi_media where   m2 =  {$_GET['mda_seq']}  and m3 = c.mda_seq  )  )   ";
    }
    $sql .=  makeSearchContQuery('b')   ;
    
    if(isset($_GET['sch_mda_name']) &&  $_GET['sch_mda_name'] != ''){
       $sql .= " and c.mda_nm   like  '%{$_GET['sch_mda_name']}%'";
    }


    //송출제외, 영업이하는 본인 계약만 조회
    if( $member['mb_level'] <=  6  &&  $member['mb_level'] !=4  ){
        $sql .= " and b.sale_prsn =  {$member['id']} ";
    }
    $sql .= "  order by   a.st_dt, b.cont_seq desc ,  a.cont_mda_seq desc  
 ) a ,(SELECT @rownum:=0) TMP
 order by a.mda_dt , a.cont_mda_seq desc  
 ";

$result = sql_query_json($sql); //질의.
echo $result ;

?>
