<?php
$sub_menu = "100601";
include_once('./_common.php');

$g5['title'] = '계약 빌딩 등록';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : date('Y', time()).'0101';  ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date('Y', time()).'1231';  ;
if(strlen($fr_date) == 8) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $fr_date);
if(strlen($to_date) == 8) $to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $to_date);


$st_date = date( 'Y-m-01' );
$ed_date = date( 'Y-m-t' );


?>
<script type="text/javascript">
    $(document).ready(function () {
        $("#fr_date, #to_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

      /*빌딩관리*/
        $("#grid").jqxGrid('clear');
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'bld_seq',type: 'number'},
                    { name: 'bld_num'},
                    { name: 'bld_nm'},
                    { name: 'zipcode'},
                    { name: 'addr1'},
                    { name: 'addr2'},
                    { name: 'addr3'},
                    { name: 'bld_type'},
                    { name: 'bld_level'},
                    { name: 'bld_floor'},
                    { name: 'bld_ev1'},
                    { name: 'bld_ev2'},
                    { name: 'area1'},
                    { name: 'area2'},
                    { name: 'bld_pkg'},
                    { name: 'ds_type'},
                    { name: 'ds_ev1'},
                    { name: 'ds_ev2'},
                    { name: 'ds_ev3'},
                    { name: 'ds_ev4'},
                    { name: 'disable_cnt'},
                    { name: 'ins_cnt'},
                    { name: 'ins_sec'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'excpt_item'},
                    { name: 'bigo'},
                    { name: 'use_yn'},
                    { name: 'del_yn'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'} ,
                    { name: 'bld_type_nm'},
                ],
                url: g_sale_url+'/bld_list_result.php',
                cache: false,
                data:{
                    sfl:$('#sfl').val(),
                    search_str:$('#stx').val()
                }
            };
        var adapter = new $.jqx.dataAdapter(source);

        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter ,
                filterable: true,
                filterbarmode: 'simple',
                showfilterbar: true,
                sortable: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                selectionmode: 'checkbox',
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount ,
                    },
                    { text: '빌딩코드', datafield: 'bld_num', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '건물유형', datafield: 'bld_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},
                    { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},
                    { text: '주소1', datafield: 'addr1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:270 },
                    { text: '주소2', datafield: 'addr2', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '주소3', datafield: 'addr3', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '금지업종', datafield: 'excpt_item', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170},
                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    {datafield: 'bld_seq', hidden: true,  } ,
                ]
            });


        $("#refresh").click(function () {
            source.data={
                sfl:$('#sfl').val(),
                search_str:$('#stx').val()
            }
            $("#grid").jqxGrid("updatebounddata","cells");
        });


        $("#grid_cont").jqxGrid('clear');
        var source_cont =
            {
                datatype: "json",
                datafields: [
                    { name: 'cont_seq', type: 'number'},
                    { name: 'cont_nm'},
                    { name: 'cont_type_code'},
                    { name: 'cont_type_nm'},
                    { name: 'mda_type'},
                    { name: 'cont_yearmon' , type: 'string'},
                    { name: 'cont_stat'},
                    { name: 'cont_stat_nm'},
                    { name: 'cli_seq'},
                    { name: 'cli_nm'},
                    { name: 'agncy_seq'},
                    { name: 'agncy_nm'},
                    { name: 'rep_seq'},
                    { name: 'rep_nm'},
                    { name: 'sale_prsn'},
                    { name: 'sale_prsn_nm'},
                    { name: 'cont_st_dt' , type: 'string'},
                    { name: 'cont_ed_dt' , type: 'string'},
                    { name: 'cont_amt', type: 'number'},
                    { name: 'out_amt', type: 'number'},
                    { name: 'in_amt', type: 'number'},
                    { name: 'profit_amt', type: 'number'},
                    { name: 'bigo'},
                    { name: 'entr_prsn'},
                    { name: 'entr_prsn_nm'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'},
                    { name: 'mda_nm'}
                ],
                url: g_sale_url+'/cont_list_result.php',
                cache: false,
                data: formParams($("#fsearch1"))
            };
        var adapter_cont = new $.jqx.dataAdapter(source_cont);
        $("#grid_cont").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter_cont,
                filterable: true,
                filterbarmode: 'simple',
                showfilterbar: true,
                sortable: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                selectionmode: 'checkbox',
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                        , pinned: true
                    },
                    { text: '계약 코드', datafield: 'cont_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70, pinned: true},
                    { text: '계약명', datafield: 'cont_nm',   align: 'center'  ,width:240, pinned: true},
                    { text: '계약월', datafield: 'cont_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm},
                    { text: '계약구분', datafield: 'cont_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '매체', datafield: 'mda_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},
                    { text: '시작일', datafield: 'cont_st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '종료일', datafield: 'cont_ed_dt', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '수정자', datafield: 'entr_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '수정일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150}
                ]
            });

        $("#refresh1").click(function () {
            source_cont.data = formParams($("#fsearch1"))  ;
            $("#grid_cont").jqxGrid("updatebounddata","cells");
        });


        setTimeout(function(){
            var gridHeight = Number($(window).height()) -  $("#grid").offset().top ;
            $("#grid").parent().height(gridHeight);
            $("#grid_cont").parent().height(gridHeight);
        },100)
    });

    function fn_add_bldCont(){
        //빌딩
        var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
        if(rowindexes.length ==  0 ){
            alert("등록할 빌딩을 선택하십시오.  ");
            return false ;
        }
        //계약
        var rowindexes1 = $('#grid_cont').jqxGrid('getselectedrowindexes');
        if(rowindexes1.length ==  0 ){
            alert("등록할 계약을 선택하십시오.  ");
            return false ;
        }
        var bld_list=[];
        rowindexes.forEach(function(element){
            bld_list.push($('#grid').jqxGrid('getrowdatabyid', element) )  ;
        } );

        var cont_list=[];
        rowindexes1.forEach(function(element){
            cont_list.push($('#grid_cont').jqxGrid('getrowdatabyid', element)  )  ;
        } );
        var params = fn_chkForm("fsearch0") ;
        if(!params){
            return false ;
        }
        params.bld_list  = bld_list.map(el=>el.bld_seq) ;
        params.cont_list  = cont_list.map(el=> { return { cont_seq : el.cont_seq, st_dt : el.cont_st_dt , ed_dt : el.cont_ed_dt }} ) ;
        fn_submission("subForm", "./bld_cont_form_update.php", params, true, fn_subCallback  );
    }

    function fn_subCallback(subid, voJson){
        try{
            alert("처리 되었습니다.") ;
        }catch (e) {
            console.log(e)
        }
    }

    $(function(){
        $("#st_date, #ed_date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });
    });

</script>
<div>
    <form id="fsearch0" name="fsearch0" class="local_sch01 local_sch" method="get">
        <strong>소재초수</strong>
        <input type="text" name="mtrl_sec"  id="mtrl_sec" required class="required frm_input number "  style="width:50px"  length="3"  value="15">

        <strong>운행기간</strong>
        <input  id="st_date" name="st_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_date?>"></input>
        ~
        <input  id="ed_date" name="ed_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_date?>"></input>

        <button type="button" onclick="fn_add_bldCont();" class="btn btn_01 ms-20">계약 빌딩 등록 </button>
    </form>
</div>
    <div id="main_grid0"   style="display:flex; ">
        <div id="div01" class="" style="width: 49%; height: 625px;padding:3px">
            <div class="pb-15"><div class="subTlt"  >빌딩정보</div></div>
              <div>
                <form id="fsearch" name="fsearch" class="local_sch03 local_sch" method="get">
                    <label for="sfl" class="sound_only">검색대상</label>
                    <select name="sfl" id="sfl">
                        <option value="sch_all"<?php echo get_selected($sfl, "sch_all"); ?>>전체</option>
                        <option value="comp_nm"<?php echo get_selected($sfl, "bld_nm"); ?>>빌딩명</option>
                    </select>
                    <label for="stx" class="sound_only">검색어</label>
                    <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
                    <input type="button" id="refresh" class="btn_submit" value="검색">
                </form>
            </div>
            <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; ">
                <div id="grid"  style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
        <div id="div02" class="" style="width: 50%; height: 625px;padding:3px">
            <div class="pb-15"><div class="subTlt"  > 계약 정보 </div></div>
            <div>
                <form id="fsearch1" name="fsearch1" class="local_sch03 local_sch" method="get">
                    <strong style="width:unset">광고주</strong>
                    <input type="text" name="cli_nm" value="" id="cli_nm" required class="frm_input" style="width:100px">

                    <strong style="width:unset">광고회사</strong>
                    <input type="text" name="agncy_nm" value="" id="agncy_nm" required class="frm_input" style="width:100px">

                    <strong style="width:unset">기간</strong>
                    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$fr_date?>"></input>
                    ~
                    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$to_date?>"></input>

                    <button type="button"  id="refresh1" class="btn_submit">검색</button>
                </form>
            </div>
            <div id="main_grid1" class="tbl_head01 tbl_wrap" style="width:100%;height:100%;">
                <div id="grid_cont"  style="width: 100%; height: 100%;">
                </div>
            </div>
        </div>
    </div>

<?php
include_once ('./sale.tail.php');
?>
