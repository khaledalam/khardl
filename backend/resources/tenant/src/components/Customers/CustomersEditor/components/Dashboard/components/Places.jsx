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
  updateLatLng,
} from "../../../../../../redux/NewEditor/customerSlice"
import {MdLocationPin} from "react-icons/md"

const Places = ({inputStyle}) => {
  const [libraries, _] = useState(["places"])

  const {isLoaded} = useLoadScript({
    googleMapsApiKey: "AIzaSyB4IfCMfgHzQaHLHy59vALydLhvtjr0Om0",
    libraries,
  })

  if (!isLoaded) {
    return <div>Loading....</div>
  }
  return <Map inputStyle={inputStyle} />
}

function Map({inputStyle}) {
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)
  const selectedLatLng = useSelector((state) => state.customerAPI.addressLatLng)
  const branches = restuarantStyle.branches
  const filterBranch = branches?.filter(
    (branch) => branch.pickup_availability === 1
  )[0]

  const center = useMemo(() => {
    if (filterBranch) {
      return {
        lat: parseInt(filterBranch.lat),
        lng: parseInt(filterBranch.lng),
      }
    }
    return {
      lat: 23.885942,
      lng: 45.079162,
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
    dispatch(updateLatLng({ lat, lng }))
  };
  const handleMapClick = (event) => {
    const { latLng } = event;
    const lat = latLng.lat();
    const lng = latLng.lng();
    dispatch(updateLatLng({ lat, lng }));
  };

  return (
    <div className='w-full '>
      <div className='mb-6'>
        <PlacesAutoComplete inputStyle={inputStyle} />
      </div>

      <div className='w-full h-full'>
        <GoogleMap
          zoom={10}
          center={selectedLatLng ? selectedLatLng : center}
          mapContainerStyle={containerStyle}
          options={{ draggableCursor: 'pointer' }}          
          onClick={handleMapClick}
        >
          <MarkerF position={selectedLatLng ? selectedLatLng : center} draggable={true} onDragEnd={handleMarkerDragEnd} />
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
    dispatch(updateCustomerAddress(address))
    const results = await getGeocode({address: address})
    const {lat, lng} = await getLatLng(results[0])
    dispatch(updateLatLng({lat, lng}))
  }

  const getPosition = () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition((position) => {
        let lat = position.coords.latitude
        let lng = position.coords.longitude

        console.log("geolocation", position)

        dispatch(updateLatLng({lat, lng}))

        convertToAddress(lat, lng)
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

  const convertToAddress = (lat, lng) => {
    fetch(
      `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyB4IfCMfgHzQaHLHy59vALydLhvtjr0Om0`
    )
      .then((res) => res.json())
      .then((address) => console.log("addressDetected: " + address))
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
          placeholder={customerAddress}
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
