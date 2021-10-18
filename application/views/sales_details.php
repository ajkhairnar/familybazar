
  <?php include('common/header.php')?>

<!-- sidebar -->
<?php include('common/sidebar.php')?>

<style type="text/css">
 
    #printable { display: none; }

    @media print
    {
        #btn_print { display: none; }
        #home_c { display: none; }
        
    }
</style>
<!-- Main Content -->
<main class="body-content">

  <!-- header -->
  <?php include('common/navbar.php')?>

  <div class="ms-content-wrapper">
      <div class="row">

        <div class="col-md-12">
          <nav aria-label="breadcrumb" id="home_c" >
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Sales</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sales Details</li>
            </ol>
          </nav>


            
            


          <div class="ms-panel" id="DivIdToPrint">
          
            <div class="ms-panel-header">
            
              <h6>Sales Details</h6> 
            </div>
            <div class="ms-panel-body">

            <div class="row">
                <div class="col">
                    <span> Agent Name : </span> <?=$s_details->sales_agentname?>  <br><br>
                    Sale Date : <?= date("d-m-Y",strtotime($s_details->sales_date));  ?> <br><br>
                   
                </div>

                <div class="col">
                    Sales Status : <?=$s_details->sales_status?><br><br>
                    Customer Name : <?=$s_details->sales_shopname?> <br><br>
                   
                </div>

                <div class="col">
                Customer Owner : <?=$s_details->sales_shopowner?> <br><br>
                    Address : <?=$s_details->sales_address?> <br><br>
                </div>
            </div>
            <div class="table-responsive">
                
              <?php 

           

                    $p_id1=json_decode($s_details->p_id);
                    $p_name1=json_decode($s_details->p_name);
                    $p_var1=json_decode($s_details->p_var);
                    $p_mrp1=json_decode($s_details->p_mrp);
                    $p_qty1=json_decode($s_details->p_qty);
                    $p_dp1=json_decode($s_details->p_dp);
                    $p_dpcalc1=json_decode($s_details->p_dpcalc);
                    $p_mrpcalc1=json_decode($s_details->p_mrpcalc);
                    


                    $p_id2=$p_id1[0];
                    $p_name2=$p_name1[0];
                    $p_var2=$p_var1[0];
                    $p_mrp2=$p_mrp1[0];
                    $p_qty2=$p_qty1[0];
                    $p_dp2=$p_dp1[0];
                    $p_dpcalc2 = $p_dpcalc1[0];
                    $p_mrpcalc2 = $p_mrpcalc1[0];


                    foreach($p_id1 as $key => $value) { 
                        
                        $aa=array($p_id1[$key],$p_name1[$key],$p_var1[$key],$p_dp1[$key],$p_mrp1[$key],$p_qty1[$key],$p_dpcalc1[$key],$p_mrpcalc1[$key]);
                        $array[]=$aa;

                    }

                
                    
                    

                    ?>
               
                        <table id="myTable" class="table w-100 thead-primary">
                            <thead>
                                <tr>
                                    <th>Srno</th>
                                    <th>Product Name </th>
                                    <th>Product Variation </th>
                                    <th>Product DP</th>
                                    <th>Product MRP. </th>
                                    <th>Product QTY. </th>
                                    <th>Offer Total</th>
                                    <th>Final Total</th>
                                  
                                </tr>
                            </thead>
                            
                            

                            <tbody>
                            <?php  $cnt=1; foreach($array as $d) {  ?>
                                <tr>
                                    <td><?=$cnt?></td>
                                    <td><?=$d[1]?></td>
                                    <td><?=$d[2]?></td>
                                    <td><?=$d[3]?></td>
                                    <td><?=$d[4]?></td>
                                    <td><?=$d[5]?></td>
                                    <td><?=$d[6]?></td>
                                    <td><?=$d[7]?></td>
                                    <td><?=$d[8]?></td>
                                </tr>

                                <?php $cnt++; } ?>
                          
                                   
                                
                            </tbody>
                        </table>
                   
              
            </div>

            <div class="row">
               <div class="col mt-3">
               <span style="font-size: 15px; font-weight: 600;"> Total Discount : <?= $s_details->p_oprice?> </span> <br><br>
                  <span style="font-size: 15px; font-weight: 600;">Total  :  <?= $s_details->p_finalprice?> </span> <br><br>
               </div>
            </div>
            <div class="row" id="btn_print">
                <div class="col-md-12">
                    <button class="btn btn-info float-right" onclick="window.print();">Print</button>
                </div>
            </div>
             
            </div>
          </div>

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>

</script>


