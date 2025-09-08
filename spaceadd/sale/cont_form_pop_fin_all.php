<?php
$sub_menu = "";
include_once('./_common.php');

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
            a.cont_stat ,
            ifnull((select comm_cd_nm from tb_code where comm_cd = a.deal_type_code  ), '') deal_type_nm ,
            a.cont_type_code 
          from  tb_cont a
          where cont_seq='{$_GET['cont_seq']}'";
    $del_able_yn ="N"  ;
    $save_able_yn ="Y"  ;

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

            <? if(isset($_GET['fin_seq']) &&  $_GET['fin_seq'] != '') {?>
            $("#adj_type_code").attr("disabled", true); //설정
            <?}?>

            $("input[name='inout_type']:radio").change(function () {
                fn_inoutType( this.value)
            });
            fn_inoutType('ABD01')


            $("#grid").jqxGrid('clear');
            var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'comp_seq'},
                        { name: 'comp_type'},
                        { name: 'comp_type_nm'},
                        { name: 'comp_nm'} ,
                        { name: 'out_amt', type: 'number'},
                    ],
                    cache: false
                };
            var adapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
                {
                    width: '100%',
                    height: '150px',
                    source: adapter,
                    columnsresize: true,
                    filterable: false,
                    sortable: false,
                    showstatusbar: true,
                    statusbarheight: 27,
                    showaggregates: true,
                    selectionmode: 'checkbox',
                    altrows: true,
                    autoshowfiltericon: true,
                    editable: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    autoshowfiltericon: true,
                    columns: [
                        { text: '일련번호', datafield: 'comp_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center',width:70, editable: false},
                        { text: '회사구분', datafield: 'comp_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100, editable: false},
                        { text: '거래처명', datafield: 'comp_nm', filtertype: 'checkedlist',  cellsalign: 'center', align: 'center'  ,width:250, editable: false},
                        { text: '매출액', datafield: 'out_amt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:200,  cellsformat: 'n' ,
                            aggregates: ['sum'] ,
                            aggregatesrenderer: aggSum
                        }
                    ]
                });
            $("#grid").on("bindingcomplete", function (event) {
                $('#grid').jqxGrid('clearselection');
            });

            $("#grid").on('rowselect', function (event){
                $('#grid').jqxGrid('refreshaggregates');
            });
            $("#grid").on('rowunselect', function (event){
                $('#grid').jqxGrid('refreshaggregates');
            });
        });

        /*저장*/
        function fn_contFin_submit(f){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            //매출일 경우 수신처
            if($(':radio[name="inout_type"]:checked').val() == "ABD01" ){
                if ($('#grid').jqxGrid('getrows').length == 0 ) {
                    alert("세금계산서 수신처를 추가해주세요");
                    return false;
                }
                params.rsv_comp_arr = $('#grid').jqxGrid('getrows')
            }
            fn_submission("subForm", "./cont_form_pop_fin_update.php", params, true, fn_subFinCallback  );
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

        function fn_inoutType(inType){
            if(inType =="ABD01"){
                $("[class*='ABD01']").attr("disabled", false);
                $("[class*='ABD02']").attr("disabled", true);

                $("[class*='ABD01']").addClass("required");
                $("[class*='ABD02']").removeClass("required");


                $("#snd_comp_seq").val("100") ;
                $("#snd_comp_seq_nm").val("㈜스페이스애드") ;

                $("#rsv_comp_seq").val("") ;
                $("#rsv_comp_seq_nm").val("") ;
                $("#rsv_comp_seq").removeClass("required");

                $("#bill_rsv_div_ABD01").show();
                $("#bill_rsv_div_ABD02").hide();

                $("#tr_agnt_cmms_rt").hide();
                $("#agnt_cmms_rt").removeClass("required");

            }else{
                $("[class*='ABD01']").attr("disabled", true);
                $("[class*='ABD02']").attr("disabled", false);

                $("[class*='ABD01']").removeClass("required");
                $("[class*='ABD02']").addClass("required");

                $("#snd_comp_seq").val("") ;
                $("#snd_comp_seq_nm").val("") ;

                $("#rsv_comp_seq").val("100") ;
                $("#rsv_comp_seq_nm").val("㈜스페이스애드") ;
                $("#rsv_comp_seq").addClass("required");

                $("#bill_rsv_div_ABD01").hide();
                $("#bill_rsv_div_ABD02").show();

                $("#tr_agnt_cmms_rt").show();
                $("#agnt_cmms_rt").addClass("required");
            }
        }

        //회사 검색 팝업
        function fn_findComppPopGrid(compType ){
            try{
                var winTlt  ="거래처" ;
                var url ="/spaceadd/sale/common/commP_comp_list.php?compType=AAC&callBack=fn_setCompPopGrid"  ;
                basicPopupOpen(url, winTlt, "900", "620")  ;
            }catch (e) {
                console.log(e)
            }
        };

        function fn_setCompPopGrid(voJson){
            $("#grid").jqxGrid('addrow', null, [voJson]);
        }
        function fn_deleteGrid(){
            try{
                var chk = $('#grid').jqxGrid('getselectedrowindexes');
                if(chk.length <= 0 ){
                    alert("삭제할 거래처를 선택하십시오. ");
                    return false ;
                }
                var id = $("#grid").jqxGrid('getrowid', chk);
                var commit = $("#grid").jqxGrid('deleterow', id);
            }catch (e) {
                console.log(e)
            }
        }

    </script>
    <div class="btn_list03" style="padding-top:10px; padding-right: 10px"  >

    </div>
 <form name="fcomp" id="fcomp"  method="post" onsubmit="return false;"  >
    <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
    <input type="hidden" name="cont_type_code" value="<?php echo $cont_fin['cont_type_code']  ?>">
    <input type="hidden" name="cont_yearmon" value="<?php echo str_replace('-' ,'',$cont_fin['adj_yearmon'] ) ?>">
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
                <th scope="row"><label for="inout_type">거래구분 </label></th>
                <td>
                    <label><input type='radio' name='inout_type' id='inout_type' value='ABD01'  checked  > 매출 </label>
                    <label><input type='radio' name='inout_type' id='inout_type' value='ABD02'  > 매입</label>
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
                <th scope="row"><label for="bill_snd">세금계산서 발행처</label></th>
                <td >
                    <? print_comp_all_search('snd_comp_seq', '', '', '' , '', 'Y', 'Y', 'N') ?>
                </td>
                <th scope="row"><label for="in_amt">매입액</label></th>
                <td >
                    <input  id="in_amt" name="in_amt"  maxlength="20" class="frm_input number  w130 ABD02" value="<?=$cont_fin['in_amt']?>" ></input>
                </td>
                <!--
                <th scope="row"><label for="out_amt">매출액</label></th>
                <td >
                    <input  id="out_amt" name="out_amt"  maxlength="20" class="frm_input number w130 ABD01" value="<?=$cont_fin['out_amt']?>" ></input>
                </td>
                -->
            </tr>
            <tr>
                <th scope="row"><label for="rsv_comp_seq">세금계산서 수신처</label></th>
                <td colspan="3">
                    <div id="bill_rsv_div_ABD02" class="tbl_head01 tbl_wrap" style="width: 100%;">
                      <? print_comp_all_search('rsv_comp_seq', '', '', '' , '', '', 'Y', 'N') ?>
                    </div>
                    <div id="bill_rsv_div_ABD01" class="tbl_head01 tbl_wrap" style="width:90%;  ">
                         <button type="button"  id="btn_rsv" class="btn_find"  onClick="fn_findComppPopGrid()">검색</button>
                         <button type="button"  id="btn_d" class="btn_delIcon"  onClick="fn_deleteGrid('')">삭제</button>
                        <div id="grid" style="width:100%; height:200px;"></div>
                    </div>
                </td>
            </tr>
            <tr id="tr_agnt_cmms_rt">
                <th scope="row"><label for="agnt_cmms_rt">대행수수료율</label></th>
                <td colspan="3">
                    <input  id="agnt_cmms_rt" name="agnt_cmms_rt"  maxlength="20" class="frm_input number  " value="<?=$cont_fin['agnt_cmms_rt']?>" ></input>
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
<!--                <th scope="row"><label for="adj_dt">정산일(BM)</label></th>
                <td >
                    <input  id="adj_dt" name="adj_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?php /*=$cont_fin['adj_dt']*/?>"></input>
                </td>-->
                <!--
                <th scope="row"><label for="adj_num">정산번호</label></th>
                <td>
                    <input  id="adj_num" name="adj_num"   maxlength="20"  length="6" class="frm_input w200  " value="<?=$cont_fin['adj_num']?>"></input>
                </td>
                -->
            </tr>
            <tr>
                <th scope="row"><label for="tret_yn">상계여부</label></th>
                <td colspan="3">
                    <? print_radioYN("tret_yn", $cont_fin['tret_yn'], "$type")  ?>
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