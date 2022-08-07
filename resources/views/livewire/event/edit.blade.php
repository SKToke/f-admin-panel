<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('event.event_type') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.event.fields.event_type') }}</label>
        <select class="form-control" wire:model="event.event_type">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['event_type'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('event.event_type') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.event_type_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.sport_id') ? 'invalid' : '' }}">
        <label class="form-label" for="sport">{{ trans('cruds.event.fields.sport') }}</label>
        <x-select-list class="form-control" id="sport" name="sport" :options="$this->listsForFields['sport']" wire:model="event.sport_id" />
        <div class="validation-message">
            {{ $errors->first('event.sport_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.sport_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.number_of_team') ? 'invalid' : '' }}">
        <label class="form-label" for="number_of_team">{{ trans('cruds.event.fields.number_of_team') }}</label>
        <input class="form-control" type="number" name="number_of_team" id="number_of_team" wire:model.defer="event.number_of_team" step="1">
        <div class="validation-message">
            {{ $errors->first('event.number_of_team') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.number_of_team_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.player_per_team') ? 'invalid' : '' }}">
        <label class="form-label" for="player_per_team">{{ trans('cruds.event.fields.player_per_team') }}</label>
        <input class="form-control" type="number" name="player_per_team" id="player_per_team" wire:model.defer="event.player_per_team" step="1">
        <div class="validation-message">
            {{ $errors->first('event.player_per_team') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.player_per_team_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.application_type') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.event.fields.application_type') }}</label>
        <select class="form-control" wire:model="event.application_type">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['application_type'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('event.application_type') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.application_type_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.event.fields.description') }}</label>
        <input class="form-control" type="text" name="description" id="description" wire:model.defer="event.description">
        <div class="validation-message">
            {{ $errors->first('event.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.start_date_time') ? 'invalid' : '' }}">
        <label class="form-label" for="start_date_time">{{ trans('cruds.event.fields.start_date_time') }}</label>
        <x-date-picker class="form-control" wire:model="event.start_date_time" id="start_date_time" name="start_date_time" />
        <div class="validation-message">
            {{ $errors->first('event.start_date_time') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.start_date_time_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.end_date_time') ? 'invalid' : '' }}">
        <label class="form-label" for="end_date_time">{{ trans('cruds.event.fields.end_date_time') }}</label>
        <x-date-picker class="form-control" wire:model="event.end_date_time" id="end_date_time" name="end_date_time" />
        <div class="validation-message">
            {{ $errors->first('event.end_date_time') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.end_date_time_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>