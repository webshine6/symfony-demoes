<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method("GET")
     */
    public function indexAction()
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->add('submit', SubmitType::class);

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView()
        ));
    }


    /**
     * @Route("/", name="create_article_process")
     * @Method("POST")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createArticleAction(Request $request)
    {
        $article = new Article();
        $article->setCreatedOn(new \DateTime('now'));

        $form = $this->createForm(ArticleType::class, $article);
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            var_dump($article);
            exit;
        }

    }

}
