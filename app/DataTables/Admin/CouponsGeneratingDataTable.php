<?php

namespace App\DataTables\Admin;

use App\Models\CouponsGenerating;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponsGeneratingDataTable extends DataTable
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
            // ->addColumn('parent', function (CouponsGenerating $coupon) {
            //     return $coupon->parent? $coupon->parent->name : '';
            // })
            ->addColumn('action', '

            <a href="'.url('admin/form1/{{$id}}/edit').'" class=""><i class="fas fa-edit"></i></a>
            <a href="#" onclick="delElement(\'form1/{{$id}}\')" class=""><i class="fas fa-trash-alt"></i></a>
            ');
            // <a href="'.url('admin/form1/{{$id}}').'" class=""><i class="fas fa-eye"></i></a>
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Country $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CouponsGenerating $model)
    {
        return $model->newQuery()->orderBy('purchase_order','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    // ->setTableId('country-table')
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

            Column::make('purchase_order'),
            Column::make('total_quantity'),
            Column::make('RM_source'),
            Column::make('contractor_name'),
            Column::make('storage_location'),
            // Column::make('parent'),
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
        return 'CouponsGenerating_' . date('YmdHis');
    }
}
