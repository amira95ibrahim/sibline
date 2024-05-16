<?php

namespace App\DataTables\Customer;

use App\Models\ProjectAccounts;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ApproveAccountsDataTable extends DataTable
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
             ->editColumn('ob_debit',function($query){
                return number_format((float)$query->ob_debit) ?? '';
            })->editColumn('ob_credit',function($query){
                return number_format((float)$query->ob_credit) ?? '';
            })->editColumn('m_debit',function($query){
                return number_format((float)$query->m_debit) ?? '';
            })->editColumn('m_credit',function($query){
                return number_format((float)$query->m_credit) ?? '';
            })->editColumn('balance',function($query){
                return number_format($query->balance) ?? '';
            })
            ->editColumn('ac_name', function($query){
                $name = 'ac_name';
                $val = $query->ac_name;
                return view('customer.accounts.components.input' , compact('query','name','val'));
            })

            ->editColumn('ac_phone', function($query){
                $name = 'ac_phone';
                $val = $query->ac_phone;
                return view('customer.accounts.components.input' , compact('query','name','val'));
            })

            ->editColumn('ac_email', function($query){
                $name = 'ac_email';
                $val = $query->ac_email;
                return view('customer.accounts.components.input' , compact('query','name','val'));
            })

            ->editColumn('ac_address', function($query){
                $name = 'ac_address' ;
                $val = $query->ac_address;
                return view('customer.accounts.components.input' , compact('query','name','val'));
            })
            ->setRowClass(function ($user) {
                return 'data-row';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProjectAccounts $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProjectAccounts $model)
    {
        return $model->with(['project'])->whereHas('project',function ($q) {
            $q->when(request()->has('project_id'),function($q){
                $q->where('id',request('project_id'));
            });
            $q->where('customer_id', auth('customer')->user()->customer_id ?? null);
         })->where(['authorization_request'=> 1 , 'authorization_status' => 3])->newQuery()->orderBy('project_accounts.id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('Approve-accounts-table')
        ->columns($this->getColumns())
        ->parameters(['lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']]                    ])
        ->minifiedAjax()
        ->dom('Blfrtip')
        ->orderBy(0)
        ->rowId()
        ->buttons(
            Button::make('csv'),
            Button::make('pdf'),
            Button::make('excel'),
            [ 'text' => 'Submit',
            'attr' => [
                'type' =>'submit' ,
                'style'   => 'padding:5px 30px;border-radius:5px',
                'class' => 'btn btn-success',
                'onclick' => 'approveAccount()' ,

                'id' => 'approveAll' ],
            ],


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
            Column::make('account_number'),
            Column::make('account_name'),
            Column::make('currency'),
           Column::make('ob_debit'),
            Column::make('ob_credit'),
            Column::make('m_debit'),
            Column::make('m_credit'),
            Column::make('balance'),
            Column::make('ac_name')->title('Contact Name'),
            Column::make('ac_phone')->title('Contact Phone'),
            Column::make('ac_email')->title('Contact Email'),
            Column::make('ac_address')->title('Contact Address'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProjectAccounts_' . date('YmdHis');
    }
}
