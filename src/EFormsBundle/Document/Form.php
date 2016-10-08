<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\Document
 */
class Form
{
    use ConstructableProperties;

    /**
     * @var int
     *
     * @ODM\Id
     */
    public $id;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $label;

    /**
     * @var Section[]
     *
     * @ODM\EmbedMany(targetDocument="Section")
     */
    public $sections = [];
}
