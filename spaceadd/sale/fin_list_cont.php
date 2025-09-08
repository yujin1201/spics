<?php
$sub_menu = "300200";
include_once('./_common.php');

$g5['title'] = '광고비 정산 내역';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';

if (empty($fr_date) ) $fr_date = G5_TIME_YM;
if (empty($to_date)) $to_date = G5_TIME_YM;
if(strlen($fr_date) == 6) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $fr_date);
if(strlen($to_date) == 6) $to_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $to_date);
?>
<script type="text/javascript">
    var  source = {} ;
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');
        var i = 5;
        source =
            {
                datatype: "json",
                datafields: [
                    { name: 'cont_seq', type: 'number'},
                    { name: 'cont_nm'},
                    { name: 'cont_type_code'},
                    { name: 'cont_type_nm'},
                    { name: 'mda_type'},
                    { name: 'cont_yearmon'},
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
                    { name: 'cont_st_dt'},
                    { name: 'cont_ed_dt'},
                    { name: 'cont_amt', type: 'number'},
                    { name: 'fin_seq'},
                    { name: 'adj_type_code'},
                    { name: 'adj_type_nm'},
                    { name: 'adj_yearmon'},
                    { name: 'sell_amt', type: 'number'},
                    { name: 'out_amt', type: 'number'},
                    { name: 'in_amt', type: 'number'},
                    { name: 'agnt_cmms_rt', type: 'number'},
                    { name: 'cnsg_cmms_rt', type: 'number'},
                    { name: 'agnt_cmms_amt', type: 'number'},
                    { name: 'cnsg_cmms_amt', type: 'number'},
                    { name: 'rep_cmms_rt', type: 'number'},
                    { name: 'rep_cmms_amt', type: 'number'},
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
                    { name: 'bigo'},
                    { name: 'entr_prsn_nm'},
                    { name: 'entr_dt'},
                    { name: 'inout_type_nm'},
                    { name: 'rsv_comp_nm'},
                    { name: 'rsv_busi_no'},
                    { name: 'rsv_busi_nm'},
                    { name: 'snd_comp_nm'},
                    { name: 'snd_busi_no'},
                    { name: 'snd_busi_nm'},
                    { name: 'adj_chk'} ,
                    { name: 'mda_nm_list'}
                ],
                url: g_sale_url+'/fin_list_cont_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
        i++;
        var cellclass = function (row, columnfield, value, rowData, some) {
            if (rowData['adj_chk'] =='Y') {
                return 'jqx_red';
            }
            else return "";
        }

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
                        text: '#', columntype: 'number',width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,pinned:true,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '정산번호', datafield: 'adj_num', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 , pinned:true, cellclassname:cellclass},
                    { text: '계약 코드', datafield: 'cont_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70, pinned:true},
                    { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist', align: 'center'  ,width:200, pinned:true},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '청구년월', datafield: 'adj_yearmon',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYm , width : 130, filtertype: 'checkedlist'
                        ,aggregates: [{
                            function (aggregatedValue, currentValue, column, record) {
                                var total =  parseInt(record['out_amt']) - parseInt(record['in_amt']);
                                return  aggregatedValue + total ;
                            }
                        }],
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("function") >= 0) {
                                return '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center; color:#c52323;font-weight:700">매출이익 : ' + adapter.formatNumber(value.replace("function:", "") , 'd')  + '</div>';

                            }
                        },
                        aggregatesrenderer: function (aggregates) {
                            var renderstring = "";
                            $.each(aggregates, function (key, value) {
                                renderstring += '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center; color:#c52323;font-weight:700">매출이익 : ' + adapter.formatNumber(value , 'd')  + '</div>';
                            });
                            return renderstring;
                        },
                    },
                    { text: '거래구분', datafield: 'inout_type_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '매출', datafield: 'out_amt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 120, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum,
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("Sum") >= 0) {
                                return defaultRender.replace("Sum:", "");
                            }
                        },
                    },
                    { text: '매입', datafield: 'in_amt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 120, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum,
                        cellsrenderer: function (row, column, value, defaultRender, column, rowData) {
                            if (value.toString().indexOf("Sum") >= 0) {
                                return defaultRender.replace("Sum:", "");
                            }
                        },
                    },
                    { text: '상계 여부', datafield: 'tret_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '세금계산서 발행일', datafield: 'bill_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '세금계산서 발행 여부', datafield: 'bill_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '계산서 발행처', datafield: 'snd_comp_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '발행처 사업자번호', datafield: 'snd_busi_no',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    /*{ text: '발행처 사업자명', datafield: 'snd_busi_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,*/
                    { text: '계산서 수신처', datafield: 'rsv_comp_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '수신처 사업자번호', datafield: 'rsv_busi_no',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '수신처 사업자명', datafield: 'rsv_busi_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '입금일', datafield: 'send_dt',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 , filtertype: 'checkedlist'},
                    { text: '출금일', datafield: 'out_dt',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100, filtertype: 'checkedlist' },
                    { text: '정산완료 여부', datafield: 'adj_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '정산일', datafield: 'adj_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '2차 대행사', datafield: 'rep_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '대행수수료율', datafield: 'agnt_cmms_rt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 100, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '계약구분', datafield: 'cont_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width:100},
                    /*
                    { text: '결제조건', datafield: 'stl_condi_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '결제조건 기타', datafield: 'stl_condi_cntnts', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '청구구분', datafield: 'adj_type_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                     */

                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '매체목록', datafield: 'mda_nm_list', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 200 },
                    { text: '수정자', datafield: 'entr_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150} ,
                    { text: '수정일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150}
                ]
            });


        $('#grid').on('rowdoubleclick', function (event) {
            fn_finPopup( event.args.row.bounddata)  ;
            /*
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            location.href = "./cont_form.php?cont_seq="+getRowData['cont_seq'];
             */
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

    //청구===========
    function fn_finPopup(voJson){
        var url ="cont_form_pop_fin.php?cont_seq=<?php echo $cont['cont_seq'] ?>";
        if(( voJson??"")  != "" ){
            url = url + "&fin_seq="+voJson.fin_seq  ;
        }
        basicPopupOpen(url, "계약 청구 정보", "900", "650")  ;
    }

    //새로고침
    function fn_refresh(p_cont_seq){
        source.data = formParams($("#fsearch"))  ;
        $("#grid").jqxGrid("updatebounddata","cells");
    }

    $(function(){
        $("#fr_date, #to_date" ).datepicker( $.datepicker.yearmon) ;
        $("#fr_date, #to_date").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });
    });
</script>
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <strong>정산월</strong>
    <input  id="fr_date" name="fr_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$to_date?>"></input>
    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <option value="BAC03"> 확정 </option>
        <option value="BAC04"> 정산요청 </option>
        <option value="BAC05"> 정산완료 </option>
    </select>

    <strong>거래구분</strong>
    <select name="inout_type" id="inout_type" onChange="" style="width: 150px" >
        <option value="">전체<?print_option_with_select('ABD', '');?>
    </select>

    <strong>구분</strong>
    <select name="adj_type_code" id="adj_type_code" onChange="" style="width: 100px" >
        <option value="">전체<?print_option_with_select('BAH', '');?>
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
