
        <?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

?>
<?php
  include "../storescripts/connect_to_mysql.php";
$cartTotal = "";
if(isset($_SESSION["id"])){
  $cid=$_SESSION["id"];
  $sql = mysql_query("SELECT * FROM customer_cart WHERE customerid='$cid'") or die(mysql_error());
  $count = mysql_num_rows($sql);  
    $i=0;
    while ($lists = mysql_fetch_array($sql)) {
        $item_id = $lists["productid"];
        $sqls = mysql_query("SELECT * FROM products WHERE id='$item_id' LIMIT 1") or die(mysql_error());
        $list = mysql_fetch_array($sqls);
        $product_name = $list["product_name"];
        $price = $list["price"];
        $quantity = $lists["quantity"];
        $pricetotal = $price * $quantity;
        $cartTotal = $pricetotal + $cartTotal;

  }
}
?>

<?php
  
	$merchant_key  = "sSfROsof";
	$salt          = "nwyHpEoqHd";
	$payu_base_url = "https://secure.payu.in"; 
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
	$hashSequence = "key|txnid|$cartTotal|productinfo|firstname|email|phone|address1|zipcode|Height in mm|Breadth in mm|Length in mm|udf4";

	if(empty($posted['hash']) && sizeof($posted) > 0) {
	  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
    
          || empty($posted['Height in mm'])
          || empty($posted['Length in mm'])
          || empty($posted['Breadth in mm'])
          || empty($posted['address1'])
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
  <style>
    .mand{
      color: red;
    }
    table{
      padding-left: 280px;

    line-height: 30px;
    font-size: 20px;
    font-family: cursive;
    }
    h2{
      text-align: center;
    font-size: 60px;
    margin-top: 40px;
    font-family: cursive;
    color: palegoldenrod;
    }
  </style>
  <link rel="icon" type="image/png" href="../images/logo.png" />
  </head>
  <body onload="submitPayuForm()" style="background:url(1.jpg); color: whitesmoke;">


    <h2 style="text-align: center;">PayU Form</h2>
  
    <br/>
    <?php if($formError) { ?>
      <span style="color:red;text-align: center;">Please fill all mandatory fields.</span>
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
         <!-- <td>Amount <span class="mand">*</span>: </td>
          <td><input name="amount" type="number" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount']; ?>" /></td>-->
          <td>First Name <span class="mand">*</span>: </td>
          <td><input type="text" name="firstname" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" /></td>
          <td>Last Name: </td>
          <td><input type="text" name="lastname" id="lastname" value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>" /></td>
        </tr>
        <tr>
                    <td>Email <span class="mand">*</span>: </td>
          <td><input type="email" name="email" id="email" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></td>
          <td>Phone <span class="mand">*</span>: </td>
          <td><input type="text" name="phone" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" /></td>
        </tr>
 <tr>
          <td>Product Info <span class="mand">*</span>: </td>
          <td colspan="3"><textarea name="productinfo"><?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?></textarea></td>

        </tr>
        <tr>
          <td><span class="mand"></span></td>
          <td colspan="3"><input type="hidden" name="surl" value="<?php echo (empty($posted['surl'])) ? $currentDir.'success.php' : $posted['surl'] ?>" size="64" /></td>
        </tr>
        <tr>
          <td><span class="mand"></span></td>
          <td colspan="3"><input type="hidden" name="furl" value="<?php echo (empty($posted['furl'])) ? $currentDir.'failure.php' : $posted['furl'] ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3">   <input type="hidden" name="service_provider" value="payu_paisa" size="64" /></td>

        </tr>

      
        <tr>

          <td><input type="hidden" name="curl" value="<?php echo (empty($posted['furl'])) ? $currentDir.'cancel.php' : $posted['furl'] ?>" /></td>
        </tr>
        <tr>
          <td>Address1<span class="mand">*</span>:  </td>
          <td><input type="text" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" /></td>
          <td>street<span class="mand">*</span>: </td>
          <td><input type="text" name="street" value="<?php echo (empty($posted['street'])) ? '' : $posted['street']; ?>" /></td>
        </tr>
        <tr>
          <td>City<span class="mand">*</span>: </td>
          <td><input type="text" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" /></td>
          <td>State<span class="mand">*</span>: </td>
          <td><input type="text" name="state" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" /></td>
        </tr>
        <tr>
          <td>Country<span class="mand">*</span>: </td>
          <td><input type="text" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" /></td>
          <td>Zipcode<span class="mand">*</span>: </td>
          <td><input type="text" name="zipcode" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></td>
        </tr>
        <tr>
          <td>Height in mm<span class="mand">*</span>: </td>
          <td><input type="number" name="Height in mm" value="<?php echo (empty($posted['Height in mm'])) ? '' : $posted['Height in mm']; ?>" /></td>
          <td>Breadth in mm<span class="mand">*</span>:</td>
          <td><input type="number" name="Breadth in mm" value="<?php echo (empty($posted['Breadth in mm'])) ? '' : $posted['Breadth in mm']; ?>" /></td>
        </tr>
        <tr>
          <td>Length in mm<span class="mand">*</span>:</td>
          <td><input type="number" name="Length in mm" value="<?php echo (empty($posted['Length in mm'])) ? '' : $posted['Length in mm']; ?>" /></td>
          <td>UDF4: </td>
          <td><input type="text" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '' : $posted['udf4']; ?>" /></td>
        </tr>
      <!--  <tr>
          <td>UDF5</td>
          <td><input type="text" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '' : $posted['udf5']; ?>" /></td>
          <td>PG: </td>
          <td><input type="text" name="pg" value="<?php echo (empty($posted['pg'])) ? '' : $posted['pg']; ?>" /></td>
        </tr>-->>
        <tr>
          <?php if(!$hash) { ?>
            <td colspan="4"><input type="submit" value="          " style="background: url(PayUMoney_logo.png);padding-left: 120px;margin-left: 310px;background-color: antiquewhite;margin-top: 25px;" /></td>
          <?php } ?>
        </tr>
      </table>
    </form>
  </body>
</html>