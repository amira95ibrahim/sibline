<h4>Assinging Permission</h4>
<hr>
@foreach($menus as $index => $value) 

    @if($index !==0)
        <div class="col-md-12">
            <hr>
        </div>
    @endif

    <div class="col-md-12">
        
        <h5>{{ $value['name'] }}</h5>

        @if(count($value['sub_menu']) == 0)
            
            {!!Form::checkbox('permission[]', $value['name'],$value['id'],$value['check'])->id('permission_'.$value['id'])!!}
        @else
            @if($value['menu_url'])
            <div class="col-lg-4 col-xl-4-1 col-md-12 col-sm-12 d-inline-block">
                {!!Form::checkbox('permission[]', $value['name'],$value['id'],$value['check'])->id('permission_'.$value['id'])!!}
            </div>
            @endif
            @foreach($value['sub_menu'] as $sub_index => $sub_value) 
            <div class="col-lg-4 col-xl-4-1 col-md-12 col-sm-12 d-inline-block">
                {!!Form::checkbox('permission[]', $sub_value['name'],$sub_value['id'],$sub_value['check'])->id('permission_'.$sub_value['id'])!!}
            </div>
            @endforeach
        @endif
    </div>                     
@endforeach
<br><br>