<?php
$sub_menu = "400330";
include_once('./_common.php');

$g5['title'] = '패키지 운행 현황';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : date("Y-m-d", strtotime(  "-1 months") ) ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] :  date("Y-m-d", strtotime(  "+3 months") ) ;
if(strlen($fr_date) == 8) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $fr_date);
if(strlen($to_date) == 8) $to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $to_date);

?>
<?php
include_once(G5_PATH.'/head.sub.smart.php');
?>
<style type="text/css">
   .prod1 , .prod2, .prod3 , .prod4 {color:#ffffff !important;}
   .prod1 .smart-timeline-task-fill { background-color: #845EC2!important;}
   .prod2 .smart-timeline-task-fill { background-color: #D65DB1!important; }
   .prod3 .smart-timeline-task-fill { background-color: #FF6F91!important; }
   .prod4 .smart-timeline-task-fill { background-color: #FF9671!important; }
   .prod5 .smart-timeline-task-fill { background-color: #FFC75F!important; }
   .prod6 .smart-timeline-task-fill { background-color: #F9F871 !important; }
</style>
<script >
    var ganttChart ;
    function fn_getInvList(){
        ganttChart.dataSource = null ;
        var p_url="inven_list_opsa_result.php"  ;
        fn_submission("subInvList", p_url, formParams($("#fsearch")) , true, fn_getInvListCallback) ;
    }


    var segListAll ;
    function fn_getInvListCallback(sub, data){
        //전체목록
        segListAll = JSON.parse( data.segList)  ;
        var mdaList =   JSON.parse(JSON.stringify(segListAll));
        var proList =   JSON.parse(JSON.stringify(segListAll));
        var asgList =   JSON.parse(JSON.stringify(segListAll));
        var mdaNum = 0 ;
        for(var i=0; i < proList.length ; i++){
            var _chk =  asgList.filter((item2 ) => (item2.asg_seq == proList[i].asg_seq && item2.comp_rank >  Number(proList[i].comp_rank))).length  ;
            if(proList[i].mda_rank == 1 ){
                mdaNum = mdaNum + 1 ;
            }
            proList[i].class = "prod" + mdaNum ;
            proList[i].mda_comp_nm = proList[i].cli_nm ;
            proList[i].mda_comp_nm = proList[i].cli_nm ;
            proList[i].mda_nm = proList[i].st_dt +"~" +proList[i].ed_dt;
             /*
            proList[i].resources =  { id: proList[i].prod_seq , label: proList[i].mda_nm , type:  proList[i].mda_nm  }  ;
              */
            if(_chk >  0 ){
                proList[i].connections =  [{ target: Number(proList[i].comp_rank) +mdaNum +1 , type:1 }]   ;
            }
        }
        try{

            var gList = mdaList.filter( ( item ) =>  item["mda_rank"] == "1"  )
                .map(function(obj) {
                    obj['disableDrag'] = true ;
                    obj['disableResize'] = true ;
                    obj['dragProject'] = false ;
                    obj['synchronized'] = true ;
                    obj['type'] = 'project' ;
                    obj['expanded'] = true ;
                    obj['class'] = 'non' ;
                    obj['cli_nm'] = '' ;
                    obj['asg_num'] = '' ;
                    obj['label'] = '' ;
                    obj['cont_nm'] = '' ;
                    obj['tasks']  = proList.filter((item1 ) => (item1.prod_seq == obj.prod_seq    ))
                        .map(function(obj1) {
                            obj1['disableDrag'] = true ;
                            obj1['disableResize'] = true ;
                            obj1['dragProject'] = false ;
                            obj1['expanded'] = true ;
                            obj1['type'] = 'task'   ;
                            return obj1 ;
                        })  ;
                    return obj ;
                })  ;
            ganttChart.dataSource =  gList ;
        }catch (e) {
            console.log(e)
        }
    }

    $(document).ready(function () {
        $("#refresh").click(function () {
            fn_getInvList() ;
        });
    }) ;
</script>
</head>
<body class="viewport">
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>매체사</strong>
    <? print_comp_search('AAC02', '893', 'spaceAdd' , '', "Y", "N") ?>
    <strong>계약명</strong>
    <input type="text" name="sch_name" value="<?php echo $sch_name ?>" id="sch_name" required class="frm_input">


    <strong>기간</strong>
    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>
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
                treeSize: '600px',
                durationUnit: 'day',
                view: 'week',
                shadeUntilCurrentTime: true,
                currentTimeIndicator: true,
                currentTimeIndicatorInterval: 60, //measured in seconds
                dateStart: new Date(year, month, date - 3),
                dateEnd: new Date(year, month, date + 9),
                monthFormat : 'short' ,
                resourceTimelineMode: 'diagram',
                resourceTimelineView : 'tasks' ,
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
                        label: '매체사<br/>(광고주)',
                        value: 'mda_comp_nm',
                        size: '250px'

                    },
                    {
                        label: '상품명<br/>(기간)',
                        value: 'mda_nm',
                        size: '250px'
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
                    /*
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
                    */
                    {
                        label: 'Tasks',
                        value: 'label',
                    }
                ],
                dataSource: [
                ],
                resourceColumns: [
                    {
                        label: '패키지명',
                        value: 'label'
                    }
                ],
            }
        }
    });

    window.onload = function () {
        ganttChart = document.querySelector('smart-gantt-chart');
        ganttChart.columnResize = true ;
        ganttChart.resourceTimelineView = 'tasks';
        fn_getInvList()
        document.getElementById('exportToXLSX').addEventListener('click', function (event) {
            ganttChart.exportData('xlsx' ,'패키지 운행 현황');
        });
    };
    $(function(){
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

    });
</script>
<?php
include_once ('./sale.tail.php');
?>
