<?php
include_once('./_common.php');

$sql = " 
     SELECT
    mda_seq,
    mda_nm,
    mda_div,
    mda_own_yn  ,
    ifnull((select comm_cd_nm from tb_code where comm_cd = a.mda_div and comm_type_cd ='AAA'), '') mda_div_nm ,
    mda_type,
    mda_prod,
    mda_poi,
    ord,
    use_yn,
    show_yn ,
    bigo,
    up_mda_seq,
    entr_prsn,
    entr_dt,
    updt_prsn,
    updt_dt,
    last_yn,
    depth ,
    mda_seq org_mda_seq
FROM tb_media a
order by   ord  ";
$result = sql_query_json($sql); //질의.
echo $result ;
?>


