<?php

include ('config/db_connect.php');
if (isset($_POST ['delete'])){
    $id_to_delete= mysqli_real_escape_string($conn,$_POST['id_to_delete']);
    $sql="DELETE FROM pizzzas WHERE id=$id_to_delete";
    if(mysqli_query($conn,$sql)){
        header ('location:index.php');
    }{
        echo 'query error:'.mysqli_error($conn);
    }
}
if (isset($_GET['id'])){
    $id=mysqli_real_escape_string($conn, $_GET['id']);
    $sql= "SELECT * FROM pizzzas WHERE id =$id";
    $result= mysqli_query($conn, $sql);
    $pizza= mysqli_fetch_array($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    print_r($pizza);
}
?>
<?php include ('templete/header.php'); ?>
<html>
<div class="container center gray-text">
<?php if($pizza):?>
    <h4><?php echo htmlspecialchars($pizza ['title']);?></h4>
        <p><?php echo date($pizza ['created_at']);?></p>
        <p>created by : <?php echo htmlspecialchars($pizza ['email']);?></p>
        <h5> ingredients</h5>
        <p><?php echo htmlspecialchars($pizza ['ingredients']);?></p>
        <form action="info.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza ['id'];?>">
        <input type="submit" name="delete" value="delete" class="btn brand z-depth-0">

        </form>
<?php else:?>
<h5>no such pizza exists</h5>
<?php endif:?>
</div>
</html>

<?php include ('templete/footer.php'); ?>
