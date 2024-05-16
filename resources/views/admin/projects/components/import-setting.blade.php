<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::select('type', 'Type of file to import',[0 => 'Trial Balance']) !!}
</div>

<div class="col-lg-5 col-xl-5-1 col-md-12 col-sm-12 d-inline-block">
    {!!Form::file('file', 'File')->id('excel_file')!!}
</div>

<div class="card-body">
    <div class="container">
    
          <div id="excel_data" style="overflow:scroll;height:400px;">

          </div>
         
          
     
        
    
       
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">
                    Account Name
                </th>
                <th scope="col">Account Number</th>
                <th scope="col">Currency</th>
                 <th scope="col">OB Debit</th>
                  <th scope="col"> OB Credit</th>
                <th scope="col">M Debit</th>
                <th scope="col">M Credit</th>
                <th scope="col">balance</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">
               <select name="account_name" id="account_name" class="form-control " >
                 <option value="">Account name</option>
               </select>
              </th>
                <td>
                  <select name="account_number" id="account_number" class="form-control" >
                    <option  value="" >Account number</option>
                </select></td>
                <td>
                  <select name="currency" id="currency" class="form-control"  >
                    <option  value=""> Currency</option>
                </select></td>
                 <td>
                  <select name="ob_debit" id="ob_debit" class="form-control" >
                    <option  value="">OB debit</option>
                  </select>
                </td>
                 <td>
                  <select name="ob_credit" id="ob_credit" class="form-control" >
                    <option  value="">OB debit</option>
                  </select>
                </td>
                <td>
                  <select name="m_debit" id="m_debit" class="form-control" >
                    <option  value="">M debit</option>
                  </select>
                </td>
                <td>
                  <select name="m_credit" id="m_credit" class="form-control" >
                    <option  value="">M credit</option>
                  </select>
                </td>
                <td>
                  <select name="balance" id="balance" class="form-control" >
                     <option  value="">Balance</option>
                  </select>
                </td>
              </tr>
             
            </tbody>
          </table>
    </div>
</div>