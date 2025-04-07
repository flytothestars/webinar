<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Participant;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

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
            TD::make('created_at', __('Дата регистрации')),
        ];
    }
}
