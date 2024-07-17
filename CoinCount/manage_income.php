<?php
   include('header.php');
   checkUser();
   userArea();
   $msg="";
   $amount="";
   $date=date('Y-m-d');
   $label="Add";
   if(isset($_GET['id']) && $_GET['id']>0){
   	$label="Edit";
   	$id=get_safe_value($_GET['id']);
   	$res=mysqli_query($con,"select * from income where id=$id");
   	if(mysqli_num_rows($res)==0){
   		redirect('income.php');
   		die();
   	}
   	$row=mysqli_fetch_assoc($res);
   	$amount=$row['amount'];
   	$date=$row['date'];
   	if($row['added_by']!=$_SESSION['UID']){
   		redirect('income.php');
   	}
   	
   }
   
   if(isset($_POST['submit'])){
   	$amount=get_safe_value($_POST['amount']);
   	$date=get_safe_value($_POST['date']);
   	
   	$type="add";
   	$sub_sql="";
   	if(isset($_GET['id']) && $_GET['id']>0){
   		$type="edit";
   		$sub_sql="and id!=$id";
   	}
   	
   	$added_by=$_SESSION['UID'];
   	$sql="insert into income(amount,date,added_by) values('$amount','$date','$added_by')";
   
   	if(isset($_GET['id']) && $_GET['id']>0){
   		$sql="update income set amount='$amount',date='$date' where id=$id and added_by=$added_by";
   	}
   	mysqli_query($con,$sql);
   	redirect('income.php');
   }
   ?>
<script>
   setTitle("Manage Income");
   selectLink('income_link');
</script>
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <h2><?php echo $label?> Income</h2>
               <a href="income.php">Back</a>
               <div class="card">
                  <div class="card-body card-block">
                     <form method="post" class="form-horizontal">
      
                        <div class="form-group">												<label class="control-label mb-1">Amount</label>
                           <input type="text" name="amount" required value="<?php echo $amount?>" class="form-control" rquired>
                        </div>
                       
                        <div class="form-group">												<label class="control-label mb-1">Income Date</label>
                           <input type="date" name="date" required value="<?php echo $date?>" class="form-control" rquired max="<?php echo date('Y-m-d')?>">
                        </div>
                        <div class="form-group">												
                           <input type="submit" name="submit" value="Submit"  class="btn btn-lg btn-info btn-block">                          
                        </div>
                        <div id="msg"><?php echo $msg?></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
   include('footer.php');
   ?>