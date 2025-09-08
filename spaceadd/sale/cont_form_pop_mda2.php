<?php
$sub_menu = "";
include_once('./_common.php');

    $sql = "select   '' cont_mda_seq,
            a.cont_seq,
            'Y' excpt_cnt,
            cont_st_dt st_dt,
            cont_ed_dt ed_dt  ,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  toss_dt  ,
            date_format(LAST_DAY(concat(a.cont_yearmon , '01')),'%Y%m%d')  mg_report  , 
            '0800' act_st_time  , 
            '2000'  act_ed_time  , 
            'Y' report_yn, 
            'Y' mg_report_yn ,
            15 mtrl_sec ,
            100 guarant_pos ,
            a.cont_stat ,
            a.cont_amt ,
            a.cli_seq 
          from  tb_cont a
          where cont_seq='{$_GET['cont_seq']}'";
$cont_mda = sql_fetch($sql);

$m_sql=" SELECT
    mda_seq,
    mda_nm,
    mda_div,
    mda_type,
    mda_prod,
    mda_poi,
    ord, 
    ifnull(up_mda_seq, 0) up_mda_seq, 
    ifnull(last_yn, 'N')  last_yn,
    depth
FROM  tb_media
where use_yn='Y'"   ;


$cont_mda['st_dt'] =  date('Y-m-d',strtotime($cont_mda['st_dt']));
$cont_mda['ed_dt'] =  date('Y-m-d',strtotime($cont_mda['ed_dt']));
$cont_mda['toss_dt'] =  date('Y-m-d',strtotime($cont_mda['toss_dt']));
$cont_mda['mg_report'] =  date('Y-m-d',strtotime($cont_mda['mg_report']));

if(!isset($_GET['cont_mda_seq']) ) {
    $cont_mda['toss_dt'] = addDaysExcludingWeekends( $cont_mda['st_dt'] , 5 )   ;
    $cont_mda['mg_report'] =  addDaysExcludingWeekends( $cont_mda['st_dt'] , 20 )   ;
}

$g5['title'] = "계약상품 등록";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
    <script type="text/javascript">
        var mda_array = [] ;
        jQuery(function($) {
            try{
                //멀티소재
                $('input[name="multi_yn"]').change(function() {
                    if( $('input[name="multi_yn"]:checked').val() =="Y"){
                        $("#multi_mtrl").show() ;
                    }else{
                        $("#multi_mtrl").hide() ;
                    }
                });
                //게첨보고서
                $('input[name="report_yn"]').change(function() {
                    if( ($('input[name="report_yn"]:checked').val() ?? "") !='N'){
                        $(".report_yn").show() ;
                    }else{
                        $(".report_yn").hide() ;
                    }
                });
                //관리보고서
                $('input[name="mg_report_yn"]').change(function() {
                    if( $('input[name="mg_report_yn"]:checked').val() !='N'){
                        $(".mg_report_yn").show() ;
                    }else{
                        $(".mg_report_yn").hide() ;
                    }
                });
                //시작일변경시 - 개첨보고서, 관리보고서
                $('input[name="st_dt"]').change(function() {
                    $("#toss_dt").val(fn_addDaysWeekdays( $(this).val() , 5 )  );
                    $("#mg_report").val(fn_addDaysWeekdays( $(this).val() , 20 )  );
                });

            }catch (e) {
                console.log(e)
            }

            $("#st_dt, #ed_dt, #toss_dt, #mg_report").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99"  });
            $("[id^='act_']").jqxMaskedInput({ mask: '[0-2][0-9]:[0-5][0-9]', theme:"frm_input", width:45});

            mda_array= <?echo sql_query_json($m_sql);  ?> ;
            fn_mdaChange() ;

            $("#grid").jqxGrid('clear');
            var source =
                {
                    datatype: "json",
                    datafields: [
                        { name : 'prod_seq'},
                        { name : 'mda_seq'},
                        { name : 'comp_seq'},
                        { name : 'mda_nm', type: 'string'},
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
                        { name : 'excpt_nm'} ,
                        { name : 'm1_nm'} ,
                    ],
                    url: g_sale_url+'/cont_form_pop_mda_mdalist.php',
                    cache: false,
                    data:{
                        mda_seq:' '
                    }
                };
            var adapter = new $.jqx.dataAdapter(source);
            $("#grid").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapter,
                    columnsresize: true,
                    filterable: true,
                    filterbarmode: 'simple',
                    showfilterbar: true,
                    sortable: true,
                    showstatusbar: true,
                    statusbarheight: 27,
                    showaggregates: true,
                    selectionmode: 'checkbox',
                    altrows: true,
                    autoshowfiltericon: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    columns: [
                         {text: '자사/타사',datafield: 'm1_nm',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 100,filtertype: 'checkedlist'} ,
                         { text: '매체사', datafield: 'comp_nm',  cellsalign: 'left', align: 'center'  ,width:150,filtertype: 'checkedlist',
                             aggregates: ['count'] ,
                             aggregatesrenderer: function (aggregates) {
                                 var _len  = $('#grid').jqxGrid('getselectedrowindexes').length ;
                                 var _s = addComma(_len+"")  ;
                                 return '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center;">' +   _s  + '</div>';
                             }
                         }
                        ,{text: '상품명',datafield: 'mda_nm',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 150,filtertype: 'checkedlist'}
                        ,{text: '구좌수',datafield: 'mda_cnt',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70, filtertype: 'checkedlist'}
                        , { text: '단가', datafield: 'mda_amt', cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd',filtertype: 'checkedlist',
                            aggregates: ['sum'] ,
                            aggregatesrenderer: function (aggregates) {
                                var _sum =  0 ;
                                $.each($('#grid').jqxGrid('getselectedrowindexes') , function (key, value) {
                                    var data = $('#grid').jqxGrid('getrowdatabyid', value);
                                     _sum = _sum + data.mda_amt  ;
                                });
                                var _s = addComma(_sum+"")  ;
                                return '<div style="position: relative; margin: 2px; overflow: hidden; text-align: right;">' +   _s  + '</div>';
                            }
                        }
                        , { text: '기기수', datafield: 'ins_cnt', cellsalign: 'right', align: 'center'  ,width:100,  cellsformat: 'd' ,filtertype: 'checkedlist',
                            aggregates: ['sum'] ,
                            aggregatesrenderer: function (aggregates) {
                                var _sum1=  0 ;
                                $.each($('#grid').jqxGrid('getselectedrowindexes') , function (key, value) {
                                    var data = $('#grid').jqxGrid('getrowdatabyid', value);
                                    _sum1 = _sum1 + data.ins_cnt  ;
                                });
                                var _s1 = addComma(_sum1+"")  ;
                                return '<div style="position: relative; margin: 2px; overflow: hidden; text-align: right;">' + _s1 + '</div>';
                            }
                        }
                        ,{text: '금지업종',datafield: 'excpt_nm',cellsalign: 'center',align: 'center',cellsformat: 'd' ,filtertype: 'checkedlist'}
                        ,{text: '재원사용 여부',datafield: 'asg_use_yn',cellsalign: 'center',align: 'center',cellsformat: 'd' ,width:70,filtertype: 'checkedlist'  }
                        ,{datafield: 'prod_seq', hidden: true}
                    ]
                });
            $("#grid").on("bindingcomplete", function (event) {
                $('#grid').jqxGrid('clearselection');
            });

            $("#grid").on('rowselect', function (event){
               $('#grid').jqxGrid('refreshaggregates');
            });
            $("#grid").on('rowunselect', function (event){
                $('#grid').jqxGrid('refreshaggregates');
            });

            $("#btn_mda").click(function () {
                if($("#mda1").val() == "" ){
                    alert("자사/타사 매체를  선택하십시오. ");
                    return false ;
                }
                $('#grid').jqxGrid('clearselection');
                source.data = {
                    "mda_seq" : $("#mda_seq").val()
                    , "mda1" : $("#mda1").val()
                    , "mda2" : $("#mda2").val()
                    , "mda3" : $("#mda3").val()
                    , "mda4" : $("#mda4").val()
                    , "mda5" : $("#mda5").val()
                }  ;
                $("#grid").jqxGrid("updatebounddata","cells");
            });
        });


        /*저장*/
        function fn_contMda_submit(){
            var chk = $('#grid').jqxGrid('getselectedrowindexes');
            if(chk.length <= 0 ){
                alert("등록할 상품을 선택하십시오. ");
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            /*
            if(params.st_dt <= getTodayFullYear() ){
                alert("운행일은 오늘 이후 만 가능합니다. ");
                return false ;
            }
             */
            var prod_arr =[] ;
            for (var i = 0; i < chk.length; i++) {
                var data = $('#grid').jqxGrid('getrowdatabyid', chk[i]);
                prod_arr.push(data)  ;
            }
            params.prod_seq = prod_arr ;
            fn_submission("subForm", "./cont_form_pop_mda2_update.php", params, true, fn_subMdaCallback  );
        }

        function fn_subMdaCallback(subid, voJson){
            try{
                alert("처리 되었습니다.") ;
                var callbacks = $.Callbacks();
                callbacks.add(eval("opener.fn_refresh"));
                callbacks.fire(voJson.cont_seq);
                self.close();
            }catch (e) {
                console.log(e)
            }
        }
        //매체 설정
        function fn_mdaChange( obj) {
            try {
                $("#mda_seq").val("");
                $("#grid").jqxGrid('clear');

                var _id = (obj == null) ? "mda1" : obj.id;
                var _val = (obj == null) ? "0" : $(obj).val();
                var _num = (obj == null) ? 1 : Number(_id.replaceAll("mda", "")) + 1;
               // $("#btn_mda").hide();

                for (var i = _num; i <= 5; i++) {
                    $("#mda" + i).hide();
                    $("#mda" + i).empty();
                }
                var option = $("<option value=''>선택</option>");
                $('#mda' + _num).append(option);
                var _cnt = 0;
                $.map(mda_array, function (item) {
                    if ((item.up_mda_seq ?? "") == _val) {
                        var option = $("<option value='" + item.mda_seq + "'>" + item.mda_nm + "</option>");
                        $('#mda' + _num).append(option);
                        _cnt++;
                        $("#mda" + _num).show();
                    }
                });

                if (_cnt == 0) {
                    $("#mda_seq").val(_val);
                 //   $("#btn_mda").show();
                }
            } catch (e) {
                console.log(e);
            }
        }
    </script>
 <form name="fcomp" id="fcomp"  method="get" onsubmit="return false;"  >
    <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
    <input type="hidden" name="mda_seq" id="mda_seq" value=""  >
    <input type="hidden" name="cont_stat" id="cont_stat" value="<?=$cont_mda['cont_stat']?>"  >
    <input type="hidden" name="cont_mtrl_seq1" id="cont_mtrl_seq1" value=""  >
    <input type="hidden" name="cont_mtrl_seq2" id="cont_mtrl_seq2" value=""  >
    <div class="tbl_frm02 tbl_wrap">
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
                <th scope="row"><label for="mda_seq">매체 / 상품</label></th>
                <td colspan="3">
                    <select name="mda1"  id="mda1" onchange="fn_mdaChange(this)">
                    </select>
                    <select name="mda2" id="mda2" onchange="fn_mdaChange(this)">
                    </select>
                    <select name="mda3" id="mda3" onchange="fn_mdaChange(this)">
                    </select>
                    <select name="mda4" id="mda4" onchange="fn_mdaChange(this)">
                    </select>
                    <select name="mda5" id="mda5" onchange="fn_mdaChange(this)">
                    </select>
                    <button type="button"  id="btn_mda" class="btn_find"  onClick=" ">검색</button>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mda_seq">상품 내역</label></th>
                <td colspan="3">
                    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height: 250px;">
                        <div id="grid"  style="width: 100%; height: 100%;"></div>
                    </div>
                </td> 
            </tr>
            <tr>
                <th scope="row"><label for="account_cnt">집행 구좌수</label></th>
                <td>
                    <select name="account_cnt" id="account_cnt">
                    <?for($i=1 ; $i<26 ;$i++){?>
                    <option value="<?=$i?>"  <? if($cont_mda['account_cnt']== $i){?>selected<?}?> > <?=$i?> </option>
                    <?}?>
                    </select>
                </td>
                <th scope="row"><label for="bns_yn"> 서비스 여부</label></th>
                <td>
                    <? print_radioYN("bns_yn", $cont_mda['bns_yn'], "")  ?>
                </td>
                <!--
                <th scope="row"><label>집행 기수</label></th>
                <td>
                    <select name="equip_cnt" id="equip_cnt">
                        <?for($i=1 ; $i<26 ;$i++){?>
                            <option value="<?=$i?>"  <? if($cont_mda['equip_cnt']== $i){?>selected<?}?> > <?=$i?> </option>
                        <?}?>
                    </select>
                </td>
                -->
            </tr>
            <tr>
                <th scope="row"><label for="st_dt">집행기간</label></th>
                <td>
                    <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd"  value="<?=$cont_mda['st_dt']?>"></input>
                    ~
                    <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$cont_mda['ed_dt']?>"></input>
                </td>
                <th scope="row"><label for="st_time">운영시간</label></th>
                <td>
                    <input  id="act_st_time" name="act_st_time"  maxlength="5" class="frm_input" value="<?=$cont_mda['act_st_time'] ?>" ></input>
                    ~
                    <input  id="act_ed_time" name="act_ed_time"  maxlength="5"  class="frm_input" value="<?=$cont_mda['act_ed_time']?>" ></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="guarant_pos">보장노출횟수(기/일)</label></th>
                <td>
                    <input  id="guarant_pos" name="guarant_pos"  maxlength="50"   class="frm_input  w150" value="<?=$cont_mda['guarant_pos']?>" ></input>
                </td>
                <th scope="row"><label for="mtrl_sec">소재 초수</label></th>
                <td>
                    <?php echo get_spin_select('mtrl_sec', 10, 120, 15, 5) ?>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="multi_yn">멀티소재 여부</label></th>
                <td >
                    <? print_radioYN("multi_yn", $cont_mda['multi_yn'], "$type")  ?>
                </td>
                <th scope="row"><label for="multi_yn">소재선택</label></th>
                <td>
                    <?php  print_mtrl_search('',  '', $cont_mda['cli_seq'] , '1', 'Y', 'N','Y') ?>
                    <input  id="mtrl_bigo1" name="mtrl_bigo1"    class="frm_input  w100" value="" ></input>
                    <div id="multi_mtrl" name="multi_mtrl" style="display:none;" >
                        <?php  print_mtrl_search('',  '', $cont_mda['cli_seq'] , '2', 'Y', 'N','Y') ?>
                        <input  id="mtrl_bigo2" name="mtrl_bigo2"    class="frm_input  w100" value="" ></input>
                    </div>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="report_yn">게첨보고서 필요여부</label></th>
                <td>
                    <? print_radioYN("report_yn", $cont_mda['report_yn'], "")  ?>
                </td>
                <th scope="row"><label for="toss_dt" class="report_yn">게첨보고서 전달일자</label></th>
                <td>
                    <input  id="toss_dt" name="toss_dt"   maxlength="20"  length="6" class="frm_input ymd report_yn"  value="<?=$cont_mda['toss_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="mg_report_yn">관리보고서 필요여부</label></th>
                <td>
                    <? print_radioYN("mg_report_yn", $cont_mda['mg_report_yn'], "")  ?>
                </td>
                <th scope="row"><label for="mg_report" class="mg_report_yn">관리보고서 전달일자</label></th>
                <td>
                    <input  id="mg_report" name="mg_report"   maxlength="20"  length="6" class="frm_input ymd mg_report_yn"  value="<?=$cont_mda['mg_report']?>"></input>
                </td>
            </tr>
<!--            <tr>
                <th scope="row"><label for="cnsg_cmms_rt">매체수수료(매월)</label></th>
                <td colspan="3">
                    <input  id="mda_cmms_rt" name="mda_cmms_rt"   maxlength="30" class="frm_input number required w50" value="<?/*=$cont_mda['mda_cmms_rt']*/?>" ></input>
                    <input  id="mda_cmms_amt" name="mda_cmms_amt"  maxlength="20" class="frm_input number w130" value="<?/*=$cont_mda['mda_cmms_amt']*/?>" ></input>
                </td>
            </tr>-->
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td colspan="3"><textarea name="bigo" id="bigo" style="height:40px " class="wp95"> <?php echo $cont_mda['bigo'] ?></textarea></td>
            </tr>
            <?php if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') { ?>
                <tr>
                    <th scope="row"><label>등록자 / 등록일</label></th>
                    <td><?=$cont_mda['entr_prsn_nm']?> / <?=$cont_mda['entr_dt']?></td>
                    <th scope="row"><label>수정자 / 수정일</label></th>
                    <td><?=$cont_mda['updt_prsn_nm']?> / <?=$cont_mda['updt_dt']?> </td>
                </tr>
            <? } ?>
            </tbody>
        </table>
    </div>
 </form>
    <div class="" align="center">
        <button  class="btn btn_save btn_lg" onclick="fn_contMda_submit();">저장</button>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>
</body>
</html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>