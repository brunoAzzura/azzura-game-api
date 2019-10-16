<?php

namespace App\DataFixtures;

use App\Entity\World;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Theme;
use App\Entity\WorldDraw;
use App\Entity\ThemeDraw;
use App\Entity\Question;
use App\Entity\Answer;

class LoadWorldData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $world = new World();
        $world->setWording('La cuisine');
        $world->setDescription('La cuisine est un endroit ...');
        $world->setRanking(1);
        $manager->persist($world);
        $manager->flush();

        $worldDraw = new WorldDraw();
        $worldDraw->setPositionX(24);
        $worldDraw->setPositionY(0);
        $worldDraw->setImagePath('img/world/world_22.png');
        $worldDraw->setWording('kitchen');
        $worldDraw->setWorld($world);
        $manager->persist($worldDraw);
        $manager->flush();

        $theme = new Theme();
        $theme->setWording('Frigo');
        $theme->setWorld($world);
        $theme->setDescription('theme du frigo');
        $theme->setRanking(1);
        $manager->persist($theme);
        $manager->flush();

        $question = new Question();
        $question->setWording("Est t'il bon de laisser un frigo ouvert?");
        $question->setComplement('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore');
        $question->setTheme($theme);
        $manager->persist($question);
        $manager->flush();

        $answer = new Answer();
        $answer->setWording('Oui clairement !');
        $answer->setValid(false);
        $answer->setQuestion($question);
        $manager->persist($answer);
        $manager->flush();

        $answer = new Answer();
        $answer->setWording('Surement pas !');
        $answer->setValid(true);
        $answer->setQuestion($question);
        $manager->persist($answer);
        $manager->flush();

        $question = new Question();
        $question->setWording("A quoi sert un frigo?");
        $question->setComplement('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore');
        $question->setTheme($theme);
        $manager->persist($question);
        $manager->flush();

        $answer = new Answer();
        $answer->setWording('A faire du bruit');
        $answer->setValid(false);
        $answer->setQuestion($question);
        $manager->persist($answer);
        $manager->flush();

        $answer = new Answer();
        $answer->setWording('A rechauffer les aliments');
        $answer->setValid(false);
        $answer->setQuestion($question);
        $manager->persist($answer);
        $manager->flush();

        $answer = new Answer();
        $answer->setWording('A conserver les aliments');
        $answer->setValid(true);
        $answer->setQuestion($question);
        $manager->persist($answer);
        $manager->flush();

        $themeDraw = new ThemeDraw();
        $themeDraw->setPositionX('70');
        $themeDraw->setPositionY('30');
        $themeDraw->setWidth(32);
        $themeDraw->setImageErrorPath('frigo_sad.gif');
        $themeDraw->setImageSuccessPath('frigo_happy.gif');
        $themeDraw->setImagePath('frigo.png');
        $themeDraw->setBackgroundQuestionPath('frigo_question.gif');
        $themeDraw->setBackgroundQuestionSuccessPath('frigo_question_success.gif');
        $themeDraw->setBackgroundQuestionErrorPath('frigo_question_error.gif');
        $themeDraw->setTheme($theme);
        $manager->persist($themeDraw);
        $manager->flush();

        $theme = new Theme();
        $theme->setWording('Lave vaisselle');
        $theme->setWorld($world);
        $theme->setDescription('theme du lave vaisselle');
        $theme->setRanking(2);
        $manager->persist($theme);
        $manager->flush();

        $themeDraw = new ThemeDraw();
        $themeDraw->setPositionX('55');
        $themeDraw->setPositionY('60');
        $themeDraw->setWidth(30);
        $themeDraw->setImageErrorPath('');
        $themeDraw->setImageSuccessPath('');
        $themeDraw->setImagePath('lave_vaisselle.png');
        $themeDraw->setBackgroundQuestionPath('frigo_question.gif');
        $themeDraw->setBackgroundQuestionSuccessPath('frigo_question_success.gif');
        $themeDraw->setBackgroundQuestionErrorPath('frigo_question_error.gif');
        $themeDraw->setTheme($theme);
        $manager->persist($themeDraw);
        $manager->flush();

        // $question = new Question();
        // $question->setWording("Quel est le but d'un frigo ?");
        // $question->setDescription('util?');
        // $question->setTheme($theme);

        // $answer = new Answer();
        // $answer->setWording('raffraichir les aliments');
        // $answer->setQuestion($question);
        // //voir pour la persistence en cascade
        // $manager->persist($answer);
        // $manager->flush();


        $world = new World();
        $world->setWording('La salle de bain');
        $world->setDescription('La cuisine est un endroit ...');
        $world->setRanking(2);
        $manager->persist($world);
        $manager->flush();

        $worldDraw = new WorldDraw();
        $worldDraw->setPositionX(23);
        $worldDraw->setPositionY(27);
        $worldDraw->setImagePath('img/world/world_23.png');
        $worldDraw->setWording('bathroom');
        $worldDraw->setWorld($world);
        $manager->persist($worldDraw);
        $manager->flush();
    }
}