<?php

namespace App\Controller;

use App\Entity\Presidente;
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


    // Ejercicio 3 Apartado C
    #[Route('/ejercicios/ligabi/{id}', name: 'ejercicios_doctrine_3B')]
    public function findPlayersByLiga(ManagerRegistry $doctrine, int $id): Response
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


    // Ejercicio 5
    #[Route('/ejercicios/presidenteEquipo/{id}', name: 'ejercicios_doctrine_5')]
    public function FindPresidentByTeamId(ManagerRegistry $doctrine, int $id): Response
    {

        $equipo = $doctrine->getRepository(Equipo::class)->find($id);


        $datos = "Equipo: ". $equipo->getNombre() . "<br>Presidente/a: <br>Nombre:" . $equipo->getPresidente()->getNombre()
        . "<br>Apellidos: " . $equipo->getPresidente()->getApellidos() . "<br>Posesión: " . $equipo->getPresidente()->getPosesion();


        return new Response($datos);

    }


    // Ejercicio 6
    #[Route('/ejercicios/presidente/{id}', name: 'ejercicios_doctrine_6')]
    public function FindPresidentById(ManagerRegistry $doctrine, int $id): Response
    {

        $presidente = $doctrine->getRepository(Presidente::class)->find($id);
        $equipo = $doctrine->getRepository(Equipo::class)->find($presidente->getEquipo());


        $datos = "Presidente: ". $presidente->getNombre() .
            "<br>Equipo:". $equipo->getNombre() .
            "<br>Socios:". $equipo->getSocios() .
            "<br>Fundacion: " . $equipo->getFundacion() .
            "<br>Ciudad: " . $equipo->getCiudad();


        return new Response($datos);
    }


    

}
