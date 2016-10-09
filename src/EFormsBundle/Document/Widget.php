<?php

namespace EFormsBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\Document
 */
class Widget
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
     * @var bool
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
     * @var int
     *
     * @ODM\Field(type="integer")
     */
    public $min;

    /**
     * @var int
     *
     * @ODM\Field(type="integer")
     */
    public $max;

    /**
     * @var int
     *
     * @ODM\Field(type="integer")
     */
    public $step;

    /**
     * @var int
     *
     * @ODM\Field(type="integer")
     */
    public $maxlength;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $value;

    /**
     * @var array
     *
     * @ODM\Field(type="hash")
     */
    public $values;
}
