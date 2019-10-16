<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Filesystem\Filesystem;
use App\Entity\PuzzleGame;
use App\Entity\PuzzlePiece;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_authenticated()")
 */
class PuzzleGameController extends AbstractController{
    use ControllerTrait;

    /**
     * @Rest\Put("/puzzlegames")
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     * @ParamConverter("puzzleGame", converter="fos_rest.request_body")
     */
    public function putPuzzleGamesAction(PuzzleGame $puzzleGame){
        //updates a single resource for this type
        $em = $this->getDoctrine()->getManager();
        $em->merge($puzzleGame);

        $em->flush();
        return $puzzleGame;
    }

    // @todo :a deplacer dans un nouveau controller

    /**
     * @Rest\Post("/uploadFilePuzzlePiece")
     * @Security("is_granted('ROLE_ADMIN')")
     * @View()
     */
    public function postUploadFilePuzzlePiece(Request $request){
        $em = $this->getDoctrine()->getManager();
        $fileSystem = new Filesystem();
        if(!$fileSystem->exists('./img/puzzle')){
            $fileSystem->mkdir('./img/puzzle');
        }

        $puzzleGameId = $_REQUEST['puzzle_game_id'];
        
        $puzzleGame = null;

        if(isset($_REQUEST['puzzle_game_id'])){
            $puzzleGameId = $_REQUEST['puzzle_game_id'];
            $puzzleGame = $this->getDoctrine()
            ->getRepository(PuzzleGame::class)
            ->find($puzzleGameId);
        }

        
        $pieceId = null;
        if(isset($_REQUEST['puzzle_piece_id'])) {
            $pieceId = $_REQUEST['puzzle_piece_id'];
            $piece = $this->getDoctrine()
            ->getRepository(PuzzlePiece::class)
            ->find($pieceId);

            // supprssion de l'ancien fichier s'il existe 
            if($fileSystem->exists('./'.$piece->getImagePath())) {
                $fileSystem->remove('./'.$piece->getImagePath());
            }
        } else {
            $piece = new PuzzlePiece();
            $piece->setPuzzleGame($puzzleGame);
            $piece->setImagePath('');
            $piece->setPieceOrder($_REQUEST['piece_order']);
            $em->persist($piece);
            // premiere sauvegarde pour obtenir un ID afin de nommer le ficher
            $em->flush();
        }

        $fileInfos = $_FILES['puzzlePieceImage'];
        $tempsPath = $fileInfos['tmp_name'];
        $typeInfo = explode('/', $fileInfos['type']);
        $type = $typeInfo[1];

        $fileName = "puzzle_".sprintf("%d", microtime(true) * 1000000).".".$type;
        $piece->setImagePath("img/puzzle/".$fileName);

        $filePath = "./img/puzzle/".$fileName;
        $fileSystem->copy($tempsPath, $filePath, true);
        
        $em->flush();

        return $piece;
    }

    /**
     * @Rest\Put("/puzzlepieces")
     * @Security("is_granted('ROLE_ADMIN')")
     * @View()
     * @ParamConverter("puzzlePiece", converter="fos_rest.request_body")
     */
    public function putPuzzlePiecesAction(PuzzlePiece $puzzlePiece){
        //updates a single resource for this type
        $em = $this->getDoctrine()->getManager();
        $em->merge($puzzlePiece);

        $em->flush();
        return $puzzlePiece;
    }

    /**
     * @Rest\Delete("/puzzlepieces/{puzzlePiece}")
     * @View()
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function deletePuzzlePiecesAction(PuzzlePiece $puzzlePiece)
    {
        //@todo : creater an upload/delete image class
        $em = $this->getDoctrine()->getManager();

        $puzzleGameId = $puzzlePiece->getPuzzleGame()->getId();
        $order = $puzzlePiece->getPieceOrder();

        $pieces = $this->getDoctrine()->getRepository(PuzzlePiece::class)->findAllPuzzleGamePiecesGreaterThanOrder($puzzleGameId, $order);

        foreach($pieces as $piece){
            $piece->setpieceOrder($piece->getPieceOrder() -1);
            $em->persist($piece);
            // $em->flush();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($puzzlePiece);
        $em->flush();
    }

    /**
     * @View()
     */
    public function getPuzzlegamePiecesAction(PuzzleGame $puzzleGame){
        //return all sub-ressources
        return $puzzleGame->getPuzzlePieces();
    }


}

?>  