<!DOCTYPE html>

<?php

include('connectionData.txt');

$conn = mysqli_connect($server, $user, $pass, $dbname, $port)
or die('Error connecting to MySQL server.');

?>

<html>
<head>
    <title>Pokemon Emerald Kaizo - Nuzlocke Tracker</title>

    <link rel="stylesheet" href="style.css">

    <script>
        let all_thumbnails = Array(387);
        for (let i = 1; i <= 386; i++) {
            all_thumbnails[i] = new Image(32, 32);
            if (i < 10)
                all_thumbnails[i].src = "ek_sprites/rse/icons/00" + i + ".gif";
            else if (i < 100)
                all_thumbnails[i].src = "ek_sprites/rse/icons/0" + i + ".gif";
            else
                all_thumbnails[i].src = "ek_sprites/rse/icons" + i + ".gif";
        }

        function swap_img() {
            let select = document.getElementById("swap");
            let selection = select.selectedIndex;
            let img = select.options[selection].value;
            src = img;
        }
    </script>
</head>

<h1>===== EK Database Nuzlocke Tracker =====</h1>

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

<?php
    // Query location names
    $location_query = 
            "SELECT location 
            FROM ek_data.location 
            WHERE sort IS NOT NULL 
            ORDER BY sort ASC;";
    $all_locations = mysqli_query($conn, $location_query) or die(mysqli_error($conn));

    // Print encounter dropdowns per location and floor
    while ($row = mysqli_fetch_array($all_locations, MYSQLI_BOTH)) {
        print "<div>";

        // Assemble and make query for all encounters in that location
        $encounter_query =
            "SELECT DISTINCT p.dex_num, e.name, e.floor, e.encounter_type, e.perc
            FROM ek_data.encounter e
                JOIN pokemon p ON e.name=p.name
            WHERE e.location_name LIKE ";
        $encounter_query = $encounter_query."'$row[location]'";
        $encounter_query = $encounter_query." ORDER BY e.floor, e.encounter_type, e.perc ASC;";
        $all_encounters = mysqli_query($conn, $encounter_query) or die(mysqli_error($conn));

        // Location title
        print "<h5>$row[location]";

        // Encounter dropdown
        print "<img src='ek_sprites/rse/icons/132.gif' alt='thumbnail' width='32' height='32' name='thumbnail' id='thumbnail'></h5>";
        print "<form name='img_form'><select name='swap' id='swap' onchange=''>";   // TODO: make this icon change with selection!
        print "<option>Encounter</option>";
        while ($enc = mysqli_fetch_array($all_encounters, MYSQLI_BOTH))
            print "<option value='ek_sprites/rse/icons/$row[dex_num].gif'>$enc[name] [$enc[floor] | $enc[encounter_type] | $enc[perc]%]</option>";
        print "</select></form>";

        // Nickname textbox
        print "<input type='text' name='$row[location] $enc[name]' id='$row[location] $enc[name]' size='10' placeholder='Nickname'><br>";

        // Capture status dropdown
        print "<select name='$row[location] $enc[name] status' id='$row[location] $row[name]'";
        print "<option value='none'>Status</option>";
        print "<option value='captured'>Captured</option>";
        print "<option value='received'>Received</option>";
        print "<option value='missed'>Missed</option>";
        print "<option value='deceased'>Deceased</option>";
        print "</select>";

        print "</div><br>";
    }
?>

</body>

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
Created | Last Edited: 3.14.23 | 3.22.23</h6><p>

</html>
