<div class="card-body">
    <div class="container">
        <table class="table table-bordered datatable" id="revenueAddRemove">
            <thead>
                <tr>
                    <th>Property Title</th>
                    <th>Property Country</th>
                    <th>Property City</th>
                    <th>Total Amount</th>
                    <th>Shares</th>
                    <th>Commission</th>
                    <th>Date</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($revenues as $revenue)
                <tr>
                    <td>

                        {{$revenue->property->title}}
                                            
                    </td>

                    <td>

                        {{$revenue->property->address->country->name}}
                                            
                    </td>

                    <td>

                        {{$revenue->property->address->city->name}}
                                            
                    </td>

                    <td>

                        @money($revenue->amount)
                                            
                    </td>
                
                    <td>
                        
                        {{number_format($revenue->sum_percentage, 3,'.','')}}

                    </td>

                    <td>
                        
                        @money($revenue->sum_commission)

                    </td>

                    <td>

                        {{$revenue->date}}
                                            
                    </td>

                    

                </tr>
                @endforeach

                
            
            </tbody>
            
        </table>
        
    </div>
</div>


@push('script')

@endpush