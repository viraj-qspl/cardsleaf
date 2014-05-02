<html>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<body>
<div style="margin-top:15px;">
	<div class="receiverdetails">Receiver Details</div>
    <div class="receiver_details">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="rdl">First Name:</td>
            <td class="rdf" id="rname"><?php echo $thecardDtls['name']?></td>
          </tr>
	  <tr>
            <td class="rdl">Last Name:</td>
            <td class="rdf" id="lname"><?php echo $thecardDtls['lname']?></td>
          </tr>
	  <tr>
            <td class="rdl">Delivery Date:</td>
            <td class="rdf" id="rddt"><?php echo $thecardDtls['delivery_dt']?></td>
          </tr>
	  <tr>
            <td class="rdl">Country:</td>
            <td class="rdf" id="rcountry"><?php echo $thecardDtls['cname']?></td>
          </tr>
          <tr>
            <td class="rdl">Address:</td>
            <td class="rdf" id="radd"><?php echo $thecardDtls['reciver_add1']?></td>
          </tr>
	  <tr>
            <td class="rdl">State:</td>
            <td class="rdf" id="rstate"><?php echo $thecardDtls['sname']?></td>
          </tr>
	  <tr>
            <td class="rdl">City:</td>
            <td class="rdf" id="rcity"><?php echo $thecardDtls['city']?></td>
          </tr>
          <tr>
            <td class="rdl">Zip:</td>
            <td class="rdf" id="rzip"><?php echo $thecardDtls['zipcode']?></td>
          </tr>
          <tr>
            <td class="rdl">Contact Number:</td>
            <td class="rdf" id="rcontact"><?php echo $thecardDtls['contactno']?></td>
          </tr>
        </table>
    </div>
</div>
</body>
</html>
