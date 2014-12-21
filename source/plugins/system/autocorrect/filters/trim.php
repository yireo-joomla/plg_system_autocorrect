<?php
/**
 * Joomla! plugin to autocorrect content
 *
 * @author Yireo (info@yireo.com)
 * @copyright Copyright 2014
 * @license GNU Public License
 * @link http://www.yireo.com
 * @contributor Jisse Reitsma, Yireo (main code)
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

// Import the parent class
jimport( 'joomla.plugin.plugin' );

/**
 * System plugin
 */
class plgSystemAutocorrectFilterTrim
{
    public function filter($string)
    {
        $string = trim($string);
        return $string;
    }
}
