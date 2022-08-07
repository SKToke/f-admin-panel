<?php

namespace App\Http\Livewire\Sport;

use App\Models\Sport;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public Sport $sport;

    public array $listsForFields = [];

    public function mount(Sport $sport)
    {
        $this->sport = $sport;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.sport.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->sport->save();

        return redirect()->route('admin.sports.index');
    }

    protected function rules(): array
    {
        return [
            'sport.name' => [
                'string',
                'min:0',
                'max:255',
                'nullable',
            ],
            'sport.description' => [
                'string',
                'nullable',
            ],
            'sport.creator_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'sport.max_player_per_team' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'sport.min_player_per_team' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'sport.is_require_choose_role' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['is_require_choose_role'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['creator']                = User::pluck('name', 'id')->toArray();
        $this->listsForFields['is_require_choose_role'] = $this->sport::IS_REQUIRE_CHOOSE_ROLE_RADIO;
    }
}
