<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class Widget
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
    public $type;


    /**
     * @var string
     *
     * @ODM\Field
     */
    public $subtype;

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
    public $description;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $name;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $className;

    /**
     * @var string
     *
     * @ODM\Field(type="bool")
     */
    public $required;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $placeholder;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $value;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $values;
}
