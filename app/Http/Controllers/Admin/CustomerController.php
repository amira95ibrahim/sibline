<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\CustomerDataTable;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\Address;
use Illuminate\Http\Request;
use Auth,URL;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Hash; 

class CustomerController extends Controller
{
    use ResponseTrait;
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
     
    public function index(CustomerDataTable $dataTable)
    {

        return $dataTable->render('admin.customer.index');

    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.customer.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Customer $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Customer $customer)
    {
        return view('admin.customer.create')->with(['customer' => $customer , 'show' => true]);
    }

    // public function profile(Request $request)
    // {
    //     $customer = customer::find(Auth::guard('customer')->user()->id);

    //     return view('customer.profile.index')->with(['customer' => $customer ]);
    // }

    /**
     * @param \App\Http\Requests\CustomerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerStoreRequest $request)
    {
        // return $request;
        $customer = $request->validated();

        // save address
        $address = Address::create($customer);
        
        // save image
        $imageName = "avater.jpg";
        $customer['image'] = $imageName;
        
        if($request->file('image')){
            $imageName = 'customer_'.time().'.'.$request->image->extension();  
        
            $request->image->move(public_path('images'), $imageName);

            $customer['image'] = $imageName;
        }
        $customer = Customer::create($customer);

        $customer->address()->associate($address);
        $customerContacts = [];
        if(isset($request->contact) && $request->contact[0]['name'] != null && $request->contact[0]['password'] && $request->contact[0]['email']){
             // Hash::make($request->contact[0]['password']);
            foreach ($request->contact as $contact) {

                $customerContacts[] = CustomerContact::create($contact);
            }
            $customer->castomerContacts()->saveMany($customerContacts);
        }
       

        $customer->save();
       // return $request->contact[0]['password'];
        return redirect()->route('admin.customer.edit', $customer->id)->with('success','Customer created successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {        
        return view('admin.customer.create')->with('customer', $customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
       
        $previousUrl =URL::previous();

        $new_customer = $request->validated();
//   return $new_customer;
        // save address
        $address = Address::find($customer->address_id);
    
        $address->update($new_customer);

        $imageName = $customer->image;

        if($request->file('image')){

            $imageName = 'customer_'.time().'.'.$request->image->extension();  
     
            $request->image->move(public_path('images'), $imageName);
    
            $new_customer['image'] = $imageName;
        }

        if(isset($request->contact) && $request->contact[0]['name'] != null  && $request->contact[0]['email']){
        $customerContacts_old = $customer->castomerContacts;
        
         $customer->castomerContacts()->delete();

        $customerContacts = [];

        $i = 0;
       // return $customerContacts_old;
            foreach ($request->contact as $contact) {
           
        // return  $contact;
        if(empty($contact['password'])&&!empty($customerContacts_old)){
            $contact['password'] = $customerContacts_old[$i]->password;
        }else {
             $contact['password'] =$contact['password'];//Hash::make($contact['password']);
        }
            // $contact['password'] = !empty($contact['password']) ? \Hash::make($contact['password']) : $customerContacts_old[$i]->password;
       
                
    
                $customerContacts[] = CustomerContact::create($contact);
    
                $i++;
            }
           // return $customerContacts;
    
            $customer->castomerContacts()->saveMany($customerContacts);
      
            
        }
        
        
        $customer->update($new_customer); 
        return redirect()->route('admin.customer.edit', $customer->id)->with('success','Customer Updated successfully!');
      
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $custommer = Customer::find($id);
        $custommer->castomerContacts()->delete();
        $custommer->delete();


        return response()->json(array('msg'=> 'Customer Deleted Successfully'), 200);
    }
}
