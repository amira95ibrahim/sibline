<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    <label>Account Type</label>
    <select id="account_type" name="status_account" class="form-control" disabled>
        <option @if($system_remember->status_account == 1 ) selected @endif value="1">Pending</option>
        <option @if($system_remember->status_account == 2 ) selected @endif value="2">Accepted
            (details missing)</option>
        <option @if($system_remember->status_account == 3 ) selected @endif
        value="3">Accepted</option>
        <option @if($system_remember->status_account == 4 )selected @endif
        value="4">Refused</option>
    </select>


</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::text('time', 'Time Remember Email')->required()->type('number') !!}
</div>



