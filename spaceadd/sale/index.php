<?php
//$sub_menu = "900110";

include_once('./_common.php');
include_once('./sale.head.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

$date_1 = date('Y-m');
$date_1_last_day = date("Y-m-d", mktime(0, 0, 0, intval(date('m'))+1, 0, intval(date('Y')) ));
$date_2 = date('Y-m',strtotime('+1 month'));
$date_2_last_day = date("Y-m-d", mktime(0, 0, 0, intval(date('m'))+2, 0, intval(date('Y')) ));
$date_3 = date('Y-m',strtotime('+2 month'));
$date_3_last_day = date("Y-m-d", mktime(0, 0, 0, intval(date('m'))+3, 0, intval(date('Y')) ));

?>

<style>
    #container    {
        padding-left: 50px;
        margin-top: 50px;
    }
    #container_title   {
        padding-left: 70px;
        display: none ;
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
<link rel="stylesheet" href="/htmlelements/admin-template/assets/css/main.css" type="text/css" />
<div class="" style="width: 100%; margin: auto;">
    <div class="row">
        <div class="col-lg-6 mb-5">
            <div class="card h-100">
                <div class="lat" style="height: 500px">
                    <h2 class="lat_title"><a href="inven_list_ds.php"><b>디지털사이니지 구좌 현황</b></a></h2>

                    <div id="grid1"  style="width: 100%; height: 500px;">
                    </div>
                    <a href="inven_list_ds.php" target="_blank" class="lt_more"> 더보기</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            <div class="card h-100">
                <div class="lat" style="height: 500px">
                    <h2 class="lat_title"><a href="inven_list_mda.php"><b>인쇄매체 구좌 현황</b></a></h2>
                    <div id="grid2"  style="width: 100%; height: 500px;">
                    </div>
                    <a href="inven_list_mda.php" target="_blank" class="lt_more"> 더보기</a>
                </div>

            </div>

        </div>
    </div>
    <div class="row" style="margin-top: 40px">
        <div class="col-lg-6 mb-5">
            <div class="card h-100">
                <div style="" class="lt_wr">
                    <?php
                    echo latest('basic', 'qa', 10, 50);
                    ?>
                </div>
            </div>

        </div>
        <div class="col-lg-6 mb-5">
            <div class="latest_wr">
                <div style="" class="lt_wr">
                    <?php
                    echo latest('basic', 'free', 10, 50);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module">

    $(document).ready(function () {

        $("#grid1").jqxGrid('clear');


        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_nm'},
                    { name: 'comp_seq'},
                    { name: 'comp_type_nm'},
                    { name: 'mda_cnt_1'},
                    { name: 'mda_cnt_2'},
                    { name: 'mda_cnt_3'},
                    { name: 'account_cnt_1'},
                    { name: 'account_cnt_2'},
                    { name: 'account_cnt_3'},
                    { name: 'mi_cnt_1'},
                    { name: 'mi_cnt_2'},
                    { name: 'mi_cnt_3'}

                ],
                url: g_sale_url+'/index_result.php',
                cache: false,
                data:{
                    mda_div:'AAA02'
                }
            };


        var adapter = new $.jqx.dataAdapter(source);

        $("#grid1").jqxGrid(
            {
                //width: getWidth('grid'),
                width: '100%',
                height: '100%',
                //autorowheight: true,
                //autoheight: true,
                source: adapter,
                //theme: "dark",
                columnsresize: true,
                filterable: false,
                sortable: false,
                ready: function () {

                },
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum
                    },
                    { text: '매체', datafield: 'comp_nm', filtertype: 'checkedlist',  align: 'center'  ,width:135},
                    { text: '전체구좌', columngroup: 'yearmon_1', datafield: 'mda_cnt_1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매구좌', columngroup: 'yearmon_1', datafield: 'account_cnt_1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '잔여구좌', columngroup: 'yearmon_1', datafield: 'mi_cnt_1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '전체구좌', columngroup: 'yearmon_2', datafield: 'mda_cnt_2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매구좌', columngroup: 'yearmon_2', datafield: 'account_cnt_2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '잔여구좌', columngroup: 'yearmon_2', datafield: 'mi_cnt_2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '전체구좌', columngroup: 'yearmon_3', datafield: 'mda_cnt_3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매구좌', columngroup: 'yearmon_3', datafield: 'account_cnt_3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '잔여구좌', columngroup: 'yearmon_3', datafield: 'mi_cnt_3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { datafield: 'comp_seq', hidden: true },

                ],
                columngroups: [
                    { text: '<?=$date_1?>', align: 'center', name: 'yearmon_1' },
                    { text: '<?=$date_2?>', align: 'center', name: 'yearmon_2' },
                    { text: '<?=$date_3?>', align: 'center', name: 'yearmon_3' }
                ]
            });

        $('#grid1').on('celldoubleclick', function (event) { //rowdoubleclick
            var getRowData = $('#grid1').jqxGrid('getboundrows')[event.args.rowindex];
            if(event.args.datafield == "account_cnt_1"){ //당월
                if(event.args.value !=0){
                    //alert(event.args.value);
                    var url ="inven_list_ds.php?comp_seq="+getRowData['comp_seq']+"&comp_nm="+getRowData['comp_nm']
                        +"&fr_date=<?=$date_1?>-01&to_date=<?=$date_1_last_day?>"
                    basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
                }
            }else if(event.args.datafield == "account_cnt_2"){//당월 +1
                if(event.args.value !=0){
                    var url ="inven_list_ds.php?comp_seq="+getRowData['comp_seq']+"&comp_nm="+getRowData['comp_nm']
                        +"&fr_date=<?=$date_2?>-01&to_date=<?=$date_2_last_day?>"
                    //+ "&fr_date="+$("#fr_date").val().substring(0,7)+"&to_date="+$("#to_date").val().substring(0,7)  ;
                    basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
                }
            }else if(event.args.datafield == "account_cnt_3") {//대형베너
                if(event.args.value !=0){
                    var url ="inven_list_ds.php?comp_seq="+getRowData['comp_seq']+"&comp_nm="+getRowData['comp_nm']
                        +"&fr_date=<?=$date_3?>-01&to_date=<?=$date_3_last_day?>"
                    //+ "&fr_date="+$("#fr_date").val().substring(0,7)+"&to_date="+$("#to_date").val().substring(0,7)  ;
                    basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
                }
            }

            //var column = $("#grid2").jqxGrid('getcolumn', event.args.datafield);
            //alert(getRowData['comp_nm']);
            //alert(column);
            //console.log(event.args);
            //location.href = g_sale_url+"/agncy_form.php?w=u&comp_seq="+getRowData['comp_seq'];
        });



        $("#grid2").jqxGrid('clear');


        var source2 =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_nm'},
                    { name: 'comp_seq'},
                    { name: 'comp_type_nm'},
                    { name: 'mda_cnt_1'},
                    { name: 'mda_cnt_2'},
                    { name: 'mda_cnt_3'},
                    { name: 'account_cnt_1'},
                    { name: 'account_cnt_2'},
                    { name: 'account_cnt_3'},
                    { name: 'mi_cnt_1'},
                    { name: 'mi_cnt_2'},
                    { name: 'mi_cnt_3'}

                ],
                url: g_sale_url+'/index_result.php',
                cache: false,
                data:{
                    mda_div:'AAA01'
                }
            };



        var adapter2 = new $.jqx.dataAdapter(source2);

        $("#grid2").jqxGrid(
            {
                //width: getWidth('grid'),
                width: '100%',
                height: '100%',
                //autorowheight: true,
                //autoheight: true,
                source: adapter2,
                //theme: "dark",
                columnsresize: true,
                filterable: true,
                sortable: true,
                ready: function () {

                },
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum
                    },
                    { text: '매체', datafield: 'comp_nm', filtertype: 'checkedlist', align: 'center'  ,width:135},
                    { text: '전체구좌', columngroup: 'yearmon_1', datafield: 'mda_cnt_1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매구좌', columngroup: 'yearmon_1', datafield: 'account_cnt_1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '잔여구좌', columngroup: 'yearmon_1', datafield: 'mi_cnt_1', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '전체구좌', columngroup: 'yearmon_2', datafield: 'mda_cnt_2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매구좌', columngroup: 'yearmon_2', datafield: 'account_cnt_2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '잔여구좌', columngroup: 'yearmon_2', datafield: 'mi_cnt_2', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '전체구좌', columngroup: 'yearmon_3', datafield: 'mda_cnt_3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매구좌', columngroup: 'yearmon_3', datafield: 'account_cnt_3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '잔여구좌', columngroup: 'yearmon_3', datafield: 'mi_cnt_3', filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:70,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { datafield: 'comp_seq', hidden: true },

                ],
                columngroups: [
                    { text: '타석의자(<?=$date_1?>)', align: 'center', name: 'yearmon_1' },
                    { text: '타석칸막이(<?=$date_1?>)', align: 'center', name: 'yearmon_2' },
                    { text: '대형배너(<?=$date_1?>)', align: 'center', name: 'yearmon_3' }
                ]
            });

        $('#grid2').on('celldoubleclick', function (event) { //rowdoubleclick
            //getrows  는 소팅하면 안맞음
            var getRowData = $('#grid2').jqxGrid('getboundrows')[event.args.rowindex];
            //alert(event.args.datafield);
            if(event.args.datafield == "account_cnt_1"){ //타석의자 68
                if(event.args.value !=0){
                    //alert(event.args.value);
                    var url ="inven_list_mda_pop.php?comp_seq="+getRowData['comp_seq']
                        + "&mda_seq=68";
                        //+ "&fr_date="+$("#fr_date").val().substring(0,7)+"&to_date="+$("#to_date").val().substring(0,7)  ;
                    basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
                }
            }else if(event.args.datafield == "account_cnt_2"){//타석칸막이
                if(event.args.value !=0){
                    var url ="inven_list_mda_pop.php?comp_seq="+getRowData['comp_seq']
                        + "&mda_seq=69";
                    //+ "&fr_date="+$("#fr_date").val().substring(0,7)+"&to_date="+$("#to_date").val().substring(0,7)  ;
                    basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
                }
            }else if(event.args.datafield == "account_cnt_3") {//대형베너
                if(event.args.value !=0){
                    var url ="inven_list_mda_pop.php?comp_seq="+getRowData['comp_seq']
                        + "&mda_seq=70";
                    //+ "&fr_date="+$("#fr_date").val().substring(0,7)+"&to_date="+$("#to_date").val().substring(0,7)  ;
                    basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
                }
            }

            //var column = $("#grid2").jqxGrid('getcolumn', event.args.datafield);
            //alert(getRowData['comp_nm']);
            //alert(column);
            //console.log(event.args);
            //location.href = g_sale_url+"/agncy_form.php?w=u&comp_seq="+getRowData['comp_seq'];
        });

    });


    function fn_mdaPopup(voJson){
        if(voJson.cont_asg_cnt <= 0 ){
            alert("판매구좌가 없습니다.")
            return false ;
        }
        var url ="inven_list_mda_pop.php?comp_seq="+voJson.comp_seq
            + "&mda_seq="+voJson.mda_seq
            + "&fr_date="+$("#fr_date").val().substring(0,7)+"&to_date="+$("#to_date").val().substring(0,7)  ;
        basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
    }






</script>
<?php
include_once ('./sale.tail.php');
?>
