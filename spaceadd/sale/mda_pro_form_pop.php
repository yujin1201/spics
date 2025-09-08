<?php

include_once('./_common.php');

$g5['title'] = '매체 광고상품 상세';
include_once('./sale.head.popup.php');


$sound_only = '<strong class="sound_only">필수</strong>';

function print_option_with_select_mda($ob=""){
    $sql = "SELECT mda_seq, mda_nm 
            FROM tb_media 
            where use_yn='y' and (up_mda_seq is null or up_mda_seq ='')
            order by  ord ";
    $result = sql_query($sql);

    $array_select = array();
    $diff = 0;

    while($row = sql_fetch_array($result)) {

        $array_select[$row[mda_seq]] = trim($row[mda_nm]);
        if($diff !=0){
            $mda_nm .= ",";
            $mda_seq .= ",";
        }
        $mda_nm .= "new Array('".$diff."','".$row[mda_nm]."')";
        $mda_seq .= "new Array('".$diff."','".$row[mda_seq]."')";

        $diff++;
    }

    if(!sizeof($array_select)) return;

    foreach( $array_select as $key => $val )
    {
        echo "<option value='".$key."'";
        if($ob!="")
        {
            is_select($ob, $key);
        }
        echo "> ".$val." </option>";
    }
}

if(isset($_GET['prod_seq']) && $_GET['prod_seq'] !='0'){
    //수정모드
    $w = "U";

    $sql = "
      SELECT a.prod_seq, a.comp_seq, a.mda_seq, a.mda_nm, a.mda_cnt, a.use_yn,a.asg_use_yn, a.mda_position
         , date_format(a.use_st_dt,'%Y-%m-%d') as use_st_dt
         , date_format(a.use_ed_dt,'%Y-%m-%d') as use_ed_dt
         , a.use_st_time, a.use_ed_time, rent_adj_day
         ,rent_adj_yn
         ,CASE WHEN rent_adj_yn ='N' THEN 'N' ELSE rent_adj_type_code END AS rent_adj_type_code
         , rent_amt
         ,ad_adj_yn
         ,CASE WHEN ad_adj_yn ='N' THEN 'N' ELSE ad_adj_type_code END AS ad_adj_type_code
         , ad_adj_day
         , ad_amt, ad_rt, mda_amt, ins_cnt
         , a.bigo,  a.entr_dt,  a.updt_dt
         ,FN_MB_NM(a.entr_prsn) as entr_prsn
         ,FN_MB_NM(a.updt_prsn) as updt_prsn
         , m1,m2,m3,m4,m5 
         ,a.ad_date_type_code
         , a.mda_type_code
     FROM tb_comp_mda a , vi_media  b 
     where a.mda_seq = b.mda_seq 
       and a.prod_seq='{$_GET['prod_seq']}'";

    $prod = sql_fetch($sql);
    //$prod_seq_array =  explode( '/', $prod['depth'] );
    for($i=1;$i<6;$i++){

        if($prod['m'.$i] !=''){
            $prod_seq_array[] =  $prod['m'.$i];
        }
    }

    $prod_cnt = count($prod_seq_array);

}else{
    //신규 입력
    $w = "I";
    $prod_cnt = 0;
    $chk = "checked";
}

if (empty($prod['use_st_dt']) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $prod['use_st_dt']) ) $prod['use_st_dt'] = G5_TIME_YMD;
if (empty($prod['use_ed_dt']) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $prod['use_ed_dt']) ) $prod['use_ed_dt'] = G5_TIME_YMD;


?>
    <style type="text/css">
        html {overflow:hidden;}
    </style>
    <form name="fcomp" id="fcomp" action="./mda_pro_form_pop_update.php" onsubmit="return fmtrl_submit(this);" method="post">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="comp_seq" value="<?php echo $_GET['comp_seq'] ?>">
        <input type="hidden" name="prod_seq" value="<?php echo $_GET['prod_seq'] ?>">
        <input type="hidden" name="mda_seq" id="mda_seq" value="">
        <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>

        <div class="btn_fixed_top">
            <div class="btn_list03">
                <? if($member['mb_level'] > 7 &&  $w == "U"){ ?>
                    <button  type="button" class="btn_del" onclick="return fcomp_del_submit(this);">삭제</button>
                <?} ?>
            </div>
        </div>
        <div class="tbl_frm01 tbl_wrap">
            <table>
                <tbody>
                <tr>
                    <th scope="row"><label for="mtrl_nm">상품 구분<strong class="sound_only">필수</strong></label></th>
                    <td colspan="3">
                        <div style="display: flex;">
                            <select name="mda_seq_select_1" id="mda_seq_select_1" onChange="update_select(1,0)">
                                <option value="">상품 선택<?print_option_with_select_mda($prod_seq_array[0]);?>
                            </select>
                            &nbsp;&nbsp;<div id="mda_pro_2" style="flex: left;">
                            </div>
                                &nbsp;&nbsp;<div id="mda_pro_3" style="flex: left;">
                            </div>
                                &nbsp;&nbsp;<div id="mda_pro_4" style="flex: left;">
                            </div>
                                &nbsp;&nbsp;<div id="mda_pro_5" style="flex: left;">
                            </div>
                        </div>
                    </td>
                </tr>
                <th scope="row"><label for="deal_type_code">매체구분 </label></th>
                <td colspan="3">
                    <select name="mda_type_code" id="mda_type_code" onChange="" style="width: 150px">
                        <?php print_option_with_select('AAB', $prod['mda_type_code']);?>
                    </select>
                </td>
                <tr>
                    <th scope="row"><label for="mda_nm">상품명<strong class="sound_only">필수</strong></label></th>
                    <td><input type="text" name="mda_nm" id="mda_nm"  class="frm_input required" required value="<?php echo $prod['mda_nm'] ?>" size="40" maxlength="50" autocomplete="off"></td>
                    <th scope="row"><label for="mda_position">상세 위치<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="text" name="mda_position" id="mda_position"  class="frm_input "  value="<?php echo $prod['mda_position'] ?>" size="40" maxlength="50" autocomplete="off">
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="use_yn">운영 여부<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="radio" name="use_yn" value="Y" id="use_yn" <?php echo $prod['use_yn']=='Y'?'checked':''; ?> <?=$chk?>>
                        <label for="use_yn">Y</label>
                        <input type="radio" name="use_yn" value="N" id="use_yn" <?php echo $prod['use_yn']=='N'?'checked':''; ?>>
                        <label for="use_yn">N</label>

                    </td>
                    <th scope="row"><label for="mda_amt">상품 단가</label></th>
                    <td>
                        <input  id="mda_amt" name="mda_amt"  maxlength="20" class="frm_input number w130 required" value="<?=$prod['mda_amt']?>" ></input> 원
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mda_cnt">구좌수</label></th>
                    <td>
                        <?php echo get_member_level_select('mda_cnt', 1, 99, $prod['mda_cnt']) ?>

                    </td>
                    <th scope="row"><label for="ins_cnt">기기수</label></th>
                    <td>
                        <input  id="ins_cnt" name="ins_cnt"  maxlength="3" size="1" class="frm_input number required" value="<?=$prod['ins_cnt']?>" ></input> 개
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="bigo">재원사용 여부</label></th>
                    <td colspan="3">
                        <input type="radio" name="asg_use_yn" onclick="mad_asg_yn(this)" value="Y" id="asg_use_yn" <?php echo $prod['asg_use_yn']=='Y'?'checked':''; ?> <?=$chk?>>
                        <label for="asg_use_yn">사용</label>
                        <input type="radio" name="asg_use_yn" onclick="mad_asg_yn(this)" value="N" id="asg_use_yn" <?php echo $prod['asg_use_yn']=='N'?'checked':''; ?>>
                        <label for="asg_use_yn">미사용</label>
                    </td>
                </tr>

<!--                <tr>
                    <th scope="row"><label for="bigo">임대료</label></th>
                    <td colspan="3">
                        <input type="radio" name="rent_adj_type_code"  onclick="rent_onclick(this)" value="N" id="rent_adj_type_code" <?php /*echo $prod['rent_adj_type_code']=='N'?'checked':''; */?> <?php /*=$chk*/?>>
                        <label for="rent_adj_type_code">해당없음</label>
                        <input type="radio" name="rent_adj_type_code" onclick="rent_onclick(this)"  value="ABA01" id="rent_adj_type_code" <?php /*echo $prod['rent_adj_type_code']=='ABA01'?'checked':''; */?> <?php /*=$chk*/?>>
                        <label for="rent_adj_type_code">매월</label>
                        <input type="radio" name="rent_adj_type_code" onclick="rent_onclick(this)"  value="ABA02" id="rent_adj_type_code" <?php /*echo $prod['rent_adj_type_code']=='ABA02'?'checked':''; */?>>
                        <label for="rent_adj_type_code">분기</label>
                        <input type="radio" name="rent_adj_type_code" onclick="rent_onclick(this)"  value="ABA03" id="rent_adj_type_code" <?php /*echo $prod['rent_adj_type_code']=='ABA03'?'checked':''; */?>>
                        <label for="rent_adj_type_code">반기</label>
                        <input type="radio" name="rent_adj_type_code" onclick="rent_onclick(this)"   value="ABA04" id="rent_adj_type_code" <?php /*echo $prod['rent_adj_type_code']=='ABA04'?'checked':''; */?>>
                        <label for="rent_adj_type_code">연말</label>
                        <select name="rent_adj_day" id="rent_adj_day" class="" onChange="">
                            <option value="">청구일자<?/*print_option_with_select('ABC', $prod['rent_adj_day']);*/?>
                        </select>
                        <input  id="rent_amt" name="rent_amt"  maxlength="20" class="frm_input number w130 " value="<?php /*=$prod['rent_amt']*/?>" ></input><label for="rent_amt" id="rent_amt_label">원</label>
                    </td>
                </tr>-->
                <tr>
                    <th scope="row"><label for="bigo">매체 광고료 청구기준</label></th>
                    <td colspan="3"><?php print_option_with_radio( "ad_date_type_code", 'AAF', $prod['ad_date_type_code']);?></td>
                </tr>
                <tr>
                    <th scope="row"><label for="bigo">광고료</label></th>
                    <td colspan="3">
                        <label for="ad_adj_day" style="display: none">청구일자</label>
                        <input type="radio" name="ad_adj_type_code" onclick="ad_onclick(this)" value="N" id="ad_adj_type_code" <?php echo $prod['ad_adj_type_code']=='N'?'checked':''; ?> <?=$chk?>>
                        <label for="ad_adj_type_code">해당없음</label>
                        <!--
                        <input type="radio" name="ad_adj_type_code" onclick="ad_onclick(this)" value="ABB01" id="ad_adj_type_code" <?php echo $prod['ad_adj_type_code']=='ABB01'?'checked':''; ?> <?=$chk?>>
                        <label for="ad_adj_type_code">비율</label>
                        -->
                        <input type="radio" name="ad_adj_type_code" onclick="ad_onclick(this)" value="ABB02" id="ad_adj_type_code" <?php echo $prod['ad_adj_type_code']=='ABB02'?'checked':''; ?>>
                        <label for="ad_adj_type_code">금액</label>
                        <select name="ad_adj_day" id="ad_adj_day" class="" onChange="">
                            <option value="">청구일자<?print_option_with_select('ABC', $prod['ad_adj_day']);?>
                        </select>
                        <input  id="ad_amt" name="ad_amt"  maxlength="20" class="frm_input number w130 " value="<?=$prod['ad_amt']?>" ></input><label for="ad_amt" id="ad_amt_label">원</label>
                        <input  id="ad_rt" name="ad_rt"  maxlength="2" class="frm_input number w130 " value="<?=$prod['ad_rt']?>"  style="display:none"></input> <label for="ad_rt" id="ad_rt_label"  style="display:none">%</label>

                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="corp_no">운영일자<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input  id="use_st_dt" name="use_st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$prod['use_st_dt']?>"></input>
                        ~
                        <input  id="use_ed_dt" name="use_ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$prod['use_ed_dt']?>"></input>
                    </td>
                    <th scope="row"><label for="use_st_time">운영시간</label></th>
                    <td>
                        <input type="text" name="use_st_time" id="use_st_time"  class="frm_input TimeNo"  value="<?php echo $prod['use_st_time'] ?>" size="5" maxlength="4" autocomplete="off">
                        ~ <input type="text" name="use_ed_time" id="use_ed_time"  class="frm_input TimeNo"  value="<?php echo $prod['use_ed_time'] ?>" size="5" maxlength="4" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="bigo">비고</label></th>
                    <td colspan="3"><textarea name="bigo" id="bigo" style="height: 40px;"><?php echo $prod['bigo'] ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="corp_no">등록 일시 / 작성자</label></th>
                    <td><input type="text" name="entr" id="entr"  class="frm_input readonly"  value="<?php echo $prod['entr_dt'].' / '.$prod['entr_prsn'] ?>" size="30" maxlength="30" readonly></td>
                    <th scope="row"><label for="corp_no">수정 일시 / 수정자</label></th>
                    <td><input type="text" name="entr" id="entr"  class="frm_input readonly"  value="<?php echo $prod['updt_dt'].' / '.$prod['updt_prsn'] ?>" size="30" maxlength="30" readonly></td>
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
            <? if($member['mb_level'] > 7 ){ ?>
            <button  class="btn btn_save btn_lg" >저장</button>
            <? } ?>
            <button  type="button" class="btn btn_close btn_lg" onclick="self.close();">닫기</button>
        </div>





    </form>
    <script>

        jQuery(function($) {


            $("#use_st_dt, #use_ed_dt").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                yearRange: "c-99:c+99"  });

            $("#mda_amt").val(deleteIsNotValidateChar($("#mda_amt").val()))  ;
            $("#ad_amt").val(deleteIsNotValidateChar($("#ad_amt").val()))  ;
            /*$("#rent_amt").val(deleteIsNotValidateChar($("#rent_amt").val()))  ;*/
        });
        var prod_select = <?=json_encode($prod_seq_array)?> ;

        //console.log(prod_select);
        $(document).ready( function(){
            <?php
            if($prod_cnt > 1){
                $prod_select = 1;
            ?>
                update_select(1,1);
            <?php
            }
            if($prod['ad_adj_type_code']=='ABB02'){
            ?>
                $("#ad_amt").show();
                $("#ad_rt").hide();
                $("#ad_amt_label").show();
                $("#ad_rt_label").hide();
                $("#ad_adj_day").show();

            <?php }else if($prod['ad_adj_type_code']=='ABB01'){ ?>
                $("#ad_amt").hide();
                $("#ad_rt").show();
                $("#ad_amt_label").hide();
                $("#ad_rt_label").show();
                $("#ad_adj_day").show();
            <?php }else if($prod['ad_adj_type_code']=='N'){ ?>
                $("#ad_amt").hide();
                $("#ad_rt").hide();
                $("#ad_amt_label").hide();
                $("#ad_rt_label").hide();
                $("#ad_adj_day").hide();
            <? } ?>

            /*
             <?
                if($prod['rent_adj_type_code']=='ABA02'){
             ?>
                $("#rent_amt").show();
                $("#rent_amt_label").show();
                $("#rent_adj_day").show();
             <?php
                }else if($prod['rent_adj_type_code']=='ABA01'){
             ?>
                $("#rent_amt").show();
                $("#rent_amt_label").show();
                $("#rent_adj_day").show();
             <?php }else if($prod['rent_adj_type_code']=='N'){ ?>
                $("#rent_amt").hide();
                $("#rent_amt_label").hide();
                $("#rent_adj_day").hide();
            <? } ?>
            */
        }
        );
        var g_depth;

        function mad_asg_yn(v){

            //alert(v.value);
            if(v.value == "Y"){
                $("#mda_cnt").prop('disabled', false);
            }else{
                $("#mda_cnt").prop('disabled', true);
            }


            //$("input").prop('disabled', false);
        }
        
        function ad_onclick(v){
            if(v.value == "ABB01"){ //비율
                $("#ad_amt").hide();
                $("#ad_rt").show();
                $("#ad_amt_label").hide();
                $("#ad_rt_label").show();
                $("#ad_adj_day").show();
            }else if(v.value == "ABB02"){ //금액
                $("#ad_amt").show();
                $("#ad_rt").hide();
                $("#ad_amt_label").show();
                $("#ad_rt_label").hide();
                $("#ad_adj_day").show();
            }else if(v.value == "N"){
                $("#ad_amt").hide();
                $("#ad_rt").hide();
                $("#ad_amt_label").hide();
                $("#ad_rt_label").hide();
                $("#ad_adj_day").hide();
            }
        }

        function rent_onclick(v){
            if(v.value == "N"){ //비율
                $("#rent_amt").hide();
                $("#rent_amt_label").hide();
                $("#rent_adj_day").hide();
            }else{
                $("#rent_amt").show();
                $("#rent_amt_label").show();
                $("#rent_adj_day").show();
            }
        }
        
        function setup_select(){
            $('#mda_seq_select_1').change(update_select);
        }

        function update_select(depth,v){
            try{
                var seq = $('#mda_seq_select_'+depth).val();
                for(var i =5; i>depth;i--){
                    $('#mda_pro_'+i).empty();
                }
                g_depth= depth+1;
                if(v == 1){
                    $.get('mda_select_seq.php?up_mda_seq='+seq,update_select_callBack2);
                }else{
                    $.get('mda_select_seq.php?up_mda_seq='+seq,update_select_callBack);
                }
            }catch (e) {
            }
        }

        function update_select_callBack(option){
            $('#mda_pro_'+g_depth).html(option);
        }

        function update_select_callBack2(option){
            $('#mda_pro_'+g_depth).html(option);

            var dd = g_depth-1;
            if(g_depth <= <?=$prod_cnt?>) $('#mda_seq_select_'+g_depth).val(prod_select[dd]);
            if(g_depth < <?=$prod_cnt?>){

                $('#mda_seq_select_'+g_depth).val(prod_select[dd]);
                update_select(g_depth,1);
            }
        }

        function fmtrl_submit(f)
        {
            var depth = 0;
            depth = g_depth-1;
            var mda_seq = $('#mda_seq_select_'+depth).val();
            var last_mda_seq = $('#mda_seq_select_'+g_depth).val();


            if($('#mda_seq_select_1').val() !=undefined ){ //불려오지 않음
                if($('#mda_seq_select_1').val()==''){
                    alert("상품구분을 선택 하세요!");
                    return false;
                }else{
                    $('#mda_seq').val($('#mda_seq_select_1').val());
                }
            }

            if($('#mda_seq_select_2').val() !=undefined ){ //불려오지 않음
                if($('#mda_seq_select_2').val()==''){
                    alert("상품구분을 선택 하세요!");
                    return false;
                }else{
                    $('#mda_seq').val($('#mda_seq_select_2').val());
                }
            }

            if($('#mda_seq_select_3').val() !=undefined ){ //불려오지 않음
                if($('#mda_seq_select_3').val()==''){
                    alert("상품구분을 선택 하세요!");
                    return false;
                }else{
                    $('#mda_seq').val($('#mda_seq_select_3').val());
                }
            }

            if($('#mda_seq_select_4').val() !=undefined ){ //불려오지 않음
                if($('#mda_seq_select_4').val()==''){
                    alert("상품구분을 선택 하세요!");
                    return false;
                }else{
                    $('#mda_seq').val($('#mda_seq_select_4').val());
                }
            }


            if($('#ad_adj_type_code').val()=='ABB01'){ //비율
                var ad_amt = $('#ad_amt').val();
                ad_amt = ad_amt.replace(",", "");
                //alert(ad_amt);
                if(Number(ad_amt) < 0){
                    alert("광고료를 입력 하세요");
                    return false;
                }
            }else if($('#ad_adj_type_code').val()=='ABB02'){
                var ad_rt = $('#ad_rt').val();
                if(Number(ad_rt) > 0){
                    alert("광고료 비율을 입력 하세요");
                    return false;
                }
            }
            
            if( !($('#ins_cnt').val()>0)){
                alert("기기수를 입력 하세요");
                return false;
            }

/*
            if( !($('#rent_adj_type_code').val() =='N')){
                if(!($('#rent_amt').val() > 0)){
                    alert("임대료를 입력 하세요");
                    return false;
                }
                alert($('#rent_adj_day').val());
                if(!($('#rent_adj_day').val() > 0)){
                    alert("청구일자를 선택 하세요");
                    return false;
                }

            }*/

            //return false;

            return true;
        }


        function fcomp_del_submit(f){
            if(confirm("정말 삭제 하시겠습니까?")){
                location.href = 'mda_pro_form_pop_update.php?w=D&prod_seq=<?=$prod['prod_seq']?>';
            }else{
                return false;
            }

        }



    </script>

    </body>
    </html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다.