<?php
$sub_menu = "";
include_once('./_common.php');

$stop_date =  date("Y-m-d",  strtotime(G5_TIME_YMD." +1 days"));

$g5['title'] = "계약 상품 중지";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>

    <!--계약 청구 -->
    <div class="tbl_frm01 tbl_wrap">
        <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
            <input type="hidden"  id="op_yn" name="op_yn" value="Y"/>
            <input type="hidden"  id="cont_seq" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>"/>
            <strong>중지일자</strong>
            <input  id="stop_date" name="stop_date"  ref="" maxlength="20"  length="6" class="frm_input ymd" value="<?=$stop_date?>"></input>
            <button type="button"  id="refresh" class="btn_submit">검색</button>
        </form>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:405px;">
            <div id="grid_stop"  style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>
    <div class="" align="center">
        <button  class="btn btn_save btn_lg" onclick="fn_mdaStop();">중지</button>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>

    <script>

        /*중지처리*/
        function fn_mdaStop(pStat, pFlag ="U") {
            var rowindexes = $('#grid_stop').jqxGrid('getselectedrowindexes');
            if(rowindexes.length ==0 ){
                alert("중지 처리할 상품을 선택하십시오.  ");
                return false ;
            }
            if(!confirm("중지하시겠습니까? ")){
                return false ;
            }
            var mdaList=[];
            rowindexes.forEach(function(element){
                var data = $('#grid_stop').jqxGrid('getrowdatabyid', element);
                mdaList.push(data)  ;
            } );
            var params  = Object.assign({},  {"mdaList" : mdaList }, formParams($("#fsearch")) );
            fn_submission("subStop", "./cont_form_pop_stop_update.php", params, true, fn_subMdaCallback  );
        }
        function fn_subMdaCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                var callbacks = $.Callbacks();
                callbacks.add(eval("opener.fn_refresh"));
                callbacks.fire(voJson.cont_seq);
                self.close();
            }catch (e) {
            }
        }

        var source_mda =
            {
                datatype: "json",
                datafields: [
                    {name: 'cont_mda_seq'},
                    {name: 'cont_seq'},
                    {name: 'prod_seq'},
                    {name: 'mda_comp_seq'},
                    {name: 'mda_comp_nm'},
                    {name: 'account_cnt'},
                    {name: 'equip_cnt'},
                    {name: 'guarant_pos'},
                    {name: 'multi_yn'},
                    {name: 'st_dt'},
                    {name: 'ed_dt'},
                    {name: 'act_st_time'},
                    {name: 'act_ed_time'},
                    {name: 'report_yn'},
                    {name: 'report_opt'},
                    {name: 'toss_dt'},
                    {name: 'mg_report_yn'},
                    {name: 'mg_report'},
                    {name: 'bigo'},
                    {name: 'entr_prsn'},
                    {name: 'entr_dt'},
                    {name: 'updt_prsn'},
                    {name: 'updt_dt'},
                    {name: 'mda_nm'},
                    {name: 'report_opt_nm'},
                    {name: 'comp_nm'},
                    {name: 'opdt_yn'},
                    {name: 'op_yn'}

                ],
                url: './cont_form_mda_result.php',
                cache: false,
                data: {
                    cont_seq: '<?php echo $_GET['cont_seq'] ?>'
                    , op_yn:'Y'
                    , stop_date : $("#stop_date").val().replaceAll("-", "")
                }
            };

        function mda_grid_load() {
            $("#grid_stop").jqxGrid('clear');

            var adapter_mda = new $.jqx.dataAdapter(source_mda);
            $("#grid_stop").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapter_mda,
                    columnsresize: true,
                    filterable: false,
                    sortable: false,
                    showstatusbar: true,
                    statusbarheight: 27,
                    showaggregates: true,
                    autoshowfiltericon: true,
                    autowidth: false,
                    selectionmode: 'checkbox',
                    columns: [
                        {
                            text: '#', sortable: false, filterable: false, editable: false,
                            groupable: false, draggable: false, resizable: false,
                            datafield: '', columntype: 'number', width: 50, cellsalign: 'center', align: 'center',
                            cellsrenderer: cellRowNum,
                            aggregates: ['count'],
                            aggregatesrenderer: aggCount
                        }
                        ,{text: '매체사',datafield: 'mda_comp_nm',align: 'center',width: 100}
                        ,{text: '매체',datafield: 'mda_nm',align: 'center',width: 200}
                        ,{text: '운영시작일',datafield: 'st_dt',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120}
                        ,{text: '종료일',datafield: 'ed_dt',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120}
                        ,{text: '송출중',datafield: 'opdt_yn',cellsalign: 'center',align: 'center',width: 60}
                        ,{text: '구좌수',datafield: 'account_cnt',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70,aggregates: ['sum'],aggregatesrenderer: aggSum}
                        ,{text: '기기수',datafield: 'equip_cnt',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70}
                        ,{text: '보장노출횟수(기/일)',datafield: 'guarant_pos',cellsalign: 'center',align: 'center',width: 110}
                        ,{text: '게첨보고서 필요여부',datafield: 'report_yn',cellsalign: 'center',align: 'center',width: 100}
                        ,{text: '게첨보고서 전달일자',datafield: 'toss_dt', cellsalign: 'center',align: 'center',cellsrenderer: cellYmd, width: 100}
                        ,{text: '관리보고서 필요여부',datafield: 'mg_report_yn',cellsalign: 'center',align: 'center',width: 100}
                        ,{text: '관리보고서 전달일자',datafield: 'mg_report',cellsalign: 'center',align: 'center',width: 100}
                        ,{text: '멀티소재 여부',datafield: 'multi_yn',cellsalign: 'center',align: 'center',width: 60}
                        ,{text: '등록일',datafield: 'entr_dt',cellsalign: 'center',align: 'center'}
                        ,{datafield: 'cont_seq', hidden: true}
                        ,{datafield: 'cont_mda_seq', hidden: true}
                    ]
                });
        };
        $(document).ready(function () {
            mda_grid_load();

            $("#refresh").click(function () {
                source_mda.data = formParams($("#fsearch"));
                $("#grid_stop").jqxGrid("updatebounddata", "cells");
            });

            $("#stop_date").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                minDate: new Date('<?echo $stop_date ?>>'),
                yearRange: "c-99:c+99"
            });
        }) ;
    </script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>