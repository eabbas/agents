<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)->setRowId('id')
            ->editColumn('action', 'datatable.user_btns');
    }

    /**
     * Get query source of dataTable.
     *
     * @param User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        $query = $model->newQuery();
        return $query->applyScopes($model->scopeAgent($query));
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
            ])
            ->setTableId('users')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('myCustomAction'),
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            )->parameters([
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print', 'reset', 'reload'],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('full_name')->title('نام کامل'),
            Column::make('created_at'),
            Column::computed('action')->title('عملیات')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }


    protected $exportColumns = [
        ['data' => 'name', 'title' => 'Name'],
        ['data' => 'email', 'title' => 'Registered Email'],
    ];

    public function myCustomAction()
    {
        return 1;
    }
}
