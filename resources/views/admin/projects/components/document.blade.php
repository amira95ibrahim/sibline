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
                            <input type="text" name="document[{{$i}}][name]" placeholder="Enter Title" class="form-control @if($errors->has('document.'.$i.'.name')) is-invalid @endif" value="{{$documents[$i]['name']}}" />
                            @if($errors->has('document.'.$i.'.name'))
                                <div class="invalid-feedback">{{$errors->first('document.'.$i.'.name')}}</div>
                            @endif
                        </td>
                        
                        <td>
                            <input type="file" name="document[{{$i}}][path]" class="form-control @if($errors->has('document.'.$i.'.path')) is-invalid @endif" />
                            @if($errors->has('document.'.$i.'.path'))
                                <div class="invalid-feedback">{{$errors->first('document.'.$i.'.path')}}</div>
                            @endif
                        </td>

                        <td>
                            @if(isset($documents[$i]['path']) && $documents[$i]['path'] != "")
                        
                            <a href="{{asset('images/'.$documents[$i]['path'] )}}" onclick="window.open(this.href,'_blank');return false;">Review Document </a>
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
                <input type="text" name="document[`+i_documents+`][name]" placeholder="Enter Title" class="form-control" />
            </td>
            <td>
                <input type="file" name="document[`+i_documents+`][path]" class="form-control" />
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

$('a').each(function() {
   var a = new RegExp('/' + window.location.host + '/');
   if(!a.test(this.href)) {
       $(this).click(function(event) {
           event.preventDefault();
           event.stopPropagation();
           window.open(this.href, '_blank');
       });
   }
});
</script>
@endpush