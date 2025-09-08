<?php
$sub_menu = "300500";
include_once('./_common.php');

$g5['title'] = '매체별 월별 판매 현황';
include_once('./sale.head.php');

$sc_yearmon = substr(G5_TIME_YM, 0,4 ) ;
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'year'}
                    ,{ name: 'mda_type'}
                    ,{ name: 'mda_nm'}
                    , { name: 'cli_seq'}
                    , { name: 'agncy_seq'}
                    , { name: 'rep_seq'}
                    , { name: 'brnd_nm'}
                    , { name: 'deal_type_code'}
                    , { name: 'sale_prsn'}
                    ,{ name: 'deal_type_nm'}
                    ,{ name: 'cli_nm'}
                    ,{ name: 'agncy_nm'}
                    ,{ name: 'sale_prsn_nm'}
                    ,{ name: 'rep_indst_nm'}
                    ,{ name: 'cont_stat'}
                    ,{ name: 'cont_stat_nm'}
                    ,{ name: 'cont_type_code_nm'}
                    ,{ name: 'amt01', type: 'number'}
                    ,{ name: 'amt02', type: 'number'}
                    ,{ name: 'amt03', type: 'number'}
                    ,{ name: 'amt04', type: 'number'}
                    ,{ name: 'amt05', type: 'number'}
                    ,{ name: 'amt06', type: 'number'}
                    ,{ name: 'amt07', type: 'number'}
                    ,{ name: 'amt08', type: 'number'}
                    ,{ name: 'amt09', type: 'number'}
                    ,{ name: 'amt10', type: 'number'}
                    ,{ name: 'amt11', type: 'number'}
                    ,{ name: 'amt12', type: 'number'}
                    ,{ name: 'amtTot', type: 'number'}
                ],
                url: g_sale_url+'/report_list_media_ym_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
        i++;

        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#',  columntype: 'number', width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '집행년도', datafield: 'year', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '거래유형', datafield: 'deal_type_nm', filtertype: 'checkedlist',cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약구분', datafield: 'cont_type_code_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '매체', datafield: 'mda_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  },
                    { text: '업종', datafield: 'rep_indst_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '브랜드', datafield: 'brnd_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '1월', datafield: 'amt01', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '2월', datafield: 'amt02', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '3월', datafield: 'amt03', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '4월', datafield: 'amt04', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '5월', datafield: 'amt05', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '6월', datafield: 'amt06', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '7월', datafield: 'amt07', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '8월', datafield: 'amt08', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '9월', datafield: 'amt09', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '10월', datafield: 'amt10', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '11월', datafield: 'amt11', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '12월', datafield: 'amt12', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '합계', datafield: 'amtTot', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                ]
            });

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });

        //첫 로딩
        setTimeout(function() {
            source.data = formParams($("#fsearch"));
            $("#grid").jqxGrid("updatebounddata", "cells");
        },100)
    });

    $(function(){
        $("#sc_yearmon" ).val(<?echo $sc_yearmon?>)
    });
</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>년도</strong>
    <select name="sc_yearmon" id="sc_yearmon" onChange="" style="width: 150px" >
        <?for($i=2021; $i <= 2030; $i++){?>
            <option value="<?echo $i?>"><?echo $i?></option>
        <?}?>
    </select>
    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '');?>
    </select>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;"></div>
    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>
<?php
include_once ('./sale.tail.php');
?>
