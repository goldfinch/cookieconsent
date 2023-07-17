<?php

namespace Goldfinch\CookieConsent\Extensions;

use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\ValidationResult;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;

class SiteConfigExtension extends DataExtension
{
    private static $db = [
        'CookieConsent' => 'Boolean',
        'CookieConsentMessage' => 'HTMLText',
    ];

    private static $has_one = [
        'CookieConsentPolicyLink' => Link::class,
        'CookieConsentPrivacyLink' => Link::class,
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.CookieConsent', [

            CompositeField::create(

                CheckboxField::create('CookieConsent', 'Cookie Consent'),
                Wrapper::create(

                    HtmlEditorField::create('CookieConsentMessage', 'Message'),
                    // LinkField::create('CookieConsentPolicyLink', 'Cookie Policy Link', $this->owner),
                    // LinkField::create('CookieConsentPrivacyLink', 'Cookie Privacy Link', $this->owner),

                )->displayIf('CookieConsent')->isChecked()->end(),

            ),

        ]);
    }

    public function validate(ValidationResult $validationResult)
    {
        // $validationResult->addError('Error message');
    }
}
