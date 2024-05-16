<?php

namespace App\DataTables;

use App\Models\CommissionTransaction;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CommissionDataTable extends DataTable
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

            ->addColumn('type', function (CommissionTransaction $commission) {
                if($commission->partner->name)
                    return 'Partner';
                elseif($commission->broker->name)
                    return 'Broker';
                else
                    return 'Botakey';
            })
            ->addColumn('name', function (CommissionTransaction $commission) {
                if($commission->partner->name)
                    return $commission->partner->name;
                elseif($commission->broker->name)
                    return $commission->broker->name;
                else
                    return 'Botakey';
            })
            ->addColumn('action', '
            <a href="'.url('admin/{{strtolower($transaction_model)}}/{{$transaction_id}}').'" class=""><i class="fas fa-eye"></i></a>

            <a href="#" onclick="delElement(\'commission/{{$id}}\')" class=""><i class="fas fa-trash-alt"></i></a>
            ');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CommissionTransaction $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CommissionTransaction $model)
    {
        $commissions = $model->with(['broker', 'partner'])
        ->select('commission_transactions.*')
        ->where('commission_transactions.amount', '>', 0)
        ->orderBy('commission_transactions.id','DESC');
        return $this->applyScopes($commissions);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('commission-table')
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
            Column::make('created_at')->title('Creation Date'),
            Column::make('type'),
            Column::make('name'),
            Column::make('price')->title('Total Amount ($)'),
            Column::make('percentage')->title('Percentage (%)'),
            Column::make('amount')->title('Commission ($)'),
            Column::make('transaction_model')->title('transaction type'),
            Column::make('transaction_id'),
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
        return 'commission_' . date('YmdHis');
    }
}
