<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.Flexslider
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('JPATH_BASE') or die;

/**
 * Joomla Flexslider plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Flexslider
 * @since       3.1
 */
class PlgSystemFlexslider extends JPlugin
{
	/**
	 * Method to catch the onAfterDispatch event.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.1
	 */
	public function onAfterDispatch()
	{
		// Check that we are in the site application.
		if (JFactory::getApplication()->isAdmin())
		{
			return true;
		}

		// Register dependent classes.
		JLoader::register('JHtmlFlexslider', __DIR__ . '/helpers/html/flexslider.php');

		// Register a function.
		JHtml::register('jquery.flexslider', array('JHtmlFlexslider', 'flexslider'));

		// Force load script.
		if ($this->params->get('force'))
		{
			// Load the flexslider jquery script.
			JHtml::_('jquery.flexslider', $this->params->get('selector', '.flexslider'), $this->params);
		}

		return true;
	}
}
