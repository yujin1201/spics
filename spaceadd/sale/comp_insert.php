<?php
$sub_menu = "100400";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '광고주 관리';
include_once('./sale.head.php');


$sound_only = '<strong class="sound_only">필수</strong>';
add_javascript('<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>', 0);
?>
<script type="text/javascript">

    </script>
<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

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
                <th scope="row"><label for="COMP_NM">광고주 명<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="COMP_NM" value="<?php echo $comp['COMP_NM'] ?>" id="COMP_NM"  class="frm_input " size="15"  maxlength="20">
                </td>
                <th scope="row"><label for="COMP_seq">광고주 코드 </label></th>
                <td><input type="text" name="COMP_seq" id="COMP_seq"  class="frm_input " size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="BUSI_NO">사업자 번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="BUSI_NO" value="<?php echo $comp['BUSI_NO'] ?>" id="BUSI_NO" required class="required frm_input" size="15"  maxlength="20"></td>
                <th scope="row"><label for="CORP_NO">법인 번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="CORP_NO" value="<?php echo $comp['CORP_NO'] ?>" id="CORP_NO" required class="required frm_input" size="15"  maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">대표자 1<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30"></td>
                <th scope="row"><label for="REP_NM2">대표자 2</label></th>
                <td><input type="text" name="REP_NM2" value="<?php echo $comp['REP_NM2'] ?>" id="REP_NM2" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_hp">전화 번호</label></th>
                <td><input type="text" name="mb_hp" value="<?php echo $comp['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
                <th scope="row"><label for="mb_tel">FAX 번호</label></th>
                <td><input type="text" name="mb_tel" value="<?php echo $comp['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row">주소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호</label>
                    <input type="text" name="mb_zip" value="<?php echo $comp['mb_zip1'].$comp['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="mb_addr1" value="<?php echo $comp['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
                    <label for="mb_addr1"> </label> <input type="text" name="mb_addr3" value="<?php echo $comp['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
                    <label for="mb_addr2">상세주소</label> <input type="text" name="mb_addr2" value="<?php echo $comp['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">

                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $comp['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">업 태<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30"></td>
                <th scope="row"><label for="REP_NM2">종 목</label></th>
                <td><input type="text" name="REP_NM2" value="<?php echo $comp['REP_NM2'] ?>" id="REP_NM2" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">결재조건<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30"></td>
                <th scope="row"><label for="REP_NM2">업종 구분</label></th>
                <td><input type="text" name="REP_NM2" value="<?php echo $comp['REP_NM2'] ?>" id="REP_NM2" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">거래 상태<strong class="sound_only">필수</strong></label></th>
                <td colspan="3"><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30"></td>

            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">직책자<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <label for="mb_addr2">이름</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                    <label for="mb_addr2">연락처</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                    <label for="mb_addr2">E-Mail</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">실무자<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <label for="mb_addr2">이름</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                    <label for="mb_addr2">연락처</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                    <label for="mb_addr2">E-Mail</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="REP_NM1">재무 담당<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <label for="mb_addr2">이름</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                    <label for="mb_addr2">연락처</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                    <label for="mb_addr2">E-Mail</label><input type="text" name="REP_NM1" value="<?php echo $comp['REP_NM1'] ?>" id="REP_NM1" maxlength="100" required class="required frm_input email" size="30">
                </td>
            </tr>            
            <tr>
                <th scope="row"><label for="mb_memo">비고</label></th>
                <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $comp['mb_memo'] ?></textarea></td>
            </tr>

            </tbody>
        </table>
    </div>

    <div class="btn_fixed_top">
        <a href="./member_list.php?<?php echo $qstr ?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
    </div>
</form>

<script>
    function fmember_submit(f)
    {
        if (!f.mb_icon.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_icon.value) {
            alert('아이콘은 이미지 파일만 가능합니다.');
            return false;
        }

        if (!f.mb_img.value.match(/\.(gif|jpe?g|png)$/i) && f.mb_img.value) {
            alert('회원이미지는 이미지 파일만 가능합니다.');
            return false;
        }

        return true;
    }
</script>


<?php
include_once ('./sale.tail.php');
?>
