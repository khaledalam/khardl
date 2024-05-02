import React from "react";
import { useTranslation } from "react-i18next";
import infog from "../assets/infog.svg";

const ConfirmationModal = ({ isOpen, message, onClose, onConfirm }) => {
  const { t } = useTranslation();

  if (!isOpen) return null;

  return (
    <div className="backdrop-custom">
      <div className="modal-box confirm-modal">
        <h3 className="font-bold text-lg"></h3>
        <p className="py-4  flex ">
          <img
            src={infog}
            alt="InfoIcon"
            className="inline-block align-middle w-5"
          />
          <span className="p-2 text-[20px]">{message}</span>
        </p>
        <div className="text-end flex gap-3 justify-end">
          {onConfirm && (
            <button
              className="w-32 cursor-pointer text-white bg-red-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-red-900 hover:text-red-900 transition-all shadow-md"
              onClick={onConfirm}
            >
              {t("Confirm")}
            </button>
          )}
          {onClose && (
            <button
              className="w-32 cursor-pointer text-white bg-gray-900 rounded-lg px-4 py-2.5 border  leading-[18px] hover:bg-white hover:border-gray-900 hover:text-gray-900 transition-all shadow-md"
              onClick={onClose}
            >
              {onConfirm ? t("Cancel") : t("Ok")}
            </button>
          )}
        </div>
      </div>
    </div>
  );
};

export default ConfirmationModal;
