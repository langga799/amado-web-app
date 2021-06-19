@extends('_layouts.app')

@section('title', 'Data Pasien')

@section('content')

	@if (session()->has('success'))
		<div class="alert alert-success alert-dismissible">
		  <span>{{ session('success' )}}</span>
		  <button class="close" data-dismiss="alert">&times;</button>
		</div>
	@endif

	<div id="alert"></div>

	<div class="card shadow">
		<div class="card-header py-2 d-flex justify-content-between align-items-center">
			<h2 class="h6 m-0 font-weight-bold text-primary">Lokasi Pasien</h2>
		</div>
		<div class="card-body">
            <div class="container">
                <div id="map" style="width:auto;height:600px;"></div>
            </div>
		</div>
	</div>

    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>

    <script type="text/javascript">

        //Begin geocoding
        // const lat = '-8.23648';
        // const long = '114.35851';

        let lokasi = @json($lokasi);
        // console.log(lokasi);

        function addMarkerToGroup(group, coordinate, html) {
            let marker = new H.map.Marker(coordinate);
            // add custom data to the marker
            marker.setData(html);
            group.addObject(marker);
        }

        function addInfoBubble(map, latitude, longitude, nama, alamat) {
            let group = new H.map.Group();

            map.addObject(group);

            // add 'tap' event listener, that opens info bubble, to the group
            group.addEventListener('tap', function (evt) {
                // event target is the marker itself, group is a parent event target
                // for all objects that it contains
                let bubble = new H.ui.InfoBubble(evt.target.getGeometry(), {
                // read custom data
                content: evt.target.getData()
                });
                // show info bubble
                ui.addBubble(bubble);
            }, false);

            addMarkerToGroup(group, {lat: latitude, lng: longitude},
                '<div>'+ nama +'</div> <hr>' +
                '<div>'+ alamat +'</div>');
        }

        const platform = new H.service.Platform({ apikey: 'xwNRXhJjal0isNdGq1d3i8_OkbS3VA4z5UsGlpp3AwI' });

        const defaultLayers = platform.createDefaultLayers();

        const map = new H.Map(document.getElementById('map'),
            defaultLayers.vector.normal.map, {
            center: { lat: '-7.705053', lng: '113.995279' },
            zoom: 8,
            pixelRatio: window.devicePixelRatio || 1
        });

        window.addEventListener('resize', () => map.getViewPort().resize());

        const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));

        const ui = H.ui.UI.createDefault(map, defaultLayers);

        // lokasi.forEach(element => {
        //     const service = platform.getSearchService();
        //     // console.log(element);
        //     service.reverseGeocode({ at: element['latitude']+','+element['longitude']}, (result) => {
        //     result.items.forEach((item) => {
        //         map.addObject(new H.map.Marker(item.position));
        //     });
        //     }, alert);
        // });

        lokasi.forEach(element => {
            addInfoBubble(map,element['latitude'],element['longitude'],element['nama'],element['alamat']);
        });

    </script>
@endsection

{{-- @push('js')

@endpush --}}

@push('css')
	<link rel="stylesheet" href="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
@endpush

{{-- @push('js')
	<script src="{{ asset('sbadmin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('sbadmin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

	<script>
		const ajaxUrl = '{{ route('patient.datatables') }}'
		const deleteUrl = '{{ route('patient.destroy', ':id') }}'
	</script>

	<script src="{{ asset('js/patient.js') }}"></script>
@endpush --}}
