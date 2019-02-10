<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Text;

class Payment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Domain\Payment';

	public static $group = "Basic";

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
	        DateTime::make('Created', 'created_at'),
	        Text::make('First Name', 'firstName')
	            ->sortable()
	            ->rules('max:255'),
	        Text::make('Last Name', 'lastName')
	            ->sortable()
	            ->rules('max:255'),
	        Text::make('email')
	            ->sortable()
	            ->rules('max:255'),
	        Text::make('amount', function() {
	        	return number_format($this->amount / 100, 2);
	        })
	            ->sortable(),
	        Text::make('city')
	            ->rules('max:255')
	            ->hideFromIndex(),
	        Text::make('state')
	            ->rules('max:255')
	            ->hideFromIndex(),
	        Text::make('zip')
	            ->rules('max:255')
	            ->hideFromIndex(),
	        Text::make('error')
	            ->rules('max:255')
	            ->hideFromIndex(),
	        Text::make('stripe_id')
	            ->rules('max:255')
	            ->hideFromIndex(),
	        Text::make('Outcome', 'outcome_type')
	            ->rules('max:255')
	            ->hideFromIndex(),
	        Text::make('Receipt', 'receipt_url', function()
	        {
	        	return "<a target = '_blank' href = '" . $this->receipt_url . "'>" . $this->receipt_url . "</a>";
	        })
	            ->onlyOnDetail()
	            ->asHtml(),
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
        return [];
    }
}
