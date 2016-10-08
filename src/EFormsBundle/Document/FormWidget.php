<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\EmbeddedDocument
 */
class FormWidget extends Widget
{
    /**
     * @var Form
     *
     * @ODM\ReferenceOne(targetDocument="Widget")
     */
    public $widget;
}
