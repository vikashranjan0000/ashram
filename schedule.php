<!DOCTYPE html>
<html>

<head>

    <?php include_once 'public_html/includes/commonHeader.php'; ?>
    <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css' />
    <script defer src="js/solid.js"></script>
    <script src="vendor/modernizr/modernizr.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href='assets/css/custom/schedule.css' media='all' rel='stylesheet' type='text/css' />
</head>

<body class="front">
    <?php include_once 'public_html/includes/sideBarContent.php'; ?>
        <div class="row">
            <div class="col-lg-12">

                <div class="header-bg" style="background-image:url(images/banner.jpg)">
                    <div class=" header-content">
                        <div class="main-title">
                            <h1 class="bold mb-30 a-f ">Schedule</h1>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="form-mgr clearfix searchHolder">
                <div class="col-md-12 col-sm-12 animate fadeInRight">
                    <form role="form" action="esendmail1.php" method="post" class="m-t-40" novalidate>
                        <div class="form-group clearfix scheduleFormGroup">

                            <div class="col-md-4">
                                <span class="titleLabel">Program Category </span>
                                <div class="controls">
                                    <input name="programCate_SPG" id="programCate_SPG" placeholder="Program Category" required class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <span class="titleLabel">Program  </span>
                                <div class="controls customInputDiv">
                                   <input name="programNameAuto_SPG" id="programNameAuto_SPG" placeholder="Program Name" required class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <span class="titleLabel">Venue  </span>
                                <div class="controls customInputDiv">
                                    <input name="venueNameAuto_SPG" id="venueNameAuto_SPG" placeholder="Venue Name" required class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="form-group clearfix scheduleFormGroup">
                            <div class="col-md-4">

                                <span class="titleLabel">State  </span>
                                <div class="controls customInputDiv">
                                    <select name="ss" id="ss" required class="form-control">
                                        <option value="">Select an Option</option>
                                        <option value="State  1">State 1</option>
                                        <option value="State  2">State 2</option>
                                        <option value="State  3">State 3</option>
                                        <option value="State  4">State 4</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <span class="titleLabel">From Date  </span>
                                <div class="controls customInputDiv">
                                    <input id="startDate_SPG" type="name" name="name" class="form-control" required placeholder="start date" data-validation-required-message="This field is required"> 
                                </div>
                            </div>

                            <div class="col-md-4">
                                <span class="titleLabel">last Date  </span>
                                <div class="controls customInputDiv">
                                    <input id="endDate_SPG" type="name" name="name" class="form-control" required placeholder="end date" data-validation-required-message="This field is required"> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="text-xs-right">
                                <button id="searchSchedule_SPG" type="button" class="btn myButton" data-text="Submit">Search</button>
                                <button id="resetSchedule_SPG" type="button" class="btn myButton btn-inverse" data-text="Reset">Reset</button>
                                <br>
                                <br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row tpp-orgl ">

            <div class="col-lg-12 tpp-orgl1">
                <div class="table-responsive ">
                    <form id="contact-form" action="#" method="POST" novalidate="novalidate">
                        <table class="table table-striped ">
                            <thead class="tb-bg-text">
                                <tr>
                                    <th class="scheduleTableHeader" width="20%">Program</th>
                                    <th class="scheduleTableHeader" width="18%">Location</th>
                                    <th class="scheduleTableHeader" width="20%">Date</th>
                                    <th class="scheduleTableHeader" width="24%">Aachrya</th>
                                    <th class="scheduleTableHeader" width="18%">
                                        <span id="viewButton"  class="pull-left">View</span>
                                        <span id="bookButton" class="pull-right">Book</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="programScheduleHolder">

                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="pagination-wrap">
            <div class="row">
                <div class="col-xs-7">
                    <ul class="pagination">
                        <li class="active"><a href="comingSoon.html">1 <span class="sr-only">(current)</span></a></li>
                        <li><a href="comingSoon.html">2</a></li>
                        <li><a href="comingSoon.html">3</a></li>
                    </ul>
                </div>
                <div class="col-xs-5 text-right">
                    <p>Showing 1–9 of 20 results</p>
                </div>
            </div>
        </div>
    <?php include_once 'public_html/includes/footerPage.php'; ?>
    <div id="myModal">
        
    </div>
    <div id="proBookingModalHolder">
        
    </div>
    
    <?php include_once 'public_html/includes/footerScript.php'; ?>

    <script src="assets/script/libs/jquery-ui.min.js"></script>
    <script src="assets/script/js/schedule.js"></script>
    <script src="js/mask.init.js"></script>
    <script src="js/jquery.inputmask.bundle.min.js"></script>
    </body>

</html>
