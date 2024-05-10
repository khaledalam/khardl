import React from "react";
import orderIcon from "../../../assets/orderBlack.svg";
import { useTranslation } from "react-i18next";
import Places from "../../../components/Customers/CustomersEditor/components/Dashboard/components/Places";
import { AddressTypeIcons } from "./AddressItem";
import { toast } from "react-toastify";

const AddAddress = ({ onSave, onCancel, address, setAddress }) => {
  const { t } = useTranslation();

  return (
    <div className="m-4 mt-8 md:m-12 mb-5">
      <div className="flex items-center gap-3">
        <img src={orderIcon} alt="addresses" className="w-8" />
        <h3 className="text-3xl font-medium">{t("Add new address")}</h3>
      </div>
      <div className="flex flex-col lg:flex-nowrap gap-4 mb-5 mt-8 min-h-96 font-['Plus Jakarta Sans']">
        <div className="justify-start items-center flex flex-wrap gap-5">
          <div className="text-black text-opacity-75 font-medium text-sm">
            {t("Select address type")}
          </div>
          <div className="justify-center items-start gap-2 flex flex-wrap min-w-max">
            {Object.getOwnPropertyNames(AddressTypeIcons).map((type, index) => (
              <div
                className={`transition-all px-[9px] py-2 rounded-[50px] border justify-start items-center gap-2 flex font-light cursor-pointer text-xs bg-white ${
                  type === address.type
                    ? "border-neutral-900 text-black"
                    : "border-gray-200 text-zinc-600"
                }`}
                key={index}
                onClick={() =>
                  setAddress((prevAddress) => ({
                    ...prevAddress,
                    type,
                  }))
                }
              >
                {AddressTypeIcons[type]}
                <div className="">{t(type)}</div>
              </div>
            ))}
          </div>
        </div>
        <div className="w-full rounded-[10px] border border-black border-opacity-20 flex-col gap-2.5 flex h-full p-4">
          <Places
            inputStyle={
              "input bg-white w-full outline-none focus-visible:outline-none p-2 text-sm placeholder:text-neutral-500 h-fit text-neutral-900  rounded-2xl border border-neutral-700 hover:border-black focus-visible:border-black disabled:border-neutral-700"
            }
          />
        </div>
        <div className="h-fit flex-row items-center gap-4 flex text-center">
          <div
            className="w-full cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 transition-all shadow-md"
            onClick={() => {
              if (
                address.address === "" ||
                address.address === null ||
                address.address === undefined
              ) {
                return toast.error("Address value can't be empty.");
              }
              onSave(address);
            }}
          >
            {t("Save address")}
          </div>
          <div
            className="w-full cursor-pointer text-white bg-gray-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-gray-900 hover:text-gray-900 transition-all shadow-md"
            onClick={() => {
              setAddress({
                type: "home",
              });
              onCancel();
            }}
          >
            {t("Cancel")}
          </div>
        </div>
      </div>
    </div>
  );
};

export default AddAddress;
