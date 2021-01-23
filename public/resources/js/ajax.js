function send_message_ajax(chat_room_id) {

    var text = document.getElementById(chat_room_id).getElementsByClassName("new")[0].getElementsByTagName("input")[0].value;
    console.log(text);
    console.log(chat_room_id);

    var xhr = new XMLHttpRequest();
    var data = "send="+chat_room_id+","+text;

    xhr.open('POST', 'process.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function(){

        console.log(this.responseText);
    }    
    xhr.send(data);


}
