<?php
$sub_menu = "";
include_once('./_common.php');

//광고주 모든 소재
$sql =" SELECT
    a.mtrl_seq, 
    concat(a.mtrl_nm, a.mtrl_sec,  prod_type ,  insp_no  ) mtrl_nm
FROM tb_mtrl a, tb_cont b 
where a.comp_seq = b.cli_seq 
  and a.use_yn ='Y'
  and b.cont_seq ={$_GET['cont_seq']}  " ;
$mtrl = sql_query_json($sql);

//상품정보
$sql = "select  a.cont_mda_seq,
        a.cont_seq,
        a.mda_seq,
        a.account_cnt,
        a.equip_cnt,
        a.guarant_pos,
        a.multi_yn,
        a.st_dt,
        a.ed_dt,
        a.act_st_time,
        a.act_ed_time,
        a.report_opt,
        a.toss_dt,
        a.bigo,
        a.entr_prsn,
        b.cont_stat ,
        c.m1 , c.m2, c.m3, c.m4, c.m5 
      from  tb_cont_mda a, tb_cont b, vi_media c
      where a.cont_mda_seq = {$_GET['cont_mda_seq']}   and a.cont_seq = b.cont_seq and a.mda_seq = c.mda_seq  ";
$cont_mda = sql_fetch($sql);

 
if(isset($_GET['cont_mda_seq']) &&  $_GET['cont_mda_seq'] != '') {
    if( $cont_mda['cont_stat'] == "BAC04" || $cont_mda['cont_stat'] =="BAC05" ){
        $del_able_yn ="N"  ;
        $save_able_yn ="N" ;
    }else{
        $del_able_yn ="Y"  ;
        $save_able_yn ="Y"  ;
    }
}

$cont_mda['st_dt'] =  date('Y-m-d',strtotime($cont_mda['st_dt']));
$cont_mda['ed_dt'] =  date('Y-m-d',strtotime($cont_mda['ed_dt']));  

$g5['title'] = "계약 상품 소재";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
    <script type="text/javascript"> 
        var mda_array = [] ;
        jQuery(function($) {
            $("#st_dt, #ed_dt").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99"  });

            mda_grid_load();
            function mda_grid_load() {
                $("#grid_mtrl").jqxGrid('clear');
                var source_mda =
                    {
                        datatype: "json",
                        datafields: [
                            {name: 'cont_mda_seq'},
                            {name: 'cont_seq'},
                            {name: 'mda_seq'},
                            {name: 'account_cnt'},
                            {name: 'equip_cnt'},
                            {name: 'guarant_pos'},
                            {name: 'multi_yn'},
                            {name: 'st_dt'},
                            {name: 'ed_dt'},
                            {name: 'act_st_time'},
                            {name: 'act_ed_time'},
                            {name: 'report_opt'},
                            {name: 'toss_dt'},
                            {name: 'bigo'},
                            {name: 'entr_prsn'},
                            {name: 'entr_dt'},
                            {name: 'updt_prsn'},
                            {name: 'updt_dt'},
                            {name: 'mda_nm'},
                            {name: 'report_opt_nm'},
                            {name: 'comp_nm'},
                            {name: 'opYn'}

                        ],
                        url: './cont_form_mda_result.php',
                        cache: false,
                        data: {
                            cont_seq: '<?php echo $cont['cont_seq'] ?>'
                        }
                    };
                var adapter_mda = new $.jqx.dataAdapter(source_mda);
                $("#grid_mtrl").jqxGrid(
                    {
                        width: '100%',
                        height: '100%',
                        source: adapter_mda,
                        columnsresize: true,
                        filterable: false,
                        sortable: false,
                        showstatusbar: true,
                        statusbarheight: 27,
                        showaggregates: true,
                        autoshowfiltericon: true,
                        autowidth: false,
                        columns: [
                            {
                                text: '#', sortable: false, filterable: false, editable: false,
                                groupable: false, draggable: false, resizable: false,
                                datafield: '', columntype: 'number', width: 50, cellsalign: 'center', align: 'center',
                                cellsrenderer: cellRowNum,
                                aggregates: ['count'],
                                aggregatesrenderer: function (aggregates) {
                                    var renderstring = "";
                                    $.each(aggregates, function (key, value) {
                                        renderstring = value;
                                    });
                                    return renderstring;
                                }
                            },
                            {
                                text: '매체',
                                datafield: 'mda_nm',
                                filtertype: 'checkedlist',
                                align: 'center',
                                width: 200
                            },
                            {
                                text: '운영시작일',
                                datafield: 'st_dt',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                cellsrenderer: cellYmd,
                                width: 120
                            },
                            {
                                text: '종료일',
                                datafield: 'ed_dt',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                cellsrenderer: cellYmd,
                                width: 120
                            },
                            {
                                text: '운행여부',
                                datafield: 'opYn',
                                cellsalign: 'center',
                                filtertype: 'checkedlist',
                                align: 'center',
                                width: 60
                            },

                            {
                                text: '구좌수',
                                datafield: 'account_cnt',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                cellsformat: 'd',
                                width: 70,
                                aggregates: ['sum'],
                                aggregatesrenderer: function (aggregates) {
                                    var renderstring = "";
                                    $.each(aggregates, function (key, value) {
                                        renderstring += value;
                                    });
                                    return renderstring;
                                }
                            },
                            {
                                text: '기기수',
                                datafield: 'equip_cnt',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                cellsformat: 'd',
                                width: 70
                            },
                            {
                                text: '보장노출',
                                datafield: 'guarant_pos',
                                filtertype: 'checkedlist',
                                align: 'center',
                                width: 110
                            },
                            {
                                text: '게첨보고',
                                datafield: 'report_opt_nm',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                width: 100
                            },
                            {
                                text: '전달일',
                                datafield: 'toss_dt',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                cellsrenderer: cellYmd,
                                width: 120
                            } ,
                            {
                                text: '멀티소재 여부',
                                datafield: 'multi_yn',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                width: 60
                            },
                            {
                                text: '금지 매체사',
                                datafield: 'comp_nm',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center',
                                width: 100
                            },
                            {
                                text: '등록일',
                                datafield: 'entr_dt',
                                filtertype: 'checkedlist',
                                cellsalign: 'center',
                                align: 'center'
                            },
                            {
                                text: '소재', datafield: 'Edit', columntype: 'button', align: 'center'
                                , cellsrenderer: function () { return "소재"; }
                                , buttonclick: function (row) {
                                    var dataRecord = $("#grid_mtrl").jqxGrid('getrowdata', row);
                                    var url = "cont_form_pop_mtrl.php?cont_seq="+dataRecord.cont_seq+"&cont_mda_seq="+dataRecord.cont_mda_seq  ;
                                    basicPopupOpen(url, "계약 상품 소재", "900", "500");
                                },
                                width: 100
                            },

                            {datafield: 'cont_seq', hidden: true},
                            {datafield: 'cont_mda_seq', hidden: true}
                        ]
                    });
                $('#grid_mtrl').on('rowdoubleclick', function (event) {
                    fn_mdaPopup(event.args.row.bounddata);
                });
            };
        });


        /*저장*/
        function fn_contMtrl_submit(){
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subForm", "./cont_form_pop_mtrl_update.php", params, true, fn_subMdaCallback  );
        }
        /*삭제*/
        function fn_contMtrl_del(){
            if(!confirm("삭제 하시겠습니까? ")){
                return false ;
            }
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            fn_submission("subDel", "./cont_form_pop_mtrl_update.php", params, true, fn_subMdaCallback  );
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
    </script>
<div class="btn_list03" style="padding-top:10px; padding-right: 10px"  >
    <?  if( $del_able_yn == "Y" ) {  ?>
        <button  class="btn btn_del  " onclick="return fn_contMtrl_del(this);">삭제</button>
    <?}?>
</div>
 <form name="fcomp" id="fcomp"  method="get" onsubmit="return false;"  >
    <input type="hidden" name="cont_mda_seq" value="<?php echo $_GET['cont_mda_seq'] ?>">
    <input type="hidden" name="cont_seq" value="<?php echo $_GET['cont_seq'] ?>">
    <input type="hidden" name="mda_seq" id="mda_seq" value="<?=$cont_mda['mda_seq']?>"  >
    <input type="hidden" name="cont_stat" id="cont_stat" value="<?=$cont_mda['cont_stat']?>"  >
    <input type="hidden" name="multi_yn" id="multi_yn" value="<?=$cont_mda['multi_yn']?>"  >

    <div class="tbl_frm02 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?></caption>
            <colgroup>
                <col class="grid_3">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mda_seq">소재 </label></th>
                <td>
                    <select name="mda1"  id="mda1" onchange="fn_mdaChange(this)"> </select>
                </td> 
            </tr>
            <tr>
                <th scope="row"><label for="st_dt">운영일자</label></th>
                <td>
                    <input  id="st_dt" name="st_dt"   maxlength="20"  length="6" class="frm_input ymd"  value="<?=$cont_mda['st_dt']?>"></input>
                    ~
                    <input  id="ed_dt" name="ed_dt"   maxlength="20"  length="6" class="frm_input ymd  " value="<?=$cont_mda['ed_dt']?>"></input>
                </td>
            </tr>
            <tr>
                <th scope="row"><label for="bigo">비고</label></th>
                <td ><textarea name="bigo" id="bigo" style="height:40px " class="wp95"> <?php echo $cont_mda['bigo'] ?></textarea></td>
            </tr>

            </tbody>
        </table>
    </div>
 </form>
    <div class="" align="center">
        <?  if( $save_able_yn == "Y" ) {  ?>
        <button  class="btn btn_save btn_lg" onclick="fn_contMtrl_submit();">저장</button>
        <?}?>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>
    <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:195px;padding-top: 20px">
        <div id="grid_mtrl" style="width: 100%; height: 100%;">
        </div>
    </div>

</body>
</html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>