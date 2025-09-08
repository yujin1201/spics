<?php
$sub_menu = "100500";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '광고주 관리2';
include_once('./sale.head.php');

$sql = " select sum(case when deal_sts_code='BAA01' then 1 else 0 end) as sts_ok,
            sum(case when deal_sts_code !='BAA01' then 1 else 0 end) as sts_stop
             from tb_comp; ";
$row = sql_fetch($sql);

?>
<script type="text/javascript">
    $('#main_grid').bind('resize', function(){
       // console.log('resized');
    });
        $(document).ready(function () {
            //var data = generatedata(500);
            //var data = [{"comp_seq":"1","comp_nm":"테스트회사","comp_type":"AAC01","busi_no":"23452345","corp_no":"3453456","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"02-4562-4565","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"02-4564-7897","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"재무담당","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"456456","entr_prsn":null,"entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"2","comp_nm":"테스트회사333","comp_type":"AAC01","busi_no":"23452345","corp_no":"234234234","rep_nm1":"박민상","rep_nm2":"4567","tel_no":"125678546","fax_no":"234234","zipcode":"","addr1":"","addr2":"","busi_sts":"2345","item":"종목입니다","chrg_nm":"직책자","chrg_no":"02-4564-7897","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"재무담당","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"adasdasdasdasdasd","entr_prsn":null,"entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"3","comp_nm":"테스트회사333","comp_type":"AAC01","busi_no":"23452345","corp_no":"234234234","rep_nm1":"박민상","rep_nm2":"4567","tel_no":"125678546","fax_no":"234234","zipcode":"","addr1":"","addr2":"","busi_sts":"2345","item":"종목입니다","chrg_nm":"직책자","chrg_no":"02-4564-7897","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"재무담당","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"adasdasdasdasdasd","entr_prsn":null,"entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"4","comp_nm":"테스트회사333","comp_type":"AAC01","busi_no":"23452345","corp_no":"234234234","rep_nm1":"박민상","rep_nm2":"4567","tel_no":"125678546","fax_no":"234234","zipcode":"","addr1":"","addr2":"","busi_sts":"2345","item":"종목입니다","chrg_nm":"직책자","chrg_no":"02-4564-7897","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"재무담당","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"adasdasdasdasdasd","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"5","comp_nm":"테스트회사333","comp_type":"AAC01","busi_no":"23452345","corp_no":"234234234","rep_nm1":"박민상","rep_nm2":"4567","tel_no":"125678546","fax_no":"234234","zipcode":"","addr1":"","addr2":"","busi_sts":"2345","item":"종목입니다","chrg_nm":"직책자","chrg_no":"02-4564-7897","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"재무담당","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"adasdasdasdasdasd","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"6","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"7","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"8","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"9","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"10","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"11","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"12","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"13","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"14","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"15","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"16","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"17","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"18","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"19","comp_nm":"스패이스애드33","comp_type":"AAC01","busi_no":"23452345","corp_no":"23452345","rep_nm1":"박민상","rep_nm2":"유진","tel_no":"3029999961","fax_no":"2345","zipcode":"19720-","addr1":"312 Cherry Lane","addr2":"(종로1가) 교보생명빌딩 11층 SBS MC","busi_sts":"업태에요","item":"종목입니다","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"2345","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"20","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"21","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"22","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"23","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"24","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"25","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"26","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null},{"comp_seq":"27","comp_nm":"스패이스애드","comp_type":"AAC01","busi_no":"12346556","corp_no":"12658564","rep_nm1":"김옥빈","rep_nm2":"","tel_no":"02-456-7866","fax_no":"564556","zipcode":"05230","addr1":"서울 강동구 양재대로 1706","addr2":"","busi_sts":"광고회사","item":"광고","chrg_nm":"직책자","chrg_no":"2345","chrg_email":"polomin@daum.net","psrn_nm":"실무자","psrn_no":"010-4865-4568","psrn_email":"polomin@daum.net","fin_nm":"2345","fin_no":"010-4865-4568","fin_email":"polomin@daum.net","deal_sts_code":"BAA01","deal_ocur_dt":null,"rep_indst_div":"","bill_type":"","bigo":"비고","entr_prsn":"polomin","entr_dt":null,"updt_prsn":null,"updt_dt":null,"mda_type":null}]
            //var exampleTheme = theme;
            var source =
                {
                    //localdata: data,
                    datatype: "json",
                    datafields: [
                        { name: 'comp_seq'},
                        { name: 'comp_nm'},
                        { name: 'comp_type'},
                        { name: 'busi_no'},
                        { name: 'rep_nm1'},
                        { name: 'entr_dt'}
                    ],
                    url: 'comp_list_result.php',
                    cache: false
                };

            var addfilter = function () {
                var filtergroup = new $.jqx.filter();

                var filter_or_operator = 1;
                var filtervalue = 'Andrew';
                var filtercondition = 'equal';
                var filter1 = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);
 
                filtergroup.addfilter(filter_or_operator, filter1);
                // add the filters.
                $("#grid").jqxGrid('addfilter', 'firstname', filtergroup);
                // apply the filters.
                $("#grid").jqxGrid('applyfilters');
            }

            var adapter = new $.jqx.dataAdapter(source);



            $("#grid").jqxGrid(
            {
                //width: getWidth('grid'),
                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                autoshowfiltericon: true,
                columns: [
                    { text: '광고주 코드', datafield: 'comp_seq', filtertype: 'checkedlist', width: 160},
                    { text: '광고주 명', datafield: 'comp_nm', filtertype: 'checkedlist', width: 160},
                    { text: '회사 구분', datafield: 'comp_type', filtertype: 'checkedlist', width: 170 },
                    { text: '거래 상태', datafield: 'busi_no', filtertype: 'checkedlist', width: 170 },
                    { text: '담당자 명', datafield: 'rep_nm1', filtertype: 'checkedlist', width: 170 },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'date', width: 160 }
                ]
            });
/*

            $('#clearfilteringbutton').jqxButton({ height: 25 });
            $('#clearfilteringbutton').click(function () {
                $("#grid").jqxGrid('clearfilters');
            });

            $("#excelExport").jqxButton();
            $("#excelExport").click(function () {
                $("#grid").jqxGrid('exportdata', 'xlsx', 'jqxGrid');
            });
*/


            $('#grid').on('rowdoubleclick', function (event) {
                var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];
                alert(getRowData['comp_nm']);
            });

        });
    </script>
<div class="local_ov01 local_ov">    
    <span class="btn_ov01"><span class="ov_txt">총 광고주 수 </span><span class="ov_num"> <?php echo number_format($row[sts_ok]+$row[sts_stop]) ?> </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="차단된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">정상 </span><span class="ov_num"><?php echo number_format($row[sts_ok]) ?>건</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="탈퇴된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">거래종료  </span><span class="ov_num"><?php echo number_format($row[sts_stop]) ?>건</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($sfl, "comp_nm"); ?>>광고주 명</option>
        <option value="mb_nick"<?php echo get_selected($sfl, "rep_nm"); ?>>대표자 명</option>
        <option value="mb_name"<?php echo get_selected($sfl, "mb_name"); ?>>담당자 명</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
<div class="btn_fixed_top">
    <button type="button" onclick="return add_menu();" class="btn btn_02">메뉴추가<span class="sound_only"> 새창</span></button>
    <input type="submit" name="act_button" value="확인" class="btn_submit btn ">
</div>


<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 100%;display: flex;">
    <div id="input_table"  style="width: 50%; height: 100%; flex: none;">
        <form name="fcomp" id="fcomp" action="./comp_form_update.php" onsubmit="return fcomp_submit(this);" method="post">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>


            <div class="tbl_frm01 tbl_wrap">
                <table>
                    <caption><?php echo $g5['title']; ?></caption>
                    <colgroup>
                        <col class="grid_4">
                        <col>
                        <col class="grid_4">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <th scope="row"><label for="comp_nm">광고주 명<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <input type="text" name="comp_nm" value="<?php echo $comp['comp_nm'] ?>" id="COMP_NM"  class="required frm_input " size="20"  maxlength="20">
                        </td>
                        <th scope="row"><label for="comp_seq">광고주 코드 </label></th>
                        <td><input type="text" name="comp_seq" id="comp_seq"  class="frm_input " size="20" maxlength="20"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="busi_no">사업자 번호<strong class="sound_only">필수</strong></label></th>
                        <td><input type="text" name="busi_no" value="<?php echo $comp['busi_no'] ?>" id="busi_no" required class="required frm_input" size="15"  maxlength="20"></td>
                        <th scope="row"><label for="corp_no">법인 번호<strong class="sound_only">필수</strong></label></th>
                        <td><input type="text" name="corp_no" value="<?php echo $comp['corp_no'] ?>" id="corp_no" required class="required frm_input" size="15"  maxlength="20"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="rep_nm1">대표자 1<strong class="sound_only">필수</strong></label></th>
                        <td><input type="text" name="rep_nm1" value="<?php echo $comp['rep_nm1'] ?>" id="rep_nm1" maxlength="100" required class="required frm_input " size="30"></td>
                        <th scope="row"><label for="rep_nm2">대표자 2</label></th>
                        <td><input type="text" name="rep_nm2" value="<?php echo $comp['rep_nm2'] ?>" id="rep_nm2" class="frm_input" maxlength="255" size="15"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="tel_no">전화 번호</label></th>
                        <td><input type="text" name="tel_no" value="<?php echo $comp['tel_no'] ?>" id="tel_no" class="frm_input" size="15" maxlength="20"></td>
                        <th scope="row"><label for="fax_no">FAX 번호</label></th>
                        <td><input type="text" name="fax_no" value="<?php echo $comp['fax_no'] ?>" id="fax_no" class="frm_input" size="15" maxlength="20"></td>
                    </tr>
                    <tr>
                        <th scope="row">주소</th>
                        <td colspan="3" class="td_addr_line">
                            <label for="mb_zip" class="sound_only">우편번호</label>
                            <input type="text" name="zipcode" value="<?php echo $comp['zipcode']; ?>" id="zipcode" class="frm_input readonly" size="5" maxlength="6">
                            <button type="button" class="btn_frmline" onclick="win_zip('fcomp', 'zipcode', 'addr1', 'addr2', 'addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                            <input type="text" name="addr1" value="<?php echo $comp['addr1'] ?>" id="addr1" class="frm_input readonly" size="60">
                            <label for="mb_addr1"> </label> <input type="text" name="addr3" value="<?php echo $comp['addr3'] ?>" id="addr3" class="frm_input" size="60">
                            <label for="mb_addr2">상세주소</label> <input type="text" name="addr2" value="<?php echo $comp['addr2'] ?>" id="addr2" class="frm_input" size="60">

                            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $comp['mb_addr_jibeon']; ?>"><br>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="busi_sts">업 태<strong class="sound_only">필수</strong></label></th>
                        <td><input type="text" name="busi_sts" value="<?php echo $comp['busi_sts'] ?>" id="busi_sts" maxlength="100" required class="required frm_input" size="30"></td>
                        <th scope="row"><label for="item">종 목</label></th>
                        <td><input type="text" name="item" value="<?php echo $comp['item'] ?>" id="item" class="frm_input" maxlength="255" size="15"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="BILL_TYPE">결재조건<strong class="sound_only">필수</strong></label></th>
                        <td><input type="text" name="BILL_TYPE" value="<?php echo $comp['BILL_TYPE'] ?>" id="BILL_TYPE" maxlength="100" required class="required frm_input" size="30"></td>
                        <th scope="row"><label for="REP_INDST_DIV">업종 구분</label></th>
                        <td><input type="text" name="REP_INDST_DIV" value="<?php echo $comp['REP_INDST_DIV'] ?>" id="REP_INDST_DIV" class="frm_input" maxlength="255" size="15"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="deal_sts_code">거래 상태<strong class="sound_only">필수</strong></label></th>
                        <td colspan="3">
                            <select name="deal_sts_code" id="deal_sts_code" onChange="">
                                <option value="">거래선 선택<?print_option_with_select('BAA', $comp['deal_sts_code']);?>
                            </select>
                        </td>

                    </tr>
                    <tr>
                        <th scope="row"><label for="chrg_nm">직책자<strong class="sound_only">필수</strong></label></th>
                        <td colspan="3">
                            <label for="chrg_nm">이름</label><input type="text" name="chrg_nm" value="<?php echo $comp['chrg_nm'] ?>" id="chrg_nm" maxlength="100" required class="required frm_input" size="30">
                            <label for="chrg_no">연락처</label><input type="text" name="chrg_no" value="<?php echo $comp['chrg_no'] ?>" id="CHRG_NO" maxlength="100" required class="required frm_input" size="30">
                            <label for="chrg_email">E-Mail</label><input type="text" name="chrg_email" value="<?php echo $comp['chrg_email'] ?>" id="chrg_email" maxlength="100" required class="required frm_input email" size="30">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="psrn_nm">실무자<strong class="sound_only">필수</strong></label></th>
                        <td colspan="3">
                            <label for="psrn_nm">이름</label><input type="text" name="psrn_nm" value="<?php echo $comp['psrn_nm'] ?>" id="PSRN_NM" maxlength="100" required class="required frm_input" size="30">
                            <label for="psrn_no">연락처</label><input type="text" name="psrn_no" value="<?php echo $comp['psrn_no'] ?>" id="psrn_no" maxlength="100" required class="required frm_input" size="30">
                            <label for="psrn_email">E-Mail</label><input type="text" name="psrn_email" value="<?php echo $comp['psrn_email'] ?>" id="psrn_email" maxlength="100" required class="required frm_input email" size="30">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="fin_nm">재무 담당<strong class="sound_only">필수</strong></label></th>
                        <td colspan="3">
                            <label for="fin_nm">이름</label><input type="text" name="fin_nm" value="<?php echo $comp['fin_nm'] ?>" id="fin_nm" maxlength="100" required class="required frm_input" size="30">
                            <label for="fin_no">연락처</label><input type="text" name="fin_no" value="<?php echo $comp['fin_no'] ?>" id="fin_no" maxlength="100" required class="required frm_input" size="30">
                            <label for="fin_email">E-Mail</label><input type="text" name="fin_email" value="<?php echo $comp['fin_email'] ?>" id="fin_email" maxlength="100" required class="required frm_input email" size="30">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="bigo">비고</label></th>
                        <td colspan="3"><textarea name="bigo" id="bigo"><?php echo $comp['bigo'] ?></textarea></td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div class="btn_fixed_top">
                <a href="./comp_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
                <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
            </div>
        </form>
    </div>
    <div id="grid"  style="width: 50%; height: 100%; flex: left;">

    </div>
    <!--
    <div style='margin-top: 20px;'>
        <div style='float: left;'>
            <input value="Remove Filter" id="clearfilteringbutton" type="button" /> <input type="button" value="Export to Excel" id='excelExport' />
        </div>

    </div>
    -->
</div>

</form>


<?php
include_once ('./sale.tail.php');
?>
