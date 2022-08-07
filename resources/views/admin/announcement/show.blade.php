@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.create') }}
                    {{ trans('cruds.announcement.title_singular') }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('announcement.create')
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.announcement.title_singular') }}:
                    {{ trans('cruds.announcement.fields.id') }}
                    {{ $announcement->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.id') }}
                            </th>
                            <td>
                                {{ $announcement->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.type') }}
                            </th>
                            <td>
                                {{ $announcement->announcement_type_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.sport') }}
                            </th>
                            <td>
                                @if($announcement->sport)
                                    <span class="badge badge-relationship">{{ $announcement->sport->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.number_of_team') }}
                            </th>
                            <td>
                                {{ $announcement->number_of_team }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.player_per_team') }}
                            </th>
                            <td>
                                {{ $announcement->player_per_team }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.application_type') }}
                            </th>
                            <td>
                                {{ $announcement->application_type_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.description') }}
                            </th>
                            <td>
                                {{ $announcement->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.start_date_time') }}
                            </th>
                            <td>
                                {{ $announcement->start_date_time }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.announcement.fields.end_date_time') }}
                            </th>
                            <td>
                                {{ $announcement->end_date_time }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('announcement_edit')
                    <a href="{{ route('admin.announcement.edit', $announcement) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.announcement.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
