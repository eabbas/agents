<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClientsDataTable extends DataTable
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
            ->editColumn('action', 'datatable.client_btns');
    }

    /**
     * Get query source of dataTable.
     *
     * @param Client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->newQuery();
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
                'columnDefs' => [
                    [
                        "className" => "dt-center", "targets" => "_all"
                    ],
                    [
                        'targets' => 0,
                        'width' => '10%',
                        'responsivePriority' => 1
                    ],
                    [
                        'targets' => 1,
                        'width' => '15%',
                        'responsivePriority' => 3
                    ],
                    [
                        'targets' => 2,
                        'width' => '10%',
                        'responsivePriority' => 4
                    ],
                    [
                        'targets' => 3,
                        'width' => '15%',
                        'responsivePriority' => 5
                    ],
                    [
                        'targets' => 4,
                        'width' => '15%',
                        'responsivePriority' => 6
                    ],
                    [
                        'targets' => 5,
                        'width' => '10%',
                        'responsivePriority' => 7
                    ],
                    [
                        'targets' => 6,
                        'width' => '35%',
                        'responsivePriority' => 2
                    ],
                ]
            ])
            ->setTableId('clients-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        return [
            Column::make('id')->title(__("_.id")),
            Column::make('full_name')->title(__("_.fullname")),
            Column::make('job')->title(__("_.job")),
            Column::make('province')->title(__("_.province")),
            Column::make('city')->title(__("_.city")),
            Column::make('created_at')->title(__("_.created at")),
            Column::computed('action')
                ->title('عملیات')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Clients_' . date('YmdHis');
    }
}
