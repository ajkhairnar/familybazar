
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
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Sales</a></li>
              <li class="breadcrumb-item active" aria-current="page">Sales List</li>
            </ol>
          </nav>


            <?php if($this->session->flashdata('success_msg')){ ?>
                <div class="alert alert-success" role="alert">
                    <i class="flaticon-tick-inside-circle"></i> <strong>Well done!</strong>  <?=$this->session->flashdata('success_msg')?>
                </div>
		    <?php } ?>
            
            <?php if($this->session->flashdata('error_msg')){ ?>
                <div class="alert alert-danger" role="alert">
                    <i class="flaticon-alert-1"></i> <strong>Oh snap!</strong> <?=$this->session->flashdata('error_msg')?>
                </div>
		    <?php } ?>
            


          <div class="ms-panel">
          
            <div class="ms-panel-header">
            
              <h6>Sales List</h6>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                  
                <form action="<?=base_url()?>sales/new_order_print" method="post" target="_blank">

                    <div class="row">
                        
                        <div class="col-md-12"><h6>Print Summary By Date</h6></div>
                        
                        <div class="col-md-4">
                            <lable>Start Date<lable>
                            <input type="text" class="form-control mydate" name="from" placeholder="dd/mm/yyyy" required> 
                        </div>
                        <div class="col-md-4">
                            <lable>End Date<lable>
                            <input type="text" class="form-control mydate" name="to" placeholder="dd/mm/yyyy" required> 
                        </div>
                        
                        <div class="col-md-4">
                            <button type="submit" name="submit" class="btn btn-info btn-sm mt-4">Print Summary</button>
                        </div>
                    </div>

                </form>  
                
                <hr>
                
                <form action="<?=base_url()?>sales/new_order_list" method="post" target="_blank">

                    <div class="row">
                        
                        <div class="col-md-12"><h6>Print Bill By Date</h6></div>
                        
                        <div class="col-md-4">
                            <lable>Start Date<lable>
                            <input type="text" class="form-control mydate" name="from" placeholder="dd/mm/yyyy" required> 
                        </div>
                        <div class="col-md-4">
                            <lable>End Date<lable>
                            <input type="text" class="form-control mydate" name="to" placeholder="dd/mm/yyyy" required> 
                        </div>
                        
                        <div class="col-md-4">
                            <button type="submit" name="print_bill" class="btn btn-info btn-sm mt-4">Print Bill</button>
                        </div>
                    </div>

                </form>  
                
                <hr>
                
                <form action="<?=base_url()?>sales/new_order_list" method="post" target="_blank">
                    <div class="row">
                        <div class="col-12"><h6>Please Select Checkbox to Print Order or Summary</h6></div>
                        <div class="col-md-3">
                            <button type="submit" name="submit" class="btn btn-info float-left btn-sm">Print order</button>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" name="print_summary" class="btn btn-info float-left btn-sm">Print Summary</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                       
                            <table id="salestable" class="table w-100 thead-primary">
                                <thead>
                                    <tr>
                                        <th>select</th>
                                        <th>Id</th>
                                        <th>Date</th>
                                        <th>Customer name</th>
                                        <th>Landmark</th>
                                        <th>Offer Total</th>
                                        <th>Total</th>
                                        <th>View</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $cnt= 1; foreach ($new_sales as $sale) {    ?>
                                        <tr>
                                            <th scope="row"><input type="checkbox" id="checkItem" name="sub_id[]" value="<?= $sale->sales_id ?>"></th>
                                            <th scope="row"><?= $cnt ?></th>
                                            <th scope="row"><?= date("d-m-Y", strtotime($sale->sales_date))  ?></th>
                                            <th scope="row"><?= $sale->sales_shopowner ?></th>
                                            <th scope="row"><?= $sale->sales_landmarkarea ?></th>
                                            <th scope="row"><?= $sale->offer_total ?></th>
                                            <th scope="row"><?= $sale->total ?></th>
                                            <th><a href="<?=base_url().'sales/new_order_view_details/'.$sale->sales_id ?>"><i class="fas fa-paper-plane text-secondary text-success"></i></a></th>
                                        </tr>
                                        <?php $cnt++; } ?>
                                    
                                </tbody>
                            </table>

                            
                        </div>
                    
                    </div>
                </form>
              
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>


<script type="text/javascript">
	$(document).ready(function() {
    $('#salestable').DataTable({
        "order": [[ 1, "desc" ]],
        "lengthMenu": [[50,100, -1], [50,100, "All"]]
    });
    });



$(document).ready( function () {

$('#filter').click(function(){
    var username = $('#username').val();
    var from_date = $('#from_date').val();
    var to_date = $('#to_date').val();
    
    $.ajax({
            url:"<?=base_url()?>Sales/sales_filter",
            method:"POST",
            data:{username:username,from_date:from_date,to_date:to_date},
            success:function(data){
                console.log(data);
                
            }
        });

});


} );    


</script>

