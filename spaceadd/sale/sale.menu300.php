<?php
$menu['menu300'] = array (
    array('300000', '정산관리', G5_SALE_URL.'', 'config')
);
if($member['mb_level'] !=4 ) {
    array_push($menu['menu300'], array('300200', '광고비 정산 내역', G5_SALE_URL . '/fin_list_cont.php', 'cf_basic'));
}
if($member['mb_level'] > 7){
    array_push($menu['menu300'],array('300210', '매체사 정산 내역', G5_SALE_URL.'/fin_list_mda.php',   'cf_basic'));
}
if($member['mb_level'] > 4){
    array_push($menu['menu300'],array('300400', '월별 판매 현황', G5_SALE_URL.'/report_list_ym.php',   'cf_basic'));
    array_push($menu['menu300'],array('300500', '매체/월별 현황(취급고)', G5_SALE_URL.'/report_list_media_ym.php',   'cf_basic'));
    array_push($menu['menu300'],array('3001000', '매체/월별 현황(회계)', G5_SALE_URL.'/report/report_media_ym_01.php',   'cf_basic'));
    array_push($menu['menu300'],array('3001001', '월별판매현황 차트', G5_SALE_URL.'/report/report_chart_ym.php',   'cf_basic'));

    /*array_push($menu['menu300'],array('3001000', '매체/월별 현황(회계)', G5_SALE_URL.'/report_list_media_ym02.php',   'cf_basic'));*/
}

array_push($menu['menu300'],array('300600', '---------------', '#',     'cf_basic'));
if($member['mb_level'] > 7){
   array_push($menu['menu300'],array('300700', '구분 손익 및 증감 내역', G5_SALE_URL.'/report_list_01.php',   'cf_basic'));
}
if($member['mb_level'] >= 1){
    array_push($menu['menu300'],array('300800', '자사 매체 가동현황', G5_SALE_URL.'/report_list_02.php',   'cf_basic'));
}

if($member['mb_level'] > 8){
    array_push($menu['menu300'],array('3001000', '---------------', '#',     'cf_basic'));




}