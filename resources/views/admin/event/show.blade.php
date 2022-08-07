@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.event.title_singular') }}:
                    {{ trans('cruds.event.fields.id') }}
                    {{ $event->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.id') }}
                            </th>
                            <td>
                                {{ $event->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.event_type') }}
                            </th>
                            <td>
                                {{ $event->event_type_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.sport') }}
                            </th>
                            <td>
                                @if($event->sport)
                                    <span class="badge badge-relationship">{{ $event->sport->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.number_of_team') }}
                            </th>
                            <td>
                                {{ $event->number_of_team }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.player_per_team') }}
                            </th>
                            <td>
                                {{ $event->player_per_team }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.application_type') }}
                            </th>
                            <td>
                                {{ $event->application_type_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.description') }}
                            </th>
                            <td>
                                {{ $event->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.start_date_time') }}
                            </th>
                            <td>
                                {{ $event->start_date_time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.event.fields.end_date_time') }}
                            </th>
                            <td>
                                {{ $event->end_date_time }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('event_edit')
                    <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection