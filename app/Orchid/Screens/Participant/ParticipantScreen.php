<?php

namespace App\Orchid\Screens\Participant;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\Participant\ParticipantListLayout;
use App\Models\Participant;

class ParticipantScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'participant_list' => Participant::orderBy('created_at', 'desc')->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Участники';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ParticipantListLayout::class
        ];
    }
}
