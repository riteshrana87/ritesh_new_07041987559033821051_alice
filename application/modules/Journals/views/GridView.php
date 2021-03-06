<div class="row ">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
        <div class="form-group">
            <div class="icon-addon addon-lg">
                <input type="text" placeholder="Search" class="form-control filtr-search" name="filtr-search" data-search>
                <label for="email" class="glyphicon glyphicon-search filtr-search-icon" rel="tooltip" title="email"></label>
            </div>
        </div>
	</div>	
</div>
<div class="col-sm-1"></div>
<div class="col-sm-10">
	<div class="row">
		<div class="filtr-container">
			<div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('addTitleClient'); ?>" title="<?php echo lang('addTitleClient'); ?>">
				<a href="<?php echo base_url('Journals/Add'); ?>">
					<div class="card-box alert alert-success fixedheightdiv_invoice add_new_box">
						<div class="row text-center">
							<div class="col-md-12">
								<h4 class="header-title"><?php echo lang('journal'); ?></h4>
							</div>
							<div class="col-md-12 ">
								<i class="fa fa-plus fa-5x success"></i>
							</div>
						</div>
					</div>
				</a>
			</div><!-- end col -->
			<?php
			$today_date = strtotime(date('F d, Y'));
			if (count($journals) > 0) {
				foreach ($journals as $journal) {
					?>
					<a href="<?php echo base_url('Journals/Edit/' . $journal['_id']); ?>">
						<div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $journal['journal_code']; ?>">
							<div class="card-box fixedheightdiv_invoice other_box">
								<div class="row">
                                    <div class="col-md-12">
                                        <div class="full_name_plat">
                                            <div class="full_name">
                                                    <div class="invoice_no">Journal No : <?php echo $journal['journal_code']; ?></div>
                                                    <div class="invoice_date"><?php echo $journal['created_date']; ?></div>
                                              </div>
                                            <div class="actions">
                                                <a class="on-default edit-row" href="<?php echo base_url('Journals/Edit/' . $journal['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                                <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Journals/Delete/' . $journal['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                    </div>

									<div class="col-md-12">
										<?php
										$data_client = $this->mongo_db->get_where('Client',array('_id' => new \MongoId($invoice['client_id'])));
										if(count($data_client)>0)
										{
											echo '<div class="client_name">' . $data_client[0]['firstname'] . ' ' . $data_client[0]['lastname'] . '</div>';
										}
										?>
									</div>
									<?php
									if(!empty($data_client[0]['currency'])){
                                    ?>
									<div class="col-md-12 text-right">
                                        <?php echo '<h3>'. $data_client[0]['currency'] .' '. $journal['total_debit'].'</h3>';?>
                                    </div>
									<?php
									}
									else{
									?>
										  <div class="col-md-12 text-right">
											<?php echo '<h3> $'. $journal['total_debit'].'</h3>';?>
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