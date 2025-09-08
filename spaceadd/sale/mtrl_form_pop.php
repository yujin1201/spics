<?php

include_once('./_common.php');

$g5['title'] = '소재등록';
include_once('./sale.head.popup.php');


$sound_only = '<strong class="sound_only">필수</strong>';


if(isset($_GET['mtrl_seq'])){
    //수정모드
    $w = "U";

    $sql = "SELECT mtrl_seq, comp_seq, mtrl_nm, mtrl_sec, use_yn, prod_type, indst_lrg_knd_cd, indst_mdl_knd_cd,
       indst_sml_knd_cd, insp_no, bigo,mtrl_url_1,mtrl_url_2,mtrl_url_3,mtrl_url_4, FN_MB_NM(entr_prsn) as entr_prsn, entr_dt, updt_dt, FN_MB_NM(updt_prsn) as updt_prsn FROM tb_mtrl where mtrl_seq='{$_GET['mtrl_seq']}'";

    //echo $sql;
    $mtrl = sql_fetch($sql);

    //print_r($mtrl);

}else{
    //신규 입력
    $w = "I";
    $chk = "checked";
}


?>
    <style type="text/css">
        html {overflow:hidden;}
    </style>
<form name="fmtrl" id="fcomp" action="./mtrl_form_update.php" onsubmit="return fmtrl_submit(this);" method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="mtrl_seq" value="<?php echo $_GET['mtrl_seq'] ?>">
    <input type="hidden" name="comp_seq" value="<?php echo $_GET['comp_seq'] ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>

    <div class="btn_fixed_top">
        <div class="btn_list03">
            <? if($member['mb_level'] > 6 &&  $w == "U"){ ?>
                <button  type="button" class="btn_del" onclick="return fmtrl_del_submit(this);">삭제</button>
            <?} ?>
        </div>
    </div>
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption>소재 관리</caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mtrl_nm">소재명<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="mtrl_nm" value="<?php echo $mtrl['mtrl_nm'] ?>" id="mtrl_nm"  class="required frm_input " size="20"  maxlength="20">
                </td>
                <th scope="row"><label for="mtrl_seq">소재 번호</label></th>
                <td><input type="text" name="mtrl_seq" id="mtrl_seq"  class="frm_input readonly"  value="<?php echo $mtrl['mtrl_seq'] ?>" size="20" maxlength="20" readonly></td>
            </tr>
            <tr>
                <th scope="row"><label for="mtrl_sec">소재 초수</label></th>
                <td>
                    <?php echo get_spin_select('mtrl_sec', 10, 120, $mtrl['mtrl_sec'], 5) ?>
                </td>
                <th scope="row"><label for="busi_no">업 종<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="prod_type" id="prod_type" class="required" onChange="">
                        <option value="">업종 선택<?print_option_with_select('CAA', $mtrl['prod_type']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="corp_no">사용 여부<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="radio" name="use_yn" value="Y" id="use_yn" <?php echo $mtrl['use_yn']=='Y'?'checked':''; ?> <?=$chk?>>
                    <label for="use_yn">Y</label>
                    <input type="radio" name="use_yn" value="N" id="use_yn" <?php echo $mtrl['use_yn']=='N'?'checked':''; ?>>
                    <label for="use_yn">N</label>
                </td>
                <th scope="row"><label for="corp_no">등록 일시 / 수정일시 </label></th>
                <td><input type="text" name="entr" id="entr"  class="frm_input readonly"  value="<?php echo $mtrl['entr_dt'].' / '.$mtrl['entr_prsn'] ?>" size="25" maxlength="20" readonly>
                    <input type="text" name="updt" id="updt"  class="frm_input readonly"  value="<?php echo $mtrl['updt_dt'].' / '.$mtrl['updt_prsn'] ?>" size="25" maxlength="20" readonly></td>
            </tr>
            <tr>
                <th scope="row"><label for="mtrl_url_1">소재 URL 1 </label></th>
                <td colspan="3"><input type="text" name="mtrl_url_1" value="<?php echo $mtrl['mtrl_url_1'] ?>" id="mtrl_url_1"  class="frm_input " size="150"  maxlength="100"> &nbsp;<a href="<?php echo $mtrl['mtrl_url_1'] ?>" target="_blank"><button type="button" class="btn_save" onclick="" style="">열기</button></a></td>
            </tr>
            <tr>
                <th scope="row"><label for="mtrl_url_2">소재 URL 2</label></th>
                <td colspan="3"><input type="text" name="mtrl_url_2" value="<?php echo $mtrl['mtrl_url_2'] ?>" id="mtrl_url_2"  class="frm_input " size="150"  maxlength="100"> &nbsp;<a href="<?php echo $mtrl['mtrl_url_2'] ?>" target="_blank"><button type="button" class="btn_save" onclick="" style="">열기</button></a></td>
            </tr>
            <tr>
                <th scope="row"><label for="mtrl_url_3">소재 URL 3</label></th>
                <td colspan="3"><input type="text" name="mtrl_url_3" value="<?php echo $mtrl['mtrl_url_3'] ?>" id="mtrl_url_3"  class="frm_input " size="150"  maxlength="100"> &nbsp;<a href="<?php echo $mtrl['mtrl_url_3'] ?>" target="_blank"><button type="button" class="btn_save" onclick="" style="">열기</button></a></td>
            </tr>
            <tr>
                <th scope="row"><label for="mtrl_url_4">소재 URL 4</label></th>
                <td colspan="3"><input type="text" name="mtrl_url_4" value="<?php echo $mtrl['mtrl_url_4'] ?>" id="mtrl_url_4"  class="frm_input " size="150"  maxlength="100"> &nbsp;<a href="<?php echo $mtrl['mtrl_url_4'] ?>" target="_blank"><button type="button" class="btn_save" onclick="" style="">열기</button></a></td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" style="height: 50px"><?php echo $mtrl['bigo'] ?></textarea></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--
    <div class="btn_fixed_top">
        <a href="./comp_list.php?<?php /*echo $qstr */?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
    </div>
-->
    <div class="" align="center">
        <? if($member['mb_level'] > 4){ ?>
            <button  class="btn btn_save btn_lg" onclick="fmtrl_submit(this);">저장</button>
        <?} ?>
        <button  type="button" class="btn btn_close btn_lg" onclick="self.close();">닫기</button>
    </div>

</form>
<script>

    function fmtrl_submit(f)
    {
        return true;
    }

    function fmtrl_del_submit(f){
        if(confirm("정말 삭제 하시겠습니까?")){
            location.href = 'mtrl_form_update.php?w=D&mtrl_seq=<?=$mtrl['mtrl_seq']?>';
        }else{
            return false;
        }

    }
</script>

</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다.