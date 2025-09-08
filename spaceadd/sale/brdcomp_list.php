<?php
$sub_menu = "100100";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '매체사 관리';
include_once('./sale.head.php');

$sql = " select sum(case when deal_sts_code='BAA01' then 1 else 0 end) as sts_ok,
            sum(case when deal_sts_code !='BAA01' then 1 else 0 end) as sts_stop
             from tb_comp where comp_type='AAC01' ";
$row = sql_fetch($sql);

?>
<script type="text/javascript">
    $(document).ready(function () {

        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'comp_type_nm'},
                    { name: 'comp_nm'},
                    { name: 'rep_nm1'},
                    { name: 'busi_no'},
                    { name: 'deal_sts_nm'},
                    { name: 'bill_type_nm'},
                    { name: 'deal_ocur_dt'},
                    { name: 'addr1'},
                    { name: 'addr2'},
                    { name: 'addr3'},
                    { name: 'tel_no'},
                    { name: 'busi_sts'},
                    { name: 'chrg_nm'},
                    { name: 'psrn_nm'},
                    { name: 'fin_nm'},
                    { name: 'entr_dt'}
                ],
                url: './comp_list_result.php',
                cache: false,
                data:{
                    comp_type:'AAC01',
                    deal_sts_code:'<?php echo $_GET['deal_sts_code'] ?>',
                    sfl:$('#sfl').val(),
                    search_str:$('#stx').val()
                }
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
                //width: getWidth('grid'),
                width: '100%',
                height: '100%',
                //autorowheight: true,
                //autoheight: true,
                source: adapter,
                theme: "dark",
                columnsresize: true,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', sortable: false, filterable: false, editable: false,
                        groupable: false, draggable: false, resizable: false,
                        datafield: '', columntype: 'number', width: 50,
                        cellsrenderer: function (row, column, value) {
                            return "<div style='margin:4px;'>" + (value + 1) + "</div>";
                        }
                    },
                    { text: '광고주 코드', datafield: 'comp_seq', filtertype: 'checkedlist', cellsalign: 'right', align: 'center'  ,width:70},
                    { text: '회사 구분', datafield: 'comp_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:90},
                    { text: '광고주 명', datafield: 'comp_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},
                    { text: '대표자 명', datafield: 'rep_nm1', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 },
                    { text: '사업자 번호', datafield: 'busi_no', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '결재 조건', datafield: 'bill_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '거래 상태', datafield: 'deal_sts_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '거래 발생일자', datafield: 'deal_ocur_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '전화번호', datafield: 'tel_no', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '직책자', datafield: 'chrg_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 },
                    { text: '실무자', datafield: 'psrn_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  },
                    { text: '재무담당', datafield: 'fin_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 },
                    { text: '주소1', datafield: 'addr1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:170 },
                    { text: '주소2', datafield: 'addr2', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '주소3', datafield: 'addr3', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100}
                ]
            });


        $('#clearfilteringbutton').jqxButton({ theme: theme });
        $('#clearfilteringbutton').click(function () {
            $("#grid").jqxGrid('clearfilters');
        });

        $("#excelExport").jqxButton({ theme: theme });
        $("#excelExport").click(function () {
            $("#grid").jqxGrid('exportdata', 'xlsx', 'jqxGrid');
        });
        $("#refresh").jqxButton({ theme: theme });
        $("#clear").jqxButton({ theme: theme });
        $("#refresh").click(function () {
            source.data={
                comp_type:'AAC01',
                sfl:$('#sfl').val(),
                deal_sts_code:$('#deal_sts_code').val(),
                search_str:$('#stx').val()
            }
            //console.log(source);
            // passing "cells" to the 'updatebounddata' method will refresh only the cells values when the new rows count is equal to the previous rows count.
            $("#grid").jqxGrid("updatebounddata","cells");
        });
        $("#clear").click(function () {
            $("#grid").jqxGrid('clear');
        });
        $('#btn_gnb').click(function () {

            $('#grid').jqxGrid('render');
        });


        $('#grid').on('rowdoubleclick', function (event) {
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];

            //alert(getRowData['comp_seq']);
            //alert(event.args.rowindex);
            //console.log(getRowData);
            location.href = "./comp_form.php?w=u&comp_seq="+getRowData['comp_seq'];
        });

    });

    function fn_add_comp(){
        location.href = "./comp_form.php";
    }

    </script>
<div class="local_ov01 local_ov">
    <a href="?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;deal_sts_code=" class="btn_ov01" data-tooltip-text="모든 광고주를 조회합니다."><span class="btn_ov01"><span class="ov_txt">총 광고주 수 </span><span class="ov_num"> <?php echo number_format($row[sts_ok]+$row[sts_stop]) ?> </span></span></a>
    <a href="?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;deal_sts_code=BAA01" class="btn_ov01" data-tooltip-text="거래상태 정상 광고주를 조회합니다."> <span class="ov_txt">정상 </span><span class="ov_num"><?php echo number_format($row[sts_ok]) ?>건</span></a>
    <a href="?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;deal_sts_code=BAANOT" class="btn_ov01" data-tooltip-text="거래상태 정상이 아닌 광고주를 조회합니다."> <span class="ov_txt">거래종료  </span><span class="ov_num"><?php echo number_format($row[sts_stop]) ?>건</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="comp_nm"<?php echo get_selected($sfl, "comp_nm"); ?>>광고주 명</option>
        <option value="rep_nm"<?php echo get_selected($sfl, "rep_nm"); ?>>대표자 명</option>
        <option value="mb_name"<?php echo get_selected($sfl, "mb_name"); ?>>담당자 명</option>
    </select>
    <label for="stx" class="sound_only">검색어</label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="deal_sts_code"> 거래 상태</label>
    <select name="deal_sts_code" id="deal_sts_code" onChange="">
        <option value="">전체<?print_option_with_select('BAA', $_GET['deal_sts_code']);?>
    </select>    
    
<input type="button" id="refresh" class="btn_submit" value="검색">

</form>
<!--
<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
-->
<div class="btn_fixed_top">
    <button type="button" onclick="fn_add_comp();" class="btn btn_02">광고주 등록 <span class="sound_only"> 새창</span></button>
    <!-- <input type="submit" name="act_button" value="확인" class="btn_submit btn "> -->
</div>


<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 590px;">
    <div id="grid"  style="width: 100%; height: 100%;">
    </div>

    <div style='margin-top: 20px;'>
        <div style='float: left;'>
            <input value="Remove Filter" id="clearfilteringbutton" type="button" />
            <input type="button" value="Export to Excel" id='excelExport' />
            <!--<input id="refresh" type="button" value="Refresh Data" />-->
            <input id="clear" type="button" value="Clear" />
            <input type="button" style="margin: 10px;" id="jqxbutton" value="Render" />
        </div>

    </div>
</div>

</form>


<?php
include_once ('./sale.tail.php');
?>
