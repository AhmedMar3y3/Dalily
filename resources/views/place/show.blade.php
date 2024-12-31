@extends('layout')
@section('main')
<div class="container">
    <h1 class="mb-4">Place Details</h1>

    <!-- Success and Error Messages -->
    @if (Session::has('success'))
    <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h3>{{ $place->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
            

                <!-- place Details -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th>Category</th>
                            <td>{{ $place->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $place->map_disc }}</td>
                        </tr>
                        <tr>
                            <th>Rating</th>
                            <td>{{ $place->rating }}</td>
                        </tr>
                        <tr>
                            <th>Opening Time</th>
                            <td>{{ $place->open_at }}</td>
                        </tr>
                        <tr>
                            <th>Closing Time</th>
                            <td>{{ $place->close_at }}</td>
                        </tr>
                      
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Place Images</h4>
                    <div class="owl-carousel owl-theme full-width owl-carousel-dash portfolio-carousel" id="owl-carousel-basic">
                        @forelse ($place->images as $image)
                            <div class="item">
                                <img src="{{ $image->image }}" alt="Place Image">
                            </div>
                        @empty
                            <p>No images available for this place.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="card-footer text-end">
            <a href="{{ route('admin.places.index') }}" class="btn btn-secondary btn-rounded ">back</a>
            <a href="{{ route('admin.places.edit', $place->id) }}" class="btn btn-warning btn-rounded ">edit</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#owl-carousel-basic").owlCarousel({
                items: 1,
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                nav: true,
                dots: true
            });
        });
    </script>
    
</div>
@endsection
