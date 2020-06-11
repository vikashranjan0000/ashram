<!DOCTYPE html>
<html>

<head>
  <?php include_once 'public_html/includes/commonHeader.php'; ?>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> </head>
  <meta name="viewport" content="width=device-width">

  <body class="front">
    <?php include_once 'public_html/includes/sideBarContent.php'; ?>
    <div class="row">
     <div class="col-lg-12">
      <div class="header-bg" style="background-image:url(images/banner.jpg)">
        <div class=" header-content">
          <div class="main-title">
            <h1  id="bookingDetailsprogramNameTitle" class="bold mb-30 a-f ">Online Dhyan Samadhi 5-14 May 2020</h1>
          </div>
        </div>
      </div>  

    </div>
  </div>  
  <div class="row">
    <div class="form-mgr">
      <div class="col-md-12 col-sm-12 animate fadeInRight">
                    <div class="row">
                        <form role="form" action="esendmail1.php" method="post" class="m-t-40 customForm" novalidate>
                            <div class="form-group clearfix scheduleFormGroup">
                                <div class="col-md-6">
                                    <span class="titleLabel">Program</span>
                                    <div class="controls customInputDiv">
                                        <input id="bookingDetailsprogramName" name="programName" required class="form-control customInput"  disabled="true">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <span class="titleLabel">Name</span>
                                    <div class="controls customInputDiv">
                                        <input id="bookingDetailsuserName" name="Name" required class="form-control customInput" value="Online" disabled="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix scheduleFormGroup">

                                <div class="col-md-6 required-field">
                                    <span class="titleLabel">Email Id</span>
                                    <div class="controls customInputDiv">
                                        <input id="bookingDetailsemailId" placeholder="Email Id"  name="Email Id" required class="form-control customInput disabled="true">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <span class="titleLabel">Phone Number</span>
                                    <div class="controls customInputDiv">
                                        <input id="bookingDetailsphoneNumber" placeholder="Phone Number"  name="Phone Number" required class="form-control customInput"  disabled="true">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group clearfix scheduleFormGroup">

                                <div class="col-md-6 required-field">
                                    <span class="titleLabel">Contribution Amount</span>
                                    <div class="controls customInputDiv">
                                        <input id="bookingDetailsContributionAmount" placeholder="Contribution Amount"  name="Contribution Amount" disabled="true" class="form-control customInput">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <span class="titleLabel">Order Id</span>
                                    <div class="controls customInputDiv">
                                        <input id="bookingDetailsOrderId" placeholder="OrderId" type="text" name="OrderId" disabled="true" class="form-control customInput">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-12">
                                <div class="text-xs-right">
                                    <button id="rzpPaymentButton" ids="bookOnlineButton_{{programid}}_{{scheduleid}}" type="button" class="btn myButton" data-text="Submit">Submit</button> 
                                    <button id="cancelOnlineButton_{{programid}}_{{scheduleid}}" type="button" class="btn myButton" data-dismiss="modal" data-text="Reset">Cancel</button>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </form>
                    </div>
                        </div>
                      </div>
                    </div>
                    <?php include_once 'public_html/includes/footerPage.php'; ?>
                    <?php include_once 'public_html/includes/footerScript.php';?>
                    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                    <script src="assets/script/js/bookingPayment.js"></script>

                  </body>

                  </html>