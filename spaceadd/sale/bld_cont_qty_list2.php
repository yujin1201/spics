    <?php
    $sub_menu = "100602";
    include_once('./_common.php');

    $g5['title'] = '빌딩 재원 관리';
    include_once('./sale.head.php');

    $st_dt = isset($_REQUEST['st_dt']) ? $_REQUEST['st_dt'] : date( 'Y-m-01' ) ;
    $ed_dt = isset($_REQUEST['ed_dt']) ? $_REQUEST['ed_dt'] : date( 'Y-m-t' ) ;
    $sec_div = isset($_REQUEST['sec_div']) ? $_REQUEST['sec_div'] : "mtrl_sec" ;
    ?>

    <link rel="stylesheet" type="text/css" href="/htmlelements/source/styles/smart.default.css" />
    <link rel="stylesheet" type="text/css" href="/htmlelements/styles/demos.css" />
    <script type="module" src="/htmlelements/source/modules/smart.pivottable.js"></script>
    <style>
        .smart-pivot-table {
            height: 800px;
        }
    </style>


    <script type="text/javascript">
        $(document).ready(function () {
            var  pivotTable  ;
            function generateData() {
                var str= './bld_cont_qty_list3_result.php'
                const params = formParams($("#fsearch"))   ;
                Object.keys(params).forEach((el, idx)=>{
                    str += ((idx > 0 )?"&":"?")+el+"="+params[el] ;
                })
                fn_submission("subInvList", str, {} , true, fn_getInvListCallback ) ;
            }
            function fn_getInvListCallback(sub, data){
                initPivot(data)
            }

            function initPivot(data){
                console.log(data)
                const pivotData = data.map(el=>{
                    return {
                        bld_seq : el.bld_seq
                        ,bld_nm : el.bld_nm
                        , yyyy : el.yyyy
                        , dd : el.dd
                        , mm : el.mm
                        , mtrl_sec : Number(el.mtrl_sec)
                    }
                }) ;
               // console.log(pivotData)
                window.Smart('#pivotTable', class {
                    get properties() {
                        return {
                            dataSource: new window.Smart.DataAdapter({
                                dataSource: pivotData ,
                                dataFields: [
                                    'bld_seq : string ',
                                    'bld_nm : string ',
                                    'yyyy : string ',
                                    'mm : string ',
                                    'dd : string ',
                                    'mtrl_sec : number ',
                                    /*
                                    'able_sec : string ',
                                    'agncy_nm : string ',
                                    'agncy_seq : string ',
                                    'bld_nm : string ',
                                    'bld_seq : string ',
                                    'cli_nm : string ',
                                    'cli_seq : string ',
                                    'cont_bld_seq : string ',
                                    'cont_nm : string ',
                                    'cont_seq : string ',
                                    'dd : string ',
                                    'dt : string ',
                                    'ed_dt : string ',
                                    'ins_sec : string ',
                                    'mm : string ',
                                    'mtrl_sec : number ',
                                    'qty_sec : string ',
                                    'real_sec : string ',
                                    'st_dt : string ',
                                    'yyyy : string '
                                    */
                                ]
                            }),
                            freezeHeader: true,
                            keyboardNavigation: true,
                            onInit() {
                            },
                            rowTotals: true,
                            sortMode: 'one',
                            columnTotals : false ,
                            columns: [
                                { label: 'bld_nm', dataField: 'bld_nm', dataType: 'string', allowRowGroup: true, rowGroup: true },
                                { label: 'bld_seq', dataField: 'bld_seq',   dataType: 'string', allowRowGroup: true, rowGroup: true },
                                { label: 'yyyy', dataField: 'yyyy', dataType: 'string', allowPivot: true, pivot: true },
                                { label: 'mm', dataField: 'mm', dataType: 'string', allowPivot: true, pivot: true },
                                { label: 'dd', dataField: 'dd', dataType: 'string', allowPivot: true, pivot: true },
                                { label: 'mtrl_sec', dataField: 'mtrl_sec', dataType: 'number', summary: 'sum' },
                            ]
                        };
                    }
                });
                try{
                    const pivotGrid = document.createElement('smart-pivot-table');
                    pivotGrid.id = 'pivotTable';

                    document.getElementById('main_grid').appendChild(pivotGrid);
                    pivotGrid.expandAllRows();
                }catch (e) {
                    console.log(e)
                }
            }


            window.onload = function () {
                 generateData()  ;
            };

            $("#refresh").click(function () {
                document.getElementById('pivotTable')?.remove();
                generateData()  ;
            });
            document.getElementById('xlsx').addEventListener('click', function () {
                const pivotTable = document.getElementById('pivotTable');
              //  console.log('xlsx')
                pivotTable.exportData('xlsx', 'pivotTable');
            });
        });
    </script>

    <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get"  >
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
    <div class="option">
        <smart-button id="xlsx">Export to XLSX</smart-button>
    </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 825px;">
        </div>
    <?php
    include_once ('./sale.tail.php');
    ?>
