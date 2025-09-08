<?php
header('Location: /spaceadd/sale//report/report_media_ym_01.php', true, 302); // 302 Found(기본)
exit; // 반드시 종료

$sub_menu = "3001000";
include_once('./_common.php');

$g5['title'] = '매체 월별 판매 현황 (회계기준)';
$g5['title_desc'] ='<p>① 매체별 매출 금액 표기 : 자사미디어, 제작대행,설치대행,영업수수료,기타서비스</p>
<p>② 매체별 정산 금액 (매출 - 매입) 표기 :종합대행, 방송대행,옥외대행,디지털대행,인쇄대행</p>' ;
include_once('./sale.head.php');

if (empty($fr_date)) $fr_date = substr(G5_TIME_YM, 0, 5)."01";
if (empty($to_date)) $to_date = substr(G5_TIME_YM, 0, 5)."12";
if(strlen($fr_date) == 6) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $fr_date);
if(strlen($to_date) == 6) $to_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $to_date);
?>
<script type="text/javascript" src="/spaceadd/sale/js/date.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                     { name: 'mda_type'}
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
                    ,{ name: 'amt1', type: 'number'}
                    ,{ name: 'amt2', type: 'number'}
                    ,{ name: 'amt3', type: 'number'}
                    ,{ name: 'amt4', type: 'number'}
                    ,{ name: 'amt5', type: 'number'}
                    ,{ name: 'amt6', type: 'number'}
                    ,{ name: 'amt7', type: 'number'}
                    ,{ name: 'amt8', type: 'number'}
                    ,{ name: 'amt9', type: 'number'}
                    ,{ name: 'amt10', type: 'number'}
                    ,{ name: 'amt11', type: 'number'}
                    ,{ name: 'amt12', type: 'number'}
                    ,{ name: 'amtTot', type: 'number'}
                ],
                url: g_sale_url+'/report_list_media_ym02_result.php',
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
                showfilterbar: true,
                filterbarmode: 'simple',
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
                        , pinned: true
                    },
                    { text: '거래유형', datafield: 'deal_type_nm', filtertype: 'checkedlist',cellsalign: 'center', align: 'center'  ,width:150  , pinned: true   },
                    { text: '계약구분', datafield: 'cont_type_code_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100, pinned: true },
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150, pinned: true },
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150, pinned: true },
                    { text: '매체', datafield: 'mda_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  },
                    { text: '업종', datafield: 'rep_indst_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '브랜드', datafield: 'brnd_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '1월', datafield: 'amt1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '2월', datafield: 'amt2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '3월', datafield: 'amt3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '4월', datafield: 'amt4', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '5월', datafield: 'amt5', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '6월', datafield: 'amt6', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '7월', datafield: 'amt7', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '8월', datafield: 'amt8', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '9월', datafield: 'amt9', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '10월', datafield: 'amt10', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '11월', datafield: 'amt11', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '12월', datafield: 'amt12', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                    { text: '합계', datafield: 'amtTot', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum },
                ]
            });

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
            try{
                for(var i=1; i<=12; i++){
                    $("#grid").jqxGrid('hidecolumn', "amt"+i );
                }
                var fd = Date.parse($("#fr_date").val())   ;
                var td = Date.parse($("#to_date").val())   ;
                var num = 1 ;
                while(fd.toString("yyyyMM") <=  td.toString("yyyyMM") ){
                    $("#grid").jqxGrid('showcolumn', "amt"+num );
                    $('#grid').jqxGrid('setcolumnproperty',  "amt"+num , 'text', fd.toString("yyyy년 MM월") );
                    fd =   fd.add({ months: 1 })
                    num++ ;
                }
            }catch (e) {
                console.log(e)
            }

        });

        //첫 로딩
        setTimeout(function() {
            source.data = formParams($("#fsearch"));
            $("#grid").jqxGrid("updatebounddata", "cells");
        },100)
    });

    $(function(){
        $("#fr_date, #to_date" ).datepicker( $.datepicker.yearmon) ;
        $("#fr_date, #to_date").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });
    });
</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>계약월 기간</strong>
    <input  id="fr_date" name="fr_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$to_date?>"></input>
    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '', '',  'BACALL');?>
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
