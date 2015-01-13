<div class="navbar 	navbar-fixed-top">
	<div class="navbar navbar-inner">
	    <div class="container">  
	      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

	      <div class="navbar navber-inverse">
		      <ul class="nav">
		        <li class="active"><a href="<?=site_url()?>">首頁</a></li>
		        <li><a href="<?=site_url("simulator")?>">選課模擬</a></li>
		        <li><a href="<?=site_url("course/")?>">課表查詢</a></li>
		        <li><a href="<?=site_url("explore/")?>">找同學</a></li>
		      </ul>

		      <ul class="nav pull-right">
		      	<li><a href="<?=site_url("users/auth/facebook")?>"> Sign in with Facebook</a></li>

		      </ul>
		  </div>
	      </div>
	</div>
</div>
