function submit() {
    $.post("login.php", { command: 'login', username: $("#username").val(), 'password': $("#password").val() })
    .done(function(response) {
        response = JSON.parse(response);
        $("#response").html(response.message);
        if (response.url) {
            window.location.href = response.url + "?authToken=" + response.authToken;
        }
    });
}
$.post("login.php", { command: 'get_recent' })
.done(function(response) {
    _.each(JSON.parse(response).list, function(handle) {
        $("#recentUsers").append('<p>' + handle.handle + "</p>");
    });
});

function authTokenLogin(authToken) {
    $.post("login.php", { command: 'login', authToken: authToken })
    .done(function(response) {
        response = JSON.parse(response);
        $("#response").html(response.message);
        if (response.url) {
            window.location.href = response.url + "?authToken=" + response.authToken;
        }
    });
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