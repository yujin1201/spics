<?php
$sub_menu = "200130";
include_once('./_common.php');

$g5['title'] = '계약상품 운행';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : G5_TIME_YMD ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] :  date("Y-m-d", strtotime(  "+1 months") ) ;
if(strlen($fr_date) == 8) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $fr_date);
if(strlen($to_date) == 8) $to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $to_date);

?>
    <style>
        #container_title {z-index:499 !important;}
    </style>

    <!--수정-->
    <script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxdate.js"></script>
    <script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxscheduler.js"></script>
    <script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxscheduler.api.js"></script>
    <script type="text/javascript" src="<?php echo $g5_jqx_url?>/jqxtooltip.js"></script>
<script type="text/javascript">

    var source    ;

    $(document).ready(function () {
        source =
            {
                datatype: "json",
                datafields: [
                    { name: 'id', type: 'subject' },
                    { name: 'subject', type: 'subject' },
                    { name : 'cont_mda_seq' , type: 'number'},
                    { name : 'cont_seq' , type: 'number'},
                    { name : 'mda_seq' , type: 'number'},
                    { name : 'account_cnt' , type: 'number'},
                    { name : 'equip_cnt' , type: 'number'},
                    { name : 'guarant_pos' , type: 'string'},
                    { name : 'multi_yn' , type: 'string'},
                    { name : 'st_dt' , type: 'string'},
                    { name : 'ed_dt' , type: 'string'},
                    { name : 'act_st_time' , type: 'string'},
                    { name : 'act_ed_time' , type: 'string'},
                    { name: 'stdttm', type: 'date', format: "yyyy-MM-dd HH:mm" },
                    { name: 'eddttm', type: 'date', format: "yyyy-MM-dd HH:mm" },
                    {name: 'report_yn' , type: 'string'},
                    {name: 'report_opt' , type: 'string'},
                    {name: 'toss_dt' , type: 'string'},
                    {name: 'mg_report_yn' , type: 'string'},
                    {name: 'mg_report' , type: 'string'},
                    { name : 'bigo' , type: 'string'},
                    { name : 'entr_prsn' , type: 'string'},
                    { name : 'entr_prsn_nm' , type: 'string'},
                    { name : 'entr_dt' , type: 'string'},
                    { name : 'updt_prsn' , type: 'string'},
                    { name : 'mda_nm' , type: 'string'},
                    { name : 'report_opt_nm' , type: 'string'},
                    { name : 'mtrl_nm' , type: 'string'},
                    { name : 'opdt_yn' , type: 'string'},
                    { name : 'cont_nm' , type: 'string'},
                    { name : 'cont_type_code' , type: 'string'},
                    { name : 'mda_type' , type: 'string'},
                    { name : 'cont_yearmon' , type: 'string'},
                    { name : 'cont_stat' , type: 'string'},
                    { name : 'cont_stat_nm' , type: 'string'},
                    { name : 'cli_seq' , type: 'number'},
                    { name : 'cli_nm' , type: 'string'},
                    { name : 'agncy_seq' , type: 'number'},
                    { name : 'agncy_nm' , type: 'string'},
                    { name : 'rep_seq' , type: 'number'},
                    { name : 'rep_nm' , type: 'string'},
                    { name : 'sale_prsn' , type: 'string'},
                    { name : 'sale_prsn_nm' , type: 'string'},
                    { name : 'cont_st_dt' , type: 'string'  },
                    { name : 'cont_ed_dt' , type: 'string' },
                    { name : 'cont_amt', type: 'number' },
                    { name : 'tot_sell_amt' , type: 'number' },
                    { name : 'op_yn' , type: 'string'},
                    { name : 'bns_yn' , type: 'string'},
                    { name : 'mda_comp_nm' , type: 'string'},
                ],
                id: 'id',
                url: g_sale_url+'/cont_mda_list01_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };

        makeScheduler() ;

        $("#refresh").click(function () {
            makeScheduler()   ;
        });


        $("#scheduler").on('appointmentClick', function (event) {
            var args = event.args;
            var appointment = args.appointment;
            window.open("./cont_form.php?cont_seq="+appointment.cont_seq, "_blank") ;
        });

        $('#scheduler').on('bindingComplete', function (event) {
            try{
                $("#gridCount").text("총 " +( $('#scheduler').jqxScheduler('getDataAppointments').length+"").replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,')+"개")  ;
            } catch (e) {
                console.log(e)
            }
        });

    });

    $(function(){
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });
    });


    function makeScheduler(){
        var fdate = $("#fr_date").val().replaceAll("-","") ;
        var yyy = parseInt(fdate.substring(0,4)   )    ;
        var mm = parseInt(fdate.substring(4,6)   )    ;
        var ddd = parseInt(fdate.substring(6,8)   )    ;
        source.data = formParams($("#fsearch"))  ;

        var adapter = new $.jqx.dataAdapter(source);
        $("#scheduler").jqxScheduler({
            date: new $.jqx.date(yyy,mm,ddd )    ,
            width:1500,
            height: 3000,
            source: adapter,
            showLegend: true,
            ready: function () {
            },
            localization: {
                firstDay: 1,
                days: {
                    names: ["일", "월", "화", "수", "목", "금", "토"],
                },
                months: {
                    names:  ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월", ""],
                    namesAbbr: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월", ""],
                },
            } ,
            resources:
                {
                    colorScheme: "scheme05",
                    dataField: "mda_nm",
                    source:  new $.jqx.dataAdapter(source)
                },
            appointmentDataFields:
                {
                    from: "stdttm",
                    to: "eddttm",
                    id: "id",
                    description: "cont_nm",
                    location: "mda_seq",
                    subject: "subject",
                    resourceId: "mda_nm",
                    cont_seq : "cont_seq",
                },
            view: 'monthView',
            views:[ { type: 'monthView' }, 'agendaView' ] ,
        });
    }
</script>
    <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
        <strong>매체사</strong>
        <? print_comp_search('AAC02', $_REQUEST['comp_seq'], $_REQUEST['comp_nm'] ,'', "Y", "N") ?>
        <strong>운행일</strong>
        <input  id="fr_date" name="fr_date"    maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
        ~
        <input  id="to_date" name="to_date"    maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>
        <strong>계약 상태</strong>
        <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
            <option value="">전체</option>
            <?php print_option_with_select('BAC', '', 'BAC01',  'BACALL');?>
        </select>
        <button type="button"  id="refresh" class="btn_submit">검색</button>
    </form>
    <div id="gridCount"></div>

    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 3000px;">
        <div id="scheduler"></div>
    </div>
<?php
include_once ('./sale.tail.php');
?>