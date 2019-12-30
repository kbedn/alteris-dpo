<?php

namespace App\Validator;

use App\Entity\MaterialGroup;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class NodeWithNoChildrenValidator extends ConstraintValidator
{
    /**
     * @var NestedTreeRepository
     */
    protected $materialGroupRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->materialGroupRepository = $em->getRepository(MaterialGroup::class);
    }

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof NodeWithNoChildren) {
            throw new UnexpectedTypeException($constraint, NodeWithNoChildren::class);
        }

        $group = $this->materialGroupRepository->find($value);
        if ($this->materialGroupRepository->childCount($group) === 0) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
