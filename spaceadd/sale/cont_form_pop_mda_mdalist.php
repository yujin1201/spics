<?php
include_once('./_common.php');
$jsonInput  = json_decode(stripslashes(file_get_contents('php://input')),  true );

$sql ="select  b.prod_seq
            , b.comp_seq
            , b.mda_seq
            , b.mda_nm
            , b.mda_cnt 
            , b.use_st_dt
            , b.use_ed_dt
            , b.use_st_time
            , b.use_ed_time 
            , b.asg_use_yn
            , b.mda_position
            , ifnull(b.mda_amt, 0 ) mda_amt
            , ifnull(b.ins_cnt, 0) ins_cnt
            , c.m1_nm
            , c.m1
            ,c.full_nm
            , a.comp_nm 
            ,ifnull(( select group_concat(t.comm_cd_nm) from tb_comp_excpt s, tb_code t where a.comp_seq = s.comp_seq and s.item_code = t.comm_cd  and s.use_yn ='Y' and s.del_yn ='N' ), '')  excpt_nm
        from tb_comp a, tb_comp_mda b, vi_media c
        where a.comp_seq = b.comp_seq
           and b.mda_seq = c.mda_seq
           and b.del_yn ='N'
           and a.del_yn ='N'
           and b.use_yn ='Y'     
           and a.deal_sts_code ='BAA01'
"   ;

if(isset($jsonInput['comp_seq']) &&  $jsonInput['comp_seq'] != ''){
    $sql .= " and a.comp_seq  ='{$jsonInput['comp_seq']}'";
}
if(isset($_GET['comp_seq']) &&  $_GET['comp_seq'] != ''){
    $sql .= " and a.comp_seq  ='{$_GET['comp_seq']}'";
}
if(isset($_GET['mda_seq']) &&  $_GET['mda_seq'] != ''){
    $sql .= " and b.mda_seq  ='{$_GET['mda_seq']}'";
}

if(isset($_GET['mda1']) &&  $_GET['mda1'] != ''){
    $sql .= " and c.m1 ='{$_GET['mda1']}'";
}

if(isset($_GET['mda2']) &&  $_GET['mda2'] != ''){
    $sql .= " and c.m2 ='{$_GET['mda2']}'";
}
if(isset($_GET['mda3']) &&  $_GET['mda3'] != ''){
    $sql .= " and c.m3 ='{$_GET['mda3']}'";
} 

$result = sql_query_json($sql); //질의.
echo $result ;
?>