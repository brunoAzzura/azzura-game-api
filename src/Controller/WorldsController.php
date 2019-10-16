<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\World;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\WorldDraw;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnsupportedMediaTypeHttpException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


/**
 * @Security("is_authenticated()")
 */
class WorldsController extends Controller{

    // use ControllerTrait;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    // ImageRepository $imageRepository,
    // @param ImageRepository $imageRepository
  
    public function __construct(
        ParameterBagInterface $params
    ) {
        $this->params = $params;
        // $this->imageRepository = $imageRepository;
    }

    /**
     * @View(serializerGroups={"get-worlds"})
     * 
     */
    public function getWorldsAction(){
        $worlds = $this->getDoctrine()
        ->getRepository(World::class)
        ->findAll();

        return $worlds;
    }

    /**
     * @View(serializerGroups={"get-world"})
     */
    public function getWorldAction(?World $world) 
    {
        if( null === $world) {
            return $this->view(null, 404);
        }

        return $world;
    }

    /**
     * @View(serializerGroups={"get-world-themes"})
     */
    public function getWorldsThemesAction(?World $world){
        if( null === $world) {
            return $this->view(null, 404);
        }

        return $world->getThemes();
    }
    
    // @todo : utiliser la nouvelle méthode postWorld
    /**
     * @Rest\Post("/worlds")
     * @View(serializerGroups={"get-world"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("world", converter="fos_rest.request_body")
     */
    public function postWorldsAction(World $world){
        //creates a new resource of this type
        // @todo : essayer avec un merge alors que la propriété est dans world_draw
        $em = $this->getDoctrine()->getManager();
        // $em->persist($world);
        // $em->flush();
        $worldMerge = $em->merge($world);
        
        //if not merge, the worldDraw is not modified 
        $worldDrawMerged = $em->merge($worldMerge->getWorldDraw());
        $worldMerge->setWorldDraw($worldDrawMerged);
        $em->flush();
        return $worldMerge;
    }

    /**
     * @Rest\Post("/uploadFile")
     * @Security("is_granted('ROLE_ADMIN')")
     * @View()
     */
    public function postUploadFile(Request $request){
        // todo: methode a perfectionner

        $fileSystem = new Filesystem();

        if(!$fileSystem->exists('./img/world')){
            $fileSystem->mkdir('./img/world');
        }

        $worldId = $_REQUEST['world_id'];
        $var = $_REQUEST['var'];

        $em = $this->getDoctrine()->getManager();
        $world = $em->getRepository(World::class)
                    ->find($worldId);

        $fileInfos = $_FILES['image'];
        $tempsPath = $fileInfos['tmp_name'];
        $typeInfo = explode('/', $fileInfos['type']);
        $type = $typeInfo[1];



        $time = sprintf("%d", microtime(true) * 1000000);
        

        switch ($var) {
            case "image_path":
                // supprssion de l'ancien fichier s'il existe 
                if($world->getWorldDraw()->getImagePath() && $fileSystem->exists('./'.$world->getWorldDraw()->getImagePath())) {
                    $fileSystem->remove('./'.$world->getWorldDraw()->getImagePath());
                }
                $fileName = "world_".$time.".".$type;
                $world->getWorldDraw()->setImagePath("img/world/".$fileName);
                break;
            case "background":
                // supprssion de l'ancien fichier s'il existe 
                if($world->getWorldDraw()->getBackground() && $fileSystem->exists('./'.$world->getWorldDraw()->getBackground())) {
                    $fileSystem->remove('./'.$world->getWorldDraw()->getBackground());
                }
                $fileName = "world_background_".$time.".".$type;
                $world->getWorldDraw()->setBackground("img/world/".$fileName);
                break;
            case "logo_path":
                // supprssion de l'ancien fichier s'il existe 
                if($world->getWorldDraw()->getLogoPath() && $fileSystem->exists('./'.$world->getWorldDraw()->getLogoPath())) {
                    $fileSystem->remove('./'.$world->getWorldDraw()->getLogoPath());
                }
                $fileName = "world_logo_".$time.".".$type;
                $world->getWorldDraw()->setLogoPath("img/world/".$fileName);
                break;
        }

        $filePath = "./img/world/".$fileName;
        $fileSystem->copy($tempsPath, $filePath, true);

        $em->flush();
        return ["img_path" => "img/world/".$fileName];
    }


    /**
     * @Rest\Put("/worlds")
     * @View(serializerGroups={"get-world"})
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("modifiedWorld", converter="fos_rest.request_body")
     */
    public function putWorldAction(World $modifiedWorld){
        //updates a single resource for this type
        $worldDrawModified = $modifiedWorld->getWorldDraw();
        
        $em = $this->getDoctrine()->getManager();
        $em->merge($modifiedWorld);

        // @todo: modifier le worldDraw en cascade
        // $worldDraw = $modifiedWorld->getWorldDraw();
        // $worldDraw->setWorld($modifiedWorld);
        // $em->merge($worldDraw);

        $worldDraw = $em->getRepository(WorldDraw::class)
        ->find($modifiedWorld->getWorldDraw()->getId());

        $worldDraw->setPositionX($worldDrawModified->getPositionX());
        $worldDraw->setPositionY($worldDrawModified->getPositionY());

        $em->flush();
        return $modifiedWorld;
    }

    ################## New methods to Use #######################

    // , options={"deserializationContext={"groups"={"Deserialize"}"}}
    // /**
    //  * @View(statusCode=201)
    //  * @ParamConverter("world", converter="fos_rest.request_body")
    //  * @Rest\NoRoute()
    //  * @Security("is_granted('ROLE_ADMIN')")
    //  */
    // public function postWorldsAction(World $world) {
    //     // if (count($validationErrors) > 0) {
    //     //     throw new ValidationException($validationErrors);
    //     // }

    //     $em = $this->getDoctrine()
    //         ->getManager();
    //     $em->persist($world);
    //     $em->flush();

    //     return $world;
    // }

    // @Security("is_granted('ROLE_ADMIN')")
    /**
     * @Rest\NoRoute()
     * 
     */
    public function putImageUploadAction(?World $world, ?string $image, Request $request) 
    {

        if(null === $world){
            throw new NotFoundHttpException();
        }

        if(null === $image){
            $image = 'image_path';
        }

        // Read the image content from request body
        $content = $request->getContent();
        // Create the temporary upload file (deleted after request finishes)
        $tmpfile = tmpfile();
        // Get the temporary file name
        $tmpFilePath = stream_get_meta_data($tmpfile)['uri'];
        // Write image content to the temporary file
        file_put_contents(
            $tmpFilePath,
            $content
        );

        // Get the file mime-type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file(
            $finfo,
            $tmpFilePath
        );
        
        // Check if it's really an image (never trust client set mime-type!)
        if (!in_array(
            $mimeType,
            ['image/jpeg', 'image/png', 'image/gif', 'application/octet-stream']
        )) {
            throw new UnsupportedMediaTypeHttpException(
                'File uploaded is not a valid png/jpeg/gif image'
            );
        }

        // Guess the extension based on mime-type
        $extensionGuesser = ExtensionGuesser::getInstance();
        // Generate a new random filename
        $newFileName = md5(uniqid()).'.'.$extensionGuesser->guess($mimeType);

        // Copy the temp file to the final uploads directory
        copy(
            $tmpFilePath,
            $this->params->get('image_directory').DIRECTORY_SEPARATOR.$newFileName
        );

        // $image->setUrl($this->imageBaseUrl.$newFileName);
        // $this->persistImage($image);

        $world->setDescription($this->params->get('image_base_url').$newFileName);
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($world);
        $em->flush();

        return new Response(null, Response::HTTP_OK);
    }

    
    public function deleteWorldAction($slug){
        //deletes a single resource for this type
    }
}    