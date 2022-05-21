<?php require 'header1.php'; ?><br>
<?php require 'header2.php'; ?>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
     <center> <h2>Borrow any item you want</h2></center>
    </div>
    <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
      <form method="post">
        <?php
require 'connect.php';
$message = '';
if (isset ($_POST['fullname'])  && isset($_POST['phonenumber']) && isset($_POST['borrowdate']) && isset($_POST['item_id']) ) {
  $fullname = $_POST['fullname'];
  $phonenumber = $_POST['phonenumber'];
    $email = $_POST['email'];
  $borrowdate = $_POST['borrowdate'];

  $item_id = $_POST['item_id'];
  $sql = 'INSERT INTO person(fullname, phonenumber,email, borrowdate, item_id) VALUES(:fullname, :phonenumber, :email, :borrowdate, :item_id)';
  $statement = $connection->prepare($sql);
  if ($statement->execute([':fullname' => $fullname, ':phonenumber' => $phonenumber ,':email' => $email , ':borrowdate' => $borrowdate, ':item_id' => $item_id ])) {
    $message = 'data inserted successfully';
  }



}


 ?>
 <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>
        <div class="form-group">
          <label for="full_name">FullName</label>
          <input type="text" name="fullname" id="full_name" class="form-control">
        </div>
        <div class="form-group">
          <label for="phonenumber">Phone number</label>
          <input type="text" name="phonenumber" id="pnumber" class="form-control">
        </div>
        <div class="form-group">
          <label for="email">Enter email</label>
          <input type="email" name="email" id="email" class="form-control">
        </div>
           <div class="form-group">
  <div class="input-group">Borrowed Date:<br><br>
    <div class="input-group-prepend">
      <span class="input-group-text"> <i class="fa fa-calendar-alt"></i> </span>
    </div>
  <input type="date" lass="form-control col-lg-7 shadow-lg"  max="<?=date('d-m-Y')?>" name="borrowdate" required />
    </div> <!-- input-group.// -->
  </div>
        <div class="form-group">
          <?php
require 'connect.php';
$sql = 'SELECT * FROM item_tbl';
$statement = $connection->prepare($sql);
$statement->execute();
$item_tbl= $statement->fetchAll(PDO::FETCH_OBJ);
 ?>
  <?php foreach($item_tbl as $st): ?>
          <label for="select">select item</label>
          <select name="item_id" id="select" class="form-select">
            <option value="<?= $st->item_id; ?>"><?= $st->item_name; ?></option>
          </select>
           <?php endforeach; ?>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-info">Tira</button>
        
        </div>
      </form>
        
    </div>
  </div>
</div>
