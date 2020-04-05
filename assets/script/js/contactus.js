$(document).ready(function() {
  if(!window.localStorage.languageCode){
    window.localStorage.languageCode = 'en';
  }else{
    $('#languageSelector').val(window.localStorage.languageCode);
  }
  $('#faqHeaderView').addClass('active');
  loadCategory()
});
