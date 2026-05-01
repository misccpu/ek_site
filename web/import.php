<!DOCTYPE html>

<html>

<head>
    <title>Pokemon Emerald Kaizo - Database Import</title>
    <link rel="stylesheet" href="style.css">

    <script>
        function parse_trainer_text(txt) {
            let trainer = txt.split("\n\n");

            // The first three lines are trainer location, class, and name
            for (let i = 0; i < trainer.length; i++) {
                let trainer_and_pokemon = trainer[i].split("\n");
                let l = trainer_and_pokemon[0]; // location
                let c = trainer_and_pokemon[1]; // class
                let n = trainer_and_pokemon[2]; // name

                // Now each line following is a Pokemon
                for (let j = 3; j < trainer_and_pokemon.length; j++) {
                    let sort = j - 2;

                    // Split line in half
                    let half = trainer_and_pokemon[j].split(": "); // half[0] is name, g, level, item | half[1] is moves, iv, nature, ability

                    // First half: separate item from other stuff
                    let first_half_split = half[0].split(" "); // first_half_split formatting is: name gender level @item
                    let chunks = half[0].split("@");

                    // Extract name, gender, level, item!
                    let pkmn_name = first_half_split[0];
                    let gender = first_half_split[1];
                    let level = first_half_split[2];
                    let item = chunks[1];

                    // Now get moves, iv, nature, ability
                    let second_half_split = half[1].split(", "); // second_half_split formatting is: move1, move2, move3, move4 [iv|nature] ability
                    let move1 = second_half_split[0];
                    let move2 = second_half_split[1];
                    let move3 = second_half_split[2];
                    let move4_and_stuff = second_half_split[3].split(" \[");
                    let move4 = move4_and_stuff[0];
                    let stuff = move4_and_stuff[1].split("\|");
                    let iv = stuff[0];
                    stuff = stuff[1].split("\] ");
                    let nature = stuff[0];
                    let ability = stuff[1];

                    // Print output!!
                    document.write("INSERT INTO `ek_data`.`trainer_pokemon` \(`location`, `class`, `trainer_name`, `sort`, `name`, `gender`, `level`, `hold_item`, `move1`, `move2`, `move3`, `move4`, `iv`, `nature`, `ability`\) VALUES \(\'");
                    document.write(l);
                    document.write("\', \'");
                    document.write(c);
                    document.write("\', \'");
                    document.write(n);
                    document.write("\', \'");
                    document.write(sort);
                    document.write("\', \'");
                    document.write(pkmn_name);
                    document.write("\', \'");
                    document.write(gender);
                    document.write("\', \'");
                    document.write(level);
                    document.write("\', \'");
                    document.write(item);
                    document.write("\', \'");
                    document.write(move1);
                    document.write("\', \'");
                    document.write(move2);
                    document.write("\', \'");
                    document.write(move3);
                    document.write("\', \'");
                    document.write(move4);
                    document.write("\', \'");
                    document.write(iv);
                    document.write("\', \'");
                    document.write(nature);
                    document.write("\', \'");
                    document.write(ability);
                    document.write("\');");
                    document.write("<br>");
                }
                //document.write("<br>");
            }
        }

        function parse_text(txt) {
            let movepools = txt.split("\n\n");

            // The first line is the name
            for (let i = 0; i < movepools.length; i++) {
                let elements = movepools[i].split("\n");
                name = elements[0];

                // All other lines are a number, a space, and a move name (which may include a space)
                for (let j = 1; j < elements.length; j++) {
                    // Grab the number before only the first space
                    let x = elements[j].split(/ (.*)/);

                    // Print output
                    document.write("INSERT INTO `ek_data`.`movepool_levelup` \(`pokemon_name`, `move_name`, `level`\) VALUES \(\'");
                    document.write(name);
                    document.write("\', \'");
                    document.write(x[1]);
                    document.write("\', \'");
                    document.write(x[0]);
                    document.write("\');");
                    document.write("<br>");
                }
            }
        }

        // Used to parse encounters; kinda jank
        function parse_encounter_text(txt) {
            // Parse the data
            let loc = txt.split("\n");
            let new_txt = loc[1].replaceAll(", ", "<br>");
            let type = new_txt.split(": ");
            new_txt = type[1].replaceAll(", ", "<br>");
            new_txt = new_txt.replaceAll("% ", "<br>");
            let elements = new_txt.split("<br>");

            // Spit out queries to add Encounters
            for (let i = 0; i < elements.length; i += 2) {
                document.write("INSERT INTO `ek_data`.`encounter` \(`location_name`, `encounter_type`, `pokemon_name`, `%`\) VALUES \(\'");
                document.write(loc[0]);
                document.write("', '")
                document.write(type[0]);
                document.write("', '");
                document.write(elements[i + 1]);
                document.write("', '");
                document.write(elements[i]);
                document.write("');<br>");
            }
        }
    </script>
</head>

<body text="white" bgcolor="black">
    <h1>===== EK DATABASE IMPORT =====</h1>
    <?php
    include('header.php');
    ?>

    <div>
        <p>Enter your data:</p>
        <textarea name="input" id="input" rows="20" cols="50"></textarea><br>

        <button type="button" onclick="parse_trainer_text(document.getElementById('input').value)">GO</button>
    </div>

    <br>

    <div id="output">
        <h5>Results</h5>
    </div>

    <?php
        include('footer.php');
    ?>

</body>

</html>