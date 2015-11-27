# Overloading classes in Joomla
This plugin is an example of how to overload classes of the Joomla Framework.
Instead of copying the original class to a new location and modifying it there,
this plugin aims to leave the original class intact while using it as a shadow parent
for a new class.

As example, this plugin overrides the class `JHtmlBehavior`. To test this plugin, make sure to add the
following code to your template:

    JHtml::_('behavior.framework');

Using this call, MooTools will be added to your HTML document. We hate MooTools. When the plugin is disabled,
MooTools should be there in the HTML source. When the plugin is enabled, MooTools should be no longer there.

This plugin overrides
the class `JHtmlBehavior` by returning nothing when running its method `framework()`. However, this is
accomplished with a minimal code change. The new class `JHtmlBehavior` is almost empty and extends a copy of
the original class (now renamed to `JHtmlBehaviorShadow`:

    class JHtmlBehavior extends JHtmlBehaviorShadow
    {
	    public static function framework($extras = false, $debug = null)
	    {
            return;
        }
    }

Because the original class is no longer copied but extended from, any changes in the original Joomla core class
will be available in the modified class, except for the `framework()` method which we hate because of its usage
of MooTools.
