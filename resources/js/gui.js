function open_pane(evt, chat_room_index) {
  // Declare all variables
  var i, right, tablinks;

  // Get all elements with class="tabcontent" and hide them
  right = document.getElementsByClassName("right");
  for (i = 0; i < right.length; i++) {
    right[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(chat_room_index).style.display = "block";
  evt.currentTarget.className += " active";
}
