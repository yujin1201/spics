<?php
include_once('./_common.php');


$sql = "   SELECT 
      a.bld_seq
     , a.bld_num
     , a.bld_nm
     , a.zipcode
     , a.addr1
     , a.addr2
     , a.addr3
     , a.bld_type
     , a.bld_level
     , a.bld_floor
     , a.bld_ev1
     , a.bld_ev2
     , a.area1
     , a.area2
     , a.bld_pkg
     , a.ds_type
     , a.ds_ev1
     , a.ds_ev2
     , a.ds_ev3
     , a.ds_ev4
     , a.disable_cnt
     , a.ins_cnt
     , a.ins_sec
     , a.use_st_dt
     , a.use_ed_dt
     , a.excpt_item
     , a.bigo
     , a.use_yn
     , a.del_yn
     , a.entr_prsn
     , a.entr_dt
     , a.updt_prsn
     , a.updt_dt
     , FN_MB_NM(a.entr_prsn) as entr_prsn
     , FN_MB_NM(a.updt_prsn) as updt_prsn
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_type and comm_type_cd ='BBA'), '')  bld_type_nm   
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_pkg and comm_type_cd ='BBF'), '')  bld_pkg_nm   
    , b.cont_bld_seq, b.mtrl_sec, b.st_dt, b.ed_dt
  FROM tb_bld a ,  tb_cont_bld b 
  where a.DEL_YN='N' 
      and b.DEL_YN='N'  
      and b.cont_seq ={$_GET['cont_seq']}  
    and a.bld_seq = b.bld_seq 
 order by b.st_dt desc, b.ed_dt desc, a.bld_seq , b.cont_bld_seq   ";
$result = sql_query_json($sql); //질의.

echo $result ;
?>


