<?php
/**
 * @file
 * ttad's theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $content: The markup content of the header region. This will be a series
 *   of blocks. Typically it's just the search block.
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity: (These are applied in template.php)
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */  ?>

<?php /* MOBILE MENU NAVBAR: a secondary menu intended for devices with with narrow screens. */?>
<div id="page" class="hfeed" role="main">

  <?php /* Header */?>
  <header id="branding" role="banner" class="row">
    <div class="columns twelve">
    	<?php if ($page['header']): ?>
    	  <?php print render($page['header']); ?>
    	<?php endif; ?>
    </div>
  </header>

  <?php /* Main Row */?>
  <div id="main" class="row">

      <?php /* Content Region */?>
      <div id="content"  role="main">
          <?php if ($page['highlighted']): ?>
            <?php print render($page['highlighted']); ?>
          <?php endif;
          if ($title): ?>
            <div class="page-title">
            	<h1 id="page-title"><?php print $title; ?></h1>
            </div>
          <?php endif;
          if ($tabs['#primary'] != ""): ?>
            <div class="drupal_tabs"><?php print render($tabs); ?></div>
          <?php endif;
          print render($page['help']);
          print $messages;
          if ($action_links): ?>
            <dl class="sub-nav action-links"><?php print render($action_links); ?></dl>
          <?php endif; ?>
      	<div class="content-inner">
         <?php print render($page['content']);?>
      	</div>
      </div>
  </div>


  <?php /* Footer */?>
  <footer id="footer" role="contentinfo" class="row">
  	<div class="row">
  		<div class="columns twelve">
	  		<?php print render($page['postscript_first']); ?>
  		</div>
  	</div>
  	<div class="row">
  		<div class="columns twelve">  	
      <?php print render($page['postscript_second']); ?>
  		</div>
  	</div>
  	
  	<div class="row">
  		<div class="columns twelve">      
      <?php print render($page['footer']); ?>
  		</div>
  	</div>
  	
  	<div class="row">
  		<div class="columns twelve">      
      <?php print render($page['copyright']); ?> 
  		</div>
  	</div>      
  </footer>

</div>