<?php
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
        if ($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
            return null;
        }
        $results = [];
        $data = json_decode($data, true); // true car je souhaite avoir un tableau associatif
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