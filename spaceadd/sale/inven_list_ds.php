<?php
$sub_menu = "400310";
include_once('./_common.php');

$g5['title'] = 'DS 재원 현황';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : G5_TIME_YMD ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] :  date("Y-m-d", strtotime(  "+1 months") ) ;
if(strlen($fr_date) == 8) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $fr_date);
if(strlen($to_date) == 8) $to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $to_date);
?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#grid").jqxGrid('clear');

        var i = 5;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'comp_nm'},
                    { name: 'prod_seq'},
                    { name: 'mda_seq'},
                    { name: 'mda_nm'},
                    { name: 'full_nm' },
                    { name: 'asg_use_yn' },
                    { name: 'mda_cnt', type: 'number'},
                    { name: 'cont_asg_cnt', type: 'number'},
                    { name: 'asg_per'},
                    { name: 'comp_excpt'},
                    { name: 'm1'},
                    { name: 'm2'},
                    { name: 'm3'},
                    { name: 'm4'},
                    { name: 'm5'},
                    { name: 'm1_nm'},
                    { name: 'm2_nm'},
                    { name: 'm3_nm'},
                    { name: 'm4_nm'},
                    { name: 'm5_nm'}
                ],
                url: g_sale_url+'/inven_list_ds_result.php',
                cache: false,
                data: formParams($("#fsearch"))
            };
        i++;
        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                columnsresize: true,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                groupable: false,
                groupsexpandedbydefault:true ,
                showfilterbar: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsreorder: true,
                columns: [
                    {
                        text: '#',  columntype: 'number',width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '자사/타사', datafield: 'm1_nm', columngroup: 'mdaGroup', filtertype: 'checkedlist',  align: 'center' ,width:120 },
                    { text: '매체', datafield: 'm2_nm', columngroup: 'mdaGroup', filtertype: 'checkedlist',  align: 'center' ,width:150  },
                    { text: '상품', datafield: 'm3_nm', columngroup: 'mdaGroup', filtertype: 'checkedlist',  align: 'center'  ,width:150 },
                    { text: '매체사', datafield: 'comp_nm', filtertype: 'checkedlist', align: 'center'  },
                    { text: '상품명', datafield: 'mda_nm', filtertype: 'checkedlist',  align: 'center'  ,width:150  },
                    { text: '금지업종', datafield: 'comp_excpt', filtertype: 'checkedlist' ,   align: 'center'  ,width:150},
                    { text: '구좌사용여부', datafield: 'asg_use_yn', filtertype: 'checkedlist',  cellsalign: 'center',  align: 'center' ,width:100  },
                    { text: '광고 구좌', datafield: 'mda_cnt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '판매 구좌', datafield: 'cont_asg_cnt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90,  cellsformat: 'd' ,
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '사용량(%)', datafield: 'asg_per', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:90,  cellsformat: 'd'   }
                ],
                columngroups: [
                    { text: '매체', align: 'center', name: 'mdaGroup' }
                ]
            });

        $('#grid').on('rowdoubleclick', function (event) {
            fn_mdaPopup( event.args.row.bounddata)  ;
        }); 

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });

    });

    //목록 상품 상세==========
    function fn_mdaPopup(voJson){
        /*
        if(voJson.cont_asg_cnt <= 0 ){
            alert("판매구좌가 없습니다.")
            return false ;
        }

         */
        var url ="inven_list_mda_pop.php?comp_seq="+voJson.comp_seq
            + "&mda_seq="+voJson.mda_seq
            + "&fr_date="+$("#fr_date").val() +"&to_date="+$("#to_date").val()   ;
        basicPopupOpen(url, "계약상품 목록", "1100", "620")  ;
    }

    $(function(){
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

    });
</script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">
    <strong>매체사명</strong>
    <input type="text" name="comp_nm" value="<?php echo $comp_nm ?>"  id="comp_nm" required class="required frm_input">

    <strong>기간</strong>
    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
    ~
    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>

    <strong>계약 상태</strong>
    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" >
        <option value="">전체</option>
        <?php print_option_with_select('BAC', '',"BAC01");?>
        <option value="BAC99">확정이상</option>
    </select>

    <button type="button"  id="refresh" class="btn_submit">검색</button>
</form>

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;"></div>
    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>
<?php
include_once ('./sale.tail.php');
?>
