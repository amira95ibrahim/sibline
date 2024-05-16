@if($query->type_replay && $query->is_replay )
<a href="{{route('admin.get_data_accounts_ajax',$query->id)}}" class="" target="_blank">
    <i class="fas fa-eye"></i>
</a>
@endif
