
	<table class="form-table">
		<tbody>
			<form method="post" action="options.php" name="form">
				<?php settings_fields( 'smsbump_settings' ); ?>
				<?php do_settings_sections( 'smsbump_settings' ); ?>
				<?php $enabled = get_option('smsbump_enabled'); ?>
				<?php $phoneNumberPrefix = get_option('smsbump_PhoneNumberPrefix'); ?>
				<?php $strictPrefix = get_option('smsbump_StrictPrefix'); ?>
				<?php $published_comment = get_option('smsbump_published_comment'); ?>
				<?php $registered_user = get_option('smsbump_registered_user'); ?>
				<?php $success_registration_user = get_option('smsbump_success_registration_user'); ?>
				<tr>
					<th scope="row"><label for="smsbump_enabled">Status</label></th>
					<td>
						<select name="smsbump_enabled">
		                      <option value="yes" <?php if($enabled == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(!($enabled) || $enabled == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_apikey">API Key</label>
						<span class="help">You can find the API key in your account in SMSBump.com</span>
					</th>
					<td><input name="smsbump_apikey" value="<?php echo get_option('smsbump_apikey'); ?>" type="text" class="regular-text" /></td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_PhoneNumberPrefix">Add phone number prefix</label>
						<span class="help">This setting will add prefix to all phone numbers when the module sends a message. It will also remove the zeros (if any) in the beginning in the numbers.</span>
					</th>
					<td><select name="smsbump_PhoneNumberPrefix" class="form-control">
		                      <option value="yes" <?php if($phoneNumberPrefix && $phoneNumberPrefix == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(!($phoneNumberPrefix) || $phoneNumberPrefix == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
		            </td>
				</tr>
				<tr class="NumberPrefix" style="display:none;">
					<th scope="row">
						<label for="smsbump_NumberPrefix">Prefix</label>
					</th>
					<td>
						<input name="smsbump_NumberPrefix" type="text" class="regular-text" value="<?php echo get_option('smsbump_NumberPrefix'); ?>"/>
		            </td>
				</tr>
				<tr class="PhoneRemoveZeros" style="display:none;">
					<th scope="row">
						<label for="smsbump_PhoneRemoveZeros">Remove the leading zeros from the beginning of the number:</label>
					</th>
					<td>
						<select name="smsbump_PhoneRemoveZeros" class="form-control">
		                      <option value="yes" <?php if(get_option('smsbump_PhoneRemoveZeros') == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(get_option('smsbump_PhoneRemoveZeros') == false || get_option('smsbump_PhoneRemoveZeros') == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
		            </td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_StrictPrefix">Send messages only to numbers starting with a prefix:</label>
					</th>
					<td><select name="smsbump_StrictPrefix">
		                      <option value="yes" <?php if(get_option('smsbump_StrictPrefix') == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(get_option('smsbump_StrictPrefix') == false || get_option('smsbump_StrictPrefix') == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
		            </td>
				</tr>
				<tr class="StrictNumberPrefix" style="display:none;">
					<th scope="row">
						<labe for="smsbump_StrictNumberPrefix">Starting prefix</label>
					</th>
					<td>
						<input name="smsbump_StrictNumberPrefix" type="text" class="regular-text" value="<?php echo get_option('smsbump_StrictNumberPrefix'); ?>"/>
		            </td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_StoreOwnerPhoneNumber">Store owner phone number:</label>
						<span class="help">This phone number can be used for notifications.</span>
					</th>
					<td>
						<input name="smsbump_StoreOwnerPhoneNumber" type="text" class="regular-text" value="<?php echo get_option('smsbump_StoreOwnerPhoneNumber'); ?>"/>
		            </td>
				</tr>
				<tr>
					<th scope="row">
						<label for="smsbump_From">From:</label>
						<span class="help">This field will be taken into account only if you are subscribed for the premium plan.<br />> Latin characters are supported only..</span>
					</td>
					<td>
						<input name="smsbump_From" type="text" class="regular-text" value="<?php echo get_option('smsbump_From'); ?>"/>
		            </th>
				</tr>
				<tr>
					<th scope="row"><label for="smsbump_published_comment">Receive SMS on published comment</label></th>
					<td>
						<select name="smsbump_published_comment">
		                      <option value="yes" <?php if(get_option('smsbump_published_comment') == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(get_option('smsbump_published_comment')  == 'false' || get_option('smsbump_published_comment')  == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr class="published_comment_text" style="display:none;">
					<th scope="row">
							<span class="help">Shortcodes:<br />{author} - Author name<br />{post_title} - Post title</span>
					</th>
					<td>
						<textarea name="smsbump_published_comment_text" cols="50" class="form-control" rows="4" class="regular-text"><?php if(get_option('smsbump_published_comment_text')) echo get_option('smsbump_published_comment_text'); else echo "Hello! The user {author} posted a new comment in {post_title}!"; ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="smsbump_registered_user">Receive SMS on registered user</label></th>
					<td>
						<select name="smsbump_registered_user">
		                      <option value="yes" <?php if(get_option('smsbump_registered_user') == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(get_option('smsbump_registered_user')  == 'false' || get_option('smsbump_registered_user')  == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr class="registered_user_text" style="display:none;">
					<th scope="row">
							<span class="help">Shortcodes:<br />{user_name} - User name</span>
					</th>
					<td>
						<textarea name="smsbump_registered_user_text" cols="50" class="form-control" rows="4" class="regular-text"><?php if(get_option('registered_user_text')) echo get_option('registered_user_text'); else echo "Hello! The user {user_name} registered at your site!"; ?></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="smsbump_success_registration_user">Send SMS to users on successful sign up</label></th>
					<td>
						<select name="smsbump_success_registration_user">
		                      <option value="yes" <?php if(get_option('smsbump_success_registration_user') == 'yes') echo 'selected=selected'; ?>>Enabled</option>
		                      <option value="no"  <?php if(!(get_option('smsbump_success_registration_user')) || get_option('smsbump_success_registration_user')  == 'no') echo 'selected=selected'; ?>>Disabled</option>
		                </select>
					</td>
				</tr>
				<tr class="success_registration_user_text" style="display:none;">
					<th scope="row">
							<span class="help">Shortcodes:<br />{user_name} - User name</span>
					</th>
					<td>
						<textarea name="smsbump_success_registration_user_text" cols="50" class="form-control" rows="4" class="regular-text"><?php if(get_option('smsbump_success_registration_user_text')) echo get_option('smsbump_success_registration_user_text'); else echo "Hello, {user_name}! Thank you for registering. Enjoy our site!"; ?></textarea>
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
		var phoneNumberPrefix = '<?php echo $phoneNumberPrefix ?>';
		if(phoneNumberPrefix == "yes") {
			$('.NumberPrefix').show();
			$('.PhoneRemoveZeros').show();
		} else {
			$('.NumberPrefix').hide();
			$('.PhoneRemoveZeros').hide();
		}

		$('select[name="smsbump_PhoneNumberPrefix"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.PhoneRemoveZeros').show();
				$('.NumberPrefix').show();
			} else {
				$('.NumberPrefix').hide();
				$('.PhoneRemoveZeros').hide();
			}
		});

		var strictPrefix = '<?php echo $strictPrefix ?>';
		if(strictPrefix == "yes") {
			$('.StrictNumberPrefix').show();
		} else {
			$('.StrictNumberPrefix').hide();
		}

		$('select[name="smsbump_StrictPrefix"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.StrictNumberPrefix').show();
			} else {
				$('.StrictNumberPrefix').hide();
			}
		});

		var smsbump_published_comment = '<?php echo $published_comment; ?>';
		
		if(smsbump_published_comment == "yes") {
			$('.published_comment_text').show();
		} else {
			$('.published_comment_text').hide();
		}

		$('select[name="smsbump_published_comment"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.published_comment_text').show();
			} else {
				$('.published_comment_text').hide();
			}
		});

		var smsbump_registered_user = '<?php echo $registered_user; ?>';
		
		if(smsbump_registered_user == "yes") {
			$('.registered_user_text').show();
		} else {
			$('.registered_user_text').hide();
		}

		$('select[name="smsbump_registered_user"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.registered_user_text').show();
			} else {
				$('.registered_user_text').hide();
			}
		});

		var smsbump_success_registration_user = '<?php echo $success_registration_user; ?>';
		
		if(smsbump_success_registration_user == "yes") {
			$('.success_registration_user_text').show();
		} else {
			$('.success_registration_user_text').hide();
		}

		$('select[name="smsbump_success_registration_user"]').on('change', function() {
			if($(this).val()=="yes") {
				$('.success_registration_user_text').show();
			} else {
				$('.success_registration_user_text').hide();
			}
		});

	});
	
</script>