<?php

namespace Oro\Bundle\SegmentBundle\Query;

use Symfony\Bridge\Doctrine\ManagerRegistry;

use Oro\Bundle\SegmentBundle\Entity\Segment;
use Oro\Bundle\SegmentBundle\Entity\SegmentType;
use Oro\Bundle\QueryDesignerBundle\QueryDesigner\Manager;
use Oro\Bundle\SegmentBundle\Model\RestrictionSegmentProxy;
use Oro\Bundle\QueryDesignerBundle\QueryDesigner\RestrictionBuilder;

class DynamicSegmentQueryBuilder
{
    /** @var RestrictionBuilder */
    protected $restrictionBuilder;

    /** @var Manager */
    protected $manager;

    /** @var ManagerRegistry */
    protected $doctrine;

    /**
     * @param RestrictionBuilder $restrictionBuilder
     * @param Manager            $manager
     * @param ManagerRegistry    $doctrine
     */
    public function __construct(
        RestrictionBuilder $restrictionBuilder,
        Manager $manager,
        ManagerRegistry $doctrine
    ) {
        $this->restrictionBuilder = $restrictionBuilder;
        $this->manager            = $manager;
        $this->doctrine           = $doctrine;
    }

    /**
     * Builds query based on dynamic segment definition
     * Returns query that could be applied in WHERE statement for filtering by segment conditions
     *
     * @param Segment $segment
     *
     * @return \Doctrine\ORM\Query
     * @throws \LogicException
     */
    public function build(Segment $segment)
    {
        $converter = new SegmentQueryConverter($this->manager, $this->doctrine, $this->restrictionBuilder);
        $qb        = $converter->convert(
            new RestrictionSegmentProxy($segment, $this->doctrine->getManagerForClass($segment->getEntity()))
        );

        return $qb->getQuery();
    }
}
