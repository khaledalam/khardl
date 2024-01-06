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

const Places = ({selected, setSelected}) => {
  const [libraries, _] = useState(["places"])

  const {isLoaded} = useLoadScript({
    googleMapsApiKey: "AIzaSyB4IfCMfgHzQaHLHy59vALydLhvtjr0Om0",
    libraries,
  })

  if (!isLoaded) {
    return <div>Loading....</div>
  }
  console.log("selected", selected)
  return <Map selected={selected} setSelected={setSelected} />
}

function Map({selected, setSelected}) {
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)
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
    width: "100",
    height: "500px",
  }

  console.log("filterBranch", filterBranch)

  return (
    <div className='w-full '>
      <div className='mb-6'>
        <PlacesAutoComplete setSelected={setSelected} />
      </div>

      <div className='w-full h-[500px]'>
        <GoogleMap
          zoom={10}
          center={selected ? selected : center}
          mapContainerStyle={containerStyle}
        >
          <MarkerF position={selected ? selected : center} />
        </GoogleMap>
      </div>
    </div>
  )
}

function PlacesAutoComplete({setSelected}) {
  const {
    ready,
    value,
    setValue,
    suggestions: {status, data},
    clearSuggestions,
  } = usePlaceAutoComplete()

  const handleSelect = async (address) => {
    setValue(address)
    clearSuggestions()

    const results = await getGeocode({address: address})
    const {lat, lng} = await getLatLng(results[0])
    setSelected({lat, lng, address})
  }

  return (
    <Combobox onSelect={handleSelect}>
      <ComboboxInput
        value={value}
        onChange={(e) => setValue(e.target.value)}
        disabled={!ready}
        className='w-full text-[14px] bg-[var(--secondary)]  py-3 rounded-full px-4 appearance-none'
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
