<?php if(!defined("THUNDER_MANAGED")){header("Location:/dead-end/403");exit();}?>
<p>caralhinho que vos foda, <?=$testicles?> gender: <?=$gender?></p>
<form method="POST" action="<?=Url::action($___VIEWID,"other",array("bubas","23"))?>">
    <input type="hidden" name="gender" value="f"/>
    <input type="submit" value="go"/>
</form>


<?=Url::rescope($___VIEWID,"pt")?>