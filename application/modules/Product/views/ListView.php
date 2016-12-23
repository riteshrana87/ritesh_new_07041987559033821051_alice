<?php
if ($sortOrder == 'asc') {
    $sortOrder = 'desc';
} else {
    $sortOrder = 'asc';
}
?>

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
                    <table id="tech-companies-1" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th data-priority="1">SKU</th>
                                <th data-priority="2">Opening Stock</th>
                                <th data-priority="5">Purchases</th>
                                <th data-priority="4">Sales</th>
                                <th data-priority="2">Closing Stock</th>
                                <th data-priority="7">Action</th>
                            </tr>
                        </thead>

                        <tbody>
<?php


$i=1;
if (count($products) > 0) {
    foreach ($products as $product) {
        ?>
                                    <tr>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo $i; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo $product['product_name']; ?></a></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo $product['sku']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo $product['opening_stock']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo $product['purchases']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo $product['sales']; ?></td>
                                        <td class="cursor_<?php echo $i;?> cursor"  onclick="view('<?php echo $product['_id'];?>');" ><?php echo ( ($product['opening_stock'] + $product['purchases']) - $product['sales'] ); ?></td>

                                        <td class="actions">

                                            <a class="on-default edit-row" href="<?php echo base_url('Product/Edit/' . $product['_id']); ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="on-default remove-row cursor" onclick="promptAlert('<?php echo base_url('Product/Delete/' . $product['_id']); ?>');" ><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
    <?php $i++; } ?>

                            <?php } else { ?>
                                <tr>
                                    <td colspan="4"><?php echo lang('NO_RECORD_FOUND'); ?></td>
                                </tr>
<?php } ?>
                        </tbody>

                    </table>
<?php if (count($products) > 0) { ?>
                        <?php
                        echo $pagination['links'];
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>
<script>

var view_url="<?php echo base_url('Product/Edit'); ?>";

</script>