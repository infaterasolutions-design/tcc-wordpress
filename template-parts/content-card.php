<?php
/**
 * Template part for displaying a standard bottom grid post card
 */
?>
<a href="<?php the_permalink(); ?>" style="text-decoration: none;">
	<div class="bottom-card group">
		<div class="bottom-card-image">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'large', array( 'style' => 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;', 'class' => 'hover-scale' ) ); ?>
			<?php else : ?>
				<?php 
					$dummy_img = get_post_meta( get_the_ID(), '_tcc_dummy_image', true ) ?: 'https://images.unsplash.com/photo-1445205170230-053b83016050?auto=format&fit=crop&q=80&w=600'; 
					echo tcc_get_picture_tag($dummy_img, 'Placeholder', 'hover-scale', 'width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;');
				?>
			<?php endif; ?>
			<style>
				.bottom-card:hover .hover-scale { transform: scale(1.05); }
			</style>
		</div>
		<div>
			<span style="font-family: 'Inter', sans-serif; font-size: 9px; letter-spacing: 1.51px; color: #605C5C; text-transform: uppercase; display: block; margin-bottom: 8px;">
				<?php echo get_the_date(); ?>
			</span>
			<h2 style="font-family: 'Playfair Display', serif; font-size: 20px; line-height: 25px; letter-spacing: 0.17px; color: #000; margin: 0;">
				<?php the_title(); ?>
			</h2>
		</div>
	</div>
</a>
