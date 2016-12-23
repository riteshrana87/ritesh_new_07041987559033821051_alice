<div class="container dashboard_screen">
    <div class="row">
        <div class="col-lg-6">
            <div class="head_title">Total Profit</div>
            <div class="card-box section_height1">
                <div class="row">
                    <div class="text-center">
                        <ul class="list-inline chart-detail-list">
                            <li>
                                Total Profit: <?php echo $companyinformation[0]['company_currency'] ." ". $profit ?><!-- <h5 style="color: #ff8acc;"><i class="fa fa-circle m-r-5"></i>Series A</h5>-->
                            </li>
                            <li>
                                <select id="total_profit_year">
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <div id="total_profit_chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="head_title">Total Spending</div>
            <div class="card-box section_height1">
                <div class="row">
                    <div class="text-center">
                        <ul class="list-inline chart-detail-list">
                            <li>
                                Total Spending: <?php echo $companyinformation[0]['company_currency'] ." ". $spending; ?>
                            </li>
                            <li>
                                <select id="total_spending_year">
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                    <div id="total_spending_chart"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="head_title">Outstanding Revenue</div>
            <div class="card-box section_height2">
                <div class="row">
                    <div class="col-lg-8">
                        <div id="outstanding_revenue_chart" style="height: 300px;"></div>
                        <div class="text-center">
                            <ul class="list-inline chart-detail-list">
                                <li>
                                    <h5 style="color: #d70206;"><i class="fa fa-circle m-r-5"></i>Outstanding</h5>
                                </li>
                                <li>
                                    <h5 style="color: #f05b4f;"><i class="fa fa-circle m-r-5"></i>Overdue</h5>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-center section_outstanding">
                            <div class="col-lg-12">
                                <div class="head">Total Outstanding</div>
                                <p class="amt_no"><?php echo $companyinformation[0]['company_currency'] .' '. $overdue_total_amount + $outstanding_total_amount ?></p>
                            </div>
                            <div class="col-lg-6">
                                <div class="head1">Outstanding </div>
                                <p class="amt_no1"><?php echo $companyinformation[0]['company_currency'] .' '. $outstanding_total_amount ?></p>
                            </div>
                            <div class="col-lg-6">
                                <div class="head1">Overdue</div>
                                <p class="amt_no1"><?php echo $companyinformation[0]['company_currency'] .' '. $overdue_total_amount ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="head_title">Spending By Category</div>
            <div class="card-box section_height2">
                <div class="row">
                    <div class="text-center">
                        <ul class="list-inline chart-detail-list">
                            <li>
                            </li>
                        </ul>
                    </div>
                    <table id="pieChart" style="display:none" class="pieChart data-table col-table">
                        <tr>
                            <th scope="col" data-type="string">Spending Category</th>
                            <th scope="col" data-type="number">Value</th>
                        </tr>
                        <?php
                        foreach ($categories_spend_try as $key => $value){
                            ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td><?php echo $value ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="head_title">Activities</div>
            <div class="card-box section_height">
                <div class="row">
                    <table class="table table-striped m-0">
                        <tbody>
                            <?php
                            if(count($activities_data)>0){
                                foreach($activities_data as $activity){
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $activity['created_at'] .$activity['activity'] ?> </th>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="head_title">Reports for your Accountant</div>
            <div class="col-lg-2 box_report">
                <a href="<?php echo base_url('Reports').'/ProfitLossReport/' ?>">
                    <img src="<?php echo base_url(); ?>/uploads/assets/images/dash_report/report1.svg"/>
                    <div class="title">Profit & Loss</div>
                </a>
            </div>
            <div class="col-lg-2 box_report">
                <a href="<?php echo base_url('Reports').'//' ?>">
                    <img src="<?php echo base_url(); ?>/uploads/assets/images/dash_report/report2.svg"/>
                    <div class="title">Sale Tax Summary</div>
                </a>
            </div>
            <div class="col-lg-2 box_report">
                <a href="<?php echo base_url('Reports') ?>">
                    <img src="<?php echo base_url(); ?>/uploads/assets/images/dash_report/report3.svg"/>
                    <div class="title">Accounts Aging</div>
                </a>
            </div>
            <div class="col-lg-2 box_report">
                <a href="<?php echo base_url('Reports') ?>">
                    <img src="<?php echo base_url(); ?>/uploads/assets/images/dash_report/report4.svg"/>
                    <div class="title">Invoice Details</div>
                </a>
            </div>
            <div class="col-lg-2 box_report">
                <a href="<?php echo base_url('Reports') ?>">
                    <img src="<?php echo base_url(); ?>/uploads/assets/images/dash_report/report5.svg"/>
                    <div class="title">Expense Reports</div>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">

</div>
<script>
    var resizefunc = [];
    var profit_get_url 	=	'<?php echo base_url('Dashboard').'/GetProfitByYear/' ?>';
    var spending_get_url 	=	'<?php echo base_url('Dashboard').'/GetSpendingByYear/' ?>';
    var getcat_trial 	=	'<?php echo base_url('Dashboard').'/getcat_trial/' ?>';
    var overdue_total_amount 	=	'<?php echo $overdue_total_amount ?>';
    var outstanding_total_amount 	=	'<?php echo $outstanding_total_amount ?>';
    var categories_spend 	=	'<?php echo $categories_spend ?>';

    var year 	=	'<?php echo $year ?>';
    var jan 	=	'<?php echo $jan ?>';
    var feb 	=	'<?php echo $feb ?>';
    var mar 	=	'<?php echo $mar ?>';
    var apr 	=	'<?php echo $apr ?>';
    var may 	=	'<?php echo $may ?>';
    var jun 	=	'<?php echo $jun ?>';
    var jul 	=	'<?php echo $jul ?>';
    var aug 	=	'<?php echo $aug ?>';
    var sept	=	'<?php echo $sept ?>';
    var oct 	=	'<?php echo $oct ?>';
    var nov 	=	'<?php echo $nov ?>';
    var dec 	=	'<?php echo $dec ?>';

    var jan_spending 	=	'<?php echo $jan_spending ?>';
    var feb_spending 	=	'<?php echo $feb_spending ?>';
    var mar_spending 	=	'<?php echo $mar_spending ?>';
    var apr_spending 	=	'<?php echo $apr_spending ?>';
    var may_spending 	=	'<?php echo $may_spending ?>';
    var jun_spending 	=	'<?php echo $jun_spending ?>';
    var jul_spending 	=	'<?php echo $jul_spending ?>';
    var aug_spending 	=	'<?php echo $aug_spending ?>';
    var sept_spending	=	'<?php echo $sept_spending ?>';
    var oct_spending 	=	'<?php echo $oct_spending ?>';
    var nov_spending 	=	'<?php echo $nov_spending ?>';
    var dec_spending 	=	'<?php echo $dec_spending ?>';
</script>
