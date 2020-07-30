<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Plat\BulkDestroyPlat;
use App\Http\Requests\Admin\Plat\DestroyPlat;
use App\Http\Requests\Admin\Plat\IndexPlat;
use App\Http\Requests\Admin\Plat\StorePlat;
use App\Http\Requests\Admin\Plat\UpdatePlat;
use App\Models\Plat;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PlatsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPlat $request
     * @return array|Factory|View
     */
    public function index(IndexPlat $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Plat::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name'],

            // set columns to searchIn
            ['id', 'name']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.plat.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.plat.create');

        return view('admin.plat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePlat $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePlat $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Plat
        $plat = Plat::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/plats'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/plats');
    }

    /**
     * Display the specified resource.
     *
     * @param Plat $plat
     * @throws AuthorizationException
     * @return void
     */
    public function show(Plat $plat)
    {
        $this->authorize('admin.plat.show', $plat);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Plat $plat
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Plat $plat)
    {
        $this->authorize('admin.plat.edit', $plat);


        return view('admin.plat.edit', [
            'plat' => $plat,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePlat $request
     * @param Plat $plat
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePlat $request, Plat $plat)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Plat
        $plat->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/plats'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/plats');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPlat $request
     * @param Plat $plat
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPlat $request, Plat $plat)
    {
        $plat->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyPlat $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPlat $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Plat::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
