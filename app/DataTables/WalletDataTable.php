<?php

namespace App\DataTables;

use App\Models\WalletTransaction;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WalletDataTable extends DataTable
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
            ->addColumn('action', '
                <a href="#" onclick="delElement(\'wallet/{{$id}}\')" class=""><i class="fas fa-trash-alt"></i></a>
                ');
            
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\WalletTransaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(WalletTransaction $model)
    {
        return $model->with(['customer'])->newQuery()->orderBy('wallet_transactions.id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('wallet-table')
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
            Column::make('created_at')->title('Transaction Date'),
            Column::make('customer.name')->title('Customer Name'),
            Column::make('amount')->title('Amount ($)'),
            Column::make('type')->title('Transaction Type'),
            Column::make('reference_model')->title('Reference'),
            Column::make('reference_id')->title('Reference Id'),
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
        return 'wallet_' . date('YmdHis');
    }
}
