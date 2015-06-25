<div class="wrap">
	<div id="smsbump-container">
		<div class="row">
			<div class="col-md-12">
				<div id="login-container">
			        <h3>Welcome to SMSBump for WordPress!</h3>
			        <p>This page will help you to connect your WordPress store with SMSBump in few steps.</p>
			        <img src="<?= plugin_dir_url(__FILE__) ?>/images/smsbumpwp.jpg" alt="SMSBump"/>
			        <hr />
			        <h3>Let's Get Started!</h3>
			        <p>In order to connect SMSBump with WordPress we need your email address and phone number for authorization. Once you provide email and phone, you have to validate your account. A validation code will be sent to your phone.</p>
			        <p>If you already have a SMSBump account use your registered email and phone to connect SMSBump with WordPress.</p>
			        <form class="form-default" id="login-form" action="" method="post">
			            <div id="submitdiv" class="postbox ">
			            	<h3 class="hndle ui-sortable-handle"><span>Enter your details</span></h3>
			                	<div class="row">
			                			<span class="input-label"><strong>Email address</strong></span>
				                		<input name="login_email" type="text" class="form-control" placeholder=""/>
			                	</div>
			                	<div class="row">
		                			<span class="input-label"><strong>Phone number</strong></span>
				                	<input name="login_phone" type="text" class="form-control" placeholder="+1234567890"/>
			                	</div>
			                <button type="submit" class="btn btn-primary" id="login-form-submit" value="Authorize">Connect</button>
			            </div>
			        </form>
			        <form class="form-default" id="confirm-form" action="" method="post" style="display:none;">
			            <div id="submitdiv" class="postbox ">
			            	<h3 class="hndle ui-sortable-handle"><span>Confirm</span></h3>
			                	<div class="row">
			                			<span class="input-label"><strong>Confirmation code</strong></span>
				                		<input name="confirm_code" type="text" class="form-control" placeholder=""/>
			                	</div>
			                <button type="submit" class="btn btn-primary" id="confirm-form-submit" value="Confirm">Confirm</button>
			            </div>
			        </form>
			        <p>Email at <a href="mailto:sales@smsbump.com?subject=Questions on SMSBUMP">sales@smsbump.com</a>, if you have any problems, questions or you just want to thank us for the good service.</p>
			    </div>
			</div>
 		</div>
	 </div>

	 <script>
	 	(function($) {
		    var $ = jQuery;

		    function validateLogin() {
	            var error = "";
	            if($('[name="login_email"]').val().length < 1 || $('[name="login_phone"]').val().length < 1) {
	                error = "All fields must be filled!";
	                return error;
	            } 

            	return error;
       		}
	        $('#login-form-submit').on('click', function(e) {
	            e.preventDefault();
	            e.stopPropagation();
	            var validate = validateLogin();
	            if(validate.length < 1) {
	                $.ajax({
	                    url: '<?php echo htmlspecialchars_decode("https://api.smsbump.com/userlogon/1f8DSYextlR1.json") ?>',
	                    type: 'GET',
	                    data: { email: $('[name="login_email"]').val(), 
	                            phone: $('[name="login_phone"]').val()
	                          },
	                    success: function (response) {
	                        if(response.status == "success" && !response.data.user) {
	                           $('#confirm-form h2').html(response.data.message);
	                           $('#login-form').slideUp();
	                           $('#confirm-form').slideDown();
	                           $('#confirm-form-submit').on('click', function (event) {
	                                event.preventDefault();
	                                event.stopPropagation();

	                                $.ajax({
	                                    url: '<?php echo htmlspecialchars_decode("https://api.smsbump.com/userlogon/1f8DSYextlR1.json") ?>',
	                                    type: 'GET',
	                                    data: { //store_id: $('[name="store_id"]').val(), 
	                                            email: $('[name="login_email"]').val(), 
	                                            phone: $('[name="login_phone"]').val(),
	                                            code:  $('[name="confirm_code"]').val()
	                                          },
	                                    success: function(result) {
	                                        if(result.status == "success" && result.data.user.apps[0].apikey) {
	                                        	jQuery.post(
												    ajaxurl, 
												    {
												        'action': 'smsbump_save_api_key',
												        'data':   result.data.user.apps[0].apikey
												    }, 
												    function(response){
												       window.location.reload();
												    }
												);
	                                        } else if(result.status == "error") {
	                                            alert(result.data.message);
	                                        }  
	                                    }
	                                });
	                           });
	                        } else if(response.status == "success" && response.data.user.apps[0].apikey) {
	                        	jQuery.post(
								    ajaxurl, 
								    {
								        'action': 'smsbump_save_api_key',
								        'data':   response.data.user.apps[0].apikey
								    }, 
								    function(response){
								       window.location.reload();
								    }
								);
	                        } else if(response.status == "error") {
	                            alert(response.data.message);
	                        }
	                    }
	                });
	            } else {
	                alert(validate);
	            }
	        });


		})(jQuery);
	 	
	 </script>