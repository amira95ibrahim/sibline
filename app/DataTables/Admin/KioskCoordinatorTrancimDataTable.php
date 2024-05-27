<?php

namespace App\DataTables\Admin;

use App\Models\KioskCoordinatorTrancim;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class KioskCoordinatorTrancimDataTable extends DataTable
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
            // ->addColumn('parent', function (KioskCoordinatorTrancim $coupon) {
            //     return $coupon->parent? $coupon->parent->name : '';
            // })
            ->addColumn('action', '
            <a href="'.url('admin/form5/{{$id}}').'" class=""><i class="fas fa-eye"></i></a>
            <a href="'.url('admin/form5/{{$id}}/edit').'" class=""><i class="fas fa-edit"></i></a>
            <a href="#" onclick="delElement(\'form5/{{$id}}\')" class=""><i class="fas fa-trash-alt"></i></a>
            ');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Country $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(KioskCoordinatorTrancim $model)
    {
        return $model->newQuery()->orderBy('id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('kiosk_coordinator_trancim-table')
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

            
            Column::make('coupon'),
            Column::make('sales_order'),
            Column::make('customer_name'),
            Column::make('customer_phone'),
            Column::make('contractor_name'),
            Column::make('destination'),
            Column::make('material_name'),
            Column::make('Qty_loaded'),
            Column::make('material_name'),
            Column::make('driver_name'),
            Column::make('truck_plate'),
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
        return 'KioskCoordinatorTrancim_' . date('YmdHis');
    }
}
