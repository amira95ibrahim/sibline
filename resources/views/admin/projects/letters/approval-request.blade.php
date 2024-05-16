<!DOCTYPE html>
<html>
<head>
	<title>Approval Request</title>
	

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
<div class="container" >
    <table>
        <tr>
            <th>  <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/system_1647785474.png')))}}" style="width: 150px;" class="main-logo" alt="logo"></th>
            <th>Messrs’ {{$companyName}} <br>Att.: "Chairman of Board of Directors" <br>CC: “Internal Audit Department”; “Accounting Department” <br> Beirut, {{$date}}
             </th>
            
        </tr>
     
         <tr>
             <td  style="text-align:center" colspan="2">
	                        <h1>Letter of Request to Approve </h1>
             </td>
             <td></td>
           
        </tr>
        <tr>
             <td colspan="2" >
                         <h3>Subject: Letter of request to approve the communication with the company’s related parties.</h3>
                        </td>
                          <td></td>
                   
         </tr>
                <tr>
                   <td style="text-align:left" colspan="2">
                     <p >Dear Sir</p>
    
                   </td>
                  
                    <td></td>
                </tr>
                
                
                <tr><td colspan="2">
    <p >We hereby request for your approval to communicate directly with your company’s   
    third parties according to “IAS 505- External Confirmation”, in order to obtain confirmation on their balances in the process of collecting audit evidences. </p>
    <p >Accordingly, this request is submitted for your kind consideration and approval, within the scope of the objectives of our external audit to Messrs’ {{$companyName}}.</p>
</td>  <td></td>
                   </tr>
<tr><td colspan="4">
<p style="text-align:right">Yours Faithfully</p></td>  <td></td>
                  </tr>
<tr>
    <td colspan="2" >
        <p>Notes:</p>
        <p>* Please find below list of parties that we would communicate with.</p>
        <p>* The request of Approval should be sent to our behalf during 15 days from date.</p>
        <p >* The approved parties should be attached with contact details, otherwise it will be considered as unapproved.</p>
    </td>  <td></td>
                   
</tr>
  <tr><td></td><td></td></tr>
   @if($accounts)
<tr style="border:1px solid black">
    <td style="border:1px solid black">Account Number</td>
    <td style="border:1px solid black" colspan="4">Account Name</td>
     
   </tr>
 
        @foreach($accounts as $account)
         <tr style="border:1px solid black">
             <td style="border:1px solid black">{{$account->account_number}}</td>
              <td style="border:1px solid black" colspan="4">{{$account->account_name}}</td>
            
             </tr>
        @endforeach
    @endif
    </table>




</div>
</body>
</html>