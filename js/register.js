/**
 * Created by sven.bautz on 19/05/15.
 */
function startPage(){

    $('#input_d').click(registerClicked);

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


$(document).ready(startPage)