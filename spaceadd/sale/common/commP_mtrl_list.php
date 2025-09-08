<?php
$sub_menu = "100300";
include_once('../_common.php');

$g5['title'] ="광고주 소재 검색";
include_once(G5_SALE_PATH.'/sale.head.popup.php');
?>
    <script type="text/javascript">
        $(document).ready(function () {

            if('<?echo $_GET['mtrl_sec'] ?>' != '' ){
                $("#mtrl_sec").attr("readonly", true);
            }
            var voParasm = <?php echo json_encode(  $_GET);?>  ;
            $("#grid").jqxGrid('clear');
            var i = 5;
            var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'mtrl_seq'},
                        { name: 'comp_seq'},
                        { name: 'comp_nm'},
                        { name: 'mtrl_nm'},
                        { name: 'mtrl_sec'},
                        { name: 'use_yn'},
                        { name: 'prod_type'},
                        { name: 'bigo'},
                        { name: 'prod_type_nm'},
                        { name: 'entr_dt'}
                    ],
                    url: g_sale_url+'/common/commP_mtrl_list_result.php',
                    cache: false,
                    data: formParams($("#fsearch"))
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
                    ready: function () {
                    },
                    autoshowfiltericon: true,
                    columns: [
                        { text: '광고주 넘버', datafield: 'comp_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                        { text: '광고주 명', datafield: 'comp_nm', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:150 },
                        { text: '소재 넘버', datafield: 'mtrl_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                        { text: '소재명', datafield: 'mtrl_nm', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:150},
                        { text: '소재 초수', datafield: 'mtrl_sec', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:70},
                        { text: '사용 여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:70},
                        { text: '업종', datafield: 'prod_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                        { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  },
                        { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150}
                    ]
                });
            $("#refresh").click(function () {
                source.data = formParams($("#fsearch"))  ;
                $("#grid").jqxGrid("updatebounddata","cells");
            });
            $('#grid').on('rowdoubleclick', function (event) {
                try{
                    var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];

                    delete voParasm["callBack"];
                    delete voParasm["compType"];
                    getRowData.num =  '<?echo $_GET['num'] ?>';

                    getRowData = {...getRowData, ...voParasm } ;
                    var callbacks = $.Callbacks();
                    callbacks.add(eval("opener.<?php echo $_GET['callBack']?>"));
                    callbacks.fire(getRowData);
                    self.close();
                }catch (e) {
                    console.log(e)
                }
            });
        });
    </script>
    <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
        <input type="hidden"  id="cli_seq" name="cli_seq"  value="<?echo $_GET['cli_seq'] ?>" >
        <strong>소재명</strong>
        <input type="text" id="mtrl_nm" name="mtrl_nm" value=""    class="frm_input">
        <strong>소재초수</strong>
        <input type="text" id="mtrl_sec" name="mtrl_sec"   value="<?echo $_GET['mtrl_sec'] ?>"  class="frm_input">
        <input type="button" id="refresh" class="btn_submit" value="검색">
    </form>
    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%;  ">
        <div id="grid"  style="width: 100%; height: 100%;">
        </div>
    </div>
    </form>
    <div class="" align="center">
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>