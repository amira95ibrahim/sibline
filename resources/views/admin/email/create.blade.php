@extends('admin.master')
@section('title','Email')
@section('content')
        
        <div class="breadcrumb-header justify-content-between">

            <div class="my-auto">

                <div class="d-flex">

                    <h4 class="content-title mb-0 my-auto">Manage Email</h4>

                </div>

            </div>
        </div>
        <!-- breadcrumb -->

        <!--Row-->

        <div class="row row-sm">

            <div class="col-sm-7 col-md-7 col-lg-7 col-xl-7 grid-margin">

                <div class="card">

                    <div class="card-body">
                        

                            {!!Form::open()->fill($email)->put()->multipart()->route('admin.email.update',[$email->id])!!}
                        
                        
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('host', 'Host')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('port', 'Port')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('username', 'Username')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('password', 'Password',$email->password)->required()!!}
                            </div>


                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::select('encryption', 'Choose Encryption',['tls' => 'TLS', 'ssl' => 'SSL'])->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('from_address', 'From Address')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::text('from_name', 'From Name')->required()!!}
                            </div>

                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::select('status', 'Choose Status',[ 1 => 'Active' , 0 => 'Not Active'])->required()!!}
                            </div>
                            
                            <div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
                                {!!Form::submit("Save")!!}
                            </div>                            
                            
                            {!!Form::close()!!}


                        
                    </div>

                </div>

            </div>

            <div class="col-sm-5 col-md-5 col-lg-5 col-xl-5 grid-margin">

                <div class="card">
                    <div class="card-header">
                       <div class="card-title">
                          <h3>Instuction</h3>
                       </div>
                    </div>
                    <div class="card-body">
                       <ul>
                          <li>Make sure you select IMAP server to send email. The mailing driver you'd like to use. By default, this is set to SMTP, but you can also change it to use PHPs mail feature or Sendmail instead.</li>
                          <li>Enter your SMTP server's host address.</li>
                          <li>Under user information, enter a name and the current email address in which you would like to set up.</li>
                          <li>Enter your email address into the username field and your password that you have been sent.</li>
                          <li>
                             Turning on 'less secure apps' settings as mailbox user
                             <ul>
                                <li>Go to your (Google Account).</li>
                                <li>On the left navigation panel, click Security.</li>
                                <li>On the bottom of the page, in the Less secure app access panel, click Turn on access.</li>
                                <li>If you don't see this setting, your administrator might have turned off less secure app account access (check the instruction above).</li>
                                <li>Click the Save button.</li>
                             </ul>
                          </li>
                       </ul>
                    </div>
                </div>

            </div>

        </div>
        
@endsection

@push('script')

@endpush
