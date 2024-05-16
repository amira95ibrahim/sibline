<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\RevenueCustomer;
use Illuminate\Http\Request;
use App\DataTables\Customer\RevenueCustomerDataTable;

class RevenueController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(RevenueCustomerDataTable $dataTable)
    {
        return $dataTable->render('customer.revenue.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $broker
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,  $id)
    {
        $revenueCustomer = RevenueCustomer::where('revenue_id' , $id)->with(['property','property.address', 'property.address.city', 'property.address.country'])
        ->groupBy(['property_id','revenue_id'])->where('revenue_id' , $id)
        ->selectRaw('revenue_customers.*, sum(percentage) as sum_percentage, sum(commission) as sum_commission')->first();

        return view('customer.revenue.view')->with(['revenueCustomer' => $revenueCustomer]);
    }

}
