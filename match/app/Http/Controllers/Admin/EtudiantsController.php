<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Plat;
use App\Models\Animal;
use App\Models\Couleur;
use App\Models\Etudiant;
use App\Models\Filliere;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Auth\Access\AuthorizationException;
use App\Http\Requests\Admin\Etudiant\IndexEtudiant;
use App\Http\Requests\Admin\Etudiant\StoreEtudiant;
use App\Http\Requests\Admin\Etudiant\UpdateEtudiant;
use App\Http\Requests\Admin\Etudiant\DestroyEtudiant;
use App\Http\Requests\Admin\Etudiant\BulkDestroyEtudiant;

class EtudiantsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexEtudiant $request
     * @return array|Factory|View
     */
    public function index(IndexEtudiant $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Etudiant::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'nom', 'prenom', 'filliere_id', 'plat_id', 'couleur_id', 'animal_id'],

            // set columns to searchIn
            ['id', 'nom', 'prenom']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }
        foreach($data as $d){
            $d['filliere'] = $d->filliere->name;
            $d['plat'] = $d->plat->name;
            $d['couleur'] = $d->couleur->name;
            $d['animal'] = $d->animal->name;
        }
        // dd($data);

        return view('admin.etudiant.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.etudiant.create');

        $fillieres = Filliere::all()->pluck('name', 'id');
        $animals = Animal::all()->pluck('name', 'id');
        $couleurs = Couleur::all()->pluck('name', 'id');
        $plats = Plat::all()->pluck('name', 'id');

        return view('admin.etudiant.create')->with([
            'fillieres' => $fillieres,
            'couleurs' => $couleurs,
            'animals' => $animals,
            'plats' => $plats
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEtudiant $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreEtudiant $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // $etudiant = Etudiant::create([
        //     'nom' => 'Antoni',
        //     'prenom' => 'Luc',
        //     'filliere_id' => 1,
        //     'plat_id' => 1,
        //     'couleur_id' => 1,
        //     'animal_id' => 1
        // ]);
        // Store the Etudiant
        $etudiant = Etudiant::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/etudiants'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/etudiants');
    }

    /**
     * Display the specified resource.
     *
     * @param Etudiant $etudiant
     * @throws AuthorizationException
     * @return void
     */
    public function show(Etudiant $etudiant)
    {
        $this->authorize('admin.etudiant.show', $etudiant);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Etudiant $etudiant
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Etudiant $etudiant)
    {
        $this->authorize('admin.etudiant.edit', $etudiant);

        $fillieres = Filliere::all()->pluck('name', 'id');
        $animals = Animal::all()->pluck('name', 'id');
        $couleurs = Couleur::all()->pluck('name', 'id');
        $plats = Plat::all()->pluck('name', 'id');

        return view('admin.etudiant.edit', [
            'etudiant' => $etudiant,
            'fillieres' => $fillieres,
            'couleurs' => $couleurs,
            'animals' => $animals,
            'plats' => $plats
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEtudiant $request
     * @param Etudiant $etudiant
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateEtudiant $request, Etudiant $etudiant)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Etudiant
        $etudiant->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/etudiants'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/etudiants');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyEtudiant $request
     * @param Etudiant $etudiant
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyEtudiant $request, Etudiant $etudiant)
    {
        $etudiant->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyEtudiant $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyEtudiant $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Etudiant::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
