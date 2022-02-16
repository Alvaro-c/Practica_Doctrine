<?php

namespace App\Controller;

use App\Entity\Partido;
use App\Entity\Partidobidireccional;
use App\Entity\Presidente;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Equipo;
use App\Repository\EquipoRepository;
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
    #[Route('/ejercicios/equiposliga/{id}', name: 'ejercicios_doctrine_3B')]
    public function searchLiga(ManagerRegistry $doctrine, int $id): Response
    {


        $array_de_equipos = $doctrine->getRepository(Equipo::class)->findAll();
        $datos = '';

        foreach ($array_de_equipos as $equipo){
            if($equipo->getLiga()->getId() == $id) {

                $datos = $datos . '- ' . $equipo->getnombre() . ' <br>';
            }
        }

        return new Response($datos);
    }


    // Ejercicio 3 Apartado C
    #[Route('/ejercicios/ligabi/{id}', name: 'ejercicios_doctrine_3C')]
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
        // Datos del equipo
        $equipo = $doctrine->getRepository(Equipo::class)->find($id);
        // Del objeto equipo se sacan todos los demás datos del presidente asociado
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

    // Ejercicio 7
    #[Route('/ejercicios/partido7/{id}', name: 'ejercicios_doctrine_7')]
    public function FindMatchById(ManagerRegistry $doctrine, int $id): Response
    {

        // Se obtiene el partido
        $partidos = $doctrine->getRepository(Partido::class)->find($id);

        // A partir del partido, dentro están los datos del local y el visitante
        $local = $doctrine->getRepository(Equipo::class)->find($partidos->getLocal());
        $visitante = $doctrine->getRepository(Equipo::class)->find($partidos->getVisitante());

        $datos = "Equipo local: ". $local->getNombre() .
                 "<br>Equipo visitante: ". $visitante->getNombre();

        return new Response($datos);
    }


    // Ejercicio 8 FALTA
    #[Route('/ejercicios/partidos8/{id}', name: 'ejercicios_doctrine_8')]
    public function datesById(ManagerRegistry $doctrine, int $id): Response
    {

        $equipo = $doctrine->getRepository(Equipobidireccional::class)->find($id);
        $partidosLocal = $equipo->getVisitantes();
        $datos = '';

        // Se guardan las fechas como local

        foreach ($partidosLocal as $partido) {
            $datos = "1";
            //$datos = $datos . "Local: " . $partido->getFecha() . "<br>";
        }


        return new Response($datos);
    }

    // Ejercicio 9
    #[Route('/ejercicios/equipos/fundacion', name: 'ejercicios_doctrine_9')]
    public function teamsByFoundation(ManagerRegistry $doctrine): Response
    {
        // Llamada al método que encuentra todos los equipos ordenados por fundación
        $equipos = $doctrine->getRepository(Equipo::class)->findByFoundation();
        $datos = '';

        // Se imprimen los resultados
        foreach ($equipos as $equipo) {

            $datos = $datos . "Equipo: " . $equipo->getNombre() . "; Fundación: ". $equipo->getFundacion() . "<br>";
        }

        return new Response($datos);
    }

    // Ejercicio 10
    #[Route('/ejercicios/partidos/visitante/{id}', name: 'ejercicios_doctrine_10')]
    public function teamsByVisitante(ManagerRegistry $doctrine, int $id): Response
    {
        // El método está hecho para que se pueda comprobar el visitante. Se fuerza el id para que siempre sea el del Bcn
        //Hardcoded id= 2 (Barcelona)
        $id = 2;

        // Llamada al método que encuentra todos los partidos del visitante con el ID pasado por parámetro
        $partidos = $doctrine->getRepository(Partido::class)->findByVisitante($id);
        $datos = '';

        // Se imprime cada uno de los partidos
        foreach ($partidos as $partido) {

            $datos = $datos .
                    "Partido: " . $partido->getId() . "; " .
                    "Local: ". $partido->getLocal()->getNombre() . "; " .
                    "Goles Local: ". $partido->getGolesLocal() . "; " .
                    "Visitante: ". $partido->getVisitante()->getNombre() . "; " .
                    "Goles Visitante: ". $partido->getGolesVisitante() . "; " .
                    "Fecha: ". $partido->getFecha() . "; " . "<br>";
        }

        return new Response($datos);
    }

}
