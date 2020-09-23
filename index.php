<LINK REL=StyleSheet HREF="custom.css" TITLE="Contemporary">
<?php


include 'database.php';
include 'hero.php';
include 'monster.php';
include 'gameEngineClass.php';
session_start();
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
?>
<div style="clear:both"></div>
<?php echo "Turns made: ". $_SESSION['turnCounter'] . " max is 20. </br>"; ?>
<div id='wrapper'>
    <div id='first'>
<?php

echo 'Hero: </br>';
// echo 'Hero: '.$_SESSION['hero']->id.'  </br>';
echo 'name: '.$_SESSION['hero']->name.'</br>';
echo 'health: '.$_SESSION['hero']->stats[0]['max'].' - '.$_SESSION['hero']->stats[0]['min'].' "from interval random value set" '.$_SESSION['hero']->health.' </br>';
echo 'strength: '.$_SESSION['hero']->strength.' random from interval '.$_SESSION['hero']->stats[1]['max'].' - '.$_SESSION['hero']->stats[1]['min'].' "from interval random value set" </br>';
echo 'defence: '.$_SESSION['hero']->defence.' random from interval '.$_SESSION['hero']->stats[2]['max'].' - '.$_SESSION['hero']->stats[2]['min'].' "from interval random value set" </br>';
echo 'speed: '.$_SESSION['hero']->speed.' random from interval '.$_SESSION['hero']->stats[3]['max'].' - '.$_SESSION['hero']->stats[3]['min'].' "from interval random value set" </br>';
echo 'luck: '.$_SESSION['hero']->luck.' random from interval '.$_SESSION['hero']->stats[4]['max'].' - '.$_SESSION['hero']->stats[4]['min'].' "from interval random value set" </br>';
// var_dump($_SESSION['hero']);
?>
    </div>
    <div id='second'>
<?php
echo 'Monster: </br>';
// echo 'Hero: '.$_SESSION['hero']->id.'  </br>';
echo 'name: '.$_SESSION['monster']->name.'</br>';
echo 'health: '.$_SESSION['monster']->stats[0]['max'].' - '.$_SESSION['monster']->stats[0]['min'].' "from interval random value set" '.$_SESSION['monster']->health. '</br>';
echo 'strength: '.$_SESSION['monster']->stats[1]['max'].' - '.$_SESSION['monster']->stats[1]['min'].' "from interval random value set" '.$_SESSION['monster']->strength. '</br>';
echo 'defence: '.$_SESSION['monster']->stats[2]['max'].' - '.$_SESSION['monster']->stats[2]['min'].' "from interval random value set" '.$_SESSION['monster']->defence. '</br>';
echo 'speed: '.$_SESSION['monster']->stats[3]['max'].' - '.$_SESSION['monster']->stats[3]['min'].' "from interval random value set" '.$_SESSION['monster']->speed. '</br>';
echo 'luck: '.$_SESSION['monster']->stats[4]['max'].' - '.$_SESSION['monster']->stats[4]['min'].' "from interval random value set" '.$_SESSION['monster']->luck. '</br>';
// var_dump('Monster ', $_SESSION['monster']);
?>
    </div>
</div>
<div style="clear:both"></div>
<?php
echo $_SESSION['battle_logs'];

if(isset($results) && $results[3] === true){
    session_destroy();
} 
?>

