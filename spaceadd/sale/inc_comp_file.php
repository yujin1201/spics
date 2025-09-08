
        <!--계약 청구 -->
    <div class="tbl_frm01 tbl_wrap">
        <div class="" style="margin-top: 15px" >
            <div class="subTlt" style="width:300px" >
                첨부파일
            </div>
            <div class="btn_list03">
                <button type="button" class="btn_new" onclick="fn_filePopup();">첨부파일 등록</button>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:205px;">
            <div id="grid_file"  style="width: 100%; height: 100%;">
            </div>
        </div>
    </div>

    <script>
    function fn_filePopup(){
        var url ="pop_file_upload.php?comp_seq=<?php echo $comp['comp_seq'] ?>";

        basicPopupOpen(url, "파일 첨부", "600", "200")  ;
    }
    function fn_down_Popup(voJson){
        
        //jpg|jpeg|png|gif|bmp 이미지면 보여주고 아니면 다운
        if(voJson.file_type =='jpg' || voJson.file_type =='jpeg' 
            || voJson.file_type =='png' || voJson.file_type =='gif' 
            || voJson.file_type =='bmp' ){
            var url ="inc_comp_file_view.php?file_seq="+voJson.file_seq;

            basicPopupOpen(url, "파일 보기", "900", "600")  ;
        }else{
            //파일 다운
            (function($){
                document.location.href = "inc_comp_file_download.php?file_seq="+voJson.file_seq;
            })(jQuery);
        }
        
    }
    file_grid_load();
    function file_del_callBack(){
        file_grid_load();
    }
    function file_grid_load(){
        $("#grid_file").jqxGrid('clear');
        var source_fin =
            {
                datatype: "json",
                datafields: [
                    { name: 'file_seq'},
                    { name: 'comp_seq'},
                    { name: 'file_source'},
                    { name: 'file_save'},
                    { name: 'file_download'},
                    { name: 'file_content'},
                    { name: 'file_url'},
                    { name: 'file_thumburl'},
                    { name: 'file_storage'},
                    { name: 'file_size'},
                    { name: 'file_width'},
                    { name: 'file_height'},
                    { name: 'file_type'},
                    { name: 'entr_prsn'},
                    { name: 'entr_dt'},
                    { name: 'updt_prsn'},
                    { name: 'updt_dt'}
                ],
                url: g_sale_url+'/inc_comp_file_result.php',
                cache: false,
                data:{
                    comp_seq: '<?php echo $comp['comp_seq'] ?>'
                }
            };
        var adapter_fin = new $.jqx.dataAdapter(source_fin);
        $("#grid_file").jqxGrid(
            {
                width: '100%',
                height: '100%',
                source: adapter_fin,
                columnsresize: true,
                filterable: false,
                sortable: false,
                showstatusbar: true,
                statusbarheight: 27,
                showaggregates: true,
                autoshowfiltericon: true,
                columns: [
                    {
                        text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                        cellsrenderer: cellRowNum
                    },
                    { text: '첨부번호', datafield: 'file_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center', width: 80},
                    { text: '파일명', datafield: 'file_source', filtertype: 'checkedlist', cellsalign: 'center', align: 'center', width: 250},
                    { text: '용량(MB)', datafield: 'file_size', filtertype: 'checkedlist', cellsalign: 'center', align: 'center', width: 80},
                    { text: '타입', datafield: 'file_type', filtertype: 'checkedlist', cellsalign: 'center', align: 'center', width: 80},
                    { text: '설명', datafield: 'file_content', filtertype: 'checkedlist' , cellsalign: 'left', align: 'center' },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center' , width: 140  },
                    {
                        text: '삭제', datafield: 'Edit', columntype: 'button', align: 'center', width: 80, cellsrenderer: function () {
                            return "삭제";
                        }, buttonclick: function (row) {
                            if(delete_confirm2("정말 삭제 하시겠습니까?")){

                                var dataRecord = $("#grid_file").jqxGrid('getrowdata', row);
                                $.get('pop_file_upload_update.php?w=D&file_seq='+dataRecord.file_seq,file_del_callBack);
                            }
                        }
                    },
                    { datafield: 'file_save', hidden: true },
                    { datafield: 'file_url', hidden: true },
                    { datafield: 'file_storage', hidden: true },
                    {  datafield: 'file_download', hidden: true }
                ]
            });

        $('#grid_file').on('rowdoubleclick', function (event) {
            fn_down_Popup( event.args.row.bounddata)  ;
        });
    };
</script>
