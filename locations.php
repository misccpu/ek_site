<!DOCTYPE html>

<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
    <title>Pokemon Emerald Kaizo - Database Locations App</title>
    <link rel="stylesheet" href="style.css">
</head>

<h1>===== EK Database Location Info =====</h1>
<div>
<a href="https://ix.cs.uoregon.edu/~debel/index.html">Home</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/pokedex.php">Pokedex</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/trainerdex.php">TrainerDex</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/locations.php">Locations</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/nuzlocke_tracker.php">Nuzlocke Tracker</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/import.html">Import</a>
</div>

<hr>

<body text="white" bgcolor="black">

<!-- Query location first -->
<?php
    $location_query = "SELECT location FROM location WHERE sort IS NOT NULL ORDER BY sort ASC;";
    $all_locations = mysqli_query($conn, $location_query) or die(mysqli_error($conn));
?>

<!-- Location dropdown -->
<div>
    <form action="locations.php" method="POST">

        <select name='location_select' id='location_select' onchange='if(this.value != 0) { this.form.submit(); }'>
        <option value='0'>Select a Location</option>
        <?php
            while($row = mysqli_fetch_array($all_locations, MYSQLI_BOTH))
                print "<option value='$row[location]'>$row[location]</option>";
        ?>
        </select><br><br>
    </form>
</div>

<br>

<!-- Query encounter info -->
<?php
    $location = $_POST ['location_select'];
    print "<div><h3>$location Encounters</h3></div><br>";

    // Grass encounters
    $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location_name LIKE ";
    $enc_query = $enc_query."'".$location."' AND (encounter_type = 'Grass' OR encounter_type = 'Cave' OR encounter_type = 'tower') ORDER BY e.encounter_type, e.floor, e.perc DESC;";
    $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
    $prev_floor = "";
    print "<div><h4><u>Grass/Cave/Tower</u></h4>";
    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/icons/$row[dex_num]' title='$row[name]' alt='$row[name]'>$row[perc]% - $row[floor]<br>";
    print "</div><br>";

    // Surfing encounters
    $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location_name LIKE ";
    $enc_query = $enc_query."'".$location."' AND encounter_type = 'Surfing' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
    $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
    print "<div><h4><u>Surfing</u></h4>";
    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/icons/$row[dex_num]' title='$row[name]' alt='$row[name]'>$row[perc]% - $row[floor]<br>";
    print "</div><br>";

    // Old Rod
    $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location_name LIKE ";
    $enc_query = $enc_query."'".$location."' AND encounter_type = 'Old Rod' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
    $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
    print "<div><h4><u>Old Rod</u></h4>";
    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/icons/$row[dex_num]' title='$row[name]' alt='$row[name]'>$row[perc]% - $row[floor]<br>";
    print "</div><br>";

    // Good Rod
    $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location_name LIKE ";
    $enc_query = $enc_query."'".$location."' AND encounter_type = 'Good Rod' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
    $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
    print "<div><h4><u>Good Rod</u></h4>";
    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/icons/$row[dex_num]' title='$row[name]' alt='$row[name]'>$row[perc]% - $row[floor]<br>";
    print "</div><br>";

    // Super Rod
    $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location_name LIKE ";
    $enc_query = $enc_query."'".$location."' AND encounter_type = 'Super Rod' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
    $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
    print "<div><h4><u>Super Rod</u></h4>";
    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/icons/$row[dex_num]' title='$row[name]' alt='$row[name]'>$row[perc]% - $row[floor]<br>";
    print "</div><br>";

    // Gift
    $enc_query = "SELECT p.dex_num, e.name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN pokemon p on e.name=p.name WHERE location_name LIKE ";
    $enc_query = $enc_query."'".$location."' AND encounter_type = 'Gift' ORDER BY e.encounter_type, e.floor, e.perc DESC;";
    $encounters = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));
    print "<div><h4><u>Gift</u></h4>";
    while ($row = mysqli_fetch_array($encounters, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/icons/$row[dex_num]' title='$row[name]' alt='$row[name]'> $row[perc]% - $row[floor]<br>";
    print "</div><br><hr><br>";

    // Now list trainers
    $trainer_query = "SELECT class, name FROM trainer WHERE location LIKE ";
    $trainer_query = $trainer_query."'".$location."' ORDER BY class, name ASC;";
    $trainer_result = mysqli_query($conn, $trainer_query) or die(mysqli_error($conn));
    while ($row = mysqli_fetch_array($trainer_result, MYSQLI_BOTH)) {
        print "<div>";
        print "<h3>$row[class] $row[name]</h3>";

        // If we need class and name...
        if ("$row[class]" == "Aqua Admin" ||
            "$row[class]" == "Elite Four" ||
            "$row[class]" == "Leader" ||
            "$row[class]" == "Magma Admin" ||
            "$row[class]" == "Winstrate") {
            print "<img src='ek_sprites/rse/trainer/$row[class] $row[name].png' alt='$row[class] $row[name]'>";
        }

        // If we need class and gender...
        else if ("$row[class]" == "Cool Trainer" ||
                 "$row[class]" == "Expert" ||
                 "$row[class]" == "Pokefan" ||
                 "$row[class]" == "Pkmn Breeder" ||
                 "$row[class]" == "Pkmn Ranger" ||
                 "$row[class]" == "Psychic" ||
                 "$row[class]" == "School Kid" ||
                 "$row[class]" == "Swimmer" ||
                 "$row[class]" == "Team Aqua Grunt" ||
                 "$row[class]" == "Team Magma Grunt" ||
                 "$row[class]" == "Tuber" ||
                 "$row[class]" == "Triathlete Runner" ||
                 "$row[class]" == "Triathlete Swimmer" ||
                 "$row[class]" == "Triathlete Cyclist") {
            // Make query for trainer gender and display correct image
            $trainer_gender_query = "SELECT gender FROM trainer WHERE location LIKE ";
            $trainer_gender_query = $trainer_gender_query."'".$location."' AND class LIKE ";
            $trainer_gender_query = $trainer_gender_query."'$row[class]' AND name LIKE ";
            $trainer_gender_query = $trainer_gender_query."'$row[name]';";
            $trainer_gender_result = mysqli_query($conn, $trainer_gender_query) or die(mysqli_error($conn));

            while($r = mysqli_fetch_array($trainer_gender_result, MYSQLI_BOTH))
                print "<img src='ek_sprites/rse/trainer/$row[class] ($r[gender]).png' alt='$row[class] $row[name] ($r[gender])'>";
        }

        // If we have a rival...
            else if ("$row[class]" == "Pkmn Trainer") {
            if ("$row[name]" == "May (Treecko)" ||
                "$row[name]" == "May (Torchic)" ||
                "$row[name]" == "May (Mudkip)")
                print "<img src='ek_sprites/rse/trainer/$row[class] May.png' alt='$row[class] May'>";

            else if ("$row[name]" == "Brendan (Treecko)" ||
                     "$row[name]" == "Brendan (Torchic)" ||
                     "$row[name]" == "Brendan (Mudkip)")
                print "<img src='ek_sprites/rse/trainer/$row[class] Brendan.png' alt='$row[class] Brendan'>";

            else
                print "<img src='ek_sprites/rse/trainer/$row[class] $row[name].png' alt='$row[class] $row[name]'>";
        }

        // If we have a Grunt... (Grunt gender not recorded in database or dealt with here yet)
        else if ("$row[name]" == "Grunt" ||
                "$row[name]"  == "Grunt (1)" ||
                "$row[name]"  == "Grunt (2)" ||
                "$row[name]"  == "Grunt (3)" ||
                "$row[name]"  == "Grunt (4)" ||
                "$row[name]"  == "Grunt (5)" ||
                "$row[name]"  == "Grunt (6)" ||
                "$row[name]"  == "Grunt (7)" ||
                "$row[name]"  == "Grunt (8)" ||
                "$row[name]"  == "Grunt (9)" ||
                "$row[name]"  == "Grunt (10)" ||
                "$row[name]"  == "Grunt (11)" ||
                "$row[name]"  == "Grunt (12)" ||
                "$row[name]"  == "Grunt (13)" ||
                "$row[name]" == "Grunt (14)" ||
                "$row[name]" == "Grunt (15)" ||
                "$row[name]" == "Grunt (16)") {
            if ("$row[name]" == "Team Aqua")
                print "<img src='ek_sprites/rse/trainer/Team Aqua Grunt (m).png' alt='$row[class] Grunt'>";
            else
                print "<img src='ek_sprites/rse/trainer/Team Magma Grunt (m).png' alt='$row[class] Grunt'>";
        }

        // Otherwise we just need class.
        else
            print "<img src='ek_sprites/rse/trainer/$row[class].png' alt='$row[class]'>";
        print "</div><br>";
        
        // Build team query and print results
        $team_query = "SELECT p.dex_num, tp.name, tp.gender, tp.level, tp.hold_item, tp.ability, tp.move1, tp.move2, tp.move3, tp.move4 FROM trainer_pokemon tp JOIN pokemon p ON tp.name=p.name WHERE location LIKE ";
        $team_query = $team_query."'".$location."' and tp.class LIKE ";
        $team_query = $team_query."'$row[class]' and tp.trainer_name LIKE ";
        $team_query = $team_query."'$row[name]' ORDER BY sort;";
        $team_result = mysqli_query($conn, $team_query) or die(mysqli_error($conn));

        $count = 1;

        while ($mon = mysqli_fetch_array($team_result, MYSQLI_BOTH)) {
            if ($count % 2 == 1) {
                print "<div class='row'>";
            }

            print "<p class='column'>";
            print "<img src='ek_sprites/rse/ruby_and_sapphire/$mon[dex_num]'><br>";
            print "#$mon[dex_num] $mon[name]($mon[gender])<br>Lv.$mon[level]<br>- $mon[ability] -<br>$mon[hold_item]<br><br>$mon[move1]<br>$mon[move2]<br>$mon[move3]<br>$mon[move4]<br>";

            if ($count %2 == 0) {
                print "</div><br>";
            }

            $count++;
        }
        
        print "</p>";
        print "</div><hr>";
    }

    mysqli_free_result($result);
    mysqli_close($conn);
?>

<hr>

<div>
<a href="https://ix.cs.uoregon.edu/~debel/index.html">Home</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/pokedex.php">Pokedex</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/trainerdex.php">TrainerDex</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/locations.php">Locations</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/nuzlocke_tracker.php">Nuzlocke Tracker</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/import.html">Import</a>
</div>

<p><h6>Final Project | CS 451 | Donny Ebel<br>
Created | Last Edited<br>
3.27.23 | 3.27.23</h6><p>

</body>
</html>
