<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Webinar;

use App\Orchid\Layouts\Webinar\WebinarInfoLayout;
use App\Orchid\Layouts\Webinar\WebinarSettingLayout;
use Orchid\Screen\Screen;
use App\Models\Webinar;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Support\Facades\Toast;
use App\Http\Requests\WebinarRequest;
use Illuminate\Http\Request;
use App\Helpers\GlobalHelper;

class WebinarEditScreen extends Screen
{
    use GlobalHelper;
    /**
     * @var Webinar
     */
    public $webinar;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Webinar $webinar): iterable
    {
        return [
            'webinar' => $webinar,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->webinar->exists ? 'Редактировать' : 'Создать';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return '';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Удалить'))
                ->icon('bs.trash3')
                ->confirm(__('Вы уверены?'))
                ->method('remove')
                ->canSee($this->webinar->exists),

            Button::make(__('Сохранить'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [

            Layout::block(WebinarInfoLayout::class)
                ->title(__('Общий информация'))
                ->description(__('Информация о вебинаре'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->canSee($this->webinar->exists)
                        ->method('save')
                ),

            Layout::block(WebinarSettingLayout::class)
                ->title(__('Общий настройки'))
                ->description(__('Настройка вебинара'))
                ->commands(
                    Button::make(__('Сохранить'))
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->canSee($this->webinar->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Webinar $webinar, WebinarRequest $request)
    {
        Toast::info(__('Сохранено'));
        
        $webinar->fill($request->collect('webinar')->toArray());
        $webinar->video_url = $this->generateUrl();
        $webinar->rtmp_url = $this->generateUrl();
        $webinar->save();
        return redirect()->route('platform.webinar');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Webinar $webinar)
    {
        $webinar->delete();

        Toast::info(__('Удалено'));

        return redirect()->route('platform.webinar');
    }

}
