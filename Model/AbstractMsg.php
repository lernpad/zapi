<?php

namespace Lernpad\ZApi\Model;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Exception\ValidatorException;

/**
 *
 */
abstract class AbstractMsg implements PackableInterface
{
    private $violations = [];

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
        $validator = Validation::createValidatorBuilder()
                ->addYamlMapping('resources/config/validation.yml')
                ->getValidator();

        $violations = $validator->validate($this);

        if (0 !== count($violations)) {
            $this->violations = $violations;
            return false;
        }
        return true;
    }

    /**
     *
     */
    public function validate()
    {
        $validator = Validation::createValidatorBuilder()
                ->addYamlMapping('resources/config/validation.yml')
                ->getValidator();

        $violations = $validator->validate($this);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                throw new ValidatorException($violation->getMessage());
            }
        }
    }

    public function getViolations()
    {
        return $this->violations;
    }
}
