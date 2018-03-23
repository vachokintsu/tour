<?php $this->load->view('front/inc/header.php'); ?>

    <div class="wrap pages-header-wrap">
        <ul class="uk-breadcrumb">
            <li><a href="/"><?=$translate['main']?></a></li>
            <li><a href="/all_news" class="uk-active"><?=$translate['contact']?></a></li>
        </ul>
        <header class="pages-header filters"> 
            <h2 class="pages-heading">
                <?=$translate['contact']?>
            </h2>
        </header>
    </div>
    <div class="wrap contact-page pages-cards">
        <div class="uk-grid">
            <div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-3-5">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2975.690189606447!2d44.804066!3d41.770337!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4af9bad8422807b2!2sciu!5e0!3m2!1sen!2sus!4v1509549320516" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="uk-width-small-1-1 uk-width-medium-1-2 uk-width-large-2-5">
                <div class="uk-grid">
                	<div class="contact-info-block">
	                	<div class="uk-width-1-1">
	                		<div class="contact-info">
		                		<div class="contact-info-text-first contact-info-icon"><i class="uk-icon-phone"></i></div>
		                		<div class="contact-info-text-first contact-info-text">
		                		<?php foreach (explode(',',$contact['phone']) as $value): ?>
			                    	<p>
			                    		<a href="tel:<?=$value?>"><?=$value?></a>
			                    	</p>
		                		<?php endforeach ?>
			                    </div>
			                </div>
		                </div>
	                	<div class="uk-width-1-1">
		                	<div class="contact-info">	
		                		<div class="contact-info-icon"><i class="uk-icon-envelope"></i></div>
		                    	<div class="contact-info-text">
		                		<?php foreach (explode(',',$contact['email']) as $value): ?>
			                    	<p>
			                    		<a href="mailto:<?=$value?>"><?=$value?></a>
			                    	</p>
		                		<?php endforeach ?>
			                    </div>
		                    </div>	
	                	</div>
	                	<div class="uk-width-1-1">
		                	<div class="contact-info">	
		                		<div class="contact-info-icon"><i class="uk-icon-map-marker"></i></div>
		                    	<div class="contact-info-text">
			                    	<p><?=$contact['address_'.LANG]?></p>
			                    </div>
		                    </div>	
	                	</div>
	                </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view('front/inc/footer.php'); ?>