<?php

namespace Goldfinch\CookieConsent\Extensions;

use gorriecoe\Link\Models\Link;
use SilverStripe\Forms\FieldList;
use gorriecoe\LinkField\LinkField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\ORM\ValidationResult;
use UncleCheese\DisplayLogic\Forms\Wrapper;

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
