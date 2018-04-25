<?php

namespace Lernpad\ZApi\Model;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 *
 */
abstract class AbstractMsg implements PackableInterface
{
    /**
     *
     */
    abstract public function pack();

    /**
     *
     */
    abstract public function unpack($bytes);

    /**
     *
     */
    public function isValid()
    {
        $validator = Validation::createValidator();

        $validator = Validation::createValidatorBuilder()
                ->addYamlMapping('resources/config/validation.yml')
                ->getValidator();

        $violations = $validator->validate($this);

        if (0 !== count($violations)) {
            // there are errors, now you can show them
            foreach ($violations as $violation) {
                throw new ValidatorException($violation->getMessage());
            }
        }
    }
}
