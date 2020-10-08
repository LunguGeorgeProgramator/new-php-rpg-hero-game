<?php
class PlayerFactory {

    public function createPlayer($player, $player_id=1){

        if($player === "hero") {
            $player_obj = new Hero();
        }else if($player === "monster") {
            $player_obj = new Monster();
        }

        $player_obj->getDBResults($player, $player_id);
        $player_obj->getDBStats($player);

        return $player_obj;
        
    }

}
?>