<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
?>

<div  id="footerSection">
	<div class="container">
		<div class="row">
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="login.html">YOUR ACCOUNT</a>
				<a href="login.html">PERSONAL INFORMATION</a>
				<a href="login.html">ADDRESSES</a>
				<a href="login.html">DISCOUNT</a>
				<a href="login.html">ORDER HISTORY</a>
			 </div>
			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="contact.html">CONTACT</a>
				<a href="register.html">REGISTRATION</a>
				<a href="legal_notice.html">LEGAL NOTICE</a>
				<a href="tac.html">TERMS AND CONDITIONS</a>
				<a href="faq.html">FAQ</a>
			 </div>
			<div class="span3">
				<h5>OUR LINKS</h5>
				@foreach ($mainCategories as $mainCat)
					<a href="{{ url('/products/' . $mainCat->url) }}">{{ strtoupper($mainCat->name) }}</a>
				@endforeach
			 </div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="/images/frontend_img/facebook.png" title="facebook" alt="facebook"/></a>
				<a href="#"><img width="60" height="60" src="/images/frontend_img/twitter.png" title="twitter" alt="twitter"/></a>
				<a href="#"><img width="60" height="60" src="/images/frontend_img/youtube.png" title="youtube" alt="youtube"/></a>
			 </div>
		 </div>
		<p class="pull-right">&copy; Whytech Solutions <?php echo date('Y'); ?></p>
	</div><!-- Container End -->
</div>