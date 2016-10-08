<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\EmbeddedDocument
 */
class Section
{
    use ConstructableProperties;

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
