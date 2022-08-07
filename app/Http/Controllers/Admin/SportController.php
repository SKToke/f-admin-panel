<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sport_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sport.index');
    }

    public function create()
    {
        abort_if(Gate::denies('sport_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sport.create');
    }

    public function edit(Sport $sport)
    {
        abort_if(Gate::denies('sport_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sport.edit', compact('sport'));
    }

    public function show(Sport $sport)
    {
        abort_if(Gate::denies('sport_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sport->load('creator');

        return view('admin.sport.show', compact('sport'));
    }
}
