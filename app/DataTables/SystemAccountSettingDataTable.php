<?php

namespace App\DataTables;

use App\Models\SystemAccountSetting;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SystemAccountSettingDataTable extends DataTable
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
            ->addColumn('action', function ($query){
                $actionUrls = '';
                if(checkPermission('edit'))
                    $actionUrls .= '<a href="'.url('admin/systemAccount/'.$query->id.'/edit').'" class=""><i class="fas fa-edit"></i></a> ';
                if(checkPermission('destroy'))
                    $actionUrls .= '<a href="#" onclick="delElement(\'systemAccount/'.$query->id.'\')" class=""><i class="fas fa-trash-alt"></i></a> ';
                return $actionUrls;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\systemAccountSetting $model
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function query(SystemAccountSetting $model)
    {
        return $model->newQuery()->orderBy('system_account_settings.id','DESC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('system_account_setting_table')
                    ->columns($this->getColumns())
                    ->parameters(['lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']] ])
                    ->postAjax(['data'=>['table_name'=>'refuse_table']])
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
            Column::make('start_account_no'),
            Column::make('type'),
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
        return 'SystemAccountSetting_' . date('YmdHis');
    }
}
