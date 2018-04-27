<?php return [
    'chained_result' => [
        'entity' => 'MyOwn\\SuperCustom\\Entity',
        'steps' => [
            'step_a' => [
                'allowed_transitions' => ['transition_two'],
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'position' => [],
            ],
            'step_b' => [
                'is_final' => true,
                'order' => 0,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
        ],
        'attributes' => [
            'attribute1' => ['type' => 'string', 'property_path' => null, 'options' => []],
            'attribute2' => ['type' => 'integer', 'property_path' => null, 'options' => []],
        ],
        'transitions' => [
            'transition_two' => [
                'step_to' => 'step_b',
                'frontend_options' => ['icon' => 'foo'],
                'is_start' => false,
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'form_type' => 'Oro\Bundle\WorkflowBundle\Form\Type\WorkflowTransitionType',
                'display_type' => 'dialog',
                'destination_page' => '',
                'form_options' => [],
                'page_template' => null,
                'dialog_template' => null,
                'init_entities' => [],
                'init_routes' => [],
                'init_datagrids' => [],
                'init_context_attribute' => 'init_context',
                'message_parameters' => [],
                'triggers' => [],
            ],
        ],
        'is_system' => false,
        'start_step' => null,
        'force_autostart' => false,
        'entity_attribute' => 'entity',
        'steps_display_ordered' => false,
        'defaults' => ['active' => false],
        'priority' => 0,
        'scopes' => [],
        'datagrids' => [],
        'disable_operations' => [],
        'applications' => ['default'],
        'transition_definitions' => [],
        'entity_restrictions' => [],
        'exclusive_active_groups' => [],
        'exclusive_record_groups' => [],
    ],
];
