<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Property;
use App\Models\Share;
use App\Models\Customer;
use App\Models\Order;
use App\Models\CommissionSetting;
use App\Models\Notification;
use App\Models\WalletTransaction;
use App\Models\CommissionTransaction;
use Illuminate\Http\Request;
use App\Http\Requests\BidStoreRequest;
use App\Http\Requests\BidUpdateRequest;
use App\Http\Requests\BidStatusRequest;
use Auth;

class BidController extends Controller
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
                $dataTable = new  \App\DataTables\Customer\BidDataTable;
                break;
            default:
                $dataTable = new  \App\DataTables\BidDataTable;
                break;
        }
        return $dataTable->render(basename(request()->route()->getPrefix()).'.bid.index');


    }


    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function offer()
    {
        $dataTable = new  \App\DataTables\Customer\OfferDataTable;
        return $dataTable->render('customer.bid.index');
    }



    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request , $property_id , $customer_id)
    {
        $property = Property::find($property_id);
        return view(basename(request()->route()->getPrefix()).'.bid.create')->with(['property' => $property ,'customer_id' => $customer_id]);
    }    

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bid $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bid $bid)
    {
        return view(basename(request()->route()->getPrefix()).'.bid.create')->with('bid',$bid);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bid $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $bid = Bid::find($id);
        if($bid)
            return view('customer.bid.view')->with(['bid' => $bid ,'guard' => basename(request()->route()->getPrefix()), 'show' => true]);
    }

    /**
     * @param \App\Http\Requests\BidStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidStoreRequest $request)
    {
        $bid = $request->validated();
        
        $bid['sender_id'] = Auth::guard('customer')->user()->id;

        $bid = Bid::create($bid);

        Notification::create([
            'title' => 'new bid',
            'receiver_id' => $bid->receiver_id,
            'receiver_model' => 'Customer',
            'reference_id' => $bid->id,
            'reference_model' => 'Bid',
            'reference_url' => 'bid/'.$bid->id
        ]);

        return redirect()->route(basename(request()->route()->getPrefix()).'.property.index');
        
    }

    /**
     * @param \App\Http\Requests\BidUpdateRequest $request
     * @param \App\Models\Bid $expense
     * @return \Illuminate\Http\Response
     */
    public function update(BidUpdateRequest $request, Bid $bid)
    {
        $bid->update($request->validated());

        return redirect()->route(basename(request()->route()->getPrefix()).'.property.index');
    }

    public function approve(BidStatusRequest $request, $id)
    {
        $new_bid = $request->validated();
        
        $new_bid['status'] = 'APPROVED';
        $bid = Bid::find($id);
        $bid->update($new_bid);

        Notification::create([
            'title' => 'bid Approved ',
            'receiver_id' => $bid->sender_id,
            'receiver_model' => 'Customer',
            'reference_id' => $bid->id,
            'reference_model' => 'Bid',
            'reference_url' => 'bid/'.$bid->id
        ]);

        return response()->json(array('msg'=> 'Bid Approved Successfully'), 200);

    }


    public function decline(BidStatusRequest $request, $id)
    {
        $new_bid = $request->validated();
        
        $new_bid['status'] = 'DECLINED';
        $bid = Bid::find($id);
        $bid->update($new_bid);

        Notification::create([
            'title' => 'bid Rejected ',
            'receiver_id' => $bid->sender_id,
            'receiver_model' => 'Customer',
            'reference_id' => $bid->id,
            'reference_model' => 'Bid',
            'reference_url' => 'bid/'.$bid->id
        ]);

        return response()->json(array('msg'=> 'Bid Rejected Successfully'), 200);

    }

    public function pay(BidStatusRequest $request, $id)
    {
        $new_bid = $request->validated();

        $bid = Bid::find($id); 

        $sender = Customer::find($bid->sender_id);

        $receiver = Customer::find($bid->receiver_id);

        if($sender->wallet >= $bid->amount)
        {
            

            $commissionSystem = CommissionSetting::where(['type' => 'SYSTEM'])->first();
        
            $new_bid['status'] = 'DONE';
        
            

            $bid->update($new_bid);

            Share::create([
                'percentage' => number_format($bid->percentage,3),
                'amount' => ($bid->property->price * $bid->percentage) / 100,
                'status' => 'OUT',
                'property_id' => $bid->property_id,
                'customer_id' => $bid->receiver_id,
                'reference_id' => $bid->id,
                'reference_model' => 'Bid',
            ]);

            Share::create([
                'percentage' => number_format($bid->percentage,3),
                'amount' => ($bid->property->price * $bid->percentage) / 100,
                'status' => 'IN',
                'property_id' => $bid->property_id,
                'customer_id' => $bid->sender_id,
                'reference_id' => $bid->id,
                'reference_model' => 'Bid'
            ]);
            
            $partnerCommissionAmount = number_format(($bid->property->partner->commission->shares_selling * $bid->amount) /100,3);

            $brokerCommissionAmount = number_format(($bid->property->broker->commission->shares_selling * $bid->amount) /100,3);

            $systemCommissionAmount = number_format(($commissionSystem->shares_selling * $bid->amount) /100,3);

            $totalCommissionAmount = $partnerCommissionAmount + $brokerCommissionAmount + $systemCommissionAmount;


            $order = Order::create([
                'percentage' => $bid->percentage,
                'amount' => $bid->amount - $totalCommissionAmount,
                'property_id' => $bid->property_id,
                'buyer_id' => $bid->sender_id,
                'seller_id' => $bid->receiver_id,
                'commission' => $totalCommissionAmount
            ]);

            // decrease  wallet by shares customer have been buied.
            $sender->update(['wallet' => $sender->wallet - $bid->amount]);
            // create wallet transaction
            WalletTransaction::create([
                'amount' => $bid->amount,
                'type' => 'OUT',
                'reference_id' => $bid->id,
                'reference_model' => 'Bid',
                'customer_id' => $bid->sender_id,
            ]);

            

            $receiver->update(['wallet' => $receiver->wallet + ($bid->amount - $totalCommissionAmount)]);

            WalletTransaction::create([
                'amount' => $bid->amount - $totalCommissionAmount,
                'type' => 'IN',
                'reference_id' => $bid->id,
                'reference_model' => 'Bid',
                'customer_id' => $bid->receiver_id,
            ]);

            CommissionTransaction::create([
                'percentage' => $bid->property->partner->commission->shares_selling,
                'amount' => $partnerCommissionAmount,
                'price' => $bid->amount,
                'partner_id' => $bid->property->partner_id,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            CommissionTransaction::create([
                'percentage' => $bid->property->broker->commission->shares_selling,
                'amount' => $brokerCommissionAmount,
                'price' => $bid->amount,
                'broker_id' => $bid->property->broker_id,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            CommissionTransaction::create([
                'percentage' => $commissionSystem->shares_selling,
                'amount' => $systemCommissionAmount,
                'price' => $bid->amount,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);


            Notification::create([
                'title' => 'money transfer',
                'receiver_id' => $bid->receiver_id,
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
    public function destroy(Bid $bid)
    {
        $bid->delete();

        return response()->json(array('msg'=> 'Bid Deleted Successfully'), 200);
    }

}
