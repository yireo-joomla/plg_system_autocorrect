<?php
/**
 * Joomla! form
 *
 * @author Yireo (info@yireo.com)
 * @package Yireo
 * @copyright Copyright 2015
 * @license GNU Public License
 * @link http://www.yireo.com
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

// Import classes
jimport('joomla.form.fields.list');

/**
 * Form Field-class for selecting content fields
 */
class JFormFieldFieldTypes extends JFormFieldList
{
    public $type = 'FieldTypes';

	protected function getInput()
	{
        if(!empty($this->value) && is_string($this->value))
        {
            $this->value = explode(',', $this->value);
        }

        return parent::getInput();
    }

    protected function getLabel()
    {
        $this->element['label'] = 'PLG_SYSTEM_AUTOCORRECT_FIELD_TYPES';
        $this->description = 'PLG_SYSTEM_AUTOCORRECT_FIELD_TYPES_DESC';
        return parent::getLabel();
    }
    
	protected function getOptions()
	{
        $options = array(
            JHtml::_('select.option', 'title', JText::_('PLG_SYSTEM_AUTOCORRECT_FIELD_TITLE')),
            JHtml::_('select.option', 'introtext', JText::_('PLG_SYSTEM_AUTOCORRECT_FIELD_INTROTEXT')),
            JHtml::_('select.option', 'fulltext', JText::_('PLG_SYSTEM_AUTOCORRECT_FIELD_FULLTEXT')),
            JHtml::_('select.option', 'text', JText::_('PLG_SYSTEM_AUTOCORRECT_FIELD_TEXT')),
        );
        return $options;
    }
}
