<?php
$sub_menu = "300700";
include_once('./_common.php');

$g5['title'] = '구분 손익 및 증감 내역';
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
                    { name: 'year'}
                    ,{ name: 'mda_seq'}
                    ,{ name: 'mda_type_nm'}
                    , { name: 'flag'}
                    , { name: 'flag_nm'}
                    , { name: 'mda_type_code'}
                    , { name: 'cont_type_nm'}
                    , { name: 'cont_rank_nm'}
                    , { name: 'cont_type_code'}
                    ,{ name: 'cont_rank', type: 'number'}
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
                url: g_sale_url+'/report_list_01_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
        i++;

        var cellClas = function(row, column, value, data) {
            var clsNm = "" ;
            if(data.cont_type_code =='BAB99'){
                clsNm = "grid_bg_sum "   ;
            }else {
                if(data.mda_type_code =='AAB00'){
                    clsNm = "grid_bg_sub "   ;
                }
            }

            if(column == 'cont_rank_nm'){
                if(data.cont_rank == 1){
                    clsNm = clsNm + " grid_border_nb grid_border_t "  ;
                }else{
                    clsNm = clsNm + " grid_border_lr_ntb "  ;
                }
            }
            if(column == 'mda_type_nm'){
                if(data.flag =="01"){
                    clsNm = clsNm + " grid_border_nb "   ;
                }else if(data.flag =="04"){
                    clsNm = clsNm + " grid_border_nt "  ;
                }else{
                    clsNm = clsNm + " grid_border_lr_ntb ";
                }
            }
            return clsNm   ;
        }

        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                sortable: false,
                ready: function () {
                    addfilter();
                },
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: false,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                columns: [
                    { text: '계약 구분', datafield: 'cont_rank_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:150, pinned: true , cellclassname: cellClas},
                    { text: '매체', datafield: 'mda_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:150, pinned: true ,cellclassname: cellClas },
                    { text: '구분', datafield: 'flag_nm', filtertype: 'checkedlist',cellsalign: 'center', align: 'center'  ,width:100 , pinned: true  , cellclassname: cellClas},
                    { text: '1월', datafield: 'amt1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '2월', datafield: 'amt2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '3월', datafield: 'amt3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '4월', datafield: 'amt4', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '5월', datafield: 'amt5', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '6월', datafield: 'amt6', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '7월', datafield: 'amt7', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '8월', datafield: 'amt8', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '9월', datafield: 'amt9', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '10월', datafield: 'amt10', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd', cellclassname: cellClas},
                    { text: '11월', datafield: 'amt11', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '12월', datafield: 'amt12', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' , cellclassname: cellClas},
                    { text: '합계', datafield: 'amtTot', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120,  cellsformat: 'd', cellclassname: cellClas },
                ]
            });

        $("#refresh").click(function () {
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
<div style="line-height: 40px">
    * <b>매출[1]</b> = 매출,  <b>매출원가[2]</b> = 매입  + 매체사 정산액 ,  <b>매출이익[3]</b> =  매출[1] -매출원가[2]   , <b>(%)</b> = (매출이익[3]/매출[1]) *100
</div>
<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;"></div>
    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>
<?php
include_once ('./sale.tail.php');
?>
