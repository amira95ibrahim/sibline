@extends('admin.master')
@section('title','System Remember')
@section('content')
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">System Remember Account Settings</h4>

                </div>

            </div>
        </div>

        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">

                <div class="card">

                    <div class="card-body">
                        @if(isset($email))

                            {!!Form::open()->fill($email)->put()->multipart()->route('admin.mails.update',[$email->id])!!}
                        @else
                            {!!Form::open()->multipart()->route('admin.systemRemember.store')!!}
                        @endif

                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <ul class="nav panel-tabs main-nav-line" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="main-tab" data-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">Main Details</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
                                        @include('admin.system_mail_content.main-details')
                                    </div>

                                </div>
                            </div>
                        </div>


                        @if(!isset($show))
                        <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                            {!!Form::submit("Save")!!}
                        </div>
                        @endif


                        {!!Form::close()!!}

                    </div>

                </div>

            </div><!-- COL END -->

        </div>
@endsection

@push('script')
<script>

</script>
@endpush
