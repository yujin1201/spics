<?php
include_once('./_common.php');

$sql = "select  
      a.comm_seq 
    , a.comm_cd 
    , a.comm_cd_nm  
    , b.cont_mdatype_seq 
    , {$_GET['cont_seq']}  cont_seq 
    , b.mda_type_code  
    , ifnull(b.mda_type_code ,  a.comm_cd  )   mda_type_code 
    , ifnull(b.mda_amt ,0 )  mda_amt 
    , ifnull(b.mda_cmms_amt ,0 )  mda_cmms_amt
    , ifnull(b.mda_cost ,0 )  mda_cost
    , b.bigo
from tb_code  a   
  left outer join  tb_cont_mdatype b  on  a.comm_cd = b.mda_type_code  and b.cont_seq = {$_GET['cont_seq']}   
where a.comm_type_cd ='AAB'
  and ( a.use_yn ='Y' or b.cont_seq is not null ) 
  and a.up_comm_seq is not null 
 order by a.ord  
    ";
$result = sql_query_json($sql); //질의.
echo $result ;
?>


