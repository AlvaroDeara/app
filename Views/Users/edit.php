<h1>Edit User</h1>

<form action="users/edit" method="POST">
	<?php foreach($users as $user){ ?>
	<input type="hidden" name="id" value="<?php echo $user["id"]; ?>">
	<p>First name: <input type="text" name="first_name" value="<?php echo $user["first_name"]; ?>"></p>
	<p>Last name: <input type="text" name="last_name" value="<?php echo $user["last_name"]; ?>"></p>
	<p>Email: <input type="text" name="email" value="<?php echo $user["email"]; ?>"></p>
	<p>Username: <input type="text" name="username" value="<?php echo $user["username"]; ?>"></p>
    
    <?php }?>
    
    <p>Grupo: 
    <select name="group_id">
    	<?php foreach($groups as $group){ ?>
    		<option value="<?=$group['id']?>"
            <?php if($user['group_id']==$group['id']){echo 'selected';}?>
            ><?=$group['name']?></option>
        <?php }?>
    </select>
    </p>
    
	<p><input type="submit" value="Save"></p>
</form>