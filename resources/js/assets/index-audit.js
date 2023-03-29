'use strict';

$(function () {
    let role_table = $('.audit_table');

    if (role_table.length) {
        let auditTable = role_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: role_table.attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'created_at'},
                {data: 'user'},
                {data: 'auditable_type'},
                {data: 'event'},
                {data: 'ip_address'},
                {data: 'view'},
            ],
            aaSorting: [],
            columnDefs: [
                {
                    className: 'action',
                    orderable: false,
                    targets: 5
                }
            ],
            orderCellsTop: true,
        });

        function searchAudit() {
            auditTable.column(2).search($("#search-model").val()).
            column(3).search($("#search-action").val()).
            column(4).search($("#search-ip").val()).draw();
        }
        $("#search-request").click(function () {
            searchAudit()
        })
        $("#clear-search").click(function () {
            $("#search-model").val('');
            $("#search-action").val('');
            $("#search-ip").val('');
            searchAudit()
        })
    }
});
