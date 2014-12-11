<?php
/**
 * Responsible for the output of each post in the infinite scroll.
 *
 * @since      0.2.0
 * @package    EasyScroll
 * @subpackage EasyScroll\Frontend\Post
 */
namespace EasyScroll\Frontend\Post;

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Class Post
 *
 * This class is used to build the output of each post in the feed based on user defined parameters.
 *
 * @since      0.2.0
 * @package    EasyScroll\
 * @subpackage EasyScroll\FrontEnd\Post
 * @author     Joel Worsham <joelworsham@gmail.com>
 */
class Post {

	/**
	 * The post ID.
	 *
	 * @since 0.1
	 */
	public $ID;

	/**
	 * The main class output.
	 *
	 * @since 0.1
	 */
	private $output;

	/**
	 * The user-defined template used to construct the post(s).
	 *
	 * @since 0.1
	 */
	private $template;

	/**
	 * The post title.
	 *
	 * @since 0.1
	 */
	public $title;

	/**
	 * The post link.
	 *
	 * @since 0.1
	 */
	public $link;

	/**
	 * The content of the post.
	 *
	 * @since 0.1
	 */
	public $content;

	/**
	 * The post's featured image.
	 *
	 * @since 0.1
	 */
	public $featuredimage;

	/**
	 * The post's featured image in a thumbnail size.
	 *
	 * @since 0.1
	 */
	public $featuredimage_thumb;

	/**
	 * The post's featured image in a medium size.
	 *
	 * @since 0.1
	 */
	public $featuredimage_medium;

	/**
	 * The post's featured image in a large size.
	 *
	 * @since 0.1
	 */
	public $featuredimage_large;

	/**
	 * The post's featured image in a full size.
	 *
	 * @since 0.1
	 */
	public $featuredimage_full;

	/**
	 * The complete meta of the post.
	 *
	 * @since 0.1
	 */
	public $meta;

	/**
	 * The post author's first name.
	 *
	 * @since 0.1
	 */
	public $meta_fname;

	/**
	 * The post author's last name.
	 *
	 * @since 0.1
	 */
	public $meta_lname;

	/**
	 * The post's publish date.
	 *
	 * @since 0.1
	 */
	public $meta_date;

	/**
	 * The edit post link.
	 *
	 * @since 0.1
	 */
	public $editpost;

	/**
	 * Construct the post.
	 *
	 * @since 0.1
	 *
	 * @param $post_ID int The ID of the post to construct.
	 */
	public function __construct( $post_ID ) {

		$this->ID       = $post_ID;
		$this->template = get_option( 'easy_scroll_template', EasyScroll_Admin::$option_defaults['template'] );

		$this->prepare_template_variables();
		$this->prepare_output();
		$this->output_post();
	}

	/**
	 * Gather all possible template variables.
	 *
	 * When a user creates a template, the user can define various
	 * pre-defined variables for displaying specific content. This
	 * function prepares values for all possible variables.
	 *
	 * @since 0.1
	 */
	private function prepare_template_variables() {
		// {TITLE}
		$this->title = get_the_title( $this->ID );

		// {LINK}
		$this->link = get_permalink( $this->ID );

		// {CONTENT}
		$post          = get_post( $this->ID );
		$this->content = wpautop( $post->post_content );

		// {FEATUREDIMAGE}
		$this->featuredimage = get_the_post_thumbnail( $this->ID, 'medium' );
		// {FEATUREDIMAGE:THUMB}
		$this->featuredimage_thumb = get_the_post_thumbnail( $this->ID, 'thumbnail' );
		// {FEATUREDIMAGE:MEDIUM}
		$this->featuredimage_medium = get_the_post_thumbnail( $this->ID, 'medium' );
		// {FEATUREDIMAGE:LARGE}
		$this->featuredimage_large = get_the_post_thumbnail( $this->ID, 'large' );
		// {FEATUREDIMAGE:FULL}
		$this->featuredimage_full = get_the_post_thumbnail( $this->ID, 'full' );

		// {META}
		$author_ID   = get_post_field( 'post_author', $this->ID );
		$author_name = get_the_author_meta( 'first_name', $author_ID ) . ' ' . get_the_author_meta( 'last_name', $author_ID );

		// If author has no name set, use username
		if ( $author_name == ' ' ) $author_name = get_the_author_meta( 'display_name', $author_ID );

		$author_link = get_the_author_meta( 'user_url', $author_ID );
		$this->meta  = 'Posted on ' . get_the_time( get_option( 'date_format' ), $this->ID ) . ' by <a href="' . $author_link . '">' . $author_name . '</a>';
		// {META:FNAME}
		$this->meta_fname = get_the_author_meta( 'first_name', $author_ID );
		// {META:LNAME}
		$this->meta_lname = get_the_author_meta( 'last_name', $author_ID );
		// {META:DATE}
		$this->meta_date = get_the_time( get_option( 'date_format' ), $this->ID );

		// {EDITPOST}
		// Only show if logged in
		if ( is_user_logged_in() )
			$this->editpost = '<a href="' . get_edit_post_link( $this->ID ) . '">Edit This</a>';
		else
			$this->editpost = '';
	}

	/**
	 * Prepare the output.
	 *
	 * Parses through the template and replaces all pre-defined
	 * template variables with the prepared content
	 *
	 * @since 0.1
	 */
	private function prepare_output() {
		$this->output = str_replace( '{CONTENT}', $this->content, $this->template );
		$this->output = str_replace( '{TITLE}', $this->title, $this->output );
		$this->output = str_replace( '{LINK}', $this->link, $this->output );
		$this->output = str_replace( '{META}', $this->meta, $this->output );
		$this->output = str_replace( '{META:FNAME}', $this->meta_fname, $this->output );
		$this->output = str_replace( '{META:LNAME}', $this->meta_lname, $this->output );
		$this->output = str_replace( '{META:DATE}', $this->meta_date, $this->output );
		$this->output = str_replace( '{FEATUREDIMAGE}', $this->featuredimage, $this->output );
		$this->output = str_replace( '{FEATUREDIMAGE:THUMB}', $this->featuredimage_thumb, $this->output );
		$this->output = str_replace( '{FEATUREDIMAGE:MEDIUM}', $this->featuredimage_medium, $this->output );
		$this->output = str_replace( '{FEATUREDIMAGE:LARGE}', $this->featuredimage_large, $this->output );
		$this->output = str_replace( '{FEATUREDIMAGE:FULL}', $this->featuredimage_full, $this->output );
		$this->output = str_replace( '{EDITPOST}', $this->editpost, $this->output );
	}

	/**
	 * Outputs HTML of the post(s) content.
	 *
	 * Parses through the template and replaces all pre-defined
	 * template variables with the prepared content
	 *
	 * @since 0.1
	 */
	public function output_post() {
		echo '<div class="' . get_option( 'easy_scroll_post_container', EasyScroll_Admin::$option_defaults['post_container'] ) . '">';

		echo $this->output;

		echo '</div>';
	}
}