<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    /**
     * @Route("/article/{id}", name="view_article")
     * @param Article $article
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Article $article)
    {
        return $this->render('articles/view.html.twig',['article'=>$article]);
    }

    /**
     * @Route("/articles", name="all_articles")
     */
    public function showAll()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        return $this->render('articles/show_all.html.twig', ['articles', $articles]);
    }

}
