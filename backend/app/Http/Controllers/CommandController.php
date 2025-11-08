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
            $commands = array_merge($commands, $this->getYouTubeCommands($baseLocale));
        } elseif ($platformName === 'instagram') {
            $commands = array_merge($commands, $this->getInstagramCommands($baseLocale));
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
                'next' => ['next', 'next video', 'next post', 'skip'],
                'previous' => ['previous', 'previous video', 'previous post', 'back', 'go back'],
                'mute' => ['mute', 'silence', 'turn off sound'],
                'unmute' => ['unmute', 'sound on', 'turn on sound'],
                'fullscreen' => ['fullscreen', 'full screen', 'maximize'],
                'volume-up' => ['volume up', 'increase volume', 'louder'],
                'volume-down' => ['volume down', 'decrease volume', 'quieter'],
                'skip-forward' => ['skip forward', 'forward', 'fast forward'],
                'skip-backward' => ['skip backward', 'backward', 'rewind'],
                'like' => ['like', 'thumbs up', 'heart'],
                'subscribe' => ['subscribe', 'follow channel'],
                'comment' => ['comment', 'add comment', 'write comment'],
            ],
            'sq' => [
                'scroll-down' => ['shkruaj poshtë', 'shkruaj poshtë faqen', 'shko poshtë'],
                'scroll-up' => ['shkruaj lart', 'shkruaj lart faqen', 'shko lart'],
                'click' => ['kliko', 'prek', 'shtyp'],
                'play' => ['luaj', 'fillo video', 'luaj video'],
                'pause' => ['pauzë', 'ndalo video', 'pauzë video'],
                'next' => ['tjeter', 'video tjeter', 'postimi tjeter', 'kaloj'],
                'previous' => ['i meparshem', 'video e meparshme', 'postimi i meparshem', 'kthe mbrapa'],
                'mute' => ['mute', 'pa ze', 'fike ze'],
                'unmute' => ['unmute', 'me ze', 'hape ze'],
                'fullscreen' => ['ekran i plote', 'fullscreen', 'maksimizo'],
                'volume-up' => ['rrit volumin', 'me ze', 'ze me i larte'],
                'volume-down' => ['ul volumin', 'me pak ze', 'ze me i ulet'],
                'skip-forward' => ['kaloj para', 'para', 'shpejto para'],
                'skip-backward' => ['kaloj mbrapa', 'mbrapa', 'shpejto mbrapa'],
                'like' => ['pelqe', 'zemer', 'thumbs up'],
                'subscribe' => ['abonohu', 'ndiq kanalin'],
                'comment' => ['komento', 'shto koment', 'shkruaj koment'],
            ],
            'es' => [
                'scroll-down' => ['desplazar abajo', 'bajar', 'ir abajo'],
                'scroll-up' => ['desplazar arriba', 'subir', 'ir arriba'],
                'click' => ['clic', 'tocar', 'presionar'],
                'play' => ['reproducir', 'iniciar video', 'reproducir video'],
                'pause' => ['pausar', 'detener video', 'pausar video'],
                'next' => ['siguiente', 'siguiente video', 'siguiente publicación'],
                'previous' => ['anterior', 'video anterior', 'publicación anterior'],
                'mute' => ['silenciar', 'sin sonido', 'apagar sonido'],
                'unmute' => ['activar sonido', 'con sonido', 'encender sonido'],
                'fullscreen' => ['pantalla completa', 'pantalla completa', 'maximizar'],
                'volume-up' => ['subir volumen', 'aumentar volumen', 'más fuerte'],
                'volume-down' => ['bajar volumen', 'disminuir volumen', 'más bajo'],
                'skip-forward' => ['adelantar', 'avanzar', 'saltar adelante'],
                'skip-backward' => ['retroceder', 'atrás', 'saltar atrás'],
                'like' => ['me gusta', 'corazón', 'pulgar arriba'],
                'subscribe' => ['suscribirse', 'seguir canal'],
                'comment' => ['comentar', 'agregar comentario', 'escribir comentario'],
            ],
            'fr' => [
                'scroll-down' => ['défiler vers le bas', 'descendre', 'aller en bas'],
                'scroll-up' => ['défiler vers le haut', 'monter', 'aller en haut'],
                'click' => ['cliquer', 'toucher', 'appuyer'],
                'play' => ['lire', 'démarrer vidéo', 'lire vidéo'],
                'pause' => ['pause', 'arrêter vidéo', 'mettre en pause'],
                'next' => ['suivant', 'vidéo suivante', 'publication suivante'],
                'previous' => ['précédent', 'vidéo précédente', 'publication précédente'],
                'mute' => ['couper le son', 'sourdine', 'sans son'],
                'unmute' => ['activer le son', 'avec son', 'allumer le son'],
                'fullscreen' => ['plein écran', 'plein écran', 'maximiser'],
                'volume-up' => ['augmenter le volume', 'plus fort', 'monter le volume'],
                'volume-down' => ['diminuer le volume', 'plus bas', 'baisser le volume'],
                'skip-forward' => ['avancer', 'sauter en avant', 'avance rapide'],
                'skip-backward' => ['reculer', 'sauter en arrière', 'retour rapide'],
                'like' => ['aimer', 'cœur', 'pouce en haut'],
                'subscribe' => ['s\'abonner', 'suivre la chaîne'],
                'comment' => ['commenter', 'ajouter un commentaire', 'écrire un commentaire'],
            ],
        ];

        return $phrases[$locale][$command] ?? $phrases['en'][$command] ?? [];
    }

    /**
     * Get YouTube-specific commands
     */
    private function getYouTubeCommands($locale)
    {
        return [
            [
                'id' => 'play-video',
                'phrases' => $this->getPhrases('play', $locale),
                'action' => 'youtube-play',
                'description' => 'Play video'
            ],
            [
                'id' => 'pause-video',
                'phrases' => $this->getPhrases('pause', $locale),
                'action' => 'youtube-pause',
                'description' => 'Pause video'
            ],
            [
                'id' => 'next-video',
                'phrases' => $this->getPhrases('next', $locale),
                'action' => 'youtube-next',
                'description' => 'Next video'
            ],
            [
                'id' => 'previous-video',
                'phrases' => $this->getPhrases('previous', $locale),
                'action' => 'youtube-previous',
                'description' => 'Previous video'
            ],
            [
                'id' => 'mute',
                'phrases' => $this->getPhrases('mute', $locale),
                'action' => 'youtube-mute',
                'description' => 'Mute video'
            ],
            [
                'id' => 'unmute',
                'phrases' => $this->getPhrases('unmute', $locale),
                'action' => 'youtube-unmute',
                'description' => 'Unmute video'
            ],
            [
                'id' => 'fullscreen',
                'phrases' => $this->getPhrases('fullscreen', $locale),
                'action' => 'youtube-fullscreen',
                'description' => 'Toggle fullscreen'
            ],
            [
                'id' => 'volume-up',
                'phrases' => $this->getPhrases('volume-up', $locale),
                'action' => 'youtube-volume-up',
                'description' => 'Increase volume'
            ],
            [
                'id' => 'volume-down',
                'phrases' => $this->getPhrases('volume-down', $locale),
                'action' => 'youtube-volume-down',
                'description' => 'Decrease volume'
            ],
            [
                'id' => 'skip-forward',
                'phrases' => $this->getPhrases('skip-forward', $locale),
                'action' => 'youtube-skip-forward',
                'description' => 'Skip forward 10 seconds'
            ],
            [
                'id' => 'skip-backward',
                'phrases' => $this->getPhrases('skip-backward', $locale),
                'action' => 'youtube-skip-backward',
                'description' => 'Skip backward 10 seconds'
            ],
            [
                'id' => 'like-video',
                'phrases' => $this->getPhrases('like', $locale),
                'action' => 'youtube-like',
                'description' => 'Like video'
            ],
            [
                'id' => 'subscribe',
                'phrases' => $this->getPhrases('subscribe', $locale),
                'action' => 'youtube-subscribe',
                'description' => 'Subscribe to channel'
            ],
        ];
    }

    /**
     * Get Instagram-specific commands
     */
    private function getInstagramCommands($locale)
    {
        return [
            [
                'id' => 'next-post',
                'phrases' => $this->getPhrases('next', $locale),
                'action' => 'instagram-next',
                'description' => 'Next post'
            ],
            [
                'id' => 'previous-post',
                'phrases' => $this->getPhrases('previous', $locale),
                'action' => 'instagram-previous',
                'description' => 'Previous post'
            ],
            [
                'id' => 'like-post',
                'phrases' => $this->getPhrases('like', $locale),
                'action' => 'instagram-like',
                'description' => 'Like post'
            ],
            [
                'id' => 'comment',
                'phrases' => $this->getPhrases('comment', $locale),
                'action' => 'instagram-comment',
                'description' => 'Open comment section'
            ],
        ];
    }
}

