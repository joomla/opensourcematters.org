<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;

// Getting params from template
$app = Factory::getApplication();
$params = $app->getTemplate(true)->params;
$doc = Factory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
$wa = $this->getWebAssetManager();

// Load template stylesheet and javascript
$wa->useStyle('template.osm.custom.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
    ->useScript('template.osm');

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.osm.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemId   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task === 'edit' || $layout === 'form' )
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Logo file
if ($params->get('logoFile'))
{
	$logo = JUri::root() . $params->get('logoFile');
}
else
{
	$logo = $this->baseurl . "/templates/" . $this->template . "/images/osm_logo.png";
}

$this->setMetaData('viewport', 'width=device-width, initial-scale=1');

// Defer font awesome
$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');

// Browsers support SVG favicons
$this->addHeadLink(HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'shortcut icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>

<body class="osm-site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemId ? ' itemid-' . $itemId : '');
?>">
<div class="noise-wrapper">
  <div class="header-main">
 		<div class="container">
      		<div class="search-top">
	  			<?php
					// Display position-0 modules
					echo $doc->getBuffer('modules', 'search', array('style' => 'none'));
				?>
     		</div>
            <nav class="navbar navbar-expand-md" role="navigation">
                <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#osmNavMenu" aria-controls="osmNavMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="current navbar-brand float-end" href="/">
                    <img alt="Open Source Matters Inc." class="osmlogo" src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/osm_logo.png">
                </a>
                <div id="osmNavMenu" class="collapse navbar-collapse">
                    <?php
                        // Display position-1 modules
                        echo $doc->getBuffer('modules', 'menu', array('style' => 'none'));
                    ?>
                </div>
            </nav>
		</div>
	</div>
</div>
<div class="separator-shadow-bottom">
    <img alt="" src="<?php echo JUri::base(); ?>templates/<?php echo $this->template; ?>/images/shadow-separator-wide-bottom.png">
</div>
<div class="area-content">
			<div class="container">
				<div id="content" class="span12">
					<!-- Begin Content -->
					<h1 class="page-header"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
					<div class="well">
						<div class="row-fluid">
							<div class="span6">
								<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
								<p><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
								<ul>
									<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
									<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
								</ul>
							</div>
							<div class="span6">
								<?php if (JModuleHelper::getModule('search')) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_SEARCH'); ?></strong></p>
									<p><?php echo JText::_('JERROR_LAYOUT_SEARCH_PAGE'); ?></p>
									<?php echo $doc->getBuffer('module', 'search'); ?>
								<?php endif; ?>
								<p><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></p>
								<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn"><i class="icon-home"></i> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
							</div>
						</div>
						<hr />
						<p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
						<blockquote>
							<span class="label label-inverse"><?php echo $this->error->getCode(); ?></span> <?php echo $this->error->getMessage();?>
						</blockquote>
                        <?php if ($this->debug) : ?>
                            <div>
                                <?php echo $this->renderBacktrace(); ?>
                                <?php // Check if there are more Exceptions and render their data as well ?>
                                <?php if ($this->error->getPrevious()) : ?>
                                    <?php $loop = true; ?>
                                    <?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
                                    <?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
                                    <?php $this->setError($this->_error->getPrevious()); ?>
                                    <?php while ($loop === true) : ?>
                                        <p><strong><?php echo Text::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
                                        <p><?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
                                        <?php echo $this->renderBacktrace(); ?>
                                        <?php $loop = $this->setError($this->_error->getPrevious()); ?>
                                    <?php endwhile; ?>
                                    <?php // Reset the main error object to the base error ?>
                                    <?php $this->setError($this->error); ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
					</div>
					<!-- End Content -->
				</div>
			</div>
		</div>
	</div>
</div>
	<!-- Footer -->
	<footer id="main-footer">
		<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : '');?>">
			<div class="row">
				<div class="col-md-6">
					<div class="copyright">
						<?php echo $doc->getBuffer('modules', 'copyright', array('style' => 'none')); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<?php echo $doc->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>
</html>
