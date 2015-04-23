<?php Require(SITE_PATH_TEMPLATE . '__top.php'); ?>

<div id="lyrics">


</div>





<script type="text/javascript">
var zaglavie=new Array();
var vbox=new Array();
var youtube=new Array();
var pesen_id=new Array();
var text=new Array();

var br_pesni=<?php echo $broi_pesni; ?>;

<?php
$br = 0;
foreach ($pesni as $v) {
?>zaglavie['<?php echo $br; ?>']="<?php echo addslashes(htmlspecialchars($v['zaglavie']));?>";
pesen_id['<?php echo $br; ?>']        =<?php echo $v['id']; ?>;
vbox['<?php echo $br; ?>']      ="<?php echo addslashes($v['video_vbox7']); ?>";
youtube['<?php echo $br; ?>']   ="<?php echo addslashes($v['video_youtube']); ?>";
text['<?php echo $br; ?>']      = '';
<?php $br++; } ?>
</script>

<div>

	<label>смяна през </label><input type="text" id="videoDefaultTime" value="300" readonly="readonly" size="3"> секунди (сменя се от плъзгача отдулу)<br/>
	<div id="videoDefaultTimeSlider"></div>
	
	<br/>
	<input type="checkbox" id="check_actosmqna" value="1" checked><label for="check_actosmqna">Автоматично сменяне</label>
	

<span id="player_vreme" style="width:800px;"></span>




<div style="text-align: center;" id="player">player</div>



<div style="text-align: center;" >
    <a href="#" style="font-size: 20px;font-weight: bold;" onclick="$('#playlist').toggle(500);return false;">Списък с песни</a>
<div  id="playlist"> </div>
</div>

</div>

<div id="pesen_tekst" style="width:450px;float:left"> </div>

<script type="text/javascript">
var vreme_smqna=300; // 300


var playlistHTML="";
for(q=0;q<br_pesni;q++){
    playlistHTML += '<a href="#" onClick="javascript:smeniklip('+q+');return false;">'+" "+zaglavie[q]+'<br>';
    }
$("#playlist").html(playlistHTML);


function smeniklip(id_pesen){
	var video="";
        if(youtube[id_pesen]) video=videoYouTube(youtube[id_pesen],1);
	else if(vbox[id_pesen]) video= videoVbox(vbox[id_pesen],1);
	else video='Песента няма клип<br>';
	$("#player").html('<br><b><a href="browse.php?id='+pesen_id[id_pesen]+'">'+zaglavie[id_pesen]+'</a></b>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="javascript:pokaji_tekst('+id_pesen+');return false;">виж текста</a><br>'+video);
	pokaji_tekst();
        vreme_smqna = $("#videoDefaultTime").val();
	}

function autosmqna(vreme){

	if ($('#check_actosmqna').is(":checked") == false) {
		return vreme;
	}

	vreme=vreme-1;
	if(vreme<1) {
		var start_proizvolen= Math.ceil(Math.random()*br_pesni);
		//alert(vbox[start_proizvolen]);
		smeniklip(start_proizvolen-1);
		return $("#videoDefaultTime").val();
		}
	$("#player_vreme").html(vreme+ ' секунди до следващата песен');
	return vreme;
	}

function pokaji_tekst(izbrano_id){
    if(izbrano_id == undefined) {
        $("#pesen_tekst").html('&nbsp;');
        return ;
    }

    if(!text[izbrano_id]){

    $.ajax(
        {type: "GET",
            url: "ajax/text_ot_id.php",
            data: "id="+pesen_id[izbrano_id],
            cache: false,
            success: function(message)
            {
                temp_text = message;
                temp_text = temp_text.replace(/\n/g, "<br>");
                temp_text = temp_text.replace(/ /g, "&nbsp;");


                $('#lyrics').append('<div id="lyric_'+izbrano_id+'" title="'+zaglavie[izbrano_id]+'">'+temp_text+'</div>');
                $( "#lyric_"+izbrano_id ).dialog({
			autoOpen: false,
			show: "fade",
			hide: "fade",
                        stack: true,
                        width: 400,
                        height: 400
		});


                

                $('#lyric_'+izbrano_id ).dialog( "open" );
            }
        });

    return ;

    }

            $('#lyric_'+izbrano_id ).dialog("open");
            $('#lyric_'+izbrano_id ).dialog("moveToTop");
            $('#lyric_'+izbrano_id ).effect("highlight", 1000);





        
}


setInterval ("vreme_smqna=autosmqna(vreme_smqna)", 1000 );

var start_proizvolen= Math.ceil(Math.random()*br_pesni)-1;
smeniklip(start_proizvolen);

$( "#check_actosmqna" ).button();
$("#videoDefaultTimeSlider").slider({
	range: "min",
	value: 300,
	min: 3,
	max: 600,
	slide: function( event, ui ) {
		$("#videoDefaultTime").val( ui.value );
	}
});

</script>






<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>