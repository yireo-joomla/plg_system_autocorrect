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
class plgSystemAutocorrect extends JPlugin
{
    /**
     * Plugin event when this form is being prepared
     *
     * @param JForm $form
     * @param array $data
     *
     * @return null
     */
    public function onContentPrepareForm($form, $data)
    {
        // Check we have a form
        if (!($form instanceof JForm))
        {
            $this->_subject->setError('JERROR_NOT_A_FORM');
            return;
        }

        // Grab system variables
        $app = JFactory::getApplication();
        $input = $app->input;

        // Check for the backend
        if ($app->isAdmin() == false) {
            return;
        }

        // Skip this for non-category pages
        if ($input->getCmd('option') != 'com_plugins')
        {
            return;
        }

        // Convert empty data if needed
        if (empty($data))
        {
            $data = (object)$input->get('jform', '', 'array');
        }

        // Check for this plugin
        if (empty($data) || !is_object($data) || $data->element != 'autocorrect')
        {
            return;
        }

        // Add the plugin-form to main form
        $formDir = dirname(__FILE__).'/filters';
        $formFiles = glob($formDir.'/*.xml');

        foreach ($formFiles as $formFile)
        {
            $form->loadFile($formFile, false);
        }

        return true;
    }

    /**
     * Plugin event before this content is being saved
     *
     * @param string $context
     * @param array $table
     * @param bool $isNew
     *
     * @return bool
     */
    public function onContentBeforeSave($context, $table, $isNew)
    {
        // Loop through the parameters
        foreach ($this->params as $paramName => $paramValue)
        {
            if (preg_match('/([a-zA_Z0-9]+)\_enable$/', $paramName, $paramMatch) == false)
            {
                continue;
            }

            $filterName = $paramMatch[1];
            $filterClass = 'plgSystemAutocorrectFilter'.ucfirst($filterName);
            $filterFile = __DIR__.'/filters/'.$filterName.'.php';
            $fieldTypes = $this->params->get($filterName.'_fieldtypes');
            
            if (empty($fieldTypes))
            {
                continue;
            }

            if (file_exists($filterFile) == false)
            {
                continue;
            }

            include_once $filterFile;

            if (class_exists($filterClass) == false)
            {
                continue;
            }

            $filter = new $filterClass;

            foreach ($fieldTypes as $fieldType)
            {
                if (isset($table->$fieldType))
                {
                    $table->$fieldType = $filter->filter($table->$fieldType);
                }
            }
        }

        return true;
    }
}
