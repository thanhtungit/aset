<?php
/**
 * @package		solo
 * @copyright Copyright (c)2014-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license		GNU GPL version 3 or later
 */

namespace Solo\View;

use Awf\Mvc\DataView\Html;
use Awf\Utils\Template;

class DataHtml extends Html
{
	/**
	 * Overrides the default method to execute and display a template script.
	 * Instead of loadTemplate is uses loadAnyTemplate.
	 *
	 * @param   string  $tpl  The name of the template file to parse
	 *
	 * @return  mixed  A string if successful, otherwise an exception.
	 *
	 * @throws  \Exception  When the layout file is not found
	 */
	public function display($tpl = null)
	{
		$this->loadCommonMedia();

		return parent::display($tpl);
	}

	/**
	 * Loads the common media files for our application
	 */
	protected function loadCommonMedia()
	{
		$document  = $this->container->application->getDocument();

		// This only applies to the HTML document type
		if (!($document instanceof \Awf\Document\Html))
		{
			return;
		}

		Template::addJs('media://js/solo/gui-helpers.js', $this->container->application);
		Template::addJs('media://js/solo/modal.js', $this->container->application);
		Template::addJs('media://js/solo/ajax.js', $this->container->application);
		Template::addJs('media://js/solo/system.js', $this->container->application);
		Template::addJs('media://js/solo/tooltip.js', $this->container->application);
		Template::addJs('media://js/piecon.js', $this->container->application);
	}
}
