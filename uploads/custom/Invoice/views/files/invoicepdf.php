<div id="prntViewPage" <?php if($section == 'print'){ ?> style="display:none;" <?php }?>>
    <?php
    if (isset($editRecord) && !empty($editRecord)) { ?>
        <style>
            .white-border-ox{
                font-family: calibri;
            }
            .TopHeaderTitle{
                font-weight:bold;
                font-size:30px;
            }
            .IntroductionPage{

            }
            .hidden{
               display:none;
            }
        </style>

<table style="width: 100% " cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
    <tr>
        <td style="width: 50%; font-size:12px;line-height:20px; font-size:16px; display: table-cell;font-weight:bold;"> <?php
                                if(!empty($CompanyInformation[0]['company_logo'])){
                                    $profile_img = base_url("/uploads/company_logo/" . $CompanyInformation[0]['company_logo']);
                                }
                                else{
                                    $profile_img = base_url("/uploads/profile_images/boy-512.png");
                                }
                                ?>
                                <h3 class="logo"><img src="<?php echo $profile_img; ?>" alt="user-img" class="img-thumbnail img-responsive"></h3></td>
        <td style="width: 50%; font-size:16px;line-height:20px; display: table-cell; text-align:right">
                <?php echo ucfirst($user_details[0]['company']);?><br />
                <?php echo ucfirst($user_details[0]['address']);?><br />
                <?php echo ucfirst($user_details[0]['zipcode']);?><br />
                <?php echo ucfirst($user_details[0]['phone']);?>
        </td>
    </tr>
    
</table>
        
        <hr>
        <table style="width: 100%" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
    <tr>
        <td style="width: 50%; font-size:16px;line-height:20px; display: table-cell;"> 
                <?php if(isset($client_data[0]['firstname']) && $client_data[0]['firstname'] != "" &&  isset($client_data[0]['lastname']) && $client_data[0]['lastname'] != ""){ ?>
            <span style="font-weight:bold;"> <?php  echo ucfirst($client_data[0]['firstname']).' '.$client_data[0]['lastname']; ?></span>
                        <?php } ?><br />
                        <?php if(isset($client_data[0]['address']) && $client_data[0]['address'] != ""){
                                 echo $client_data[0]['address']; 
                        }?><br />
                        <?php if(isset($client_data[0]['zipcode']) && $client_data[0]['zipcode'] != ""){ 
                                 echo $client_data[0]['zipcode'].',';
                            }?>
                        <?php if(isset($client_data[0]['city']) && $client_data[0]['city'] != ""){ 
                                 echo $client_data[0]['city'];
                            }?>
                        <br />
                        <?php if(isset($client_data[0]['state']) && $client_data[0]['state'] != ""){ 
                                 echo $client_data[0]['state'].','; 
                            }?>
                        <?php if(isset($client_data[0]['country']) && $client_data[0]['country'] != ""){
                                 echo $client_data[0]['country'];
                             }?>
                        <br />
               </td>
        <td style="width: 50%; font-size:16px;line-height:20px; display: table-cell; text-align:right">
                 Invoice:<?= !empty($editRecord[0]['invoice_code']) ? $editRecord[0]['invoice_code'] : '0' ?><br />
                Order Date:<?= !empty($editRecord[0]['created_date']) ? $editRecord[0]['created_date'] : '0' ?><br />
                Due Date:<?= !empty($editRecord[0]['due_date']) ? $editRecord[0]['due_date'] : '0' ?><br />
        </td>
    </tr>
    
</table>

        <br /><br />
        <table style="width: 100%" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
    <tr>
        <td style="width: 100%; font-size:16px;line-height:20px; display: table-cell;"> 
               Summary:- <br />
               <?= !empty($editRecord[0]['summary']) ? $editRecord[0]['summary'] : '0' ?>
               </td>
    </tr>
    
</table><br /><br />
<table style="width: 100%;">
            <tbody>
            <tr>
                <td>
                    <p style="text-align: left;font-size:16px;font-weight:bold;">Invoice Pricing Overview</p>
                </td>
            </tr>
            </tbody>
        </table>
<table width="100%" style="margin-bottom: 20px;border-spacing:0">
    <thead>
    <tr>
        <th style="text-align:left;border-bottom:3px solid #1c476d; display: table-cell; border-top:3px solid #1c476d;background: #ecf4f9; padding:5px; font-size:16px;line-height:20px; font-weight:bold;">Quantity</th>
        
            <th style="border-bottom:3px solid #1c476d; display: table-cell; border-top:3px solid #1c476d;text-align:left;background: #ecf4f9; padding:5px; font-size:16px;line-height:20px; font-weight:bold;">Description </th>
            <th style="border-bottom:3px solid #1c476d; display: table-cell; border-top:3px solid #1c476d;text-align:left;background: #ecf4f9; padding:5px; font-size:16px;line-height:20px; font-weight:bold;">Rate</th>
            <th style="border-bottom:3px solid #1c476d; display: table-cell; border-top:3px solid #1c476d;text-align:left;background: #ecf4f9; padding:5px; font-size:16px;line-height:20px; font-weight:bold;"> Tax</th>
            <th style="border-bottom:3px solid #1c476d; display: table-cell; border-top:3px solid #1c476d;text-align:left;background: #ecf4f9; padding:5px; font-size:16px;line-height:20px; font-weight:bold;"> Line Total</th>
        
    </tr>
    </thead>
    <tbody>
         <?php if (!empty($item_details)) {
            foreach ($item_details as $row) {
            ?>
    <tr>
            <td style="padding:5px; font-size:16px;line-height:20px;  display: table-cell;"><?= !empty($row['qty_hours']) ? $row['qty_hours'] : '' ?></td>
            <td style=" padding:5px; font-size:16px;line-height:20px; display: table-cell;"><?= !empty($row['description']) ? $row['description'] : '' ?></td>
            <td style=" padding:5px; font-size:16px;line-height:20px; display: table-cell;"><?= !empty($row['rate']) ? $row['rate'] : '' ?></td>
            <td style=" padding:5px; font-size:16px;line-height:20px; display: table-cell;"><?php if (count($allTaxesArray) > 0) { ?>
                                <?php foreach ($allTaxesArray as $tax) { ?>
                                    <?php if (!empty($row['tax_rate']) && $row['tax_rate'] == $tax["_id"]) {
                                     echo $tax["tax_name"] .':-'. $tax["tax"];
                                    } ?>
                                    <?php
                                }
                            }
                            ?></td>
            
            <td style=" padding:5px; font-size:16px;line-height:20px; display: table-cell;"><?= !empty($row['cost_rate']) ? $row['cost_rate'] : '' ?></td>
            <input type="hidden" name="cost_rate_<?= $row['_id'] ?>" data-tax_id="<?= !empty($row['tax_rate']) ? $row['tax_rate'] : '' ?>" onkeydown="return false" class="form-control cost_rate" placeholder="" value="<?= !empty($row['cost_rate']) ? $row['cost_rate'] : '' ?>">
                                            <input type="hidden" name="tax_sub_data_<?= $row['_id'] ?>" onkeydown="return false" class="form-control tax_sub_data" placeholder="" value="<?= !empty($row['tax_sub_data']) ? $row['tax_sub_data'] : '' ?>">
                                            <input type="hidden" name="tax_total_val_<?= $row['_id'] ?>" data-tax_id="<?= !empty($row['tax_rate']) ? $row['tax_rate'] : '' ?>" onkeydown="return false" class="form-control tax_total_val" data-tax_id="<?= !empty($row['tax_rate']) ? $row['tax_rate'] : '' ?>" placeholder="" value="<?= !empty($row['tax_total_val']) ? $row['tax_total_val'] : '' ?>">
    </tr>
            <?php }}?>
    
    </tbody>
</table>

    <!--    <div style='page-break-before: always;'></div>-->
        
        <table style="margin-top:8px; text-align: right; width: 100%; padding-top: 20px; font-size:16px; border-top: 1px solid #000;">
            <tbody>
            <tr>
                <td>Excluding Tax:</td>
                <td><?= !empty($editRecord[0]['amount']) ? $editRecord[0]['amount'] : '0' ?></td>
            </tr>
            <tr>
                <td><?= lang('discount') ?>:</td>
                <td><?= !empty($editRecord[0]['discount']) ? $editRecord[0]['discount'] : '0' ?>
            <?php 
            if($editRecord[0]['discount_type'] == 1  && !empty($editRecord[0]['discount_type'])){
                echo '%';
            }
            ?>

                    
                </td>
                <input type="hidden" name="discount_type" id="discount_type" value="<?= !empty($editRecord[0]['discount_type']) ? $editRecord[0]['discount_type'] : '' ?>">
            <input type="hidden" maxlength="5" name="discount" data-parsley-gteqm="#discount" id="discount" data-parsley-required-message="Required" onkeypress="return numericDecimal(event)" class="form-control item_cal discount_item discount-text" placeholder="" value="<?= !empty($editRecord[0]['discount']) ? $editRecord[0]['discount'] : '0' ?>">
            </tr>
            <?php
                            //  pr($item_details);exit;
                            $taxArray = array();
                            if (!empty($finalarr)) {
                                foreach ($finalarr as $key => $row) {
                                    $taxArray[$key][] = $row;
                                    //    $taxArray[]=$row['tax_total_val'];
                                }
                            }
                           // pr($taxArray);exit;
                            
                            ?>
            
              <?php if (count($taxes) > 0) { ?>
                                <?php
                                foreach ($taxes as $tax) {
                                    $taxSum = 0;
                                    $taxid = $tax["_id"];
                                    $taxSum = isset($taxArray["$taxid"]) ? array_sum($taxArray["$taxid"]) : 0;
                                    $taxedit = 0;
                                    if (isset($editRecord)) {
                                        if (($taxSum)>0) {
                                            $class = '';
                                        } else {
                                            $class='hidden';
                                        }
                                    }
                                    else
                                    {
                                         $class='hidden';
                                    }
                                    ?>
                        <tr>
                            
                            <td class="text-right <?php echo $class; ?> tax_boxvals" id="tax_<?php echo $tax["_id"]; ?>"><?php echo $tax["tax_name"]; ?>(<?php echo $tax["tax"]; ?>%): </td>
                            <td><span id='<?php echo $tax["_id"]; ?>' class="tax_boxvals_item"><?php echo $taxSum; ?></span></td>
                        </tr>
                        <?php
                    }
                }
                ?>


            <tr>
                <td>Tax Amount::</td>
                <td><?= !empty($editRecord[0]['tax_amunt']) ? $editRecord[0]['tax_amunt'] : '0' ?></td>
            </tr>
            <hr>
            <tr>
                <td><?= lang('total_amount') ?>:</td>
                <td><?= !empty($editRecord[0]['total_payment']) ? $editRecord[0]['total_payment'] : '0.00' ?></td>
            </tr>
            </tbody>
        </table>
    <br />
    <br />
<table style="width: 100%" cellpadding="0" cellspacing="0" style="margin-bottom: 20px;">
    <tr>
        <td style="width: 100%; font-size:16px;line-height:20px; display: table-cell;"> 
               Terms And Conditions:- <br />
               <?= !empty($editRecord[0]['terms_and_conditions']) ? $editRecord[0]['terms_and_conditions'] : '0' ?>
               </td>
    </tr>
    
</table>
    <?php }?>

</div>
<script src='<?= base_url() ?>uploads/custom/js/jQuery.print.js'></script>

<?php if($section == 'print'){ ?>
    <script>
        $("#prntViewPage").print();
        //window.top.close();
    </script>
<?php }?>


    