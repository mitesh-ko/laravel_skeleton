'use strict';

$(function () {
    let role_table = $('.audit_table');

    if (role_table.length) {
        let table = role_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: role_table.attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'created_at'},
                {data: 'user'},
                {data: 'event'},
                {data: 'ip_address'},
                {data: 'view'},
            ],
            aaSorting: [],
            columnDefs: [
                {
                    className: 'action',
                    orderable: false,
                    targets: 4
                }
            ],
            orderCellsTop: true,
        });
    }
});
