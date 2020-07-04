<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWorkerRequest;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Worker;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('worker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $workers = Worker::all();

        return view('admin.workers.index', compact('workers'));
    }

    public function create()
    {
        abort_if(Gate::denies('worker_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workers.create');
    }

    public function store(StoreWorkerRequest $request)
    {
        $worker = Worker::create($request->all());

        $user = User::create($request->all());
        $user->roles()->sync(["3"]);

        return redirect()->route('admin.workers.index');
    }

    public function edit(Worker $worker)
    {
        abort_if(Gate::denies('worker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workers.edit', compact('worker'));
    }

    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        $worker->update($request->all());

        return redirect()->route('admin.workers.index');
    }

    public function show(Worker $worker)
    {
        abort_if(Gate::denies('worker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.workers.show', compact('worker'));
    }

    public function destroy(Worker $worker)
    {
        abort_if(Gate::denies('worker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $worker->delete();

        return back();
    }

    public function massDestroy(MassDestroyWorkerRequest $request)
    {
        Worker::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
