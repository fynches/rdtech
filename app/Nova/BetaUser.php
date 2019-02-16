<?php

namespace App\Nova;

use App\Nova\Actions\CreateInvite;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;

class BetaUser extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Domain\BetaUser';

	public static $group = "Miscellaneous";

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
	        Text::make('name')
	            ->sortable()
	            ->rules('required', 'max:255'),
	        Text::make('email')
	            ->sortable()
	            ->rules('required', 'email', 'max:255')
	            ->creationRules('unique:beta_users,email')
	            ->updateRules('unique:_beta_users,email,{{resourceId}}'),
	        Text::make('invitation')
	            ->onlyOnIndex()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
        	new CreateInvite
        ];
    }
}
