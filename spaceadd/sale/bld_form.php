<?php
$sub_menu = "100600";
include_once('./_common.php');

$g5['title'] = '빌딩 관리';
include_once('./sale.head.php');

add_javascript('<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>', 0);
$bld_seq = isset($_GET['bld_seq']) ? $_GET['bld_seq']  : "";

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
        , bld_mda_type
    ,FN_MB_NM(entr_prsn) as entr_prsn
    ,FN_MB_NM(updt_prsn) as updt_prsn 
    from tb_bld 
    where bld_seq='{$bld_seq }'";
    $comp = sql_fetch($sql);
}else{
    $comp['use_yn'] ="Y" ;
    $comp['ins_sec'] ="300" ;
}
$comp['use_st_dt'] = (empty($comp['use_st_dt'])) ? G5_TIME_YMD :  date('Y-m-d',strtotime($comp['use_st_dt'])) ;
$comp['use_ed_dt'] = (empty($comp['use_ed_dt'])) ? '2999-12-31' :  date('Y-m-d',strtotime($comp['use_ed_dt'])) ;


?>
<script type="text/javascript">
    jQuery(function($) {
        try{
            $("#use_st_dt, #use_ed_dt ").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                yearRange: "c-99:c+99"  });
        }catch (e) {
            console.log(e)
        }
    });

    //저장
    function fn_bld_submit(f){
        var params = fn_chkForm("fcomp") ;
        if(!params){
            return false ;
        }
        fn_submission("subForm", "./bld_form_update.php", params, true, fn_subCallback  );
    }
    /*삭제*/
    function fn_bld_del(pStat, pFlag ="U")
    {
        if(!confirm("삭제 하시겠습니까? ")){
            return false ;
        }
        var params  =   formParams($("#fcomp"));
        fn_submission("subDel", "./bld_form_update.php", params, true, fn_subCallback  );
    }
    function fn_subCallback(subid, voJson){
        alert("처리 되었습니다.") ;
        if(subid == "subDel"){
            location.href="./bld_list.php";
        }else{
            fn_refresh(voJson.bld_seq) ;
        }
    }

    //빌딩상세
    function fn_refresh(bld_seq){
        location.href="./bld_form.php?bld_seq="+bld_seq ;
    }

</script>


    <div class="btn_fixed_top">
        <div class="btn_list03">
            <a href="./bld_list.php" class="">빌딩 관리</a>
            <button  class="btn_save" onclick="return fn_bld_submit(this);" style="">저장</button>
            <?php if( isset($_GET['bld_seq'])  ) {  ?>
              <button  class="btn_del" onclick="return fn_bld_del( );">삭제</button>
            <?} ?>

        </div>
    </div>
<form name="fcomp" id="fcomp" action="./bld_form_update.php"  method="post">
    <input type="hidden" name="token" value="<?php echo get_write_token('online') ?>">
    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="bld_nm">빌딩명<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <input type="text" name="bld_nm" value="<?php echo $comp['bld_nm'] ?>" id="bld_nm" required class="required frm_input " size="50"  maxlength="50" autocomplete="off">
                    <input type="text" name="bld_seq" id="bld_seq"  class="frm_input readonly"  value="<?php echo $comp['bld_seq'] ?>" size="20" maxlength="20" autocomplete="off" readonly>
                </td>
              </tr>
            <tr>
                <th scope="row"><label for="bld_mda_type">빌딩 매체 타입<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <select name="bld_mda_type" id="bld_mda_type" class="required" onChange="" required>
                        <?print_option_with_select('BBK', $comp['bld_type']);?>
                    </select>
                 </td>
            </tr>
            <tr>
                <th scope="row"><label for="bld_num">빌딩코드</label></th>
                <td><input type="text" name="bld_num" id="bld_num"  required class="required frm_input "  value="<?php echo $comp['bld_num'] ?>" size="20" maxlength="20" autocomplete="off" ></td>

                <th scope="row"><label for="bld_floor">층수</label></th>
                <td >
                    <input type="text" name="bld_floor" value="<?php echo $comp['bld_floor'] ?>" id="bld_nm"   class="  frm_input " size="20"  maxlength="20" autocomplete="off">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bld_type">건물유형</label></th>
                <td>
                    <select name="bld_type" id="bld_type" class="required" onChange="" required>
                        <option value="">  선택</option>
                        <?print_option_with_select('BBA', $comp['bld_type']);?>
                    </select>
                </td>
                <th scope="row"><label for="bld_level">건물 등급</label></th>
                <td>
                    <select name="bld_level" id="bld_level" class="required" onChange="" required>
                        <option value="">선택</option>
                        <?print_option_with_select('BBB', $comp['bld_level']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="area1">빌딩 권역</label></th>
                <td>
                    <select name="area1" id="area1" class="required" onChange="" required>
                        <option value="">권역1 선택</option>
                        <?print_option_with_select('BBC', $comp['area1']);?>
                    </select>
                    <!--
                    <select name="area2" id="area2" class="required" onChange="" required>
                        <option value="">권역2 선택</option>
                        <?print_option_with_select('BBD', $comp['area2']);?>
                    </select>
                    -->
                </td>
                <th scope="row"><label for="bld_pkg">패키지</label></th>
                <td>
                    <select name="bld_pkg" id="bld_pkg"  class="required" onChange="" required>
                        <option value="">쿼터 선택</option>
                        <?print_option_with_select('BBF', $comp['bld_pkg']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row">주 소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호<strong class="sound_only">필수</strong></label>
                    <input type="text" name="zipcode" value="<?php echo $comp['zipcode']; ?>" id="zipcode" class=" frm_input readonly" size="5" maxlength="6" autocomplete="off" readonly>
                    <button type="button" class="btn_frmline" onclick="win_zip('fcomp', 'zipcode', 'addr1', 'addr3', 'addr2', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="addr1" value="<?php echo $comp['addr1'] ?>" id="addr1" class=" frm_input readonly" size="60" readonly autocomplete="off">
                    <label for="mb_addr1"> </label> <input type="text" name="addr2" value="<?php echo $comp['addr2'] ?>" id="addr2" class="frm_input readonly" size="60" readonly autocomplete="off" >
                    <label for="mb_addr3">상세주소</label> <input type="text" name="addr3" value="<?php echo $comp['addr3'] ?>" id="addr3" class="frm_input" size="60" autocomplete="off">

                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $comp['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ins_sec">가용초수</label></th>
                <td>
                    <input type="text" name="ins_sec" value="<?php echo $comp['ins_sec'] ?>" id="ins_sec"   required class="frm_input number  required" size="20"  maxlength="20" autocomplete="off">초
                </td>
                <th scope="row"><label for="use_st_dt"> 운영기간</label></th>
                <td >
                    <input  id="use_st_dt" name="use_st_dt"   maxlength="20"  length="8" class="frm_input ymd " value="<?=$comp['use_st_dt']?>"></input>
                    ~
                    <input  id="use_ed_dt" name="use_ed_dt"   maxlength="20"  length="8" class="frm_input ymd " value="<?=$comp['use_ed_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="ins_cnt">기기수</label></th>
                <td colspan="3">
                    <input type="text" name="ins_cnt" value="<?php echo $comp['ins_cnt'] ?>" id="ins_cnt"   class="frm_input number" size="20"  maxlength="20" autocomplete="off">
                </td>
<!--                <th scope="row"><label for="disable_cnt">송출불가 기기수</label></th>
                <td>
                    <input type="text" name="disable_cnt" value="<?php /*echo $comp['disable_cnt'] */?>" id="disable_cnt"   class="frm_input number" size="20"  maxlength="20" autocomplete="off">
                </td>-->
            </tr>
            <!--
            <tr>
                <th scope="row"><label for="use_yn">사용여부</label></th>
                <td>
                     <? print_radioYN("use_yn", $comp['use_yn'], "")  ?>
                </td>
                <th scope="row"><label for="bld_level">엘리베이터</label></th>
                    <td>
                        내부 :
                        <input type="text" name="bld_ev1" value="<?php echo $comp['bld_ev1'] ?>" id="bld_ev1"   class="frm_input " size="20"  maxlength="20" autocomplete="off">
                        외부 :
                        <input type="text" name="bld_ev2" value="<?php echo $comp['bld_ev2'] ?>" id="bld_ev2"   class="frm_input " size="20"  maxlength="20" autocomplete="off">

                    </td>
            </tr>
            -->
            <tr>
                <th scope="row"><label for="ds_type">DS매체</label></th>
                <td colspan="3">
<!--                    <select name="ds_type" id="ds_type" class="" onChange=""  >
                        <option value="">DS매체 선택</option>
                        <?/*print_option_with_select('BBH', $comp['ds_type']);*/?>
                    </select>-->
                    <input type="checkbox" name="ds_ev1" value="Y" id="ds_ev1" <?php echo ($comp['ds_ev1']=="Y")?'checked':''; ?> >
                    <label for="ds_ev1">세로형(EV외부)</label>

                    <input type="checkbox" name="ds_ev2" value="Y" id="ds_ev2" <?php echo ($comp['ds_ev2']=="Y")?'checked':''; ?> >
                    <label for="ds_ev2">가로형(EV외부)</label>

                    <input type="checkbox" name="ds_ev3" value="Y" id="ds_ev3" <?php echo ($comp['ds_ev3']=="Y")?'checked':''; ?> >
                    <label for="ds_ev3">세로형(EV내부)</label>

                    <input type="checkbox" name="ds_ev4" value="Y" id="ds_ev4" <?php echo ($comp['ds_ev4']=="Y")?'checked':''; ?> >
                    <label for="ds_ev4">가로형(EV내부)</label>

                </td>
            </tr>


            <tr>
                <th scope="row"><label for="excpt_item">금지업종</label></th>
                <td colspan="3">
                    <input  id="excpt_item" name="excpt_item"   maxlength="120"   class="frm_input" value="<?=$comp['excpt_item']?>" style="width:80%"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비 고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" rows="3" style="height:50px"><?php echo $comp['bigo'] ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="psrn_nm">등록정보</label></th>
                <td >
                    <input type="text" name="entr_prsn" value="<?php echo $comp['entr_prsn'] ?>" id="entr_prsn" maxlength="20" class="frm_input readonly" size="20" autocomplete="off" readonly>
                    <input type="text" name="entr_dt" value="<?php echo $comp['entr_dt'] ?>" id="entr_dt" maxlength="20" class="frm_input readonly" size="20" autocomplete="off" readonly>
                </td>
                <th scope="row"><label for="psrn_nm">수정정보</label></th>
                <td >
                    <input type="text" name="updt_prsn" value="<?php echo $comp['updt_prsn'] ?>" id="updt_prsn" maxlength="20" class="frm_input readonly" size="20" autocomplete="off" readonly>
                    <input type="text" name="updt_dt" value="<?php echo $comp['updt_dt'] ?>" id="updt_dt" maxlength="20" class="frm_input readonly" size="20" autocomplete="off" readonly>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

    <?php if( isset($_GET['bld_seq'])  ) {  ?>
    <div class="tbl_frm01 tbl_wrap">
<!--        <div class="" style="margin-top: 15px" >
            <div class="subTlt"  >
                빌딩 기기
            </div>
            <div class="btn_list03">
              <button type="button" class="btn_new" onclick="bldIns_popup('');">기기등록</button>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:195px;">
            <div id="grid"  style="width: 100%; height: 100%;">
            </div>
        </div>-->

        <div class="" style="margin-top: 15px" >
            <div class="subTlt"  >
                제한 빌딩재원 관리
            </div>
            <?if($member['mb_level'] > 7 || $member['mb_level'] ==  4 ){?>
            <div class="btn_list03">
               <button type="button" class="btn_new" onclick="bldQty_popup('');">제한 재원등록</button>
            </div>
            <?}?>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:195px;">
            <div id="gridQty"  style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>


    <?php
    }
    ?>
</form>


<script>
   <?php if( isset($_GET['bld_seq'])  ) {  ?>

   <?php

   $sqlIns = " SELECT 
            ins_seq
         , 	bld_seq
         , 	ins_code
         , 	ins_nm
         , 	ins_poi
         , 	ins_condi
         , 	mda_type
         , 	ins_cnt
         , 	use_yn
         , 	use_st_dt
         , 	use_ed_dt
         , 	comm_seq
         , 	comm_type_cd
         , 	etc1
         , 	etc2
         , 	etc3
         , 	bigo
         , 	del_yn
         , 	entr_prsn
         , 	entr_dt
         , 	updt_prsn
         , 	updt_dt
          FROM tb_bld_ins a
          where  DEL_YN='N'  
              and bld_seq =  {$bld_seq } 
           order by ins_nm desc ";
   //$resultIns = sql_query_json($sqlIns);
   $resultIns = [] ;

   //질의.


//재원
   $sqlQty= "  SELECT
            bld_qty_seq,
            bld_seq,
            ins_sec,
            st_dt,
            ed_dt,
            bigo,
            use_yn,
            del_yn,
            entr_prsn,
            entr_dt,
            updt_prsn,
            updt_dt
        FROM tb_bld_qty  
         where  DEL_YN='N'  
              and bld_seq =  {$bld_seq }  
         order by st_dt desc ";
   $resultQty = sql_query_json($sqlQty); //질의.

   ?>

   //ins_grid_load();
   qty_grid_load();

   <!--기기 등록-->
    function bldIns_popup(ins_seq){
        var pram ="";
        if(ins_seq !=''){
            pram = "&ins_seq="+ins_seq;
        }
        var new_win = window.open("bld_form_ins_pop.php?bld_seq=<?=$comp['bld_seq']?>"+pram, 'win_profile', 'left=100,top=100,width=650,height=650');
        new_win.focus();
    }
    function ins_grid_load(){
        $("#grid").jqxGrid('clear');
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'ins_seq'},
                    { name: 'bld_seq'},
                    { name: 'ins_code'},
                    { name: 'ins_nm'},
                    { name: 'ins_poi'},
                    { name: 'ins_condi'},
                    { name: 'mda_type'},
                    { name: 'ins_cnt'},
                    { name: 'use_yn'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'comm_seq'},
                    { name: 'comm_type_cd'},
                    { name: 'etc1'},
                    { name: 'etc2'},
                    { name: 'etc3'},
                    { name: 'bigo'},
                    { name: 'del_yn'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'}
                ],
                localData: <?=$resultIns?>
            };
        var adapter = new $.jqx.dataAdapter(source);
        $("#grid").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter,
                columnsresize: true,
                filterable: true,
                sortable: true,
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', sortable: false, filterable: false, editable: false,
                        groupable: false, draggable: false, resizable: false,
                        datafield: '', columntype: 'number', width: 50, height:25,
                        cellsrenderer: function (row, column, value) {
                            return "<div style='margin:2px;'>" + (value + 1) + "</div>";
                        }
                    },
                    { text: '일련번호', datafield: 'ins_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:70 },
                    { text: '기기명', datafield: 'ins_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:120 },
                    { text: '기기위치', datafield: 'ins_poi', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                    { text: '기기수', datafield: 'ins_cnt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '사용시작일자', datafield: 'use_st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd},
                    { text: '사용종료일자', datafield: 'use_ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center',cellsrenderer : cellYmd },
                    { datafield: 'bld_seq', hidden: true },
                ]
            });

        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];
            bldIns_popup(getRowData['ins_seq']);
        });
   }


     //재원등록-----
        function bldQty_popup(bld_qty_seq){
            var pram ="";
            if(bld_qty_seq !=''){
                pram = "&bld_qty_seq="+bld_qty_seq;
            }
            var new_win = window.open("bld_form_qty_pop.php?bld_seq=<?=$comp['bld_seq']?>"+pram, 'win_profile', 'left=100,top=100,width=650,height=550');
            new_win.focus();
        }
        function qty_grid_load(){

            $("#gridQty").jqxGrid('clear');
            var source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'bld_qty_seq'},
                        { name: 'bld_seq'},
                        { name: 'ins_sec'},
                        { name: 'use_yn'},
                        { name: 'st_dt'},
                        { name: 'ed_dt'},
                        { name: 'bigo'},
                        { name: 'entr_prsn'},
                        { name: 'entr_dt'},
                        { name: 'updt_prsn'},
                        { name: 'updt_dt'}
                    ],
                    localData: <?=$resultQty?>
                };
            var adapterQty = new $.jqx.dataAdapter(source);
            $("#gridQty").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapterQty,
                    columnsresize: true,
                    filterable: true,
                    sortable: true,
                    autoshowfiltericon: true,
                    columns: [
                        {
                            text: '#', sortable: false, filterable: false, editable: false,
                            groupable: false, draggable: false, resizable: false,
                            datafield: '', columntype: 'number', width: 50, height:25,
                            cellsrenderer: function (row, column, value) {
                                return "<div style='margin:2px;'>" + (value + 1) + "</div>";
                            }
                        },
                        { text: '일련번호', datafield: 'bld_qty_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:70 },
                        { text: '초수', datafield: 'ins_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:120 },
                        { text: '시작일자', datafield: 'st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd},
                        { text: '종료일자', datafield: 'ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center',cellsrenderer : cellYmd },
                        { datafield: 'bld_seq', hidden: true },
                    ]
                });

            $('#gridQty').on('rowdoubleclick', function (event) {
                var getRowData = $('#gridQty').jqxGrid('getrows')[event.args.rowindex];
                bldQty_popup(getRowData['bld_qty_seq']);
            });
       };
    <?php
    }
    ?>
</script>


<?php
include_once ('./sale.tail.php');
?>
