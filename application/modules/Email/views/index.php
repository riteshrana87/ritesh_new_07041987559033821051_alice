<script>
    var view_name = 'List';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
            </div>
        </div>
        <div class="">
            <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span><span class="line"></span><span class="line"></span><span class="line line-angle1"></span><span class="line line-angle2"></span></a></h1>

        </div>
        <!--        
				<div class="row">
                    <header class="header">
                        <div class="search-box pull-left">
                            <input placeholder="Search..."><span class="icon glyphicon glyphicon-search"></span>
                        </div>
        
                    </header>
                </div>-->
    </div>
    <div class="clearfix"></div>
    <div id="replacementdiv">
        <div class="col-sm-12">

    <div class="row">
        <div class="card-box">

<?php if ($this->session->flashdata('error')) {
    ?>
                <?php echo $this->session->flashdata('error'); ?>
            <?php } ?>
            <?php if ($this->session->flashdata('message')) {
                ?>
                <?php echo $this->session->flashdata('message'); ?>
            <?php } ?>         <div class="table-rep-plugin">
                <div class="table-responsive" data-pattern="priority-columns">
                    <table  id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="display:none">Row_id</th>
                                <th><?php echo lang('email_from') ?></th>
                                <th data-priority="1"><?php echo lang('email_subject') ?></th>
                               <!--  <th data-priority="2">Attachemnts</th> -->
                                <th data-priority="5"><?php echo lang('email_date') ?></th>

                            </tr>
                        </thead>

                        <tbody>
<?php
if(!empty($emails)){
if (count($emails) > 0) {
	$row_number = 1;
    foreach ($emails as $email) {
		if(!empty($email['attachments']))
		$attachmentArray = $email['attachments'];
		$count_attchments = 0;
		
		for($i=0;$i<10;$i++){
			if (!empty($email['attachments'][$i]['is_attachment'])) {
				$count_attchments++;
			}
		}	
		$email_from_mailaddress = $email['from_email'];
		//print_r($email_from_mailaddress);
		$email_to_mailaddress = $email['to_email'];
		$email_date = $email['date'];
		$email_subject = $email['subject'];
        ?>
                                    <tr>
                                        <td style="display:none"><?php echo $row_number; ?></td>
                                        <td><?php echo $email['from']; ?></td>
                                        <td><?php echo $email['subject']; ?> <span class="attachemnt_display"><?php if($count_attchments > 0){ ?> <span class="teaser"><?php echo $count_attchments; ?> <i class="zmdi zmdi-attachment"></i></span> <?php } else { echo '&nbsp;'; } ?> </span></td>
                                        <!--<td><?php if($count_attchments > 0){ ?> <span class="teaser"><?php echo $count_attchments; ?> <i class="zmdi zmdi-attachment"></i></span> <?php } else { echo '&nbsp;'; } ?></td> -->
                                        <td><?php echo substr($email['date'],0,16); ?></td>
										<div id="myModal_<?php echo $row_number; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
													<h4 class="modal-title email_modal_title" id="myModalLabel"><?php echo $email['from']; ?></h4>
													<span class="from_mail_span"> <?php echo '&lt;' . $email_from_mailaddress . '&gt;' ; ?></span>
													<h5 class="email_modal_tome"> to Me  <span class="caret mail_details_caret"></span></h5>
													<div class="clear"> </div>
													<div class="mail_details"> 
														<p> <b><?php echo lang('email_from') ?>: </b> <?php echo $email['from'] . '&lt;' . $email['from_email'] . '&gt;' ; ?></p>
														<p> <b><?php echo lang('email_to') ?>: </b>	<?php echo $email['to_email'][0]; ?> </p>
														<p> <b><?php echo lang('email_date') ?>: </b>	<?php echo $email['date']; ?> </p>
														<p> <b><?php echo lang('email_subject') ?>: </b>	<?php echo $email['subject']; ?> </p>
													</div>
												</div>
												<div class="modal-body">
													<h4><?php echo $email['subject']; ?></h4>
													<p style="white-space: pre;"><?php echo base64_decode($email['body']); ?></p>
													<hr>
															<?php
														if($count_attchments > 0){
														?>
															<h4><?php echo lang('email_attachments') ?>: </h4>
														<?php 
														}
													$folderId = $this->session->userdata('alice_session')['_id'];
													for($i=0;$i<10;$i++){
														if (!empty($email['attachments'][$i]['is_attachment'])) {
													?>
													<a target="_blank" href='<?php echo base_url("uploads/Mail/" . $folderId. "/" . $email['attachments'][$i]['name']) ?> ' > <?php echo $email['attachments'][$i]['name']; ?></a> <br>
													<?php
														}
													}
													?>
											
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
												</div>
											</div><!-- /.modal-content -->
										</div><!-- /.modal-dialog -->
									</div><!-- /.modal -->
                                    </tr>
    <?php 
	$row_number++;
	} ?>

                            <?php } else { ?>
                                <tr>
                                    <td colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                                </tr>
<?php } ?>
                        </tbody>

                    </table>
<?php if (count($emails) > 0) { ?>
                        <?php
                     //   echo $pagination['links'];
                    }
}
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>
    </div>
</div>
<!-- End row -->

</div> <!-- container -->
<div class="col-lg-1"></div>

