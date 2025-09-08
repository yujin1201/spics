<?php

include_once('./_common.php');


    //최초 입력시 사업자 번호 중복 체크
    $sql = "select  count(*) as cnt   from tb_comp where del_yn='N' and comp_type = '{$_GET['comp_type']}'
            and replace( busi_no,'-','') = replace( '{$_GET['busi_no']}','-','') " ;
    if($_GET['comp_seq'] != '') $sql .= " AND comp_seq != '{$_GET['comp_seq']}'";
    $comp= sql_fetch($sql);

    echo $comp['cnt'];

?>
