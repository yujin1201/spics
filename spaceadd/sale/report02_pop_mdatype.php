<?php
$sub_menu = "";
include_once('./_common.php');

include_once('./cont_form_common.php');
$g5['title'] = "월별 매체 구좌/재원 관리";
include_once(G5_SALE_PATH.'/sale.head.popup.php');


$yearmon = isset($_REQUEST['yearmon']) ? $_REQUEST['yearmon'] : '';
if (empty($yearmon) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $yearmon) ) $yearmon = G5_TIME_YM;

?>
    <script type="text/javascript">
        var source = {} ;
        var initiallySelectedRows = [];
        jQuery(function($) {
            source =
                {
                    datatype: "json",
                    datafields: [
                        { name : 'comm_seq'},
                        { name : 'comm_cd'},
                        { name : 'comm_cd_nm'},
                        { name : 'mdatype_seq'},
                        { name : 'yearmon'},
                        { name : 'mda_type_code'},
                        { name : 'mda_cnt', type: 'number'},
                        { name : 'mda_unitprc', type: 'number'},
                        { name : 'bigo'}
                    ],
                    url: g_sale_url+'/report02_pop_mdatype_result.php',
                    cache: false,
                    data: formParams($("#fcomp"))
                };

            var adapter = new $.jqx.dataAdapter(source );
            $("#grid").jqxGrid('clear');
            $("#grid").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapter,
                    columnsresize: true,
                    filterable: false,
                    sortable: true,
                    showstatusbar: true,
                    statusbarheight: 27,
                    showaggregates: true,
                    altrows: true,
                    editable:  true ,
                    autoshowfiltericon: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    columns: [
                         {text: '미디어명',datafield: 'comm_cd_nm',align: 'center', cellsformat: 'd',width: 180, editable: false }
                        ,{ text: '구좌수', datafield: 'mda_cnt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'd' ,
                            aggregates: ['sum'] ,
                            aggregatesrenderer: aggSum
                        } ,
                        ,{ text: '1구좌 금액', datafield: 'mda_unitprc', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'd' ,
                            aggregates: ['sum'] ,
                            aggregatesrenderer: aggSum
                        },
                        {
                            text: '총재원',  datafield: 'mda_tot',  editable: false,align: 'center', width: 100, cellsformat: 'd' ,
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total =  rowdata.mda_cnt  * rowdata.mda_unitprc ;
                                return "<div style='margin: 4px;' class='jqx-right-align'>" + adapter.formatNumber(total , 'd') + "</div>";
                            }
                            ,aggregates: [{
                                function (aggregatedValue, currentValue, column, record) {
                                    var total =  parseInt(record['mda_cnt'])  * parseInt(record['mda_unitprc']);
                                    return  aggregatedValue + total ;
                                }
                            }],
                            aggregatesrenderer: function (aggregates) {
                                var renderstring = "";
                                $.each(aggregates, function (key, value) {
                                    renderstring += "<div style='margin: 4px;' class='jqx-right-align'>"  +  value  + '</div>';
                                });
                                return renderstring;
                            }
                        }
                        ,{ text: '비고', datafield: 'bigo',align: 'center'  }
                        ,{datafield: 'comm_seq', hidden: true}
                        ,{datafield: 'yearmon', hidden: true}
                        ,{datafield: 'mda_type_code', hidden: true}
                        ,{datafield: 'mdatype_seq', hidden: true}
                    ]
                });
        });

        $("#grid").on("bindingcomplete", function (event) {
            $('#grid').jqxGrid('hideloadelement');
        });


        /*저장*/
        function fn_submit(){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
             params.media  = $('#grid').jqxGrid('getrows');  ;
            fn_submission("subForm", "./report02_pop_mdatype_update.php", params, true, fn_subCallback  );
        }

        function fn_subCallback(subid, voJson){
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
        $(function(){
            $("#yearmon" ).datepicker( $.datepicker.yearmon) ;
            $("#yearmon").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
            });
        });

        function fn_search(){
            $('#grid').jqxGrid('showloadelement');
            source.data = formParams($("#fcomp"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        }

    </script>
    <form name="fcomp" id="fcomp"  method="get" onsubmit="return false;"  >
        <div class="btn_list"  >
            <div style="line-height:50px; ">
                <strong  style="margin:30px" >년월</strong>
                <input  id="yearmon" name="yearmon"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$yearmon?>"  ></input>
                <button  class="btn btn_color05 btn_sm" onclick="fn_search();">검색</button>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:510px;">
            <div id="grid"  style="width: 100%; height: 100%;"></div>
        </div>
    </form>
    <div class="" align="center">
        <button  class="btn btn_save btn_lg" onclick="fn_submit();">저장</button>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>
    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>