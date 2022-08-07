<?php

namespace App\Http\Livewire\Announcement;

use App\Models\Announcement;
use App\Models\Sport;
use Livewire\Component;

class Create extends Component
{
    public Announcement $announcement;

    public array $listsForFields = [];

    public function mount(Announcement $announcement)
    {
        $this->announcement = $announcement;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.announcement.create');
    }

    public function submit()
    {
        $this->validate();


        $this->announcement->save();

        return redirect()->route('admin.announcement.index');
    }

    protected function rules(): array
    {
        return [
            'announcement.type' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['type'])),
            ],
            'announcement.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'announcement.title' => [
                'string',
                'nullable',
            ],
            'announcement.about' => [
                'string',
                'nullable',
            ],
            'announcement.start_date' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
            'announcement.end_date' => [
                'nullable',
                'date_format:' . config('project.datetime_format'),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['status']       = $this->announcement::STATUS_SELECT;
        //$this->listsForFields['sport']            = Sport::pluck('name', 'id')->toArray();
        $this->listsForFields['type'] = $this->announcement::ANNOUNCEMENT_TYPE_SELECT;
    }
}
