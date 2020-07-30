<div class="form-group row align-items-center" :class="{'has-danger': errors.has('nom'), 'has-success': fields.nom && fields.nom.valid }">
    <label for="nom" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.nom') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.nom" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('nom'), 'form-control-success': fields.nom && fields.nom.valid}" id="nom" name="nom" placeholder="{{ trans('admin.parrain.columns.nom') }}">
        <div v-if="errors.has('nom')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('nom') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('prenom'), 'has-success': fields.prenom && fields.prenom.valid }">
    <label for="prenom" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.prenom') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.prenom" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('prenom'), 'form-control-success': fields.prenom && fields.prenom.valid}" id="prenom" name="prenom" placeholder="{{ trans('admin.parrain.columns.prenom') }}">
        <div v-if="errors.has('prenom')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('prenom') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('filliere_id'), 'has-success': fields.filliere_id && fields.filliere_id.valid }">
    <label for="filliere_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.filliere_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.filliere_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('filliere_id'), 'form-control-success': fields.filliere_id && fields.filliere_id.valid}" id="filliere_id" name="filliere_id" placeholder="{{ trans('admin.parrain.columns.filliere_id') }}">
            @foreach($fillieres as $key => $filliere)
                <option value="{{ $key }}">{{ $filliere }}</option>
            @endforeach
        </select>
        <div v-if="errors.has('filliere_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('filliere_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('plat_id'), 'has-success': fields.plat_id && fields.plat_id.valid }">
    <label for="plat_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.plat_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.plat_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('plat_id'), 'form-control-success': fields.plat_id && fields.plat_id.valid}" id="plat_id" name="plat_id" placeholder="{{ trans('admin.parrain.columns.plat_id') }}">
            @foreach($plats as $key => $plat)
                <option value="{{ $key }}">{{ $plat }}</option>
            @endforeach
        </select>
        <div v-if="errors.has('plat_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('plat_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('couleur_id'), 'has-success': fields.couleur_id && fields.couleur_id.valid }">
    <label for="couleur_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.couleur_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.couleur_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('couleur_id'), 'form-control-success': fields.couleur_id && fields.couleur_id.valid}" id="couleur_id" name="couleur_id" placeholder="{{ trans('admin.parrain.columns.couleur_id') }}">
            @foreach($couleurs as $key => $couleur)
                <option value="{{ $key }}">{{ $couleur }}</option>
            @endforeach
        </select>
        <div v-if="errors.has('couleur_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('couleur_id') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('animal_id'), 'has-success': fields.animal_id && fields.animal_id.valid }">
    <label for="animal_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.animal_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <select v-model="form.animal_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('animal_id'), 'form-control-success': fields.animal_id && fields.animal_id.valid}" id="animal_id" name="animal_id" placeholder="{{ trans('admin.parrain.columns.animal_id') }}">
            @foreach($animals as $key => $animal)
                <option value="{{ $key }}">{{ $animal }}</option>
            @endforeach
        </select>
        <div v-if="errors.has('animal_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('animal_id') }}</div>
    </div>
</div>

@if(\Request::is('*/edit'))
    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('match'), 'has-success': fields.match && fields.match.valid }">
        <label for="match" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.parrain.columns.match') }}</label>
            <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="integer" v-model="form.match" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('match'), 'form-control-success': fields.match && fields.match.valid}" id="match" name="match" placeholder="{{ trans('admin.parrain.columns.match') }}">
            <div v-if="errors.has('match')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('match') }}</div>
        </div>
    </div>
@endif