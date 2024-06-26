<!DOCTYPE html>
<html>
<head>
  <title>Password Reset</title>
  <style>
    *{ margin: auto; padding:0; }
    table{margin: 20px auto; text-align: center;height: auto; width: 850px;border-style: hidden;border-radius: 4px;font-family:serif; font-size: 18px;line-height: 1.5em;background: #fdf7f7;}
  </style>
</head>
<body>
<table>
  <tr style="">
    <td style="padding: 8px 0px;">
      <a href="{{ url('/') }}">
            <img src="{{asset('images/'.$system_info->logo_header )}}"  alt="{{ $system_info->name }}">
          </a></td>
  </tr>
  <tr style="height:auto;">
    <td>
      <p style="width:240px;padding: 10px 20px;border-bottom: 2px solid #888888;margin-top: 20px;font-size: 1.3em;">Reset Your Password</p>
            <p style="margin: 20px 25px;font-size: 1.1em;">Tap the button below to reset your account password. If you didn't request a new password, you can safely delete this email.</p>

          <a href="{{ url($guard.'/reset/'.$token)}}" style="padding: 12px 30px;text-decoration:none;background-color: #dff0d8;border:1px solid #d4cccc;border-radius: 5px;font-size: 1.1em;">Click To Reset Password</a>

          <p style="margin: 20px 25px;font-size: 1.1em;">If that doesn't work, copy and paste the following link in your browser: <a href="{{ url($guard.'/reset/'.$token)}}" target="_blank">{{ url($guard.'/reset/'.$token)}}</a></p>
 
    </td>
  </tr>
  
</table>
</body>
</html>