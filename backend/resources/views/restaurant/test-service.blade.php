
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]--><head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>TAP JS library v2 - TAP documentation</title>
	<meta name="viewport" content="width=device-width">
    <meta name="csrf-token" content="QzHx6kS7bfljoJAYGAGwfVd1ffxwTlqThm8tDU6V" />
    <!-- custom css -->
	<link rel="stylesheet" type="text/css" href="https://jselements.tap.company/tapdocumentation/public/css/jquery.fullpage.css" />
<link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/bootstrap.min.css">
<link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/style2.css">

<link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/jquery.mCustomScrollbar.min.css">
<link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/custom.css">
<link rel="stylesheet" href="https://jselements.tap.company/tapdocumentation/public/css/prism.css">
<script src="https://jselements.tap.company/tapdocumentation/public/js/jquery.min.js"></script>

<!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
<script src="https://jselements.tap.company/tapdocumentation/public/js/jquery.min.js"></script>
<script src="https://jselements.tap.company/tapdocumentation/public/js/jquery.easings.min.js"></script>

<script src="https://jselements.tap.company/tapdocumentation/public/js/bootstrap.min.js"></script>
<script src="https://jselements.tap.company/tapdocumentation/public/js/prism.js"></script>
<script src="https://jselements.tap.company/tapdocumentation/public/js/custom.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js"></script>

<!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
<script type="text/javascript" src="https://jselements.tap.company/tapdocumentation/public/js/scrolloverflow.min.js"></script>
<script type="text/javascript" src="https://jselements.tap.company/tapdocumentation/public/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="https://jselements.tap.company/tapdocumentation/public/js/jquery.fullpage.js"></script>
    
</head>
<body>
    <div id="centralloader"></div>
    <div class="wrapper">
        <nav id="sidebarhead">
<div class="sidebar-header">
                    <h3>Tap&nbsp;Documentation</h3>
                </div>
</nav>
<nav id="sidebar" class="mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;"><div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                

                <ul class="list-unstyled components">
                    <li><a class="standalone" href="https://jselements.tap.company/tapdocumentation/public/#homeSubmenu" data-toggle="collapse" aria-expanded="false">Payments</a></li>

                    <li class="active">
                        <a href="https://jselements.tap.company/tapdocumentation/public/#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="">Quickstart</a>
                        <ul class="list-unstyled collapse in" id="homeSubmenu" aria-expanded="true" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/#intro">Introduction</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/#apikeys">API keys</a></li>

                            <li><a href="https://jselements.tap.company/tapdocumentation/public/#paymentmodes">Payment modes</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/#privatekey">Secret API key</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/#configjson">Encryption file for JS library</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/#encrkey">Encryption Key</a></li>
                        </ul>
                    </li>
                    <li><a class="standalone" href="https://jselements.tap.company/tapdocumentation/public/tapjs#jsliSubmenu" data-toggle="collapse" aria-expanded="false">COLLECTING PAYMENT DETAILS</a></li>
                    <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/tapjs#jsliSubmenu" data-toggle="collapse" aria-expanded="false" class=" ">TAP JS  &amp; Elements</a>
                        <ul class="list-unstyled collapse " id="jsliSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#cardelements">Card Element</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#httpsrequirements">HTTPS requirements</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#step1jsli">Step 1: Set up TAP JS Elements</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#step2jsli">Step 2: Create your payment form</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#step3jsli">Step 3: Create a token to securely transmit card information</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#step4jsli">Step 4: Submit the token and the rest of your form to your server</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/tapjs#bin">BIN (bank identification number)</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/iosdk#iosSubmenu" data-toggle="collapse" aria-expanded="false" class="">iOS</a>
                        <ul class="list-unstyled  collapse " id="iosSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/iosdk#iosdk">iOS SDK</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/iosdk#iosinstall">Install</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/iosdk#iosusage">Usage</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/iosdk#iosapicalls">API calls</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/iosdk#iostoken">Tokens</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/iosdk#ioscharges">Charges</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#androidSubmenu" data-toggle="collapse" aria-expanded="false" class="">Android</a>
                        <ul class="list-unstyled  collapse " id="androidSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#androidsdk">Android SDK</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#androidinstall">Install</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#androidbasic">Basic Usage</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#createtoken">Create Token</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#createcharge">Create Charge</a></li>
                             <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#capturecharge">Capture Charge</a></li>
                             <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#createredirect">Create Redirect</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#createsource">Create Source</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/androidsdk#getBINNumberDetails">Get bin number details</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/merchantapi#into" class="standalone2 ">Merchant API</a>
                    </li>
                    <li><a href="https://jselements.tap.company/tapdocumentation/public/merchantapi#into">Introduction</a></li>
                    <li><a href="https://jselements.tap.company/tapdocumentation/public/merchantapi#auth">Authentication</a></li>
                    
                    <li><a class="" href="https://jselements.tap.company/tapdocumentation/public/charges#chargesSubmenu" data-toggle="collapse" aria-expanded="false">Charges</a>
                         <ul class="list-unstyled  collapse " id="chargesSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#createcharges">Creating Charges</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#withoutoken">Charge Request without Source object</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#withknet">Charge Request with KNET Source</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#withcc">Charge Request with Credit Card source</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#withoken">Charge Request with Token</a></li>
                            <!-- <li><a href="https://jselements.tap.company/tapdocumentation/public/merchant#merchantSubmenu">Charges</a></li> -->
                        </ul>
                    </li>
                    <!-- <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#createcharges">Creating Charges</a></li> -->

                    <!-- <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/test#chargeSubmenu" data-toggle="collapse" aria-expanded="false" class="">CHARGES</a>
                        <ul class="list-unstyled  collapse " id="chargeSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/charges#createcharges">Creating Charges</a></li>
                        </ul>
                    </li> -->
                     <li><a class="" href="https://jselements.tap.company/tapdocumentation/public/refunds#refundsSubmenu" data-toggle="collapse" aria-expanded="false">Refunds</a>
                            <ul class="list-unstyled  collapse " id="refundsSubmenu" aria-expanded="false" style="">
                                <li><a href="https://jselements.tap.company/tapdocumentation/public/refunds#createrefund">Creating Refund</a></li>
                            </ul>
                     </li>
                    
                    <!-- <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/refunds#refundsSubmenu" data-toggle="collapse" aria-expanded="false" class="">Refunds</a>
                        <ul class="list-unstyled  collapse " id="refundsSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/refunds#createrefund">Creating Refund</a></li>
                        </ul>
                    </li> -->

                    <li><a href="https://jselements.tap.company/tapdocumentation/public/supportedcurrencies" class=" standalone">Supported Currencies</a></li>
                    <!-- <p>SOURCES</p>
                    <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/sources#sourcesSubmenu" data-toggle="collapse" aria-expanded="false" class="">Payment Methods</a>
                        <ul class="list-unstyled  collapse " id="sourcesSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/sources#KNET">KNET</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/sources#3dsecure">3D Secure</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/sources#creditcards">Credit Cards</a></li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="https://jselements.tap.company/tapdocumentation/public/test#testSubmenu" data-toggle="collapse" aria-expanded="false" class=" standalone2">Testing Data</a>
                        <ul class="list-unstyled  collapse " id="testSubmenu" aria-expanded="false" style="">
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/test#testkeys">Test API Keys</a></li>
                            <li><a href="https://jselements.tap.company/tapdocumentation/public/test#testcard">Test Card numbers</a></li>
                        </ul>
                    </li>
                    <li><a href="http://www.tap.company/docs/api/" target="_new" class="standalone">API Reference</a></li>

                </ul>
                

                <!-- <ul class="list-unstyled CTAs">
                    <li><a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a></li>
                    <li><a href="https://bootstrapious.com/p/bootstrap-sidebar" class="article">Back to article</a></li>
                </ul> -->
            </div></div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; height: 24px; top: 0px; display: block; max-height: 116px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></nav>    <div id="content">
  		<nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                        </div>

                        <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">Support</a></li>
                                <li><a href="#" style="content: '\279D'">Sign In</a></li>
                            </ul>
                        </div> -->
                    </div>
                </nav>	   <script src="https://secure.gosell.io/js/sdk/tap.min.js"></script>
<style type="text/css">
  #card-element{
    height: auto;
  }
  #content{ width: 100%; }
  #sidebarhead,#sidebar,.navbar{display: none;}
  body{       background: inherit;}
</style>
    <p>TAP JavaScript library can be used for building payment flows. With it you can collect sensitive Card information from the user in your web pages and create representative Tokens for safely sending that data to your servers.</p>

<h3>Card Element</h3>
    <p>TAP JS library’s card element is a prebuilt UI component. It collects card details from customers and tokenizes the sensitive information with in the element without ever touching your server. Card element includes feature like 
        <ul>
<li>Automatically format card information as it’s entered</li>
<li>Currency validation for payment options</li>
<li>Input validation and error response</li>
<li>Real time BIN response (The leading six digits of the card number is the "bank identification number or BIN", sometimes referred to as the "issuer identification number or IIN")</li>
<li>Responsive design to fit the width of your customer’s screen or mobile device</li>
<li>Customizable styling to match the look and feel of your checkout flow</li>
<li>Customizable styling to match the look and feel of your checkout flow</li>
 </ul>
The following guide walks through the creation of this payment form.
</p>
    <br>
<ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Result</li>
        <li class="tab-link" data-tab="tab-2">HTML</li>
        <li class="tab-link" data-tab="tab-3">CSS</li>
        <li class="tab-link" data-tab="tab-4">Javascript</li>
    </ul>
    <div id="tab-1" class="tab-content current" style="overflow: hidden;">
        <form id="form-container" method="post" action="/charge">
          <!-- Tap element will be here -->
          <div id="element-container"></div>  
          <div id="error-handler" role="alert"></div>
          <div id="success" style=" display: none;;position: relative;float: left;">
        Success! Your token is <span id="token"></span>
      </div>
          <!-- Tap pay button -->
          <button id="tap-btn">Submit</button>
      </form>
    </div>
    <div id="tab-2" class="tab-content">
        <pre class="line-numbers">
            <code class="language-markup">
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js">&lt;/script>
&lt;script src="https://secure.gosell.io/js/sdk/tap.min.js">&lt;/script>
&lt;form id="form-container" method="post" action="/charge">
  &lt;!-- Tap element will be here -->
  &lt;div id="element-container">&lt;/div>  
  &lt;div id="error-handler" role="alert">&lt;/div>
  &lt;div id="success" style=" display: none;;position: relative;float: left;">
        Success! Your token is &lt;span id="token">&lt;/span>
  &lt;/div>
  &lt;!-- Tap pay button -->
  &lt;button id="tap-btn">Submit&lt;/button>
&lt;/form>
        </code>
    </pre>
    </div>
    <div id="tab-3" class="tab-content">
        <pre class="line-numbers">
            <code class="language-css">
.form-row {
    width: 70%;
    float: left;
    background-color: #ededed;
}
#card-element {
background-color: transparent;
height: 40px;
border-radius: 4px;
border: 1px solid transparent;
box-shadow: 0 1px 3px 0 #e6ebf1;
-webkit-transition: box-shadow 150ms ease;
transition: box-shadow 150ms ease;
}

#card-element--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

#card-element--invalid {
  border-color: #fa755a;
}

#card-element--webkit-autofill {
  background-color: #fefde5 !important;
}

#submitbutton,#tap-btn{
align-items:flex-start;
background-attachment:scroll;background-clip:border-box;
background-color:rgb(50, 50, 93);background-image:none;
background-origin:padding-box;
background-position-x:0%;
background-position-y:0%;
background-size:auto;
border-bottom-color:rgb(255, 255, 255);
border-bottom-left-radius:4px;
border-bottom-right-radius:4px;border-bottom-style:none;
border-bottom-width:0px;border-image-outset:0px;
border-image-repeat:stretch;border-image-slice:100%;
border-image-source:none;border-image-width:1;
border-left-color:rgb(255, 255, 255);
border-left-style:none;
border-left-width:0px;
border-right-color:rgb(255, 255, 255);
border-right-style:none;
border-right-width:0px;
border-top-color:rgb(255, 255, 255);
border-top-left-radius:4px;
border-top-right-radius:4px;
border-top-style:none;
border-top-width:0px;
box-shadow:rgba(50, 50, 93, 0.11) 0px 4px 6px 0px, rgba(0, 0, 0, 0.08) 0px 1px 3px 0px;
box-sizing:border-box;color:rgb(255, 255, 255);
cursor:pointer;
display:block;
float:left;
font-family:"Helvetica Neue", Helvetica, sans-serif;
font-size:15px;
font-stretch:100%;
font-style:normal;
font-variant-caps:normal;
font-variant-east-asian:normal;
font-variant-ligatures:normal;
font-variant-numeric:normal;
font-weight:600;
height:35px;
letter-spacing:0.375px;
line-height:35px;
margin-bottom:0px;
margin-left:12px;
margin-right:0px;
margin-top:28px;
outline-color:rgb(255, 255, 255);
outline-style:none;
outline-width:0px;
overflow-x:visible;
overflow-y:visible;
padding-bottom:0px;
padding-left:14px;
padding-right:14px;
padding-top:0px;
text-align:center;
text-decoration-color:rgb(255, 255, 255);
text-decoration-line:none;
text-decoration-style:solid;
text-indent:0px;
text-rendering:auto;
text-shadow:none;
text-size-adjust:100%;
text-transform:none;
transition-delay:0s;
transition-duration:0.15s;
transition-property:all;
transition-timing-function:ease;
white-space:nowrap;
width:150.781px;
word-spacing:0px;
writing-mode:horizontal-tb;
-webkit-appearance:none;
-webkit-font-smoothing:antialiased;
-webkit-tap-highlight-color:rgba(0, 0, 0, 0);
-webkit-border-image:none;

}
            </code>
    </pre>
    </div>
    <div id="tab-4" class="tab-content">
        <pre class="line-numbers">
            <code class="language-javascript">
//pass your public key from tap's dashboard
var tap = Tapjsli('pk_test_EtHFV4BuPQokJT6jiROls87Y');

var elements = tap.elements({});
var style = {
  base: {
    color: '#535353',
    lineHeight: '18px',
    fontFamily: 'sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: 'rgba(0, 0, 0, 0.26)',
      fontSize:'15px'
    }
  },
  invalid: {
    color: 'red'
  }
};
// input labels/placeholders
var labels = {
    cardNumber:"Card Number",
    expirationDate:"MM/YY",
    cvv:"CVV",
    cardHolder:"Card Holder Name"
  };
//payment options
var paymentOptions = {
  currencyCode:["KWD","USD","SAR"],
  labels : labels,
  TextDirection:'ltr'
}
//create element, pass style and payment options
var card = elements.create('card', {style: style},paymentOptions);
//mount element
card.mount('#element-container');
//card change event listener
card.addEventListener('change', function(event) {
  if(event.BIN){
    console.log(event.BIN)
  }
  if(event.loaded){
    console.log("UI loaded :"+event.loaded);
    console.log("current currency is :"+card.getCurrency())
  }
  var displayError = document.getElementById('error-handler');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission
var form = document.getElementById('form-container');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  tap.createToken(card).then(function(result) {
    console.log(result);
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('error-handler');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server
      var errorElement = document.getElementById('success');
      errorElement.style.display = "block";
      var tokenElement = document.getElementById('token');
      tokenElement.textContent = result.id;
      console.log(result.id);
    }
  });
});                
            </code>
        </pre>
    </div>
<script>
//pass your public key from tap's dashboard
var tap = Tapjsli('pk_test_EtHFV4BuPQokJT6jiROls87Y');

var elements = tap.elements({});
var style = {
  base: {
    color: '#535353',
    lineHeight: '18px',
    fontFamily: 'sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: 'rgba(0, 0, 0, 0.26)',
      fontSize:'15px'
    }
  },
  invalid: {
    color: 'red'
  }
};

var labels = {
    cardNumber:"Card Number",
    expirationDate:"MM/YY",
    cvv:"CVV",
    cardHolder:"Card Holder Name"
  };

var paymentOptions = {
  currencyCode:["KWD","USD","SAR"],
  labels : labels,
  TextDirection:'ltr'
}

var card = elements.create('card', {style: style},paymentOptions);

card.mount('#element-container');

card.addEventListener('change', function(event) {
  if(event.BIN){
    console.log(event.BIN)
  }
  if(event.loaded){
    //console.log("UI loaded :"+event.loaded);
    //console.log("current currency is :"+card.getCurrency())
  }
  var displayError = document.getElementById('error-handler');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission
var form = document.getElementById('form-container');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  tap.createToken(card).then(function(result) {
    //console.log(result);
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('error-handler');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server
      var errorElement = document.getElementById('success');
      errorElement.style.display = "block";
      var tokenElement = document.getElementById('token');
      tokenElement.textContent = result.id;
      //console.log(result);
      //console.log(result.id);
    }
  });
});

</script>

<section id="httpsrequirements">
    <h2>HTTPS requirements</h2>
    <p>
        All submissions of payment info using Elements are made via a secure HTTPS connection. However, to protect yourself from certain forms of man-in-the-middle attacks, and to prevent your customers from seeing Mixed Content warnings in modern browsers, you must serve the page containing the payment form over HTTPS as well.

In short, the address of the page containing Elements must start with https:// rather than just http://. If you are not familiar with the process of buying SSL certificates and integrating them with your server to enable a secure HTTPS connection, Please ask a server administrator to set it up.

    </p>
</section>

<section id="step1jsli">
    <h2>Step 1: Set up TAP JS Elements</h2>
    <p>
        Elements is available as part of TAP JS library. To get started, include this script on your pages—it should always be loaded directly from https://secure.gosell.io/js/sdk/tap.min.js:
In the header of your html web page.
<pre class="line-numbers">
            <code class="language-markup">
&lt;script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/3.3.4/bluebird.min.js">&lt;/script>
&lt;script src="https://secure.gosell.io/js/sdk/tap.min.js">&lt;/script>                
            </code>
</pre>

    </p>
     <h3>Responsive Dimension&nbsp;<small>Optional</small></h3>    
     <p>
        To make JS element scale to dimensions of the device, You should include the following meta tag in your html header.
        <pre class="line-numbers">
            <code class="language-markup">

&lt;meta name="viewport" content="width=device-width, initial-scale=1.0">
             
            </code>
</pre>
    </p>

</section>
<section id="step2jsli">
    <h2>Step 2: Create your payment form</h2>
    <p>
        To securely collect card details from your customers, Elements creates UI components for you that are hosted by Tap payments. They are then placed into your payment form, rather than you creating them directly. 

To determine where to insert these components, create empty DOM elements (containers) with unique IDs within your payment form.<br>
<h4>For example:</h4>
</p>
<pre class="line-numbers">
            <code class="language-markup">
&lt;form id="form-container" method="post" action="/charge">
  &lt;!-- Tap element will be here -->
  &lt;div id="element-container">&lt;/div>  
  &lt;div id="error-handler" role="alert">&lt;/div>
  &lt;div id="success" style=" display: none;;position: relative;float: left;">
        Success! Your token is &lt;span id="token">&lt;/span>
  &lt;/div>
  &lt;!-- Tap pay button -->
  &lt;button id="tap-btn">Submit&lt;/button>
&lt;/form>               
            </code>
</pre>
    <p>
        When the form above has loaded, in javascript create an instance of an Element and mount it to the Element container created above. Tap provides a public key to access js library and initialized to your TAP account. This public key should be passed as parameter to <b>Tapjsli()</b>.
        <br>
    </p>
    <h4>Javascript</h4>
    <pre class="line-numbers">
            <code class="language-javascript">
//pass your public key from tap's dashboard
var tap = Tapjsli('pk_test_EtHFV4BuPQokJT6jiROls87Y');

var elements = tap.elements({});

var style = {
  base: {
    color: '#535353',
    lineHeight: '18px',
    fontFamily: 'sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: 'rgba(0, 0, 0, 0.26)',
      fontSize:'15px'
    }
  },
  invalid: {
    color: 'red'
  }
};
// input labels/placeholders
var labels = {
    cardNumber:"Card Number",
    expirationDate:"MM/YY",
    cvv:"CVV",
    cardHolder:"Card Holder Name"
  };
//payment options
var paymentOptions = {
  currencyCode:["KWD","USD","SAR"],
  labels : labels,
  TextDirection:'ltr'
}
//create element, pass style and payment options
var card = elements.create('card', {style: style},paymentOptions);
//mount element
card.mount('#element-container');
//card change event listener
card.addEventListener('change', function(event) {
  if(event.loaded){
    console.log("UI loaded :"+event.loaded);
    console.log("current currency is :"+card.getCurrency())
  }
  var displayError = document.getElementById('error-handler');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

            </code>
    </pre>            
</section>
<section id="step3jsli">
    <h2>Step 3: Create a token to securely transmit card information</h2>
    <p>
       The payment details collected using Elements can then be converted into a token. Create an event handler that handles the submit event on the form. The handler sends the fields to TAP for tokenization and prevents the form’s submission (the form is submitted by JavaScript in the next step).
<br>
<h4>Javascript</h4>
</p>
<pre class="line-numbers">
            <code class="language-javascript">
// Handle form submission
var form = document.getElementById('form-container');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  tap.createToken(card).then(function(result) {
    console.log(result);
    if (result.error) {
      // Inform the user if there was an error
      var errorElement = document.getElementById('error-handler');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server
      var errorElement = document.getElementById('success');
      errorElement.style.display = "block";
      var tokenElement = document.getElementById('token');
      tokenElement.textContent = result.id;
    tapTokenHandler(token)
      
    }
  });
});
              
            </code>
</pre>
    <p>
        tap.createToken returns a Promise which resolves with a result object. This object has either:
        <ul>
            <li>result.id: a Token was created successfully.</li>
            <li>result.error: there was an error. This includes client-side validation errors.</li>
        </ul>
    </p>
             
</section>


<section id="step4jsli">
    <h2>Step 4: Submit the token and the rest of your form to your server</h2>
    <p>
       The last step is to submit the token, along with any additional information that has been collected, to your server.
<br>
<h4>Javascript</h4>
</p>
<pre class="line-numbers">
            <code class="language-javascript">
function tapTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'tapToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
            
            </code>
</pre>   
</section>

<section id="bin">
    <h2>Get Card Details</h2>
    <p>
       The leading six digits of the card number is the "bank identification number (BIN)", sometimes referred to as the "issuer identification number (IIN)". <br>
       TAP JS Card element also returns BIN details in real time. 
       Check the highlighted part of the script below if you want to use the BIN in your application(s).
<br>
<h4>Javascript</h4>
</p>
<pre class="line-numbers" data-line='2-4'>
            <code class="language-javascript">
card.addEventListener('change', function(event) {
  if(event.BIN){
    console.log(event.BIN)
  }
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
            
            </code>
</pre> 
<h4>BIN response sample</h4>
</p>
<pre class="line-numbers">
            <code class="language-json">
{  
   "bin":"424242",
   "bank":"",
   "card_brand":"VISA",
   "card_type":"CREDIT",
   "card_category":"",
   "card_scheme":"VISA",
   "country_name":"UNITED KINGDOM",
   "country":"GB",
   "website":"",
   "phone":"",
   "address_required":false,
   "api_version":"V2"
}
            
            </code>
</pre> 
  <h4>Possible utilities of BIN</h4>
  <ul>
    <li>Card origin identification</li>
    <li>Targeted campaigns for card origins</li>
    <li>Currency identification</li>
    <li>Shipping feasibility</li>
  </ul>
</section>
<section id="options">
  <h2>Element Options</h2>
  <table class="table table-bordered">
    <tr>
      <th>
        Option
      </th>
      <th>
        Description
      </th>
      <th>
        Target
      </th>
    </tr>
    <tr>
      <td>
        style.base.color 
      </td>
      <td>
        Text Color 
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.base.lineHeight  
      </td>
      <td>
        Line height
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.base.fontFamily 
      </td>
      <td>
        Font Family
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.base.fontSmoothing 
      </td>
      <td>
        Font Smoothing
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.base.fontSize 
      </td>
      <td>
        Font Size
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.base['::placeholder'].color 
      </td>
      <td>
        Color
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.base['::placeholder'].fontSize
      </td>
      <td>
        Font Size
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        style.invalid.color
      </td>
      <td>
        Color of text when input is invalid  
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.labels.cardNumber
      </td>
      <td>
        Place holder for credit card
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.labels.expirationDate
      </td>
      <td>
        Place holder for expiry date 
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.labels.cvv
      </td>
      <td>
        Place holder for CVV 
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.labels.cardHolder
      </td>
      <td>
        Place holder for Card Owner Name
      </td>
      <td>
        Input 
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.currencyCode 
      </td>
      <td>
        array of three-letter alphabetic ISO currency codes
      </td>
      <td>
        Currency support 
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.paymentAllowed 
      </td>
      <td>
        array of payment method to be allowed, options ['VISA', 'MASTERCARD', 'AMEX', 'MADA'], default string 'all'
      </td>
      <td>
        Payment Methods support
      </td>
    </tr>
    <tr>
      <td>
        paymentOptions.TextDirection
      </td>
      <td>
        sets the direction of text, table columns, and horizontal overflow, only two values valid (rtl, ltr)
      </td>
      <td>
        Input 
      </td>
    </tr>
  </table>
</section>
<section id="methods">
  <h2>Library methods</h2>
  <table class="table table-bordered">
    <tr>
      <th>
        Method
      </th>
      <th>
        Description
      </th>
    </tr>
    <tr>
      <td>
        Tapjsli('PUBLIC API')
      </td>
      <td>
        Authenticates and validates public key access
      </td>
    </tr>
    <tr>
      <td>
        Tapjsli('PUBLIC API','MERCHANT ID')
      </td>
      <td>
        <small>(optional)</small>&nbsp;Authenticates public key and merchant id access
      </td>
    </tr>
    
    <tr>
      <td>
        tap.elements({})
      </td>
      <td>
        Initiates Element
      </td>
    </tr>
    <tr>
      <td>
        elements.create('card', {style: style},paymentOptions)
      </td>
      <td>
       Creates Card Element with given options
      </td>
    </tr>
    <tr>
      <td>
        card.mount('#element-container')
      </td>
      <td>
        mounts/loads UI into html container
      </td>
    </tr>
    <tr>
      <td>
        card.addEventListener('change', function(event) {});
      </td>
      <td>
        Adds change event listener to card element
      </td>
    </tr>
    <tr>
      <td>
        event.loaded
      </td>
      <td>
        If ‘true’, js library is loaded
      </td>
    </tr>
    <tr>
      <td>
        card.currency(‘SAR’)
      </td>
      <td>
        Changes currency in real time, supplied value must be valid three-letter alphabetic ISO currency code
      </td>
    </tr>
    <tr>
      <td>
        card.clearForm()
      </td>
      <td>
        Clears the form inputs and errors
      </td>
    </tr>
  </table>
</section>
 
 
    
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

         $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar, #content, #sidebarhead').toggleClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
         $(window).load(function(){
            $('#centralloader').fadeOut();
        });
    </script>
    </div>
</body>
</html>