'use strict';

$(function () {

    let authentication_table = $('.authentication_table');

    if (authentication_table.length) {
        let authenticationTable = authentication_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: {
                url: authentication_table.attr('data-url'),
                data: {}
            },
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
    }
});
