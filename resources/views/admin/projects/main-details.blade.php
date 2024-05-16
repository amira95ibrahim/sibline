<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('name', 'Name')->required()!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::date('fiscal_year', 'Fiscal Date')->required() !!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::select('status', 'Choose Status',[1 => 'Active' , 0 => 'Not Active'])->required()!!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
        {!!Form::select('customer_id', 'Choose Customer')->options(\App\Models\Customer::all()->prepend('None',null))->required()->id('inp-customer-id') !!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {{-- @if(isset($project))
    <label for="user_ids" class="required">Choose Users</label>
    <select  class="form-control select2" name="user_ids[]" multiple="multiple" id="inp-user-ids">
      @foreach(\App\Models\User::all() as $user)
      <option {{ $project->users()->where('user_id' , $user->id)->exists() ? 'selected' : '' }} value="{{$user->id}}">{{$user->user_name}}</option>
      @endforeach

  </select>
    @else --}}
    {!! Form::select('user_ids[]', 'Choose Users')->multiple()->options(\App\Models\User::all() , 'user_name' ,'id')->required()->id('inp-user-ids') !!}
    {{-- @endif --}}
</div>
    <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
        {!!Form::text('cfo_name', 'CFO Name')->required()!!}
    </div>
    


    <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
        {!!Form::text('cfo_email', 'CFO Email')->required()!!}
    </div>


  <div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
        {!!Form::date('project_date', 'Project date  ')->required()!!}
    </div>
