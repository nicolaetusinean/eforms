<?php

namespace EFormsBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\EmbeddedDocument
 */
class Widget
{
    use ConstructableProperties {
        __construct as _construct;
    }

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
     * @var Option[]
     *
     * @ODM\EmbedMany(targetDocument="Option")
     */
    public $values = [];


    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $values = isset($data['values']) ? $data['values'] : [];
        foreach ($values as &$value) {
            $value = new Option($value);
        }
        $data['values'] = $values;

        $this->_construct($data);
    }
}
