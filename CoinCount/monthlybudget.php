<?php
   include('header.php');
   checkUser();
   userArea();

   $amount="";
   $expense="";
   $investment="";
   $savings="";
   $desireFund = "";
   $emergencyFund ="";
   
?>
<script>
   setTitle("Monthly Budget");
   selectLink('monthlybudget_link');
</script>
<div class="main-content">
   <div class="section__content section__content--p30">
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12">
               <h2>Monthly Budget Planning</h2>
               <a href="dashboard.php">Back</a>
               <div class="card">
                  <div class="card-body card-block">
                     <form method="post" class="form-horizontal">
                        <div class="form-group">
                        <div class="form-group">												<label class="control-label mb-1">Enter your monthly income</label>
                           <input type="number" name="income" class="form-control" rquired>
                        </div>
                        <div class="form-group">												
                           <input type="submit" name="submit" value="Submit"  class="btn btn-lg btn-info btn-block">                          
                        </div>
                        <?php
                                if (isset($_POST['submit'])) {
                                $amount = $_POST['income'];
                                $expense = $amount * 0.30;
                                $investment = $amount * 0.20;
                                $savings = $amount * 0.20;
                                $desireFund = $amount * 0.20;
                                $emergencyFund = $amount * 0.10;
                             }
                        ?>
                         <br/><br/>
                        <div class="table-responsive table--no-card m-b-30">
                  <table class="table table-borderless table-striped table-earning">
                     <thead>
                        <tr>
                           <th>Category</th>
                           <th>Amount</th>
                           <th></th>
                        </tr>
                        <tr>
                           <td>Expense</td>
                           <td><?php echo $expense;?></td>
                        </tr>
                        <tr>
                           <td>Investment</td>
                           <td><?php echo $investment;?></td>
                        </tr>
                        <tr>
                           <td>Savings</td>
                           <td><?php echo $savings;?></td>
                        </tr>
                        <tr>
                           <td>Desire Fund</td>
                           <td><?php echo $desireFund;?></td>
                        </tr>
                        <tr>
                           <td>Emergency Fund</td>
                           <td><?php echo $emergencyFund;?></td>
                        </tr>
                     </tbody>
                  </table>
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