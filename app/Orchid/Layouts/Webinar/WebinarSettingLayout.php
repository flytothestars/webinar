<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Webinar;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use App\Models\WebinarStatus;

class WebinarSettingLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('webinar.video_url')
                ->type('text')
                ->title(__('URL видео на сайте'))
                ->disabled(),

            Input::make('webinar.rtmp_url')
                ->type('text')
                ->title(__('URL видеопотока'))
                ->disabled(),

            Input::make('webinar.date')
                ->type('date')
                ->title('Дата')
                ->placeholder('YYYY-MM-DD')
                ->horizontal(),

            Input::make('webinar.time')
                ->type('time')
                ->title('Время')
                ->placeholder('HH:MM:SS')
                ->horizontal(),

            // Upload::make('webinar.attachments')
            //     ->title('Видео файл')
            //     ->groups('webinarVideo')
            //     ->required(),


            Relation::make('webinar.status')
                ->fromModel(WebinarStatus::class, 'name')
                ->title('Статус вебинара')
        ];
    }
}
