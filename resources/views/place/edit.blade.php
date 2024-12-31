@extends('layout')
@section('main')
<div class="container">
    <h1>Edit Place</h1>
    <form action="{{ route('admin.places.update', $place->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <!-- Error Messages -->
        @if (Session::has('success'))
        <div class="alert alert-success" style="background:#28272f; color: white;">{{ Session::get('success') }}</div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif

        <!-- Place Details -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $place->name) }}">
        </div>
        <div class="mb-3">
            <label for="map_disc" class="form-label">Map Description</label>
            <textarea name="map_disc" class="form-control" value="{{ old('map_disc', $place->map_disc) }}"></textarea>
        </div>
        <div class="mb-3">
            <label for="open_at" class="form-label">Opening Time</label>
            <input type="time" name="open_at" class="form-control" value="{{ old('open_at', $place->open_at) }}">
        </div>
        <div class="mb-3">
            <label for="close_at" class="form-label">Closing Time</label>
            <input type="time" name="close_at" class="form-control" value="{{ old('close_at', $place->close_at) }}">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" value="{{ old('category_id', $place->category->name) }}">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
            </select>
        </div>

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
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $place->latitude) }}">
            <input type="hidden" name="longitude" id="longitude"  value="{{  old('longitude', $place->longitude) }}">
        </div>

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
        // Initialize the map
        var map = L.map('map').setView([30.0444, 31.2357], 10); // Default to Cairo
        
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
