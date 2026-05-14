<!DOCTYPE html>

<html>
    
<!-- TODO:
        Fix div containers, ugh -->

    <head>
        <title>Pokemon Emerald Kaizo - Movepool Import</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body text="white" bgcolor="black">
        <h1>===== EK MOVEPOOL IMPORT =====</h1>
        
        <?php
            include('header.php');
        ?>
        
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $pkmn_name = $_POST['pkmn_name'];
                $output = "";

                // TM/HM
                if (isset($_POST['tmhm'])) {

                    foreach ($_POST['tmhm'] as $move) {

                        if (strpos($move, "(hm)") !== false) {

                            $clean_move = str_replace(" (hm)", "", $move);

                            $output .= "INSERT INTO movepool_hm (name, move_name) ";
                            $output .= "VALUES ('$pkmn_name', '$clean_move');\n";

                        } else {

                            $output .= "INSERT INTO movepool_tm (name, move_name) ";
                            $output .= "VALUES ('$pkmn_name', '$move');\n";
                        }
                    }
                }

                // Tutor
                if (isset($_POST['tutor'])) {

                    foreach ($_POST['tutor'] as $move) {

                        $output .= "INSERT INTO movepool_tutor (name, move_name) ";
                        $output .= "VALUES ('$pkmn_name', '$move');\n";
                    }
                }

                // Egg
                if (!empty($_POST['egg_moves'])) {

                    $egg_moves = explode("\n", $_POST['egg_moves']);

                    foreach ($egg_moves as $move) {

                        $move = trim($move);

                        if ($move != "") {

                            $output .= "INSERT INTO movepool_egg (name, move_name) ";
                            $output .= "VALUES ('$pkmn_name', '$move');\n";
                        }
                    }
                }
            }
        ?>
        
        <?php
            if (!isset($output)) {
                $output = "";
            }
            
            if (isset($_POST['tmhm']) || isset($_POST['tutor']) || !empty($_POST['egg_moves'])) {
                echo "<br><div>";
                echo "<h2>Generated SQL</h2>";
                echo "</div><br>";

                echo "<div>";
                echo "<textarea rows='15' cols='85' spellcheck='false'>$output</textarea>";
                echo "</div><br>";
            }
        ?>
        
        <form method="POST">
            <!-- Req Pokemon name -->
            <div>
                <label><b>Pokemon Name:</b></label><br>
                <input type="text" name="pkmn_name" required><br><br>
            </div>
            
            <br>

            <div class="container" width=100px>

                <!-- TM/HM -->
                <div class="column">
                    <h3>TM/HM Moves</h3>

                    <?php
                        $tmhm_moves = [
                            "Aerial Ace",
                            "Attract",
                            "Blizzard",
                            "Brick Break",
                            "Bullet Seed",
                            "Calm Mind",
                            "Cut (hm)",
                            "Dig",
                            "Dive (hm)",
                            "Dragon Claw",
                            "Earthquake",
                            "Facade",
                            "Fire Blast",
                            "Flamethrower",
                            "Flash (hm)",
                            "Fly (hm)",
                            "Focus Punch",
                            "Frustration",
                            "Giga Drain",
                            "Hidden Power",
                            "Ice Beam",
                            "Iron Tail",
                            "Light Screen",
                            "Overheat",
                            "Psychic",
                            "Reflect",
                            "Rest",
                            "Return",
                            "Roar",
                            "Rock Smash (hm)",
                            "Rock Tomb",
                            "Safeguard",
                            "Secret Power",
                            "Seismic Toss",
                            "Shadow Ball",
                            "Shock Wave",
                            "Skill Swap",
                            "Sludge Bomb",
                            "Solar Beam",
                            "Steel Wing",
                            "Strength (hm)",
                            "Surf (hm)",
                            "Thief",
                            "Torment",
                            "Toxic",
                            "Waterfall (hm)",
                            "Water Pulse"
                        ];

                        foreach ($tmhm_moves as $move) {
                            print "<input type='checkbox' name='tmhm[]' value=\"$move\"> $move<br>";
                        }
                    ?>
                </div>

                <!-- Tutor -->
                <div class="column">
                    <h3>Tutor Moves</h3>

                    <?php
                        $tutor_moves = [
                            "Body Slam",
                            "Counter",
                            "Defense Curl",
                            "Double-Edge",
                            "Dream Eater",
                            "Dynamic Punch",
                            "Endure",
                            "Explosion",
                            "Fire Punch",
                            "Ice Punch",
                            "Icy Wind",
                            "Mega Kick",
                            "Mega Punch",
                            "Metronome",
                            "Mimic",
                            "Mud-Slap",
                            "Nightmare",
                            "Psych Up",
                            "Rock Slide",
                            "Rollout",
                            "Seismic Toss",
                            "Self-Destruct",
                            "Sky Attack",
                            "Sleep Talk",
                            "Snore",
                            "Soft-Boiled",
                            "Swagger",
                            "Swift",
                            "Swords Dance",
                            "Thunder Punch",
                            "Thunder Wave",
                            "X-Scissors"
                        ];

                        foreach ($tutor_moves as $move) {
                            print "<input type='checkbox' name='tutor[]' value=\"$move\"> $move<br>";
                        }
                    ?>
                </div>

                <br>
                
                <!-- Egg Moves -->
                <div>
                    <h3>Egg Moves</h3>

                    <textarea name="egg_moves" rows=7 cols=30></textarea>
                </div>

            </div>

            <br>

            <div>
                <input type="submit" value="Generate SQL">
            </div>

        </form>

        <?php
            include('footer.php');
        ?>

    </body>

</html>