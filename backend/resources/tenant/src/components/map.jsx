import React, { useState } from "react";
import ReactMapGL, { Marker, Popup } from "react-map-gl";

function RestaurantLocator() {
    const [viewport, setViewport] = useState({
        width: "100%",
        height: "400px",
        latitude: 40.7128,
        longitude: -74.006,
        zoom: 15,
    });

    const [userLocation, setUserLocation] = useState(null);

    const getUserLocation = () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const { latitude, longitude } = position.coords;
                setViewport({ ...viewport, latitude, longitude });
                setUserLocation({ latitude, longitude });
            });
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    };

    return (
        <div>
            <div style={{ width: "100%", height: "400px" }}>
                <button onClick={getUserLocation} className="text-black">
                    استخدم موقعي
                </button>
                <ReactMapGL
                    {...viewport}
                    onViewportChange={(newViewport) => setViewport(newViewport)}
                    mapStyle="mapbox://styles/mapbox/streets-v11" // يمكنك استخدام أنماط الخريطة المختلفة من Mapbox
                    mapboxApiAccessToken={
                        "AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E"
                    }
                >
                    {userLocation && (
                        <Marker
                            latitude={userLocation.latitude}
                            longitude={userLocation.longitude}
                        >
                            <Popup>موقعك الحالي</Popup>
                        </Marker>
                    )}
                </ReactMapGL>
            </div>
            <div>{/* هنا يمكنك وضع محتوى داخل الـ div الذي تحت الخريطة */}</div>
        </div>
    );
}

export default RestaurantLocator;
