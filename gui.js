function open_chat_room(evt, id) {
  
    var chat_pane = document.getElementsByClassName("chat_pane");
    for ( var i = 0; i < chat_pane.length; i++) {
        chat_pane[i].style.display = "none";
    }
    chat_name = document.getElementsByClassName("chat_name");
    for (i = 0; i < chat_name.length; i++) {
        chat_name[i].className = chat_name[i].className.replace(" active", "");
    }

    document.getElementById(id).style.display = "block";
    evt.currentTarget.className += " active";
}
