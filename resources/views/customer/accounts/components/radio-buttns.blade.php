<div class="form-check">
    <input class="form-check-input approve"  @if($val == 2) checked  @endif  type="radio" name="authorization_status_{{$query->id}}"  value="2" id="{{$query->id}}">
    <label class="form-check-label" for="flexRadioDefault1">
      Accept
    </label>
  </div>
  <div class="form-check">
    <input class="form-check-input notApprove"  @if($val == 4) checked @endif   type="radio" name="authorization_status_{{$query->id}}" value="4" id="{{$query->id}}" >
    <label class="form-check-label" for="flexRadioDefault2">
        Refuse
    </label>
  </div>
  

