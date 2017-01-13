<?php
namespace App\Http\Views\Composers;

use App\Breed;
use Illuminate\Contracts\View\View;

/**
 * Author: darluc
 * Date: 4/26/16
 * Time: 09:40
 */
class CatFormComposer
{
    protected $breeds;

    public function __construct(Breed $breeds)
    {
        $this->breeds = $breeds;
    }

    public function compose(View $view)
    {
        $view->with('breeds', $this->breeds->lists('name', 'id'));
    }

}