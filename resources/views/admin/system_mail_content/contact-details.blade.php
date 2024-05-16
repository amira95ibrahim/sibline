
<div class="container">
    <table class="table table-bordered" id="dynamicAddRemove">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Position</th>
            <th>Phone</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>
        @for ($i = 0 ; $i < count($contacts) ; $i++)
            <tr>
                <td>
                    <input type="text" name="contact[{{$i}}][name]" placeholder="Enter Name" class="form-control @if($errors->has('contact.'.$i.'.name')) is-invalid @endif" value="{{$contacts[$i]['name']}}" />
                    @if($errors->has('contact.'.$i.'.name'))
                        <div class="invalid-feedback">{{$errors->first('contact.'.$i.'.name')}}</div>
                    @endif
                </td>
                <td>
                    <input type="email" name="contact[{{$i}}][email]" placeholder="Enter Email" class="form-control @if($errors->has('contact.'.$i.'.email')) is-invalid @endif " value="{{$contacts[$i]['email']}}"/>
                    @if($errors->has('contact.'.$i.'.email'))
                        <div class="invalid-feedback">{{$errors->first('contact.'.$i.'.email')}}</div>
                    @endif
                </td>
                <td>
                    <input type="password" name="contact[{{$i}}][password]" placeholder="Enter Password" class="form-control @if($errors->has('contact.'.$i.'.password')) is-invalid @endif" />
                    @if($errors->has('contact.'.$i.'.password'))
                        <div class="invalid-feedback">{{$errors->first('contact.'.$i.'.password')}}</div>
                    @endif
                </td>
                <td>
                    <input type="text" name="contact[{{$i}}][position]" placeholder="Enter Position" class="form-control @if($errors->has('contact.'.$i.'.position')) is-invalid @endif" value="{{$contacts[$i]['position']}}"/>
                    @if($errors->has('contact.'.$i.'.position'))
                        <div class="invalid-feedback">{{$errors->first('contact.'.$i.'.position')}}</div>
                    @endif
                </td>
                <td>
                    <input type="number" name="contact[{{$i}}][phone]" placeholder="Enter Phone" class="form-control @if($errors->has('contact.'.$i.'.phone')) is-invalid @endif" value="{{$contacts[$i]['phone']}}"/>
                    @if($errors->has('contact.'.$i.'.phone'))
                        <div class="invalid-feedback">{{$errors->first('contact.'.$i.'.phone')}}</div>
                    @endif
                </td>
                <td>
                    <input type="number" name="contact[{{$i}}][mobile]" placeholder="Enter Mobile" class="form-control @if($errors->has('contact.'.$i.'.mobile')) is-invalid @endif" value="{{$contacts[$i]['mobile']}}"/>
                    @if($errors->has('contact.'.$i.'.mobile'))
                        <div class="invalid-feedback">{{$errors->first('contact.'.$i.'.mobile')}}</div>
                    @endif
                </td>
                <td>
                    @if ($i == 0)
                        <button type="button" id="add-contact" class="btn btn-outline-primary">Add Contact</button>
                    @else
                        <button type="button" class="btn btn-outline-danger remove-contact">Delete</button>
                    @endif
                </td>
            </tr>
        @endfor
        
        
        
    </table>
    
</div>

@push('script')
<script>
var i = {{count($contacts)}};
$("#add-contact").click(function () {
    
    $("#dynamicAddRemove").append(`
        <tr>
            <td>
                <input type="text" name="contact[`+i+`][name]" placeholder="Enter Name" class="form-control" />
            </td>
            <td>
                <input type="email" name="contact[`+i+`][email]" placeholder="Enter Email" class="form-control" />
            </td>
            <td>
                <input type="password" name="contact[`+i+`][password]" placeholder="Enter Password" class="form-control" />
            </td>
            <td>
                <input type="text" name="contact[`+i+`][position]" placeholder="Enter Position" class="form-control" />
            </td>
            <td>
                <input type="number" name="contact[`+i+`][phone]" placeholder="Enter Phone" class="form-control" />
            </td>
            <td>
                <input type="number" name="contact[`+i+`][mobile]" placeholder="Enter Mobile" class="form-control" />
            </td>
            
            <td>
                <button type="button" class="btn btn-outline-danger remove-contact">Delete</button>
            </td>
        </tr>
    `
    );
    ++i;
});
$(document).on('click', '.remove-contact', function () {
    $(this).parents('tr').remove();
});
</script>
@endpush