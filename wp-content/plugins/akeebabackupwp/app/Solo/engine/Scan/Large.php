<?php
/**
 * Akeeba Engine
 * The modular PHP5 site backup engine
 * @copyright Copyright (c)2006-2018 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU GPL version 3 or, at your option, any later version
 * @package   akeebaengine
 *
 */

namespace Akeeba\Engine\Scan;

// Protection against direct access
defined('AKEEBAENGINE') or die();

use Akeeba\Engine\Factory;

/* Windows system detection */
if (!defined('_AKEEBA_IS_WINDOWS'))
{
	if (function_exists('php_uname'))
	{
		define('_AKEEBA_IS_WINDOWS', stristr(php_uname(), 'windows'));
	}
	else
	{
		define('_AKEEBA_IS_WINDOWS', DIRECTORY_SEPARATOR == '\\');
	}
}

/**
 * A filesystem scanner which uses opendir() and is smart enough to make large directories
 * be scanned inside a step of their own.
 *
 * The idea is that if it's not the first operation of this step and the number of contained
 * directories AND files is more than double the number of allowed files per fragment, we should
 * break the step immediately.
 *
 */
class Large extends Base
{
	public function &getFiles($folder, &$position)
	{
		$result = $this->scanFolder($folder, $position, false, 'file', 100);

		return $result;
	}

	public function &getFolders($folder, &$position)
	{
		$result = $this->scanFolder($folder, $position, true, 'dir', 50);

		return $result;
	}

	protected function scanFolder($folder, &$position, $forFolders = true, $threshold_key = 'dir', $threshold_default = 50)
	{
		$registry = Factory::getConfiguration();

		// Initialize variables
		$arr = array();
		$false = false;

		if (!is_dir($folder) && !is_dir($folder . '/'))
		{
			return $false;
		}

		try
		{
			$di = new \DirectoryIterator($folder);
		}
		catch (\Exception $e)
		{
			$this->setWarning('Unreadable directory ' . $folder);

			return $false;
		}

		if (!$di->valid())
		{
			$this->setWarning('Unreadable directory ' . $folder);

			return $false;
		}

		if (!empty($position))
		{
			$di->seek($position);

			if ($di->key() != $position)
			{
				$position = null;

				return $arr;
			}
		}

		$counter = 0;
		$maxCounter = $registry->get("engine.scan.large.{$threshold_key}_threshold", $threshold_default);

		while ($di->valid())
		{
			/**
			 * If the directory entry is a link pointing somewhere outside the allowed directories per open_basedir we
			 * will get a RuntimeException (tested on PHP 5.3 onwards). Catching it lets us report the link as
			 * unreadable without suffering a PHP Fatal Error.
			 */
			try {
				$di->isLink();
			}
			catch (\RuntimeException $e)
			{
				$this->setWarning(sprintf("Link %s is inaccessible. Check the open_basedir restrictions in your server's PHP configuration", $di->getPathname()));

				$di->next();

				continue;
			}

			if ($di->isDot())
			{
				$di->next();

				continue;
			}

			if ($di->isDir() != $forFolders)
			{
				$di->next();

				continue;
			}

			$ds = ($folder == '') || ($folder == '/') || (@substr($folder, -1) == '/') || (@substr($folder, -1) == DIRECTORY_SEPARATOR) ? '' : DIRECTORY_SEPARATOR;
			$dir = $folder . $ds . $di->getFilename();

			$data = _AKEEBA_IS_WINDOWS ? Factory::getFilesystemTools()->TranslateWinPath($dir) : $dir;

			if ($data)
			{
				$counter++;
				$arr[] = $data;
			}

			if ($counter == $maxCounter)
			{
				break;
			}
			else
			{
				$di->next();
			}
		}

		// Determine the new value for the position
		$di->next();

		if ($di->valid())
		{
			$position = $di->key() - 1;
		}
		else
		{
			$position = null;
		}

		return $arr;
	}
}
