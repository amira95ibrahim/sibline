
<div class="card-body">
    <div class="container">
        <table class="table table-bordered datatable" id="">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Amount</th>
                    <th>Percentage</th>
                    <th>Commission</th>
                    <th>Transaction Type</th>
                    <th>Transaction Id</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($commissionTransactions as $commissionTransaction)
                <tr>
                    <td>
                        {{$commissionTransaction->id}}                    
                    </td>
                
                    <td>
                        
                        @money($commissionTransaction->price)

                    </td>

                    <td>
                        
                        {{$commissionTransaction->percentage}} 

                    </td>

                    <td>
                        
                        @money($commissionTransaction->amount)

                    </td>

                    <td>
                        
                        {{$commissionTransaction->transaction_model}} 

                    </td>

                    <td>
                        
                        {{$commissionTransaction->transaction_id}} 

                    </td>

                </tr>
                @endforeach
            
            </tbody>
            <tfoot>

                <tr>
                    <td>
                        Total                 
                    </td>
                
                    <td colspan="2">
                        
                        @money($commissionTransactions->sum('price'))

                    </td>


                    <td colspan="3">
                        
                        @money($commissionTransactions->sum('amount'))

                    </td>

                </tr>

            </tfoot>
            
            
        </table>
        
    </div>
</div>


@push('script')

@endpush