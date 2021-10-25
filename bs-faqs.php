<?php
/*
Plugin Name: bootScore FAQ's
Plugin URI:
Description: Build vertically collapsing accordions in combination.
Version: 1.0.0
Author: norico
Author URI: https://github.com/norico/bs-faqs
Domain Path: /languages
Text Domain: bs-faqs
RequiresWP: 5.6
License: GPL2
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class BSFAQS {
    public function __construct()
    {
        add_action( 'plugins_loaded', array( &$this, 'loadTextDomain' ) );
        $this->register_custom_post_type();
    }

    public function loadTextDomain() {
        load_plugin_textdomain( 'bs-faqs', false, basename( dirname( __FILE__ ) ) . '/languages' );
    }

    private function register_custom_post_type()
    {
        add_action('init', [$this, 'create_post_type']);
    }


    public function create_post_type()
    {
        $labels = array(
            "name"                  => __( "FAQs", "bs-faqs" ),
            "singular_name"         => __( "FAQ", "bs-faqs" ),
            "menu_name"             => __( "FAQ", "bs-faqs" ),
            "all_items"             => __( "Questions", "bs-faqs" ),
            "add_new"               => __( "Add New", "bs-faqs" ),
            "add_new_item"          => __( "Add New Question", "bs-faqs" ),
            "edit_item"             => __( "Edit  Question", "bs-faqs" ),
            "new_item"              => __( "New  Question", "bs-faqs" ),
            "view_item"             => __( "View  Question", "bs-faqs" ),
            "view_items"            => __( "View  Questions", "bs-faqs" ),
            "search_items"          => __( "Search Question", "bs-faqs" ),
            "not_found"             => __( "Empty", "bs-faqs" ),
            "not_found_in_trash"    => __( "Trash is empty", "bs-faqs" ),
            "parent_item_colon"     => __( "Parent", "bs-faqs" ),
            "featured_image"        => __( "Featured Image", "bs-faqs" ),
            "set_featured_image"    => __( "Set Featured Image", "bs-faqs" ),
            "remove_featured_image" => __( "Remove Featured Image", "bs-faqs" ),
            "use_featured_image"    => __( "Use Featured Image", "bs-faqs" ),
            "archives"              => __( "Archives", "bs-faqs" ),
            "insert_into_item"      => __( "Insert into item", "bs-faqs" ),
            "uploaded_to_this_item" => __( "Uploaded to this Item", "bs-faqs" ),
            "filter_items_list"     => __( "Filter Items List", "bs-faqs" ),
            "items_list_navigation" => __( "Items List Navigation", "bs-faqs" ),
            "items_list"            => __( "Items List", "bs-faqs" ),
            "attributes"            => __( "Attributes", "bs-faqs" )
        );
        $args = array(
            "label"                 => __( "FAQs", "bs-faqs" ),
            "labels"                => $labels,
            "description"           => "Frequently Ask Questions",
            "public"                => true,
            "publicly_queryable"    => true,
            "show_ui"               => true,
            "show_in_rest"          => true,
            "rest_base"             => "FAQS",
            "has_archive"           => false,
            "show_in_menu"          => true,
            "show_in_nav_menus"     => true,
            "exclude_from_search"   => false,
            "capability_type"       => "post",
            "map_meta_cap"          => true,
            "hierarchical"          => false,
            "rewrite"               => array( "slug" => "faqs", "with_front" => true ),
            "query_var"             => false,
            "menu_position"         => 100,
            'show_in_nav_menus'     => false,
            "menu_icon"             => "dashicons-text-page",
            "supports"              => array( "title", "editor", "revisions", "author", "page-attributes" ),
        );
        register_post_type( "bs-faqs", $args );
    }
}
$faq = new BSFAQS();

add_shortcode( 'bs-faqs', 'bs_faqs_archives_page' );
function bs_faqs_archives_page($atts)
{
    $attributes = shortcode_atts( array(
        'class' => '',
    ), $atts );
    if ( locate_template('archive-faqs.php') )
    {
        $template = get_template_part('archive-faqs');
    }
    else {
        $template = load_template(plugin_dir_path(__FILE__).'/archive-faqs.php', true, $attributes );
    }
    return $template;
}
