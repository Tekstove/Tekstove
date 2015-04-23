/*
 * a lot of shitty code...
 * if u are just checking how look site code, please check somewhere else
 *
 */
// browse.php da ne dava greshki

var video_link = null;
var video_metacafe = null;
var video_vbox = null;
var video_youtube = null;
// krai da ne dava gre6ki


function showTranslation() {
    $("#text_bg_show").html("");

    $("#text_bg").slideDown(2500);

    var lyricTranslatedHtml = $("#text_bg").html();
    var lyricTranslatedHtmlHardWhitespace = lyricTranslatedHtml.replace(/ /g, "&nbsp;");
    $("#text_bg").html(lyricTranslatedHtmlHardWhitespace + "<br><hr width=\"100%\">");
    var lyricHtml = $("#text_glaven").html();
    var lyricHtmlHardWhitespace = (lyricHtml.replace(/ /g, "&nbsp;"));
    $("#text_glaven").html(lyricHtmlHardWhitespace + "<br><hr width=\"100%\">");
    document.location.href = "#prevod";

}
// ----------------------- НАЧАЛО ЛЮБИМИ
var links = new Array(
    " ",
    "Песента успешно добавена.",
    "Песента успешно изтрита.",
    "За да добавите песента в Любими , трябва да <a href=/login.php\">Влезете в профила си. <b>Вход</b><\/a>",
    "Песента е вече в любими",
    "песента не е намерена в Любими"
    );
function update_liubimi(show,id) {
    $('#syob6tenie').html(links[parseInt(show)]);
    // 1 or 4 .... I have no idea what it mean.
    // @TODO refactor ASAP !!!
    if ((show == 1) || (show == 4)) {
        $('#liubimi').html("<a href=\"#\" onCLick=\"javascript:liubimi_add_remove('remove'," + id + ");return false;\" title=\"Изтрий от Любими\">Изтрий от Любими</a>");
    } else {
        $('#liubimi').html("<a href=\"#\" onCLick=\"javascript:liubimi_add_remove('add'," + id + ");return false;\" title=\"Добави към Любими\">Добави към Любими</a>");
    }
}


function liubimi_add_remove(action, id) {
    $("#syob6tenie").html("Зареждане ....");
    if (action !== "add") {
        action = "remove";
    }
    $.ajax({
        type: "POST",
        url: "ajax/liubimi.php",
        data: {
            id: id,
            action: action
        },
        cache: false,
        success: function(message) {
            update_liubimi(message, id);
        }
    });
}
// КРАЙ ЛЮБИМИ

// ----------------------- НАЧАЛО ГЛАСУВАНЕ

function glasuvai(id) {
    $("#glasuvane").html("....");
    $.ajax({
        type: "GET",
        url: "ajax/browse_glasuvai.php",
        data: "id="+id,
        cache: false,
        success: function(message) {
            $("#glasuvane").html(message);
        }
    });

}
// КРАЙ ГЛАСУВАНЕ


function albumShowVideo(video, type) {
    
    // @TODO switch
    
    if (type === 1) {
        video = videoVbox(video, 1);
    }
    if (type === 2) {
        video = videoYouTube(video, 1);
    }

    $("#video").html(video);
}



function browseShowCensoredLyric() {
    $("#browse_tekst_buton").toggle();
    $("#browse_tekst").toggle(2500);
}


function smeni_video(where) {
    // @TODO switch
    if (where == 1) {
        $('#video').html(videoVbox(video_vbox, 1));
    }
    else if (where == 2 ){
        $('#video').html(videoYouTube(video_youtube, 1));
    }
    else if (where == 3){
        $('#video').html(video_link);
    }
    else if (where == 4){
        $('#video').html('<embed flashVars="playerVars=showStats=no|autoPlay=yes|videoTitle="src="'+video_metacafe+'"width="498" height="423" wmode="transparent" allowFullScreen="true" allowScriptAccess="always"pluginspage="http://www.macromedia.com/go/getflashplayer"type="application/x-shockwave-flash"></embed>');
    }
}



function  showHint(koe, stranica) {

    var tekst = $('#artist' + koe + '_tarsene').val();

    $.ajax({
        url: "/ajax/uploadliryc_artists_filter.php",
        type: "GET",
        data: {
            filter: tekst,
            kyde: koe,
            stranica: stranica
        },
        success: function(msg) {

            // search changed before ajax is recived
            if ($('#artist' + koe + '_tarsene').val() !== tekst) {
                return false;
            }

            if (msg.length > 10) {
                $('#artist' + koe + '_ajax').html(msg);
            } else {
                // font-color ... kill me
                $('#artist' + koe + '_ajax').html('<font color="red">Няма намерени резултати</font>');
            }

        }
    });

}

// Izberi_Artist Prepishi_Koda
function Izberi_Artist(id, kyde, name) {
    $('#artist' + kyde + '_name').val(name);
    document.getElementById('artist' + kyde).value = id;

    document.getElementById('artist' + kyde + '_ajax').innerHTML = '';
}



// holy shit!!!!
function value_smqna(id, value) {
    $('#' + id).val(value);

}

// @TODO {}{}{}{}{}{}
function browse_problem(a) {
    if (a == 'Видеото не работи') {
        if (video_vbox) {
            smeni_video(1);
        } else if (video_youtube) {
            smeni_video(2);
        } else if (video_metacafe) {
            smeni_video(4);
        }
        alert('Състемата ще пробва да оправи проблема автоматично, моля изчакайте 15 секунди преди да изпратите съобщението');
    }

    $('#browse_problemi').html('Подробности<br><textarea cols="10" rows="5" id="browse_problem"></textarea><br><input type="button" value="изпрати" onclick="browse_problem_ajax(\'' + a + '\');">');
    return false;
}

function browse_problem_ajax(a) {
    if (!$('#browse_problem').val()) {
        alert('Трябва да въведете какъв е проблема');
    } else {
        $.ajax({
            url: "ajax/browse_problem.php",
            type: "GET",
            data: {
                // @TODO RE\nWRITE
                problem: a + '\n\n' + $('#browse_problem').val(),
                url: tekushta_stranica,
                lyric_id: pesen_id
            },
            success: function() {
                $('#browse_problemi').html('Благодарим, ще прегледаме за проблема');
            }
        });
    }
}


function koi_e_glasuval(start) {
    $('#browse_koi_e_glasuval').html('');
    $('#koi_e_glasuval_link_stranicirane').remove();

    $.ajax({
        url: "ajax/browse_koi_e_glasuval.php",
        type: "GET",
        data: {
            id: pesen_id,
            start: start
        },
        success: function(msg) {
            $('#koi_e_glasuval_div_ajax').html($('#koi_e_glasuval_div_ajax').html() + '<hr>' + msg);
        }
    });



    return false;
}










var emot_icons_id = new Array();
var emot_icons_code = new Array();
var emot_icons_code_regular = new Array();

emot_icons_id.push('1.gif');
emot_icons_code.push(':)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\:\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('2.gif');
emot_icons_code.push('(kitara)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(kitara\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('3.gif');
emot_icons_code.push('(dance)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('4.gif');
emot_icons_code.push('(svirq)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(svirq\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('7.gif');
emot_icons_code.push('(ogan4e)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(ogan4e\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('8.gif');
emot_icons_code.push('(rock)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(rock\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('9.gif');
emot_icons_code.push('(slu6alki)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(slu6alki\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('10.gif');
emot_icons_code.push('(skasetofon)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(skasetofon\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('11.gif');
emot_icons_code.push('(?)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(\?\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('12.gif');
emot_icons_code.push('(:P)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(\:P\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('5.gif');
emot_icons_code.push('(party)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(party\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('14.gif');
emot_icons_code.push('(dance3)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance3\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('13.gif');
emot_icons_code.push('(dance2)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance2\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('15.gif');
emot_icons_code.push('(barabani)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(barabani\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('16.gif');
emot_icons_code.push('(arfa)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(arfa\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('17.gif');
emot_icons_code.push('(radost)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(radost\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('18.gif');
emot_icons_code.push('(peq)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(peq\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('19.gif');
emot_icons_code.push('(dance4)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance4\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('20.gif');
emot_icons_code.push(':*');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\:\*(\s|\n|\<br\>|$)/img);

emot_icons_id.push('21.gif');
emot_icons_code.push(':D');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\:D(\s|\n|\<br\>|$)/img);

emot_icons_id.push('22.gif');
emot_icons_code.push('(hug)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(hug\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('23.gif');
emot_icons_code.push('(snow)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(snow\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('24.gif');
emot_icons_code.push('(bored)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(bored\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('25.gif');
emot_icons_code.push('(sorry)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(sorry\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('26.gif');
emot_icons_code.push('(bow)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(bow\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('27.gif');
emot_icons_code.push('(action)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(action\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('28.gif');
emot_icons_code.push('(bg)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(bg\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('29.gif');
emot_icons_code.push('(inbottle)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(inbottle\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('30.gif');
emot_icons_code.push('(sleep)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(sleep\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('31.gif');
emot_icons_code.push('(missya)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(missya\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('32.gif');
emot_icons_code.push('(cry)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(cry\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('33.gif');
emot_icons_code.push('(love_date)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(love_date\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('34.gif');
emot_icons_code.push('(shame)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(shame\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('35.gif');
emot_icons_code.push('(rr)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(rr\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('36.gif');
emot_icons_code.push('(sunny)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(sunny\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('37.gif');
emot_icons_code.push('(duck)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(duck\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('39.gif');
emot_icons_code.push('(dance6)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance6\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('40.gif');
emot_icons_code.push('(reading)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(reading\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('41.gif');
emot_icons_code.push('(bow_to_the_ground)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(bow_to_the_ground\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('42.gif');
emot_icons_code.push('(angry)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(angry\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('43.gif');
emot_icons_code.push('(dance7)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance7\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('44.gif');
emot_icons_code.push('(wutwutwut)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(wutwutwut\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('45.gif');
emot_icons_code.push('(dance8)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(dance8\)(\s|\n|\<br\>|$)/img);

emot_icons_id.push('46.gif');
emot_icons_code.push('(facepalm)');
emot_icons_code_regular.push(/(\s|\n|\<br\>|^)\(facepalm\)(\s|\n|\<br\>|$)/img);

var bb_code_pattern = new Array();
var bb_code_replacement = new Array();

bb_code_pattern.push(/\r?\n|\r|\n/g);
bb_code_replacement.push("<br>");

bb_code_pattern.push(/\[quote\](.*?)\[\/quote\]/gmi);
bb_code_replacement.push('<div class="bbcode_quote">$1</div>');

bb_code_pattern.push(/\[b\](.*?)\[\/b\]/gmi);
bb_code_replacement.push("<b>$1</b>");

bb_code_pattern.push(/\[u\](.*?)\[\/u\]/img);
bb_code_replacement.push("<u>$1</u>");

bb_code_pattern.push(/\[i\](.*?)\[\/i\]/img);
bb_code_replacement.push("<i>$1</i>");

bb_code_pattern.push(/\[url\=http([абвгдежзийклмнопрстуфхцчшщъьюяАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЮЯa-zA-Z0-9#\!\:\=\_\-\?\&\;\%\/\.\?\+\(\)]+)\](.*?)\[\/url\]/img);
bb_code_replacement.push('<a href="http$1" target="_blanc"><u>$2</u></a>');

bb_code_pattern.push(/\[img\]http([абвгдежзийклмнопрстуфхцчшщъьюяАБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЬЮЯa-zA-Z0-9#\:\=\_\-\?\&\;\%\/\.\?\+\(\)]+)\[\/img\]/img);
bb_code_replacement.push('<img class="bbcode_image" src="http$1">');

bb_code_pattern.push(/\[color\=(\#[0123456789abcdef]{6})\](.+?)\[\/color\]/img);
bb_code_replacement.push('<span style="color: $1">$2</span>');

bb_code_pattern.push(/\[youtube\].*v\=([a-zA-Z0-9_\-]+).*\[\/youtube\]/img);
bb_code_replacement.push('<iframe title="YouTube video player" width="480" height="390" src="http://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe>');


for(i = 0 ; i < emot_icons_id.length ; i ++) {
    bb_code_pattern.push(emot_icons_code_regular[i]);
    bb_code_replacement.push('$1<img src="/emic/'+emot_icons_id[i]+'">$2');
}







function bbemic_show(vsi4ki) {
    var bbcode_htmlcode = "";




    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/1.gif' ALT=':)' onClick=\"javascript:emot_icons(':)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/2.gif' ALT='(kitara)' onClick=\"javascript:emot_icons('(kitara)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/3.gif' ALT='dance' onClick=\"javascript:emot_icons('(dance)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/4.gif' ALT='svirq' onClick=\"javascript:emot_icons('(svirq)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/7.gif' ALT='ogan4e' onClick=\"javascript:emot_icons('(ogan4e)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/8.gif' ALT='rock' onClick=\"javascript:emot_icons('(rock)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/9.gif' ALT='slu6alki' onClick=\"javascript:emot_icons('(slu6alki)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/10.gif' ALT='skasetofon' onClick=\"javascript:emot_icons('(skasetofon)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/11.gif' ALT='(?)' onClick=\"javascript:emot_icons('(?)',this)\";\">";
    bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/12.gif' ALT='(?)' onClick=\"javascript:emot_icons('(:P)',this)\";\">";


    if (!vsi4ki) {
        bbcode_htmlcode=bbcode_htmlcode+'<span style="font-size:20px;"><a href="#" onclick="bbemic_show(1);return false"> още емотикони </a></span>';
    } else {

        bbcode_htmlcode=bbcode_htmlcode+"<br><img src='/emic/5.gif' ALT='party' onClick=\"javascript:emot_icons('(party)',this)\";\">";
        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/13.gif' ALT='(dance2)' onClick=\"javascript:emot_icons('(dance2)',this)\";\">";
        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/14.gif' ALT='(dance3)' onClick=\"javascript:emot_icons('(dance3)',this)\";\">";
        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/15.gif' ALT='(dance)' onClick=\"javascript:emot_icons('(barabani)',this)\";\">";
        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/16.gif' ALT='(dance)' onClick=\"javascript:emot_icons('(arfa)',this)\";\">";

        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/17.gif' ALT='(radost)' onClick=\"javascript:emot_icons('(radost)',this)\";\">";
        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/18.gif' ALT='(peq)' onClick=\"javascript:emot_icons('(peq)',this)\";\">";
        bbcode_htmlcode=bbcode_htmlcode+"<img src='/emic/19.gif' ALT='(dance4)' onClick=\"javascript:emot_icons('(dance4)',this)\";\">";



    }


    $('#bbcode_emic').html(bbcode_htmlcode);
}

function emot_icons(code,element) {

    if (element) {
        element.style.display = 'none';
    }

    var myElement = $('#bbcode_input');

    if (myElement.length == 0) {
        myElement=$('#chat_text');
    }

    myElement.val(myElement.val() + ' ' + code + ' ');


    myElement.focus();
}


function bb_code_show_picker() {

    $('#bb_code_color_picker').toggle(300);
    return;

    // a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
    $( "#bb_code_color_picker" ).dialog( "destroy" );

    $( "#bb_code_color_picker" ).dialog({
        height: 250,
        width: 550,
        modal: false,
        dialogClass: 'dialogColorPicker'
    });

}


function hexFromRGB(r, g, b) {
    var hex = [
    r.toString( 16 ),
    g.toString( 16 ),
    b.toString( 16 )
    ];
    $.each( hex, function( nr, val ) {
        if ( val.length === 1 ) {
            hex[ nr ] = "0" + val;
        }
    });
    return hex.join( "" ).toUpperCase();
}
function refreshSwatch() {
    var red = $("#red" ).slider( "value" ),
    green = $( "#green" ).slider( "value" ),
    blue = $( "#blue" ).slider( "value" ),
    hex = hexFromRGB( red, green, blue );
    $( "#swatch" ).css( "background-color", "#" + hex );
    $( "#bb_code_color_current" ).css( "background-color", "#" + hex );
    $( "#bb_code_color" ).val( "#" + hex );


}



function bb_butoni() {

    var bbcode_htmlcode = '';
    bbcode_htmlcode+='<input type="button" style="font-size: 13px;font-weight:bold;" onclick="bbcode(3);" value="B" />';
    bbcode_htmlcode+='<input type="button" style="font-size: 13px;text-decoration:underline;" onclick="bbcode(4);" value="U" />';
    bbcode_htmlcode+='<input type="button" style="font-size: 13px;font-style:italic;" onclick="bbcode(5);" value="I" />';
    bbcode_htmlcode+='<input type="button" style="font-size: 13px;" onclick="bbcode(2);" value="линк" />';
    bbcode_htmlcode+='<input type="button" style="font-size: 13px;" onclick="bbcode(1);" value="img" />'+
    '<input type="button" style="font-size: 13px;" onclick="bbcode(7);" value="youtube" />'+
	'<input type="button" style="font-size: 13px;" onclick="bbcode(8);" value="цитат" />'+
    '<input type="button" style="font-size: 13px;" onclick="bbcode(6);" value="оцвети" />'+
    '<span onclick="bb_code_show_picker()" id="bb_code_color_current" style="cursor: pointer">&nbsp;&nbsp;&nbsp;</span>'+
    '<input id="bb_code_color" type="hidden" value="#000000">'+
    '<div id="bb_code_color_picker" title="Цвят" style="display:none;">'+

    '<div id="red"></div>'+
    '<div id="green"></div>'+
    '<div id="blue"></div>'+

    '<div id="swatch" class="ui-widget-content ui-corner-all"></div>'+

    '<a href="#" onclick="$(\'#bb_code_color_picker\').toggle(0);return false;">затвори</a>'+
    '</div>'+
    '<br clear="all">';



    $('#bbcode_butoni').html(bbcode_htmlcode);

    $( "#red, #green, #blue" ).slider({
        orientation: "horizontal",
        range: "min",
        max: 255,
        value: 127,
        slide: refreshSwatch,
        change: refreshSwatch
    });
    $( "#red" ).slider( "value", 0 );
    $( "#green" ).slider( "value", 0 );
    $( "#blue" ).slider( "value", 0 );





		


	

}

function bbcode (number){
    function smart_bbcode(t1,t2){

        var textarea = $("#bbcode_input");
        textarea = textarea[0];

        if (textarea == undefined) {
            textarea = $('#chat_text');
            textarea = textarea[0];
        }


        var len = textarea.value.length;
        var start = textarea.selectionStart;
        var end = textarea.selectionEnd;
        var sel = textarea.value.substring(start, end);

        if( (end-start) >0){
            var replace = t1 + sel + t2;
            textarea.value = textarea.value.substring(0,start) + replace + textarea.value.substring(end,len);
        }

        else emot_icons(t1+t2);

    } //smartbb

    var bba = null;
    var bbb = null;

    switch (number) {
        case 1:
            bba = prompt('линк към картинката');
            if (bba) {
                emot_icons('[img]'+bba+'[/img]');
            }
            break;

        case 2:
            bba = prompt('Линк','http://');
            if(bba) bbb = prompt('Текст към линка');
            if(bbb) emot_icons('[url='+bba+']'+bbb+'[/url]');
            break;

        case 3:
            smart_bbcode('[b]','[/b]');
            break;

        case 4:
            smart_bbcode('[u]','[/u]');
            break;

        case 5:
            smart_bbcode('[i]','[/i]');
            break;

        case 6:
            smart_bbcode('[color=' + $('#bb_code_color').val() + ']','[/color]');
            break;
        case 7:
            var ytube = prompt('линк на видеото');
            if(ytube)
            {
                emot_icons('[youtube]'+ytube+'[/youtube]');
            }
            break;
		case 8:
			smart_bbcode('[quote]','[/quote]');
			break;
        default:
            emot_icons(number);
            break;
                        
            return false;

			
    }

    $("#bbcode_input").focus();


} // bbcode






function bbcode_make(text){

    for(var i = 0 ; i < bb_code_pattern.length ; i++ ) {
        text = text.replace(bb_code_pattern[i], bb_code_replacement[i] );
        text = text.replace(bb_code_pattern[i], bb_code_replacement[i] ); // fix 2 emoticons in row, bug
    }

    return text;

}






// =======================================================================================================

function videoMetacatfe(link, autoplay)
{
    var html_video = '<embed flashVars="playerVars=showStats=no|autoPlay=';
    if (autoplay) {
        html_video += 'Yes';
    } else {
        html_video += 'No';
    }
    html_video += '|videoTitle="src="'+link+'"width="498" height="423" wmode="transparent" allowFullScreen="true"';
    html_video += 'allowScriptAccess="always"pluginspage="http://www.macromedia.com/go/getflashplayer"';
    html_video += 'type="application/x-shockwave-flash"></embed>';
                
    return html_video;
}

function videoVbox(link, autoplay)
{
    var html = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\"";
    html += 'width="450" height="403"><param name="movie" value="http://i47.vbox7.com/player/ext.swf?vid='+video_vbox;
    if (autoplay) {
        html += '&autoplay=1';  
    }
        
    html += '"><param name="quality" value="high"><embed src="http://i47.vbox7.com/player/ext.swf?vid='+link;
    if(autoplay) {
        html += '&autoplay=1';  
    }
    html +='" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"';
    html += 'width="450" height="403"></embed></object>';
        
    return html;

}

function videoYouTube(link, autoplay)
{
    
    var html = '';
 
    html += '<iframe title="YouTube video player" width="480" height="390" src="http://www.youtube.com/embed/' + link;
    if (autoplay) {
        html += "?autoplay=1";
    }
    html += '" frameborder="0" autoplay="1" allowfullscreen></iframe>';
    
    return html;
    
    
}

$(function () {
    var bukvi=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y',
    'Z','1','2','3','4','5','6','7','8','9','А','Б','В','Г','Д','Е','Ж','З','И','Й','К','Л','М','Н','О','П',
    'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ь','Ю','Я'];
    var w = '', q;

    for (q = 0; q <= 25; q++) {
        w += '<a href="/browsepobukva.php?bukva=' + bukvi[q] + '">&nbsp;' + bukvi[q] + '&nbsp;</a>&nbsp;';
    }

    w += '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="browsepobukva.php?bukva=10">&nbsp;0&nbsp;</a>&nbsp;';

    for (q = 26; q <= 34; q++) {
        w += '<a href="/browsepobukva.php?bukva=' + bukvi[q] + '">&nbsp;' + bukvi[q] + '&nbsp;</a>&nbsp;';
    }
    w += '&nbsp;&nbsp;<a href="/browsepobukva.php?bukva=11">&nbsp;#&nbsp;</a>&nbsp;<br>';
    for (q = 35; q <= 64; q++) {
        w += '<a href="/browsepobukva.php?bukva=' + bukvi[q] + '">&nbsp;' + bukvi[q] + '&nbsp;</a>&nbsp;';
    }

    $('#bukvi_bg').html(w);



    $('#browse_problemi').html('<a href="#" onclick="browse_problem(\'Видеото не работи\');return false;">Видеото не работи ?</a><br><a href="#" onclick="browse_problem(\'Грешен текст\');return false;">Грешен текст</a><br><a href="#" onclick="browse_problem(\'Грешен превод\');return false;"> или грешен превод?</a>');



    bb_butoni();
    bbemic_show();
    $("button, input:button").button();





    // =============== browse autovideo
    if (video_link) {
        $('#video').html("<a href=\""+video_link+"\" target=\"_blank\">"+video_link+"</a>");
        $('#video_butoni').append("<input type=\"button\" value=\"link\" onclick=\"smeni_video(3)\">");
    }


    if (video_metacafe) {
        $('#video').html(videoMetacatfe(video_metacafe, video_autoplay));
        $('#video_butoni').append("<input type=\"button\" value=\"metacafe\" onclick=\"smeni_video(4)\">");

    }


    if (video_vbox)	{
        $('#video').html(videoVbox(video_vbox, video_autoplay));
        $('#video_butoni').append("<input type=\"button\" value=\"vbox7\" onclick=\"smeni_video(1)\">");
    }



    if (video_youtube) {
        $('#video').html(videoYouTube(video_youtube, video_autoplay));
        $('#video_butoni').append("<input type=\"button\" value=\"youtube\" onclick=\"smeni_video(2)\">");
    }




    //----------------- browse autovideo



    $("#blqv_menu_extra_show").click( function() {
        $(this).slideUp(500, function(){

            $('#blqvo_menu_extra').slideDown(1500);
            
        });
        
        return false;
    });


    if (navigator.appName.match(/^(netscape|microsoft internet explorer)$/i)) {

        /* Unsupported list :
		 * Opera
		 *
		 */

        $('.textarea_resizable , #chat_frame').resizable({
            minHeight: 100,
            minWidth: 100,
			alsoResize: ".textarea_sync_resize"
        });

    }
	
	$('textarea').attr('wrap','off');

   // $('#top_menu_chat').effect( 'pulsate', 500 );



    if ($('.bb_code_text').length > 0) { // if there is an element
        $('.bb_code_text').each(function(){

            for(var i = 0 ; i <= bb_code_pattern.length ; i++ ) {
                //$(this).html(  $(this).html().replace(bb_code_pattern[i], bb_code_replacement[i] ) );
                $(this).html(bbcode_make($(this).html()));
            }



        //    $(this).html(  bbcode($(this).html())  );
        });
    }


	$('.tooltip').tooltip({
		track: true
	});

}); // =============================================================================================





function porfile_izprateni_pesni(id, ot_pesen) {

    $('#profile_izprateni_tekstove_menu').html('Зареждам....');

    function parseXml(xml)
    {
        $(xml).find("pesen").each(function() {
            var id =  $(this).attr("id");
            var ime = $(this).attr("ime");

            if (id != '#') {
                $("#profile_izprateni_tekstove").append('<a href="browse.php?id='+id+'">'+ime+'</a><br>');
            } else {
                $("#profile_izprateni_tekstove").append('Няма изпратени песни');
            }
        });
        var link_za_oshte = $(xml).find("link_oshte").attr('nomer');
        if (link_za_oshte) {
            $('#profile_izprateni_tekstove_menu').html('<br><a href="#" onclick="porfile_izprateni_pesni('+id+','+link_za_oshte+');return false;"><b>Още текстове</b></a><br><br>');
        } else {
            $('#profile_izprateni_tekstove_menu').html('<br>');
        }

    }


    $.ajax({
        type: "GET",
        url: "ajax/profile_posledni_pesni.php",
        data:"id="+id+'&start='+ot_pesen,
        dataType: "xml",
        success: parseXml
    });



} // function porfile_izprateni_pesni(id, ot_pesen)




function porfile_posledni_glasa(id, ot_pesen){

    $('#profile_posledno_glasuvani_menu').html('Зареждам....');

    function parseXml(xml)
    {
        $(xml).find("pesen").each(function()
        {
            var id =  $(this).attr("id");
            var ime = $(this).attr("ime");

            if (id != '#') {
                $("#profile_posledno_glasuvani").append('<a href="browse.php?id='+id+'">'+ime+'</a><br>');
            } else {
                $("#profile_posledno_glasuvani").append('Не е гласувал');
            }



        });
        var link_za_oshte = $(xml).find("link_oshte").attr('nomer');
        if (link_za_oshte) {
            $('#profile_posledno_glasuvani_menu').html('<br><a href="#" onclick="porfile_posledni_glasa(' + id + ',' + link_za_oshte + ');return false;"><b>Още гласове</b></a><br><br>');
        } else {
            $('#profile_posledno_glasuvani_menu').html('<br>');
        }

    }


    $.ajax({
        type: "GET",
        url: "ajax/profile_posledni_glasa.php",
        data: {
            id: id,
            start: ot_pesen
        },
        dataType: "xml",
        success: parseXml
    });



} //  function porfile_posledni_glasa(id, ot_pesen)




function porfile_posledni_komentara(id, ot_pesen){

    $('#profile_posledno_komentara_menu').html('Зареждам....');

    function parseXml(xml)
    {
        $(xml).find("pesen").each(function(){
            var id =  $(this).attr("id");
            var ime = $(this).attr("ime");
            var text = $(this).find('komentar').text();

            if( id != '#') {
                $("#profile_posledno_komentara").append(text+'<br> за песен: <a href="browse.php?id='+id+'"><b>'+ime+'</b></a><hr>');
            } else {
                $("#profile_posledno_komentara").append('Няма коментари');
            }

        });
        var link_za_oshte = $(xml).find("link_oshte").attr('nomer');
        if(link_za_oshte) {
            $('#profile_posledno_komentara_menu').html('<br><a href="#" onclick="porfile_posledni_komentara('+id+','+link_za_oshte+');return false;"><b>Още коментара</b></a><br><br>');
        } else {
            $('#profile_posledno_komentara_menu').html('<br>');
        }

    }


    $.ajax({
        type: "GET",
        url: "ajax/profile_posledni_komentara.php",
        data:"id="+id+'&start='+ot_pesen,
        dataType: "xml",
        success: parseXml
    });



} //  function porfile_posledni_komentara





function porfile_posledni_postove(id, ot_pesen){

    $('#profile_posledno_postove_menu').html('Зареждам....');

    function parseXml(xml)
    {
        $(xml).find("pesen").each(function(){
            var id =  $(this).attr("id");
            var ime = $(this).attr("ime");
            var text = $(this).find('post').text();

            if (id != '#') {
                $("#profile_posledno_postove").append(text+'<br> в тема: <a href="forum_topic_vij.php?id='+id+'"><b>'+ime+'</b></a><hr>');
            } else {
                $("#profile_posledno_postove").append('Няма форум съобщения');
            }
        });
        var link_za_oshte = $(xml).find("link_oshte").attr('nomer');
        if( link_za_oshte ) $('#profile_posledno_postove_menu').html('<br><a href="#" onclick="porfile_posledni_postove('+id+','+link_za_oshte+');return false;"><b>Още постове</b></a><br><br>');
        else $('#profile_posledno_postove_menu').html('<br>');

    }


    $.ajax({
        type: "GET",
        url: "ajax/profile_posledni_postove.php",
        data:"id="+id+'&start='+ot_pesen,
        dataType: "xml",
        success: parseXml
    });



} //  function porfile_posledni_postove



function porfile_prevodi(id, ot_pesen){

    $('#profile_prevodi_menu').html('Зареждам....');

    function parseXml(xml)
    {
        $(xml).find("pesen").each(function()
        {
            var id =  $(this).attr("id");
            var ime = $(this).attr("ime");
            var text = $(this).find('post').text();

            if( id != '#') $("#profile_prevodi").append(text+'<br><a href="ajax/__prevod.php?id='+id+'" onclick="window.open(\'ajax/__prevod.php?id='+id+'\',\'превод\',\'width=700,height=700,toolbar=no,location=yes,status=no,menubar=no,scrollbars=yes\');return false;"><b>&nbsp;'+ime+'</b></a>');
            else $("#profile_prevodi").append('Няма преводи');



        });
        var link_za_oshte = $(xml).find("link_oshte").attr('nomer');
        if( link_za_oshte ) $('#profile_prevodi_menu').html('<br><a href="#" onclick="porfile_prevodi('+id+','+link_za_oshte+');return false;"><b>Още преводи</b></a><br><br>');
        else $('#profile_prevodi_menu').html('<br>');

    }


    $.ajax({
        type: "GET",
        url: "ajax/profile_prevodi.php",
        data:"id="+id+'&start='+ot_pesen,
        dataType: "xml",
        success: parseXml
    });



} //  function porfile_prevod





function browse_deleted_show_info(id){

    $('#browse_deleted_details_'+id).slideDown(2000);

}


/**
 * class
 */
function User(data) {
	this.id = data.id;
	this.name = data.name;
	
	this.getId = function(){
		return this.id;
	};
	
	this.getProfileLink = function() {
		var link = '';
		if (this.id) {
			link += '<a href="/profile.php?profile=' + this.id + '" target="_blank">';
		}
		
		link += this.name;
		
		if (this.id) {
			link += '</a>';
		}
		return link;
	};
}