<?php
include_once('./_common.php');

$sql = "SELECT a.prod_seq
     , a.comp_seq
     ,FN_COMP_NM(a.comp_seq) as comp_nm
     , a.mda_seq
     , (select mda_nm from tb_media where mda_seq = a.mda_seq) as mda_seq_nm 
     , a.mda_nm
     , a.mda_cnt
     , a.use_yn
     , date_format(a.use_st_dt,'%Y-%m-%d') as use_st_dt
     , date_format(a.use_ed_dt,'%Y-%m-%d') as use_ed_dt
     , a.use_st_time
     , a.use_ed_time
     , a.bigo
     , a.entr_prsn
     , a.entr_dt
     , a.updt_prsn
     , a.updt_dt
     , ad_adj_type_code
     , FN_CODE_NM(rent_adj_type_code) as rent_adj_type_nm
     , rent_adj_day
     , FN_CODE_NM(rent_adj_day) as rent_adj_day_nm
     , rent_amt
     , ad_adj_type_code
     ,  FN_CODE_NM(ad_adj_type_code) as ad_adj_type_nm 
     , ad_adj_day
     , FN_CODE_NM(ad_adj_day) as ad_adj_day_nm 
     , ad_amt
     , ad_rt
     , b.full_nm
    , b.m1_nm 
    , b.m2_nm 
    , b.m3_nm
    , b.m4_nm 
FROM tb_comp_mda a , vi_media b , tb_comp c
where a.mda_seq = b.mda_seq AND c.comp_seq = a.comp_seq AND a.del_yn='N' AND c.del_yn='N'
      ";

if(isset($_GET['search_str']) &&  $_GET['search_str'] != ''){
    if($_GET['sfl'] == 'comp_nm'){
        $sql .= "and comp_nm like '%{$_GET['search_str']}%'";
    }else if($_GET['sfl'] == 'mda_nm'){
        $sql .= "and a.mda_nm like '%{$_GET['search_str']}%'";
    }else if($_GET['sfl'] == 'all'){
        
        $sql .= "and ( a.mda_nm like '%{$_GET['search_str']}%' or comp_nm like '%{$_GET['search_str']}%')";
    }
}

if($_GET['sfl2'] == 's_type'){
    $sql .= " and m1 ='53'";
}else if($_GET['sfl2'] == 'd_type'){
    $sql .= "and m1 ='55'";
}
$sql .=" order by prod_seq desc ";

$result = sql_query($sql); //질의.

$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>


