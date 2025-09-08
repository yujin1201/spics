<?php
$sub_menu = "100300";
include_once('./_common.php');

//auth_check_menu($auth, $sub_menu, 'r');


$g5['title'] = '광고주 관리';
include_once('./sale.head2.php');

$sql = " select sum(case when deal_sts_code='BAA01' then 1 else 0 end) as sts_ok,
            sum(case when deal_sts_code !='BAA01' then 1 else 0 end) as sts_stop
             from tb_comp; ";
$row = sql_fetch($sql);
print_r($row);
?>
<script type="text/javascript" src="/spaceadd/erp/scripts/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxdata.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxscrollbar.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxinput.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxgrid.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxgrid.selection.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="/jqwidgets/globalization/globalize.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxcalendar.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxdatetimeinput.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="https://spaceadd2.cafe24.com/spaceadd/erp/scripts/demos.js"></script>
<script type="text/javascript" src="https://spaceadd2.cafe24.com/spaceadd/erp/scripts/jszip.min.js"></script>

<script type="text/javascript" src="/jqwidgets/jqxdata.export.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxgrid.export.js"></script>
<script type="text/javascript" src="/jqwidgets/jqxexport.js"></script>


<script src="https://spaceadd2.cafe24.com/spaceadd/js/jquery-migrate-1.4.1.min.js?ver=191202"></script>
<script src="https://spaceadd2.cafe24.com/spaceadd/js/jquery.menu.js?ver=191202"></script>
<script src="https://spaceadd2.cafe24.com/spaceadd/js/common.js?ver=191202"></script>
<script src="https://spaceadd2.cafe24.com/spaceadd/js/wrest.js?ver=191202"></script>
<script src="https://spaceadd2.cafe24.com/spaceadd/js/placeholders.min.js?ver=191202"></script>
<script type="text/javascript">
    $('#main_grid').bind('resize', function(){
        //console.log('resized');
    });
    $(document).ready(function () {
        //var data = generatedata(500);
        //var exampleTheme = theme;
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'comp_seq'},
                    { name: 'comp_nm'},
                    { name: 'comp_type'},
                    { name: 'busi_no'},
                    { name: 'rep_nm1'},
                    { name: 'entr_dt'}
                ],
                url: 'comp_list_result.php',
                cache: false
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
                source: adapter,
                filterable: true,
                sortable: true,
                ready: function () {
                    addfilter();
                },
                autoshowfiltericon: true,
                columns: [
                    { text: '광고주 코드', datafield: 'comp_seq', filtertype: 'checkedlist', width: 160},
                    { text: '광고주 명', datafield: 'comp_nm', filtertype: 'checkedlist', width: 160},
                    { text: '회사 구분', datafield: 'comp_type', filtertype: 'checkedlist', width: 170 },
                    { text: '거래 상태', datafield: 'busi_no', filtertype: 'checkedlist', width: 170 },
                    { text: '담당자 명', datafield: 'rep_nm1', filtertype: 'checkedlist', width: 170 },
                    { text: '등록일', datafield: 'entr_dt', filtertype: 'date', width: 160 }
                ]
            });

        $('#clearfilteringbutton').jqxButton({ height: 25 });
        $('#clearfilteringbutton').click(function () {
            $("#grid").jqxGrid('clearfilters');
        });

        $("#excelExport").jqxButton();
        $("#excelExport").click(function () {
            $("#grid").jqxGrid('exportdata', 'xlsx', 'jqxGrid');
        });


        $('#grid').on('rowdoubleclick', function (event) {
            var getRowData = $('#grid').jqxGrid('getrows')[event.args.rowindex];

            alert(getRowData['comp_nm']);
        });

    });
</script>
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Base UI</a></li>
                        <li class="breadcrumb-item active">Grid System</li>
                    </ol>
                </div>
                <h4 class="page-title">Grid System</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div id="grid"  style="width: 100%; height: 100%;">
                    </div>
                    <div style='margin-top: 20px;'>
                        <div style='float: left;'>
                            <input value="Remove Filter" id="clearfilteringbutton" type="button" /> <input type="button" value="Export to Excel" id='excelExport' />
                        </div>

                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
    <!-- end row -->

</div> <!-- container -->




<?php
include_once ('./sale.tail2.php');
?>
