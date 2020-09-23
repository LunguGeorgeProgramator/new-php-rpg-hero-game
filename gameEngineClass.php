<?php
session_start();

class engine {

    public $monster;
    public $hero;

    function __construct(){
        $this->hero = $this->hero();
        $this->monster = $this->monster();
    }

    function hero(){
        $buildHero = new buildHeroClass;
        return $buildHero->buildHero();
    }

    function monster(){
        $db = new DataBase;
        $monsterEncounter = $db->runQuery('SELECT `id` FROM `monster` ORDER BY RAND() LIMIT 0,1;');
        $buildMonster = new buildMonsterClass;
        return $buildMonster->buildMonster($monsterEncounter[0]['id']);
    }

    function figth($hero, $monster, $turn, $log = ''){
        $atacker = null;
        $defender = null;
        $stop_battle = false;
        
        // set turn to atack and defence
        if(empty($turn)){
            $turn = $this->determinFirstTurnToAttack($hero, $monster, $turn);
        } elseif ($turn['turn'] === 'hero') {
            $turn['turn'] = 'monster';
            $turn['id'] = $monster->id;
        } else {
            $turn['turn'] = 'hero';
            $turn['id'] = $hero->id;
        } 

        if($turn['turn'] === 'hero'){
            $atacker = $hero;
            $defender = $monster;
        } else {
            $atacker = $monster;
            $defender = $hero;
        }

        // set damage
        $damage = $atacker->strength - $defender->defence; // Damage = Attacker strength – Defender defence

        if(rand(0, 100) < $defender->luck ){ // the defender gets lucky that turn.
            $damage = 0;
        }

        $defender->setHealth($defender->health - $damage); // The damage is subtracted from the defender’s health.

        if($defender->health <= 0){

            $stop_battle = true;
            $log .= "Battle finished for ". $defender->name . "</br>";

        } else {

            $log .= "Damage ".$damage." to ".$defender->name . "</br>";

        }

        return [$hero, $monster, $turn, $stop_battle, $log];
    }

    function determinFirstTurnToAttack($hero, $monster, $turn){ // The first attack
        if ($monster->speed > $hero->speed) { 
            $turn = ['turn' => 'monster', 'id' => $monster->id];
        } elseif ($monster->speed < $hero->speed) {
            $turn = ['turn' => 'hero', 'id' => $hero->id];
        } elseif ($monster->speed === $hero->speed) {
            if ($monster->luck > $hero->luck) {
                $turn = ['turn' => 'monster', 'id' => $monster->id];
            } elseif ($monster->luck < $hero->luck) {
                $turn = ['turn' => 'hero', 'id' =>$hero->id];
            } elseif ($monster->luck === $hero->luck) {
                $turn = ['turn' => 'hero', 'id' => $hero->id];
            }
        }
        return $turn;
    }


}


$game = new engine;

if(!isset($_SESSION['turn'])){
    $_SESSION['turn'] = [];
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

$results = $game->figth($_SESSION['hero'], $_SESSION['monster'], $_SESSION['turn'], $_SESSION['battle_logs']);

$_SESSION['hero'] = $results[0];
$_SESSION['monster'] = $results[1];
$_SESSION['turn'] = $results[2];
$_SESSION['battle_logs'] = $results[4];

var_dump('Hero ', $_SESSION['hero']);
var_dump('Monster ', $_SESSION['monster']);
echo $_SESSION['battle_logs'];

if(isset($results) && $results[3] === true){
    session_destroy();
} 

// var_dump($_SESSION['hero'], $_SESSION['monster']);

// var_dump($game->figth($_SESSION['hero'], $_SESSION['monster'], $_SESSION['turn']));





// $buildHero = new buildHeroClass;
// $hero  = $buildHero->buildHero();



// $heroDB = $db->runQuery('SELECT * FROM hero where id=1');
 
// $heroSkillsDB = $db->runQuery(
//     'SELECT s.* FROM `hero` h
//     INNER JOIN heros_skills hs on hs.id_hero = h.id
//     inner join skill s on s.id = hs.id_skill
//     WHERE h.id = 1'
// );
// $hero = new Hero(1, 213123, 'xxx', 32, 65, 76, 43, 99, 7);
// $hero->setLuck(999999999);
// $heroSkillsDB = $db->runQuery('SELECT s.* FROM `hero` h
// INNER JOIN heros_skills hs on hs.id_hero = h.id
// inner join skill s on s.id = hs.id_skill
// WHERE h.id = 1');
// var_dump($hero);

// var_dump($monster);

// var_dump($monsterEncounter[0]['id']);

/// 

// class buildHero extends Hero {

//     public $hero;

//     public function buildHero(){
//         parent::
//     }
// }
?>