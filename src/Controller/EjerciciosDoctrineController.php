<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Equipo;
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
    #[Route('/ejercicios/buscar/{id}', name: 'ejercicios_doctrine')]
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
}
