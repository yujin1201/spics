<?php
$sub_menu = "300800";
include_once('./_common.php');

$g5['title'] = '자사 매체 가동현황';
include_once('./sale.head.php');

if (empty($fr_date)) $fr_date = substr(G5_TIME_YM, 0, 5)."01";
if (empty($to_date)) $to_date = substr(G5_TIME_YM, 0, 5)."12";
if(strlen($fr_date) == 6) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $fr_date);
if(strlen($to_date) == 6) $to_date = preg_replace("/([0-9]{4})([0-9]{2})/i", "$1-$2", $to_date);
?>
<script type="text/javascript" src="/spaceadd/sale/js/date.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                     { name: 'comm_cd'}
                    ,{ name: 'comm_cd_nm'}
                    ,{ name: 'ord'}
                    ,{ name: 'tot_mda_amt', type: 'number'}
                    ,{ name: 'tot_mda_cnt', type: 'number'}
                    ,{ name: 'tot_mda_prc', type: 'number'}
                    ,{ name: 'tot_mda_per', type: 'number'}

                    ,{ name: 'm1_mda_cnt', type: 'number'}
                    ,{ name: 'm1_mda_unitprc', type: 'number'}
                    ,{ name: 'm1_mda_prc', type: 'number'}
                    ,{ name: 'm1_mda_amt', type: 'number'}
                    ,{ name: 'm1_mda_per', type: 'number'}
                    ,{ name: 'm2_mda_cnt', type: 'number'}
                    ,{ name: 'm2_mda_unitprc', type: 'number'}
                    ,{ name: 'm2_mda_prc', type: 'number'}
                    ,{ name: 'm2_mda_amt', type: 'number'}
                    ,{ name: 'm2_mda_per', type: 'number'}
                    ,{ name: 'm3_mda_cnt', type: 'number'}
                    ,{ name: 'm3_mda_unitprc', type: 'number'}
                    ,{ name: 'm3_mda_prc', type: 'number'}
                    ,{ name: 'm3_mda_amt', type: 'number'}
                    ,{ name: 'm3_mda_per', type: 'number'}
                    ,{ name: 'm4_mda_cnt', type: 'number'}
                    ,{ name: 'm4_mda_unitprc', type: 'number'}
                    ,{ name: 'm4_mda_prc', type: 'number'}
                    ,{ name: 'm4_mda_amt', type: 'number'}
                    ,{ name: 'm4_mda_per', type: 'number'}
                    ,{ name: 'm5_mda_cnt', type: 'number'}
                    ,{ name: 'm5_mda_unitprc', type: 'number'}
                    ,{ name: 'm5_mda_prc', type: 'number'}
                    ,{ name: 'm5_mda_amt', type: 'number'}
                    ,{ name: 'm5_mda_per', type: 'number'}
                    ,{ name: 'm6_mda_cnt', type: 'number'}
                    ,{ name: 'm6_mda_unitprc', type: 'number'}
                    ,{ name: 'm6_mda_prc', type: 'number'}
                    ,{ name: 'm6_mda_amt', type: 'number'}
                    ,{ name: 'm6_mda_per', type: 'number'}
                    ,{ name: 'm7_mda_cnt', type: 'number'}
                    ,{ name: 'm7_mda_unitprc', type: 'number'}
                    ,{ name: 'm7_mda_prc', type: 'number'}
                    ,{ name: 'm7_mda_amt', type: 'number'}
                    ,{ name: 'm7_mda_per', type: 'number'}
                    ,{ name: 'm8_mda_cnt', type: 'number'}
                    ,{ name: 'm8_mda_unitprc', type: 'number'}
                    ,{ name: 'm8_mda_prc', type: 'number'}
                    ,{ name: 'm8_mda_amt', type: 'number'}
                    ,{ name: 'm8_mda_per', type: 'number'}
                    ,{ name: 'm9_mda_cnt', type: 'number'}
                    ,{ name: 'm9_mda_unitprc', type: 'number'}
                    ,{ name: 'm9_mda_prc', type: 'number'}
                    ,{ name: 'm9_mda_amt', type: 'number'}
                    ,{ name: 'm9_mda_per', type: 'number'}
                    ,{ name: 'm10_mda_cnt', type: 'number'}
                    ,{ name: 'm10_mda_unitprc', type: 'number'}
                    ,{ name: 'm10_mda_prc', type: 'number'}
                    ,{ name: 'm10_mda_amt', type: 'number'}
                    ,{ name: 'm10_mda_per', type: 'number'}
                    ,{ name: 'm11_mda_cnt', type: 'number'}
                    ,{ name: 'm11_mda_unitprc', type: 'number'}
                    ,{ name: 'm11_mda_prc', type: 'number'}
                    ,{ name: 'm11_mda_amt', type: 'number'}
                    ,{ name: 'm11_mda_per', type: 'number'}
                    ,{ name: 'm12_mda_cnt', type: 'number'}
                    ,{ name: 'm12_mda_unitprc', type: 'number'}
                    ,{ name: 'm12_mda_prc', type: 'number'}
                    ,{ name: 'm12_mda_amt', type: 'number'}
                    ,{ name: 'm12_mda_per', type: 'number'}
                ],
                url: g_sale_url+'/report_list_02_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
        i++;

        var  columngroups = [{text:'합계', name :'month_tot', align: 'center', pinned: true,  classname: "grid_border_lr" }] ;
        var cols= [
                {
                    text: '#',  columntype: 'number', width:50,cellsalign: 'center', align: 'center',
                    cellsrenderer: cellRowNum ,
                    aggregates: ['count'] ,
                    aggregatesrenderer: aggCount
                    , pinned: true
                }
                ,{ text: '매체', datafield: 'comm_cd_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:150 , pinned: true}
                ,{ text: '구좌수',  datafield:'tot_mda_cnt', columngroup :'month_tot' , filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum  }
                ,{ text: '총재원',  datafield:'tot_mda_prc', columngroup :'month_tot' , filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum   }
                ,{ text: '판매액',  datafield:'tot_mda_amt', columngroup :'month_tot' , filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum   }
                ,{ text: '%',  datafield:'tot_mda_per', columngroup :'month_tot' , filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , classname: "grid_border_r"  , cellclassname: "grid_border_r"   }
            ]
        ;
        var col = { text: '구좌수',  filtertype: 'checkedlist' , cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'n' , aggregates: ['sum'] , aggregatesrenderer: aggSum };


        var fd = Date.parse($("#fr_date").val())   ;
        var td = Date.parse($("#to_date").val())   ;
        for(var i=1 ; i< 13 ; i++){
            if(fd.toString("yyyyMM") <=  td.toString("yyyyMM") ){
                columngroups.push(  {text : fd.toString("yyyy년 MM월")  , name : "month"+i , align: 'center' , classname: "grid_border_lr" }  ) ;
                cols.push(  {...col, text: '구좌수',  columngroup : "month"+i , datafield : "m"+i+"_mda_cnt" , classname: "grid_border_l" , cellclassname: "grid_border_l" } ) ;
                cols.push(  {...col, text: '1구좌금액',  columngroup : "month"+i , datafield : "m"+i+"_mda_unitprc" } ) ;
                cols.push(  {...col, text: '총재원',  columngroup : "month"+i , datafield : "m"+i+"_mda_prc" } ) ;
                cols.push(  {...col, text: '판매액',  columngroup : "month"+i , datafield : "m"+i+"_mda_amt" } ) ;
                cols.push(  {...col, text: '%',  columngroup : "month"+i , datafield : "m"+i+"_mda_per" , classname: "grid_border_r"  , cellclassname: "grid_border_r" } ) ;
             }
             fd =   fd.add({ months: 1 })
        }
        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                sortable: false,
                ready: function () {
                    addfilter();
                },
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                columns: cols ,
                columngroups: columngroups
            });


        $("#refresh").click(function () {
            fsearch.action ="report_list_02.php"   ;
            fsearch.submit() ;

            /*
            $('#grid').jqxGrid('showloadelement');
            try{
                $("#grid").jqxGrid("updatebounddata","cells");
                var fd = Date.parse($("#fr_date").val())   ;
                var td = Date.parse($("#to_date").val())   ;
                for(var i=1; i<=12; i++){
                    if(fd.toString("yyyyMM") <=  td.toString("yyyyMM") ){
                        $("#grid").jqxGrid('showcolumn', "m"+i+"_mda_cnt"  );
                        $("#grid").jqxGrid('showcolumn', "m"+i+"_mda_unitprc" );
                        $("#grid").jqxGrid('showcolumn', "m"+i+"_mda_prc"  );
                        $("#grid").jqxGrid('showcolumn', "m"+i+"_mda_amt"  );
                        $("#grid").jqxGrid('showcolumn', "m"+i+"_mda_per"  );
                        headers[i].textContent  = fd.toString("yyyy년 MM월")     ;
                    }else{
                        $("#grid").jqxGrid('hidecolumn', "m"+i+"_mda_cnt"  );
                        $("#grid").jqxGrid('hidecolumn', "m"+i+"_mda_unitprc" );
                        $("#grid").jqxGrid('hidecolumn', "m"+i+"_mda_prc"  );
                        $("#grid").jqxGrid('hidecolumn', "m"+i+"_mda_amt"  );
                        $("#grid").jqxGrid('hidecolumn', "m"+i+"_mda_per"  );
                    }
                    fd =   fd.add({ months: 1 })
                }

                source.data = formParams($("#fsearch"))  ;
                $("#grid").jqxGrid("updatebounddata","cells");

            }catch (e) {
                console.log(e)
            }
             */
        });

        $("#grid").on("bindingcomplete", function (event) {
            $('#grid').jqxGrid('hideloadelement');
        });

        //첫 로딩
        setTimeout(function() {
            source.data = formParams($("#fsearch"));
            $("#grid").jqxGrid("updatebounddata", "cells");
        },100)
    });


    $(function(){
        $("#fr_date, #to_date" ).datepicker( $.datepicker.yearmon) ;
        $("#fr_date, #to_date").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });
    });

    //미디어금액 등록
    function  fn_mdatype(){
        var url = "./report02_pop_mdatype.php"  ;
        basicPopupOpen(url, "계약 매체별 금액", "900", "700")  ;
    }
</script>
<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>계약월 기간</strong>
    <input  id="fr_date" name="fr_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"  ref="" maxlength="20"  length="6" class="frm_input ym" value="<?=$to_date?>"></input>
    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '', '',  'BACALL');?>
    </select>
    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>
<div class="btn_fixed_top">
        <button type="button" onclick="fn_mdatype();" class="btn btn_02">월 매채 재원 관리</button>

</div>
<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;"></div>
    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>
<?php
include_once ('./sale.tail.php');
?>
