<?php

function amPagination($options = null) {
	$query           = $options['query'] ?? null;
	$paged           = $options['paged'] ?? null;
	?>
	<div class="am-pagination">
		<?php
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
			'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'  => get_home_url() . '?paged=%#%',
			'current' =>  max( 1, get_query_var( $paged ) ),
			'total'   => $query->max_num_pages
		) );
		?>
	</div>
<?php }