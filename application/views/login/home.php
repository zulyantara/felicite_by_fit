<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("asset/css/login.css");?>">
        <script src="<?php echo base_url("asset/js/modernizr.custom.63321.js"); ?>"></script>
        
        <!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
        
        <script src="<?php echo base_url("asset/js/jquery-2.1.1.min.js"); ?>"></script>
        <script type="text/javascript" src="js/jquery.placeholder.min.js"></script>
        <script type="text/javascript">
        $(function(){
            $('input, textarea').placeholder();
        });
        </script>
    </head>
    <body>
        <div class="container">
            <header>
                <h1><strong>Felicite by Fit</strong></h1>
                <div class="support-note">
                    <span class="note-ie">Sorry, only modern browsers.</span>
                </div>
            </header>
            
            <section class="main">
                <?php
                echo (isset($error)) ? $error : "";
                ?>
                <form method="post" action="<?php echo base_url("auth/validate_credential"); ?>" class="form-2">
                    <h1><span class="log-in">Log in</span></h1>
					<p class="float">
						<label for="login"><i class="icon-user"></i>Username</label>
						<input type="text" name="txt_user_name" id="txt_user_name" placeholder="Username" autofocus="autofocus" required="required">
					</p>
					<p class="float">
						<label for="password"><i class="icon-lock"></i>Password</label>
						<input type="password" name="txt_user_password" id="txt_user_password" placeholder="Password" class="showpassword" required="required">
					</p>
					<p class="clearfix"> 
						<a href="<?php echo base_url("presensi"); ?>" class="log-twitter">Presensi</a>    
						<input type="submit" name="btn_login" id="btn_login" value="Login">
					</p>
                </form>
            </section>
        </div>
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Password' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Show password")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script>
    </body>
</html>