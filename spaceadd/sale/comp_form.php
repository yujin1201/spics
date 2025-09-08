<?php
$sub_menu = "100310";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '광고주 등록';
include_once('./sale.head.php');


$sound_only = '<strong class="sound_only">필수</strong>';
add_javascript('<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>', 0);


if(isset($_GET['w']) && isset($_GET['comp_seq'])){
    //수정모드
    $w = "U";

    $sql = "select *,FN_MB_NM(entr_prsn) as entr_prsn,FN_MB_NM(updt_prsn) as updt_prsn from tb_comp where comp_seq='{$_GET['comp_seq']}'";
    $comp = sql_fetch($sql);

}else{
    //신규 입력
    $w = "I";
}

if (empty($comp['deal_ocur_dt']) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $comp['deal_ocur_dt']) ) $comp['deal_ocur_dt'] = G5_TIME_YMD;


?>
<script type="text/javascript">
    jQuery(function($) {


        $("#deal_ocur_dt").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "yy-mm-dd",
            showButtonPanel: true,
            yearRange: "c-99:c+99"  });
    });
</script>
<form name="fcomp" id="fcomp" action="./comp_form_update.php" onsubmit="return fcomp_submit(this);" method="post">
    <input type="hidden" name="w" id="w" value="<?php echo $w ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>

    <div class="btn_fixed_top">
        <div class="btn_list03">
            <!-- <a href="./cont_list.php?cli_seq=<?=$comp['comp_seq']?>&cli_nm=<?=$comp['comp_nm']?>" class="">계약 목록</a> -->
                <a href="./comp_list.php" class="">광고주 관리</a>
            <? if($member['mb_level'] > 6){ ?>
                <!-- button  class="btn_save" onclick="return fcomp_submit(this);" style="">저장</button -->
                <button  class="btn_save" style="">저장</button>
                <button  type="button" class="btn_del" onclick="return fcomp_del_submit(this);">삭제</button>
            <?} ?>
        </div>
    </div>
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
                <th scope="row"><label for="comp_nm">광고주명<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="comp_nm" value="<?php echo $comp['comp_nm'] ?>" id="comp_nm" required class="required frm_input " size="20"  maxlength="20" autocomplete="off">
                </td>
                <th scope="row"><label for="comp_seq">광고주코드 </label></th>
                <td><input type="text" name="comp_seq" id="comp_seq"  class="frm_input readonly"  value="<?php echo $comp['comp_seq'] ?>" size="20" maxlength="20" autocomplete="off" readonly></td>
            </tr>
            <tr>
                <th scope="row"><label for="busi_no">사업자번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="busi_no" value="<?php echo $comp['busi_no'] ?>" id="busi_no" required class="required frm_input bizno" size="15"  autocomplete="off" maxlength="12"></td>
                <th scope="row"><label for="corp_no">법인번호</label></th>
                <td><input type="text" name="corp_no" value="<?php echo $comp['corp_no'] ?>" id="corp_no" class="frm_input bizno" size="15"  autocomplete="off" maxlength="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="rep_nm1">대표자 1<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="rep_nm1" value="<?php echo $comp['rep_nm1'] ?>" id="rep_nm1" maxlength="15" required class="required frm_input " autocomplete="off" size="30"></td>
                <th scope="row"><label for="rep_nm2">대표자 2</label></th>
                <td><input type="text" name="rep_nm2" value="<?php echo $comp['rep_nm2'] ?>" id="rep_nm2" class="frm_input" maxlength="255" size="15" autocomplete="off"</td>
            </tr>
            <tr>
                <th scope="row"><label for="tel_no">전화번호</label></th>
                <td><input type="text" name="tel_no" value="<?php echo $comp['tel_no'] ?>" id="tel_no" class="frm_input telno" size="15" maxlength="13" autocomplete="off"></td>
                <th scope="row"><label for="fax_no">FAX번호</label></th>
                <td><input type="text" name="fax_no" value="<?php echo $comp['fax_no'] ?>" id="fax_no" class="frm_input telno" size="15" maxlength="13" autocomplete="off"></td>
            </tr>
            <tr>
                <th scope="row">주 소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호<strong class="sound_only">필수</strong></label>
                    <input type="text" name="zipcode" value="<?php echo $comp['zipcode']; ?>" id="zipcode" class="required frm_input readonly" size="5" maxlength="6" autocomplete="off" required readonly>
                    <button type="button" class="btn_frmline" onclick="win_zip('fcomp', 'zipcode', 'addr1', 'addr3', 'addr2', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="addr1" value="<?php echo $comp['addr1'] ?>" id="addr1" class="required frm_input readonly" size="60" readonly autocomplete="off" required>
                    <label for="mb_addr1"> </label> <input type="text" name="addr2" value="<?php echo $comp['addr2'] ?>" id="addr2" class="frm_input readonly" size="60" readonly autocomplete="off">
                    <label for="mb_addr3">상세주소</label> <input type="text" name="addr3" value="<?php echo $comp['addr3'] ?>" id="addr3" class="frm_input" size="60" autocomplete="off" >

                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $comp['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>

            <tr>
                <!--
                <th scope="row"><label for="bill_type">결제조건<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="bill_type" id="bill_type" class="required" onChange="" required>
                        <option value="">결제조건 선택<?print_option_with_select('BAD', $comp['bill_type']);?>
                    </select>
                </td>
                -->
                <th scope="row"><label for="deal_sts_code">거래상태</label></th>
                <td  colspan="3">
                    <select name="deal_sts_code" id="deal_sts_code" class="required" onChange="" required>
                        <option value="">거래상태 선택<?print_option_with_select('BAA', $comp['deal_sts_code']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="rep_indst_div">업종구분<strong class="sound_only">필수</strong></label></th>
                <td >
                    <select name="rep_indst_div" id="rep_indst_div" class="required" onChange="" required>
                        <option value="">업종구분 선택<?print_option_with_select('CAA', $comp['rep_indst_div']);?>
                    </select>
                </td>
                <th scope="row"><label for="excpt_div"><!--업종 2--></label></th>
                <td>
                    <!--
                    <select name="excpt_div" id="excpt_div" class="required" onChange="" required>
                        <option value="">업종2 선택<?/*print_option_with_select('AAD', $comp['excpt_div']);*/?>
                    </select>
                    -->
                </td>

            </tr>
            <tr>
                <th scope="row"><label for="chrg_nm">브랜드</label></th>
                <td colspan="3">
                    <label for="brand_1">브랜드 1</label>
                    <input type="text" name="brand_1" value="<?php echo $comp['brand_1'] ?>" id="brand_1" maxlength="15" class="frm_input" size="30" autocomplete="off">
                    <label for="brand_2">브랜드 2</label>
                    <input type="text" name="brand_2" value="<?php echo $comp['brand_2'] ?>" id="brand_2" maxlength="15" class="frm_input" size="30" autocomplete="off">
                    <label for="brand_3">브랜드 3</label>
                    <input type="text" name="brand_3" value="<?php echo $comp['brand_3'] ?>" id="brand_3" maxlength="15" class="frm_input" size="30" autocomplete="off">
                    <label for="brand_4">브랜드 4</label>
                    <input type="text" name="brand_4" value="<?php echo $comp['brand_4'] ?>" id="brand_4" maxlength="15" class="frm_input" size="30" autocomplete="off">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="chrg_nm">직책자</label></th>
                <td colspan="3">
                    <label for="chrg_nm">이름</label>
                    <input type="text" name="chrg_nm" value="<?php echo $comp['chrg_nm'] ?>" id="chrg_nm" maxlength="15" class="frm_input" size="30" autocomplete="off">
                    <label for="chrg_no">연락처</label>
                    <input type="text" name="chrg_no" value="<?php echo $comp['chrg_no'] ?>" id="CHRG_NO" maxlength="13" class="frm_input telno" size="30" autocomplete="off">
                    <label for="chrg_email">E-Mail</label>
                    <input type="text" name="chrg_email" value="<?php echo $comp['chrg_email'] ?>" id="chrg_email" maxlength="30" class="frm_input email" size="30" autocomplete="off">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="psrn_nm">실무자</label></th>
                <td colspan="3">
                    <label for="psrn_nm">이름</label>
                    <input type="text" name="psrn_nm" value="<?php echo $comp['psrn_nm'] ?>" id="psrn_nm" maxlength="15" class="frm_input required" size="30" autocomplete="off" required>
                    <label for="psrn_no">연락처</label>
                    <input type="text" name="psrn_no" value="<?php echo $comp['psrn_no'] ?>" id="psrn_no" maxlength="13" class="frm_input telno" size="30" autocomplete="off">
                    <label for="psrn_email">E-Mail</label>
                    <input type="text" name="psrn_email" value="<?php echo $comp['psrn_email'] ?>" id="psrn_email" maxlength="30" class="frm_input email" size="30" autocomplete="off">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="fin_nm">재무담당</label></th>
                <td colspan="3">
                    <label for="fin_nm">이름</label>
                    <input type="text" name="fin_nm" value="<?php echo $comp['fin_nm'] ?>" id="fin_nm" maxlength="15"  class="frm_input" size="30" autocomplete="off">
                    <label for="fin_no">연락처</label>
                    <input type="text" name="fin_no" value="<?php echo $comp['fin_no'] ?>" id="fin_no" maxlength="13"  class="frm_input telno"  size="30" autocomplete="off">
                    <label for="fin_email">E-Mail</label>
                    <input type="text" name="fin_email" value="<?php echo $comp['fin_email'] ?>" id="fin_email" maxlength="30"  class="frm_input email" size="30" autocomplete="off">
                </td>
            </tr>            
            <tr>
                <th scope="row"><label for="bigo">비 고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" autocomplete="off"><?php echo $comp['bigo'] ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="psrn_nm">등록정보</label></th>
                <td >
                    <input type="text" name="entr_prsn" value="<?php echo $comp['entr_prsn'] ?>" id="entr_prsn" maxlength="15" class="frm_input readonly" size="30" autocomplete="off" readonly>
                    <input type="text" name="entr_dt" value="<?php echo $comp['entr_dt'] ?>" id="entr_dt" maxlength="15" class="frm_input readonly" size="30" autocomplete="off" readonly>
                </td>
                <th scope="row"><label for="psrn_nm">수정정보</label></th>
                <td >
                    <input type="text" name="updt_prsn" value="<?php echo $comp['updt_prsn'] ?>" id="updt_prsn" maxlength="15" class="frm_input readonly" size="30" autocomplete="off" readonly>
                    <input type="text" name="updt_dt" value="<?php echo $comp['updt_dt'] ?>" id="updt_dt" maxlength="15" class="frm_input readonly" size="30" autocomplete="off" readonly>
                </td>
            </tr>


            </tbody>
        </table>
    </div>

    <?php
    if($w == "U"){
    ?>
    <div class="tbl_frm01 tbl_wrap">
        <div class="" style="margin-top: 15px" >
            <div class="subTlt"  >
                광고주 소재
            </div>
            <div class="btn_list03">
                <? if($member['mb_level'] > 4){ ?>
                    <button type="button" class="btn_new" onclick="mtrl_popup('');">신규 소재</button>
                <?} ?>

            </div>
        </div>
		<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 200px;"> 
		    <div id="grid"  style="width: 100%; height: 100%;">
		</div>
    </div>
    <?php
    }
    ?>
    <?php
    if($w == "U"){
        include_once('./inc_comp_file.php');
    }
    ?>

</form>

<script>
    <?php
    if($w == "U"){
    ?>
    mtrl_grid_load();

    function mtrl_reload(){
        mtrl_grid_load();
    }
    function mtrl_popup(mtrl_seq){
        var pram ="";
        if(mtrl_seq !=''){
            pram = "&mtrl_seq="+mtrl_seq;
        }
        var new_win = window.open("mtrl_form_pop.php?comp_seq=<?=$comp['comp_seq']?>"+pram, 'win_profile', 'left=100,top=100,width=1250,height=480,scrollbars=no, status=no');
        new_win.focus();
    }

    function mtrl_grid_load(){

        $("#grid").jqxGrid('clear');

        //var data = generatedata(500);
        //var exampleTheme = theme;

        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'mtrl_seq'},
                    { name: 'mtrl_nm'},
                    { name: 'mtrl_sec'},
                    { name: 'prod_type'},
                    { name: 'prod_type_nm'},
                    { name: 'use_yn'},
                    { name: 'bigo'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'}

                ],
                url: './mtrl_list_result.php',
                cache: false,
                data:{
                    comp_seq:<?php echo $comp['comp_seq'] ?>
                }
            };

        var addfilter = function () {
            var filtergroup = new $.jqx.filter();

            var filter_or_operator = 1;
            var filtervalue = 'Andrew';
            var filtercondition = 'equal';
            var filter1 = filtergroup.createfilter('stringfilter', filtervalue, filtercondition);

            filtergroup.addfilter(filter_or_operator, filter1);
            // add the filters.
            $("#grid").jqxGrid('addfilter', 'firstname', filtergroup);
            // apply the filters.
            $("#grid").jqxGrid('applyfilters');
        }

        var adapter = new $.jqx.dataAdapter(source);

        $("#grid").jqxGrid(
            {
                //width: getWidth('grid'),
                width: '100%',
                height: '100%',

                //autorowheight: true,
                //autoheight: true,
                source: adapter,
                columnsresize: true,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
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

                    { text: '소재번호', datafield: 'mtrl_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center', width: 80},
                    { text: '소재명', datafield: 'mtrl_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  , width: 350},
                    { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width: 80},
                    { text: '업종구분', datafield: 'prod_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center', width: 180 },
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' ,width: 80},
                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center' },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width: 140},
                    { datafield: 'comp_seq', hidden: true },
                    {  datafield: 'prod_type', hidden: true }
                ]
            });


        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];

            <? if($member['mb_level'] > 2){ ?>
            mtrl_popup(getRowData['mtrl_seq'])
            <?} ?>

            //alert(event.args.rowindex);
            //console.log(getRowData);
        });

    };
    <?php
    }
    ?>

    <?php
    if($w == "U"){
    ?>
    var g_comp_seq = <?=$comp['comp_seq']?>
    <? }else{?>
    var g_comp_seq = 0;
    <?}?>

    function fcomp_del_submit(f){
        if(delete_confirm2("정말 삭제 하시겠습니까?")){

            $('#w').val('D');
            fcomp_submit(f,"D");
        }else{
            return false;
        }

    }

    function busi_chk(){

        if($('#busi_no').val() != ''){


            $.get('comp_busi_no_chk.php?comp_type=AAC01&&comp_seq='+g_comp_seq+'&busi_no='+$('#busi_no').val(),function (cnt){

                if(Number(cnt)>0){
                    alert("이미 등록된 사업자 번호 입니다.");
                    return false;
                }else{

                    document.fcomp.submit();

                }
            });
        }else{

        }
    }

    function fcomp_submit(f,del)
    {

        if(del =='D'){
            location.href = 'comp_form_update.php?comp_type=AAC01&comp_seq='+g_comp_seq+'&w=D';

        }else{

            busi_chk();
            return false;
        }

    }
</script>
<?php
include_once ('./sale.tail.php');
?>
