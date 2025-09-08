<?php
$sub_menu = "3001001";
include_once('../_common.php');

$g5['title'] = '월별 판매 현황(매출/매입)';
$g5['title_desc'] ='' ;
include_once('../sale.head.php');

if (empty($fr_date)) $fr_date = substr(G5_TIME_YM, 0, 5)."01";
if (empty($to_date)) $to_date = substr(G5_TIME_YM, 0, 5)."12";
if(strlen($fr_date) == 6) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $fr_date);
if(strlen($to_date) == 6) $to_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $to_date);

$sql="SELECT comm_cd, comm_cd_nm 
      FROM tb_code  
      where comm_type_cd = 'AAB' AND use_yn = 'Y' and up_comm_seq > 0    "    ;
$sql .= "  order by ord";
$commCdResult = sql_query_json($sql); //질의.
?>
<script type="text/javascript" src="/spaceadd/sale/js/date.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxdraw.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxchart.core.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxdatatable.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxdropdownlist.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        const comList = <?=$commCdResult?>  ;
        try{
            var sourceMda  =
            {
                datatype: "json",
                datafields: [
                    { name: 'comm_cd' },
                    { name: 'comm_cd_nm' }
                ],
                id: 'id',
                localdata: comList
            };
            var dataAdapterMda = new $.jqx.dataAdapter(sourceMda);
            $("#jqxWidget").jqxDropDownList({
                checkboxes: true, source: dataAdapterMda, displayMember: "comm_cd_nm", valueMember: "comm_cd"
                , width: 200
                , placeHolder : "매체선택"
                , enableHover: true
            });
        }catch (e) {
            console.log(e)
        }
        var source =
               {
                   datatype: "json",
                      datafields: [
                          { name: 'yyyymm', type: 'string' },
                          { name: 'sellAmt', type: 'int' },
                          { name: 'totAmt', type: 'int' },

                      ],
                      id: 'id',
                   localdata: [],
               };
           var dataAdapter = new $.jqx.dataAdapter(source );
            // prepare jqxChart settings
            var settings = {
                title: "",
                description: "",
                showLegend: true,
                enableAnimations: true,
                padding: { left: 5, top: 10, right: 5, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter ,
                xAxis:
                    {
                        dataField: 'yyyymm',
                        displayText: '년월' ,
                        gridLines: { visible: true , interval: 1 },
                        tickMarks: { visible: true, interval: 1 },
                        valuesOnTicks: true ,
                        labels: {
                             formatFunction: function (value) {
                                 return (value+"").replace( /^(\d{4})(\d{2})$/ , `$1-$2` )  ;
                             }
                         },
                         toolTipFormatFunction: function (value) {
                             return  (value+"").replace( /^(\d{4})(\d{2})$/ , `$1-$2` )  ;
                         },
                    },
                colorScheme: 'scheme01',
                columnSeriesOverlap: false,
                seriesGroups:
                    [
                        {
                            type: 'column',
                            valueAxis:
                            {
                                visible: true,
                                title: { text: '월금액(천원)' } ,
                                formatFunction: function (value) {
                                    return   ((value).toFixed(0)).replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")
                                }
                            },
                            toolTipFormatFunction: function (value, itemIndex, serie, group, categoryValue, categoryAxis) {
                                return  categoryAxis.displayText + " : "+ (categoryValue+"").replace( /^(\d{4})(\d{2})$/ , `$1-$2` )  +"<br/>"
                                        +serie.displayText + " : "+   ((value).toFixed(0)).replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")  ;
                            },
                            series: [
                                    {    dataField: 'sellAmt'   ,displayText: '월금액'    }
                                ]
                        },
                        {
                            type: 'line',
                            valueAxis:
                            {
                                visible: true,
                                position: 'right',
                                title: { text: '누적금액(천원)' },
                                gridLines: { visible: true },
                                labels: {
                                    horizontalAlignment: 'left'
                                } ,
                                formatFunction: function (value) {
                                    return  ((value).toFixed(0)).replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")
                                }
                            },
                            series: [
                                    { dataField: 'totAmt', symbolType: 'square', displayText: '누적금액' ,
                                        formatFunction: function (value, itemIndex) {
                                            return   ((value).toFixed(0)).replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")
                                        } ,
                                        labels:
                                          {
                                              visible: true,
                                              backgroundColor: '#FEFEFE',
                                              backgroundOpacity: 0.2,
                                              borderColor: '#7FC4EF',
                                              borderOpacity: 0.7,
                                              padding: { left: 5, right: 5, top: 0, bottom: 0 }
                                          }
                                    }

                                ]
                        }
                    ]
            };

         const pieChartList = [
            {chartId:"chartCli", chartTlt :"광고주" , db_col : "cli_seq" , db_tlt : "cli_nm" },
            {chartId:"chartMda", chartTlt: "매체" , db_col : "mda_type_code" , db_tlt : "mda_nm"} ,
            {chartId:"chartCont", chartTlt: "계약구분" , db_col : "cont_type_code" , db_tlt : "cont_type_code_nm"} ,
        ]
        pieChartList.forEach((el, idx )=>{
            const  settings = {
                 title:  el.chartTlt ,
                 description: "",
                 enableAnimations: true,
                 showLegend: true,
                 showBorderLine: true,
                 padding: { left: 5, top: 5, right: 5, bottom: 5 },
                 titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
                 source: [],
                 colorScheme: 'scheme0'+(idx +1),
                 seriesGroups:
                     [{
                         type: 'pie',
                         showLabels: true,
                         series:
                             [
                                 {
                                     dataField: 'per',
                                     displayText: 'tlt',
                                     labelRadius: 155,
                                     initialAngle: 0,
                                     radius: 145,
                                     centerOffset: 0,
                                     formatFunction: function (value,  itemIndex   ) {
                                         if (isNaN(value))  return value;

                                         const records = $('#'+el.chartId).jqxChart('getInstance')?.source
                                         return  records[itemIndex].tlt +":"+value+"%" ;
                                     },
                                 }
                             ],
                         toolTipFormatFunction: function (value, itemIndex ) {
                             const records = $('#'+el.chartId).jqxChart('getInstance')?.source
                             const _val =    records[itemIndex]  ;
                             return _val.tlt +":"+value+"%" +"<br/>금액 :" + ((_val.amt).toFixed(0)).replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",")   ;
                         },
                     }]
             };
            $('#'+el.chartId).jqxChart( settings);
        })
        fn_search() ;

        //검색
        function fn_search(){
            let params = formParams($("#fsearch"))  ;
            params.mda_type_code = $("#jqxWidget").jqxDropDownList('getCheckedItems').map((el)=> el.value)   ;

            console.log("params" , params )

            fn_submission("subList", "./report/report_chart_ym_result.php", params, true, fn_subCallback   );
        }
        function fn_subCallback(subid, voJson){
            try{
                var list  = JSON.parse(voJson).map(el=> { return { ...el, amt : (Number(el.amtTot)/1000).toFixed(0)  }})  ;
                const amtSum = list.reduce((acc, cur) => acc + Number(cur.amt), 0) ;

                //월별 판매현황
                const months = [];
                const startDate = Date.parseExact((document.getElementById("fr_date").value).replaceAll("-" , "")+"01"  , 'yyyyMMdd');
                const endDate = Date.parseExact((document.getElementById("to_date").value).replaceAll("-" , "")+"01"  , 'yyyyMMdd');
                let currentDate = startDate;
                while (currentDate <= endDate) {
                    months.push({
                       yyyymm :  currentDate.toString('yyyyMM')
                     , sellAmt : list.filter(el => el.yearmon ===  currentDate.toString('yyyyMM') ).reduce((acc, cur) => acc +Number(cur.amt), 0)
                     , totAmt : list.filter(el => Number(el.yearmon) <= Number(currentDate.toString('yyyyMM')) ).reduce((acc, cur) => acc +Number(cur.amt), 0)
                    });
                    currentDate = currentDate.add(1).month();
                }
                source.localdata = months ;
                dataAdapter.dataBind();
                $('#chartContainer').jqxChart(settings);

                pieChartList.forEach(( pi)=>{
                    const datas =  Object.entries( list?.reduce(( acc , cur ) => {
                                                return {
                                                    ...acc ,
                                                    [cur[pi.db_col]] : acc[cur[pi.db_col]]
                                                        ? { tlt : cur[pi.db_tlt], code : cur[pi.db_col], amt :  acc[cur[pi.db_col]].amt + Number(cur.amt || 0) , cnt : acc[cur[pi.db_col]].cnt + 1 }
                                                        : { tlt : cur[pi.db_tlt], code : cur[pi.db_col], amt : Number(cur.amt)  , cnt : 1 } ,
                                                };
                                            },[])).map(( [key , value] ) => {return {  ...value , per : (value.amt/amtSum*100).toFixed(2) }})
                                                  .sort((a, b) => (a.amt > b.amt) ? -1: 0 )
                                                  .filter((el, index) => el.amt > 0 && index < 10)  ;

                    $('#'+pi.chartId).jqxChart('getInstance').source  = datas  ;
                    $('#'+pi.chartId).jqxChart('update');
                }) ;
            }catch (e) {
                console.log("[fn_subCallback]" , e) ;
            }
        }
        $("#refresh").click(function () {
                fn_search() ;
        });
    });
    $(function(){
        $("#fr_date, #to_date" ).datepicker( $.datepicker.yearmon) ;
        $("#fr_date, #to_date").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });
    });
</script>
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" style="display: flex; align-items: center;">
    <strong>계약월 기간</strong>
    <input  id="fr_date" name="fr_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$to_date?>"></input>
    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '', '',  'BACALL');?>
    </select>
    <strong>판매방식</strong>
    <select name="cont_sale_type" id="cont_sale_type" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAK', '', '',  '');?>
    </select>
    <strong style="width:unset"> <label for="mda_type_code">매체</label></strong>
    <div id='jqxWidget'>
    </div>


<!--    <strong>구분</strong>
    <select name="inout_type" id="inout_type" onChange="" style="width: 150px" >
        <option value="ABD01">매출</option>
        <option value="ABD02">매입</option>
        <option value="ABD03">매출 수익</option>
    </select>-->
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>
    <div class="" style="width: 100%; margin-bottom: 10px;">
        <p ><b>월별금액</b></p>
        <div id="main_month" class="" style="width: 100%;">
            <div id='chartContainer' style="width:100%; height:500px; padding:10px;">
            </div>
        </div>
        <div id="main" class="" style="width: 100%;  display: flex ; padding:10px; ">
            <div style="min-width:500px;padding:5px;">
                <div id='chartCli' style="width:100%; min-height:500px;"></div>
                <!--<div id="tableCli" style="width:100%; "></div>-->
            </div>
            <div style="min-width:500px;padding:5px;">
                <div id='chartMda' style="width:100%; min-height:500px;"></div>
            </div>
            <div style="min-width:500px;padding:5px;">
                <div id='chartCont' style="width:100%; min-height:500px;"></div>
            </div>
        </div>
    </div>
<?php
include_once ('../sale.tail.php');
?>
