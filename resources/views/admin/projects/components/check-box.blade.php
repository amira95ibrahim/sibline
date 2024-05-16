@if($type == 'email')
<input type="checkbox" class="item_checkbox"  @if($query->confirmation_email == 1) checked onclick="return false;" @endif name="item[]"  value="{{$query->id}}" />
@else
<input type="checkbox" class="item_checkbox"  @if($query->authorization_request == 1) checked onclick="return false;" @endif name="item[]"  value="{{$query->id}}" />
@endif