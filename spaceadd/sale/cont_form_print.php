<?php
$sub_menu = "200110";
include_once('./_common.php');

$g5['title'] = '계약 상세정보';
include_once('./sale.head.php');
include_once('./cont_form_common.php');

if( isset($_GET['cont_seq'])){
    //수정모드
    $w = "U";
    $cont = fn_contInfo($_GET['cont_seq'])  ;

    $cont['cont_yearmon'] = date('Y-m',strtotime($cont['cont_yearmon']."01"));
    $cont['cont_st_dt'] =  date('Y-m-d',strtotime($cont['cont_st_dt']));
    $cont['cont_ed_dt'] =  date('Y-m-d',strtotime($cont['cont_ed_dt']));

}else{
    //신규 입력
    $w = "I";
    $cont['cont_yearmon'] = G5_TIME_YM;
    $cont['sale_prsn'] = $member['mb_no'] ;
    $cont['cont_amt'] =  0 ;
}

if (empty($cont['cont_yearmon'])) $cont['cont_yearmon'] = G5_TIME_YM;
if (empty($cont['cont_st_dt'])) $cont['cont_st_dt'] = G5_TIME_YMD;
if (empty($cont['cont_ed_dt'])) $cont['cont_ed_dt'] = G5_TIME_YMD;
?>
<script type="text/javascript">
    jQuery(function($) {
        $("#cont_yearmon" ).datepicker( $.datepicker.yearmon) ;
        $("#cont_yearmon").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });

        $("#cont_st_dt, #cont_ed_dt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

        $("#cont_amt").val(deleteIsNotValidateChar($("#cont_amt").val()))
    });

     function fn_findComp(compType) {
        try{
            var winTlt ="" ;
            if(compType =="AAC01") {
                winTlt = "광고주";
            }else if(compType =="AAC02"){
                    winTlt="매체사" ;
            }else{
                winTlt="광고회사" ;
            }
            var url ="./common/commP_comp_list.php?compType="+compType+"&callBack=fn_setComp"  ;
            basicPopupOpen(url, winTlt, "800", "570")  ;
        }catch (e) {
            console.log(e)
        }
    };


    function fn_setComp(voJson){
        if(voJson.comp_type =="AAC01") {
            $("#cli_seq").val(voJson.comp_seq);
            $("#cli_nm").val(voJson.comp_nm);
        }else if(voJson.comp_type =="AAC03") {
            $("#agncy_seq").val(voJson.comp_seq);
            $("#agncy_nm").val(voJson.comp_nm);
        }else if(voJson.comp_type =="AAC04") {
            $("#rep_seq").val(voJson.comp_seq);
            $("#rep_nm").val(voJson.comp_nm);
        }
    }
    //회사 삭제
    function fn_delComp(comp_type){
        if(comp_type =="AAC01") {
            $("#cli_seq").val('');
            $("#cli_nm").val('');
        }else if(comp_type =="AAC03") {
            $("#agncy_seq").val('');
            $("#agncy_nm").val('');
        }else if(comp_type =="AAC04") {
            $("#rep_seq").val('');
            $("#rep_nm").val('');
        }
    }

    function fn_cont_submit(f){
        var params = fn_chkForm("fcomp") ;
        if(!params){
            return false ;
        }
        fn_submission("subForm", "./cont_form_update.php", params, true, fn_subCallback  );
    }
    function fn_subCallback(subid, voJson){
        alert("처리 되었습니다.") ;
        if(subid == "subDel"){
            location.href="./cont_list.php";
        }else{
            fn_refrsh(voJson.cont_seq) ;
        }
    }

    function fn_refrsh(p_cont_seq){
        location.href="./cont_form.php?cont_seq="+p_cont_seq ;
    }
/*상태변경*/
    function fn_cont_stat(pStat, pFlag ="U")
    {
       if(!confirm("수정하시겠습니까? ")){
           return false ;
       }
        var params  = Object.assign({},  {"sub_stat" : pStat , "subFlag" : pFlag  }, formParams($("#fcomp")));
       fn_submission("subStat", "./cont_form_update.php", params, true, fn_subCallback  );
    }
/*삭제*/
    function fn_cont_del(pStat, pFlag ="U")
    {
        if(!confirm("삭제 하시겠습니까? ")){
            return false ;
        }
        var params  =   formParams($("#fcomp"));
        fn_submission("subDel", "./cont_form_update.php", params, true, fn_subCallback  );
    }


</script>
<div class="btn_fixed_top">
    <div class="btn_list03">
        <a href="./cont_list.php" class="">계약 목록</a>
        <?
        /*
    BAC01	작성중
    BAC02	가확정
    BAC03	확정
    BAC04	정산요청
    BAC05	정산완료
*/
        ?>
        <?  if( !isset($_GET['cont_seq']) || $cont['cont_stat'] == "BAC01" || $cont['cont_stat'] == "BAC02"    ) {  ?>
        <button  class="btn_save" onclick="return fn_cont_submit(this);" style="">저장</button>
        <?}?>
        <?php if( $cont['cont_stat'] == "BAC01" ) {  ?>
        <button  class="btn_del" onclick="return fn_cont_del( );">삭제</button>
        <button  class="btn_color02" onclick="return fn_cont_stat('BAC02' );">가확정</button>
        <?}?>
        <?  if( $cont['cont_stat'] == "BAC01" || $cont['cont_stat'] == "BAC02"  ) {  ?>
        <button  class="btn_color03" onclick="return fn_cont_stat('BAC03');">확정</button>
        <?}?>
        <?  if(  $cont['cont_stat'] == "BAC02"  ) {  ?>
        <button  class="btn_color04" onclick="return fn_cont_stat('BAC02', 'D');">가확정취소</button>
        <?}?>
        <?  if(  $cont['cont_stat'] == "BAC03"  ) {  ?>
        <button  class="btn_color05" onclick="return fn_cont_stat('BAC03', 'D');">확정취소</button>
        <button  class="btn_color06" onclick="return fn_cont_stat('BAC04');">정산요청</button>
        <?}?>
        <?  if(  $cont['cont_stat'] == "BAC04"  ) {  ?>
         <button  class="btn_color09" onclick="return fn_cont_stat('BAC04','D');">정산요청 취소</button>
        <button  class="btn_color07" onclick="return fn_cont_stat('BAC05');">정산확정</button>
        <?}?>
        <?  if(  $cont['cont_stat'] == "BAC05"  ) {  ?>
            <button  class="btn_color08" onclick="return fn_cont_stat('BAC05', 'D');">정산취소</button>
        <?}?>
    </div>
</div>
<!--계약상세 정보-->
<form name="fcomp" id="fcomp" action="./cont_form_update.php"  method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="token" value="<?php echo get_write_token('online') ?>">
    <input type="hidden" name="cont_seq" value="<?php echo $cont['cont_seq'] ?>">
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_3">
                <col>
                <col class="grid_3">
                <col>
                <col class="grid_3">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="cont_nm">계약명</label></th>
                <td colspan="5">
                    <input type="text" name="cont_nm" value="<?php echo $cont['cont_nm'] ?>" id="cont_nm" required class="required frm_input wp90" size="100"   >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cli_seq">광고주</label></th>
                <td>
                    <input type="text" name="cli_seq" value="<?php echo $cont['cli_seq'] ?>" id="cli_seq"  class="readonly required frm_input w30" readonly  maxlength="20" readonly>
                    <input type="text" name="cli_nm" value="<?php echo $cont['cli_nm'] ?>" id="cli_nm"  class="required frm_input readonly w130" readonly    maxlength="20">
                    <button type="button"  id="btn_cli_find" class=" btn_find"  onClick="fn_findComp('AAC01')">검색</button>
                </td>
                <th scope="row"><label for="agncy_seq">광고회사 </label></th>
                <td>
                    <input type="text" name="agncy_seq" value="<?php echo $cont['agncy_seq'] ?>" id="agncy_seq"  class="readonly required frm_input w30 " readonly    maxlength="20" readonly>
                    <input type="text" name="agncy_nm" value="<?php echo $cont['agncy_nm'] ?>" id="agncy_nm"  class="required frm_input readonly w130" readonly   maxlength="20">
                    <button type="button"  id="btn_agncy_find" class=" btn_find"  onClick="fn_findComp('AAC03')">검색</button>
                </td>
                <th scope="row"><label for="rep_seq">미디어렙사 </label></th>
                <td>
                    <input type="text" name="rep_seq" value="<?php echo $cont['rep_seq'] ?>" id="rep_seq"  class="readonly  frm_input w30" readonly  maxlength="20" readonly>
                    <input type="text" name="rep_nm" value="<?php echo $cont['rep_nm'] ?>" id="rep_nm"  class="frm_input readonly w130" readonly   maxlength="20">
                    <button type="button"  id="btn_mda_find" class=" btn_find"  onClick="fn_findComp('AAC04')">검색</button>
                    <button type="button"  id="btn_comp_del" class="btn_delIcon"  onClick="fn_delComp('AAC04')">검색</button>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cont_yearmon">계약년월 </label></th>
                <td>
                    <input  id="cont_yearmon" name="cont_yearmon"   maxlength="20"  length="6" class="frm_input ym" value="<?echo $cont['cont_yearmon']?>"></input>
                </td>
                <th scope="row"><label for="mda_type">매체구분 </label></th>
                <td>
                    <select name="mda_type" id="mda_type" onChange="">
                        <option value="">매체 선택<?print_option_with_select('AAB', $cont['mda_type']);?>
                    </select>
                </td>
                <th scope="row"><label for="cont_type_code">계약구분</label></th>
                <td>
                    <select name="cont_type_code" id="cont_type_code" onChange="" style="width: 150px">
                        <?php print_option_with_select('BAB', $cont['cont_type_code']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="tel_no">담당자</label></th>
                <td>
                    <select name="sale_prsn" id="sale_prsn" onChange="" style="width: 150px" >
                        <?php print_option_member($cont['sale_prsn'], '1') ?>
                    </select>
                </td>
                <th scope="row"><label for="cont_st_dt">계약기간</label></th>
                <td>
                    <input  id="cont_st_dt" name="cont_st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_st_dt']?>"></input>
                    ~
                    <input  id="cont_ed_dt" name="cont_ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_ed_dt']?>"></input>
                </td>
                <th scope="row"><label for="cont_amt">예산</label></th>
                <td>
                    <input  id="cont_amt" name="cont_amt"  maxlength="20" class="frm_input number w130" value="<?=$cont['cont_amt']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cont_stat">계약 상태</label></th>
                <td colspan="5">
                    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" disabled>
                        <?php print_option_with_select('BAC', $cont['cont_stat']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="5"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"> <?php echo $cont['bigo'] ?></textarea></td>
            </tr>
            </tbody>
        </table>
    </div>
</form>
    <!--계약상세 정보-->
<?php
if(!empty($cont['cont_seq'] )  ) {
?>
    <!--계약상품 상세-->
    <?php
        include_once('./cont_form_mda.php');
    ?>
    <!--계약 청구 -->
    <?php
        include_once('./cont_form_fin.php');
    ?>
    <?php
    }
?>
<!--계약상품 상세-->
<?php
include_once (G5_PATH.'/sale.tail.php');
?>
