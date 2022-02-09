@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Output Ganjil') }}</div>

                <div class="card-body">
                    <table class="table output-ganjil">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Handphone</th>
                                <th scope="col">Provider</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Output Genap') }}</div>

                <div class="card-body">
                    <table class="table output-genap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Handphone</th>
                                <th scope="col">Provider</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<audio id="ringtone" src="{{ asset("ringtones/done.mp3") }}"></audio>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                
                <input type="hidden" name="id" id="id">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button onclick="put()" type="button" class="btn btn-primary">
                {{ __('Update') }}
            </button>
        </div>
        </div>
    </div>
</div>
  

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            init();

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            const pusher = new Pusher('920aa015011b8f3b3fc7', {
                cluster: 'ap1'
            });

            const channel = pusher.subscribe('laravel-with-google');
            channel.bind('my-event', function(response) {
                showToast(response)
            });
        })
    </script>
@endsection