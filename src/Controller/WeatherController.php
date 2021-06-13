<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\Weather;

class WeatherController extends AbstractController {

    /**
     * @Route("/api/save-weather", name="api_save_weather", methods={"POST"})
     */
    public function saveWeatherData(Request $request, EntityManagerInterface $em): JsonResponse{
        
        $content = $request->getContent();
        $weatherData = json_decode($content);
        
        $weather = new Weather();
        $weather->setTemperature($weatherData->temperature);
        $weather->setHumidity($weatherData->humidity);
        $weather->setPressure($weatherData->pressure);
        
        $em->persist($weather);
        $em->flush();
        
        return new JsonResponse("OK", 200);
    }
}