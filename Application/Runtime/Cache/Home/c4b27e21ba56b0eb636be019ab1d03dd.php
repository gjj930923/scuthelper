<?php if (!defined('THINK_PATH')) exit();?><div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<nav id="copyright" class="navbar navbar-default" role="navigation">
				<div>
					Text
				</div>
			</nav>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		if($(window).height()==$(document).height()){
			$("#copyright").addClass("navbar-fixed-bottom");
		}
		else{
			$("#copyright").removeClass(" navbar-fixed-bottom");
		}
	});
</script>
</div>
  </font>

  </body>
</html>