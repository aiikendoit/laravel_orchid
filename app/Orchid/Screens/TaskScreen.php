<?php

namespace App\Orchid\Screens;

use App\Models\Task;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\TD;
use Illuminate\Http\Request;

class TaskScreen extends Screen
{


    /**
     * A method that defines all screen input data
     * is in it that database queries should be called,
     * api or any others (not necessarily explicit),
     * the result of which should be an array,
     * appeal to which his keys will be used.
     */
    public function query(): iterable
    {
        return [
            'tasks' => Task::latest()->get(),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Simple To-Do List';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'Orchid Quickstart';
    }

    /**
     * Identifies control buttons and events.
     * which will have to happen by pressing
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Add Task')
                ->modal('taskModal')
                ->method('create')
                ->icon('plus'),
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
            Layout::table('tasks', [
                TD::make('name'),

                TD::make('Actions')
                    ->alignRight()
                    ->render(function (Task $task) {
                        return Button::make('Delete Task')
                            ->confirm('After deleting, the task will be gone forever.')
                            ->method('delete', ['task' => $task->id]);
                    }),
            ]),

            Layout::modal('taskModal', Layout::rows([
                Input::make('task.name')
                    ->title('Name')
                    ->placeholder('Enter task name')
                    ->help('The name of the task to be created.'),
            ]))
                ->title('Create Task')
                ->applyButton('Add Task'),


        ];
    }

    public function create(Request $request)
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'task.name' => 'required|max:255',
        ]);

        $task = new Task();
        $task->name = $request->input('task.name');
        $task->save();
    }
    public function delete(Task $task)
    {
        $task->delete();
    }
}


