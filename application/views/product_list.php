
<?php include('common/header.php')?>

<!-- sidebar -->
<?php include('common/sidebar.php')?>

<!-- Main Content -->
<main class="body-content">

  <!-- header -->
  <?php include('common/navbar.php')?>
<style>

table img {
    max-width: 60px;
    border-radius: 0%;
    margin-right: 0px;
    }
</style>
  <div class="ms-content-wrapper">
      <div class="row">

        <div class="col-md-12">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb pl-0">
              <li class="breadcrumb-item"><a href="#"><i class="material-icons">home</i>Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Product</a></li>
              <li class="breadcrumb-item active" aria-current="page">Product List</li>
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
            
              <h6>Product List</h6>
            </div>
            <div class="ms-panel-body">
              <form action="<?=base_url()?>product/update_cat_subcat" method="post">
                <div class="row mb-4">
                  <div class="col">
                      <select class=" form-control" name="product_cat">
                          <option selected value="" >Select Category</option>
                          <?php

                              foreach ($resultcategory as $row) {  ?>

                              <option value="<?=$row['cat_name']?>"> <?= $row['cat_name'] ?></option>;

                          <?php }  ?>

                      </select>

                      
                  </div>
                  <div class="col">
                      <select class=" form-control" name="product_subcat">
                          <option selected value="" >Select Subcategory</option>
                          <?php

                              foreach ($resultsubcategory as $row) {  ?>

                              <option value="<?=$row['sub_cat_name']?>"> <?= $row['sub_cat_name'] ?></option>;

                          <?php }  ?>

                      </select>
                  </div>
                  <div class="col">
                      <button type="submit" name="submit" class="btn btn-danger btn-sm mt-1">Update</button>
                  </div>
              </div>   
              
              
              <div class="row mb-4">
                  <div class="col">
                      <select class=" form-control" name="product_status">
                          <option selected value="" disbaled >Select Status</option>
                          <option selected value="hide" disbaled >Hide</option>
                          <option selected value="active" disbaled >Active</option>
                      </select>

                      
                  </div>
                  <div class="col">
                      <button type="submit" name="p_status" class="btn btn-danger btn-sm mt-1">Update Status</button>
                  </div>
              </div>   
              <div class="table-responsive">
                  
                  
                  <table id="pTable" class="table w-100 thead-primary display dataTable">
                  <thead>
						<tr>
						    <th>Select</th>
						    <th>Id</th>
						    <th>status</th>
							<th> Img </th>
							<th> Company </th>
							<th> Product Name </th>
							<th> Category </th>
							<th> Sub Category </th>
							<th> Variation </th>
							<th> D. Price </th>
							<th> Price </th>
							<th>Action</th>
						</tr>
					</thead>
                    
                    <script type="text/javascript">
                     $(document).ready(function(){
                        $('#pTable').DataTable({
                        'pagingType': 'full_numbers',
                        'pageLength': 20,
                        'processing': true,
                        'serverSide': true,
                        'serverMethod': 'post',
                          'ajax': {
                             'url':'<?=base_url()?>Product/productlist'
                          },
                          'columns': [
                             {data:'product_id',
                                    render: function(data, type, row, meta) {
                                        var a = `<input type="checkbox" id="checkItem" name="check[]" value="${row.product_id}"/>`;
                                        return a;
                             },},
                             { data: 'product_id' },
                             { data: 'product_status' },
                             { data: "product_img",
                                    render: function(data, type, row, meta) {
                                        var b =`<img src="<?=base_url()?>uploads/product/${row.product_img}" width="150" height="150" />`;
                                        return b;
                             }, },
                             { data: 'product_name' },
                             { data: 'product_company' },
                             { data: 'product_cat' },
                             { data: 'product_subcat' },
                             { data: 'product_variation' },
                             { data: 'product_dprice' },
                             { data: 'product_mrp' },
                             {data: 'product_id',
                                    render: function(data, type, row, meta) {
                                        var c = `<a href="<?=base_url()?>product/product_manage/${row.product_id}"><i class="fas fa-paper-plane text-secondary text-success"></i></a><a href="<?=base_url()?>product/product_delete/${row.product_id}/${row.product_img}"><i class="far fa-trash-alt ms-text-danger"></i></a>`;
                                        return c;
                             },},
                          ]
                        });
                     });
                     </script>
                    

                </table>


              </div>
             </form>    
            </div>
          </div>

        </div>

      </div>
    </div>


</main>
<!-- MODALS -->

<?php include('common/footer.php')?>

