import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import orderIcon from "../../../assets/orderBlack.svg";
import AddAddress from "./AddAddress";
import AddressItem from "./AddressItem";

const CustomerAddresses = () => {
  const { t } = useTranslation();

  const [addresses, setAddresses] = useState([
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
    {
      addressType: 0,
      address:
        "Street 123, no.100 A, Villa Breeze, Khobbar,loremipsumloremipsumlore 12345, Saudi Arabia",
      phoneNumber: "+966 - 123 - 456 - 789",
      name: "Chaterine Angella",
    },
  ]);
  const [addMode, setAddMode] = useState(false);

  return (
    <>
      {!addMode ? (
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
          onAdd={(address) => {
            setAddMode(false);
            setAddresses([...addresses, address]);
          }}
          onCancel={() => {
            setAddMode(false);
          }}
        />
      )}
    </>
  );
};

export default CustomerAddresses;
