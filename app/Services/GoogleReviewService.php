<?php

namespace App\Services;

use App\Models\GoogleReview;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Setting;
use Illuminate\Support\Carbon;

class GoogleReviewService
{
    public function fetchAndStoreReviews()
    {
        $apiKey = Setting::where('key', 'google_api_key')->value('value');
        $placeId = Setting::where('key', 'google_place_id')->value('value');

        if (!$apiKey || !$placeId) {
            Log::error('Google Reviews: Clé API ou Place ID manquant. test');
            return;
        }

        // Appel à l'API Google Places (Details)
        // On demande spécifiquement le champ "reviews" pour économiser des données
        $url = "https://maps.googleapis.com/maps/api/place/details/json?place_id={$placeId}&fields=reviews&language=fr&key={$apiKey}";

        $response = Http::get($url);

        // $data = $response->json();
        // dd($data);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['result']['reviews'])) {
                foreach ($data['result']['reviews'] as $review) {

                    // On ne garde que les avis de 4 étoiles ou plus
                    if ($review['rating'] < 4) {
                        continue;
                    }

                    // Google ne donne pas toujours d'ID unique stable dans cette API.
                    // On en génère un unique basé sur l'auteur et l'heure pour éviter les doublons.
                    $uniqueId = md5($review['author_name'] . $review['time']);

                    GoogleReview::updateOrCreate(
                        ['google_review_id' => $uniqueId], // On cherche par cet ID
                        [
                            'author_name' => $review['author_name'],
                            'author_photo_url' => $review['profile_photo_url'] ?? null,
                            'rating' => $review['rating'],
                            'text' => $review['text'] ?? '',
                            'language' => $review['language'] ?? 'fr',
                            // Conversion du timestamp Google en date Laravel
                            'review_time' => Carbon::createFromTimestamp($review['time']),
                            'is_visible' => true,
                        ]
                    );
                }
                Log::info('Google Reviews: Importation réussie.');
            }
        } else {
            Log::error('Google Reviews: Erreur lors de l\'appel API: ' . $response->body());
        }
    }
}
