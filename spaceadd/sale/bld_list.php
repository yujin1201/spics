<?php
$sub_menu = "100600";
include_once('./_common.php');

$g5['title'] = '빌딩 관리';
include_once('./sale.head.php');



?>
<script type="text/javascript">
    $(document).ready(function () {

        $("#grid").jqxGrid('clear');
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'bld_seq',type: 'number'},
                    { name: 'bld_num'},
                    { name: 'bld_nm'},
                    { name: 'zipcode'},
                    { name: 'addr1'},
                    { name: 'addr2'},
                    { name: 'addr3'},
                    { name: 'bld_type'},
                    { name: 'bld_level'},
                    { name: 'bld_floor'},
                    { name: 'bld_ev1'},
                    { name: 'bld_ev2'},
                    { name: 'area1'},
                    { name: 'area2'},
                    { name: 'bld_pkg'},
                    { name: 'ds_type'},
                    { name: 'ds_ev1'},
                    { name: 'ds_ev2'},
                    { name: 'ds_ev3'},
                    { name: 'ds_ev4'},
                    { name: 'disable_cnt'},
                    { name: 'ins_cnt'},
                    { name: 'ins_sec'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'excpt_item'},
                    { name: 'bigo'},
                    { name: 'use_yn'},
                    { name: 'del_yn'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'} ,
                    { name: 'bld_type_nm'},
                    { name: 'bld_pkg_nm'},
                    { name: 'bld_level_nm'},
                    { name: 'area1_nm'},
                    { name: 'bld_mda_type'},
                    { name: 'bld_mda_type_nm'},
                ],
                url: g_sale_url+'/bld_list_result.php',
                cache: false,
                data:formParams($("#fsearch"))
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
                showfilterbar: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount ,
                    },
                    { text: '빌딩코드', datafield: 'bld_num', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '건물유형', datafield: 'bld_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},

                    { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},
                    { text: '매체 타입', datafield: 'bld_mda_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '패키지', datafield: 'bld_pkg_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '등급', datafield: 'bld_level_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '권역', datafield: 'area1_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '주소1', datafield: 'addr1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:270 },
                    { text: '금지업종', datafield: 'excpt_item', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정자', datafield: 'updt_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130} ,
                    {datafield: 'bld_seq', hidden: true,  }
                ]
            });


        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });


        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            const url  = "./bld_form.php?w=u&bld_seq="+getRowData['bld_seq'];
            window.open(url, "_blank") ;
        });

    });

    function fn_add_bld(){
        location.href = "./bld_form.php";
    }

    </script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" class="w100">
        <option value="sch_all"<?php echo get_selected($sfl, "sch_all"); ?>>전체</option>
        <option value="comp_nm"<?php echo get_selected($sfl, "bld_nm"); ?>>빌딩명</option>
        <option value="comp_nm"<?php echo get_selected($sfl, "addr1"); ?>>주소1</option>
    </select>
    <label for="stx" class="sound_only">검색어</label>
    <input type="text" name="search_str" value="<?php echo $search_str ?>" id="search_str" required class="required frm_input">

    <strong style="width:unset"> <label for="bld_pkg">패키지</label></strong>
     <?print_option_with_checkbox('bld_pkg', 'BBF', $_REQUEST['bld_pkg'], "", "", true)?>

    <strong><label for="bld_mda_type"> 매체 타입</label></strong>
    <select name="bld_mda_type" id="bld_mda_type" onChange="">
        <option value="">전체<?print_option_with_select('BBK', $_REQUEST['bld_mda_type']);?>
    </select>

    <input type="button" id="refresh" class="btn_submit" value="검색">
</form>

<div class="btn_fixed_top">
    <?if($member['mb_level'] > 7 || $member['mb_level'] ==  4 ){?>
      <button type="button" onclick="fn_add_bld();" class="btn btn_02">빌딩 등록 <span class="sound_only"> 새창</span></button>
    <?}?>
</div>


<form name="fmdalist" id="fmdalist" action="#" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;">
    </div>

    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>

</form>


<?php
include_once ('./sale.tail.php');
?>
