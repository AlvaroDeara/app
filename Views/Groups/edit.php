<h1>Edit Group</h1>

<form action="groups/edit" method="POST">
	<?php foreach($groups as $group){ ?>
	<input type="hidden" name="id" value="<?php echo $group["id"]; ?>">
	<p>Name: <input type="text" name="name" value="<?php echo $group["name"]; ?>"></p>
    <?php }?>
	<p><input type="submit" value="Save"></p>
</form>