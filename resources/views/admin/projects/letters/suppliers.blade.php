<!DOCTYPE html>
<html>
<head>
	<title> Suppliers</title>
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
                    <td></td>
                    <td></td>
                    <td >Name "Related party name"</br>
                   <span>Address "As indicated by the company" </span></br>
                  </td>
                 </tr>
                 <br>
           
           
                <tr >
                    <td colspan="4" style="text-align:center">
	                        <h1 >Creditors Confirmation</h1>
                    </td>
                </tr>
                    <tr>
                        <td colspan="4" >
                            <p>In connection with our audit of the records of Messrs. {{$companyName}},
                          , please provide us with the balances of your accounts with "Company Name" directly to us via this web application OR to our address below:</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" >
                            <h3>AFS | Advanced Financial Solutions</h3>
                            <h3>Cornish Mazraa – Saeb Salam Avenue – Hassan Center, Block A – 5th Floor</h3>
                            <h3>Beirut - Lebanon</h3>
                            <h3>Fax: 01/702216 |   Email: Audit@afsleb.com</h3>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" >
                            <p> Your account (s) as at {{$fiscalYear ?? ''}} shows the following balances (s) :</p>
                        </td>
                    </tr>
                    
                      <tr>
                        <td colspan="4" >
                           <table width="100%" style="border:1px solid black">
                              <thead>
                                  <tr>
                                      <th colspan="2">Account No</th>
                                      <th colspan="2">Debit</th>
                                      <th colspan="2">Credit</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td></td>
                                  </tr>
                              </tbody>
                           </table>
                        </td>
                    </tr>
                    
                    </br></br>
                     <tr>
                        <td colspan="4" >
                            <h3> to AFS | Advanced Financial Solutions</h3>
                            <h3>Cornish Mazraa – Saeb Salam Avenue – Hassan Center, Block A – 5th Floor</h3>
                            <h3>Beirut - Lebanon</h3>
                            <h3>Fax: 01/702216 |   Email: Audit@afsleb.com</h3>
                        </td>
                    </tr> 
                    
                     <tr>
                        <td colspan="4">
                            <p>The above information is <strong>correct</strong>.  </p>
                            <p>Date 	:		…………………………………………</p>
                            <p style="text-align:right">Signature	:  	…………………………………………</p>
                            <p style="text-align:right">Stamp 	 :	………………………………………… </p>
                        </td>
                    </tr>
                       <tr>
                        <td colspan="4">
                            <p>The above information is <strong>not correct.</strong>  </p>
                            <p>(The exceptions are shown on the margin side of this letter).</p>
                            <p>Date 	:		…………………………………………</p>
                            <p style="text-align:right">Signature	:  	…………………………………………</p>
                            <p style="text-align:right">Stamp 	 :	………………………………………… </p>
                        </td>
                    </tr>
                    
                      <tr>
                        <td colspan="4">
                            <p>Non response within fifteen days from the date of receipt of this request will be considered as a confirmation of the validity of your balance shown above.</p>
                        </td>
                    </tr>
                    
  
</table>




</div>
</body>
</html>