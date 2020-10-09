<?php

class Hero extends Player
{
    public function skills()
    {
        $skills = (new DataBase)->runQuery(
            'SELECT s.* FROM `hero` h
            INNER JOIN heros_skills hs on hs.id_hero = h.id
            inner join skill s on s.id = hs.id_skill
            WHERE h.id = 1'
        );

        foreach ($skills as $skill) {
            if (rand(0, 100) < $skills[0]['skill_chance']) { // check the chance of the skill to occur
                return $skill;
            }
        }

        return null;
    }
}
