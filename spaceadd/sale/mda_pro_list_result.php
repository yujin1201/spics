<?php
include_once('./_common.php');

$sql = "SELECT a.prod_seq
     , a.comp_seq
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
     , rent_adj_type_code, rent_adj_day, rent_amt, ad_adj_type_code, ad_adj_day, ad_amt, ad_rt
     , b.mda_own_yn
     , b.full_nm FROM tb_comp_mda a , vi_media b 
where a.mda_seq = b.mda_seq AND a.del_yn='N'
     AND comp_seq = {$_GET['comp_seq']} ";

$result = sql_query($sql); //질의.

$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>


