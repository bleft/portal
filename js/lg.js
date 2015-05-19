/**
 * Created by sven.bautz on 19/05/15.
 */

function startPage(){
    $('#input_login').click(loginClicked);
    $('#input_register').click(registerClicked);
}

function loginClicked(){
    var name = $('#input_name').val();
    var pswd = $('#input_password').val();
    var md5psdw = $.md5(pswd);
    login(name, md5psdw);
}


function login(name, pswd){
    // erwartet md5 pswd
    var postdata = {};
    postdata.name = name;
    postdata.pswd = pswd;

    $.post('ajax/login.php', JSON.stringify(postdata), null, 'json')
        .done(function (result) {
            window.open("start.html","_self");
        })
        .fail(function (err){
            alert('Fehler aufgetreten');
            window.open("index.html", "_self");
        });
}



function registerClicked(){

    var name = $('#input_a').val();
    var pswd = $.md5($('#input_b').val());
    var mail = $('#input_c').val();

    registerUser(name, pswd, mail);

}


function registerUser(name, pswd, mail){

    var postdata = {};
    postdata.name = name;
    postdata.pswd = pswd;
    postdata.email = mail;

    $.post('ajax/register.php', JSON.stringify(postdata), null, 'json')
        .done(function (result) {
            window.open("index.html","_self");
        })
        .fail(function (err){
            alert('Fehler aufgetreten');
        });
}

$(document).ready(startPage);