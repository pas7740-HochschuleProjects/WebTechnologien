// Username & PW validation

form = document.getElementById('register-form');
username = document.getElementById('username');
password = document.getElementById('password');
confirm = document.getElementById('confirm');
UserErrorElement = document.getElementById('UserError');
PasswordErrorElement = document.getElementById('PasswordError');
ConfirmErrorElement = document.getElementById('ConfirmError');

form.addEventListener('input', (e) => {
    let UserMessages = [];
    let PasswordMessages = [];
    let ConfirmMessages = [];
    let checkA = false;
    let checkB = false;

    // Check if Username has at least 3 characters
    if (username.value.length < 3) {
        UserMessages.push('Username requires at least 3 characters');
        document.getElementById("username").style.border = "2px solid red";
        UserErrorElement.innerText = UserMessages.join(', ');    //print error message
        submitBTN.setAttribute('disabled', 'disabled');                                      //prevent submitting
    } else {
        document.getElementById("username").style.border = "2px solid green";
        UserErrorElement.innerText = "";
        checkA = true;
    }

    // Check if Username is already used
    sendRequest(REQUEST_TYPE.GET, "user/" + username.value, undefined, false).then((response)=>{
        if (response.status == 204) {
            UserMessages.push('Username is already used');
            document.getElementById("username").style.border = "2px solid red";
            UserErrorElement.innerText = UserMessages.join(', ');    //print error message
            submitBTN.setAttribute('disabled', 'disabled');                                     //prevent submitting
            console.log("User exists");
        } else if (response.status == 404) {
            console.log("User does not exist");
        }
    });

    // Check if PW has at least 8 characters
    if (password.value.length < 8) {
        PasswordMessages.push('Password requires at least 8 characters');
        document.getElementById("password").style.border = "2px solid red";
        PasswordErrorElement.innerText = PasswordMessages;       //print error message
        submitBTN.setAttribute('disabled', 'disabled');                                     //prevent submitting
    } else {
        document.getElementById("password").style.border = "2px solid green";
        PasswordErrorElement.innerText = "";
        

        // Check if PW and Confirm PW match
        if (confirm.value != password.value) {
            ConfirmMessages.push('Passwords do not match');
            document.getElementById("confirm").style.border = "2px solid red";
            ConfirmErrorElement.innerText = ConfirmMessages;   //print error message
            submitBTN.setAttribute('disabled', 'disabled');                                //prevent submitting
        } else {
            document.getElementById("confirm").style.border = "2px solid green";
            ConfirmErrorElement.innerText = "";
            checkB = true;
        }
    }

    // prevent cheating on Validation :)
    if (checkA && checkB) {
        submitBTN.removeAttribute('disabled');
    }
})