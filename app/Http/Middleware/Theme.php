<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class Theme
{
    /**
     * @param Request $request
     * @return string
     */
    private function getViewTheme(Request $request)
    {
        if ($request->cookie('theme') == 'mobile') {
            return 'mobile';
        }

        if (!$request->hasCookie('theme')) {
            return (!Agent::isDesktop() && !Agent::isTablet()) ? 'mobile' : 'desktop';
        }

        return 'desktop';
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $theme = $this->getViewTheme($request);

        config(['theme.default' => $theme]);

        return $next($request);
    }
}
