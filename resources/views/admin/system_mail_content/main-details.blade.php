<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('name_mail', 'Name Email')->disabled() !!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('subject', 'Subject Email')->required() !!}
</div>

<div class="col-lg-12 col-xl-12-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::textarea('content', 'Email Content')->required() !!}
</div>



