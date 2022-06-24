<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SalarieController extends AbstractController
{
    #[Route('/', name: 'app_salarie')]
    public function index(EmployesRepository $empRepo): Response
    {

        $salaries = $empRepo->findAll();

        return $this->render('salarie/index.html.twig', [
            'salaries' => $salaries,
        ]);
    }





    /**
     * Undocumented function
     *
     * @Route("/ajouter", name="salarie_ajouer")
     */
    public function salarie_ajouter(Request $request, EntityManagerInterface $manager): Response
    {

        $salarie = new Employes;

        $form = $this->createForm(EmployesType::class, $salarie);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            
            $manager->persist($salarie);
            $manager->flush();

            //$reposalarie->add($salarie);


            // notification
            $this->addFlash('success', 'Le salarié N° '  . $salarie->getId() . ' a bien été ajouté');


            // Redurection
            return $this->redirectToRoute('app_salarie');
        }

        return $this->render("salarie/ajouter.html.twig", [
            "form" => $form->createView()

        ]);
    }




    #[Route('/voir/{id}', name: 'salarie_voir')]
    public function voir(Employes $salarie): Response
    {  
        return $this->render('salarie/voir.html.twig', [
            'salarie' => $salarie
        ]);
    }




    #[Route('/modifier/{id}', name: 'salarie_modifier')]
    public function modifier(Employes $salarie, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(EmployesType::class, $salarie);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            
            $manager->persist($salarie);
            $manager->flush();


            // notification
            $this->addFlash('success', 'Le salarie N° '  . $salarie->getId() . ' a bien été modifier');


            // Redurection
            return $this->redirectToRoute('app_salarie');
        }

        return $this->render('salarie/modifier.html.twig', [
            'salarie' => $salarie,
            'form' => $form->createView()
        ]);
    }



     /**
     * @Route("/supprimer/{id}", name="salarie_supprimer")
     */
    public function produit_supprimer(Employes $salarie, EntityManagerInterface $manager): Response
    {
        $idSalarie = $salarie->getId();
        $manager->remove($salarie);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le salarié N° $idSalarie a bien été supprimé"
        );

        return $this->redirectToRoute("app_salarie");
    }




}
