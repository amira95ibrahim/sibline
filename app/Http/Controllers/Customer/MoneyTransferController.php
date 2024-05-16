<?php

namespace App\Http\Controllers\Customer;

use App\Http\Requests\MoneyTransferStoreRequest;
use App\Http\Requests\MoneyTransferUpdateRequest;
use App\Models\MoneyTransfer;
use App\Models\Customer;
use App\Models\CommissionSetting;
use App\Models\CommissionTransaction;
use App\Models\WalletTransaction;
use App\Models\Notification;
use App\DataTables\Customer\MoneyTransferDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MoneyTransferController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(MoneyTransferDataTable $dataTable)
    {
        return $dataTable->render('customer.money_transfer.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('customer.money_transfer.create');
    }

    

    

    /**
     * @param \App\Http\Requests\MoneyTransferStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoneyTransferStoreRequest $request)
    {

        $moneyTransfer = $request->validated();


        $sender = Auth::guard('customer')->user();

        $moneyTransfer['sender_id'] = $sender->id;

        $moneyTransfer['receiver_id'] = base64_decode($moneyTransfer['wallet_address']);
        
        $receiver = Customer::find($moneyTransfer['receiver_id']);
        
        $amount = $moneyTransfer['amount'];

        if($sender->wallet >= $amount && $receiver)
        {
            
            $moneyTransfer = MoneyTransfer::create($moneyTransfer);

            $commissionSystem = CommissionSetting::where(['type' => 'SYSTEM'])->first();

            $systemCommissionAmount = number_format(($commissionSystem->wallet_transfer * $amount) /100,3);

            $totalCommissionAmount = $systemCommissionAmount;

            // decrease  wallet .
            $sender->update(['wallet' => $sender->wallet - $amount]);
            // create wallet transaction
            WalletTransaction::create([
                'amount' => $amount,
                'type' => 'OUT',
                'reference_id' => $moneyTransfer->id,
                'reference_model' => 'MoneyTransfer',
                'customer_id' => $moneyTransfer->sender_id,
            ]);

            $receiver->update(['wallet' => $receiver->wallet + ($amount - $totalCommissionAmount)]);

            WalletTransaction::create([
                'amount' => $amount - $totalCommissionAmount,
                'type' => 'IN',
                'reference_id' => $moneyTransfer->id,
                'reference_model' => 'MoneyTransfer',
                'customer_id' => $moneyTransfer->receiver_id,
            ]);

            CommissionTransaction::create([
                'percentage' => $commissionSystem->wallet_transfer,
                'amount' => $systemCommissionAmount,
                'price' => $amount,
                'transaction_id' => $moneyTransfer->id,
                'transaction_model' => 'MoneyTransfer',
            ]);


            Notification::create([
                'title' => 'money transfer',
                'receiver_id' => $moneyTransfer->receiver_id,
                'receiver_model' => 'Customer',
                'reference_id' => $moneyTransfer->id,
                'reference_model' => 'MoneyTransfer',
                'reference_url' => 'wallet'
            ]);

            return redirect()->route('customer.money-transfer.index')->with('message', "Done !");
        }else
        {
            return redirect()->route('customer.money-transfer.index')->with('error', "Wallet doesn't have enough money ! or wallet address doesn't right");
        }
    }

    
}
