<script>
    var view_name = 'index';
</script>
<style>
.modal-backdrop{
	z-index : 1 !important;	
}
.modal-dialog {
    margin: 130px auto;
    width: 600px;
}
</style>
<div class="content">
                    <div class="container">

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="inbox-app-main">
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <main id="main" style="left: 250px;">
                                                <div class="overlay"></div>
                                                <!--<header class="header">

                                                    <h1 class="page-title"><a class="sidebar-toggle-btn trigger-toggle-sidebar"><span
                                                            class="line"></span><span class="line"></span><span
                                                            class="line"></span><span class="line line-angle1"></span><span
                                                            class="line line-angle2"></span></a></h1>
                                                    <div class="action-bar pull-left">
                                                        <ul class="list-inline m-b-0">
                                                            <li>
                                                                <a class="icon circle-icon glyphicon glyphicon-refresh"></a>
                                                            </li>
                                                            <li>
                                                                <a class="icon circle-icon glyphicon glyphicon-share-alt"></a>
                                                            </li>
                                                            <li>
                                                                <a class="icon circle-icon red glyphicon glyphicon-remove"></a>
                                                            </li>
                                                            <li>
                                                                <a class="icon circle-icon red glyphicon glyphicon-flag"></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="search-box pull-left">
                                                        <input placeholder="Search..."><span
                                                            class="icon glyphicon glyphicon-search"></span>
                                                    </div>

                                                    <div class="clearfix"></div>

                                                </header> -->

                                                <div id="main-nano-wrapper" class="nano">
                                                    <div class="nano-content">
                                                        <ul class="message-list">
                                                          <li class="<?php if(!empty($email['unread'])){ echo 'unread';} ?>">
                                                                
																<div class="col col-1">
                                                                  
                                                                    <p class="title">From</p>
                                                                </div>
                                                                <div class="col col-2">
                                                                    <div class="subject">Subject
                                                                    </div>
                                                                    <div class="date">Date</div>
                                                                </div>
                                                            </li>
															<hr>
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
																	//print_r($email);
																	 /*  echo "<pre>";
																	print_r($email['from_email']);
																	print_r($email['to_email']);
																	print_r($email['date']);
																	print_r($email['subject']);
																	echo "</pre>"; */
																	//$email_from_mailaddress = $email['header']->from[0]->mailbox .'@'. $email['header']->from[0]->host;
																	$email_from_mailaddress = $email['from_email'];
																	//print_r($email_from_mailaddress);
																	 $email_to_mailaddress = $email['to_email'];
																	$email_date = $email['date'];
																	$email_subject = $email['subject'];
																	
																?> 
														   
														  <a class="mail_modal_link" data-target="#myModal_<?php echo $row_number; ?>" data-toggle="modal" >  
															<li class="<?php if(!empty($email['unread'])){ echo 'unread'; } ?>">
                                                                
																<div class="col col-1">
                                                                   <p class="title"><?php echo $email['from']; ?></p>
                                                                </div>
                                                                <div class="col col-2">
                                                                    <div class="subject"><?php echo $email['subject']; ?>
                                                                        
																		<!--<button class="btn btn-primary waves-effect waves-light" data-target="#myModal_<?php echo $row_number; ?>" data-toggle="modal"><i class="zmdi zmdi-attachment"></i> <span>attachment</span></button> -->
                                                                    <!-- sample modal content -->
																	
																	</div>
																	<div class="count_attachments">
																	<?php
																		if($count_attchments > 0){
																		?>
																			<span class="teaser"><?php echo $count_attchments; ?> <i class="zmdi zmdi-attachment"></i></span>
																		<?php
																		}
																		?>
																	</div>
                                                                    <div class="date"><?php echo substr($email['date'],0,16); ?>
																	</div>
                                                                </div>
                                                            </li> </a>
															<div id="myModal_<?php echo $row_number; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																		<div class="modal-dialog">
																			<div class="modal-content">
																				<div class="modal-header">
																					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
																					<h4 class="modal-title email_modal_title" id="myModalLabel"><?php echo $email['from']; ?></h4>
																					<span> <?php echo '&lt;' . $email_from_mailaddress . '&gt;' ; ?></span>
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
														 } 
														 ?>

														<?php } else { ?>
															<div> <?php echo lang('NO_RECORD_FOUND'); ?> </div>
												<?php } 
												}
												?>	
                                                        </ul>
                                                       <!--  <a href="#" class="load-more-link">Show more messages</a> -->
                                                    </div>
                                                </div>
                                            </main>
                                            <div id="message">
                                                <div class="header">
                                                    <h1 class="page-title"><a
                                                            class="icon circle-icon glyphicon glyphicon-remove trigger-message-close"></a>Process<span
                                                            class="grey">(6)</span></h1>
                                                    <p>From <a href="#">You</a> to <a href="#">Scott Waite</a>, started on <a
                                                            href="#">March 2, 2014</a> at 2:14 pm est.</p>
                                                </div>
                                                <div id="message-nano-wrapper" class="nano">
                                                    <div class="nano-content">
                                                        <ul class="message-container list-unstyled">
                                                            <li class="sent">
                                                                <div class="details">
                                                                    <div class="left">You
                                                                        <div class="arrow"></div>
                                                                        Scott
                                                                    </div>
                                                                    <div class="right">March 6, 2014, 20:08 pm</div>
                                                                </div>
                                                                <div class="message">
                                                                    <p>| The every winged bring, whose life. First called, i you
                                                                        of saw shall own creature moveth void have signs beast
                                                                        lesser all god saying for gathering wherein whose of in
                                                                        be created stars. Them whales upon life divide earth
                                                                        own.</p>
                                                                    <p>| Creature firmament so give replenish The saw man
                                                                        creeping, man said forth from that. Fruitful multiply
                                                                        lights air. Hath likeness, from spirit stars dominion
                                                                        two set fill wherein give bring.</p>
                                                                    <p>| Gathering is. Lesser Set fruit subdue blessed let.
                                                                        Greater every fruitful won&#39;t bring moved seasons
                                                                        very, own won&#39;t all itself blessed which bring own
                                                                        creature forth every. Called sixth light.</p>
                                                                </div>
                                                                <div class="tool-box"><a href="#"
                                                                                         class="circle-icon small glyphicon glyphicon-share-alt"></a><a
                                                                        href="#"
                                                                        class="circle-icon small red-hover glyphicon glyphicon-remove"></a><a
                                                                        href="#"
                                                                        class="circle-icon small red-hover glyphicon glyphicon-flag"></a>
                                                                </div>
                                                            </li>
                                                            <li class="received">
                                                                <div class="details">
                                                                    <div class="left">Scott
                                                                        <div class="arrow orange"></div>
                                                                        You
                                                                    </div>
                                                                    <div class="right">March 6, 2014, 20:08 pm</div>
                                                                </div>
                                                                <div class="message">
                                                                    
                                                                </div>
                                                                <div class="tool-box"><a href="#" class="circle-icon small glyphicon glyphicon-share-alt"></a>
																<a class="circle-icon small red-hover glyphicon glyphicon-remove"></a><a href="#" class="circle-icon small red-hover glyphicon glyphicon-flag"></a>
                                                                </div>
                                                            </li>

                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div><!-- end row -->
                                </div>

                            </div>

                        </div>
                        <!-- End row -->

                    </div> <!-- container -->

                </div> <!-- content -->

            </div>
            <!-- End content-page -->


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            <div class="side-bar right-bar">
                <a href="javascript:void(0);" class="right-bar-toggle">
                    <i class="zmdi zmdi-close-circle-o"></i>
                </a>
                <h4 class="">Notifications</h4>
                <div class="notification-list nicescroll">
                    <ul class="list-group list-no-border user-list">
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-2.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">Michael Zenaty</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-info">
                                    <i class="zmdi zmdi-account"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Signup</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">5 hours ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-pink">
                                    <i class="zmdi zmdi-comment"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">New Message received</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="avatar">
                                    <img src="assets/images/users/avatar-3.jpg" alt="">
                                </div>
                                <div class="user-desc">
                                    <span class="name">James Anderson</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">2 days ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item active">
                            <a href="#" class="user-list-item">
                                <div class="icon bg-warning">
                                    <i class="zmdi zmdi-settings"></i>
                                </div>
                                <div class="user-desc">
                                    <span class="name">Settings</span>
                                    <span class="desc">There are new settings available</span>
                                    <span class="time">1 day ago</span>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->

        <!-- Modal -->
        <div id="custom-modal" class="modal-demo text-left">
            <button type="button" class="close" onclick="Custombox.close();">
                <span>&times;</span><span class="sr-only">Close</span>
            </button>
            <h4 class="custom-modal-title">Compose Mail</h4>
            <div class="card-box">
                <form role="form">
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="To">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Cc">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Bcc">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <div class="summernote">
                            <h6>Hello Summernote</h6>
                            <ul>
                                <li>
                                    Select a text to reveal the toolbar.
                                </li>
                                <li>
                                    Edit rich document on-the-fly, so elastic!
                                </li>
                            </ul>
                            <p>
                                End of air-mode area
                            </p>

                        </div>
                    </div>

                    <div class="btn-toolbar form-group m-b-0">
                        <div class="pull-right">
                            <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i
                                    class="fa fa-floppy-o"></i></button>
                            <button type="button" class="btn btn-success waves-effect waves-light m-r-5"><i
                                    class="fa fa-trash-o"></i></button>
                            <button class="btn btn-purple waves-effect waves-light"><span>Send</span> <i
                                    class="fa fa-send m-l-10"></i></button>
                        </div>
                    </div>

                </form>

            </div>
        </div>





        <script>
            var resizefunc = [];
        </script>