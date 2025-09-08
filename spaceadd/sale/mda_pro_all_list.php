<?php
$sub_menu = "100510";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');

if(!($member['mb_level'] > 5)){
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    alert("권한이 없는 메뉴 입니다.", $previous);
}

$g5['title'] = '매체 광고상품 관리';
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
                    { name: 'prod_seq',type: 'number'},
                    { name: 'comp_seq'},
                    { name: 'comp_nm'},
                    { name: 'mda_seq'},
                    { name: 'mda_seq_nm'},
                    { name: 'mda_nm'},
                    { name: 'mda_cnt'},
                    { name: 'use_yn'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'use_st_time'},
                    { name: 'use_ed_time'},
                    { name: 'ad_adj_type_code'},
                    { name: 'rent_adj_type_nm'},
                    { name: 'rent_adj_day'},
                    { name: 'rent_adj_day_nm'},
                    { name: 'rent_amt', type: 'number'},
                    { name: 'ad_adj_type_code'},
                    { name: 'ad_adj_type_nm'},
                    { name: 'ad_adj_day'},
                    { name: 'ad_adj_day_nm'},
                    { name: 'ad_amt', type: 'number'},
                    { name: 'ad_rt', type: 'number'},
                    { name: 'full_nm'},
                    { name: 'bigo'},
                    { name: 'full_nm'},
                    { name: 'm1_nm'},
                    { name: 'm2_nm'},
                    { name: 'm3_nm'},
                    { name: 'm4_nm'},
                    { name: 'entr_prsn'},
                    { name: 'updt_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_dt'}
                ],
                url: g_sale_url+'/mda_pro_all_list_result.php',
                cache: false,
                data:{
                    sfl:$('#sfl').val(),
                    sfl2:$('#sfl2').val(),
                    search_str:$('#stx').val()
                }
            };

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
                groupable: true,
                groupsexpandedbydefault:true ,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum
                    },
                    { text: '매체상품 코드', datafield: 'prod_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '매체사명', datafield: 'comp_nm', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:150 },
                    { text: '상품구분', datafield: 'm1_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:80},
                    { text: '상품명', datafield: 'mda_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:220},
                    { text: '상품경로', datafield: 'full_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:290},
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '임대료 구분', datafield: 'rent_adj_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90},
                    { text: '임대료 납입일', datafield: 'rent_adj_day_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90},
                    { text: '임대료', datafield: 'rent_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '광고료 구분', datafield: 'ad_adj_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90},
                    { text: '광고료 비율', datafield: 'ad_rt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:120},
                    { text: '광고료', datafield: 'ad_amt', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '광고료 납입일', datafield: 'ad_adj_day_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90},
                    { text: '상품경로2', datafield: 'm2_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:80},
                    { text: '상품경로3', datafield: 'm3_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:80},
                    { text: '상품경로4', datafield: 'm4_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:80},

                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130}
                ]
            });

        $("#refresh").click(function () {
            source.data={
                sfl:$('#sfl').val(),
                sfl2:$('#sfl2').val(),
                search_str:$('#stx').val()
            }
            //console.log(source);
            // passing "cells" to the 'updatebounddata' method will refresh only the cells values when the new rows count is equal to the previous rows count.
            $("#grid").jqxGrid("updatebounddata","cells");
        });


        $('#grid').on('rowdoubleclick', function (event) {
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            location.href = g_sale_url+"/mda_form.php?w=u&comp_seq="+getRowData['comp_seq'];
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
        <option value="comp_nm"<?php echo get_selected($sfl, "comp_nm"); ?>>매체사</option>
        <option value="mda_nm"<?php echo get_selected($sfl, "mda_nm"); ?>>상품명</option>
    </select>
    <label for="stx" class="sound_only">검색어</label>
    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
    &nbsp;&nbsp;&nbsp;&nbsp;
    <select name="sfl2" id="sfl2">
        <option value="comp_nm"<?php echo get_selected($sfl2, "all"); ?>>전체</option>
        <option value="s_type"<?php echo get_selected($sfl2, "s_type"); ?>>자사매체</option>
        <option value="d_type"<?php echo get_selected($sfl2, "d_type"); ?>>타사매체</option>
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



<form name="fmemberlist" id="fmemberlist" action="#" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="sfl2" value="<?php echo $sfl2 ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 655px;">
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
