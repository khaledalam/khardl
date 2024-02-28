import React from "react";
import BigCart from "../../../assets/cartLgIcon.svg";
import { useTranslation } from "react-i18next";

const CartHeader = ({ styles, isloading }) => {
    const { t } = useTranslation();

    return (
        <>
            {isloading ? (
                <div className="skeleton w-16 h-16 w-full shrink-0"></div>
            ) : (
                <div
                    style={{
                        backgroundColor: styles?.categoryDetail_cart_color,
                    }}
                    className={`w-full laptopXL:w-[75%] mx-auto h-[85px] rounded-lg flex items-center justify-center`}
                >
                    <div className="flex items-center gap-4">
                        <img src={BigCart} alt="cart" />
                        <h3 className="text-2xl">{t("Your Cart")}</h3>
                    </div>
                </div>
            )}
        </>
    );
};

export default CartHeader;
