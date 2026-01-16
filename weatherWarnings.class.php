<?php

class WeatherWarnings
{
    private $apiKey = '---INSERT YOUR API KEY HERE---';
    private $baseUrl = 'https://api.meteogate.eu/warnings/collections/warnings/locations/';
    private $validCountries = ['ALL', 'SE', 'SI', 'RO', 'MK', 'PL', 'FR', 'EE', 'GR', 'LU', 'LT', 'IT', 'DE', 'ES', 'BA', 'NL', 'CH', 'FI', 'PT', 'RS', 'MD', 'SK', 'HR', 'BG', 'IE', 'CZ', 'LV', 'IS', 'HU', 'UK', 'BE', 'DK', 'ME', 'AT', 'MT', 'CY', 'IL', 'UA'];

    public function getWarnings($country = 'ALL', $hoursBack = 24)
    {
        global $link;
        $endTime = new DateTime();
        $startTime = (clone $endTime)->sub(new DateInterval('PT' . $hoursBack . 'H'));
        
        $datetime = $startTime->format('Y-m-d\TH:i:sP') . '/' . $endTime->format('Y-m-d\TH:i:sP');
        
        $url = $this->baseUrl . $country . '?apikey=' . $this->apiKey . '&datetime=' . urlencode($datetime) . '&language=en-GB';

        echo $url;
        
        $context = stream_context_create([
            'http' => [
                'timeout' => 30,
                'ignore_errors' => true
            ]
        ]);
        
        $response = file_get_contents($url, false, $context);
        
        $data = json_decode($response, true);
        
        if (isset($data['error'])) {
            echo "API Error: " . $data['error'] . "\n";
            return null;
        }
        
        return $data;
    }

    public function isInsideBoundingBox($lat, $lon, $geometry)
    {
        if ($geometry['type'] !== 'Polygon') return false;
        
        $coords = $geometry['coordinates'][0];
        $minLat = $maxLat = $coords[0][1];
        $minLon = $maxLon = $coords[0][0];
        
        foreach ($coords as $coord) {
            $minLat = min($minLat, $coord[1]);
            $maxLat = max($maxLat, $coord[1]);
            $minLon = min($minLon, $coord[0]);
            $maxLon = max($maxLon, $coord[0]);
        }
        
        return $lat >= $minLat && $lat <= $maxLat && $lon >= $minLon && $lon <= $maxLon;
    }

    public function getWarningDetails($url, $datetime = null)
    {
        $response = file_get_contents($url);
        $details = $response ? json_decode($response, true) : null;
        
        if ($details && $datetime && isset($details['info'][1]['onset']) && isset($details['info'][1]['expires'])) {
            $checkTime = new DateTime($datetime);
            $onset = new DateTime($details['info'][1]['onset']);
            $expires = new DateTime($details['info'][1]['expires']);
            
            if ($checkTime < $onset || $checkTime > $expires) {
                return null;
            }
        }
        
        return $details;
    }

    public function checkActiveWarningsForCoordinates($countries, $coordinates, $hoursBack = 24)
    {
        $countries = array_intersect($countries, $this->validCountries);
        $countries = array_slice($countries, 0, 5); // limit to 5 countries at once (API limit)
        $activeWarnings = [];
        foreach ($countries as $country) {
            $warnings = $this->getWarnings($country, $hoursBack);
            if ($warnings) {
                foreach ($coordinates as $coord) {
                    foreach ($warnings['features'] as $feature) {
                        if ($this->isInsideBoundingBox($coord[0], $coord[1], $feature['geometry'])) {
                            $details = $this->getWarningDetails($feature['links'][1]['href'], $coord[2]);
                            if ($details) {
                                $activeWarnings[] = [
                                    'coordinate' => [$coord[0], $coord[1]],
                                    'timestamp' => $coord[2],
                                    'warning' => $details
                                ];
                            }
                        }
                    }
                }
            }
        }
        return $activeWarnings;
    }
}