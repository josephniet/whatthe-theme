<article class="event">
	<div class="event-header-image">
		<?php echo get_the_post_thumbnail( $item->id, 'full' ); ?>
	</div>
	<div class="inner container">
		<div class="dates-container">
			<div class="dates">
				<?php	writeDate($item->start_date) ?>
				<span class="to">to</span>
				<?php	writeDate($item->end_date) ?>
			</div>
		</div>
<!--		<div class="link-container top">
			<a class="tickets-link" href="<?php echo $item->tickets_link->url?>"><span><?php echo $item->tickets_link->text ?></span></a>
</div> -->
		<section class="content">
			<?php echo $item->content ?>
		</section>

		<?php /*ADDITIONAL CONTENT*/ if (!empty($item->additionalContent)){ ?>
		<?php doAdditional($item);?>		
		<?php } ?>
		
		
		<?php /*FEATURED CONTENT*/ if (!empty($item->attachedItems)){ ?>
		<section class="featured-content">
			<?php 
			doFeatured($item);
			 ?>
		</section>
		<?php } ?>
		
		
		<?php /*COMMUNICATIONS*/ if (!empty($item->communications)){ ?>
		<section class="communications">
			<div class="communications-content"><?php echo $item->communications_text ?></div>
			<div class="communications-wrapper">
				<?php $old = $item; foreach($item->communications as $item){ include "communications.php"; } $item = $old;//bad practise but im incredibly busy atm. ?>
			</div>
		</section>
		<?php } ?>
		<div class="call-to-action">
			<?php echo $item->call_to_action ?>
		</div>
		
		<?php /*TICKETS LINK*/ if (!empty($item->tickets_link->text)){ ?>
		<div class="link-container">
			<a class="tickets-link" href="<?php echo $item->tickets_link->url?>"><span><?php echo $item->tickets_link->text ?></span></a>
		</div>
		<?php } ?>
	</div>
	<div class="characters-container">
		<div class="char-right char"></div>
		<div class="char-left char"></div>
	</div>
</article>
<?php // var_dump($item) ?>
