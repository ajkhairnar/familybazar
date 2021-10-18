
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
              <li class="breadcrumb-item"><a href="#">Customer</a></li>
              <li class="breadcrumb-item active" aria-current="page">Customer List</li>
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
            
              <h6>Customer List</h6>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                <table id="pTable" class="table w-100 thead-primary">
                <thead>
						<tr>
							<th>Id</th>
							<th> Customer Name </th>
							<th> Mobile </th>
							<th> Landmark </th>
							<th> City </th>
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
                             'url':'<?=base_url()?>Shop/shoplist'
                          },
                          'columns': [
                             
                             { data: 'shop_id' },
                             { data: 'shop_owner' },
                            
                             { data: 'shop_phone' },
                             { data: 'shop_landmarkarea' },
                             { data: 'shop_city' },
                             
                             {data: 'shop_id',
                                    render: function(data, type, row, meta) {
                                        var c = `<a href="<?=base_url()?>shop/view_shop/${row.shop_id}"><i class="fas fa-paper-plane text-secondary text-success"></i></a>
                                        
                                        <a href="<?=base_url()?>shop/shop_manage/${row.shop_id}"><i class="fas fa-pencil-alt text-secondary"></i></a>
                                        <a href="<?=base_url()?>shop/shop_delete/${row.shop_id}"><i class="far fa-trash-alt ms-text-danger"></i></a>`;
                                        return c;
                             },},
                          ]
                        });
                     });
                     </script>
                    <?php  //foreach ($shops as $shop) { ?>
                            <!--<tr>-->
                            <!--    <th scope="row"><?= $shop->shop_id ?></th>-->
                                
                            <!--    <th scope="row"><?= $shop->shop_owner ?></th>-->
                            <!--    <th scope="row"><?= $shop->shop_phone ?></th>-->
                            <!--    <th scope="row"><?= $shop->shop_landmarkarea ?></th>-->
                            <!--    <th scope="row"><?= $shop->shop_city ?></th>-->

                               
                            <!--    <td>-->
                            <!--        <a href="<?=base_url().'shop/view_shop/'.$shop->shop_id ?>"><i class="fas fa-paper-plane text-secondary text-success"></i></a>-->
                            <!--        <a href="<?=base_url().'shop/shop_manage/'.$shop->shop_id ?>"><i class="fas fa-pencil-alt text-secondary"></i></a>-->
                            <!--        <a href="<?=base_url().'shop/shop_delete/'.$shop->shop_id ?>"><i class="far fa-trash-alt ms-text-danger"></i></a>-->
                            <!--    </td>-->
                              
                            <!--</tr>-->
                            <?php //} ?>
						
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

