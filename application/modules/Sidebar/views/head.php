<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">

<link rel="shortcut icon" href="assets/images/favicon.ico">

<title>Alice - Bookkeeping</title>

<!--Morris Chart CSS -->
<link rel="stylesheet" href="<?= base_url() ?>uploads/assets/plugins/morris/morris.css">

<!-- App css -->
<link href="<?= base_url() ?>uploads/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/assets/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/assets/css/pages.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/assets/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>uploads/custom/alice.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>uploads/assets/plugins/morris/morris.css">

<link rel="stylesheet" href="<?= base_url() ?>uploads/assets/plugins/magnific-popup/dist/magnific-popup.css" />
<link rel="stylesheet" href="<?= base_url() ?>uploads/assets/plugins/jquery-datatables-editable/datatables.css" />

<?php
if (isset($headerCss)) {
    if (count($headerCss) > 0) {
        foreach ($headerCss as $element) {
            ?>
            <link href="<?php echo $element; ?>" rel="stylesheet" type="text/css" />
            <?php
        }
    }
}
?>

<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

<script src="<?= base_url() ?>uploads/assets/js/modernizr.min.js"></script>

