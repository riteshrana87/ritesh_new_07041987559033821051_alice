<script>
    var view_name = 'index2';
</script>

<div class="col-lg-1"></div>
<div class="col-lg-10 ">
    <div class="row">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? lang('your_emails') : ''; ?></h1>
            </div>
            
        </div>
        <div class="">
            <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span class="line"></span><span class="line"></span><span class="line"></span><span class="line line-angle1"></span><span class="line line-angle2"></span></a></h1>
            

        </div>
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
                   <ul class="message-list list_headers">
                       <!-- <li class="li1">From</li>
                       <li class="li2">Subject</li>
                       <li class="li3">Attachemnts</li>
                       <li class="li4">date</li> -->
                       <li>
					   <div class="li1">From</div>
                       <div class="li2">Subject</div>
                       <div class="li3">Attachemnts</div>
                       <div class="li4"><?php echo lang('date') ?></div>
					   </li>
					</ul>	
					
					
<ul class="message-list message_lists">                     
<?php
if(!empty($emails)){
if (count($emails) > 0) {
	$row_number = 1;
    foreach ($emails as $email) {
		
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
                                    <a class="mail_modal_link" data-target="#myModal_<?php echo $row_number; ?>" data-toggle="modal"> 
                                        <li class=" <?php if(!empty($email['unread'])){ echo 'unread';} ?> " style="">
										<div class="li1"><?php echo $email['from']; ?></div>
                                        <div class="li2"><?php echo $email['subject']; ?></div>
                                        <div class="li3"><?php	if($count_attchments > 0){ ?> <span class="teaser"><?php echo $count_attchments; ?> <i class="zmdi zmdi-attachment"></i></span> <?php } else { echo '&nbsp;'; } ?></div>
                                        <div class="li4"><?php echo substr($email['date'],0,16); ?></div>
										</li>
                                    </a>
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
														<p> <b>from: </b> <?php echo $email['from'] . '&lt;' . $email['from_email'] . '&gt;' ; ?></p>
														<p> <b>to: </b>	<?php echo $email['to_email'][0]; ?> </p>
														<p> <b>date: </b>	<?php echo $email['date']; ?> </p>
														<p> <b>subject: </b>	<?php echo $email['subject']; ?> </p>
													</div>
												</div>
												<div class="modal-body">
													<h4><?php echo $email['subject']; ?></h4>
													<p style="white-space: pre;"><?php echo $email['body']; ?></p>
													<hr>
													  <?php
														if($count_attchments > 0){
													?>
													<h4>Attachments: </h4>
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
    <?php 
	 $row_number++;
	} ?>

                            <?php } else { ?>
                               
                                    <li colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></li>
                              
<?php }
}
 ?>
 </ul>               
<?php if (count($emails) > 0) { ?>
                        <?php
                       // echo $pagination['links'];
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

