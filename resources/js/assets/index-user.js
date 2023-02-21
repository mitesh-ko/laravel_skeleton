/**
 * DataTables Advanced (jquery)
 */

'use strict';

$(function () {

    $(document).on("click", ".delete-user", function () {
        Swal.fire({
            title: 'Are you sure you would like delete user',
            text: 'Are you sure you would like to deactivate your account?',
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
    let dt_adv_filter_table = $('.dt-advanced-search');

    var rangePickr = $('.flatpickr-range'),
        dateFormat = 'MM/DD/YYYY';

    if (rangePickr.length) {
        rangePickr.flatpickr({
            mode: 'range',
            dateFormat: 'm/d/Y',
            locale: {
                format: dateFormat
            },
            onClose: function (selectedDates, dateStr, instance) {
                var startDate = '',
                    endDate = new Date();
                if (selectedDates[0] != undefined) {
                    startDate = moment(selectedDates[0]).format('MM/DD/YYYY');
                    startDateEle.val(startDate);
                }
                if (selectedDates[1] != undefined) {
                    endDate = moment(selectedDates[1]).format('MM/DD/YYYY');
                    endDateEle.val(endDate);
                }
                $(rangePickr).trigger('change').trigger('keyup');
            }
        });
    }

    function filterColumn(i, val) {
        if (i === 5) {
            var startDate = startDateEle.val(),
                endDate = endDateEle.val();
            if (startDate !== '' && endDate !== '') {
                $.fn.dataTableExt.afnFiltering.length = 0; // Reset datatable filter
                dt_adv_filter_table.dataTable().fnDraw(); // Draw table after filter
                filterByDate(i, startDate, endDate); // We call our filter function
            }
            dt_adv_filter_table.dataTable().fnDraw();
        } else {
            dt_adv_filter_table.DataTable().column(i).search(val, false, true).draw();
        }
    }

    // Advance filter function
    // We pass the column location, the start date, and the end date
    $.fn.dataTableExt.afnFiltering.length = 0;
    var filterByDate = function (column, startDate, endDate) {
        // Custom filter syntax requires pushing the new filter to the global filter array
        $.fn.dataTableExt.afnFiltering.push(function (oSettings, aData, iDataIndex) {
            var rowDate = normalizeDate(aData[column]),
                start = normalizeDate(startDate),
                end = normalizeDate(endDate);

            // If our date from the row is between the start and end
            if (start <= rowDate && rowDate <= end) {
                return true;
            } else if (rowDate >= start && end === '' && start !== '') {
                return true;
            } else if (rowDate <= end && start === '' && end !== '') {
                return true;
            } else {
                return false;
            }
        });
    };

    // converts date strings to a Date object, then normalized into a YYYYMMMDD format (ex: 20131220). Makes comparing dates easier. ex: 20131220 > 20121220
    var normalizeDate = function (dateString) {
        var date = new Date(dateString);
        var normalized =
            date.getFullYear() + '' + ('0' + (date.getMonth() + 1)).slice(-2) + '' + ('0' + date.getDate()).slice(-2);
        return normalized;
    };
    // Advanced Search Functions Ends

    // Advanced Search
    // --------------------------------------------------------------------

    // Advanced Filter table
    if (dt_adv_filter_table.length) {
        let table = dt_adv_filter_table.DataTable({
            dom: "<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",
            ajax: $(".user-search").attr('data-url'),
            processing: true,
            serverSide: true,
            columns: [
                {data: 'name'},
                {data: 'email'},
                {data: 'joined_on'},
                {data: 'action'},
            ],
            aaSorting: [],
            columnDefs: [
                {
                    className: 'action',
                    orderable: false,
                    targets: 3,
                }
            ],
            orderCellsTop: true,
        });
        $(".email").keyup(function () {
            table.draw();
        });
    }

    $('input.dt-input').on('keyup', function () {
        filterColumn($(this).attr('data-column'), $(this).val());
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 200);
});
