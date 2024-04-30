import React from "react";
import { useTranslation } from "react-i18next";

const AddressItem = ({ address, setViewOnMap }) => {
  const { t } = useTranslation();

  const addressTypes = ["Home", "Office", "Other Address"];
  return (
    <div className="flex-1 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 h-fit p-4 bg-white rounded-[15px] border border-gray-200 flex-col justify-start items-start gap-4 inline-flex max-w-96 min-w-72">
      <div className="self-stretch justify-start items-center gap-2 inline-flex">
        <div className="grow shrink basis-0 h-8 justify-start items-center gap-2 flex">
          <div className="px-[9px] py-2 bg-white rounded-[50px] border border-gray-200 justify-start items-center text-center gap-2 flex">
            {/* <div className="w-4 h-4 py-0.5 flex-col justify-center items-center gap-2.5 inline-flex" /> */}
            <div className="text-zinc-600 font-light font-['Plus Jakarta Sans']">
              {t(addressTypes[address.addressType || 0])}
            </div>
          </div>
        </div>
        {/* <div className="w-[30px] h-[30px] rounded-[32px] justify-center items-center gap-2.5 flex">
          <div className="w-[15px] h-[15px] py-0.5 flex-col justify-center items-center gap-0.5 inline-flex" />
        </div> */}
      </div>
      <div className="self-stretch text-neutral-700 font-light font-['Plus Jakarta Sans']">
        {t(address?.address)}
      </div>
      <div className="self-stretch justify-between items-center inline-flex">
        <div className="grow shrink basis-0 flex-col justify-start items-start gap-1 inline-flex">
          <div className="text-neutral-700 font-light font-['Plus Jakarta Sans']">
            {t(address?.name)}
          </div>
          <div className="text-neutral-700 font-light font-['Plus Jakarta Sans']">
            {t(address?.phoneNumber)}
          </div>
        </div>
        <div
          className="cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all text-center shadow-md"
          onClick={() => setViewOnMap(true)}
        >
          {t("View on map")}
        </div>
      </div>
    </div>
  );
};

export default AddressItem;
