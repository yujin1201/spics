<?php

include_once('./_common.php');

$g5['title'] = '매체 금지업종';
include_once('./sale.head.popup.php');


$sound_only = '<strong class="sound_only">필수</strong>';

if(isset($_GET['comp_seq']) && isset($_GET['item_code'])){
    //수정모드
    $w = "U";

    $sql = "SELECT comp_seq, item_code, use_yn, bigo, entr_prsn, entr_dt, updt_prsn, updt_dt FROM tb_comp_excpt where comp_seq = {$_GET['comp_seq']} and item_code='{$_GET['item_code']}'";


    $excpt = sql_fetch($sql);

}else{
    //신규 입력
    $w = "I";

    $chk = "checked";
}

?>
    <style type="text/css">
        html {overflow:hidden;}
    </style>
    <form name="fcomp" id="fcomp" action="./mda_excpt_form_pop_update.php" onsubmit="return fmtrl_submit(this);" method="post">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="comp_seq" value="<?php echo $_GET['comp_seq'] ?>">
        <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>


        <div class="tbl_frm01 tbl_wrap">
            <table>
                <tbody>
                <tr>
                    <th scope="row" style="width:180px"><label for="item_code">금지업종 선택<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <select name="item_code" id="item_code" onChange="" class="required">
                            <option value="">금지업종 선택<?print_option_with_select('AAD',$excpt['item_code']);?>
                        </select>
                    </td>
                    <th scope="row"><label for="use_yn">운영 여부<strong class="sound_only">필수</strong></label></th>
                    <td>
                        <input type="radio" name="use_yn" value="Y" id="use_yn" <?php echo $excpt['use_yn']=='Y'?'checked':''; ?> <?=$chk?>>
                        <label for="use_yn">Y</label>
                        <input type="radio" name="use_yn" value="N" id="use_yn" <?php echo $excpt['use_yn']=='N'?'checked':''; ?>>
                        <label for="use_yn">N</label>

                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="corp_no">등록 일시 / 작성자</label></th>
                    <td><input type="text" name="endt" id="entr"  class="frm_input readonly"  value="<?php echo $excpt['entr_dt'].' / '.$excpt['entr_prsn'] ?>" size="25" maxlength="20" readonly></td>
                    <th scope="row"><label for="corp_no">수정 일시 / 수정자</label></th>
                    <td><input type="text" name="updt" id="updt"  class="frm_input readonly"  value="<?php echo $excpt['updt_dt'].' / '.$excpt['updt_prsn'] ?>" size="25" maxlength="20" readonly></td>
                </tr>
                <tr>
                    <th scope="row"><label for="bigo">비고</label></th>
                    <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px;"><?php echo $excpt['bigo'] ?></textarea></td>
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

            <button  class="btn btn_save btn_lg" onclick="fmtrl_submit(this);">저장</button>

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
        });
        var prod_select = <?=json_encode($prod_seq_array)?> ;
        $(document).ready( function(){
            <?php
            if($prod_cnt > 1){
                $prod_select = 1;
            ?>
                update_select(1,1);
            <?php
            }
            ?>
        }


        );
        var g_depth;

        function setup_select(){
            $('#mda_seq_select_1').change(update_select);
        }

        function update_select(depth,v){

            var seq = $('#mda_seq_select_'+depth).attr('value');

            for(var i =5; i>depth;i--){
                $('#mda_pro_'+i).empty();
            }
            g_depth= depth+1;

            if(v == 1)$.get('mda_select_seq.php?depth='+g_depth+'&up_mda_seq='+seq,update_select_callBack2);
            else $.get('mda_select_seq.php?depth='+g_depth+'&up_mda_seq='+seq,update_select_callBack);

        }

        function update_select_callBack(option){

            //alert("g_depth==="+g_depth);
            $('#mda_pro_'+g_depth).html(option);
        }

        function update_select_callBack2(option){

            //alert("g_depth==="+g_depth);
            $('#mda_pro_'+g_depth).html(option);
            //alert(g_depth);

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


            if(Number(mda_seq) > 0){
                $('#mda_seq').val(mda_seq);
                //alert($('#mda_seq').val());
            }else{
                return false;
            }

            //return false;

            return true;
        }



    </script>

    </body>
    </html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다.