// Username & PW validation

form = document.getElementById('register-form');
username = document.getElementById('username');
password = document.getElementById('password');
confirm = document.getElementById('confirm');
UserErrorElement = document.getElementById('UserError');
PasswordErrorElement = document.getElementById('PasswordError');
ConfirmErrorElement = document.getElementById('ConfirmError');

form.addEventListener('submit', (e) => {
    let UserMessages = [];
    let PasswordMessages = [];
    let ConfirmMessages = [];

    // Check if Username has at least 3 characters
    if (username.value.length < 3) {
        UserMessages.push('Username requires at least 3 characters');
        document.getElementById("username").style.border = "2px solid red";
        UserErrorElement.innerText = UserMessages.join(', ');    //print error message
        e.preventDefault();                                      //prevent submitting
    } else {
        document.getElementById("username").style.border = "2px solid green";
        UserErrorElement.innerText = "";
    }

    // Check if Username is already used
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4) {
            if (xmlhttp.status == 204) {
                UserMessages.push('Username is already used');
                document.getElementById("username").style.border = "2px solid red";
                UserErrorElement.innerText = UserMessages.join(', ');    //print error message
                e.preventDefault();                                      //prevent submitting
                console.log("Exists");
            } else if (xmlhttp.status == 404) {
                console.log("Does not exist");
            }
        }
    };
    xmlhttp.open("GET", "https://online-lectures-cs.thi.de/chat/5f292156-ad1b-43ff-bda4-31ce05cd447c/user/" + username.value, true);
    xmlhttp.send();

    // Check if PW has at least 8 characters
    if (password.value.length < 8) {
        PasswordMessages.push('Password requires at least 8 characters');
        document.getElementById("password").style.border = "2px solid red";
        PasswordErrorElement.innerText = PasswordMessages;       //print error message
        e.preventDefault();                                      //prevent submitting
    } else {
        document.getElementById("password").style.border = "2px solid green";
        PasswordErrorElement.innerText = "";

        // Check if PW and Confirm PW match
        if (confirm.value != password.value) {
            ConfirmMessages.push('Passwords do not match');
            document.getElementById("confirm").style.border = "2px solid red";
            ConfirmErrorElement.innerText = ConfirmMessages;   //print error message
            e.preventDefault();                                //prevent submitting
        } else {
            document.getElementById("confirm").style.border = "2px solid green";
            ConfirmErrorElement.innerText = "";
        }
    }
})