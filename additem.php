<?php
require 'connect.php';
$message = '';
if (isset ($_POST['item_name']) && isset($_POST['cost']) && isset($_POST['enter_date']) && isset($_POST['serial_number'])) {
  $item_name = $_POST['item_name'];
  $cost = $_POST['cost'];
  $enter_date = $_POST['enter_date'];
  $serial_number = $_POST['serial_number'];
  $sql='INSERT INTO item_tbl( item_name, cost, enter_date, serial_number) VALUES (:item_name,:cost,:enter_date,:serial_number)';
  //$sql = 'INSERT INTO people(name, email) VALUES(:name, :email)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':item_name' => $item_name, ':cost' => $cost, ':enter_date' => $enter_date,':serial_number' => $serial_number,])) {
    $message = 'data inserted successfully';
  }



}


 ?>
<?php require 'header1.php'; ?><br>
<?php require 'header2.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
     <center> <h2>Add new item</h2></center>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <div class="form-group">
          <label for="name">Name_item</label>
          <input type="text" name="item_name" id="item_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="cost">cost</label>
          <input type="text" name="cost" id="cost" class="form-control">
        </div>
        <div class="input-group">Borrowed Date:<br><br>
    <div class="input-group-prepend">
      <span class="input-group-text"> <i class="fa fa-calendar-alt"></i> </span>
    </div>
  <input type="date" lass="form-control col-lg-7 shadow-lg"  max="<?=date('d-m-Y')?>" name="enter_date" required />
    </div> <!-- input-group.// -->
  </div>
        <div class="form-group">
          <label for="out_date">Serial Number</label>
          <input type="text" name="serial_number" id="out_date" class="form-control">
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Add item</button>
        
        </div>
      </form>
      
    </div>
  </div>
</div>

