
    <!--계약상품 상세-->
    <div class="tbl_frm01 tbl_wrap">
        <div class="" style="margin-top: 15px;height:28px" >
            <div class="subTlt"  style="width:300px"> 계약상품 </div>
            <div class="btn_list03">
               <?if($mdaAble_yn =="Y"){?>
                <!--
                <button id="btnMadAdd" class="btn_new" onclick="fn_mdaPopup();">등록</button>
                -->
                <button id="btnMadAddAll"  class="btn_new" onclick="fn_mdaPopup2();">등록</button>
                   <!--
                <button id="btnMadStop"  class="btn_color12 btn_stop" onclick="fn_mdaPopupStop();">상품 중지</button>
                -->

                <button id="btnMadRemove"  class="btn_del" onclick="fn_mdaPopupRemove();">상품 삭제</button>
               <?}?>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:300px;margin-top: 10px;">
            <div id="grid_mda" style="width: 100%; height: 100%;"></div>
            <div style='margin-top: 5px;'>
                <div style='float: left;'>
                    <input value="Remove Filter" id="clearfilteringbutton_mda" type="button" />
                    <input type="button" value="Export to Excel" id='excelExport_mda' />
                    <input type="button" value="컬럼 선택" id='openButton_mda' />
                </div>
            </div>
        </div>
    </div>
<script>
    function fn_mdaPopup(voJson) {
        var url = "cont_form_pop_mda.php?cont_seq=<?php echo $cont['cont_seq'] ?>";
        if(( voJson ?? "")  != "" ){
            url = url + "&cont_mda_seq="+voJson.cont_mda_seq  ;
        }
        basicPopupOpen(url, "계약 상품 정보", "1050", "670");
    }
    function fn_mdaPopup2() {
        var url = "cont_form_pop_mda2.php?cont_seq=<?php echo $cont['cont_seq'] ?>";
        basicPopupOpen(url, "계약 상품 일괄 등록", "1050", "760");
    }
    function fn_mdaPopupStop() {
        var url = "cont_form_pop_stop.php?cont_seq=<?php echo $cont['cont_seq'] ?>";
        basicPopupOpen(url, "계약 상품 중지", "1050", "650");
    }
    function fn_mdaPopupRemove() {
        var chk = $('#grid_mda').jqxGrid('getselectedrowindexes');
        if(chk.length <= 0 ){
            alert("삭제할 상품을 선택하십시오. ");
            return false ;
        }
        var validChk = true ;
        var mdaList=[];
        for (var i = 0; i < chk.length; i++) {
            var data = $('#grid_mda').jqxGrid('getrowdatabyid', chk[i]);
            if(data.asg_use_yn =="Y" && data.op_yn =="Y" && data.st_dt <= getTodayFullYear() ) {
                alert("삭제 불가한 상품이 포함되어 있습니다. ")
                validChk = false ;
                return false ;
            }
            mdaList.push(data)  ;
        }
        if(validChk){
            var params  = Object.assign({},  {"mdaList" : mdaList }, formParams($("#fsearch")) );
            fn_submission("subRemove", "./cont_form_mda_update.php", params, true,  function(subid, voJson) {
                try{
                    alert("처리 되었습니다.") ;
                    mda_grid_load();
                }catch (e) {
                    console.log(e)
                }
            }  );
        }
    }
    mda_grid_load();
    function mda_grid_load() {
        $("#grid_mda").jqxGrid('clear');
        var source_mda =
            {
                datatype: "json",
                datafields: [
                    {name: 'cont_mda_seq'},
                    {name: 'cont_seq'},
                    {name: 'prod_seq'},
                    {name: 'mda_comp_seq'},
                    {name: 'mda_comp_nm'},
                    {name: 'account_cnt', type: 'number'},
                    {name: 'guarant_pos'},
                    {name: 'multi_yn'},
                    {name: 'st_dt'},
                    {name: 'ed_dt'},
                    {name: 'act_st_time'},
                    {name: 'act_ed_time'},
                    {name: 'report_yn'},
                    {name: 'report_opt'},
                    {name: 'toss_dt'},
                    {name: 'mg_report_yn'},
                    {name: 'mg_report'},
                    {name: 'bigo'},
                    {name: 'entr_prsn'},
                    {name: 'entr_dt'},
                    {name: 'updt_prsn'},
                    {name: 'updt_dt'},
                    {name: 'mda_nm'},
                    {name: 'mda_amt', type: 'number'},
                    {name: 'ins_cnt', type: 'number'},
                    {name: 'm1_nm'},
                    {name: 'full_nm'},
                    {name: 'report_opt_nm'},
                    {name: 'comp_nm'},
                    {name: 'opdt_yn'},
                    {name: 'op_yn'},
                    {name: 'asg_use_yn'},
                    {name: 'bns_yn'},

                ],
                url: './cont_form_mda_result.php',
                cache: false,
                data: {
                    cont_seq: '<?php echo $cont['cont_seq'] ?>'
                }
            };
        var adapter_mda = new $.jqx.dataAdapter(source_mda);

        $("#grid_mda").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter_mda,
                filterable: true,
                filterbarmode: 'simple',
                showfilterbar: true,
                sortable: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                selectionmode: 'checkbox',
                columns: [
                    {
                        text: '#',columntype: 'number', width: 50, cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum,
                        aggregates: ['count'],
                        aggregatesrenderer: aggCount
                    }
                    ,{text: '매체구분',datafield: 'm1_nm',align: 'center',width: 100 , filtertype: 'checkedlist'}
                    ,{text: '매체사',datafield: 'mda_comp_nm',align: 'center',width: 100 , filtertype: 'checkedlist'}
                    ,{text: '상품명',datafield: 'mda_nm',align: 'center',width: 100, filtertype: 'checkedlist'}
                    ,{text: '매체',datafield: 'full_nm',align: 'center',width: 200, filtertype: 'checkedlist'}
                    ,{text: '운행확정 여부',datafield: 'op_yn',align: 'center',cellsalign: 'center',width: 70, filtertype: 'checkedlist'}
                    ,{text: '집행시작일',datafield: 'st_dt',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120, filtertype: 'checkedlist'}
                    ,{text: '집행종료일',datafield: 'ed_dt',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd,width: 120, filtertype: 'checkedlist'}
                    ,{text: '송출중',datafield: 'opdt_yn',cellsalign: 'center',align: 'center',width: 60, filtertype: 'checkedlist'}
                    ,{text: '구좌수',datafield: 'account_cnt',cellsalign: 'center',align: 'center',cellsformat: 'd',width: 70,aggregates: ['sum'],aggregatesrenderer: aggSum , filtertype: 'checkedlist'}
                    ,{ text: '단가', datafield: 'mda_amt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 100, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    }
                    , { text: '기기수', datafield: 'ins_cnt',  cellsalign: 'center', align: 'center' , cellsformat: 'd', width : 100, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    }
                    ,{text: '보장노출횟수(기/일)',datafield: 'guarant_pos',align: 'center',cellsalign: 'center', width: 110, filtertype: 'checkedlist'}
                    ,{text: '게첨보고서 필요여부',datafield: 'report_yn',cellsalign: 'center',align: 'center',width: 100, filtertype: 'checkedlist'}
                    ,{text: '게첨보고서 전달일자',datafield: 'toss_dt',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd, width: 100, filtertype: 'checkedlist'}
                    ,{text: '관리보고서 필요여부',datafield: 'mg_report_yn',cellsalign: 'center',align: 'center',width: 100, filtertype: 'checkedlist'}
                    ,{text: '관리보고서 전달일자',datafield: 'mg_report',cellsalign: 'center',align: 'center',cellsrenderer: cellYmd, width: 100, filtertype: 'checkedlist'}
                    ,{text: '멀티소재 여부',datafield: 'multi_yn',cellsalign: 'center',align: 'center',width: 60, filtertype: 'checkedlist'}
                    ,{text: '서비스 여부',datafield: 'bns_yn',cellsalign: 'center',align: 'center',width: 60, filtertype: 'checkedlist'}
                    ,{text: '등록일',datafield: 'entr_dt',cellsalign: 'center',align: 'center',width: 120, filtertype: 'checkedlist'}
                    ,{datafield: 'cont_seq', hidden: true, filtertype: 'checkedlist',}
                    ,{datafield: 'cont_mda_seq', hidden: true, filtertype: 'checkedlist',}
                ]
            });

        $('#grid_mda').on('rowdoubleclick', function (event) {
            fn_mdaPopup(event.args.row.bounddata);
        });
    };

    $(document).ready(function () {
        $('#clearfilteringbutton_mda').jqxButton({ theme: theme });
        $('#clearfilteringbutton_mda').click(function () {
            $("#grid_mda").jqxGrid('clearfilters');
        });

        $("#excelExport_mda").jqxButton({ theme: theme });
        $("#excelExport_mda").click(function () {
            $("#grid_mda").jqxGrid('exportdata', 'xlsx',   '계약상품');
        });

        $("#openButton_mda").jqxButton({ theme: theme });
        $("#openButton_mda").on('click', function () {
            $("#grid_mda").jqxGrid('openColumnChooser');
        });
    });
</script>