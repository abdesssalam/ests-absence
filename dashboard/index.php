<?php require_once '../includes/header.php' ?>
dashboard
<?php
$persons = simplexml_load_file('../db/absence.xml');

?>
<table>
	<tr>
		<th>nom</th>
		<th>prenom</th>

	</tr>
	<?php foreach($persons->person as $person) { ?>
	<tr>
		<td><?php echo $person->nom; ?></td>
		<td><?php echo $person->prenom; ?></td>

    </tr>
    <?php
    }
    ?>
<?php require_once '../includes/footer.php' ?>