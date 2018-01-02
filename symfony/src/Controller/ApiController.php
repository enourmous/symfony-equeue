<?php

namespace App\Controller;

use Predis\Connection\ConnectionException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This class is test task for Stfalcon Company
 * Class ApiController
 *
 * @package App\Controller
 */
class ApiController extends Controller
{

    /** List name */
    const STFALCON_LIST = 'stfalcon:persons';

    /**
     * @Route("/api/")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {

        return new Response('Access Denied', 403);
    }

    /**
     * @param $person
     * @Route("/api/add/{person}")
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addNew($person)
    {

        // Exception examples
        try {
            $this->getClient()->rpush(self::STFALCON_LIST, $person);
            $result = new JsonResponse(['OK']);
        } catch (ConnectionException $e) { // If redis gone...
            $result = new Response('Storage server not running.', 500);
        } catch (\Exception $e) {
            $result = new Response('Try again!.', 404);
        }

        return $result;
    }

    /**
     * @Route("/api/first")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getFirst()
    {

        $first = $this->getClient()->lpop(self::STFALCON_LIST);

        return new JsonResponse($first);
    }

    /**
     * @Route("/api/last")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getLast()
    {

        $first = $this->getClient()->rpop(self::STFALCON_LIST);

        return new JsonResponse($first);
    }

    /**
     * @Route("/api/list")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getList()
    {

        $list = $this->getClient()->lrange(self::STFALCON_LIST, 0, -1);

        return new JsonResponse($list);
    }

    /**
     * @return \Predis\Client
     */
    private function getClient()
    {

        /** @var \Predis\Client $cacheService */
        $cacheService = $this->get('snc_redis.default');

        return $cacheService;

    }
}