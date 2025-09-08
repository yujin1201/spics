
<div style='margin-top: 20px;'>
    <div style='float: left;'>
        <input value="Remove Filter" id="clearfilteringbutton" type="button" />
        <input type="button" value="Export to Excel" id='excelExport' />
        <input type="button" value="컬럼 선택" id='openButton' />
    </div>
</div>
<script type="text/javascript">
    function addfilter() {
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

    $(document).ready(function () {
        $('#clearfilteringbutton').jqxButton({ theme: theme });
        $('#clearfilteringbutton').click(function () {
            $("#grid").jqxGrid('clearfilters');
        });

        $("#excelExport").jqxButton({ theme: theme });
        $("#excelExport").click(function () {
            $("#grid").jqxGrid('exportdata', 'xlsx', $("#container_title").html(), true, null , false , null, "euc-kr");

        });

        $("#openButton").jqxButton({ theme: theme });
        $("#openButton").on('click', function () {
            $("#grid").jqxGrid('openColumnChooser');
        });
        $('#btn_gnb').click(function () {
            $('#grid').jqxGrid('render');
        });

    });
</script>