@extends('customer.master')
@section('title','Property')
@section('content')

<div class="container-fluid main_content">
    <div class="row d-flex flex-wrap">
        
        {!! $dataTable->table() !!}
    </div>
</div>

@endsection

@push('script')
    {!! $dataTable->scripts() !!}
@endpush


