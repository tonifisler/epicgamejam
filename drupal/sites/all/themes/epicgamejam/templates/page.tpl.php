<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
drupal_add_library('chosen', 'drupal.chosen');
?>
<header role="banner" class="header <?php if ($is_front): ?>header-front<?php endif; ?>">

  <div id="page-header">
    <?php if (!empty($site_slogan)): ?>
      <p class="lead"><?php print $site_slogan; ?></p>
    <?php endif; ?>

    <h1 class="text-center">
      <a class="shake" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
        <img class="logo" src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/svg/epicgamejam_logo.svg" alt="<?php print $site_name; ?>">
      </a>
    </h1>

    <?php print render($page['header']); ?>

    <?php if ($is_front): ?>
      <h2 class="text-center">July 3th <span class="text-muted">20:00</span> to 5th <span class="text-muted">17:00 CEST (GMT+2)</span></h2>
      <div class="hidden-xs">
        <div class="spacer spacer-sm"></div>
        <div id="countdown"></div>
        <h2 class="text-center"><span class="sr-only">A few days only </span>BEFORE IT ALL BEGINS.</h2>
        <div class="spacer spacer-sm"></div>
      </div>
    <?php endif ?>
  </div> <!-- /#page-header -->

  <div class="container">
    <nav class="navbar navbar-default" role="navigation">
      <div class="">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php if ($logo): ?>
            <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
              <!-- <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /> -->
            </a>
          <?php endif; ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="main-menu">
          <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
            <?php if (!empty($primary_nav)): ?>
              <?php print render($primary_nav); ?>
            <?php endif; ?>
            <?php if (!empty($secondary_nav)): ?>
              <?php print render($secondary_nav); ?>
            <?php endif; ?>
            <?php if (!empty($page['navigation'])): ?>
              <?php print render($page['navigation']); ?>
            <?php endif; ?>
          <?php endif; ?>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>

</header>

<div class="main-container container">

  <?php print $messages; ?>

  <div class="row">

    <?php if (!empty($page['sidebar_first'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_first']); ?>
      </aside>  <!-- /#sidebar-first -->
    <?php endif; ?>

    <section<?php print $content_column_class; ?>>
      <a id="main-content"></a>
      <?php if (!empty($breadcrumb)): print $breadcrumb; endif;?>
      <?php if (!empty($tabs)): ?>
        <?php print render($tabs); ?>
      <?php endif; ?>
      <?php if (!$is_front): ?>
        <?php print render($title_prefix); ?>
        <?php if (!empty($title)): ?>
          <h1 class="page-header"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php print render($title_suffix); ?>
      <?php endif ?>
      <?php if (!empty($page['help'])): ?>
        <?php print render($page['help']); ?>
      <?php endif; ?>
      <?php if (!empty($action_links)): ?>
        <ul class="action-links"><?php print render($action_links); ?></ul>
      <?php endif; ?>

      <?php if (!empty($page['highlighted'])): ?>
        <div class="row">
          <div class="col-md-8">
      <?php endif; ?>

      <?php print render($page['content']); ?>
      <?php if ($is_front): ?>
        <div class="spacer"></div>
      <?php endif ?>

      <?php if (!empty($page['highlighted'])): ?>
          </div>
          <div class="col-md-4">
            <div class="well">
              <?php print render($page['highlighted']); ?>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php print render($page['content_bottom']); ?>
    </section>

    <?php if (!empty($page['sidebar_second'])): ?>
      <aside class="col-sm-3" role="complementary">
        <?php print render($page['sidebar_second']); ?>
      </aside>  <!-- /#sidebar-second -->
    <?php endif; ?>

  </div>
</div>
<div class="spacer spacer-md"></div>
<footer class="main-footer">
  <?php print render($page['footer']); ?>

  <div class="bg-white">
    <div class="container text-center">
      <div class="spacer spacer-sm"></div>
      <h6>Big up to all the partners and sponsors who help us make this game jam… epic !</h6>
      <ul class="list-inline">
        <li><img src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/img/NIFFF.png" alt="NIFFF"></li>
        <li><img src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/img/itf.png" alt="ITF"></li>
        <li><img src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/img/logo_ville_neuch.png" alt="Neuchâtel"></li>
        <li><img src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/img/PH_logo_neutr_black.png" alt="Pro Helvetia"></li>
        <li><img src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/img/SGDA.png" alt="SGDA"></li>
        <li><img src="/<?php print drupal_get_path('theme',$GLOBALS['theme']); ?>/build/img/sgj.png" alt="Swiss Game Jam"></li>
      </ul>
      <div cla  ss="spacer spacer-xs"></div>
      <small class="text-muted">
        The epic game jam is an event created by :  <a href="mailto:caroline.hirt@nifff.ch">Caroline Hirt</a> | <a href="mailto:mail@toni.io">Toni Fisler</a> | <a href="mailto:wuthrer@gmail.com">Jérémy Hervé Wuthrer Cuany</a><br>Contact Epic Game Jam: <a href="mailto:hello@epicgamejam.com">hello@epicgamejam.com</a>
      </small>
      <div class="spacer spacer-xs"></div>
    </div>
  </div>
</footer>
