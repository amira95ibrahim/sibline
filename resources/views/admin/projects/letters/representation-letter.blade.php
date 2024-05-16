<!DOCTYPE html>
<html>
<head>
	<title>Reepresentation Letter</title>
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
                      <!-- <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/system_1647785474.png')))}}" style="width: 150px" class="main-logo" alt="logo"> -->
                            @if($logo)
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path($logo)))}}" style="width: 150px" class="main-logo" alt="logo">
                                @else
                                    <p>No logo found</p>
                                @endif

                    </td>
                    <td></td>
                    <td></td>
                    <td style="text-align:left">
                    Name :{{$companyName ?? ''}}</br>
                     Email :{{$customerEmail ?? ''}}</br>
                      Address :{{$customerAddress ?? ''}}</br>
                     Phone :{{$customerPhone ?? ''}}</br>
                    </td>
                
                 </tr>
                
              
           
           
                <tr >
                    <td colspan="4" style="text-align:center">
                        
                	<h1 style="text-align:center" >
                	    Representation Letter<br>
                       (As for ISA 580)</h1>

                    </td>
                </tr>
                 
                 <tr>
                     <td colspan="2">
                          	<p style="text-align:left">To: AFS | Advanced Financial Solutions</p >
                     </td>
                     <td colspan="2">
                         	<p style="text-align:right">{{$date}}</p>
                     </td>
                 </tr>
                 <tr>
                     <td colspan="4">
                     	<p >This representation letter is provided in connection with your audit of the financial statements of
                           <span > {{$companyName}}</span> for the year ended {{$fiscalYear ?? ''}} for the purpose of expressing an opinion as
                            to whether the financial statements are presented fairly, in all material respects, (or give a true and fair
                            view) in accordance with International Financial Reporting Standards.</p>
                            
                           <p >We confirm that (to the best of our knowledge and belief, having made such inquiries as we considered
                           necessary for the purpose of appropriately informing ourselves):</p>
                     </td>
                 </tr>
      
                <tr>
                     <td colspan="4">
                        <h3>Financial Statements:</h3>
                         <p >• We have fulfilled our responsibilities, as set out in the terms of the audit engagement dated March 3,
                           2022, for the preparation of the financial statements in accordance with International Financial
                           Reporting Standards; in particular the financial statements are fairly presented (or give a true and fair
                           view) in accordance therewith.
                         </p>
                     </td>
               </tr>
                 
                  <tr>
                     <td colspan="4">
                         
                            <p >Significant assumptions used by us in making accounting estimates, including those measured at fair
                             value, are reasonable (ISA 540).</p>

                            <p >• Related party relationships and transactions have been appropriately accounted for and disclosed in
                            accordance with the requirements of International Financial Reporting Standards (ISA 550).</p>
                     </td>
                 </tr>

                <tr>
                     <td colspan="4">
                         <p >• All events subsequent to the date of the financial statements and for which International Financial
                          Reporting Standards require adjustment or disclosure have been adjusted or disclosed (ISA 560).</p>

                         <p >The effects of uncorrected misstatements are immaterial, both individually and in the aggregate, to
                         the financial statements as a whole. A list of the uncorrected misstatements is attached to the
                         representation letter (ISA 450)</p>
                         
                    </td>
               </tr>

               <tr>
                     <td colspan="4">
                        <h3>Information Provided:</h3>
                         <p> • We have provided you with:
                            - Access to all information of which we are aware that is relevant to the preparation of the
                            financial statements, such as records, documentation and other matters;
                            - Additional information that you have requested from us for the purpose of the audit; and
                            - Unrestricted access to persons within the entity from whom you determined it necessary
                            to obtain audit evidence.</p>
                     </td>
              </tr>
    
               <tr>
                     <td colspan="4">
                        <p>• All transactions have been recorded in the accounting records and are reflected in the financial
                            statements.</p>
                        <p>• We have disclosed to you the results of our assessment of the risk that the financial statements may
                        be materially misstated as a result of fraud (ISA 240).</p>
                        <p>• We have disclosed to you all information in relation to fraud or suspected fraud that we are aware of
                        and that affects the entity and involves:
                        - Management;
                        - Employees who have significant roles in internal control; or
                        - Others where the fraud could have a material effect on the financial statements.</p>
                     </td>
              </tr>

              <tr>
                    <td colspan="4">
                        <p>• We have disclosed to you all information in relation to allegations of fraud, or suspected fraud,
                         affecting the entity’s financial statements communicated by employees, former employees, analysts,
                         regulators or others (ISA 240).</p>
                       <p>• We have disclosed to you in writing all known instances of non-compliance or suspected non-
                        compliance with laws and regulations whose effects should be considered when preparing financial
                        statements (ISA 250).</p>

        </td>
              </tr>

              <tr>
                    <td colspan="4">
                    <p>• We have disclosed to you in writing the identity of the entity’s related parties and all the related party
                    relationships and transactions of which we are aware (ISA 550).</p>
                    <p>
                     • According to ISA 505 – External confirmation, we hereby approve for your request to communicate
                    directly with our company’s third parties.
                    </p>

                    </td>
              </tr>

            <tr>
                <td>
                    <h3>Management
                    <br>Chairman of Board
                    <br>General Manager - CEO</h3>
                </td>
                <td></td>
                <td></td>
                <td>
                  <h3>Management</h3>
                  <h3>Financial Manager - CFO</h3>  
                </td>
            </tr>




</table>
</body>
</html>