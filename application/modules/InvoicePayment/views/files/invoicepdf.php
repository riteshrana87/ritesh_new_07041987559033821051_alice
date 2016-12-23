<div id="prntViewPage" <?php if($section == 'print'){ ?> style="display:none;" <?php }?>>
    <?php
    if (isset($editRecord) && !empty($editRecord)) { ?>
        <?php $Symbol = $PDFCuntArray[0]['currrency_symbol'];

        ?>

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
        </style>
        <table style="width:100%">
            <tbody>
            <tr>
                <td style="font-size: 65px;padding-top:154px;text-align: left; width:100%">
                    subject : name
                    <p style="padding-bottom: 0px; font-size:20px;"><?php echo $editRecord[0]['invoice_code']; ?>
                    </p>
                    <?php echo "<br><br>";?>

                    <p style="padding-bottom: 20px; padding-top: 20px; font-size:20px; width:200px; border-top: 1px solid #000;"><?php echo lang('PREPARED_FOR') ?></p>
                    <?php if(isset($client_data['name']) && $client_data['name'] != ""){?>

                        <p style="font-size: 40px;font-weight:bold;text-transform:capitalize;">
                            <?php if(isset($client_data[0]['firstname']) && $client_data[0]['firstname'] != "" &&  isset($client_data[0]['lastname']) && $client_data[0]['lastname'] != ""){ ?>
                                <?php echo $client_data[0]['firstname'].' '.$client_data[0]['lastname']; ?>
                            <?php }?>
                        </p>
                    <?php }?>
                    <p style="font-size: 30px;">
                        <?php if(isset($client_data[0]['address']) && $client_data[0]['address'] != ""){?>
                            <?php echo $client_data[0]['address']; echo "<br>";?>
                        <?php }?>
                    </p>
                    <p style="font-size: 30px;">
                        <?php if(isset($client_data[0]['zipcode']) && $client_data[0]['zipcode'] != ""){?>
                            <?php echo $client_data[0]['zipcode']; ?>
                        <?php }?>
                        <?php if(isset($client_data[0]['city']) && $client_data[0]['city'] != ""){?>
                            <?php echo ' | '.$client_data[0]['city']; ?>
                        <?php }?>
                        <?php if(isset($client_data[0]['state']) && $client_data[0]['state'] != ""){?>
                            <?php echo ' | '.$client_data[0]['state']; ?>
                        <?php }?>
                    </p>
                    <p  style="font-size: 30px;">
                        <?php echo $client_data[0]['country']; ?>
                    </p>
                </td>
            </tr></tbody>
        </table>

        <!--style="width:100%;border:2px #000 solid;text"-->
        <table style="width: 100%; padding-top: 50px;">
            <tbody>
            <tr>
                <td>
                    <p style="text-align: left;font-size:20px;">
                        <?php if(isset($editRecord[0]['created_date']) && $editRecord[0]['created_date'] != ""){?>
                    <p style="text-align: left;font-size:20px;">
                        <?php echo lang('EST_CREATE'); ?>:s
                        <?php echo "<br>";?>
                        <?php echo $editRecord[0]['created_date']; ?>
                    </p>
                    <?php }?>
                    </p>
                </td>
                <td>
                    <p style="text-align: right;font-size:20px;">
                        <?php if(isset($editRecord[0]['due_date']) && $editRecord[0]['due_date'] != ""){?>
                    <p style="text-align: right;font-size:20px;">
                        <?php echo lang('EST_VALID_TIL'); ?>:
                        <?php echo "<br>";?>
                        <?php echo $editRecord[0]['due_date']; ?>
                    </p>
                    <?php }?>
                    </p>
                </td>
            </tr>
            </tbody>
        </table>

        <?php $Symbol = $PDFCuntArray[0]['currrency_symbol'];?>
        <div style='page-break-before: always;'></div>
        <table style="width: 100%;">
            <tbody>
            <tr>
                <td>
                    <p style="text-align: left;font-size:20px;font-weight:bold;"><?php echo lang('EST_PDF_PRICING_OVERVIEW'); ?></p>
                </td>
            </tr>
            </tbody>
        </table>
        <table style="width: 100%;">
            <tbody>
            <tr>
                <th style="width:10%"><?php echo lang("EST_LBL_PDF_QTY");?></th>
                <th style="width:30%;text-align:left;"><?php echo lang('EST_LABEL_PRODUCT_NAME'); ?></th>
                <th style="width:20%;text-align:right;"><?php echo lang('EST_LABEL_SINGLE_PRICE'); ?></th>
                <th style="width:20%;text-align:right;"><?php echo lang('EST_LABEL_ITEM_TAX'); ?></th>
                <th style="width:20%;text-align:right;"><?php echo lang('EST_LABEL_TOTAL_LINE_PRICE'); ?></th>
            </tr>


            <?php if (!empty($item_details)) {
            foreach ($item_details as $row) {
            ?>
                <tr>
                    <td style="text-align: left"><?= !empty($row['qty_hours']) ? $row['qty_hours'] : '' ?></td>
                    <td style="text-align: left"><?= !empty($row['description']) ? $row['description'] : '' ?></td>

                    <td style="text-align: right"><?= !empty($row['rate']) ? $row['rate'] : '' ?></td>
                    <td style="text-align: right"><select class="form-control item_cal tax_item" name="tax_rate_<?= $row['_id'] ?>" required data-parsley-trigger="change" >
                            <option value=""><?= lang('tax') ?></option>
                            <?php if (count($taxes) > 0) { ?>
                                <?php foreach ($taxes as $tax) { ?>
                                    <option <?php if (!empty($row['tax_rate']) && $row['tax_rate'] == $tax["_id"]) {
                                        echo 'selected="selected"';
                                    } ?> value="<?= $tax["_id"] ?>"  data-tax="<?php echo $tax["tax"]; ?>"><?php echo $tax["tax_name"]; ?>  <?php echo $tax["tax"]; ?> </option>
                                    <?php
                                }
                            }
                            ?>
                        </select></td>
                    <td style="text-align: right"><?= !empty($row['cost']) ? $row['cost'] : '' ?></td>
                </tr>
            <?php }
            } ?>
            </tbody>
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