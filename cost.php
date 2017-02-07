<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_logged_in(); ?>
<?php require_once("include/layouts/header.php"); ?>

            <div class="col-md-10" id="main-content">
                <div class="row Content" id="guts">
                    <div class="contentHeading">
                        <h2>Cost Status</h2>
                    </div><!-- /. content-heading -->
                    <div class="addButton text-center">
                        <button class="btn btn-success " data-toggle="modal" data-target="#myModal">Add Cost Status</button>

                        <!-- add item form for modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Save Cost Money</h4>
                              </div>
                              <div class="modal-body">

                                <form method="post" action="costAction.php" class="text-left">
                                  <div class="form-group">
                                    <label for="tk">Source Of Cost:</label>
                                    <input type="text" class="form-control" id="tk" placeholder="Enter Source Of Cost" name="costItem">
                                  </div>
                                  <div class="form-group">
                                    <label for="tk">Amount:</label>
                                    <input type="number" class="form-control" id="tk" placeholder="Enter Amount" name="costAmont">
                                  </div>
                                  <div class="form-group">
                                    <label for="src">Catagories:</label>
                                    <select class="form-control" name="costcat">
                                      <option selected disabled>Select Catagory</option>
                                      <option value="1">Mandetoy Cost</option>
                                      <option value="2">Entertainment</option>
                                      <option value="3">Others</option>
                                    </select>
                                  </div>
                                  <button type="submit" name="submit" class="btn btn-default">Add Cost</button>
                                </form>

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                    </div>
                    <div class="message">
                     <?php echo message(); ?>
                    </div>
                    <div class="contentTable">
                        <table class="table" id="moneyManagement">
                            <thead>
                              <tr>
                                <th width="10%">SerialNo:</th>
                                <th width="20%">Date</th>
                                <th width="50%">Source of Cost</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                                  $userId = $_SESSION['user_id'];
                                  $costdata = find_cost_item($userId);
                                  while ($costItem = mysqli_fetch_assoc($costdata)) {
                                ?>
                              <tr class="<?php 
                                  if($costItem['deleted'] == 1){ 
                                    echo 'success';
                                  } elseif ($costItem['deleted'] == 2) {
                                   echo 'danger';
                                  } elseif ($costItem['deleted'] == 3) {
                                   echo 'info';
                                  } else {
                                   echo 'warning';
                                  }
                                 ?>">
                                <td><?php echo $costItem['id']; ?></td>
                                <td><?php echo $costItem['costdate']; ?></td>
                                <td><?php echo $costItem['costitem']; ?></td>
                                <td><?php echo $costItem['costnamount']; ?></td>
                                <td>
                                    <a data-toggle="modal" href="#editModal<?php echo $costItem['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a href="" data-toggle="tooltip" title="Delete" class="deletecost" id="<?php echo $costItem['id']; ?>"><i class="fa fa-trash"></i></a>
                                </td>

                                <!-- edit modal -->
                                <div id="editModal<?php echo $costItem['id']; ?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Cost Money</h4>
                                      </div>
                                      <div class="modal-body">

                                        <form method="post" action="editCost.php" class="text-left">
                                          <div class="form-group">
                                            <label for="tk">Source Of Cost:</label>
                                            <input type="text" class="form-control" id="tk" value="<?php echo $costItem['costitem']; ?>" name="editCostItem">
                                          </div>
                                          <div class="form-group">
                                            <label for="tk">Amount:</label>
                                            <input type="number" class="form-control" id="tk" value="<?php echo $costItem['costnamount']; ?>" name="editCostAmont">
                                          </div>
                                          <div class="form-group">
                                            <label for="src">Catagories:</label>
                                            <select class="form-control" name="editCostCat">
                                              <option<?php if ($costItem['deleted'] == 1): ?> selected="selected"<?php endif; ?> value=1>Mandetoy Cost</option>
                                              <option<?php if ($costItem['deleted'] == 2): ?> selected="selected"<?php endif; ?> value=2>Entertainment</option>
                                              <option<?php if ($costItem['deleted'] == 3): ?> selected="selected"<?php endif; ?> value=3>Others</option>
                                            </select>
                                          </div>
                                          <button type="submit" name="editCostSub" class="btn btn-default">Submit</button>
                                          <input type="hidden" name="cid" id="cid" value="<?php echo $costItem["id"]; ?>">
                                        </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                    </div><!-- /. content-heading -->
                </div><!-- /. content -->
            </div><!-- /. col-md-10 -->
        </section><!-- /.contentWrepper -->    
<?php require_once("include/layouts/footer.php"); ?>