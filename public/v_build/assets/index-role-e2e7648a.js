$(function(){$(document).on("click",".delete_role",function(){Swal.fire({title:"Are you sure you would like delete this role",html:`<form action="${$(this).attr("data-url")}" method="POST">
                    <input type="hidden" name="_token" value="${$("meta[name='csrf-token']").attr("content")}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" class="btn btn-danger" value="Yes">
                    </form>`,icon:"warning",showCancelButton:!1,showConfirmButton:!1,showDenyButton:!1,showCloseButton:!0}).then(t=>{})});let e=$(".role_table");e.length&&e.DataTable({dom:"<'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-6'i><'col-sm-12 col-md-6 dataTables_pager'p>>",ajax:e.attr("data-url"),processing:!0,serverSide:!0,columns:[{data:"name"},{data:"guard_name"},{data:"action"}],aaSorting:[],columnDefs:[{className:"action",orderable:!1,targets:2}],orderCellsTop:!0})});
