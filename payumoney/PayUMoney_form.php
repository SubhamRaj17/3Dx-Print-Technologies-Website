       <?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

?>
<?php
  include "../storescripts/connect_to_mysql.php";
$cartTotal = "";
$product_name1 = "";
if(isset($_SESSION["id"])){
  $cid=$_SESSION["id"];
  $sql = mysql_query("SELECT * FROM customer_cart WHERE customerid='$cid'") or die(mysql_error());
  $sql1 = mysql_query("SELECT * FROM customer WHERE id='$cid'") or die(mysql_error());
  $count = mysql_num_rows($sql); 
    $i=0;
    while ($lists = mysql_fetch_array($sql)) {
        $item_id = $lists["productid"];
        $sqls = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1") or die(mysql_error());
        $list = mysql_fetch_array($sqls);
        $product_name = $list["product_name"];
        $product_name1 = $product_name.'||'.$product_name1;
        $price = $list["price"];
        $quantity = $lists["quantity"];
        $pricetotal = $price * $quantity;
        $cartTotal = $pricetotal + $cartTotal;

  }
  while ($lists1 = mysql_fetch_array($sql1)) {
        $email = $lists1["email"];
        $mobile = $lists1["mobile"];
        $name = $lists1["name"];
        $address1 = $lists1["address"];
        $address2 = $lists1["address"];
        $state = $lists1["state"];
        $pin = $lists1["pin"];
        $city =$lists1["city"];
        $lname = $lists1["login"];
        $country = "india";
  }
}
?>
<?php
 

	$merchant_key  = "gtKFFx";
	$salt          = "eCwWELxi";
	$payu_base_url = "https://test.payu.in"; 
	$action        = ''; 
	$currentDir	   = 'http://localhost/Main%20Website/payumoney/';
	$posted = array();
	if(!empty($_POST)) {
	  foreach($_POST as $key => $value) {    
	    $posted[$key] = $value; 
	  }
	}




	$formError = 0;
	if(empty($posted['txnid'])) {
	  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
	} else {
	  $txnid = $posted['txnid'];
	}
  
	$hash         = '';
	$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";

	if(empty($posted['hash']) && sizeof($posted) > 0) {
	  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])
          || empty($posted['surl'])
          || empty($posted['furl'])
	  ){
	    $formError = 1;

	  } else {
	   	$hashVarsSeq = explode('|', $hashSequence);
	    $hash_string = '';	
		foreach($hashVarsSeq as $hash_var) {
	      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
	      $hash_string .= '|';
	    }
	    $hash_string .= $salt;
	    $hash = strtolower(hash('sha512', $hash_string));
	    $action = $payu_base_url . '/_payment';
	  }
	} elseif(!empty($posted['hash'])) {
	  $hash = $posted['hash'];
	  $action = $payu_base_url . '/_payment';
	}
?>
<html>
  <head>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();

    }

  </script>
  </head>
  <body onload="submitPayuForm()">
    <h2>PayU Form</h2>
    <br/>
    <?php if($formError) { ?>
      <span style="color:red">Please fill all mandatory fields.</span>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $merchant_key ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        <tr>
          <td><b>Mandatory Parameters</b></td>
        </tr>
        <tr>
          <td>Amount <span class="mand">*</span>: </td>
          <td><input name="amount" type="number" value="<?php echo (empty($posted['amount'])) ? $cartTotal : $posted['amount'] ?>" /></td>
          <td>First Name <span class="mand">*</span>: </td>
          <td><input type="text" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? $name : $posted['firstname']; ?>" /></td>
        </tr>
        <tr>
          <td>Email <span class="mand">*</span>: </td>
          <td><input type="email" name="email" id="email" value="<?php echo (empty($posted['email'])) ? $email : $posted['email']; ?>" /></td>
          <td>Phone <span class="mand">*</span>: </td>
          <td><input type="text" name="phone" value="<?php echo (empty($posted['phone'])) ? $mobile : $posted['phone']; ?>" /></td>
        </tr>
        <tr>
          <td>Product Info <span class="mand">*</span>: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? $product_name1 : $posted['productinfo'] ?></textarea></td>
        </tr>
        <tr>
          <td>Success URL <span class="mand">*</span>: </td>
          <td colspan="3"><input type="text" name="surl" value="<?php echo (empty($posted['surl'])) ? $currentDir.'success.php' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td>Failure URL <span class="mand">*</span>: </td>
          <td colspan="3"><input type="text" name="furl" value="<?php echo (empty($posted['furl'])) ? $currentDir.'failure.php' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="" size="64" /></td>
        </tr>

        <tr>
          <td><b>Optional Parameters</b></td>
        </tr>
        <tr>
          <td>Login Name: </td>
          <td><input type="text" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? $lname : $posted['lastname']; ?>" /></td>
          <td>Cancel URI: </td>
          <td><input type="text" name="curl" value="" /></td>
        </tr>
        <tr>
          <td>Address1: </td>
          <td><input type="text" name="address1" value="<?php echo (empty($posted['address1'])) ? $address1 : $posted['address1']; ?>" /></td>
          <td>Address2: </td>
          <td><input type="text" name="address2" value="<?php echo (empty($posted['address2'])) ? $address2 : $posted['address2']; ?>" /></td>
        </tr>
        <tr>
          <td>City: </td>
          <td><input type="text" name="city" value="<?php echo (empty($posted['city'])) ? $city : $posted['city']; ?>" /></td>
          <td>State: </td>
          <td><input type="text" name="state" value="<?php echo (empty($posted['state'])) ? $state : $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country: </td>
          <td><input type="text" name="country" value="<?php echo (empty($posted['country'])) ? $country : $posted['country']; ?>" /></td>
          <td>Zipcode: </td>
          <td><input type="text" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? $pin : $posted['zipcode']; ?>" /></td>
        </tr>
 
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="Submit"  /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
  </body>
</html>
