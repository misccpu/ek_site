<!DOCTYPE html>

<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
    <title>Pokemon Emerald Kaizo - Database Pokedex App</title>
    <link rel="stylesheet" href="style.css">

    <script>
        // Swapts the image shown based on a checkbox
        function swap_img() {
            let checkbox = document.getElementById("shininess");
            let regular_pic = document.getElementById("regular");
            let shiny_pic = document.getElementById("shiny");

            if (checkbox.checked == true) {
                regular_pic.style.display = "none";
                shiny_pic.style.display = "block";
            }
            else {
                regular_pic.style.display = "block";
                shiny_pic.style.display = "none";
            }
        }
    </script>
</head>

<body text="white" bgcolor="black">

<h1>===== EK Database Pokedex =====</h1>
<div>
<a href="https://ix.cs.uoregon.edu/~debel/index.html">Home</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/pokedex.php">Pokedex</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/trainerdex.php">TrainerDex</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/locations.php">Locations</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/nuzlocke_tracker.php">Nuzlocke Tracker</a> &#183;
<a href="https://ix.cs.uoregon.edu/~debel/import.html">Import</a><br>
</div>

<hr>

<!-- Query all Pokemon names -->
<?php
    $dropdown_query = "SELECT name FROM pokemon ORDER BY name;";
    $all_names = mysqli_query($conn, $dropdown_query) or die(mysqli_error($conn));
?>

<!-- Dropdown -->
<div>
    <!-- Select a Pokemon to View -->
    <form action='pokedex.php' method='POST'>
        <select name='pkmn_name' id='pkmn_name' onchange='if(this.value != 0) { this.form.submit(); }'>
            <option>Select a Pokemon</option>
            <?php
                while($name_array= mysqli_fetch_array($all_names, MYSQLI_BOTH))
                    print "<option value=$name_array[name]>$name_array[name]</option>";
            ?>
        </select><br>
    </form>
</div>

<hr>

<!-- Get and print Pokedex data -->
<?php
// Prepare.
$pkmn_name = $_POST ['pkmn_name'];
$pkmn_name = mysqli_real_escape_string($conn, $pkmn_name);

// Construct query for Pokemon data
$name_query =
    "SELECT dex_num, name, 
    type1, type2, 
    ability1, ability2, 
    hp, hp AS meterHP, 
    atk, atk AS meterATK,
    def, def AS meterDEF, 
    satk, satk AS meterSATK, 
    sdef, sdef AS meterSDEF, 
    spd, spd as meterSPD
    FROM pokemon ";

if ($pkmn_name == "Select a Pokemon")
    $name_query = $name_query."ORDER BY dex_num;";
else {
    $name_query = $name_query."WHERE name LIKE ";
    $name_query = $name_query."'".$pkmn_name."';";
}

// Make evo queries
$evo_query1 =  "SELECT p.name, l.next_pkmn, l.level
                FROM pokemon p
                    JOIN evolution_levelup l on p.name=l.name
                WHERE p.name LIKE ";
$evo_query1 = $evo_query1."'".$pkmn_name."';";

$evo_query2 =  "SELECT p.name, s.next_pkmn, s.stone
                FROM pokemon p
                    JOIN evolution_stone s on p.name=s.name
                WHERE p.name LIKE ";
$evo_query2 = $evo_query2."'".$pkmn_name."';";

// Construct query for movepool data
$movepool_query =
    "SELECT move_name, level
    FROM movepool_levelup
    WHERE name LIKE ";
$movepool_query = $movepool_query."'".$pkmn_name."'";
$movepool_query = $movepool_query." ORDER BY level ASC;";

// Construct query for encounter data
$enc_query = 
    "SELECT e.location_name, e.floor, e.encounter_type, e.perc FROM encounter e JOIN location l on e.location_name=l.location WHERE name LIKE ";
$enc_query = $enc_query."'".$pkmn_name."'";
$enc_query = $enc_query." ORDER BY l.sort ASC;";

// Make the queries
$result = mysqli_query($conn, $name_query) or die(mysqli_error($conn));
$evo_result1 = mysqli_query($conn, $evo_query1) or die(mysqli_error($conn));
$evo_result2 = mysqli_query($conn, $evo_query2) or die(mysqli_error($conn));
$moves_result = mysqli_query($conn, $movepool_query) or die(mysqli_error($conn));
$enc_result = mysqli_query($conn, $enc_query) or die(mysqli_error($conn));

// Loop through results and print data!
print "<div class='row'>";
print "<pre>";
while ($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
    // Dex num and name
    print "<b>#$row[dex_num]</b><br>";
    print "<h3>$row[name]</h3>";

    // Pic
    if ("$row[dex_num]" <= 151) {
        print "<p id='regular'><img src='ek_sprites/frlg/FRLG/$row[dex_num].png' alt='$row[name]'></p>";
        print "<p id='shiny' style='display:none'><img src='ek_sprites/frlg/Shiny/$row[dex_num].png' alt='$row[name]'></p>";
        print "<input type='checkbox' id='shininess' onclick='swap_img()'>Shiny?<br><br>";
    }
    else {
        print "<p id='regular'><img src='ek_sprites/rse/ruby_and_sapphire/$row[dex_num].png' alt='$row[name]'></p>";
        print "<p id='shiny' style='display:none'><img src='ek_sprites/rse/ruby_and_sapphire_shiny/$row[dex_num].png' alt='$row[name]'></p>";
        print "<input type='checkbox' id='shininess' onclick='swap_img()'>Shiny?<br><br>";
    }

    // Type1, type2, ability1, ability2, stats
    print "<u>Types:</u>\n$row[type1]\n$row[type2]\n";
    print "<u>Abilities:</u>\n$row[ability1]\n$row[ability2]\n"; 
    print "HP:\t$row[hp] <meter id='hp' min='0' max='255' low='80' high='255' optimum='120' value='$row[meterHP]'></meter>\n";
    print "ATK:\t$row[atk] <meter id='atk' min='0' max='255' low='80' high='160' optimum='100' value='$row[meterATK]'></meter>\n";
    print "DEF:\t$row[def] <meter id='def' min='0' max='255' low='80' high='230' optimum='100' value='$row[meterDEF]'></meter>\n";
    print "SATK:\t$row[satk] <meter id='satk' min='0' max='255' low='80' high='154' optimum='100' value='$row[meterSATK]'></meter>\n";
    print "SDEF:\t$row[sdef] <meter id='sdef' min='0' max='255' low='80' high='230' optimum='100' value='$row[meterSDEF]'></meter>\n";
    print "SPD:\t$row[spd] <meter id='spd' min='0' max='255' low='80' high='160' optimum='100' value='$row[meterSPD]'></meter>\n\n";

    while ($e = mysqli_fetch_array($evo_result1, MYSQLI_BOTH))
        print "$pkmn_name evolves into $e[next_pkmn] at level $e[level]\n";

    while ($e = mysqli_fetch_array($evo_result2, MYSQLI_BOTH))
        print "$pkmn_name evolves into $e[next_pkmn] by using a $e[stone]\n";
    
    print "<br>";

    print "<u>Learnset:</u>\n";
    while ($e = mysqli_fetch_array($moves_result, MYSQLI_BOTH))
        print "Lv.$e[level] - $e[move_name]<br>";
    print "\n";

    print "<u>Available Locations:</u>\n";
    while ($e = mysqli_fetch_array($enc_result, MYSQLI_BOTH))
        print "$e[location_name] - $e[floor] - $e[encounter_type] - $e[perc]%<br>";
    print "\n";
}

print "</pre>";
print "</div>";

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
<a href="https://ix.cs.uoregon.edu/~debel/import.php">Import</a>
</div>

<p><h6>Final Project | CS 451 | Donny Ebel<br>
Created | Last Edited<br>
3.12.23 | 3.25.23</h6><p>

</body>
</html>
