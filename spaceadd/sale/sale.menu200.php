<?php
$menu['menu200'] = array (
    array('200000', '계약관리', G5_SALE_URL.'/cont_list.php', 'config')
);
if($member['mb_level']  != 4 ){
    array_push($menu['menu200'],array('200110', '계약 등록', G5_SALE_URL.'/cont_form.php',   'cf_basic'));
}

if($member['mb_level'] > 1){
    array_push($menu['menu200'],array('200100', '계약 목록', G5_SALE_URL.'/cont_list.php',   'cf_basic'));
    array_push($menu['menu200'],array('200120', '계약 상품 목록', G5_SALE_URL.'/cont_mda_list.php',   'cf_basic'));
    array_push($menu['menu200'],array('200131', '계약상품 운행달력', G5_SALE_URL.'/cont_mda_list02.php',   'cf_basic'));
}
if($member['mb_level'] > 7){
    array_push($menu['menu200'],array('200140', '담당자 일괄변경', G5_SALE_URL.'/cont/cont_change_salePrsn.php',   'cf_basic'));
}
if($member['mb_level'] > 9){
    array_push($menu['menu200'],array('200130', '계약상품 운행', G5_SALE_URL.'/cont_mda_list01.php',   'cf_basic'));
}
