
  <!-- Quick bar -->
  <aside id="ms-quick-bar" class="ms-quick-bar fixed ms-d-block-lg">


  </aside>



  <!-- SCRIPTS -->
  <!-- Global Required Scripts Start -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?=assets?>js/jquery-3.5.0.min.js"></script>
  <script src="<?=assets?>js/popper.min.js"></script>
  <script src="<?=assets?>js/bootstrap.min.js"></script>
  <script src="<?=assets?>js/perfect-scrollbar.js">
  </script>
  <script src="<?=assets?>js/jquery-ui.min.js">
  </script>
  <!-- Global Required Scripts End -->
  <!-- Page Specific Scripts Start -->

  <script src="<?=assets?>js/Chart.bundle.min.js">
  </script>
  <script src="<?=assets?>js/widgets.js"> </script>
  <script src="<?=assets?>js/clients.js"> </script>
  <script src="<?=assets?>js/Chart.Financial.js"> </script>
  <script src="<?=assets?>js/d3.v3.min.js">
  </script>
  <script src="<?=assets?>js/topojson.v1.min.js">
  </script>
  
  <script src="<?=assets?>js/datatables.min.js">
  </script>
  <script src="<?=assets?>js/data-tables.js">
  </script>
  
  <!-- Page Specific Scripts Finish -->
  <!-- Costic core JavaScript -->
  <script src="<?=assets?>js/framework.js"></script>
  <!-- Settings -->
  <script src="<?=assets?>js/settings.js"></script>
  
  

<script type="text/javascript">
	$(document).ready(function() {
    $('#myTable').DataTable({
        "lengthMenu": [[50,100, -1], [50,100, "All"]]
    });
    });
</script>

<script type="text/javascript">
$(function () {
        $(".mydate").datepicker({
            showOn: 'button',
            buttonImageOnly: true,
            buttonImage: 'https://www.aspsnippets.com/demos/images/calendar.gif',
            dateFormat: 'dd-mm-yy'
        });
    });
</script>

  
  
</body>
</html>
