<?php
/**
 * User: darluc
 * Date: 21/03/2017
 * Time: 11:06
 */

namespace app\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Determine if the request is from my blog site
 * Class FromMyBlog
 * @package app\Http\Middleware
 */
class FromMyBlog
{
    public function handle(Request $request, Closure $next)
    {
        $referer = $request->headers->get('referer');
        if (!preg_match('/\/\/log\.zvz\.im\//', $referer)) {
            abort(404);
        }
        return $next($request);
    }
}