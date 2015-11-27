<?php
/**
 * Joomla! System plugin - Override
 *
 * @author     Yireo <info@yireo.com>
 * @copyright  Copyright 2015 Yireo.com. All rights reserved
 * @license    GNU Public License
 * @link       http://www.yireo.com
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Override System Plugin
 */
class PlgSystemOverride extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @param object $subject
	 * @param array  $config
	 */
	public function __construct(&$subject, $config = array())
	{
        // Class definitions
        $originalClass = 'JHtmlBehavior';
        $originalPath = JPATH_LIBRARIES . '/cms/html/behavior.php';
        $newPath = __DIR__ . '/overrides/html/behavior.php';

        // Overload the class
        $this->overloadClass($originalClass, $originalPath, $newPath);
    
		return parent::__construct($subject, $config);
	}

    /**
     * Method to overload a specific class with your own
     *
     * @param string $originalClass
     * @param string $originalPath
     * @param string $newPath
     *
     * @return bool
     */
    protected function overloadClass($originalClass, $originalPath, $newPath)
    {
        // Check whether the current class is already loaded
        if (in_array($originalClass, get_declared_classes()))
        {
            return false;
        }

        // Load the shadow class based on the original class
        $this->loadShadowClass($originalClass, $originalPath);

        // Make sure that the shadow class is loaded
        if (!in_array($originalClass . 'Shadow', get_declared_classes()))
        {
            return false;
        }

        // Include the new class
        include_once $newPath;

        return true;    
    }

    /**
     * Method to read an original class definition and change it into a shadow class
     *
     * @param string $file
     */
    protected function loadShadowClass($className, $file)
    {
        // Read the original PHP contents
        $code = file_get_contents($file);

        // Remove PHP opening tags
        $code = str_replace('<?php', '', $code);

        // Replace the class definition
        $code = preg_replace('/class ' . $className . '/', 'class ' . $className . 'Shadow', $code);

        // Run the modified PHP code
        eval($code);
    }
}
