@extends('layouts.app')

@section('title', 'Profil')

@section('styles')
<style>
    .profile-btn-save {
        background: var(--biru);
        border-radius: 8px;
        font-weight: 600;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }
    .profile-btn-save:hover {
        background: #23355d;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(44, 62, 107, .25);
    }
    .profile-btn-delete {
        background: var(--merah);
        border-radius: 8px;
        font-weight: 600;
        transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
    }
    .profile-btn-delete:hover {
        background: #a53125;
        transform: translateY(-1px);
        box-shadow: 0 6px 14px rgba(192, 57, 43, .28);
    }
    .form-control:focus {
        border-color: #9ab4ef;
        box-shadow: 0 0 0 .2rem rgba(44, 62, 107, .15);
    }
</style>
@endsection

@section('content')
    <h4 class="mb-4" style="color: var(--biru); font-weight: 700;">
        <i class="fas fa-user-cog me-2"></i>Profil Saya
    </h4>

    <div class="row g-4">
        <div class="col-12">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
