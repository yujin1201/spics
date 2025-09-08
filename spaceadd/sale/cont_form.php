<?php
$sub_menu = "200110";
include_once('./_common.php');
$g5['title'] = '계약 상세정보';
include_once('./sale.head.php');
include_once('./cont_form_common.php');

$media_html = "" ;
$media_str = "" ;
$media_sum = 0 ;
if( isset($_GET['cont_seq'])){
    //수정모드
    $w = "U";
    $cont = fn_contInfo($_GET['cont_seq'])  ;

    $cont['cont_yearmon'] = date('Y-m',strtotime($cont['cont_yearmon']."01"));
    $cont['cont_st_dt'] =  date('Y-m-d',strtotime($cont['cont_st_dt']));
    $cont['cont_ed_dt'] =  date('Y-m-d',strtotime($cont['cont_ed_dt']));

    $sql_media = "select  
                  a.comm_cd_nm   
                , ifnull(b.mda_amt ,0 )  mda_amt                 
                , ifnull(b.mda_cmms_amt ,0 )  mda_cmms_amt
                , ifnull(b.mda_cost ,0 )  mda_cost
                , b.bigo 
            from tb_code  a  , tb_cont_mdatype b   
            where a.comm_type_cd ='AAB' 
              and a.up_comm_seq is not null 
              and a.comm_cd = b.mda_type_code  
             and b.cont_seq = {$_GET['cont_seq']}   
             order by a.ord  
    ";
     $result_media = sql_query($sql_media);
    $media_html = "<table style='width:60%; border:1px solid #cecdcd'>";
    for ($i=0; $row=sql_fetch_array($result_media); $i++) {
        if($i==0){
            $media_html .= "<tr>"
                ."<th style='width:150px; border:1px solid #cecdcd'>매체</th>"
                ."<th style='width:120px; border:1px solid #cecdcd'>매출</th>"
                ."<th style='width:120px; border:1px solid #cecdcd'>매입</th>"
                ."<th style='width:120px; border:1px solid #cecdcd'>정산금액</th>"
                ."<th style='border:1px solid #cecdcd'>비고</th>"
                ."</tr>";
        }
        $media_html .= "<tr>"
                      ."<td style='width:150px; border:1px solid #cecdcd'>".$row['comm_cd_nm']."</td>"
                      ."<td style='width:120px; text-align:right; border:1px solid #cecdcd'>".number_format($row['mda_amt']) ."원"."</td>"
                      ."<td style='width:120px; text-align:right; border:1px solid #cecdcd'>".number_format($row['mda_cmms_amt']) ."원"."</td>"
                      ."<td style='width:120px; text-align:right; border:1px solid #cecdcd'>".number_format($row['mda_cost']) ."원"."</td>"
                      ."<td style='border:1px solid #cecdcd'>".$row['bigo']."</td>"
                      ."</tr>";
        $media_sum = $media_sum + $row['mda_amt']  ;
        if($i > 0){
            $media_str.=","  ;
        }
        $media_str.= $row['comm_cd_nm'].":".number_format($row['mda_amt']) ."원(".$row['bigo'].")" ;
    }
    $media_html = $media_html."</table>" ;
}else{
    //신규 입력
    $w = "I";
    $cont['cont_yearmon'] = G5_TIME_YM;
    $cont['sale_prsn'] = $member['mb_no'] ;
    $cont['cont_amt'] =  0 ;
    $cont['cont_stat'] =  'BAC01' ;
}

if (empty($cont['cont_yearmon'])) $cont['cont_yearmon'] = G5_TIME_YM;
if (empty($cont['cont_st_dt'])) $cont['cont_st_dt'] = G5_TIME_YMD;
if (empty($cont['cont_ed_dt'])) $cont['cont_ed_dt'] = G5_TIME_YMD;


$editAble_yn ="Y" ;
$mdaAble_yn ="Y" ;
$finAble_yn ="Y" ;

if($member['mb_level']  == 4 ){
    $editAble_yn ="N" ;
    $mdaAble_yn ="N" ;
    $finAble_yn ="N" ;
}
?>
<script type="text/javascript">
    jQuery(function($) {
        $("#cont_yearmon, #c_cont_yearmon" ).datepicker( $.datepicker.yearmon) ;
        $("#cont_yearmon, #c_cont_yearmon").focus(function () {
            $(".ui-datepicker-calendar").css("display","none");
            $("#ui-datepicker-div").position({ my: "center top", at: "center bottom", of: $(this)});
        });

        $("#cont_st_dt, #cont_ed_dt, #c_cont_st_dt, #c_cont_ed_dt, #c_toss_dt , #c_mg_report ").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });

        $("#cont_amt").val(deleteIsNotValidateChar($("#cont_amt").val())) ;
        //작성중, 가확정 일 경우만 상품,정산 등록 가능
        if('<?echo $cont['cont_stat'] ?>'== 'BAC01' || '<?echo $cont['cont_stat'] ?>'== 'BAC02' ){
        }else{
            $(".btn_find").hide() ;
            $(".btn_delIcon").hide() ;
            $(".btn_new").hide() ;
            $("#btnMadAddAll").hide() ;
            $("#btnMadRemove").hide() ;
        }
    });

    //저장
    function fn_cont_submit(f){
        var params = fn_chkForm("fcomp") ;
        if(!params){
            return false ;
        }
        fn_submission("subForm", "./cont_form_update.php", params, true, fn_subCallback  );
    }
    function fn_subCallback(subid, voJson){
        alert("처리 되었습니다.") ;
        if(subid == "subDel"){
            location.href="./cont_list.php";
        }else{
            fn_refresh(voJson.cont_seq) ;
        }
    }

   //계약목록
    function fn_refresh(p_cont_seq){
        location.href="./cont_form.php?cont_seq="+p_cont_seq ;
    }
    /*상태변경*/
    function fn_cont_stat(pStat, pFlag ="U")
    {
        //가확정, 확정 처리할 경우
        /*
       if((pStat =="BAC02" || pStat=="BAC03") && pFlag=="U"){
          var cnt =$('#grid_mda').jqxGrid('getrows');
          if(cnt <= 0 ){
              alert("1개 이상의 상품이 등록되어 있어야 합니다.");
              return false ;
          }
       }
       */
        //확정할때 미디어별 금액 체크
        if(Number($("#cont_amt").val().replaceAll(',','')) > 0  ){
            if( pStat=="BAC03" && pFlag=="U"){
                if(Number($("#cont_amt").val().replaceAll(',','')) != <?php echo $media_sum?>  ){
                    alert("청약금액과 미디어별 금액의 합이 일치해야 합니다.");
                    return false ;
                }
                const finAmt =$("#grid_fin").jqxGrid('getcolumnaggregateddata', 'out_amt', ['sum']);
                if(Number($("#cont_amt").val().replaceAll(',','')) !=  Number(finAmt?.sum||0)){
                    alert("계약 청약금액과 매출 청구 금액이 일치하지 않습니다");
                    return false ;
                }
           }
        }
       if(!confirm("수정하시겠습니까? ")){
           return false ;
       }
        var params  = Object.assign({},  {"sub_stat" : pStat , "subFlag" : pFlag  }, formParams($("#fcomp")));
         params.sale_prsn_nm ="<?php echo $cont['sale_prsn_nm'] ?>"  ;
         params.media_str ="<?php echo $media_str  ?>"  ;
       fn_submission("subStat", "./cont_form_update.php", params, true, fn_subCallback  );
    }
     /*삭제*/
    function fn_cont_del(pStat, pFlag ="U")
    {
        if(!confirm("삭제 하시겠습니까? ")){
            return false ;
        }
        var params  =   formParams($("#fcomp"));
        fn_submission("subDel", "./cont_form_update.php", params, true, fn_subCallback  );
    }
    //출력
    function fn_cont_print(f){
        var chk = $('#grid_mda').jqxGrid('getselectedrowindexes');
        if(chk.length <= 0 ){
            alert("출력할 상품을 선택하십시오. ");
            return false ;
        }
        var cont_mda_seq = "" ;
        var mda_comp_seq = "" ;
        var validChk = true ;

        for (var i = 0; i < chk.length; i++) {
            var data = $('#grid_mda').jqxGrid('getrowdatabyid', chk[i]);
            if(i == 0 ){
                mda_comp_seq = data.mda_comp_seq ;
                cont_mda_seq =data.cont_mda_seq ;
            }else{
                /*
                if(mda_comp_seq != data.mda_comp_seq){
                    validChk = false ;
                    alert("하나의 매체사 상품만 선택하십시오.")
                    return  false ;
                }
                 */
                cont_mda_seq = cont_mda_seq+","+data.cont_mda_seq    ;
            }
        }
        if(validChk){
            var url = "" ;
                url = "cont_form_pop_print_"+$("#print_opt").val()+".php";
            url = url+"?cont_seq=<?php echo $_GET['cont_seq']?>&cont_mda_seq="+cont_mda_seq+"&mda_comp_seq="+mda_comp_seq ;
           $('#ioPrint').attr('src', url);

            // basicPopupOpen(url, "Insertion Order", "1200", "800");
        }
    }

    function fn_cont_copy(){
        try{
            $('.dimm').addClass('on_dimm');
            $('.dimm').css('z-index', '150');
            $('#cont_copy').css('display', 'block');
            $('#cont_copy').css('z-index', '999');
        }catch (e) {
            console.log(e)
        }
    }

    //저장
    function fn_cont_copy_submit(f){
        var params = fn_chkForm("c_fcomp") ;
        if(!params){
            return false ;
        }
        fn_submission("subCopy", "./cont_form_copy.php", params, true,  function (subid, voJson){
            fn_refresh('<?echo $_GET['cont_seq']?>') ;
            window.open("./cont_form.php?cont_seq="+voJson.cont_seq, "_blank") ;
        });
    }

    //미디어금액 등록
    function  fn_cont_media(){
        var url = "./cont_form_pop_mdatype.php?cont_seq=<?echo $_GET['cont_seq']?>"  ;
        basicPopupOpen(url, "계약 매체별 금액", "900", "700")  ;
    }

</script>
<div class="btn_fixed_top">
    <div class="btn_list03">
        <?if(isset($_GET['cont_seq']) &&  $_GET['cont_seq'] != '') {?>
            <select name="print_opt" id="print_opt" onChange="" style="width: 150px">
                <?php print_option_with_select('BAJ', '');?>
            </select>
            <button  class="btn_print" onclick="return fn_cont_print(this);" style="">Insertion Order</button>
        <?}?>
        <a href="./cont_list.php" class="">계약 목록</a>
        <?
        /*
    BAC01	작성중
    BAC02	가확정
    BAC03	확정
    BAC04	정산요청
    BAC05	정산완료
*/
        ?>
     <?if($editAble_yn =="Y"){?>
        <?  if( !isset($_GET['cont_seq']) || $cont['cont_stat'] == "BAC01" || $cont['cont_stat'] == "BAC02"    ) {  ?>
            <button  class="btn_save" onclick="return fn_cont_submit(this);" style="">저장</button>
        <?}?>
        <?php if( isset($_GET['cont_seq']) && $cont['cont_stat'] == "BAC01" ) {  ?>
            <button  class="btn_del" onclick="return fn_cont_del( );">삭제</button>
            <button  class="btn_color01" onclick="return fn_cont_stat('BAC02' );">가확정</button>
        <?}?>
        <?  if(  $cont['cont_stat'] == "BAC02"  ) {  ?>
            <button  class="btn_color03" onclick="return fn_cont_stat('BAC03');">확정</button>
            <button  class="btn_color04" onclick="return fn_cont_stat('BAC02', 'D');">가확정취소</button>
        <?}?>
        <? if($member['mb_level'] !=4 ){ ?>
           <?  if(  $cont['cont_stat'] == "BAC03"  ) {  ?>
             <button  class="btn_color06" onclick="return fn_cont_stat('BAC04');">정산요청</button>
            <?}?>
        <?}?>
          <? if($member['mb_level'] > 7 ){ ?>
             <?  if(  $cont['cont_stat'] == "BAC03"  ) {  ?>
              <button  class="btn_color05" onclick="return fn_cont_stat('BAC03', 'D');">확정취소</button>
            <?}?>
            <? if ($cont['cont_stat'] == "BAC04") { ?>
             <button  class="btn_color09" onclick="return fn_cont_stat('BAC04','D');">정산요청 취소</button>
             <button  class="btn_color07" onclick="return fn_cont_stat('BAC05');">정산완료</button>
            <?}?>
            <?  if(  $cont['cont_stat'] == "BAC05"  ) {  ?>
                <button  class="btn_color08" onclick="return fn_cont_stat('BAC05', 'D');">정산취소</button>
            <?}?>
           <?}?>

        <?php if( isset($_GET['cont_seq'])  ) {  ?>
             <button  class="btn_color12" onclick="return fn_cont_copy();">계약복사</button>
         <?}?>
      <?}?>
    </div>
</div>
<!--계약상세 정보-->
<form name="fcomp" id="fcomp" action="./cont_form_update.php"  method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="token" value="<?php echo get_write_token('online') ?>">

    <div class="tbl_frm01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_3">
                <col>
                <col class="grid_3">
                <col>
                <col class="grid_3">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="cont_nm">계약명</label></th>
                <td colspan="3">
                    <input type="text" name="cont_nm" value="<?php echo $cont['cont_nm'] ?>" id="cont_nm" required class="required frm_input wp100" size="100" placeholder="청구년월_광고주명_브랜드명_대행사명_거래구분_매체명">
                    <? if(empty($cont['cont_seq'] )  ) {?>
                       <span style="color:#5b86b9">(ex) 청구년월_광고주명_브랜드명_대행사명_거래구분_매체명</span>
                    <?}?>
                </td>
                <th scope="row"><label for="cli_seq">계약일련번호</label></th>
                <td>
                    <input type="text" name="cont_seq" id="cont_seq" value="<?php echo $cont['cont_seq'] ?>"  class="frm_input readonly " readonly size="5">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cli_seq">광고주</label></th>
                <td>
                    <? print_comp_search('AAC01', $cont['cli_seq'], $cont['cli_nm'] , '', 'Y', 'Y', 'N') ?>
                </td>
                <th scope="row"><label for="agncy_seq">광고회사 </label></th>
                <td>
                    <? print_comp_search('AAC03', $cont['agncy_seq'], $cont['agncy_nm'] , '', 'Y', 'Y', 'N') ?>
                </td>
                <th scope="row"><label for="rep_seq">2차 대행사 </label></th>
                <td>
                    <? print_comp_search('AAC03', $cont['rep_seq'], $cont['rep_nm'] , '1', 'Y', 'N', 'Y') ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cont_yearmon">계약월 </label></th>
                <td>
                    <input  id="cont_yearmon" name="cont_yearmon"   maxlength="20"  length="6" class="frm_input ym" value="<?echo $cont['cont_yearmon']?>"></input>
                </td>
                <th scope="row"><label for="cont_st_dt">청약기간</label></th>
                <td>
                    <input  id="cont_st_dt" name="cont_st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_st_dt']?>"></input>
                    ~
                    <input  id="cont_ed_dt" name="cont_ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_ed_dt']?>"></input>
                </td>
                <th scope="row"><label for="cont_amt">청약금액(매출액)</label></th>
                <td>
                    <input  id="cont_amt" name="cont_amt"  maxlength="20" class="frm_input number w130" value="<?=$cont['cont_amt']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cont_type_code">계약구분</label></th>
                <td>
                    <select name="cont_type_code" id="cont_type_code" onChange="" style="width: 150px">
                        <?php print_option_with_select('BAB', $cont['cont_type_code']);?>
                    </select>
                </td>
                <th scope="row"><label for="deal_type_code">거래구분 </label></th>
                <td >
                    <select name="deal_type_code" id="deal_type_code" onChange="" style="width: 150px">
                        <?php print_option_with_select('BAG', $cont['deal_type_code']);?>
                    </select>
                </td>
                <th scope="row"><label for="cont_sale_type">판매방식 </label></th>
                <td>
                    <select name="cont_sale_type" id="cont_sale_type" onChange="">
                        <?php print_option_with_select('BAK', $cont['cont_sale_type']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="tel_no">담당자</label></th>
                <td>
                    <select name="sale_prsn" id="sale_prsn" onChange="" style="width: 200px" >
                        <?php print_option_member($cont['sale_prsn'], '1') ?>
                    </select>
                </td>
                <th scope="row"><label for="brnd_nm">캠페인 명 </label></th>
                <td>
                    <input type="text" name="campgn_nm" value="<?php echo $cont['campgn_nm'] ?>" id="campgn_nm"   class="required frm_input wp90" size="50"   >
                </td>
                <th scope="row"><label for="brnd_nm">브랜드명 </label></th>
                <td>
                    <input type="text" name="brnd_nm" value="<?php echo $cont['brnd_nm'] ?>" id="brnd_nm"   class="required frm_input wp90" size="50"   >
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="cont_stat">계약상태</label></th>
                <td   <?php if(empty($cont['cont_seq'] ) ) { ?>colspan="5" <?}?>>
                    <select name="cont_stat" id="cont_stat" onChange="" style="width: 150px" disabled>
                        <?php print_option_with_select('BAC', $cont['cont_stat']);?>
                    </select>
                </td>
                <?php
                if(!empty($cont['cont_seq'] )  ) {
                ?>
                <th scope="row"><label>등록자 / 등록일</label></th>
                <td><?=$cont['entr_prsn_nm']?> / <?=$cont['entr_dt']?></td>
                <th scope="row"><label>수정자 / 수정일</label></th>
                <td><?=$cont['updt_prsn_nm']?> / <?=$cont['updt_dt']?> </td>
                <?
                }
                ?>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="5"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"><?php echo str_replace('rn',"\r\n",$cont['bigo']) ?></textarea></td>
            </tr>
            <?if( isset($_GET['cont_seq'])){?>
            <tr>
                <th scope="row"><label>매체별 금액</label> </th>
                <td colspan="5">
                    <button  type="button"  class="btn_color11" style="padding:5px 10px; border:0px" onclick="return fn_cont_media();">
                        <?  if( !isset($_GET['cont_seq']) || $cont['cont_stat'] == "BAC01" || $cont['cont_stat'] == "BAC02"    ) {  ?>
                        등록/수정
                        <?}else{?>
                            상세보기
                        <?}?>
                    </button>
                    <?php echo $media_html ;?>
                </td>
            </tr>
            <?}?>
            </tbody>
        </table>
    </div>
</form>

    <!--계약상세 정보-->
<?php
if(!empty($cont['cont_seq'] )  ) {
?> 
            <!--계약상품 상세-->
            <?php
            include_once('./cont_form_mda.php');
            ?>
            <!--계약 청구 -->
            <?php
            include_once('./cont_form_fin.php');
            ?>

            <!--계약 빌딩 -->
            <?php
            include_once('./cont_form_bld.php');
            ?>
    <?php
    }
?>
<?php
include_once ('./sale.tail.php');
?>

<!-- dimm 처리 -->
<div class="dimm"><i class="hide"></i></div>
<?php
if(!empty($cont['cont_seq'] )  ) {
    ?>
    <form name="c_fcomp" id="c_fcomp" action="./cont_form_copy.php"  method="post">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="token" value="<?php echo get_write_token('online') ?>">
        <input type="hidden" name="cont_seq" id="cont_seq" value="<?php echo $cont['cont_seq'] ?>"  class="frm_input readonly " readonly size="5">
        <div id="cont_copy"  class="tbl_frm01 tbl_wrap header_layer" style="display:none">
            <table>
                <colgroup>
                    <col class="grid_3">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th scope="row"><label for="cont_yearmon">계약월 </label></th>
                    <td>
                        <input  id="c_cont_yearmon" name="c_cont_yearmon"   maxlength="20"  length="6" class="frm_input ym" value="<?echo $cont['cont_yearmon']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label >청약기간</label></th>
                    <td>
                        <input  id="c_cont_st_dt" name="c_cont_st_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_st_dt']?>"></input>
                        ~
                        <input  id="c_cont_ed_dt" name="c_cont_ed_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_ed_dt']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="report_yn">게첨보고서</label></th>
                    <td>
                        <span style="padding-right:10px">
                            <? print_radioYN("c_report_yn","Y", "")  ?>
                        </span>
                        <input  id="c_toss_dt" name="c_toss_dt"   maxlength="20"  length="6" class="frm_input ymd" value="<?=$cont['cont_st_dt']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="mg_report_yn">관리보고서</label></th>
                    <td>
                        <span style="padding-right:10px">
                            <? print_radioYN("c_mg_report_yn", "Y", "")  ?>
                        </span>
                        <input  id="c_mg_report" name="c_mg_report"   maxlength="20"  length="6" class="frm_input ymd " value="<?=$cont['cont_st_dt']?>"></input>
                    </td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" class="btn_list03" style="text-align:center"> <button  class="btn_save" onclick="return fn_cont_copy_submit(this);" style="">계약 복사</button> </th>
                </tr>
                </tbody>
            </table>
        </div>
    </form>
    <?php
}
?>

<iframe id="ioPrint" id="ioPrint" title=" " width="1" height="1" src=""></iframe>
