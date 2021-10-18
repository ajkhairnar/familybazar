<html>
<head>
    <title>Invoice Print</title>
    
<style>

body
{
    font-size:12px !important;
}



#invoice-POS{
  padding:2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
  border:1px #f6f4f4 solid;
}
  
  
::selection {background: #f31544; color: #FFF;}
::moz-selection {background: #f31544; color: #FFF;}
h1{
  font-size: 1.5em;
  color: #222;
}
h2{font-size: .9em;}
h3{
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
p{
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
 
#top, #mid,#bot{ /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}

#top{min-height: 100px;}
#mid{min-height: 80px;} 
#bot{ min-height: 50px;}


.info{
  display: block;
  margin-left: 0;
}
.title{
  float: right;
}
.title p{text-align: right;} 
table{
  width: 100%;
  border-collapse: collapse;
}

.tabletitle{
  padding: 5px;
  font-size: .5em;
  background: #EEE;
}
.service{border-bottom: 1px solid #EEE;}
.item{width: 24mm;}
.itemtext{font-size: .5em;}

#legalcopy{
  margin-top: 5mm;
}

@media print {
  #page_b {page-break-after: always;}
  #print_btn{display:none;}
  #navbreadcrumb{display:none;}
}

</style>
</head>

<body>
    <div class="row " id="print_btn">
        <div class="col">
            <button onclick="window.print()" class="btn btn-info btn-sm float-right mr-5 mt-0 mb-2">Print now</button>
        </div>
    </div>


          <?php  foreach ($get_onebyone_orders as $key1 => $get_order) {    $lastkey = array_key_last($get_order); ?>

  <div id="invoice-POS">
    
    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2><img src="https://admin.familybazar.co.in/assets/img/familybazar_logo.png" style="width:100%;"></h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
    
    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p>
            Order ID:<?=$get_order[$lastkey]->sales_id?></br>
            Name    : <?=$get_order[ $lastkey]->sales_shopowner?></br>
            Address : <?=$get_order[ $lastkey]->sales_address?></br>
            Phone   : <?=$get_order[ $lastkey]->sales_shopphone?></br>
            Date    : <?=date('d-M-Y', strtotime($get_order[ $lastkey]->sales_date))?>
        </p>
      </div>
    </div><!--End Invoice Mid-->
    
    <div id="bot">

					<div id="table">
						<table>
							<tr class="tabletitle">
								<td class="item"><h2>Item</h2></td>
								<td class="Hours"><h2>Qty</h2></td>
								<td class="Rate"><h2>MRP</h2></td>
								<td class="Rate"><h2>Offer</h2></td>
							</tr>
                            
                            <?php     
                                $finaltotal=0;
                                $offertotal=0;
                              $last = array_key_last ( $get_order );
                              foreach($get_order as $key=>$details) {  
                                  
                                  if($last != $key) 
                                  {
                                      $offertotal = $offertotal + $details->p_dpcalc;
                                      $finaltotal =  $finaltotal + $details->p_mrpcalc;
                                  ?>
                                  
							<tr class="service">
								<td class="tableitem"><p class="itemtext"><?=$details->p_name?></p></td>
								<td class="tableitem"><p class="itemtext"><?=$details->p_qty?></p></td>
								<td class="tableitem"><p class="itemtext">Rs. <?=$details->p_mrpcalc?></p></td>
								<td class="tableitem"><p class="itemtext">Rs. <?=$details->p_dpcalc?></p></td>
							</tr>
							
							<?php } } ?>

							<tr class="tabletitle">
								<td colspan="2" class="Rate"><h2>Total</h2></td>
								<td class="payment"><h2>Rs. <?= $finaltotal ?></h2></td>
								<td class="payment"><h2>Rs. <?= $offertotal ?></h2></td>
							</tr>
							
							<tr class="tabletitle">
								<td colspan="2" class="Rate"><h2>Total Savings</h2></td>
								<td colspan="2" class="payment"><h2>Rs. <?= $finaltotal - $offertotal ?></h2></td>
							</tr>

						</table>
					</div><!--End Table-->

					<div id="legalcopy">
					    <p class="legal">
					        Office Address: Durga Traders, Near Chhatrapati Shivaji Maharaj Smarak, Gram Panchayat Parisar, Shingave.| Mobile No: 8605635493
					    </p>
					</div>

				</div><!--End InvoiceBot-->
  </div><!--End Invoice-->
   <?php } ?> 


</body>
</html>

