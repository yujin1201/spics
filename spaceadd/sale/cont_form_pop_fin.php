<?php
$sub_menu = "";
include_once('./_common.php');

    $sql = "select  a.fin_seq 
                , a.cont_seq 
                , a.adj_yearmon 
                , a.inout_type 
                , a.adj_type_code 
                , a.sell_amt 
                , a.out_amt 
                , a.in_amt 
                , a.rsv_comp_seq 
                , a.snd_comp_seq 
                , a.agnt_cmms_rt 
                , a.cnsg_cmms_rt 
                , a.agnt_cmms_amt 
                , a.cnsg_cmms_amt 
                , a.rep_cmms_rt 
                , a.rep_cmms_amt 
                , a.adj_yn 
                , a.adj_dt 
                , a.adj_num 
                , a.bill_dt 
                , a.bill_yn 
                , a.bill_rsv 
                , a.bill_snd 
                , a.send_dt 
                , a.out_dt 
                , a.stl_condi_code 
                , a.stl_condi_cntnts 
                , a.tret_yn 
                , a.bigo 
                , a.entr_prsn   
                ,(select mb_name from g5_member where mb_no =  a.entr_prsn) entr_prsn_nm
                ,a.entr_dt
                ,a.updt_prsn
                ,(select mb_name from g5_member where mb_no =  a.updt_prsn) updt_prsn_nm
                ,a.updt_dt
                , b.cont_stat 
                ,ifnull((select comm_cd_nm from tb_code where comm_cd = b.deal_type_code  ), '') deal_type_nm
          from  tb_cont_fin a, tb_cont b
          where a.fin_seq = {$_GET['fin_seq']}   and a.cont_seq = b.cont_seq ";


$cont_fin = sql_fetch($sql);

if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {

    if( $cont_fin['cont_stat'] == "BAC01" ||   $cont_fin['cont_stat'] == "BAC02"  ){
        $del_able_yn ="Y"  ;
        $save_able_yn ="Y"  ;
    }else{
        $del_able_yn ="N"  ;
        $save_able_yn ="N" ;
    }

    //관리자 이상은 무조건 수정, 삭제 가능
    if($member['mb_level'] > 7) {
        $del_able_yn ="Y"  ;
        $save_able_yn ="Y"  ;
    }
    //송출은 무조건 수정불가
    if($member['mb_level']  == 4 ) {
        $del_able_yn ="N"  ;
        $save_able_yn ="N"  ;
    }
}

$cont_fin['adj_yearmon'] = date('Y-m',strtotime($cont_fin['adj_yearmon']."01"));
$cont_fin['bill_dt'] =  date('Y-m-d',strtotime($cont_fin['bill_dt']));
$cont_fin['send_dt'] =  date('Y-m-d',strtotime($cont_fin['send_dt']));
$cont_fin['adj_dt'] =  date('Y-m-d',strtotime($cont_fin['adj_dt']));
$cont_fin['out_dt'] =  date('Y-m-d',strtotime($cont_fin['out_dt']));

$g5['title'] = "계약청구 상세";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
    <script type="text/javascript">
        jQuery(function($) {

            try{

                $("#adj_yearmon" ).datepicker( $.datepicker.yearmon) ;
                $("#adj_yearmon").focus(function () {
                    $(".ui-datepicker-calendar").css("display","none");
                    $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
                });

                $("#bill_dt, #send_dt, #adj_dt, #out_dt").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",
                    showButtonPanel: true,
                    yearRange: "c-99:c+99"  });
                $("input[name='inout_type']:radio").attr("disabled", true); //설정
                $("input[name='inout_type']:radio[value='<?=$cont_fin['inout_type']?>']").prop('checked',true); // 해제하기

                <? if($cont_fin['inout_type'] =="ABD01") {?>
                    $("[class*='ABD01']").attr("disabled", false);
                    $("[class*='ABD02']").attr("disabled", true);

                    $("[class*='ABD01']").addClass("required");
                    $("[class*='ABD02']").removeClass("required");

                    $("#tr_agnt_cmms_rt").hide();
                    $("#agnt_cmms_rt").removeClass("required");
                <?}else{?>
                    $("[class*='ABD01']").attr("disabled", true);
                    $("[class*='ABD02']").attr("disabled", false);

                    $("[class*='ABD01']").removeClass("required");
                    $("[class*='ABD02']").addClass("required");

                    $("#tr_agnt_cmms_rt").show();
                    $("#agnt_cmms_rt").addClass("required");
                <?}?>

                <? if( $cont_fin['cont_stat'] == "BAC03" ||   $cont_fin['cont_stat'] == "BAC04" || $cont_fin['cont_stat'] =="BAC05" ){?>
                    $("#adj_type_code").attr("disabled", true);

                <?}?>
            }catch (e) {
                console.log(e)
            }
        });

        /*저장*/
        function fn_contFin_submit(f){
            var params = fn_chkForm("fcomp") ;
            params['inout_type'] ='<?=$cont_fin['inout_type']?>'  ;
            if(!params){
                return false ;
            }
            fn_submission("subForm", "./cont_form_pop_fin_update.php", params, true, fn_subFinCallback  );
        }
        /*삭제*/
        function fn_contFin_del(){
            if(!confirm("삭제 하시겠습니까? ")){
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subDel", "./cont_form_pop_fin_update.php", params, true, fn_subFinCallback  );
        }
        function fn_subFinCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                var callbacks = $.Callbacks();
                callbacks.add(eval("opener.fn_refresh"));
                callbacks.fire(voJson.cont_seq);
                self.close();
            }catch (e) {
                console.log(e)
            }
        }
    </script>
    <form name="fcomp" id="fcomp"  method="post" onsubmit="return false;"  >
        <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
        <input type="hidden" name="fin_seq" value="<?php echo $_GET['fin_seq'] ?>">
        <input type="hidden" name="cont_stat" value="<?php echo $cont_fin['cont_stat']?>">
        <div class="tbl_frm02 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col class="grid_3">
                    <col>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tr>
                    <th scope="row"><label for="inout_type">거래구분</label></th>
                    <td>
                        <label><input type='radio' name='inout_type' id='inout_type' value='ABD01'> 매출 </label>
                        <label><input type='radio' name='inout_type' id='inout_type' value='ABD02'> 매입</label>
                    </td>
                    <th scope="row"><label for=" "> 거래방식 </label></th>
                    <td>
                        <?echo $cont_fin['deal_type_nm']?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="adj_type_code">청구구분 </label></th>
                    <td>
                        <select name="adj_type_code" id="adj_type_code" onChange="" class="required">
                            <?print_option_with_select('BAH', $cont_fin['adj_type_code']);?>
                        </select>
                    </td>
                    <th scope="row"><label for="adj_yearmon">청구년월 </label></th>
                    <td>
                        <input  id="adj_yearmon" name="adj_yearmon"   maxlength="20"  length="6" class="frm_input ym" value="<?echo $cont_fin['adj_yearmon']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="out_amt">매출액</label></th>
                    <td >
                        <input  id="out_amt" name="out_amt"  maxlength="20" class="frm_input number w130 ABD01" value="<?=$cont_fin['out_amt']?>" ></input>
                    </td>
                    <th scope="row"><label for="in_amt">매입액</label></th>
                    <td >
                        <input  id="in_amt" name="in_amt"  maxlength="20" class="frm_input number  w130 ABD02" value="<?=$cont_fin['in_amt']?>" ></input>
                    </td>
                </tr>
                <tr id="tr_agnt_cmms_rt">
                    <th scope="row"><label for="out_amt">대행수수료율</label></th>
                    <td colspan="3">
                        <input  id="agnt_cmms_rt" name="agnt_cmms_rt"  maxlength="20" class="frm_input number  " value="<?=$cont_fin['agnt_cmms_rt']?>" ></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="bill_snd">세금계산서 발행처</label></th>
                    <td >
                        <? print_comp_all_search('snd_comp_seq', $cont_fin['snd_comp_seq'], $cont_fin['snd_comp_seq_nm'], '' , '', 'Y', 'Y', 'N') ?>
                    </td>
                    <th scope="row"><label for="rsv_comp_seq">세금계산서 수신처</label></th>
                    <td >
                       <? print_comp_all_search('rsv_comp_seq', $cont_fin['rsv_comp_seq'], $cont_fin['rsv_comp_seq_nm'], '' , '', 'Y', 'Y', 'N') ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="comp_seq">결제조건 </label></th>
                    <td>
                        <select name="stl_condi_code" id="stl_condi_code" onChange="">
                            <option value="">선택<?print_option_with_select('BAD', $cont_fin['stl_condi_code']);?>
                        </select>
                    </td>
                    <th scope="row"><label for="stl_condi_cntnts">결제조건 기타</label></th>
                    <td>
                        <input type="text" id="stl_condi_cntnts" name="stl_condi_cntnts" value="<?php echo $cont_fin['stl_condi_cntnts'] ?>"  class="frm_input w200"   >
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="send_dt">입금일</label></th>
                    <td>
                        <input  id="send_dt" name="send_dt"   maxlength="20"  length="6" class="frm_input ymd  ABD01" value="<?=$cont_fin['send_dt']?>"></input>
                    </td>
                    <th scope="row"><label for="out_dt">출금일</label></th>
                    <td>
                        <input  id="out_dt" name="out_dt"   maxlength="20"  length="6" class="frm_input ymd ABD02 " value="<?=$cont_fin['out_dt']?>"></input>
                    </td>

                </tr>
                <tr>
                    <th scope="row"><label for="bigo">청구 특이사항</label></th>
                    <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"><?php echo $cont_fin['bigo'] ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row"><label for="bill_yn">세금계산서 발행여부(MS)</label></th>
                    <td>
                        <? print_radioYN("bill_yn", $cont_fin['bill_yn'], "$type")  ?>
                    </td>
                    <th scope="row"><label for="bill_dt">세금계산서 발행일</label></th>
                    <td>
                        <input  id="bill_dt" name="bill_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?=$cont_fin['bill_dt']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="adj_yn">정산완료 여부(MS)</label></th>
                    <td colspan="3">
                        <? print_radioYN("adj_yn", $cont_fin['adj_yn'], "$type")  ?>
                    </td>
         <!--           <th scope="row"><label for="adj_dt">정산일(BM)</label></th>
                    <td>
                        <input  id="adj_dt" name="adj_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?php /*=$cont_fin['adj_dt']*/?>"></input>
                    </td>-->

                </tr>
                <tr>
                    <th scope="row"><label for="tret_yn">상계여부</label></th>
                    <td>
                        <? print_radioYN("tret_yn", $cont_fin['tret_yn'], "$type")  ?>
                    </td>
                    <th scope="row"><label for="adj_num">정산번호</label></th>
                    <td>
                        <input  id="adj_num" name="adj_num"   maxlength="20"  length="6" class="frm_input w200  " value="<?=$cont_fin['adj_num']?>" disabled></input>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
    <div class="" align="center">
        <?  if( $save_able_yn == "Y" ) {  ?>
            <button  class="btn btn_save btn_lg" onclick="return fn_contFin_submit(this);">저장</button>
        <?}?>
        <?  if( $del_able_yn == "Y" ) {  ?>
            <button  class="btn btn_del btn_lg" onclick="return fn_contFin_del(this);">삭제</button>
        <?}?>
        <button  class="btn btn_close btn_lg" onclick="return self.close();">닫기</button>
    </div>

    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>