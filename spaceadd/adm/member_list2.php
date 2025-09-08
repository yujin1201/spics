<?php
$sub_menu = "200100";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '회원관리';
include_once('./admin.head.php');

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
 
            $("#grid").jqxGrid(
            {
                width: getWidth('Grid'),
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

            $('#clearfilteringbutton').jqxButton({ height: 25 });
            $('#filterbackground').jqxCheckBox({ checked: true, height: 25 });
            $('#filtericons').jqxCheckBox({ checked: false, height: 25 });
            // clear the filtering.
            $('#clearfilteringbutton').click(function () {
                $("#grid").jqxGrid('clearfilters');
            });
            // show/hide filter background
            $('#filterbackground').on('change', function (event) {
                $("#grid").jqxGrid({ showfiltercolumnbackground: event.args.checked });
            });
            // show/hide filter icons
            $('#filtericons').on('change', function (event) {
                $("#grid").jqxGrid({ autoshowfiltericon: !event.args.checked });
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

<div class="tbl_head01 tbl_wrap">
    <div id="grid">
        </div>
        <div id="eventslog" style="margin-top: 30px;">
            <div style="width: 200px; float: left; margin-right: 10px;">
                <input value="Remove Filter" id="clearfilteringbutton" type="button" />
                <div style="margin-top: 10px;" id='filterbackground'>Filter Background</div>
                <div style="margin-top: 10px;" id='filtericons'>Show All Filter Icons</div>
            </div>
            <div style="float: left;">
                Event Log:
                <div style="border: none;" id="events">
                </div>
            </div>
        </div>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02">
    <?php if ($is_admin == 'super') { ?>
    <a href="./member_form.php" id="member_add" class="btn btn_01">회원추가</a>
    <?php } ?>

</div>


</form>


</div>
<footer id="ft">
            <p>
                Copyright &copy; spaceadd2.cafe24.com. All rights reserved. Version 5.4.5.1<br>
               <button type="button" class="scroll_top"><span class="top_img"></span><span class="top_txt">TOP</span></button>
           </p>
        </footer>
</div>
</div>
<script>
$(".scroll_top").click(function(){
     $("body,html").animate({scrollTop:0},400);
})
</script>
<script src="https://spaceadd2.cafe24.com/spaceadd/adm/admin.js?ver=191202"></script>
<script src="https://spaceadd2.cafe24.com/spaceadd/js/jquery.anchorScroll.js?ver=191202"></script>
<script>
$(function(){

    var admin_head_height = $("#hd_top").height() + $("#container_title").height() + 5;

    $("a[href^='#']").anchorScroll({
        scrollSpeed: 0, // scroll speed
        offsetTop: admin_head_height, // offset for fixed top bars (defaults to 0)
        onScroll: function () { 
          // callback on scroll start
        },
        scrollEnd: function () { 
          // callback on scroll end
        }
    });

    var hide_menu = false;
    var mouse_event = false;
    var oldX = oldY = 0;

    $(document).mousemove(function(e) {
        if(oldX == 0) {
            oldX = e.pageX;
            oldY = e.pageY;
        }

        if(oldX != e.pageX || oldY != e.pageY) {
            mouse_event = true;
        }
    });

    // 주메뉴
    var $gnb = $(".gnb_1dli > a");
    $gnb.mouseover(function() {
        if(mouse_event) {
            $(".gnb_1dli").removeClass("gnb_1dli_over gnb_1dli_over2 gnb_1dli_on");
            $(this).parent().addClass("gnb_1dli_over gnb_1dli_on");
            menu_rearrange($(this).parent());
            hide_menu = false;
        }
    });

    $gnb.mouseout(function() {
        hide_menu = true;
    });

    $(".gnb_2dli").mouseover(function() {
        hide_menu = false;
    });

    $(".gnb_2dli").mouseout(function() {
        hide_menu = true;
    });

    $gnb.focusin(function() {
        $(".gnb_1dli").removeClass("gnb_1dli_over gnb_1dli_over2 gnb_1dli_on");
        $(this).parent().addClass("gnb_1dli_over gnb_1dli_on");
        menu_rearrange($(this).parent());
        hide_menu = false;
    });

    $gnb.focusout(function() {
        hide_menu = true;
    });

    $(".gnb_2da").focusin(function() {
        $(".gnb_1dli").removeClass("gnb_1dli_over gnb_1dli_over2 gnb_1dli_on");
        var $gnb_li = $(this).closest(".gnb_1dli").addClass("gnb_1dli_over gnb_1dli_on");
        menu_rearrange($(this).closest(".gnb_1dli"));
        hide_menu = false;
    });

    $(".gnb_2da").focusout(function() {
        hide_menu = true;
    });

    $('#gnb_1dul>li').bind('mouseleave',function(){
        submenu_hide();
    });

    $(document).bind('click focusin',function(){
        if(hide_menu) {
            submenu_hide();
        }
    });

    // 폰트 리사이즈 쿠키있으면 실행
    var font_resize_act = get_cookie("ck_font_resize_act");
    if(font_resize_act != "") {
        font_resize("container", font_resize_act);
    }
});

function submenu_hide() {
    $(".gnb_1dli").removeClass("gnb_1dli_over gnb_1dli_over2 gnb_1dli_on");
}

function menu_rearrange(el)
{
    var width = $("#gnb_1dul").width();
    var left = w1 = w2 = 0;
    var idx = $(".gnb_1dli").index(el);

    for(i=0; i<=idx; i++) {
        w1 = $(".gnb_1dli:eq("+i+")").outerWidth();
        w2 = $(".gnb_2dli > a:eq("+i+")").outerWidth(true);

        if((left + w2) > width) {
            el.removeClass("gnb_1dli_over").addClass("gnb_1dli_over2");
        }

        left += w1;
    }
}

</script>



</body>
</html>
