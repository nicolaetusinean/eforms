<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\EmbeddedDocument
 */
class Option
{
    use ConstructableProperties;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $label;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $value;

    /**
     * @var string
     *
     * @ODM\Field(type="bool")
     */
    public $selected = false;
}
