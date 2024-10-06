<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$wa  = $this->getWebAssetManager();

$this->setMetaData('viewport', 'width=device-width, initial-scale=1.0');

// Load template stylesheet and javascript
$wa->useStyle('template.osm.custom.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr'))
    ->useScript('template.osm');

// Override 'template.active' asset to set correct ltr/rtl dependency
$wa->registerStyle('template.active', '', [], [], ['template.osm.' . ($this->direction === 'rtl' ? 'rtl' : 'ltr')]);

// Defer font awesome
$wa->getAsset('style', 'fontawesome')->setAttribute('rel', 'lazy-stylesheet');
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
    <jdoc:include type="metas" />
    <jdoc:include type="styles" />
    <jdoc:include type="scripts" />
</head>
<body class="contentpane component <?php echo $this->direction === 'rtl' ? 'rtl' : ''; ?>">
    <jdoc:include type="message" />
    <jdoc:include type="component" />
</body>
</html>