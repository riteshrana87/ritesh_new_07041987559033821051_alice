<div class="row">
	<div class="col-sm-12">
        <div class="form-group">
            <div class="icon-addon addon-lg">
                <input type="text" placeholder="Search" class="form-control filtr-search" name="filtr-search" data-search>
                <label for="email" class="glyphicon glyphicon-search filtr-search-icon" rel="tooltip" title="email"></label>
            </div>
        </div>
	</div>
</div>
<div class="col-sm-12">
	<div class="row">
		<div class="filtr-container">
			<div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo lang('add_expense'); ?>" title="<?php echo lang('add_expense'); ?>">
				<a href="<?php echo base_url('Expenses/Add'); ?>">
					<div class="card-box alert alert-success fixedheightdiv_expense add_new_box ">
						<div class="row text-center">
							<div class="col-md-12">
								<h4 class="header-title"><?php echo lang('add_expense'); ?></h4>
							</div>
							<div class="col-md-12 ">
								<i class="fa fa-plus fa-5x success"></i>
							</div>
						</div>
					</div>
				</a>
			</div><!-- end col -->
			<?php
			if (count($expenses) > 0) {
				foreach ($expenses as $expense) {
					?>
					<a href="<?php echo base_url('Expenses/Edit/' . $expense['_id']); ?>">
						<div class="col-md-3 filtr-item" data-category="1, 5" data-sort="<?php echo $expense['vendorname']; ?>">
							<div class="card-box fixedheightdiv_expense other_box">
								<div class="row">
                                    <div class="col-md-12">
                                        <div class="full_name_plat">
                                            <div class="full_name">
                                                <div class="category_name"><?php $categoryData=$this->mongo_db->get_where('ExpenseCategory', array('_id' => new \MongoId($expense['category'])));echo $categoryData[0]['CategoryName']; ?></div>
                                                <div class="category_date"><?php echo date('d-m-Y',strtotime($expense['created_at']));?></div>
                                            </div>
                                            <div class="actions">
                                                <a class="on-default edit-row" href="<?php echo base_url('Expenses/Edit/' . $expense['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                                <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Expenses/Delete/' . $expense['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </div>
                                    </div>

									<div class="col-md-12">
										<div class="vendor_name"><?php echo $expense['vendorname'];?></div>
									</div>
									<div class="col-md-12">
										<div class="description"><?php echo $expense['description'];?></div>
									</div>
									<div class="col-md-12">
										<div class="total_payment">$ <?php echo $expense['total']; ?></div>
									</div>
								</div>
							</div>
						</div><!-- end col -->
					</a>
					<?php } ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<script>
			var view_url="<?php echo base_url('Expenses/Edit/' . $expense['_id']); ?>";
		</script>
