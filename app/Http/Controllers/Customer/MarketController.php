<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Share;
use App\Models\Order;
use App\Models\CommissionTransaction;
use App\Models\CommissionSetting;
use App\Models\Customer;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use App\Http\Requests\ShareStoreRequest;
use Auth;

class MarketController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $properties = Property::paginate(3);
        return view('customer.market.index')->with('properties', $properties);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $property = Property::find($id);
        $commissionSystem = CommissionSetting::where(['type' => 'SYSTEM'])->first();

        return view('customer.market.view')->with(['property'=> $property , 'commissionSystem' =>$commissionSystem]);
    }

    /**
     * @param \App\Http\Requests\ShareStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShareStoreRequest $request)
    {
        $share = $request->validated();

        if(Auth::guard('customer')->user()->wallet >= $share['amount'])
        {
            $commissionSystem = CommissionSetting::where(['type' => 'SYSTEM'])->first();
        
            $share['customer_id'] = Auth::guard('customer')->user()->id;
            
            $property = Property::find($share['property_id']);
    
            

            $partnerCommissionAmount = number_format(($property->partner->commission->shares_buying * $share['amount']) /100,3);

            $brokerCommissionAmount = number_format(($property->broker->commission->shares_buying * $share['amount']) /100,3);

            $systemCommissionAmount = number_format(($commissionSystem->shares_buying * $share['amount']) /100,3);

            $totalCommissionAmount = $partnerCommissionAmount + $brokerCommissionAmount + $systemCommissionAmount;


            $totalAmount = $share['amount'];

            $share['percentage'] = number_format(($share['amount'] - $totalCommissionAmount) / $property->price * 100,3);
    
            // add share

            $share['amount'] = $share['amount'] - $totalCommissionAmount;

            $order = Order::create([
                'percentage' => $share['percentage'],
                'amount' => $totalAmount - $totalCommissionAmount,
                'property_id' => $share['property_id'],
                'buyer_id' => $share['customer_id'],
                'commission' => $totalCommissionAmount
            ]);

            $share['status'] = 'IN';

            $share['reference_id'] = $order->id;

            $share['reference_model'] = 'Order';

            Share::create($share);


    
            


            
            
            // decrease  wallet by shares customer have been buied
            Auth::guard('customer')->user()->update(['wallet' => Auth::guard('customer')->user()->wallet - $totalAmount]);
            
            // create wallet transaction
            WalletTransaction::create([
                'amount' => $totalAmount,
                'type' => 'OUT',
                'reference_id' => $order->id,
                'reference_model' => 'Order',
                'customer_id' => $share['customer_id'],
            ]);

            CommissionTransaction::create([
                'percentage' => $property->partner->commission->shares_buying,
                'amount' => $partnerCommissionAmount,
                'price' => $totalAmount,
                'partner_id' => $property->partner_id,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            CommissionTransaction::create([
                'percentage' => $property->broker->commission->shares_buying,
                'amount' => $brokerCommissionAmount,
                'price' => $totalAmount,
                'broker_id' => $property->broker_id,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            CommissionTransaction::create([
                'percentage' => $commissionSystem->shares_buying,
                'amount' => $systemCommissionAmount,
                'price' => $totalAmount,
                'transaction_id' => $order->id,
                'transaction_model' => 'Order',
            ]);

            return redirect()->route('customer.market.index')->with('message', "Congratulations !");
        }else
        {
            return redirect()->route('customer.market.index')->with('error', "Wallet doesn't have enough money !");
        }
        
    }
    

    public function loadProperties(Request $request)
    {
        $properties = Property::paginate(3);
        return view('customer.market.elements.properties')->with('properties', $properties);
    }

}
