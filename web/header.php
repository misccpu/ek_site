<!DOCTYPE html>

<?php
    // For filepath links
    // ONCE DEPLOYED change '/ek_data/' to '/'
    define('BASE_URL', '/ek_site/');
?>

<div>
    <a href="<?= BASE_URL ?>index.php">Home</a> &#183;
    <a href="<?= BASE_URL ?>pokedex.php">Pokedex</a> &#183;
    <a href="<?= BASE_URL ?>trainerdex.php">Trainerdex</a> &#183;
    <a href="<?= BASE_URL ?>locations.php">Encounter Locations</a> &#183;
    <a href="<?= BASE_URL ?>nuzlocke_tracker.php">Nuzlocke Tracker</a> &#183;
    <a href="<?= BASE_URL ?>import.php">Import</a><br>
</div>

<br>