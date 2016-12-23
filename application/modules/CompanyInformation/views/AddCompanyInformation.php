<script>
    var view_name = 'Add';
</script>
<div class="container">
    <?php if ($this->session->flashdata('error')) {
        ?>
        <?php echo $this->session->flashdata('error'); ?>
    <?php } ?>
    <?php if ($this->session->flashdata('message')) {
        ?>
        <?php echo $this->session->flashdata('message'); ?>
    <?php } ?>
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row">
            <div class="row head_page">
                <div class="col-sm-12">
                    <h1 class="text-center page-header"><?php echo (isset($pageTitle)) ? $pageTitle : ''; ?></h1>
                </div>
            </div>
            <div class="col-sm-12 mT30">
                <?php
                $countries
                ?>
                <div class="card-box form_field">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs">
                                <li role="presentation" class="active"><a href="#home1" role="tab" data-toggle="tab">Basic Details</a></li>
                                <li role="presentation"><a href="#profile1" role="tab" data-toggle="tab">Statutory Details</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home1">
                                    <form class="form-horizontal add_company_plat" enctype='multipart/form-data' role="form" id="ClientForm" name="ClientForm" method="post" action="<?php echo base_url('CompanyInformation/InsertData'); ?>">
                                        <h4 class="page-header header-title"> <?php echo lang('company_info'); ?>: </h4>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" id="company" maxlength="50" name="company" class="form-control" required placeholder="<?php echo lang('company'); ?> * " value="<?php if (!empty($CompanyInformation[0]['company'])) { echo $CompanyInformation[0]['company']; } ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <!-- <input type="text" class="form-control" required id="address" name="address" placeholder="<?php echo lang('ADDRESS_1'); ?>" value="<?php if (!empty($CompanyInformation[0]['address'])) {
                                                    echo $CompanyInformation[0]['address'];
                                                } ?>" class="form-control" required> -->
                                                <textarea cols="103" id="address" name="address" style="width: 100%;" placeholder="<?php echo lang('ADDRESS_1'); ?>"><?php if (!empty($CompanyInformation[0]['address'])) { echo $CompanyInformation[0]['address']; } ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <input type="text" onkeypress="return isNumber(event)" name="phone" id="phone" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="10" class="form-control" placeholder="<?php echo lang('phone_no'); ?>" value="<?php if (!empty($CompanyInformation[0]['phone'])) { echo $CompanyInformation[0]['phone']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" onkeypress="return isNumber(event)" name="mobno" id="mobno" data-parsley-pattern='^[\d\+\-\.\(\)\/\s]*$' maxlength="10" class="form-control" placeholder="Mobile Numnber" value="<?php if (!empty($CompanyInformation[0]['mobno'])) { echo $CompanyInformation[0]['mobno']; } ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" id="company_email" maxlength="50" name="company_email" class="form-control" required placeholder="<?php echo lang('email'); ?> * " value="<?php if (!empty($CompanyInformation[0]['company_email'])) { echo $CompanyInformation[0]['company_email']; } ?>">
                                            </div>
                                            <div class="col-md-3">
                                                <input type="url" id="company_website" maxlength="50" name="company_website" class="form-control" placeholder="<?php echo lang('website'); ?>" value="<?php if (!empty($CompanyInformation[0]['company_website'])) { echo $CompanyInformation[0]['company_website']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <!-- <label for="invoice_currency">
                                                <?php echo lang('invoice_currency'); ?></label> --->
                                                <?php
                                                /* if(!empty($clients)){
                                                        foreach($clients as $cl){
                                                        if($cl['_id'] == !empty($editrecord[0]['client_id'])){
                                                            $cur = $cl['currency'];
                                                            $lan = $cl['language'];
                                                        }
                                                    }
                                                }  */
                                                $cur = $CompanyInformation[0]['company_currency']
                                                ?>
                                                <select class="form-control" id="company_currency"
                                                        name="company_currency" placeholder="Type" tabindex="-1"
                                                        title="" required data-parsley-trigger="change">
                                                    <!-- <option value=""><?= lang('select') ?></option> -->
                                                    <option value="$" <?php if (!empty($cur)) {
                                                        if ($cur == '$') {
                                                            echo "selected";
                                                        }
                                                    } ?> >Dollar - $
                                                    </option>
                                                    <option value="£" <?php if (!empty($cur)) {
                                                        if ($cur == '£') {
                                                            echo "selected";
                                                        }
                                                    } ?> >Pound - £
                                                    </option>
                                                    <option value="₹" <?php if (!empty($cur)) {
                                                        if ($cur == '₹') {
                                                            echo "selected";
                                                        }
                                                    } ?> >Rupee - ₹
                                                    </option>
                                                    <option value="€" <?php if (!empty($cur)) {
                                                        if ($cur == '€') {
                                                            echo "selected";
                                                        }
                                                    } ?> >Euro - €
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group add_company_img">
                                            <div class="col-md-12">
                                                <label class="control-label file_upload_label">Company Logo: </label>
                                                <input type="file" name="company_logo" value="company_logo" id="company_logo" value="./uploads/company_logo/<?php if (!empty($CompanyInformation[0]['company_logo'])) { echo $CompanyInformation[0]['company_logo']; } ?>">
                                                <?php
                                                /*  if(!empty($CompanyInformation[0]['company_logo'])){
                                                     if(file_exists('./uploads/profile_images/'. $CompanyInformation[0]['company_logo'])){
                                                      echo  '<img style="height:60px;" src="./uploads/company_logo/'.$CompanyInformation[0]['company_logo'].'" />';
                                                 }
                                                 } */
                                                ?>
                                                <div class="user-img">
                                                    <?php
                                                    if (!empty($CompanyInformation[0]['company_logo'])) {
                                                        $profile_img = base_url("/uploads/company_logo/" . $CompanyInformation[0]['company_logo']);
                                                    } else {
                                                        $profile_img = base_url("/uploads/company_logo/boy-512.png");
                                                    }
                                                    ?>
                                                    <img src="<?php echo $profile_img ?>" alt="user-img" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('save_profile'); ?></button>
                                                <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" onclick="goBack()" type="reset">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile1">
                                    <form class="form-horizontal add_company_plat" enctype='multipart/form-data' role="form" id="ClientForm_statutory" name="ClientForm_statutory" method="post" action="<?php echo base_url('CompanyInformation/Insert_statutoryData'); ?>">
                                        <div class="form-group">
                                            <div class="col-md-2">
                                                <input type="text" name="tin_number" maxlength="11" id="tin_number" class="form-control" onkeypress="return numericDecimal(event)" placeholder="<?php echo lang('tin_number'); ?>" value="<?php if (!empty($CompanyInformation[0]['tin_number'])) { echo $CompanyInformation[0]['tin_number']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="cst_number" maxlength="20" id="cst_number" class="form-control" onkeypress="return numericDecimal(event)" placeholder="<?php echo lang('cst_number'); ?>" value="<?php if (!empty($CompanyInformation[0]['cst_number'])) { echo $CompanyInformation[0]['cst_number']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="servicetax_number" maxlength="20" id="servicetax_number" class="form-control" placeholder="<?php echo lang('servicetax_number'); ?>" value="<?php if (!empty($CompanyInformation[0]['servicetax_number'])) { echo $CompanyInformation[0]['servicetax_number']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="pan_number" maxlength="20" id="pan_number" class="form-control" placeholder="<?php echo lang('pan_number'); ?>" value="<?php if (!empty($CompanyInformation[0]['pan_number'])) { echo $CompanyInformation[0]['pan_number']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="tan_number" maxlength="20" id="tan_number" class="form-control" placeholder="<?php echo lang('tan_number'); ?>" value="<?php if (!empty($CompanyInformation[0]['tan_number'])) { echo $CompanyInformation[0]['tan_number']; } ?>">
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" name="cin" maxlength="20" id="cin" class="form-control" placeholder="<?php echo lang('cin'); ?>" value="<?php if (!empty($CompanyInformation[0]['cin'])) { echo $CompanyInformation[0]['cin']; } ?>">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button name="submit" id="submit" class="btn btn-success btn-lg waves-effect waves-light" type="submit"><?php echo lang('save_profile'); ?></button>
                                                <button class="btn btn-default btn-lg waves-effect waves-light m-l-5" type="reset">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
