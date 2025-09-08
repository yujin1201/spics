<?php
$sub_menu = "100603";
include_once('./_common.php');

$g5['title'] = '빌딩/ 계약 등록 내역';
include_once('./sale.head.php');

$st_dt = isset($_REQUEST['st_dt']) ? $_REQUEST['st_dt'] : date( 'Y-m-d' );  ;
$ed_dt = isset($_REQUEST['ed_dt']) ? $_REQUEST['ed_dt'] : date("Y-m-d", strtotime(  "+180  days") )   ;

$group_div = isset($_REQUEST['group_div']) ? $_REQUEST['group_div'] : "cont" ;
?>
<script type="text/javascript">
    $(document).ready(function () {

        $("#grid").jqxGrid('clear');
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'cont_bld_seq',type: 'number'},
                    { name: 'cont_seq'},
                    { name: 'bld_seq'},
                    { name: 'mtrl_sec'},
                    { name: 'st_dt'},
                    { name: 'ed_dt'},
                    { name: 'act_st_time'},
                    { name: 'act_ed_time'},
                    { name: 'bigo'},
                    { name: 'bld_nm'},
                    { name: 'bld_num'},
                    { name: 'ins_sec'},
                    { name: 'cont_nm'},
                    { name: 'cli_seq'},
                    { name: 'agncy_seq'},
                    { name: 'cli_nm'},
                    { name: 'agncy_nm'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'} ,
                    { name: 'bld_div'} ,
                    { name: 'cont_div'} ,
                    { name: 'cont_sale_type_nm'} ,
                ],
                url: g_sale_url+'/bld_cont_list_result.php',
                cache: false,
                data:formParams($("#fsearch"))
            };
        var adapter = new $.jqx.dataAdapter(source);

        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                filterable: true,
                filterbarmode: 'simple',
                sortable: true,
                ready: function () {
                    addfilter();
                },
                showfilterbar: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                showgroupsheader: false ,
                groupable: true,
                groupsexpandedbydefault: false ,
                groups: ['<?=(($group_div =="bld" )?"bld_div":"cont_div")?>'],
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount ,
                    },
                    { text: '빌딩코드', datafield: 'bld_num', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100},
                    { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170},
                    { text: '시작일', datafield: 'st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '시작일', datafield: 'ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '적용초수', datafield: 'mtrl_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  },

                    { text: '계약명', datafield: 'cont_nm',    filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:250},
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},
                    { text: '판매구분', datafield: 'cont_sale_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150},

                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정자', datafield: 'updt_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130},
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130} ,
                    {datafield: 'bld_seq', hidden: true,  },
                    {datafield: 'bld_div', hidden: true, text: '빌딩명',  } ,
                    {datafield: 'cont_div', hidden: true, text: '계약명',  }

                ]
            });


        $("#refresh").click(function () {
            fsearch.submit()
        });


        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getboundrows')[event.args.rowindex];
            var args = event.args;
            var url ="" ;

            <?if($group_div =="bld" ) { ?>
              url = "./bld_cont_qty_pop.php"  ;
            <?}else{?>
            url = "./bld_cont_qty_pop_cont.php" ;
            <?}?>
            url = url+"?bld_seq="+getRowData['bld_seq']+"&cont_seq="+getRowData['cont_seq']+"&st_dt="+getRowData['st_dt']+"&ed_dt="+getRowData['ed_dt']  ;
            var new_win = window.open(url, 'win_profile', 'left=100,top=100,width=1000,height=900');
            new_win.focus();
        });
    });

    $(function(){
        $("#st_dt, #ed_dt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });
    });

    </script>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get" action="./bld_cont_list.php">
    <label for="sfl" class="sound_only">검색대상</label>
    <select name="sfl" id="sfl" style="width:100px">
        <option value="sch_all"<?php echo get_selected($sfl, "sch_all"); ?>>전체</option>
        <option value="comp_nm"<?php echo get_selected($sfl, "bld_nm"); ?>>빌딩명</option>
        <option value="comp_nm"<?php echo get_selected($sfl, "cont_nm"); ?>>계약명</option>
    </select>
    <label for="search_str" class="sound_only">검색어</label>
    <input type="text" name="search_str" value="<?php echo $search_str ?>" id="search_str" required class="required frm_input">

    <strong style="width:unset">기간</strong>
    <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_dt?>"></input>
    ~
    <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_dt?>"></input>

    <strong style="width:unset">구분</strong>
    <label class="me-3"><input type='radio' name='group_div' id='group_div' value='bld'  <?=(($group_div =="bld" )?"checked":"")?> >빌딩별  </label>
     <label><input type='radio' name='group_div' id='group_div' value='cont'  <?=(($group_div =="cont" )?"checked":"")?> >계약별 </label>

    <input type="button" id="refresh" class="btn_submit" value="검색">
</form>

<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 625px;">
    <div id="grid"  style="width: 100%; height: 100%;">
    </div>

    <?php
    include_once('./common/comm_grid_btns.php');
    ?>
</div>

<?php
include_once ('./sale.tail.php');
?>
