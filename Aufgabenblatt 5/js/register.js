// Username & PW validation

form = document.getElementById('register-form');
username = document.getElementById('username');
password = document.getElementById('password');
confirm = document.getElementById('confirm');

form.addEventListener('input', (e) => {
    let checkA = false;
    let checkB = false;

    // Check if Username has at least 3 characters
    if (username.value.length < 3) {
        document.getElementById("username").style.border = "2px solid red";
        submitBTN.setAttribute('disabled', 'disabled');         //prevent submitting
    } else {
        checkA = true;
        // Check if Username is already used
        phpRequest(REQUEST_TYPE.GET, "../ajax_check_user.php?user=" + username.value, undefined, false).then((response) => {
            if (response.status == 204) {
                document.getElementById("username").style.border = "2px solid red";
                submitBTN.setAttribute('disabled', 'disabled');         //prevent submitting
                console.log("User exists");
            } else if (response.status == 404) {
                document.getElementById("username").style.border = "2px solid green";
                console.log("User does not exist");
            }
        });
    }

    // Check if PW has at least 8 characters
    if (password.value.length < 8) {
        document.getElementById("password").style.border = "2px solid red";
        submitBTN.setAttribute('disabled', 'disabled');         //prevent submitting
    } else {
        document.getElementById("password").style.border = "2px solid green";
        
        // Check if PW and Confirm PW match
        if (confirm.value != password.value) {
            document.getElementById("confirm").style.border = "2px solid red";
            submitBTN.setAttribute('disabled', 'disabled');   //prevent submitting
        } else {
            document.getElementById("confirm").style.border = "2px solid green";
            checkB = true;
        }
    }

    // prevent cheating on Validation :)
    if (checkA && checkB) {
        submitBTN.removeAttribute('disabled');
    }
})