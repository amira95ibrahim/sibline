<?php

namespace App\DataTables;

use App\Models\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CustomerDataTable extends DataTable
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
            ->addColumn('status', function (Customer $customer) {
                return $customer->status ? 'Active':'Not Active';
            })
            ->addColumn('action', function ($customer){
                $actionUrls = '<a href="'.url('admin/customer/'.$customer->id).'" class=""><i class="fas fa-eye"></i></a> ';
        
                if(checkPermission('edit'))
                    $actionUrls .= '<a href="'.url('admin/customer/'.$customer->id.'/edit').'" class=""><i class="fas fa-edit"></i></a> ';
                    
                if(checkPermission('destroy'))
                    $actionUrls .= '<a href="#" onclick="delElement(\'customer/'.$customer->id.'\')" class=""><i class="fas fa-trash-alt"></i></a> ';
                
                return $actionUrls;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Customer $model)
    {
        return $model->with(['address', 'address.country', 'address.city'])->newQuery()->orderBy('customers.id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Customer-table')
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
            Column::make('mobile'),
            // Column::make('address.country.name')->title('Country'),
            // Column::make('address.city.name')->title('City'),
            Column::make('status'),
            Column::make('created_at')->title('Registration Date'),
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
        return 'Customer_' . date('YmdHis');
    }
}
