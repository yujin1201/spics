<?php
$sub_menu = "100100";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '매체등록';
include_once('./sale.head.php');

?>
<script type="text/javascript" src="generatedata.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            var data = generatedata(500);
            var exampleTheme = theme;
            var source =
            {
                localdata: data,
                datafields:
                [
                    { name: 'firstname', type: 'string' },
                    { name: 'lastname', type: 'string' },
                    { name: 'productname', type: 'string' },
                    { name: 'date', type: 'date' },
                    { name: 'quantity', type: 'number' },
                    { name: 'price', type: 'number' }
                ],
                datatype: "array"
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

            //alert(getWidth('Grid'));
 
            $("#grid").jqxGrid(
            {
                //width: getWidth('Grid'),
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
                  {
                      text: 'First Name', datafield: 'firstname', filtertype: 'list', width: 160
                  },
                  {
                      text: 'Last Name', datafield: 'lastname', filtertype: 'list',
                      width: 160
                  },
                  { text: 'Product', datafield: 'productname', filtertype: 'checkedlist', width: 170 },
                  { text: 'Order Date', datafield: 'date', filtertype: 'date', width: 160, cellsformat: 'dd-MMMM-yyyy' },
                  { text: 'Quantity', datafield: 'quantity', width: 80, cellsalign: 'right' },
                  { text: 'Unit Price', datafield: 'price', cellsalign: 'right', cellsformat: 'c2' }
                ]
            });

            $('#events').jqxPanel({ width: 300, height: 80 });

            $("#grid").on("filter", function (event) {
                $("#events").jqxPanel('clearcontent');
                var filterinfo = $("#grid").jqxGrid('getfilterinformation');

                var eventData = "Triggered 'filter' event";
                for (i = 0; i < filterinfo.length; i++) {
                    var eventData = "Filter Column: " + filterinfo[i].filtercolumntext;
                    $('#events').jqxPanel('prepend', '<div style="margin-top: 5px;">' + eventData + '</div>');
                }
            });

        });
    </script>
<div class="local_ov01 local_ov">    
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="차단된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="탈퇴된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>


<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap" style="width: 100%; height: 590px;">
    <div id="grid"  style="width: 100%; height: 100%;">
    </div>

</div>

</form>


<?php
include_once ('./sale.tail.php');
?>
