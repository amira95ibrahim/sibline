<?php

namespace App\DataTables;

use App\Models\ProjectAccounts;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class ProjectAccountApproveDataTable extends DataTable
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
            ->addColumn('reply_status', function ($query) {
                if ($query->is_replay != null) {
                      if ($query->is_replay == 1) return 'Accepted';
                        if ($query->is_replay == 2) return 'Refused';
                } else {
                    return 'Pending';
                }
            })
            ->addColumn('action', function ($query) {
                $type = 'email';

                return view('admin.projects.components.check-box', compact('query', 'type'));
            })
             ->editColumn('ob_debit',function($query){
                return number_format((float)$query->ob_debit) ?? '';
            })->editColumn('ob_credit',function($query){
                return number_format((float)$query->ob_credit) ?? '';
            })->editColumn('m_debit',function($query){
                return number_format((float)$query->m_debit) ?? '';
            })->editColumn('m_credit',function($query){
                return number_format((float)$query->m_credit) ?? '';
            })->editColumn('balance', function ($query) {
                return number_format($query->balance) ?? '';
            })
            ->addColumn('actions', function ($query) {
                return view('admin.projects.components.btn_show_data', compact('query'));
                
            })
             ->order(function ($query) {
                    if (request()->has('order')) {
                         $colNum=request()->order[0]['column'];
                         $colName=request()->columns[$colNum]['data'];
                        // if($colName=='customer') $colName='customer_id';
                        $query->orderBy($colName, request()->order[0]['dir']);
                    }
                 
                });
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\ProjectAccount  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProjectAccounts $model)
    {
        return $model->where(['project_id' => $this->project_id, 'authorization_status' => 3])
                     ->with(['project'])
                     ->newQuery()
                     ;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
                    ->setTableId('project-approve-accounts-table')
                    ->columns($this->getColumns())
                    ->parameters([
                        'lengthMenu' => [
                            [10, 25, 50, 100, -1], [10, 25, 50, 100, 'All'],
                        ],
                    ])
                    ->postAjax(['data' => ['table_name' => 'approve_table']])
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('excel'),
                        [
                            'text' => 'Send confirmation letter',
                            'attr' => [
                                'type'    => 'submit',
                                'style'   => 'padding:5px 30px;border-radius:5px',
                                'onclick' => 'sendConfirmation()', 'class' => 'btn btn-success',
                            ],
                        ]
        //                   [ 'text' => 'Send pdf letters',
        //         'attr' => ['type' =>'submit','style' => 'padding:5px 30px;border-radius:5px', 'onclick' =>"sendMailLetter('basedonAccounttype')" , 'class' => 'btn btn-success' ],
        //   ]
                      // [ 'text' => 'Delete',
                    // 'attr' => ['type' =>'submit', 'onclick' =>'deleteAll()' , 'class' => 'btn btn-danger' ],
                    // ]

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
            [
                'name'       => 'action',
                'data'       => 'action',
                'title'      => '<input type="checkbox" class="check_all" onclick="check_all()" />',
                'exportable' => false,
                'printable'  => false,
                'orderable'  => false,
                'searchable' => false,
            ],
            Column::make('account_number'),
            Column::make('account_name'),
            Column::make('currency'),
             Column::make('ob_debit'),
            Column::make('ob_credit'),
            Column::make('m_debit'),
            Column::make('m_credit'),
            Column::make('balance'),
            Column::make('account_type'),
            Column::make('ac_name')->title('Contact Name'),
            Column::make('ac_phone')->title('Contact Phone'),
            Column::make('ac_email')->title('Contact Email'),
            Column::make('ac_address')->title('Contact Address'),
            Column::make('reply_status')->title('Reply Status'),
            Column::make('actions')->title('Details'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProjectAccount_'.date('YmdHis');
    }
}
