<?php

namespace App\Http\Livewire\Team;

use App\Models\Sport;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public Team $team;

    public array $listsForFields = [];

    public function mount(Team $team)
    {
        $this->team = $team;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.team.create');
    }

    public function submit()
    {
        $this->validate();

        $this->team->save();

        return redirect()->route('admin.teams.index');
    }

    protected function rules(): array
    {
        return [
            'team.name' => [
                'string',
                'nullable',
            ],
            'team.sport_id' => [
                'integer',
                'exists:sports,id',
                'nullable',
            ],
            'team.creator_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'team.coach_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'team.gender' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['gender'])),
            ],
            'team.level' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['level'])),
            ],
            'team.oganization_name' => [
                'string',
                'nullable',
            ],
            'team.oganization_url' => [
                'string',
                'nullable',
            ],
            'team.division' => [
                'string',
                'nullable',
            ],
            'team.season' => [
                'string',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['sport']   = Sport::pluck('name', 'id')->toArray();
        $this->listsForFields['creator'] = User::pluck('name', 'id')->toArray();
        $this->listsForFields['coach']   = User::pluck('name', 'id')->toArray();
        $this->listsForFields['gender']  = $this->team::GENDER_RADIO;
        $this->listsForFields['level']   = $this->team::LEVEL_SELECT;
    }
}
