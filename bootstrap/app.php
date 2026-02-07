<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetLocale;
use App\Models\SystemLog; // Assurez-vous que l'import est là

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // --- LOGIQUE DE CAPTURE AUTOMATIQUE ---
        $exceptions->reportable(function (Throwable $e) {
            try {
                // On vérifie si ce n'est pas une erreur 404 (pour éviter de polluer les logs)
                if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                    return;
                }

                SystemLog::record('danger', 'Crash Automatique: ' . $e->getMessage(), [
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => mb_substr($e->getTraceAsString(), 0, 500), // On limite la trace pour la DB
                    'url' => request()->fullUrl(),
                ]);
            } catch (Throwable $dbError) {
                // Si la DB est en panne, on ne fait rien pour éviter le crash en boucle
            }
        });
    })
    ->create();
