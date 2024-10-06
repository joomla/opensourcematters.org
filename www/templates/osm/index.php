<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.OSM
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

/** @var Joomla\CMS\Document\HtmlDocument $this */

$app = Factory::getApplication();
$sitename = $app->get('sitename');
$input = $app->getInput();
$menu     = $app->getMenu()->getActive();

// Adjusting content width
if ($this->countModules('left') && $this->countModules('right'))
{
	$span = 'col-md-6';
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
	$span = 'col-md-9';
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
	$span = 'col-md-9';
}
else
{
	$span = 'col-md-12';
}

// For mobile menu toggle
HTMLHelper::_('bootstrap.collapse');

$option   = $input->getCmd('option', '');
$view     = $input->getCmd('view', '');
$layout   = $input->getCmd('layout', '');
$task     = $input->getCmd('task', '');
$itemId   = $input->getCmd('Itemid', '');
$pageClass = $menu !== null ? $menu->getParams()->get('pageclass_sfx', '') : '';

$wa = $this->getWebAssetManager();

// Load template stylesheet and javascript
$wa->useStyle('template.osm.custom.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
    ->useScript('template.osm');

$templateBaseUrl = $this->baseurl . '/templates/' . $this->template;

// Set default template metadata
$this->setMetaData('viewport', 'width=device-width, initial-scale=1.0');
$this->setMetaData('mobile-web-app-capable', 'yes');
$this->setMetaData('apple-mobile-web-app-capable', 'yes');
$this->setMetaData('apple-mobile-web-app-status-bar-style', 'blue');
//$this->addHeadLink("$templateBaseUrl/images/apple-touch-icon-180x180.png", 'apple-touch-icon', 'rel', ['sizes' => '180x180']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-152x152.png", 'apple-touch-icon', 'rel', ['sizes' => '152x152']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-144x144.png", 'apple-touch-icon', 'rel', ['sizes' => '144x144']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-120x120.png", 'apple-touch-icon', 'rel', ['sizes' => '120x120']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-114x114.png", 'apple-touch-icon', 'rel', ['sizes' => '114x114']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-76x76.png", 'apple-touch-icon', 'rel', ['sizes' => '76x76']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-72x72.png", 'apple-touch-icon', 'rel', ['sizes' => '72x72']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-60x60.png", 'apple-touch-icon', 'rel', ['sizes' => '60x60']);
$this->addHeadLink("$templateBaseUrl/favicons/apple-touch-icon-57x57.png", 'apple-touch-icon', 'rel', ['sizes' => '57x57']);
//$this->addHeadLink("$templateBaseUrl/images/apple-touch-icon.png", 'apple-touch-icon');

$this->addHeadLink("$templateBaseUrl/favicons/favicon-196x196.png", 'icon', 'rel', ['sizes' => '196x196', 'type' => 'image/png']);
$this->addHeadLink("$templateBaseUrl/favicons/favicon-160x160.png", 'icon', 'rel', ['sizes' => '160x160', 'type' => 'image/png']);
$this->addHeadLink("$templateBaseUrl/favicons/favicon-96x96.png", 'icon', 'rel', ['sizes' => '96x96', 'type' => 'image/png']);
$this->addHeadLink("$templateBaseUrl/favicons/favicon-32x32.png", 'icon', 'rel', ['sizes' => '32x32', 'type' => 'image/png']);
$this->addHeadLink("$templateBaseUrl/favicons/favicon-16x16.png", 'icon', 'rel', ['sizes' => '16x16', 'type' => 'image/png']);

// TODO: Only for Windows 8: Do we still need/want this?
$this->setMetaData('msapplication-TileColor', '#142849');
$this->setMetaData('msapplication-TileImage', 'templates/osm/favicons/mstile-144x144.png');

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.osm.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body class="osm-site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemId ? ' itemid-' . $itemId : '')
    . ($pageClass ? ' ' . $pageClass : '');
?>">

<div class="noise-wrapper">
  <div class="header-main">
    <div class="container">
      <?php if($this->countModules('search')): ?>
      <div class="search-top">
        <jdoc:include type="modules" name="search" />
      </div>
      <?php endif; ?>
      <nav class="navbar navbar-expand-md" role="navigation">
      <a class="current navbar-brand float-start" href='/'>
        <img alt="Open Source Matters Inc." class="osmlogo" src='<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/osm_logo.png'>
      </a>
      <button class="navbar-toggler float-end" type="button" data-bs-toggle="collapse" data-bs-target="#osmNavMenu" aria-controls="osmNavMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div id="osmNavMenu" class="collapse navbar-collapse">
        <jdoc:include type="modules" name="menu" />
      </div>
      </nav>
    </div>
  </div>
</div>
  <div class="separator-shadow-bottom">
    <img alt="" src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png">
  </div>
  <?php if($this->countModules('featured')): ?>
  <div class="noise-wrapper">
      <jdoc:include type="modules" name="featured" />
  </div>
  <div class="separator-shadow-bottom">
     <img src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png" alt="">
  </div>
  <?php endif; ?>
  
<div class="area-content">
  <div class="container">

    <?php if($this->countModules('breadcrumbs')): ?>
<div id="breadcrumbs">
          <jdoc:include type="modules" name="breadcrumbs" />
</div>
 <?php endif; ?>
    <div class="row">
        <?php if($this->countModules('left')): ?>
            <div class="col-md-3">
              <jdoc:include type="modules" name="left" />
            </div>
        <?php endif; ?>
        <div class="<?php echo $span; ?>">
          <jdoc:include type="component" />
        </div>
    </div>
    <?php if($this->countModules('bottomleft')): ?>
      <div class="col-md-6">
        <jdoc:include type="modules" name="bottomleft" />
      </div>
    <?php endif; ?>
    
    <?php if($this->countModules('focus_points')): ?>
      <jdoc:include type="modules" name="focus_points" />
      <div class="separator-shadow-bottom bottom-margin">
        <img alt="" src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png" class="w-100">
      </div>
    <?php endif; ?>

    <?php if($this->countModules('special')): ?>
      <div class="row bottom-margin">
        <jdoc:include type="modules" name="special" />
      </div>
      <div class="separator-shadow-top ">
        <img alt="" src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png" class="w-100">
      </div>

    <?php endif; ?>

    <?php if($this->countModules('slogan')): ?>    
      <jdoc:include type="modules" name="slogan" />
    <div class="separator-shadow-bottom ">
      <img alt="" src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png" class="w-100">
    </div>

    <?php endif; ?>

    <?php if($this->countModules('slider')): ?>
      <jdoc:include type="modules" name="slider" />
    <?php endif; ?>

  </div>

    <?php if($this->countModules('carousel')): ?>  
      <div class="highlight-content bottom-margin light">
        <jdoc:include type="modules" name="carousel" />
      </div>
    <?php endif; ?>
    
  <?php if($this->countModules('partners')): ?>
    <div class="container">
      <jdoc:include type="modules" name="partners" />
    </div>
  <?php endif; ?>

</div>

  <footer id="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-md-6">

          <jdoc:include type="modules" name="footer-menu" />

          <div class="copyright">
            <jdoc:include type="modules" name="copyright" />
          </div>

        </div>
        <div class="col-md-6">
          <jdoc:include type="modules" name="social-menu" style="none" />
        </div>
      </div>
    </div>
  </footer>

	<jdoc:include type="modules" name="debug" style="none" />
      
    <!-- Cookie Control -->
	<script src="https://cc.cdn.civiccomputing.com/9/cookieControl-9.3.1.min.js" type="text/javascript"></script>
	<script src="/templates/osm/osm_cookiecontrol.js" type="text/javascript"></script>
	<!-- End of Cookie Control -->
</body>
</html>