<?php
include('config/db_connect.php');
$sql= "SELECT id , title , ingredients FROM pizzzas ORDER BY created_at";
$result = mysqli_query($conn,$sql);
$pizzzas = mysqli_fetch_all($result,MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<html>
<?php include ('templete/header.php'); ?>
<h4 class ="center grey-text">Pizzas</h4>
<div class ="container">
<div class="row">
<?php foreach ($pizzzas as $pizza):?>
<div class="col s6 md3">
<div class="card z- depth-0">
<div class="content center">
<img src="pizza.png" class="pizza">
<h6><?php echo htmlspecialchars($pizza['title']);?></h6>
<ul>
<?php foreach (explode(',',$pizza['ingredients'])as $ing):?>
<li><?php echo htmlspecialchars ($ing); ?></li>
<?php endforeach; ?> 

</ul>
</div>
<div class="card-action right-align">
<a href="info.php ?id=<?php echo $pizza ['id'] ?>" class="brand-text">More Info</a>
</div>
</div>
</div>
<?php endforeach;?>
</div>
</div>
<?php if (count($pizzzas)>=3){ ?>
<p>There are 2 or more pizzas</p>
<?php }else { ?>
<p>there are less than 3</p>
<?php }?>
<?php include ('templete/footer.php'); ?>

</body>
</html>