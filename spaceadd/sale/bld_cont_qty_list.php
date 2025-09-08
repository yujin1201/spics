    <?php
    $sub_menu = "100602";
    include_once('./_common.php');

    $g5['title'] = '빌딩 재원 관리';
    include_once('./sale.head.php');

    $st_dt = isset($_REQUEST['st_dt']) ? $_REQUEST['st_dt'] : date( 'Y-m-01' ) ;
    $ed_dt = isset($_REQUEST['ed_dt']) ? $_REQUEST['ed_dt'] : date( 'Y-m-t' ) ;
    $sec_div = isset($_REQUEST['sec_div']) ? $_REQUEST['sec_div'] : "mtrl_sec" ;
    ?>
    <style>
        .jqx-pivotgrid-expand-button , .jqx-pivotgrid-collapse-button{
           display: none;
        }
        #divPivotGrid div {
          box-sizing: content-box !important;
        }
    </style>

    <script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxpivot.js"></script>
    <script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxpivotgrid.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            try{
                var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'bld_seq',type: 'number'},
                        { name: 'bld_num'},
                        { name: 'bld_nm'},
                        { name: 'dt'},
                        { name: 'ins_sec',type: 'number'},
                        { name: 'qty_sec',type: 'number'},
                        { name: 'real_sec',type: 'number'},
                        { name: 'dt'},
                        { name: 'mtrl_sec',type: 'number'},
                        { name: 'able_sec',type: 'number'},
                        { name: 'cont_nm'},
                        { name: 'cli_nm'},
                        { name: 'agncy_nm'},
                        { name: 'yyyy'},
                        { name: 'mm'},
                        { name: 'dd', type: 'number'},
                    ],
                    url: g_sale_url+'/bld_cont_qty_list_result.php',
                    cache: false,
                    async: false ,
                    data: formParams($("#fsearch"))
                };

            var adapter = new $.jqx.dataAdapter(source);
            var pivotDataSource = new $.jqx.pivot(
                adapter,
                {
                    pivotValuesOnRows: false,
                    rows: [ { dataField: 'bld_nm', showExpandCollapseButtons : false },  { dataField: 'bld_seq' , isHidden : true, showExpandCollapseButtons : false},  ],
                    columns: [{ dataField: 'mm' }, { dataField: 'dd' }],
                    values: [
                        <?if( $sec_div =="mtrl_sec" || $sec_div =="all_sec"){  ?>
                        { dataField: 'mtrl_sec', 'function': 'sum', text: '판매' , align :"center" },
                        <?} ?>
                        <?if( $sec_div =="able_sec" || $sec_div =="all_sec"){  ?>
                        { dataField: 'able_sec', 'function': 'sum', text: '미판' , align :"center" },
                        <?} ?>
                    ],
                    totals: {rows: {subtotals: false, grandtotals: true} , columns: {subtotals: false, grandtotals: true}},
                });
                $('#divPivotGrid').jqxPivotGrid({
                      source: pivotDataSource,
                      selectionEnabled: true ,
                      autoResize: false,
                      treeStyleRows: false ,
                    });

                $('#divPivotGrid').on('pivotcelldblclick', function (event) {
                    const bld_nm = event.args.pivotRow.text;
                    const bld_seq = event.args.pivotRow.items[0].text;
                    url = "./bld_cont_qty_pop.php?bld_seq="+bld_seq+"&st_dt=<?=$st_dt?>&ed_dt=<?=$ed_dt?>" ;
                    var new_win = window.open(url, 'win_profile', 'left=100,top=100,width=1000,height=900');
                    new_win.focus();
                });

                $("#refresh").click(function () {
                    fsearch.submit();
                });

                setTimeout(()=>{
                    var pivotGrid = $('#divPivotGrid').jqxPivotGrid('getInstance');
                    pivotGrid.getPivotRows().items.forEach((item, index)=>{
                         item.setWidth(200);
                      }) ;
                    pivotGrid.getPivotColumns().items.forEach((item, index)=>{
                      item.expand();
                    }) ;

                    var gridHeight = Number($(window).height()) -  $("#main_grid").offset().top  -  50;
                     $("#main_grid").height(gridHeight);
                     $("#divPivotGrid").height(gridHeight);
                     $("#divContent").height(gridHeight);

                    pivotGrid.refresh();

                },100)
            }catch (e) {
                console.log(e)
            }
        });

        window.addEventListener('resize', function(event) {
            var gridHeight = Number($(window).height()) -  $("#main_grid").offset().top ;
            $("#main_grid").height(gridHeight);
            $("#divPivotGrid").height(gridHeight);
            $("#divContent").height(gridHeight);
        }, true);

        $(function(){
            $("#st_dt, #ed_dt").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                yearRange: "c-99:c+99"  });
        });
        </script>

    <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" action="./bld_cont_qty_list.php">
        <label for="sfl" class="sound_only">검색대상</label>
        <select name="sfl" id="sfl">
            <option value="sch_all"<?php echo get_selected($sfl, "sch_all"); ?>>전체</option>
            <option value="comp_nm"<?php echo get_selected($sfl, "bld_nm"); ?>>빌딩명</option>
        </select>
        <label for="stx" class="sound_only">검색어</label>
        <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">

        <strong style="width:unset">기간</strong>
        <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_dt?>"></input>
        ~
        <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_dt?>"></input>


        <strong style="width:unset"> <label for="bld_pkg">패키지</label></strong>
        <select name="bld_pkg" id="bld_pkg"  onChange=""  style="width:100px" >
            <option value="">선택</option>
            <?print_option_with_select('BBF', $_REQUEST['bld_pkg'])?>
        </select>

        <strong style="width:unset">구분</strong>
        <label class="me-3"><input type='radio' name='sec_div' id='sec_div' value='mtrl_sec'  <?=(($sec_div =="mtrl_sec" )?"checked":"")?> >판매재원  </label>
        <label><input type='radio' name='sec_div' id='sec_div' value='able_sec'  <?=(($sec_div =="able_sec" )?"checked":"")?> >미판재원 </label>
        <label><input type='radio' name='sec_div' id='sec_div' value='all_sec'  <?=(($sec_div =="all_sec" )?"checked":"")?> > 판매/미판 </label>

        <input type="button" id="refresh" class="btn_submit" value="검색">
    </form>

        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 825px;">
            <div id="divPivotGrid" style="height:90%; width:100%; background-color: white;">
            </div>
        </div>
    <?php
    include_once ('./sale.tail.php');
    ?>
