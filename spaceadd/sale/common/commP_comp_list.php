<?php
$sub_menu = "100300";
include_once('../_common.php');

$tlt_name = "" ;
$comp_type="AAC01" ;
if(isset($_GET['compType']) &&  $_GET['compType'] != ''){
    $comp_type =$_GET['compType']  ;
}

$sql = " select comm_cd_nm from tb_code where comm_type_cd='AAC' and  comm_cd = '{$comp_type}' ";
$row = sql_fetch($sql);
$tlt_name =$row['comm_cd_nm'] ;
$g5['title'] =$tlt_name." 검색";

include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
<script type="text/javascript">

    $(document).ready(function () {
        var voParam = <?php echo json_encode(  $_GET);?>  ;

        $("#grid").jqxGrid('clear');
        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'comp_type'},
                    { name: 'comp_type_nm'},
                    { name: 'comp_nm'},
                    { name: 'rep_nm1'},
                    { name: 'busi_no'},
                    { name: 'busi_nm'},
                    { name: 'psrn_nm'},
                    { name: 'deal_sts_nm'},
                    { name: 'bill_type_nm'},
                    { name: 'deal_ocur_dt'},
                    { name: 'addr1'},
                    { name: 'addr2'},
                    { name: 'addr2'},
                    { name: 'tel_no'},
                    { name: 'busi_sts'},
                    { name: 'chrg_nm'},
                    { name: 'psrn_nm'},
                    { name: 'fin_nm'},
                    { name: 'entr_dt'}
                ],
                url: g_sale_url+'/common/commP_comp_list_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };

        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                //width: getWidth('grid'),
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
                    { text: '일련번호', datafield: 'comp_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center',width:70},
                    { text: '회사 구분', datafield: 'comp_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:90},
                    { text: '<?php echo $tlt_name?> 명', datafield: 'comp_nm', filtertype: 'checkedlist',   align: 'center'  ,width:170},
                    { text: '사업자 명', datafield: 'busi_nm', filtertype: 'checkedlist',  align: 'center'  ,width:150 },
                    { text: '대표자 명', datafield: 'rep_nm1', filtertype: 'checkedlist',  align: 'center'  ,width:100 },
                    { text: '사업자 번호', datafield: 'busi_no', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '담당자 명', datafield: 'psrn_nm', filtertype: 'checkedlist',  align: 'center'  ,width:100 },
                    { text: '결재 조건', datafield: 'bill_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '거래 상태', datafield: 'deal_sts_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '거래 발생일자', datafield: 'deal_ocur_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
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

                delete voParam["callBack"];
                delete voParam["compType"];
                getRowData.num =  '<?echo $_GET['num'] ?>';

                getRowData = {...getRowData, ...voParam , ...formParams($("#fsearch")) } ;
                getRowData['callCompType'] = $("#compType").val() ;
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
    <input type="hidden" name="compType" id="compType" value="<?echo $comp_type?>">
    <input type="hidden" name="callBack" id="callBack" value="<?echo $_GET['callBack']?>">
    <input type="hidden" name="num" id="num" value="<?echo $_GET['num']?>">
    <input type="hidden" name="com_id" id="com_id" value="<?echo $_GET['com_id']?>">
    <input type="hidden" name="com_nm" id="com_nm" value="<?echo $_GET['com_nm']?>">

    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" style="width: 150px">
        <option value="comp_nm"<?php echo get_selected($sfl, "comp_nm"); ?>> <?php echo $tlt_name?> or 사업자명</option>
        <option value="rep_nm"<?php echo get_selected($sfl, "rep_nm"); ?>>대표자 명</option>
        <option value="mb_name"<?php echo get_selected($sfl, "mb_name"); ?>>담당자 명</option>2
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" style="width:200px" required class="required frm_input">
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