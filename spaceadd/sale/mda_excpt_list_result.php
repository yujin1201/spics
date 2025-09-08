<?php
include_once('./_common.php');

$sql = "SELECT comp_seq, item_code
     ,(select comm_cd_nm from tb_code where comm_cd = a.item_code) item_nm
     , use_yn, bigo, entr_prsn, entr_dt, updt_prsn, updt_dt FROM tb_comp_excpt a where del_yn='N' AND comp_seq = {$_GET['comp_seq']} ";

$result = sql_query($sql); //질의.

$num2 = 1;
$rows2 = array();

while($row = sql_fetch_array($result)) {
    $rows2[] = $row;
}
$output = json_encode($rows2,JSON_UNESCAPED_UNICODE);

echo $output;
?>


