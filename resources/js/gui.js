function open_pane(evt, chat_room_index) {
  var i, right, tablinks;

  right = document.getElementsByClassName("right");
  for (i = 0; i < right.length; i++) {
    right[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(chat_room_index).style.display = "block";
  evt.currentTarget.className += " active";
}
