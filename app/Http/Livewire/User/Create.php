<?php

namespace App\Http\Livewire\User;

use App\Models\Country;
use App\Models\Currency;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    public User $user;

    public array $roles = [];

    public string $password = '';

    public array $listsForFields = [];

    // public array $country_id = [];

    // public array $phone_code = [];

    // public array $currency_id = [];

    public array $mediaToRemove = [];

    public array $mediaCollections = [];


    public function addMedia($media): void
    {
        $this->mediaCollections[$media['collection_name']][] = $media;
    }

    public function removeMedia($media): void
    {
        $collection = collect($this->mediaCollections[$media['collection_name']]);
        $this->mediaCollections[$media['collection_name']] = $collection->reject(fn ($item) => $item['uuid'] === $media['uuid'])->toArray();
        $this->mediaToRemove[] = $media['uuid'];
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->initListsForFields();
        $this->user->is_notify_email = false;
        $this->user->is_notify_sms = false;
        $this->user->is_notify_push = false;
        $this->user->is_marketing = false;
    }

    public function render()
    {
        return view('livewire.user.create');
    }

    public function submit()
    {
        $this->validate();
        $this->user->password = $this->password;
        $this->user->save();
        $this->user->roles()->sync($this->roles);
        // $this->user->country_id()->sync($this->country_id);
        $this->syncMedia();

        return redirect()->route('admin.users.index');
    }

    protected function syncMedia(): void
    {
        collect($this->mediaCollections)->flatten(1)
            ->each(fn ($item) => Media::where('uuid', $item['uuid'])
                ->update(['model_id' => $this->user->id]));

        Media::whereIn('uuid', $this->mediaToRemove)->delete();
    }

    protected function rules(): array
    {
        return [
            'user.email' => [
                'email:rfc',
                'required',
                'unique:users,email',
            ],
            'password' => [
                'string',
                'required',
            ],
            'roles' => [
                'required',
                'array',
            ],
            'roles.*.id' => [
                'integer',
                'exists:roles,id',
            ],
            'user.locale' => [
                'string',
                'nullable',
            ],
            'mediaCollections.user_avatar' => [
                'array',
                'nullable',
            ],
            'mediaCollections.user_avatar.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'user.first_name' => [
                'string',
                'required',
            ],
            'user.last_name' => [
                'string',
                'required',
            ],
            'user.gender' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['gender'])),
            ],
            'user.phone' => [
                'string',
                'required',
            ],
            'user.birth_date' => [
                'required',
                'date_format:' . config('project.date_format'),
            ],
            'user.status' => [
                'required',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'mediaCollections.user_background_image' => [
                'array',
                'nullable',
            ],
            'mediaCollections.user_background_image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'user.country_id' => [
                'integer'
            ],
            'user.phone_code' => [
                'integer'
            ],
            'user.currency_id' => [
                'integer'
            ],
            'user.is_notify_email' => [
                'boolean'
            ],
            'user.is_notify_sms' => [
                'boolean'
            ],
            'user.is_notify_push' => [
                'boolean'
            ],
            'user.is_marketing' => [
                'boolean'
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['roles'] = Role::pluck('title', 'id')->toArray();
        $this->listsForFields['gender'] = $this->user::GENDER_SELECT;
        $this->listsForFields['status'] = $this->user::STATUS_SELECT;
        $this->listsForFields['country_id'] = Country::pluck('name', 'id')->toArray();
        $this->listsForFields['phone_code'] = Country::pluck('phone_code', 'id')->toArray();
        $this->listsForFields['currency_id'] = Currency::pluck('name', 'id')->toArray();
    }
}
