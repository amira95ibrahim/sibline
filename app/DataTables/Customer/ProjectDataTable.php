<?php

namespace App\DataTables\Customer;

use App\Models\Project;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProjectDataTable extends DataTable
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
            ->editColumn('name',function($project){
              
                return view('customer.dashboard.link',compact('project'));
            })
            ->addColumn('approve_missing',function($project){

                return view('customer.dashboard._approve_missing',compact('project'));
            })
            ->addColumn('approve',function($project){
                
                return view('customer.dashboard._approve',compact('project'));
            })
            ->addColumn('pending',function($project){
                return view('customer.dashboard._pending',compact('project'));
            })
            ->addColumn('refuse',function($project){
                return view('customer.dashboard._refuse',compact('project'));
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Customer/Project $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        return $model->with(['customer'])->where('customer_id', auth('customer')->user()->customer_id ?? null)->newQuery()
        ->orderBy('projects.id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('customer-project-table')
        
        ->columns($this->getColumns())
        ->parameters(['lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']] ,
         'buttons' => ['']
                          ] ,

        )
        ->minifiedAjax()
        ->dom('Blfrtip')
        ->orderBy(0)
        ->rowId()
    ;
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
            Column::make('fiscal_year'),
            Column::make('pending')->title('Pending Accounts'),
            Column::make('approve_missing')->title('Accepted Accounts (contact details missing)'),
            Column::make('approve')->title('Accepted Accounts'),
            Column::make('refuse')->title('Refused Accounts'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Project_' . date('YmdHis');
    }
}
