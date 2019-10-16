<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends HttpException
{
    public function __construct(ConstraintViolationListInterface $constraintViolationList)
    {
        $message = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($constraintViolationList as $violation) {
            $message[$violation->getPropertyPath()] = $violation->getMessage();
        }

        parent::__construct(404, json_encode($message));
    }
}


// use Throwable;
// use Symfony\Component\Validator\ConstraintViolationListInterface;

// class ValidationException extends \Exception
// {
//     public function __construct(
//         string $message = "",
//         int $code = 0,
//         Throwable $previous = null,
//         ?ConstraintViolationListInterface $constraintViolationList = null
//     ) {
//         $message = [];

//         /** @var ConstraintViolationInterface $violation */
//         foreach ($constraintViolationList as $violation) {
//             $message[] = $violation->getPropertyPath() . " : " . $violation->getMessage();
//         }

//         parent::__construct(implode('\n',$message));
//     }
// }