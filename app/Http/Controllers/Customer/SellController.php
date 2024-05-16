<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Sell;
use App\Models\Property;
use App\Models\Share;
use App\Models\Customer;
use App\Models\Order;
use App\Models\CommissionSetting;
use App\Models\Notification;
use App\Models\WalletTransaction;
use App\Models\CommissionTransaction;
use Illuminate\Http\Request;
use App\Http\Requests\SellStoreRequest;
use App\Http\Requests\SellUpdateRequest;
use Auth;

class SellController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prefix = basename(request()->route()->getPrefix());
        switch ($prefix) {
            case 'customer':
                $dataTable = new  \App\DataTables\Customer\SellDataTable;
                break;
            default:
                $dataTable = new  \App\DataTables\SellDataTable;
                break;
        }
        return $dataTable->render(basename(request()->route()->getPrefix()).'.sell.index');


    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $property_id)
    {
        $property = Property::find($property_id);
        return view(basename(request()->route()->getPrefix()).'.sell.create')->with(['property' => $property]);
    }    

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sell $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Sell $sell)
    {
        return view(basename(request()->route()->getPrefix()).'.sell.create')->with('sell',$sell);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Sell $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $sell = Sell::find($id);
        if($sell)
            return view('customer.sell.view')->with(['sell' => $sell ,'guard' => basename(request()->route()->getPrefix()), 'show' => true]);
    }

    /**
     * @param \App\Http\Requests\SellStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellStoreRequest $request)
    {
        $sell = $request->validated();
        
        $sell['customer_id'] = Auth::guard('customer')->user()->id;

        $sell = Sell::create($sell);

        

        return redirect()->route(basename(request()->route()->getPrefix()).'.sell.index');
        
    }

    /**
     * @param \App\Http\Requests\SellUpdateRequest $request
     * @param \App\Models\Sell $expense
     * @return \Illuminate\Http\Response
     */
    public function update(SellUpdateRequest $request, Sell $sell)
    {
        $sell->update($request->validated());

        return redirect()->route(basename(request()->route()->getPrefix()).'.sell.index');
    }


    public function pay(Request $request, $id)
    {
        $sell = Sell::find($id); 

        $receiver = Customer::find($sell->customer_id);

        $sender = Customer::find(Auth::guard('customer')->user()->id);


        if($sender->wallet >= $sell->amount)
        {
            

            $commissionSystem = CommissionSetting::where(['type' => 'SYSTEM'])->first();
        
        
            

            $sell->update(['status' => 'APPROVED']);

            Share::create([
                'percentage' => number_format($sell->percentage,3),
                'amount' => ($sell->property->price * $sell->percentage) / 100,
                'status' => 'OUT',
                'property_id' => $sell->property_id,
                'customer_id' => $sell->customer_id,
                'reference_id' => $sell->id,
                'reference_model' => 'Sell',
            ]);

            Share::create([
                'percentage' => number_format($sell->percentage,3),
                'amount' => ($sell->property->price * $sell->percentage) / 100,
                'status' => 'IN',
                'property_id' => $sell->property_id,
                'customer_id' => Auth::guard('customer')->user()->id,
                'reference_id' => $sell->id,
                'reference_model' => 'Sell'
            ]);
            
            $partnerCommissionAmount = number_format(($sell->property->partner->commission->shares_selling * $sell->amount) /100,3);

            $brokerCommissionAmount = number_format(($sell->property->broker->commission->shares_selling * $sell->amount) /100,3);

            $systemCommissionAmount = number_format(($commissionSystem->shares_selling * $sell->amount) /100,3);

            $totalCommissionAmount = $partnerCommissionAmount + $brokerCommissionAmount + $systemCommissionAmount;


            $order = Order::create([
                'percentage' => $sell->percentage,
                'amount' => $sell->amount - $totalCommissionAmount,
                'property_id' => $sell->property_id,
                'buyer_id' => Auth::guard('customer')->user()->id,
                'seller_id' => $sell->customer_id,
                'commission' => $totalCommissionAmount
            ]);

            // decrease  wallet by shares customer have been buied.
            $sender->update(['wallet' => $sender->wallet - $sell->amount]);
            // create wallet transaction
            WalletTransaction::create([
                'amount' => $sell->amount,
                'type' => 'OUT',
                'reference_id' => $sell->id,
                'reference_model' => 'Sell',
                'customer_id' => Auth::guard('customer')->user()->id,
            ]);

            

            $receiver->update(['wallet' => $receiver->wallet + ($sell->amount - $totalCommissionAmount)]);

            WalletTransaction::create([
                'amount' => $sell->amount - $totalCommissionAmount,
                'type' => 'IN',
                'reference_id' => $sell->id,
                'reference_model' => 'Sell',
                'customer_id' => $sell->customer_id,
            ]);

            CommissionTransaction::create([
                'percentage' => $sell->property->partner->commission->shares_selling,
                'amount' => $partnerCommissionAmount,
                'price' => $sell->amount,
                'partner_id' => $sell->property->partner_id,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            CommissionTransaction::create([
                'percentage' => $sell->property->broker->commission->shares_selling,
                'amount' => $brokerCommissionAmount,
                'price' => $sell->amount,
                'broker_id' => $sell->property->broker_id,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            CommissionTransaction::create([
                'percentage' => $commissionSystem->shares_selling,
                'amount' => $systemCommissionAmount,
                'price' => $sell->amount,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);


            Notification::create([
                'title' => 'money transfer',
                'receiver_id' => $sell->customer_id,
                'receiver_model' => 'Customer',
                'reference_id' => $order->id,
                'reference_model' => 'Order',
                'reference_url' => 'wallet'
            ]);

            return response()->json(array('msg'=> 'Shares Transferred Successfully.'), 200);
        }else
        {
            return response()->json(array('msg'=> "Wallet doesn't have enough money !"), 200);
        }
    }

    

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        $sell->delete();

        return response()->json(array('msg'=> 'Sell Deleted Successfully'), 200);
    }

}
