<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Gate;
use Illuminate\Http\Response;

class AnnouncementController extends Controller
{
    public function index()
    {
      //  abort_if(Gate::denies('announcement_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.announcement.index');
    }

    public function create()
    {
       // abort_if(Gate::denies('announcement_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.announcement.create');
    }

    public function edit(Announcement $announcement)
    {
        abort_if(Gate::denies('announcement_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.announcement.edit', compact('announcement'));
    }

    public function show(Announcement $announcement)
    {
        abort_if(Gate::denies('announcement_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $announcement->load('sport');

        return view('admin.announcement.show', compact('announcement'));
    }
}

