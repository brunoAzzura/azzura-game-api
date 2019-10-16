<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileUploader
{
    /**
     * @var ParameterBagInterface
     */
    private $params;


    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function uploadFile($file, $path) {

        $fileSystem = new Filesystem();

        if(!$fileSystem->exists('./img/'.$path)){
            $fileSystem->mkdir('./img/'.$path);
        }

        if (!in_array(
            $file->getMimeType(),
            ['image/jpeg', 'image/png', 'image/gif', 'application/octet-stream']
        )) {
            throw new UnsupportedMediaTypeHttpException(
                'File uploaded is not a valid png/jpeg/gif image'
            );
        }

        // Generate a new random filename
        $newFileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->params->get('image_directory').DIRECTORY_SEPARATOR.'question', $newFileName);


        return $this->params->get('image_base_url').$path.DIRECTORY_SEPARATOR.$newFileName;
    }

    public function removeFile($path) {
        $fileSystem = new Filesystem();

        // supprssion de l'ancien fichier s'il existe 
        if($path !== '' && $path != null && $fileSystem->exists('./'.$path)) {
            $fileSystem->remove('./'.$path);
        }
    }

}