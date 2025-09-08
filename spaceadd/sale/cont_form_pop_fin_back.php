<?php
$sub_menu = "";
include_once('./_common.php');


if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {
    $sql = "select  a.fin_seq
              ,a.cont_seq 
              ,a.adj_yearmon
              ,a.adj_type_code
              ,a.sell_amt
              ,a.agnt_cmms_rt
              ,a.cnsg_cmms_rt
              ,a.agnt_cmms_amt
              ,a.cnsg_cmms_amt
              ,a.rep_cmms_rt
              ,a.rep_cmms_amt
              ,a.adj_yn
              ,a.adj_dt
              ,a.adj_num
              ,a.bill_dt
              ,a.bill_yn
              ,a.bill_rsv
              ,a.bill_snd   
              ,a.send_dt
              ,a.out_dt
              ,a.stl_condi_code
              ,a.stl_condi_cntnts
              ,a.tret_yn
              ,a.bigo
              ,a.entr_prsn
              ,(select mb_name from g5_member where mb_no =  a.entr_prsn) entr_prsn_nm
              ,a.entr_dt
              ,a.updt_prsn
              ,(select mb_name from g5_member where mb_no =  a.updt_prsn) updt_prsn_nm
              ,a.updt_dt
            , b.cont_stat 
          from  tb_cont_fin a, tb_cont b
          where a.fin_seq = {$_GET['fin_seq']}   and a.cont_seq = b.cont_seq ";


    
}else{
    $sql = "select   '' fin_seq,
            a.cont_seq,
            a.cont_yearmon adj_yearmon,
            a.cont_amt sell_amt ,
            15 agnt_cmms_rt,
            15 cnsg_cmms_rt,
            round(a.cont_amt *0.15 ) agnt_cmms_amt,
            round(a.cont_amt *0.15 ) cnsg_cmms_amt,
            'N' adj_yn,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d') bill_dt,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  send_dt  ,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  adj_dt  , 
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  out_dt  ,  
            a.cont_stat
          from  tb_cont a
          where cont_seq='{$_GET['cont_seq']}'";

    $del_able_yn ="N"  ;
    $save_able_yn ="Y"  ;
}

$cont_fin = sql_fetch($sql);

if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {
    if( $cont_fin['cont_stat'] == "BAC03" ||   $cont_fin['cont_stat'] == "BAC04" || $cont_fin['cont_stat'] =="BAC05" ){
        $del_able_yn ="N"  ;
        $save_able_yn ="N" ;
    }else{
        $del_able_yn ="Y"  ;
        $save_able_yn ="Y"  ;
    }

    //관리자 이상은 무조건 수정, 삭제 가능
    if($member['mb_level'] > 6) {
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

            try{
                $("#sell_amt").val(deleteIsNotValidateChar($("#sell_amt").val()))  ;
                $("#agnt_cmms_amt").val(deleteIsNotValidateChar($("#agnt_cmms_amt").val()))  ;
                $("#rep_cmms_amt").val(deleteIsNotValidateChar($("#rep_cmms_amt").val()))  ;
            }catch (e) {
            }


            //금액 바꿨을 때
            $("#sell_amt").bind("keyup", function(e, id){
                try{
                    var _obj = e.target ;
                    var sell_amt = Number(_obj.value.replaceAll(",", "")) ;
                    var agnt_cmms_rt = Number($("#agnt_cmms_rt").val().replaceAll(",", "")) ;

                    //대행수수료
                    var amt =  deleteIsNotValidateChar(Math.round(sell_amt * agnt_cmms_rt/100) .toString()) ;
                    $("#agnt_cmms_amt").val(amt);

                    //렙 수수료
                     var rep_cmms_rt = Number($("#rep_cmms_rt").val().replaceAll(",", "")) ;
                    if( rep_cmms_rt  > 0 ){
                        var amt1 =  deleteIsNotValidateChar(Math.round(sell_amt * rep_cmms_rt/100) .toString()) ;
                        $("#rep_cmms_amt").val(amt1);
                    }
                }catch (e) {
                    console.log(e)
                }

            });

            //수수료 금액 계산
            $("#agnt_cmms_rt").bind("keyup", function(e, id){
                var _obj = e.target ;
                var amt =  Math.round(Number(_obj.value/100) * Number($("#sell_amt").val().replaceAll(",", ""))) ;
                amt =  deleteIsNotValidateChar(amt.toString()) ;
                if(_obj.id == "agnt_cmms_rt"){
                    $("#agnt_cmms_amt").val(amt);
                }
            });

            //Rep 수수료 금액 계산
            $("#rep_cmms_rt").bind("keyup", function(e, id){
                var _obj = e.target ;
                var amt =  Math.round(Number(_obj.value/100) * Number($("#sell_amt").val().replaceAll(",", ""))) ;
                amt =  deleteIsNotValidateChar(amt.toString()) ;
                if(_obj.id == "rep_cmms_rt"){
                    $("#rep_cmms_amt").val(amt);
                }
            });

            <? if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {?>
            $("#adj_type_code").attr("disabled", true); //설정
            <?}?>

        });
        /*저장*/
        function fn_contFin_submit(f){
            var params = fn_chkForm("fcomp") ;
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
    <div class="btn_list03" style="padding-top:10px; padding-right: 10px"  >

    </div>
 <form name="fcomp" id="fcomp"  method="post" onsubmit="return false;"  >
    <input type="hidden" name="fin_seq" value="<?php echo $_GET['fin_seq'] ?>">
    <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>
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
                <th scope="row"><label for="sell_amt">청구금액(취급고)</label></th>
                <td>
                    <input  id="sell_amt" name="sell_amt"  maxlength="20" class="frm_input number required w130" value="<?=$cont_fin['sell_amt']?>" ></input>
                </td>
                <th scope="row"><label for="agnt_cmms_rt">대행수수료(율/금액)</label></th>
                <td>
                    <input  id="agnt_cmms_rt" name="agnt_cmms_rt"  maxlength="30" class="frm_input number required w50" value="<?=$cont_fin['agnt_cmms_rt']?>" ></input>%
                    <input  id="agnt_cmms_amt" name="agnt_cmms_amt"  maxlength="20" class="frm_input number required w130"  value="<?=$cont_fin['agnt_cmms_amt']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"></th>
                <td></td>
                <th scope="row"><label for="rep_cmms_rt">렙 수수료(율/금액)</label></th>
                <td>
                    <input  id="rep_cmms_rt" name="rep_cmms_rt"   maxlength="30" class="frm_input number  w50" value="<?=$cont_fin['rep_cmms_rt']?>" ></input>%
                    <input  id="rep_cmms_amt" name="rep_cmms_amt"  maxlength="20" class="frm_input number  w130" value="<?=$cont_fin['rep_cmms_amt']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bill_snd">세금계산서 발행처</label></th>
                <td>
                    <input  id="bill_snd" name="bill_snd"   maxlength="20"  length="6" class="frm_input w200" value="<?=$cont_fin['bill_snd']?>"></input>
                </td>
                <th scope="row"><label for="bill_rsv">세금계산서 수신처</label></th>
                <td>
                    <input  id="bill_rsv" name="bill_rsv"   maxlength="20"  length="6" class="frm_input w200" value="<?=$cont_fin['bill_rsv']?>"></input>
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
                <td >
                    <input  id="send_dt" name="send_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$cont_fin['send_dt']?>"></input>
                </td>
                <th scope="row"><label for="out_dt">출금일</label></th>
                <td>
                    <input  id="out_dt" name="out_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$cont_fin['out_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"><?php echo $cont_fin['bigo'] ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="bill_yn">세금계산서 발행여부</label></th>
                <td>
                    <? print_radioYN("bill_yn", $cont_fin['bill_yn'], "$type")  ?>
                </td>
                <th scope="row"><label for="bill_dt">세금계산서 발행일</label></th>
                <td>
                    <input  id="bill_dt" name="bill_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?=$cont_fin['bill_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="adj_yn">정산완료 여부</label></th>
                <td colspan="3">
                    <? print_radioYN("adj_yn", $cont_fin['adj_yn'], "$type")  ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="adj_dt">정산일</label></th>
                <td>
                    <input  id="adj_dt" name="adj_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?=$cont_fin['adj_dt']?>"></input>
                </td>
                <th scope="row"><label for="adj_num">정산번호</label></th>
                <td>
                    <input  id="adj_num" name="adj_num"   maxlength="20"  length="6" class="frm_input w200  " value="<?=$cont_fin['adj_num']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="tret_yn">상계여부</label></th>
                <td colspan="3">
                    <? print_radioYN("tret_yn", $cont_fin['tret_yn'], "$type")  ?>
                </td>
            </tr>
            <?php if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') { ?>
            <tr>
                <th scope="row"><label>등록자 / 등록일</label></th>
                <td><?=$cont_fin['entr_prsn_nm']?> / <?=$cont_fin['entr_dt']?></td>
                <th scope="row"><label>수정자 / 수정일</label></th>
                <td><?=$cont_fin['updt_prsn_nm']?> / <?=$cont_fin['updt_dt']?> </td>
            </tr>
          <? } ?>
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