import React, { useEffect, useMemo, useState } from 'react'
import { useTranslation } from 'react-i18next'
import { useSelector } from 'react-redux';
import Table, { SelectColumnFilter } from "./Table";
import Statusbutton from "./Statusbutton";
import StatusShape from "./StatusShape";
import OrderDetail from '../pages/OrderDetail';
import { OrdersCustomer } from '../../../../../../data/data';
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
    const shapeImageShape = useSelector(state => state.shapeImage.shapeImageShape);
    const GlobalShape = useSelector((state) => state.button.GlobalShape);

    useEffect(() => {
        fetchOrdersData().then(r => null);

        // const newData = activeTab === "Dashboard"
        //     ? [...OrdersCustomer].sort((a, b) => {
        //         const dateA = new Date(a.DateAdded);
        //         const dateB = new Date(b.DateAdded);
        //         return dateB - dateA;
        //     }).slice(0, 3)
        //     : OrdersCustomer;
        // setOrders(newData);

    }, []);


    const fetchOrdersData = async () => {
        if (loading) return;
        setLoading(true);

        try {
            const ordersResponse = await AxiosInstance.get(`orders?items&item`);

            console.log("ordersResponse >>>", ordersResponse?.data?.data)
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
            Cell: ({ row }) => (
                <div>#{row.original.OrderID}</div>
            ),
        },
        {
            Header: `${t("Product")}`,
            accessor: "Product",
            Cell: ({ row }) => (
                <div className='flex justify-start items-center gap-3 '>
                    <div className={`w-[40px] h-[40px] rounded-[4px] bg-center bg-cover shadow-md`}
                        style={{ backgroundImage: `url(${row.original.image})`, borderRadius: shapeImageShape }}>
                    </div>
                    <div className={`truncate w-[4rem] ${Language == "en" ? 'rtl' : 'ltr'}`}>
                        {row.original.Product}
                    </div>
                </div>
            ),
        },
        {
            Header: `${t("Status")}`,
            accessor: "Status",
            Cell: ({ row }) => (
                <StatusShape text={row.original.Status} />
            ),
            Filter: SelectColumnFilter,
        },
        {
            Header: `${t("Total")}`,
            accessor: "Total",
        },
        {
            Header: `${t("Date Added")}`,
            accessor: "DateAdded",
            Filter: SelectColumnFilter,
        },
        {
            Header: `${t("Actions")}`,
            accessor: "Statusbutton",
            Cell: ({ row }) => (
                <Statusbutton id={row.original.id} />
            ),
        }
    ];



    if (!orders) {
        return;
    }


    return (
        <div>
            <div className='flex justify-between items-center gap-2'>
                <p className='font-bold'>
                    {activeTab === "Dashboard" && (
                        <span>{t("Last Orders")}</span>
                    )}
                </p>
            </div>
            {(orderShow === true && idOrder !== null) && (
                <OrderDetail />
            )}
            {(orderShow === false && activeTab === "Dashboard") && (
                <Table columns={columns} data={orders} />
            )}
            {(orderShow === false && activeTab === "Orders") && (
                <Table columns={columns} data={orders} />
            )}
        </div>
    )
}

export default Orders;
