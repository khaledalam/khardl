<script>

    document.addEventListener("DOMContentLoaded", (event) => {
        let maps = {}; // Store maps in an object
        let markers = {}; // Store markers in an object

        function initializeMapOnClick(branchId, lat, lng) {
            const latLng = new google.maps.LatLng(lat, lng);

            const map = new google.maps.Map(document.getElementById('map' + branchId), {
                center: latLng,
                zoom: 8,
            });

            const input = document.getElementById("pac-input" + branchId);

            const options = {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
            };
            const autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.bindTo("bounds", map);

            const marker = new google.maps.Marker({
    position: latLng,
    map: map,
    draggable: true,
});



            markers[branchId] = marker; // Store the marker for this branch
            maps[branchId] = map; // Store the map for this branch

            google.maps.event.addListener(marker, 'dragend', function () {
                updateLocationInput(marker.getPosition(), branchId);
            });

            // Add a click event listener to the map
            google.maps.event.addListener(map, 'click', function (event) {
                marker.setPosition(event.latLng);
                updateLocationInput(event.latLng, branchId);
            });

            autocomplete.addListener("place_changed", () => {
                marker.setVisible(false);

                const place = autocomplete.getPlace();

                if (!place.geometry || !place.geometry.location) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }
                const lat = place.geometry.location.lat();
                const lng = place.geometry.location.lng();
                selectedPlacePosition = new google.maps.LatLng(lat, lng);
                updateLocationInput(selectedPlacePosition, branchId);
                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                // infowindow.open(map, marker);
            });
        }

        const mapContainers = document.querySelectorAll('.map-container');
        mapContainers.forEach(container => {
            container.addEventListener('click', function handleClick() {
                console.log('Container clicked');
                const branchIdElement = this.getAttribute('data-branch-id');
                console.log('Branch ID:', branchIdElement);
                if (branchIdElement) {
                    const latElement = document.getElementById('lat' + branchIdElement);
                    const lngElement = document.getElementById('lng' + branchIdElement);
                    console.log('Latitude element:', latElement);
                    console.log('Longitude element:', lngElement);
                    if (latElement && lngElement) {
                        const lat = parseFloat(latElement.value);
                        const lng = parseFloat(lngElement.value);
                        console.log('Latitude:', lat);
                        console.log('Longitude:', lng);
                        initializeMapOnClick(branchIdElement, lat, lng);
                        document.getElementById('save-location' + branchIdElement).style.display = 'block';
                        document.getElementById('pac-input' + branchIdElement).style.display = 'block';
                        container.removeEventListener('click', handleClick);
                    } else {
                        console.log('Latitude or longitude element not found');
                    }
                } else {
                    console.log('Branch ID attribute not found');
                }
            });
        });






        async function convertToAddress(lat, lng) {

            return await fetch(
                `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyCFkagJ1zc4jW9N3lRNlIyAIJJcNpOwecE`
            )
                .then(async (res) => {
                    const geocode = await res.json();
                    return geocode?.results[0]?.formatted_address || geocode?.plus_code?.compound_code || `${lat},${lng}`;
                });
        }

        async function updateLocationInput(latLng, branchId) {

            const latInput = document.getElementById('lat' + branchId);
            const lngInput = document.getElementById('lng' + branchId);
            latInput.value = latLng.lat();
            lngInput.value = latLng.lng();

            const addressFromLatLng = await convertToAddress(latLng.lat(), latLng.lng());

            const locationInput = document.getElementById('location' + branchId);

            if (locationInput) {
                locationInput.value = addressFromLatLng;
            }

            const locationInputBranch = document.getElementById('pac-input' + branchId);


            if (locationInputBranch) {
                locationInputBranch.value = addressFromLatLng;
            }
        }


        if (document.getElementById('pac-input-new_branch')) {

            // New branch popup
            const centerCoords = {
                lat: 24.7136,
                lng: 46.6753,
                address: '8779 Street Number 74, Al Olaya, 2593, Riyadh 12214, Saudi Arabia'
            }; // Default center coordinates
            initializeMapOnClick('-new_branch', centerCoords?.lat, centerCoords?.lng);

            document.getElementById('lat-new_branch').value = centerCoords.lat;
            document.getElementById('lng-new_branch').value = centerCoords.lat;
            document.getElementById('pac-input-new_branch').value = centerCoords.address;


            google.maps.event.addListener(maps['-new_branch'], 'click', function (event) {

                // If a marker exists, remove it
                if (markers['-new_branch']) {
                    markers['-new_branch'].setMap(null);
                }

                // Create a new marker at the clicked location
                markers['-new_branch'] = new google.maps.Marker({
                    map: maps['-new_branch'],
                    position: event.latLng,
                    draggable: true,
                });

                // document.getElementById('pac-input-new_branch').value = markers['-new_branch'].position.lat() + ' ' + markers['-new_branch'].position.lng();

                const latnew_branch = document.getElementById('lat-new_branch');
                const lngnew_branch = document.getElementById('lng-new_branch');

                // Update the hidden input with the clicked location's latitude and longitude
                latnew_branch.value = `${event.latLng.lat()}`;
                lngnew_branch.value = `${event.latLng.lng()}`;
            });
        }
    });
</script>
