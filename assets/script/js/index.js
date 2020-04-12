var planData = {};

$(document).ready(function() {
	$('#indexHeaderView').addClass('active');
	window.localStorage.clear();
	loadCategory();
	if(!window.localStorage.languageCode){
		window.localStorage.languageCode = 'en';
	}else{
		$('#languageSelector').val(window.localStorage.languageCode);
	}
	callFaqData(); 
	eventListener();
});

function eventListener(){
	$('#languageSelector').on('change', setLangaugeCode);
}

function setLangaugeCode(){
	window.localStorage.languageCode = $('#languageSelector').val();
	loadInitialData();
}

function callFaqData(){
	var fragment = '';
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        templates = xhttp.responseText;
	        loadInitialData();
	    }
	};
	xhttp.open("GET", "public_html/fragments/indexFragment.html", true);
	xhttp.send();
}

function loadInitialData(){
	loadMasterData();
	loadProgramData();
	loadExploreMore();
}

function loadMasterData(){
/*	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        var response = xhttp.responseText;
	        planData = JSON.parse(response);*/
	        renderPlans(masterdetails);
/*	    }
	};
	xhttp.open("GET", "../php/PackageController.php", true);
	xhttp.send();*/
}

function renderPlans(renderData){
	var fragment = $(templates).filter('#mastercontent').html();
	var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
	for(var key=0; key <6 ; key++){
		$('#itemContentHolder'+key).empty();    
		$('#itemContentHolder'+key).append(Mustache.render(fragment, renderData[languageCode]));
	}
}

function loadExploreMore(){
	var fragment = $(templates).filter('#indexExploreMoreContent').html();
	var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
	$('#indexExploreMore').empty();    
	$('#indexExploreMore').append(Mustache.render(fragment, exploredetails[languageCode]));
}

function loadProgramData(){
/*	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	        var response = xhttp.responseText;
	        planData = JSON.parse(response);*/
	        renderProgramPlans(programdetails);
/*	    }
	};
	xhttp.open("GET", "../php/PackageController.php", true);
	xhttp.send();*/
}

function renderProgramPlans(renderData){
	var fragment = $(templates).filter('#programContent').html();
	var languageCode = window.localStorage.languageCode ?window.localStorage.languageCode : "en" ;
	for(var key=0; key <4 ; key++){
		$('#programContentHolder'+key).empty();    
		$('#programContentHolder'+key).append(Mustache.render(fragment, renderData[key][languageCode]));
	}
}

var exploredetails = { "en":{
			"exploreTitle":"Welcome to ",
			"exploreName":" Our Programs",
			"masterLink":"schedule.php",
			"fottertext":"Explore More"
		},
		"hi":{
			"exploreTitle":"आपका स्वागत है ",
			"exploreName":" हमारे कार्यक्रमों",
			"masterLink":"schedule.php",
			"fottertext":"और ज्यादा खोजें"
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
			"programTitle" : "Samadhi Programs",
			"content" : "Osho often says, “Life itself is God”. As a musk deer runs away from itself in the search of the fragrance, we also run away from life in the search of God. In Oshodhara 'Life' is at the center of the first level of samadhi program.",
			"fotterLink" : "programe.php?programid=1",
			"masterLink" : "programe.php?programid=1",
			"fottertext" :"Know More"
		},
		"hi":{
			"programTitle" : "समाधि कार्यक्रम",
			"content" : "ओशो अक्सर कहते है,'जीवन ही ईश्वर है'। जैसे कस्तूरी मृग सुगंध की खोज में अपने आप से दूर भागता है, वैसे ही हम भी ईश्वर की खोज में जीवन से भाग जाते हैं। ओशोधारा में 'जीवन' समाधि कार्यक्रम के पहले स्तर के केंद्र में है।द्भाव में रहना सीखता है",
			"fotterLink" : "programe.php?programid=1",
			"masterLink" : "programe.php?programid=1",
			"fottertext" :"अधिक जानिए"
		}	
},
{ "en":{
			"programTitle" : "Pragya Programs",
			"content" : "Mahajeevan is the higher life, which contains the cycle of births and deaths of a soul. It's the journey of a soul including all the births and deaths",
			"fotterLink" : "programe.php?programid=100",
			"masterLink" : "programe.php?programid=100",
			"fottertext" :"Know More"
		},
		"hi":{
			"programTitle" : "प्रज्ञा कार्यक्रम",
			"content" : "महाजीवन उच्च जीवन है, जिसमें आत्मा के जन्म और मृत्यु का चक्र होता है। यह एक आत्मा की यात्रा है जिसमें सभी जन्म और मृत्यु शामिल हैंहै जो कुछ बिंदु पर आवश्यक हैं।",
			"fotterLink" : "programe.php?programid=100",
			"masterLink" : "programe.php?programid=100",
			"fottertext" :"अधिक जानिए"
		}	
} ,
{ "en":{
			"programTitle" : "Health Programs",
			"content" : "‘Kaya’ means body and ‘kalp’ means transformation; collectively ‘kayakalp’ means transformation of the body. Kayakalpam is a six day health program specifically meant for reducing weight, calorie intake management and for bursting all our wrong notions around food and health.",
			"fotterLink" : "programe.php?programid=60",
			"masterLink" : "programe.php?programid=60",
			"fottertext" :"Know More"
		},
		"hi":{
			"programTitle" : "स्वास्थ्य कार्यक्रम",
			"content" : "'काया' का अर्थ है शरीर और 'कल्प' का अर्थ है परिवर्तन; सामूहिक रूप से 'कायाकल्प' का अर्थ है शरीर का परिवर्तन। कायाकल्प एक छह दिवसीय स्वास्थ्य कार्यक्रम है जो विशेष रूप से वजन कम करने, कैलोरी सेवन प्रबंधन और भोजन और स्वास्थ्य के आसपास हमारी सभी गलत धारणाओं को तोड़ने के लिए है।्वारा संचालित किए जाते हैं।",
			"fotterLink" : "programe.php?programid=60",
			"masterLink" : "programe.php?programid=60",
			"fottertext" :"अधिक जानिए"
		}	
} ,{ "en":{
			"programTitle" : "Sumiran Programs",
			"content" : "A seeker embarks on the journey of Devotion as one enters Sumiran and later Pad Programs. One gets to experience the liveliness of space and consequently fall in love with it. 'Sans sans sumre Govind '- the Art of Divine remembrance is taught in these programs.",
			"fotterLink" : "programe.php?programid=15",
			"masterLink" : "programe.php?programid=15",
			"fottertext" :"Know More"
		},
		"hi":{
			"programTitle" : "सुमिरन कार्यक्रम",
			"content" : "एक साधक भक्ति की यात्रा पर निकलता है क्योंकि एक सुमिरन और बाद में पैड कार्यक्रमों में प्रवेश करता है। व्यक्ति को अंतरिक्ष की आजीविका का अनुभव होता है और फलस्वरूप उसके साथ प्यार हो जाता है। 'सन्स सेन्स गोविन्द' - इन कार्यक्रमों में दिव्य स्मरण की कला सिखाई जाती है।",
			"fotterLink" : "programe.php?programid=15",
			"masterLink" : "programe.php?programid=15",
			"fottertext" :"अधिक जानिए"
		}	
} ] 

//https://www.jssor.com/skins/bullet/bullet-skin-035-black.slider/=skin