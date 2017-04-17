<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/", name="create_article_process")
     * @Method("POST")
     * @param Request $request
     */
    public function createArticleProcess(Request $request)
    {
       $article = new Article();
       $article->setCreatedOn(new \DateTime('now'));

       $form = $this->createForm(ArticleType::class, $article);
       $form->handleRequest($request);

       if ($form->isValid()) {
           var_dump($article);
           exit;
       }

      var_dump($form->getErrors(true, false));
      exit;
    }
}
