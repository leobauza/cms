<?php
namespace Craft;

/**
 * Will validate that the given attribute is a valid URL format.
 */
class UrlFormatValidator extends \CValidator
{
	/**
	 * @var bool Whether we should ensure that "{slug}" is used within the URL format.
	 */
	public $requireSlug = true;

	/**
	 * @param $object
	 * @param $attribute
	 */
	protected function validateAttribute($object, $attribute)
	{
		$urlFormat = $object->$attribute;

		if ($urlFormat)
		{
			// Remove any leading or trailing slashes
			$urlFormat = trim($urlFormat, '/');
			$object->$attribute = $urlFormat;

			if ($this->requireSlug)
			{
				$element = (object) array('slug' => StringHelper::randomString());
				$uri = craft()->templates->renderObjectTemplate($urlFormat, $element);

				if (strpos($uri, $element->slug) === false)
				{
					$this->addError($object, $attribute, Craft::t('{attribute} must contain “{slug}”'));
				}
			}
		}
	}
}
