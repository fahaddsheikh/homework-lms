
<?php if(isset($batchnoset) && !empty($batchnoset)) : echo "<h4>Batch ID#:" . $batchnoset . "</h4>"; endif;?>
<div id="<?php if(isset($batchnoset) && !empty($batchnoset)) : echo $batchnoset; else: echo 'new-batch'; endif; ?>">
    <div style="padding:15px;">
        <h2><strong>Batch Details</strong></h2>
        <hr>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Batch Number -->
            <label for="batch_number" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Batch Number#</h2>
            </label>
            <input type="text" style="width:50%" name="batch_number" id="batch_number" value="<?php if(isset($batchnoset) && !empty($batchnoset)) : echo $batchnoset; endif; ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Price -->
            <label for="price" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Price(Rs)</h2>
            </label>
            <input type="number" style="width:50%" name="price" id="price" value="<?php if(isset($price) && !empty($price)) : echo $price; endif; ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Location -->
            <label for="price" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Location</h2>
            </label>
            <select name="venue" id="venue" style="width:50%;" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo 'disabled'; endif; ?>>
                <option value="karachi" <?php if(isset($venue) && $venue == 'karachi') : echo 'selected'; endif; ?>>Karachi</option>
                <option value="hyderabad" <?php if(isset($venue) && $venue == 'hyderabad') : echo 'selected'; endif; ?>>Hyderabad</option>
                <option value="online" <?php if(isset($venue) && $venue == 'online') : echo 'selected'; endif; ?>>Online</option>
            </select>
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Price -->
            <label for="discounted_price" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2>Discounted Price(Rs)</h2></label>
            <input type="number" style="width:50%" name="discounted_price" id="discounted_price" value="<?php if(isset($discounted_price) && empty(!$discounted_price)) : echo $discounted_price; endif; ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="width:100%;float:left;margin-bottom:10px;">
            <!-- Price -->
            <label for="discount_detail" style="display: inline-block;margin: 0 10px;width:30%;width:30%;"><h2 style="margin:20px 0px 10px 0;">Discount Detail</h2></label>
            <textarea name="discount_detail" id="discount_detail" style="display: inline-block;box-sizing: border-box;margin: 0 21px;width: 97%;height: 100px;" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>><?php if(isset($discount_detail) && empty(!$discount_detail)) : echo $discount_detail; endif; ?></textarea>
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
            <input type="date" style="width:50%;" name="start_date" id="start_date" value="<?php if(isset($startdate) && !empty($startdate)) : echo $startdate; else: echo date("Y-m-d"); endif;  ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?> >
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- End Date -->
            <label for="end_date" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>End Date</h2>
            </label>
            <input type="date" style="width:50%;" name="end_date" id="end_date" value="<?php if(isset($enddate) && !empty($enddate)) : echo $enddate; else: echo date("Y-m-d"); endif;  ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?> >
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Duration -->
            <label for="duration" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Duration</h2>
            </label>
            <input type="text" style="width:50%" name="duration" id="duration" value="<?php if(isset($duration) && !empty($duration)) : echo $duration; endif; ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Days -->
            <label for="days" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Days</h2>
            </label>
            <input type="text" style="width:50%" name="days" id="days" value="<?php if(isset($days) && !empty($days)) : echo $days; endif; ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Time -->
            <label for="time" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Time</h2>
            </label>
            <input type="text" style="width:50%" name="time" id="time" value="<?php if(isset($time) && !empty($time)) : echo $time; endif; ?>" class="regular-text" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div style="padding:15px;">
        <h2><strong>Number of Students</strong></h2>
        <hr>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Batch Number -->
            <label for="number_registered_students" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Number of registered Students</h2>
            </label>
            <input type="number" style="width:50%" name="number_registered_students" id="number_registered_students" value="<?php if(isset($number_registered_students) && !empty($number_registered_students)) : echo $number_registered_students; else : echo 0; endif; ?>" class="small" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
        </div>
        <div style="width:50%;float:left;margin-bottom:10px;">
            <!-- Price -->
            <label for="number_total_students" style="display: inline-block;margin: 0 10px;width:30%;">
                <h2>Total Number of Students</h2>
            </label>
            <input type="number" style="width:50%" name="number_total_students" id="number_total_students" value="<?php if(isset($number_total_students) && !empty($number_total_students)) : echo $number_total_students;  else : echo 20; endif; ?>" class="small" <?php if(isset($batchnoset) && !empty($batchnoset)) : echo "readonly='readonly'"; endif; ?>>
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
        
        <?php if(isset($batchnoset) && !empty($batchnoset)) : ?>
            <button type="button" name="edit-batch" id="edit-batch" class="button button-primary">Edit Batch</button>
            <button type="button" name="update-batch" id="update-batch" class="button button-primary" style="display:none;">Update Batch</button>
            <button type="button" name="delete-batch" id="delete-batch" class="button button-secondary delete" onclick="return confirm('Are you sure you want to delete this batch?');" style="display:none;">Delete Batch</button>
        <?php else: ?>
            <button type="button" name="create-batch" id="create-batch" class="button button-primary">Create Batch!</button>
        <?php endif; ?>
    </div>
</div>