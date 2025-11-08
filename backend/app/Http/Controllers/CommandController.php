<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommandController extends Controller
{
    /**
     * Get commands for a platform
     * Returns default commands based on platform and locale
     */
    public function index(Request $request)
    {
        $platformId = $request->input('api_platform_id'); // Set by ApiKeyMiddleware
        $locale = $request->input('locale', 'en-US');
        $platformName = $request->input('platform_name', 'custom');

        if (!$platformId) {
            return response()->json([
                'success' => false,
                'error' => 'Platform ID not found in request context.'
            ], 400);
        }

        // Get platform info
        $platform = DB::table('platforms')
            ->where('id', $platformId)
            ->first();

        if (!$platform) {
            return response()->json([
                'success' => false,
                'error' => 'Platform not found.'
            ], 404);
        }

        // For now, return default commands
        // In future, can load custom commands from database
        $commands = $this->getDefaultCommands($locale, $platformName);

        return response()->json([
            'success' => true,
            'commands' => $commands,
            'platform' => [
                'id' => $platform->id,
                'name' => $platform->name,
                'plan' => $platform->plan,
            ],
            'locale' => $locale,
        ]);
    }

    /**
     * Get default commands based on locale
     */
    private function getDefaultCommands($locale, $platformName)
    {
        $baseLocale = explode('-', $locale)[0]; // Extract base locale (e.g., 'en' from 'en-US')

        $commands = [
            [
                'id' => 'scroll-down',
                'phrases' => $this->getPhrases('scroll-down', $baseLocale),
                'action' => 'scroll-down',
                'description' => 'Scroll page down'
            ],
            [
                'id' => 'scroll-up',
                'phrases' => $this->getPhrases('scroll-up', $baseLocale),
                'action' => 'scroll-up',
                'description' => 'Scroll page up'
            ],
            [
                'id' => 'click',
                'phrases' => $this->getPhrases('click', $baseLocale),
                'action' => 'click',
                'description' => 'Click element'
            ],
        ];

        // Add platform-specific commands
        if ($platformName === 'youtube') {
            $commands[] = [
                'id' => 'play-video',
                'phrases' => $this->getPhrases('play', $baseLocale),
                'action' => 'play-video',
                'description' => 'Play video'
            ];
            $commands[] = [
                'id' => 'pause-video',
                'phrases' => $this->getPhrases('pause', $baseLocale),
                'action' => 'pause-video',
                'description' => 'Pause video'
            ];
        }

        return $commands;
    }

    /**
     * Get phrases for a command based on locale
     */
    private function getPhrases($command, $locale)
    {
        $phrases = [
            'en' => [
                'scroll-down' => ['scroll down', 'scroll down page', 'go down'],
                'scroll-up' => ['scroll up', 'scroll up page', 'go up'],
                'click' => ['click', 'tap', 'press'],
                'play' => ['play', 'start video', 'play video'],
                'pause' => ['pause', 'stop video', 'pause video'],
            ],
            'sq' => [
                'scroll-down' => ['shkruaj poshtë', 'shkruaj poshtë faqen', 'shko poshtë'],
                'scroll-up' => ['shkruaj lart', 'shkruaj lart faqen', 'shko lart'],
                'click' => ['kliko', 'prek', 'shtyp'],
                'play' => ['luaj', 'fillo video', 'luaj video'],
                'pause' => ['pauzë', 'ndalo video', 'pauzë video'],
            ],
            'es' => [
                'scroll-down' => ['desplazar abajo', 'bajar', 'ir abajo'],
                'scroll-up' => ['desplazar arriba', 'subir', 'ir arriba'],
                'click' => ['clic', 'tocar', 'presionar'],
                'play' => ['reproducir', 'iniciar video', 'reproducir video'],
                'pause' => ['pausar', 'detener video', 'pausar video'],
            ],
            'fr' => [
                'scroll-down' => ['défiler vers le bas', 'descendre', 'aller en bas'],
                'scroll-up' => ['défiler vers le haut', 'monter', 'aller en haut'],
                'click' => ['cliquer', 'toucher', 'appuyer'],
                'play' => ['lire', 'démarrer vidéo', 'lire vidéo'],
                'pause' => ['pause', 'arrêter vidéo', 'mettre en pause'],
            ],
        ];

        return $phrases[$locale][$command] ?? $phrases['en'][$command] ?? [];
    }
}

