function mod_problem(id,div, lyricID){
    $.ajax(
    {
        type: "GET",
        url: "mod/problemi.php",
        data: "problemi_iztrii="+id+'&lyric_id='+lyricID,
        cache: false,
        success: function(message)
        {
            if(message == 'refresh')
            {
                location.reload();
            }
            
            if(message.length>2) alert(message);
            else $('#'+div).html('');
        }
    });

    
}

