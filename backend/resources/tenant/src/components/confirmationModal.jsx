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
                <div className="text-end">
                    {onConfirm && (
                        <button
                            className="btn mr-2 bg-[#b8cb0aa4]"
                            onClick={onConfirm}
                        >
                            {t("Confirm")}
                        </button>
                    )}
                    {onClose && (
                        <button
                            className="btn mr-2 bg-[var(--customer)]"
                            onClick={onClose}
                        >
                            {onConfirm ? t("Cancel") : t("ok")}
                        </button>
                    )}
                </div>
            </div>
        </div>
    );
};

export default ConfirmationModal;
