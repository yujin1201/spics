<?php
$sub_menu = "200100";
include_once('./_common.php');
$g5['title'] = '계약 목록';
include_once('./sale.head.php');
include_once('./cont_form_common.php');

$data_desr="계약 코드 : 
계약명 : 
청약기간 :  
금액 : "   ;

$data = array();
$data['body'] = "TESTTEST ";
$data['connectColor'] = "#FAC11B";
$data['connectInfo'][] = array("title" => "TEST", "description" => $data_desr  );
$response = jandi_post($data, "https://wh.jandi.com/connect-api/webhook/28477738/a2898436eea7f83140a7459185ee4ebd"); // 잔디로 전송

?>