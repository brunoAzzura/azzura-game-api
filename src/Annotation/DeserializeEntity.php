<?php

namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 */
final class DeserializeEntity
{
    /**
     * @var string
     * @Required()
     */
    public $type; // <- App\Entity\Person
    /**
     * @var string
     * @Required()
     */
    public $idField; // <- Person class id field
    /**
     * @var string
     * @Required()
     */
    public $setter; // <- Role setPerson() method
    /**
     * @var string
     * @Required()
     */
    public $idGetter; // <- Person getId() Method
}