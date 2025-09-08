<?php
$sub_menu = "100605";
include_once('./_common.php');

$g5['title'] = '빌딩 계약 상세(계약)';
include_once(G5_SALE_PATH.'/sale.head.popup.php');
include_once('./cont_form_common.php');

$bld_seq = isset($_GET['bld_seq']) ? $_GET['bld_seq']  : "";
$st_dt = isset($_GET['st_dt']) ? $_GET['st_dt'] : date( 'Y-m-01' ) ;
$ed_dt = isset($_GET['ed_dt']) ? $_GET['ed_dt'] : date( 'Y-m-t' ) ;
$cont_seq = isset($_GET['cont_seq']) ? $_GET['cont_seq']  : "";

if( $cont_seq  != ""){
    $cont = fn_contInfo($_GET['cont_seq'])  ;
}
?>
<style>
    .tbl_frm01 th {
        padding :3px 5px  ;
	}
</style>

    <form name="fcomp" id="fcomp" action="./cont_form_update.php"  method="post">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="token" value="<?php echo get_write_token('online') ?>">

        <div class="tbl_frm01 tbl_wrap">
            <table>
                <caption><?php echo $g5['title']; ?></caption>
                <colgroup>
                    <col class="grid_2">
                    <col class="grid_4">
                    <col class="grid_2">
                    <col class="grid_4">
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="cont_nm">계약명</label></th>
                    <td > <?php echo $cont['cont_nm'] ?> </td>
                    <th scope="row"><label for="cli_seq">계약일련번호</label></th>
                    <td>
                        <input type="text" name="cont_seq" id="cont_seq" value="<?php echo $cont['cont_seq'] ?>"  class="frm_input readonly " readonly size="5">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cli_seq">광고주</label></th>
                    <td> <?php echo$cont['cli_nm']  ?></td>
                    <th scope="row"><label for="agncy_seq">광고회사 </label></th>
                    <td>   <?php echo$cont['agncy_nm'] ?> </td>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cont_yearmon">계약월 </label></th>
                    <td> <?echo $cont['cont_yearmon']?> </td>
                    <th scope="row"><label for="cont_st_dt">청약기간</label></th>
                    <td> <?=$cont['cont_st_dt']?> ~<?=$cont['cont_ed_dt']?> </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cont_amt">청약금액(매출액)</label></th>
                    <td> <?=$cont['cont_amt']?> </td>
                    <th scope="row"><label for="cont_type_code">계약구분</label></th>
                    <td>
                        <select name="cont_type_code" id="cont_type_code" onChange="" style="width: 150px" disabled>
                            <?php print_option_with_select('BAB', $cont['cont_type_code']);?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="deal_type_code">거래구분 </label></th>
                    <td >
                        <select name="deal_type_code" id="deal_type_code" onChange="" style="width: 150px" disabled>
                            <?php print_option_with_select('BAG', $cont['deal_type_code']);?>
                        </select>
                    </td>
                    <th scope="row"><label for="tel_no">담당자</label></th>
                    <td> <?=$cont['sale_prsn_nm']?> </td>
                </tr>
                <tr>
                    <th scope="row"><label for="brnd_nm">캠페인 명 </label></th>
                    <td> <?php echo $cont['campgn_nm'] ?> </td>
                    <th scope="row"><label for="brnd_nm">브랜드명 </label></th>
                    <td> <?php echo $cont['brnd_nm'] ?> </td>
                </tr>
                <tr>
                    <th scope="row"><label for="cont_stat">계약상태</label></th>
                    <td>
                       <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" disabled>
                            <?php print_option_with_select('BAC', $cont['cont_stat']);?>
                        </select>
                    </td>
                     <th scope="row"><label>수정자 / 수정일</label></th>
                     <td><?=$cont['updt_prsn_nm']?> / <?=$cont['updt_dt']?> </td>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php if( isset($_GET['bld_seq'])  ) {  ?>
    <div class="subTlt" style="position: relative"  >
        빌딩 계약 내역
    </div>
    <form id="fsearch" name="fsearch" class="pad-t-5" method="get" >
        <input type="hidden" id="bld_seq" name="bld_seq" value="<?=$bld_seq?>">
        <input type="hidden" id="cont_seq" name="cont_seq" value="<?=$cont_seq?>">
        <!--
        <strong style="width:unset">기간</strong>
        <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_dt?>"></input>
        ~
        <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_dt?>"></input>

        <input type="button" id="refresh" class="btn_submit" value="검색">
        -->
    </form>
    <div class="tbl_frm01 tbl_wrap">
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:455px;">
            <div id="grid"  style="width: 100%; height: 100%;">
            </div>
            <?php
            include_once('./common/comm_grid_btns.php');
            ?>
        </div>
    </div>
    <div class="" align="center">
        <button  class="btn btn_save btn_lg" onclick="return fn_qty_submit('subForm');">저장</button>
        <button  class="btn btn_del btn_lg" onclick="return fn_qty_submit('subDel');">삭제</button>
        <button  class="btn btn_close btn_lg" onclick="return self.close();">닫기</button>
    </div>
    <?php
    }
    ?>


<script>

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
                { name: 'bld_div'} ,
                { name: 'cont_div'} ,
            ],
            url: './cont_form_bld_result.php',
            cache: false,
            data: formParams($("#fsearch"))
        };


    <?php if( isset($_GET['bld_seq'])  ) {  ?>
   ins_grid_load();

   <!--빌딩 계약내역-->

    function ins_grid_load() {
        $("#grid").jqxGrid('clear');
        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                columnsresize: true,
                filterable: false,
                sortable: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                selectionmode: 'checkbox',
                altrows: true,
                editable:  true ,
                autoshowfiltericon: true,
                columnsreorder: false,
                ready: function () {
                    addfilter();
                },
                filterbarmode: 'simple',
                showfilterbar: true,
                showgroupsheader: false ,
                columns: [
                    {
                        text: '#',columntype: 'number', width: 50, cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum,
                        aggregates: ['count'],
                        aggregatesrenderer: aggCount
                    },
                    { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '운행 시작일', datafield: 'st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '운행 종료일', datafield: 'ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '건물유형', datafield: 'bld_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170,  editable: false } ,
                    { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170,  editable: false } ,
                    { text: '기기초수', datafield: 'ins_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100,  editable: false } ,
                    { text: '주소1', datafield: 'addr1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:270 ,  editable: false } ,
                    { text: '주소2', datafield: 'addr2', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170,  editable: false } ,
                    { text: '주소3', datafield: 'addr3', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170,  editable: false } ,
                    { text: '금지업종', datafield: 'excpt_item', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170,  editable: false } ,
                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '수정자', datafield: 'updt_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false }  ,

                    {datafield: 'bld_seq', hidden: true,  } ,
                    {datafield: 'cont_seq', hidden: true,  } ,
                    {datafield: 'cont_bld_seq', hidden: true,  } ,
                ]
            });

        $("#refresh").click(function () {
            source.data = formParams($("#fsearch"))  ;
            $("#grid").jqxGrid("updatebounddata","cells");
        });
    }


   /*저장*/
   function fn_qty_submit(subId){
       var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
       if(rowindexes.length ==  0 ){
           alert("등록할 항목을 선택하십시오.  ");
           return false ;
       }
       var media=[];
       rowindexes.forEach(function(element){
           var data = $('#grid').jqxGrid('getrowdatabyid', element);
           media.push(data)  ;
       } );
       var params = fn_chkForm("fsearch") ;
       if(!params){
           return false ;
       }
       params.list  = media ;
       fn_submission(subId , "./bld_cont_qty_pop_update.php", params, true, fn_subCallback  );
   }

   function fn_subCallback(subid, voJson){
       try{
           alert("처리 되었습니다.") ;
           $('#grid').jqxGrid('clearselection');

           source.data = formParams($("#fsearch"))  ;
           $("#grid").jqxGrid("updatebounddata","cells");
       }catch (e) {
           console.log(e)
       }
   }



   $(function(){
       $("#st_dt, #ed_dt").datepicker({
           changeMonth: true,
           changeYear: true,
           dateFormat: "yy-mm-dd",
           showButtonPanel: true,
           yearRange: "c-99:c+99"  });
   });
   <?php
    }
    ?>
</script>

<?php
include_once(G5_PATH.'/tail.sub.php');
?>