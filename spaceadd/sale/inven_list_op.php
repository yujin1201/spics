<?php
$sub_menu = "400400";
include_once('./_common.php');

$g5['title'] = 'DS 운행 현황';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : '';
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : '';
if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $fr_date) ) $fr_date = G5_TIME_YM;
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])$/", $to_date) ) $to_date = G5_TIME_YM;

?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.38/vfs_fonts.js"></script>
    <script >
        var ganttChart ;

        function fn_getInvList(){
            ganttChart.dataSource = null ;
            var p_url="/spaceadd/sale/inven_list_op_result.php"  ;
            fn_submission("subInvList", p_url, formParams($("#fsearch")) , true, fn_getInvListCallback) ;
        }

        function fn_getInvListCallback(sub, data){
            var complist = JSON.parse( data.compList)  ;
            var mdalist = JSON.parse( data.mdaList)  ;
            var asgList = JSON.parse( data.asgList)  ;

            if( !Array.isArray(complist) ) complist = [complist] ;
            if( !Array.isArray(mdalist) ) mdalist = [mdalist] ;
            if( !Array.isArray(asgList) ) asgList = [asgList] ;

            if(complist.length == 0 ){
                alert("재원이 등록되지 않았습니다 ")
                return false ;
            }

            asgList.map(function(obj) {
                obj['disableDrag'] = true ;
                obj['disableResize'] = true ;
                obj['dragProject'] = false ;
                obj['expanded'] = false ;
                obj['type'] = 'task' ;
                return obj ;
            })  ;

            mdalist.map(function(obj) {
                obj['disableDrag'] = true ;
                obj['disableResize'] = true ;
                obj['dragProject'] = false ;
                obj['type'] = 'project' ;
                obj['expanded'] = false ;
                obj['class'] = 'non' ;
                obj['tasks']  = asgList.filter((itm , index) => (itm.prod_seq == obj.prod_seq))
                return obj ;
            })  ;

            complist.map(function(obj) {
                obj['disableDrag'] = true ;
                obj['disableResize'] = true ;
                obj['dragProject'] = false ;
                obj['type'] = 'project' ;
                obj['expanded'] = true ;
                obj['class'] = 'non' ;
                obj['tasks']  = mdalist.filter((itm , index) => (itm.comp_seq == obj.comp_seq))
                return obj ;
            })  ;
            ganttChart.dataSource =  complist ;
        }

        $(document).ready(function () {
            $("#refresh").click(function () {
                fn_getInvList() ;
            });
        }) ;
    </script>
<?php
include_once(G5_PATH.'/head.sub.smart.php');
?>
</head>
<body class="viewport">
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>매체사</strong>
    <? print_comp_search('AAC02', '893', 'spaceAdd' , '', "Y", "N") ?>
    <strong>계약명</strong>
    <input type="text" name="sch_name" value="<?php echo $sch_name ?>" id="sch_name" required class="frm_input">

    <strong>기간</strong>
    <input  id="fr_date" name="fr_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$to_date?>"></input>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

<div class="">
    <div class="btn_list03">
       <button  class="btn_color02" id="exportToXLSX"  style="">엑셀저장</button>
    </div>
</div>
<div id="main_grid" class="tbl_wrap" style="width: 100%; height: 590px; margin-bottom:30px">
    <smart-gantt-chart id="ganttchart"  disable-window-editor auto-scroll-step="5"></smart-gantt-chart>
</div>
<script type="module">

    const today = new Date(),
        year = today.getFullYear(),
        month = today.getMonth(),
        date = today.getDate();

    Smart('#ganttchart', class {
        get properties() {
            return {
                treeSize: '650px',
                durationUnit: 'day',
                view: 'week',
                shadeUntilCurrentTime: true,
                currentTimeIndicator: true,
                currentTimeIndicatorInterval: 60, //measured in seconds
                dateStart: new Date(year, month, date - 3),
                dateEnd: new Date(year, month, date + 9),
                monthFormat : 'short' ,
                resourceTimelineMode: 'histogram',
                timelineHeaderFormatFunction: function (date, type, isHeaderDetailsContainer) {
                    if (isHeaderDetailsContainer) {
                         return date.toLocaleDateString('ko-KR', { year: 'numeric', month: 'long'  });
                    }
                    else {
                        return date.toLocaleDateString('de-DE', { day: 'numeric' });
                    }
                },
                taskColumns: [
                    {
                        label: '매체사',
                        value: 'mda_comp_nm',
                        size: '250px'

                    },
                    {
                        label: '상품명',
                        value: 'mda_nm',
                        size: '150px'
                    },
                    {
                        label: '구좌',
                        value: 'asg_num',
                        size: '50px'
                    },
                    {
                        label: '기간<br/>(days)',
                        value: 'duration',
                        size: '50px',
                        disableTaskDrag :true
                    },
                    {
                        label: '광고주',
                        value: 'cli_nm',
                        size: '150x',
                    },
                    {
                        label: '시작일',
                        value: 'st_dt',
                        size: '150x',
                        formatFunction: function (param1) {
                            if(param1 =="Unassigned"){
                                return "" ;
                            }
                        }
                    },
                    {
                        label: '종료일',
                        value: 'ed_dt',
                        size: '150x',
                        formatFunction: function (param1) {
                            if(param1 =="Unassigned"){
                                return "" ;
                            }
                        }
                    },
                    {
                        label: 'Tasks',
                        value: 'label',
                    }
                ],
                dataSource: [
                ]
            }
        }
    });

    window.onload = function () {
        ganttChart = document.querySelector('smart-gantt-chart');
        ganttChart.columnResize = true ;
        fn_getInvList()
        document.getElementById('exportToXLSX').addEventListener('click', function (event) {
            ganttChart.exportData('xlsx' ,'매체 운행 현황');
        });
    };
    $(function(){
        $("#fr_date, #to_date" ).datepicker( $.datepicker.yearmon) ;
        $("#fr_date, #to_date").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });
    });
</script>
<?php
include_once ('./sale.tail.php');
?>
