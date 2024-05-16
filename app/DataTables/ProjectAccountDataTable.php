<?php

namespace App\DataTables;

use App\Models\ProjectAccounts;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;
class ProjectAccountDataTable extends DataTable
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
        ->addColumn('action', function($query){
            $type = 'sendAuth';
            return view('admin.projects.components.check-box', compact('query','type'));
        })
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
               ->order(function ($query) {
                    if (request()->has('order')) {
                         $colNum=request()->order[0]['column'];
                         $colName=request()->columns[$colNum]['data'];
                        // if($colName=='customer') $colName='customer_id';
                        $query->orderBy($colName, request()->order[0]['dir']);
                    }
                    else {
                       // $query->orderBy('name', 'DESC');
                    }
                });
        // ->editColumn('authorization_status',function($query){
        //     return view('admin.projects.components.heading',compact('query'));

        // })
        ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProjectAccount $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ProjectAccounts $model)
    {
       
        
        return $model->where(['project_id'=>$this->project_id , 'authorization_status' => 0])->with(['project'])->newQuery();

    }


    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
        ->setTableId('Project-account-table')

        ->columns($this->getColumns())
                            ->parameters(['lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']] ,
                            ['tableName'=>'testtable'] ])
        ->postAjax([
            'data'=>['table_name'=>'accounts_table']
            ])
        ->dom('Blfrtip')
        ->orderBy(1)
        ->buttons(
             Button::make('csv'),
             Button::make('pdf'),
             Button::make('excel'),
             [ 'text' => 'Send authorization requests',
                'attr' => ['type' =>'submit','style' => 'padding:5px 30px;border-radius:5px', 'onclick' =>'approveItems()' , 'class' => 'btn btn-success' ],
        ],
        [ 'text' => 'Delete',
        'attr' => ['type' =>'submit','style' => 'padding:5px 30px;border-radius:5px', 'onclick' =>'deleteAll()' , 'class' => 'btn btn-danger' ],
        ]

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
            // Column::make('authorization_status')->title('Status'),
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ProjectAccount_' . date('YmdHis');
    }
}
