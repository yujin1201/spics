<?php
$sub_menu = "200200";
include_once('./_common.php');

$g5['title'] = '광고비 정산 내역';
include_once('./sale.head.php');

$adj_yearmon = isset($_REQUEST['adj_yearmon']) ? $_REQUEST['adj_yearmon'] : '';
if (empty($adj_yearmon) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $adj_yearmon) ) $adj_yearmon = G5_TIME_YM;
?>
<script type="text/javascript">
    $(document).ready(function () {

        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'cont_seq'},
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
                    { name: 'adj_yearmon'},
                    { name: 'sell_amt', type: 'number'},
                    { name: 'agnt_cmms_rt', type: 'number'},
                    { name: 'cnsg_cmms_rt', type: 'number'},
                    { name: 'agnt_cmms_amt', type: 'number'},
                    { name: 'cnsg_cmms_amt', type: 'number'},
                    { name: 'adj_yn'},
                    { name: 'adj_dt'},
                    { name: 'adj_num'},
                    { name: 'bill_dt'},
                    { name: 'bill_yn'},
                    { name: 'bill_rsv'},
                    { name: 'send_dt'},
                    { name: 'stl_condi_code'},
                    { name: 'stl_condi_nm'},
                    { name: 'stl_condi_cntnts'},
                    { name: 'tret_yn'},
                    { name: 'bigo'},
                    { name: 'entr_prsn_nm'},
                    { name: 'entr_dt'}
                ],
                url: g_sale_url+'/cont_fin_list_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
        i++;
        var addfilter = function () {
            var filtergroup = new $.jqx.filter();

            var filter_or_operator = 1;
            var filtervalue = 'Andrew';
            var filtercondition = 'equal';
            var filter1 = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);

            filtergroup.addfilter(filter_or_operator, filter1);
            // add the filters.
            $("#grid").jqxGrid('addfilter', 'firstname', filtergroup);
            // apply the filters.
            $("#grid").jqxGrid('applyfilters');
        }

        var adapter = new $.jqx.dataAdapter(source);

        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                columnsresize: true,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#', sortable: false, filterable: false, editable: false,
                        groupable: false, draggable: false, resizable: false,
                        datafield: '', columntype: 'number', width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,pinned:true,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '계약 코드', datafield: 'cont_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70, pinned:true},
                    { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist', align: 'center'  ,width:200, pinned:true},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '청구년월', datafield: 'adj_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm},
                    { text: '정산완료 여부', datafield: 'adj_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '정산일', datafield: 'adj_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '2차 대행사', datafield: 'rep_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width:100},
                    { text: '계약구분', datafield: 'cont_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '취급고', datafield: 'sell_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '대행수수료율', datafield: 'agnt_cmms_rt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , cellsformat: 'd', width : 70},
                    { text: '대행수수료', datafield: 'agnt_cmms_amt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', cellsformat: 'd' , width : 100,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '매체수수료율', datafield: 'cnsg_cmms_rt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , cellsformat: 'd', width : 70  },
                    { text: '매체수수료', datafield: 'cnsg_cmms_amt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', cellsformat: 'd' , width : 100,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '정산번호', datafield: 'adj_num', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '입금일', datafield: 'send_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '결제조건', datafield: 'stl_condi_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '결제조건 기타', datafield: 'stl_condi_cntnts', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '세금계산서 발행 여부', datafield: 'bill_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '세금계산서 발행일', datafield: 'bill_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 },
                    { text: '세금계산서 수신처', datafield: 'bill_rsv', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '상계 여부', datafield: 'tret_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 100 },
                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width : 150 },
                    { text: '수정자', datafield: 'entr_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150} ,
                    { text: '수정일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150}
                ]
            });

        $('#grid').on('rowdoubleclick', function (event) {
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            location.href = "./cont_form.php?cont_seq="+getRowData['cont_seq'];
        });
        $('#clearfilteringbutton').jqxButton({ theme: theme });
        $('#clearfilteringbutton').click(function () {
            $("#grid").jqxGrid('clearfilters');
        });

        $("#excelExport").jqxButton({ theme: theme });
        $("#excelExport").click(function () {
            $("#grid").jqxGrid('exportdata', 'xlsx', 'jqxGrid');
        });
        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });
        $('#btn_gnb').click(function () {

            $('#grid').jqxGrid('render');
        });

        //첫 로딩
        setTimeout(function() {
            source.data = formParams($("#fsearch"));
            $("#grid").jqxGrid("updatebounddata", "cells");
        },100)
    });

    function fn_add_cont(){
        location.href = "./cont_form.php";
    }
    $(function(){
         $("#adj_yearmon" ).datepicker( $.datepicker.yearmon) ;
         $("#adj_yearmon").focus(function () {
             $(".ui-datepicker-calendar").css("display","none");
             $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
         });
    });
</script>


<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>계약명</strong>
    <input type="text" name="sch_name" value="<?php echo $sch_name ?>" id="sch_name" required class="frm_input">

    <strong>정산월</strong>
    <input  id="adj_yearmon" name="adj_yearmon"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$adj_yearmon?>"></input>
    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <option value="BAC03"> 확정 </option>
        <option value="BAC04"> 정산요청 </option>
        <option value="BAC05"> 정산완료 </option>
    </select>

    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 590px;">
    <div id="grid"  style="width: 100%; height: 100%;">
    </div>

    <div style='margin-top: 20px;'>
        <div style='float: left;'>
            <input value="Remove Filter" id="clearfilteringbutton" type="button" />
            <input type="button" value="Export to Excel" id='excelExport' />
        </div>

    </div>
</div>
<?php
include_once (G5_PATH.'/sale.tail.php');
?>
