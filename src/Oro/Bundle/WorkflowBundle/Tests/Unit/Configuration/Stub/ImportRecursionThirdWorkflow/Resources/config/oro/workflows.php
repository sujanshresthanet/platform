<?php return [
    'first' => [
        'entity' => 'Entity1',
        'steps' => [
            'step_one' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
            'step_three' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
            'step_two' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
        ],
        'transitions' => [
            'transition_one' => [
                'is_start' => true,
                'step_to' => 'step_one',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
            'transition_three' => [
                'is_start' => true,
                'step_to' => 'step_three',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
            'transition_two' => [
                'is_start' => true,
                'step_to' => 'step_two',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
        'defaults' => ['active' => false,],
        'priority' => 0,
        'scopes' => [],
        'datagrids' => [],
        'disable_operations' => [],
        'applications' => [0 => 'default',],
        'attributes' => [],
        'transition_definitions' => [],
        'entity_restrictions' => [],
        'exclusive_active_groups' => [],
        'exclusive_record_groups' => [],
    ],
    'second' => [
        'entity' => 'Entity2',
        'steps' => [
            'step_one' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
            'step_three' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
            'step_two' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
        ],
        'transitions' => [
            'transition_one' => [
                'is_start' => true,
                'step_to' => 'step_one',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
            'transition_three' => [
                'is_start' => true,
                'step_to' => 'step_three',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
            'transition_two' => [
                'is_start' => true,
                'step_to' => 'step_two',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
        'defaults' => ['active' => false,],
        'priority' => 0,
        'scopes' => [],
        'datagrids' => [],
        'disable_operations' => [],
        'applications' => [0 => 'default',],
        'attributes' => [],
        'transition_definitions' => [],
        'entity_restrictions' => [],
        'exclusive_active_groups' => [],
        'exclusive_record_groups' => [],
    ],
    'third' => [
        'entity' => 'Entity3',
        'steps' => [
            'step_one' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
            'step_three' => [
                'order' => 0,
                'is_final' => false,
                '_is_start' => false,
                'entity_acl' => [],
                'allowed_transitions' => [],
                'position' => [],
            ],
        ],
        'transitions' => [
            'transition_one' => [
                'is_start' => true,
                'step_to' => 'step_one',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
            'transition_three' => [
                'is_start' => true,
                'step_to' => 'step_three',
                'is_hidden' => false,
                'is_unavailable_hidden' => false,
                'acl_message' => null,
                'frontend_options' => [],
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
        'defaults' => ['active' => false,],
        'priority' => 0,
        'scopes' => [],
        'datagrids' => [],
        'disable_operations' => [],
        'applications' => [0 => 'default',],
        'attributes' => [],
        'transition_definitions' => [],
        'entity_restrictions' => [],
        'exclusive_active_groups' => [],
        'exclusive_record_groups' => [],
    ],
];
