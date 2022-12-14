<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('sport.name') ? 'invalid' : '' }}">
        <label class="form-label" for="name">{{ trans('cruds.sport.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" wire:model.defer="sport.name">
        <div class="validation-message">
            {{ $errors->first('sport.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sport.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sport.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.sport.fields.description') }}</label>
        <input class="form-control" type="text" name="description" id="description" wire:model.defer="sport.description">
        <div class="validation-message">
            {{ $errors->first('sport.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sport.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sport.creator_id') ? 'invalid' : '' }}">
        <label class="form-label" for="creator">{{ trans('cruds.sport.fields.creator') }}</label>
        <x-select-list class="form-control" id="creator" name="creator" :options="$this->listsForFields['creator']" wire:model="sport.creator_id" />
        <div class="validation-message">
            {{ $errors->first('sport.creator_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sport.fields.creator_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sport.max_player_per_team') ? 'invalid' : '' }}">
        <label class="form-label" for="max_player_per_team">{{ trans('cruds.sport.fields.max_player_per_team') }}</label>
        <input class="form-control" type="number" name="max_player_per_team" id="max_player_per_team" wire:model.defer="sport.max_player_per_team" step="1">
        <div class="validation-message">
            {{ $errors->first('sport.max_player_per_team') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sport.fields.max_player_per_team_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sport.min_player_per_team') ? 'invalid' : '' }}">
        <label class="form-label" for="min_player_per_team">{{ trans('cruds.sport.fields.min_player_per_team') }}</label>
        <input class="form-control" type="number" name="min_player_per_team" id="min_player_per_team" wire:model.defer="sport.min_player_per_team" step="1">
        <div class="validation-message">
            {{ $errors->first('sport.min_player_per_team') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sport.fields.min_player_per_team_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('sport.is_require_choose_role') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.sport.fields.is_require_choose_role') }}</label>
        @foreach($this->listsForFields['is_require_choose_role'] as $key => $value)
            <label class="radio-label"><input type="radio" name="is_require_choose_role" wire:model="sport.is_require_choose_role" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('sport.is_require_choose_role') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.sport.fields.is_require_choose_role_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.sports.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>