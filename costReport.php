<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php require_once("include/validation.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("include/layouts/header.php"); ?>
        

            <div class="col-md-10" id="main-content">
                <div class="row Content" id="guts">
                    <div class="contentHeading">
                        <h2>Costing Report</h2>
                    </div><!-- /. content-heading -->
                    <div class="contentTable">
                        <div class="col-md-4 col-md-offset-4">
                            <form class="navbar-form" method="post" action="costReport.php">
                                <div class="input-group add-on" >
                                 <label for="exampleInputEmail1">Start<span>*</span></label>
                                  <input class="form-control datepicker" data-date-format="dd/mm/yyyy" placeholder="Date" name="startdate">
                                  <div class="input-group-btn">
                                    <button class="btn btn-default form" type="button"><i class="fa fa-calendar"></i></button>
                                  </div>
                                </div>
                                <br><br>
                                <div class="input-group add-on">
                                 <label for="exampleInputEmail1">End<span>*</span></label>
                                  <input class="form-control datepicker" data-date-format="dd/mm/yyyy" placeholder="Date" name="enddate">
                                  <div class="input-group-btn">
                                    <button class="btn btn-default form" type="button"><i class="fa fa-calendar"></i></button>
                                  </div>
                                </div>
                                <button type="submit" name="genarate" class="btn btn-success customeSubmit">Genarate Report</button>
                            </form>
                        </div>
                    </div><!-- /. contentTable -->

                    <div class="col-md-12">
                        <div class="row showReport">
                        <?php
                           if(isset($_POST['genarate'])) {
                                $startDate = $_POST['startdate'];
                                $endDate = $_POST['enddate'];
                                $userid = $_SESSION['user_id'];
                                $match = "false";

                                $genarateReport = find_cost_item_date($userid, $startDate, $endDate);
                            ?> 
                            <div class="box-body">
                                <div id="printableArea">
                                    <div class="row ">
                                        <div class="col-md-8 col-md-offset-2">
                                            <header class="clearfix">
                                                <div id="company">
                                                    <h2 class="name">Shuvo</h2>
                                                    <div>01834934583</div>
                                                    <div>helloacademy@gmail.com</div>
                                                </div>
                                            </header>
                                            <hr>   


                                            <main class="invoice_report">
                                                <h4>Cost Report from: <strong><?php echo $startDate; ?></strong> to <strong><?php echo $endDate; ?></strong></h4>
                                                <br>
                                                <br>  

                                                                                                                                                                 
                                                <div class="singleTable">

                                                    <table border="0" cellspacing="0" cellpadding="0">
                                                        <thead>
                                                        <tr style="background-color: #20A19D">
                                                            <th class="no text-center">#</th>
                                                            <th class="text-center">Description</th>
                                                            <th class="unit text-center">Date</th>
                                                            <th class="total">TOTAL</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody> 
                                                        <?php
                                                            $i = 0;
                                                            $total = 0;
                                                            while ($getReport = mysqli_fetch_assoc($genarateReport)) {
                                                                $match = "true"; 
                                                                $i++;

                                                                //get total save(money)
                                                                $singleAmount = $getReport['costnamount'];
                                                                $total = $total + $singleAmount;
                                                                
                                                                
                                                         ?>                                             
                                                            <tr>
                                                                <td class="no"><?php echo $i; ?></td>
                                                                <td class="desc"><h3><?php echo $getReport['costitem']; ?></h3></td>
                                                                <td class="unit"><?php echo $getReport['costdate']; ?></td>
                                                                <td class="total"><?php echo $getReport['costnamount']; ?>Tk</td>
                                                            </tr>

                                                        <?php 
                                                            }
                                                            if($match === "false"){
                                                                echo "<h2 style='color:red'>there is no data</h2>";
                                                            }
                                                        ?> 
                                                        </tbody>
                                                    </table>
                                                </div><!-- singleTable -->
                                                      
                                                <table>
                                                    <thead>
                                                    <tr style="background-color: #ccc;display: none;">
                                                        <th class="no text-right">1</th>
                                                        <th class="no text-right">Description</th>
                                                        <th class="no text-center"></th>
                                                        <th class="no text-center"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody style="background-color: #c5c5c5">
                                                    <tr>
                                                    <td class="total" style="width: 10%;"></td>
                                                    <td class="total" style="width: 20%;"></td>
                                                    <td class="total" style="width: 30%;">Total Cost</td>
                                                    <td class="total" style="width: 35%;">= &nbsp;<?php echo $total; ?>Tk</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </main>

                                            <hr>
                                            <footer class="text-center">
                                                <strong>Money Management system</strong>&nbsp;&nbsp;&nbsp;Copyright &copy hello academy &copy; 2016                               
                                            </footer>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div><!-- /.showReport -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /. content -->
            </div><!-- /. col-md-10 -->
        </section><!-- /.contentWrepper -->         

<?php require_once("include/layouts/footer.php"); ?>