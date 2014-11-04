<a href="groups/add">Add Group</a>
<a href="users">User</a>

<table border="1">
	<tr>
		<th>ID</th>		
		<th>Name</th>
        <th>Action</th>			
	</tr>
	
	<?php
		foreach($groups as $group){ ?>
		<tr>
		<td><?php echo $group['id']; ?></td>
		<td><?php echo $group['name']; ?></td>
		<td>
			<a href="groups/edit/<?php echo $group['id']; ?>">Edit</a> | 
			<a href="groups/delete/<?php echo $group['id']; ?>">Delete</a>
		</td>
		</tr>
	<?php }	?>	
	
</table>