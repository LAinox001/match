<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Filliere\BulkDestroyFilliere;
use App\Http\Requests\Admin\Filliere\DestroyFilliere;
use App\Http\Requests\Admin\Filliere\IndexFilliere;
use App\Http\Requests\Admin\Filliere\StoreFilliere;
use App\Http\Requests\Admin\Filliere\UpdateFilliere;
use App\Models\Filliere;
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

class FillieresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexFilliere $request
     * @return array|Factory|View
     */
    public function index(IndexFilliere $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Filliere::class)->processRequestAndGet(
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

        return view('admin.filliere.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.filliere.create');

        return view('admin.filliere.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFilliere $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreFilliere $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Filliere
        $filliere = Filliere::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/fillieres'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/fillieres');
    }

    /**
     * Display the specified resource.
     *
     * @param Filliere $filliere
     * @throws AuthorizationException
     * @return void
     */
    public function show(Filliere $filliere)
    {
        $this->authorize('admin.filliere.show', $filliere);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Filliere $filliere
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Filliere $filliere)
    {
        $this->authorize('admin.filliere.edit', $filliere);


        return view('admin.filliere.edit', [
            'filliere' => $filliere,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFilliere $request
     * @param Filliere $filliere
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateFilliere $request, Filliere $filliere)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Filliere
        $filliere->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/fillieres'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/fillieres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyFilliere $request
     * @param Filliere $filliere
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyFilliere $request, Filliere $filliere)
    {
        $filliere->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyFilliere $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyFilliere $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Filliere::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
