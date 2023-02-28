<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Movie;
use App\Entity\Actor;
use App\Entity\Cast;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use App\Repository\ActorRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @Route("/api2", name="movie")
 */
class MovieController extends AbstractController
{
    private $movieRepository;
    private $actorRepository;

    public function __construct(
        MovieRepository $movieRepository,
        ActorRepository $actorRepository
    )
    {
        $this->movieRepository = $movieRepository;
        $this->actorRepository = $actorRepository;
    }

     /**
     * @Route("/movies", name="movie_index", methods={"GET"})
     */
    public function index(ManagerRegistry $doctrine,MovieRepository $movieRepository): JsonResponse
    {
        $movies = $doctrine->getRepository(Movie::class)->findAll();

            foreach ($movies as $movie) {
                $movieData = [
                    'id' => $movie->getId(),
                    'title' => $movie->getTitle(),
                    'description' => $movie->getDescription(),
                    'year' => $movie->getMoveYear(),
                    'actors' => []
                ];
                
                foreach ($movie->getActors() as $actor) {
                    $actorData = [
                        'firstName' => $actor->getFirstName(),
                        'lastName' => $actor->getLastName()
                    ];
                    $movieData['actors'][] = $actorData;
                }
                
                $allMovies[] = $movieData;
            }
            return $this->json($allMovies);
    }


    /**
     * @Route("/movie/{id}", name="movie_show", methods={"GET"})
     */
    public function show($id)
    {
        $movie = $this->movieRepository->find($id);
        foreach($movie->getActors() as $actor){
        }

        $actorId = $actor->getId();
        $actor = $this->actorRepository->find($actorId);

            $movieData = [
                'id' => $movie->getId(),
                'title' => $movie->getTitle(),
                'description' => $movie->getDescription(),
                'year' => $movie->getMoveYear(),
                'actors' => []
            ];

            foreach ($movie->getActors() as $actor) {
                $actorData = [
                    'firstName' => $actor->getFirstName(),
                    'lastName' => $actor->getLastName()
                ];
                $movieData['actors'][] = $actorData;
            }

            $film[] = $movieData;

        return $this->json($film);
    }

     /**
     * @Route("/create", name="movie_new",  methods={"GET","POST"})
     */
    public function create(ManagerRegistry $doctrine, Request $request)
    {
        $entityManager = $doctrine->getManager();
        $params = json_decode($request->getContent(), true);

            if (!isset($params["title"]) 
                || !isset($params["description"]) 
                || !isset($params["year"]) 
                || !isset($params["actors"]['firstName'])
                || !isset($params["actors"]['lastName'] )
               ) 
            {
                return new JsonResponse(null, 400, ["Content-Type" => "application/json"]);
            }

            $actor = new Actor();

            $actor->setFirstName($params["actors"]['firstName']);
            $actor->setLastName($params["actors"]['lastName']);

            $movie = new Movie();
            $movie->setTitle($params["title"]);
            $movie->setDescription($params["description"]);
            $movie->setMoveYear($params["year"]);

            $movie->addActor($actor);

        
            $entityManager->persist($actor);
            $entityManager->persist($movie);
            $entityManager->flush(); 

              return new JsonResponse(['status' => 'Movie created!'], 200);
    }


    /**
     * @Route("/update/{id}", name="movie_edit", methods = {"GET","POST"})
     */
    public function update(ManagerRegistry $doctrine, Request $request, $id): JsonResponse
    {
        $entityManager = $doctrine->getManager();

        $movie = $this->movieRepository->find($id);
        foreach($movie->getActors() as $actor){
        }

        $params = json_decode($request->getContent(), true);

            if (!isset($params["title"]) 
                || !isset($params["description"]) 
                || !isset($params["year"]) 
                || !isset($params["actors"]['firstName'])
                || !isset($params["actors"]['lastName'] )
               ) 
            {
                return new JsonResponse(null, 400, ["Content-Type" => "application/json"]);
            }

            $actor->setFirstName($params["actors"]['firstName']);
            $actor->setLastName($params["actors"]['lastName']);

            $movie->setTitle($params["title"]);
            $movie->setDescription($params["description"]);
            $movie->setMoveYear($params["year"]);
            $movie->addActor($actor);

            $entityManager->persist($actor);
            $entityManager->persist($movie);
            $entityManager->flush(); 

            return new JsonResponse(['status' => 'Movie created!'], 200);
    }

    /**
     * @Route("/delete/{id}", name="movie_delete", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine,Request $request, Movie $movie): Response
    {
            $entityManager = $doctrine->getManager();
            $entityManager->remove($movie);
            $entityManager->flush();
            return new JsonResponse(['status' => 'Book delete!'], 200); 
    }
}
