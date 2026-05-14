<!DOCTYPE html>

<br>

<div>
    <a href="<?= BASE_URL ?>index.php">Home</a> &#183;
    <a href="<?= BASE_URL ?>pokedex.php">Pokedex</a> &#183;
    <a href="<?= BASE_URL ?>trainerdex.php">Trainerdex</a> &#183;
    <a href="<?= BASE_URL ?>locations.php">Encounter Locations</a> &#183;
    <!-- <a href="<?= BASE_URL ?>nuzlocke_tracker.php">Nuzlocke Tracker</a> &#183; -->
    <a href="<?= BASE_URL ?>import.php">Import</a> &#183;
    <a href="<?= BASE_URL ?>movepool_import.php">Movepool Import</a><br>
</div>

<p><h6>
    <footer>
        <p>&copy; <?php date_default_timezone_set('America/Los_Angeles'); echo date("Y"); ?> Donny Ebel (<a href="<?= BASE_URL ?>https://github.com/misccpu">github: misccpu</a>)</p>
        <p>Pokémon and related content are trademarks of Nintendo, Game Freak, and The Pokémon Company.</p>
        <p>This site is not affiliated with or endorsed by Nintendo or The Pokémon Company.</p>
        <p>Last updated: <?php echo date("F j, Y", filemtime($_SERVER['SCRIPT_FILENAME'])); ?></p>
    </footer><br>
</h6><p>