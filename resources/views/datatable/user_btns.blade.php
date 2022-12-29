<p class="btn btn-sm btn-sm btn-warning" onclick="datatable_edit($(this).closest('tr').attr('id'))"> ویرایش </p>
<a data-destroy="{{ route('agent.users.destroy', ['user' => $id]) }}" class="btn btn-sm btn-sm btn-danger">حذف</a>
<p class="btn btn-sm btn-sm btn-info" onclick="datatable_details($(this).closest('tr').attr('id'))"> جزییات </p>
<p class="btn btn-sm btn-sm btn-danger" onclick="login_as($(this).closest('tr').attr('id'))"> ورود به پنل </p>
