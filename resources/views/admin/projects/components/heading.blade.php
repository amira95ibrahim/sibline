@if ($query->authorization_status == 0)
<h6> </h6>
@elseif($query->authorization_status == 1)
    <h6 style="color:#9A9A9A">Pending </h6>
@elseif($query->authorization_status == 2)
<h6 style="color:#FFA500"> Accepted (contact details missing )</h6>
@elseif($query->authorization_status == 3)
    <h6 style="color:green"> Accepted </h6>
@elseif($query->authorization_status == 4)
<h6 style="color:red"> Refused</h6>
@endif