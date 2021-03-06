<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<title>Courses::iWebApp</title>
		<link rel="stylesheet" type="text/css" href="assets/css/normalize.css" />
 		<link rel="stylesheet" type="text/css" href="assets/css/demo.css" />
 		<link rel="stylesheet" type="text/css" href="assets/css/component.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				//alert("hi");
				var stat=0;
				$("#showMenu").click(function(){
					$(".mysidebar").fadeOut();
					stat=1;
				});
				$(".container").click(function(){
					if(stat==1 && $(window).width()>723){
						$(".mysidebar").fadeIn();
						stat=0;
					}
				});
				$("#mobile-show-menu").click(function(){
					$('#showMenu').trigger('click');
				});
			});
		</script>
		<!--[if lte IE 8]><script src="assets/courses/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/courses/css/main.css" />
		<script src="assets/js/modernizr.custom.25376.js"></script>
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/courses/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/courses/css/ie8.css" /><![endif]-->
		<style>
				.wrapper.fullscreen {
					min-height: 40vh !important;
				}
				.outer-nav.right {
					left:10%;
				}
				#mobile-show-menu {
					font-family: fontAwesome;
					font-size: 30px;
					position:fixed;
					color: #312450;
					right: 20px;
					top: 10px; 
					z-index: 1000;
				}
			}
		</style>
		<script>
			function subscribe(type,course,sub){
				var sendTo="cAPI/Subs";
				if(sub==2 || $("#buttonC"+course).hasClass("subs")){
					sendTo="cAPI/unSubs";
				}
				$.post(sendTo,
                        {
                        	type:1,
                        	code:course
                        },
                        function(data,status){
                        	// $(this).text(data[1]);
                        	console.log(data);
                        	if(status=='success'){
                        		if(sub==2){
	                        		$("#buttonC"+course).text("Un-Subscribed!");
	                        		$("#buttonC"+course).removeClass("subs");
	                        		$("#buttonC"+course).css("background","rgba(33, 156, 50, 0)");
                        		}else{
	                        		$("#buttonC"+course).text("Subscribed!");
	                        		$("#buttonC"+course).addClass("subs");
	                        		$("#buttonC"+course).attr("onclick","subscribe(1,"+course+",2)");
	                        		$("#buttonC"+course).css("background","rgba(33, 156, 50, 0.53)");
                        		}
                        		//alert("success");
                        		if(sub==2){
	                        		$("#buttonC"+course).text("Un-Subscribed!");
	                        	}
                        	}
                        });
			}
		</script>
		<style>
			.subs{
				background:rgba(33, 156, 50, 0.53) !important;
			}
		</style>
		<script>
		$(document).ready(function(){//use same for unsubs
			var cSubs;
			$.post("cAPI/checkSub",
                        {type:1},
                        function(data, status){
                        console.log("Response");
                        console.log("Data: " + data + "\nStatus: " + status);
                            if(status=='success'){//$("#myloader").fadeOut();
                                cSubs = data;
                               
                            }else{
                            	window.location="";

                            }
                    }
		        ,"json");
			$.post("cAPI/getCourse",
                        {},
                        function(data, status){
                        console.log("Response");
                        console.log("Data: " + data + "\nStatus: " + status);
                            if(status=='success'){//$("#myloader").fadeOut();
                                var cse = data[0];
                                var ee = data[1];
                                var me = data[2];
                                var ce = data[3];
                                var courseData;
                                var i=0;
                                var currElement;
                                while(cse[i]){
                                	currElement = cse[i];
                                	console.log(currElement);
                                	courseData ='<section class="">	<a href="#" class="image" style="background-image: url(&quot;img/courses/'+currElement[4]+'&quot;); background-position: center center;"><img src="img/courses/'+currElement[4]+'" alt="" data-position="center center" style="display: none;"></a><div class="content"><div class="inner"><h2>'+currElement[1]+'</h2><h3>'+currElement[3]+'</h3><p><br>Course Rating : '+currElement[2]+'/5</p><ul class="actions"><li><a id="buttonC'+currElement[0]+'"';
                                	if(cSubs[currElement[0]]==1){
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',2);" class="button subs">';
                                	}else {
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',1);" class="button">';
                                	}
                                	courseData+='Subscribe</a></li><li><a id="buttonI" href="courses/view/'+currElement[1]+'" target="_blank" class="button">Course Info</a></li></ul></div></div></section>'; 
                                	i++;
                                	$("#cseCourses").append(courseData);
                                }
                                i=0;
                                while(ee[i]){
                                	currElement = ee[i];
                                	console.log(currElement);
                                	courseData ='<section class="">	<a href="#" class="image" style="background-image: url(&quot;img/courses/'+currElement[4]+'&quot;); background-position: center center;"><img src="img/courses/'+currElement[4]+'" alt="" data-position="center center" style="display: none;"></a><div class="content"><div class="inner"><h2>'+currElement[1]+'</h2><h3>'+currElement[3]+'</h3><p><br>Course Rating : '+currElement[2]+'/5</p><ul class="actions"><li><a id="buttonC'+currElement[0]+'"';
                                	if(cSubs[currElement[0]]==1){
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',2);" class="button subs">';
                                	}else {
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',1);" class="button">';
                                	}
                                	courseData+='Subscribe</a></li><li><a id="buttonI" href="courses/view/'+currElement[1]+'" target="_blank" class="button">Course Info</a></li></ul></div></div></section>';  
                                	i++;
                                	$("#eeCourses").append(courseData);
                                }
                                i=0;
                                while(me[i]){
                                	currElement = me[i];
                                	console.log(currElement);
                                	courseData ='<section class="">	<a href="#" class="image" style="background-image: url(&quot;img/courses/'+currElement[4]+'&quot;); background-position: center center;"><img src="img/courses/'+currElement[4]+'" alt="" data-position="center center" style="display: none;"></a><div class="content"><div class="inner"><h2>'+currElement[1]+'</h2><h3>'+currElement[3]+'</h3><p><br>Course Rating : '+currElement[2]+'/5</p><ul class="actions"><li><a id="buttonC'+currElement[0]+'"';
                                	if(cSubs[currElement[0]]==1){
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',2);" class="button subs">';
                                	}else {
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',1);" class="button">';
                                	}
                                	courseData+='Subscribe</a></li><li><a id="buttonI" href="courses/view/'+currElement[1]+'" target="_blank" class="button">Course Info</a></li></ul></div></div></section>'; 
                                	i++;
                                	$("#meCourses").append(courseData);
                                }
                                 while(ce[i]){
                                	currElement = ce[i];
                                	console.log(currElement);
                                	courseData ='<section class="">	<a href="#" class="image" style="background-image: url(&quot;img/courses/'+currElement[4]+'&quot;); background-position: center center;"><img src="img/courses/'+currElement[4]+'" alt="" data-position="center center" style="display: none;"></a><div class="content"><div class="inner"><h2>'+currElement[1]+'</h2><h3>'+currElement[3]+'</h3><p><br>Course Rating : '+currElement[2]+'/5</p><ul class="actions"><li><a id="buttonC'+currElement[0]+'" ';
                                	if(cSubs[currElement[0]]==1){
	                                	courseData+='onclick="subscribe(1,'+currElement[0]+',2);" class="button subs">';
	                                	courseData+='Subscribed!</a></li></ul></div></div></section>'; 

                                	}else {
	                                	courseData+=' onclick="subscribe(1,'+currElement[0]+',1);" class="button">';
    
                                	}
	                                	courseData+='Subscribe</a></li><li><a id="buttonI" href="courses/view/'+currElement[1]+'" target="_blank" class="button">Course Info</a></li></ul></div></div></section>'; 
                                	i++;
                                	$("#ceCourses").append(courseData);
                                }
                            }else{
                            	window.location.reload();	
                            }

                            
                    }
		        ,"json");
		$(".subs").text("Subscribed");
		        
		    
		});
		</script>
		<script>
			$(document).ready(function(){

				setTimeout(function(){
					$(".subs").text("Subscribed");
					var text =$("#cseCourses").html();
	                            text = text.replace(/\s/g,'');
	                            if(text==""){window.location.reload();	}
				},1000); 
				
			});
		</script>
	</head>
	<body>
	<div id="perspective" class="perspective effect-airbnb">
	<div id="mobile-show-menu" href="#back"></div>
		<!-- Sidebar -->
			<section id="sidebar" class="mysidebar">
				<div class="inner">
					<nav>
						<ul>
							<li><button class="button special" id="showMenu" style="margin:auto;" href="#back">Show Menu</button></li>
							<li><a href="#intro">Welcome</a></li>
							<li><a href="#cse">Computer Science and Engineering</a></li>
							<li><a href="#ee">Electrical Engineering</a></li>
							<li><a href="#me">Mechanical Engineering</a></li>
							<li><a href="#ce">Civil Engineering</a></li>
						</ul>
					</nav>
				</div>
			</section>
			<div class="container">
				<div class="wrapper">
		<!-- Sidebar -->
			<section id="sidebar">
				<div class="inner">
					<nav>
						<ul><li><button>Show Menu</button></li>
							<li><a href="#intro">Welcome</a></li>
							<li><a href="#cse">NJACK</a></li>
							<li><a href="#ee">Sparkonics</a></li>
							<li><a href="#me">SCME</a></li>
							<li><a href="#ce">E-Club</a></li>
						</ul>
					</nav>
				</div>
			</section>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>Courses</h1>
							<p> Subscribe to any course here to never miss any updates.</p>
							<span id = "mobile-nav">
							<ul class="actions vertical">
								<li><a href="#cse" class="button fit scrolly">Computer Science and Engineering</a></li>
								<li><a href="#ee" class="button fit scrolly">Electrical Engineering</a></li>
								<li><a href="#me" class="button fit scrolly">Mechanical Engineering</a></li>
								<li><a href="#ce" class="button fit scrolly">Civil Engineering</a></li>
								</ul>
							</span>
						</div>
					</section>
				<!-- Computer Science Header -->
					<section id="cse" class="wrapper style3 fade-up">
						<div class="inner">
							<h2>Computer Science and Engineering</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
						</div>
					</section>

				<!-- Computer Science Course List -->
					<section class="wrapper style2 spotlights" id="cseCourses">
						
					</section>
				<!-- Electrical Header -->
					<section id="ee" class="wrapper style3 fade-up">
						<div class="inner">
							<h2>Electrical Engineering</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
						</div>
					</section>

				<!-- Electrical Course List -->
					<section class="wrapper style2 spotlights" id="eeCourses">
					
					</section>
				<!-- Mechanical Header -->
					<section id="me" class="wrapper style3 fade-up">
						<div class="inner">
							<h2>Mechanical Engineering</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
						</div>
					</section>

				<!-- Mechanical Course List -->
					<section class="wrapper style2 spotlights" id="meCourses">
					</section>
				<!-- Civil Engineering Header -->
				<section id="ce" class="wrapper style3 fade-up">
						<div class="inner">
							<h2>Civil engineering</h2>
							<p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus, lacus eget hendrerit bibendum, urna est aliquam sem, sit amet imperdiet est velit quis lorem.</p>
						</div>
					</section>

				<!-- Civil Engineering Course List -->
					<section class="wrapper style2 spotlights" id="ceCourses">
					</section>
			</div>

		<!-- Scripts -->
			<script src="assets/courses/js/jquery.min.js"></script>
			<script src="assets/courses/js/jquery.scrollex.min.js"></script>
			<script src="assets/courses/js/jquery.scrolly.min.js"></script>
			<script src="assets/courses/js/skel.min.js"></script>
			<script src="assets/courses/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/courses/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/courses/js/main.js"></script>
			<script src="assets/js/classie.js"></script>
		<script src="assets/js/menu.js"></script>
		</div></div>
		<?php require('render/menu.php');?>
		</div>
	</body>
</html>