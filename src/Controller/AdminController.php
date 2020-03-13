<?php

namespace App\Controller;

use App\Entity\Voyage;
use App\Form\VoyageFormType;
use App\Repository\AdminRepository;
use App\Repository\VoyageRepository;



use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/login", name="admin_login")
     */
    public function login(AuthenticationUtils $auth)
    {
        $error = $auth->getLastAuthenticationError();
        return $this->render('admin/login.html.twig',[
            'error' => $error !== null
        ]);
    }

    /**
     * @Route("/admin/logout", name="admin_logout")
     */
    public function logout(){

    }

    /**
     * @Route("/admin/voyages", name="admin_voyages")
     */
    public function voyages(VoyageRepository $voyagesRepo){
        return $this->render('admin/voyages.html.twig', [
            'voyages' => $voyagesRepo->findAll()
        ]);
    }

    /**
     * @Route("/admin/voyages/nouveau", name="admin_voyages_nouveau")
     */
    public function nouveau(Request $request, ObjectManager $manager){
        $voyage = new Voyage();
        $form = $this->createForm(VoyageFormType::class, $voyage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //dd($voyage);
            $manager->persist($voyage);
            $manager->flush();
            return $this->redirectToRoute('admin_voyages');
        }

        return $this->render('admin/nouveau.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/voyages/{id}/delete", name="admin_voyages_delete")
     */
    public function delete(Voyage $voyage, ObjectManager $manager){
        $manager->remove($voyage);
        $manager->flush();
        return $this->redirectToRoute('admin_voyages');
    }

    /**
     * @Route("/admin/voyages/{id}/edit", name="admin_voyages_edit")
     */
    public function edit(Voyage $voyag, Request $request, ObjectManager $manager){
        $form = $this->createForm(VoyageFormType::class, $voyage);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            //dd($voyage);
            $manager->persist($voyage);
            $manager->flush();
            return $this->redirectToRoute('admin_voyages');
        }

        return $this->render('admin/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
