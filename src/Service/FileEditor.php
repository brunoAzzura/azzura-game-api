<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FileEditor{

    // @todo : à rendre plus général (fortement lié aux certificats)

    /**
     * @var ParameterBagInterface
     */
    private $params;


    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }

    public function addTextToFile(string $text) {
        $fileSystem = new Filesystem();

        if(!$fileSystem->exists('./img/certificate')){
            $fileSystem->mkdir('./img/certificate');
        }

        // Load And Create Image From Source
        $certificate = imagecreatefromjpeg('./img/certificateEco.jpg');

        // Allocate A Color For The Text Enter RGB Value
        $color = imagecolorallocate($certificate, 0, 0, 0);

        // Set Text to Be Printed On Image
        // Set Path to Font File
        $font_path = './font/font-regular.ttf';
        $size=35;
        $angle=0;
        $left=900;
        $top=745;

        $fileName = md5(uniqid()).'.jpg';
            
        // Print Text On Image
        imagettftext($certificate, $size,$angle,$left,$top, $color, $font_path, $text);

        // Send Image to Browser
        imagejpeg($certificate, './img/certificate/'.$fileName); // , './img/coco2.jpg'

        return $this->params->get('image_base_url').'certificate'.DIRECTORY_SEPARATOR.$fileName;
    }
}