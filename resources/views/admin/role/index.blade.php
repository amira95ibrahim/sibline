@extends('admin.master')
@section('title','Roles')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Roles</h4>

                </div>

            </div>

            <div class="d-flex my-xl-auto right-content">

              <div class="pr-1 mb-3 mb-xl-0">

                    <a href="{{ url('admin/role/create') }}" title="Add Role">

                        <button type="button" class="btn btn-primary"><i class="mdi mdi-plus"></i></button>

                    </a>

                </div>



               

            </div>

        </div>
        

        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">

                        <div class="table-responsive userlist-table">

                            {!! $dataTable->table() !!}

                        </div>

                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')
{!! $dataTable->scripts() !!}
@endpush

