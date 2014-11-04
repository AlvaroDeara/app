<h1>Add User</h1>

<form action="users/add" method="POST">
	<p>First name: <input type="text" name="first_name"></p>
	<p>Last name: <input type="text" name="last_name"></p>
	<p>Email: <input type="text" name="email"></p>
	<p>Username: <input type="text" name="username"></p>
    <p>Age: <input type="text" name="age"></p>

    <p>Grupo: 
    <select name="group_id">
    	<?php foreach($groups as $group){ ?>
    	<option value="<?=$group['id']?>"><?=$group['name']?></option>
        <?php }?>
    </select>
    </p>
    
	<p><input type="submit" value="Save"></p>
</form>