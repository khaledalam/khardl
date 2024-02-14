import React, {useEffect, useMemo, useRef, useState} from "react"
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
import ClipLoader from "react-spinners/ClipLoader";
import {useTranslation} from "react-i18next";



const Places = ({inputStyle}) => {
  const [libraries, _] = useState(["places"]);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const {t} = useTranslation()

    const {isLoaded} = useLoadScript({
    googleMapsApiKey: "AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E",
      version: "weekly",
      language: Language || "ar",
    libraries,
  });

  if (!isLoaded) {
    return <div className={'m-auto flex items-center'}><ClipLoader color="#36d7b7" /> {t('Loading')}...</div>
  }
  return <Map inputStyle={inputStyle} />
}

const convertToAddress = async (lat, lng) => {

    return await fetch(
        `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyCFkagJ1zc4jW9N3lRNlIyAIJJcNpOwecE`
    )
        .then(async (res) => {

            const geocode = await res.json();

            return geocode?.results[0]?.formatted_address || geocode?.plus_code?.compound_code || `${lat},${lng}`;
        });
}

function Map({inputStyle}) {

    const [forceCenter, setForceCenter] = useState({
        lat: customerAddress?.lat, // || 23.885942,
        lng: customerAddress?.lng  // ||45.079162,
    });
  const restuarantStyle = useSelector((state) => state.restuarantEditorStyle)
  const customerAddress = useSelector((state) => state.customerAPI.address)


  const branches = restuarantStyle.branches
  const filterBranch = branches?.filter(
    (branch) => branch.pickup_availability === 1
  )[0]

    const inputRef = useRef();
    const inputValueRef = useRef();

  const center = useMemo(() => {
      console.log("safasfasdtgdasghdsahgadfghdfshsd")
    if (filterBranch) {
        console.log("hererer filterBranch", );
      return {
        lat: parseFloat(filterBranch.lat),
        lng: parseFloat(filterBranch.lng),
      }
    }
    return {
      lat: customerAddress?.lat, // || 23.885942,
      lng: customerAddress?.lng  // ||45.079162,
    }
  }, [filterBranch, inputRef.current])

  const containerStyle = {
    width: "100%",
    height: "400px",
    borderWidth: 6,
    borderColor: "#E16449",
    padding: 5,
    borderRadius: 6,
  }

  const dispatch = useDispatch();


  const handleMarkerDragEnd = async (event) => {
    const { latLng } = event;
    const lat = latLng.lat();
    const lng = latLng.lng();
      dispatch(updateCustomerAddress({ lat: lat, lng: lng}));
    const addressText = await convertToAddress(lat, lng);

    dispatch(updateCustomerAddress({ lat: lat, lng: lng, addressValue: addressText }))
  };
  const handleMapClick = async (event) => {
    const { latLng } = event;
    const lat = latLng.lat();
    const lng = latLng.lng();

     dispatch(updateCustomerAddress({ lat: lat, lng: lng}));
    const addressText = await convertToAddress(lat, lng);
    console.log("addressText >> ", addressText);
      inputValueRef.current = addressText;
    dispatch(updateCustomerAddress({ lat: lat, lng: lng, addressValue: addressText }));
  };

  console.log("Center:", center)
  return (
    <div className='w-full '>
      <div className='mb-6'>
        <PlacesAutoComplete inputStyle={inputStyle} inputRef={inputRef} inputValueRef={inputValueRef}/>
      </div>

      <div className='w-full h-full'>
        <GoogleMap
          zoom={10}
          center={ customerAddress ? customerAddress : center }
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

function PlacesAutoComplete({inputStyle, inputRef, inputValueRef}) {
    const customerAddress = useSelector((state) => state.customerAPI.address)
    const {
    ready,
    value,
    setValue,
    suggestions: {status, data},
    clearSuggestions,
  } = usePlaceAutoComplete()

  const dispatch = useDispatch()

    useEffect(() => {
        setValue(inputValueRef.current)
    }, [inputValueRef.current])

  const handleSelect = async (address) => {
      setValue(address)

      inputRef.current = address;

    const results = await getGeocode({address: address})
    const {lat, lng} = await getLatLng(results[0])
    dispatch(updateCustomerAddress({lat: lat, lng: lng, addressValue: address}));
      clearSuggestions()
  }

  const getPosition = () => {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(async (position) => {
        let lat = position.coords.latitude
        let lng = position.coords.longitude


          console.log("position >>", position)


          dispatch(updateCustomerAddress({lat: lat, lng: lng}))

          const addressText = await convertToAddress(lat, lng);

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
