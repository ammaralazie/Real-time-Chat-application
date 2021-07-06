//send message by ajax to database

var frm = $("#data");
$(document).on("click", "#send", function(e) {
    e.preventDefault();
    $.ajax({
        url: "/recive-message/",
        type: "POST",
        data: frm.serialize(),
        success: function(response) {
            console.log(response.msg);
        },
        error: function(err) {
            console.log(err);
        }
    }); //end of ajax

    showMessage();
});

//end send mesage by ajax to database

//show my message in container

function showMessage() {
    var msg = document.querySelector("input[name=message]");

    var myMessage = document.createElement("div");
    myMessage.classList = "my-message";
    var createP = document.createElement("p");
    createP.textContent = msg.value;
    myMessage.appendChild(createP);

    var messageCover = document.getElementsByClassName("message-cover")[0];
    messageCover.appendChild(myMessage);
    msg.value = "";
    var messageCover = document.getElementsByClassName("message-cover")[0];
    messageCover.scrollTop = messageCover.scrollHeight;
} //end of showMessage

//end of show my message in container
