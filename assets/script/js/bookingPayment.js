var planProgramData = {};
var orderId ='';
var bookingInfo;

$(document).ready(function() {
    $('#scheduleHeaderView').addClass('active');
    $('#onlineScheduleListView').addClass('active');
    loadCategory()
    var urlParams = new URLSearchParams(window.location.search);
    orderId = urlParams.get('orderId');
    bookingInfo = JSON.parse(window.localStorage.bookingInfo) ;
    if (!window.localStorage.languageCode) {
        window.localStorage.languageCode = 'en';
    } else {
        $('#languageSelector').val(window.localStorage.languageCode);
    }
    renderBookingData(bookingInfo);
    eventListenerOnline();
});

function eventListenerOnline() {
    $('#languageSelector').on('change', setLangaugeCode);
     $('#rzpPaymentButton').on('click', processPaymentHandler);
}

function processPaymentHandler() {
    paymentInfo = JSON.parse(window.localStorage.bookingInfo) ;
    var options = {
        "key": "rzp_test_TYAsXdXhKaGSa6", // Enter the Key ID generated from the Dashboard
        "amount": paymentInfo.ContributionAmount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Oshodhara",
        "description": paymentInfo.programName,
        "image": "https://example.com/your_logo",
        "order_id": orderId, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": handlerPaymentProcessed,
        "prefill": {
            "name":paymentInfo.userName,
            "email": paymentInfo.emailId,
            "contact": "+91"+paymentInfo.phoneNumber
        },
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#F37254"
        }
    };
    var rzp1 = new Razorpay(options);    
    rzp1.open();
}



function handlerPaymentProcessed(response) {
    alert("Payment Successful, Please Not the payment Id "+response.razorpay_payment_id);
    alert(", Please Not the OrderId "+response.razorpay_order_id);
  //  alert(response.razorpay_signature)
}

function setLangaugeCode() {
    window.localStorage.languageCode = $('#languageSelector').val();
}


function renderBookingData(renderData) {
    $('#bookingDetailsprogramNameTitle').val(renderData.programName);
    $('#bookingDetailsprogramName').val(renderData.programName);
    $('#bookingDetailsuserName').val(renderData.userName);
    $('#bookingDetailsemailId').val(renderData.emailId);
    $('#bookingDetailsphoneNumber').val(renderData.phoneNumber);
    $('#bookingDetailsContributionAmount').val(renderData.ContributionAmount);
    $('#bookingDetailsOrderId').val(orderId);    
}
