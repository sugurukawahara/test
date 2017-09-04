<?php get_header(); ?>
<div id="contents" class="cf">

<div id="notfound">
    <div><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/404.png" alt="404 Not Found"></div>
    
    <div class="pic03 cf">
		<?php
		$args = array(
			'posts_per_page'   => 4,
			'post_type'        => 'post',
			'post_status'      => 'publish',
			'suppress_filters' => true
		);
		$the_query = new WP_Query( $args ); ?>
		
		<?php if ( $the_query->have_posts() ) : ?>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php
			$thumbnail_id = get_post_thumbnail_id();
			$eye_img = wp_get_attachment_image_src( $thumbnail_id , 'medium' );
			?>            
            <section class="article">
				<p class="img"><a href="<?php the_permalink(); ?>"><img src="<?php echo $eye_img[0]; ?>" alt="<?php the_title(); ?>"></a></p>
				<div class="article-body">
					<h1 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php
                        $days  = 7 ;
                        $today = date_i18n('U');
                        $entry = get_the_time('U');
                        $total = date('U',($today - $entry)) / 86400 ;
                    ?>
                    <?php if( $days > $total ){ ?>
						<p class="new">NEW</p>
					<?php } ?>
					<p class="day"><?php the_time('Y年n月d日'); ?>｜<?php the_category(' '); ?></p>
					<p class="tag cf">
						<?php
							$tags = get_the_tags();
							foreach ( $tags as $tag ) {
							   echo '<a href="/tag/'.$tag->slug.'">'.$tag->name.'</a>';
						} ?>
					</p>
				</div>
			</section>
		
			<?php endwhile; wp_reset_postdata(); ?>
		<?php else: endif;  ?>
	</div>
</div>

</div>
<?php get_footer(); ?>