<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Form
{
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
