<?php
include_once('./_common.php');

$sql = "SELECT file_seq, comp_seq, file_source, file_save, file_download, file_content, file_url, file_thumburl, file_storage, round((file_size / 1000000),2) as file_size, file_width, file_height, file_type, entr_prsn, updt_prsn, updt_dt, entr_dt
         FROM tb_comp_file
        where  comp_seq  = {$_GET['comp_seq']} AND del_yn='N' 
        order by file_seq desc 
    ";

$result = sql_query_json($sql); //질의.
echo $result ;
?>


