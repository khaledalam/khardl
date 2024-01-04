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

const Places = () => {
  const [libraries, _] = useState(["places"])
  const {isLoaded} = useLoadScript({
    googleMapsApiKey: "AIzaSyB4IfCMfgHzQaHLHy59vALydLhvtjr0Om0",
    libraries,
  })

  if (!isLoaded) {
    return <div>Loading....</div>
  }
  return <Map />
}

function Map() {
  const center = useMemo(() => ({lat: 43.45, lng: -80.49}), [])
  const [selected, setSelected] = useState(null)

  const containerStyle = {
    width: "100",
    height: "500px",
  }

  console.log("selected", selected)

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
    setSelected({lat, lng})
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
