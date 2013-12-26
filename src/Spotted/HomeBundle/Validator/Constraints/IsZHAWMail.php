<?php

namespace Spotted\HomeBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsZHAWMail extends Constraint
{
  //  public $message = 'The string "%string%" contains an illegal character: it can only contain letters or numbers.';
    public $message = 'Die eingegebene E-Mail-Adresse ist nicht von der ZHAW.';
}