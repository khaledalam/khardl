import React, { useEffect, useMemo, useRef, useState } from "react";
import {
    GoogleMap,
    useLoadScript,
    MarkerF,
    useJsApiLoader,
} from "@react-google-maps/api";
import usePlaceAutoComplete, {
    getGeocode,
    getLatLng,
} from "use-places-autocomplete";
import {
    Combobox,
    ComboboxInput,
    ComboboxPopover,
    ComboboxList,
    ComboboxOption,
} from "@reach/combobox";
import "@reach/combobox/styles.css";
import { useSelector, useDispatch } from "react-redux";
import { updateCustomerAddress } from "../../../../../../redux/NewEditor/customerSlice";
import { MdLocationPin } from "react-icons/md";
import ClipLoader from "react-spinners/ClipLoader";
import { useTranslation } from "react-i18next";
import ConfirmationModal from "../../../../../confirmationModal";
import AxiosInstance from "../../../../../../axios/axios";
import { toast } from "react-toastify";

const Places = ({ inputStyle, isCart, user }) => {
    const [libraries, _] = useState(["places"]);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const { t } = useTranslation();

    const { isLoaded } = useJsApiLoader({
        googleMapsApiKey: "AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E",
        version: "weekly",
        language: "en",
        libraries,
    });

    if (!isLoaded) {
        return (
            <div className={"m-auto flex items-center"}>
                <ClipLoader color="#36d7b7" /> {t("Loading")}...
            </div>
        );
    }
    return <Map isCart={isCart} user={user} inputStyle={inputStyle} />;
};

const convertToAddress = async (lat, lng) => {

    try {
        return await AxiosInstance.post(`/latlng-to-address`, {
            lat: lat,
            lng: lng,
        })
            .then((r) => {
                console.log("convert: ", r);
                return r;
            });
    } catch (error) {
        toast.error(error.response.data.message);
    }
};

function Map({ inputStyle, isCart, user }) {
    const restuarantStyle = useSelector((state) => state.restuarantEditorStyle);
    const customerAddress = useSelector((state) => state.customerAPI.address);
    const [isAddressChanged, setIsAddressChanged] = useState(false);
    const { t } = useTranslation();

    const branches = restuarantStyle.branches;
    const filterBranch = branches?.filter(
        (branch) => branch.pickup_availability === 1,
    )[0];

    const inputRef = useRef();
    const inputValueRef = useRef();

    const center = useMemo(() => {
        if (filterBranch) {
            return {
                lat: parseFloat(filterBranch.lat),
                lng: parseFloat(filterBranch.lng),
            };
        }
        return {
            lat: customerAddress?.lat, // || 23.885942,
            lng: customerAddress?.lng, // ||45.079162,
        };
    }, [filterBranch, inputRef.current]);

    const containerStyle = {
        width: "100%",
        height: "400px",
        padding: 5,
    };

    const dispatch = useDispatch();

    const handleMarkerDragEnd = async (event) => {
        const { latLng } = event;
        const lat = latLng.lat();
        const lng = latLng.lng();
        dispatch(updateCustomerAddress({ lat: lat, lng: lng }));
        const addressText = await convertToAddress(lat, lng);

        dispatch(
            updateCustomerAddress({
                lat: lat,
                lng: lng,
                addressValue: addressText,
            }),
        );
        setIsAddressChanged(true);
    };
    const handleMapClick = async (event) => {
        const { latLng } = event;
        const lat = latLng.lat();
        const lng = latLng.lng();

        dispatch(updateCustomerAddress({ lat: lat, lng: lng }));
        const addressText = await convertToAddress(lat, lng);
        console.log("addressText >> ", addressText);
        inputValueRef.current = addressText;
        dispatch(
            updateCustomerAddress({
                lat: lat,
                lng: lng,
                addressValue: addressText,
            }),
        );
    };

    const handleSetDefaultAddress = async () => {
        try {
            await AxiosInstance.post(`/user`, {
                first_name: user.firstName,
                last_name: user.lastName,
                phone: user.phone,
                address: customerAddress?.addressValue,
                lat: customerAddress?.lat,
                lng: customerAddress?.lng,
            })
                .then((r) => {
                    toast.success(t("Address updated successfully"));
                })
                .finally((r) => {
                    // setLoading(false);
                });
        } catch (error) {
            toast.error(error.response.data.message);
        }
    };

    return (
        <div className="w-full ">
            <div className="mb-6">
                <PlacesAutoComplete
                    inputStyle={inputStyle}
                    inputRef={inputRef}
                    inputValueRef={inputValueRef}
                    isCart={isCart}
                    saveLocation={handleSetDefaultAddress}
                    AddressChanged={isAddressChanged}
                />
            </div>

            <div className="w-full h-full">
                <GoogleMap
                    zoom={10}
                    center={
                        customerAddress
                            ? {
                                  lat: parseFloat(customerAddress.lat),
                                  lng: parseFloat(customerAddress.lng),
                              }
                            : center
                    }
                    mapContainerStyle={containerStyle}
                    options={{ draggableCursor: "pointer" }}
                    onClick={handleMapClick}
                >
                    <MarkerF
                        position={
                            customerAddress
                                ? {
                                      lat: parseFloat(customerAddress.lat),
                                      lng: parseFloat(customerAddress.lng),
                                  }
                                : center
                        }
                        draggable={true}
                        onDragEnd={handleMarkerDragEnd}
                    />
                </GoogleMap>
            </div>
        </div>
    );
}

function PlacesAutoComplete({
    inputStyle,
    inputRef,
    inputValueRef,
    isCart,
    saveLocation,
    AddressChanged,
}) {
    const [modalOpen, setModalOpen] = useState(false);
    const [modalMessage, setModalMessage] = useState("");
    const { t } = useTranslation();
    const [isAddressChanged, setIsAddressChanged] = useState(AddressChanged);

    const customerAddress = useSelector((state) => state.customerAPI.address);
    const {
        ready,
        value,
        setValue,
        suggestions: { status, data },
        clearSuggestions,
    } = usePlaceAutoComplete();

    const dispatch = useDispatch();

    useEffect(() => {
        setValue(inputValueRef.current);
    }, [inputValueRef.current]);

    const handleSelect = async (address) => {
        setValue(address);

        inputRef.current = address;

        const results = await getGeocode({ address: address });
        const { lat, lng } = await getLatLng(results[0]);
        dispatch(
            updateCustomerAddress({
                lat: lat,
                lng: lng,
                addressValue: address,
            }),
        );
        setIsAddressChanged(true);
        clearSuggestions();
    };
    const handleAlert = (message) => {
        setModalMessage(message);
        setModalOpen(true);
    };
    const handleCloseModal = () => {
        setModalOpen(false);
        setModalMessage("");
    };

    const getPosition = () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async (position) => {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                const addressText = await convertToAddress(lat, lng);
                dispatch(
                    updateCustomerAddress({
                        lat: lat,
                        lng: lng,
                        addressValue: addressText,
                    }),
                );
                setIsAddressChanged(true);
            }, positionError);
        } else {
            handleAlert(
                "Sorry, Geolocation is not supported by your browser. You can continue by typing your location on the map.",
            );
        }
    };

    const positionError = () => {
        if (navigator.permissions) {
            navigator.permissions.query({ name: "geolocation" }).then((res) => {
                if (res.state === "denied") {
                    handleAlert(
                        "Enable location permissions for this website in your browser settings.",
                    );
                } else {
                    handleAlert(
                        "Unable to access your location. You can continue by typing your location on the map.",
                    );
                }
            });
        }
    };

    return (
        <Combobox onSelect={handleSelect}>
            <div className="flex items-center gap-4">
                <ConfirmationModal
                    isOpen={modalOpen}
                    message={t(modalMessage)}
                    onClose={handleCloseModal}
                />
                <ComboboxInput
                    type="text"
                    name="location"
                    id={"location"}
                    value={value}
                    onChange={(e) => setValue(e.target.value)}
                    disabled={!ready}
                    className={inputStyle}
                    placeholder={t("Write custom address")}
                />
                <div
                    onClick={getPosition}
                    className="w-10 h-10 flex items-center justify-center rounded-lg p-1 border border-[text-gray-900] cursor-pointer"
                >
                    <MdLocationPin size={28} color="grey" />
                </div>
                {isCart && (AddressChanged || isAddressChanged) && (
                    <div>
                        <button
                            onClick={() => saveLocation()}
                            className="w-40 h-10 flex items-center justify-center rounded-lg p-1 border border-[text-gray-900] "
                        >
                            {t("Set default address")}
                        </button>
                    </div>
                )}
            </div>

            <ComboboxPopover>
                <ComboboxList>
                    {status === "OK" &&
                        data.map(({ place_id, description }) => (
                            <ComboboxOption
                                key={place_id}
                                value={description}
                            />
                        ))}
                </ComboboxList>
            </ComboboxPopover>
        </Combobox>
    );
}
export default Places;
