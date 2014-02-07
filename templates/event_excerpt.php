<article class="event excerpt">
	<div class="event-header-image">
		<?php echo get_the_post_thumbnail( $item->id, 'full' ); ?>
	</div>
	<div class="container inner">
		<a href="<?php echo $item->permalink ?>">
			<div class="dates-container">
				<div class="dates">
					<?php	writeDate($item->start_date) ?>
					<span class="to">to</span>
					<?php	writeDate($item->end_date) ?>
				</div>
			</div>
		</a>
			<section class="content">
				<?php echo $item->excerpt ?>
			</section>
		<a href="<?php echo $item->permalink ?>">			
		</a>
	</div>
</article>

<?php //var_dump($item) ?>
