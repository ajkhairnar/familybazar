
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
              <li class="breadcrumb-item"><a href="#">Category</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
            
              <h6>Category List</h6>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                <table id="pTable" class="table w-100 thead-primary">
                <thead>
						<tr>
							<th>Id</th>
							<th> Category Name </th>
							<th> Image </th>

              <th> Action </th>
						</tr>
					</thead>

                    <tbody>
                        
                        
                <script type="text/javascript">
                     $(document).ready(function(){
                        $('#pTable').DataTable({
                        'pagingType': 'full_numbers',
                        'pageLength': 20,
                        'processing': true,
                        'serverSide': true,
                        'serverMethod': 'post',
                          'ajax': {
                             'url':'<?=base_url()?>Category/categorylist'
                          },
                          'columns': [
                             
                             { data: 'cat_id' },
                             { data: 'cat_name' },
                             { data: "product_img",
                                    render: function(data, type, row, meta) {
                                        var b =`<img src="<?=base_url()?>uploads/category/${row.cat_img}" width="150" height="150" />`;
                                        return b;
                             }, },
                            
                             {data: 'cat_id',
                                    render: function(data, type, row, meta) {
                                        var c = `<a href="<?=base_url()?>category/category_manage/${row.cat_id}"><i class="fas fa-paper-plane text-secondary text-success"></i></a><a href="<?=base_url()?>category/category_delete/${row.cat_id}/${row.cat_img}"><i class="far fa-trash-alt ms-text-danger"></i></a>`;
                                        return c;
                             },},
                          ]
                        });
                     });
                     </script>
                   
						
					</tbody>
                </table>
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

</script>

