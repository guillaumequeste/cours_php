<?php
require_once 'APIException.php';
class OpenWeather {

    private $apiKey;
    
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getForecast(string $city): ?array // ? : peut être null
    {   
        $curl = curl_init("http://api.openweathermap.org/data/2.5/forecast?q={$city}&units=metric&lang=fr&APPID={$this->apiKey}");
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CAINFO => dirname(__DIR__) . DIRECTORY_SEPARATOR . 'cert.cer',
            CURLOPT_TIMEOUT => 1
        ]);
        $data = curl_exec($curl);
        // si l'exécution de curl n'a pas fonctionné, on récupère l'erreur
        if ($data === false) {
            $error = curl_error($curl);
            curl_close($curl);
            // j'envoie une exception avec la classe APIException que j'ai créée et qui hérite de la classe Exception
            throw new APIException($error);
        }
        // si le serveur ne répond pas avec un statut 200 (succès de la requête), on renvoie les données récupérées
        if (curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            // j'envoie une exception avec la classe Exception
            throw new Exception($data);
        }
        $results = [];
        $data = json_decode($data, true); // true car je souhaite avoir un tableau associatif
        curl_close($curl);
        
        foreach ($data['list'] as $threeHour) {
            $results[] = [
                'temp' => $threeHour['main']['temp'],
                'description' => $threeHour['weather'][0]['description'],
                'date' => new DateTime('@' . $threeHour['dt']),
                'date2' => $threeHour['dt_txt']
            ];
        }
        return $results;
    }

}