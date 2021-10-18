<style>

@media print {
  #page_b {page-break-after: always;}
  #print_btn{display:none;}
  #navbreadcrumb{display:none;}
 #th1{
    color:black;
    border: 1px solid black;
  }
  #td1{
   
    border: 1px solid black;
  }
}

</style>
  <?php include('common/links.php')?>

<!-- sidebar -->
<?php //include('common/sidebar.php')?>

<!-- Main Content -->
<main class="body-content">

  <!-- header -->
  <?php //include('common/navbar.php')?>

  <div class="ms-content-wrapper">
      <div class="row">

        <div class="col-md-10">
          <!--<nav aria-label="breadcrumb" id="navbreadcrumb">-->
          <!--  <ol class="breadcrumb pl-0">-->
          <!--    <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>-->
          <!--    <li class="breadcrumb-item"><a href="#">Sales</a></li>-->
          <!--    <li class="breadcrumb-item active" aria-current="page">Sales Details</li>-->
          <!--  </ol>-->

            
          <!--</nav>-->



          


          <div class="row " id="print_btn">

                <div class="col">
                  <button onclick="window.print()" class="btn btn-info btn-sm float-right mr-5 mt-0 mb-2">Print now</button>
                </div>
              </div>
            
            

       
            <div class="ms-panel">
              
             
                <div class="ms-panel-header" > 
                  <h6>Sales Details</h6>
                </div>
                <div class="ms-panel-body">
                <div class="row">
                <div class="col">
                    <span> From Date : <?=$from?></span> <br><br>
                    To Date :  <?=$to?><br><br>
                   
                </div>

                <!-- <div class="col">
                    Sales Status : <br><br>
                    Shop Name : <br><br>
                   
                </div> -->

                <!-- <div class="col">
                Shop Owner :  <br><br>
                    Address :  <br><br>
                </div> -->
            </div>
            <div class="table-responsive">
              
            
                        <table  class="table w-100 thead-primary" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th id="th1">Srno</th>
                                    <th id="th1">Product Name </th>
                                    <th id="th1">Product Variation </th>
                                    <th id="th1">Product MRP. </th>
                                 
                                    <th id="th1">Product QTY. </th>
                                    <th id="th1">Total</th>
                                  
                                </tr>
                            </thead>

                            <tbody>
                            <?php $c=1; foreach ($order_list as $list) {  
                              
                                

                                $final_price = $final_price + $list->total;
                              ?>
                              <tr>
                                    <td id="td1"><?=$c?></td>
                                    <td id="td1"><?=$list->p_name?> </td>
                                    <td id="td1"><?=$list->p_var?> </td>
                                    <td id="td1">Rs.<?=$list->p_mrp?> </td>
                                  
                                    <td id="td1"><?=$list->totalquantity?></td>
                                   
                                    <td id="td1">Rs.<?=$list->total?></td>

                                    
                                </tr>


                                
                              <?php  $c++; } ?>    

                                  <tr> 
                                      <td colspan="4" id="td1"></td>
                                      <td id="td1"> <strong> Total </strong> </td>
                                    
                                      <td id="td1"><strong>Rs.<?= $final_price ?></strong></td>
                                  </tr> 
                                
                            </tbody>
                        </table>
                   
              
            </div>

            
                  
                  
                </div>
                <div id="page_b"></div>
             
            </div>
          

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );

</script>
<?php //include('common/footer.php')?>




