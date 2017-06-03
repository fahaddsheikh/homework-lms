<div id="new-batch">
    <div style="padding:15px;">
        <h2><strong>Batch Details</strong></h2>
        <hr>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Batch Number -->
            <label for="batch_number" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                <h2>Batch Number#</h2>
            </label>
            <input type="text" name="batch_number" id="batch_number" value="" class="regular-text" readonly="readonly">
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Price -->
            <label for="price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                <h2>Price(Rs)</h2>
            </label>
            <input type="number" name="price" id="price" value="<?php if(isset($price) && empty(!$price)) : echo $price; endif; ?>" class="regular-text" >
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Location -->
            <label for="price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                <h2>Location</h2>
            </label>
            <select name="venue" id="venue" style="width:50%;">
                <option value="karachi" <?php if(isset($venue) && $venue == 'karachi') : echo 'selected'; endif; ?>>Karachi</option>
                <option value="hyderabad" <?php if(isset($venue) && $venue == 'hyderabad') : echo 'selected'; endif; ?>>Hyderabad</option>
                <option value="online" <?php if(isset($venue) && $venue == 'online') : echo 'selected'; endif; ?>>Online</option>
            </select>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div style="padding:15px;">
        <h2><strong>Duration &amp; Timing</strong></h2>
        <hr>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Start Date -->
            <label for="start_date" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Start Date</h2>
            </label>
            <input type="date" name="start_date" id="start_date" value="<?php echo date("Y-m-d"); ?>" class="regular-text" >
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- End Date -->
            <label for="end_date" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>End Date</h2>
            </label>
            <input type="date" name="end_date" id="end_date" value="<?php echo date("Y-m-d"); ?>" class="regular-text" >
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Duration -->
            <label for="duration" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Duration</h2>
            </label>
            <input type="text" name="duration" id="duration" value="<?php if(isset($duration) && empty(!$duration)) : echo $duration; endif; ?>" class="regular-text">
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Days -->
            <label for="days" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Days</h2>
            </label>
            <input type="text" name="days" id="days" value="<?php if(isset($days) && empty(!$days)) : echo $days; endif; ?>" class="regular-text">
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Time -->
            <label for="time" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Time</h2>
            </label>
            <input type="text" name="time" id="time" value="<?php if(isset($time) && empty(!$time)) : echo $time; endif; ?>" class="regular-text">
        </div>
        <div style="clear:both;"></div>
    </div>
    <div style="padding:15px;">
        <h2><strong>Number of Students</strong></h2>
        <hr>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Batch Number -->
            <label for="number_registered_students" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                <h2>Number of registered Students</h2>
            </label>
            <input type="number" name="number_registered_students" id="number_registered_students" value="<?php if(isset($number_registered_students) && empty(!$number_registered_students)) : echo $number_registered_students; else : echo 0; endif; ?>" class="small" >
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Price -->
            <label for="number_total_students" style="display: inline-block;margin: 0 10px;width:30%;width:30%;">
                <h2>Total Number of Students</h2>
            </label>
            <input type="number" name="number_total_students" id="number_total_students" value="<?php if(isset($number_total_students) && empty(!$number_total_students)) : echo $number_total_students;  else : echo 20; endif; ?>" class="small" >
        </div>
        <div style="clear:both;"></div>
    </div>
    <hr>
    <div style="padding:15px 30px;;text-align:right;">
      <div id="batch-error" class="notice notice-error" style="display:none;">
          <h4 style="text-align:left;"></h4>
      </div>
      <input type="hidden" name="submitted" id="submitted" value="<?php echo wp_create_nonce( 'hl_batch_ajax' );?>">
      <div class="spinner hl-create" style="float: none;width: auto;height: auto;padding: 10px 0 10px 21px;"></div>
      <button type="button" name="create-batch" id="create-batch" class="button button-primary">Create Batch!</button>
          </div>
</div>



      <h4>Batch ID#: <?php echo $batchnoset ?></h4>
        <div id="<?php echo $batchnoset ?>" class="batch">
            <div>
                <h2><strong>Batch Details</strong></h2>
                <hr>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Batch Number -->
                    <label for="batch_number" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Batch Number#</h2></label>
                    <input type="text" name="batch_number" id="batch_number" value="<?php echo $batchnoset; ?>" class="regular-text" readonly="readonly">
                </div>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Price -->
                    <label for="price" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Price(Rs)</h2></label>
                    <input type="number" name="price" id="price" value="<?php if(isset($price) && empty(!$price)) : echo $price; endif; ?>" class="regular-text" readonly="readonly">
                </div>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Location -->
                    <label for="price" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Location</h2></label>
                    <select name="venue" id="venue" style="width:50%;" disabled>
                      <option value="karachi" <?php if(isset($venue) && $venue == 'karachi') : echo 'selected'; endif; ?>>Karachi</option>
                      <option value="hyderabad" <?php if(isset($venue) && $venue == 'hyderabad') : echo 'selected'; endif; ?>>Hyderabad</option>
                      <option value="online" <?php if(isset($venue) && $venue == 'online') : echo 'selected'; endif; ?>>Online</option>
                    </select>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div>
                <h2><strong>Duration &amp; Timing</strong></h2>
                <hr>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Start Date -->
                    <label for="start_date" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Start Date</h2></label>
                    <input type="date" name="start_date" id="start_date" value="<?php if(isset($startdate) && empty(!$startdate)) : echo $startdate; endif; ?>" class="regular-text" readonly="readonly">
                </div>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- End Date -->
                    <label for="end_date" style="display: inline-block;margin: 0 10px;width:25%;"><h2>End Date</h2></label>
                    <input type="date" name="end_date" id="end_date" value="<?php if(isset($enddate) && empty(!$enddate)) : echo $enddate; endif; ?>" class="regular-text" readonly="readonly">
                </div>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Duration -->
                    <label for="duration" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Duration</h2></label>
                    <input type="text" name="duration" id="duration" value="<?php if(isset($duration) && empty(!$duration)) : echo $duration; endif; ?>" class="regular-text" readonly="readonly">
                </div>      
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Days -->
                    <label for="days" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Days</h2></label>
                    <input type="text" name="days" id="days" value="<?php if(isset($days) && empty(!$days)) : echo $days; endif; ?>" class="regular-text" readonly="readonly">
                </div>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Time -->
                    <label for="time" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Time</h2></label>
                    <input type="text" name="time" id="time" value="<?php if(isset($time) && empty(!$time)) : echo $time; endif; ?>" class="regular-text" readonly="readonly">
                </div>
                <div style="clear:both;"></div>
            </div>
            <div>
                <h2><strong>Number of Students</strong></h2>
                <hr>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Batch Number -->
                    <label for="number_registered_students" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Number of registered Students</h2></label>
                    <input type="number" name="number_registered_students" id="number_registered_students" value="<?php if(isset($number_registered_students) && empty(!$number_registered_students)) : echo $number_registered_students; else : echo 0; endif; ?>" class="small" readonly="readonly">
                </div>
                <div style="width:50%;float:left;margin-bottom:10px;">
                    <!-- Price -->
                    <label for="number_total_students" style="display: inline-block;margin: 0 10px;width:25%;"><h2>Total Number of Students</h2></label>
                    <input type="number" name="number_total_students" id="number_total_students" value="<?php if(isset($number_total_students) && empty(!$number_total_students)) : echo $number_total_students;  else : echo 20; endif; ?>" class="small" readonly="readonly">
                </div>
                <div style="clear:both;"></div>
            </div>
            <hr>
            <div style="padding:15px 30px;;text-align:right;">
                <div id="batch-error" class="notice notice-error" style="display:none;"><h4 style="text-align:left;"></h4></div>
                <input type="hidden" name="submitted" id="submitted" value="<?php echo wp_create_nonce( 'hl_batch_ajax' );?>">
                <div class="spinner hl-show" style="float: none;width: auto;height: auto;padding: 10px 0 10px 21px;background-position: 0;position: absolute;left: 50%;top: 50%;"></div>
        <button type="button" name="edit-batch" id="edit-batch" class="button button-primary">Edit Batch</button>
                <button type="button" name="update-batch" id="update-batch" class="button button-primary" style="display:none;">Update Batch</button>
                <button type="button" name="delete-batch" id="delete-batch" class="button button-secondary delete" onclick="return confirm('Are you sure?');" style="display:none;">Delete Batch</button>
            </div>
        
        </div>

  </div>
  <div class='spinner hl-show' style='float: none;width: auto;height: auto;padding: 10px 0 10px 21px;background-position: 0;background-position: 0;position: absolute;top: 50%;left: 50%;'></div>