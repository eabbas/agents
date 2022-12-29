<a data-destroy="{{ route('agent.clients.destroy', ['client' => $id]) }}" onclick="onDelete(this);"
    class="btn btn-sm btn-sm btn-danger">حذف</a>
<a href="{{ route('agent.clients.edit', ['client' => $id]) }}" class="btn btn-sm btn-sm btn-warning">ویرایش</a>
<p class="btn btn-sm btn-sm btn-success" onclick="order_by_agent($(this).closest('tr').attr('id'))"> ثبت سفارش - ارتقا</p>
<a href="{{ route('agent.clients.details', ['client' => $id]) }}" class="btn btn-sm btn-sm btn-info">جزییات</a>
