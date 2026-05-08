<!DOCTYPE html>

<?php
    include(__DIR__ . '/../config/connectionData.php');
    $conn = mysqli_connect($server, $user, $pass, $dbname, $port)
        or die('Error connecting to MySQL server.');
?>

<html>

    <head>
        <title>Pokemon Emerald Kaizo - Database Locations App</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body text="white" bgcolor="black">
        <h1>===== EK Database Location Info =====</h1>
        <?php
            include('header.php');
        ?>

        <!-- Query location first -->
        <?php
            $location_query = "SELECT location FROM location WHERE sort IS NOT NULL ORDER BY sort ASC;";
            $all_locations = mysqli_query($conn, $location_query) or die(mysqli_error($conn));
        ?>

        <!-- Location dropdown -->
        <div>
            <form action="locations.php" method="POST">
                <select name='location_select' id='location_select' onchange='if(this.value != "0") { this.form.submit(); }'>
                    <option value='0'>Select a Location</option>
                    <?php
                        while ($row = mysqli_fetch_array($all_locations, MYSQLI_BOTH))
                            print "<option value='$row[location]'>$row[location]</option>";
                    ?>
                </select><br><br>
            </form>
        </div>

        <br>

        <!-- Query encounter info -->
        <?php
            $location = $_POST['location_select'] ?? "";
            print "<div><h3>$location Encounters</h3></div><br>";

            if ($location !== "") {
                // Walking encounters
                $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location LIKE ";
                $enc_query = $enc_query . "'" . $location . "' AND (encounter_type = 'Grass' OR encounter_type = 'Cave' OR encounter_type = 'tower') ORDER BY e.encounter_type, e.floor, e.perc DESC;";
                $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
                
                $prev_floor = "";

                while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH)) {

                    // New floor section
                    if ($row['floor'] != $prev_floor) {

                        // Close previous floor div
                        if ($prev_floor != "") {
                            print "</div><br>";
                        }

                        // Open new floor div
                        print "<div class='encounter_floor'>";
                        print "<h4>Standard Walking - {$row['floor']}</h4>";

                        $prev_floor = $row['floor'];
                    }

                    // Print Pokemon
                    print "<img src='assets/ek_sprites/rse/icons/" . sprintf("%03d", $row['dex_num']) . ".gif' title='{$row['name']}' alt='{$row['name']}'> ";
                    print "{$row['perc']}%<br>";
                }

                // Close final div
                if ($prev_floor != "") {
                    print "</div><br>";
                }

                // Surfing encounters
                $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location LIKE ";
                $enc_query = $enc_query . "'" . $location . "' AND encounter_type = 'Surfing' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
                $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
                if (mysqli_num_rows($encounters) > 0) {
                    print "<div><h4>Surfing</h4>";
                    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
                        print "<img src='assets/ek_sprites/rse/icons/" . sprintf("%03d", $row['dex_num']) . ".gif' title='{$row['name']}' alt='{$row['name']}'> {$row['perc']}% - {$row['floor']}<br>";
                    print "</div><br>";
                }

                // Old Rod
                $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location LIKE ";
                $enc_query = $enc_query . "'" . $location . "' AND encounter_type = 'Old Rod' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
                $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
                if (mysqli_num_rows($encounters) > 0) {
                    print "<div><h4>Old Rod</h4>";
                    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
                        print "<img src='assets/ek_sprites/rse/icons/" . sprintf("%03d", $row['dex_num']) . ".gif' title='{$row['name']}' alt='{$row['name']}'> {$row['perc']}% - {$row['floor']}<br>";
                    print "</div><br>";
                }

                // Good Rod
                $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location LIKE ";
                $enc_query = $enc_query . "'" . $location . "' AND encounter_type = 'Good Rod' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
                $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
                if (mysqli_num_rows($encounters) > 0) {
                    print "<div><h4>Good Rod</h4>";
                    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
                        print "<img src='assets/ek_sprites/rse/icons/" . sprintf("%03d", $row['dex_num']) . ".gif' title='{$row['name']}' alt='{$row['name']}'> {$row['perc']}% - {$row['floor']}<br>";
                    print "</div><br>";
                }

                // Super Rod
                $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location LIKE ";
                $enc_query = $enc_query . "'" . $location . "' AND encounter_type = 'Super Rod' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
                $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
                if (mysqli_num_rows($encounters) > 0) {
                    print "<div><h4>Super Rod</h4>";
                    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
                        print "<img src='assets/ek_sprites/rse/icons/" . sprintf("%03d", $row['dex_num']) . ".gif' title='{$row['name']}' alt='{$row['name']}'> {$row['perc']}% - {$row['floor']}<br>";
                    print "</div><br>";
                }

                // Gift
                $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location LIKE ";
                $enc_query = $enc_query . "'" . $location . "' AND encounter_type = 'Gift' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
                $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
                if (mysqli_num_rows($encounters) > 0) {
                    print "<div><h4>Gift</h4>";
                    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
                        print "<img src='assets/ek_sprites/rse/icons/" . sprintf("%03d", $row['dex_num']) . ".gif' title='{$row['name']}' alt='{$row['name']}'> {$row['perc']}% - {$row['floor']}<br>";
                    print "</div><br><hr><br>";
                }

                // Now list trainers
                $trainer_query = "SELECT class, name FROM trainer WHERE location LIKE ";
                $trainer_query = $trainer_query . "'" . $location . "' ORDER BY class, name ASC;";
                $trainer_result = mysqli_query($conn, $trainer_query) or die(mysqli_error($conn));
                
                if (mysqli_num_rows($trainer_result) > 0) {
                    print "<div><h3>$location Trainers</h3></div><br>";
                    while ($row = mysqli_fetch_array($trainer_result, MYSQLI_BOTH)) {
                        print "<div>";
                        print "<h3>$row[class] $row[name]</h3>";
                        $trainer_class = "$row[class]";
                        $trainer_name = "$row[name]";

                        // If we need class and name...
                        if (
                            $trainer_class == "Aqua Admin" ||
                            $trainer_class == "Aqua Leader" ||
                            $trainer_class == "Champion" ||
                            $trainer_class == "Elite Four" ||
                            $trainer_class == "Leader" ||
                            $trainer_class == "Magma Admin" ||
                            $trainer_class == "Magma Leader" ||
                            $trainer_class == "Winstrate"
                        ) {
                            print "<img src='assets/ek_sprites/rse/trainer/$trainer_class $trainer_name.png' alt='$trainer_class $trainer_name'>";
                        }

                        // If we need class and gender...
                        else if (
                            $trainer_class == "Cool Trainer" ||
                            $trainer_class == "Expert" ||
                            $trainer_class == "Pokefan" ||
                            $trainer_class == "Pkmn Breeder" ||
                            $trainer_class == "Pkmn Ranger" ||
                            $trainer_class == "Psychic" ||
                            $trainer_class == "School Kid" ||
                            $trainer_class == "Swimmer" ||
                            $trainer_class == "Team Aqua Grunt" ||
                            $trainer_class == "Team Magma Grunt" ||
                            $trainer_class == "Tuber" ||
                            $trainer_class == "Triathlete Runner" ||
                            $trainer_class == "Triathlete Swimmer" ||
                            $trainer_class == "Triathlete Cyclist"
                        ) {
                            // Make query for trainer gender and display correct image
                            $trainer_gender_query = "SELECT gender FROM trainer WHERE location LIKE ";
                            $trainer_gender_query = $trainer_gender_query . "'" . $location . "' AND class LIKE ";
                            $trainer_gender_query = $trainer_gender_query . "'" . $trainer_class . "' AND name LIKE ";
                            $trainer_gender_query = $trainer_gender_query . "'" . $trainer_name . "';";
                            $trainer_gender_result = mysqli_query($conn, $trainer_gender_query) or die(mysqli_error($conn));

                            while ($r = mysqli_fetch_array($trainer_gender_result, MYSQLI_BOTH))
                                print "<img src='assets/ek_sprites/rse/trainer/$trainer_class ($r[gender]).png' alt='$trainer_class $trainer_name'>";
                        }

                        // If we have a rival...
                        else if ("$row[class]" == "Pkmn Trainer") {
                            if (
                                $trainer_name == "May (Treecko)" ||
                                $trainer_name == "May (Torchic)" ||
                                $trainer_name == "May (Mudkip)"
                            )
                                print "<img src='assets/ek_sprites/rse/trainer/$trainer_class May.png' alt='$trainer_class May'>";

                            else if (
                                $trainer_name == "Brendan (Treecko)" ||
                                $trainer_name == "Brendan (Torchic)" ||
                                $trainer_name == "Brendan (Mudkip)"
                            )
                                print "<img src='assets/ek_sprites/rse/trainer/$trainer_class Brendan.png' alt='$trainer_class Brendan'>";

                            else    // It's Wally!
                                print "<img src='assets/ek_sprites/rse/trainer/$trainer_class $trainer_name.png' alt='$trainer_class $trainer_name'>";
                        }

                        // If we have a Grunt... (Grunt gender not recorded in database or dealt with here yet)
                        else if (preg_match('/^Grunt( \(\d+\))?$/', $trainer_name)) {
                            if ($trainer_class == "Team Aqua")
                                print "<img src='assets/ek_sprites/rse/trainer/Team Aqua Grunt (m).png' alt='$trainer_class Grunt'>";
                            else
                                print "<img src='assets/ek_sprites/rse/trainer/Team Magma Grunt (m).png' alt='$trainer_class Grunt'>";
                        }

                        // Otherwise we just need class.
                        else
                            print "<img src='assets/ek_sprites/rse/trainer/$trainer_class.png' alt='$trainer_class'>";
                        print "</div><br>";

                        // Build team query and print results
                        $team_query = "SELECT p.dex_num, tp.name, tp.gender, tp.level, tp.hold_item, tp.ability, tp.move1, tp.move2, tp.move3, tp.move4 FROM trainer_pokemon tp JOIN pokemon p ON tp.name=p.name WHERE location LIKE ";
                        $team_query = $team_query . "'" . $location . "' and tp.class LIKE ";
                        $team_query = $team_query . "'$row[class]' and tp.trainer_name LIKE ";
                        $team_query = $team_query . "'$row[name]' ORDER BY sort;";
                        $team_result = mysqli_query($conn, $team_query) or die(mysqli_error($conn));

                        $count = 1;

                        while ($mon = mysqli_fetch_array($team_result, MYSQLI_BOTH)) {
                            if ($count % 2 == 1) {
                                print "<div class='row'>";
                            }

                            print "<p class='column'>";
                            
                            $dex = (int)$mon['dex_num'];
                            if ($dex <= 151) {
                                print "<img src='assets/ek_sprites/frlg/FRLG/" . sprintf("%03d", $dex) . ".png' alt='{$mon['name']}'><br>";
                            } else {
                                print "<img src='assets/ek_sprites/rse/ruby_and_sapphire/" . sprintf("%03d", $dex) . ".png' alt='{$mon['name']}'><br>";
                            }
                            print "#" . sprintf("%03d", $dex) . " {$mon['name']}({$mon['gender']})<br>Lv.{$mon['level']}<br>- {$mon['ability']} -<br>{$mon['hold_item']}<br><br>{$mon['move1']}<br>{$mon['move2']}<br>{$mon['move3']}<br>{$mon['move4']}<br>";

                            if ($count % 2 == 0) {
                                print "</div><br>";
                            }

                            $count++;
                        }

                        print "</p>";
                        print "</div><br>";
                    }
                }

            mysqli_free_result($all_locations);
            mysqli_free_result($encounters);
            mysqli_free_result($trainer_result);
            //mysqli_free_result($trainer_gender_result);
            //mysqli_free_result($team_result);
            mysqli_close($conn);
            }
        ?>
        
        <?php
            include('footer.php');
        ?>

    </body>

</html>