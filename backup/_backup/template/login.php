<?php
Require(SITE_PATH_TEMPLATE . '__top.php');


?>


<br><br><font color="#FF0000" size=3><b>
	<?php if(isset ($_GET['error']))
	 if($_GET['error']==1) echo "Не сте попълнили нужните полета";
	 else if ($_GET['error']==2) echo "Няма такъв потребител.";
	  else if ($_GET['error']==3) echo "Грешна парола, опитайте пак!";
          ?>
	</b></font><br><br>

        <form action="" method="post">
	<table>
		<tr><td colspan=2><h1><a href="registeruser.php">Sign Up/регистрация</a></h1></td></tr>
		<tr><td colspan=2><font color="red"><u><b>чувствителност към малки и големи букви !!!</b></u></font>
                </td></tr><tr><td>Име:</td>
		<td><input type="text" name="username" maxlength="30">
		</td></tr><tr><td>Парола:</td><td>
			<input type="password" name="pass" maxlength="30">
		</td>
                </tr>
		<tr>
                    <td colspan="2">
                        <input type="checkbox" name="remember" id="loginRemember" /><label for="loginRemember">запомни ме</label>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
			<input type="submit" name="submit" value="Влез">
                    </td>
                </tr>
                <tr> 
                    <td colspan="2">
                        <a href="login_zabraveno.php">Забравено потребителко име <u>клик</u></a>
                    </td>
                </tr>
	</table>
	</form>






<?php
Require (SITE_PATH_TEMPLATE . "__bdqsno.php");
?>
