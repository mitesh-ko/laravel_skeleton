$(function(){let a=$(".permission_table");a.length&&a.DataTable({dom:"<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",ajax:a.attr("data-url"),processing:!0,serverSide:!0,columns:[{data:"name"},{data:"guard_name"}],aaSorting:[],orderCellsTop:!0})});