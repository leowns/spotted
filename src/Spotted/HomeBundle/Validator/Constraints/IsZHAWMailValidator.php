<?php

namespace Spotted\HomeBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class IsZHAWMailValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        list($user, $domain) = explode('@', $value);

        // Check if mail is a zhaw email
        if ($domain != 'students.zhaw.ch' && $domain != 'zhaw.ch') {
            $this->context->addViolation($constraint->message, array('%string%' => $value));
        }
    }
}