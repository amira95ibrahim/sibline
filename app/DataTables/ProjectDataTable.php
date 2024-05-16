<?php

namespace App\DataTables;

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
            ->addColumn('status', function (Project $project) {
                return $project->status ? 'Active':'Not Active';
            })
            ->editColumn('customer',function($project){
                return $project->customer->name ?? ' ' ;
            })
            ->addColumn('action', function ($project){
                $actionUrls = '<a href="'.url('admin/project/'.$project->id).'" class=""><i class="fas fa-eye"></i></a> ';

                if(checkPermission('edit'))
                    $actionUrls .= '<a href="'.url('admin/project/'.$project->id.'/edit').'" class=""><i class="fas fa-edit"></i></a> ';

                if(checkPermission('destroy'))
                    $actionUrls .= '<a href="#" onclick="delElement(\'project/'.$project->id.'\')" class=""><i class="fas fa-trash-alt"></i></a> ';

                 $actionUrls .= '<a href="'.url('admin/acconts/export/'.$project->id).'" class=""><i class="fa fa-arrow-down" aria-hidden="true"></i></a> ';
                return $actionUrls;
            })
               ->order(function ($query) {
                    if (request()->has('order')) {
                         $colNum=request()->order[0]['column'];
                         $colName=request()->columns[$colNum]['data'];
                         if($colName=='customer') $colName='customer_id';
                        $query->orderBy($colName, request()->order[0]['dir']);
                    }
                    else {
                       // $query->orderBy('name', 'DESC');
                    }
                });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ProjectDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Project $model)
    {
        return $model->with(['customer','users'])->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
        ->setTableId('Project-table')
        ->columns($this->getColumns())
                            ->parameters(['lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']]                    ])
        ->minifiedAjax()
        ->dom('Blfrtip')
        
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
            Column::make('fiscal_year'),
            Column::make('customer')->title('Customer')->searchable(false),
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
        return 'Project_' . date('YmdHis');
    }
}
