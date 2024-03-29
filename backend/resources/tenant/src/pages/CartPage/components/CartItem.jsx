import React, { useState } from "react";
import { Card } from "primereact/card";
import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { InputTextarea } from "primereact/inputtextarea";
import { Button } from "primereact/button";
import { MdDelete } from "react-icons/md";
import AxiosInstance from "../../../axios/axios";
import { toast } from "react-toastify";

import "./CartItem.scss";

const CartItem = ({ cartitem, onReload }) => {
    const { t } = useTranslation();
    const language = useSelector((state) => state.languageMode.languageMode);
    const [value, setValue] = useState("");
    const [qtyCount, setQtyCount] = useState(cartitem.quantity);

    const restaurantStyle = useSelector((state) => {
        return state.restuarantEditorStyle;
    });

    const handleRemoveItem = async (cartItemId) => {
        try {
            const response = await AxiosInstance.delete(
                `/carts/` + cartItemId,
                {},
            );

            if (response?.data) {
                onReload();
                toast.success(`${t("Item removed from cart")}`);
            }
        } catch (error) {
            console.log("err removing item from cart", error);
        }
    };

    const incrementQty = () => {
        const newQuantity = qtyCount + 1;
        setQtyCount(newQuantity);
        handleQuantityChange(newQuantity).then((r) => null);
    };

    const decrementQty = () => {
        if (qtyCount > 1) {
            const newQuantity = qtyCount - 1;
            setQtyCount(newQuantity);
            handleQuantityChange(newQuantity).then((r) => null);
        }
    };

    const handleQuantityChange = async (newQuantity) => {
        try {
            await AxiosInstance.put(`/carts/${cartitem.id}`, {
                quantity: newQuantity,
            })
                .then((e) => {
                    toast.success(`${t("Item quantity updated")}`);
                    console.log("successfully", e);
                })
                .finally(async () => {
                    onReload();
                });
        } catch (error) {
            console.log("error: ", error);
        }
    };

    return (
        <div className="cartitem">
            <Card>
                <div className="grid grid-cols-12 relative">
                    <div className="col-span-2 flex items-center">
                        <img
                            className="rounded-lg"
                            src={cartitem.item.photo}
                            alt="item_photo"
                        ></img>
                    </div>
                    <div className="col-span-10 xl:col-span-7 px-4">
                        <div className="flex h-20 mb-3">
                            <div className="py-2 px-2">
                                <h2>
                                    {language === "en"
                                        ? cartitem.item.name.en
                                        : cartitem.item.name.ar}
                                </h2>
                                <p className="mt-4">{`${t("extras")}: `}</p>
                            </div>
                        </div>
                        <InputTextarea
                            className="w-full visible"
                            value={value}
                            onChange={(e) => setValue(e.target.value)}
                            rows={5}
                            cols={30}
                            placeholder={t(
                                "Item notes : e.g. Please make the meat medium cook",
                            )}
                        />
                    </div>
                    <div className="mt-4 xl:mt-0 col-span-12 xl:col-span-3 flex flex-col items-center xl:items-end justify-end">
                        <div className="h-20 w-40">
                            <h2 className="text-center">{`${cartitem.total} ${t("SAR")}`}</h2>
                            <div className="flex quantityBtn bg-neutral-50">
                                <div className="w-2/6 py-1 text-center">
                                    <Button
                                        className="w-full"
                                        label="+"
                                        onClick={incrementQty}
                                    />
                                </div>
                                <div className="w-2/6 py-1 text-center">
                                    {cartitem.quantity}
                                </div>
                                <div className="w-2/6 py-1 text-center">
                                    <Button
                                        className="w-full"
                                        label="-"
                                        onClick={decrementQty}
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center absolute top-1 left-1 deleteBtn">
                        <Button onClick={() => handleRemoveItem(cartitem.id)}>
                            <MdDelete className="text-lg text-white " />
                        </Button>
                    </div>
                </div>
            </Card>
        </div>
    );
};

export default CartItem;
