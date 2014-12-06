<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1479869905635486',
      xfbml      : true,
      version    : 'v2.2'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

	function statusChangeCallback(response){
		console.log('statusChangeCallback');
		console.log(response);
		if(response.status =='connected'){
			testAPI();

		}
	function testAPI(){
		console.log('wlcome');
		FB.api('/me',function(response){
			console.log('Successful'+response.name);
			document.getElementById('status').innerHTML = 'thank'+response.name;
		})

	}
}

</script>
<div class="fb-login-button" data-max-rows="2" data-size="xlarge" data-show-faces="false" data-auto-logout-link="true"></div>
<div id="status"></div>