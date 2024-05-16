<?php

namespace App\DataTables\Customer;

use App\Models\ProjectAccounts;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingAccountsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  mixed  $query  Results from query() method.
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
                return number_format((float)$query->balance) ?? '';
            })
            ->editColumn('authorization_status', function ($query) {
                $val = $query->authorization_status;

                return view('customer.accounts.components.radio-buttns-bending',
                    compact('query', 'val'));
            })
            ->editColumn('authorization_comment', function ($query) {

                return view('customer.accounts.components.comment', compact('query'));
            })
            ->setRowClass(function ($user) {
                return 'data-row';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\Customer/PendingAccount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProjectAccounts $model)
    {

        return $model->with(['project'])
                     ->whereHas('project', function ($q) {
                         $q->when(request()->has('project_id'), function ($q) {
                             $q->where('id', request('project_id'));
                         });
                         $q->where('customer_id', auth('customer')->user()->customer_id ?? null);
                     })
                     ->where(['authorization_request' => 1, 'authorization_status' => 1])
                     ->newQuery()
                     ->orderBy('project_accounts.id', 'DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('Accounts-table')
                    ->columns($this->getColumns())
                    ->parameters([
                        'lengthMenu' => [
                            [10, 25, 50, 100, -1], [10, 25, 50, 100, 'All'],
                        ],
                    ])
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(0)
                    ->rowId()
                    ->buttons(
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('excel'),
                        // [ 'text' => 'Approve',
                        // 'attr' => ['type' =>'submit' , 'onclick' => 'selectAllApprove()' , 'class' => 'btn btn-success radioButton' , 'id' => 'approveAll' , 'value' => 'Approve' ],
                        // ],
                        [
                            'text' => 'Submit',
                            'attr' => [
                                'type' => 'submit',
                                'style'   => 'padding:5px 30px;border-radius:5px',
                                'class' => 'btn btn-success',
                                'onclick' => 'approveAccount()',
                                'id' => 'approveAll',
                            ],
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
            Column::make('authorization_status')->title('Status'),
            Column::make('authorization_comment')->title('Comment'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProjectAccounts_'.date('YmdHis');
    }
}
