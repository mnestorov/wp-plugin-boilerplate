<?php

/**
 * Class Plugin_Name_Register_Taxonomies
 * 
 * Register the taxonomies for the post type.
 * 
 * @link       http://devrix.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes/classes
 * @author     DevriX <contact@devrix.com>
 */
class Plugin_Name_Register_Taxonomies {
    /**
     * Register the `Size` taxonomy.
     *
     * @return void
     */
    public function register_size_taxonomy() {
        /**
         * Taxonomy: Sizes
         */
        $labels = array(
            'name'                  => __('Sizes', 'load_plugin_textdomain'),
            'singular_name'         => __('Size', 'load_plugin_textdomain'),
            'add_new_item'          => __('Add New Size', 'load_plugin_textdomain'),
            'choose_from_most_used' => __('Choose from the most common sizes', 'load_plugin_textdomain'),
            'items_list_navigation' => __('Browse Business by size', 'load_plugin_textdomain'),
        );

        $args = array(
            'label'                 => __('Sizes', 'load_plugin_textdomain'),
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'query_var'             => true,
            'rewrite'               =>
            array(
                'slug'       => 'size',
                'with_front' => true,
            ),
            'show_admin_column'     => true,
            'show_in_rest'          => true,
            'show_tagcloud'         => false,
            'rest_base'             => 'size',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'show_in_quick_edit'    => true,
            'show_in_graphql'       => false,
        );

        // Associate post types.
        $post_types = array('business');

        register_taxonomy('size', $post_types, $args);
    }

    /**
     * Register `location` taxonomy.
     *
     * @return void
    */
    public function register_location_taxonomy() {
        /**
         * Taxonomy: Location
         */
        $labels = array(
            'name'                  => __('Locations', 'load_plugin_textdomain'),
            'singular_name'         => __('Location', 'load_plugin_textdomain'),
            'add_new_item'          => __('Add New Location', 'load_plugin_textdomain'),
        );

        $args = array(
            'label'                 => __('Locations', 'load_plugin_textdomain'),
            'labels'                => $labels,
            'public'                => true,
            'publicly_queryable'    => true,
            'hierarchical'          => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'query_var'             => true,
            'rewrite'               =>
            array(
                'hierarchical' => true,
                'with_front'   => true,
            ),
            'show_admin_column'     => true,
            'show_in_rest'          => true,
            'show_tagcloud'         => false,
            'rest_base'             => 'location',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
            'show_in_quick_edit'    => true,
            'show_in_graphql'       => false,
        );

        // Associate post types.
        $post_types = array('business', 'event');

        register_taxonomy('location', $post_types, $args);
    }
}
