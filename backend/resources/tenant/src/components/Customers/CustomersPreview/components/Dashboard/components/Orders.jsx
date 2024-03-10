import React, { useEffect, useMemo, useState } from "react";
import { useTranslation } from "react-i18next";
import { useSelector } from "react-redux";
import Table, { SelectColumnFilter } from "./Table";
import Statusbutton from "./Statusbutton";
import StatusShape from "./StatusShape";
import OrderDetail from "../pages/OrderDetail";
import { OrdersCustomer } from "../../../../../../data/data";
import AxiosInstance from "../../../../../../axios/axios";

function Orders() {
    const { t } = useTranslation();
    const [loading, setLoading] = useState(false);
    const [orders, setOrders] = useState(null);

    const Language = useSelector((state) => state.languageMode.languageMode);
    const orderShow = useSelector((state) => state.order.orderShow);
    const idOrder = useSelector((state) => state.id.idOrder);
    const activeTab = useSelector((state) => state.tab.activeTab);
    const GlobalColor = useSelector((state) => state.button.GlobalColor);
    const shapeImageShape = useSelector(
        (state) => state.shapeImage.shapeImageShape,
    );
    const GlobalShape = useSelector((state) => state.button.GlobalShape);

    useEffect(() => {
        fetchOrdersData().then((r) => null);
    }, []);

    const fetchOrdersData = async () => {
        if (loading) return;
        setLoading(true);

        try {
            const ordersResponse = await AxiosInstance.get(`orders?items&item`);

            if (ordersResponse.data) {
                setOrders(Object.values(ordersResponse?.data?.data));
            }
        } catch (error) {
            console.log(error);
        } finally {
            setLoading(false);
        }
    };

    const columns = [
        {
            Header: `${t("Order ID")}`,
            accessor: "OrderID",
            Cell: ({ row }) => <div>#{row.original.id}</div>,
        },
        {
            Header: `${t("Products")}`,
            accessor: "Products",
            Cell: ({ row }) => (
                <div className="flex justify-start items-center gap-3 ">
                    <div
                        className={`w-[40px] h-[40px] rounded-[4px] bg-center bg-cover shadow-md`}
                        style={{
                            backgroundImage: `url(${row.original?.items[0]?.item?.photo})`,
                            borderRadius: shapeImageShape,
                        }}
                    ></div>
                    <div
                        className={`truncate w-[4rem] ${Language == "en" ? "rtl" : "ltr"}`}
                    >
                        {row.original?.items[0]?.item?.name}{" "}
                        {row.original?.items?.length > 1 ? (
                            <span>
                                <br />
                                {t("and")} {row.original?.items?.length - 1}{" "}
                                {t("other products")}
                            </span>
                        ) : null}
                    </div>
                </div>
            ),
        },
        {
            Header: `${t("Status")}`,
            accessor: "status",
            Cell: ({ row }) => <StatusShape text={row.original.status} />,
            Filter: SelectColumnFilter,
        },
        {
            Header: `${t("Total")}`,
            accessor: "total",
        },
        {
            Header: `${t("Date Added")}`,
            accessor: "created_at",
            Filter: SelectColumnFilter,
        },
        {
            Header: `${t("Actions")}`,
            accessor: "Statusbutton",
            Cell: ({ row }) => <Statusbutton id={row.original.id} />,
        },
    ];

    if (!orders) {
        return;
    }

    return (
        <div>
            <div className="flex justify-between items-center gap-2">
                <p className="font-bold">
                    {activeTab === "Dashboard" && (
                        <span>{t("Last Orders")}</span>
                    )}
                </p>
            </div>
            {orderShow === true && idOrder !== null && (
                <OrderDetail orders={orders} />
            )}
            {orderShow === false && activeTab === "Dashboard" && (
                <Table columns={columns} data={orders} />
            )}
            {orderShow === false && activeTab === "Orders" && (
                <Table columns={columns} data={orders} />
            )}
        </div>
    );
}

export default Orders;
