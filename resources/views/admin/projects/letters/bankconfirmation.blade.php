<!DOCTYPE html>
<html>
<head>
	<title>Bank Confirmation Request</title>
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
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/system_1647785474.png')))}}" style="width: 150px" class="main-logo" alt="logo">
                    </td>
                    <td></td> <td></td>
                    <td >Messrs. "Bank Name"</br>
                        Subject: Bank Confirmation Letter</br>
                    </td>
                 </tr><br>
                 
              
                <p style="text-align:left">Beirut, {{$date}}</p>
           
           
                <tr>
                    <td colspan="4">
                      <p>In connection with our examination of the financial statements of Messrs.{{$companyName}} for the year ended {{$fiscalYear ?? ''}}, we would appreciate your cooperation in 
                          providing confirmation regarding the company’s balances with your institution, as the close of business day on "Fiscal year ending day", especially the following: </p>
    
                       <p>1- Bank accounts: please indicate  descriptions,  account  numbers  and  balances  (including  zero  balances)  as  of  the reporting date for ALL accounts opened by the Institution
                           (including current and transit accounts, letters of credit, deposits, loans, compensating balances, etc.)</p>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <p>2- Bank Loans : please indicate each  loan  provided  by you,  excluding  loans  with  zero  balances  as  of  the reporting date with amendments  to  the  agreement, 
                        if  any, up to the date of your response, Principal amount, Payment terms, Interest rate, Outstanding balance as of the reporting date,
                        Collateral   provided   by   the Bank, Collateral  provided  by  third  parties  as  of  the reporting  date,  if  any.</p>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="4">
                        <p>If during the process of completing this confirmation additional information about other deposit and loan accounts we may have with you comes to your attention, 
                        please include such information below. </p>
                        <p>Please use the enclosed address to return the form directly to us.</p>
                    </td>
                </tr>
            
                <tr>
                    <td colspan="4">
                        <p>Beirut – Corniche El Mazraa – Saeb Salem Avenue – Al Hassan Center – Block A – 5th Floor. </p>
                        <p>And, by email to our email address: Audit@afsleb.com</p>
                        <p>And, by our web application here in.</p>
                    </td>
                </tr>
</table>




</div>
</body>
</html>