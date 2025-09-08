<?php
$menu['menu400'] = array (
    array('400000', '운행/재원 관리', G5_SALE_URL.'#', 'board'),
    array('400300', 'DS 운행 현황', G5_SALE_URL.'/inven_list_dsop.php',   'cf_basic'),
    array('400310', 'DS 재원 현황', G5_SALE_URL.'/inven_list_ds.php',   'cf_basic'),
    array('400320', '인쇄매체 재원 현황', G5_SALE_URL.'/inven_list_mda.php',   'cf_basic') ,
    array('400330', '패키지 운행 현황', G5_SALE_URL.'/inven_list_opsa.php',   'cf_basic')
);

if($member['mb_level'] > 9){
    array_push($menu['menu400'], array('400400', 'DS 운행 현황', G5_SALE_URL.'/inven_list_op.php',     'cf_basic', 1));
}

