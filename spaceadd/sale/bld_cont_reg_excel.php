<?php
$sub_menu = "100604";
include_once('./_common.php');

$g5['title'] = '계약 빌딩 엑셀 등록';
include_once('./sale.head.php');

$fr_date = isset($_REQUEST['fr_date']) ? $_REQUEST['fr_date'] : date('Y', time()).'0101';  ;
$to_date = isset($_REQUEST['to_date']) ? $_REQUEST['to_date'] : date('Y', time()).'1231';  ;
if(strlen($fr_date) == 8) $fr_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $fr_date);
if(strlen($to_date) == 8) $to_date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $to_date);

$st_date = date( 'Y-m-d' );
$ed_date = date("Y-m-d", strtotime(  "+180  days") ) ;

/*$st_date = date( 'Y-m-01' );
$ed_date = date( 'Y-m-t' );*/

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.5/xlsx.full.min.js"></script>
<script type="text/javascript">
    const bldInfo= [    
          {name: 'bld_num', text: '빌딩코드',  hidden: false, addOptions : { filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 }}
        , {name: 'bld_nm', text: '빌딩명',  hidden: false, addOptions : { filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170 }}
        , {name: 'bld_seq', text: '빌딩일련번호',  hidden: true,type: 'number' }
    ];

    var source =
    {
        datatype: "array" ,
        datafields: bldInfo.map(el=> { return { name: el.name,  type: (el.type)? el.type : 'string' } } ) ,
        localdata: [],
    };
    
    $(document).ready(function () {
        $("#fr_date, #to_date, #st_date, #ed_date ").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

       $( "#xlf" ).bind( "change" , handleXlsFile );


      /*빌딩관리*/
        $("#grid").jqxGrid('clear');

        var adapter = new $.jqx.dataAdapter(source);
        var columns = [
            {
                text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                cellsrenderer: cellRowNum ,
                aggregates: ['count'] ,
                aggregatesrenderer: aggCount ,
            }
        ] ;
        bldInfo.forEach((el)=> {
            let item = {  text: el.text,  datafield : el.name }  ;
            let addOptions = (el.addOptions)? el.addOptions : {} ;
            let hidden = (el.hidden)? {hidden :true }:{} ;
            columns.push( { ...item , ...hidden , ...addOptions } ) ;
       }) ;

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
                autoshowfiltericon: true,
                columns: columns
            });


        $("#refresh").click(function () {
            source.data= formParams($("#fsearch"))  ;
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
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '담당자', datafield: 'sale_prsn_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '계약구분', datafield: 'cont_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
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
    });

    function fn_add_bldCont(){
        //빌딩
        var rowindexes = $('#grid').jqxGrid('getrows');
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
        var params = fn_chkForm("fsearch0") ;
        if(!params){
            return false ;
        }
         window.open("bld_cont_reg_pop.php", "childForm", "width=1200, height=800, resizable = no, scrollbars = no");
    }

    function fn_openParams(){
        //빌딩
        var bld_list=[];
        var rowindexes = $('#grid').jqxGrid('getrows');
        rowindexes.forEach(function(element){
            bld_list.push (element )  ;
        } );
        //계약
        var cont_list=[];
        var rowindexes1 = $('#grid_cont').jqxGrid('getselectedrowindexes');
        rowindexes1.forEach(function(element){
            cont_list.push($('#grid_cont').jqxGrid('getrowdatabyid', element)  )  ;
        } );
        var params = fn_chkForm("fsearch0") ;
        params.bld_nums  = bld_list.map(el=>el.bld_num) ;
        params.cont_list  = cont_list.map(el=> el.cont_seq  ) ;

        return  params ;
    }

    function fn_subPopCallback(subid, voJson){
        try{
            $('#grid').jqxGrid('clearselection');
            $('#grid_cont').jqxGrid('clearselection');
        }catch (e) {
            console.log(e)
        }
    }


    function handleXlsFile( e ) {

       let input = e.target;
       let reader = new FileReader();
       reader.onload = function () {
           try {
               let data = reader.result;
               let workBook = XLSX.read( data , { type : 'binary' } );
               workBook.SheetNames.forEach( function ( sheetName , index ) {
                   if(index  > 0 ) return ;
                   let rows = XLSX.utils.sheet_to_json( workBook.Sheets[ sheetName ] );
                   let datas = [];
                   rows.forEach( function ( _row ) {

                       let values = {};
                       Object.keys( _row ).forEach( function ( k ) {
                           try{
                               if(bldInfo.find(el=>el.text == k)){
                                values[bldInfo.find(el=>el.text == k).name ]  = _row[ k ];                                                          }
                           }catch (e) {
                           }
                       } );
                       datas.push( values )

                   } )
                   source.localdata = datas;
                   $("#grid").jqxGrid('updatebounddata', 'cells');
               } )
           } catch (ex) {
           }
       };
       reader.readAsBinaryString( input.files[ 0 ] );
   }
    jQuery(function($){
        var gridHeight = Number($(window).height()) - 60 - $("#grid_cont").offset().top ;
        $("#grid").parent().height(gridHeight);
        $("#grid_cont").parent().height(gridHeight);
        //console.log("gridHeight",gridHeight)
    });

</script>
<div>
    <form id="fsearch0" name="fsearch0" class="local_sch01 local_sch" method="get"  >
        <strong>소재초수</strong>
        <input type="hidden" name="bld_req_type"  id="bld_req_type" value="bld_num">
        <input type="text" name="mtrl_sec"  id="mtrl_sec" required class="required frm_input number "  style="width:50px"  length="3"  value="15">

        <strong>운행기간</strong>
        <input  id="st_date" name="st_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_date?>"></input>
        ~
        <input  id="ed_date" name="ed_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_date?>"></input>

        <button type="button" onclick="fn_add_bldCont();" class="btn btn_01 ms-20">계약 빌딩 등록 </button>
    </form>
</div>
    <div id="main_grid0"   style="display:flex; ">
        <div id="div02" class="" class="" style="width: 100%; height: 500px;padding:3px">
            <div class="pad-b-15"><div class="subTlt"  > 계약 정보 </div></div>
            <div>
                <form id="fsearch1" name="fsearch1" class="local_sch03 local_sch" method="get">
                    <div style="display:none">
                        <label for="cont_type_code">계약구분</label>
                        <select name="cont_type_code" id="cont_type_code"  class=" " onChange=""  >
                            <option value="">선택</option>
                            <?print_option_with_select('BAB', 'BAB01');?>
                        </select>
                    </div>

                    <label for="mda_type_code">매체</label>
                    <select name="mda_type_code" id="mda_type_code"  class=" " onChange=""  >
                        <option value="">선택</option>
                        <?print_option_with_select('AAB', 'AAB03');?>
                    </select>

                    <strong style="width:unset">기간</strong>
                    <input  id="fr_date" name="fr_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_date?>"></input>
                    ~
                    <input  id="to_date" name="to_date"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_date?>"></input>
                    <button type="button"  id="refresh1" class="btn_submit">검색</button>
                </form>
            </div>
            <div id="main_grid1" class="tbl_head01 tbl_wrap" style="width:100%;height:100%;">
                <div id="grid_cont"  style="width: 100%; height:300px;">
                </div>
                <div style='margin-top: 5px;'>
                    <div style='float: left;'>
                        <input value="Remove Filter" id="clearfilteringbutton_1" type="button" />
                        <input type="button" value="Export to Excel" id='excelExport_1' />
                        <input type="button" value="컬럼 선택" id='openButton_1' />
                    </div>
                </div>
            </div>
        </div>
        <div id="div01" class="" style="width: 100%; height:400px;padding:3px">
            <div class="pad-b-15">
                <div class="subTlt"  >빌딩정보</div></div>
              <div class="local_sch03 local_sch" style="height:42px;">
                <input type="file" name="excelFile" id="xlf"/>
                  <!--
                <input type="button" id="refresh" class="btn_submit" value="엑셀등록">
                -->
              </div>
            <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; ">
                <div id="grid"  style="width: 100%; height: 100%;">
                </div>
                <?php
                include_once('./common/comm_grid_btns.php');
                ?>
            </div>
        </div>
    </div>
<script>
$(document).ready(function () {
    $('#clearfilteringbutton_1').jqxButton({ theme: theme });
    $('#clearfilteringbutton_1').click(function () {
        $("#grid_cont").jqxGrid('clearfilters');
    });

    $("#excelExport_1").jqxButton({ theme: theme });
    $("#excelExport_1").click(function () {
        $("#grid_cont").jqxGrid('exportdata', 'xlsx',   '계약상품');
    });

    $("#openButton_1").jqxButton({ theme: theme });
    $("#openButton_1").on('click', function () {
        $("#grid_cont").jqxGrid('openColumnChooser');
    });
});
</script>

<?php
include_once ('./sale.tail.php');
?>
