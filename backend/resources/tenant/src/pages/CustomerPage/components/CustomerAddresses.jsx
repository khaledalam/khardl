import React, { useEffect, useState } from "react";
import { useTranslation } from "react-i18next";
import orderIcon from "../../../assets/orderBlack.svg";
import AddAddress from "./AddAddress";
import AddressItem from "./AddressItem";
import { useDispatch, useSelector } from "react-redux";
import {
  updateAddressesList,
  updateCustomerAddress,
} from "../../../redux/NewEditor/customerSlice";
import AxiosInstance from "../../../axios/axios";
import { toast } from "react-toastify";
import ConfirmationModal from "../../../components/confirmationModal";

const CustomerAddresses = () => {
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const addresses = useSelector((state) => state.customerAPI.addressesList);
  const [addMode, setAddMode] = useState(false);
  const [openDeleteConfirmModal, setOpenDeleteConfirmModal] = useState(-1);
  const [editMode, setEditMode] = useState(-1);
  const [address, setAddress] = useState({
    type: "other",
    name: "",
  });

  const setAddresses = (addresses) => {
    dispatch(updateAddressesList(addresses));
  };
  const [isMouseHover, setIsMouseHover] = useState(false);

  const restuarantEditorStyle = useSelector(
    (state) => state.restuarantEditorStyle
  );

  const { price_background_color } = restuarantEditorStyle;

  const fetchAddresses = async () => {
    try {
      const addressesResponse = await AxiosInstance.get("/get-addresses");
      if (addressesResponse?.data?.data) {
        setAddresses(addressesResponse?.data?.data);
      }
    } catch (err) {
      toast.error(err?.message);
      console.error(err);
    }
  };

  const addAddress = async () => {
    try {
      address.type = "other";
      const addressResponse = await AxiosInstance.post("/add-address", address);
      if (addressResponse?.data?.success === true) {
        toast.success(addressResponse?.data?.message);
      } else {
        return toast.error(addressResponse?.data?.message);
      }
      if (addressResponse?.data?.data) {
        setAddresses(addressResponse?.data?.data);
      }
    } catch (err) {
      toast.error(err?.message);
      console.error(err);
    }
  };

  const updateAddress = async () => {
    try {
      const addressResponse = await AxiosInstance.post(
        `/update-address/${addresses[editMode].id}`,
        address
      );
      if (addressResponse?.data?.success === true) {
        toast.success(addressResponse?.data?.message);
      } else {
        return toast.error(addressResponse?.data?.message);
      }
      if (addressResponse?.data?.data) {
        setAddresses(addressResponse?.data?.data);
      }
    } catch (err) {
      toast.error(err?.message);
      console.error(err);
    }
  };

  const deleteAddress = async (index) => {
    try {
      const addressResponse = await AxiosInstance.post(
        `/delete-address/${addresses[index].id}`
      );
      if (addressResponse?.data?.success === true) {
        toast.success(addressResponse?.data?.message);
      } else {
        return toast.error(addressResponse?.data?.message);
      }
      if (addressResponse?.data?.data) {
        setAddresses(addressResponse?.data?.data);
      }
    } catch (err) {
      toast.error(err?.message);
      console.error(err);
    }
  };

  const setAsDefault = async (index) => {
    try {
      const addressResponse = await AxiosInstance.post(
        `/make-as-default/${addresses[index].id}`
      );
      if (addressResponse?.data?.success === true) {
        toast.success(addressResponse?.data?.message);
      } else {
        return toast.error(addressResponse?.data?.message);
      }
      if (addressResponse?.data?.data) {
        setAddresses(addressResponse?.data?.data);
      }
    } catch (err) {
      toast.error(err?.message);
      console.error(err);
    }
  };
  useEffect(() => {
    fetchAddresses();
  }, []);

  const customerAddress = useSelector((state) => state.customerAPI.address);

  useEffect(() => {
    setAddress((prevAddress) => ({
      ...prevAddress,
      address: customerAddress.addressValue,
      lat: customerAddress.lat,
      lng: customerAddress.lng,
    }));
  }, [customerAddress]);

  return (
    <>
      {!(addMode || editMode !== -1) ? (
        <div className="m-4 mt-8 md:m-12 mb-5 h-full">
          <div className="flex flex-row justify-between mb-5">
            <div className="flex items-center gap-3">
              <img src={orderIcon} alt="addresses" className="w-8" />
              <h3 className="text-3xl font-medium">{t("Addresses")}</h3>
            </div>
            {addresses?.length !== 0 && (
              <div
                onMouseEnter={() => setIsMouseHover(true)}
                onMouseLeave={() => setIsMouseHover(false)}
                className="text-center cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all"
                onClick={() => {
                  setAddMode(true);
                  setIsMouseHover(false);
                }}
                style={
                  price_background_color
                    ? {
                        backgroundColor: isMouseHover
                          ? "white"
                          : price_background_color,
                        color: isMouseHover ? price_background_color : "white",
                        borderColor: price_background_color,
                      }
                    : {}
                }
              >
                {t("Add address")}
              </div>
            )}
          </div>
          <div
            className={`flex flex-wrap gap-4 mb-5 mx-3 ${
              addresses.length ? "" : "min-h-96"
            }`}
          >
            {addresses?.map((address, index) => (
              <AddressItem
                key={index}
                address={address}
                onDelete={() => {
                  setOpenDeleteConfirmModal(index);
                }}
                onSetAsDefault={() => {
                  setAsDefault(index);
                }}
                onEdit={() => {
                  updateCustomerAddress(addresses[index]);
                  setAddress(addresses[index]);
                  setEditMode(index);
                }}
              />
            ))}
            {addresses?.length === 0 && (
              <div className="place-self-center text-center items-center w-full flex flex-col gap-4">
                <div className="text-2xl">
                  {t("You don't have any addresses")}
                </div>
                <div>{t("Please add one or more addresses.")}</div>
                <div
                  onMouseEnter={() => setIsMouseHover(true)}
                  onMouseLeave={() => setIsMouseHover(false)}
                  className={`cursor-pointer text-white rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white bg-red-900 hover:border-red-900 hover:text-red-900 w-32 transition-all shadow-md`}
                  style={
                    price_background_color
                      ? {
                          backgroundColor: isMouseHover
                            ? "white"
                            : price_background_color,
                          color: isMouseHover
                            ? price_background_color
                            : "white",
                          borderColor: price_background_color,
                        }
                      : {}
                  }
                  onClick={() => {
                    setAddress(
                      {
                        name: "",
                      },
                      setAddMode(true)
                    );
                    setIsMouseHover(false);
                  }}
                >
                  {t("Add address")}
                </div>
              </div>
            )}
          </div>
        </div>
      ) : (
        <AddAddress
          address={address}
          onSave={(address) => {
            if (addMode) {
              setAddMode(false);
              addAddress();
              dispatch(
                updateCustomerAddress({
                  addressValue: "",
                  lat: 26.39925,
                  lng: 49.98436,
                })
              );
            } else if (editMode !== -1) {
              updateAddress(editMode);
              setEditMode(-1);
            }
            setAddress({
              name: "",
            });
          }}
          onCancel={() => {
            setAddMode(false);
            setEditMode(-1);
          }}
          setAddress={setAddress}
        />
      )}
      <ConfirmationModal
        isOpen={openDeleteConfirmModal !== -1}
        message={t("Are You sure you want to delete this address?")}
        onClose={() => {
          setOpenDeleteConfirmModal(-1);
        }}
        onConfirm={() => {
          deleteAddress(openDeleteConfirmModal);
          setOpenDeleteConfirmModal(-1);
        }}
      />
    </>
  );
};

export default CustomerAddresses;
