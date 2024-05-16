<div class="card-body">
    <div class="container">
        <table class="table table-bordered datatable" id="revenueAddRemove">
            <thead>
                <tr>
                    <th>Property Title</th>
                    <th>Property Country</th>
                    <th>Property City</th>
                    <th>Shares</th>
                    <th>Amount</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($shares as $share)
                <tr>
                    <td>

                        {{$share->property->title}}
                                            
                    </td>

                    <td>

                        {{$share->property->address->country->name}}
                                            
                    </td>

                    <td>

                        {{$share->property->address->city->name}}
                                            
                    </td>
                
                    <td>
                        
                        {{number_format($share->sum_percentage, 3,'.','')}}

                    </td>

                    <td>
                        
                        @money($share->sum_amount)

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@push('script')

@endpush