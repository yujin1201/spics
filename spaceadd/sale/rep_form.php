<?php
$sub_menu = "100410";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '미디어랩 등록';
include_once('./sale.head.php');


$sound_only = '<strong class="sound_only">필수</strong>';
add_javascript('<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>', 0);


if(isset($_GET['w']) && isset($_GET['comp_seq'])){
    //수정모드
    $w = "U";

    $sql = "select * from tb_comp where comp_seq='{$_GET['comp_seq']}'";
    $comp = sql_fetch($sql);

}else{
    //신규 입력
    $w = "I";
}

if (empty($comp['deal_ocur_dt']) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $comp['deal_ocur_dt']) ) $comp['deal_ocur_dt'] = G5_TIME_YMD;


?>
<script type="text/javascript">
    jQuery(function($) {


        $("#deal_ocur_dt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });
    });
</script>
<form name="fcomp" id="fcomp" action="./rep_form_update.php" onsubmit="return" method="post">
    <input type="hidden" name="w" id="w" value="<?php echo $w ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>

    <div class="btn_fixed_top">
        <div class="btn_list03">
            <a href="./rep_list.php" class="">미디어랩 관리</a>
            <button  class="btn_save" onclick="return fcomp_submit(this);" style="">저장</button>
            <button  type="button" class="btn_del" onclick="return fcomp_del_submit(this);">삭제</button>
        </div>
    </div>
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
                <th scope="row"><label for="comp_nm">미디어랩명<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="comp_nm" value="<?php echo $comp['comp_nm'] ?>" id="comp_nm" required class="required frm_input " size="20"  maxlength="30" autocomplete="off">
                </td>
                <th scope="row"><label for="comp_seq">미디어랩코드 </label></th>
                <td><input type="text" name="comp_seq" id="comp_seq"  class="frm_input readonly"  value="<?php echo $comp['comp_seq'] ?>" size="20" maxlength="11" autocomplete="off" readonly></td>
            </tr>
            <tr>
                <th scope="row"><label for="busi_no">사업자번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="busi_no" value="<?php echo $comp['busi_no'] ?>" id="busi_no" required class="required frm_input bizno" size="11"  autocomplete="off" maxlength="12"></td>
                <th scope="row"><label for="corp_no">법인번호</label></th>
                <td><input type="text" name="corp_no" value="<?php echo $comp['corp_no'] ?>" id="corp_no"  class="frm_input bizno" size="14"  autocomplete="off" maxlength="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="rep_nm1">대표자 1<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="rep_nm1" value="<?php echo $comp['rep_nm1'] ?>" id="rep_nm1" maxlength="15" required class="required frm_input " autocomplete="off" size="30"></td>
                <th scope="row"><label for="rep_nm2">대표자 2</label></th>
                <td><input type="text" name="rep_nm2" value="<?php echo $comp['rep_nm2'] ?>" id="rep_nm2" class="frm_input" maxlength="255" size="15" autocomplete="off"</td>
            </tr>
            <tr>
                <th scope="row"><label for="tel_no">전화번호</label></th>
                <td><input type="text" name="tel_no" value="<?php echo $comp['tel_no'] ?>" id="tel_no" class="frm_input telno" size="11" maxlength="13" autocomplete="off"></td>
                <th scope="row"><label for="fax_no">FAX번호</label></th>
                <td><input type="text" name="fax_no" value="<?php echo $comp['fax_no'] ?>" id="fax_no" class="frm_input telno" size="15" maxlength="13" autocomplete="off"></td>
            </tr>
            <tr>
                <th scope="row">주 소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호<strong class="sound_only">필수</strong></label>
                    <input type="text" name="zipcode" value="<?php echo $comp['zipcode']; ?>" id="zipcode" class="required frm_input readonly" size="5" maxlength="6" autocomplete="off" required readonly>
                    <button type="button" class="btn_frmline" onclick="win_zip('fcomp', 'zipcode', 'addr1', 'addr3', 'addr2', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="addr1" value="<?php echo $comp['addr1'] ?>" id="addr1" class="required frm_input readonly" size="60" readonly autocomplete="off" required>
                    <label for="mb_addr1"> </label> <input type="text" name="addr2" value="<?php echo $comp['addr2'] ?>" id="addr2" class="frm_input readonly" size="60" readonly autocomplete="off">
                    <label for="mb_addr3">상세주소</label> <input type="text" name="addr3" value="<?php echo $comp['addr3'] ?>" id="addr3" class="required frm_input" size="60" autocomplete="off" required>

                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $comp['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="bill_type">결재조건<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="bill_type" id="bill_type" class="required" onChange="" required>
                        <option value="">결재조건 선택<?print_option_with_select('BAD', $comp['bill_type']);?>
                    </select>
                </td>
                <th scope="row"><label for="rep_indst_div">업종구분</label></th>
                <td>
                    <select name="rep_indst_div" id="rep_indst_div" class="required" onChange="">
                        <option value="">업종 선택<?print_option_with_select('CAA', $comp['rep_indst_div']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="deal_sts_code">거래상태<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <select name="deal_sts_code" id="deal_sts_code" class="required" onChange="" required>
                        <option value="">거래상태 선택<?print_option_with_select('BAA', $comp['deal_sts_code']);?>
                    </select>
                </td>

            </tr>
            <tr>
                <th scope="row"><label for="chrg_nm">직책자</label></th>
                <td colspan="3">
                    <label for="chrg_nm">이름</label>
                    <input type="text" name="chrg_nm" value="<?php echo $comp['chrg_nm'] ?>" id="chrg_nm" maxlength="15" class="frm_input" size="30" autocomplete="off">
                    <label for="chrg_no">연락처</label>
                    <input type="text" name="chrg_no" value="<?php echo $comp['chrg_no'] ?>" id="CHRG_NO" maxlength="13" class="frm_input telno" size="30" autocomplete="off">
                    <label for="chrg_email">E-Mail</label>
                    <input type="text" name="chrg_email" value="<?php echo $comp['chrg_email'] ?>" id="chrg_email" maxlength="30" class="frm_input email" size="30" autocomplete="off">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="psrn_nm">실무자</label></th>
                <td colspan="3">
                    <label for="psrn_nm">이름</label>
                    <input type="text" name="psrn_nm" value="<?php echo $comp['psrn_nm'] ?>" id="psrn_nm" maxlength="15" class="frm_input required" size="30" autocomplete="off" required>
                    <label for="psrn_no">연락처</label>
                    <input type="text" name="psrn_no" value="<?php echo $comp['psrn_no'] ?>" id="psrn_no" maxlength="13" class="frm_input telno" size="30" autocomplete="off">
                    <label for="psrn_email">E-Mail</label>
                    <input type="text" name="psrn_email" value="<?php echo $comp['psrn_email'] ?>" id="psrn_email" maxlength="30" class="frm_input email" size="30" autocomplete="off">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="fin_nm">재무담당</label></th>
                <td colspan="3">
                    <label for="fin_nm">이름</label>
                    <input type="text" name="fin_nm" value="<?php echo $comp['fin_nm'] ?>" id="fin_nm" maxlength="15"  class="frm_input" size="30" autocomplete="off">
                    <label for="fin_no">연락처</label>
                    <input type="text" name="fin_no" value="<?php echo $comp['fin_no'] ?>" id="fin_no" maxlength="13"  class="frm_input telno"  size="30" autocomplete="off">
                    <label for="fin_email">E-Mail</label>
                    <input type="text" name="fin_email" value="<?php echo $comp['fin_email'] ?>" id="fin_email" maxlength="30"  class="frm_input email" size="30" autocomplete="off">
                </td>
            </tr>            
            <tr>
                <th scope="row"><label for="bigo">비 고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" autocomplete="off"><?php echo $comp['bigo'] ?></textarea></td>
            </tr>

            </tbody>
        </table>
    </div>

    <?php
    if($w == "U"){
        include_once('./inc_comp_file.php');
    }
    ?>

</form>

<script>

    function fcomp_del_submit(f){
        if(delete_confirm2("정말 삭제 하시겠습니까?")){

            $('#w').val('D');

            fcomp_submit(f,"D");
        }else{
            return false;
        }

    }
    <?php
    if($w == "U"){
    ?>
    var g_comp_seq = <?=$comp['comp_seq']?>
    <? }else{?>
    var g_comp_seq = 0;
    <?}?>


    function busi_chk(){

        if($('#busi_no').val() != ''){

            $.get('comp_busi_no_chk.php?comp_type=AAC04&&comp_seq='+g_comp_seq+'&busi_no='+$('#busi_no').val(),function (cnt){

                if(Number(cnt)>0){
                    alert("이미 등록된 사업자 번호 입니다.");
                    return false;
                }else{

                    document.fcomp.submit();

                }
            });
        }else{

        }
    }

    function fcomp_submit(f)
    {

        if(del =='D'){
            location.href = 'rep_form_update.php?comp_type=AAC04&comp_seq='+g_comp_seq+'&w=D';

        }else{
            busi_chk();
            return false;
        }
    }
</script>


<?php
include_once ('./sale.tail.php');
?>
