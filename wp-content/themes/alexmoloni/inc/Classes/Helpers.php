<?php
/**
 * Created by PhpStorm.
 * User: Aleksander
 * Date: 05-Nov-19
 * Time: 23:34
 */

namespace alexito;


class Helpers {
	public static function includeSVG( $locationFromSVGAddSlash ) {
		include get_stylesheet_directory() . '/assets/images/svg' . $locationFromSVGAddSlash;
	}

	public static function cleanAndValidateInputData( $data ) {
		$data = trim( $data );
		$data = stripslashes( $data );
		$data = htmlspecialchars( $data );

		return $data;
	}


	public static function isCategorySelected( $options ) {
		if ( ! isset( $options['default_selected'] ) ) {
			$options['default_selected'] = false;
		}

		if ( $options['default_selected'] ) {
			//if by default category should be selected and we dont have filter get param in url, then display it
			if ( ! isset( $_GET[ $options['get_param'] ] ) ) {
				echo 'selected';
			}
		}

		if ( in_array( $options['slug'], $options['selected_categories_array'] ) ) {
			echo 'selected';
		}
	}

	/**
	 * @param \WP_Post $id
	 *
	 * @return string
	 */
	public static function getPostContentRaw( $id = null ) {
		global $post;
		if ( ! $id ) {
			$id = $post->ID;
		}
		$post_obj = get_post( $id );

		return $post_obj->post_content;
	}


	public static function send404() {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
		exit();
	}

	public static function getPostBySlug( $slug, $post_type = 'post' ) {
		$args     = array(
			'name'        => $slug,
			'post_type'   => $post_type,
			'post_status' => 'publish',
			'numberposts' => 1
		);
		$my_posts = get_posts( $args );
		if ( $my_posts ) {
			return $my_posts[0];
		} else {
			return false;
		}
	}


	/**
	 * @param string $append
	 *
	 * @return string the url path, after the host, ex. /marcas/converse/
	 * with slash at the end
	 */
	static function getCurrentUrl( $append = '' ) {
		return $_SERVER['REQUEST_URI'] . $append;
	}

	static function getCurrentUrlNoQueryString( $append = '' ) {
		return strtok( $_SERVER["REQUEST_URI"], '?' );
	}

	static function scriptToPreventFormResendOnReload() { ?>
        <script>
            if ( window.history.replaceState ) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>

	<?php }

	/**
	 * @param $filter_get_param
	 *
	 * @return array An array of slugs from filters that have been seleceted by user on front end
	 */
	static function getSelectedFiltersSlugs( $filter_get_param ) {
		if ( ! empty( $_GET[ $filter_get_param ] ) ) {

			//remove leading and trailing commas so that explode doesnt return empty items in the array
			$slugs_string = trim( $_GET[ $filter_get_param ], ',' );
			$slugs_string = sanitize_text_field( $slugs_string );

			return explode( ',', $slugs_string );
		} else {
			return [];
		}
	}


	/**
	 * ex. return https://troovix.alexmoloni.com/wp-content/themes/troovix/assets/js/dev/main.js
	 *
	 * @param string $filename
	 *
	 * @param bool $prod if only look inside prod folder
	 *
	 * @return string used to register a script
	 */
	static function getJsRelativePath( $filename, $prod = null ) {
		if ( $prod ) {
			return get_stylesheet_directory_uri() . '/assets/js/prod/' . $filename;
		}

		return get_stylesheet_directory_uri() . '/assets/js/' . ENV . '/' . $filename;
	}

	/**
	 * ex return /var/www/troovix.alexmoloni.com/wp-content/themes/troovix/assets/js/dev/main.js
	 *
	 * @param string $filename
	 *
	 * @param bool $prod if only look inside prod folder
	 *
	 * @return string can be used in filemtime function
	 */
	static function getJsAbsolutePath( $filename, $prod = null ) {
		if ( $prod ) {
			return get_stylesheet_directory() . '/assets/js/prod/' . $filename;
		}

		return get_stylesheet_directory() . '/assets/js/' . ENV . '/' . $filename;
	}

	static function getFieldKey( $field_name ) {
		return get_field_object( $field_name )['key'];
	}

	static function selectMaxMetaValue( $meta_key, $post_ids_array = null ) {
		global $wpdb;

		if ( $post_ids_array ) {
			$post_ids_array_placeholders = implode( ', ', array_fill( 0, count( $post_ids_array ), '%d' ) );
			$prepare_values              = array_merge( array( $meta_key ), $post_ids_array );
			$query_result                = $wpdb->prepare(
				"SELECT max(cast(meta_value as decimal(8, 2))) 
                        FROM troovix_postmeta pm
                        LEFT JOIN troovix_posts wp ON wp.ID = pm.post_id
                        WHERE (wp.post_status = 'publish')
                        AND meta_key='%s' 
                        AND post_id in ($post_ids_array_placeholders)", $prepare_values
			);
		} else {
			$query_result = $wpdb->prepare(
				"SELECT max(cast(meta_value as decimal(8, 2))) 
                        FROM troovix_postmeta pm
                        LEFT JOIN troovix_posts wp ON wp.ID = pm.post_id
                        WHERE (wp.post_status = 'publish')
                        AND meta_key='%s'", $meta_key
			);
		}

		$the_max = $wpdb->get_var( $query_result );

		return $the_max;
	}

	static function selectMinMetaValue( $meta_key, $post_ids_array = null ) {
		global $wpdb;

		if ( ! empty( $post_ids_array ) ) {
			$post_ids_array_placeholders = implode( ', ', array_fill( 0, count( $post_ids_array ), '%d' ) );
			$prepare_values              = array_merge( array( $meta_key ), $post_ids_array );
			$query_result                = $wpdb->prepare(
				"SELECT min(cast(meta_value as decimal(8, 2))) FROM troovix_postmeta pm
                        LEFT JOIN troovix_posts wp ON wp.ID = pm.post_id
                        WHERE (wp.post_status = 'publish')
                        AND meta_key='%s' 
                        AND post_id in ($post_ids_array_placeholders)", $prepare_values
			);
		} else {
			$query_result = $wpdb->prepare(
				"SELECT min(cast(meta_value as decimal(8, 2))) FROM troovix_postmeta pm
                        LEFT JOIN troovix_posts wp ON wp.ID = pm.post_id
                        WHERE (wp.post_status = 'publish')
                        AND meta_key='%s'", $meta_key
			);
		}


		$the_min = $wpdb->get_var( $query_result );

		return $the_min;
	}

	/**
	 * @param WP_Query $query
	 * @param array $new_meta_query
	 * @param string $relation
	 */
	static function appendMetaQuery( $query, $new_meta_query, $relation = 'AND' ) {
		$current_meta_query = $query->get( 'meta_query' );

		//if we already have a different filter actvaited with tax query, append the new one
		if ( ! empty( $current_meta_query ) ) {
			$current_meta_query[]           = $new_meta_query;
			$current_meta_query['relation'] = $relation;
			$query->set( 'meta_query', $current_meta_query );
		} //if no previous tax query present
		else {
			$new_meta_query = [ $new_meta_query ];
			$query->set( 'meta_query', $new_meta_query );
		}

	}

	/**
	 * @param WP_Query $query
	 * @param $new_tax_query
	 * @param string $relation
	 */
	static function appendTaxQuery( $query, $new_tax_query, $relation = 'AND' ) {
		$query->tax_query->queries[]                = $new_tax_query;
		$query->query_vars['tax_query']             = $query->tax_query->queries;
		$query->query_vars['tax_query']['relation'] = $relation;
	}

	static function getIdsArrayFromQuery( $query ) {
		return array_column( $query->posts, 'ID' );
	}

	static function queryIsOptimized( $query ) {
		return $query->query_vars['optimize'] ?? false;
	}

	static function removeHttp( $url ) {
		$disallowed = array( 'http://', 'https://' );
		foreach ( $disallowed as $d ) {
			if ( strpos( $url, $d ) === 0 ) {
				return str_replace( $d, '', $url );
			}
		}

		return $url;
	}


	static function getPostSlug( $post_id ) {
		return get_post_field( 'post_name', $post_id );
	}

	static function getPostName( $post_id ) {
		return get_post_field( 'post_title', $post_id );
	}

	public static function searchIsActive() {
		$search_active = isset( $_GET['search'] ) && strlen( $_GET['search'] ) > 0;

		return $search_active;
	}


	public static function unsetArrayElementByValue( $val, $arr ) {
		if ( ( $key = array_search( $val, $arr ) ) !== false ) {
			unset( $arr[ $key ] );
		}

		return $arr;
	}

	public static function unsetAllArrayElementByValue( $val, $arr ) {

		foreach ( $arr as $item ) {
			if ( $item === $val ) {
				$key = array_search( $val, $arr );
				unset( $arr[ $key ] );
			}
		}

		return $arr;
	}

	public static $products_query_for_look_images = null;

	public static function redirectHome() {
		wp_redirect( home_url() );
		exit;
	}

	//have to use & so we pass array by reference, not by copying it
	public static function removeItemFromArray( $item, &$array ) {
		$key = array_search( $item, $array );
		//remove the current product from list of related products
		unset( $array[ $key ] );
	}

	/**
	 * Get all the registered image sizes along with their dimensions (default and additional ones)
	 *
	 * @return array $image_sizes The image sizes
	 * @global array $_wp_additional_image_sizes
	 *
	 */
	public static function getAllImageSizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = get_intermediate_image_sizes();

		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ]['width']  = intval( get_option( "{$size}_size_w" ) );
			$image_sizes[ $size ]['height'] = intval( get_option( "{$size}_size_h" ) );
			$image_sizes[ $size ]['crop']   = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
		}

		if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return $image_sizes;
	}

	public static function removeAllWhitespaceFromString( $string ) {
		return str_replace( ' ', '', $string );
	}

	public static function wpmlLinkMaintainingLanguage( $page_slug ) {
        return apply_filters( 'wpml_permalink', site_url($page_slug), ICL_LANGUAGE_CODE );
	}

	public static function isWPMLLangSet( $lang ) {
		if ( defined( 'ICL_LANGUAGE_CODE' ) && ! empty( ICL_LANGUAGE_CODE ) ) {
			if ( ICL_LANGUAGE_CODE === $lang ) {
				return true;
			}
		}

		return false;

	}

	public static function wpmlGetCurrentLanguage(  ) {
		if ( defined( 'ICL_LANGUAGE_CODE' ) && ! empty( ICL_LANGUAGE_CODE ) ) {
			return ICL_LANGUAGE_CODE;
		}

		return '';

	}



	public static function generateUniqueID( $prefix = 'id-' ) {
		return uniqid( $prefix );
	}


}
