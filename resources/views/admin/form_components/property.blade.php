
<div class="card-body">
    <div class="container">
        <table class="table table-bordered datatable" id="">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Property Type</th>
                    <th>Country</th>
                    <th>City</th>                    
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                <tr>
                    <td>
                        {{$property->id}}                    
                    </td>
                
                    <td>
                        
                        {{$property->title}} 

                    </td>

                    <td>
                        
                        {{$property->propertyType? $property->propertyType->name : ""}} 

                    </td>

                    <td>
                        
                        {{$property->address->country->name}} 

                    </td>

                    <td>
                        
                        {{$property->address->city->name}} 

                    </td>

                    

                    

                </tr>
                @endforeach
            
            </tbody>
            
            
        </table>
        
    </div>
</div>


@push('script')

@endpush