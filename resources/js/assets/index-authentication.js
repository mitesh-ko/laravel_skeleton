'use strict';

$(function () {
    let authentication_table = $('.authentication_table');

    if (authentication_table.length) {
        let authenticationTable = authentication_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: authentication_table.attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'authenticatable_type'},
                {data: 'authenticatable_id'},
                {data: 'ip_address'},
                {data: 'user_agent'},
                {data: 'login_at'},
                {data: 'login_successful'},
                {data: 'logout_at'},
            ],
            aaSorting: [],
            columnDefs: [],
            orderCellsTop: true,
        });

        function searchAudit() {
            authenticationTable.column(2).search($("#search-user").val()).draw();
        }
        $("#search-request").click(function () {
            searchAudit()
        })
        $("#clear-search").click(function () {
            $("#search-user").val('');
            searchAudit()
        })
    }
});
