<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OrderController extends AbstractController
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }
    /**
     * @Route("/", name="app_brand_new")
     */
    public function index(): Response
    {
        $response = $this->client->request(
            'GET',
            'https://api.mockaroo.com/api/b51ce860?count=200&key=ba55c120'
        );
        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        $content = $response->getContent();

        $data = json_decode($content, TRUE);
        // var_dump($data[0]['items']);die();
        return $this->render('order/index.html.twig', [
            'order' => $data,
        ]);
    }
}
