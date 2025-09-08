<?php
$sub_menu = "";
include_once('./_common.php');
$g5['title'] = "계약빌딩 등록 확인";
include_once(G5_SALE_PATH.'/sale.head.popup.php');

?>
    <script type="text/javascript">
        var source = {} ;
        var initiallySelectedRows = [];
        jQuery(function($) {
            var params = opener.fn_openParams() ;
          //  console.log(params)
            source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'bld_seq',type: 'number'},
                        { name: 'bld_num'},
                        { name: 'bld_nm'},
                        { name: 'ins_sec'},
                        { name: 'cont_seq', type: 'number'},
                        { name: 'cont_nm'},
                        { name: 'cont_type_code'},
                        { name: 'cont_type_nm'},
                        { name: 'mda_type'},
                        { name: 'cont_yearmon' , type: 'string'},
                        { name: 'cont_stat'},
                        { name: 'cont_stat_nm'},
                        { name: 'cli_seq'},
                        { name: 'cli_nm'},
                        { name: 'agncy_seq'},
                        { name: 'agncy_nm'},
                        { name: 'cont_st_dt' , type: 'string'},
                        { name: 'cont_ed_dt' , type: 'string'},
                        { name: 'mtrl_sec'},
                        { name: 'st_date'},
                        { name: 'ed_date'},
                        { name: 'ins_cnt'},
                    ],
                    url: g_sale_url+'/bld_cont_reg_pop_result.php',
                    type: 'post',
                    cache: false,
                    data: params
                };

            var adapter = new $.jqx.dataAdapter(source );
            $("#grid").jqxGrid('clear');
            $("#grid").jqxGrid(
                {
                    width: '100%',
                    height: '100%',
                    source: adapter,
                    columnsresize: true,
                    filterable: false,
                    sortable: true,
                    showstatusbar: true,
                    statusbarheight: 27,
                    showaggregates: true,
                    selectionmode: 'checkbox',
                    altrows: true,
                    editable:  true ,
                    autoshowfiltericon: true,
                    columnsreorder: false,
                    ready: function () {
                    },
                    columns: [
                        {
                            text: '#', columntype: 'number', width:50,cellsalign: 'center', align: 'center',filtertype: 'checkedlist',
                            cellsrenderer: cellRowNum ,
                            aggregates: ['count'] ,
                            aggregatesrenderer: aggCount ,
                        },
                        { text: '초수', datafield: 'mtrl_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70},
                        { text: '운행 시작일', datafield: 'st_date', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },
                        { text: '운행 종료일', datafield: 'ed_date', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd },

                        { text: '빌딩코드', datafield: 'bld_num', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70,  editable: false  },
                        { text: '빌딩명', datafield: 'bld_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:170,  editable: false },
                        { text: '기기초수', datafield: 'ins_sec', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100,  editable: false
                          ,  aggregates: ['sum'] , aggregatesrenderer: aggCount ,

                        },
                        { text: '기기수', datafield: 'ins_cnt', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100,  editable: false, aggregates: ['sum'] ,  aggregatesrenderer: aggCount ,},
                        { text: '계약 코드', datafield: 'cont_seq', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:70,     editable: false },
                        { text: '계약명', datafield: 'cont_nm', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:300,  editable: false },
                        { text: '계약월', datafield: 'cont_yearmon', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYm,  editable: false },
                         { text: '광고주', datafield: 'cli_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150,  editable: false },
                        { text: '광고회사', datafield: 'agncy_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:150,  editable: false },
                        { text: '계약상태', datafield: 'cont_stat_nm', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:120,  editable: false },
                        { text: '계약시작일', datafield: 'cont_st_dt', filtertype: 'checkedlist' , cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd ,  editable: false },
                        { text: '계약종료일', datafield: 'cont_ed_dt', filtertype: 'checkedlist', cellsalign: 'center', align: 'center'  ,width:100 ,cellsrenderer : cellYmd ,  editable: false },
                         {datafield: 'bld_seq', hidden: true,  } ,
                    ]
                });
        });

        /*저장*/
        function fn_submit(){
            var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
            if(rowindexes.length ==  0 ){
                alert("등록할 항목을 선택하십시오.  ");
                return false ;
            }
            var media=[];
            rowindexes.forEach(function(element){
                var data = $('#grid').jqxGrid('getrowdatabyid', element);
                media.push(data)  ;
            } );
            var params = fn_chkForm("fcomp") ;
            if(!params){
                return false ;
            }
            params.list  = media ;
            fn_submission("subForm", "./bld_cont_reg_pop_update.php", params, true, fn_subCallback  );
        }

        function fn_subCallback(subid, voJson){
            try{
                alert("처리 되었습니다.["+voJson+" 개 등록]") ;
                var callbacks = $.Callbacks();
                callbacks.add(eval("opener.fn_subPopCallback"));
                callbacks.fire(voJson );
                self.close();
            }catch (e) {
                console.log(e)
            }
        }

    </script>
    <form name="fcomp" id="fcomp"  method="get" onsubmit="return false;"  >
        <div class="btn_list" style="margin-top:5px">
            <div>
                <b>* 체크된 항목만 저장됩니다.</b>
            </div>
        </div>
        <div id="main_grid" class="tbl_head01 tbl_wrap" style="width: 100%; height:520px;">
            <div id="grid"  style="width: 100%; height: 100%;"></div>

            <?php
            include_once('./common/comm_grid_btns.php');
            ?>
        </div>
    </form>
    <div class="" align="center">
         <button  class="btn btn_save btn_lg" onclick="fn_submit();">저장</button>
        <button  class="btn btn_close btn_lg" onclick="return window.close();">닫기</button>
    </div>
    </body>
    </html>
<?php
include_once(G5_PATH.'/tail.sub.php');
?>