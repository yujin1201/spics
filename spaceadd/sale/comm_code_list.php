<?php
$sub_menu = "100610";
include_once('./_common.php');

$g5['title'] = '공통코드 관리';
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
                    { name: 'comm_seq' , type: 'number'},
                    { name: 'comm_cd'},
                    { name: 'comm_type_cd'},
                    { name: 'comm_cd_nm'},
                    { name: 'up_comm_seq', type: 'number'},
                    { name: 'ord'},
                    { name: 'use_yn'},
                    { name: 'bigo1'},
                    { name: 'bigo2'},
                    { name: 'bigo3'},
                    { name: 'org_comm_seq'},
                ],
                hierarchy:
                    {
                        keyDataField: { name: 'comm_seq' },
                        parentDataField: { name: 'up_comm_seq' }
                    },
                id: 'comm_seq',
                url: g_sale_url+'/comm_code_list_result.php',
                cache: false,
                data: formParams($("#fsearch")) ,
                addRow: function (rowID, rowData, position, parentID, commit) {
                    commit(true);
                    newRowID = rowID;
                    $("#treegrid").jqxTreeGrid('checkRow', newRowID);
                }
            };
        var dataAdapter = new $.jqx.dataAdapter(source);
        var cellClass = function (row, dataField, cellText, rowData) {
            if (rowData['use_yn'] == "N") {
                return "cell_yn_n";
            }
            return "" ;
        }

        // create Tree Grid
        $("#treegrid").jqxTreeGrid(
            {
                width: '100%',
                height: '95%',
                source: dataAdapter,
                checkboxes: true,
                editable: true,
                sortable: true,
                ready: function()
                {
                    $("#treegrid").jqxTreeGrid('expandRow', '2');
                },
                columns: [
                    { text: '코드 명', dataField: 'comm_cd_nm', cellClassName: cellClass,  width: 300,'align':'center' },
                    { text: '코드', dataField: 'comm_cd', width: 150, cellClassName: cellClass, 'align':'center' ,'cellsalign':'center'},
                    { text: '순번',  dataField: 'ord', width: 70, cellClassName: cellClass, 'align':'center' ,'cellsalign':'center' },
                    { text: '사용여부',  dataField: 'use_yn', width: 70 , cellClassName: cellClass, 'align':'center' ,'cellsalign':'center'},
                    { text: '비고1',  dataField: 'bigo1', width: 200 ,'align':'center'},
                    { text: '비고2',  dataField: 'bigo2', width: 200 ,'align':'center'},
                    { text: '비고3',  dataField: 'bigo3', 'align':'center'},
                    {datafield: 'comm_seq', hidden: true} ,
                    {datafield: 'up_comm_seq', hidden: true} ,
                    {datafield: 'comm_type_cd', hidden: true} ,
                    {datafield: 'org_comm_seq', hidden: true}
                ]
            });

        $('#treegrid').on('bindingComplete', function (event) {
            $("#treegrid").jqxTreeGrid('sortBy', 'comm_type_cd', 'asc');
        });
        $("#treegrid").on('cellValueChanged', function (event) {
            try{
                $("#treegrid").jqxTreeGrid('checkRow', event.args.key);
            }catch (e) {
                console.log(e)
            }
        });
        $("#refresh").click(function () {
            code_reload()  ;
        });

        var rowKey = null;
        var rowValues = {} ;
        $("#treegrid").on('rowClick', function (event) {
            var args = event.args;
            rowKey = args.key;
            rowValues = args.row ;
        });
        $("#btnAdd").click(function (event) {
            if((rowValues.up_comm_seq ??"") == "" ){
                var _vals = {"up_comm_seq" : rowValues.comm_seq, "use_yn" :"Y" ,"comm_type_cd" : rowValues.comm_cd }  ;
                $("#treegrid").jqxTreeGrid('addRow', null,_vals, 'first', rowKey);
                $("#treegrid").jqxTreeGrid('expandRow',rowValues.comm_seq);
            }else{
               alert("하위 코드 등록 불가 합니다.") ;
               return false ;
            }
        });
        $("#btnAdd01").click(function (event) {
            var _vals = {"up_comm_seq" : "", "use_yn" :"Y", "ord":1, "comm_type_cd" :""}  ;
            $("#treegrid").jqxTreeGrid('addRow', null, _vals, 'first', null);

        });

        $("#btnSave").click(function (event) {
            var _data = $("#treegrid").jqxTreeGrid('getCheckedRows');
            if(_data.length ==0 ){
                alert("처리할 데이터를 선택하십시오.  ");
                return false ;
            }
            try{
                _data.map(function(ele){
                    delete ele.parent;
                    delete ele.records;
                    delete ele.originalRecord;
                });
            }catch (e) {
            }
            var params  =  {"codeList" : _data} ;
            fn_submission( "subSave" , "./comm_code_list_update.php", params, true, fn_subCodeCallback  );
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
                delete ele.parent;
                delete ele.records;
                delete ele.originalRecord;
            });
            var params  =  {"codeList" : _data} ;
            fn_submission( "subDel" , "./comm_code_list_update.php", params, true, fn_subCodeCallback  );
        });
        $("#btnexpandAll").click(function (event) {
            $("#treegrid").jqxTreeGrid('expandAll');

        });
        $("#btncollapseAll").click(function (event) {
            $("#treegrid").jqxTreeGrid('collapseAll');

        });

        function fn_subCodeCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                code_reload()  ;
            }catch (e) {
            }
        }
        function code_reload(){
            source.data = formParams($("#fsearch"))  ;
            $("#treegrid").jqxTreeGrid('updateBoundData');
        }
    });
</script>
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="height:70px">
    <input type="checkbox" id="use_yn" name="use_yn" value="Y"  class="frm_input" checked/><label for="use_yn">사용가능</label>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>
<div id="main_grid" class="tbl_wrap" style="width: 100%; height: 590px;">
    <div class="btn_list03">
        <button  id="btnAdd01" class="btn_color06"   style="">최상위 코드추가</button>
        <button  id="btnAdd" class="btn_new"   style="">추가</button>
        <button  id="btnSave"  class="btn_save"   style="">저장</button>
        <button  id="btnDel" class="btn_del"  >삭제</button>
    </div>
    <div id="treegrid"  style="width: 100%; height:95%;">
    </div>
    <div style='margin-top:5px;float: left;' class="btn_list03" >
        <button  id="btnexpandAll" class="btn_color12"  >모두 펼치기</button>
        <button  id="btncollapseAll" class="btn_color04">모두 접기</button>
    </div>
</div>
<?php
include_once (G5_PATH.'/sale.tail.php');
?>
