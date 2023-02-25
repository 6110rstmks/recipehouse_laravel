<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Recipe;

class seeOtherUserRecipe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $previous = $request->session()->get('_previous');
        logger($previous);


        $recipe = $request->route()->parameter('recipe');

        if ($recipe->user->id != Auth::user()->id)
        {
            // リストページから遷移して来た場合のみ詳細ページに入れる。
            if (!strpos($previous['url'], '/recipes/list'))
            {
                logger('aiueo');
                return redirect()->route('recipes.list')
                    ->withErrors(['message' => 'リストページからアクセスする必要があります。']);

            }

            if (Auth::user()->point < config('recipe.options.consumption_point'))
            {
                return back()
                    ->withErrors(['message' => 'ポイントが足りません。']);
            }


        }

        return $next($request);
    }
}
