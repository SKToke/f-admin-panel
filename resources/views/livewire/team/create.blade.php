<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('team.name') ? 'invalid' : '' }}">
        <label class="form-label" for="name">{{ trans('cruds.team.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" wire:model.defer="team.name">
        <div class="validation-message">
            {{ $errors->first('team.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.sport_id') ? 'invalid' : '' }}">
        <label class="form-label" for="sport">{{ trans('cruds.team.fields.sport') }}</label>
        <x-select-list class="form-control" id="sport" name="sport" :options="$this->listsForFields['sport']" wire:model="team.sport_id" />
        <div class="validation-message">
            {{ $errors->first('team.sport_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.sport_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.creator_id') ? 'invalid' : '' }}">
        <label class="form-label" for="creator">{{ trans('cruds.team.fields.creator') }}</label>
        <x-select-list class="form-control" id="creator" name="creator" :options="$this->listsForFields['creator']" wire:model="team.creator_id" />
        <div class="validation-message">
            {{ $errors->first('team.creator_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.creator_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.coach_id') ? 'invalid' : '' }}">
        <label class="form-label" for="coach">{{ trans('cruds.team.fields.coach') }}</label>
        <x-select-list class="form-control" id="coach" name="coach" :options="$this->listsForFields['coach']" wire:model="team.coach_id" />
        <div class="validation-message">
            {{ $errors->first('team.coach_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.coach_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.gender') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.team.fields.gender') }}</label>
        @foreach($this->listsForFields['gender'] as $key => $value)
            <label class="radio-label"><input type="radio" name="gender" wire:model="team.gender" value="{{ $key }}">{{ $value }}</label>
        @endforeach
        <div class="validation-message">
            {{ $errors->first('team.gender') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.gender_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.level') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.team.fields.level') }}</label>
        <select class="form-control" wire:model="team.level">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['level'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('team.level') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.level_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.oganization_name') ? 'invalid' : '' }}">
        <label class="form-label" for="oganization_name">{{ trans('cruds.team.fields.oganization_name') }}</label>
        <input class="form-control" type="text" name="oganization_name" id="oganization_name" wire:model.defer="team.oganization_name">
        <div class="validation-message">
            {{ $errors->first('team.oganization_name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.oganization_name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.oganization_url') ? 'invalid' : '' }}">
        <label class="form-label" for="oganization_url">{{ trans('cruds.team.fields.oganization_url') }}</label>
        <input class="form-control" type="text" name="oganization_url" id="oganization_url" wire:model.defer="team.oganization_url">
        <div class="validation-message">
            {{ $errors->first('team.oganization_url') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.oganization_url_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.division') ? 'invalid' : '' }}">
        <label class="form-label" for="division">{{ trans('cruds.team.fields.division') }}</label>
        <input class="form-control" type="text" name="division" id="division" wire:model.defer="team.division">
        <div class="validation-message">
            {{ $errors->first('team.division') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.division_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('team.season') ? 'invalid' : '' }}">
        <label class="form-label" for="season">{{ trans('cruds.team.fields.season') }}</label>
        <input class="form-control" type="text" name="season" id="season" wire:model.defer="team.season">
        <div class="validation-message">
            {{ $errors->first('team.season') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.team.fields.season_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>