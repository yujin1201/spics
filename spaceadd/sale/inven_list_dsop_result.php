<?php
include_once('./_common.php');

$sql_where = "" ;
if(isset($_GET['comp_seq']) &&  $_GET['comp_seq'] != ''){
    $sql_where = " and a.comp_seq  = '{$_GET['comp_seq']}' ";
}
if(isset($_GET['comp_nm']) &&  $_GET['comp_nm'] != ''){
    $sql_where .= " and a.comp_nm  like  '%{$_GET['comp_nm']}%'";
}

$sql_cont = ""  ;
 if(isset($_GET['cli_seq']) &&  $_GET['cli_seq'] != ''){
     $sql_cont .= " and g.cli_seq  = '{$_GET['cli_seq']}' ";
}
if(isset($_GET['sch_name']) &&  $_GET['sch_name'] != ''){
    $sql_cont .= " and g.cont_nm like '%{$_GET['sch_name']}%'";
}

if(isset($_GET['cont_stat']) &&  $_GET['cont_stat'] != ''){
    if($_GET['cont_stat'] == 'BAC99' ){
        $sql_cont .= " and g.cont_stat   in  ('BAC03','BAC04','BAC05') "  ;
        $sql_where.= " and e.cont_stat   in  ('BAC03','BAC04','BAC05') "  ;
    }else{
        $sql_cont .= " and g.cont_stat  = '{$_GET['cont_stat']}'";
        $sql_where.= " and e.cont_stat  = '{$_GET['cont_stat']}'";
    }
}

$sql = "
SELECT  
          a.comp_seq
     , a.comp_nm mda_comp_nm
     , a.comp_type
     , a.mda_type 
     , b.prod_seq  
     , b.mda_cnt
     , b.mda_nm prod_nm
     , b.use_yn  
     ,b.asg_use_yn 
     , c.asg_seq 
     , c.asg_num
     , c.ord  
    , ifnull(e.cont_asg_seq ,'')  cont_asg_seq
    , ifnull(date_format( e.st_dt ,'%Y-%m-%d'),'') st_dt
    , ifnull(date_format( e.ed_dt , '%Y-%m-%d') ,'') ed_dt
    , ifnull(e.act_st_time,'') act_st_time
    , ifnull(e.act_ed_time ,'') act_ed_time
    , ifnull(e.cont_mda_seq,'') cont_mda_seq
    , ifnull(e.cont_nm,'') cont_nm
    , ifnull(e.cli_nm , '')  cli_nm    
    , ifnull(e.mtrl_sec , '') mtrl_sec
     ,ifnull(e.account_cnt , '') account_cnt
     , e.equip_cnt
     , e.guarant_pos
     , ifnull(e.multi_yn , '') multi_yn
     , ifnull(e.cont_seq , '') cont_seq  
     , e.cont_stat
     , ifnull((select comm_cd_nm from tb_code where comm_cd = e.cont_stat and comm_type_cd ='BAC'), '')  cont_stat_nm   
     ,  ifnull(( select group_concat(t.mtrl_nm ) from tb_cont_mtrl s, tb_mtrl t where e.cont_mda_seq = s.cont_mda_seq and s.mtrl_seq = t.mtrl_seq  ), '')  mtrl_nm  
     , d.* 
FROM
    tb_comp  a
    inner join  tb_comp_mda b  on  a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' and ifnull(b.use_yn, 'Y')  ='Y'  
    inner join  tb_mda_assign c  on   b.prod_seq = c.prod_seq  and ifnull(c.use_yn, 'Y')  ='Y'  
    inner join  vi_media d   on  b.mda_seq = d.mda_seq and d.mda_own_yn='Y'
    left  join   (
        select  e.asg_seq, e.cont_asg_seq , e.st_dt, e.ed_dt  , e.act_st_time , e.act_ed_time, f.cont_mda_seq , g.cont_nm ,  ifnull(h.comp_nm , '-')  cli_nm     
              , f.mtrl_sec , f.account_cnt, f.equip_cnt, f.guarant_pos, f.multi_yn, g.cont_seq, g.cont_stat 
        from tb_cont_mda_assign e
            inner  join tb_cont_mda f on e.cont_mda_seq = f.cont_mda_seq  and f.op_yn='Y'
            inner  join tb_cont  g on f.cont_seq = g.cont_seq  {$sql_cont}
            inner join tb_comp  h on  g.cli_seq= h.comp_seq   
        where   
                e.st_dt between '{$_GET['fr_date']}'  and '{$_GET['to_date']}' 
            or  e.ed_dt between '{$_GET['fr_date']}'  and '{$_GET['to_date']}' 
            and ( e.st_dt < '{$_GET['fr_date']}' or  e.ed_dt > '{$_GET['to_date']}'  )  
          
      ) e on c.asg_seq = e.asg_seq     
where ifnull(a.del_yn, 'N')  = 'N'  
   and a.comp_type ='AAC02' 
   and a.deal_sts_code ='BAA01'  
   and b.use_yn  ='Y'
   and c.use_yn  ='Y'
   and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='AAA02') 
  {$sql_where}  
order by  d.m1, d.m2, d.m3, a.comp_nm, b.mda_seq , c.ord ";


$result = sql_query_json($sql); //질의.
echo $result ;

?>
