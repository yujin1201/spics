<?php
include_once('./_common.php');

$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$sql_where = "" ;
if(isset($jsonInput['comp_seq']) &&  $jsonInput['comp_seq'] != ''){
    $sql_where = " and a.comp_seq  = '{$jsonInput['comp_seq']}' ";
}


$sql_cont = ""  ;
 if(isset($jsonInput['cli_seq']) &&  $jsonInput['cli_seq'] != ''){
     $sql_cont .= " and g.cli_seq  = '{$jsonInput['cli_seq']}' ";
}
if(isset($jsonInput['sch_name']) &&  $jsonInput['sch_name'] != ''){
    $sql_cont .= " and g.cont_nm like '%{$jsonInput['sch_name']}%'";
}

$sql = "
SELECT  a.comp_seq
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
    , ifnull(e.cont_mda_seq,'') cont_mda_seq
    , ifnull(e.cont_nm,'') cont_nm
    , ifnull(e.cli_nm , '')  cli_nm  
    , ifnull( ( case when  e.cli_nm  is null  then '' else concat( e.cli_nm , '(', date_format( e.st_dt ,'%Y-%m-%d') ,' ~ ', date_format( e.ed_dt , '%Y-%m-%d')  , ')')  end  ) ,'') label
    , greatest(ifnull(date_format(ifnull(e.st_dt , '{$jsonInput['fr_date']}' ),'%Y-%m-%d'),'') , date_format( '{$jsonInput['fr_date']}','%Y-%m-%d') )  dateStart
    , ifnull(date_format(ifnull(e.ed_dt , '{$jsonInput['fr_date']}'), '%Y-%m-%d') ,'') dateEnd
    , date_format(e.st_dt,'%Y-%m-%d')  st_dt
    ,date_format(e.ed_dt,'%Y-%m-%d')  ed_dt
    , c.asg_seq  class 
    ,CASE @GROUPING WHEN a.comp_seq  THEN @RANK := @RANK + 1 ELSE @RANK :=0  END AS comp_rank
    ,@GROUPING := a.comp_seq    
    ,CASE @GROUPING1 WHEN b.prod_seq  THEN @RANK1 := @RANK1 + 1 ELSE @RANK1 := 1  END AS mda_rank
    ,@GROUPING1 := b.prod_seq
    ,CASE @GROUPING2 WHEN c.asg_seq  THEN @RANK2 := @RANK2 + 1 ELSE @RANK2 := 0  END AS asg_rank
    ,@GROUPING2 := c.asg_seq 
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
        where    e.ed_dt  >=  date_format( '{$jsonInput['fr_date']}'   ,'%Y%m%d') 
            and  e.st_dt <= date_format( '{$jsonInput['to_date']}'  ,'%Y%m%d')   
      ) e on c.asg_seq = e.asg_seq     
    , (SELECT @GROUPING :=  ''  , @RANK := 0) X0    
    , (SELECT @GROUPING1 :=  ''  , @RANK1 := 1) X1
    , (SELECT @GROUPING2 := '', @RANK2 := 0) X2      
where ifnull(a.del_yn, 'N')  = 'N'
   and b.use_yn  ='Y'
   and c.use_yn  ='Y' 
  {$sql_where}
  /*
   and exists ( select '1' from tb_media x where b.mda_seq = x.mda_seq  and x.mda_div='AAA02')
   and a.comp_type ='AAC02' 
   and a.deal_sts_code ='BAA01'     
   */
 order by a.comp_nm,  b.prod_seq,  b.mda_seq , c.ord , e.st_dt , e.ed_dt ";

$result = sql_query_json($sql); //질의.
$value = array('segList'=>$result);

//$value = array('compList'=>$result1, 'mdaList'=>$result2, 'asgList'=>$result);
echo json_encode($value);
?>
