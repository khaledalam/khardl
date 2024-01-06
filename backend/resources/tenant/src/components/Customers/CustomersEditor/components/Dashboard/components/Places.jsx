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
  }

  console.log("filterBranch", filterBranch)

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
        >
          <MarkerF position={selectedLatLng ? selectedLatLng : center} />
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

  return (
    <Combobox onSelect={handleSelect}>
      <ComboboxInput
        value={value}
        defaultValue={customerAddress}
        onChange={(e) => setValue(e.target.value)}
        disabled={!ready}
        className={inputStyle}
        placeholder='Search an address...'
      />

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
