<h5 class="m-2">Task list</h5>
<div class="d-grid gap-2 d-md-flex justify-content-md-end m-2">
	<a href="/admin/login" class="btn btn-primary m-2 ">Admin</a>
</div>
<?php

$taskGrid = '<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col"><a href="?sort=user_name" class="btn btn-secondary">User Name</a></th>
      <th scope="col"><a href="?sort=email" class="btn btn-secondary">Email</a></th>
      <th scope="col"><a href="#" class="btn btn-secondary">Task</a></th>
      <th scope="col"><a href="?sort=checked" class="btn btn-secondary">Checked</a></th>
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
     </tr>';
}

$taskGrid .= '</tbody></table>';

echo "$taskGrid";
echo "<div class='m-2'> $paginator </div>"; 
?>

<div class="mt-5">
  <form  action="/main/insert/" method="POST">
    <div class="form-group">
      <label>User Name</label>
      <input type="text" name="user_name" class="form-control">
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control">
    </div>
    <div class="form-group">
      <label>Task</label>
      <input type="text" name="task" class="form-control">
    </div>
    <div class="form-group">
      <button type="submit" name="insert_form" class="btn btn-primary">Add Task</button>
    </div>
  </form>
</div>