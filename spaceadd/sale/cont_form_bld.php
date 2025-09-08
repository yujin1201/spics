
    <!--계약빌딩 상세-->
    <div class="tbl_frm01 tbl_wrap">
        <div class="" style="margin-top: 25px;height:28px" >
            <div class="subTlt"  style="width:300px"> 계약빌딩 </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:300px;margin-top: 10px;">
            <div id="grid_bld" style="width: 100%; height: 100%;"></div>
            <div style='margin-top: 5px;'>
                <div style='float: left;'>
                    <input value="Remove Filter" id="clearfilteringbutton_bld" type="button" />
                    <input type="button" value="Export to Excel" id='excelExport_bld' />
                    <input type="button" value="컬럼 선택" id='openButton_bld' />
                </div>
            </div>
        </div>
    </div>
<script> 
    bld_grid_load();
    function bld_grid_load() {
        $("#grid_bld").jqxGrid('clear');
        var source_bld =
            {
                datatype: "json",
                datafields: [
                    { name: 'bld_seq',type: 'number'},
                    { name: 'mtrl_sec'},
                    { name: 'st_dt'},
                    { name: 'ed_dt'},
                    { name: 'cont_seq', type: 'number'},
                    { name: 'cont_bld_seq',type: 'number'},
                    { name: 'bld_num'},
                    { name: 'bld_nm'},
                    { name: 'zipcode'},
                    { name: 'addr1'},
                    { name: 'addr2'},
                    { name: 'addr3'},
                    { name: 'bld_type'},
                    { name: 'bld_level'},
                    { name: 'bld_floor'},
                    { name: 'bld_ev1'},
                    { name: 'bld_ev2'},
                    { name: 'area1'},
                    { name: 'area2'},
                    { name: 'bld_pkg'},
                    { name: 'ds_type'},
                    { name: 'ds_ev1'},
                    { name: 'ds_ev2'},
                    { name: 'ds_ev3'},
                    { name: 'ds_ev4'},
                    { name: 'disable_cnt'},
                    { name: 'ins_cnt'},
                    { name: 'ins_sec'},
                    { name: 'use_st_dt'},
                    { name: 'use_ed_dt'},
                    { name: 'excpt_item'},
                    { name: 'bigo'},
                    { name: 'use_yn'},
                    { name: 'del_yn'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'} ,
                    { name: 'bld_type_nm'},
                    { name: 'bld_div'} ,
                    { name: 'cont_div'} ,
                ],
                url: './cont_form_bld_result.php',
                cache: false,
                data: {
                    cont_seq: '<?php echo $cont['cont_seq'] ?>'
                }
            };
        var adapter_bld = new $.jqx.dataAdapter(source_bld);

        $("#grid_bld").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter_bld,
                filterable: true,
                filterbarmode: 'simple',
                showfilterbar: false,
                sortable: true,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columnsresize: true,
                columnsreorder: true,
                //selectionmode: 'checkbox',
                columns: [
                    {
                        text: '#',columntype: 'number', width: 50, cellsalign: 'center', align: 'center',
                        cellsrenderer: cellRowNum,
                        aggregates: ['count'],
                        aggregatesrenderer: aggCount
                    },
                    { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                    { text: '운행 시작일', datafield: 'st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '운행 종료일', datafield: 'ed_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                    { text: '빌딩코드', datafield: 'bld_num', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100,  editable: false } ,
                    { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170,  editable: false } ,
                    { text: '건물유형', datafield: 'bld_type_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170,  editable: false } ,
                    { text: '기기초수', datafield: 'ins_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100,  editable: false } ,
                    { text: '주소1', datafield: 'addr1', filtertype: 'checkedlist', cellsalign: 'left', align: 'center'  ,width:270 ,  editable: false } ,
                    { text: '금지업종', datafield: 'excpt_item', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center'  ,width:170,  editable: false } ,
                    { text: '등록자', datafield: 'entr_prsn', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:130,  editable: false } ,

                    {datafield: 'bld_seq', hidden: true,  } ,
                    {datafield: 'cont_seq', hidden: true,  } ,
                    {datafield: 'cont_bld_seq', hidden: true,  } ,
                ]
            });

        $('#grid_bld').on('rowdoubleclick', function (event) {
            fn_bldPopup(event.args.row.bounddata);
        });
    };

    $(document).ready(function () {
        $('#clearfilteringbutton_bld').jqxButton({ theme: theme });
        $('#clearfilteringbutton_bld').click(function () {
            $("#grid_bld").jqxGrid('clearfilters');
        });

        $("#excelExport_bld").jqxButton({ theme: theme });
        $("#excelExport_bld").click(function () {
            $("#grid_bld").jqxGrid('exportdata', 'xlsx',   '계약빌딩');
        });

        $("#openButton_bld").jqxButton({ theme: theme });
        $("#openButton_bld").on('click', function () {
            $("#grid_bld").jqxGrid('openColumnChooser');
        });
    });
</script>