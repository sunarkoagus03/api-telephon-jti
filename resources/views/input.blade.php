@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Input') }}</div>

                <div class="card-body">
                    <form id="input_form" method="post">
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('No Handphone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control" name="phone" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==20) return false;" required autocomplete="081234567890" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="provider" class="col-md-4 col-form-label text-md-end">{{ __('Provider') }}</label>

                            <div class="col-md-6">
                                <select name="id_tele_provider" id="provider" class="form-control">
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button onclick="post()" type="button" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                                <button onclick="autoGenerate()" class="btn btn-success" type="button">
                                    {{ __('Auto') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
