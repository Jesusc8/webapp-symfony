<?php 

namespace App\Controller;

use App\Entity\Snippet;
use App\Repository\SnippetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    #[Route('/', name: 'home')]

    public function index(
        SnippetRepository $snippetRepository
    ):Response
    {
        $snippets = $snippetRepository->findAll();

        return $this->render('pages/home.html.twig', [
            'title' => 'Home Page.',
            'snippets' => $snippets,
        ]);

    }

    #[Route('/item{id}', name: 'item')]

    public function item(
        int $id,
        SnippetRepository $snippetRepository
        ):Response
    {
        $snippet = $snippetRepository->find($id);
        
        if (!$snippet) {
            throw $this->createNotFoundException('snippet not found');
            
        }
        
        return $this->render('pages/item.html.twig', [
            'title' => $snippet->getTitle(),
            'snippet' => $snippet,
        ]);
    }
}