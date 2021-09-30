<?php

namespace Oro\Bundle\DataAuditBundle\Config\Validation;

use Oro\Bundle\EntityConfigBundle\Config\Validation\FieldConfigInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * Provides validations field config for dataaudit scope.
 */
class DataauditFieldConfiguration implements FieldConfigInterface
{
    public function getSectionName(): string
    {
        return 'dataaudit';
    }

    public function configure(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->node('auditable', 'normalized_boolean')
                ->info('`boolean` if set to true, any changes to this field become traceable.')
            ->end()
            ->node('propagate', 'normalized_boolean')
                ->info('`boolean` use the option to enable reverse side audit for the relations.')
            ->end()
            ->node('immutable', 'normalized_boolean')
                ->info('`boolean`  this attribute can be used to prohibit changing the auditable state (regardless ' .
                'of whether it is enabled or not) for the entity field. If TRUE, than the current state cannot ' .
                'be changed.')
            ->end()
        ;
    }
}
