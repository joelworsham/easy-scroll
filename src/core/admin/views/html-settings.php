<?php
/**
 * View for the Easy Scroll settings page.
 *
 * @since 0.2.0
 * @package EasyScroll
 * @subpackage EasyScroll\Admin\Views
 */

// Don't load this file directly
if ( ! defined( 'ABSPATH' ) ) {
	die;
}
?>

	<h2>EasyScroll Settings</h2>

	<!--suppress HtmlUnknownTarget -->
	<form method="post" action="options.php" class="easy-scroll-settings">
		<?php
		// Prepare settings
		settings_fields( 'easy_scroll' );
		?>

		<h3>Display</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_post_count">Post Count</label>
				</th>
				<td>
					<input type="text" name="easy_scroll_post_count" id="easy_scroll_post_count"
					       value="<?php echo $this->options['post_count']; ?>"/>

					<p class="description">Number of posts to load each time</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_window_offset">Window Offset</label>
				</th>
				<td>
					<input type="text" name="easy_scroll_window_offset" id="easy_scroll_window_offset"
					       value="<?php echo $this->options['window_offset']; ?>"/>

					<p class="description">Numer (in pixels), from the bottom of the screen, that user must scroll to
						for
						new posts to load.</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_inject_location">Inject Location ID</label>
				</th>
				<td>
					<input type="text" name="easy_scroll_inject_location" id="easy_scroll_inject_location"
					       value="<?php echo $this->options['inject_location']; ?>"/>

					<p class="description">The <strong>ID</strong> of the element posts should be appended inside of.
					</p>

					<p class="description"><b>Example:</b> If you use "content", the posts will be placed inside the
						"#content" element, at the end.</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_post_container">Post Container CLASS</label>
				</th>
				<td>
					<input type="text" name="easy_scroll_post_container" id="easy_scroll_post_container"
					       value="<?php echo $this->options['post_container']; ?>"/>

					<p class="description">The <strong>CLASS</strong> of each post's container element (REQUIRED).</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_home">Use on Home Page</label>
				</th>
				<td>
					<input type="hidden" name="easy_scroll_home" value=""/>
					<input type="checkbox" name="easy_scroll_home" id="easy_scroll_home"
					       value="1" <?php checked( $this->options['home'], 1 ); ?> />
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_pages">Pages to use on</label>
				</th>
				<td>
					<input type="text" name="easy_scroll_pages" id="easy_scroll_pages"
					       value="<?php echo $this->options['pages']; ?>"/>

					<p class="description">Comma delimited list of page/post ID's to use EasyScroll on.</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_template">Content Template</label>
				</th>
				<td>
					<textarea name="easy_scroll_template" id="easy_scroll_template"
					          style="width: 500px; max-width: 100%;"
					          rows="20"><?php echo $this->options['template']; ?></textarea>

					<div id="template-variable-help">
						<h3>Available Template Variables</h3>
						<table>
							<tr>
								<td>{TITLE}</td>
								<td>The post title</td>
							</tr>
							<tr>
								<td>{LINK}</td>
								<td>The post link</td>
							</tr>
							<tr>
								<td>{CONTENT}</td>
								<td>The post content</td>
							</tr>
							<tr>
								<td>{META}</td>
								<td>The post meta information</td>
							</tr>
							<tr>
								<td>{META:FNAME}</td>
								<td>The post author first name</td>
							</tr>
							<tr>
								<td>{META:LNAME}</td>
								<td>The post author last name</td>
							</tr>
							<tr>
								<td>{META:DATE}</td>
								<td>The post publish date</td>
							</tr>
							<tr>
								<td>{FEATUREDIMAGE}</td>
								<td>The post featured image</td>
							</tr>
							<tr>
								<td>{FEATUREDIMAGE:THUMB}</td>
								<td>The post featured image in thumbnail size</td>
							</tr>
							<tr>
								<td>{FEATUREDIMAGE:MEDIUM}</td>
								<td>The post featured image in medium size</td>
							</tr>
							<tr>
								<td>{FEATUREDIMAGE:LARGE}</td>
								<td>The post featured image in large size</td>
							</tr>
							<tr>
								<td>{FEATUREDIMAGE:FULL}</td>
								<td>The post featured image in full size</td>
							</tr>
							<tr>
								<td>{EDITPOST}</td>
								<td>The edit post link</td>
							</tr>
						</table>
					</div>
					<!--#template-variable-help-->
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_footer">Show Footer</label>
				</th>
				<td>
					<input type="hidden" name="easy_scroll_footer" value=""/>
					<input type="checkbox" name="easy_scroll_footer" id="easy_scroll_footer"
					       value="true" <?php checked( $this->options['footer'], 'true' ); ?> />
				</td>
			</tr>
		</table>

		<h3>Loading Image</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_loader">Loader</label>
				</th>
				<td>
					<p class="description">Loader to display when loading new posts</p>
					<select name="easy_scroll_loader" onchange="easy_scroll_loader_image(this)"
					        style="vertical-align: top;">
						<option value="alternative" <?php selected( 'alternative', $this->options['loader'] ); ?>>Alternative
						</option>
						<option
							value="appearing_squares" <?php selected( 'appearing_squares', $this->options['loader'] ); ?>>
							Appearing Squares
						</option>
						<option value="balls" <?php selected( 'balls', $this->options['loader'] ); ?>>Balls</option>
						<option value="floating_rays" <?php selected( 'floating_rays', $this->options['loader'] ); ?>>
							Floating
							Rays
						</option>
						<option value="in_circle" <?php selected( 'in_circle', $this->options['loader'] ); ?>>In Circle
						</option>
						<option value="moving_line" <?php selected( 'moving_line', $this->options['loader'] ); ?>>Moving Line
						</option>
						<option value="pulse" <?php selected( 'pulse', $this->options['loader'] ); ?>>Pulse</option>
						<option value="triplex" <?php selected( 'triplex', $this->options['loader'] ); ?>>Triplex</option>
						<option value="ventiliator" <?php selected( 'ventiliator', $this->options['loader'] ); ?>>Ventiliator
						</option>
						<option value="wings" <?php selected( 'wings', $this->options['loader'] ); ?>>Wings</option>
					</select>

					<img id="easy-scroll-loader"
					     src="<?php echo EASYSCROLL_URL . 'assets/img/loaders/' . $this->options['loader']; ?>.gif"
					     style="max-height: <?php echo $this->options['loader_height']; ?>px; max-width: <?php echo $this->options['loader_width']; ?>px; opacity: <?php echo $this->options['loader_opacity']; ?>;"/>

					<h4>Loader Style Attributes</h4>

					<p>
						<input type="text" name="easy_scroll_loader_width" id="easy_scroll_loader_width"
						       value="<?php echo $this->options['loader_width']; ?>"
						       onchange="easy_scroll_loader_styles();"/>
						<span class="description">Max Width (in pixels)</span><br/>
						<span class="description">Largest possible = 130px</span><br/>

						<input type="text" name="easy_scroll_loader_height" id="easy_scroll_loader_height"
						       value="<?php echo $this->options['loader_height']; ?>"
						       onchange="easy_scroll_loader_styles();"/>
						<span class="description">Max Height (in pixels)</span><br/>
						<span class="description">Largest possible = 130px</span>
					</p>

					<p>
						<input type="text" name="easy_scroll_loader_opacity" id="easy_scroll_loader_opacity"
						       value="<?php echo $this->options['loader_opacity']; ?>"
						       onchange="easy_scroll_loader_styles();"/>
						<span class="description">Opacity</span><br/>
						<span class="description">Values between 0.0 - 1.0</span>
					</p>
				</td>
			</tr>
		</table>

		<h3>Order Properties</h3>
		<table class="form-table">
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_post_type">Post Type</label>
				</th>
				<td>
					<select name="easy_scroll_post_type">
						<?php
						$post_types = get_post_types();
						foreach ( $post_types as $type ): {
							?>
							<option
								value="<?php echo $type; ?>" <?php selected( $type, $this->options['post_type'] ); ?> ><?php echo ucwords( $type ); ?></option>
						<?php } endforeach; ?>
					</select>

					<p class="description">Post type to load</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_post_order">Order Direction</label>
				</th>
				<td>
					<select name="easy_scroll_post_order">
						<option value="DSC" <?php selected( 'DSC', $this->options['post_order'] ); ?> >DSC</option>
						<option value="ASC" <?php selected( 'ASC', $this->options['post_order'] ); ?> >ASC</option>
					</select>

					<p class="description">Direction to load posts from</p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row">
					<label for="easy_scroll_post_order">Order By</label>
				</th>
				<td>
					<select name="easy_scroll_post_order" onchange="easy_scroll_meta_value(this)">
						<option value="date" <?php selected( 'date', $this->options['post_order'] ); ?> >Date</option>
						<option value="ID" <?php selected( 'ID', $this->options['post_order'] ); ?> >ID</option>
						<option value="author" <?php selected( 'author', $this->options['post_order'] ); ?> >Author</option>
						<option value="title" <?php selected( 'title', $this->options['post_order'] ); ?> >Title</option>
						<option value="name" <?php selected( 'name', $this->options['post_order'] ); ?> >Name</option>
						<option value="parent" <?php selected( 'parent', $this->options['post_order'] ); ?> >Parent</option>
						<option value="modified" <?php selected( 'modified', $this->options['post_order'] ); ?> >Last
							Modified
						</option>
						<option value="rand" <?php selected( 'rand', $this->options['post_order'] ); ?> >Random</option>
						<option value="menu_order" <?php selected( 'menu_order', $this->options['post_order'] ); ?> >Menu
							Order
						</option>
						<option value="meta_value" <?php selected( 'meta_value', $this->options['post_order'] ); ?> >Meta
							Value
						</option>
						<option value="meta_value_num" <?php selected( 'meta_value_num', $this->options['post_order'] ); ?> >
							Meta
							Value (Number)
						</option>
					</select>

					<p class="description">What to order the posts by</p>
				</td>
			</tr>
			<tr valign="top" id="easy-scroll-meta-value">
				<th scope="row">
					<label for="easy_scroll_meta_val">Meta Value to Order By</label>
				</th>
				<td>
					<input type="text" name="easy_scroll_meta_val" id="easy_scroll_meta_val"
					       value="<?php echo $this->options['meta_val']; ?>"/>

					<p class="description">The custom meta value to order by</p>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
<?php