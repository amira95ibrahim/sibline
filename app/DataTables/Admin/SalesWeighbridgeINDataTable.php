<?php

namespace App\DataTables\Admin;

use App\Models\SalesWeighbridgeIN;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Carbon\Carbon;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesWeighbridgeINDataTable extends DataTable
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
            ->editColumn('created_at', function (SalesWeighbridgeIN $coupon) {
                return Carbon::parse($coupon->created_at)->format('Y-m-d H:i:s');
            })

            ->addColumn('user_name', function (SalesWeighbridgeIN $coupon) {
                return $coupon->user ? $coupon->user->first_name : 'N/A';
            })
            ->addColumn('action', function ($SalesWeighbridgeIN){

                $actionUrls=' <a href="'.url('admin/form6/'.$SalesWeighbridgeIN->id).'" class=""><i class="fas fa-eye"></i></a> ';

                if(checkPermission('edit'))
                    $actionUrls .= '<a href="'.url('admin/form6/'.$SalesWeighbridgeIN->id.'/edit').'" class=""><i class="fas fa-edit"></i></a> ';

                if(checkPermission('destroy'))
                    $actionUrls .= '<a href="#" onclick="delElement(\'form6/'.$SalesWeighbridgeIN->id.'\')" class=""><i class="fas fa-trash-alt"></i></a> ';

                return $actionUrls;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Country $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SalesWeighbridgeIN $model)
    {
        return $model->newQuery() ->with('user')->orderBy('id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('sales_weighbridge_in-table')
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
            Column::make('user_name')->title('User Name'),
            Column::make('coupon'),
            Column::make('weigh_in'),
            Column::make('created_at'),
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
        return 'SalesWeighbridgeIN_' . date('YmdHis');
    }
}
