<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends Controller
{

    const STFALCON_LIST = 'stfalcon:persons';

    /**
     * @Route("/api/add/{person}")
     */
    public function add($person)
    {

        $this->getClient()->rpush(self::STFALCON_LIST, $person);

        return new JsonResponse(['OK']);
    }

    /**
     * @Route("/api/first")
     */
    public function first()
    {

        $first = $this->getClient()->lpop(self::STFALCON_LIST);

        return new JsonResponse($first);
    }

    /**
     * @Route("/api/last")
     */
    public function last()
    {

        $first = $this->getClient()->rpop(self::STFALCON_LIST);

        return new JsonResponse($first);
    }

    /**
     * @Route("/api/list")
     */
    public function list()
    {

        $list = $this->getClient()->lrange(self::STFALCON_LIST, 0, -1);

        return new JsonResponse($list);
    }

    private function getClient()
    {

        /** @var \Predis\Client $cacheService */
        $cacheService = $this->get('snc_redis.default');

        return $cacheService;
    }
}