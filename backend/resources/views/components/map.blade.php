<script>


        let maps = {}; // Store maps in an object
        let markers = {}; // Store markers in an object
        let infoWindow;
        async function initializeMapOnClick(branchId, lat, lng) {

            const [{ Map }, { AdvancedMarkerElement }] = await Promise.all([
                google.maps.importLibrary("marker"),
                google.maps.importLibrary("places"),
            ]);
            const latLng = new google.maps.LatLng(lat, lng);

            const map = new google.maps.Map(document.getElementById('map' + branchId), {
                center: latLng,
                zoom: 8,
                mapId: "{{env('GOOGLE_MAP_ID')}}",
                mapTypeControl: false,
            });
            infoWindow = new google.maps.InfoWindow({});
            // const input = document.getElementById("pac-input" + branchId);

            const options = {
                fields: ["formatted_address", "geometry", "name"],
                strictBounds: false,
            };

            const autocomplete = new google.maps.places.PlaceAutocompleteElement();


            const card = document.getElementById('map-autocomplete-card' + branchId);
            card.appendChild(autocomplete);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);


            const marker = new google.maps.marker.AdvancedMarkerElement({
                position: latLng,
                map: map,
                gmpDraggable: true,
            });



            markers[branchId] = marker; // Store the marker for this branch
            maps[branchId] = map; // Store the map for this branch

            map.addListener( 'bounds_changed', function (event) {
                console.log('bounds_changed', event);

                // marker.position  = event.latLng;
                // updateLocationInput(marker.position, branchId);
            });

            // Add a click event listener to the map
            map.addListener( 'click', function (event) {
                marker.position  = event.latLng;
 
                updateLocationInput(event.latLng, branchId);
            });

            autocomplete.addEventListener("gmp-placeselect", async ({ place }) => {
                await place.fetchFields({ fields: ['displayName', 'formattedAddress', 'location'] });
                if (place.location.viewport) {
                    map.fitBounds(place.location.viewport);
                } else {
                    map.setCenter(place.location);
                    map.setZoom(17);
                }
                // marker.setVisible(false);



                // if (!place.geometry || !place.geometry.location) {
                //     // User entered the name of a Place that was not suggested and
                //     // pressed the Enter key, or the Place Details request failed.
                //     window.alert("No details available for input: '" + place.name + "'");
                //     return;
                // }
                const lat = place.location.lat();
                const lng = place.location.lng();
              
                selectedPlacePosition = new google.maps.LatLng(lat, lng);
         
                updateLocationInput(selectedPlacePosition, branchId);
                // If the place has a geometry, then present it on a map.
                if (place.location.viewport) {
                    map.fitBounds(place.location.viewport);
                } else {
                    map.setCenter(place.location);
                    map.setZoom(17);
                }
                let content =
                '<div id="infowindow-content">' +
                '<span id="place-displayname" class="title">' +
                place.displayName +
                "</span><br />" +
                '<span id="place-address">' +
                place.formattedAddress +
                "</span>" +
                "</div>";
                updateInfoWindow(content, place.location,marker,map);
                marker.position =place.location;
                // marker.setVisible(true);
                // infowindow.open(map, marker);
            });



        }

        const mapContainers = document.querySelectorAll('.map-container');
        mapContainers.forEach(container => {
            container.addEventListener('click', function handleClick() {
                const branchIdElement = this.getAttribute('data-branch-id');
                // console.log('Branch ID:', branchIdElement);
                if (branchIdElement) {
                    const latElement = document.getElementById('lat' + branchIdElement);
                    const lngElement = document.getElementById('lng' + branchIdElement);
                    // console.log('Latitude element:', latElement);
                    // console.log('Longitude element:', lngElement);
                    if (latElement && lngElement) {
                        const lat = parseFloat(latElement.value);
                        const lng = parseFloat(lngElement.value);
                      
                        initializeMapOnClick(branchIdElement, lat, lng);
                        document.getElementById('save-location' + branchIdElement).style.display = 'block';
                        // document.getElementById('pac-input' + branchIdElement).style.display = 'block';
                        container.removeEventListener('click', handleClick);
                    }
                }
            });
        });




        function updateInfoWindow(content, center,marker,map) {
            infoWindow.setContent(content);
            infoWindow.setPosition(center);
            infoWindow.open({
                map,
                anchor: marker,
                shouldFocus: false,
            });
        }

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
            console.log(locationInput,addressFromLatLng);
            if (locationInput) {
                locationInput.value = addressFromLatLng;
            }

            // const addressInput = document.getElementById('pac-input' + branchId);
            // if (addressInput) {
            //     locationInput.value = addressFromLatLng;
            // }


        }
        


</script>
