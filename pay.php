<?php
  include_once ("lib/MPAY24.php");

  $shop = new MPAY24();

  $payment = array(
    "amount" => "100",
    "currency" => "EUR",
	"UseProfile" => "true"
  );
  
    $additional = array(
    "customerID" => "customer123",
    "successURL" => "http://yourdomain.com/success",
    "errorURL" => "http://yourdomain.com/error",
    "confirmationURL" => "http://yourdomain.com/confirmation",
    "cancelURL" => "http://yourdomain.com/cancel"
  );

  if(isset($_POST["type"])) {
    $type = $_POST["type"];
    switch($type) {
      case "TOKEN":
        $payment["token"] = $_POST["token"];
		$result = $shop->acceptPayment($type, "123", $payment, $additional);
		if($result->generalResponse->returnCode == "REDIRECT") {
		  header('Location: '.$result->location);
		} else {
		  echo $result->generalResponse->returnCode;
		}
		
        break;
		
		case "SOFORT":
		$result = $shop->acceptPayment($type, "123", $payment, $additional);
		if($result->generalResponse->returnCode == "REDIRECT") {
		  header('Location: '.$result->location);
		} else {
		  echo $result->generalResponse->returnCode;
		}
		
        break;

		case "PAYPAL":
		$result = $shop->acceptPayment($type, "123", $payment, $additional);
		if($result->generalResponse->returnCode == "REDIRECT") {
		  header('Location: '.$result->location);
		} else {
		  echo $result->generalResponse->returnCode;
		}
		
        break;
		
		case "EPS":
        $payment["brand"] = "INTERNATIONAL";
		$result = $shop->acceptPayment($type, "123", $payment, $additional);
		if($result->generalResponse->returnCode == "REDIRECT") {
		  ?>
		    <script>
				window.onload = function(e){ 
					window.open("<?php echo $result->location ?>");
				}
			</script>
			Falls das Pop-Up blockiert wurde klicken Sie <a href="<?php echo $result->location ?>">hier.</a>
		  <?php
		} else {
		  echo $result->generalResponse->returnCode;
		}
        break;
		
		case "PAYPAGE":
          $shop = new MPAY24();

		  $mdxi = new ORDER();
          $mdxi->Order->Tid = "123";
		  // Disable only specific payments
		  $mdxi->Order->PaymentTypes->setEnable (true);
		  $mdxi->Order->PaymentTypes->Payment(1)->setType("CC");
		  $mdxi->Order->PaymentTypes->Payment(2)->setType("EPS");
		  $mdxi->Order->PaymentTypes->Payment(2)->setBrand("INTERNATIONAL");		  
		  $mdxi->Order->PaymentTypes->Payment(3)->setType("SOFORT");
		  $mdxi->Order->PaymentTypes->Payment(4)->setType("PAYPAL");

          $mdxi->Order->Price = "1.00";

          header('Location: '.$shop->selectPayment($mdxi)->location);
        break;
		
    }

  }
?>
