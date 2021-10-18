
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
              <li class="breadcrumb-item"><a href="#">Agent </a></li>
              <li class="breadcrumb-item active" aria-current="page">Agent Pending List</li>
            </ol>
          </nav>


            <?php if($this->session->flashdata('success_msg')){ ?>
                <div class="alert alert-success" role="alert">
                    <i class="flaticon-tick-inside-circle"></i> <strong>Well done!</strong>  <?=$this->session->flashdata('success_msg')?> <a href="<?=base_url().'agents/agent_manage/'?>" style="color: #07be6e;font-weight: 700;">Goto Agent List</a>
                </div>
		    <?php } ?>
            
            <?php if($this->session->flashdata('error_msg')){ ?>
                <div class="alert alert-danger" role="alert">
                    <i class="flaticon-alert-1"></i> <strong>Oh snap!</strong> <?=$this->session->flashdata('error_msg')?>
                </div>
		    <?php } ?>
            


          <div class="ms-panel">
          
            <div class="ms-panel-header">
            
              <h6>Agent Pending List</h6>
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
							<th> Status </th>
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
                             'url':'<?=base_url()?>Agents/getallpendingagent'
                          },
                          'columns': [
                             
                             { data: 'agent_id' },
                             { data: 'agent_username' },
                             
                             { data: 'agent_fullname' },
                             { data: 'agent_email' },
                             { data: 'agent_phone' },
                             { data: 'agent_status' },
                          
                             {data: 'agent_id',
                                    render: function(data, type, row, meta) {
                                        
                                        if(row.agent_status != "decline") {
                                            
                                        var c = `<a href="<?=base_url()?>agents/view_agent_pending/${row.agent_id}" class="btn btn-sm btn-info" style="margin-top:0px;" >View</a>
                                         <a href="<?=base_url()?>agents/agent_approve/${row.agent_id}" class="btn btn-sm btn-success" style="margin-top:0px; margin-left:3px;"> Approve </a>
                                        <a href="<?=base_url()?>agents/agent_decline/${row.agent_id}" class="btn btn-sm btn-danger" style="margin-top:0px; margin-left:3px;">Decline</a>`;
                                        return c;
                                        
                                        }else{
                                            
                                        return "No Action Needed";
                                    }
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

