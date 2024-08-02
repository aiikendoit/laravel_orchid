<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Illuminate\Http\Request;

use Orchid\Support\Color;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;

class StateScreen extends Screen
{
    public $clicks;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            // 'clicks' => 0,
            'clicks'  => $this->clicks ?? 0,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'State';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array //iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Label::make('clicks')
                    ->title('Click Count:'),

                Button::make('Increment Click')
                    ->type(Color::DARK)
                    ->method('increment'),
            ]),
        ];
    }

    public function increment(Request $request)
    {
        // dd($request->all());
        // dd($this->clicks);
        $this->clicks++;
    }
}
