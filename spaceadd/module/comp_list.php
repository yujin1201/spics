<?php
$sub_menu = "100300";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '광고주 관리';
include_once('./sale.head.php');

$sql = " select sum(case when deal_sts_code='BAA01' then 1 else 0 end) as sts_ok,
            sum(case when deal_sts_code !='BAA01' then 1 else 0 end) as sts_stop
             from tb_comp; ";
$row = sql_fetch($sql);

?>
<script type="text/javascript">
    $('#main_grid').bind('resize', function(){
        console.log('resized');
    });
        $(document).ready(function () {
            //var data = generatedata(500);
            //var exampleTheme = theme;
            var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'comp_seq'},
                        { name: 'comp_nm'},
                        { name: 'comp_type'},
                        { name: 'busi_no'},
                        { name: 'rep_nm1'},
                        { name: 'entr_dt'}
                    ],
                    url: 'comp_list_result.php',
                    cache: false
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
                source: adapter,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                autoshowfiltericon: true,
                columns: [
                    { text: '광고주 코드', datafield: 'comp_seq', filtertype: 'checkedlist', width: 160},
                    { text: '광고주 명', datafield: 'comp_nm', filtertype: 'checkedlist', width: 160},
                    { text: '회사 구분', datafield: 'comp_type', filtertype: 'checkedlist', width: 170 },
                    { text: '거래 상태', datafield: 'busi_no', filtertype: 'checkedlist', width: 170 },
                    { text: '담당자 명', datafield: 'rep_nm1', filtertype: 'checkedlist', width: 170 },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'date', width: 160 }
                ]
            });

            $('#clearfilteringbutton').jqxButton({ height: 25 });
            $('#clearfilteringbutton').click(function () {
                $("#grid").jqxGrid('clearfilters');
            });

            $("#excelExport").jqxButton();
            $("#excelExport").click(function () {
                $("#grid").jqxGrid('exportdata', 'xlsx', 'jqxGrid');
            });


            $('#grid').on('rowdoubleclick', function (event) {
                var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];

                alert(getRowData['comp_nm']);
                //alert(event.args.rowindex);
                console.log(getRowData);
            });

        });
    </script>
<div class="local_ov01 local_ov">    
    <span class="btn_ov01"><span class="ov_txt">총 광고주 수 </span><span class="ov_num"> <?php echo number_format($row[sts_ok]+$row[sts_stop]) ?> </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="차단된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">정상 </span><span class="ov_num"><?php echo number_format($row[sts_ok]) ?>건</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="탈퇴된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">거래종료  </span><span class="ov_num"><?php echo number_format($row[sts_stop]) ?>건</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($sfl, "comp_nm"); ?>>광고주 명</option>
        <option value="mb_nick"<?php echo get_selected($sfl, "rep_nm"); ?>>대표자 명</option>
        <option value="mb_name"<?php echo get_selected($sfl, "mb_name"); ?>>담당자 명</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>
<div class="btn_fixed_top">
    <button type="button" onclick="return add_menu();" class="btn btn_02">메뉴추가<span class="sound_only"> 새창</span></button>
    <input type="submit" name="act_button" value="확인" class="btn_submit btn ">
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
            <input value="Remove Filter" id="clearfilteringbutton" type="button" /> <input type="button" value="Export to Excel" id='excelExport' />
        </div>

    </div>
</div>

</form>


<?php
include_once ('./sale.tail.php');
?>
