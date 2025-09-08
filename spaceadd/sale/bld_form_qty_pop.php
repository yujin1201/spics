<?php
$sub_menu = "";
include_once('./_common.php');

    $sql = "select
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
          from   tb_bld_qty  a
          where  bld_qty_seq = {$_GET['bld_qty_seq']}   ";
    $qty_info = sql_fetch($sql);

$qty_info['st_dt'] = (empty($qty_info['st_dt'])) ? G5_TIME_YMD :  date('Y-m-d',strtotime($qty_info['st_dt'])) ;
$qty_info['ed_dt'] = (empty($qty_info['ed_dt'])) ? date( 'Y-m-t' ) :  date('Y-m-d',strtotime($qty_info['ed_dt'])) ;

$g5['title'] = "빌딩 재원 ";
include_once(G5_SALE_PATH.'/sale.head.popup.php'); 
?>
    <script type="text/javascript">
        jQuery(function($) {
            try{
                $("#st_dt, #ed_dt ").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: "yy-mm-dd",
                    showButtonPanel: true,
                    yearRange: "c-99:c+99"  });
            }catch (e) {
                console.log(e)
            }
        });

        /*저장*/
        function fn_bldqty_submit(f){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subForm", "./bld_form_qty_pop_update.php", params, true, fn_subFinCallback  );
        }
        /*삭제*/
        function fn_bldqty_del(){
            if(!confirm("삭제 하시겠습니까? ")){
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subDel", "./bld_form_qty_pop_update.php", params, true, fn_subFinCallback  );
        }
        function fn_subFinCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                var callbacks = $.Callbacks();
                callbacks.add(eval("opener.fn_refresh"));
                callbacks.fire( <?php echo $_GET['bld_seq'] ?>);
                self.close();
            }catch (e) {
                console.log(e)
            }
        }
    </script>
    <form name="fcomp" id="fcomp"  method="post" onsubmit="return false;"  >
        <input type="hidden" name="bld_seq" value="<?php echo $_GET['bld_seq'] ?>">
        <input type="hidden" name="bld_qty_seq" value="<?php echo $_GET['bld_qty_seq'] ?>">
        <div class="tbl_frm02 tbl_wrap">
            <table> 
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup> 
                <tr>
                    <th scope="row"><label for="ins_sec">초수</label></th>
                    <td>
                        <input  id="ins_sec" name="ins_sec"  maxlength="20" class="frm_input number w130  " value="<?=$qty_info['ins_sec']?>" ></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="st_dt"> 운영기간</label></th>
                    <td >
                       <input  id="st_dt" name="st_dt"   maxlength="20"  length="8" class="frm_input ymd " value="<?=$qty_info['st_dt']?>"></input>
                       ~
                       <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="8" class="frm_input ymd " value="<?=$qty_info['ed_dt']?>"></input>
                     </td>
                </tr>
 <!--               <tr>
                    <th scope="row"><label for="use_yn">사용여부</label></th>
                    <td>
                        <?/*print_radioYN("use_yn", $qty_info['use_yn'], "")  */?>
                    </td>
                </tr>-->
                <tr>
                    <th scope="row"><label for="bigo">비고</label></th>
                    <td><textarea name="bigo" id="bigo" style="height:40px " class="wp95"><?echo $qty_info['bigo'] ?></textarea></td>
                </tr> 
                </tbody>
            </table>
        </div>
    </form>
    <div class="" align="center">
        <?if($member['mb_level'] > 7 || $member['mb_level'] ==  4 ){?>
            <button  class="btn btn_save btn_lg" onclick="return fn_bldqty_submit(this);">저장</button>
            <?php if( isset($_GET['bld_qty_seq'])  ) {  ?>
            <button  class="btn btn_del btn_lg" onclick="return fn_bldqty_del(this);">삭제</button>
            <?php } ?>
        <?php } ?>
        <button  class="btn btn_close btn_lg" onclick="return self.close();">닫기</button>
    </div>
    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>