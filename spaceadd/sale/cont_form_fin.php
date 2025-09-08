
        <!--계약 청구 -->
    <div class="tbl_frm01 tbl_wrap" style="" >
        <div class="" style="margin-top: 25px;height:28px" >
            <div class="subTlt" style="width:300px;" >
                계약청구
            </div>
            <div class="btn_list03">
              <?if($finAble_yn =="Y"){?>
                <button  class="btn_new" onclick="fn_finPopup();">등록</button>
              <?}?>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:305px;">
            <div id="grid_fin"  style="width: 100%; height: 100%;"></div>
            <div style='margin-top: 5px;'>
                <div style='float: left;'>
                    <input value="Remove Filter" id="clearfilteringbutton_fin" type="button" />
                    <input type="button" value="Export to Excel" id='excelExport_fin' />
                    <input type="button" value="컬럼 선택" id='openButton_fin' />
                </div>
            </div>
        </div>
    </div>

    <script>
    //청구===========
    function fn_finPopup(voJson){
        var url = "" ;
        if(( voJson??"")  != "" ){
          url ="cont_form_pop_fin.php?cont_seq=<?php echo $cont['cont_seq'] ?>&fin_seq="+voJson.fin_seq   ;
            basicPopupOpen(url, "계약 청구 정보", "1200", "600")  ;
        }else{
            url ="cont_form_pop_fin_all.php?cont_seq=<?php echo $cont['cont_seq'] ?>";
            basicPopupOpen(url, "계약 청구 정보", "1200", "750")  ;
        }
    }
    fin_grid_load();
    function fin_grid_load(){
        $("#grid_fin").jqxGrid('clear');
        var source_fin =
            {
                datatype: "json",
                datafields: [
                    { name: 'fin_seq'},
                    { name: 'inout_type'},
                    { name: 'inout_type_nm'},
                    { name: 'adj_type_code'},
                    { name: 'adj_type_nm'},
                    { name: 'adj_yearmon'},
                    { name: 'sell_amt', type: 'number'},
                    { name: 'out_amt', type: 'number'},
                    { name: 'in_amt', type: 'number'},
                    { name: 'agnt_cmms_rt', type: 'number'},
                    { name: 'cnsg_cmms_rt', type: 'number'},
                    { name: 'agnt_cmms_amt', type: 'number'},
                    { name: 'cnsg_cmms_amt', type: 'number'},
                    { name: 'rep_cmms_rt', type: 'number'},
                    { name: 'rep_cmms_amt', type: 'number'},
                    { name: 'adj_yn'},
                    { name: 'bill_dt'},
                    { name: 'send_dt'},
                    { name: 'out_dt'},
                    { name: 'stl_condi_code'},
                    { name: 'stl_condi_nm'},
                    { name: 'stl_condi_cntnts'},
                    { name: 'bigo'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'},
                    { name: 'rsv_comp_seq'},
                    { name: 'rsv_comp_nm'},
                    { name: 'snd_comp_seq'},
                    { name: 'snd_comp_nm'}

                ],
                url: g_sale_url+'/cont_form_fin_result.php',
                cache: false,
                data:{
                    cont_seq: '<?php echo $cont['cont_seq'] ?>'
                }
            };
        var adapter_fin = new $.jqx.dataAdapter(source_fin);
        $("#grid_fin").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter_fin,
                columnsresize: true,
                filterable: true,
                sortable: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                columns: [
                    {
                        text: '#',  columntype: 'number', width:50,cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum ,
                        aggregates: ['count'] ,
                        aggregatesrenderer: aggCount
                    },
                    { text: '거래구분', datafield: 'inout_type_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '청구구분', datafield: 'adj_type_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '청구년월', datafield: 'adj_yearmon',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYm , width : 130, filtertype: 'checkedlist'
                        ,aggregates: [{
                                function (aggregatedValue, currentValue, column, record) {
                                    var total =  parseInt(record['out_amt']) - parseInt(record['in_amt']);
                                    return  aggregatedValue + total ;
                                }
                        }],
                        aggregatesrenderer: function (aggregates) {
                            var renderstring = "";
                            $.each(aggregates, function (key, value) {
                                renderstring += '<div style="position: relative; margin: 2px; overflow: hidden; text-align: center; color:#c52323;font-weight:700">매출이익 : ' + adapter_fin.formatNumber(parseInt(value) , 'd') + '</div>';
                            });
                            return renderstring;
                        }
                    },
                    { text: '매출', datafield: 'out_amt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 100, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '매입', datafield: 'in_amt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 100, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '대행수수료율', datafield: 'agnt_cmms_rt',  cellsalign: 'right', align: 'center' , cellsformat: 'd', width : 100, filtertype: 'checkedlist',
                        aggregates: ['sum'] ,
                        aggregatesrenderer: aggSum
                    },
                    { text: '세금계산서 발행일', datafield: 'bill_dt',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100, filtertype: 'checkedlist' },
                    { text: '계산서 발행처', datafield: 'snd_comp_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '계산서 수신처', datafield: 'rsv_comp_nm',  cellsalign: 'center', align: 'center' ,  width : 130 , filtertype: 'checkedlist' } ,
                    { text: '입금일', datafield: 'send_dt',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100 , filtertype: 'checkedlist'},
                    { text: '출금일', datafield: 'out_dt',  cellsalign: 'center', align: 'center' ,cellsrenderer : cellYmd, width : 100, filtertype: 'checkedlist' },
                    { text: '결제조건', datafield: 'stl_condi_nm',  cellsalign: 'center', align: 'center', width : 150 , filtertype: 'checkedlist'},
                    { text: '정산완료 여부', datafield: 'adj_yn',  cellsalign: 'center', align: 'center', width : 60 , filtertype: 'checkedlist'},
                    { text: '등록일', datafield: 'entr_dt',  cellsalign: 'center', align: 'center' , filtertype: 'checkedlist'  },
                    { datafield: 'cont_seq', hidden: true },
                    {  datafield: 'fin_seq', hidden: true }
                ]
            });

        $('#grid_fin').on('rowdoubleclick', function (event) {
            fn_finPopup( event.args.row.bounddata)  ;
        });

        $(document).ready(function () {
            $('#clearfilteringbutton_fin').jqxButton({ theme: theme });
            $('#clearfilteringbutton_fin').click(function () {
                $("#grid_fin").jqxGrid('clearfilters');
            });

            $("#excelExport_fin").jqxButton({ theme: theme });
            $("#excelExport_fin").click(function () {
                $("#grid_fin").jqxGrid('exportdata', 'xlsx',   '계약청구');
            });

            $("#openButton_fin").jqxButton({ theme: theme });
            $("#openButton_fin").on('click', function () {
                $("#grid_fin").jqxGrid('openColumnChooser');
            });
        });
    };
</script>
