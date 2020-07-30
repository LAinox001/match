<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/fillieres') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.filliere.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/plats') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.plat.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/couleurs') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.couleur.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/animals') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.animal.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/etudiants') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.etudiant.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/parrains') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.parrain.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/match/matchup') }}"><i class="nav-icon icon-diamond"></i> Match</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
