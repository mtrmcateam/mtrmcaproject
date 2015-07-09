<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-IN">
	<head>
		@section('head')
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="description" content="Mycollegeadda provides a platform to college students to buy and sell books, notes, electronics and post queries for roomate, car pool. Click hereto know more" />
		<meta name="keywords" content="buy books, sell books, used books, old books, find books, mycollegeadda, buy, sell, old, second hand books, carpool, electronics, notes, flatmates, pg, hostel, rooms, rideshare" />
		<meta name="author" content="mycollegeadda">
		<meta name="robots" content="index, follow" />
		<link type="image/x-icon" href="{{asset('images/favicon.png')}}" rel="shortcut icon" />
		@include('layout.head_script')
		@show
	</head>
	<body>
<!-- HEADER NAVIGATION SECTION STARTS --> 
		@include('layout.header')
<!-- HEADER NAVIGATION SECTION ENDS -->

<!-- MAIN SECTION STARTS -->
		@include('layout.display_errors')				
		@yield('content')
		<div style="min-height:151px">
		@yield('home_content')
	</div>
<!-- MAIN SECTION ENDS -->
<!-- FOOTER SECTION STARTS -->
		@include('layout.footer')
<!-- FOOTER SECTION ENDS -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58888080-1', 'auto');
  ga('send', 'pageview');

</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var $_Tawk_API={},$_Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5569a60df81778866e5eb47e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5575db205b1f5516" async="async"></script>
	</body>
</html>