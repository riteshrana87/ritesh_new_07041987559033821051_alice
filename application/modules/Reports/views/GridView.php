   <div class="col-sm-12">
            <div class="row">
                <a class="" title="<?php echo lang('add_expense'); ?>"  href="<?php echo base_url('Expenses/Add'); ?>" type="button">
                
                <div class="col-md-2 cursor" title="<?php echo lang('add_expense'); ?>">
                    <div class="card-box alert alert-success fixedheightdiv">

                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="header-title m-t-0 m-b-30"><?php echo lang('add_expense'); ?></h4>
                            </div>
                            <div class="col-md-12  ">
                                <i class="fa fa-plus fa-5x success"></i>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
                </a>
                <?php
                if (count($expenses) > 0) {
                    foreach ($expenses as $expense) {
						
                        ?>
                        <div class="col-md-2">
							<a href="<?php echo base_url('Expenses/Edit/' . $expense['_id']); ?>">
                            <div class="card-box fixedheightdiv">

                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <div><b><?php $categoryData=$this->mongo_db->get_where('category_master', array('_id' => new \MongoId($expense['category'])));echo $categoryData[0]['categoryname']; ?></b></div>
                                        <small><?php echo date('d-m-Y',strtotime($categoryData[0]['created_at']));?></small>
                                    </div>
                                    <div class="col-md-12 text-left">
                                        <h4><?php echo $expense['vendorname'];?></h4>
                                    </div>
                                   
                                   
                                    <div class="col-md-12 text-left">
                                     
                                        <small> <?php echo $expense['description'];?></small>
                                      
                                    </div>
                                  
                                    <div class="col-md-12 text-right">
										
                                        <b> $ <?php echo $expense['total']; ?></b>
                                    </div>
                                    
                                </div>
                            </div>
                            </a>
                        </div><!-- end col -->
                    <?php } ?>
                <?php } ?>


            </div>

        </div>
<script>

var view_url="<?php echo base_url('Expenses/Edit/' . $expense['_id']); ?>";

</script>
