
function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("google_map"), {
        center: { lat: -27.4975, lng: 153.0137 },
        zoom: 17,
        mapTypeId: "roadmap",
    });
    // Create the search box and link it to the UI element.
    const input = document.getElementById("eventLocation");
    const searchBox = new google.maps.places.SearchBox(input);

    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    // Bias the SearchBox results towards current map's viewport.
    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();
        var address = '';
        if (places.length != 0) {
            address = [
                (places[0].address_components[0] && places[0].address_components[0].short_name || ''),
                (places[0].address_components[1] && places[0].address_components[1].short_name || ''),
                (places[0].address_components[2] && places[0].address_components[2].short_name || ''),
                (places[0].address_components[3] && places[0].address_components[3].short_name || ''),
                (places[0].address_components[4] && places[0].address_components[4].short_name || '')
            ].join(', ');
            // alert('success');
        }
        console.log(places[0].geometry.location.lng());
        console.log(address);
        $('#choosen_location').html('');
        $('#choosen_location').append(address);
        $('#eventLocation').val(address);
        $('#choosen_address').val(address);
        $('#location-lat').val(places[0].geometry.location.lat());
        $('#location-lng').val(places[0].geometry.location.lng());
        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        const bounds = new google.maps.LatLngBounds();

        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            const icon = {
                url: place.icon,
                size: new google.maps.Size(100, 100),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            // Create a marker for each place.
            markers.push(
                new google.maps.Marker({
                    map,
                    icon,
                    title: place.name,
                    position: place.geometry.location,
                })
            );
            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}