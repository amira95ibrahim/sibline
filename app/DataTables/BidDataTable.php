<?php

namespace App\DataTables;

use App\Models\Bid;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BidDataTable extends DataTable
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
            <a href="'.url('admin/bid/{{$id}}').'" class=""><i class="fas fa-eye"></i></a>
            <a href="#" onclick="delElement(\'bid/{{$id}}\')" class=""><i class="fas fa-trash-alt"></i></a>
            ');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Bid $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bid $model)
    {
        $bids = $model->with(['property','sender','receiver'])
        ->select('bids.*')
        ->orderBy('bids.id','DESC');
        return $this->applyScopes($bids);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Bid-table')
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
            Column::make('property.title')->title('Property'),
            Column::make('sender.name')->title('Sender'),
            Column::make('receiver.name')->title('Receiver'),
            Column::make('amount')->title('Total Amount ($)'),
            Column::make('percentage')->title('Percentage (%)'),
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
        return 'Bid_' . date('YmdHis');
    }
}
