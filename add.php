<html>
<?php
// var_dump("test");
include ('config/db_connect.php');
$title=$email=$ingredients='';
$errors = array('email'=>'', 'title'=>'', 'ingredients'=>'');
// var_dump($_POST);    
 if(isset($_POST['submit'])){   
    // var_dump("test");
    if(empty($_POST['email'])){
        $errors['email']="An Email is requaied <br/>";
    }else{
        $email = $_POST['email'];
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['email']= 'email must be a valid address';
        }     
    }
    if(empty($_POST['title'])){
        $errors ['title'] ='A title is required <br/>';
    }else{
        $title = $_POST ['title'];
        if(!preg_match('/^[a-zA-Z\s]+$/' , $title)){
            $errors['title']= 'Title must be letters and spaces only';
        }
      }
    if(empty($_POST['ingredients'])){

        $errors['ingredients']= "At least one Ingredients is requaied <br/>";
    }else{
        $ingredients = $_POST ['ingredients'];
        if(!preg_match('/^([a-zA-Z\s]+)(,s*[a-zA-Z\s]*)*$/', $ingredients)){
            $errors['ingredients']= 'Ingredients must be comma separeted list';
        }
    }
    if (array_filter($errors)){
        // header ('location:index.php');
    }else{
        $email= mysqli_real_escape_string($conn, $_POST['email']);
        $title= mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients= mysqli_real_escape_string($conn, $_POST['ingredients']);
        $sql= "INSERT INTO pizzzas (title,email,ingredients) VALUES ('$title','$email','$ingredients')";
        if(mysqli_query($conn,$sql)){

        }else{
            echo 'query error:'.mysqli_error($conn);
        }
    }
} 

?>


<?php include ('templete/header.php'); ?>
<sction class="container">
<h4 class="center">Add a pizza</h4>
<form class="white" action="add.php" method="POST">
<label >Your Email</label>
<input type="text" name="email" value="<?php echo $email?>">
<div class ="red-text"><?php echo $errors['email']?></div>
<label >Pizza Title</label>
<input type="text" name="title" value="<?php echo $title?>">
<div class ="red-text"><?php echo $errors['title']?></div>
<label >Ingredients comma separeted </label>
<input type="text" name="ingredients" value="<?php echo $ingredients?>">
<div class ="red-text"><?php echo $errors['ingredients']?></div>
<div class="center">
<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
</div>
</form>
</sction>
<?php include ('templete/footer.php'); ?>

</body>
</html>
