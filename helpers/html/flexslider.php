<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('JPATH_PLATFORM') or die;

/**
 * Flexslider Utility class for jQuery JavaScript behaviors.
 *
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @since       3.1
 */
abstract class JHtmlFlexslider extends JHtmlJquery
{
	/**
	 * Method to load the jQuery Flexslider into the document head.
	 *
	 * @param   string     $selector  The HTML selector.
	 * @param   JRegistry  $params    The parameters object. [optional]
	 * @param   mixed      $debug     Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public static function Flexslider($selector = '.flexslider', $params = null, $debug = null)
	{
		// Include jQuery.
		self::framework();

		// If no debugging value is set, use the configuration setting.
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug  = (boolean) $config->get('debug');
		}

		// Add Stylesheet.
		if ($params->get('default_css'))
		{
			JHtml::stylesheet('plg_system_flexslider/flexslider.css', false, true, false);
		}

		// Add JavaScript.
		if ($params->get('minified', 1))
		{
			JHtml::script('plg_system_flexslider/jquery.flexslider.min.js', false, true);
		}
		else
		{
			JHtml::script('plg_system_flexslider/jquery.flexslider.js', false, true);
		}

		// Get the document object.
		$doc = JFactory::getDocument();

		// Build the script.
		$script = array();
		$script[] = 'jQuery(document).ready(function() {';
		$script[] = '	jQuery(window).on(\'resize\', function() {';
		$script[] = '		var slider = $(\'' . $selector . '\');';

		$script[] = '		slider.each(function() {';
		$script[] = '			var sliderInstance       = $(\'#\' + $(this).prop(\'id\')),';
		$script[] = '				sliderSelector       = sliderInstance.data(\'selector\'),';
		$script[] = '				sliderAnimation      = sliderInstance.data(\'animation\'),';
		$script[] = '				sliderDirection      = sliderInstance.data(\'direction\'),';
		$script[] = '				sliderAnimationLoop  = sliderInstance.data(\'animationloop\'),';
		$script[] = '				sliderControlNav     = sliderInstance.data(\'controlnav\'),';
		$script[] = '				sliderDirectionNav   = sliderInstance.data(\'directionnav\'),';
		$script[] = '				sliderSlideshowSpeed = sliderInstance.data(\'slideshowspeed\'),';
		$script[] = '				sliderAnimationSpeed = sliderInstance.data(\'animationspeed\'),';
		$script[] = '				sliderPauseOnHover   = sliderInstance.data(\'pauseonhover\'),';
		$script[] = '				sliderUseCSS         = sliderInstance.data(\'usecss\'),';
		$script[] = '				sliderItemWidth      = sliderInstance.data(\'itemwidth\'),';
		$script[] = '				sliderItemMargin     = sliderInstance.data(\'itemmargin\'),';
		$script[] = '				sliderminItems       = sliderInstance.data(\'minitems\'),';
		$script[] = '				slidermaxItems       = sliderInstance.data(\'maxitems\');';

		$script[] = '			$(this).flexslider({';
		$script[] = '				selector: sliderSelector,';
		$script[] = '				animation: sliderAnimation,';
		$script[] = '				direction: sliderDirection,';
		$script[] = '				animationLoop: sliderAnimationLoop,';
		$script[] = '				controlNav: sliderControlNav,';
		$script[] = '				directionNav: sliderDirectionNav,';
		$script[] = '				slideshowSpeed: sliderSlideshowSpeed,';
		$script[] = '				animationSpeed: sliderAnimationSpeed,';
		$script[] = '				pauseOnHover: sliderPauseOnHover,';
		$script[] = '				useCSS: sliderUseCSS,';
		$script[] = '				itemWidth: sliderItemWidth,';
		$script[] = '				itemMargin: sliderItemMargin,';
		$script[] = '				minItems: sliderminItems,';
		$script[] = '				maxItems: slidermaxItems,';
		$script[] = '				prevText: \'<i class="icon-chevron-left"></i>\',';
		$script[] = '				nextText: \'<i class="icon-chevron-right"></i>\'';
		$script[] = '			});';
		$script[] = '		});';
		$script[] = '	}).resize();';
		$script[] = '});';

		// Add the script to the document head.
		$doc->addScriptDeclaration(implode("\n", $script));

		return;
	}
}
