<LINK REL=StyleSheet HREF="custom.css" TITLE="Contemporary">
<?php

include 'database.php';
include 'hero.php';
include 'monster.php';
include 'gameEngineClass.php';

?>
    <form method="POST" style="float: left">
        <input type="submit" name="next_attack" value="Next turn.">
    </form>
    </br>
<?php

$game = new engine;

if(!isset($_SESSION['turn'])){
    $_SESSION['turn'] = [];
}

if(!isset($_SESSION['turnCounter'])){
    $_SESSION['turnCounter'] = 0;
}

if(!isset($_SESSION['hero'])){
    $_SESSION['hero'] =  $game->hero;
}

if(!isset($_SESSION['monster'])){
    $_SESSION['monster'] =  $game->monster;
}

if(!isset($_SESSION['battle_logs'])){
    $_SESSION['battle_logs'] = "";
}

$results = $game->figth($_SESSION['hero'], $_SESSION['monster'], $_SESSION['turn'], $_SESSION['battle_logs'], $_SESSION['turnCounter']);

$_SESSION['hero'] = $results[0];
$_SESSION['monster'] = $results[1];
$_SESSION['turn'] = $results[2];
$_SESSION['battle_logs'] = $results[4];
$_SESSION['turnCounter'] = $results[5];
echo "Turns made: ". $_SESSION['turnCounter'] . " max is 20. ";
var_dump('Hero ', $_SESSION['hero']);
var_dump('Monster ', $_SESSION['monster']);
echo $_SESSION['battle_logs'];

if(isset($results) && $results[3] === true){
    session_destroy();
} 
?>

