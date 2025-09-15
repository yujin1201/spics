<?php
include_once('./_common.php');

$bld_pkg_options =""  ;
for($i=0; $i< $_GET['bld_pkg_size'] ; $i++){
    if (isset($_GET['bld_pkg_'.$i]) && $_GET['bld_pkg_'.$i] != ""  ) {
        $bld_pkg_options = $bld_pkg_options . " , '{$_GET['bld_pkg_'.$i]}' ";
    }
}
if($bld_pkg_options != "") $bld_pkg_options = "and a.bld_pkg  in ( '' {$bld_pkg_options} ) " ;


$sql = " SELECT 
     bld_seq
    , bld_num
    , bld_nm
    , zipcode
    , addr1
    , addr2
    , addr3
    , bld_type
    , bld_level
    , bld_floor
    , bld_ev1
    , bld_ev2
    , area1
    , area2
    , bld_pkg
    , ds_type
    , ds_ev1
    , ds_ev2
    , ds_ev3
    , ds_ev4
    , disable_cnt
    , ins_cnt
    , ins_sec
    , use_st_dt
    , use_ed_dt
    , excpt_item
    , bigo
    , use_yn
    , del_yn
    , entr_prsn
    , entr_dt
    , updt_prsn
    , updt_dt
    ,FN_MB_NM(entr_prsn) as entr_prsn
    ,FN_MB_NM(updt_prsn) as updt_prsn 
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_type and comm_type_cd ='BBA'), '')  bld_type_nm   
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_pkg and comm_type_cd ='BBF'), '')  bld_pkg_nm   
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_level and comm_type_cd ='BBB'), '')  bld_level_nm  
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.area1 and comm_type_cd ='BBC'), '')  area1_nm  
    , a.bld_mda_type
    , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_mda_type and comm_type_cd ='BBK'), '')  bld_mda_type_nm   
 
  FROM tb_bld a
  where 1=1 AND DEL_YN='N' ";

if (isset($_GET['idx']) && $_GET['idx'] > 0) {
    $sql .= "and bld_seq = '{$_GET['idx']}'";
}
if (isset($_GET['bld_mda_type'])  && $_GET['bld_mda_type'] != ""   ) {
    $sql .= "and bld_mda_type = '{$_GET['bld_mda_type']}'";
}
if (isset($_GET['bld_pkg'])  && $_GET['bld_pkg'] != ""   ) {
    $sql .= "and bld_pkg = '{$_GET['bld_pkg']}'";
}
if (isset($_GET['excpt_str'])  && $_GET['excpt_str'] != ""   ) {
    if (isset($_GET['excpt_opt'])  && $_GET['excpt_opt'] != ""   ) {
        if (  $_GET['excpt_opt'] =="Y"  ) {
            $sql .= "and (( excpt_item  not like '%{$_GET['excpt_str']}%' or excpt_item is null ) and  ( bigo not  like '%{$_GET['excpt_str']}%'   or bigo is null) ) ";
        }else{
            $sql .= "and ( excpt_item  like '%{$_GET['excpt_str']}%'  or bigo  like '%{$_GET['excpt_str']}%'  ) ";
        }
    }else{
        $sql .=  "and (( excpt_item  not like '%{$_GET['excpt_str']}%' or excpt_item is null ) and  ( bigo not  like '%{$_GET['excpt_str']}%'   or bigo is null) ) ";
    }
}
$sql .= $bld_pkg_options   ;

if (isset($_GET['search_str']) && $_GET['search_str'] != ""  ) {
    if($_GET['sfl'] == 'sch_all'){
        $sql .= "and ( bld_nm like '%{$_GET['search_str']}%' or addr1 like '%{$_GET['search_str']}%' ) ";
    }else{
        $sql .= "and {$_GET['sfl']}  like '%{$_GET['search_str']}%' ";
    }
}
$sql .= " order by bld_seq  desc  ,bld_nm desc ";

$result = sql_query_json($sql); //질의. 
echo $result ;
?>


