<?php

use YouCan\Pay;
use YouCan\Pay\YouCanPay;

class ExamplePayment
{
    /**
     * Return a token to make payment for an order, this token is required to make payment with JS script.
     *
     * @return string
     */
    public function createToken()
    {
        // Enable sandbox mode, otherwise delete this line.
        YouCanPay::setIsSandboxMode(true);

        // Create a YouCan Pay instance, to retrieve your private and public keys login to your YouCan Pay account
        // and go to Settings and open API Keys.
        $youCanPay = YouCanPay::instance()->useKeys('pri_9a36cca0-5830-42c9-b9d1-fd98298f', 'pub_79f881e2-687b-483b-89b0-f51815fc');

        // Data of the customer who wishes to make this purchase.
        // Please keep these keys.
        $customerInfo = [
            'name'         => 'haytem',
            'address'      => 'walo',
            'zip_code'     => '20570',
            'city'         => 'casa',
            'state'        => 'casa',
            'country_code' => 'ma',
            'phone'        => '0767256939',
            'email'        => 'haytemcharraj2000@gmail.com',
        ];

        // You can use it to send data to retrieve after the response or in the webhook.
        $metadata = [
            // Can you insert what you want here...
            //'key' => 'value'
            'user' => 'haytem'
        ];

        // Create the order you want to be paid
        $token = $youCanPay->token->create(
            // String orderId (required): Identifier of the order you want to be paid.
            "order-id",
            // Integer amount (required): The amount, Example: 25 USD is 2500.
            "500",
            // String currency (required): Uppercase currency.
            "USD",
            // String customerIP (required): Customer Address IP.
            "160.179.52.193",
            // String successUrl (required): This URL is returned when the payment is successfully processed.
            "https://yourdomain.com/orders-status/success",
            // String errorUrl (required): This URL is returned when payment is invalid.
            "https://yourdomain.com/orders-status/error",
            // Array customerInfo (optional): Data of the customer who wishes to make this purchase.
            $customerInfo,
            // Array metadata (optional): You can use it to send data to retrieve after the response or in the webhook.
            $metadata
        );

        return $token->getId();
    }
}

$aa = new ExamplePayment;
$aa->createToken();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://pay.youcan.shop/js/ycpay.js"></script>
    
</head>
<body>
<div id="payment-card"></div>
<button id="pay" onclick='paye()'>Pay</button>
<script type="text/javascript">
  // Create a YouCan Pay instance.
  const ycPay = new YCPay(
    // String public_key (required): Login to your account.
    // Go to Settings and open API Keys and copy your key.
    "pub_79f881e2-687b-483b-89b0-f51815fc",
    // Optional options object
    {
      formContainer: "#payment-card",
      // Defines what language the form should be rendered in, supports EN, AR, FR.
      locale: "en",

      // Whether the integration should run in sandbox (test) mode or live mode.
      isSandbox: false,

      // A DOM selector representing which component errors should be injected into.
      // If you omit this option, you may alternatively handle errors by chaining a .catch()
      // On the pay method.
      errorContainer: "#error-container",
    }
  );

  // Select which gateways to render
  ycPay.renderAvailableGateways(["CashPlus", "CreditCard"]);

  // Alternatively, you may use gateway specific render methods if you only need one.
  ycPay.renderCreditCardForm();

  
</script>
<?php $a = new ExamplePayment; ?>
<script>
     // Start the payment on button click
  document.getElementById("pay").addEventListener("click", function () {
    console.log('mzyan')
    // Execute the payment, it is required to put the created token in the tokenization step.
    ycPay
      .pay("<?php createToken(); ?>")
      .then(successCallback)
      .catch(errorCallback);
  });
  function paye()
  {
    console.log('mzyan')
    // Execute the payment, it is required to put the created token in the tokenization step.
    ycPay
      .pay("<?php $a->createToken(); ?>")
      .then(successCallback)
      .catch(errorCallback);
  }

  function successCallback(transactionId) {
    console.log('naddi')
  }

  function errorCallback(errorMessage) {
    console.log('ghalatt')
  }
</script>

</body>
</html>