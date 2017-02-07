<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("include/layouts/header.php"); ?>
        
			<section id="main-content">
			    <div class="Content" id="guts">
			    	<div class="dashboardTop">

			    		<div class="col-md-3">
			    			<div class="singleDitem">
			    				<div class="iner">
			    					<?php
										$totalSave = total_saving_account();
										$gettotalsave = $totalSave['save_value_sum']; 
										echo "<h2>Tk:". $gettotalsave . "/=</h2>";
										echo "<p>Total saving</p>";
									?>
			    				</div>
			    				<div class="icon">
			    					<i class="fa fa-bar-chart-o"></i>
			    				</div>
			    				<span>Earning Amount</span>
			    			</div><!-- /. singleDitem -->
			    		</div><!-- /. col-md-3 -->
			    		
			    		<div class="col-md-3">
			    			<div class="singleDitem TotalcostBg">
			    				<div class="iner">
			    					<?php
										$totalcost = total_costing_account();
										$gettotalCost = $totalcost['cost_value_sum'];
										echo "<h2>Tk:".$gettotalCost . "/=</h2>";
										echo "<p>Total saving</p>";
									?>
			    				</div>
			    				<div class="icon">
			    					<i class="fa fa-money"></i>
			    				</div>
			    				<span>Costing Amount</span>
			    			</div><!-- /. singleDitem -->
			    		</div><!-- /. col-md-3 -->

			    		<div class="col-md-3">
			    			<div class="singleDitem benifitBg">
			    				<div class="iner">
				    				<?php 
										$devit = devit_amount();
										if($gettotalsave > $gettotalCost ) {
											echo "<h2>Tk:". $devit ."/=</h2>";
											echo "<p>Only</p>";
										} else {

											echo "<h2>Tk:0/=</h2>";
											echo "<p>Only</p>";
										}
									?>
			    				</div>
			    				<div class="icon">
			    					<i class="fa fa-shopping-cart"></i>
			    				</div>
			    				<span>Debit Amount</span>
			    			</div><!-- /. singleDitem -->
			    		</div><!-- /. col-md-3 -->

			    		<div class="col-md-3">
			    			<div class="singleDitem lostBg">
			    				<div class="iner">
				    				<?php 
										$creadit = devit_amount();
										if($gettotalsave < $gettotalCost ) {
											echo "<h2>Tk:". $creadit ."/=</h2>";
											echo "<p>Only</p>";
										} else {
											echo "<h2>Tk: 0 /=</h2>";
											echo "<p>Only</p>";
										}
									?>
			    				</div>
			    				<div class="icon">
			    					<i class="fa fa-suitcase"></i>
			    				</div>
			    				<span>Credit Amount</span>
			    			</div><!-- /. singleDitem -->
			    		</div><!-- /. col-md-3 -->
				<section>
					<?php
						$ss = monthly_saving_amount(1);
						
					?>
				</section>
			    	</div><!-- /.  dahsboardTop -->
			    </div>
			</section>


        </section><!-- /.contentWrepper -->       


<?php require_once("include/layouts/footer.php"); ?>