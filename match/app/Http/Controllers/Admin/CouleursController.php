<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Couleur\BulkDestroyCouleur;
use App\Http\Requests\Admin\Couleur\DestroyCouleur;
use App\Http\Requests\Admin\Couleur\IndexCouleur;
use App\Http\Requests\Admin\Couleur\StoreCouleur;
use App\Http\Requests\Admin\Couleur\UpdateCouleur;
use App\Models\Couleur;
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

class CouleursController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexCouleur $request
     * @return array|Factory|View
     */
    public function index(IndexCouleur $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Couleur::class)->processRequestAndGet(
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

        return view('admin.couleur.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.couleur.create');

        return view('admin.couleur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCouleur $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCouleur $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Couleur
        $couleur = Couleur::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/couleurs'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/couleurs');
    }

    /**
     * Display the specified resource.
     *
     * @param Couleur $couleur
     * @throws AuthorizationException
     * @return void
     */
    public function show(Couleur $couleur)
    {
        $this->authorize('admin.couleur.show', $couleur);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Couleur $couleur
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Couleur $couleur)
    {
        $this->authorize('admin.couleur.edit', $couleur);


        return view('admin.couleur.edit', [
            'couleur' => $couleur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCouleur $request
     * @param Couleur $couleur
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCouleur $request, Couleur $couleur)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Couleur
        $couleur->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/couleurs'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/couleurs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyCouleur $request
     * @param Couleur $couleur
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCouleur $request, Couleur $couleur)
    {
        $couleur->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyCouleur $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCouleur $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Couleur::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
