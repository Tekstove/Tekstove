<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lyricForm
 *
 * @author po_taka
 */

class lyric_form
{
	
	private $delete = <<<'EOF'
<input type="checkbox" name="delete" value="delete" id="delete" onclick="$('#iztrivane_prichina_div').slideDown(0);">
	<label for="delete">Изтрий</label><br>
                Код: {code}
                <br>
                <input type="text" name="deletekod" size=30 value="Въведи кода за да изтриеш песента">

                <div id="iztrivane_prichina_div" style="display: none"><br>
                    Причина за изтриване ( ще се прати и като ЛС до изпрателия песента )
                    <div style="color: red;">при повторение, посочвай линк към първата песен</div>
                    <div id="bbcode_butoni"></div>

                    <textarea name="iztrii_prichina" id="bbcode_input" style="width: 450px; height: 40px;" rows=15 cols=90></textarea>
                    
					повтаряща се:<input type="text" onchange="$('#bbcode_input').val('текста повтаря [url='+this.value+']'+this.value+'[/url]');" />

                </div>
EOF;
	protected $deleteOptions = array('code'=>NULL);
	
	
	public function setDeleteOptions($key, $value)
	{
		$this->deleteOptions[$key] = $value;
	}
	
	public function getDelete()
	{
		if (empty($this->deleteOptions['code']))
		{
			trigger_error('delete options code not set');
		}
		
		$return = preg_replace('/{code}/', $this->deleteOptions['code'], $this->delete);
		
		return $return;
		
		
		
	}










}

?>
