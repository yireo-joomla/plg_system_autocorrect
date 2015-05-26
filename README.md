# AutoCorrect
This project offers a Joomla! plugin to autocorrect content when saving. 

## Why?
When you are maintaining a Joomla site that is used by others, you will note that non-technical people
will often add content in a wrong way: They will put spaces in front of article titles, add HTML to article
titles, etcetera. This plugin allows you to automatically fix this, before saving the article to the database.

## Usage
Enable the plugin and configure its settings. Per filter, there is a seperate tab in the plugin parameters,
which allows you to enable the filter and specify to which fields the filter should be applied (`title`, `text`, etcetera).

## Current state
Currently, the following filters are available:
* Trim: Removes spaces from the beginning and end of a string.
* Strip: Removes all HTML tags from the entire string.

## Development
Each filter has its own class in a `filters` subfolder and is added through a filter-specific XML file to allow integration.
New filters can be added to the `filters` subfolder by adding a PHP class plus a XML file.

The main functionality of the plugin is that of a Content Plugin. Nonetheless, the plugin belongs to the System Plugin group,
to allow for the trick of filters automatically being added.

## Caveats
* To filters for the form, do not show up unless the plugin itself is enabled.

---
## Want to learn how to program Joomla plugins?
We have released an excellent guide for developing Joomla plugins: **Programming Joomla Plugins** written by Jisse Reitsma, a must-have for any serious Joomla developer.

https://www.yireo.com/books/programming-joomla-plugins-book

