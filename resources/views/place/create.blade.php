@extends('layout')

@section('main')
<div class="container">
    <h1>Create Place</h1>
    <form action="{{ route('admin.places.store') }}" method="POST" enctype="multipart/form-data">
        @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        @csrf

        <!-- Place Details -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="map_disc" class="form-label">Map Description</label>
            <textarea name="map_disc" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="open_at" class="form-label">Opening Time</label>
            <input type="time" name="open_at" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="close_at" class="form-label">Closing Time</label>
            <input type="time" name="close_at" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            </select>
        </div>
                <!-- Image Upload Section -->
                {{-- <div class="mb-3">
                    <label for="images" class="form-label">Images</label>
                    <input type="file" name="images[]" class="form-control file-upload-info" accept="image/*" multiple>
                    <span class="input-group-append ms-2">
                </div> --}}

                <div class="form-group">
                    <label>File upload</label>
                    <input type="file" name="images[]" class="file-upload-default" accept="image/*" multiple>
                    <div class="input-group col-xs-12 d-flex align-items-center">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Images">
                        <span class="input-group-append ms-2">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                        </span>
                    </div>
                </div>
                

        <!-- Map Section -->
        <div class="mb-3">
            <label for="map" class="form-label">Select Location on Map</label>
            <div id="map" style="height: 400px;"></div>
            <input type="hidden" name="latitude" id="latitude" required>
            <input type="hidden" name="longitude" id="longitude" required>
        </div>



        {{-- <div class="form-group">
            <label>File upload</label>
            <input type="file" name="images[]" class="file-upload-default" accept="image/*" multiple>
            <div class="input-group col-xs-12 d-flex align-items-center">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" accept="image/*" multiple>
              <span class="input-group-append ms-2">
                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
              </span>
            </div>
            </div> --}}

        <!-- Submit Button -->
        <button type="submit" class="btn btn-success float-start">Submit</button>
    </form>
</div>

<!-- Leaflet.js -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.querySelector('.file-upload-default');
    const fileBrowseButton = document.querySelector('.file-upload-browse');
    const fileInfoInput = document.querySelector('.file-upload-info');

    fileBrowseButton.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        const fileNames = Array.from(fileInput.files)
            .map(file => file.name)
            .join(', ');
        fileInfoInput.value = fileNames || 'No files selected';
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([31.0364, 31.3807], 10); // Default to Dakahlia, Egypt
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a marker on the map
        var marker = L.marker([30.0444, 31.2357], {
            draggable: true // Allow marker to be dragged
        }).addTo(map);

        // Update latitude and longitude fields when the marker is moved
        marker.on('dragend', function (e) {
            var position = marker.getLatLng();
            document.getElementById('latitude').value = position.lat;
            document.getElementById('longitude').value = position.lng;
        });

        // Update latitude and longitude fields on initial load
        var initialPosition = marker.getLatLng();
        document.getElementById('latitude').value = initialPosition.lat;
        document.getElementById('longitude').value = initialPosition.lng;

        // Allow clicking on the map to move the marker
        map.on('click', function (e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });
    });
</script>
@endsection
