<!DOCTYPE html>
<html>
<head>
  <title>Activation Email</title>
  <style>
    *{ margin: auto; padding:0; }
    table{margin: 20px auto; text-align: center;height: auto; width: 850px;border-style: hidden;border-radius: 4px;font-family:serif; font-size: 18px;line-height: 1.5em;background: #fdf7f7;}
  </style>
</head>
<body>
<table  class="text-center">
  <tr style="">
    <td style="padding: 8px 0px;">
      <a href="{{ url('/') }}">
            <img src="{{asset('images/'.$system_info->logo_header )}}"  alt="{{ $system_info->name }}">
          </a></td>
  </tr>
  <tr style="height:auto;">
    <td  >
      <p style="width:240px;padding: 10px 20px;border-bottom: 2px solid #888888;margin-top: 20px;font-size: 1.3em;">Email Verification</p>
      <p style="margin: 20px 25px;font-size: 1.1em;">Hi {{ $name }},<br> Please verify your email address on our system. Here is the Code.</p>
      <span href="" style="padding: 12px 30px;text-decoration:none;background-color: #dff0d8;border:1px solid #d4cccc;border-radius: 5px;font-size: 1.1em;">{{ $token }}</span>

      <p style="margin: 20px 25px;font-size: 1.1em;"></p>
      
    </td>
  </tr>
  
</table>
</body>
</html>