<?php
$sub_menu = "100500";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '소재 관리';
include_once('./sale.head.php');

?>

<script type="text/javascript">
    $(document).ready(function () {

        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'mtrl_seq',type: 'number'},
                    { name: 'comp_seq',type: 'number'},
                    { name: 'comp_nm'},
                    { name: 'mtrl_nm'},
                    { name: 'mtrl_sec'},
                    { name: 'use_yn'},
                    { name: 'prod_type'},
                    { name: 'bigo'},
                    { name: 'prod_type_nm'},
                    { name: 'entr_dt'}
                ],
                url: g_sale_url+'/mtrl_all_list_result.php',
                cache: false,
                data:{
                    sfl:$('#sfl').val(),
                    prod_type:$('#prod_type').val(),
                    search_str:$('#stx').val()
                }
            };

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
                //theme: "dark",
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
                    { text: '광고주코드', datafield: 'comp_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '광고주명', datafield: 'comp_nm', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:150 },
                    { text: '소재코드', datafield: 'mtrl_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '소재명', datafield: 'mtrl_nm', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:150},
                    { text: '소재초수', datafield: 'mtrl_sec', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '업종', datafield: 'prod_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150}
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

        $("#refresh").click(function () {
            source.data={
                sfl:$('#sfl').val(),
                prod_type:$('#prod_type').val(),
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
            location.href = g_sale_url+"/comp_form.php?w=u&comp_seq="+getRowData['comp_seq'];
        });

    });

    function fn_add_comp(){
        location.href = g_sale_url+"/comp_form.php";
    }

</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="all"<?php echo get_selected($sfl, "all"); ?>>전체</option>
        <option value="comp_nm"<?php echo get_selected($sfl, "comp_nm"); ?>>광고주</option>
        <option value="mtrl_nm"<?php echo get_selected($sfl, "mtrl_nm"); ?>>소재명</option>
    </select>
    <label for="stx" class="sound_only">검색어</label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    &nbsp;&nbsp;&nbsp;&nbsp;
    <label for="prod_type"> 업종</label>
    <select name="prod_type" id="prod_type" onChange="">
        <option value="">전체<?print_option_with_select('AAD', $_GET['prod_type']);?>
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
    <!--<button type="button" onclick="fn_add_comp();" class="btn btn_02">소재 등록 <span class="sound_only"> 새창</span></button> -->
    <!-- <input type="submit" name="act_button" value="확인" class="btn_submit btn "> -->
</div>


<form name="fmemberlist" id="fmemberlist" action="#" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 655px;">
        <div id="grid"  style="width: 100%; height: 100%;">
        </div>

        <div style='margin-top: 20px;'>
            <div style='float: left;'>
                <input value="Remove Filter" id="clearfilteringbutton" type="button" />
                <input type="button" value="Excel" id='excelExport' />
                <!--<input id="refresh" type="button" value="Refresh Data" />-->
                <!--<input id="clear" type="button" value="Clear" />
                <input type="button" style="margin: 10px;" id="jqxbutton" value="Render" />-->
            </div>

        </div>
    </div>

</form>


<?php
include_once ('./sale.tail.php');
?>
