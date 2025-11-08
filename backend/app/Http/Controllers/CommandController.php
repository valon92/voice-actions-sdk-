<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\UniversalCommands;

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
     * Get commands for demo (no API key required)
     * Returns default commands based on locale and platform name
     */
    public function demo(Request $request)
    {
        $locale = $request->input('locale', 'en-US');
        $platformName = $request->input('platform_name', 'demo');

        // Return default commands without requiring API key
        $commands = $this->getDefaultCommands($locale, $platformName);

        return response()->json([
            'success' => true,
            'commands' => $commands,
            'platform' => [
                'name' => $platformName,
                'plan' => 'demo',
            ],
            'locale' => $locale,
        ]);
    }

    /**
     * Get default commands based on locale
     * Komanda universale që funksionojnë për çdo platformë
     * Includes all commands for social media platforms (Facebook, Instagram, TikTok, X, etc.)
     */
    private function getDefaultCommands($locale, $platformName)
    {
        $baseLocale = explode('-', $locale)[0]; // Extract base locale (e.g., 'en' from 'en-US')

        // Get all universal commands from UniversalCommands helper
        $commands = UniversalCommands::getAllCommands($baseLocale);

        return $commands;
    }

    /**
     * Get default commands (old method - kept for reference)
     * @deprecated Use UniversalCommands::getAllCommands() instead
     */
    private function getDefaultCommandsOld($locale, $platformName)
    {
        $baseLocale = explode('-', $locale)[0];

        // Komanda universale bazë për çdo platformë
        $commands = [
            // Navigation
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
                'id' => 'go-home',
                'phrases' => $this->getPhrases('go-home', $baseLocale),
                'action' => 'go-home',
                'description' => 'Go to home feed'
            ],
            [
                'id' => 'go-profile',
                'phrases' => $this->getPhrases('go-profile', $baseLocale),
                'action' => 'go-profile',
                'description' => 'Go to profile'
            ],
            [
                'id' => 'go-messages',
                'phrases' => $this->getPhrases('go-messages', $baseLocale),
                'action' => 'go-messages',
                'description' => 'Go to messages'
            ],
            [
                'id' => 'go-notifications',
                'phrases' => $this->getPhrases('go-notifications', $baseLocale),
                'action' => 'go-notifications',
                'description' => 'Go to notifications'
            ],
            [
                'id' => 'search',
                'phrases' => $this->getPhrases('search', $baseLocale),
                'action' => 'search',
                'description' => 'Open search'
            ],
            
            // Content Navigation
            [
                'id' => 'next',
                'phrases' => $this->getPhrases('next', $baseLocale),
                'action' => 'next',
                'description' => 'Next item (post, video, story, etc.)'
            ],
            [
                'id' => 'previous',
                'phrases' => $this->getPhrases('previous', $baseLocale),
                'action' => 'previous',
                'description' => 'Previous item'
            ],
            
            // Social Actions (Universale për Facebook, Instagram, TikTok, X, etj.)
            [
                'id' => 'like',
                'phrases' => $this->getPhrases('like', $baseLocale),
                'action' => 'like',
                'description' => 'Like post/content'
            ],
            [
                'id' => 'unlike',
                'phrases' => $this->getPhrases('unlike', $baseLocale),
                'action' => 'unlike',
                'description' => 'Unlike post/content'
            ],
            [
                'id' => 'comment',
                'phrases' => $this->getPhrases('comment', $baseLocale),
                'action' => 'comment',
                'description' => 'Open comment section'
            ],
            [
                'id' => 'share',
                'phrases' => $this->getPhrases('share', $baseLocale),
                'action' => 'share',
                'description' => 'Share post/content'
            ],
            [
                'id' => 'save',
                'phrases' => $this->getPhrases('save', $baseLocale),
                'action' => 'save',
                'description' => 'Save post/content'
            ],
            [
                'id' => 'unsave',
                'phrases' => $this->getPhrases('unsave', $baseLocale),
                'action' => 'unsave',
                'description' => 'Unsave post/content'
            ],
            [
                'id' => 'follow',
                'phrases' => $this->getPhrases('follow', $baseLocale),
                'action' => 'follow',
                'description' => 'Follow user/account'
            ],
            [
                'id' => 'unfollow',
                'phrases' => $this->getPhrases('unfollow', $baseLocale),
                'action' => 'unfollow',
                'description' => 'Unfollow user/account'
            ],
            [
                'id' => 'view-profile',
                'phrases' => $this->getPhrases('view-profile', $baseLocale),
                'action' => 'view-profile',
                'description' => 'View user profile'
            ],
            
            // Content Creation (Universale)
            [
                'id' => 'create-post',
                'phrases' => $this->getPhrases('create-post', $baseLocale),
                'action' => 'create-post',
                'description' => 'Create new post/content'
            ],
            [
                'id' => 'open-camera',
                'phrases' => $this->getPhrases('open-camera', $baseLocale),
                'action' => 'open-camera',
                'description' => 'Open camera'
            ],
            
            // Media Control (Universale për video/audio)
            [
                'id' => 'play',
                'phrases' => $this->getPhrases('play', $baseLocale),
                'action' => 'play',
                'description' => 'Play video/audio'
            ],
            [
                'id' => 'pause',
                'phrases' => $this->getPhrases('pause', $baseLocale),
                'action' => 'pause',
                'description' => 'Pause video/audio'
            ],
            [
                'id' => 'mute',
                'phrases' => $this->getPhrases('mute', $baseLocale),
                'action' => 'mute',
                'description' => 'Mute audio'
            ],
            [
                'id' => 'unmute',
                'phrases' => $this->getPhrases('unmute', $baseLocale),
                'action' => 'unmute',
                'description' => 'Unmute audio'
            ],
            [
                'id' => 'volume-up',
                'phrases' => $this->getPhrases('volume-up', $baseLocale),
                'action' => 'volume-up',
                'description' => 'Increase volume'
            ],
            [
                'id' => 'volume-down',
                'phrases' => $this->getPhrases('volume-down', $baseLocale),
                'action' => 'volume-down',
                'description' => 'Decrease volume'
            ],
            [
                'id' => 'fullscreen',
                'phrases' => $this->getPhrases('fullscreen', $baseLocale),
                'action' => 'fullscreen',
                'description' => 'Toggle fullscreen'
            ],
            [
                'id' => 'skip-forward',
                'phrases' => $this->getPhrases('skip-forward', $baseLocale),
                'action' => 'skip-forward',
                'description' => 'Skip forward'
            ],
            [
                'id' => 'skip-backward',
                'phrases' => $this->getPhrases('skip-backward', $baseLocale),
                'action' => 'skip-backward',
                'description' => 'Skip backward'
            ],
            
            // Basic Actions
            [
                'id' => 'click',
                'phrases' => $this->getPhrases('click', $baseLocale),
                'action' => 'click',
                'description' => 'Click element'
            ],
        ];

        // Platformat mund të shtojnë komanda shtesë specifike nëse duan
        // Por komanda bazë janë universale dhe funksionojnë për të gjitha platformat

        return $commands;
    }

    /**
     * Get phrases for a command based on locale
     * @deprecated Use UniversalCommands::getPhrases() instead
     */
    private function getPhrases($command, $locale)
    {
        // Use UniversalCommands helper
        return UniversalCommands::getPhrases($command, $locale);
    }

    /**
     * Get phrases (old method - kept for reference)
     * @deprecated Use UniversalCommands::getPhrases() instead
     */
    private function getPhrasesOld($command, $locale)
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
                'unlike' => ['unlike', 'remove like', 'unheart'],
                'subscribe' => ['subscribe', 'follow channel'],
                'comment' => ['comment', 'add comment', 'write comment'],
                'share' => ['share', 'share post', 'send post'],
                'save' => ['save', 'save post', 'bookmark'],
                'unsave' => ['unsave', 'remove save', 'unbookmark'],
                'follow' => ['follow', 'follow user', 'follow account'],
                'unfollow' => ['unfollow', 'unfollow user', 'stop following'],
                'go-home' => ['go home', 'home', 'home feed', 'main feed'],
                'go-reels' => ['go to reels', 'reels', 'open reels', 'show reels'],
                'go-explore' => ['explore', 'go to explore', 'discover', 'browse'],
                'go-stories' => ['stories', 'go to stories', 'view stories', 'open stories'],
                'go-profile' => ['profile', 'go to profile', 'my profile', 'view profile'],
                'go-messages' => ['messages', 'direct messages', 'dm', 'inbox', 'go to messages'],
                'go-notifications' => ['notifications', 'alerts', 'go to notifications'],
                'view-profile' => ['view profile', 'see profile', 'show profile', 'user profile'],
                'create-post' => ['create post', 'new post', 'make post', 'post'],
                'open-camera' => ['camera', 'open camera', 'take photo', 'take picture'],
                'create-story' => ['create story', 'new story', 'make story', 'add story'],
                'create-reel' => ['create reel', 'new reel', 'make reel', 'add reel'],
                'next-story' => ['next story', 'skip story', 'forward story'],
                'previous-story' => ['previous story', 'back story', 'go back story'],
                'skip-story' => ['skip story', 'next story', 'forward'],
                'next-reel' => ['next reel', 'skip reel', 'forward reel'],
                'previous-reel' => ['previous reel', 'back reel', 'go back reel'],
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
                'unlike' => ['heq pelqimin', 'heq zemer', 'mos pelqe'],
                'subscribe' => ['abonohu', 'ndiq kanalin'],
                'comment' => ['komento', 'shto koment', 'shkruaj koment'],
                'share' => ['ndaj', 'shpernda', 'dergo'],
                'save' => ['ruaj', 'ruaj postimin', 'bookmark'],
                'unsave' => ['heq ruajtjen', 'heq bookmark'],
                'follow' => ['ndiq', 'ndiq perdoruesin', 'follow'],
                'unfollow' => ['mos ndiq', 'heq ndjekjen', 'stop follow'],
                'go-home' => ['shko ne shtepi', 'home', 'faqja kryesore'],
                'go-reels' => ['reels', 'shko ne reels', 'hape reels'],
                'go-explore' => ['explore', 'shko ne explore', 'zbulim'],
                'go-stories' => ['stories', 'shko ne stories', 'hape stories'],
                'go-profile' => ['profile', 'shko ne profile', 'profili im'],
                'go-messages' => ['mesazhe', 'direct', 'dm', 'inbox'],
                'go-notifications' => ['njoftime', 'alerts', 'shko ne njoftime'],
                'view-profile' => ['shiko profile', 'shfaq profile', 'profili i perdoruesit'],
                'create-post' => ['krijo postim', 'postim i ri', 'bej postim'],
                'open-camera' => ['kamera', 'hape kamere', 'foto', 'fotoje'],
                'create-story' => ['krijo story', 'story i ri', 'shto story'],
                'create-reel' => ['krijo reel', 'reel i ri', 'shto reel'],
                'next-story' => ['story tjeter', 'kaloj story', 'para story'],
                'previous-story' => ['story i meparshem', 'mbrapa story'],
                'skip-story' => ['kaloj story', 'skip story'],
                'next-reel' => ['reel tjeter', 'kaloj reel', 'para reel'],
                'previous-reel' => ['reel i meparshem', 'mbrapa reel'],
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
                'unlike' => ['quitar me gusta', 'quitar corazón'],
                'subscribe' => ['suscribirse', 'seguir canal'],
                'comment' => ['comentar', 'agregar comentario', 'escribir comentario'],
                'share' => ['compartir', 'compartir publicación', 'enviar'],
                'save' => ['guardar', 'guardar publicación', 'marcar'],
                'unsave' => ['quitar guardado', 'desmarcar'],
                'follow' => ['seguir', 'seguir usuario', 'seguir cuenta'],
                'unfollow' => ['dejar de seguir', 'dejar seguir'],
                'go-home' => ['inicio', 'ir a inicio', 'feed principal'],
                'go-reels' => ['reels', 'ir a reels', 'abrir reels'],
                'go-explore' => ['explorar', 'ir a explorar', 'descubrir'],
                'go-stories' => ['historias', 'ir a historias', 'ver historias'],
                'go-profile' => ['perfil', 'ir a perfil', 'mi perfil'],
                'go-messages' => ['mensajes', 'mensajes directos', 'dm', 'buzón'],
                'go-notifications' => ['notificaciones', 'alertas', 'ir a notificaciones'],
                'view-profile' => ['ver perfil', 'mostrar perfil', 'perfil de usuario'],
                'create-post' => ['crear publicación', 'nueva publicación', 'publicar'],
                'open-camera' => ['cámara', 'abrir cámara', 'tomar foto'],
                'create-story' => ['crear historia', 'nueva historia', 'agregar historia'],
                'create-reel' => ['crear reel', 'nuevo reel', 'agregar reel'],
                'next-story' => ['siguiente historia', 'saltar historia'],
                'previous-story' => ['historia anterior', 'atrás historia'],
                'skip-story' => ['saltar historia', 'siguiente historia'],
                'next-reel' => ['siguiente reel', 'saltar reel'],
                'previous-reel' => ['reel anterior', 'atrás reel'],
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
                'unlike' => ['ne plus aimer', 'retirer le cœur'],
                'subscribe' => ['s\'abonner', 'suivre la chaîne'],
                'comment' => ['commenter', 'ajouter un commentaire', 'écrire un commentaire'],
                'share' => ['partager', 'partager la publication', 'envoyer'],
                'save' => ['enregistrer', 'sauvegarder', 'marquer'],
                'unsave' => ['retirer l\'enregistrement', 'démarquer'],
                'follow' => ['suivre', 'suivre l\'utilisateur', 'suivre le compte'],
                'unfollow' => ['ne plus suivre', 'arrêter de suivre'],
                'go-home' => ['accueil', 'aller à l\'accueil', 'fil principal'],
                'go-reels' => ['reels', 'aller aux reels', 'ouvrir reels'],
                'go-explore' => ['explorer', 'aller à explorer', 'découvrir'],
                'go-stories' => ['stories', 'aller aux stories', 'voir stories'],
                'go-profile' => ['profil', 'aller au profil', 'mon profil'],
                'go-messages' => ['messages', 'messages directs', 'dm', 'boîte de réception'],
                'go-notifications' => ['notifications', 'alertes', 'aller aux notifications'],
                'view-profile' => ['voir le profil', 'afficher le profil', 'profil utilisateur'],
                'create-post' => ['créer une publication', 'nouvelle publication', 'publier'],
                'open-camera' => ['caméra', 'ouvrir la caméra', 'prendre une photo'],
                'create-story' => ['créer une story', 'nouvelle story', 'ajouter story'],
                'create-reel' => ['créer un reel', 'nouveau reel', 'ajouter reel'],
                'next-story' => ['story suivante', 'passer story'],
                'previous-story' => ['story précédente', 'retour story'],
                'skip-story' => ['passer story', 'story suivante'],
                'next-reel' => ['reel suivant', 'passer reel'],
                'previous-reel' => ['reel précédent', 'retour reel'],
            ],
        ];

        return $phrases[$locale][$command] ?? $phrases['en'][$command] ?? [];
    }

    // Metodat getYouTubeCommands dhe getInstagramCommands janë hequr
    // Të gjitha komandat janë universale dhe funksionojnë për çdo platformë
    // Platformat implementojnë logjikën e tyre për çdo komandë universale
}

