<script>
    var delete_client = '<?php echo lang('invoice_delete_message'); ?>';
    var view_name = 'List';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10">
    <div class="row">
        <div class="row head_page">
            <div class="col-sm-10">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
                <div class="insdie_tag">
                    <ul class="nav nav-pills">
                        <li <?php if($invoice_from==1){?>class="active" <?php }?>><a href="<?php echo base_url('Invoice/'); ?>">From Me</a></li>
                        <li <?php if($invoice_to==1){?>class="active" <?php }?>><a href="<?php echo base_url('Invoice/Invoice_to'); ?>">To Me</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-success btn-bordred page-header-btn" title="<?php echo lang('addTitleClient'); ?>"  href="<?php echo base_url($add_link); ?>" type="button"><i class="fa fa-plus"></i> <?php echo lang('new_invoice'); ?></a>
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

	$duesupport1 = 0;
	$duesupport2 = 0;
	$outsupport1 = 0;
	$outsupport2 = 0;
	
    $tome_overdue_total_amount = 0;
    $tome_outstanding_total_amount = 0;

    foreach($invoices as $invoice){

        $rt =strtotime($invoice['due_date']);

        if($today_date > $rt && $invoice['save_type'] != 'save' ){
            if(empty($invoice['payment_status']) || $invoice['payment_status'] == 'partial'){
                foreach($invoicepaid as $ip){
					if($ip['payment_with'] == 'Ideal'){
						if($ip['ideal_status'] == 'paid'){
							if($ip['invoice_id'] == $invoice['_id']){
								$total_paid = $ip['paid_amount'];
							}
							else{
								$total_paid = 0;
							}
							$duesupport1 = $duesupport1 + $total_paid;
						}
					}
					else{
						if($ip['invoice_id'] == $invoice['_id']){
							$total_paid = $ip['paid_amount'];
						}
						else{
							$total_paid = 0;
						}
						$duesupport1 = $duesupport1 + $total_paid;
					}
				}
				$duesupport2 = $duesupport2 + $invoice['total_payment'];
				$overdue_total_amount = $duesupport2 - $duesupport1;
        }
        }
        else if($today_date <= $rt && $invoice['save_type'] != 'save'){
            if(empty($invoice['payment_status'])  || $invoice['payment_status'] == 'partial'){
                foreach($invoicepaid as $ip1){
					if($ip1['payment_with'] == 'Ideal'){
						if($ip1['ideal_status'] == 'paid'){
							if($ip1['invoice_id'] == $invoice['_id']){
								$total_paid1 = $ip1['paid_amount'];
							}
							else{
								$total_paid1 = 0;
							}
							$outsupport1 = $outsupport1 + $total_paid1;
						}
					}
					else{
						if($ip1['invoice_id'] == $invoice['_id']){
							$total_paid1 = $ip1['paid_amount'];
						}
						else{
							$total_paid1 = 0;
						}
						$outsupport1 = $outsupport1 + $total_paid1;
					}
                }
                
                $outsupport2 = $outsupport2 + $invoice['total_payment'];
				$outstanding_total_amount = $outsupport2 - $outsupport1;
            }
        }

        if($invoice['save_type'] == 'save' && (isset($invoice['payment_status']) && $invoice['payment_status'] != 'full')){
            $draft_total_amount = $draft_total_amount + $invoice['total_payment'] ;
        }
    }
    ?>
	
	<?php //echo $outstanding_total_amount ?>

    <div class="col-lg-1"></div>
    <div class="col-lg-10">

        <div class="tab-content inside_body">
            <?php if($invoice_from==1){ ?>
                <div class="tab-pane fade active in" id="cardpills-1">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount" id="overdue_price"><?php echo '$ '.$overdue_total_amount ?></h4>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount_detail">Overdue</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount" id="outstanding_price"><?php echo '$ '.$outstanding_total_amount ?></h4>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount_detail">Outstanding</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount" id="draft_price"><?php echo '$ '.$draft_total_amount ?></h4>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount_detail">Draft</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            if($invoice_to==1){
                ?>
                <div class="tab-pane fade active in" id="cardpills-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="card-box">

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount"  id="overdue_price"><?php echo '$ '.$tome_overdue_total_amount ?></h4>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount_detail">Overdue</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-box">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount" id="outstanding_price"><?php echo '$ '.$tome_outstanding_total_amount ?></h4>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <h4 class="amount_detail">Outstanding</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
    <div class="page_inside">
        <h1 class="page-title">
            <a class="sidebar-toggle-btn trigger-toggle-sidebar">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line line-angle1"></span>
                <span class="line line-angle2"></span>
            </a>
        </h1>
        <div class="action-bar">
            <ul class="list-inline m-b-0">
                <li><h3 class="title_head"><?php echo lang('recently_updated'); ?></h3></li>
                <li>
                    <!--<i title='<?php echo lang('gridview'); ?>' onclick="loadView('grid', '<?php echo base_url('Invoice'); ?>')" class="fa fa-file-o fa-2x cursor"></i>&nbsp;-->
                    <a  class="active" href="<?php echo base_url('Invoice/grid');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-file-o fa-2x cursor"></i></a>
                </li>
                <li>
                    <!-- <i title='<?php echo lang('listview'); ?>' onclick="loadView('list', '<?php echo base_url('Invoice/'); ?>')"  class="fa fa-align-justify fa-2x cursor"></i>-->
                    <a href="<?php echo base_url('Invoice/list');?>"><i title='<?php echo lang('gridview'); ?>' class="fa fa-align-justify fa-2x cursor"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div id="replacementdiv">
    <?php //echo $this->load->view('ListView'); ?>
    <?php
    if($view1)
    {
		
		
		
        if($view1 == 'grid')
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
