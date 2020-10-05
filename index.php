<LINK REL=StyleSheet HREF="custom.css" TITLE="Contemporary">
<?php
include 'database.php';
include 'hero.php';
include 'monster.php';
include 'gameEngineClass.php';
include 'logger.php';
session_start();
// session_destroy();
?>
    <form method="POST" style="float: left">
        <input type="submit" name="next_attack" value="Next turn (apasa aici/click here).">
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
    $_SESSION['battle_logs'] = Logger::getInstance();
}


$results = $game->figth($_SESSION['hero'], $_SESSION['monster'], $_SESSION['turn'], $_SESSION['turnCounter'], $_SESSION['battle_logs']);


// [$hero, $monster, $turn, $stop_battle, $turnCounter, $log_pass];
$_SESSION['hero'] = $results[0];
$_SESSION['monster'] = $results[1];
$_SESSION['turn'] = $results[2];
$_SESSION['turnCounter'] = $results[4];
$_SESSION['battle_logs'] = $results[5];
?>
<div style="clear:both"></div>
<?php echo "Turns made: ". $_SESSION['turnCounter'] . " max is 20. </br>"; ?>
<div id='wrapper' style="width: 100%">
    <div id='first'>
<?php

// echo 'Hero: '.$_SESSION['hero']->id.'  </br>';
echo 'Hero: '.$_SESSION['hero']->getName().'</br>';
echo 'Health: '.$_SESSION['hero']->getStats()[0]['max'].' - '.$_SESSION['hero']->getStats()[0]['min'].' "from interval value set" '.$_SESSION['hero']->getHealth(). '</br>';
echo 'Strength: '.$_SESSION['hero']->getStats()[1]['max'].' - '.$_SESSION['hero']->getStats()[1]['min'].' "from interval value set" '.$_SESSION['hero']->getStrength(). '</br>';
echo 'Defence: '.$_SESSION['hero']->getStats()[2]['max'].' - '.$_SESSION['hero']->getStats()[2]['min'].' "from interval value set" '.$_SESSION['hero']->getDefence(). '</br>';
echo 'Speed: '.$_SESSION['hero']->getStats()[3]['max'].' - '.$_SESSION['hero']->getStats()[3]['min'].' "from interval value set" '.$_SESSION['hero']->getSpeed(). '</br>';
echo 'Luck: '.$_SESSION['hero']->getStats()[4]['max'].' - '.$_SESSION['hero']->getStats()[4]['min'].' "from interval  value set" '.$_SESSION['hero']->getLuck(). '</br>';
// var_dump($_SESSION['hero']->getStats());
?>
    </div>
    <div id='second'>
<?php
// echo 'Hero: '.$_SESSION['hero']->id.'  </br>';
echo 'Monster: '.$_SESSION['monster']->getName().'</br>';
echo 'Health: '.$_SESSION['monster']->getStats()[0]['max'].' - '.$_SESSION['monster']->getStats()[0]['min'].' "from interval value set" '.$_SESSION['monster']->getHealth(). '</br>';
echo 'Strength: '.$_SESSION['monster']->getStats()[1]['max'].' - '.$_SESSION['monster']->getStats()[1]['min'].' "from interval value set" '.$_SESSION['monster']->getStrength(). '</br>';
echo 'Defence: '.$_SESSION['monster']->getStats()[2]['max'].' - '.$_SESSION['monster']->getStats()[2]['min'].' "from interval value set" '.$_SESSION['monster']->getDefence(). '</br>';
echo 'Speed: '.$_SESSION['monster']->getStats()[3]['max'].' - '.$_SESSION['monster']->getStats()[3]['min'].' "from interval value set" '.$_SESSION['monster']->getSpeed(). '</br>';
echo 'Luck: '.$_SESSION['monster']->getStats()[4]['max'].' - '.$_SESSION['monster']->getStats()[4]['min'].' "from interval  value set" '.$_SESSION['monster']->getLuck(). '</br>';
// var_dump('Monster ', $_SESSION['monster']);
?>
    </div>
</div>
<div style="clear:both"></div></br>
Click this button "Next Turn" !!!!.
<h2>Battle logs:</h2>
<?php
// echo $_SESSION['battle_logs'];
echo $_SESSION['battle_logs']->getLog();

if(isset($results) && $results[3] === true){
    session_destroy();
} 

?>

