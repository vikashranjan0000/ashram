var centresData = {};
var centreLocationData = {};
var centreTemplates = "";

$(document).ready(function() {
	loadCategory()
	if(!window.localStorage.languageCode){
		window.localStorage.languageCode = 'en';
	}else{
		$('#languageSelector').val(window.localStorage.languageCode);
	}
	callCentreFragment(); 
	resetCentreSearchField();
	eventListener();
});

function eventListener(){
	$('#languageSelector').on('change', setLangaugeCode);
	$('#searchCentre_SPG').on('click', handlerSearchCentre);
	$('#resetSchedule_SPG').on('click', resetCentreSearchField);
}


function venueAutoComplete(){
	$(function() {
        $("#venueNameAuto_SPG").autocomplete({
           	source:function(request, response){
           		$("#venueNameAuto_SPG").attr("venueId", '');
				if(window.localStorage.venueSchResponse){
					var venueAC = JSON.parse(window.localStorage.venueSchResponse);
					venueAC = JSON.parse(venueAC);
					var venueAutoResponse = [];
					
					for(var venueAutokey in venueAC){						
						let labelObj = {}
						labelObj.label = venueAC[venueAutokey].dhyankendraname;
						labelObj.value = venueAC[venueAutokey].dhyankendraid;
						venueAutoResponse.push(labelObj);							
					}
					response(venueAutoResponse);
				}
           	},
           	select: function( event, ui ) {
	            $("#venueNameAuto_SPG").val( ui.item.label); //ui.item is your object from the array
	            $("#venueNameAuto_SPG").attr("venueId",  ui.item.value); //ui.item is your object from the array
	            return false;
	        }

        });
     });
}

function loadVenueData_SPG(){
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          let venueSchResponse = xhttp.responseText;
          window.localStorage.venueSchResponse =  JSON.stringify(venueSchResponse);
      }else{

      }
  };
  xhttp.open("POST", "php/api/controller/CenterController.php", true);
  xhttp.send();
}


function setProgramName(){
	var programName_SPG = JSON.parse(window.localStorage.catProResponse);
	programName_SPG = JSON.parse(programName_SPG);
	for(var pronameAutokey in programName_SPG){
		planProgramData[programName_SPG[pronameAutokey].programid] = programName_SPG[pronameAutokey];
	}
}
function setLocationName(){
	var scheuleLocationData_SPG = JSON.parse(window.localStorage.venueSchResponse);
	scheuleLocationData_SPG = JSON.parse(scheuleLocationData_SPG);
	for(var lockey in scheuleLocationData_SPG){
		scheuleLocationData[scheuleLocationData_SPG[lockey].dhyankendraid] = scheuleLocationData_SPG[lockey];
	}
}


function setLangaugeCode(){
	window.localStorage.languageCode = $('#languageSelector').val();
	loadCenterListData();
}

function resetCentreSearchField(){
	$('#programCate_SPG').val('');
	loadCenterListData();
}


function handlerSearchCentre(){
	var serchInput = {}
	serchInput.categoryid =  $('#programCate_SPG').attr("categoryid");
	serchInput.programid =  $('#programNameAuto_SPG').attr("programid");
	serchInput.venueId =  $('#venueNameAuto_SPG').attr("venueId");
	serchInput.startDate =  $('#startDate_SPG').val();
	if(serchInput.startDate){
		serchInput.startDate = moment(serchInput.startDate).format('YYYY-MM-DD');
	}
	serchInput.endDate =  $('#endDate_SPG').val();
	if(serchInput.endDate){
		serchInput.endDate = moment(serchInput.endDate).format('YYYY-MM-DD');
	}
	loadCenterListData(serchInput);

}

function callCentreFragment(){
	var fragment = '';
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        scheduleTemplates = xhttp.responseText;
	        loadInitialData();
	    }
	};
	xhttp.open("GET", "public_html/fragments/scheduleFragment.html", true);
	xhttp.send();
}

function loadInitialData(){	
	loadCenterListData();
	setProgramName();
	setLocationName();
}

function loadCenterListData(searchCenterdata){
  var xhttp = new XMLHttpRequest();
  let fd  = new FormData();
  if(searchCenterdata){
  	for(var cenSerkey in searchCenterdata){
  		if(searchCenterdata[cenSerkey]){
			fd.append(cenSerkey, searchCenterdata[cenSerkey]);
  		}
  	}
  	if(fd.has.length > 0){
		fd.append("search", "byFilter");
  	}
  }

  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var response = xhttp.responseText;
          var scheduleData = JSON.parse(response);
          //programData = response;
          if(scheduleData){
          	renderCentreData(scheduleData);
          }else{
          	
          }
      }else{

      }
  };
  xhttp.open("POST", "php/api/controller/CentreController.php", true);
  xhttp.send(fd);
}


function renderCentreData(renderData){
  var schedulefragment = $(scheduleTemplates).filter('#programScheduleContent').html();
  var scheduleModalfragment = $(headerTemplates).filter('#programScheduleModalContent').html();

  var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
  $('#programScheduleHolder').empty();    
  $('#myModal').empty();    
  for(var key in renderData){
  	renderData[key].start_date = moment(renderData[key].start_date).format('DD MMM, YYYY');
  	renderData[key].end_date = moment(renderData[key].end_date).format('DD MMM, YYYY');
  	renderData[key].programData =  planProgramData[renderData[key].programid]
  	renderData[key].locationData =  scheuleLocationData[renderData[key].dhyankendraid]
  	
    if(renderData[key]['language']=languageCode){
      $('#programScheduleHolder').append(Mustache.render(schedulefragment, renderData[key]));
      $('#myModal').append(Mustache.render(scheduleModalfragment, renderData[key]));
    }
  }
}