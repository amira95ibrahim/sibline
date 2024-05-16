<?php

namespace App\Http\Controllers\Admin;

use App\Models\Notification;
use App\DataTables\NotificationDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(NotificationDataTable $dataTable)
    {
        return $dataTable->render(basename(request()->route()->getPrefix()).'.notification.index');
    }


    /**
     * @param \App\Http\Requests\OccupationStoreRequest $request
     * @param \App\Models\Occupation $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        Notification::find($id)->update(['is_read' => '1']);

        return response()->json(array('msg'=> 'Notification changed Successfully'), 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->json(array('msg'=> 'Notification Deleted Successfully'), 200);
    }
}
