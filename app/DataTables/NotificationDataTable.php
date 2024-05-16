<?php

namespace App\DataTables;

use App\Models\Notification;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth,Route;

class NotificationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $guard = explode('.',Route::currentRouteName())[0];

        return datatables()
            ->eloquent($query)
            ->setRowClass(function ($notification) {
                return $notification->is_read == 0 ? 'alert-warning' : '';
            })
            ->addColumn('action', '
            <a onclick="readNotification({{$id}});" href="'.url($guard.'/{{$reference_url}}').'"  class="color-spy"><i class="fas fa-eye"></i></a>
            ');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notification $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notification $model)
    {
        $guard = explode('.',Route::currentRouteName())[0];

        if($guard == 'partner')
            $receiver_id = Auth::guard($guard)->user()->partner->id;
        elseif($guard == 'admin'){
            
            $receiver_id = Auth::guard($guard)->user()->id;
            $guard = 'user';
        }else
            $receiver_id = Auth::guard($guard)->user()->id;

            


        $receiver_model = ucfirst($guard);
 
        
        return $model->where(['receiver_id'=>$receiver_id , 'receiver_model'=>$receiver_model])->newQuery()->orderBy('id','DESC');;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('notification-table')
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
            Column::make('title'),
            Column::make('reference_id'),
            Column::make('reference_model'),
            Column::make('created_at')->title('date'),
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
        return 'notification_' . date('YmdHis');
    }
}
