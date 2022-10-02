<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\ReqresService;

/**
 * @Route("/api", name="api_")
 * 
 * @author David
 */
class UserController extends AbstractController {

    private ReqresService $reqresService;

    /**
     * Constructor
     * 
     * @param ReqresService $reqresService
     */
    public function __construct(ReqresService $reqresService) {
        $this->reqresService = $reqresService;
    }

    /**
     * @Route("/user", name="user_index", methods={"GET"})
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response {
        $page = $request->query->has('page') ? (int) $request->query->get('page') : 1;
        $perPage = $request->query->has('per_page') ? (int) $request->query->get('per_page') : 6;
        $response = $this->reqresService->getConnector()->getUsers($page, $perPage);
        $statusCode = $response->getStatusCode();
        $data = [];

        if (200 === $statusCode) {
            $data = $response->getContent()->data;
        }

        return new JsonResponse($data, $statusCode);
    }

    /**
     * @Route("/user", name="user_add", methods={"POST"})
     * 
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response {
        $response = $this->reqresService->getConnector()->addUser($request->request->all());
        $statusCode = $response->getStatusCode();
        $data = [];

        if (201 === $statusCode) {
            $data = $response->getContent();
        }

        return new JsonResponse($data, $statusCode);
    }

    /**
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     * 
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response {
        $response = $this->reqresService->getConnector()->deleteUser($id);
        $statusCode = $response->getStatusCode();
        $data = [];

        if (204 === $statusCode) {
            $data = $response->getContent();
        }

        return new JsonResponse($data, $statusCode);
    }

}
