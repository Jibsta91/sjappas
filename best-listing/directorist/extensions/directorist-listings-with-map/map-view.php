<?php

use BestListing\wpWax\ThemeSupport;
use BestListing\wpWax\Helper as ThemeHelper;

bdmv_init_template_data();
global $bdmv_listings;
$current_listing_type   = $bdmv_listings->data['listings']->current_listing_type;
$enable_multi_directory = get_directorist_option( 'enable_multi_directory', true );

// removed only multidir section
?>

<?php if ( $bdmv_listings->column_is( 3 ) ) { ?>
<div id="directorist" class="directorist-wrapper"
	data-view-columns="<?php $bdmv_listings->get_the_attr( 'listings_with_map_columns' ); ?>">
	
	<?php ThemeHelper::get_template_part( 'directorist/custom/map-listing-type', $bdmv_listings ); ?>

	<div class="directorist-map-wrapper directorist-map-columns-three">

		<div class="directorist-map-search-inner">

			<h2 class="directorist-listing-map-title" data-post-id="<?php echo get_the_ID(); ?>"><?php echo ThemeSupport::get_header_title( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>

			<?php if ( $bdmv_listings->has_search_section() ) { ?>
			<div class="directorist-map-search">
				<div class="directorist-map-search-content">
					<?php bdmv_get_template( 'all-listings/columns-three/search' ); ?>
				</div>
			</div>
			<?php } ?>
			
		</div>

		<div class="directorist-map-listing">
			<?php bdmv_get_template( 'all-listings/columns-three/map-listing' ); ?>
		</div>
		<div class="directorist-ajax-search-result"></div>
		<!--responsive buttons-->
		<div class="directorist-res-btns">
			<a href="" class="directorist-res-btn" id="js-dlm-search"><span class="la la-search"></span></a>
			<a href="" class="directorist-res-btn active" id="js-dlm-listings"><span class="la la-list-ul"></span></a>
			<a href="" class="directorist-res-btn" id="js-dlm-map"><span class="la la-map-o"></span></a>
		</div>
	</div>
</div>
<?php } elseif ( $bdmv_listings->column_is( 2 ) ) { ?>
<div id="directorist" class="directorist-wrapper"
	data-view-columns="<?php $bdmv_listings->get_the_attr( 'listings_with_map_columns' ); ?>">

	<?php ThemeHelper::get_template_part( 'directorist/custom/map-listing-type', $bdmv_listings ); ?>

	<div class="directorist-map-wrapper directorist-map-columns-two">
		
		<div class="directorist-map-search-inner">

			<h2 class="directorist-listing-map-title" data-post-id="<?php echo get_the_ID(); ?>"><?php echo ThemeSupport::get_header_title( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
			
			<div class="directorist-map-search">
				
				<?php if ( $bdmv_listings->has_search_section() ) { ?>
				<div class="directorist-map-search-content">
					<?php bdmv_get_template( 'all-listings/columns-two/search' ); ?>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="directorist-map-listing">
			<?php bdmv_get_template( 'all-listings/columns-three/map-listing' ); ?>
		</div>
		<div class="directorist-ajax-search-result"></div>
		<!--responsive buttons-->
		<div class="directorist-res-btns">
			<a href="" class="directorist-res-btn" id="js-dlm-search"><span class="la la-search"></span></a>
			<a href="" class="directorist-res-btn active" id="js-dlm-listings"><span class="la la-list-ul"></span></a>
			<a href="" class="directorist-res-btn" id="js-dlm-map"><span class="la la-map-o"></span></a>
		</div>
	</div>
</div>
<?php } elseif ( $bdmv_listings->column_is( '2-style-2' ) ) { ?>
<div id="directorist" class="directorist-wrapper"
	data-view-columns="<?php $bdmv_listings->get_the_attr( 'listings_with_map_columns' ); ?>">
	<div class="directorist-map-listing">
		<?php bdmv_get_template( 'all-listings/columns-two-(style-two)/map-listing' ); ?>
	</div>
	<div class="directorist-ajax-search-result"></div>
	<!--responsive buttons-->
	<div class="directorist-res-btns">
		<a href="" class="directorist-res-btn" id="js-dlm-search"><span class="la la-search"></span></a>
		<a href="" class="directorist-res-btn active" id="js-dlm-listings"><span class="la la-list-ul"></span></a>
		<a href="" class="directorist-res-btn" id="js-dlm-map"><span class="la la-map-o"></span></a>
	</div>
</div>
<?php } elseif ( $bdmv_listings->column_is( 1 ) ) { ?>
<div id="directorist" class="directorist-wrapper"
	data-view-columns="<?php $bdmv_listings->get_the_attr( 'listings_with_map_columns' ); ?>">
	<div class="directorist-map-listing">
		<?php bdmv_get_template( 'all-listings/columns-one/map-listing' ); ?>
	</div>
	<div class="directorist-ajax-search-result"></div>
	<!--responsive buttons-->
	<div class="directorist-res-btns">
		<a href="" class="directorist-res-btn" id="js-dlm-search"><span class="la la-search"></span></a>
		<a href="" class="directorist-res-btn active" id="js-dlm-listings"><span class="la la-list-ul"></span></a>
		<a href="" class="directorist-res-btn" id="js-dlm-map"><span class="la la-map-o"></span></a>
	</div>
</div>
<?php } ?>
<style>
.directorist-map-wrapper,
.directorist-map-columns-three .directorist-map-listing .directorist-listing,
.directorist-map-columns-three .directorist-map-listing .directorist-map,
.directorist-map-columns-three .directorist-ajax-search-result .directorist-listing,
.bdmv-columns-two .directorist-map-listing {
	height: 
	<?php 
	$bdmv_listings->get_the_map_height();
	?>
	;
}
</style>


<input type="hidden" id="display_header" value="<?php $bdmv_listings->get_the_data( 'display_header' ); ?>">
<input type="hidden" id="header_title" value="<?php $bdmv_listings->get_the_data( 'header_title' ); ?>">
<input type="hidden" id="show_pagination" value="<?php $bdmv_listings->get_the_data( 'show_pagination' ); ?>">
<input type="hidden" id="listings_per_page" value="<?php $bdmv_listings->get_the_data( 'listings_per_page' ); ?>">
<input type="hidden" id="location_slug" value="<?php $bdmv_listings->get_the_data( 'location_slug' ); ?>">
<input type="hidden" id="category_slug" value="<?php $bdmv_listings->get_the_data( 'category_slug' ); ?>">
<input type="hidden" id="tag_slug" value="<?php $bdmv_listings->get_the_data( 'tag_slug' ); ?>">
<input type="hidden" id="directory_type" value="<?php echo esc_attr( $bdmv_listings->data['listings']->current_listing_type ); ?>">
<input type="hidden" id="map_zoom_level" value="<?php echo $bdmv_listings->get_data( 'map_zoom_level' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>">
<input type="hidden" id="map_height" value="<?php echo $bdmv_listings->get_data( 'map_height' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>">
<input type="hidden" id="listings_with_map_columns" value="<?php $bdmv_listings->get_the_data( 'listings_with_map_columns' ); ?>">

<?php bdmv_reset_template_data(); ?>
