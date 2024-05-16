<?php

namespace App\DataTables;

use App\Models\Broker;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrokerDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            
            ->addColumn('status', function (Broker $broker) {
                return $broker->status ? 'Active':'Not Active';
            })
            ->addColumn('action', '
            <a href="'.url('admin/broker/{{$id}}').'" class=""><i class="fas fa-eye"></i></a>
            <a href="'.url('admin/broker/{{$id}}/edit').'" class=""><i class="fas fa-edit"></i></a>
            <a href="#" onclick="delElement(\'broker/{{$id}}\')" class=""><i class="fas fa-trash-alt"></i></a>
            ');
    
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Broker $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Broker $model)
    {
        return $model->with(['address', 'address.country', 'address.city'])->newQuery()->orderBy('brokers.id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('broker-table')
                    ->columns($this->getColumns())
                                        ->parameters(['lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']]                    ])
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(0)
                    ->buttons(
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('excel'),
);

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
            Column::make('name'),
            Column::make('phone'),
            Column::make('address.country.name')->title('Country'),
            Column::make('address.city.name')->title('City'),
            Column::make('status'),
            Column::computed('action')
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
        return 'Broker_' . date('YmdHis');
    }
}
