import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { setOrderShow } from "../../../../../../redux/editor/orderShowSlice";
import { OrdersCustomer } from "../../../../../../data/data";
import StatusShape from "../components/StatusShape";
import {
    MdOutlineKeyboardArrowLeft,
    MdOutlineKeyboardArrowRight,
} from "react-icons/md";
import { useTranslation } from "react-i18next";

function OrderDetail() {
    const { t } = useTranslation();
    const [order, setOrder] = useState([]);
    const dispatch = useDispatch();
    const handleOrderClick = (stutes) => {
        dispatch(setOrderShow(stutes));
    };
    const idOrder = useSelector((state) => state.id.idOrder);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const shapeImageShape = useSelector(
        (state) => state.shapeImage.shapeImageShape,
    );
    const totalPrice = order.items?.reduce(
        (total, item) => total + (item.price || 0),
        0,
    );
    const divWidth = useSelector((state) => state.divWidth.value);

    useEffect(() => {
        const selectedOrder = OrdersCustomer.find(
            (order) => order.id === idOrder,
        );
        setOrder(selectedOrder);
    }, [order]);

    return (
        <div
            className="flex flex-col items-start gap-y-4"
            style={{ maxWidth: `${divWidth}px` }}
        >
            <div className="font-bold">
                <button
                    className="flex items-center"
                    onClick={() => handleOrderClick(false)}
                >
                    {Language === "en" ? (
                        <MdOutlineKeyboardArrowLeft size={24} />
                    ) : (
                        <MdOutlineKeyboardArrowRight size={24} />
                    )}
                    <span className="text-[18px]">
                        {Language === "en" ? "Back" : "الرجوع"}
                    </span>
                </button>
            </div>
            <div className="flex justify-start items-center gap-3">
                <div className="font-bold">(#{order.OrderID})</div>
                <StatusShape text={order.Status} />
            </div>
            <div className="w-[100%] bg-white drop-shadow-md rounded-md p-6 py-8">
                <div
                    className={`w-[100%] h-[220px] rounded-[4px]  bg-center bg-cover shadow-md`}
                    style={{
                        backgroundImage: `url(${order.image})`,
                        borderRadius: shapeImageShape,
                    }}
                ></div>
                <div className="grid grid-cols-2 px-6 mt-4">
                    <div className="flex flex-col items-start justify-start text-start">
                        <p className="font-bold">
                            {t("Product")} ({order.number_of_orders})
                        </p>
                        <div className="mt-2 flex flex-col gap-4">
                            {order.items?.map((item, index) => (
                                <div key={index}>
                                    <div
                                        className="mt-2 flex justify-start items-start gap-12 min-w-[250px]"
                                        key={index}
                                    >
                                        <p className="">{item.name}</p>
                                        <p className="">x{item.number}</p>
                                        <p className="font-bold">
                                            {item.price}
                                        </p>
                                    </div>
                                    <p className="">{item.additions}</p>
                                </div>
                            ))}
                        </div>
                        <div className="mt-4 flex justify-start items-start gap-3 flex-wrap">
                            {order.items?.map((item, index) => (
                                <div
                                    key={index}
                                    className={`w-[40px] h-[40px] rounded-[4px]  bg-center bg-cover shadow-md`}
                                    style={{
                                        backgroundImage: `url(${item.image})`,
                                        borderRadius: shapeImageShape,
                                    }}
                                ></div>
                            ))}
                        </div>
                    </div>
                    <div className="flex flex-col items-start justify-start text-start">
                        <p className="font-bold">{t("Delivery Details")}</p>
                        <p className="mt-2">{order.address}</p>
                    </div>
                </div>
                <div className="my-6 font-bold w-[100%] h-2 bg-[var(--secondary)]"></div>
                <div className="flex flex-col items-center justify-start">
                    <div className="flex flex-col items-start justify-start text-start">
                        <p className="font-bold">{t("Summary")}</p>
                        <div className="mt-2 flex justify-between items-start gap-6 min-w-[250px]">
                            <p className="">{t("Delivery")}</p>
                            <p className="">{order.delivary_price}</p>
                        </div>
                        <div className="mt-2 flex justify-between items-start gap-6 min-w-[250px]">
                            <p className="">{t("Services")}</p>
                            <p className="">{order.services_price}</p>
                        </div>
                        <div className="mt-2 flex justify-between items-start gap-6 min-w-[250px]">
                            <p className="">{t("Products")}</p>
                            <p className="">{totalPrice}</p>
                        </div>
                        <div className="mt-2 flex justify-between items-start gap-6 min-w-[250px]">
                            <p className="font-bold">{t("Total")}</p>
                            <p className="font-bold">
                                {totalPrice +
                                    order.delivary_price +
                                    order.services_price}
                            </p>
                        </div>
                        <p className="mt-2">{t("(Paid with Cash)")}</p>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default OrderDetail;
