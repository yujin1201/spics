<?php
$sub_menu = "";
include_once('./_common.php');

if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') {
    $sql = "select  a.cont_mda_seq,
            a.cont_seq,
            a.mda_comp_seq  ,
            (select comp_nm from tb_comp where comp_seq = a.mda_comp_seq) mda_comp_nm ,
            a.prod_seq,
            a.account_cnt,
            a.equip_cnt,
            a.guarant_pos,
            a.multi_yn,
            a.mtrl_sec ,
            a.st_dt,
            a.ed_dt,
            a.act_st_time,
            a.act_ed_time,
            ifnull(a.report_yn , 'N') report_yn ,
            a.report_opt,
            a.toss_dt,
            ifnull(a.mg_report_yn , 'N') mg_report_yn ,
            a.mg_report , 
            a.mda_cmms_rt   , 
            a.mda_cmms_amt   , 
            a.bigo,
            a.entr_prsn,
            (select mb_name from g5_member where mb_no =  a.entr_prsn) entr_prsn_nm,
            a.entr_dt, 
            a.updt_prsn,
            (select mb_name from g5_member where mb_no =  a.updt_prsn) updt_prsn_nm,
            a.updt_dt ,
            a.op_yn ,
            a.bns_yn ,
            ifnull(a.asg_use_yn, 'Y') asg_use_yn ,
            b.cont_stat ,
            b.cli_seq ,
            c.m1 , c.m2, c.m3, c.m4, c.m5 , c.full_nm, d.mda_nm
          from  tb_cont_mda a, tb_cont b, vi_media c, tb_comp_mda d
          where  a.cont_seq = b.cont_seq 
            and a.prod_seq = d.prod_seq 
            and d.mda_seq = c.mda_seq  
            and a.cont_mda_seq = {$_GET['cont_mda_seq']}   ";

    //상품 소재
    $sql_m = "SELECT
                a.cont_mtrl_seq, 
                a.mtrl_seq,
                a.bigo,
                date_format(a.st_dt,'%Y-%m-%d')  st_dt,
                date_format(a.ed_dt,'%Y-%m-%d')  ed_dt,
                a.entr_prsn,
                a.entr_dt,
                a.updt_prsn,
                a.updt_dt ,
                b.mtrl_nm 
            FROM tb_cont_mtrl a, tb_mtrl b 
            where a.cont_mda_seq = {$_GET['cont_mda_seq']}  
               and a.mtrl_seq = b.mtrl_seq 
            ORDER BY  st_dt desc , mtrl_seq 
            limit 0,2 "  ;
    $result_m = sql_query($sql_m);
    $m_row = array();
    while($row1 = sql_fetch_array($result_m)) {
        $m_row[] = $row1;
    }
}else{
    $sql = "select   '' cont_mda_seq,
            a.cont_seq,
            'Y' excpt_cnt,
            cont_st_dt st_dt,
            cont_ed_dt ed_dt  ,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  toss_dt  ,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  mg_report  ,   
            '0800' act_st_time  , 
            '1800'  act_ed_time  , 
            'Y' report_yn, 
            'Y' mg_report_yn ,
            15 mtrl_sec ,
            100 guarant_pos ,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y-%m-%d')  mg_report  , 
            a.cont_stat ,
            a.cont_amt ,
            a.cli_seq  
          from  tb_cont a
          where cont_seq='{$_GET['cont_seq']}'";
    $del_able_yn ="N"  ;
    $save_able_yn ="Y"  ;
}
$cont_mda = sql_fetch($sql);


//광고주 모든 소재
$mtrl_sql =" SELECT
      a.mtrl_seq  
    , a.mtrl_nm
    , a.mtrl_sec
    , a.use_yn
    , a.prod_type
    , a.indst_lrg_knd_cd
    , a.indst_mdl_knd_cd
    , a.indst_sml_knd_cd
    , a.insp_no
    , a.bigo
FROM tb_mtrl a, tb_cont b 
where a.comp_seq = b.cli_seq 
  and a.use_yn ='Y'
  and b.cont_seq ={$cont_mda['cont_seq']}  " ;
$result = sql_query($mtrl_sql);
$mtrl_row = array();
while($row = sql_fetch_array($result)) {
    $mtrl_row[] = $row;
}




if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') {
    $save_able_yn ="Y" ;
	$del_able_yn ="N"  ;
    if( $cont_mda['cont_stat'] == "BAC03" || $cont_mda['cont_stat'] == "BAC04" || $cont_mda['cont_stat'] =="BAC05" ){
		    if($member['mb_level'] > 7) { 
				$save_able_yn ="Y" ;
			}else{
				$del_able_yn ="N"  ;
				$save_able_yn ="N" ;
			}
    }else{
        $del_able_yn ="Y"  ;
    }
}
$cont_mda['st_dt'] =  date('Y-m-d',strtotime($cont_mda['st_dt']));
$cont_mda['ed_dt'] =  date('Y-m-d',strtotime($cont_mda['ed_dt']));
$cont_mda['toss_dt'] =  date('Y-m-d',strtotime($cont_mda['toss_dt']));
$cont_mda['mg_report'] =  date('Y-m-d',strtotime($cont_mda['mg_report']));

if(!isset($_GET['cont_mda_seq']) ) {
    $cont_mda['toss_dt'] = addDaysExcludingWeekends( $cont_mda['st_dt'] , 5 )   ;
    $cont_mda['mg_report'] =  addDaysExcludingWeekends( $cont_mda['st_dt'] , 20 )   ;
}
$g5['title'] = "계약상품 상세";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
    <script type="text/javascript">
        var mda_array = [] ;
        var source = {} ;

        jQuery(function($) {
            $('input[name="report_yn"]:checked').val('Y')    ;
            $('input[name="mg_report_yn"]:checked').val('Y')    ;
            try{
                //멀티소재
                $('input[name="multi_yn"]').change(function() {
                    if( $('input[name="multi_yn"]:checked').val() =="Y"){
                        $("#multi_mtrl").show() ;
                    }else{
                        $("#multi_mtrl").hide() ;
                    }
                });
                //게첨보고서
                $('input[name="report_yn"]').change(function() {
                    if( ($('input[name="report_yn"]:checked').val() ?? "") !='N'){
                        $(".report_yn").show() ;
                    }else{
                        $(".report_yn").hide() ;
                    }
                });
                //관리보고서
                $('input[name="mg_report_yn"]').change(function() {
                    if( $('input[name="mg_report_yn"]:checked').val() !='N'){
                        $(".mg_report_yn").show() ;
                    }else{
                        $(".mg_report_yn").hide() ;
                    }
                });
                $("#mtrl_sec").change(function() {
                    $('#mtrl_seq1, #mtrl_nm1, #mtrl_seq2, #mtrl_nm2').val('')    ;
                });
            }catch (e) {
                console.log(e)
            }

          <?if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') {?>
            $("#btn_comp_seq_find").hide() ;
            $("#account_cnt, #equip_cnt , #st_dt, #ed_dt ").addClass("readonly")
            $("#account_cnt, #equip_cnt , #st_dt, #ed_dt ").attr("disabled", true); //설정
          //  $("#mda_cmms_amt").val(deleteIsNotValidateChar($("#mda_cmms_amt").val())) ;

            setTimeout(function (){
                //소재
            <?
            for ($i=1; $i <= count($m_row); $i++) {
                $row = $m_row[$i-1] ;
            ?>
                $("#cont_mtrl_seq<?=$i?>").val('<?echo $row['cont_mtrl_seq']?>')  ;
                $("#mtrl_seq<?=$i?>").val('<?echo $row['mtrl_seq']?>')  ;
                $("#mtrl_nm<?=$i?>").val('<?echo $row['mtrl_nm']?>')  ;
                $("#mtrl_bigo<?=$i?>").val('<?echo $row['bigo']?>')  ;
            <?
            }
            ?>
                <?if($cont_mda['multi_yn'] =="Y"){?>
                $("#multi_mtrl").show() ;
                <?}?>

                $('input[name="report_yn"]:checked').val('<?echo $cont_mda['report_yn']?>')    ;
                $('input[name="mg_report_yn"]:checked').val('<?echo $cont_mda['mg_report_yn']?>')    ;

                <?if($cont_mda['report_yn'] =="N"){?>
                $(".report_yn").hide() ;
                <?}?>
                <?if($cont_mda['mg_report_yn'] =="N"){?>
                $(".mg_report_yn").hide() ;
                <?}?>
            }, 100)
         <?}?>

            $("#st_dt, #ed_dt, #toss_dt, #mg_report").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99"  });
            $("[id^='act_']").jqxMaskedInput({ mask: '[0-2][0-9]:[0-5][0-9]', theme:"frm_input", width:45});

            <?if(!isset($_GET['cont_mda_seq']) ) {?>
            source =
                {
                    datatype: "json",
                    datafields: [
                        { name : 'prod_seq'},
                        { name : 'mda_seq'},
                        { name : 'comp_seq'},
                        { name : 'mda_nm'},
                        { name : 'mda_cnt', type: 'number'},
                        { name : 'use_st_dt'},
                        { name : 'use_ed_dt'},
                        { name : 'use_st_time'},
                        { name : 'use_ed_time'},
                        { name : 'asg_use_yn'},
                        { name : 'mda_position'},
                        { name : 'mda_amt', type: 'number'},
                        { name : 'ins_cnt', type: 'number'},
                        { name : 'full_nm'} ,
                        { name : 'comp_nm'} ,
                    ],
                    url: g_sale_url+'/cont_form_pop_mda_mdalist.php',
                    cache: false,
                    data:{
                        comp_seq:' '
                    }
                };
            var adapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapter,
                    columnsresize: true,
                    filterable: false,
                    sortable: false,
                    showstatusbar: false,
                    statusbarheight: 27,
                    showaggregates: false,
                    selectionmode: 'checkbox',
                    altrows: true,
                    autoshowfiltericon: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    columns: [
                         {text: '상품명',datafield: 'mda_nm',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 250}
                        ,{text: '구좌수',datafield: 'mda_cnt',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70,  }
                        ,{ text: '단가', datafield: 'mda_amt', cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' }
                        ,{ text: '기기수', datafield: 'ins_cnt', cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' }
                        ,{text: '재원사용 여부',datafield: 'asg_use_yn',cellsalign: 'center',align: 'center',cellsformat: 'd' }
                        ,{datafield: 'prod_seq', hidden: true}
                        ,{datafield: 'use_st_time', hidden: true}
                        ,{datafield: 'use_ed_time', hidden: true}
                    ]
                });
            $("#grid").on("bindingcomplete", function (event) {
                $('#grid').jqxGrid('clearselection');
                $(".jqx-checkbox-default:first").hide();
            });
            $("#grid").on('rowselect', function (event){
                $("#mda_seq").val(event.args.row.mda_seq)  ;
                $("#prod_seq").val(event.args.row.prod_seq)  ;
                var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
                $.each(rowindexes, function (ff, k){
                    if(k != event.args.rowindex  ){
                        $('#grid').jqxGrid('unselectrow',k);
                    }
                }) ;
            });
            <?}?>

        });

        function fn_commSetCompPop(voJson){
            $("#mda_seq").val('')  ;
            $("#prod_seq").val('')  ;
            $("#grid").jqxGrid('clear');

            $("#comp_seq"+voJson.num).val(voJson.comp_seq);
            $("#comp_nm"+voJson.num).val(voJson.comp_nm );

            source.data = voJson;
            $("#grid").jqxGrid("updatebounddata", "cells");

            /*
            $("#comp_seq"+voJson.num).val(voJson.comp_seq);
            $("#comp_nm"+voJson.num).val(voJson.comp_nm);
            $('#prod_seq').children('option').remove();

            fn_submission("subForm", "./cont_form_pop_mda_mdalist.php", voJson, false, function(subid, josnList) {
                try{
                    opener.close() ;
                    if((josnList.length ?? 1) ==  0  ){
                        setTimeout(function () {
                            alert("등록된 상품이 없습니다. 다른 매체사를 선택하세요") ;
                            $("#comp_seq"+voJson.num).val('');
                            $("#comp_nm"+voJson.num).val('');
                            return false ;
                        }, 100) ;
                    }
                    if((josnList.length ?? 1 ) == 1  ){
                        josnList = [josnList]  ;
                    }
                    $.map(josnList, function (item){
                        var option = $("<option value='"+item.prod_seq+"'>"+item.full_nm +" : "+item.mda_nm+"</option>");
                        $('#prod_seq').append(option);
                    }) ;
                }catch (e) {
                    console.log(e)
                }
            });

             */
        }

        /*저장*/
        function fn_contMda_submit(){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            <?if(  $_GET['cont_mda_seq'] == '') {?>
            /*
            if(params.st_dt <= getTodayFullYear() ){
                alert("운행일은 오늘 이후 만 가능합니다. ");
                return false ;
            }
             */

            if(params.prod_seq == "" ){
                alert("상품을 선택하십시오.");
                return false ;
            }
            <?}?>
            fn_submission("subForm", "./cont_form_pop_mda_update.php", params, true, fn_subMdaCallback  );
        }
        /*삭제*/
        function fn_contMda_del(){
            if(!confirm("삭제 하시겠습니까? ")){
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subDel", "./cont_form_pop_mda_update.php", params, true, fn_subMdaCallback  );
        }
        function fn_subMdaCallback(subid, voJson){
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

/*
        4. 게첨보고서 / 관리보고서 일정 자동 설정 (주말은 가능, 법정공휴일은 무시 / 영업자가 수정 가능 )
        - 게첨보고서 : 워킹데이 기준 + 5일 뒤
        - 관리보고서 : 워킹데이 기준 + 20일 뒤
 */


    </script>
    <form name="fcomp" id="fcomp"  method="get" onsubmit="return false;"  >
        <input type="hidden" name="cont_mda_seq" value="<?php echo $_GET['cont_mda_seq'] ?>">
        <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
        <input type="hidden" name="mda_seq" id="mda_seq" value="<?=$cont_mda['mda_seq']?>"  >
        <input type="hidden" name="cont_stat" id="cont_stat" value="<?=$cont_mda['cont_stat']?>"  >
        <input type="hidden" name="cont_mtrl_seq1" id="cont_mtrl_seq1" value=""  >
        <input type="hidden" name="cont_mtrl_seq2" id="cont_mtrl_seq2" value=""  >
        <input type="hidden" name="prod_seq" id="prod_seq"  value="<?php echo $cont_mda['prod_seq'] ?>">
        <div class="tbl_frm02 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col class="grid_3">
                    <col class="grid_6">
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <?if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') {?>
                    <tr>
                        <th scope="row"><label for="op_yn">운행 확정 여부 </label></th>
                        <td>
                            <?if($cont_mda['op_yn'] =='Y'){?><b>운행 확정 </b><?}else{?>운행 미확정 <?}?>
                            <?if($cont_mda['asg_use_yn'] =='N'){?><b> (재원 사용 안 함) <?}?>
                        </td>
                        <th scope="row"><label>일련번호</label></th>
                        <td> <?echo $_GET['cont_mda_seq']?></td>
                    </tr>
                <?}?>

                <tr>
                    <th scope="row"><label for="excpt_cnt">매체사</label></th>
                    <td colspan="3" >
                        <? print_comp_search('AAC02', $cont_mda['mda_comp_seq'], $cont_mda['mda_comp_nm'] , '', 'Y', 'Y', 'N') ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mda_seq">상품</label></th>
                    <td colspan="3">
                        <?if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') {?>
                            <?echo $cont_mda['full_nm'] ." : ".$cont_mda['mda_nm']?>
                        <?}else{?>
                            <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:150px;">
                                <div id="grid"  style="width: 100%; height: 100%;"></div>
                            </div>
                        <?}?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="account_cnt">집행 구좌수</label></th>
                    <td>
                        <select name="account_cnt" id="account_cnt">
                            <?for($i=1 ; $i<26 ;$i++){?>
                                <option value="<?=$i?>"  <? if($cont_mda['account_cnt']== $i){?>selected<?}?> > <?=$i?> </option>
                            <?}?>
                        </select>
                    </td>
                    <th scope="row"><label for="bns_yn">서비스 여부</label></th>
                    <td>
                        <? print_radioYN("bns_yn", $cont_mda['bns_yn'], "")  ?>
                    </td>
                    <!--
                    <th scope="row"><label style="display: none" >집행 기수</label></th>
                    <td>
                        <input  id="equip_cnt" name="equip_cnt"  maxlength="10"  class="frm_input number  w50" value="<?=$cont_mda['equip_cnt']?>"  style="display: none" ></input>
                    </td>
                    -->
                </tr>
                <tr>
                    <th scope="row"><label for="st_dt">집행기간</label></th>
                    <td>
                        <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd"  value="<?=$cont_mda['st_dt']?>"></input>
                        ~
                        <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$cont_mda['ed_dt']?>"></input>
                    </td>
                    <th scope="row"><label for="st_time">운영시간</label></th>
                    <td>
                        <input  id="act_st_time" name="act_st_time"  maxlength="5" class="frm_input" value="<?=$cont_mda['act_st_time'] ?>" ></input>
                        ~
                        <input  id="act_ed_time" name="act_ed_time"  maxlength="5"  class="frm_input" value="<?=$cont_mda['act_ed_time']?>" ></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="guarant_pos">보장노출횟수(기/일)</label></th>
                    <td >
                        <input  id="guarant_pos" name="guarant_pos"  maxlength="50"   class="frm_input  w150" value="<?=$cont_mda['guarant_pos']?>" ></input>
                    </td>
                    <th scope="row"><label for="mtrl_sec">소재 초수</label></th>
                    <td>
                        <?php echo get_spin_select('mtrl_sec', 10, 120, $cont_mda['mtrl_sec'], 5) ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="multi_yn">멀티소재 여부</label></th>
                    <td>
                        <? print_radioYN("multi_yn", $cont_mda['multi_yn'], "$type")  ?>
                    </td>
                    <th scope="row"><label for="multi_yn">소재선택</label></th>
                    <td>
                        <?php  print_mtrl_search('',  '', $cont_mda['cli_seq'] , '1', 'Y', 'N','Y') ?>
                        <input  id="mtrl_bigo1" name="mtrl_bigo1"    class="frm_input  w100" value="" ></input>
                        <div id="multi_mtrl" name="multi_mtrl" style="display:none;" >
                            <?php  print_mtrl_search('',  '', $cont_mda['cli_seq'] , '2', 'Y', 'N','Y') ?>
                            <input  id="mtrl_bigo2" name="mtrl_bigo2"    class="frm_input  w100" value="" ></input>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="report_yn">게첨보고서 필요여부</label></th>
                    <td>
                        <? print_radioYN("report_yn", $cont_mda['report_yn'], "")  ?>
                        <!--
                        <select name="report_opt" id="report_opt" onChange="">
                            <option value="">선택<?print_option_with_select('BAF', $cont_mda['report_opt']);?>
                        </select>
                        -->
                    </td>
                    <th scope="row"><label for="toss_dt" class="report_yn">게첨보고서 전달일자</label></th>
                    <td>
                        <input  id="toss_dt" name="toss_dt"   maxlength="20"  length="6" class="frm_input ymd report_yn"  value="<?=$cont_mda['toss_dt']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_report_yn">관리보고서 필요여부</label></th>
                    <td>
                        <? print_radioYN("mg_report_yn", $cont_mda['mg_report_yn'], "")  ?>
                    </td>
                    <th scope="row"><label for="mg_report" class="mg_report_yn">관리보고서 전달일자</label></th>
                    <td>
                        <input  id="mg_report" name="mg_report"   maxlength="20"  length="6" class="frm_input ymd mg_report_yn"  value="<?=$cont_mda['mg_report']?>"></input>
                    </td>
                </tr>
                <!--
            <tr>
                <th scope="row"><label for="cnsg_cmms_rt">매체수수료(매월)</label></th>
                <td colspan="3">
                    <! --<input  id="mda_cmms_rt" name="mda_cmms_rt"   maxlength="30" class="frm_input number required w50" value="<?=$cont_mda['mda_cmms_rt']?>" ></input>%- ->
                    <input  id="mda_cmms_amt" name="mda_cmms_amt"  maxlength="20" class="frm_input number w130" value="<?=$cont_mda['mda_cmms_amt']?>" ></input>
                </td>
            </tr>
            -->
                <tr>
                    <th scope="row"><label for="bigo">비고</label></th>
                    <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"> <?php echo $cont_mda['bigo'] ?></textarea></td>
                </tr>
                <?php if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') { ?>
                    <tr>
                        <th scope="row"><label>등록자 / 등록일</label></th>
                        <td><?=$cont_mda['entr_prsn_nm']?> / <?=$cont_mda['entr_dt']?></td>
                        <th scope="row"><label>수정자 / 수정일</label></th>
                        <td><?=$cont_mda['updt_prsn_nm']?> / <?=$cont_mda['updt_dt']?> </td>
                    </tr>
                <? } ?>
                </tbody>
            </table>
        </div>
    </form>
    <div class="" align="center">
        <?  if( $save_able_yn == "Y" ) {  ?>
            <button  class="btn btn_save btn_lg" onclick="fn_contMda_submit();">저장</button>
        <?}?>
        <?  if( $del_able_yn == "Y" ) {  ?>
            <button  class="btn btn_del  btn_lg" onclick="return fn_contMda_del(this);">삭제</button>
        <?}?>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>
    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>