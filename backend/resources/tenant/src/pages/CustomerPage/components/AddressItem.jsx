import React, { useState } from "react";
import { useTranslation } from "react-i18next";
import {
  MdOutlineHome,
  MdOutlineWorkOutline,
  MdOutlineMyLocation,
  MdArrowForward,
  MdFormatListBulleted,
} from "react-icons/md";

export const AddressTypeIcons = {
  home: <MdOutlineHome />,
  office: <MdOutlineWorkOutline />,
  other: <MdOutlineMyLocation />,
};

const AddressItem = ({ address, onEdit, onDelete, onSetAsDefault }) => {
  const { t } = useTranslation();
  const [settingModalVisible, setSettingModalVisible] = useState(false);

  return (
    <div
      className={`flex-1 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/4 h-fit p-4 bg-white rounded-[15px] flex-col justify-start items-start gap-4 inline-flex max-w-96 min-w-72 border-2 ${
        address.default === 1 ? "border-green-900" : "border-gray-200"
      }`}
    >
      <div className="self-stretch justify-end items-center gap-2 inline-flex">
        <div className="w-full h-10 justify-start items-center gap-2 flex">
          {address.default == 1 && (
            <div className="px-[9px] py-1 bg-white rounded-[50px] border border-green-700 justify-start items-center text-center gap-2 flex">
              <div className="text-zinc-600 font-light font-['Plus Jakarta Sans']">
                {t("Default")}
              </div>
            </div>
          )}
          <div className="px-[9px] py-1 bg-white rounded-[50px] border border-gray-200 justify-between items-center text-center max-w-32  gap-2 flex">
            {/* {AddressTypeIcons[address?.type]} */}
            <div
              className="text-zinc-600 font-light font-['Plus Jakarta Sans'] max-w-32 w-fit overflow-hidden text-nowrap text-ellipsis"
              title={address.name}
            >
              {address.name}
            </div>
          </div>
        </div>
        <div className="relative">
          <MdFormatListBulleted
            className="w-[30px] h-[30px] rounded-[32px] gap-2.5 flex p-[6px] border border-gray-400 cursor-pointer hover:bg-gray-200"
            onClick={() => setSettingModalVisible(true)}
          />
          {settingModalVisible && (
            <div
              className="w-screen h-screen fixed z-10 bg-opacity-0 top-0 left-0"
              onClick={() => setSettingModalVisible(false)}
            ></div>
          )}
          <div
            className={`${
              settingModalVisible ? "visible" : "hidden"
            } z-20 rounded-md border border-gray-900 flex flex-col absolute transition gap-2 bg-white shadow-md right-0 min-w-max`}
          >
            {address.default !== 1 && (
              <div
                className="cursor-pointer hover:bg-green-900 hover:text-white p-2"
                onClick={() => {
                  onSetAsDefault();
                  setSettingModalVisible(false);
                }}
              >
                {t("Set as default")}
              </div>
            )}
            <div
              className="cursor-pointer hover:bg-neutral-900 hover:text-white p-2"
              onClick={onEdit}
            >
              {t("Edit")}
            </div>
            <div
              className="cursor-pointer hover:bg-red-900 hover:text-white p-2"
              onClick={() => {
                onDelete();
                setSettingModalVisible(false);
              }}
            >
              {t("Delete")}
            </div>
          </div>
        </div>
      </div>
      <div
        className="overflow-hidden overflow-ellipsis text-neutral-700 font-light font-['Plus Jakarta Sans'] min-h-14 h-14 max-h-14"
        title={t(address?.address)}
      >
        {t(address?.address)}
      </div>
      {/* <div className="self-stretch justify-between items-center inline-flex">
        <div className="grow shrink basis-0 flex-col justify-start items-start gap-1 inline-flex">
          <div className="text-neutral-700 font-light font-['Plus Jakarta Sans']">
            {t(address?.name)}
          </div>
          <div className="text-neutral-700 font-light font-['Plus Jakarta Sans']">
            {t(address?.phoneNumber)}
          </div>
        </div>
        <div
          className="flex flex-row gap-2 cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border font-['Plus Jakarta Sans'] leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 w-32 transition-all text-center shadow-md"
          onClick={() => setViewOnMap(true)}
        >
          {t("View on map")}
        </div>
      </div> */}
    </div>
  );
};

export default AddressItem;
