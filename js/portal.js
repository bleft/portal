/**
 * Created by sven.bautz on 19/05/15.
 */


function startPage(){

    isLoggedIn();
}


function logout(){

    window.open("php/logout.php");

}


function isLoggedIn(){

    $.post('ajax/loggedIn.php', null, null, 'json')
        .done(function (result) {
            if (!result.result){
                window.open("index.html", "_self");
            }
            var loginbox = $('#loginbox');
            loginbox.text("Hallo " + result.result);
            loginbox.click(logout);
        })
        .fail(function (err){
            window.open("index.html", "_self");
        });
}

$(document).ready(startPage)