<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
<title>{{ $name }}</title>
<meta name="author" content="DeathGhost" />
<meta name="_token" content="{{ csrf_token() }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('admin/css/style.css') }}">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
<script src="{{ URL::asset('admin/js/jquery.js') }}"></script>
<script src="{{ URL::asset('admin/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script src="{{URL::asset('admin/js/verificationNumbers.js')}}"></script>
<script src="{{URL::asset('admin/js/Particleground.js')}}"></script>
<script src="{{URL::asset('layer/layer.js')}}"></script>
<script>

	(function($){
		$(window).load(function(){
			
			$("a[rel='load-content']").click(function(e){
				e.preventDefault();
				var url=$(this).attr("href");
				$.get(url,function(data){
					$(".content .mCSB_container").append(data); //load new content inside .mCSB_container
					//scroll-to appended content 
					$(".content").mCustomScrollbar("scrollTo","h2:last");
				});
			});
			
			$(".content").delegate("a[href='top']","click",function(e){
				e.preventDefault();
				$(".content").mCustomScrollbar("scrollTo",$(this).attr("href"));
			});
			
		});
	})(jQuery);
</script>
</head>