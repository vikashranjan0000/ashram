var programData_PPG = {};
var templates_PPG = "";

$(document).ready(function() {
  loadCategory()
  callFragmentText_PPG();
  if(!window.localStorage.languageCode){
    window.localStorage.languageCode = 'en';
  }else{
    $('#languageSelector').val(window.localStorage.languageCode);
  }
  var url  = window.location.href 
  url = url.split("?")[1];
  if(url){      
      loadProgramData_PPG(url);
  }else{
    url ="programid=1"
    loadProgramData_PPG(url);
  }
  eventListener();
});

function eventListener(){
  $('#languageSelector').on('change', setLangaugeCode);
}

function setLangaugeCode(){
  window.localStorage.languageCode = $('#languageSelector').val();
}

function callFragmentText_PPG(){
  let fragment = '';
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          templates_PPG = xhttp.responseText;
      }
  };
  xhttp.open("GET", "public_html/fragments/programFragment.html", true);
  xhttp.send();
}


function loadProgramData_PPG(urldata){
  urldata = urldata.split("=")
  var xhttp = new XMLHttpRequest();
  let fd  = new FormData();
  fd.append('programid', urldata[1])
  fd.append('programList', urldata[1])
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var response = xhttp.responseText;
          programData_PPG = JSON.parse(response);
          renderProgramData_PPG(programData_PPG['programData']);
          renderProgramIntake(programData_PPG);
      }else{

      }
  };
  xhttp.open("POST", "php/api/controller/ProgramController.php", true);
  xhttp.send(fd);
}

function renderProgramData_PPG(renderData){
  var titlefragment = $(templates_PPG).filter('#programTitleContent').html();
  var descfragment = $(templates_PPG).filter('#programDetailContent').html();
  var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
  
  if(renderData[0]['language']=languageCode){
    $('#programTitleHolder').empty();    
    $('#programTitleHolder').append(Mustache.render(titlefragment, renderData[0]));
    $('#programDetailHolder').empty();    
    $('#programDetailHolder').append(Mustache.render(descfragment, renderData[0]));  
    $('#programLongDiscription_'+renderData[0].programid).html(renderData[0].longdescription);   
      }
  }
    
  function renderProgramIntake(programListData){
      renderData = programListData['programList'];
      var progListfragment = $(templates_PPG).find('#programListContent').html();
      var scheduleModalfragment = $(templates_PPG).filter('#programListModalContent').html();

      var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
      $('#programIntakeHolder').empty();    
      $('#programModal').empty();    
      for(var key in renderData){
        if(key < 6){

          renderData[key].start_date = moment(renderData[key].start_date).format('DD MMM');
          renderData[key].end_date = moment(renderData[key].end_date).format('DD MMM, YYYY');
          renderData[key].locationData =  scheuleLocationData[renderData[key].dhyankendraid]
          renderData[key].programData =  programListData['programData'][0];
          $('#programIntakeHolder').append(Mustache.render(progListfragment, renderData[key]));
          $('#programModal').append(Mustache.render(scheduleModalfragment, renderData[key]));
        }else{
          return ;
        }
      }
  }