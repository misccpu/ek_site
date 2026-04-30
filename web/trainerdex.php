<!DOCTYPE html>

<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
    <title>Pokemon Emerald Kaizo - Database TrainerDex App</title>
    <link rel="stylesheet" href="style.css">
</head>

<h1>===== EK Database TrainerDex =====</h1>
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
    $location_query = "SELECT DISTINCT t.location, l.sort FROM ek_data.trainer t JOIN ek_data.location l ON t.location=l.location WHERE l.sort IS NOT NULL ORDER BY l.sort;";
    $all_locations = mysqli_query($conn, $location_query) or die(mysqli_error($conn));
?>

<!-- Location dropdown -->
<div>
    <form action="trainerdex.php" method="POST">

        <select name='location_select' id='location_select' onchange='if(this.value != 0) { this.form.submit(); }'>
        <option value='0'>Select a Location</option>
        <?php
            while($row = mysqli_fetch_array($all_locations, MYSQLI_BOTH))
                print "<option value='$row[location]'>$row[location]</option>";
        ?>
        </select>
    </form>

<br>

<!-- Trainer class and name dropdown -->
    <form action="trainerdex.php" method="POST">

        <!-- Query trainer info -->
        <?php
            $trainer_location = $_POST ['location_select'];
        
            $class_and_name_query = "SELECT DISTINCT class, name FROM ek_data.trainer WHERE location LIKE ";
            $class_and_name_query = $class_and_name_query."'".$trainer_location."' ORDER BY class, name ASC;";
            $all_trainers_at_location = mysqli_query($conn, $class_and_name_query) or die(mysqli_error($conn));
        ?>

        <select name='class_and_name_select' id='class_and_name_select' onchange='if(this.value != 0) { this.form.submit(); }'>
            <option>Select Trainer</option>
            <?php
                while($row = mysqli_fetch_array($all_trainers_at_location, MYSQLI_BOTH))
                    print "<option value='$trainer_location|$row[class]|$row[name]'>$row[class] $row[name]</option>";
            ?>
        </select>
    </form>
</div>

<!-- Build full query for trainer pokemon -->
<?php
$trainer_class_and_name = $_POST ['class_and_name_select'];
list($trainer_loc, $trainer_class, $trainer_name) = explode("|", $trainer_class_and_name, 3);

// Construct and make query
$trainer_query = "SELECT DISTINCT tp.sort, t.gender AS trainer_gender, p.name, tp.gender, tp.level, 
                  p.dex_num, 
                  p.type1, p.type2, 
                  tp.hold_item, 
                  tp.nature, tp.ability, 
                  tp.move1, tp.move2, tp.move3, tp.move4, 
                  tp.iv, 
                  p.hp, p.hp AS meterHP,
                  p.atk, p.atk AS meterATK,
                  p.def, p.def AS meterDEF,
                  p.satk, p.satk AS meterSATK,
                  p.sdef, p.sdef AS meterSDEF,
                  p.spd, p.spd AS meterSPD
                  FROM trainer_pokemon tp
                      JOIN pokemon p USING(name)
                      JOIN trainer t ON t.name=tp.trainer_name
                  WHERE tp.location LIKE ";
$trainer_query = $trainer_query."'".$trainer_loc."' AND tp.class LIKE ";
$trainer_query = $trainer_query."'".$trainer_class."' AND tp.trainer_name LIKE ";
$trainer_query = $trainer_query."'".$trainer_name."' ORDER BY sort ASC;";
$result = mysqli_query($conn, $trainer_query) or die(mysqli_error($conn));

print "<pre>";

// Print trainer heading, then display picture
print "<div>";
print "<h3>$trainer_loc $trainer_class $trainer_name</h3>";
print "<h3>$row[name]</h3>";

// If we need class and name...
if ($trainer_class == "Aqua Admin" ||
    $trainer_class == "Elite Four" ||
    $trainer_class == "Leader" ||
    $trainer_class == "Magma Admin" ||
    $trainer_class == "Winstrate") {
    print "<img src='ek_sprites/rse/trainer/$trainer_class $trainer_name.png' alt='$trainer_class $trainer_name'>";
}

// If we need class and gender...
else if ($trainer_class == "Cool Trainer" ||
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
         $trainer_class == "Triathlete Cyclist") {
    // Make query for trainer gender and display correct image
    $trainer_gender_query = "SELECT gender FROM trainer WHERE location LIKE ";
    $trainer_gender_query = $trainer_gender_query."'".$trainer_loc."' AND class LIKE ";
    $trainer_gender_query = $trainer_gender_query."'".$trainer_class."' AND name LIKE ";
    $trainer_gender_query = $trainer_gender_query."'".$trainer_name."';";
    $trainer_gender_result = mysqli_query($conn, $trainer_gender_query) or die(mysqli_error($conn));

    while($row = mysqli_fetch_array($trainer_gender_result, MYSQLI_BOTH))
        print "<img src='ek_sprites/rse/trainer/$trainer_class ($row[gender]).png' alt='$trainer_class $trainer_name ($row[gender])'>";
}

// If we have a rival...
else if ($trainer_class == "Pkmn Trainer") {
    if ($trainer_name == "May (Treecko)" ||
        $trainer_name == "May (Torchic)" ||
        $trainer_name == "May (Mudkip)")
        print "<img src='ek_sprites/rse/trainer/$trainer_class May.png' alt='$trainer_class May'>";
    
    else if ($trainer_name == "Brendan (Treecko)" ||
             $trainer_name == "Brendan (Torchic)" ||
             $trainer_name == "Brendan (Mudkip)")
        print "<img src='ek_sprites/rse/trainer/$trainer_class Brendan.png' alt='$trainer_class Brendan'>";
    
    else
        print "<img src='ek_sprites/rse/trainer/$trainer_class $trainer_name.png' alt='$trainer_class $trainer_name'>";
}

// If we have a Grunt... (Grunt gender not recorded in database or dealt with here yet)
else if ($trainer_name == "Grunt" ||
         $trainer_name == "Grunt (1)" ||
         $trainer_name == "Grunt (2)" ||
         $trainer_name == "Grunt (3)" ||
         $trainer_name == "Grunt (4)" ||
         $trainer_name == "Grunt (5)" ||
         $trainer_name == "Grunt (6)" ||
         $trainer_name == "Grunt (7)" ||
         $trainer_name == "Grunt (8)" ||
         $trainer_name == "Grunt (9)" ||
         $trainer_name == "Grunt (10)" ||
         $trainer_name == "Grunt (11)" ||
         $trainer_name == "Grunt (12)" ||
         $trainer_name == "Grunt (13)" ||
         $trainer_name == "Grunt (14)" ||
         $trainer_name == "Grunt (15)" ||
         $trainer_name == "Grunt (16)") {
    if ($trainer_class == "Team Aqua")
        print "<img src='ek_sprites/rse/trainer/Team Aqua Grunt (m).png' alt='$trainer_class Grunt'>";
    else
        print "<img src='ek_sprites/rse/trainer/Team Magma Grunt (m).png' alt='$trainer_class Grunt'>";
}

// Otherwise we just need class.
else
    print "<img src='ek_sprites/rse/trainer/$trainer_class.png' alt='$trainer_class'>";

print "</div><br>";

// Print all of the trainer's Pokemon
while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
{
    // Sort, name, gender, level
    print "<div class='row'>";
    print "<p class='column'>";
    print "$row[sort]) $row[name]($row[gender]) Lv.$row[level]\n\n";

    // Pic
    print "<img src='ek_sprites/rse/ruby_and_sapphire/$row[dex_num].png'>\n";

    // Type1, type2, item, nature, ability
    print "$row[type1] $row[type2]\n";
    print "@$row[hold_item]\n";
    print "Nature: $row[nature]\n";
    print "Ability: $row[ability]\n";
    print "IV: $row[iv]\n";
    print "</p>";

    // Moves
    print "<p class='column'>";
    print "HP:\t$row[hp] <meter id='hp' min='0' max='255' low='80' high='2550' optimum='120' value='$row[meterHP]'></meter>\n";
    print "ATK:\t$row[atk] <meter id='atk' min='0' max='255' low='80' high='160' optimum='100' value='$row[meterATK]'></meter>\n";
    print "DEF:\t$row[def] <meter id='def' min='0' max='255' low='80' high='230' optimum='100' value='$row[meterDEF]'></meter>\n";
    print "SATK:\t$row[satk] <meter id='satk' min='0' max='255' low='80' high='154' optimum='100' value='$row[meterSATK]'></meter>\n";
    print "SDEF:\t$row[sdef] <meter id='sdef' min='0' max='255' low='80' high='230' optimum='100' value='$row[meterSDEF]'></meter>\n";
    print "SPD:\t$row[spd] <meter id='spd' min='0' max='255' low='80' high='160' optimum='100' value='$row[meterSPD]'></meter>\n\n";
    print "<u>Moves:</u>\n";
    print "$row[move1]\n";
    print "$row[move2]\n";
    print "$row[move3]\n";
    print "$row[move4]";
    print "</p></div>\n";
}

print "</pre>";

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
3.12.23 | 3.25.23</h6><p>

</body>
</html>
