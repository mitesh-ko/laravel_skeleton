'use strict';

$(function () {

    $(document).on("click", ".delete_role", function () {
        Swal.fire({
            title: 'Are you sure you would like delete this role',
            html: `<form action="${$(this).attr('data-url')}" method="POST">
                    <input type="hidden" name="_token" value="${$('meta[name=\'csrf-token\']').attr('content')}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger" value="Yes">
                    </form>`,
            icon: 'warning',
            showCancelButton: false,
            showConfirmButton: false,
            showDenyButton: false,
            showCloseButton: true,
        }).then((result) => {
        })
    })
    let role_table = $('.role_table');


    if (role_table.length) {
        let table = role_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: role_table.attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'name'},
                {data: 'guard_name'},
                {data: 'action'},
            ],
            aaSorting: [],
            columnDefs: [
                {
                    className: 'action',
                    orderable: false,
                    targets: 2,
                }
            ],
            orderCellsTop: true,
        });
    }
});
