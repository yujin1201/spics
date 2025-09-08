<?php

$sub_menu = "100400";
include_once('./_common.php');

$w = $_POST['w'];

$sql_common = "  comp_nm = '{$_POST['comp_nm']}',                 
                 busi_no = '{$_POST['busi_no']}',
                 corp_no = '{$_POST['corp_no']}',
                 rep_nm1 = '{$_POST['rep_nm1']}',
                 rep_nm2 = '{$_POST['rep_nm2']}',
                 tel_no = '{$_POST['tel_no']}',
                 fax_no = '{$_POST['fax_no']}',
                 zipcode = '{$_POST['zipcode']}',
                 addr1 = '{$_POST['addr1']}',
                 addr2 = '{$_POST['addr2']}',
                 addr3 = '{$_POST['addr3']}',
                 busi_sts = '{$_POST['busi_sts']}',
                 item = '{$_POST['item']}',
                 bill_type = '{$_POST['bill_type']}',
                 rep_indst_div = '{$_POST['rep_indst_div']}',
                 deal_sts_code = '{$_POST['deal_sts_code']}',
                 brand_1 = '{$_POST['brand_1']}',
                 brand_2 = '{$_POST['brand_2']}',
                 brand_3 = '{$_POST['brand_3']}',
                 brand_4 = '{$_POST['brand_4']}',
                 chrg_nm = '{$_POST['chrg_nm']}',
                 chrg_no = '{$_POST['chrg_no']}',
                 chrg_email = '{$_POST['chrg_email']}',
                 psrn_nm = '{$_POST['psrn_nm']}',
                 psrn_no = '{$_POST['psrn_no']}',
                 psrn_email = '{$_POST['psrn_email']}',
                 fin_nm = '{$_POST['fin_nm']}',
                 fin_no = '{$_POST['fin_no']}',
                 fin_email = '{$_POST['fin_email']}',
                 excpt_div = '{$_POST['excpt_div']}',
                 deal_ocur_dt = replace('{$_POST['deal_ocur_dt']}', '-',''),
                 bigo = '{$_POST['bigo']}'
                  ";
if ($w == 'I'){

    //최초 입력시 사업자 번호 중복 체크
    $sql = "select  count(*) as cnt   from tb_comp where del_yn='N' and comp_type = 'AAC01'
            and replace( busi_no,'-','') = replace('{$_POST['busi_no']}','-','') ";
    $comp= sql_fetch($sql);


    if($comp['cnt'] > 0 ){
        if(isset($_SERVER['HTTP_REFERER'])) {
            $previous = $_SERVER['HTTP_REFERER'];
        }
        alert("중복된 사업자 번호 입니다. 등록 할 수 없습니다.", $previous);

    }

    $result = sql_query(" insert into tb_comp set entr_dt=now(),entr_prsn ='{$member['mb_no']}',comp_type = 'AAC01', {$sql_common} ");
    if($result)  $last_seq_no = sql_insert_id();

    //goto_url("./comp_form.php?w=u&comp_seq={$last_seq_no}");
    alert("등록 완료", './comp_form.php?w=u&comp_seq='.$last_seq_no);
}else if($w == 'U'){

    $result = sql_query(" update tb_comp set updt_dt=now(),updt_prsn ='{$member['mb_no']}',comp_type = 'AAC01', {$sql_common} where comp_seq = '{$_POST['comp_seq']}' ");
    alert("저장 완료", './comp_form.php?w=u&comp_seq='.$_POST['comp_seq']);

}else if($w == 'D' || $_GET['w'] == 'D'){
    //삭제시 계약에 정보가 있으면 삭제 안됨

    if(!isset($_POST['comp_seq']) ){
        $comp_seq = $_GET['comp_seq'];
    }else{
        $comp_seq = $_POST['comp_seq'];
    }

    $sql = "SELECT count(*) as cnt     
       FROM tb_cont a  where a.cli_seq='{$comp_seq}'";

    $cnt = sql_fetch($sql);

    if($cnt['cnt'] > 0){
        alert("계약 정보가 존재 합니다. 삭제 할 수 없습니다.", './comp_form.php?w=u&comp_seq='.$comp_seq);
    }else{
        $result = sql_query(" update tb_comp set updt_dt=now(),updt_prsn ='{$member['mb_no']}',del_yn = 'Y' where comp_seq = '{$comp_seq}' ");
        alert("삭제 완료", './comp_list.php');
    }

}

?>
