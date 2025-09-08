<?php
$sub_menu = "400300";
include_once('./_common.php');

$g5['title'] = 'DS 운행 현황';
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
                      { name: 'comp_seq'}
                    , { name: 'mda_comp_nm'}
                    , { name: 'comp_type'}
                    , { name: 'mda_type'}
                    , { name: 'prod_seq'}
                    , { name: 'mda_cnt', type: 'number'},
                    , { name: 'prod_nm'}
                    , { name: 'use_yn'}
                    , { name: 'asg_use_yn'}
                    , { name: 'asg_seq'}
                    , { name: 'asg_num'}
                    , { name: 'ord'}
                    , { name: 'cont_asg_seq'}
                    , { name: 'st_dt'}
                    , { name: 'ed_dt'}
                    , { name: 'act_st_time'}
                    , { name: 'act_ed_time'}
                    , { name: 'cont_mda_seq'}
                    , { name: 'cont_nm'}
                    , { name: 'cli_nm'}
                    , { name: 'mtrl_sec'}
                    , { name: 'account_cnt'}
                    , { name: 'equip_cnt'}
                    , { name: 'guarant_pos'}
                    , { name: 'multi_yn'}
                    , { name: 'mtrl_nm'}
                    , { name: 'mda_seq'}
                    , { name: 'mda_nm'}
                    , { name: 'cont_seq'}
                    , { name: 'm1'}
                    , { name: 'm2'}
                    , { name: 'm3'}
                    , { name: 'm4'}
                    , { name: 'm5'}
                    , { name: 'm1_nm'}
                    , { name: 'm2_nm'}
                    , { name: 'm3_nm'}
                    , { name: 'm4_nm'}
                    , { name: 'm5_nm'}
                    , { name: 'up_mda_seq'}
                    , { name: 'dep'}
                    , { name: 'full_nm'}
                    , { name: 'cont_stat_nm'}
                ],
                url: g_sale_url+'/inven_list_dsop_result.php',
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
                groupable: true,
                groups: ['m2_nm','mda_nm','mda_comp_nm'],
                rowdetails: true,
                showgroupsheader: false,
                groupsexpandedbydefault:true ,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#',  columntype: 'number',width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '매체', datafield: 'm2_nm',   filtertype: 'checkedlist',  align: 'center' ,width:120  },
                    { text: '상품', datafield: 'mda_nm',   filtertype: 'checkedlist',  align: 'center'  ,width:120 },
                    { text: '매체사', datafield: 'mda_comp_nm', filtertype: 'checkedlist', align: 'center' ,width:190  },
                    { text: '상품명', datafield: 'prod_nm',   filtertype: 'checkedlist',  align: 'center'  ,width:120 },
                    { text: '총구좌수', datafield: 'mda_cnt',   filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70 },
                    { text: '구좌번호', datafield: 'asg_num', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:70},
                    { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:150},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:120},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:120},
                    { text: '구좌사용여부', datafield: 'asg_use_yn', filtertype: 'checkedlist',  cellsalign: 'center',  align: 'center' ,width:100  },
                    { text: '구좌갯수', datafield: 'account_cnt', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:120 ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '시작일', datafield: 'st_dt', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:100},
                    { text: '종료일', datafield: 'ed_dt', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:100},
                    { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:70},
                    { text: '멀티소재여부', datafield: 'multi_yn', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:80},
                    { text: '소재', datafield: 'mtrl_nm', filtertype: 'checkedlist' ,   cellsalign: 'center',align: 'center'  ,width:120}

                ],
            });

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });

        $('#grid').on('rowdoubleclick', function (event) {

            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            if(getRowData['cont_seq'] != "" ){
                location.href = "./cont_form.php?cont_seq="+getRowData['cont_seq'];
            }
        });


        $("#btnexpandAll").click(function (event) {
            $("#grid").jqxGrid('expandallgroups');
        });
        $("#btncollapseAll").click(function (event) {
            $("#grid").jqxGrid('collapseallgroups');
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
    <strong>매체사명</strong>
    <input type="text" name="comp_nm" value="<?php echo $comp_nm ?>"  id="comp_nm" required class="required frm_input">

    <strong>기간</strong>
    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>

    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px"   >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '',"BAC01");?>
        <option value="BAC99">확정이상</option>
    </select>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>
<div style='margin-top:5px;float: left;' class="btn_list03" >
    <button  id="btnexpandAll" class="btn_color12"  >모두 펼치기</button>
    <button  id="btncollapseAll" class="btn_color04">모두 접기</button>
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
