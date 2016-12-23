<script>
    var delete_client = '<?php echo lang('delete_confirmation_client'); ?>';
    var view_name = 'List';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center page-header invoice_dashboard"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?>
                
                </h1>
                <div style="clear:both;"></div>
                 <div class="col-sm-0">
                <a class="btn btn-success btn-bordred waves-effect w-lg waves-light m-b-5 pull-right" title="<?php echo lang('addTitleClient'); ?>"  href="<?php echo base_url('Invoice/Add'); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('new_invoice'); ?></a>
            </div>
            </div>
           
        </div>
		
		<?php
		//echo "<pre>";
		//print_r($invoicepaid);
		//echo "</pre>";
		$today_date = strtotime(date('F d, Y'));
		
		$overdue_total_amount = 0;
		$outstanding_total_amount = 0;
		$draft_total_amount = 0;
		
		$tome_overdue_total_amount = 0;
		$tome_outstanding_total_amount = 0;
		
		foreach($invoices as $invoice){
			
			$rt =strtotime($invoice['due_date']);
			
			if($today_date > $rt && $invoice['save_type'] != 'save' ){
				if(empty($invoice['payment_status'])  || $invoice['payment_status'] == 'partial'){
					foreach($invoicepaid as $ip){
							if($ip['invoice_id'] == $invoice['_id']){
								$total_paid = $ip['paid_amount'];
							}
							else{
								$total_paid = 0;
							}
					}	
					$overdue_total_amount = $overdue_total_amount + ( $invoice['total_payment'] - $total_paid );
					
				}
			}
			else if($today_date <= $rt && $invoice['save_type'] != 'save'){
				if(empty($invoice['payment_status'])  || $invoice['payment_status'] == 'partial'){
					foreach($invoicepaid as $ip1){
							if($ip1['invoice_id'] == $invoice['_id']){
								$total_paid1 = $ip1['paid_amount'];
							}
							else{
								$total_paid1 = 0;
							}
					}	
					$outstanding_total_amount = $outstanding_total_amount + ($invoice['total_payment'] - $total_paid1 );
				}
			}
			
			if($invoice['save_type'] == 'save'){
				$draft_total_amount = $draft_total_amount + $invoice['total_payment'] ;
			}
			
			
		}
		?>
		
		<div class="col-lg-3"></div>
		
		
		
		<div class="col-lg-6">
		
                                <div class="card-box card-tabs">
                                    <ul class="nav nav-pills">
                                        <li class="active">
                                            <a aria-expanded="true" data-toggle="tab" href="#cardpills-1">From Me</a>
                                        </li>
                                        <li class="">
                                            <a aria-expanded="false" data-toggle="tab" href="#cardpills-2">To Me</a>
                                        </li>
                                    </ul>
                                    <!-- <h4 class="header-title m-b-30">Card with tabs</h4> -->
									</div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="cardpills-1">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
														<div class="card-box">

															<div class="row">
																<div class="col-md-12 text-center">
																	<h4 class="header-title m-t-0 m-b-30 amount" id="overdue_price"><?php echo '$ '.$overdue_total_amount ?></h4>
																</div>
																<div class="col-md-12 text-center">
																	<h4 class="header-title">Overdue</h4>
																</div>
															</div>
														</div>
													</div>
                                                    <div class="col-md-4">
														<div class="card-box">

															<div class="row">
																<div class="col-md-12 text-center">
																	<h4 class="header-title m-t-0 m-b-30 amount" id="outstanding_price"><?php echo '$ '.$outstanding_total_amount ?></h4>
																</div>
																<div class="col-md-12 text-center">
																	<h4 class="header-title">Outstanding</h4>
																</div>

															</div>
														</div>
													</div>
                                                    <div class="col-md-4">
														<div class="card-box">

															<div class="row">
																<div class="col-md-12 text-center">
																	<h4 class="header-title m-t-0 m-b-30 amount" id="draft_price"><?php echo '$ '.$draft_total_amount ?></h4>
																</div>
																<div class="col-md-12 text-center">
																	<h4 class="header-title">Draft</h4>
																</div>

															</div>
														</div>
													</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="cardpills-2">
                                            <div class="row">
                                                <div class="col-md-12">
												
                                                    <div class="col-md-2">
														
													</div>
                                                    <div class="col-md-4">
														<div class="card-box">

															<div class="row">
																<div class="col-md-12 text-center">
																	<h4 class="header-title m-t-0 m-b-30 amount" id="overdue_price"><?php echo '$ '.$tome_overdue_total_amount ?></h4>
																</div>
																<div class="col-md-12 text-center">
																	<h4 class="header-title">Overdue</h4>
																</div>
															</div>
														</div>
													</div>
                                                    <div class="col-md-4">
														<div class="card-box">

															<div class="row">
																<div class="col-md-12 text-center">
																	<h4 class="header-title m-t-0 m-b-30 amount" id="outstanding_price"><?php echo '$ '.$tome_outstanding_total_amount ?></h4>
																</div>
																<div class="col-md-12 text-center">
																	<h4 class="header-title">Outstanding</h4>
																</div>

															</div>
														</div>
													</div>
                                                    <div class="col-md-2">
														
													</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                               
                            </div>
		<div class="col-lg-3"></div>
							<div style="clear:both" > </div>
        <div class="">
            <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span><span class="line"></span><span class="line"></span><span class="line line-angle1"></span><span class="line line-angle2"></span></a></h1>
            <div class="action-bar pull-left">
                <ul class="list-inline m-b-0">
                    <li>
                        <h3 class=""><?php echo lang('recently_updated'); ?></h3>
                    </li>
                    <li>
<!--                        <i title='<?php echo lang('gridview'); ?>' onclick="loadView('grid', '<?php echo base_url('Invoice'); ?>')" class="fa fa-file-o fa-2x cursor"></i>&nbsp;-->
                            <a href="<?php echo base_url('Invoice?view=grid');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a>
                    </li>
                    <li>
<!--                        <i title='<?php echo lang('listview'); ?>' onclick="loadView('list', '<?php echo base_url('Invoice/'); ?>')"  class="fa fa-align-justify fa-2x cursor"></i>-->
                            <a href="<?php echo base_url('Invoice?view=list');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a>
                    </li>

                </ul>
            </div>

        </div>
        <!--        <div class="row">
                    <header class="header">
                        <div class="search-box pull-left">
                            <input placeholder="Search..."><span class="icon glyphicon glyphicon-search"></span>
                        </div>
        
                    </header>
                </div>-->
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
        <?php //echo $this->load->view('ListView'); ?>
        <?php 
        if(isset($_GET['view']))
        {
            if($this->input->get('view') == 'grid')
            {
                $this->load->view('GridView');
            }else{
                $this->load->view('ListView');
            }
        }else{
        
            echo $this->load->view('GridView');
        }
    ?>
    </div>
</div>
<!-- End row -->

</div> <!-- container -->
<div class="col-lg-1"></div>

<style>
.header-title.m-t-0.m-b-30.amount {
  color: orange;
  font-size: 40px;
}
#overdue_price{ color: red } 
#outstanding_price{ color:orange }
#draft_price{ color:#71b6f9 }

.overdue_invoice{
	background-color:red;
}
.client_name{
	border-bottom:1px solid #000;
}
.invoice_paid{
	background-color:#10c469 ;
}
.invoice_overdue{
	background-color:red ;
}
.invoice_draft{
	background-color:#71b6f9 ;
}
.outstanding_invoice{
	background-color:orange ;
}

.invoice_paid h3, .overdue_invoice h3, .invoice_overdue h3, .invoice_draft h3, .outstanding_invoice h3{
	color:#fff;
}

</style>