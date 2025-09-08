<?php
$menu['menu100'] = array (
    array('100000', '등록/관리', G5_SALE_URL.'#',   'config')
);

if($member['mb_level'] > 7){
    array_push($menu['menu100'],array('100310', '광고주 등록', G5_SALE_URL.'/comp_form.php',     'cf_basic', 1));
}
if($member['mb_level'] > 2){
    array_push($menu['menu100'], array('100300', '광고주 관리', G5_SALE_URL.'/comp_list.php',     'cf_basic', 1));
    /*array_push($menu['menu100'], array('100500', '소재 관리', G5_SALE_URL.'/mtrl_all_list.php',     'cf_basic', 1));*/
}
array_push($menu['menu100'],array('100399', '---------------', '#',     'cf_basic'));
if($member['mb_level'] > 7){
    array_push($menu['menu100'], array('100210', '광고회사 등록', G5_SALE_URL.'/agncy_form.php',     'cf_basic'));
}
if($member['mb_level'] > 5){
    array_push($menu['menu100'], array('100200', '광고회사 관리', G5_SALE_URL.'/agncy_list.php',     'cf_basic'));
}

array_push($menu['menu100'],array('100299', '---------------', '#',     'cf_basic'));
if($member['mb_level'] > 7){
    array_push($menu['menu100'], array('100110', '매체사 등록', G5_SALE_URL.'/mda_form.php',   'cf_basic'));
}
if($member['mb_level'] > 5){
    array_push($menu['menu100'], array('100100', '매체사 관리', G5_SALE_URL.'/mda_list.php',   'cf_basic'));
}
if($member['mb_level'] > 7){
    array_push($menu['menu100'], array('100510', '매체 광고상품 관리', G5_SALE_URL.'/mda_pro_all_list.php',     'cf_basic', 1));
}

array_push($menu['menu100'],array('100599', '---------------', '#',     'cf_basic'));
if($member['mb_level'] > 7 || $member['mb_level'] ==  4 ){
    array_push($menu['menu100'], array('100600', '빌딩관리', G5_SALE_URL.'/bld_list.php', 'cf_basic', 1));
}
if($member['mb_level'] > 8 || $member['mb_level'] ==  4 ){
    array_push($menu['menu100'], array('100601', '계약 빌딩 등록', G5_SALE_URL.'/bld_cont_reg.php', 'cf_basic', 1));
    array_push($menu['menu100'], array('100604', '계약 빌딩 엑셀 등록', G5_SALE_URL.'/bld_cont_reg_excel.php', 'cf_basic', 1));
}
if($member['mb_level'] >= 2 ){
    array_push($menu['menu100'], array('100602', '빌딩재원', G5_SALE_URL.'/bld/bldcont_qty_list.php', 'cf_basic', 1));
    /*array_push($menu['menu100'], array('100602', '빌딩재원', G5_SALE_URL.'/bld_cont_qty_list3.php', 'cf_basic', 1));*/
    array_push($menu['menu100'], array('100603', '빌딩 계약등록 내역', G5_SALE_URL.'/bld_cont_list.php', 'cf_basic', 1));
}
if($member['mb_level'] > 8){
    /*array_push($menu['menu100'], array('100605', '빌딩재원-NEW', G5_SALE_URL.'/bld/bldcont_qty_list.php', 'cf_basic', 1));*/
}

//관리자 공통코드
if($member['mb_id'] =='admin' || $member['mb_level'] >= 10  ){
    array_push($menu['menu100'],array('100900', '---------------', '#',     'cf_basic'));
    array_push($menu['menu100'], array('100910', '공통코드 관리', G5_SALE_URL.'/comm_code_list.php',     'cf_basic', 1));
    array_push($menu['menu100'], array('100920', '미디어트리', G5_SALE_URL.'/comm_mda_list.php',     'cf_basic', 1));

}
