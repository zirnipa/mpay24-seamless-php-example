<?php
require("bootstrap.php");

use Mpay24\Mpay24;

$mpay24 = new Mpay24();

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
		    $result = $mpay24->payment($type, "123", $payment, $additional);
    		if($result->getReturnCode() == "REDIRECT") {
    		  header('Location: '.$result->getLocation());
    		} else {
    		  echo $result->getReturnCode();
    		}
      break;

		  case "SOFORT":
			$result = $mpay24->payment($type, "123", $payment, $additional);
    		if($result->getReturnCode() == "REDIRECT") {
    		  header('Location: '.$result->getLocation());
    		} else {
    		  echo $result->getReturnCode();
    		}
      break;

		  case "PAYPAL":
    		$result = $mpay24->payment($type, "123", $payment, $additional);
    		if($result->getReturnCode() == "REDIRECT") {
    		  header('Location: '.$result->getLocation());
    		} else {
    		  echo $result->getReturnCode();
    		}
      break;

		  case "EPS":
        $payment["brand"] = "INTERNATIONAL";
		    $result = $mpay24->payment($type, "123", $payment, $additional);
		    if($result->getReturnCode() == "REDIRECT") {
  		    ?>
  		    <script>
  				  window.onload = function(e){
  					  window.open("<?php echo $result->getLocation() ?>");
  				  }
  			  </script>
  			  Falls das Pop-Up blockiert wurde klicken Sie <a href="<?php echo $result->getLocation() ?>">hier.</a>
  		    <?php
    		} else {
    		  echo $result->getReturnCode();
    		}
      break;

		  case "PAYPAGE":
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

			header('Location: '.$mpay24->paymentPage($mdxi)->getLocation());
      break;

    }
  }
?>
