<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class PeopleController extends Controller
{
    /**
     * @Route("/people", name="people")
     */
     public function index()
     {
       return $this->render('people/index.html.twig', [
         'controller_name' => 'PeopleController'
       ]);
     }

     /**
     * @Route("/validate/{element}", name="validate")
     * @Method({"POST"})
     */
     public function validate(Request $request, $element)
    {
        try {
          $input = json_decode($request->getContent(), true)['input'];
        } catch (\Exception $e) {
          return new JsonResponse (['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);
        }

        $students = $this->getStudents();
        $teams = $this->getTeams();
        switch ($element) {
          case 'name':
          return new JsonResponse(['valid' => in_array(strtolower($input), $students)]);
          case 'team':
          return new JsonResponse(['valid' => in_array(strtolower($input), $teams)]);
      }

      return new JsonResponse(['error' => 'Invalid method'], Response::HTTP_BAD_REQUEST);

    }

   public function getStudents() {
     $students = [];
     $json = file_get_contents("data.json");
     $storage = json_decode($json, true);

     foreach($storage as $teamData) {
        foreach($teamData['members'] as $student) {
          $students[] = strtolower($student);
        }
     }

     return $students;
   }

   public function getTeams() {
     $teams = [];
     $json = file_get_contents("data.json");
     $storage = json_decode($json, true);

     foreach($storage as $teamdata => $key) {
       $teams[] = strtolower($teamdata);
     }

     return $teams;
   }
}
