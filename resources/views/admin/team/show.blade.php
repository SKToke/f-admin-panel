@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.team.title_singular') }}:
                    {{ trans('cruds.team.fields.id') }}
                    {{ $team->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.id') }}
                            </th>
                            <td>
                                {{ $team->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.name') }}
                            </th>
                            <td>
                                {{ $team->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.sport') }}
                            </th>
                            <td>
                                @if($team->sport)
                                    <span class="badge badge-relationship">{{ $team->sport->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.creator') }}
                            </th>
                            <td>
                                @if($team->creator)
                                    <span class="badge badge-relationship">{{ $team->creator->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.coach') }}
                            </th>
                            <td>
                                @if($team->coach)
                                    <span class="badge badge-relationship">{{ $team->coach->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.gender') }}
                            </th>
                            <td>
                                {{ $team->gender_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.level') }}
                            </th>
                            <td>
                                {{ $team->level_label }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.oganization_name') }}
                            </th>
                            <td>
                                {{ $team->oganization_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.oganization_url') }}
                            </th>
                            <td>
                                {{ $team->oganization_url }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.division') }}
                            </th>
                            <td>
                                {{ $team->division }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.team.fields.season') }}
                            </th>
                            <td>
                                {{ $team->season }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('team_edit')
                    <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection