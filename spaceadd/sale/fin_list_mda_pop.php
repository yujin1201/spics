<?php
$sub_menu = "";
include_once('./_common.php');

if(isset($_GET['mda_fin_seq']) &&  $_GET['mda_fin_seq'] != '') {
    $sql = "select   
          a.comp_seq
        , a.comp_nm
        , a.busi_nm
        , a.busi_no
        , b.mda_seq
        , b.mda_nm
        , b.mda_cnt 
        , c.mda_fin_seq
        , c.prod_seq
        , c.adj_type
        , ifnull((select comm_cd_nm from tb_code where comm_cd = c.adj_type),'')  adj_type_nm
        , c.adj_yearmon
        , c.sell_amt
        , c.adj_yn
        , c.adj_dt
        , c.adj_num
        , c.bill_dt
        , c.bill_yn
        , c.bill_rsv
        , c.bill_snd   
        , c.send_dt
        , c.out_dt 
        , c.stl_condi_code 
        , c.stl_condi_cntnts
        , c.tret_yn        
        , ifnull(c.cont_seq,'')  cont_seq
        , ifnull(c.cont_mda_seq,'')  cont_mda_seq
        , ifnull(c.cont_amt, 0)  cont_amt
        , ifnull(c.cont_cmms_rt, 0 )  cont_cmms_rt
        , ifnull(c.rsv_comp_seq,'')  rsv_comp_seq
        , ifnull(c.snd_comp_seq,'')  snd_comp_seq 
        , ifnull(c.bigo ,'')  bigo
        , ifnull((select mb_name from g5_member where mb_no = c.entr_prsn ),'')  entr_prsn_nm 
        , date_format( c.entr_dt , '%Y-%m-%d %H:%i' ) entr_dt
        , ifnull((select mb_name from g5_member where mb_no =  c.updt_prsn ),'')  updt_prsn_nm 
        , date_format( c.updt_dt , '%Y-%m-%d %H:%i' ) updt_dt
        , ifnull(d.cont_nm,'') cont_nm
        , ifnull(d.cli_seq,'') cli_seq
        , ifnull((select comp_nm from tb_comp where comp_seq = d.cli_seq),'')  cli_nm 
        ,ifnull(d.agncy_seq,'') agncy_seq
        ,ifnull((select comp_nm from tb_comp where comp_seq = d.agncy_seq),'')  agncy_nm   
        , e.m1
        , e.full_nm 
    From tb_comp a, tb_comp_mda b , vi_media e,  tb_mda_fin c
      left outer join tb_cont d on c.cont_seq = d.cont_seq
    where a.comp_seq = b.comp_seq
      and b.prod_seq = c.prod_seq   
         and b.mda_seq = e.mda_seq
         and c.mda_fin_seq = {$_GET['mda_fin_seq']}    
         and b.del_yn ='N'  
         and c.del_yn='N' 
     ";
    $mda_fin = sql_fetch($sql);
}else{
    $mda_fin['adj_yearmon'] = date("Ym");
    $mda_fin['bill_dt'] = date("Ymt");
    $mda_fin['send_dt'] = date("Ymt");
    $mda_fin['adj_dt'] = date("Ymt");
    $mda_fin['out_dt'] = date("Ymt");
}
$mda_fin['adj_yearmon'] = date('Y-m',strtotime($mda_fin['adj_yearmon']."01"));
$mda_fin['bill_dt'] =  date('Y-m-d',strtotime($mda_fin['bill_dt']));
$mda_fin['send_dt'] =  date('Y-m-d',strtotime($mda_fin['send_dt']));
$mda_fin['adj_dt'] =  date('Y-m-d',strtotime($mda_fin['adj_dt']));
$mda_fin['out_dt'] =  date('Y-m-d',strtotime($mda_fin['out_dt']));

if(isset($_GET['mda_fin_seq']) &&  $_GET['mda_fin_seq'] != '') {
   $g5['title'] = "매체청구 상세";
}else{
   $g5['title'] = "매체청구 신규등록";
}
include_once(G5_SALE_PATH.'/sale.head.popup.php');
?>
    <script type="text/javascript">
        var source = {} ;
        jQuery(function($) {
          <? if(isset($_GET['mda_fin_seq']) &&  $_GET['mda_fin_seq'] != '')  {?>
            /*$("#adj_type, #adj_yearmon").attr("disabled", true); //설정*/
            $("#adj_type").attr("disabled", true); //설정
            $("#btn_comp_seq_find").hide() ;
          <?}?>
          <?if( $mda_fin['cont_mda_seq'] != '' ) {  ?>
            $("#cont_seq").attr("disabled", true);
          <?}?>

            $("#adj_yearmon" ).datepicker( $.datepicker.yearmon )  ;
            $("#adj_yearmon").focus(function () {
                $(".ui-datepicker-calendar").css("display","none");
                $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
            });

            $('#adj_yearmon').datepicker({
                onChangeMonthYear: function(dateString) {
                   // console.log(dateString);
                }
            });

            $("#bill_dt, #send_dt, #adj_dt, #out_dt").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
                showButtonPanel: true,
                yearRange: "c-99:c+99"  });

            $("#cont_amt").val(deleteIsNotValidateChar($("#cont_amt").val()))  ;
            $("#sell_amt").val(deleteIsNotValidateChar($("#sell_amt").val()))  ;

            source =
                {
                    datatype: "json",
                    datafields: [
                        { name : 'prod_seq'},
                        { name : 'mda_seq'},
                        { name : 'comp_seq'},
                        { name : 'mda_nm'},
                        { name : 'mda_cnt', type: 'number'},
                        { name : 'use_st_dt'},
                        { name : 'use_ed_dt'},
                        { name : 'use_st_time'},
                        { name : 'use_ed_time'},
                        { name : 'asg_use_yn'},
                        { name : 'mda_position'},
                        { name : 'mda_amt', type: 'number'},
                        { name : 'ins_cnt', type: 'number'},
                        { name : 'full_nm'} ,
                        { name : 'comp_nm'} ,
                        { name : 'm1_nm'} ,
                        { name : 'm1'} ,
                    ],
                    url: g_sale_url+'/cont_form_pop_mda_mdalist.php',
                    cache: false,
                    data:{
                        comp_seq:' '
                    }
                };
            var adapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapter,
                    columnsresize: true,
                    filterable: false,
                    sortable: false,
                    showstatusbar: false,
                    statusbarheight: 27,
                    showaggregates: false,
                    selectionmode: 'checkbox',
                    altrows: true,
                    autoshowfiltericon: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    columns: [
                        { text: '매체사', datafield: 'comp_nm',  cellsalign: 'left', align: 'center'  ,width:150}
                        ,{text: '상품명',datafield: 'mda_nm',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 150}
                        ,{text: '구분',datafield: 'm1_nm',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 150}
                        ,{text: '구좌수',datafield: 'mda_cnt',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70,  }
                        ,{ text: '단가', datafield: 'mda_amt', cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' }
                        ,{ text: '기기수', datafield: 'ins_cnt', cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' }
                        ,{text: '재원사용 여부',datafield: 'asg_use_yn',cellsalign: 'center',align: 'center',cellsformat: 'd' }
                        ,{datafield: 'prod_seq', hidden: true}
                        ,{datafield: 'm1', hidden: true}
                    ]
                });
            $("#grid").on("bindingcomplete", function (event) {
                $(".jqx-checkbox-default:first").hide();
                $('#grid').jqxGrid('clearselection');
            });
            $("#grid").on('rowselect', function (event){
                $("#mda_seq").val(event.args.row.mda_seq)  ;
                $("#prod_seq").val(event.args.row.prod_seq)  ;
                $("#m1").val(event.args.row.m1)  ;

                var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
                $.each(rowindexes, function (ff, k){
                    if(k != event.args.rowindex  ){
                        $('#grid').jqxGrid('unselectrow',k);
                    }
                }) ;
            });
        });

        /*저장*/
        function fn_mdaFin_submit(f){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            <?if( !isset($_GET['mda_fin_seq'])  ) {?>
            if($('#grid').jqxGrid('getselectedrowindexes').length == 0  ) {   //광고료
                alert("상품을 선택하십시오 ")  ;
                return false ;
            }
            <?}?>
            fn_submission("subForm", "./fin_list_mda_pop_update.php", params, true, fn_subFinCallback  );
        }
        /*삭제*/
        function fn_mdaFin_del(){
            if(!confirm("삭제 하시겠습니까? ")){
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subDel", "./fin_list_mda_pop_update.php", params, true, fn_subFinCallback  );
        }
        function fn_subFinCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                var callbacks = $.Callbacks();
                callbacks.add(eval("opener.fn_refresh"));
                callbacks.fire();
                self.close();
            }catch (e) {
                console.log(e)
            }
        }

        function fn_commSetCompPopCallback(voJson){
            if((voJson.com_id ?? "") ==""){
                $("#mda_seq").val('')  ;
                $("#prod_seq").val('')  ;
                $("#m1").val('')  ;
                $("#grid").jqxGrid('clear');
                source.data = voJson;
                $("#grid").jqxGrid("updatebounddata", "cells");
            }
        }

        //미디어금액 등록
        function  fn_cont_media(){
            var url = "./cont_form_pop_mdatype.php?cont_seq=<?echo  $mda_fin['cont_seq']?>"  ;
            basicPopupOpen(url, "계약 매체별 금액", "900", "700")  ;
        }

        function fn_yearmonChange(str){
            var _dt  =   fn_getLastDay($("#adj_yearmon").val(),"-"  );
            $("#bill_dt").val(_dt)  ;
            $("#adj_dt").val(_dt)  ;
            $("#out_dt").val(_dt)  ;
        }
    </script>
 <form name="fcomp" id="fcomp"  method="post" onsubmit="return false;"  >
    <input type="hidden" name="mda_fin_seq" id="mda_fin_seq"  value="<?php echo $mda_fin['mda_fin_seq'] ?>">
    <input type="hidden" name="cont_mda_seq" id="cont_mda_seq" value="<?php echo $mda_fin['cont_mda_seq'] ?>">
    <input type="hidden" name="prod_seq" id="prod_seq"  value="<?php echo $mda_fin['prod_seq'] ?>">
    <input type="hidden" name="mda_seq" id="mda_seq" value="<?php echo $mda_fin['mda_seq'] ?>">
    <input type="hidden" name="m1" id="m1" value="<?php echo $mda_fin['m1'] ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>
     <?if(  $mda_fin['cont_seq'] !="") {?>
     <div class="">
         <div class="btn_list03">
             <button  class="btn_color01" id="btnContMdatype"  style="" onclick="fn_cont_media()">계약 매체별 금액 정보</button>
         </div>
     </div>
     <?}?>
    <div class=" tbl_frm02 tbl_wrap" >
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_3">
                <col>
                <col class="grid_3">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="adj_type">청구 구분 </label></th>
                <td>
                    <select name="adj_type" id="adj_type" onChange="">
                        <?print_option_with_select('AAE', $mda_fin['adj_type']);?>
                    </select>
                </td>
                <th scope="row"><label for="adj_yearmon">청구 년월 </label></th>
                <td>
                    <input  id="adj_yearmon" name="adj_yearmon"   maxlength="20"  length="6" class="frm_input ym" value="<?echo $mda_fin['adj_yearmon']?>"  ></input>
                </td>
            </tr>
            <tr>
                <th scope="row" > <label for="excpt_cnt">매체사</label> </th>
                <td>
                    <? print_comp_search('AAC02', $mda_fin['comp_seq'], $mda_fin['comp_nm']."  [". $mda_fin['busi_nm']."]" , '', 'Y', 'Y', 'N') ?>
                </td>
                <? if(isset($_GET['mda_fin_seq']) &&  $_GET['mda_fin_seq'] != '')  {?>
                <th scope="row"><label for="">상품명 </label></th>
                <td>
                    <? echo $mda_fin['full_nm']?>
                </td>
                 <?}?>
            </tr>
            <?if(  isset($_GET['mda_fin_seq'])   ) {?>
            <tr>
                <th scope="row" > <label for="">매체사 사업자명</label> </th>
                <td  > <? echo $mda_fin['busi_nm']?></td>
                <th scope="row" > <label for="">매체사 사업자번호</label> </th>
                <td  > <? echo $mda_fin['busi_no']?></td>
            </tr>
            <? }?>
          <?if(  $mda_fin['cont_seq'] !="") {?>

            <tr class="cont_info">
                <th scope="row"><label for="">계약명 </label></th>
                <td colspan="3">
                    <? echo $mda_fin['cont_nm']?> (광고주 : <? echo $mda_fin['cli_nm']?>, 광고회사 : <? echo $mda_fin['agncy_nm']?> )
                </td>
            </tr>
          <? }?>
          <?if( !isset($_GET['mda_fin_seq'])  ) {?>
            <tr>
                <th scope="row"><label for="mda_seq">상품</label></th>
                <td colspan="3">
                    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:150px;">
                        <div id="grid"  style="width: 100%; height: 100%;"></div>
                    </div>
                </td>
            </tr>
          <?}?>
            <tr>
                <th scope="row"><label for="">계약일련번호 </label></th>
                <td colspan="3">
                    <input  id="cont_seq" name="cont_seq"  maxlength="20" class="frm_input w130" value="<?=$mda_fin['cont_seq']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cont_cmms_rt">매입액</label></th>
                <td>
                    <input  id="sell_amt" name="sell_amt"  maxlength="20" class="frm_input number required w130"  value="<?=$mda_fin['sell_amt']?>" ></input>
                </td>
                <th scope="row"> <label for="sell_amt" class="cont_info">매출액</label> </th>
                <td>
                    <input  id="cont_amt" name="cont_amt"  maxlength="20" class="frm_input number w130 cont_info" value="<?=$mda_fin['cont_amt']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bill_snd">세금계산서 발행처</label></th>
                <td >
                    <? print_comp_all_search('snd_comp_seq', $mda_fin['snd_comp_seq'], $mda_fin['snd_comp_seq_nm'], '' , '', 'Y', 'Y', 'N') ?>
                </td>
                <th scope="row"><label for="rsv_comp_seq">세금계산서 수신처</label></th>
                <td >
                    <? print_comp_all_search('rsv_comp_seq', $mda_fin['rsv_comp_seq'], $mda_fin['rsv_comp_seq_nm'], '' , '', 'Y', 'Y', 'N') ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="comp_seq">결제조건 </label></th>
                <td>
                    <select name="stl_condi_code" id="stl_condi_code" onChange="">
                        <option value="">선택<?print_option_with_select('BAD', $mda_fin['stl_condi_code']);?>
                    </select>
                </td>
                <th scope="row"><label for="stl_condi_cntnts">결제조건 기타</label></th>
                <td>
                    <input type="text" id="stl_condi_cntnts" name="stl_condi_cntnts" value="<?php echo $mda_fin['stl_condi_cntnts'] ?>"  class="frm_input w200"   >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="out_dt">출금일</label></th>
                <td colspan="3">
                    <input  id="out_dt" name="out_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$mda_fin['out_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"> <?php echo $mda_fin['bigo'] ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="bill_yn">세금계산서 발행여부</label></th>
                <td>
                    <? print_radioYN("bill_yn", $mda_fin['bill_yn'], "")  ?>
                </td>
                <th scope="row"><label for="bill_dt">세금계산서 발행일</label></th>
                <td>
                    <input  id="bill_dt" name="bill_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?=$mda_fin['bill_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="adj_yn">정산완료 여부</label></th>
                <td colspan="3">
                    <? print_radioYN("adj_yn", $mda_fin['adj_yn'], "")  ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="adj_dt">정산일</label></th>
                <td>
                    <input  id="adj_dt" name="adj_dt"   maxlength="20"  length="6" class="frm_input ymd  "  value="<?=$mda_fin['adj_dt']?>"></input>
                </td>
                <th scope="row"><label for="adj_num">정산 번호</label></th>
                <td>
                    <input  id="adj_num" name="adj_num"   maxlength="20"  length="6" class="frm_input w200  " value="<?=$mda_fin['adj_num']?>" disabled></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="tret_yn">상계여부</label></th>
                <td colspan="3">
                    <? print_radioYN("tret_yn", $mda_fin['tret_yn'], "")  ?>
                </td>
            </tr>
            <?php if(isset($_GET['mda_fin_seq']) &&  $_GET['mda_fin_seq'] != '') { ?>
            <tr>
                <th scope="row"><label>등록자 / 등록일</label></th>
                <td><?=$mda_fin['entr_prsn_nm']?> / <?=$mda_fin['entr_dt']?></td>
                <th scope="row"><label>수정자 / 수정일</label></th>
                <td><?=$mda_fin['updt_prsn_nm']?> / <?=$mda_fin['updt_dt']?> </td>
            </tr>
           <?}?>
            </tbody>
        </table>
    </div>
 </form>
    <div class="" align="center">
       <? //영업사원 이하 수정불가 ?>
      <?  if($member['mb_level'] > 7){ ?>
        <button  class="btn btn_save btn_lg" onclick="return fn_mdaFin_submit(this);">저장</button>
        <?  if( $_GET['mda_fin_seq'] != '' ) {  ?>
            <button  class="btn btn_del btn_lg" onclick="return fn_mdaFin_del(this);">삭제</button>
        <?}?>
      <?}?>
        <button  class="btn btn_close btn_lg" onclick="return self.close();">닫기</button>
    </div>
</body>
</html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>