<?php
include_once('./_common.php');


$sql = "select  
      a.comm_seq 
    , a.comm_cd 
    , a.comm_cd_nm  
    , b.mdatype_seq 
    , ifnull(b.yearmon ,  '{$_GET['yearmon']}'  )  yearmon
    , ifnull(b.mda_type_code ,  a.comm_cd  )   mda_type_code 
    , ifnull(b.mda_cnt ,0 )  mda_cnt
    , ifnull(b.mda_unitprc ,0 )  mda_unitprc 
    , b.bigo
from tb_code  a   
  left outer join   tb_mdatype_stock b  on  a.comm_cd = b.mda_type_code  and b.yearmon = '{$_GET['yearmon']}' 
where a.comm_type_cd ='AAB'
  and   a.use_yn ='Y'  
  and a.up_comm_seq is not null 
 order by a.ord  
    ";
$result = sql_query_json($sql); //질의.
echo $result ;
?>

