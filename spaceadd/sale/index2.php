<?php
$sub_menu = "900110";

include_once('./_common.php');
include_once('./sale.head.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

$sql=" SELECT   
  a.comp_seq, a.comp_nm    
, count(distinct e.asg_seq ) cont_asg_cnt 
FROM
    tb_comp  a
    inner join  tb_comp_mda b  on  a.comp_seq = b.comp_seq and ifnull(b.del_yn, 'N')  ='N' 
    inner join  tb_mda_assign c  on   b.prod_seq = c.prod_seq  and ifnull(c.use_yn, 'Y')  ='Y'  
    inner join  vi_media d   on  b.mda_seq = d.mda_seq 
    left outer join  tb_cont_mda_assign e  on  c.asg_seq = e.asg_seq   
                                             and exists ( select '1' 
                                                          from tb_date x 
                                                          where   x.dt between e.st_dt and e.ed_dt and x.dt like date_format(now() , '%Y%m%'))  
where ifnull(a.del_yn, 'N')  = 'N'  
   and b.use_yn  ='Y'
    and c.use_yn  ='Y'
   and a.comp_type ='AAC02'
   and a.deal_sts_code ='BAA01'  
 group by a.comp_seq, a.comp_nm  
 order by   a.comp_nm, b.mda_seq , c.ord  
 ;" ;
$result = sql_query_json($sql);
?>

<style>
    #container    {
        padding-left: 50px;
    }
    #container_title   {
         padding-left: 70px;
     }

    .lat_title{
        background-color: rgba(43, 43, 43, 0.03);
        padding: 0px 100px 0px 15px;
        border-bottom: 1px solid rgba(43, 43, 43, 0.125);
        line-height: 40px !important;
    }
    .lt_more {
        padding-right:15px;
        width:80px !important ;
    }
    .lat, .lat ul , .lat li {
        padding : 0px !important;
        margin-bottom:0px !important ;
    }

</style>
<?php
include_once(G5_PATH.'/head.sub.smart.php');
?>
<link rel="stylesheet" href="/htmlelements/admin-template/assets/css/main.css" type="text/css" />
<div class="container">
    <div class="row">
        <div class="col-lg-4 mb-5">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="label">매체사 판매구좌</h4>
                </div>
                <div class="card-body p-0">
                    <smart-chart id="chart" style="width:100%; height:300px"></smart-chart>
                </div>
            </div>

        </div>
        <div class="col-lg-8 mb-5">
            <div class="latest_wr">
                <div style="" class="lt_wr">
                <?php
                echo latest('basic', 'free', 5, 50);
                ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-5">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="label">Calendar</h4>
                    <div class="settings-button">…</div>
                </div>
                <div class="card-body p-0">
                    <smart-calendar id="calendar" class="w-100 border-0"></smart-calendar>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-5">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="label">Weekly sales</h4>
                    <div class="settings-button">…</div>
                </div>
                <div class="card-body">
                    <div id="weeklySalesChart" class="combo-chart h-auto w-100"></div>
                    <div id="weeklySalesTable" class="span-table no-border h-auto"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-5">
            <div class="card h-100">
                <div class="card-header">
                    <h4 class="label">Appointments</h4>
                    <div class="settings-button">…</div>
                </div>
                <div class="card-body maxh-350 p-0">
                    <div id="appointmentContainer" class="h-100">
                        <div class="appointment">
                            <div class="label"><strong>Contact Sales</strong><span>14:00</span></div>
                            <p class="">Proin sagittis nisl diam, in pretium velit congue et.</p>
                        </div>
                        <div class="appointment">
                            <div class="label"><strong>Meet with new client</strong><span>15:20</span></div>
                            <p class="">Donec sodales, tellus at facilisis commodo, lectus lectus pharetra neque, at
                                condimentum augue diam vitae massa.
                            </p>
                        </div>
                        <div class="appointment">
                            <div class="label"><strong>Dinner with manager</strong><span>19:00</span></div>
                            <p class="">Aenean facilisis mi ac vestibulum vestibulum.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="module">
    const asg_source =  <?php echo $result ;?>;
    Smart('#chart', class {
        get properties() {
            return {
                caption: '',
                description: '',
                showLegend: true,
                showBorderLine: false,
                legendPosition: { left: 0, top: 120, width: 100, height: 100 },
                padding: { left: 0, top: 0, right: 0, bottom: 0 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 0 },
                dataSource: asg_source,
                colorScheme: 'scheme03',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                            series:
                                [
                                    {
                                        dataField: 'cont_asg_cnt',
                                        displayText: 'comp_nm',
                                        labelRadius: 110,
                                        initialAngle: 15,
                                        radius: 90,
                                        centerOffset: 0,
                                        formatFunction: function (value) {
                                            if (isNaN(value))
                                                return value;
                                            return parseFloat(value)  ;
                                        },
                                    }
                                ]
                        }
                    ]
            };
        }
    });
</script>
<?php
include_once ('./sale.tail.php');
?>
