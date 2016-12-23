<!DOCTYPE html>
<html>
    <head>
        <?php
        /*
          Author : Ritesh Rana
          Desc   : Call Head area
          Input  : Bunch of Array
          Output : All CSS and JS
          Date   : 01/10/2016
         */
        if (empty($head)) {
            $head = array();
        }
        echo Modules::run('Sidebar/head', $head);
        ?>
    </head>	

     < <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">
                <?php
                /*
                  Author : Ritesh Rana
                  Desc   : Call Header area
                  Input  : Bunch of Array
                  Output : Top Side Header(Logo, Menu, Language)
                  Date   : 01/10/2016
                 */
                if (empty($header)) {
                    $header = array();
                }
                echo Modules::run('Sidebar/header', $header);
                ?>
            </div>
           
<?php
/*
  Author : Ritesh Rana
  Desc   : Call Left Menu area
  Input  : Bunch of array
  Output : Top Side Header
  Date   : 01/10/2016
 */
if (empty($leftmenu)) {
    $leftmenu = array();
}
echo Modules::run('Sidebar/leftmenu', $leftmenu);
?>
  

  <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
<?php
/*
  Author : Ritesh Rana
  Desc   : Call Page Content Area
  Input  : View Page Name and Bunch of array
  Output : View Page
  Date   : 01/10/2016
 */
$this->load->view($main_content);
?>
        </div>
        </div>
       </div> 
            <?php
            /*
              Author : Ritesh Rana
              Desc   : Call Footer Area
              Input  :
              Output : Footer Area( Menu, Content)
              Date   : 01/10/2016
             */
            echo Modules::run('Sidebar/footer');
            ?>
        <script>
            
            $('body').delegate('[data-toggle="ajaxModal"]', 'click',
        function (e) {
            $('#ajaxModal').remove();
            e.preventDefault();
            var $this = $(this)
                , $remote = $this.data('remote') || $this.attr('data-href') || $this.attr('href')
                , $modal = $('<div class="modal" id="ajaxModal"><div class="modal-body"></div></div>');
            $('body').append($modal);
            $modal.modal();
            var url=$remote+"?token=<?php echo generateFormToken();?>";
            $modal.load(url);
            //$("body").addClass("modal-open");
            $("body").css("padding-right", "0 !important");
        }
    );
        </script>
        
    </body>
</html>
