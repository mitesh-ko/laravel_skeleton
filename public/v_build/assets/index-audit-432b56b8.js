$(function(){let a=$(".audit_table");if(a.length){let e=function(){t.column(2).search($("#search-model").val()).column(3).search($("#search-action").val()).column(4).search($("#search-ip").val()).draw()};var l=e;let t=a.DataTable({dom:"<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",ajax:a.attr("data-url"),processing:!0,serverSide:!0,columns:[{data:"created_at"},{data:"user"},{data:"auditable_type"},{data:"event"},{data:"ip_address"},{data:"view"}],aaSorting:[],columnDefs:[{className:"action",orderable:!1,targets:5}],orderCellsTop:!0});$("#search-request").click(function(){e()}),$("#clear-search").click(function(){$("#search-model").val(""),$("#search-action").val(""),$("#search-ip").val(""),e()})}});