var programData = {};
var templates = "";

$(document).ready(function() {
  debugger;
    loadCategory()
  callFragmentText();
  if(!window.localStorage.languageCode){
    window.localStorage.languageCode = 'en';
  }else{
    $('#languageSelector').val(window.localStorage.languageCode);
  }
  var url  = window.location.href 
  url = url.split("?")[1];
  if(url){      
      loadProgramData(url);
  }else{
    url ="programid=1"
    loadProgramData(url);
  }
  eventListener();
});

function eventListener(){
  $('#languageSelector').on('change', setLangaugeCode);
}

function setLangaugeCode(){
  window.localStorage.languageCode = $('#languageSelector').val();
  loadInitialData();
}

function callFragmentText(){
  var fragment = '';
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          templates = xhttp.responseText;
      }
  };
  xhttp.open("GET", "public_html/fragments/programFragment.html", true);
  xhttp.send();
}


function loadProgramData(urldata){
  urldata = urldata.split("=")
  var xhttp = new XMLHttpRequest();
  let fd  = new FormData();
  fd.append('programid', urldata[1])
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var response = xhttp.responseText;
          programData = JSON.parse(response);
          //programData = response;
          renderProgramData(programData);
      }else{

      }
  };
  xhttp.open("POST", "/php/api/controller/ProgramController.php", true);
  xhttp.send(fd);
}

function renderPlans(renderData){
  var fragment = $(templates).filter('#programTitleContent').html();
  var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
  for(var key=0; key <6 ; key++){
    $('#itemContentHolder'+key).empty();    
    $('#itemContentHolder'+key).append(Mustache.render(fragment, renderData[languageCode]));
  }
}


function renderProgramData(renderData){
  var titlefragment = $(templates).filter('#programTitleContent').html();
  var descfragment = $(templates).filter('#programDetailContent').html();
  var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
  var rendered = false;
  for(var key in renderData){
    if(renderData[key]['language']=languageCode && rendered == false){
      $('#programTitleHolder').empty();    
      $('#programTitleHolder').append(Mustache.render(titlefragment, renderData[key]));
      $('#programDetailHolder').empty();    
      $('#programDetailHolder').append(Mustache.render(descfragment, renderData[key]));     
      rendered = true;
    }
  }
}
var masterdetails = { "en":{
      "mastereTitle" : "Know the Masters",
      "content" : "I Am A Threat - Certainly ! If you dont understand what I am saying, I am a threat, certainly. But if they understand what I am saying, they will rejoice, there is no threat. In fact, I want to make these people contemporaries.",
      "fotterLink" : "master.html",
      "masterLink" : "master.html",
      "fottertext" :"Know More"
    },
    "hi":{
      "mastereTitle" : "मास्टर्स को जानें",
      "content" : "आई एम ए थ्रेट - निश्चित रूप से! यदि आप यह नहीं समझते हैं कि मैं क्या कह रहा हूं, तो मैं एक खतरा हूं। लेकिन अगर वे समझते हैं कि मैं क्या कह रहा हूं, तो वे आनन्दित होंगे, कोई खतरा नहीं है। वास्तव में, मैं इन लोगों को समकालीन बनाना चाहता हूं",
      "fotterLink" : "master.html",
      "masterLink" : "master.html",
      "fottertext" :"अधिक जानिए"
    } 
} 

var programdetails = [{ "en":{
      "programTitle" : "Samadhi Program",
      "content" : "Based on Divine Sound, Light, Breathing, Energyy in which a seeker learns to live in harmony with the Divine Sound, Light, Breathing, Energyy",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"Know More"
    },
    "hi":{
      "programTitle" : "समाधि कार्यक्रम",
      "content" : "दिव्य ध्वनि, प्रकाश, श्वास, ऊर्जा पर आधारित है जिसमें एक साधक दिव्य ध्वनि, प्रकाश, श्वास, ऊर्जा के साथ सद्भाव में रहना सीखता है",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"अधिक जानिए"
    } 
},
{ "en":{
      "programTitle" : "Pragya Program",
      "content" : "For Happy Living in outside world Pragya programs have been designed and are being conducted on regular basis which are essential  at some point.",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"Know More"
    },
    "hi":{
      "programTitle" : "प्रज्ञा कार्यक्रम",
      "content" : "बाहरी दुनिया में हैप्पी लिविंग के लिए प्रज्ञा कार्यक्रमों को डिजाइन किया गया है और नियमित रूप से संचालित किया जा रहा है जो कुछ बिंदु पर आवश्यक हैं।",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"अधिक जानिए"
    } 
} ,
{ "en":{
      "programTitle" : "Health Program",
      "content" : "Based on modern developments in health management and ancient spiritual wisdom Kayakalpam programs are regularly conducted by Oshodhara.",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"Know More"
    },
    "hi":{
      "programTitle" : "स्वास्थ्य कार्यक्रम",
      "content" : "स्वास्थ्य प्रबंधन और प्राचीन आध्यात्मिक ज्ञान में आधुनिक विकास पर आधारित कायाकल्प कार्यक्रम नियमित रूप से ओशोधारा द्वारा संचालित किए जाते हैं।",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"अधिक जानिए"
    } 
} ,{ "en":{
      "programTitle" : "Sumiran Program",
      "content" : "This is conducted in total silence in which seekers learn to be grounded in Cosmic Bliss. Jeevan Pragya and Moksha Pragya before Anand Sumiran",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"Know More"
    },
    "hi":{
      "programTitle" : "सुमिरन कार्यक्रम",
      "content" : "यह कुल मौन में आयोजित किया जाता है जिसमें साधक ब्रह्मांडीय आनंद में पारंगत होना सीखते हैं। आनंद सुमिरन से पहले जीवन प्रज्ञा और मोक्ष प्रज्ञा",
      "fotterLink" : "programe.html",
      "masterLink" : "programe.html",
      "fottertext" :"अधिक जानिए"
    } 
} ] 
