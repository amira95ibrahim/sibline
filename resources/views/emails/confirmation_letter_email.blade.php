<!DOCTYPE html>
<html>
<head>
  <title>{{$title}}</title>
  <style>
    *{ margin: auto; padding:0; }
    table{margin: 20px auto; text-align: center;height: auto; width: 850px;border-style: hidden;border-radius: 4px;font-family:serif; font-size: 18px;line-height: 1.5em;background: #fdf7f7;}
  </style>
</head>
<body>
<table  class="text-center">
  <tr style="">
    <td style="padding: 8px 0px;">
      <a href="{{ route('customer.login') }}">
            <img style="width:140px;heigth:140px" src="{{asset('images/'.$system_info->logo_header )}}"  alt="{{ $system_info->name }}">
          </a></td>
  </tr>
  <tr style="height:auto;">
    <td >
      <p style="width:240px;padding: 10px 10px;border-bottom: 2px solid #888888;margin-top: 10px;
      font-size: 1.3em;">{{ $title }}<br>
       <p style="margin: 20px 25px;font-size: 1.1em;">Dear {{ $customer_name ?? ' ' }},
          {!! $body !!}  {{ $account_no }}</p>
      <a href="{{route('data_project', ['customer_hash' => $customer_hash , 'account_hash' => $account_hash ,'system_info_hash' => $system_info_hash]) }}"
        style="padding: 15px 15px;text-decoration:none;background-color: #dff0d8;border:1px solid #d4cccc;border-radius: 5px;font-size: 1.1em;">
        System Link For Confirmation
      </a>
</td>
</tr>
<tr style="height:auto; padding:8px" ><td style="padding: 8px 0px;">
      <p style="margin: 20px 25px;font-size: 1.1em;"></p>
        <a href="https://audit.afsleb.com/public/download/{{ $file }}/{{$id }}"
        style="padding: 15px 15px;text-decoration:none;background-color: #dff0d8;border:1px solid #d4cccc;border-radius: 5px;font-size: 1.1em;">
        Download Pdf Letter
      </a>
    </td>
  </tr>

</table>
</body>
</html>
