<?php
$sub_menu = "100600";
include_once('./_common.php');

$g5['title'] = '매체 관리';
include_once('./sale.head.php');
?>
<style>
    .cell_yn_n { background: #9c8061;}
    .cell_yn_n:hover, .cell_yn_n:focus, .cell_yn_n:active, .cell_yn_n.active { background: #81674b;}
    .jqx-datatable-light td.jqx-grid-cell-light, .jqx-treegrid-light .jqx-grid-cell-light {
        padding-top: 5px;
        padding-bottom: 5px;
    }
</style>
<script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxcheckbox.js"></script>
<script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxdatatable.js"></script>
<script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxtreegrid.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var newRowID = null;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'mda_seq' , type: 'number'},
                    { name: 'mda_nm'},
                    { name: 'mda_div_nm', type: "string" },
                    { name: 'mda_own_yn', type: "string" },
                    { name: 'mda_div', type: "string" },
                    { name: 'mda_type'},
                    { name: 'mda_prod'},
                    { name: 'mda_poi'},
                    { name: 'ord'},
                    { name: 'use_yn' },
                    { name: 'bigo'},
                    { name: 'up_mda_seq' , type: 'number'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'},
                    { name: 'last_yn'},
                    { name: 'depth'},
                    { name: 'org_mda_seq'},
                    { name: 'show_yn'},
                ],
                hierarchy:
                    {
                        keyDataField: { name: 'mda_seq' },
                        parentDataField: { name: 'up_mda_seq' }
                    },
                id: 'mda_seq',
                url: g_sale_url+'/comm_mda_list_result.php',
                cache: false,
                data: formParams($("#fsearch")) ,
                addRow: function (rowID, rowData, position, parentID, commit) {
                    commit(true);
                    newRowID = rowID;
                    $("#treegrid").jqxTreeGrid('checkRow', newRowID);
                }
            };
        var dataAdapter = new $.jqx.dataAdapter(source);
        var dsource = [
            { "comm_cd": "", "label": "선택" },
            { "comm_cd": "AAA01", "label": "인쇄매체" },
            { "comm_cd": "AAA02", "label": "디지털" }
        ];
        // create Tree Grid
        $("#treegrid").jqxTreeGrid(
            {
                width: '100%',
                height: '95%',
                source: dataAdapter,
                altRows: true,
                checkboxes: true,
                editable: true,
                columns: [
                    { text: '미디어 명', dataField: 'mda_nm', width: 400,'align':'center' },
                    { text: '순번',  dataField: 'ord', width: 70,'align':'center' ,'cellsalign':'center' },
                    { text: '구분', dataField: 'mda_div', displayfield : "mda_div_nm", width: 150, 'align': 'center', 'cellsalign': 'center' ,
                        columnType: "template",
                        createEditor: function (row, cellvalue, editor, cellText, width, height)
                        {
                            editor.jqxDropDownList({ autoDropDownHeight: true, source: dsource, valueMember: 'comm_cd', displayMember: 'label', width: '100%', height: '100%' });
                        },
                        initEditor: function (row, cellvalue, editor, celltext, width, height)
                        {
                            editor.jqxDropDownList('selectItem', cellvalue);
                        },
                        getEditorValue: function (row, cellvalue, editor)
                        {
                            var item = editor.jqxDropDownList('getSelectedItem');
                            if((item ??"") != ""){
                                $("#treegrid").jqxTreeGrid('setCellValue',row , 'mda_div', item.value);
                                return item.label;
                            }
                        }
                    },
                    { text: '자사여부',  dataField: 'mda_own_yn', width: 70 ,'align':'center' ,'cellsalign':'center'},
                    { text: '사용여부',  dataField: 'use_yn', width: 70 ,'align':'center' ,'cellsalign':'center'},
                    { text: '표시여부',  dataField: 'show_yn', width: 70 ,'align':'center' ,'cellsalign':'center'},
                    { text: '위치',  dataField: 'mda_poi', width: 150 ,'align':'center'},
                    { text: '비고',  dataField: 'bigo',  'align':'center'},
                    {datafield: 'mda_seq', hidden: true},
                    {datafield: 'last_yn', hidden: true},
                    {datafield: 'up_mda_seq', hidden: true},
                    {datafield: 'depth', hidden: true},
                    {datafield: 'org_mda_seq', hidden: true}
                ]
            });
        $("#refresh").click(function () {
            mda_reload()  ;
        });
        var rowKey = null;
        var rowValues = {} ;
        $("#treegrid").on('rowSelect', function (event) {
            var args = event.args;
            rowKey = args.key;
            rowValues = args.row ;
            return true ;
        });
        $("#treegrid").on('cellValueChanged', function (event) {
             $("#treegrid").jqxTreeGrid('checkRow', event.args.key);
        });

        $("#btnAdd").click(function (event) {
            var _vals = {"up_mda_seq" : rowValues.mda_seq, "depth" : rowValues.depth , "use_yn" :"Y", "last_yn" :"Y"}  ;
            $("#treegrid").jqxTreeGrid('addRow', null,_vals, 'first', rowKey);
        });
        $("#btnAdd01").click(function (event) {
            var _vals = {"up_mda_seq" :  '', "depth" :  '' , "use_yn" :"Y", "last_yn" :""}  ;
            $("#treegrid").jqxTreeGrid('addRow', null, _vals, 'first', null);
        });

        $("#btnSave").click(function (event) {
            var _data = $("#treegrid").jqxTreeGrid('getCheckedRows');
            if(_data.length ==0 ){
                alert("처리할 데이터를 선택하십시오.  ");
                return false ;
            }
            _data.map(function(ele){
                delete ele.parent
                delete ele.records
            });
            var params  =  {"mdaList" : _data} ;
            fn_submission( "subSave" , "./comm_mda_list_update.php", params, true, fn_subMdaCallback  );
        });
        $("#btnDel").click(function (event) {
            var _data = $("#treegrid").jqxTreeGrid('getCheckedRows');
            var _chk = true ;
            if(_data.length ==0 ){
                alert("처리할 데이터를 선택하십시오.  ");
                return false ;
            }
            _data.forEach(function(element){
                if((element.records ?? "") != ""){
                    alert("하위가 존재하므로 삭제가 불가합니다. ")
                    _chk = false ;
                     return false ;
                }
            });
            if(!_chk ) return false  ;
            _data.map(function(ele){
                delete ele.parent
                delete ele.records
            });
            var params  =  {"mdaList" : _data} ;
            fn_submission( "subDel" , "./comm_mda_list_update.php", params, true, fn_subMdaCallback  );
        });
        $("#btnexpandAll").click(function (event) {
            $("#treegrid").jqxTreeGrid('expandAll');

        });
        $("#btncollapseAll").click(function (event) {
            $("#treegrid").jqxTreeGrid('collapseAll');

        });



        function fn_subMdaCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                mda_reload()  ;
            }catch (e) {
            }
        }
        function mda_reload(){
            source.data = formParams($("#fsearch"))  ;
            $("#treegrid").jqxTreeGrid('updateBoundData');
        }
    });
</script>
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="height:70px">
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>
<div id="main_grid" class="tbl_wrap" style="width: 100%; height: 590px;">
    <div class="btn_list03">
        <button  id="btnAdd01" class="btn_color06"   style="">최상위 매체추가</button>
        <button  id="btnAdd" class="btn_new"   style="">추가</button>
        <button  id="btnSave"  class="btn_save"   style="">저장</button>
        <button  id="btnDel" class="btn_del"  >삭제</button>
    </div>
    <div id="treegrid"  style="width: 100%; height:95%;"></div>
    <div style='margin-top:5px;float: left;' class="btn_list03" >
        <button  id="btnexpandAll" class="btn_color12"  >모두 펼치기</button>
        <button  id="btncollapseAll" class="btn_color04">모두 접기</button>
    </div>
</div>
<?php
include_once ('./sale.tail.php');
?>
