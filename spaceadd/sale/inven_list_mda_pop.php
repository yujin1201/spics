<?php
$sub_menu = "";
include_once('./_common.php');


$g5['title'] = "계약상품 목록";

include_once(G5_SALE_PATH.'/sale.head.popup.php');

if (empty($fr_date)) $fr_date = G5_TIME_YM;
if (empty($to_date)) $to_date = G5_TIME_YM;
if(strlen($fr_date) == 6) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $fr_date);
if(strlen($to_date) == 6) $to_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $to_date);

?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name : 'cont_mda_seq'},
                    { name : 'cont_seq'},
                    { name : 'mda_seq'},
                    { name : 'account_cnt'},
                    { name : 'equip_cnt'},
                    { name : 'guarant_pos'},
                    { name : 'multi_yn'},
                    { name : 'st_dt'},
                    { name : 'ed_dt'},
                    { name : 'act_st_time'},
                    { name : 'act_ed_time'},
                    {name: 'report_yn'},
                    {name: 'report_opt'},
                    {name: 'toss_dt'},
                    {name: 'mg_report_yn'},
                    {name: 'mg_report'},
                    { name : 'bigo'},
                    { name : 'entr_prsn'},
                    { name : 'entr_dt'},
                    { name : 'updt_prsn'},
                    { name : 'mda_nm'},
                    { name : 'report_opt_nm'}, 
                    { name : 'mtrl_nm'},
                    { name : 'opdt_yn'},
                    { name : 'cont_nm'},
                    { name : 'cont_type_code'},
                    { name : 'mda_type'},
                    { name : 'cont_yearmon'},
                    { name : 'cont_stat'},
                    { name : 'cont_stat_nm'},
                    { name : 'cli_seq'},
                    { name : 'cli_nm'},
                    { name : 'agncy_seq'},
                    { name : 'agncy_nm'},
                    { name : 'rep_seq'},
                    { name : 'rep_nm'},
                    { name : 'sale_prsn'},
                    { name : 'sale_prsn_nm'},
                    { name : 'cont_st_dt'},
                    { name : 'cont_ed_dt'},
                    { name : 'cont_amt', type: 'number'},
                    { name : 'tot_sell_amt' , type: 'number'},
                    { name : 'op_yn'},
                    { name : 'mda_comp_nm'},
                    { name : 'full_nm'}
                ],
                url: g_sale_url+'/cont_mda_list_result.php',
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
                columnsresize: true,
                filterable: false,
                sortable: true,
                ready: function () {
                },
                groupable: false,
                groupsexpandedbydefault:false ,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#',  columntype: 'number', width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,pinned:true,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist', align: 'center'  ,width:240,pinned:true },
                    { text: '계약월', datafield: 'cont_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '매체사', datafield: 'mda_comp_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '2차 대행사', datafield: 'rep_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '상품명', datafield: 'mda_nm', filtertype: 'checkedlist', align: 'center',  width: 100 },
                    { text: '매체', datafield: 'full_nm', filtertype: 'checkedlist', align: 'center',  width: 200 },
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '청구금액', datafield: 'tot_sell_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '예산', datafield: 'cont_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    }
                    ,{text: '운행확정 여부',datafield: 'op_yn',cellsalign: 'center',filtertype: 'checkedlist',align: 'center',width: 60}
                    ,{text: '운영시작일',datafield: 'st_dt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120}
                    ,{text: '종료일',datafield: 'ed_dt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120}
                    ,{text: '구좌수',datafield: 'account_cnt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70,
                         aggregates: ['sum'],
                        aggregatesrenderer: aggSum}
                    ,{text: '기기수',datafield: 'equip_cnt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70}
                    ,{text: '보장노출횟수(기/일)',datafield: 'guarant_pos',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 110}
                    ,{text: '게첨보고서 필요여부',datafield: 'report_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100}
                    ,{text: '게첨보고서 전달일자',datafield: 'toss_dt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd, width: 100}
                    ,{text: '관리보고서 필요여부',datafield: 'mg_report_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100}
                    ,{text: '관리보고서 전달일자',datafield: 'mg_report',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100}
                    ,{text: '멀티소재 여부',datafield: 'multi_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 60}
                    ,{text: '소재',datafield: 'mtrl_nm',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100} ,
                    {datafield: 'cont_seq', hidden: true},
                    {datafield: 'cont_mda_seq', hidden: true}
                ]
            });
        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });
        $('#grid').on('rowdoubleclick', function (event) {
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            window.open( "./cont_form.php?cont_seq="+getRowData['cont_seq'] ) ;
        });


    });
    $(function(){
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

    });
</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <input  id="comp_seq" name="comp_seq"    maxlength="20"  length="6"  type="hidden" value="<?=$_GET['comp_seq']?>"></input>
    <input  id="mda_seq" name="mda_seq"    maxlength="20"  length="6"  type="hidden" value="<?=$_GET['mda_seq']?>"></input>

    <strong>계약월</strong>
    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd"  value="<?=$to_date?>"></input>

    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', 'BAC03',"BAC01");?>
    </select>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
        <div id="grid"  style="width: 100%; height: 100%;"></div>
    </div>
    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>