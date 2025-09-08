    <?php
    // 절대경로(권장) 혹은 상대경로 사용 가능
    header('Location: /spaceadd/sale/bld/bldcont_qty_list.php', true, 302); // 302 Found(기본)
    exit; // 반드시 종료


    $sub_menu = "100602";
    include_once('./_common.php');

    $g5['title'] = '빌딩 재원 관리';
    include_once('./sale.head.php');

    $st_dt = isset($_REQUEST['st_dt']) ? $_REQUEST['st_dt'] : date( 'Y-m-01' ) ;
    $ed_dt = isset($_REQUEST['ed_dt']) ? $_REQUEST['ed_dt'] : date( 'Y-m-t' ) ;
    $sec_div = isset($_REQUEST['sec_div']) ? $_REQUEST['sec_div'] : "mtrl_sec" ;
    $qty_type = isset($_REQUEST['qty_type']) ? $_REQUEST['qty_type'] : "sec" ;

    ?>
    <style>
         .green {
             color: black\9;
             background-color: #b6ff00\9;
         }
         .yellow {
             color: black\9;
             background-color: yellow\9;
         }
         .red {
             color: black\9;
             background-color: #e83636\9;
         }
         .green:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .green:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
             color: black;
             background-color: #b6ff00;
         }
         .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .yellow:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
             color: black;
             background-color: yellow;
         }
         .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected) {
             color: black;
             background-color: #e83636;
         }
     </style>
    <script type="text/javascript" src="/spaceadd/sale/js/date.js"></script>
    <script type="text/javascript">
        var sec_div = "mtrl_sec";

        function generateData() {
            var str= './bld_cont_qty_list3_result.php'
            const params = formParams($("#fsearch"))   ;
            sec_div = params.sec_div ;
            fn_submission("subInvList", str, params , true, fn_getListCallback ) ;
        }
        function fn_getListCallback(sub, data){
            markGrid(data)
        }
        function markGrid(data){
            var columngroups =  [] ;
            var coloumns =[
                {
                    text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist', pinned: true,
                    cellsrenderer: cellRowNum ,
                    aggregates: ['count'] ,
                    aggregatesrenderer: aggCount ,
                },
                { text: '빌딩코드', datafield: 'bld_num', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70, pinned: true },
                { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170 , pinned: true},
                { text: '기기수', datafield: 'ins_cnt', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70, pinned: true,  cellsformat: 'n' ,
                                        aggregates: ['sum'] ,
                                        aggregatesrenderer: aggSum}
            ] ;
            var datafields = [
                { name: 'bld_seq',type: 'number'},
                { name: 'bld_num'},
                { name: 'bld_nm'},
                { name: 'ins_sec'},
                { name: 'ins_cnt',type: 'number'},
            ] ;
            const dateArray = [];
            const startDate = Date.parse(document.getElementById("st_dt").value); // 시작 날짜
            const endDate = Date.parse(document.getElementById("ed_dt").value);   // 종료 날짜
            let currentDate = startDate.clone(); // 시작 날짜를 복사
            let preDate = ""; // 시작 날짜를 복사

            const cellclass = function (row, columnfield, value) {
                var _ableCnt = 999   ;
                if (sec_div == "able_sec" ) {
                    _ableCnt = Number(value) ;
                }else if( sec_div == "all_sec" ) {
                    _ableCnt = Number(value.split('/')[1]);
                }
                if(document.querySelector('input[name=qty_type]:checked').value !== "cnt"){
                    if (_ableCnt <= 0) {
                        return 'red';
                    } else if (_ableCnt >= 10 && _ableCnt < 30) {
                        return 'yellow';
                    } else return '';
                }
             }

            while (currentDate.compareTo(endDate) <= 0) { // 종료날짜까지 반복
                dateArray.push(currentDate.toString("yyyyMMdd")); // yyyyMMdd 포맷
                var col =   {
                        text: currentDate.toString("MM/dd")
                      , datafield: "c"+currentDate.toString("yyyyMMdd")
                      , filtertype: 'checkedlist'
                      , cellsalign: 'center'
                      , align: 'center'
                      , width:  (sec_div == "all_sec") ?  80 : 60
                      , columnGroup: "G"+currentDate.toString("MM")
                      , cellsformat: 'n' ,

                }  ;
                col['cellclassname']  =  cellclass ;
                if(sec_div != "all_sec") {
                    col['aggregates']   =  [{
                                    function (aggregatedValue, currentValue, column, record) {
                                        if(Number(currentValue) > 0 ){
                                            aggregatedValue = aggregatedValue + 1   ;
                                        }
                                        return  aggregatedValue   ;
                                    }
                            }]  ;
                    col['aggregatesrenderer']   =  function (aggregates) {
                                                        var renderstring = "";
                                                        $.each(aggregates, function (key, value) {
                                                            renderstring += '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center; color:#c52323;font-weight:700">' +  value + '</div>';
                                                        });
                                                        return renderstring;
                                                    }  ;
                }
                if(preDate !="" || currentDate.toString("MM") != preDate.toString("MM")){
                    columngroups.push({ text: currentDate.toString("MM")+"월", align: 'center', name: "G"+currentDate.toString("MM") }) ;
                }

                coloumns.push(col)   ;
                datafields.push({name :"c"+currentDate.toString("yyyyMMdd"),  type :  ((sec_div =="all_sec" )?"string":"number") }) ;

                preDate = currentDate.clone();
                currentDate = currentDate.addDays(1); // 하루씩 증가
            }
            coloumns.push({ datafield: 'bld_seq', hidden: true,  })   ;

            var dataSource = [] ;
            data.forEach((el)=>{
                if(!dataSource.find((it)=>el.bld_seq === it.bld_seq)){
                    var item = { "bld_seq": el.bld_seq , "bld_nm": el.bld_nm , "bld_num": el.bld_num, "ins_sec": el.ins_sec, "ins_cnt": el.ins_cnt  } ;
                    data.filter(tt=> tt.bld_seq === el.bld_seq ).forEach((bld)=>{
                          var val= bld.mtrl_sec   ;
                          if(sec_div == "all_sec") val =  bld.mtrl_sec +"/"+bld.able_sec  ;
                          if(sec_div == "able_sec") val =  bld.able_sec    ;

                        item["c"+bld.dt] = val  ;
                    })
                    dataSource.push(item)
                }

            });

            var source =
                {
                    datatype: "json",
                    datafields: datafields,
                    localdata: dataSource,
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
                    columngroups : columngroups ,
                    columns:  coloumns
                });

            $("#grid").on("celldoubleclick", function (event)
            {
                var args = event.args;
                 var _date = args.datafield.replaceAll("c" , "")
                url = "./bld_cont_qty_pop.php?bld_seq="+args.row.bounddata['bld_seq'] +"&st_dt="+_date+"&ed_dt="+_date

                /*
                +"&st_dt="+document.getElementById("st_dt").value+"&ed_dt="+document.getElementById("ed_dt").value
                 ;
                 */
                var new_win = window.open(url, 'win_profile', 'left=100,top=100,width=1000,height=900');
                new_win.focus();
            });

        }

        window.onload = function () {
            generateData()  ;
        };

        $(function(){
            $("#st_dt, #ed_dt").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                yearRange: "c-99:c+99"  });

            $("#refresh").click(function () {
                const startDate = Date.parse(document.getElementById("st_dt").value); // 시작 날짜
                const endDate = Date.parse(document.getElementById("ed_dt").value);   // 종료 날짜
                if(startDate.addDays(60) < endDate ){
                    alert("최대 60일까지 조회 가능합니다.")
                    return false ;
                }
                generateData()  ;
            });
        });
    </script>
<?php

?>

    <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" action="./bld_cont_qty_list.php">
<!--        <label for="sfl" class="sound_only">검색대상</label>
        <select name="sfl" id="sfl">
            <option value="sch_all"<?php /*echo get_selected($sfl, "sch_all"); */?>>전체</option>
            <option value="comp_nm"<?php /*echo get_selected($sfl, "bld_nm"); */?>>빌딩명</option>
        </select>
        <label for="stx" class="sound_only">검색어</label>
        <input type="text" name="stx" value="<?php /*echo $stx */?>" id="stx" required class="required frm_input">-->


        <strong style="width:unset">기간</strong>
        <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_dt?>"></input>
        ~
        <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_dt?>"></input>

        <strong style="width:unset"> <label for="bld_pkg">패키지</label></strong>
        <?print_option_with_checkbox('bld_pkg', 'BBF', $_REQUEST['bld_pkg'], "", "", true)?>

        <strong><label for="bld_mda_type"> 매체 타입</label></strong>
        <select name="bld_mda_type" id="bld_mda_type" onChange="">
            <option value="">전체<?print_option_with_select('BBK', $_REQUEST['bld_mda_type']);?>
        </select>

        <label for="excpt_str"><strong>빌딩 비고 </strong></label>
        <select name="excpt_opt" id="excpt_opt" style="width:100px">
            <option value="Y" >제외</option>
            <option value="N" >포함</option>
          </select>
        <input type="text" name="excpt_str" value="" id="excpt_str" required class="frm_input" style="width:100px">
        <br/>
        <strong>계약 상태</strong>
        <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
            <option value="">전체</option>
            <?php print_option_with_select('BAC', '', 'BAC01',  'BACALL');?>
        </select>

        <strong style="width:unset">구분</strong>
        <label class="me-3"><input type='radio' name='sec_div' id='sec_div' value='mtrl_sec'  <?=(($sec_div =="mtrl_sec" )?"checked":"")?> >판매재원  </label>
        <label><input type='radio' name='sec_div' id='sec_div' value='able_sec'  <?=(($sec_div =="able_sec" )?"checked":"")?> >미판재원 </label>
        <label><input type='radio' name='sec_div' id='sec_div' value='all_sec'  <?=(($sec_div =="all_sec" )?"checked":"")?> > 판매/미판 </label>

        <strong style="width:unset">표시 구분</strong>
        <label class="me-3"><input type='radio' name='qty_type' id='qty_type' value='sec'  <?=(($qty_type =="sec" )?"checked":"")?> >초수  </label>
        <label ><input type='radio' name='qty_type' id='qty_type' value='cnt'  <?=(($qty_type =="cnt" )?"checked":"")?> >구좌수  </label>


        <input type="button" id="refresh" class="btn_submit" value="검색">
    </form>
    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%;height: 625px;">
        <div id="grid"  style="width: 100%; height: 100%;"></div>
        <?php
        include_once('./common/comm_grid_btns.php');
        ?>
    </div>
    <?php
    include_once ('./sale.tail.php');
    ?>