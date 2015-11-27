<?php
/**
 * All of the original functionality of JHtmlBehavior is available in JHtmlBehaviorShadow
 */
class JHtmlBehavior extends JHtmlBehaviorShadow
{
    /**
     * The original method loads the MooTools framework. This method loads nothing.
     */
	public static function framework($extras = false, $debug = null)
	{
        return;
    }
}

