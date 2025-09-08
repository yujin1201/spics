<?php
$sub_menu = "";
include_once('./_common.php');

    $sql = "select
                 ins_seq
                ,bld_seq
                ,ins_code
                ,ins_nm
                ,ins_poi
                ,ins_condi
                ,mda_type
                ,ins_cnt
                ,use_yn
                ,use_st_dt
                ,use_ed_dt
                ,comm_seq
                ,comm_type_cd
                ,etc1
                ,etc2
                ,etc3
                ,bigo
                ,del_yn
                ,entr_prsn
                ,entr_dt
                ,updt_prsn
                ,updt_dt 
                ,ins_ev1
                ,ins_ev2    
                ,ins_ev
                ,ins_ad_yn
                ,ins_div 
          from   tb_bld_ins  a
          where  ins_seq = {$_GET['ins_seq']}   ";
    $ins_info = sql_fetch($sql);

$ins_info['use_st_dt'] = (empty($ins_info['use_st_dt'])) ? G5_TIME_YMD :  date('Y-m-d',strtotime($ins_info['use_st_dt'])) ;
$ins_info['use_ed_dt'] = (empty($ins_info['use_ed_dt'])) ? date( 'Y-m-t' ) :  date('Y-m-d',strtotime($ins_info['use_ed_dt'])) ;

$g5['title'] = "빌딩 기기 관리";

if( !isset($_GET['ins_seq'])  ||   $_GET['ins_seq']  == ""){
    $ins_info['ins_ad_yn'] ="Y" ;
}
include_once(G5_SALE_PATH.'/sale.head.popup.php');
 
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

        /*저장*/
        function fn_bldIns_submit(f){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subForm", "./bld_form_ins_pop_update.php", params, true, fn_subFinCallback  );
        }
        /*삭제*/
        function fn_bldIns_del(){
            if(!confirm("삭제 하시겠습니까? ")){
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subDel", "./bld_form_ins_pop_update.php", params, true, fn_subFinCallback  );
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
        <input type="hidden" name="ins_seq" value="<?php echo $_GET['ins_seq'] ?>">
        <div class="tbl_frm02 tbl_wrap">
            <table>

                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tr>
                    <th scope="row"><label for="ins_nm">기기명 </label></th>
                    <td>
                        <input  id="ins_nm" name="ins_nm"  maxlength="20" class="frm_input w200" value="<?=$ins_info['ins_nm']?>" ></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ins_code">기기 타입 </label></th>
                    <td>
                        <select name="ins_code" id="ins_code" onChange="" class="required">
                            <?print_option_with_select('BBG', $ins_info['ins_code']);?>
                        </select>
                    </td>
                </tr>
                <th scope="row"><label for="bld_level">기기 구분</label></th>
                    <td>
                       <?php print_option_with_radio( "ins_div", 'BBJ', $ins_info['ins_div']);?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ins_cnt">기기수</label></th>
                    <td>
                        <input  id="ins_cnt" name="ins_cnt"  maxlength="20" class="frm_input number w130  " value="<?=$ins_info['ins_cnt']?>" ></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="use_st_dt"> 운영기간</label></th>
                    <td >
                       <input  id="use_st_dt" name="use_st_dt"   maxlength="20"  length="8" class="frm_input ymd " value="<?=$ins_info['use_st_dt']?>"></input>
                       ~
                       <input  id="use_ed_dt" name="use_ed_dt"   maxlength="20"  length="8" class="frm_input ymd " value="<?=$ins_info['use_ed_dt']?>"></input>
                     </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ins_poi">설치위치</label></th>
                    <td>
                        <input  id="ins_poi" name="ins_poi"  maxlength="20" class="frm_input w130" value="<?=$ins_info['ins_poi']?>" ></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="ins_condi">설치상태</label></th>
                    <td>
                        <input  id="ins_condi" name="ins_condi"  maxlength="20" class="frm_input w130" value="<?=$ins_info['ins_condi']?>" ></input>
                    </td>
                </tr>
                <th scope="row"><label for="bld_level">엘리베이터 구분</label></th>
                    <td>
                       <?php print_option_with_radio( "ins_ev", 'BBI', $ins_info['ins_ev']);?>
                    </td>
                </tr>
                <th scope="row"><label for="bld_level">엘리베이터</label></th>
                    <td>
                        내부 :
                        <input type="text" name="ins_ev1" value="<?php echo $ins_info['ins_ev1'] ?>" id="ins_ev1"   class="frm_input " size="20"  maxlength="20" autocomplete="off">
                        외부 :
                        <input type="text" name="ins_ev2" value="<?php echo $ins_info['ins_ev2'] ?>" id="ins_ev2"   class="frm_input " size="20"  maxlength="20" autocomplete="off">

                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="use_yn">기기 광고여부</label></th>
                    <td>
                        <?print_radioYN("ins_ad_yn", $ins_info['ins_ad_yn'], "")  ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="use_yn">사용여부</label></th>
                    <td>
                        <?print_radioYN("use_yn", $ins_info['use_yn'], "")  ?>
                    </td>
                </tr>
                <tr>
                <tr>
                    <th scope="row"><label for="bigo">비고</label></th>
                    <td><textarea name="bigo" id="bigo" style="height:40px " class="wp95"><?echo $ins_info['bigo'] ?></textarea></td>
                </tr> 

                </tbody>
            </table>
        </div>
    </form>
    <div class="" align="center">
            <button  class="btn btn_save btn_lg" onclick="return fn_bldIns_submit(this);">저장</button>
        <?php if( isset($_GET['ins_seq'])  ) {  ?>
            <button  class="btn btn_del btn_lg" onclick="return fn_bldIns_del(this);">삭제</button>
        <?php } ?>
        <button  class="btn btn_close btn_lg" onclick="return self.close();">닫기</button>
    </div>

    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>