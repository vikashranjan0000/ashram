$(document).ready(function() {
	$('#centerHeaderView').addClass('active');
    loadCategory()
  if(!window.localStorage.languageCode){
    window.localStorage.languageCode = 'en';
  }else{
    $('#languageSelector').val(window.localStorage.languageCode);
  }
});
