<?php
$sub_menu = "100300";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '광고주 관리';
include_once('./sale.head.php');

$sql = " select sum(case when deal_sts_code='BAA01' then 1 else 0 end) as sts_ok,
            sum(case when deal_sts_code !='BAA01' then 1 else 0 end) as sts_stop
             from tb_comp where comp_type='AAC01' and del_yn='N' ";
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
                    { name: 'comp_seq',type: 'number'},
                    { name: 'comp_type_nm'},
                    { name: 'comp_nm'},
                    { name: 'rep_nm1'},
                    { name: 'busi_no'},
                    { name: 'deal_sts_nm'},
                    { name: 'bill_type_nm'},
                    { name: 'brand_1'},
                    { name: 'brand_2'},
                    { name: 'brand_3'},
                    { name: 'brand_4'},
                    { name: 'addr1'},
                    { name: 'addr2'},
                    { name: 'addr3'},
                    { name: 'tel_no'},
                    { name: 'busi_sts'},
                    { name: 'chrg_nm'},
                    { name: 'psrn_nm'},
                    { name: 'fin_nm'},
                    { name: 'entr_dt'},
                    { name: 'entr_prsn'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'}
                ],
                url: g_sale_url+'/comp_list_result.php',
                cache: false,
                data:{
                    comp_type:'AAC01',
                    deal_sts_code:'<?php echo $_GET['deal_sts_code'] ?>',
                    sfl:$('#sfl').val(),
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

                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum
                    },
                    { text: '광고주코드', datafield: 'comp_seq', filtertype: 'checkedlist', cellsalign: 'right', align: 'center' ,width:70},
                    { text: '광고주명', datafield: 'comp_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},
                    { text: '대표자명', datafield: 'rep_nm1', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 },
                    { text: '사업자번호', datafield: 'busi_no', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '결제조건', datafield: 'bill_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '거래상태', datafield: 'deal_sts_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},

                    { text: '전화번호', datafield: 'tel_no', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '직책자', datafield: 'chrg_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 },
                    { text: '실무자', datafield: 'psrn_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  },
                    { text: '재무담당', datafield: 'fin_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 },
                    { text: '브랜드1', datafield: 'brand_1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:120 },
                    { text: '브랜드2', datafield: 'brand_2', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:120 },
                    { text: '브랜드3', datafield: 'brand_3', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:120 },
                    { text: '브랜드4', datafield: 'brand_4', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:120 },
                    { text: '주소1', datafield: 'addr1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:170 },
                    { text: '주소2', datafield: 'addr2', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '주소3', datafield: 'addr3', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정자', datafield: 'updt_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130}
                ]
            });

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


        $('#grid').on('rowdoubleclick', function (event) {
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];

            location.href = g_sale_url+"/comp_form.php?w=u&comp_seq="+getRowData['comp_seq'];
        });

    });

    function fn_add_comp(){
        location.href = g_sale_url+"/comp_form.php";
    }

</script>
<div class="local_ov01 local_ov">
    <a href="?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;deal_sts_code=" class="btn_ov01" data-tooltip-text="모든 광고주를 조회합니다."><span class="btn_ov01"><span class="ov_txt">총 광고주 수 </span><span class="ov_num"> <?php echo number_format($row[sts_ok]+$row[sts_stop]) ?> </span></span></a>
    <a href="?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;deal_sts_code=BAA01" class="btn_ov01" data-tooltip-text="거래상태 정상 광고주를 조회합니다."> <span class="ov_txt">정상 </span><span class="ov_num"><?php echo number_format($row[sts_ok]) ?>건</span></a>
    <a href="?sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>&amp;deal_sts_code=BAANOT" class="btn_ov01" data-tooltip-text="거래상태 정상이 아닌 광고주를 조회합니다."> <span class="ov_txt">거래불가  </span><span class="ov_num"><?php echo number_format($row[sts_stop]) ?>건</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="all"<?php echo get_selected($sfl, "all"); ?>>전체</option>
        <option value="comp_nm"<?php echo get_selected($sfl, "comp_nm"); ?>>광고주명</option>
        <option value="chrg_nm"<?php echo get_selected($sfl, "chrg_nm"); ?>>직책자</option>
        <option value="psrn_nm"<?php echo get_selected($sfl, "psrn_nm"); ?>>실무자</option>
        <option value="fin_nm"<?php echo get_selected($sfl, "fin_nm"); ?>>재무담당자</option>
        <option value="brand"<?php echo get_selected($sfl, "brand"); ?>>브랜드</option>
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
    <? if($member['mb_level'] > 7){ ?>
    <button type="button" onclick="fn_add_comp();" class="btn btn_02">광고주 등록 <span class="sound_only"> 새창</span></button>
    <!-- <input type="submit" name="act_button" value="확인" class="btn_submit btn "> -->
    <? }?>
</div>


<form name="fmemberlist" id="fmemberlist" action="#" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
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
