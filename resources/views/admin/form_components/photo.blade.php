@if(!isset($hideTitle))
    <h5 class="content-title mb-0 my-auto">Photo Details </h5>
    <hr>
@endif

<div class="container">
        <table class="table table-bordered" id="photoAddRemove">
            <tr>
                <th>Title</th>
                <th>Photo</th>
                <th>Preview</th>
                <th>Action</th>
            </tr>
            @for ($i = 0 ; $i < count($photos) ; $i++)
                <tr>
                    <td>
                        <input type="text" name="photo[{{$i}}][title]" placeholder="Enter Title" class="form-control @if($errors->has('photo.'.$i.'.title')) is-invalid @endif" value="{{$photos[$i]['title']}}" />
                        @if($errors->has('photo.'.$i.'.title'))
                            <div class="invalid-feedback">{{$errors->first('photo.'.$i.'.title')}}</div>
                        @endif
                    </td>
                    
                    <td>
                        <input type="file" name="photo[{{$i}}][url]" class="form-control @if($errors->has('photo.'.$i.'.url')) is-invalid @endif"  />
                        @if($errors->has('photo.'.$i.'.url'))
                            <div class="invalid-feedback">{{$errors->first('photo.'.$i.'.url')}}</div>
                        @endif
                    </td>

                    <td>
                        @if(isset($photos[$i]['thumb']))
                        <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
                            <a href="{{asset('images/'.$photos[$i]['thumb'])}}" target="_blank" rel="noopener noreferrer"><img src="{{asset('images/'.$photos[$i]['thumb'])}}" class="img-thumbnail w-50"/></a>
                        </div>
                        @endif
                    </td>
                    <td>
                        @if ($i == 0)
                            <button type="button" id="add-photo" class="btn btn-outline-primary">Add More</button>
                        @else
                            <button type="button" class="btn btn-outline-danger remove-photo">Delete</button>
                        @endif
                    </td>
                </tr>
            @endfor
            
            
            
        </table>
        
</div>

@push('script')
<script>
    var i_photos = {{count($photos)}};
    $("#add-photo").click(function () {
        
        $("#photoAddRemove").append(`
            <tr>
                <td>
                    <input type="text" name="photo[`+i_photos+`][title]" placeholder="Enter Title" class="form-control" />
                </td>
                <td>
                    <input type="file" name="photo[`+i_photos+`][url]" class="form-control" />
                </td>
                <td>
                </td>               
                <td>
                    <button type="button" class="btn btn-outline-danger remove-photo">Delete</button>
                </td>
            </tr>
        `
        );
        ++i_photos;
    });
    $(document).on('click', '.remove-photo', function () {
        $(this).parents('tr').remove();
    });
</script>
@endpush