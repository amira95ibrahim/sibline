<!DOCTYPE html>
<html>
<head>
  <title>{{$title}}</title>
  <style>
    *{ margin: auto; padding:0; }
    table{margin: 20px auto; text-align: center;height: auto; width: 850px;border-style: hidden;border-radius: 4px;font-family:serif; font-size: 18px;line-height: 1.5em;background: #fdf7f7;}
    img{width: 30%}
  </style>
</head>
<body>
<table>
  <tr style="">
    <td style="padding: 8px 0px;">
      <a href="{{ url('/') }}">
            <img  src="{{asset('images/'.$system_info->logo_header )}}"  alt="{{ $system_info->name }}">
          </a></td>
  </tr>
  <tr style="height:auto;">
    <td>
      <p style="width:240px;padding: 10px 20px;border-bottom: 2px solid #888888;margin-top: 20px;
      font-size: 1.3em;">{{$title}}</p>
      <p style="font-size: 1.1em;">Dear {{ $customer_name ?? 'name ' }},<br> {!! $body!!}
       </p><br>
      <a href="https://audit.afsleb.com/public/download/{{ $letterType ?? 'clients' }}/{{$id}}"
        style="padding: 15px 30px;text-decoration:none;background-color: #dff0d8;border:1px solid #d4cccc;border-radius: 5px;font-size: 1.1em;margin-top:20px;" target="_self">
         {{$title}}
      </a>

      <p style="margin: 20px 25px;font-size: 1.1em;"></p>

    </td>
  </tr>
</table>
</body>
</html>