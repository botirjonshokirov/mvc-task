<h5 class="m-2">Admin panel</h5>
<div class="d-grid gap-2 d-md-flex justify-content-md-end m-2">
	<a href="/main/index/" class="btn btn-primary m-2">Home</a>
	<a href="/admin/logout/" class="btn btn-primary m-2">Logout</a>
</div>
<?php
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$taskGrid = '<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"><a href="?sort=user_name" class="btn btn-secondary">User Name</a></th>
      <th scope="col"><a href="?sort=email" class="btn btn-secondary">Email</a></th>
      <th scope="col"><a href="#" class="btn btn-secondary">Task</a></th>
      <th scope="col"><a href="?sort=checked" class="btn btn-secondary">Checked</a></th>
      <th scope="col"><a href="#" class="btn btn-secondary">Action</a></th>
    </tr>
  </thead>
  <tbody>';
  
foreach ($tasks as $taskRow) {
		$checked = $taskRow['checked'] ? "checked" : "";
	   	$taskGrid .= '<tr>  
	   		<td>'.$taskRow['user_name'].'</td>
	   	 	<td>'.$taskRow['email'].'</td> 
	   	 	<td>'.$taskRow['task'].'</td> 
	   	 	<td> <input class="form-check-input m-0" type="checkbox" disabled '. $checked .'></td>
	   	 	<td><a href="'.$this->utils->sgp($url, 'id_edit', $taskRow['id']).'" class="btn btn-info">Edit</a></td> 
	   	 	</tr>';

}
$taskGrid .= '</tbody></table>';

echo "$taskGrid";
echo "<div class='m-2'> $paginator </div>"; 
?>

<div class="mt-5">
	<form  action="/admin/update/" method="POST">
		<div class="form-group">
			<input type="text" name="task_id" hidden <?php if(isset($vars['id'])) echo 'value="'.$vars['id'].'"'; ?> >
		</div>
		<div class="form-group">
			<label>User Name</label>
			<input type="text" name="user_name" disabled readonly class="form-control" <?php if(isset($vars['user_name'])) echo 'value="'.$vars['user_name'].'"'; ?> >
		</div>
		<div class="form-group">
			<label>Task</label>
			<input type="text" name="task" class="form-control" <?php if(isset($vars['task'])) echo 'value="'.$vars['task'].'"'; ?> >
		</div>
	    <div class="form-group">
		    <input type="checkbox" name="checked" class="btn-check" id="btn-check-2-outlined" <?php if(isset($vars['checked']) && $vars['checked'] > 0) echo 'checked'; ?> autocomplete="off">
			<label class="btn btn-outline-secondary" for="btn-check-2-outlined">Checked</label><br>
		</div>
		<div class="form-group">
			<button type="submit" name="update_form" class="btn btn-primary" <?php if(!isset($vars['id'])) echo "disabled"; ?> >Update</button>
		</div>
	</form>
</div>