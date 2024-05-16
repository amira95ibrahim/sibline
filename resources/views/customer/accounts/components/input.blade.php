<style>
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
    input[type=number] {
  -moz-appearance: textfield;
}
</style>
<input type="{{$input_type ?? 'text'}}" class="form-control {{$name}}"  @if(isset($val))value="{{$val}}"@endif name="{{$name}}_{{$query->id}}" account_id="{{$query->id}}" >
