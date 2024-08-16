@extends('admin.admin_master')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Plots Locations</h4><br><br>

                            <div id="plots-map" style="height: 400px; width: 700px"></div>
                            <DIV id="info"
                                style="position: absolute; color:red; font-family: Arial, Helvetica, sans-serif; height: 200px; font-size: 12px">
                            </DIV>

                            {{-- <script type="text/javascript"
                                src="https://maps.googleapis.com/maps/api/js?key="></script>
                             --}}
                            <script src="{{ asset('geomap.js') }}">
                                // var locations = <?php print_r(json_encode($plots)); ?>;
                                // var map = new google.maps.Map(document.getElementById('plots-map'), {
                                //     zoom: 10,
                                //     center: new google.maps.LatLng(33.6844, 73.0479),
                                //     mapTypeId: google.maps.MapTypeId.ROADMAP
                                // });

                                // var infowindow = new google.maps.InfoWindow();

                                // var marker, i;

                                // for (i = 0; i < locations.length; i++) {
                                //     marker = new google.maps.Marker({
                                //         position: new google.maps.LatLng(locations[i].latitude, locations[i].longitude),
                                //         map: map
                                //     });

                                //     google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                //         return function() {
                                //             infowindow.setContent(locations[i].name);
                                //             infowindow.open(map, marker);
                                //         }
                                //     })(marker, i));
                                // }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
