<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    $locale = Session::get('locale', 'fr');

    // Sécurise la valeur (uniquement fr/en)
    if (! in_array($locale, ['fr', 'en', 'ht'], true)) {
      $locale = 'fr';
      Session::put('locale', $locale);
    }

    App::setLocale($locale);

    return $next($request);
  }
}
