<?php
namespace App\Controller;
use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;


class PersonneController extends AbstractController
{
    // #[Route('/', name:'premierePage')]
    // public function accueil(): Response
    // {
    //     return $this->render('/index.html.twig',[

    //     ]);
    // } 

    // #[Route('/tableau', name: 'tableauDescriptif')]
    // public function liste(): Response
    // {
    //     return $this->render('/tableau.html.twig', [  
    //     ]);
    // } 

    // #[Route('/formulaire', name: 'formulaireDescriptif')]
    // public function formulaire(): Response
    // {
    //     return $this->render('/formulaire.html.twig', [  
    //     ]);
    // } 

    #[Route('/', name: 'premierePage')]
    public function base(): Response
    {
        return $this->render('corection/base.html.twig', [  
        ]);
    } 

    #[Route('/index', name: 'deuxiemePage')]
    public function index(): Response
    {
        return $this->render('corection/index.html.twig', [  
        ]);
    } 

    #[Route('/list', name: 'pageListe')]
    public function list(EtudiantRepository $etudiantRepository): Response
    {
        $etudiant = $etudiantRepository->findAll();
        // dd($etudiant);
        return $this->render('corection/list.html.twig', 
        ['data'=>$etudiant, 
        ]);
    }
    //pour enregistrer le infos du formulaire
    // #[Route('/save', name: 'save_my_form', methods:['POST'])]
    
    // // public function savingMyForm(): Request
    // public function savingMyForm()
    // {
    //   // dd('OK');
    //   $request = Request::createFromGlobals();
    //  //dd($request->request->all());
    //   $datas = $request->request->all();
    //   return $this->render('corection/list.html.twig',["datas"=>$datas]);
    // } 


    // Pour enregistrer le formulaire dans la base de donnée
    
    #[Route('/save', name: 'save_form')] 
    public function saveFrom( EntityManagerInterface $entityManager , Request $request)
{
    $nom = $request->request->get('nom');
    $user = new Etudiant();
    $user ->setNom($nom);
    $user ->setPrenom($request->request->get('prenom'));
    $user ->setDateNaissance(new \DateTime($request->request->get('dateNaissance')) );
    $user ->setNiveauScolaire($request->request->get('niveauScolaire') );
    $user ->setModuleSouhaite($request->request->get('moduleSouhaite'));
    $user ->setMotifInscription($request->request->get('motifInscription'));
    $user ->setDateCreated(new \Datetime() );

        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'enregitrement éffectué');  
           
    return $this->redirectToRoute('pageListe');
}

    public function retrieveInformation(EtudiantRepository $etudiantRepository): Response
    {
    $etudiant = $etudiantRepository->findAll();
    // dd($etudiant);
    // Envoyez le tableau de données à votre vue
    return $this->render('corection/list.html.twig', [
        'data' => $etudiant,
    ]);
}
}

?>