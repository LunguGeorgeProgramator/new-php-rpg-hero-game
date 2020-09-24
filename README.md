# new-php-rpg-hero-game

 PHP, Apache, MySQL, phpunit.

To set the project just clone with git:

    git clone https://github.com/LunguGeorgeProgramator/new-php-rpg-hero-game
    
Import data base file hero_game.sql in phpmyadmin:

    http://localhost/phpmyadmin/db_import.php

Change data base conections creditials with yours in php file class database.php

    function __construct() {
          $this->conn = false;
          $this->servername = "localhost"; // your sql server name
          $this->username = "root"; // your sql server name
          $this->password = ""; // your sql server password
          $this->dbname = "hero_game"; 
          $this->connectDB();
      }

    
Run the game in browser and just click button "next turn".

How to run test:

    C:\wamp64\www\new-php-rpg-hero-game>vendor\bin\phpunit --verbose tests\GameTest

    cd \wamp64\www\new-php-rpg-hero-game

    vendor\bin\phpunit --verbose tests\GameTest
  
 Comand to run all tests at once:
 
    vendor\bin\phpunit --verbose tests
