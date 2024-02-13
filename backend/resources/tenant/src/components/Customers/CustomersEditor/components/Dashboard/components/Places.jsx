import React, {useEffect, useMemo, useState} from "react"
import {GoogleMap, useLoadScript, MarkerF} from "@react-google-maps/api"
import usePlaceAutoComplete, {
  getGeocode,
  getLatLng,
} from "use-places-autocomplete"
import {
  Combobox,
  ComboboxInput,
  ComboboxPopover,
  ComboboxList,
  ComboboxOption,
} from "@reach/combobox"
import "@reach/combobox/styles.css"
import {useSelector, useDispatch} from "react-redux"
import {
  updateCustomerAddress,
} from "../../../../../../redux/NewEditor/customerSlice"
import {MdLocationPin} from "react-icons/md"

const Places = ({inputStyle}) => {
  const [libraries, _] = useState(["places"])

  const {isLoaded} = useLoadScript({
    googleMapsApiKey: "AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E",
    libraries,
  });

  if (!isLoaded) {
    return <div>Loading....</div>
  }
  return <Map inputStyle={inputStyle} />
}

const convertToAddress = (lat, lng) => {

    // @TODO: remove this static response
    const geocode = JSON.parse(`
    {
   "plus_code" :
   {
      "compound_code" : "HQ65+C97 As Sufayri Saudi Arabia",
      "global_code" : "7HW7HQ65+C97"
   },
   "results" :
   [
      {
         "address_components" :
         [
            {
               "long_name" : "HQ65+C9",
               "short_name" : "HQ65+C9",
               "types" :
               [
                  "plus_code"
               ]
            },
            {
               "long_name" : "As Sufayri",
               "short_name" : "As Sufayri",
               "types" :
               [
                  "locality",
                  "political"
               ]
            },
            {
               "long_name" : "Hafar Al-Batin",
               "short_name" : "Hafar Al-Batin",
               "types" :
               [
                  "administrative_area_level_2",
                  "political"
               ]
            },
            {
               "long_name" : "Eastern Province",
               "short_name" : "Eastern Province",
               "types" :
               [
                  "administrative_area_level_1",
                  "political"
               ]
            },
            {
               "long_name" : "Saudi Arabia",
               "short_name" : "SA",
               "types" :
               [
                  "country",
                  "political"
               ]
            }
         ],
         "formatted_address" : "HQ65+C9 As Sufayri Saudi Arabia",
         "geometry" :
         {
            "bounds" :
            {
               "northeast" :
               {
                  "lat" : 28.561125,
                  "lng" : 45.7585
               },
               "southwest" :
               {
                  "lat" : 28.561,
                  "lng" : 45.758375
               }
            },
            "location" :
            {
               "lat" : 28.5610264,
               "lng" : 45.7584326
            },
            "location_type" : "GEOMETRIC_CENTER",
            "viewport" :
            {
               "northeast" :
               {
                  "lat" : 28.5624114802915,
                  "lng" : 45.7597864802915
               },
               "southwest" :
               {
                  "lat" : 28.5597135197085,
                  "lng" : 45.7570885197085
               }
            }
         },
         "place_id" : "GhIJTzEYbZ-PPEARMZzGURThRkA",
         "plus_code" :
         {
            "compound_code" : "HQ65+C9 As Sufayri Saudi Arabia",
            "global_code" : "7HW7HQ65+C9"
         },
         "types" :
         [
            "plus_code"
         ]
      },
      {
         "address_components" :
         [
            {
               "long_name" : "39977",
               "short_name" : "39977",
               "types" :
               [
                  "postal_code"
               ]
            },
            {
               "long_name" : "Hafar Al-Batin",
               "short_name" : "Hafar Al-Batin",
               "types" :
               [
                  "administrative_area_level_2",
                  "political"
               ]
            },
            {
               "long_name" : "Eastern Province",
               "short_name" : "Eastern Province",
               "types" :
               [
                  "administrative_area_level_1",
                  "political"
               ]
            },
            {
               "long_name" : "Saudi Arabia",
               "short_name" : "SA",
               "types" :
               [
                  "country",
                  "political"
               ]
            }
         ],
         "formatted_address" : "39977, Saudi Arabia",
         "geometry" :
         {
            "bounds" :
            {
               "northeast" :
               {
                  "lat" : 28.5703277,
                  "lng" : 45.7962623
               },
               "southwest" :
               {
                  "lat" : 28.531279,
                  "lng" : 45.71768060000001
               }
            },
            "location" :
            {
               "lat" : 28.550604,
               "lng" : 45.7568372
            },
            "location_type" : "APPROXIMATE",
            "viewport" :
            {
               "northeast" :
               {
                  "lat" : 28.5703277,
                  "lng" : 45.7962623
               },
               "southwest" :
               {
                  "lat" : 28.531279,
                  "lng" : 45.71768060000001
               }
            }
         },
         "place_id" : "ChIJp5gAVVFj1z8Rl5I1ZhWMmIc",
         "types" :
         [
            "postal_code"
         ]
      },
      {
         "address_components" :
         [
            {
               "long_name" : "Hafar Al-Batin",
               "short_name" : "Hafar Al-Batin",
               "types" :
               [
                  "administrative_area_level_2",
                  "political"
               ]
            },
            {
               "long_name" : "Eastern Province",
               "short_name" : "Eastern Province",
               "types" :
               [
                  "administrative_area_level_1",
                  "political"
               ]
            },
            {
               "long_name" : "Saudi Arabia",
               "short_name" : "SA",
               "types" :
               [
                  "country",
                  "political"
               ]
            }
         ],
         "formatted_address" : "Hafar Al-Batin Saudi Arabia",
         "geometry" :
         {
            "bounds" :
            {
               "northeast" :
               {
                  "lat" : 29.1414045,
                  "lng" : 47.7415143
               },
               "southwest" :
               {
                  "lat" : 26.6877787,
                  "lng" : 44.6706643
               }
            },
            "location" :
            {
               "lat" : 28.0247901,
               "lng" : 46.516262
            },
            "location_type" : "APPROXIMATE",
            "viewport" :
            {
               "northeast" :
               {
                  "lat" : 29.1414045,
                  "lng" : 47.7415143
               },
               "southwest" :
               {
                  "lat" : 26.6877787,
                  "lng" : 44.6706643
               }
            }
         },
         "place_id" : "ChIJ-VxUk9jS1j8RUATt94Tc2bA",
         "types" :
         [
            "administrative_area_level_2",
            "political"
         ]
      },
      {
         "address_components" :
         [
            {
               "long_name" : "Eastern Province",
               "short_name" : "Eastern Province",
               "types" :
               [
                  "administrative_area_level_1",
                  "political"
               ]
            },
            {
               "long_name" : "Saudi Arabia",
               "short_name" : "SA",
               "types" :
               [
                  "country",
                  "political"
               ]
            }
         ],
         "formatted_address" : "Eastern Province Saudi Arabia",
         "geometry" :
         {
            "bounds" :
            {
               "northeast" :
               {
                  "lat" : 29.1413857,
                  "lng" : 55.6666666
               },
               "southwest" :
               {
                  "lat" : 19.0004137,
                  "lng" : 44.6706643
               }
            },
            "location" :
            {
               "lat" : 23.5681347,
               "lng" : 50.6793759
            },
            "location_type" : "APPROXIMATE",
            "viewport" :
            {
               "northeast" :
               {
                  "lat" : 29.1413857,
                  "lng" : 55.6666666
               },
               "southwest" :
               {
                  "lat" : 19.0004137,
                  "lng" : 44.6706643
               }
            }
         },
         "place_id" : "ChIJhYY947MZQD4Rpli7AuRzsW0",
         "types" :
         [
            "administrative_area_level_1",
            "political"
         ]
      },
      {
         "address_components" :
         [
            {
               "long_name" : "Saudi Arabia",
               "short_name" : "SA",
               "types" :
               [
                  "country",
                  "political"
               ]
            }
         ],
         "formatted_address" : "Saudi Arabia",
         "geometry" :
         {
            "bounds" :
            {
               "northeast" :
               {
                  "lat" : 32.154284,
                  "lng" : 55.6666666
               },
               "southwest" :
               {
                  "lat" : 16.29,
                  "lng" : 34.4815001
               }
            },
            "location" :
            {
               "lat" : 23.885942,
               "lng" : 45.079162
            },
            "location_type" : "APPROXIMATE",
            "viewport" :
            {
               "northeast" :
               {
                  "lat" : 32.154284,
                  "lng" : 55.6666666
               },
               "southwest" :
               {
                  "lat" : 16.29,
                  "lng" : 34.4815001
               }
            }
         },
         "place_id" : "ChIJQSqV5z-z5xURm7YawktQYFk",
         "types" :
         [
            "country",
            "political"
         ]
      }
   ],
   "status" : "OK"
}
    `);

    return geocode?.results[0] || geocode?.plus_code?.compound_code || `${lat},${lng}`;

    fetch(
        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyCFkagJ1zc4jW9N3lRNlIyAIJJcNpOwecE`
    )
        .then((res) => res.json())
        .then((address) => console.log("addressDetected: ", address))
}

function Map({inputStyle}) {
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)
  const customerAddress = useSelector((state) => state.customerAPI.address)
  const branches = restuarantStyle.branches
  const filterBranch = branches?.filter(
    (branch) => branch.pickup_availability === 1
  )[0]


    console.log("#@!%#%#2 ", customerAddress);

  const center = useMemo(() => {
    if (filterBranch) {
        console.log("hererer filterBranch", );
      return {
        lat: parseInt(filterBranch.lat),
        lng: parseInt(filterBranch.lng),
      }
    }
    return {
      lat: customerAddress?.lat, // || 23.885942,
      lng: customerAddress?.lng  // ||45.079162,
    }
  }, [filterBranch])

  const containerStyle = {
    width: "100%",
    height: "400px",
    borderWidth: 6,
    borderColor: "#E16449",
    padding: 5,
    borderRadius: 6,
  }


  const dispatch = useDispatch();

  const handleMarkerDragEnd = (event) => {
    const { latLng } = event;
    const lat = latLng.lat();
    const lng = latLng.lng();
      const addressText = convertToAddress(lat, lng);

      console.log("response from convertToAddress in handleMapClick", addressText);

      dispatch(updateCustomerAddress({ lat: lat, lng: lng, addressValue: addressText }))
  };
  const handleMapClick = (event) => {
    const { latLng } = event;
    const lat = latLng.lat();
    const lng = latLng.lng();
      const addressText = convertToAddress(lat, lng);

      console.log("response from convertToAddress in handleMapClick", addressText);

    dispatch(updateCustomerAddress({ lat: lat, lng: lng, addressValue: addressText }));
  };

  return (
    <div className='w-full '>
      <div className='mb-6'>
        <PlacesAutoComplete inputStyle={inputStyle} />
      </div>

      <div className='w-full h-full'>
        <GoogleMap
          zoom={10}
          center={customerAddress ? customerAddress : center}
          mapContainerStyle={containerStyle}
          options={{ draggableCursor: 'pointer' }}
          onClick={handleMapClick}
        >
          <MarkerF position={customerAddress ? customerAddress : center} draggable={true} onDragEnd={handleMarkerDragEnd} />
        </GoogleMap>
      </div>
    </div>
  )
}

function PlacesAutoComplete({inputStyle}) {
  const {
    ready,
    value,
    setValue,
    suggestions: {status, data},
    clearSuggestions,
  } = usePlaceAutoComplete()
  const customerAddress = useSelector((state) => state.customerAPI.address)

  const dispatch = useDispatch()

  const handleSelect = async (address) => {
    setValue(address)
    clearSuggestions()
    const results = await getGeocode({address: address})
    const {lat, lng} = await getLatLng(results[0])
    dispatch(updateCustomerAddress({lat: lat, lng: lng, addressValue: address}))
  }

  const getPosition = () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        let lat = position.coords.latitude
        let lng = position.coords.longitude

        console.log("geolocation", position)

          const addressText = convertToAddress(lat, lng);

        console.log("DEBUG: address ", addressText);

        dispatch(updateCustomerAddress({lat: lat, lng: lng, addressValue: addressText}))

      }, positionError)
    } else {
      window.alert("Sorry,Geolocation is not supported by your browser")
    }
  }

  const positionError = () => {
    if (navigator.permissions) {
      navigator.permissions.query({name: "geolocation"}).then((res) => {
        if (res.state === "denied") {
          window.alert(
            "Enable location permissions for this website in your browser settings"
          )
        } else {
          alert(
            "Unable to access your location, you can continue by typing your location on the map"
          )
        }
      })
    }
  }

  return (
    <Combobox onSelect={handleSelect}>
      <div className='flex items-center gap-8'>
        <ComboboxInput
          type='text'
          name='location'
          id={"location"}
          value={value}
          onChange={(e) => setValue(e.target.value)}
          disabled={!ready}
          className={inputStyle}
          placeholder={customerAddress?.addressValue}
        />
        <div
          onClick={getPosition}
          className='w-10 h-10 flex items-center justify-center rounded-lg p-1 border border-[var(--customer)] cursor-pointer'
        >
          <MdLocationPin size={28} color={"red"} />
        </div>
      </div>

      <ComboboxPopover>
        <ComboboxList>
          {status === "OK" &&
            data.map(({place_id, description}) => (
              <ComboboxOption key={place_id} value={description} />
            ))}
        </ComboboxList>
      </ComboboxPopover>
    </Combobox>
  )
}
export default Places
