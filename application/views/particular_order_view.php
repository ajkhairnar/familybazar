<style>

@media print {
  #page_b {page-break-after: always;}
  #print_btn{display:none;}
  #navbreadcrumb{display:none;}
  #myTable_paginate{
      display:none;
  }
}

</style>
  <?php include('common/header.php')?>

<!-- sidebar -->
<?php include('common/sidebar.php')?>

<!-- Main Content -->
<main class="body-content">

  <!-- header -->
  <?php include('common/navbar.php')?>

  <div class="ms-content-wrapper">
      <div class="row">

        <div class="col-md-12">
          <nav aria-label="breadcrumb" id="navbreadcrumb">
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Sales</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sales Details</li>
            </ol>

            
          </nav>

          <div class="row " id="print_btn">
                <div class="col">
                  <button onclick="window.print()" class="btn btn-info btn-sm float-right mr-5 mt-0 mb-2">Print now</button>
                </div>
              </div>
            
            

        

           
          <!-- //// -->
            <div class="ms-panel">
              
             
                <div class="ms-panel-header" > 
                  <h6>Sales Details</h6>
                </div>
                <div class="ms-panel-body">
                <div class="row">
                <div class="col">
                    <span> Agent Name : <?=$sales->sales_agentname?></span>  <br><br>
                    Sale Date : <?=$sales->sales_date?> <br><br>
                   
                </div>

                <div class="col">
                    Sales Status : <?=$sales->sales_status?> <br><br>
                    Shop Name :  <?=$sales->sales_shopname?>  <br><br>
                   
                </div>

                <div class="col">
                Shop Owner : <?=$sales->sales_shopowner?>  <br><br>
                    Address : <?=$sales->sales_address?>  <br><br>
                </div>
            </div>
            <div class="table-responsive">
                
            
              
                        <table id="myTable" class="table w-100 thead-primary" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th>Srno</th>
                                    <th>Product Name </th>
                                    <th>Product Variation </th>
                                    <th>Product MRP. </th>
                                    <th>Product QTY. </th>
                                    <th>Final Total</th>
                                  
                                </tr>
                            </thead>

                            <tbody>
                              <?php     
                                $finaltotal=0;
                                $cnt=1;
                              foreach($subsales as $details) {  
                                
                                      $finaltotal =  $finaltotal + $details->p_mrpcalc;
                                  ?>
                                <tr>
                                    <th><?= $cnt ?> </th>
                                    <th> <?=$details->p_name?> </th>
                                    <th><?=$details->p_var?> </th>
                                    <th><?=$details->p_mrp?> </th>
                                    <th><?=$details->p_qty?> </th>
                                    <th><?=$details->p_mrpcalc?> </th>
                                    

                                    
                                    
                                </tr>

                               <?php $cnt++; } ?>
                          
                                   
                                
                            </tbody>
                        </table>
                   
              
            </div>

            <div class="row">
               <div class="col mt-3">
               <!--<span style="font-size: 15px; font-weight: 600;"> Total Discount :  </span> <br><br>-->
                  <span style="font-size: 15px; font-weight: 600;">Total  :  <?= $finaltotal ?> </span> <br><br>
               </div>
            </div>
                  
                  
                </div>
                <div id="page_b"></div>
             
            </div>
           

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>


<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

    


</script>

