<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\EmbeddedDocument
 */
class Section
{
    /**
     * @var string
     *
     * @ODM\Field
     */
    public $label;

    /**
     * @var FormWidget[]
     *
     * @ODM\EmbedMany(targetDocument="FormWidget")
     */
    public $widgets;
}
