<?php

namespace App\Orchid\Screens\Webinar;

use Orchid\Screen\Screen;
use App\Orchid\Layouts\Webinar\WebinarListLayout;
use App\Models\Webinar;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\Link;

class WebinarScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'webinar_list' =>Webinar::orderby('created_at', 'desc')->paginate(10)
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Вебинар';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            // ModalToggle::make('Создать')->modal('createWebinar')->method('createOrUpdateWebinar')
            Link::make(__('Создать'))
                ->icon('bs.plus-circle')
                ->route('platform.webinar.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            WebinarListLayout::class
        ];
    }

    public function createOrUpdateWebinar(WebinarRequest $request )
    {
        $validated = $request->validated();
        
        $webinarId = $request->input('webinar.id');
        $webinar = Webinar::updateOrCreate([
            'id' => $webinarId
        ], $validated['webinar']);
        $webinar->attachments()->syncWithoutDetaching(
            $request->input('webinar.attachments', [])
        );
        is_null($webinarId) ? Toast::info('Успешно добавлено') : Toast::info('Успешно обновлено');

    }

    public function asyncGetWebinar(Webinar $webinar): array
    {
        $webinar->load('attachments');
        return [
            'webinar' => $webinar
        ];
    }

}
