<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.OSM
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Getting params from template
$params = JFactory::getApplication()->getTemplate(true)->params;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$sitename = $app->getCfg('sitename');
$this->language = $doc->language;
$doc->setGenerator($sitename);

// Adjusting content width
if ($this->countModules('left') && $this->countModules('right'))
{
	$span = "col-md-6";
}
elseif ($this->countModules('left') && !$this->countModules('right'))
{
	$span = "col-md-9";
}
elseif (!$this->countModules('left') && $this->countModules('right'))
{
	$span = "col-md-9";
}
else
{
	$span = "col-md-12";
}
// Check for a custom CSS file
JHtml::_('stylesheet', 'custom.css', array('version' => 'auto', 'relative' => true));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="apple-touch-icon" sizes="57x57" href="templates/osm/favicons/apple-touch-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="114x114" href="templates/osm/favicons/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="72x72" href="templates/osm/favicons/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="144x144" href="templates/osm/favicons/apple-touch-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="60x60" href="templates/osm/favicons/apple-touch-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="120x120" href="templates/osm/favicons/apple-touch-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="76x76" href="templates/osm/favicons/apple-touch-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="152x152" href="templates/osm/favicons/apple-touch-icon-152x152.png">
  <link rel="icon" type="image/png" href="templates/osm/favicons/favicon-196x196.png" sizes="196x196">
  <link rel="icon" type="image/png" href="templates/osm/favicons/favicon-160x160.png" sizes="160x160">
  <link rel="icon" type="image/png" href="templates/osm/favicons/favicon-96x96.png" sizes="96x96">
  <link rel="icon" type="image/png" href="templates/osm/favicons/favicon-16x16.png" sizes="16x16">
  <link rel="icon" type="image/png" href="templates/osm/favicons/favicon-32x32.png" sizes="32x32">
  <meta name="msapplication-TileColor" content="#142849">
  <meta name="msapplication-TileImage" content="templates/osm/favicons/mstile-144x144.png">
	<jdoc:include type="head" />
  <link href="templates/osm/css/template.css" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="<?php echo $this->baseurl ?>/media/jui/js/html5.js"></script>
	<![endif]-->
</head>

<body>


<div class='noise-wrapper'>
  <div class='header-main'>
    <div class='container'>
      <?php if($this->countModules('search')): ?>
      <div class="search-top">
        <jdoc:include type="modules" name="search" />
      </div>
      <?php endif; ?>
      <nav class='navbar navbar-default' role='navigation'>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class='navbar-header'>
          <button class='navbar-toggle' data-target='.navbar-ex1-collapse' data-toggle='collapse' type='button'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
          </button>
          <a class='current navbar-brand' href='/'>
            <img alt='Open Source Matters Inc.' class="osmlogo" src='<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/osm_logo.png'>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class='collapse navbar-collapse navbar-ex1-collapse'>
          <jdoc:include type="modules" name="menu" />
        </div>
      </nav>
    </div>
  </div>
</div>
  <div class='separator-shadow-bottom'>
    <img alt='' src='<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png'>
  </div>
  <?php if($this->countModules('featured')): ?>
  <div class="noise-wrapper">
      <jdoc:include type="modules" name="featured" />
  </div>
  <div class="separator-shadow-bottom">
     <img src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png" alt="">
  </div>
  <?php endif; ?>
  
<div class='area-content'>
  <div class='container'>

    <?php if($this->countModules('breadcrumbs')): ?>
<div id="breadcrumbs">
          <jdoc:include type="modules" name="breadcrumbs" />
</div>
 <?php endif; ?>
    <?php if($this->countModules('left')): ?>
      <div class="sidebar">
        <div class="col-md-3">
          <jdoc:include type="modules" name="left" />
        </div>
      </div>
    <?php endif; ?>
    <div class="<?php echo $span; ?>">
      <jdoc:include type="component" />
    </div>
    <?php if($this->countModules('bottomleft')): ?>
      <div class="col-md-6">
        <jdoc:include type="modules" name="bottomleft" />
      </div>
    <?php endif; ?>
    
    <?php if($this->countModules('focus_points')): ?>
      <jdoc:include type="modules" name="focus_points" />
      <div class='separator-shadow-bottom bottom-margin'>
        <img alt='' src='<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png' class="width100">
      </div>
    <?php endif; ?>

    <?php if($this->countModules('special')): ?>
      <div class='row bottom-margin'>
        <jdoc:include type="modules" name="special" />
      </div>
      <div class='separator-shadow-top '>
        <img alt='' src='<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png' class="width100">
      </div>

    <?php endif; ?>

    <?php if($this->countModules('slogan')): ?>    
      <jdoc:include type="modules" name="slogan" />
    <div class='separator-shadow-bottom '>
      <img alt='' src='<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png' class="width100">
    </div>

    <?php endif; ?>

    <?php if($this->countModules('slider')): ?>
      <jdoc:include type="modules" name="slider" />
    <?php endif; ?>

  </div>

    <?php if($this->countModules('carousel')): ?>  
      <div class='highlight-content bottom-margin light'>
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
          <jdoc:include type="modules" name="social-menu" style="menu" />
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