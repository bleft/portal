/**
 * Created by sven.bautz on 19/05/15.
 */


function startPage(){
    isLoggedIn();

}

function loadPageStart(){

    printLanBox();
    enableChatterBox();
    loadChatterBox();

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

function printLanBox(){

    $.post('ajax/getactivelan.php', null, null, 'json')
        .done(function (result) {

            if (!result.result){
                text += " KEINE LAN????";
                lankopf.text(text);
            } else {
                var lan = result.result;
                $("#lantitel")[0].innerHTML =  lan.BEZEICHNER;
                $("#lanveranstalter")[0].innerHTML =  "bei " + lan.VERANSTALTER;
                $("#lanbeschreibung")[0].innerHTML =  lan.BESCHREIBUNG;
                $("#lanbanner")[0].innerHTML = "<img src=\"" + lan.BANNERLINK + "\" alt=\"Banner\">";
                var mapLink = "<a href=\"" + lan.MAPLINK + "\"> schau wo auf: GOOGLE MAPS </a>";
                $("#lanadresse")[0].innerHTML = lan.STREET + "<br>" + lan.ZIPCODE + " " + lan.CITY + "<br>" + mapLink;
                setTeilnehmenButton();
            }

        })
}

function setTeilnehmenButton(){

    var teilnehmenButton = $("#teilnehmen")[0];

    $.post('ajax/isAttendie.php', null, null, 'json')
        .done(function (result) {
            if (!result.result){
                teilnehmenButton.innerHTML = "<input type='button' id='subscripeButton' value='Teilnehmen'>";
                $('#subscripeButton').click(teilnehmen);
            } else {
                teilnehmenButton.innerHTML = "<input type='button' id='subscripeButton' value='Absagen!'>";
                $('#subscripeButton').click(absagen);
            }
        })
        .fail(function (err) {

        })
}

function teilnehmen(){
    $.post('ajax/subscripeToActiveLan.php', null, null, 'json' )
        .done(function (result) {
            setTeilnehmenButton();
        })
        .fail(function (err){
            //
        });
}


function absagen(){
    $.post('ajax/removeFromActiveLan.php', null, null, 'json' )
        .done(function (result) {
            setTeilnehmenButton();
        })
        .fail(function (err){
            //
        });
}


function enableChatterBox(){
    $('#chatsend').click(chatterBoxInsertEntry);
    $('#chatreload').click(loadChatterBox);
}

function chatterBoxInsertEntry(){
    var postdata = {};
    var text = encodeURI($("#chattext").val());
    postdata.text = text.replace(/\?/g,'&#63;');

    $.post('ajax/insertchatentry.php', JSON.stringify(postdata), null, 'json' )
        .done(function (result) {
            $("#chattext").val("");
            loadChatterBox();
        })
        .fail(function (err){
            //
        });

}

function loadChatterBox(){

    var chatbox =  $('#chatterboxcontent')[0];
    var chatterboxtext = "";

    $.post('ajax/getchatentries.php', null, null, 'json')
        .done (function (result) {

        var entries = result.result;

        if (entries) {

            $.each(entries, function(index, value) {
                var date = timeConverter(value.TIMESTAMP);
                var text = decodeURI(value.TEXT);
                var pattern = /<|>/g;
                var line = "<div id=\"chatentrykopf\">" + value.AUTOR.replace(pattern,'') + " sagt: (" + date + ")</div>";
                line += "<div id='chatentry'>" + text + "</div> ";
                chatterboxtext += line;
            });

            chatbox.innerHTML = chatterboxtext;
        }

    });
}


function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp*1000);
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var year = a.getFullYear();
    var month = months[a.getMonth()];
    var date = a.getDate();
    var hour = a.getHours();
    var min = a.getMinutes();
    var sec = a.getSeconds();
    var time = date + ',' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
    return time;
}

$(document).ready(startPage)