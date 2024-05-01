import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import orderIcon from "../../../assets/orderBlack.svg";
import AddAddress from "./AddAddress";
import AddressItem from "./AddressItem";
import { useDispatch, useSelector } from "react-redux";
import { updateAddressesList } from "../../../redux/NewEditor/customerSlice";

const CustomerAddresses = () => {
  const { t } = useTranslation();
  const dispatch = useDispatch();
  const addresses = useSelector((state) => state.customerAPI.addressesList);
  const [addMode, setAddMode] = useState(false);
  const [editMode, setEditMode] = useState(-1);
  const [address, setAddress] = useState({
    addressType: "Home",
    name: "",
    phoneNumber: "",
    address: "",
  });

  const setAddresses = (addresses) => {
    dispatch(updateAddressesList(addresses));
  };
  return (
    <>
      {!(addMode || editMode !== -1) ? (
        <div className="m-12 mb-5 h-full">
          <div className="flex flex-row justify-between mb-5">
            <div className="flex items-center gap-3">
              <img src={orderIcon} alt="addresses" className="w-8" />
              <h3 className="text-3xl font-medium">{t("Addresses")}</h3>
            </div>
            {addresses?.length !== 0 && (
              <div
                className="text-center cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all"
                onClick={() => setAddMode(true)}
              >
                {t("Add address")}
              </div>
            )}
          </div>
          <div className="flex flex-wrap gap-4 mb-5 mx-3 min-h-96">
            {addresses?.map((address, index) => (
              <AddressItem
                key={index}
                address={address}
                setViewOnMap={() => {}}
                onDelete={() =>
                  setAddresses(addresses.filter((_, i) => i !== index))
                }
                onEdit={() => {
                  setAddress(address);
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
                  className="cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all shadow-md"
                  onClick={() => setAddMode(true)}
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
              setAddresses([...addresses, address]);
            } else if (editMode !== -1) {
              setEditMode(-1);
              setAddresses(
                addresses.map((item, index) =>
                  editMode === index ? address : item
                )
              );
            }
          }}
          onCancel={() => {
            setAddMode(false);
            setEditMode(-1);
          }}
          setAddress={setAddress}
        />
      )}
    </>
  );
};

export default CustomerAddresses;
