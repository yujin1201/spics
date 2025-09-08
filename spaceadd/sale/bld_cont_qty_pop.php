<?php
$sub_menu = "100604";
include_once('./_common.php');

$g5['title'] = '빌딩 계약 상세(빌딩)';
include_once(G5_SALE_PATH.'/sale.head.popup.php');

$bld_seq = isset($_GET['bld_seq']) ? $_GET['bld_seq']  : "";
$st_dt = isset($_GET['st_dt']) ? $_GET['st_dt'] : date( 'Y-m-01' ) ;
$ed_dt = isset($_GET['ed_dt']) ? $_GET['ed_dt'] : date( 'Y-m-t' ) ;


if(strlen($st_dt) == 8) $st_dt = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $st_dt);
if(strlen($ed_dt) == 8) $ed_dt = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/i", "$1-$2-$3", $ed_dt);

if( $bld_seq  != ""){
    $sql = "select  
          bld_seq
        , bld_num
        , bld_nm
        , zipcode
        , addr1
        , addr2
        , addr3
        , bld_type
        , bld_level
        , bld_floor
        , bld_ev1
        , bld_ev2
        , area1
        , area2
        , bld_pkg
        , ds_type
        , ds_ev1
        , ds_ev2
        , ds_ev3
        , ds_ev4
        , disable_cnt
        , ins_cnt
        , ins_sec
        , use_st_dt
        , use_ed_dt
        , excpt_item
        , bigo
        , use_yn
        , del_yn
        , entr_prsn
        , entr_dt
        , updt_prsn
        , updt_dt
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_type and comm_type_cd ='BBA'), '')  bld_type_nm
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_level and comm_type_cd ='BBB'), '')  bld_level_nm
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.area1 and comm_type_cd ='BBC'), '') area1_nm
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.area2 and comm_type_cd ='BBD'), '') area2_nm
        , a.bld_mda_type
        , ifnull((select comm_cd_nm from tb_code where comm_cd = a.bld_mda_type and comm_type_cd ='BBK'), '') bld_mda_type_nm
    ,FN_MB_NM(entr_prsn) as entr_prsn
    ,FN_MB_NM(updt_prsn) as updt_prsn 
    from tb_bld  a 
    where bld_seq='{$bld_seq }'";
    $comp = sql_fetch($sql);
}
?>
<style>

    .tbl_frm01 th {
        padding :3px 5px  ;
	}
</style>

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
                <th scope="row"><label for="bld_nm">빌딩명</label></th>
                <td colspan="3"><?php echo $comp['bld_nm'] ?>
                </td>
              </tr>
            <tr>
                <th scope="row"><label for="bld_num">빌딩코드</label></th>
                <td><?php echo $comp['bld_num'] ?></td>
                <th scope="row"><label for="bld_floor">층수</label></th>
                <td><?php echo $comp['bld_floor'] ?></td>
            </tr>
            <tr>
                <th scope="row"><label for="bld_type">건물유형</label></th>
                <td  ><?php echo $comp['bld_type_nm'] ?></td>
                <th scope="row"><label for="bld_level">빌딩 매체 타입</label></th>
                <td ><?php  echo $comp['bld_mda_type']  ?></td>
            </tr>
            <tr>
                <th scope="row"><label for="area1">빌딩 권역</label></th>
                <td ><?php echo $comp['area1_nm'].'-'.$comp['area2_nm'] ?></td>
                <th scope="row"><label for="bld_level">엘리베이터</label></th>
                <td>
                    내부 : <?php echo $comp['bld_ev1'] ?>
                    외부 : <?php echo $comp['bld_ev2'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row">주 소</th>
                <td colspan="3" class="td_addr_line">
                    [<?php echo $comp['zipcode']; ?>]<?php echo $comp['addr1'].' '.$comp['addr2'].' '.$comp['addr3'] ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ins_sec">가용초수</label></th>
                <td><?php echo $comp['ins_sec'] ?></td>
                <th scope="row"><label for="ins_cnt">기기수</label></th>
                <td><?php echo $comp['ins_cnt'] ?></td>
                <!--<th scope="row"><label for="use_st_dt"> 운영기간</label></th>
                <td ><?php /*=$comp['use_st_dt'].'~'.$comp['use_ed_dt']*/?></td>-->
            </tr>
            <tr>
                <th scope="row"><label for="disable_cnt">송출불가 기기수</label></th>
                <td><?php echo $comp['disable_cnt'] ?>&nbsp;</td>
<!--                <th scope="row"><label for="use_yn">사용여부</label></th>
                <td><?php /*echo $comp['use_yn'] */?></td>-->
                <th scope="row"><label for="excpt_item">금지업종</label></th>
                <td><?=$comp['excpt_item']?>&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php if( isset($_GET['bld_seq'])  ) {  ?>
    <div class="subTlt" style="position: relative"  >
        빌딩 계약 내역
    </div>
    <form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get"  >
        <input type="hidden" id="bld_seq" name="bld_seq" value="<?=$bld_seq?>">
        <strong style="width:unset">기간</strong>
        <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$st_dt?>"></input>
        ~
        <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$ed_dt?>"></input>

        <input type="button" id="refresh" class="btn_submit" value="검색">
    </form>
    <div class="tbl_frm01 tbl_wrap">
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:495px;">
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
                { name: 'act_st_time'},
                { name: 'act_ed_time'},
                { name: 'bigo'},
                { name: 'bld_nm'},
                { name: 'ins_sec'},
                { name: 'cont_nm'},
                { name: 'cli_seq'},
                { name: 'agncy_seq'},
                { name: 'cli_nm'},
                { name: 'agncy_nm'},
                { name: 'entr_prsn'},
                { name: 'entr_dt'},
                { name: 'updt_prsn'} ,
                { name: 'updt_dt'} ,
                { name: 'bld_div'} ,
                { name: 'cont_div'} ,
                { name: 'cont_sale_type_nm'} ,

            ],
            url: g_sale_url+'/bld_cont_list_result.php',
            cache: false,
            data: {
                bld_seq: '<?=$bld_seq?>',
                st_dt: '<?=$st_dt?>',
                ed_dt: '<?=$ed_dt?>',
            }
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
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount ,
                    },
                    { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '운행 시작일', datafield: 'st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '운행 종료일', datafield: 'ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '일련번호', datafield: 'cont_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100  ,  editable: false } ,
                    { text: '계약명', datafield: 'cont_nm',    filtertype: 'checkedlist' ,  width:250,  editable: false } ,
                    { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150,  editable: false } ,
                    { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150,  editable: false } ,
                    { text: '판매방식', datafield: 'cont_sale_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120},

                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '수정자', datafield: 'updt_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '수정일', datafield: 'updt_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false }  ,
                    {datafield: 'bld_seq', hidden: true,  },
                    {datafield: 'bld_div', hidden: true, text: '빌딩명',  } ,
                    {datafield: 'cont_div', hidden: true, text: '계약명',  } ,
                    {datafield: 'cont_bld_seq', hidden: true, text: '일련번호',  }

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
           alert("항목을 선택하십시오.  ");
           return false ;
       }

       if(subId == "subDel") {
           if(!confirm("삭제하시겠습니까?")) {
               return false;
           }
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