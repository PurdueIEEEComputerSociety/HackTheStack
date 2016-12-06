function submit() {
    $.post("login.php", { command: 'login', username: $("#username").val(), 'password': $("#password").val() })
    .done(function(response) {
        response = JSON.parse(response);
        $("#response").html(response.message);
        if (response.url) {
            console.log(response);
            window.location.href = response.url + "?authToken=" + response.authToken;
        }
    });
}
$.post("login.php", { command: 'get_recent' })
.done(function(response) {
    _.each(JSON.parse(response).list, function(handle) {
        $("#recentUsers").append('<p>' + handle.handle + "</p>");
    });
    console.log(response);
});

function authTokenLogin() {

}

function createUser() {
    var username = $("#username_c").val();
    var password = $("#password_c").val();
    var handle = $("#handle_c").val();
    if (_.isEmpty(username) || _.isEmpty(password) || _.isEmpty(handle)) {
        return;
    }
    $.post("login.php", { command: 'create_user', username: username, password: password, handle: handle })
    .done(function(response) {
        $("#response").html(JSON.parse(response).message);
    });            
}

function setCookie(cname, cvalue, hourDuration) {
    var d = new Date();
    d.setTime(d.getTime() + (hourDuration*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}