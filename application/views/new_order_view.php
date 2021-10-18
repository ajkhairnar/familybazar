
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
                <form action="<?=base_url()?>sales/new_order_print" method="post">
                    <div class="row mb-4">

                        <!-- <div class="col-md-3">
                            <lable>Select Agent<lable>
                            <select class="form-control" id="username">
                                <?php foreach ($agents as $agent) { ?>

                                    <option value="<?=$agent->agent_username?>"><?=$agent->agent_username?></option>

                                <?php } ?>
                            </select>
                        </div> -->

                        <div class="col-md-3">
                            <lable>Start Date<lable>
                            <input type="date" class="form-control" name="from" required> 
                        </div>
                        <div class="col-md-3">
                            <lable>End Date<lable>
                            <input type="date" class="form-control" name="to" required> 
                        </div>
                        
                        <div class="col-md-1">
                            <button type="submit" name="submit" class="btn btn-info btn-sm mt-4">Print</button>
                        </div>

                    </div>

                </form>                    
               
                    <!-- <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-info float-right btn-sm mb-4">Print</button>
                        </div>
                    </div>            -->
                    <div class="row">
                        <div class="col">
                       
                            <table id="myTable" class="table w-100 thead-primary">
                                <thead>
                                    <tr>
                                      
                                        <th>Id</th>
                                        <th> Shop name </th>
                                        <th> Landmark </th>
                                        <th> Total </th>
                                        
                                        <th> View </th>
                                        
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $cnt= 1; foreach ($new_sales as $sale) {    ?>
                                        <tr>
                                           
                                            <th scope="row"><?= $cnt ?></th>
                                            <th scope="row"><?= $sale->sales_shopname ?></th>
                                            <th scope="row"><?= $sale->sales_landmarkarea ?></th>
                                            <th scope="row"><?= $sale->Total ?></th>
                                            
                                            <th><a href="<?=base_url().'product/view_product/'.$product->product_id ?>"><i class="fas fa-paper-plane text-secondary text-success"></i></a></th>
                                            
                                          
                                        </tr>
                                        <?php $cnt++; } ?>
                                    
                                </tbody>
                            </table>

                            
                        </div>
                    
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


<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );



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

