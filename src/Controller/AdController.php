<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AnnonceType;
use App\Form\AnnonceEditType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo): Response
    {
        //$repo = $this->getDoctrine()->getRepository(Ad::class);

        $ads = $repo->findAll();

        //dump($ads);

        return $this->render('ad/index.html.twig', [
            'ads' => $ads
        ]);
    }

    /**
     * Permet de créer une annonce
     * @Route("/ads/new", name="ads_create")
     *
     * @return Response
     */
    public function create(EntityManagerInterface $manager, Request $request)
    {
        $ad = new Ad();
        
        

        $form = $this->createForm(AnnonceType::class, $ad);

        $form->handleRequest($request);

        //dump($ad);

        if($form->isSubmitted() && $form->isValid()){


            foreach($ad->getImages() as $image){
                $image->setAd($ad);
                $manager->persist($image);
            }
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce a bien été enregistrée"
            );

            return $this->redirectToRoute('ads_voiture',[
                'slug' => $ad->getSlug()
            ]);

        }
        return $this->render('ad/new.html.twig',[
            'myForm' => $form->createView()
        ]);
    }

     /**
     * Permet de modifier une annonce
     * @Route("/ads/{slug}/edit", name="ads_edit")
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param Ad $ad
     * @return Response
     */
    public function edit(Request $request, EntityManagerInterface $manager, Ad $ad)
    {
        $form = $this->createForm(AnnonceEditType::class, $ad);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $ad->setSlug(''); // pour que initialize slug

            foreach($ad->getImages() as $image){
                $image->setAd($ad);
                $manager->persist($image);
            }

            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success',
                "L'annonce a bien été modifiée"
            );

            return $this->redirectToRoute('ads_voiture',[
                'slug' => $ad->getSlug()
            ]);
        }        


        return $this->render("ad/edit.html.twig",[
            "ad" => $ad,
            "myForm" => $form->createView()
        ]);

    }


    /**
     * Permet d'afficher une seule annonce
     * @Route("/ads/{slug}", name="ads_voiture")
     *
     * @param [string] $slug
     * @return Response
     */
    public function show(Ad $ad)
    {
        //$repo = $this->getDoctrine()->getRepository(Ad::class);
        //$ad = $repo->findOneBySlug($slug);


        //dump($ad);

        return $this->render('ad/voiture.html.twig',[
            'ad' => $ad
        ]);

    }


}