<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\EmbeddedDocument
 */
class FormWidget extends Widget
{
    use ConstructableProperties;

    /**
     * @var Form
     *
     * @ODM\ReferenceOne(targetDocument="Widget")
     */
    public $widget;
}
