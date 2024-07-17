<?php
   include('header.php');
   checkUser();
   userArea();
   
   if(isset($_GET['type']) && $_GET['type']=='delete' && isset($_GET['id']) && $_GET['id']>0){
   	$id=get_safe_value($_GET['id']);
   	mysqli_query($con,"delete from income where id=$id");
   	echo "<br/>Data deleted<br/>";
   }
   
   $res=mysqli_query($con,"select * from income where income.added_by='".$_SESSION['UID']."' order by date asc");
   ?>
<?php
   if(mysqli_num_rows($res)>0){
   ?>
<script>
   setTitle("Income");
   selectLink('income_link');
</script>
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <h2>Income</h2>
               <a href="manage_income.php">Add Income</a>
               <br/><br/>
               <div class="table-responsive table--no-card m-b-30">
                  <table class="table table-borderless table-striped table-earning">
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>Amount</th>
                           <th>Date</th>
                           <th></th>
                        </tr>
                     <tbody>
                        <?php while($row=mysqli_fetch_assoc($res)){?>
                        <tr>
                           <td><?php echo $row['id'];?></td>
                           <td><?php echo $row['amount']?></td>
                           <td><?php echo $row['date']?></td>
                           <td>
                              <a href="manage_income.php?id=<?php echo $row['id'];?>">Edit</a>&nbsp;
                              <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id'];?>','income.php')">Delete</a>
                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                  </table>
                  <?php }
                   else { ?>
                     <script>
                         setTitle("Income");
                         selectLink('income_link');
                     </script>
                     <div class="main-content">
                         <div class="section__content section__content--p30">
                             <div class="container-fluid">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <h2>Income</h2>
                                         <a href="manage_income.php">Add Income</a>
                                         <br/><br/>
                                         <div class="table-responsive table--no-card m-b-30">
                                             <table class="table table-borderless table-striped table-earning">
                                                 <thead>
                                                     <tr>
                                                         <th>ID</th>
                                                         <th>Amount</th>
                                                         <th>Date</th>
                                                         <th></th>
                                                     </tr>
                                                 </thead>
                                                 <tbody>
                                                     <tr>
                                                         <td colspan="6">No data found</td>
                                                     </tr>
                                                 </tbody>
                                             </table>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php } ?>
                     
<?php
   include('footer.php');
   ?>