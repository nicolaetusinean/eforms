<?php

namespace EFormsBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use EFormsBundle\Traits\ConstructableProperties;

/**
 * @ODM\Document
 */
class Form
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
    public $label;

    /**
     * @var string
     *
     * @ODM\Field
     */
    public $description;

    /**
     * @var Section[]
     *
     * @ODM\EmbedMany(targetDocument="Section")
     */
    public $sections = [];

    /**
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $sections = isset($data['sections']) ? $data['sections'] : [];
        foreach ($sections as &$section) {
            $section = new Section($section);
        }
        $data['sections'] = $sections;

        $this->_construct($data);
    }
}
