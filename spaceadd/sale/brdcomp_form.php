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

    $sql = "select * from tb_comp where comp_seq='{$_GET['comp_seq']}'";
    $comp = sql_fetch($sql);

}else{
    //신규 입력
    $w = "I";
}



?>
<script type="text/javascript">
</script>
<form name="fcomp" id="fcomp" action="./comp_form_update.php" onsubmit="return fcomp_submit(this);" method="post">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="token" value=<?php echo get_write_token('online') ?>>


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
                <th scope="row"><label for="comp_nm">매체사 명<strong class="sound_only">필수</strong></label></th>
                <td>
                    <input type="text" name="comp_nm" value="<?php echo $comp['comp_nm'] ?>" id="COMP_NM"  class="required frm_input " size="20"  maxlength="20">
                </td>
                <th scope="row"><label for="comp_seq">매체사 코드 </label></th>
                <td><input type="text" name="comp_seq" id="comp_seq"  class="frm_input "  value="<?php echo $comp['comp_seq'] ?>" size="20" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="busi_no"> 번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="busi_no" value="<?php echo $comp['busi_no'] ?>" id="busi_no" required class="required frm_input bizno" size="15"  maxlength="20"></td>
                <th scope="row"><label for="corp_no">법인 번호<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="corp_no" value="<?php echo $comp['corp_no'] ?>" id="corp_no" required class="required frm_input" size="15"  maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row"><label for="rep_nm1">대표자 1<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="rep_nm1" value="<?php echo $comp['rep_nm1'] ?>" id="rep_nm1" maxlength="100" required class="required frm_input " size="30"></td>
                <th scope="row"><label for="rep_nm2">대표자 2</label></th>
                <td><input type="text" name="rep_nm2" value="<?php echo $comp['rep_nm2'] ?>" id="rep_nm2" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="tel_no">전화 번호</label></th>
                <td><input type="text" name="tel_no" value="<?php echo $comp['tel_no'] ?>" id="tel_no" class="frm_input telno" size="15" maxlength="20"></td>
                <th scope="row"><label for="fax_no">FAX 번호</label></th>
                <td><input type="text" name="fax_no" value="<?php echo $comp['fax_no'] ?>" id="fax_no" class="frm_input telno" size="15" maxlength="20"></td>
            </tr>
            <tr>
                <th scope="row">주소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호</label>
                    <input type="text" name="zipcode" value="<?php echo $comp['zipcode']; ?>" id="zipcode" class="frm_input readonly" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('fcomp', 'zipcode', 'addr1', 'addr3', 'addr2', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="addr1" value="<?php echo $comp['addr1'] ?>" id="addr1" class="frm_input readonly" size="60">
                    <label for="mb_addr1"> </label> <input type="text" name="addr2" value="<?php echo $comp['addr2'] ?>" id="addr2" class="frm_input readonly" size="60">
                    <label for="mb_addr3">상세주소</label> <input type="text" name="addr3" value="<?php echo $comp['addr3'] ?>" id="addr3" class="frm_input" size="60">

                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $comp['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="busi_sts">업 태<strong class="sound_only">필수</strong></label></th>
                <td><input type="text" name="busi_sts" value="<?php echo $comp['busi_sts'] ?>" id="busi_sts" maxlength="100" required class="required frm_input" size="30"></td>
                <th scope="row"><label for="item">종 목</label></th>
                <td><input type="text" name="item" value="<?php echo $comp['item'] ?>" id="item" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="bill_type">결재조건<strong class="sound_only">필수</strong></label></th>
                <td>
                    <select name="bill_type" id="bill_type" onChange="">
                        <option value="">결재조건 선택<?print_option_with_select('BAD', $comp['bill_type']);?>
                    </select>
                </td>
                <th scope="row"><label for="REP_INDST_DIV">업종 구분</label></th>
                <td><input type="text" name="REP_INDST_DIV" value="<?php echo $comp['REP_INDST_DIV'] ?>" id="REP_INDST_DIV" class="frm_input" maxlength="255" size="15"></td>
            </tr>
            <tr>
                <th scope="row"><label for="deal_sts_code">거래 상태<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <select name="deal_sts_code" id="deal_sts_code" onChange="">
                        <option value="">거래선 선택<?print_option_with_select('BAA', $comp['deal_sts_code']);?>
                    </select>
                </td>

            </tr>
            <tr>
                <th scope="row"><label for="chrg_nm">직책자<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <label for="chrg_nm">이름</label><input type="text" name="chrg_nm" value="<?php echo $comp['chrg_nm'] ?>" id="chrg_nm" maxlength="100" required class="required frm_input  " size="30">
                    <label for="chrg_no">연락처</label><input type="text" name="chrg_no" value="<?php echo $comp['chrg_no'] ?>" id="CHRG_NO" maxlength="100" required class="required frm_input telno " size="30">
                    <label for="chrg_email">E-Mail</label><input type="text" name="chrg_email" value="<?php echo $comp['chrg_email'] ?>" id="chrg_email" maxlength="100" required class="required frm_input   " size="30">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="psrn_nm">실무자<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <label for="psrn_nm">이름</label><input type="text" name="psrn_nm" value="<?php echo $comp['psrn_nm'] ?>" id="PSRN_NM" maxlength="100" required class="required frm_input" size="30">
                    <label for="psrn_no">연락처</label><input type="text" name="psrn_no" value="<?php echo $comp['psrn_no'] ?>" id="psrn_no" maxlength="100" required class="required frm_input telno" size="30">
                    <label for="psrn_email">E-Mail</label><input type="text" name="psrn_email" value="<?php echo $comp['psrn_email'] ?>" id="psrn_email" maxlength="100" required class="required frm_input email" size="30">
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="fin_nm">재무 담당<strong class="sound_only">필수</strong></label></th>
                <td colspan="3">
                    <label for="fin_nm">이름</label><input type="text" name="fin_nm" value="<?php echo $comp['fin_nm'] ?>" id="fin_nm" maxlength="100" required class="required frm_input" size="30">
                    <label for="fin_no">연락처</label><input type="text" name="fin_no" value="<?php echo $comp['fin_no'] ?>" id="fin_no" maxlength="100" required class="required frm_input telno"  size="30">
                    <label for="fin_email">E-Mail</label><input type="text" name="fin_email" value="<?php echo $comp['fin_email'] ?>" id="fin_email" maxlength="100" required class="required frm_input email" size="30">
                </td>
            </tr>            
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo"><?php echo $comp['bigo'] ?></textarea></td>
            </tr>

            </tbody>
        </table>
    </div>


<!--
    <div class="btn_fixed_top">
        <a href="./comp_list.php?<?php /*echo $qstr */?>" class="btn btn_02">목록</a>
        <input type="submit" value="확인" class="btn_submit btn" accesskey='s'>
    </div>
-->
    <div class="btn_confirm01 button" align="center">
        <a href="./comp_list.php" class="btn btn_02">목록</a>
        <input type="submit" value="저장" class="btn_submit btn" accesskey='s'>
    </div>
    <?php
    if($w == "U"){
    ?>
    <div class="tbl_frm01 tbl_wrap">

        <div class="btn_list03 btn_list">
            <a href="javascript:mtrl_popup();">신규 소재</a>
        </div>
        <h2>광고주 소재</h2>
		<div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 200px;"> 
		 <div id="grid"  style="width: 100%; height: 100%;">
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
    mtrl_grid_load();

    function mtrl_reload(){
        mtrl_grid_load();
    }
    function mtrl_popup(){
        var new_win = window.open("mtrl_form_pop.php?comp_seq=<?php echo $comp['comp_seq'] ?>", 'win_profile', 'left=100,top=100,width=1250,height=710,scrollbars=1');
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

                    { text: '소재번호', datafield: 'mtrl_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                    { text: '소재명', datafield: 'mtrl_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  },
                    { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '업종구분', datafield: 'prod_type_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '사용여부', datafield: 'use_yn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' },
                    { datafield: 'comp_seq', hidden: true },
                    {  datafield: 'prod_type', hidden: true }
                ]
            });


        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];
            alert(getRowData['comp_nm']);

        });

    };
    <?php
    }
    ?>
    function fcomp_submit(f)
    {


        return true;
    }
</script>


<?php
include_once ('./sale.tail.php');
?>
