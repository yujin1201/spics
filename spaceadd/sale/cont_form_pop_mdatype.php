<?php
$sub_menu = "";
include_once('./_common.php');

include_once('./cont_form_common.php');
$cont = fn_contInfo($_GET['cont_seq'])  ;
$save_able_yn ="Y" ;
if( $cont['cont_stat'] == "BAC03" || $cont['cont_stat'] == "BAC04" || $cont['cont_stat'] =="BAC05" ){
        $save_able_yn ="N" ;
}
$g5['title'] = "계약 매체별 금액";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

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
                        { name : 'cont_mdatype_seq'},
                        { name : 'cont_seq'},
                        { name : 'mda_type_code'},
                        { name : 'mda_amt', type: 'number'},
                        { name : 'mda_cmms_amt', type: 'number'},
                        { name : 'mda_cost', type: 'number'},
                        { name : 'bigo'}
                    ],
                    url: g_sale_url+'/cont_form_pop_mdatype_result.php',
                    cache: false,
                    data:{
                        cont_seq: '<?php echo $_GET['cont_seq']?>'
                    }
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
                    selectionmode: 'checkbox',
                    altrows: true,
                    editable:  true ,
                    autoshowfiltericon: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    columns: [
                         {text: '미디어명',datafield: 'comm_cd_nm',align: 'center', cellsformat: 'd',width: 180, editable: false }
                        ,{ text: '매출', datafield: 'mda_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'd' ,
                            aggregates: ['sum'] ,
                            aggregatesrenderer: aggSum
                        }
                        ,{ text: '매입', datafield: 'mda_cmms_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'd' ,
                            aggregates: ['sum'] ,
                            aggregatesrenderer: aggSum
                        } ,
                        {
                            text: '정산금액(자동계산)',  datafield: 'mda_cost',  editable: false,align: 'center', width: 120, cellsformat: 'd' ,
                            cellsrenderer: function (index, datafield, value, defaultvalue, column, rowdata) {
                                var total =  rowdata.mda_amt   -   rowdata.mda_cmms_amt ;
                                return "<div style='margin: 4px;' class='jqx-right-align'>" + adapter.formatNumber(total , 'd') + "</div>";
                            }
                            ,aggregates: [{
                                function (aggregatedValue, currentValue, column, record) {
                                    var total =  parseInt(record['mda_amt']) - parseInt(record['mda_cmms_amt']);
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
                        ,{datafield: 'cont_mdatype_seq', hidden: true}
                        ,{datafield: 'cont_seq', hidden: true}
                        ,{datafield: 'mda_type_code', hidden: true}
                    ]
                });
        });

        /*저장*/
        function fn_submit(){
            var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
            if(rowindexes.length ==  0 ){
                alert("등록할 매체를 선택하십시오.  ");
                return false ;
            }
            var media=[];
            var gridSum = 0 ;
            rowindexes.forEach(function(element){
                var data = $('#grid').jqxGrid('getrowdatabyid', element);
                media.push(data)  ;
                gridSum = gridSum + Number(data.mda_amt)   ;
            } );
            if(gridSum  !=  <?php echo $cont['cont_amt'] ?> ){
                alert("합이 계약의 청약금액 (<?php echo number_format($cont['cont_amt']) ?> 원) 과 동일해야 합니다. ")
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
             params.media  = media ;
            fn_submission("subForm", "./cont_form_pop_mdatype_update.php", params, true, fn_subCallback  );
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

    </script>
    <form name="fcomp" id="fcomp"  method="get" onsubmit="return false;"  >
        <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
        <div class="btn_list" style="margin-top:5px">
            <div>
                <b>* 수정 시 체크되지 않은 항목은 삭제됩니다.</b>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:520px;">
            <div id="grid"  style="width: 100%; height: 100%;"></div>
        </div>
    </form>
    <div class="" align="center">
        <?  if( $save_able_yn == "Y" ) {  ?>
            <button  class="btn btn_save btn_lg" onclick="fn_submit();">저장</button>
        <?}?>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>
    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>