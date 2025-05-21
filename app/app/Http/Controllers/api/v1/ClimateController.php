<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Climate;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ClimateController extends Controller
{
    protected $apiUrl = 'https://api.stormglass.io/v2/weather/point?lat=-23.2741667&lng=-51.1352441&params=waveHeight,airTemperature';
    protected $token = '147f717c-3449-11f0-a953-0242ac130003-147f71fe-3449-11f0-a953-0242ac130003';

    public function loadExternalClimate()
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token, // Apenas o token, sem "Bearer"
            ])->get($this->apiUrl);

            if ($response->successful()) {
                $data = $response->json();

                if (!isset($data['hours'])) {
                    return response()->json(['message' => 'Dados inválidos da API'], 500);
                }

                foreach ($data['hours'] as $hour) {
                    Climate::updateOrCreate(
                        ['horario' => $hour['time']],  // Chave para updateOrCreate
                        [
                            'temp_ar_ecmwf' => $hour['airTemperature']['ecmwf'] ?? null,
                            'temp_ar_noaa' => $hour['airTemperature']['noaa'] ?? null,
                            'temp_ar_sg' => $hour['airTemperature']['sg'] ?? null,
                        ]
                    );
                }

                return response()->json(['message' => 'Dados salvos/atualizados com sucesso']);
            }

            return response()->json(['message' => 'Erro ao buscar dados da API'], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro interno: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index(Request $request)
    {
        // Chama a API externa e salva dados na tabela
        $this->loadExternalClimate();

        // Depois pega os dados da tabela Climate
        $climates = Climate::orderBy('horario')->get();

        return response()->json($climates);
    }
}
