@if(!isset($hideTitle))
    <h5 class="content-title mb-0 my-auto">Document Details </h5>
    <hr>
@endif

<div class="card-body">
    <div class="container">
        <table class="table table-bordered" id="documentAddRemove">
            <tr>
                <th>Title</th>
                <th>Document</th>
                <th>Preview</th>
                <th>Action</th>
            </tr>
            @for ($i = 0 ; $i < count($documents) ; $i++)
                <tr>
                    <td>
                        <input type="text" name="document[{{$i}}][title]" placeholder="Enter Title" class="form-control @if($errors->has('document.'.$i.'.title')) is-invalid @endif" value="{{$documents[$i]['title']}}" />
                        @if($errors->has('document.'.$i.'.title'))
                            <div class="invalid-feedback">{{$errors->first('document.'.$i.'.title')}}</div>
                        @endif
                    </td>
                    
                    <td>
                        <input type="file" name="document[{{$i}}][url]" class="form-control @if($errors->has('document.'.$i.'.url')) is-invalid @endif" />
                        @if($errors->has('document.'.$i.'.url'))
                            <div class="invalid-feedback">{{$errors->first('document.'.$i.'.url')}}</div>
                        @endif
                    </td>

                    <td>
                        @if(isset($documents[$i]['url']) && $documents[$i]['url'] != "")
                            <a href="{{asset('images/'.$documents[$i]['url'] )}}">Review Document</a>
                        @endif
                        
                    </td>

                    <td>
                        @if ($i == 0)
                            <button type="button" id="add-document" class="btn btn-outline-primary">Add More</button>
                        @else
                            <button type="button" class="btn btn-outline-danger remove-document">Delete</button>
                        @endif
                    </td>
                </tr>
            @endfor
            
            
            
        </table>
        
    </div>
</div>

@push('script')
<script>
var i_documents = {{count($documents)}};
$("#add-document").click(function () {
    
    $("#documentAddRemove").append(`
        <tr>
            <td>
                <input type="text" name="document[`+i_documents+`][title]" placeholder="Enter Title" class="form-control" />
            </td>
            <td>
                <input type="file" name="document[`+i_documents+`][url]" class="form-control" />
            </td>
            <td>
            </td>
                           
            <td>
                <button type="button" class="btn btn-outline-danger remove-document">Delete</button>
            </td>
        </tr>
    `
    );
    ++i_documents;
});
$(document).on('click', '.remove-document', function () {
    $(this).parents('tr').remove();
});
</script>
@endpush