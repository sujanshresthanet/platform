<?php

namespace Oro\Bundle\DraftBundle\Config\Validation;

use Oro\Bundle\EntityConfigBundle\Config\Validation\FieldConfigInterface;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;

/**
 * Provides validations field config for draft scope.
 */
class DraftFieldConfiguration implements FieldConfigInterface
{
    public function getSectionName(): string
    {
        return 'draft';
    }

    public function configure(NodeBuilder $nodeBuilder): void
    {
        $nodeBuilder
            ->node('draftable', 'normalized_boolean')
                ->info('`boolean` defines whether field can involved in the draft operation.')
            ->end()
        ;
    }
}
