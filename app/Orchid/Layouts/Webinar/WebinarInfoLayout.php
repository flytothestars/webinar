<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Webinar;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class WebinarInfoLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('webinar.title')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Название'))
                ->placeholder(__('')),

            Input::make('webinar.description')
                ->type('text')
                ->title(__('Описание'))
                ->placeholder(__('')),

            Input::make('webinar.price')
                ->type('number')
                ->title(__('Цена'))
                ->placeholder(__('')),
        ];
    }
}
