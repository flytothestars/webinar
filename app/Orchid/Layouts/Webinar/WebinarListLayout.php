<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Webinar;

use App\Models\Webinar;
use App\Models\WebinarStatus;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Color;
use Carbon\Carbon;
class WebinarListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'webinar_list';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('title', __('Название')),
            TD::make('video_url', __('Ссылка видео')),
            TD::make('start_time', __('Время начало'))->render(function(Webinar $webinar) {
                $dateTime = Carbon::parse($webinar->date . ' ' . $webinar->time);
                return $dateTime->format('d.m.Y H:i'); // Adjust the format as needed
            }),

            TD::make('status', __('Статус'))->render(function(Webinar $webinar){
                $status = WebinarStatus::where('enum_id', $webinar->status)->first();
                $statusColor = $status ? $status->color : 'btn-secondary';
                return "<span class='$statusColor'>{$status->name}</span>";
            })->width('150px'),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->render(fn (Webinar $webinar) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.webinar.edit', $webinar->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $webinar->id,
                            ]),
                    ])),
                
        ];
    }
}
