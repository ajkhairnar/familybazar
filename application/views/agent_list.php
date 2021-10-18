
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
              <li class="breadcrumb-item"><a href="#">Agent</a></li>
              <li class="breadcrumb-item active" aria-current="page">Agent List</li>
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
            
              <h6>Agent List</h6>
            </div>
            <div class="ms-panel-body">
              <div class="table-responsive">
                <table id="pTable" class="table w-100 thead-primary">
                <thead>
						<tr>
							<th>Id</th>
							<th> Username </th>
							<th> Full Name </th>
							<th> Email </th>
							<th> Mobile </th>
							<th> Landmark </th>
							<th>Status</th>
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
                             'url':'<?=base_url()?>Agents/getallagent'
                          },
                          'columns': [
                             
                             { data: 'agent_id' },
                             { data: 'agent_username' },
                             
                             { data: 'agent_fullname' },
                             { data: 'agent_email' },
                             { data: 'agent_phone' },
                             { data: 'agent_landmarkarea' },
                             { data: 'agent_status' },
                          
                             {data: 'agent_id',
                                    render: function(data, type, row, meta) {
                                        var c = `<a href="<?=base_url()?>agents/view_agent/${row.agent_id}"><i class="fas fa-paper-plane text-secondary text-success"></i></a>
                                         <a href="<?=base_url()?>agents/agent_manage/${row.agent_id}"><i class="fas fa-pencil-alt text-secondary"></i></a>
                                        <a href="<?=base_url()?>agents/agent_delete/${row.agent_id}"><i class="far fa-trash-alt ms-text-danger"></i></a>`;
                                        return c;
                             },},
                          ]
                        });
                     });
                     </script>
                    <?php // foreach ($agents as $agent) { ?>
                            <!--<tr>-->
                            <!--    <th scope="row"><?= $agent->agent_id ?></th>-->
                            <!--    <td><?= $agent->agent_username ?></td>-->
                            <!--    <td><?= $agent->agent_fullname ?></td>-->
                            <!--    <td><?= $agent->agent_email ?></td>-->
                            <!--    <td><?= $agent->agent_phone ?></td>-->
                            <!--    <td><?= $agent->agent_landmarkarea ?></td>-->
                            <!--    <td><span class="<?= $agent->agent_status ?>"><?= $agent->agent_status ?></span></td>-->
                                
                            <!--    <td>-->
                            <!--        <a href="<?=base_url().'agents/view_agent/'.$agent->agent_id ?>"><i class="fas fa-paper-plane text-secondary text-success"></i></a>-->
                            <!--        <a href="<?=base_url().'agents/agent_manage/'.$agent->agent_id ?>"><i class="fas fa-pencil-alt text-secondary"></i></a>-->
                            <!--        <a href="<?=base_url().'agents/agent_delete/'.$agent->agent_id ?>"><i class="far fa-trash-alt ms-text-danger"></i></a>-->
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

