<?php
$sub_menu = "200120";
include_once('./_common.php');

$g5['title'] = '계약상품 목록';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : G5_TIME_YMD ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] :  date("Y-m-d", strtotime(  "+1 months") ) ;
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
                    { name : 'cont_mda_seq' , type: 'number'},
                    { name : 'cont_seq' , type: 'number'},
                    { name : 'mda_seq' , type: 'number'},
                    { name : 'account_cnt' , type: 'number'},
                    { name : 'equip_cnt' , type: 'number'},
                    { name : 'guarant_pos' , type: 'string'},
                    { name : 'multi_yn' , type: 'string'},
                    { name : 'st_dt' , type: 'string'},
                    { name : 'ed_dt' , type: 'string'},
                    { name : 'act_st_time' , type: 'string'},
                    { name : 'act_ed_time' , type: 'string'},
                    {name: 'report_yn' , type: 'string'},
                    {name: 'report_opt' , type: 'string'},
                    {name: 'toss_dt' , type: 'string'},
                    {name: 'mg_report_yn' , type: 'string'},
                    {name: 'mg_report' , type: 'string'},
                    { name : 'bigo' , type: 'string'},
                    { name : 'entr_prsn' , type: 'string'},
                    { name : 'entr_prsn_nm' , type: 'string'},
                    { name : 'entr_dt' , type: 'string'},
                    { name : 'updt_prsn' , type: 'string'},
                    { name : 'mda_nm' , type: 'string'},
                    { name : 'report_opt_nm' , type: 'string'}, 
                    { name : 'mtrl_nm' , type: 'string'},
                    { name : 'opdt_yn' , type: 'string'},
                    { name : 'cont_nm' , type: 'string'},
                    { name : 'cont_type_code' , type: 'string'},
                    { name : 'mda_type' , type: 'string'},
                    { name : 'cont_yearmon' , type: 'string'},
                    { name : 'cont_stat' , type: 'string'},
                    { name : 'cont_stat_nm' , type: 'string'},
                    { name : 'cli_seq' , type: 'number'},
                    { name : 'cli_nm' , type: 'string'},
                    { name : 'agncy_seq' , type: 'number'},
                    { name : 'agncy_nm' , type: 'string'},
                    { name : 'rep_seq' , type: 'number'},
                    { name : 'rep_nm' , type: 'string'},
                    { name : 'sale_prsn' , type: 'string'},
                    { name : 'sale_prsn_nm' , type: 'string'},
                    { name : 'cont_st_dt' , type: 'string'  },
                    { name : 'cont_ed_dt' , type: 'string' },
                    { name : 'cont_amt', type: 'number' },
                    { name : 'tot_sell_amt' , type: 'number' },
                    { name : 'op_yn' , type: 'string'},
                    { name : 'bns_yn' , type: 'string'},
                    { name : 'mda_comp_nm' , type: 'string'},
                    { name : 'full_nm' , type: 'string'},
                    { name : 'm1_nm' , type: 'string'},
                    { name : 'm2_nm' , type: 'string'},
                    { name : 'm3_nm' , type: 'string'},
                    { name : 'bigo2' , type: 'string'},
                    { name : 'bigo_seq', type: 'number'},
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
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showfilterbar: true,
                filterbarmode: 'simple',
                groupable: true,
                groupsexpandedbydefault:true ,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsreorder: true,
                selectionmode: 'checkbox',
                editable: true,
                enabletooltips: true,
                columns: [
                    {
                        text: '#',  columntype: 'number', width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,pinned:true,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '자사/타사', datafield: 'm1_nm',   filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:120  , editable: false },
                    { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist', align: 'center'  ,width:200,pinned:true , editable: false },
                    { text: '계약월', datafield: 'cont_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm , editable: false },
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150, editable: false },
                    { text: '매체', datafield: 'm2_nm',   filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:120  , editable: false },
                    { text: '상품', datafield: 'm3_nm',   filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:120  , editable: false },
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100, editable: false },
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120, editable: false },
                    { text: '운영시작일',datafield: 'st_dt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120, editable: false },
                    { text: '종료일',datafield: 'ed_dt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120, editable: false },
                    { text: '구좌수',datafield: 'account_cnt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70, editable: false },
                    { text: '서비스 여부',datafield: 'bns_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 70, editable: false },
                   <!-- { text: '기기수',datafield: 'equip_cnt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70, editable: false },-->
                    { text: '보장노출횟수(기/일)',datafield: 'guarant_pos',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 110, editable: false },
                    { text: '게첨보고서 필요여부',datafield: 'report_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100, editable: false },
                    { text: '게첨보고서 전달일자',datafield: 'toss_dt',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd, width: 100, editable: false },
                    { text: '관리보고서 필요여부',datafield: 'mg_report_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100, editable: false },
                    { text: '관리보고서 전달일자',datafield: 'mg_report',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 100, editable: false },
                    { text: '멀티소재 여부',datafield: 'multi_yn',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 60, editable: false },
                    { text: '소재',datafield: 'mtrl_nm',filtertype: 'checkedlist',cellsalign: 'center',align: 'center',width: 100, editable: false } ,
                    { text: '상품 비고', datafield: 'bigo', filtertype: 'checkedlist', align: 'center' , width:150, editable: false },
                    { text: '운행 비고', datafield: 'bigo2', filtertype: 'checkedlist', align: 'center' , width:150 },
                    { text: '매체사', datafield: 'mda_comp_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150, editable: false },
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150, editable: false },
                    { text: '2차 대행사', datafield: 'rep_nm', filtertype: 'checkedlist' ,cellsalign: 'center',  align: 'center'  ,width:150, editable: false },
                    { text: '상품명', datafield: 'mda_nm', filtertype: 'checkedlist', align: 'center',  width: 100 , editable: false },

                    { text: '청약금액', datafield: 'cont_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , editable: false } ,
                    {text: '운행확정 여부',datafield: 'op_yn',cellsalign: 'center',filtertype: 'checkedlist',align: 'center',width: 60, editable: false } ,
                    { text: '수정자', datafield: 'entr_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '수정일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    {datafield: 'cont_seq', hidden: true,  },
                    {datafield: 'cont_mda_seq', hidden: true,  },
                    {datafield: 'bigo_seq', hidden: true,  }
                ]
            });
        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            window.open("./cont_form.php?cont_seq="+getRowData['cont_seq'], "_blank") ;
        });
        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });

        $("#btnSave").click(function (event) {
            var chk = $('#grid').jqxGrid('getselectedrowindexes');
            if(chk.length <= 0 ){
                alert("저장할 계약상품을 선택하십시오. ");
                return false ;
            } 
            var _data = [] ;
            for (var i = 0; i < chk.length; i++) {
                _data.push($('#grid').jqxGrid('getrowdatabyid', chk[i]));
            }
            var params  =  {"codeList" : _data} ;
            fn_submission( "subSave" , "./cont_mda_list_update.php", params, true, fn_subCodeCallback  );

        });
        function fn_subCodeCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                source.data = formParams($("#fsearch"))  ;
                $("#grid").jqxGrid("updatebounddata","cells");
            }catch (e) {
            }
        }
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
    <strong>매체사</strong>
    <? print_comp_search('AAC02', $_REQUEST['comp_seq'], $_REQUEST['comp_nm'] ,'', "Y", "N") ?>

    <strong>운행일</strong>
    <input  id="fr_date" name="fr_date"    maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"    maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>

    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '',"BAC01");?>
    </select>

    <strong>운행확정 여부</strong>
    <label><input type='checkbox' name='op_yn' id='op_yn' value='Y'  checked >운행확정 매체만 </label>

    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
        <?if($member['mb_level'] > 8 || $member['mb_level'] ==  4 ){?>
        <div class="btn_list03">
            <button  id="btnSave"  class="btn_save"   style="">비고 수정</button>
        </div>
        <?}?>
        <div id="grid"  style="width: 100%; height: 100%;"></div>
        <?php
        include_once('./common/comm_grid_btns.php');
        ?>
    </div>
<?php
include_once ('./sale.tail.php');
?>