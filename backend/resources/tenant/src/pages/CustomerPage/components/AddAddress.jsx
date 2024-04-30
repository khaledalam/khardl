import React, { useState } from "react";
import orderIcon from "../../../assets/orderBlack.svg";
import { useTranslation } from "react-i18next";
import PrimaryTextInput from "./PrimaryTextInput";
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
import { updateCustomerAddress } from "../../../redux/NewEditor/customerSlice";
import AxiosInstance from "../../../axios/axios";
import { useDispatch, useSelector } from "react-redux";
import ClipLoader from "react-spinners/ClipLoader";

const AddAddress = ({ onAdd, onCancel }) => {
  const { t } = useTranslation();
  const [address, setAddress] = useState({
    addressType: 0,
    name: "",
    phoneNumber: "",
    address: "",
  });
  const customerAddress = useSelector((state) => state.customerAPI.address);

  const addressTypes = ["Home", "Office", "Other Address"];

  const { isLoaded } = useJsApiLoader({
    googleMapsApiKey: "AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E",
    version: "weekly",
    language: "en",
    libraries,
  });
  const [libraries, _] = useState(["places"]);
  const dispatch = useDispatch();

  const containerStyle = {
    width: "100%",
    height: "400px",
    padding: 5,
  };

  const convertToAddress = async (lat, lng) => {
    try {
      return await AxiosInstance.post(`/latlng-to-address`, {
        lat: lat,
        lng: lng,
      }).then((r) => {
        console.log("convert: ", r);
        return r?.data;
      });
    } catch (error) {
      toast.error(error.response);
      return "";
    }
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
      })
    );
  };

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
      })
    );
    setIsAddressChanged(true);
  };

  return (
    <div className="m-12 mb-5">
      <div className="flex items-center gap-3">
        <img src={orderIcon} alt="addresses" className="w-8" />
        <h3 className="text-3xl font-medium">{t("Add new address")}</h3>
      </div>
      <div className="flex flex-wrap flex-row gap-4 mb-5 mx-3 min-h-96 font-['Plus Jakarta Sans'] items-center w-full h-full justify-center mt-8">
        <div className="grow shrink basis-0 flex-col justify-start items-start gap-4 inline-flex h-full">
          <div className="self-stretch justify-between items-center inline-flex">
            <div className="text-black text-opacity-75 font-medium ">
              {t("Select address type")}
            </div>
            <div className="justify-center items-start gap-2 flex">
              {addressTypes.map((addressType, index) => (
                <div
                  className={`transition-all px-[9px] py-2 rounded-[50px] border justify-start items-center gap-2 flex font-light cursor-pointer text-xs bg-white ${
                    index === address.addressType
                      ? "border-neutral-900 text-black"
                      : "border-gray-200 text-zinc-600"
                  }`}
                  key={index}
                  onClick={() =>
                    setAddress((prevAddress) => ({
                      ...prevAddress,
                      addressType: index,
                    }))
                  }
                >
                  <div className="">{t(addressType)}</div>
                </div>
              ))}
            </div>
          </div>
          <div className="self-stretch h-fit flex-col justify-start items-center gap-4 flex">
            <PrimaryTextInput
              placeholder={t("Write receiver's name here...")}
              value={address.name}
              onChange={(value) =>
                setAddress((prevAddress) => ({
                  ...prevAddress,
                  name: value,
                }))
              }
              id="name"
              label={t("Name")}
            />
            <PrimaryTextInput
              placeholder={t("Write receiver's phone number here...")}
              value={address.phoneNumber}
              onChange={(value) =>
                setAddress((prevAddress) => ({
                  ...prevAddress,
                  phoneNumber: value,
                }))
              }
              id="phoneNumber"
              label={t("Phone Number")}
            />
            <PrimaryTextInput
              placeholder={t("Write address here...")}
              value={address.address}
              onChange={(value) =>
                setAddress((prevAddress) => ({
                  ...prevAddress,
                  address: value,
                }))
              }
              disabled
              id="address"
              label={t("Address")}
            />
          </div>
          <div className="self-stretch h-fit flex-col justify-start items-center gap-4 flex text-center">
            <div
              className="w-full cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 transition-all shadow-md"
              onClick={() => onAdd(address)}
            >
              {t("Save address")}
            </div>
            <div
              className="w-full cursor-pointer text-white bg-gray-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-gray-900 hover:text-gray-900 transition-all shadow-md"
              onClick={() => {
                setAddress({
                  addressType: 0,
                  name: "",
                  phoneNumber: "",
                  address: "",
                });
                onCancel();
              }}
            >
              {t("Cancel")}
            </div>
          </div>
        </div>
        <div className="grow shrink basis-0 self-stretch p-4 rounded-[10px] border border-black border-opacity-20 flex-col justify-start items-center gap-2.5 inline-flex h-full">
          {isLoaded ? (
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
          ) : (
            <div className={"m-auto flex items-center"}>
              <ClipLoader color="#36d7b7" /> {t("Loading")}...
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default AddAddress;
