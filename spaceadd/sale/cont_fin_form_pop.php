<?php
$sub_menu = "";
include_once('./_common.php');


if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {
    $sql = "select  a.fin_seq,
            a.cont_seq,
            a.adj_yearmon,
            a.sell_amt,
            a.agnt_cmms_rt,
            a.cnsg_cmms_rt,
            a.agnt_cmms_amt,
            a.cnsg_cmms_amt,
            a.adj_yn,
            a.bill_dt,
            a.send_dt,
            a.stl_condi_code,
            a.stl_condi_cntnts,
            a.bigo,
            a.entr_prsn,
            a.entr_dt,
            a.updt_prsn,
            a.updt_dt ,
            b.cont_stat 
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
            a.cont_stat
          from  tb_cont a
          where cont_seq='{$_GET['cont_seq']}'";

    $del_able_yn ="N"  ;
    $save_able_yn ="Y"  ;
}

$cont_fin = sql_fetch($sql);

if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {
    if(  $cont_fin['cont_stat'] == "BAC04" || $cont_fin['cont_stat'] =="BAC05" ){
        $del_able_yn ="N"  ;
        $save_able_yn ="N" ;
    }else{
        $del_able_yn ="Y"  ;
        $save_able_yn ="Y"  ;
    }
}

$cont_fin['adj_yearmon'] = date('Y-m',strtotime($cont_fin['adj_yearmon']."01"));
$cont_fin['bill_dt'] =  date('Y-m-d',strtotime($cont_fin['bill_dt']));
$cont_fin['send_dt'] =  date('Y-m-d',strtotime($cont_fin['send_dt']));
 
$g5['title'] = "계약 청구 상세";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
    <script type="text/javascript">
        jQuery(function($) {

            $("#adj_yearmon" ).datepicker( $.datepicker.yearmon) ;
            $("#adj_yearmon").focus(function () {
                $(".ui-datepicker-calendar").css("display","none");
                $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
            });

            $("#bill_dt, #send_dt").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                yearRange: "c-99:c+99"  });

            $("#sell_amt").val(deleteIsNotValidateChar($("#sell_amt").val()))  ;
            $("#agnt_cmms_amt").val(deleteIsNotValidateChar($("#agnt_cmms_amt").val()))  ;
            $("#cnsg_cmms_amt").val(deleteIsNotValidateChar($("#cnsg_cmms_amt").val()))  ;


            //금액 바꿨을 때
            $("#sell_amt").bind("keyup", function(e, id){
                    var _obj = e.target ;
                    var sell_amt = Number(_obj.value.replaceAll(",", "")) ;
                    var agnt_cmms_rt = Number($("#agnt_cmms_rt").val().replaceAll(",", "")) ;
                    var cnsg_cmms_rt = Number($("#cnsg_cmms_rt").val().replaceAll(",", "")) ;

                    //대행수수료
                    var amt =  deleteIsNotValidateChar(Math.round(sell_amt * agnt_cmms_rt/100) .toString()) ;
                    $("#agnt_cmms_amt").val(amt);

                    //매체수수료
                    var amt1 =  deleteIsNotValidateChar(Math.round(sell_amt * cnsg_cmms_rt/100) .toString()) ;
                    $("#cnsg_cmms_amt").val(amt);
            });

            //수수료 금액 계산
            $("#agnt_cmms_rt, #cnsg_cmms_rt").bind("keyup", function(e, id){
                var _obj = e.target ;
                var amt =  Math.round(Number(_obj.value/100) * Number($("#sell_amt").val().replaceAll(",", ""))) ;
                amt =  deleteIsNotValidateChar(amt.toString()) ;
                if(_obj.id == "agnt_cmms_rt"){
                    $("#agnt_cmms_amt").val(amt);
                }else{
                    $("#cnsg_cmms_amt").val(amt);
                }
            });

        });
        /*저장*/
        function fn_contFin_submit(f){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subForm", "./cont_fin_form_pop_update.php", params, true, fn_subFinCallback  );
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
            fn_submission("subDel", "./cont_fin_form_pop_update.php", params, true, fn_subFinCallback  );
        }
        function fn_subFinCallback(subid, voJson){
            alert("처리 되었습니다.") ;
            var callbacks = $.Callbacks();
            callbacks.add(eval("opener.fn_refrsh"));
            callbacks.fire(voJson.cont_seq);
            self.close();
        }
    </script>

 <form name="fcomp" id="fcomp"  method="post">
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
            <tbody>
            <tr>
                <th scope="row"><label for="adj_yearmon">청구 년월 </label></th>
                <td colspan="3">
                    <input  id="adj_yearmon" name="adj_yearmon"   maxlength="20"  length="6" class="frm_input ym" value="<?echo $cont_fin['adj_yearmon']?>"></input>
                </td> 
            </tr>
            <tr>
                <th scope="row"><label for="sell_amt">청구금액(취급고)</label></th>
                <td>
                    <input  id="sell_amt" name="sell_amt"  maxlength="20" class="frm_input number required" value="<?=$cont_fin['sell_amt']?>" ></input>
                </td>
                <th scope="row"><label for="adj_yn">정산여부</label></th>
                <td>
                    <? print_radioYN("adj_yn", $cont_fin['adj_yn'], "$type")  ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="agnt_cmms_rt">대행수수료(율/금액)</label></th>
                <td>
                    <input  id="agnt_cmms_rt" name="agnt_cmms_rt"  style="width: 50px" maxlength="30" class="frm_input number required" value="<?=$cont_fin['agnt_cmms_rt']?>" ></input>%
                    <input  id="agnt_cmms_amt" name="agnt_cmms_amt"  maxlength="20" class="frm_input number required" value="<?=$cont_fin['agnt_cmms_amt']?>" ></input>
                </td>
                <th scope="row"><label for="cnsg_cmms_rt">매체수수료(율/금액)</label></th>
                <td>
                    <input  id="cnsg_cmms_rt" name="cnsg_cmms_rt"  style="width: 50px" maxlength="30" class="frm_input number required" value="<?=$cont_fin['cnsg_cmms_rt']?>" ></input>%
                    <input  id="cnsg_cmms_amt" name="cnsg_cmms_amt"  maxlength="20" class="frm_input number required" value="<?=$cont_fin['cnsg_cmms_amt']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bill_dt">청구일(계산서 발행일)</label></th>
                <td>
                    <input  id="bill_dt" name="bill_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?=$cont_fin['bill_dt']?>"></input>
                </td>
                <th scope="row"><label for="send_dt">입금일</label></th>
                <td>
                    <input  id="send_dt" name="send_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$cont_fin['send_dt']?>"></input>
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
                    <input type="text" id="stl_condi_cntnts" name="stl_condi_cntnts" value="<?php echo $cont_fin['stl_condi_cntnts'] ?>"  class="frm_input" size="30"  >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px "> <?php echo $cont_fin['bigo'] ?></textarea></td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="" align="center">
        <?  if( $save_able_yn == "Y" ) {  ?>
        <button  class="btn btn_save btn_lg" onclick="fn_contFin_submit(this);">저장</button>
        <?}?>
        <?  if( $del_able_yn == "Y" ) {  ?>
        <button  class="btn btn_del btn_lg" onclick="fn_contFin_del(this);">삭제</button>
        <?}?>
        <button  class="btn btn_close btn_lg" onclick="self.close();">닫기</button>
    </div>
</form>
</body>
</html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>