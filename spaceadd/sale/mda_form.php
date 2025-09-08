<?php
$sub_menu = "100110";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '매체사 등록';
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



?>
<script type="text/javascript">
</script>
<form name="fmda" id="fmda" action="./mda_form_update.php" onsubmit="return fcomp_submit(this);" method="post">
    <input type="hidden" name="w" id="w" value="<?php echo $w ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>

    <div class="btn_fixed_top">
        <div class="btn_list03">
            <a href="./mda_list.php" class="">매체사 관리</a>
        <? if($member['mb_level'] > 6){ ?>
            <button  class="btn_save" onclick="return fcomp_submit(this);" style="">저장</button>
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
                <th scope="row"><label for="comp_nm">매체사명<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="comp_nm" value="<?php echo $comp['comp_nm'] ?>" id="comp_nm" required class="required frm_input " size="20"  maxlength="20" autocomplete="off">
                </td>
                <th scope="row"><label for="busi_nm">사업자명</label></th>
                <td><input type="text" name="busi_nm" id="busi_nm"  required class="required frm_input "  value="<?php echo $comp['busi_nm'] ?>" size="20" maxlength="20" autocomplete="off" ></td>
            </tr>
            <tr>
                <th scope="row" ><label for="comp_seq">매체사코드 </label></th>
                <td colspan="3"><input type="text" name="comp_seq" id="comp_seq"  class="frm_input readonly"  value="<?php echo $comp['comp_seq'] ?>" size="20" maxlength="20" autocomplete="off" readonly></td>
            </tr>
            <tr>
                <th scope="row"><label for="busi_no">사업자번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="busi_no" value="<?php echo $comp['busi_no'] ?>" id="busi_no" required class="required frm_input bizno" size="15"  autocomplete="off" maxlength="12"></td>
                <th scope="row"><label for="corp_no">법인번호</label></th>
                <td><input type="text" name="corp_no" value="<?php echo $comp['corp_no'] ?>" id="corp_no"  class="frm_input bizno" size="15"  autocomplete="off" maxlength="15"></td>
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
                    <button type="button" class="btn_frmline" onclick="win_zip('fmda', 'zipcode', 'addr1', 'addr3', 'addr2', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="addr1" value="<?php echo $comp['addr1'] ?>" id="addr1" class="required frm_input readonly" size="60" readonly autocomplete="off" required>
                    <label for="mb_addr1"> </label> <input type="text" name="addr2" value="<?php echo $comp['addr2'] ?>" id="addr2" class="frm_input readonly" size="60" readonly autocomplete="off" >
                    <label for="mb_addr3">상세주소</label> <input type="text" name="addr3" value="<?php echo $comp['addr3'] ?>" id="addr3" class="frm_input" size="60" autocomplete="off">

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
                <th scope="row"><label for="rep_indst_div">업종구분</label></th>
                <td  colspan="3">
                    <select name="rep_indst_div" id="rep_indst_div" class="required" onChange="" required>
                        <option value="">업종 선택<?print_option_with_select('CAA', $comp['rep_indst_div']);?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mda_type">매체구분<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="mda_type" id="mda_type" class="required" onChange="" required>
                        <option value="">매체 구분 선택<?print_option_with_select('AAB', $comp['mda_type']);?>
                    </select>
                </td>
                <th scope="row"><label for="deal_sts_code">거래상태<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="deal_sts_code" id="deal_sts_code" class="required" onChange="" required>
                        <option value="">거래상태 선택<?print_option_with_select('BAA', $comp['deal_sts_code']);?>
                    </select>
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
                <td colspan="3"><textarea name="bigo" id="bigo"><?php echo $comp['bigo'] ?></textarea></td>
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
        include_once('./inc_comp_file.php');
    }
    ?>


    <?php
    if($w == "U"){
    ?>
    <div class="tbl_frm01 tbl_wrap">
        <div class="" style="margin-top: 15px" >
            <div class="subTlt"  >
                매체 광고상품
            </div>
            <div class="btn_list03">
                <? if($member['mb_level'] > 7){ ?>
                    <button type="button" class="btn_new" onclick="prod_popup('');">매체 광고상품 신규등록</button>
                <?} ?>

            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:195px;">
            <div id="grid"  style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <div class="" style="margin-top: 15px" >
            <div class="subTlt"  >
                매체 금지업종
            </div>
            <div class="btn_list03">
                <? if($member['mb_level'] > 6){ ?>
                    <button  type="button" class="btn_new" onclick="excpt_popup('');">매체 금지업종 등록</button>
                <?} ?>

            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:195px;">
            <div id="grid2"  style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>


    <?php
    }
    ?>

</form>

<script>
    <?php
    if($w == "U"){
    ?>
    //prod_popup('');
    mtrl_grid_load();
    excpt_grid_load();

    function mtrl_reload(){
        mtrl_grid_load();
    }
    function prod_popup(prod_seq){
        var pram ="";
        if(prod_seq !=''){
            pram = "&prod_seq="+prod_seq;
        }
        var new_win = window.open("mda_pro_form_pop.php?comp_seq=<?=$comp['comp_seq']?>"+pram, 'win_profile', 'left=100,top=100,width=1250,height=550');
        new_win.focus();
    }

    function excpt_popup(item_code){

        var pram ="";
        if(item_code !=''){
            pram = "&item_code="+item_code;
        }
        var new_win = window.open("mda_excpt_form_pop.php?comp_seq=<?=$comp['comp_seq']?>"+pram, 'win_profile', 'left=100,top=100,width=800,height=280');
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
                    { name: 'prod_seq'},
                    { name: 'comp_seq'},
                    { name: 'mda_seq'},
                    { name: 'mda_seq_nm'},
                    { name: 'mda_nm'},
                    { name: 'mda_cnt'},
                    { name: 'use_yn'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'use_st_time'},
                    { name: 'use_ed_time'},
                    { name: 'bigo'},
                    { name: 'full_nm'},
                    { name: 'mda_own_yn'},
                    { name: 'entr_prsn'},
                    { name: 'updt_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_dt'}

                ],
                url: './mda_pro_list_result.php',
                cache: false,
                data:{
                    comp_seq:<?=$comp['comp_seq']?>
                }
            };



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

                    { text: '상품번호', datafield: 'prod_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:70 },
                    { text: '상품명', datafield: 'mda_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center' ,width:120 },
                    { text: '상품', datafield: 'mda_seq_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                    { text: '카테고리', datafield: 'full_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:250},
                    { text: '구좌수', datafield: 'mda_cnt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '사용시작일자', datafield: 'use_st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '사용종료일자', datafield: 'use_ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    /*
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    {
                        text: '삭제', datafield: 'Edit', columntype: 'button', align: 'center', cellsrenderer: function () {
                            return "삭제";
                        }, buttonclick: function (row) {
                            if(delete_confirm2("정말 삭제 하시겠습니까?")){

                                var dataRecord = $("#grid").jqxGrid('getrowdata', row);
                                $.get('mda_pro_form_pop_update.php?w=D&prod_seq='+dataRecord.prod_seq,pro_del_callBack);
                            }
                        }
                    },

                    */
                    { datafield: 'comp_seq', hidden: true },
                    { datafield: 'mda_own_yn', hidden: true },
                    {  datafield: 'prod_type', hidden: true }
                ]
            });

        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];

            //alert(getRowData['prod_seq']);
            <? if($member['mb_level'] > 7){ ?>
            prod_popup(getRowData['prod_seq']);
            <?} elseif($member['mb_level'] == 7) {?>
            if(getRowData['mda_own_yn'] == 'N') {
                prod_popup(getRowData['prod_seq']);
            }
            <?}?>
            //console.log(getRowData);
        });

    };

    function excpt_grid_load(){

        //$("#grid2").jqxGrid('clear');

        //var data = generatedata(500);
        //var exampleTheme = theme;

        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'item_code'},
                    { name: 'item_nm'},
                    { name: 'use_yn'},
                    { name: 'bigo'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'}

                ],
                url: './mda_excpt_list_result.php',
                cache: false,
                data:{
                    comp_seq:<?=$comp['comp_seq']?>
                }
            };


        var adapter = new $.jqx.dataAdapter(source);

        $("#grid2").jqxGrid(
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

                    { text: '업종', datafield: 'item_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '비고', datafield: 'bigo', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center' },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    {
                        text: '삭제', datafield: 'Edit', columntype: 'button', align: 'center', cellsrenderer: function () {
                            return "삭제";
                        }, buttonclick: function (row) {
                            if(delete_confirm2("정말 삭제 하시겠습니까?")){

                                var dataRecord = $("#grid2").jqxGrid('getrowdata', row);
                                $.get('mda_excpt_form_pop_update.php?w=D&comp_seq=<?=$comp['comp_seq']?>&item_code='+dataRecord.item_code,excpt_del_callBack);
                            }
                        }
                    },
                    { datafield: 'comp_seq', hidden: true },
                    {  datafield: 'item_code', hidden: true }
                ]
            });

        $('#grid2').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid2').jqxGrid('getrows')[event.args.rowindex];

            //alert(getRowData['prod_seq']);

            <? if($member['mb_level'] > 6){ ?>
            excpt_popup(getRowData['item_code']);
            <?} ?>
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

    function excpt_del_callBack(){
        excpt_grid_load();
    }
    function pro_del_callBack(){
        mtrl_grid_load();
    }

    function fcomp_del_submit(f){
        if(delete_confirm2("정말 삭제 하시겠습니까?")){

            $('#w').val('D');
            fcomp_submit(f,"D");
        }else{
            return false;
        }

    }
    function fcomp_submit(f,del)
    {

        if(del =='D'){
            location.href = 'mda_form_update.php?comp_seq='+g_comp_seq+'&w=D';

        }else{
            return true;
        }

    }
</script>


<?php
include_once ('./sale.tail.php');
?>
