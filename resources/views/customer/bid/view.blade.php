@extends($guard.'.master')
@section('title','Bid')
@section('content')

    @include('admin.bid.view-content')

@endsection

@push('script')
<script>
    function changeStatus(id,status) {
        data = {};
        if(status != 'pay'){
            $("#inp-message_reply").addClass("ckeditor");
            data = {'message_reply':CKEDITOR.instances['inp-message_reply'].getData()};
        }
        
        $.ajax({
                type:'PUT',
                url: id+'/'+status+'?_token=' + '{{ csrf_token() }}',
                data: data,
                success:function(data) {
                    Swal.fire(
                        'Done!',
                        data.msg,
                        'success'
                    );
                    location.reload();
                }
        });
    }

    
    
</script>
@endpush
