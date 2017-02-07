<?php require_once("include/seassion.php"); ?>
<?php require_once("include/database.php"); ?>
<?php require_once("include/function.php"); ?>
<?php confirm_logged_in(); ?>

<?php require_once("include/layouts/header.php"); ?>

            <div class="col-md-10"  id="main-content">
                <div class="row Content" id="guts">
                    <div class="contentHeading">
                        <h2>Saving Status</h2>
                    </div><!-- /. content-heading -->
                    <div class="addButton text-center">
                        <button class="btn btn-success " data-toggle="modal" data-target="#myModal">Add Earn Status</button>

                        <!-- add item form for modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Save Earn Money</h4>
                              </div>
                              <div class="modal-body">

                                <form method="post" action="saveAction.php" class="text-left">
                                  <div class="form-group">
                                    <label for="tk">Item:</label>
                                    <input type="text" class="form-control" id="tk" placeholder="Enter Item" name="earnItem">
                                  </div>
                                  <div class="form-group">
                                    <label for="tk">Amount:</label>
                                    <input type="number" class="form-control" id="tk" placeholder="Enter Amount" name="earnAmont">
                                  </div>
                                  <div class="form-group">
                                    <label for="src">Source:</label>
                                    <input type="text" class="form-control" id="src" placeholder="Enter Source Of Money" name="earnSource">
                                  </div>
                                  <div class="form-group">
                                    <label for="src">Catagories:</label>
                                    <select class="form-control" name="earncat">
                                      <option selected disabled>Select Catagory</option>
                                      <option value="1">Mandetoy Cost</option>
                                      <option value="2">Entertainment</option>
                                      <option value="3">Others</option>
                                    </select>
                                  </div>
                                  <button type="submit" name="submit" class="btn btn-default">Submit</button>
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
                                <th width="30%">Item</th>
                                <th width="20%">Source</th>
                                <th width="10%">Amount</th>
                                <th width="10%">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php 
                              $userId = $_SESSION['user_id'];
                              $earndata = find_earn_item($userId);
                              while ($earnItem = mysqli_fetch_assoc($earndata)) {
                            ?>
                              <tr class="<?php 
                                  if($earnItem['deleted'] == 1){ 
                                    echo 'success';
                                  } elseif ($earnItem['deleted'] == 2) {
                                   echo 'danger';
                                  } elseif ($earnItem['deleted'] == 3) {
                                   echo 'info';
                                  } else {
                                   echo 'warning';
                                  }
                                 ?>">
                                <td><?php echo $earnItem['id']; ?></td>
                                <td><?php echo $earnItem['earndate']; ?></td>
                                <td><?php echo $earnItem['earnitem']; ?></td>
                                <td><?php echo $earnItem['earnsource']; ?></td>
                                <td><?php echo $earnItem['earnamount']; ?></td>
                                <td>
                                    <a data-toggle="modal" href="#editModal<?php echo $earnItem['id']; ?>"><i class="fa fa-edit"></i></a>
                                    <a href="" data-toggle="tooltip" title="Delete" class="delete" id="<?php echo $earnItem['id']; ?>"><i class="fa fa-trash"></i></a>
                                  
                                </td>
                              </tr>

                                <!-- edit modal -->
                                <div id="editModal<?php echo $earnItem['id']; ?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Earn Money</h4>
                                      </div>
                                      <div class="modal-body">

                                        <form method="post" action="editEarn.php" class="text-left">
                                          <div class="form-group">
                                            <label for="tk">Item:</label>
                                            <input type="text" class="form-control" id="tk" value="<?php echo $earnItem['earnitem']; ?>" name="editEarnItem">
                                          </div>
                                          <div class="form-group">
                                            <label for="tk">Amount:</label>
                                            <input type="number" class="form-control" id="tk" value="<?php echo $earnItem['earnamount']; ?>" name="editEarnAmont">
                                          </div>
                                          <div class="form-group">
                                            <label for="src">Source:</label>
                                            <input type="text" class="form-control" id="src" value="<?php echo $earnItem['earnsource']; ?>" name="EditearnSource">
                                          </div>
                                          <div class="form-group">
                                            <label for="src">Catagories:</label>
                                            <select class="form-control" name="editEarnCat">
                                              <option<?php if ($earnItem['deleted'] == 1): ?> selected="selected"<?php endif; ?> value=1>Mandetoy Cost</option>
                                              <option<?php if ($earnItem['deleted'] == 2): ?> selected="selected"<?php endif; ?> value=2>Entertainment</option>
                                              <option<?php if ($earnItem['deleted'] == 3): ?> selected="selected"<?php endif; ?> value=3>Others</option>
                                            </select>
                                          </div>
                                          <button type="submit" name="editEarnSub" class="btn btn-default">Submit</button>
                                          <input type="hidden" name="eid" id="cid" value="<?php echo $earnItem["id"]; ?>">
                                        </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>

                                  </div>
                                </div>

                              <?php } ?>
                            </tbody>
                          </table>
                    </div><!-- /. content-heading -->
                </div><!-- /. content -->
            </div><!-- /. col-md-10 -->
        </section><!-- /.contentWrepper -->       

<?php require_once("include/layouts/footer.php"); ?>