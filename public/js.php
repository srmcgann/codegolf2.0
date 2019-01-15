<?
	require("db.php");
?>
var oldParent;

function mobileCheck() {
 
 var check = false;
  (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
  return check;
}


function postComment(id,name){
  var comment=$("#commentInput"+id).val();
  if(comment.length>0){
    $.post('/postComment.php',{ id: id, comment: comment }, function(data) {
      if(data){
        alert("Oops. Comment could not be posted.");
      }else{
        comment=comment.replace(":)","ðŸ▒~V~R~V~R~\▒~V~R~V~R| ");
        comment=comment.replace(":D","ðŸ▒~V~R~V~R~\▒~V~R~V~R~R");
        $("#commentsDivInner"+id).show();
        $("#commentsDivInner"+id).append('<a class="commentUserName" href="/'+name+'">'+name+'</a>:<span> '+comment.replace("<","&lt;")+'</span><br>');
        $("#commentInput"+id).val("");
        $("#commentsDivInner"+id).linkify();
      }
    });
  }
}

function isEmailAddress(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function Login(){
	$("#emailConfirmScreen").hide();
	$("#registerScreen").hide();
	$("#emailVerificationScreen").hide();
	$("#loginScreen").show();
	$("#loginusername").focus();
}

function LogOut(){

	$.post( "/logout.php", function( data ) {
		location.reload();
	});
}

function Register(){
	$("#loginScreen").hide();
	$("#emailVerificationScreen").hide();
	$("#registerScreen").show();
	$("#username").focus();
}

function Preferences(){
	$("#changePasswordScreen").hide();
	$("#preferencesScreen").show();
}

function ChangePassword(){
	
	$("#preferencesScreen").hide();
	$("#changePasswordScreen").show();
	$("#password").focus();
}

function SubmitRegistration(){

	var user=$("#username").val();
	if(!userTest){
		alert("User name is blank or unavailable!\nTry again.");
		return;
	}
	var email=$("#email").val();
	if(!emailTest){
		alert("Email is blank or unavailable!\nTry again.");
		return;
	}
	if(!passwordTest){
		alert("Passwords are blank or do not match.\nTry again.");
		return;
	}
	pass=$("#password").val();
	var isEmail=isEmailAddress(user);
	$.post( "/register.php", { user: user, email: email, pass: pass}, function( data ) {
		if(data){
			location.reload();
		}else{
			alert("Registration failed.");
		}
	});
}

function SubmitNewPassword(){

	if(!passwordTest){
		alert("Passwords are blank or do not match.\nTry again.");
		return;
	}
	var pass=$("#password").val();
	$.post( "/changePassword.php", { pass: pass}, function( data ) {
		if(data){
			alert("Password change was successful!");
			$("#password").val("");
			$("#confirmpassword").val("");
			$("#changePasswordScreen").hide();
		}else{
			alert("Password change failed.");
		}
	});
}

function SubmitForceNewPassword(){

	if(!passwordTest){
		alert("Passwords are blank or do not match.\nTry again.");
		return;
	}
	var pass=$("#newPassword").val();
	$.post( "/changePassword.php", { pass: pass}, function( data ) {
		if(data){
			alert("Password change was successful!");
			$("#newPassword").val("");
			$("#newConfirmpassword").val("");
			$("#changePasswordScreen").hide();
			$("#forcePasswordScreen").hide();
		}else{
			alert("Password change failed.");
		}
	});
}

function SubmitLogin(){

	var user=$("#loginusername").val();
	var pass=$("#loginpassword").val();
	var isEmail=isEmailAddress(user);
	$.post( "login.php", { user: user, pass: pass, isEmail: isEmail }, function( data ) {
		if(data){
			location.href="/";
		}else{
			$("#loginResult").show();
		}
	});
}

function CancelRegistration(){
	$("#registerScreen").hide();
}

function CancelLogin(){
	$("#loginScreen").hide();
}

function CancelPreferences(){
	$("#preferencesScreen").hide();
}

function CancelNewPassword(){
	$("#password").val("");
	$("#confirmpassword").val("");
	$("#changePasswordScreen").hide();
}

function SavePreferences(){
	
	var img = $('#image-cropper').cropit('export', {type: 'image/jpeg', quality: .9, originalSize: false});
	var email=$("#email").val();
	$.post( "/savePrefs.php", { avatar: img, email: email}, function( data ) {
		if(data){
			location.reload();
		}
	});
}

function bindEnterKey(){
	document.getElementById('loginusername').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitLogin();
		}
	}
	document.getElementById('loginpassword').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitLogin();
		}
	}
	document.getElementById('username').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitRegistration();
		}
	}
	document.getElementById('email').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitRegistration();
		}
	}
	document.getElementById('password').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitRegistration();
		}
	}
	document.getElementById('confirmpassword').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitRegistration();
		}
	}
}

function bindLoggedInEnterKey(){
	document.getElementById('email').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SavePreferences();
		}
	}
	document.getElementById('password').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitNewPassword();
		}
	}
	document.getElementById('confirmpassword').onkeypress = function(e){
		if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			SubmitNewPassword();
		}
	}
}


function validateUsername(){
	
	var name=$("#username").val();
	if(name){
		$.post( "userNameAvailable.php", { name: name }, function( data ) {
			if(data){
				$("#usernameAvailability").show();
				$("#usernameAvailability").css("color","#0f0");
				$("#usernameAvailability").html("&#10004;");
				userTest=1;
			}else{
				$("#usernameAvailability").show();
				$("#usernameAvailability").css("color","#f00");
				$("#usernameAvailability").html("Name is taken!");
				userTest=0;
			}
		});
	}else{
		$("#usernameAvailability").hide();
	}
}

function validateEmail(){
	
	var email=$("#email").val();
	if(email){
		$.post( "emailAvailable.php", { email: email }, function( data ) {
			if(data && isEmailAddress(email)){
				$("#emailAvailability").show();
				$("#emailAvailability").css("color","#0f0");
				$("#emailAvailability").html("&#10004;");
				emailTest=1;
			}else{
				$("#emailAvailability").show();
				$("#emailAvailability").css("color","#f00");
				$("#emailAvailability").html("Invalid or Unavailable...");
				emailTest=0;
			}
		});
	}else{
		$("#emailAvailability").hide();
	}
}

function validatePrefEmail(current){
	
	var email=$("#email").val();
	if(email){
		if(email.toUpperCase()==current.toUpperCase()){
			$("#emailAvailability").show();
			$("#emailAvailability").css("color","#0f0");
			$("#emailAvailability").html("Available!");
		}else{
			$.post( "/emailAvailable.php", { email: email }, function( data ) {
				if(data && isEmailAddress(email)){
					$("#emailAvailability").show();
					$("#emailAvailability").css("color","#0f0");
					$("#emailAvailability").html("Available!");
					emailTest=1;
				}else{
					$("#emailAvailability").show();
					$("#emailAvailability").css("color","#f00");
					$("#emailAvailability").html("Unavailable!");
					emailTest=0;
				}
			});
		}
	}else{
		$("#emailAvailability").hide();
	}
}

function validatePasswords(){
	
	var pass1=$("#password").val();
	var pass2=$("#confirmpassword").val();
	if(pass1 && pass2){
		if(pass1==pass2){
			$("#passwordConsistency").show();
			$("#passwordConsistency").css("color","#0f0");
			$("#passwordConsistency").html("&#10004;");
			passwordTest=1;
		}else{
			$("#passwordConsistency").show();
			$("#passwordConsistency").css("color","#f00");
			$("#passwordConsistency").html("Passwords don't match!");
			passwordTest=0;
		}
	}else{
		$("#passwordConsistency").hide();
	}
}

function forceValidatePasswords(){
	
	var pass1=$("#newPassword").val();
	var pass2=$("#newConfirmpassword").val();
	if(pass1 && pass2){
		if(pass1==pass2){
			$("#forcePasswordConsistency").show();
			$("#forcePasswordConsistency").css("color","#0f0");
			$("#forcePasswordConsistency").html("&#10004;");
			passwordTest=1;
		}else{
			$("#forcePasswordConsistency").show();
			$("#forcePasswordConsistency").css("color","#f00");
			$("#forcePasswordConsistency").html("Passwords don't match!");
			passwordTest=0;
		}
	}else{
		$("#passwordConsistency").hide();
	}
}

function resendVerificationEmail(){
	
	$.post( "/resendVerificationEmail.php", function( data ) {
		if(data){
			$("#emailVerificationSendStatus").css("color","#0f0");
			$("#emailVerificationSendStatus").html("Email sent!");
		}else{
			$("#emailVerificationSendStatus").css("color","#f00");
			$("#emailVerificationSendStatus").html("There was a problem... Try re-registering.");
		}
	});
}

function confirmEmail(k,email){
	
	$.post( "/confirm.php", {k:k, email:email}, function( data ) {
		if(data){
                        console.log(data);
			$("#confirmResult").css("color","#0f0");
			$("#confirmResult").html("Email confirmed!<br><br><button onclick='Login()'>Log In</button>");
		}else{
			$("#confirmResult").css("color","#f44");
			$("#confirmResult").html("This email has already been confirmed!<br><br><button onclick='Login()'>Log In</button>");
		}
	});
}


function isScrolledIntoView(elem){
	
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    var elemTop = $(elem).offset().top;
    var elemBottom = elemTop + $(elem).height();
    return ((docViewTop-100 < elemTop) && (docViewBottom+50 > elemBottom));
}


var iframeStates = Array(9e3).fill(1)

function startStopApplets(){
	
	$('.appletIframe').each(function(i, obj) {
		if(isScrolledIntoView(obj)){
			if(!iframeStates[i]) {
                          setTimeout(function(){
                            if(typeof obj.loaded != "undefined")obj.contentWindow.postMessage("start:", "<?=$appletURL?>");
                            iframeStates[i]=1
                          }, 0);
                        }
		}else{
			if(iframeStates[i]) {
                          if(typeof obj.loaded != "undefined") {
                            obj.contentWindow.postMessage("stop:", "<?=$appletURL?>");
                            iframeStates[i] = 0
                          }
                        }
		}
	});
}


function fetchMore(){
	
	startStopApplets();
	if($(window).scrollTop()+$(window).height() > $(document).height()-900){
		$(window).unbind('scroll',fetchMore);
		$(window).bind('scroll',startStopApplets);
		fetchComplete=false;
		var user=window.location.pathname.split('/')[1];
		if(user=="140" || user=="512" || user=="1024"){
			var filter=user;
			user="";
		}else{
			var filter=window.location.pathname.split('/')[2];
		}
                var IDs = [];
                $("#main").find("iframe").each(function(){ IDs.push(this.id.substring(6)); });
		$.post('fetch.php',{scroll, u:user, filter, IDs:JSON.stringify(IDs)},
		function(data) {
			if(data.length>10){
				scroll++;
				if(data=="<br><br><br>User not found... :(" ||
				   data.includes("made any applets yet")){
					$("#main").html(data);
				}else{
					$("#main").append(data);
					if($(window).scrollTop()+$(window).height() > $(document).height()-900){
						fetchMore();
					}else{
						$(window).bind('scroll',fetchMore);
					}
				}
			}
			fetchComplete=true;
		});
	}
}

function hookNewAppletButton(){
	retry = () => {
          setTimeout(() => {
            if(document.getElementById("newAppletButton")) {
              $("#newAppletButton").click(function () {
		$.post('fetchnew.php',{ id:1 },
		function(data) {
			if(data.length>1){
				$("#landingDiv").html("");
				$("#main").prepend(data);
				$("#main").css("margin-top","65px");
			}
		});
              });
              $("#landingDiv").css("display","block");
              $("#main").css("margin-top","180px");
            } else {
              retry();
            }
          }, 100);
        }
        retry();
}

$(document).ready(function(){
	if(window.location.pathname.split('/')[1]=='a'){
		$.post('fetchSingle.php',{ id:window.location.pathname.split('/')[2] },
		function(data) {
			if(data.length>10){
				$("#main").append(data);
			}
		});
	}else{
		scroll=0;
		$(window).bind('scroll',fetchMore);
		fetchMore();
		hookNewAppletButton();
	}
	document.body.style.display="block";
});

$(window).resize(function(){
	var h=$(".appletIframe").width()/1.8;
	$(".appletIframe").css("height",h+"px");
	setTimeout(function(){
		var h=$(".appletIframe").width()/1.8;
		$(".appletIframe").css("height",h+"px");
		if(!mobile){
			var h=$(".appletIframe").height();
			$(".code-input").css("height",h+"px");
			$(".appletCode").css("height",h/1.85+"px");
			$(".appletCode").css("max-height",h/1.85+"px");
			$(".CodeMirror").height((h-60)+"px");
			$(".CodeMirror").css("margin-top","-25px");
		}
	},0);
	var h=$(".appletDiv").width()/38;
	$(".appletName").css("font-size",Math.min(h,20)+"px");
	var h=Math.min($(".appletDiv").width()/10.5,80);
	$(".appletAvatar").css("width",h+"px");
	var h=Math.min($(".appletDiv").width()/45,20);
	$(".userInfoTable").css("font-size",h+"px");
	mobile=($(window).width()<$(window).height());
	$(".stylesheet").addClass("oldstylesheet");
	/*
  if(mobile){
		$('head:first').append('<link class="stylesheet" rel="stylesheet" href="/style.css" />');
		$(".CodeMirror").css("margin-top","-25px");
		$(".CodeMirror").css("height","150px");
	}else{
		$('head:first').append('<link class="stylesheet" rel="stylesheet" href="/desktopStyle.css" />');
	}
	setTimeout(function(){$(".oldstylesheet").remove()},0);
  */
});

function toggleShareBox(id){
	if($("#shareBox"+id).is(":visible")){
		$("#shareBox"+id).hide();
	}else{
		$("#shareBox"+id).show();
		$("#shareBox"+id)[0].select();
	}
}

function deleteApplet(id){
	if(confirm("Are you sure?!\n\nThis action cannot be undone")){
		$.post('/deleteApplet.php',{ id }, function(data) {
			if(data){
				alert("Oops. Applet could not be deleted.");
			}else{
				location.reload();
			}
		});
	}
}

function saveApplet(id,formerUserID,formerAppletID){
        console.log('herp')
	$.post('/saveApplet.php',{ code:eval("editor"+id).getValue(), formerUserID: formerUserID, formerAppletID:formerAppletID, webgl:$("#webglCheckbox"+id).is(':checked') },
	function(data) {
		if(data=="fail"){
			alert("Applet could not be saved!\n\nEither it is too long, or you are not logged in...")
		}else{
			window.location="/"+data;
		}
	});
	
}
