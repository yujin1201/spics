<?php
$sub_menu = "300210";
include_once('./_common.php');

$g5['title'] = '매체사 정산 내역';
$g5['title_desc'] ='(매체사 정산정보를 기준으로 계약 정보 함께 조회)' ;
include_once('./sale.head.php');

if (empty($fr_date)) $fr_date = G5_TIME_YM;
if (empty($to_date)) $to_date = G5_TIME_YM;
if(strlen($fr_date) == 6) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $fr_date);
if(strlen($to_date) == 6) $to_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $to_date);
?>
<script type="text/javascript">
    var source = {} ;
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');
        source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'comp_nm'},
                    { name: 'busi_nm'},
                    { name: 'busi_no'},
                    { name: 'fin_nm'},
                    { name: 'fin_no'},
                    { name: 'fin_email'},
                    { name: 'mda_seq'},
                    { name: 'mda_nm'},
                    { name: 'mda_cnt'},
                    { name: 'use_yn'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'use_st_time'},
                    { name: 'use_ed_time'},
                    { name: 'rent_adj_type_code'},
                    { name: 'rent_adj_day'},
                    { name: 'rent_amt'},
                    { name: 'ad_adj_type_code'},
                    { name: 'ad_adj_day'},
                    { name: 'ad_amt', type: 'number'},
                    { name: 'ad_rt', type: 'number'},
                    { name: 'del_yn'},
                    { name: 'asg_use_yn'},
                    { name: 'mda_position'},
                    { name: 'mda_fin_seq'},
                    { name: 'prod_seq'},
                    { name: 'adj_type'},
                    { name: 'adj_type_nm'},
                    { name: 'adj_yearmon'},
                    { name: 'sell_amt', type: 'number'},
                    { name: 'adj_yn'},
                    { name: 'adj_dt'},
                    { name: 'adj_num'},
                    { name: 'bill_dt'},
                    { name: 'bill_yn'},
                    { name: 'bill_rsv'},
                    { name: 'bill_snd'},
                    { name: 'send_dt'},
                    { name: 'out_dt'},
                    { name: 'stl_condi_code'},
                    { name: 'stl_condi_nm'},
                    { name: 'stl_condi_cntnts'},
                    { name: 'tret_yn'},
                    { name: 'cont_seq', type: 'number'},
                    { name: 'cont_amt', type: 'number'},
                    { name: 'cont_cmms_rt', type: 'number'},
                    { name: 'bigo'},
                    { name: 'entr_prsn_nm'},
                    { name: 'entr_dt'},
                    { name: 'cont_nm'},
                    { name: 'cli_seq'},
                    { name: 'cli_nm'},
                    { name: 'agncy_seq'},
                    { name: 'agncy_nm'},
                    { name: 'rep_seq'},
                    { name: 'rep_nm'},
                    { name: 'sale_prsn'},
                    { name: 'sale_prsn_nm'},
                    { name: 'cont_yearmon'},
                    { name: 'cont_st_dt'},
                    { name: 'cont_ed_dt'},
                    { name: 'm1_nm'} ,

                    { name: 'snd_comp_nm'} ,
                    { name: 'rsv_comp_nm'} ,
                ],
                url: g_sale_url+'/fin_list_mda_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
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
                groupable: true,
                groupsexpandedbydefault:true ,
                showgroupaggregates: true,
                showfilterbar: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                groups: ['cont_seq'],
                columns: [
                    {
                        text: '#', columntype: 'number',width:50,cellsalign: 'center', align: 'center', pinned:true,
                        cellsrenderer: cellRowNum
                        ,pinned:true,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },

                    { text: '정산번호', datafield: 'adj_num', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150, pinned:true
                        ,aggregates: ["count"],
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("Count") >= 0) {
                                return defaultRender.replace("Count:", "");
                            }
                        },
                    },
                    { text: '수정자', datafield: 'entr_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150} ,
                    { text: '수정일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '구분', datafield: 'adj_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '자사/타사', datafield: 'm1_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 80,   },
                    { text: '상품명', datafield: 'mda_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '매체사', datafield: 'comp_nm', filtertype: 'checkedlist' ,  align: 'center', width : 150 },
                    { text: '계약 시작일', datafield: 'cont_st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '계약 종료일', datafield: 'cont_ed_dt', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '청구년월', datafield: 'adj_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm},
                    { text: '세금계산서 발행일', datafield: 'bill_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '세금계산서 발행 여부', datafield: 'bill_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '매출', datafield: 'cont_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:150,  cellsformat: 'n' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum,
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("Sum") >= 0) {
                                return defaultRender.replace("Sum:", "");
                            }
                        },
                    },
                    { text: '매입', datafield: 'sell_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:150,  cellsformat: 'n' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum,
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("Sum") >= 0) {
                                return defaultRender.replace("Sum:", "");
                            }
                        },
                    },
                    { text: '상계 여부', datafield: 'tret_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150
                        ,aggregates: [{
                            function (aggregatedValue, currentValue, column, record) {
                                var total =  parseInt(record['cont_amt']) - parseInt(record['sell_amt']);
                                return  aggregatedValue + total ;
                            }
                        }],
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("function") >= 0) {
                                return '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center; color:#c52323;font-weight:700"> ' + adapter.formatNumber(value.replace("function:", "") , 'd')  + '</div>';

                            }
                        },
                        aggregatesrenderer: function (aggregates) {
                            var renderstring = "";
                            $.each(aggregates, function (key, value) {
                                renderstring += '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center; color:#c52323;font-weight:700"> ' + adapter.formatNumber(value , 'd')  + '</div>';
                            });
                            return renderstring;
                        },
                    },
                    { text: '사업자명', datafield: 'busi_nm', filtertype: 'checkedlist' , align: 'center', width : 150 },
                    { text: '사업자번호', datafield: 'busi_no', filtertype: 'checkedlist' , align: 'center', width : 150 },
                    { text: '세금계산서 발행처', datafield: 'snd_comp_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '세금계산서 수신처', datafield: 'rsv_comp_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '입금일', datafield: 'send_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '출금일', datafield: 'out_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '정산완료 여부', datafield: 'adj_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '정산일', datafield: 'adj_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '계약 코드', datafield: 'cont_seq', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 80 },
                    { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist', align: 'center'  ,width:200 },
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '계약 담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width:100},

             /*       { text: '결제조건', datafield: 'stl_condi_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '결제조건 기타', datafield: 'stl_condi_cntnts', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '재무 담당자명', datafield: 'fin_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width:100},
                    { text: '재무 연락처', datafield: 'fin_no', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width:100},
                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '2차 대행사', datafield: 'rep_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '재무 이메일', datafield: 'fin_email', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width:100},*/

                    {datafield: 'mda_fin_seq', hidden: true}
                ]
            });

        $('#grid').on('rowdoubleclick', function (event) {
            if((event.args.row.bounddata.comp_seq ?? "") != ""){
                fn_finPopup( event.args.row.bounddata)  ;
            }

        });

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });

        $('#btn_new').click(function () {
            fn_finPopup()  ;
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

    //청구===========
    function fn_finPopup(voJson){
        var url ="fin_list_mda_pop.php" ;
        if(voJson != null){
           url = url + "?mda_fin_seq="+voJson.mda_fin_seq  ;
            basicPopupOpen(url, "매체 청구 정보", "1100", "750")  ;
        }else{
            basicPopupOpen(url, "매체 청구 등록", "1100", "800")  ;
        }
    }
    //새로고침
    function fn_refresh(){
        source.data = formParams($("#fsearch"))  ;
        $("#grid").jqxGrid("updatebounddata","cells");
    }
</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>정산월</strong>
    <input  id="fr_date" name="fr_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$to_date?>"></input>

    <strong>매체사명</strong>
    <input type="text" name="sch_name" value="" id="sch_name" required class="frm_input">

    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

<?  if($member['mb_level'] > 6){ ?>
<div class="btn_fixed_top">
    <button type="button" id="btn_new"  class="btn btn_02">신규등록</button>
</div>
<? }?>

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;"></div>
    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>
<?php
include_once ('./sale.tail.php');
?>
