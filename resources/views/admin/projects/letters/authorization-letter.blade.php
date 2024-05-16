<!DOCTYPE html>
<html>
<head>
	<title>Authorization Letter</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<style>
    p{
        text-align: justify;
        text-justify: inter-word;
    }
</style>
</head>
<body>
<div class="container">
 <table>
           
               <tbody>
                 <tr>
                    <td >
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($logo ?? '')))}}" style="width: 150px" class="main-logo" alt="logo">
                    </td>
                    <td></td>
                    <td></td>
                  <!--  <td ><p>Messrs’ “Related party name”</br>
                   <span>Att.: “Internal Audit Department” </span></br>
                   CC: “Accounting Department"</br></p>
                  </td>-->
                      <td style="text-align:left">
                    Name :{{$companyName ?? ''}}</br>
                     Email :{{$customerEmail ?? ''}}</br>
                      Address :{{$customerAddress ?? ''}}</br>
                     Phone :{{$customerPhone ?? ''}}</br>
                    </td>
                 </tr>
                 <br>
              
                  <p style="text-align:left">Beirut,{{$date}}</p>
           
           
                <tr >
                    <td colspan="4" style="text-align:center">
                        
	<h1 >Management’s Authorization Letter</h1>
                    </td>
                </tr>
    
<tr><td style="text-align:left" colspan="4">
<p >Dear Sir</p>
    
</td></tr>
<tr><td colspan="4">
    <p>We {{$companyName}} hereby authorize Messrs "AFS | Advanced Financial Solutions" in
connection with their audit on our financial records based on the attached representation
letter, to contact you directly in order to obtain as a direct written response from you as a
third party (the confirming party), in paper form, or by electronic or other me</p>
</td></tr>
<tr><td colspan="4">
<p style="text-align:right">Yours Faithfully</p></td></tr>
</table>




</div>
</body>
</html>