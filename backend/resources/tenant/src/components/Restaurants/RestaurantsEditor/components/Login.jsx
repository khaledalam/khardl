import React from "react";
import { motion } from "framer-motion";
import { FiX } from "react-icons/fi";
import { useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { globalColor, globalShape } from "../../../../redux/editor/buttonSlice";
import Logo from "./Logo";

const DetailesItem = ({ onClose }) => {
    const GlobalColor = useSelector(globalColor);
    const GlobalShape = useSelector(globalShape);
    const { t } = useTranslation();

    return (
        <>
            <motion.div
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                className="font-general-medium fixed inset-0 z-[99] transition-all duration-500"
            >
                <button
                    onClick={onClose}
                    className="w-full h-full fixed inset-0 z-30 transition-all duration-500"
                />
                <div className="bg-[#000000]  bg-opacity-50 fixed inset-0 w-full h-full z-20"></div>
                <main className="flex  flex-col items-center justify-center h-full w-full">
                    <div className="modal-wrapper flex items-center z-[50]">
                        <div className="modal max-w-md min-w-[480px] bg-white overflow-y-auto mx-5 xl:max-w-xl lg:max-w-xl md:max-w-xl max-h-screen shadow-lg flex-row rounded-lg ">
                            <div className="modal-header grid grid-cols-3 p-5 items-center border-b border-ternary-light">
                                <div className="text-center">
                                    <h5 className="text-center text-black font-bold text-lg">
                                        {t("Login")}
                                    </h5>
                                </div>
                                <button
                                    onClick={onClose}
                                    className="font-bold col-end-7"
                                >
                                    <FiX className="text-2xl" />
                                </button>
                            </div>
                            <div className="modal-body p-5 w-full h-full">
                                <div className="my-[10px] mx-4 flex justify-center items-center">
                                    <Logo />
                                </div>
                            </div>
                            <div className="p-4 pt-0 mx-4">
                                <h5
                                    className="text-start text-black font-semibold text-lg"
                                    style={{ color: GlobalColor }}
                                >
                                    {t("Login Description")}
                                </h5>
                                <div className="text-[16px] mt-2 font-bold">
                                    {t("Phone")}
                                </div>
                                <input
                                    type="tel"
                                    placeholder={t("Phone Number")}
                                    className="mt-2 ring ring-[var(--third)] text-black rounded-md p-2 text-[16px] w-[100%]"
                                    maxLength={12}
                                />
                                <div className="flex justify-center items-center">
                                    <button
                                        className="text-center font-bold text-lg p-1 px-4 text-white mt-6 mb-2"
                                        style={{
                                            backgroundColor: GlobalColor,
                                            borderRadius: GlobalShape,
                                        }}
                                    >
                                        {t("Login")}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </motion.div>
        </>
    );
};
export default DetailesItem;
