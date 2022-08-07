<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use App\Models\Sport;
use Livewire\Component;

class Edit extends Component
{
    public Event $event;

    public array $listsForFields = [];

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.event.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->event->save();

        return redirect()->route('admin.events.index');
    }

    protected function rules(): array
    {
        return [
            'event.event_type' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['event_type'])),
            ],
            'event.sport_id' => [
                'integer',
                'exists:sports,id',
                'nullable',
            ],
            'event.number_of_team' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'event.player_per_team' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'event.application_type' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['application_type'])),
            ],
            'event.description' => [
                'string',
                'nullable',
            ],
            'event.start_date_time' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
            'event.end_date_time' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['event_type']       = $this->event::EVENT_TYPE_SELECT;
        $this->listsForFields['sport']            = Sport::pluck('name', 'id')->toArray();
        $this->listsForFields['application_type'] = $this->event::APPLICATION_TYPE_SELECT;
    }
}
