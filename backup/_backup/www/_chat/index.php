<?php
require '../__top.php';
require SITE_PATH_TEMPLATE . '__top_small.php';
?>

<style type="text/css">

    .message {
        border-width: 1px 0 0 0;
        border-style: dotted;
        border-color: cornflowerblue;
        padding: 1px;
        margin: 0 0 0 0;
        width: 95%;
        vertical-align: text-top;
    }

    .message_text {
        word-wrap: break-word;
        max-width: 660px;
        overflow: auto;
        display: table-cell;
        vertical-align: top;
    }

    .message_date {
        font-size: 10px;
        padding-right: 5px;
        color: darkgray;
        font-weight: normal;
    }

    .message_data_and_username {
        color: #656565;
        font-weight: bold;
    }

    img.chat_avatar_limit {
        max-width: 60px;
        max-height: 62px;
    }


    div.message_avatar {
        display: table-cell;
        padding-right: 4px;
        width: 60px;
        height: 67px;

    }

    img.chat_avatar_big_limit {
        max-width:350px;
        max-height:300px;

        display: block;
        position: absolute;
        z-index: 100;

    }

    #chat_messages {

        word-wrap:break-word;
        font-size: 16px;
        font-family: "Comic Sans MS", cursive, sans-serif;

    }

    .dialogRelative {
        position: relative;
        top: 0 !important;
        position: fixed;

    }

    .online_list_dialog {
        position: relative;
        top: 0 !important;
        right:0 !important;
        left:auto !important;
        position: fixed;
    }

</style>


<div id="chat_messages">

</div>

<br/><br/>

<div style="border: dotted 1px">
    <table>
        <tr>
            <td>
                <textarea class="textarea_resizable bbcode_input" 
                          style="width: 630px; height: 60px;"
                          cols="30" rows="5" 
                          id="chat_text"
                          ></textarea>
            </td>
            <td>

                <button onclick="chat_send();" style="height: 40px;font-weight: bold;">изпрати</button>
                <div style="height: 5px;"> </div>
                <input type="checkbox" id="chat_option_checkbox" onchange="$('#chat_options').toggle(); $('html, body').scrollTop($(document).height());"/>
                <label for="chat_option_checkbox" style="size: 10px;">
                    Опции
                </label>
                <input type="button" id="chat_emoticons" value=":)" style="size: 10px;">
                <div id="chat_emoticons_menu"></div>
            </td>
        </tr>

		<tr>
			<td>
				<div id="chat_options" style="display: none;">
					<input type="checkbox" checked id="chat_autoscroll">
                    <label for="chat_autoscroll" style="font-size: 10px;">авто скролиране</label>

					<br>

					<a href="#page_bottom" onclick="$( '#dialog-message' ).dialog({modal: true,buttons: { Ok: function() {  $( this ).dialog( 'close' ); }}});">mood: </a><input type="text" id="chat_user_mood">
					<br/>
					размер на буквите
                    <select onchange="$('#chat_messages').css('font-size', this.value+'px');">
						<option value="12">12
						<option value="13">13
						<option value="14">14
						<option value="15">15
						<option selected value="16">16
						<option value="17">17
						<option value="18">18
						<option value="19">19
						<option value="20">20
						<option value="21">21
						<option value="22">22
						<option value="23">23
						<option value="24">24


					</select>

					<br>

					шрифт:
                    <select onchange="$('#chat_messages').css('font-family', this.value);">
						<option value="Georgia, serif">Georgia, serif
						<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif">Palatino Linotype, Book Antiqua, Palatino, serif
						<option value='"Times New Roman", Times, serif'>Times New Roman", Times, serif
						<option value='Arial, Helvetica, sans-serif'>Arial, Helvetica, sans-serif
						<option value='Arial Black, Gadget, sans-serif'>Arial Black, Gadget, sans-serif
						<option value='"Comic Sans MS", cursive, sans-serif'>Comic Sans MS, cursive, sans-serif
						<option value='Impact, Charcoal, sans-serif'>Impact, Charcoal, sans-serif
						<option value='"Lucida Sans Unicode", "Lucida Grande", sans-serif'>Lucida Sans Unicode, Lucida Grande, sans-serif
						<option value='Tahoma, Geneva, sans-serif'>Tahoma, Geneva, sans-serif
						<option value='"Trebuchet MS", Helvetica, sans-serif'>Trebuchet MS, Helvetica, sans-serif
						<option value='Verdana, Geneva, sans-serif'>Verdana, Geneva, sans-serif
						<option value='"Courier New", Courier, monospace'>Courier New, Courier, monospace
						<option value='"Lucida Console", Monaco, monospace'>Lucida Console, Monaco, monospace
					</select>
					<br>
					<input type="checkbox" checked id="chat_option_enterSend">
                    <label for="chat_option_enterSend">изпращане на съобщение с enter</label>

					<div id="dialog-message" title="Mood" style="display: none;">
						Mood се добавя след името Ви, в скоби
					</div>


				</div>

			</td>
		</tr>

		<tr>
			<td>
				<div id="bbcode_butoni"></div>
			</td>
			<td>
				<a href="/forum_topic_vij.php?id=568" target="_BLANK" style="color: red;">правила</a>
			</td>
		</tr>



	</table>

</div>


<div id="online_list"><!-- online users list --></div>
<a name="page_bottom" />

<script>
	var message_id_start = 0;
	var message_last_edit_timestamp = 0;
	var chat_update_interval = 5000;


	function get_message_id_start() {
		return message_id_start;
	}

	function set_message_id_start(id) {
		message_id_start = id;

		return true;
	}

	function isBanAllowed(message) {
		<?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN)) : ?>
			return true;
		<?php endif; ?>
		
		if (<?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::CHAT_BAN_ROUGH_MESSAGES)) { echo 1; } else { echo 0; } ?> && message.allowBan > 0) {
			return true;
		}
		
		return false;
	}

	function getBanLinkHtml(message) {
		if (isBanAllowed(message)) {
            // @TODO remove onclick
			return '<a href="#" onClick="ban_vote(' + message.id + '); return false;">ban</a>';
		}
		
		return '';
	}
    
    function isCensoreAllowed(message) {
        if (<?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(\Tekstove\Acl::CHAT_CENSORE)) { echo 1; } else { echo 0; } ?>) {
            return true;
        }
        
        return false;
    }
    
    function getCensoreHtml(message) {
        if (isCensoreAllowed(message)) {
            // @TODO remove onclick
			return '<a href="#" onClick="censore(' + message.id + '); return false;">censore</a>';
        }
        
        return '';
    }
    
    function censore(messageId) {
        $.ajax({
			type: "POST",
			url: '/_chat/_ajax/censore.php',
			data: ({
                id : messageId
            }),

			success: function(data) {
				if (data.status === 1) {
                    alert('ok');
                } else {
                    alert('error');
                }
            }
		});
    }
    
    

	function ban_minutes_max() {
		
		<?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN)) : ?>
				return '<?php echo currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN); ?>';
		<?php endif; ?>
		
		<?php if (currentUser::isLogged() && currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN_ROUGH_MESSAGES) > 0) : ?>
			return '<?php echo currentUser::getInstance()->getAcl()->isAllowed(Tekstove\Acl::CHAT_BAN_ROUGH_MESSAGES); ?>';
		<?php endif; ?>
			
	}

	function ban_vote(msgID) {

		if (confirm('сигурен ?') === false) {
			return;
		}

        var message = 'Банвай само от съобщението което заслужава бан\nмаксимум минути: ' + ban_minutes_max();
        var minutes = prompt(message, 2);


		$.ajax({
			type: "POST",
			url: '/_chat/_ajax/ban.php',
			data: ({
                msgId : msgID,
                banMinutes: minutes
            }),

			success: function(data){
				alert(data);
			}
		});

	}


	$('#chat_text').keypress(function(e) {
		if ($('#chat_option_enterSend').is(":checked") === false) {
			return;
		}


		var keynum = 0;

		if (window.event) { // IE
			keynum = e.keyCode;
		}
		else if (e.which) { // Netscape/Firefox/Opera
			keynum = e.which;
		}

		if (keynum === 13) {
			chat_send();
		}
    });

    function chat_send() {

        var input_text = $('#chat_text').val();

        $('#chat_text').val('');
        $('#chat_text').focus();

        input_text = jQuery.trim( input_text );

        if (input_text === '') {
            return;
        }
        $.ajax({
            type: "POST",
            url: "new.php",
            data: ({
                text : input_text, 
                user_mood: $('#chat_user_mood').val(),
                hesh: '<?php echo md5(session_id()); ?>'
            }),
            statusCode: {
                403: function() {
                    alert('Временно не може да пишеш');
                },
                401: function() {
                    alert('Бисквитките са задължителни, може би е изтекла сесията, ще презаредя');
                    location.reload();
                }
            },
            success: function(data) {
                chat_update();
            }
        });

    }





    function chat_update() {

        $.ajax({
            type: "GET",
            url: "get_messages.php",
            data: ({
                start    : message_id_start,
                lastEdit : message_last_edit_timestamp
            }),
            dataType: 'json',
            cache: false,
            success: function (data) {
                if (!data) {
                    if (chat_update_interval < 30000) {
                        chat_update_interval += 250;
                    }
                    return true;
                }

                chat_update_interval = 2000;
                $.each(data, function(jsonKey, message) {

                    chat_parse(message);

                });


            }
        });



    }


    function chatIAmOnline() {
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/_chat/online.php",
            cache: false,
            success: function (data) {

                var userOnlineCount = 0;
                var html = '';
                $.each(data, function(jsonKey, message){
                    userOnlineCount++;
                    var user = new User({
                        id: message.id,
                        name: message.username
                    });
                    html += user.getProfileLink() + '<br/>';
                });

                if ($('#online_list:visible').length > 0) {
                    $('#online_list').html(html);
                    $('#online_list').dialog({title:'Online (' + userOnlineCount + ')'});
                }
            }
        });
    }


    function chat_parse(data) {
        var user = new User({
            id: data.username_id,
            name: data.username_name
        });

        // update start id
        if (data.id > get_message_id_start() ) {
            message_id_start = data.id;
        }

        if (message_last_edit_timestamp < data.editTimestamp) {
            message_last_edit_timestamp = data.editTimestamp;
        }

        if (data.username_avatar) {
            data.username_avatar = '<img src="'+data.username_avatar+'" class="chat_avatar_limit">';
        }


        if (data.username_mood.length > 0 ) {
            data.username_mood = ' ('+data.username_mood+')' ;
        }


        data.message = data.message.replace(/\n/g, '<br>');
        data.message = bbcode_make(data.message);

        var html_data = '<div id="message_'+data.id+'" class="message">';

        html_data += '<div class="message_avatar">';
        if (data.username_avatar) {
            html_data += '<a href="/profile.php?profile='
                + data.username_id
                + '" target="_blank" >'
                + data.username_avatar
                + '</a>';
        }

        html_data += '</div>';


        html_data += '<div style="display: table-cell;vertical-align: top;">';

        html_data += '<div class="message_data_and_username"><span class="message_date">' + data.date + ' от </span>';


        html_data += user.getProfileLink();


        if (data.username_mood.length > 1) {
            html_data += data.username_mood;
        }

        if (data.classAsName.length > 0) {
            html_data += ', ' + data.classAsName;
        }

        html_data += ' <span class="message_date">#';

        html_data += data.id;



        html_data += ' ' + getBanLinkHtml(data);
        
        html_data += ' ' + getCensoreHtml(data);

        html_data += ' ' + data.ip;

        html_data += '</span>';

        html_data += '</div>';

        html_data += '<div class="message_text">' + data.message + '</div>';

        html_data += '</div>';

        // append new text, insted of createing new msg
        if ($('#message_' + data.id).length > 0) {
            $('#message_' + data.id + ' .message_text ').html(data.message);
            $('#message_' + data.id).effect('highlight', {}, 1000);
        } else {
            $('#chat_messages').append(html_data);
        }

        if ($('#chat_autoscroll').is(":checked")) {

            $('html, body').scrollTop($(document).height());

        }

        if (!windowIsFocused) {
            thereIsUnreadedMessage = true;
        }


    } // function parsexml



    function chat_auto_update() {
        chat_update();
        setTimeout("chat_auto_update()",chat_update_interval);
    }

    function chatIAmOnlineAutoUpdate() {
        chatIAmOnline();
        setTimeout("chatIAmOnlineAutoUpdate()",31000);
    }


    function chat_emot_icon_chosen(code) {

        //  $('#chat_text').append(' '+code+' ');

        $('#chat_text').val( $('#chat_text').val() + ' ' + code + ' ' );


        $("#chat_emoticons_menu").dialog('close');
        $('#chat_text').focus();

    }



    var windowIsFocused = true;
    var defaultTitle = document.title;
    var thereIsUnreadedMessage = false;

    $(function() {
        var i;
        $("button, #chat_autoscroll, #chat_option_checkbox, #chat_emoticons").button();


        for (i = 0; i < emot_icons_id.length; i++) {
            $('#chat_emoticons_menu').append('<img src="/emic/'+emot_icons_id[i] + '" onclick="chat_emot_icon_chosen(\''+emot_icons_code[i]+'\');"> ');
        }


        $("#chat_emoticons_menu").dialog({
            autoOpen: false,
            show: "blind",
            hide: "fade",
            closeOnEscape: true,
            draggable: true,
            resizable: false,
            position: 'bottom',
            title: 'EmotIcons',
            dialogClass: 'dialogRelative'

        });


        $("#chat_emoticons").click(function() {
            $(' #chat_emoticons_menu ').dialog('close');
            $( "#chat_emoticons_menu" ).dialog( "open" );
            $( "#chat_emoticons_menu" ).focus();

            return false;
        });

        $('#online_list').dialog({
            autoOpen: true,
            show: "blind",
            hide: "fade",
            closeOnEscape: false,
            draggable: false,
            resizable: false,
            position: ['right','top'],
            width: 200,
            title: 'Online',
            dialogClass: 'online_list_dialog'
        });

        chat_auto_update();
        chatIAmOnlineAutoUpdate();

        $('#chat_messages').on('mouseover', '.chat_avatar_limit', function() {
            $(this).addClass('chat_avatar_big_limit');
        });
        $('#chat_messages').on('mouseout', '.chat_avatar_limit', function() {
            $(this).removeClass('chat_avatar_big_limit');
        });


        $([window, document]).focusin(function() {
            windowIsFocused = true;
            thereIsUnreadedMessage = false;
            document.title = defaultTitle;
        }).focusout(function(){
            windowIsFocused = false;
            thereIsUnreadedMessage = false;
        });

        setInterval(function() {
            if (!windowIsFocused && thereIsUnreadedMessage) {
                var charToAnimate = Math.floor(Math.random()*10);
                var symbol = '!';
                switch (charToAnimate) {
                case 0:
                    symbol = '#';
                    break;						
                case 1:
                    symbol = '|';
                    break;
                case 2:
                    symbol = ':';
                    break;
                case 3:
                    symbol = '+';
                    break;
                default:
                    symbol = '!';
                    break;
                }

                document.title = symbol + ' Ново съобщение ' + symbol;
            }
        }, 1000);

    });
    
</script>




<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-4588309-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>





</body>
</html>
