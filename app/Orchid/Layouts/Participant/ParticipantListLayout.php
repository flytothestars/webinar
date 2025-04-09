<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Participant;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use App\Models\Participant;
use App\Models\Webinar;

class ParticipantListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'participant_list';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('phone', __('Номер телефона')),
            TD::make('name', __('Имя')),
            TD::make('webinar_id', 'Вебинар')->render(function(Participant $participant){
                $webinar = Webinar::where('id', $participant->webinar_id)->first();
                return $webinar->title;
            }),
            TD::make('created_at', __('Дата регистрации')),
        ];
    }
}
