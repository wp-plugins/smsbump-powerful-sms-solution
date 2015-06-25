	<div id="myModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title">Sending messages</h4>
	      </div>
	      <div class="modal-body">
	      	<div id="modal-message"><h4>Do not close this window until the script finishes. Otherwise the messages will not be sent to all customers.</h4></div><br />
	        <div id="progressbar-parent" class="progress progress-striped active">
	  			<div class="progress-bar" id="progressbar" role="progressbar" style="width:0%"></div>
			</div>
	        <div id="modal-message-sent"><h5>Last sent to: <span id="modal-telephone"> </span></h5></div>
	        <div id="modal-message-senttotal"><h5>Sent messages: <span id="modal-telephone-total">0</span></h5></div>
	        <div id="modal-message-errors"><h5>Errors: <span id="modal-telephone-errors">0</span></h5></div>
	        <div id="modal-message-errorsAll" style="max-height: 150px;overflow: scroll;overflow-x: hidden; overflow-y: hidden; overflow: auto;"></div>
	      </div>
		 <div class="modal-footer">
	        <button type="button" class="btn btn-default" id="myModalClose" data-dismiss="modal">Close</button>
		 </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label>Account Balance:</label></td>
					<td>
						<!--span id="balance">Insufficient funds on balance. Please recharge.</span-->
						<div class="btn-group">
			              <button type="button" class="btn btn-success text"><span id="balance">0.00 USD</span></button>
			              <button type="button" class="btn btn-success balance-plus dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="addFundsDropdown">
			                    <span class="fa fa-plus" aria-hidden="true"><strong>+</strong></span>
			              </button>
			              <ul class="dropdown-menu" role="menu" aria-labelledby="addFundsDropdown">
			                <li role="amount"><a role="menuitem" tabindex="-1" onClick="addFunds('20.00');">$ 20.00</a></li>
			                <li role="amount"><a role="menuitem" tabindex="-1" onClick="addFunds('50.00');">$ 50.00</a></li>
			                <li role="amount"><a role="menuitem" tabindex="-1" onClick="addFunds('100.00');">$ 100.00</a></li>
			                <li role="amount"><a role="menuitem" tabindex="-1" onClick="addFunds('200.00');">$ 200.00</a></li>
			                <li role="amount"><a role="menuitem" tabindex="-1" onClick="addFunds('500.00');">$ 500.00</a></li>
			                <li role="amount"><a role="menuitem" tabindex="-1" onClick="addFunds('1000.00');">$ 1000.00</a></li>
			              </ul>
			            </div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="type">Type:</strong></h3>
		  				<span class="help">SMS - Simple text message<br />MMS - Text message with multimedia<br />USSD - Send message like USSD code<br />Voice - Using text-to-speech software</span>
					</th>
					<td>
			          <select name="type" id="type" class="form-control">
			            <option value="sms">SMS</option>
			            <option value="mms">MMS</option>
			            <option value="ussd">USSD</option>
			            <option value="vms">Voice message</option>
			          </select>
					</td>
				</tr>
				<tr class="media_upload" style="display:none;">
					<th scope="row">
						<label for="media_file">Media file:</label>
		  				<span class="help">From here you can upload a picture to your message.</span>
					</th>
					<td>
			          <div id="wpss_upload_image_thumb" class="wpss-file">
						<?php if(isset($record->security_image) && $record->security_image !='') { ?>
		            	<img src="<?php echo $record->security_image;?>"  width="65"/><?php } else { echo ''; } ?>
		            </div>
					<input id="wpss_upload_image" type="text" size="36" name="wpss_upload_image" value="" class="wpss_text wpss-file" />
					<input id="wpss_upload_image_button" type="button" value="Upload Image" class="button action" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="message_to">To:</label>
		  				<span class="help">Choose the customers that you would like to receive your message.</span>
					</th>
					<td>
			          <select name="message_to" class="form-control">
			            <option value="customer_all">All users</option>
			            <option value="customer">Specific users</option>
			            <option value="phones">Specific phone numbers</option>
			          </select>
					</td>
				</tr>
				<tr id="adding_numbers" style="display:none;">
					<th scope="row">
						<label for="number">Phone number:</label>
					</td>
					<td>
			          <input name="number" type="text" class="regular-text" value="" placeholder="+19876543210"/> 
			          <button class="button-primary" style="width:50px;" id="addNumber"/><?php _e('Add', 'smsbump'); ?></button>
					</td>
				</tr>
				<tr id="added_numbers" style="display:none;">
					<th scope="row">
						
					</th>
					<td>
			          <div class="numbers_scrollbar">
			          	<ul>
			          	</ul>
			          </div>
					</td>
				</tr>
				<tr id="adding_users" style="display:none;">
					<th scope="row">
						<label for="users">Search:</label>
					</th>
					<td>
			          <input name="users" type="text" class="regular-text" value="" /> 
					</td>
				</tr>
				<tr id="added_users" style="display:none;">
					<th scope="row">
						
					</th>
					<td>
			          <div class="numbers_scrollbar">
			          	<ul>
			          	</ul>
			          </div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="from">From:</label>
		  				<span class="help">This field will be taken into account only if you are subscribed for the premium plan.<br /><br />- Latin characters are supported only.</span>
					</th>
					<td>
			          <input type="text" name="from" value="" class="regular-text" />
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="message">Message:</label>
		  				<span class="help">Usually one text is 160 characters. If your message contains more than 160 characters, your message will be divided in more than one SMSs. For example, if your message contains 1600 characters, a given customer will receive 10 SMSs (10*160).<br /><br />- Non-latin characters <strong>are</strong> supported.</span>
					</td>
					<td>
			          <textarea name="message" cols="50" id="count_me" class="form-control" rows="4" class="regular-text"></textarea>

					</td>
				</tr>

				<tr>
						<td>
							<p class="submit">
								<input type="submit" class="button-primary" id="sendMessage" value="<?php _e('Send', 'smsbump'); ?>" />
							</p>
						</td>
				</tr>
			</tbody>
		</table>
</div> <!-- CLOSING THE MAIN WRAPPER -->

<?php $apikey = get_option("smsbump_apikey"); ?>



<script>
 	jQuery(function ($) {
 		
	    $.ajax({
		  url: 'https://smsbump.com/api/index/balance/<?php echo $apikey; ?>.json',
		  type: "GET",
		  async: true,
		  success: function(result) {   
		  	if (result.data)
		      $('#balance').html(parseFloat(result.data.balance).toFixed(2) + ' <span style="text-transform:uppercase;">' + result.data.currency + '</span>');
		  }
		});

		$('select[name="message_to"]').on('change', function() {
			if($(this).val()=="phones") {
				$('#adding_numbers').show();
				$('#added_numbers').show();
				$('#adding_users').hide();
				$('#added_users').hide();
			} else if($(this).val()=="customer") {
				$('#adding_users').show();
				$('#added_users').show();
				$('#adding_numbers').hide();
				$('#added_numbers').hide();
			} else {
				$('#adding_users').hide();
				$('#added_users').hide();
				$('#adding_numbers').hide();
				$('#added_numbers').hide();
			}
		});

		$('select[name="type"]').on('change', function() {
			if($(this).val()=="mms") {
				$('.media_upload').show();
			} else {
				$('.media_upload').hide();
			}
		});

		$('#addNumber').on('click', function() {
			if($(this).prev('input').val()) {
		    	$(this).parents('#adding_numbers').next('#added_numbers').find('.numbers_scrollbar').find('ul').append('<li><span class="customer"><span class="phone_entry">'+$(this).prev('input').val()+'</span><i class="dashicons dashicons-no-alt"></i></span</li>');

		    	$('.customer').delegate('.dashicons-no-alt', 'click', function() {
				  	$(this).parent().remove();
				});
	    	}
	    	$(this).prev('input').val("");
		});

		var validate = function () {
			if(!($('textarea[name="message"]').val())) {
				return false;
			}
			return true;
		};

	    $('#sendMessage').on('click', function() {
	    	if(validate()) {
		    	var phones = [];
		    	var newPhones = [];
		    	switch($('select[name="message_to"]').val()) {
		    		case "customer_all": 
		    			phones = getAllUsersPhones(); 
		    			for(i = 0; i<phones.length; i++) {
		    				if(sendCheck(phones[i]) == true) {
		    					newPhones.push(formatNumber(phones[i]));
		    				}	    					
		    			}
		    			break;
		    		case "customer": 
		    			$('.numbers_scrollbar').find('.customer').each(function() { 
		    				phones.push($(this).attr('data-phone'));
		    			});

		    			for(i = 0; i<phones.length; i++) {
		    				if(sendCheck(phones[i]) == true) {
		    					newPhones.push(formatNumber(phones[i]));
		    				}	    					
		    			}
		    			break;
		    		case "phones": 
		    			$('.numbers_scrollbar').find('.phone_entry').each(function() { 
		    				phones.push($(this).html());
		    			});
		    			for(i = 0; i<phones.length; i++) {
		    				if(sendCheck(phones[i]) == true) {
		    					newPhones.push(formatNumber(phones[i]));
		    				}	    					
		    			}
		    			break;
		    		default: break;
		    	}
		    	$('#myModalClose').attr('disabled', true);
				$('#myModal').modal('show');
				var total = 0;
				var errors = 0;
		    	$.smsbump({
					apikey: '<?php echo (get_option('smsbump_apikey')!=false) ? get_option('smsbump_apikey') : 'test'; ?>',
					to: newPhones,
					type: $("#type option:selected").val(),
					from: $('input[name="from"]').val(),
					media: $('#wpss_upload_image').val(),
					message: $('textarea[name="message"]').val(),
					success: function(resp) {
						total++;
						$('#progressbar').css('width', (total/newPhones.length)*100 + '%');
						$('#progressbar').html((total/newPhones.length)*100 + '%');
						$('#modal-telephone').html(resp['data']['to']);
						$('#modal-telephone-total').html(total);
						if (total==newPhones.length) {
							$('#progressbar-parent').removeClass('active');
							$('#myModalClose').attr('disabled', false);
							$('#modal-message').html('<h4>Great! The messages were sent successfully. You can now close the popup.</h4>');
						}
					},
					error: function(resp) {
						total++;
						errors++;
						$('#progressbar').css('width', (total/newPhones.length)*100 + '%');
						$('#progressbar').html((total/newPhones.length)*100 + '%');
						$('#progressbar').val(total);
						$('#modal-telephone-errors').html(errors);
						$('#modal-message-errorsAll').append(resp['to'] + ": " + resp['message'] + "<br />");
						if (total==newPhones.length) {
							$('#progressbar-parent').removeClass('active');
							$('#myModalClose').attr('disabled', false);
							$('#modal-message').html('<h4>The operation completed successfully. However, some of the messages were not sent.</h4>');
						}
						
					}
				});
			} else {
				alert("Please enter message!");
			}
		});

		$("#count_me").characterCounter({
			counterFormat: '%1 written characters.',
			counterWrapper: 'div',
		    counterCssClass: 'message_counter'
		});
		
	});

function formatNumber(number) {
	<?php if( (get_option('smsbump_enabled') == 'yes') && (get_option('smsbump_NumberPrefix')) && (get_option('smsbump_PhoneNumberPrefix')=='yes')) { ?>
		var numberCheck = number.replace(/^\++/, '');
		var prefixCheck = '<?php get_option('smsbump_NumberPrefix'); ?>'.replace(/^\++/, '');
		var newNumber = '';
		<?php if (get_option('smsbump_PhoneRemoveZeros')=='yes') { ?>
			var numberCheck = numberCheck.replace(/^0+/, '');
		<?php } ?>
		var newNumber = numberCheck;
		if (numberCheck.indexOf(prefixCheck) !== 0) {
			var newNumber = '<?php get_option('smsbump_NumberPrefix'); ?>' + numberCheck;
		}
		return newNumber;	
	<?php } else { ?>
		return number;	
	<?php } ?>
}
	
function sendCheck(phone) {
	<?php $StrictNumberPrefix = get_option('smsbump_StrictNumberPrefix'); ?>
	<?php if( get_option('smsbump_StrictPrefix')=='yes') { ?>
		var numberCheck = formatNumber(phone).replace(/^\++/, '');
		var prefixCheck = '<?php get_option('smsbump_StrictNumberPrefix'); ?>'.replace(/^\++/, '');
		
		if (0 === numberCheck.indexOf(prefixCheck)) {
		   return true;
		} else {
		   return false;
		}
	<?php } ?>
	return true;
}

function getAllUsersPhones() {
	var phones = [];
	<?php 
	$users = get_users();
	foreach ($users as $user ) { 
		$phone = get_user_meta($user->ID, "phone", true);
	?>
		phones.push('<?php echo $phone; ?>');
	<?php } ?>
	return phones;
}

function addFunds(amount) {
	var apikey = '<?php echo get_option('smsbump_apikey') ?>';
	
	jQuery(function ($) {
	    var parentUrl = (window.location != window.parent.location)
	                ? document.referrer
	                : document.location;
	     
	    $.ajax({
	        url: 'https://api.smsbump.com/recharge/'+apikey+'.json',
	        type: "GET",
	        data: {
	                amount: amount,
	                returnurl: parentUrl.href
	        },
	        success: function(json) {
	            if(json.status=='success') {
	                window.open(json.data.payment_link,"_top","",true);
	            } else {
	                alert("You need to register your API key in the administration before adding balance!");
	            }                   
	        }
	    });
	});
}

</script>
