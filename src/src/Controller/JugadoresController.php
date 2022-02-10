<?php
namespace App\Controller;

use App\Entity\Equipo;
use App\Entity\Equipobidireccional;
use App\Entity\Jugador;
use App\Repository\JugadorRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JugadoresController extends AbstractController
{
    // Mostramos los jugadores del equipo con el id de la URL
    #[Route('/controlador/bidireccional/{id}', name: 'jugadores_equipo')]
    public function verjugadores(ManagerRegistry $doctrine, int $id): Response
    {
        $equipo = $doctrine->getRepository(Equipobidireccional::class)->find($id);
        $array_de_jugadores = $equipo->getjugadores();
        $datos = '';
        foreach ($array_de_jugadores as $jugador){
            $datos = $datos . '- ' . $jugador->getnombre() . ' ' . $jugador->getapellidos() . ', ' . $jugador->getedad() .' años <br>';
        }

        return new Response('Los jugadores del '. $equipo->getnombre() . ' son: <br>'. $datos );
    }
    // Insertamos un jugador un jugador en el equipo con el id de la URL
    #[Route('/controlador/insertar/{id}', name: 'insertar_jugador')]
    public function insertarjugador(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        //Buscamos el equipo donde insertar el jugador
        $equipo = $doctrine->getRepository(Equipo::class)->find($id);
        $jugador = new Jugador();
        $jugador->setnombre('Gabriel');
        $jugador->setapellidos('Saiz');
        $jugador->setedad(19);
        //Como las entidades están relaciones, pasamos como argumento el equipo encontrado
        $jugador->setequipo($equipo);
        // Decimos a Doctrine que queremos guardar al jugador
        $entityManager->persist($jugador);
        // Ejecutamos la consulta de guardado.
        $entityManager->flush();
        return new Response('Id asignado al jugador: ' . $jugador->getId());
    }

    // Buscamos un jugador según el ID de la URL
    // Devolvemos su nombe y apellidos y el nombre del equipo
    #[Route('/controlador/buscar/{id}', name: 'buscar_jugador')]
    public function buscarjugador(ManagerRegistry $doctrine, int $id): Response
    {
        $jugador = $doctrine->getRepository(Jugador::class)->find($id);

        if (!$jugador){
            throw $this->createNotFoundException(
                'No hay ningún jugador con el id: ' . $id
            );
        }
        $equipo=$jugador->getEquipo();

        return new Response('El jugador buscado es ' . $jugador->getnombre() .' ' . $jugador->getapellidos()
    .'. Su equipo es: '. $equipo->getnombre());
    }

    // Buscamos un jugador según el ID de la URL
    // Devolvemos su nombe y apellidos
    // Usamos el repositorio del jugador en vez del ManagerRigistry
    #[Route('/controlador/buscar2/{id}', name: 'buscar2_jugador')]
    public function buscardosjugador(JugadorRepository $jugadorRepository, int $id): Response
    {
        $jugador = $jugadorRepository->find($id);

        if (!$jugador){
            throw $this->createNotFoundException(
                'No hay ningún jugador con el id: ' . $id
            );
        }
        
        return new Response('El jugador buscado es ' . $jugador->getnombre() .' ' . $jugador->getapellidos());
    }

    // Buscamos un jugador según el ID de la URL
    // Actualizamos su nombre a Antonio
    #[Route('/controlador/actualizar/{id}', name: 'actualizar_jugador')]
    public function actualizarjugador(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $jugador = $doctrine->getRepository(Jugador::class)->find($id);

        if (!$jugador){
            throw $this->createNotFoundException(
                'No hay ningún jugador con el id: '.$id
            );
        }
        $jugador->setnombre('Antonio');
        $entityManager->flush();
          return new Response('El nombre se ha actualizado a: ' . $jugador->getnombre());
    }

    // Buscamos un jugador según el ID de la URL
    // Borramos el jugador encontrado
    #[Route('/controlador/borrar/{id}', name: 'borrar_jugador')]
    public function borrarjugador(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $jugador = $doctrine->getRepository(Jugador::class)->find($id);

        if (!$jugador){
            throw $this->createNotFoundException(
                'No hay ningún jugador con el id: '.$id
            );
        }
        $entityManager->remove($jugador);
        $entityManager->flush();
        
        return new Response('El jugador se ha borrado correctamente');
    }


}
