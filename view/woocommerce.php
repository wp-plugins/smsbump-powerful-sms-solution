
	<table class="form-table">
		<tbody>
			<form method="post" action="options.php" name="form">
				<?php settings_fields( 'smsbump_woo_settings' ); ?>
				<?php do_settings_sections( 'smsbump_woo_settings' ); ?>
				<?php $smsbump_woo_on_checkout = get_option('smsbump_woo_on_checkout'); ?>
				<?php $smsbump_woo_on_checkout_user = get_option('smsbump_woo_on_checkout_user'); ?>
				<?php $smsbump_woo_on_order_status = get_option('smsbump_woo_on_order_status'); ?>
				<tr>
					<th scope="row">
						<label for="smsbump_woo_on_checkout">Receive SMS on checkout</label>
						<span class="help">Enable this option if you want to receive SMS on successful checkout</span>
					</th>
					<td>
						<select name="smsbump_woo_on_checkout">
                     		<option value="yes" <?php if(get_option('smsbump_woo_on_checkout') == 'yes') echo 'selected=smsbump_woo_on_checkout'; ?>>Enabled</option>
                      		<option value="no"  <?php if(get_option('smsbump_woo_on_checkout')  == '' || get_option('smsbump_woo_on_checkout')  == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr class="smsbump_woo_on_checkout_text" style="display:none;">
					<th scope="row">
							<span class="help">Shortcodes:<br />{OrderID} - Order id</span>
					</th>
					<td>
						<textarea name="smsbump_woo_on_checkout_text" cols="50" class="form-control" rows="4" class="regular-text"><?php if(get_option('smsbump_woo_on_checkout_text')) echo get_option('smsbump_woo_on_checkout_text'); else echo "Someone ordered something from your store. The order ID is: {OrderID}."; ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_woo_on_checkout_user">Send SMS on checkout</label>
						<span class="help">Enable this option if you want to send SMS to your customers that their order has been succesfully made.</span>
					</th>
					<td>
						<select name="smsbump_woo_on_checkout_user">
                     		<option value="yes" <?php if(get_option('smsbump_woo_on_checkout_user') == 'yes') echo 'selected=smsbump_woo_on_checkout_user'; ?>>Enabled</option>
                      		<option value="no"  <?php if(get_option('smsbump_woo_on_checkout_user')  == '' || get_option('smsbump_woo_on_checkout_user')  == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr class="smsbump_woo_on_checkout_user_text" style="display:none;">
					<th scope="row">
						<span class="help">Shortcodes:<br />{SiteName} - Site name<br />{OrderID} - Order id</span>
					</th>
					<td>
						<textarea name="smsbump_woo_on_checkout_user_text" cols="50" class="form-control" rows="4" class="regular-text"><?php if(get_option('smsbump_woo_on_checkout_user_text')) echo get_option('smsbump_woo_on_checkout_user_text'); else echo "Thank you for ordering from {SiteName}. Your order ID is: {OrderID}."; ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_woo_on_order_status">Send SMS on completed order</label>
						<span class="help">Enable this option if you want to send SMS to your customers when the order status is changed to Completed.</span>
					</th>
					<td>
						<select name="smsbump_woo_on_order_status">
		                    <option value="yes" <?php if(get_option('smsbump_woo_on_order_status') == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                    <option value="no"  <?php if(get_option('smsbump_woo_on_order_status')  == '' || get_option('smsbump_woo_on_order_status')  == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr class="smsbump_woo_on_order_status_text" style="display:none;">
					<th scope="row">
							<span class="help">Shortcodes:<br />{OrderID} - Order id<br />{SiteName} - Site name</span>
					</th>
					<td>
						<textarea name="smsbump_woo_on_order_status_text" cols="50" class="form-control" rows="4" class="regular-text"><?php if(get_option('smsbump_woo_on_order_status_text')) echo get_option('smsbump_woo_on_order_status_text'); else echo "Your order ({OrderID}) at {SiteName} has been completed."; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<p class="submit">
							<?php submit_button(); ?>
						</p>
					</td>
				</tr>		
					
			</form>
		</tbody>
	</table>
</div> <!-- CLOSING THE MAIN WRAPPER -->
<script>
	jQuery(function ($) {
		var smsbump_woo_on_checkout = '<?php echo $smsbump_woo_on_checkout ?>';
		
		if(smsbump_woo_on_checkout == "yes") {
			$('.smsbump_woo_on_checkout_text').show();
		} else {
			$('.smsbump_woo_on_checkout_text').hide();
		}

		$('select[name="smsbump_woo_on_checkout"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.smsbump_woo_on_checkout_text').show();
			} else {
				$('.smsbump_woo_on_checkout_text').hide();
			}
		});

		var smsbump_woo_on_checkout_user = '<?php echo $smsbump_woo_on_checkout_user ?>';
		
		if(smsbump_woo_on_checkout_user == "yes") {
			$('.smsbump_woo_on_checkout_user_text').show();
		} else {
			$('.smsbump_woo_on_checkout_user_text').hide();
		}

		$('select[name="smsbump_woo_on_checkout_user"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.smsbump_woo_on_checkout_user_text').show();
			} else {
				$('.smsbump_woo_on_checkout_user_text').hide();
			}
		});

		var smsbump_woo_on_order_status = '<?php echo $smsbump_woo_on_order_status ?>';
		
		if(smsbump_woo_on_order_status == "yes") {
			$('.smsbump_woo_on_order_status_text').show();
		} else {
			$('.smsbump_woo_on_order_status_text').hide();
		}

		$('select[name="smsbump_woo_on_order_status"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.smsbump_woo_on_order_status_text').show();
			} else {
				$('.smsbump_woo_on_order_status_text').hide();
			}
		});		

	});
	
</script>