import React, { useState } from "react";
import { Card } from "primereact/card";
import { useDispatch, useSelector } from "react-redux";
import { useTranslation } from "react-i18next";
import { InputTextarea } from "primereact/inputtextarea";
import { Button } from "primereact/button";
import "./CartItem.scss";

const CartItem = ({ cartitem }) => {
    const { t } = useTranslation();
    const language = useSelector((state) => state.languageMode.languageMode);
    const [value, setValue] = useState("");

    return (
        <div className="cartitem">
            <Card>
                <div className="flex">
                    <div className="w-4/5 ">
                        <div className="flex h-20 mb-3">
                            <div className="p-6">
                                <img
                                    className="rounded-lg"
                                    src={cartitem.item.photo}
                                    alt="item_photo"
                                ></img>
                            </div>
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
                            value={value}
                            onChange={(e) => setValue(e.target.value)}
                            rows={5}
                            cols={30}
                            placeholder={t(
                                "Item notes : e.g. Please make the meat medium cook",
                            )}
                        />
                    </div>
                    <div className="w-1/5 flex flex-col justify-center">
                        <div className="h-24">
                            <h2 className="text-center">{`${cartitem.total} ${t("SAR")}`}</h2>
                            <div className="flex quantityBtn bg-neutral-50">
                                <div className="w-2/6 py-1 text-center">
                                    <Button label="+" />
                                </div>
                                <div className="w-2/6 py-1 text-center">
                                    {cartitem.quantity}
                                </div>
                                <div className="w-2/6 py-1 text-center">
                                    <Button label="-" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Card>
        </div>
    );
};

export default CartItem;
