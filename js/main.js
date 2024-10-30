

function OpenCSS(evt, cssidchange) {
  var i, tabcontent, tablinks, homecssbyua;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cssidchange).style.display = "block";
  evt.currentTarget.className += " active";


}
