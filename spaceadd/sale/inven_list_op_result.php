<?php
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$sql_where = "" ;
if(isset($jsonInput['comp_seq']) &&  $jsonInput['comp_seq'] != ''){
    $sql_where = " and a.comp_seq  = '{$jsonInput['comp_seq']}' ";
}

//compList
$sql =  "
SELECT 
distinct
       a.comp_seq
     , a.comp_nm mda_comp_nm
     , a.comp_type
     , a.mda_type  
     , ifnull(date_format( '{$jsonInput['fr_date']}01'   ,'%Y-%m-%d') ,'') dateStart
     , ifnull(date_format( '{$jsonInput['fr_date']}01' , '%Y-%m-%d')  ,'') dateEnd 
     , '' mda_nm
     , '' asg_num
     , '' cli_nm 
     , '' st_dt
     ,  '' ed_dt 
     , '' label
FROM
    tb_comp  a 
     inner join  tb_comp_mda b  on  a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' and ifnull(b.use_yn, 'Y')  ='Y'   
     inner join  tb_mda_assign c  on   b.prod_seq = c.prod_seq  and ifnull(c.use_yn, 'Y')  ='Y'  
where ifnull(a.del_yn, 'N')  = 'N'  
   and a.comp_type ='AAC02'
   and a.deal_sts_code ='BAA01'  
   and b.use_yn  ='Y'
   and c.use_yn  ='Y' 
   and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='AAA02') 
   {$sql_where}  "  ;
$result1 = sql_query_json($sql); //질의.


$sql = "
SELECT 
     distinct 
       a.comp_seq
     , a.comp_nm mda_comp_nm
     , a.comp_type
     , a.mda_type 
     , b.prod_seq 
     , b.mda_seq
     , b.mda_nm
     , b.mda_cnt
     , b.use_yn  
     , d.mda_nm
     , d.m1
     , ifnull(d.m2, '') m2
     , ifnull(d.m3, '') m3
     , ifnull(d.m4, '') m4
     , ifnull(d.m5, '') m5
     , ifnull(d.m1_nm, '') m1_nm
     , ifnull(d.m2_nm, '') m2_nm
     , ifnull(d.m3_nm, '') m3_nm
     , ifnull(d.m4_nm, '') m4_nm
     , ifnull(d.m5_nm, '') m5_nm
     , d.up_mda_seq
     , d.dep
     , d.full_nm 
     , '' asg_num
     , '' cli_nm              
     , date_format( '{$jsonInput['fr_date']}01'   ,'%Y-%m-%d')  dateStart
     , date_format( '{$jsonInput['fr_date']}01'   , '%Y-%m-%d') dateEnd    
     , '' st_dt
     ,  '' ed_dt 
     , '' label
FROM
    tb_comp  a
    inner join  tb_comp_mda b  on  a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' and ifnull(b.use_yn, 'Y')  ='Y'   
    inner join  tb_mda_assign c  on   b.prod_seq = c.prod_seq  and ifnull(c.use_yn, 'Y')  ='Y'  
    inner join  vi_media d   on  b.mda_seq = d.mda_seq  
where ifnull(a.del_yn, 'N')  = 'N'  
   and a.comp_type ='AAC02'
   and a.deal_sts_code ='BAA01'  
   and b.use_yn  ='Y'
   and c.use_yn  ='Y'
   and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='AAA02') 
   {$sql_where} 
";
$result2 = sql_query_json($sql);

$sql_cont = ""  ;
 if(isset($jsonInput['cli_seq']) &&  $jsonInput['cli_seq'] != ''){
     $sql_cont .= " and g.cli_seq  = '{$jsonInput['cli_seq']}' ";
}
if(isset($jsonInput['sch_name']) &&  $jsonInput['sch_name'] != ''){
    $sql_cont .= " and g.cont_nm like '%{$jsonInput['sch_name']}%'";
}

$sql = "
SELECT  
       a.comp_seq
     , a.comp_nm mda_comp_nm
     , a.comp_type
     , a.mda_type 
     , b.prod_seq 
     , b.mda_seq
     , b.mda_nm
     , b.mda_cnt
     , b.use_yn 
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
    , ifnull( ( case when  e.cli_nm  is null  then '' else concat( e.cli_nm , '(', date_format( e.st_dt ,'%Y-%m-%d') ,' ~ ', date_format( e.ed_dt , '%Y-%m-%d')  , ')')  end  ) ,'') label
    , ifnull(date_format(ifnull(e.st_dt , '{$jsonInput['fr_date']}01'    ),'%Y-%m-%d'),'') dateStart
    , ifnull(date_format(ifnull(e.ed_dt , '{$jsonInput['fr_date']}01'   ), '%Y-%m-%d') ,'') dateEnd
    , c.asg_seq  class     
FROM
    tb_comp  a
    inner join  tb_comp_mda b  on  a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' and ifnull(b.use_yn, 'Y')  ='Y'    
    inner join  tb_mda_assign c  on   b.prod_seq = c.prod_seq  and ifnull(c.use_yn, 'Y')  ='Y'  
    inner join  vi_media d   on  b.mda_seq = d.mda_seq 
    left  join   (
        select  e.asg_seq, e.cont_asg_seq , e.st_dt, e.ed_dt  , e.act_st_time , e.act_ed_time, f.cont_mda_seq , g.cont_nm ,  ifnull(h.comp_nm , '-')  cli_nm
        from tb_cont_mda_assign e
            inner  join tb_cont_mda f on e.cont_mda_seq = f.cont_mda_seq  and f.op_yn='Y'
            inner  join tb_cont  g on f.cont_seq = g.cont_seq  {$sql_cont}
            inner join tb_comp  h on  g.cli_seq= h.comp_seq  
        where   exists ( select '1' 
                          from tb_date x 
                          where substr(x.dt,1,6)  between '{$jsonInput['fr_date']}' and '{$jsonInput['to_date']}' 
                              and x.dt between e.st_dt and e.ed_dt )       
          
      ) e on c.asg_seq = e.asg_seq     
where ifnull(a.del_yn, 'N')  = 'N'  
   and a.comp_type ='AAC02' 
   and a.deal_sts_code ='BAA01'  
   and b.use_yn  ='Y'
   and c.use_yn  ='Y'
   and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='AAA02') 
  {$sql_where}  
order by   a.comp_nm, b.mda_seq , c.ord  ";
$result = sql_query_json($sql); //질의.

$value = array('compList'=>$result1, 'mdaList'=>$result2, 'asgList'=>$result);
echo json_encode($value);
?>
