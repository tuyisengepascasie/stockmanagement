<!DOCTYPE html>
<html>
<head>
  <title>ADMIN_LOGN</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>


<body bgcolor="skyblue">
    
    <div class="container" style="width:500px;">
               <?php
            require_once 'connect.php';
            session_start();
            if(isset($_POST['login'])){
                $username= $_POST['username'];
                $password= $_POST['password'];
                if(empty($username)){
                    $errorMsg[]= "Please Fill Username";
                }elseif(empty($password)){
                    $errorMsg[]= "Please fill Password";
                }else{
                    try{
                        $sql=$connection->prepare("SELECT * FROM admin WHERE username=:uname AND password=:upassword");
                        $sql->execute(array(':uname'=>$username,':upassword'=>$password));
                        $row= $sql->fetch(PDO:: FETCH_ASSOC);
                        if($sql->rowCount() > 0){
                            if($username==$row['username']){
                                if($password==$row['password']){
                                    $_SESSION['user_login']= $row['id'];
                                    $loginMsg= "Successfully Login...";
                                    header("refresh:2; managereport.php");
                                }else{
                                    $errorMsg[]= "Wrong Password";
                                }
                                }else{
                                    $errorMsg[]= "Wrong Username";
                            }
                        }
                    }catch(PDOException $e){
                        $e->getMessage();
                    }
                }
            }
            ?>

            <?php
            if(isset($errorMsg)){
                foreach($errorMsg as $error){
        
            ?>
            <div class="errorMsg form-control">
                <strong><?php echo $error;?></strong>
            </div>
            <?php
                }
            }
            if(isset($loginMsg)){

            ?>
            <div class="loginMsg form-control">
                <strong><?php echo $loginMsg;?></strong>
            </div>
            <?php
            }
            ?> 
                <h5 align="center">WELCOME TO ADMIN LOGIN FORM</h5> 
               <center><form action="" method="post">  
                    
                     <label>Username</label>
                     <input type="text" name="username" class="form-control" required/><br><br> 
                       
                     <label>Password</label>  
                <input type="password" name="password" class="form-control" required/><br><br> 
                       
                     <input type="submit" name="login" class="btn btn-info" value="Login" />  
                     
                         </form> 
                         </center>  
                            </body>
                                </html>
                          
    