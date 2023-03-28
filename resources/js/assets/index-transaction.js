$(function () {
    'use strict';

    $(document).on("click", ".delete-transaction", function () {
        Swal.fire({
            title: 'Are you sure you want to delete this transaction.',
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

    let transactionListTable = $('.transaction-list-table');
    if (transactionListTable.length) {
        let transactionTable = transactionListTable.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: transactionListTable.attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'type'},
                {data: 'amount'},
                {data: 'payment_date'},
                {data: 'desc'},
                {data: 'status'},
                {data: 'action'},
            ],
            aaSorting: [],
            columnDefs: [
                {
                    className: 'action',
                    orderable: false,
                    targets: 5,
                }
            ],
            orderCellsTop: true,
        });

        function searchTransaction() {
            transactionTable
                .column(0).search($("#search-type").val())
                .column(1).search($("#search-amount").val())
                .column(2).search($("#search-date").val())
                .column(4).search($("#search-status").val())
                .draw();
        }

        $("#search-request").click(function () {
            searchTransaction()
        })

        $("#clear-search").click(function () {
            $("#search-name").val('');
            $("#search-amount").val('');
            $("#search-date").val('');
            $("#search-status").val('');
            searchTransaction()
        })
    }
});
