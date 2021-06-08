<?php

namespace Oro\Bundle\CommentBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * The controller for Comment entity.
 * @Route("/comments")
 */
class CommentController extends AbstractController
{
    /**
     * @Route(
     *      "/form",
     *      name="oro_comment_form"
     * )
     *
     * @AclAncestor("oro_comment_view")
     *
     * @Template("@OroComment/Comment/form.html.twig")
     */
    public function getFormAction()
    {
        $form = $this->get('oro_comment.form.comment.api');

        return [
            'form' => $form->createView()
        ];
    }
}
