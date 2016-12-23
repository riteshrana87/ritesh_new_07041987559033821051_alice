 <div class="row search-row">
    <input type="text" placeholder="&#9906; Search"class="filtr-search" name="filtr-search" data-search>
 </div>
<div class="col-sm-12">
            <div class="row">
			<div class="filtr-container">
                <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
                    <div class="card-box fixedheightdiv">
                <a href="<?php echo base_url('Invoice/Add'); ?>">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('invoice'); ?></h4>
                            </div>
                            <div class="col-md-12  ">
                                <i class="fa fa-plus fa-5x "></i>
                            </div>
                        </div>
                </a>
                    </div>
                </div><!-- end col -->
                <?php
				
				$today_date = strtotime(date('F d, Y'));
                if (count($invoices) > 0) {
                    foreach ($invoices as $invoice) {
                        ?>
                <a href="<?php echo base_url('Invoice/View/' . $invoice['_id']); ?>">
                        <div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $invoice['invoice_code']; ?>">
                            <div class="card-box">

                                <div class="row">
                                    <div class="col-md-12">
                                        Invoice No : <?php echo $invoice['invoice_code']; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <?php echo $invoice['created_date']; ?>
                                    </div>
                                    <div class="col-md-12 client_name">
                                        <?php
                                        $data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($invoice['client_id'])));
                                        if(count($data_client)>0)
                                        {
                                            echo '<h4>' . $data_client[0]['firstname'] . ' ' . $data_client[0]['lastname'] . '</h4>';
                                        }
                                        ?>
                                    </div>
									<hr>
									<?php
									if(!empty($data_client[0]['currency'])){
                                    ?>
									<div class="col-md-12 text-right">
                                        <?php echo '<h3>'. $data_client[0]['currency'] .' '. $invoice['total_payment'].'</h3>';?>
                                    </div>
									<?php
									}
									else{
									?>
										  <div class="col-md-12 text-right">
											<?php echo '<h3> $'. $invoice['total_payment'].'</h3>';?>
											</div>
									<?php
									}
									?>
									
									
									<?php
									$rt =strtotime($invoice['due_date']);
									if($invoice['save_type'] != 'save'){
										if(!empty($invoice['payment_status'])){
											if($invoice['payment_status'] == 'full'){
												$cl = 'invoice_paid';
												$tx = 'Paid';
											}
											else if($invoice['payment_status'] == 'partial') {
												if($today_date > $rt){
													$cl = 'overdue_invoice';
													$tx = 'Overdue';
												}
												else if($today_date <= $rt){
													$cl = 'outstanding_invoice';
													$tx = 'Outstanding';
												}
											}
										}
										else{
											if($today_date > $rt){
												$cl = 'invoice_overdue';
												$tx = 'Overdue';
											}
											else if($today_date <= $rt){
												$cl = 'outstanding_invoice';
												$tx = 'Outstanding';
											}
										}
									}
									
									else if($invoice['save_type'] == 'save' && $invoice['payment_status'] =='' ){
										$cl = 'invoice_draft';
												$tx = 'Draft';
									}
									else{
										if(!empty($invoice['payment_status'])){
									
										if($invoice['payment_status'] == 'full'){
											$cl = 'invoice_paid';
											$tx = 'Paid';
										}
										else if($invoice['payment_status'] == 'partial') {
											if($today_date > $rt){
												$cl = 'invoice_overdue';
												$tx = 'Overdue';
											}
											else if($today_date <= $rt){
												$cl = 'outstanding_invoice';
												$tx = 'Outstanding';
											}
										}
									
										}
										else{
										if($today_date > $rt){
												$cl = 'invoice_overdue';
												$tx = 'Overdue';
											}
											else if($today_date <= $rt){
												$cl = 'outstanding_invoice';
												$tx = 'Outstanding';
											}
										}
									}
									
									
									?>
									<div class="col-md-12 text-center <?php echo $cl ?>">
                                        <?php echo '<h3>'.$tx.'</h3>';?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        </a>
                    <?php } ?>
                <?php } else { ?>
                    <h3 class="text-center" ><?php echo lang('NO_RECORD_FOUND'); ?></h3>

                <?php } ?>


            </div>
            </div>

        </div>
		
		<style>
		.filtr-search {
		  border-radius: 50rem;
		  margin: 10px 0 50px;
		  padding: 0.5rem;
		  text-transform: uppercase;
		  width: 95%;
		}
		</style>