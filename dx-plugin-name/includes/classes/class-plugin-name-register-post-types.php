<?php

/**
 * Class Plugin_Name_Register_Post_Types
 * 
 * Register the custom post type.
 * 
 * @link       http://devrix.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes/classes
 * @author     DevriX <contact@devrix.com>
 */
class Plugin_Name_Register_Post_Types {
    /**
     * Register the 'Business' post type.
     *
     * @return void
     */
    public function register_business_type() {
        /**
         * Post Type: Businesses
         */
        $labels = array(
            'name'                  => __('Businesses', 'load_plugin_textdomain'),
            'singular_name'         => __('Business', 'load_plugin_textdomain'),
            'add_new'               => __('Add New Business', 'load_plugin_textdomain'),
            'add_new_item'          => __('Add New Business', 'load_plugin_textdomain'),
            'search_items'          => __('Find a Business', 'load_plugin_textdomain'),
            'featured_image'        => __('Business Logo', 'load_plugin_textdomain'),
            'set_featured_image'    => __('Set Business Logo', 'load_plugin_textdomain'),
            'remove_featured_image' => __('Remove Logo', 'load_plugin_textdomain'),
            'use_featured_image'    => __('Use Logo', 'load_plugin_textdomain'),
            'archives'              => __('Business Directory', 'load_plugin_textdomain'),
        );

        $args = array(
            'label'                 => __('Businesses', 'load_plugin_textdomain'),
            'labels'                => $labels,
            'description'           => '',
            'public'                => true,
            'publicly_queryable'    => true,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'rest_base'             => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'has_archive'           => 'businesses',
            'show_in_menu'          => true,
            'show_in_nav_menus'     => true,
            'delete_with_user'      => false,
            'exclude_from_search'   => false,
            'capability_type'       => 'post',
            'map_meta_cap'          => true,
            'hierarchical'          => false,
            'rewrite'               =>
            array(
                'slug'       => 'business',
                'with_front' => true,
            ),
            'query_var'             => true,
            'menu_icon'             => 'dashicons-building',
            'supports'              => array('title', 'editor', 'thumbnail'),
            'taxonomies'            => array('post_tag'),
            'show_in_graphql'       => false,
        );

        register_post_type( 'business', $args );
    }
}
