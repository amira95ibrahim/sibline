<div class="table-responsive userlist-table">
      <div class="pr-1 mb-3 mb-xl-2 ">
            {{-- @dd($pending_accounts) --}}
            @if(isset($pending_accounts))
              <a href="#" class="badge badge-secondary">Pending {{$pending_accounts}}</a>
          
            @endif
            @if(isset($approve_missing))
            <a href="#" class="badge badge-warning">Accepted (contact details missing) {{$approve_missing}}</a>
          
          @endif
          @if(isset($approve_accounts))
          <a href="#" class="badge badge-success">Accepted {{$approve_accounts}}</a>
      
        @endif
        @if(isset($refuse_account))
        <a href="#" class="badge badge-danger">Refused {{$refuse_account}}</a>
       
      @endif
        </div>

      {!! $dataTable->table() !!}
    
</div>

@push('script')

{!! $dataTable->scripts() !!}
@endpush



