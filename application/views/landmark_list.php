
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
              <li class="breadcrumb-item"><a href="#">Landmark</a></li>
              <li class="breadcrumb-item active" aria-current="page">Landmark List</li>
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
            
              <h6>Landmark List</h6>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                <table id="myTable" class="table w-100 thead-primary">
                <thead>
						<tr>
							<th>Id</th>
							<th> State </th>
							<th> City </th>
							<th> Landmark </th>
                            <th> Action </th>
						</tr>
					</thead>

                    <tbody>
                    <?php  foreach ($landmarks as $landmark) { ?>
                            <tr>
                                <th scope="row"><?= $landmark->landmark_id ?></th>
                                <td><?= $landmark->shop_state ?></td>
                                <td><?= $landmark->shop_city ?></td>
                                <td><?= $landmark->landmark_name ?></td>
                               
                               
                                <td>
                                    <a href="<?=base_url().'landmark/landmark_manage/'.$landmark->landmark_id ?>"><i class="fas fa-pencil-alt text-secondary"></i></a>
                                    <a href="<?=base_url().'landmark/landmark_delete/'.$landmark->landmark_id ?>"><i class="far fa-trash-alt ms-text-danger"></i></a>
                                </td>
                              
                            </tr>
                            <?php } ?>
						
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

