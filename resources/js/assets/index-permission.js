'use strict';

$(function () {
    let permission_table = $('.permission_table');
    if (permission_table.length) {
        let table = permission_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: permission_table.attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'name'},
                {data: 'guard_name'},
            ],
            aaSorting: [],
            orderCellsTop: true,
        });
    }
});
