<?php 

// src/EventListener/SearchIndexerSubscriber.php
namespace App\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use App\Entity\ImageEntityInterface;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Service\FileUploader;

class ImagedEntitySubscriber implements EventSubscriber
{

    /**
     * @var FileUploader
     */
    private $fileUploader;

    public function __construct(
        FileUploader $fileUploader
    ) {
        $this->fileUploader = $fileUploader;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::preRemove,
            Events::preUpdate
        ];
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof ImageEntityInterface) {
            $this->fileUploader->removeFile($entity->getImagePath());
        }
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {   
        //can update the entity here
        $entity = $args->getObject();
        if ($entity instanceof ImageEntityInterface) {
            if ($args->hasChangedField('imagePath')) {
                $path = $args->getOldValue('imagePath');
                $this->fileUploader->removeFile($path);
            }
        }
    }
}