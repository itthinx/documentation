<?php
/**
 * class-documentation-add-ons.php
 *
 * Copyright (c) 2013 "kento" Karim Rahimpur www.itthinx.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Karim Rahimpur
 * @package documentation
 * @since documentation 1.5.0
 */

/**
 * Shows the recommended plugins and add-ons.
 */
class Documentation_Add_Ons {

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ) );
	}

	/**
	 * Adds the Add Ons menu item to the Documentation menu.
	 */
	public static function admin_menu() {
		add_submenu_page(
			add_query_arg( array( 'post_type' => 'document' ), 'edit.php' ),
			__( 'Add-Ons', 'widgets-control' ),
			__( 'Add-Ons', 'widgets-control' ),
			'edit_posts', // @todo ???
			'documentation-add-ons',
			array( __CLASS__, 'render_admin' )
		);
	}
	
	public static function render_admin() {
		self::add_ons_content();
	}
	
	
	/**
	 * Renders the content of the Add-Ons section.
	 *
	 * @param $params array of options (offset is 0 by default and used to adjust heading h2)
	 */
	public static function add_ons_content( $params = array( 'offset' => 0 ) ) {
		
		$d = intval( $params['offset'] );
		$h2 = sprintf( 'h%d', 2+$d );
		
		echo "<$h2>";
		echo __( 'Recommended Tools and Extensions', 'documentation' );
		echo "</$h2>";
		
		$entries = array(
				'groups' => array(
						'title'   => 'Groups',
						'content' => 'Groups is designed as an efficient, powerful and flexible solution for group-oriented memberships and content access control. Use it to control who can view documents and more.',
						'image'   => DOCUMENTATION_PLUGIN_URL . 'images/add-ons/groups.png',
						'url'     => 'https://wordpress.org/plugins/groups/',
						'index'   => 100
				),
				'search-live' => array(
						'title'   => 'Search Live',
						'content' => 'Search Live supplies effective integrated live search facilities and advanced search features. Makes it really easy to find the desired documents.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/search-live.png',
						'url'     => 'https://wordpress.org/plugins/search-live/',
						'index'   => 100
				),
				'widgets-control' => array(
						'title'   => 'Widgets Control',
						'content' => 'Widgets Control is a toolbox that features visibility management for all widgets, sidebars, sections of content and content blocks. This is very useful to show document-specific content and widgets.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/widgets-control.png',
						'url'     => 'https://wordpress.org/plugins/search-live/',
						'index'   => 100
				),
				'decent-comments' => array(
						'title'   => 'Decent Comments',
						'content' => 'Decent Comments shows what people say. If you want to show comments along with their author’s avatars and an excerpt of their comment, then this is the right plugin for you. Use it to show comments posted on documents only or including them.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/decent-comments.png',
						'url'     => 'https://wordpress.org/plugins/decent-comments/',
						'index'   => 100
				),
				'open-graph-protocol-framework' => array(
						'title'   => 'Open Graph Protocol Framework',
						'content' => 'The Open Graph protocol enables any web page to become a rich object in a social graph. For instance, this is used on Facebook to allow any web page to have the same functionality as any other object on Facebook. This will automate the process of adding basic and optional metadata to documents.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/open-graph-protocol-framework.png',
						'url'     => 'https://wordpress.org/plugins/open-graph-protocol-framework/',
						'index'   => 100
				),
				'woocommerce-documentation' => array(
						'title'   => 'WooCommerce Documentation',
						'content' => 'This extension for WooCommerce and the Documentation plugin for WordPress allows to link documentation pages to products and display them automatically on the product pages.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/woocommerce-documentation.png',
						'url'     => 'http://www.itthinx.com/shop/woocommerce-documentation/',
						'index'   => 10
				),
				'widgets-control-pro' => array(
						'title'   => 'Widgets Control Pro',
						'content' => 'An advanced Widget toolbox that adds visibility management and helps to control where widgets are shown efficiently. Show or hide widgets based on a user’s group membership.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/widgets-control-pro.png',
						'url'     => 'http://www.itthinx.com/shop/widgets-control-pro/',
						'index'   => 20
				),
		);
		usort( $entries, array( __CLASS__, 'add_ons_sort' ) );
		
		echo '<ul class="add-ons">';
		foreach( $entries as $key => $entry ) {
			echo '<li class="add-on">';
			echo sprintf( '<a href="%s">', $entry['url'] );
			echo '<h3>';
			echo sprintf( '<img src="%s"/>', $entry['image'] );
			echo $entry['title'];
			echo '</h3>';
			echo '<p>';
			echo $entry['content'];
			echo '</p>';
			echo '</a>';
			echo '</li>'; // .add-on
		}
		echo '</ul>'; // .add-ons
		
		echo "<$h2>";
		printf( __( 'More from <a href="%s">itthinx</a>', 'documentation' ), esc_attr( 'https://www.itthinx.com/' ) );
		echo "</$h2>";
		
		$entries = array(
				'affiliates' => array(
						'title'   => 'Affiliates',
						'content' => 'The free Affiliates system provides powerful tools to maintain an Affiliate Marketing Program.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/affiliates-pro.png',
						'url'     => 'http://www.itthinx.com/shop/affiliates-pro/',
						'index'   => 100
				),
				'affiliates-pro' => array(
						'title'   => 'Affiliates Pro',
						'content' => 'Boost Sales with the best Affiliate Marketing for your WordPress site.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/affiliates-pro.png',
						'url'     => 'http://www.itthinx.com/shop/affiliates-pro/',
						'index'   => 200
				),
				'affiliates-enterprise' => array(
						'title'   => 'Affiliates Enterprise',
						'content' => 'Affiliates Enterprise provides an even more advanced affiliate management system for sellers, shops and developers, who want to boost sales with their own affiliate program. Features affiliate campaigns, tracking pixels and multiple tiers.',
						'image'   => DOCUMENTATION_PLUGIN_URL. 'images/add-ons/affiliates-enterprise.png',
						'url'     => 'http://www.itthinx.com/shop/affiliates-enterprise/',
						'index'   => 300
				),
		);
		usort( $entries, array( __CLASS__, 'add_ons_sort' ) );
		
		echo '<ul class="add-ons">';
		foreach( $entries as $key => $entry ) {
			echo '<li class="add-on">';
			echo sprintf( '<a href="%s">', $entry['url'] );
			echo '<h3>';
			echo sprintf( '<img src="%s"/>', $entry['image'] );
			echo $entry['title'];
			echo '</h3>';
			echo '<p>';
			echo $entry['content'];
			echo '</p>';
			echo '</a>';
			echo '</li>'; // .add-on
		}
		echo '</ul>'; // .add-ons
	}
	
	function add_ons_sort( $e1, $e2 ) {
		$i1 = isset( $e1['index'] ) ? $e1['index'] : 0;
		$i2 = isset( $e2['index'] ) ? $e2['index'] : 0;
		$t1 = isset( $e1['title'] ) ? $e1['title'] : '';
		$t2 = isset( $e2['title'] ) ? $e2['title'] : '';
		
		return $i1 - $i2 + strnatcmp( $t1, $t2 );
	}
	
}
Documentation_Add_Ons::init();
