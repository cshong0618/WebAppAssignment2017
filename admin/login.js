// Client-side validation
ev("form_button", "click", function() {
        var username = ele("username").value;
        var password = ele("password").value;

        var pass = true;

        if(username === "") {
            ele("username_error").innerHTML = "Username cannot be blank";
            pass = false;
        } else {
            ele("username_error").innerHTML = "";
        }

        if(password === "") {
            ele("password_error").innerHTML = "Password cannot be blank";
            pass = false;
        } else {
            ele("password_error").innerHTML = "";
        }

        if(pass) {
            ele("login_form").submit();
        }
    }
)

// Login on ENTER
ev("password", "keyup", function() {
    if(event.keyCode == 13) {
        ele("form_button").click();
    }
})
