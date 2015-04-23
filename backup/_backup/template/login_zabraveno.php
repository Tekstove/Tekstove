<?php
/* @var $pesen lyric */

require(SITE_PATH_TEMPLATE . '__top.php');
?>
<form action="" method="post">
    Използвана Ел. поща<input type="text" name="z_po6ta"><br>
    Въведена година на раждане<select name="z_godina">
        <option selected value=0>Не съм въвел година на раждане
        <option value="2008">2008
        <option value="2007">2007
        <option value="2006">2006
        <option value="2005">2005
        <option value="2004">2004
        <option value="2003">2003
        <option value="2002">2002
        <option value="2001">2001
        <option value="2000" style="font-weight: bold">2000
        <option value="1999">1999
        <option value="1998">1998
        <option value="1997">1997
        <option value="1996">1996
        <option value="1995">1995
        <option value="1994">1994
        <option value="1993">1993
        <option value="1992">1992
        <option value="1991">1991
        <option value="1990" style="font-weight: bold">1990
        <option value="1989">1989
        <option value="1988">1988
        <option value="1987">1987
        <option value="1986">1986
        <option value="1985">1985
        <option value="1984">1984
        <option value="1983">1983
        <option value="1982">1982
        <option value="1981">1981
        <option value="1980" style="font-weight: bold">1980
        <option value="1979">1979
        <option value="1978">1978
        <option value="1977">1977
        <option value="1976">1976
        <option value="1975">1975
        <option value="1974">1974
        <option value="1973">1973
        <option value="1972">1972
        <option value="1971">1971
        <option value="1970" style="font-weight: bold">1970
        <option value="1969">1969
        <option value="1968">1968
        <option value="1967">1967
        <option value="1966">1966
        <option value="1965">1965
        <option value="1964">1964
        <option value="1963">1963
        <option value="1962">1962
        <option value="1961">1961
        <option value="1960" style="font-weight: bold">1960
        <option value="1959">1959
        <option value="1958">1958
        <option value="1957">1957
        <option value="1956">1956
        <option value="1955">1955
        <option value="1954">1954
        <option value="1953">1953
        <option value="1952">1952
    </select><br>
    <input type="submit" value="търси">
</form>

<br>

<?php if (isset($msg)): ?>
    <?php echo $msg; ?>
<?php endif; ?>


<?php Require (SITE_PATH_TEMPLATE . "__bdqsno.php"); ?>