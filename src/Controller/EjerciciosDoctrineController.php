<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Equipo;
use App\Entity\Liga;
use App\Entity\Equipobidireccional;
use App\Entity\Jugador;
use App\Entity\Jugadorbidireccional;
use App\Repository\JugadorRepository;

class EjerciciosDoctrineController extends AbstractController
{
    #[Route('/ejercicios/doctrine', name: 'ejercicios_doctrine')]
    public function index(): Response
    {
        return $this->render('ejercicios_doctrine/index.html.twig', [
            'controller_name' => 'EjerciciosDoctrineController',
        ]);
    }

    // Ejercicio 3, apartado A
    #[Route('/ejercicios/buscar/{id}', name: 'ejercicios_doctrine_3A')]
    public function searchPlayer(ManagerRegistry $doctrine, int $id): Response
    {
        $jugador = $doctrine->getRepository(Jugadorbidireccional::class)->find($id);

        if (!$jugador){
            throw $this->createNotFoundException(
                'No hay ningún jugador con el id: ' . $id
            );
        }
        $equipo=$jugador->getEquipoBid();

        return new Response('El jugador buscado es ' . $jugador->getnombre() .' ' . $jugador->getapellidos()
        .'. Su equipo es: '. $equipo->getnombre());
    }

    // Ejercicio 3, apartado B
    #[Route('/ejercicios/liga/{id}', name: 'ejercicios_doctrine_3B')]
    public function searchLiga(ManagerRegistry $doctrine, int $id): Response
    {
        

        $array_de_equipos = $doctrine->getRepository(Equipobidireccional::class)->findAll();
        $datos = '';
        foreach ($array_de_equipos as $equipo){
            $datos = $datos . '- ' . $equipo->getnombre() . ' <br>';
        }



        return new Response($datos);
    }


    // Ejercicio 3, apartado C
    #[Route('/ejercicios/ligabi/{id}', name: 'ejercicios_doctrine_3C')]
    // public function searchLigaBi(ManagerRegistry $doctrine, int $id): Response
    // {
        
    //     $array_de_equipos = $doctrine->getRepository(Equipo::class)->findAll();
    //     $datos = '';

    //     $array_de_equipos = $doctrine->getRepository(Equipo::class)->findBy(array('liga_id' => $id));
        
        
    //     foreach ($array_de_equipos as $equipo){

    //         $datos = $datos . '' . $equipo->getnombre() . ' <br>';

    //         $array_de_jugadores = $doctrine->getRepository(Jugador::class)->findAll();
    //         // $array_de_jugadores = $doctrine->getRepository(Jugador::class)->findByJugadorByLigaId($id);

    //         foreach($array_de_jugadores as $jugador) {

    //             $datos = $datos . '- ' . $jugador->getnombre() . ' <br>';

    //         }

    //         $datos = $datos . ' <br><br>';
    //     }



    //     return new Response($datos);
    // }

    // metodo 3C
    #[Route('/ejercicios/ligabi/{id}', name: 'buscar_Jugador_LigaUnid')]
    public function buscar__Jugador_Liga(ManagerRegistry $doctrine, int $id): Response
    {

        $jugadores = $doctrine->getRepository(Jugador::class)->findAll();

        $datos = '';

        foreach ($jugadores as $jugador) {

            if ($jugador->getEquipo()->getLiga()->getId() == $id) {
                $datos = $datos . $jugador->getNombre(). "<br> ";
            }


        }

        return new Response($datos);
    }






}
