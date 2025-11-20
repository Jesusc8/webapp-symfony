<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Snippet;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

final class CommentController extends AbstractController
{
    #[Route('/snippet/{id}/comment/new', name: 'app_comment_new', methods:['POST'])]
    public function newComment(
        #[CurrentUser] User $user,
        EntityManagerInterface $entityManager,
        Snippet $snippet,
        Request $request
    ): Response
    {
        $content = $request->get('content');

        $comment = (new Comment())
            ->setAuthor($user)
            ->setSnippet($snippet)
            ->setContent($content);

        if (!empty($content))
        {
            $entityManager->persist($comment);
            $entityManager->flush();

        }

        return $this->redirectToRoute('item', ['slug' => $snippet->getSlug()]);
    }
}
