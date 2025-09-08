<?php
$sub_menu = "200100";
include_once('./_common.php');
$g5['title'] = '계약 목록';
include_once('./sale.head.php');

/*$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : substr(G5_TIME_YMDHIS, 0, 4);  ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] :  date("Y-m-d", strtotime(  "+6 months") ) ;*/


$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : date('Y', time()).'0101';  ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date('Y', time()).'1231';  ;
if(strlen($fr_date) == 8) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $fr_date);
if(strlen($to_date) == 8) $to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $to_date);

?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');
        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'cont_seq', type: 'number'},
                    { name: 'cont_nm'},
                    { name: 'cont_type_code'},
                    { name: 'cont_type_nm'},
                    { name: 'mda_type'},
                    { name: 'cont_yearmon' , type: 'string'},
                    { name: 'cont_stat'},
                    { name: 'cont_stat_nm'},
                    { name: 'cli_seq'},
                    { name: 'cli_nm'},
                    { name: 'agncy_seq'},
                    { name: 'agncy_nm'},
                    { name: 'rep_seq'},
                    { name: 'rep_nm'},
                    { name: 'sale_prsn'},
                    { name: 'sale_prsn_nm'},
                    { name: 'cont_st_dt' , type: 'string'},
                    { name: 'cont_ed_dt' , type: 'string'},
                    { name: 'cont_amt', type: 'number'},
                    { name: 'out_amt', type: 'number'},
                    { name: 'in_amt', type: 'number'},
                    { name: 'profit_amt', type: 'number'},
                    { name: 'bigo'},
                    { name: 'entr_prsn'},
                    { name: 'entr_prsn_nm'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'},
                    { name: 'mda_nm'} ,
                    { name: 'cont_sale_type_nm'} ,
                ],
                url: g_sale_url+'/cont_list_result.php',
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
                filterbarmode: 'simple',
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showfilterbar: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                        , pinned: true
                    },
                    { text: '계약 코드', datafield: 'cont_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70, pinned: true},
                    { text: '계약명', datafield: 'cont_nm',   align: 'center'  ,width:240, pinned: true},
                    { text: '계약월', datafield: 'cont_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm},
                    { text: '계약구분', datafield: 'cont_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '판매방식', datafield: 'cont_sale_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '2차 대행사', datafield: 'rep_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '매체', datafield: 'mda_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '매출액', datafield: 'out_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '매입액', datafield: 'in_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    {text: '매출이익', datafield: 'profit_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },

                    { text: '시작일', datafield: 'cont_st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '종료일', datafield: 'cont_ed_dt', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '수정자', datafield: 'entr_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '수정일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150}
                ]
            });

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });
        $('#grid').on('rowdoubleclick', function (event) {
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
           // location.href = "./cont_form.php?cont_seq="+getRowData['cont_seq'];
		    window.open("./cont_form.php?cont_seq="+getRowData['cont_seq'], "_blank") ;
        });
    });
    function fn_add_cont(){
        /*location.href = "./cont_form.php";*/
        window.open("./cont_form.php" , "_blank") ;
    }
    $(function(){
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

         setTimeout(function (){
           <? if($member['mb_level'] < 7 ){ ?>
             $("#excelExport").hide();
           <?}?>
         }, 100)
    });
</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <!--
    <strong>계약명</strong>
    <input type="text" name="sch_name" value="<?php echo $sch_name ?>" id="sch_name" required class="required frm_input">
    -->

    <strong>광고주</strong>
    <input type="text" name="cli_nm" value="" id="sch_name" required class="frm_input">

    <strong>광고회사</strong>
    <input type="text" name="agncy_nm" value="" id="sch_name" required class="frm_input">

    <strong>기간</strong>
    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>

    <strong>담당자</strong>
    <select name="sale_prsn" id="sale_prsn" onChange="" style="width: 200px" >
        <?php print_option_member($member['mb_no'], '2', 'all') ?>
    </select>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>
<div class="btn_fixed_top">
    <? if($member['mb_level']  != 4 ){ ?>
    <button type="button" onclick="fn_add_cont();" class="btn btn_02">신규 계약 등록</button>
    <?}?>
</div>
<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%;height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;"></div>
    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>
<?php
include_once ('./sale.tail.php');
?>
