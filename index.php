<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
	<script src="js/modernizr.js"></script> <!-- Modernizr -->

	<title>Animated Sign Up Flow | CodyHouse</title>
</head>
<body>
	<header class="cd-main-header">
		<h1>Animated Sign Up Flow</h1>
	</header>

	<ul class="cd-pricing">
		<li>
			<header class="cd-pricing-header">
				<h2>Basic</h2>

				<div class="cd-price">
					<span>$9.99</span>
					<span>month</span>
				</div>
			</header> <!-- .cd-pricing-header -->

			<div class="cd-pricing-features">
				<ul>
					<li class="available"><em>Feature 1</em></li>
					<li><em>Feature 2</em></li>
					<li><em>Feature 3</em></li>
					<li><em>Feature 4</em></li>
				</ul>
			</div> <!-- .cd-pricing-features -->

			<footer class="cd-pricing-footer">
				<a href="#0">Select</a>
			</footer> <!-- .cd-pricing-footer -->
		</li>

		<li>
			<header class="cd-pricing-header">
				<h2>Popular</h2>

				<div class="cd-price">
					<span>$19.99</span>
					<span>month</span>
				</div>
			</header> <!-- .cd-pricing-header -->

			<div class="cd-pricing-features">
				<ul>
					<li class="available"><em>Feature 1</em></li>
					<li class="available"><em>Feature 2</em></li>
					<li><em>Feature 3</em></li>
					<li><em>Feature 4</em></li>
				</ul>
			</div> <!-- .cd-pricing-features -->

			<footer class="cd-pricing-footer">
				<a href="#0">Select</a>
			</footer> <!-- .cd-pricing-footer -->
		</li>

		<li>
			<header class="cd-pricing-header">
				<h2>Premier</h2>

				<div class="cd-price">
					<span>$29.99</span>
					<span>month</span>
				</div>
			</header> <!-- .cd-pricing-header -->

			<div class="cd-pricing-features">
				<ul>
					<li class="available"><em>Feature 1</em></li>
					<li class="available"><em>Feature 2</em></li>
					<li class="available"><em>Feature 3</em></li>
					<li class="available"><em>Feature 4</em></li>
				</ul>
			</div> <!-- .cd-pricing-features -->

			<footer class="cd-pricing-footer">
				<a href="#0">Select</a>
			</footer> <!-- .cd-pricing-footer -->
		</li>
	</ul> <!-- .cd-pricing -->

	<div class="cd-form">

		<div class="cd-plan-info">
			<!-- content will be loaded using jQuery - according to the selected plan -->
		</div>

		<div class="cd-more-info">
			<h3>Need help?</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
		</div>

		<form action="pay.php" method="POST">
			<fieldset>
				<legend>Account Info</legend>

				<div class="half-width">
					<label for="userName">Name</label>
					<input type="text" id="userName" name="userName">
				</div>

				<div class="half-width">
					<label for="userEmail">Email</label>
					<input type="email" id="userEmail" name="userEmail">
				</div>

				<div class="half-width">
					<label for="userPassword">Password</label>
					<input type="password" id="userPassword" name="userPassword">
				</div>

				<div class="half-width">
					<label for="userPasswordRepeat">Repeat Password</label>
					<input type="password" id="userPasswordRepeat" name="userPasswordRepeat">
				</div>
			</fieldset>

			<fieldset>
				<legend>Payment Method</legend>

				<div>
					<ul class="cd-payment-gateways">
						<li>
							<input type="radio" onclick="enableButton(true)" name="type" id="paypal" value="PAYPAL">
							<label for="paypal">Paypal</label>
						</li>
						<li>
							<input type="radio" onclick="enableButton(false)" name="type" id="card" value="TOKEN" checked>
							<label for="card">Credit Card</label>
						</li>
						<li>
							<input type="radio" onclick="enableButton(true)" name="type" id="eps" value="EPS">
							<label for="eps">EPS</label>
						</li>
						<li>
							<input type="radio" onclick="enableButton(true)" name="type" id="sofort" value="SOFORT">
							<label for="sofort">Sofort</label>
						</li>
						<li>
							<input type="radio" onclick="enableButton(true)" name="type" id="paypage" value="PAYPAGE">
							<label for="paypage">Payment Page</label>
						</li>
					</ul> <!-- .cd-payment-gateways -->
				</div>

				<div class="cd-credit-card">
					<div>
					<?php
					  include_once ("lib/MPAY24.php");
					  $shop = new MPAY24();
					  $tokenizer = $shop->createPaymentToken("CC")->getPaymentResponse();
					?>

					<iframe src="<?php echo $tokenizer->location; ?>" frameBorder="0"></iframe>
					<input name="token" type="hidden" value="<? echo $tokenizer->token; ?>" />

					<script>
					  window.addEventListener("message", checkValid, false);
    				function checkValid(form) {
    				  var data = JSON.parse(form.data);
    				  if (data.valid === "true") {
    					  document.getElementById("paybutton").disabled=false;
    				  }
    				}
    				function enableButton(enabled) {
    					document.getElementById("paybutton").disabled=!enabled;
    				}
					</script>
					</div>
				</div> <!-- .cd-credit-card -->
			</fieldset>

			<fieldset>
				<div>
					<input id="paybutton" type="submit" value="Pay" disabled>
				</div>
			</fieldset>
		</form>

		<a href="#0" class="cd-close"></a>
	</div> <!-- .cd-form -->

	<div class="cd-overlay"></div> <!-- shadow layer -->
<script src="js/jquery-2.1.4.js"></script>
<script src="js/velocity.min.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>
