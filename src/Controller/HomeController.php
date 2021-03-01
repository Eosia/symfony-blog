<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    private $repoArticle;
    public function  __construct(ArticleRepository $repoArticle)
    {
    $this->repoArticle = $repoArticle;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(CategoryRepository $repoCategory): Response
    {

        $categories = $repoCategory->findAll();

        $articles = $this->repoArticle->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
            'categories'=>$categories
        ]);
    }



    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Article $article): Response
    {

        if(!$article){
           return $this->redirectToRoute('home');
        }

        return $this->render('show/index.html.twig', [
            'article' => $article,
        ]);
    }
}

/**
 * @Route("/showArticles/{id}", name="showarticle")
 */
public function showArticle(Category $category): Response
{


    return $this->render('show/showArticle.html.twig', [
        'category' => $category,
    ]);
}
}
