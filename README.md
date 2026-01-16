# meteogate.eu
PHP class to fetch weather warnings and their details for EU member states from meteogate.eu API

## Pre-requisities
- Get a developer API key at https://devportal.meteogate.eu/

## Usage
- Update ```weatherWarnings.class.php``` line ```5``` with your API key
- Use this example code:

```php
<?
include("weatherWarnings.class.php");
$weather = new WeatherWarnings();

$countries = ['SK', 'AT']; // countries to look for a warnings
$coordinates = [
  [48.14790, 17.11686, '2026-16-01T13:14:00Z'],
  [48.20909, 16.37168, '2026-16-01T12:00:00Z']
]; // coordinates for which you want to find out alerts along with the time

$activeWarnings = $weather->checkActiveWarningsForCoordinates($countries, $coordinates, 24);

foreach($activeWarnings as $warning) {
  print_r($warning);
}
```

## Example response
```
Array
(
    [0] => Array
        (
            [coordinate] => Array
                (
                    [0] => 46.5456468408
                    [1] => 15.6974795646
                )

            [timestamp] => 2026-01-14T12:00:00Z
            [warning] => Array
                (
                    [identifier] => 2.49.0.0.705.0.SI.260112082812.0060101
                    [incidents] => Alert
                    [info] => Array
                        (
                            [0] => Array
                                (
                                    [area] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [areaDesc] => Slovenija / severovzhod
                                                    [polygon] => Array
                                                        (
                                                            [0] => 46.050,15.717 46.087,15.652 46.090,15.624 46.161,15.607 46.192,15.653 46.218,15.657 46.222,15.745 46.209,15.772 46.237,15.802 46.259,15.795 46.308,16.012 46.337,16.040 46.344,16.079 46.394,16.062 46.405,16.145 46.382,16.192 46.378,16.306 46.499,16.246 46.513,16.309 46.549,16.371 46.519,16.470 46.485,16.521 46.475,16.586 46.505,16.528 46.532,16.536 46.611,16.450 46.649,16.390 46.690,16.430 46.703,16.381 46.754,16.323 46.799,16.319 46.804,16.344 46.841,16.352 46.868,16.299 46.877,16.238 46.857,16.165 46.869,16.114 46.839,16.062 46.833,15.994 46.742,15.987 46.686,16.046 46.656,16.042 46.685,15.987 46.692,15.944 46.720,15.883 46.722,15.839 46.700,15.775 46.696,15.726 46.706,15.654 46.680,15.624 46.690,15.599 46.669,15.556 46.621,15.523 46.615,15.473 46.641,15.448 46.652,15.398 46.652,15.297 46.639,15.240 46.656,15.187 46.660,15.114 46.641,15.020 46.602,14.983 46.633,14.960 46.603,14.927 46.613,14.891 46.543,14.827 46.509,14.817 46.500,14.719 46.445,14.664 46.430,14.590 46.396,14.592 46.373,14.566 46.357,14.594 46.364,14.642 46.333,14.643 46.312,14.676 46.264,14.706 46.251,14.760 46.251,14.852 46.218,14.926 46.203,14.912 46.186,14.949 46.196,15.010 46.189,15.107 46.138,15.173 46.113,15.189 46.093,15.158 46.080,15.183 46.085,15.263 46.075,15.318 46.063,15.523 46.021,15.559 46.007,15.610 46.042,15.667 46.050,15.717
                                                        )

                                                )

                                        )

                                    [category] => Array
                                        (
                                            [0] => Met
                                        )

                                    [certainty] => Likely
                                    [description] => Maksimalna hitrost vetra : od 50 do 70 km/h. Veter maje drevesa, lahko lomi manjše veje.
                                    [effective] => 2026-01-12T08:21:00+01:00
                                    [event] => Veter - zmerna ogroženost
                                    [expires] => 2026-01-14T23:59:00+01:00
                                    [headline] => Veter - zmerna ogroženost (Stopnja 2/4) - Slovenija / severovzhod
                                    [instruction] => Priporočamo dodatno previdnost v prometu. Ne zadržujte se na potencialno nevarnih mestih.
                                    [language] => sl
                                    [onset] => 2026-01-14T00:00:00+01:00
                                    [parameter] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [value] => 2; yellow; Moderate
                                                    [valueName] => awareness_level
                                                )

                                            [1] => Array
                                                (
                                                    [value] => 1; wind
                                                    [valueName] => awareness_type
                                                )

                                        )

                                    [responseType] => Array
                                        (
                                            [0] => Shelter
                                        )

                                    [senderName] => Agencija Republike Slovenije za okolje (ARSO vreme)
                                    [severity] => Moderate
                                    [urgency] => Future
                                    [web] => https://meteo.arso.gov.si/met/sl/warning/
                                )

                            [1] => Array
                                (
                                    [area] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [areaDesc] => Slovenia / North-East
                                                    [polygon] => Array
                                                        (
                                                            [0] => 46.050,15.717 46.087,15.652 46.090,15.624 46.161,15.607 46.192,15.653 46.218,15.657 46.222,15.745 46.209,15.772 46.237,15.802 46.259,15.795 46.308,16.012 46.337,16.040 46.344,16.079 46.394,16.062 46.405,16.145 46.382,16.192 46.378,16.306 46.499,16.246 46.513,16.309 46.549,16.371 46.519,16.470 46.485,16.521 46.475,16.586 46.505,16.528 46.532,16.536 46.611,16.450 46.649,16.390 46.690,16.430 46.703,16.381 46.754,16.323 46.799,16.319 46.804,16.344 46.841,16.352 46.868,16.299 46.877,16.238 46.857,16.165 46.869,16.114 46.839,16.062 46.833,15.994 46.742,15.987 46.686,16.046 46.656,16.042 46.685,15.987 46.692,15.944 46.720,15.883 46.722,15.839 46.700,15.775 46.696,15.726 46.706,15.654 46.680,15.624 46.690,15.599 46.669,15.556 46.621,15.523 46.615,15.473 46.641,15.448 46.652,15.398 46.652,15.297 46.639,15.240 46.656,15.187 46.660,15.114 46.641,15.020 46.602,14.983 46.633,14.960 46.603,14.927 46.613,14.891 46.543,14.827 46.509,14.817 46.500,14.719 46.445,14.664 46.430,14.590 46.396,14.592 46.373,14.566 46.357,14.594 46.364,14.642 46.333,14.643 46.312,14.676 46.264,14.706 46.251,14.760 46.251,14.852 46.218,14.926 46.203,14.912 46.186,14.949 46.196,15.010 46.189,15.107 46.138,15.173 46.113,15.189 46.093,15.158 46.080,15.183 46.085,15.263 46.075,15.318 46.063,15.523 46.021,15.559 46.007,15.610 46.042,15.667 46.050,15.717
                                                        )

                                                )

                                        )

                                    [category] => Array
                                        (
                                            [0] => Met
                                        )

                                    [certainty] => Likely
                                    [description] => Maximum wind speed : from 50 to 70 km/h. Wind sways trees and may break smaller branches.
                                    [effective] => 2026-01-12T08:21:00+01:00
                                    [event] => Moderate Wind Warning
                                    [expires] => 2026-01-14T23:59:00+01:00
                                    [headline] => Moderate Wind Warning (Degree 2/4) - Slovenia / North-East
                                    [instruction] => Doors and windows should be kept closed. We recommend additional caution in traffic, especially in crosswinds and in exposed areas (e.g. bridges, cuttings). Do not linger in potentially dangerous areas.
                                    [language] => en-GB
                                    [onset] => 2026-01-14T00:00:00+01:00
                                    [parameter] => Array
                                        (
                                            [0] => Array
                                                (
                                                    [value] => 2; yellow; Moderate
                                                    [valueName] => awareness_level
                                                )

                                            [1] => Array
                                                (
                                                    [value] => 1; wind
                                                    [valueName] => awareness_type
                                                )

                                        )

                                    [responseType] => Array
                                        (
                                            [0] => Shelter
                                        )

                                    [senderName] => Slovenian Environment Agency (ARSO vreme)
                                    [severity] => Moderate
                                    [urgency] => Future
                                    [web] => https://meteo.arso.gov.si/met/sl/warning/
                                )

                        )

                    [msgType] => Alert
                    [scope] => Public
                    [sender] => dezurni.prognostik@arso.gov.si
                    [sent] => 2026-01-12T08:28:12+01:00
                    [status] => Actual
                )

        )
```

If you like it:<br>
<a href="https://www.buymeacoffee.com/palsoft" target="_blank"><img src="https://cdn.buymeacoffee.com/buttons/default-orange.png" alt="Buy Me A Coffee" height="41" width="174"></a>
