<?
	require("db.php");

	function drawNewAppletButton(){
		?>
                <div id="landingDivContainer">
       		  <div id="landingDiv">
                    <div class="newAppletButton" id="newAppletButton">
                      <img src="" class="NewAppletButtonGraphic">
                      Create New Demo 
                    </div>
                  </div>
		</div>
                <script>
                  document.getElementsByClassName('NewAppletButtonGraphic')[0].src = '/plus.png'
                </script>
		<?		
	}
	
	function drawLoggedInMenu($name,$id,$email){
		$avatar="/avatars/$id.jpg?".rand();
		?>
                <div id="config-container">
                  <div id="preferencesScreen">
                          <div class="inputDiv">
                                  <table class="inputTable" style="width:82%">
                                          <tr><td></td><td><div id="emailAvailability"></div></td></tr>
                                          <tr>
                                                  <td class="inputLabel">Email</td>
                                                  <td class="inputCell"><input  onkeyup="validatePrefEmail('<?=$email?>')" onpaste="setTimeout(validatePrefEmail('<?=$email?>'),0)" type="email" id="email" value='<?=$email?>'></td>
                                          </tr>
                                  </table>
                                  <hr>
                                  <div id="image-cropper">
                                          <div class="cropit-preview" style="margin-left: auto; margin-right: auto;margin-top: 25px; margin-bottom: 15px;"></div>
                                          <input type="range" class="cropit-image-zoom-input" />
                                          <input type="file" class="cropit-image-input" />
                                  </div>
                                  <script>
                                          $('#image-cropper').cropit({
                                                  maxZoom:2,
                                                  imageState: {src: '<?=$avatar?>'}
                                          });
                                          document.querySelectorAll('.cropit-preview-image-container')[0].style.borderRadius = '50%'
                                  </script>
                                  <hr>
                                  <table class="submitTable">
                                          <tr>
                                                  <td><button onclick="SavePreferences()">Save</button></td>
                                                  <td><button onclick="CancelPreferences()">Cancel</button></td>
                                          </tr>
                                  </table>
                          </div>
                  </div>

                  <div id="changePasswordScreen">
                          <div class="inputDiv">
                                  <table class="inputTable">
                                          <tr><td></td><td><div id="passwordConsistency"></div></td></tr>
                                          <tr>
                                                  <td class="inputLabel">New Password</td>
                                                  <td class="inputCell"><input onkeyup="validatePasswords()" onpaste="setTimeout(validatePasswords,0)" type="password" id="password"></td>
                                          </tr>
                                          <tr>
                                                  <td class="inputLabel">Confirm Password</td>
                                                  <td class="inputCell"><input onkeyup="validatePasswords()" onpaste="setTimeout(validatePasswords,0)" type="password" id="confirmpassword"></td>
                                          </tr>
                                  </table>
                                  <table class="submitTable">
                                          <tr>
                                                  <td><button onclick="SubmitNewPassword()">Save</button></td>
                                                  <td><button onclick="CancelNewPassword()">Close</button></td>
                                          </tr>
                                  </table>
                          </div>
                  </div>
                </div>
                <script>bindLoggedInEnterKey()</script>
                <div id="loggedInRightMenu">
                  <div class="dropdown">
                    <img src='<?=$avatar?>' class="menuAvatar"><br>
                    <span onclick="location.href='<?=$name?>'" class="userMenu"><?=$name?></span>
                    <div class="dropdown-content">
                      <p onclick="Preferences()" class="dropdownItem">Preferences</p>
                      <p onclick="ChangePassword()" class="dropdownItem">Change Password</p>
                      <p onclick="LogOut()" class="dropdownItem">Log Out</p>
                    </div>
                  </div>
                </div>
                <script>
                  oldParent = document.getElementById('config-container');
                  while (oldParent.childNodes.length > 0) {
                      document.body.appendChild(oldParent.childNodes[0]);
                  }
                  oldParent = document.getElementById('landingDivContainer');
                  while (oldParent.childNodes.length > 0) {
                      document.body.appendChild(oldParent.childNodes[0]);
                  }
                </script>
		<?
	}

	
	function drawConfirmScreen($k,$email){
		require("logout.php");
		?>
                <div id="emailConfContainer">
		<div id="emailConfirmScreen">
			<div class="inputDiv">
				<script>
                                  confirmEmail("<?=$k?>","<?=$email?>")
                                </script>
				<div id="confirmResult"></div>
			</div>
		</div>
                </div>
		<script>
                  $("#emailConfirmScreen").show()
                  oldParent = document.getElementById('emailConfContainer');
                  while (oldParent.childNodes.length > 0) {
                      document.body.appendChild(oldParent.childNodes[0]);
                  }
                </script>
		<?
	}
		

	function drawLoggedOutMenu(){

		?>
                <div id="config-container">
                  <div id="loginScreen">
                          <div class="inputDiv">
                                  <table class="inputTable">
                                          <tr><td></td><td><div id="loginResult">Login Failed!</div></td></tr>
                                          <tr>
                                                  <td class="inputLabel">User Name or Email</td>
                                                  <td class="inputCell"><input type="text" id="loginusername"></td>
                                          </tr>
                                          <tr>
                                                  <td class="inputLabel">Password</td>
                                                  <td class="inputCell"><input type="password" id="loginpassword"></td>
                                          </tr>
                                  </table>
                                  <table class="submitTable">
                                          <tr>
                                                  <td><button onclick="SubmitLogin()">Login</button></td>
                                                  <td><button onclick="CancelLogin()">Cancel</button></td>
                                          </tr>
                                  </table>
                          </div>
                  </div>
                  <div id="registerScreen">
                          <div class="inputDiv">
                                  <table class="inputTable">
                                          <tr><td></td><td><div id="usernameAvailability"></div></td></tr>
                                          <tr>
                                                  <td class="inputLabel">User Name</td>
                                                  <td class="inputCell"><input onkeyup="validateUsername()" onpaste="setTimeout(validateUsername,0)" type="text" id="username" maxlength="20"></td>
                                          </tr>
                                          <tr><td></td><td><div id="emailAvailability"></div></td></tr>
                                          <tr>
                                                  <td class="inputLabel">Email</td>
                                                  <td class="inputCell"><input  onkeyup="validateEmail()" onpaste="setTimeout(validateEmail,0)" type="email" id="email"></td>
                                          </tr>
                                          <tr><td></td><td><div id="passwordConsistency"></div></td></tr>
                                          <tr>
                                                  <td class="inputLabel">Password</td>
                                                  <td class="inputCell"><input onkeyup="validatePasswords()" onpaste="setTimeout(validatePasswords,0)" type="password" id="password"></td>
                                          </tr>
                                          <tr>
                                                  <td class="inputLabel">Confirm Password</td>
                                                  <td class="inputCell"><input onkeyup="validatePasswords()" onpaste="setTimeout(validatePasswords,0)" type="password" id="confirmpassword"></td>
                                          </tr>
                                  </table>
                                  <table class="submitTable">
                                          <tr>
                                                  <td><button onclick="SubmitRegistration()">Submit</button></td>
                                                  <td><button onclick="CancelRegistration()">Cancel</button></td>
                                          </tr>
                                  </table>
                          </div>
                  </div>
                </div>
		<script>bindEnterKey()</script>
                <script>
                  oldParent = document.getElementById('config-container');
                  while (oldParent.childNodes.length > 0) {
                      document.body.appendChild(oldParent.childNodes[0]);
                  }
                  oldParent = document.getElementById('landingDivContainer');
                  while (oldParent.childNodes.length > 0) {
                      document.body.appendChild(oldParent.childNodes[0]);
                  }
                </script>
		<?
		if($_GET['login']){
			?>
			<script>Login()</script>
			<?
		}
	}

	
	function drawEmailVerification($email){
		?>
                <div id="emailver-container">
  		<div id="emailVerificationScreen">
			<div class="inputDiv">
				<center>
					You must click the link that was sent to<br><span class="highlighted"><?=$email?></span><br><br>
					Check your spam/junk folder if you cannot find it.<br><br>
					<table class="submitTable">
						<tr>
							<td class="inputLabel"><button onclick="resendVerificationEmail()">Resend Email</button></td>
							<td class="inputCell"><button onclick="LogOut();location.reload()">Close</button></td>
						</tr>
					</table>
					<div id="emailVerificationSendStatus"></div>
				</center>
			</div>
		</div>
                </div>
		<script>
                  $("#emailVerificationScreen").show();
                  oldParent = document.getElementById('emailver-container');
                  while (oldParent.childNodes.length > 0) {
                      document.body.appendChild(oldParent.childNodes[0]);
                  }
                </script>
		<?
	}
	
	function drawNewPasswordRequiredScreen(){
		global $baseDomain;
		?>
		<div id="forcePasswordScreen">
			<div class="inputDiv" style="text-align:justify;padding-left:20px;padding-right:20px;">
			<?=$baseDomain?> has recently implemented a stronger login system. As a result you must re-enter your password to continue using this site. Please enter and confirm your password. If you wish to change your password, you may do so now.<br><br>Questions can be emailed to the admin @ <br><a href="mailto:s.r.mcgann@hotmail.com">s.r.mcgann@hotmail.com</a><br><br><br>
				<table class="inputTable">
					<tr><td></td><td><div id="forcePasswordConsistency"></div></td></tr>
					<tr>
						<td class="inputLabel">New Password</td>
						<td class="inputCell"><input onkeyup="forceValidatePasswords()" onpaste="setTimeout(forceValidatePasswords,0)" type="password" id="newPassword"></td>
					</tr>
					<tr>
						<td class="inputLabel">Confirm Password</td>
						<td class="inputCell"><input onkeyup="forceValidatePasswords()" onpaste="setTimeout(forceValidatePasswords,0)" type="password" id="newConfirmpassword"></td>
					</tr>
				</table>
				<table class="submitTable">
					<tr>
						<td><button onclick="SubmitForceNewPassword()">Save</button></td>
					</tr>
				</table>
			</div>
		</div>
		<script>
			$("#forcePasswordScreen").show();
			setTimeout(function(){
				$("#newPassword").focus()
				document.getElementById('newPassword').onkeypress = function(e){
					if (!e) e = window.event;
					var keyCode = e.keyCode || e.which;
					if (keyCode == '13'){
						SubmitForceNewPassword();
					}
				}
				document.getElementById('newConfirmpassword').onkeypress = function(e){
					if (!e) e = window.event;
					var keyCode = e.keyCode || e.which;
					if (keyCode == '13'){
						SubmitForceNewPassword();
					}
				}
			},0);
		</script>
		<?
	}
	
	function drawMenu(){
		global $link, $baseDomain;
		?>
		<div class="navMenu"></div>
		<?
		if(isset($_GET['k']) && $_GET['k'] !== '' && isset($_GET['email'])){
			$k=str_replace("'","",str_replace(";","",str_replace('"','',str_replace("<","",str_replace("%22","",$_GET['k'])))));
			$email=str_replace("'","",str_replace(";","",str_replace('"','',str_replace("<","",str_replace("%22","",$_GET['email'])))));
			drawConfirmScreen($k,$email);
			drawLoggedOutMenu();
		}else{
			if($_COOKIE['id']){
				$id=$_COOKIE['id'];
				$pass=$_COOKIE['session'];
				$sql="SELECT * FROM users WHERE id=$id AND pass = \"$pass\"";
				$res=$link->query($sql);
				if(mysqli_num_rows($res)){
					$row=mysqli_fetch_assoc($res);
					$email=$row['email'];
					if($row['emailVerified']){
						$name=$row['name'];
						drawLoggedInMenu($name,$id,$email);
						$date=date("Y-m-d H:i:s",strtotime("now"));
						$IP=$_SERVER['REMOTE_ADDR'];
						$sql="UPDATE users SET lastseen = \"$date\", IP=\"$IP\" WHERE id=$id";
						$link->query($sql);
						//for new hashing transition
						$newHash=$row['newHash'];
						if($newHash=="") drawNewPasswordRequiredScreen();
						//
					}else{
						drawEmailVerification($email);
					}
				}else{
					require("logout.php");
					drawLoggedOutMenu();
				}
			}else{
				drawLoggedOutMenu();
			}
		}
		drawNavMenu();
		drawNewAppletButton();
	}
	
	function drawNavMenu(){
		$params=explode("/",$_GET['params']);
		$user=$params[0];
		$filter=$params[1]?$params[1]:"all";
		$valid=0;
		if($user=="140" || $user=="512" || $user=="1024"){
			$filter=$user;
			$user="";
			$valid=1;
		}elseif($user=='a'){
			require("db.php");
			$id=mysqli_real_escape_string($link,$filter);
			$sql="SELECT userID FROM applets WHERE id=$id";
			$res=$link->query($sql);
			$row=mysqli_fetch_assoc($res);
			$userID=$row['userID'];
			$sql="SELECT name FROM users WHERE id=$userID";
			$res=$link->query($sql);
			$row=mysqli_fetch_assoc($res);
			$user=$row['name'];
			$filter="";
			$valid=1;
		}
		$user=str_replace("'","",str_replace(";","",str_replace('"','',str_replace("<","",str_replace("%22","",$user)))));
		$filter=str_replace("'","",str_replace(";","",str_replace('"','',str_replace("<","",str_replace("%22","",$filter)))));
		if(!$valid){
			$user='';
			$filter='';
		}
		?>
		<script>
			<?

			if($user){
				?>
				$(".navMenu").html("( <?="$user"?> ) ");
				$(".navMenu").append('<a href="/<?=$user?>" class="navMenuButton<?=($filter=="all"?"Selected":"")?>">all</a>');
				$(".navMenu").append('<a href="/<?=$user?>/140" class="navMenuButton<?=($filter=="140"?"Selected":"")?>">140b</a>');
				$(".navMenu").append('<a href="/<?=$user?>/512" class="navMenuButton<?=($filter=="512"?"Selected":"")?>">512b</a>');
				$(".navMenu").append('<a href="/<?=$user?>/1024" class="navMenuButton<?=($filter=="1024"?"Selected":"")?>">1024b</a>');
				<?
			}else{
				?>
				$(".navMenu").append('<a href="/" class="navMenuButton<?=($filter=="all"?"Selected":"")?>">all</a>');
				$(".navMenu").append('<a href="/140" class="navMenuButton<?=($filter=="140"?"Selected":"")?>">140b</a>');
				$(".navMenu").append('<a href="/512" class="navMenuButton<?=($filter=="512"?"Selected":"")?>">512b</a>');
				$(".navMenu").append('<a href="/1024" class="navMenuButton<?=($filter=="1024"?"Selected":"")?>">1024b</a>');
				<?
			}
			?>
		</script>
		<?
	}
	
	function sendVerificationEmail($name,$email,$key){
		global $baseURL, $baseDomain;
		$to = '"'.$name.'" <'.$email.'>';
		$subject = "Welcome to CodeGolf.tk!";
		$txt = "
		Thank you for signing up on $baseDomain!\r\n
		Click the link below to confirm your email address.\r\n\r\n
		$baseURL/?k=$key&email=$email\r\n\r\n
		Thank you for joining $baseDomain!\r\n\r\n
		P.S. If you did not register, just igonore this email.
		";
		$headers = "From: no-reply@$baseDomain" . "\r\n";

		mail($to,$subject,$txt,$headers);
	}
	
	function ipToDec($ip){
		$parts=explode(".",$ip);
		return $parts[0]*pow(2,24)+$parts[1]*pow(2,16)+$parts[2]*pow(2,8)+$parts[3];
	}
	
	function syncUserRating($userID){
		$sql="SELECT * FROM votes where userID=$userID";
		$res=$link->query($sql);
		$rating=0;
		for($i=0;$i<mysqli_num_rows($res);++$i){
			$row=mysqli_fetch_assoc($res);
			$rating+=$row['vote']-1;
		}
		$rating/=mysqli_num_rows($res);
		$rating*=20;
		$sql="UPDATE users SET rating = \"$rating\" WHERE id=$userID";
		$res=$link->query($sql);
	}

	function drawComments($id){
		global $link;
		$sql="SELECT * FROM comments WHERE appletID=$id ORDER BY date ASC";
		$res=$link->query($sql);
		?>
		<div class="commentsDiv">
			<div id="commentsDivInner<?=$id?>" class="commentsDivInner">
			<?
			if(mysqli_num_rows($res)){
				for($i=0;$i<mysqli_num_rows($res);++$i){
					$row=mysqli_fetch_assoc($res);
					$userID=$row['userID'];
					$comment=$row['comment'];
					$sql="SELECT name FROM users WHERE id=$userID";
					$res2=$link->query($sql);
					$row=mysqli_fetch_assoc($res2);
					$name=$row["name"];
					?>
					<a class="commentUserName" href="/<?=$name?>"><?=$name?></a>:<span> <?=str_replace("<","&lt;",$comment)?></span><br>
					<?
				}
			}else{
				?>
				<span>No Comments...</span><br>
				<?
			}
			?>
			</div>
			<script>
				$("#commentsDivInner<?=$id?>").linkify();
			</script>
			<?
			$userID=$_COOKIE['id'];
			$sql="SELECT * FROM users WHERE id=$userID";
			$res=$link->query($sql);
			$row=mysqli_fetch_assoc($res);
			$userName=$row['name'];
			if(isset($_COOKIE['id'])){
				?>
				<div style="display:flex">
					<input type="text" id="commentInput<?=$id?>" style="flex-grow:100;margin:10px;text-align:left;padding-left:5px;" />
					<button style="width:250px;float:right;overflow:hidden;font-size:.9em;margin:10px;" onclick="postComment(<?=$id?>,'<?=$userName?>')">Post Comment</button>
				</div>
				<div class="clear"></div>				
				<script>
					document.getElementById('commentInput<?=$id?>').onkeypress = function(e){
						if (!e) e = window.event;
						var keyCode = e.keyCode || e.which;
						if (keyCode == '13'){
							postComment(<?=$id?>,'<?=$userName?>');
						}
					}
				</script>
				<?
			}
			?>
		</div>
		<?
	}

	function drawRateWidget($id,$userID){
		?>
		<div class='assetChoice'>
			<div id="<?=$id?>" class="rate_widget<?=$id?>">
				<div class="cloud_1 ratings_clouds clouds<?=$id?>"></div>
				<div class="cloud_2 ratings_clouds clouds<?=$id?>"></div>
				<div class="cloud_3 ratings_clouds clouds<?=$id?>"></div>
				<div class="cloud_4 ratings_clouds clouds<?=$id?>"></div>
				<div class="cloud_5 ratings_clouds clouds<?=$id?>"></div>
				<div class="cloud_6 ratings_clouds clouds<?=$id?>"></div>
			</div>
		</div>
		<script>
			$('.clouds<?=$id?>').hover(
				function() {
					$(this).prevAll().andSelf().addClass('ratings_over');
					$(this).nextAll().removeClass('ratings_vote'); 
				},
				function() {
					$(this).prevAll().andSelf().removeClass('ratings_over');
					set_votes<?=$id?>($(this).parent(),$(this).attr('id'),0);
				}
			);
			
			function set_votes<?=$id?>(widget,id,updateUR) {
				var votes = $(widget).data('fsr').number_votes;
				var exact = $(widget).data('fsr').dec_avg;
				var user_vote = $(widget).data('fsr').user_vote;
				var userRating = $(widget).data('fsr').userRating;
				$(widget).find('.cloud_' + user_vote).prevAll().andSelf().addClass('ratings_vote');
				$(widget).find('.cloud_' + user_vote).nextAll().removeClass('ratings_vote'); 
				$('#popCell'+id).html("Pop. "+exact+'% &nbsp;'+votes+" vote"+(votes==1?"":"s"));
				if(updateUR)$('.userRating<?=$userID?>').html("User<br>Rating<br>"+userRating+"%");
			}
			
			$('.clouds<?=$id?>').bind('click', function() {
				var cloud = this;
				var widget = $(this).parent();
				 
				var clicked_data = {
					clicked_on : $(cloud).attr('class'),
					id : widget.attr('id')
				};
				$.post(
					'ratings.php',
					clicked_data,
					function(INFO) {
						widget.data( 'fsr', INFO );
						set_votes<?=$id?>(widget,widget.attr('id'),1);
						$('.clouds<?=$id?>').prevAll().andSelf().removeClass('ratings_over');
					},
					'json'
				); 
			});
			$('.rate_widget<?=$id?>').each(function(i) {
				var widget = this;
				var out_data = {
					id : $(widget).attr('id'),
					fetch: 1
				};
				$.post(
					'ratings.php',
					out_data,
					function(INFO) {
						$(widget).data( 'fsr', INFO );
						set_votes<?=$id?>(widget,$(widget).attr('id'),1);
					},
					'json'
				);
			});
		</script>
		<?
	}
	
	function drawApplet($row,$drawLegend=0){
		global $link,$appletURL,$baseURL;
		$id=$row['id'];
		$userID=$row['userID'];
		$avatar="./avatars/$userID.jpg?".rand();
		$webgl=$row['webgl'];
		$code=$row['code'];
		$votes=$row['votes'];
		$rating=$row['rating'];
		$date=$row['date'];
		$bytes=$row['bytes'];
		$formerUserID=$row['formerUserID'];
		$formerAppletID=$row['formerAppletID'];
		$sql="SELECT * FROM users WHERE id=$userID";
		$res=$link->query($sql);
		$row=mysqli_fetch_assoc($res);
		$name=$row['name'];
		$dateCreated=date('m / d / Y',strtotime($row['dateCreated']));
		$lastSeen=date('m / d / Y',strtotime($row['lastSeen']));
		$rating=$row['rating'];
		if(isset($_COOKIE['id'])){
			$sql="SELECT * FROM users WHERE id=".$_COOKIE['id'];
			$res=$link->query($sql);
			$row=mysqli_fetch_assoc($res);
			$admin=$row['admin'];
		}else{
			$admin=0;
		}
		?>
		<div class="appletDiv" id="appletDiv<?=$id?>">
			<iframe src="<?=$appletURL?>/<?=$id?>" sandbox="allow-same-origin allow-scripts" class="appletIframe" id="iframe<?=$id?>"></iframe>
			<script>
				var h=$(".appletIframe").width()/1.8;
				$(".appletIframe").css("height",h+"px");
				var h=Math.min($(".appletDiv").width()/38,24);
				$(".appletName").css("font-size",h/1.25+"px");
				var h=Math.min($(".appletDiv").width()/10.5,80);
				$(".appletAvatar").css("width",h+"px");
				var h=Math.min($(".appletDiv").width()/45,20);
				$(".userInfoTable").css("font-size",h+"px");
				if(!mobile){
					var h=$(".appletIframe").height();
					$(".code-input").css("height",h+"px");
					$(".appletCode").css("height",h/1.85+"px");
					$(".appletCode").css("max-height",h/1.85+"px");
				}
				$("#iframe<?=$id?>").load(function(){
					var i=$("#iframe<?=$id?>")[0].contentWindow;
					document.querySelector("#iframe<?=$id?>").loaded=1;
       	                                var len=editor<?=$id?>.getValue().length;
               	                        var text=editor<?=$id?>.getValue();
                       	                if(len<1025)var max=1024;
                               	        if(len<513)var max=512;
                                       	if(len<141)var max=140;
                                        $("#count<?=$id?>").html("}//<span style='color:"+(len>1024?"red":"#888")+"'>"+len+"</span>/"+max<?=$formerUserID?"+' ('+((len-$bytes)>=0?'+':'')+(len-$bytes)+'b)'":""?>);
       	                                var webgl=$("#webglCheckbox<?=$id?>").is(":checked");
               	                        document.querySelector("#iframe<?=$id?>").contentWindow.postMessage("start:"+webgl+":"+text, "<?=$appletURL?>");
					startStopApplets();
				});
				
				$('#toggle_fullscreen<?=$id?>').on('click', function(){
					i=$("#appletDiv<?=$id?>")[0];
					if (i.requestFullscreen) {
						i.requestFullscreen();
					} else if (i.webkitRequestFullscreen) {
						i.webkitRequestFullscreen();
					} else if (i.mozRequestFullScreen) {
						i.mozRequestFullScreen();
					} else if (i.msRequestFullscreen) {
						i.msRequestFullscreen();
					}
					i=$(iframe<?=$id?>)[0];
					if (i.requestFullscreen) {
						i.requestFullscreen();
					} else if (i.webkitRequestFullscreen) {
						i.webkitRequestFullscreen();
					} else if (i.mozRequestFullScreen) {
						i.mozRequestFullScreen();
					} else if (i.msRequestFullscreen) {
						i.msRequestFullscreen();
					}
				});
			</script>
			<div class="code-input"><div class="function-wrap" style="float:left;margin-bottom:5px;">function u(t){</div><input id="webglCheckbox<?=$id?>" <?if($webgl)echo "checked"?> style="margin-left:5%;float:left;" type="checkbox"></input><span style="float:left;margin-left:5px;font-size:.7em;" id="webglCheckboxLabel<?=$id?>">webgl</span>
				<a href="javascript:deleteApplet(<?=$id?>)" id="deleteButton<?=$id?>" class="deleteButton">Delete Applet</a>
				<textarea class="appletCode" id="textArea<?=$id?>" autocorrect="off" autocapitalize="off" spellcheck="false" oninput="this.style.height='auto';this.style.height=this.scrollHeight+'px';"><?=$code?></textarea><div class="function-wrap" style="margin-top:5px;" id="count<?=$id?>"></div>
				<?
				if(isset($_COOKIE['id']) && isset($_COOKIE['session'])){
					?>
					<button id="postRemix<?=$id?>" onclick="saveApplet(<?=$id?>,<?=$userID?>,<?=$id?>)" class="postButton">Post Remix</button>
					<?
				}else{
					?>
					<span id="postRemix<?=$id?>" style="display:none;font-size:.8em;margin-left:20px;color:red;background:#222a;">Please login or register to post your work.</span>
					<?
				}
				?>
				<script>
					var editor<?=$id?> = CodeMirror.fromTextArea($("#textArea<?=$id?>")[0],{theme:"blackboard",lineWrapping:true});
					$('#webglCheckbox<?=$id?>').change(function() {
						var webgl=this.checked;
						var text=editor<?=$id?>.getValue();
						document.querySelector("#iframe<?=$id?>").contentWindow.postMessage("start:"+webgl+":"+text, "<?=$appletURL?>");
						$('#webglCheckboxLabel<?=$id?>').val(this.checked);
					});
					if(!($(window).width()<$(window).height())){
						var h=$(".appletIframe").height();
						$(".CodeMirror").height((h-65)+"px");
						$(".CodeMirror").css("margin-top","-25px");
					}else{
						var h=$(".appletIframe").height();
						$(".CodeMirror").height("145px");
						$(".CodeMirror").css("margin-top","-25px");						
					}
				</script>
			</div>
			<div class="clear"></div>
			<?
			if($formerUserID){
				$sql="SELECT * FROM users WHERE id=$formerUserID";
				$res=$link->query($sql);
				$row=mysqli_fetch_assoc($res);
				$formerName=$row['name'];
				$sql="SELECT bytes FROM applets WHERE id=$formerAppletID";
				$res=$link->query($sql);
				$row=mysqli_fetch_assoc($res);
				$byteDiff=$bytes-$row['bytes'];
				?>
				<div class="creditDiv">
					Remix of <a href="/a/<?=$formerAppletID?>">Applet #<?=$formerAppletID?></a> by <a href="/<?=$formerName?>"><?=$formerName?></a> (<?=($byteDiff>=0?"+":"").$byteDiff?>b)
				</div>
				<?
			}
			?>
			<div class="toolbar">
				<?drawRateWidget($id,$userID)?>
				<div class="toolbarText">
					<span id="popCell<?=$id?>">Pop<?=$rating?>%</span>
					<span><a href="javascript:;" id="toggle_fullscreen<?=$id?>">Fullscreen</a></span>
					<!--<span><a href="javascript:toggleShareBox(<?=$id?>)">Share</a></span>-->
					<span><a href="<?=$baseURL?>/a/<?=$id?>" target="_blank">Share</a></span>
					<br><input id="shareBox<?=$id?>" value="<?=$baseURL.'/a/'.$id?>" class="shareBox"></input>
				</div>
			</div>
			<table class="userInfoTable">
				<tr>
					<td style="border:0; width: 275px"><a href="/<?=$name?>"><img src="<?=$avatar?>" class="appletAvatar" />
					<br><span class="appletName"><?=$name?></span></a></td>
					<td><span class="userRating<?=$userID?>">User<br>Rating<br><?=$rating?>%</span></td>
					<td>Member Since<br><?=$dateCreated?></td>
					<td style="border-right:0;">Last Seen<br><?=$lastSeen?></td>
				</tr>
			</table>
			<?drawComments($id)?>
		</div>
		<?
		if($drawLegend){
			?>
			<div class="appletLegend">
				<code class="legendText">u(t) is called 60 times per second.
					t: Elapsed time in seconds.
					S: Shorthand for Math.sin.
					C: Shorthand for Math.cos.
					T: Shorthand for Math.tan.
					c: A 1920x1080 canvas.
					x: A context for that canvas.
					There are 3 applet categories based on number of characters: 140, 512, or 1024. The category is determined automatically.
				</code>
			</div>
			<?
		}
		?>			
		<script>
			<?
			if($_COOKIE['id']==$userID || $admin){
				?>
				$("#deleteButton<?=$id?>").show();
				<?
			}
			?>
			var oldcode=editor<?=$id?>.getValue();
			editor<?=$id?>.on("keyup",function(){
				if(editor<?=$id?>.getValue()!=oldcode){
					$("#postRemix<?=$id?>").show();
					oldcode=editor<?=$id?>.getValue();
					var len=editor<?=$id?>.getValue().length;
					var text=editor<?=$id?>.getValue();
					if(len<1025)var max=1024;
					if(len<513)var max=512;
					if(len<141)var max=140;
					$("#count<?=$id?>").html("}//<span style='color:"+(len>1024?"red":"#888")+"'>"+len+"</span>/"+max<?=$formerUserID?"+' ('+((len-$bytes)>=0?'+':'')+(len-$bytes)+'b)'":""?>);
					var webgl=$("#webglCheckbox<?=$id?>").is(":checked");
					document.querySelector("#iframe<?=$id?>").contentWindow.postMessage("start:"+webgl+":"+text, "<?=$appletURL?>");
				}
			});
			var len=editor<?=$id?>.getValue().length;
			if(len<1025)var max=1024;
			if(len<513)var max=512;
			if(len<141)var max=140;
			$("#count<?=$id?>").html("}//<span style='color:"+(len>1024?"red":"#888")+"'>"+len+"</span>/"+max);
		</script>
		<?		
	}
?>
