import React, { useEffect, useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { setOrderShow } from '../../../../../../redux/editor/orderShowSlice';
import { OrdersCustomer } from '../../../../../../data/data';
import StatusShape from '../components/StatusShape';
import { MdOutlineKeyboardArrowLeft, MdOutlineKeyboardArrowRight } from 'react-icons/md';
import { useTranslation } from 'react-i18next';

function OrderDetail(props) {
    const {orders} = props;
    const { t } = useTranslation();
    const [order, setOrder] = useState(null);
    const dispatch = useDispatch();

    const idOrder = useSelector((state) => state.id.idOrder);
    const Language = useSelector((state) => state.languageMode.languageMode);
    const shapeImageShape = useSelector(state => state.shapeImage.shapeImageShape);

    useEffect(() => {
        const selectedOrder = orders.find(order => order?.id == idOrder);
        setOrder(selectedOrder);
    }, [order])


    console.log("OrderDetail idOrder", idOrder);
    console.log("OrderDetail order",   order);

    if (!order || !orders) {
        return;
    }


    console.log("OrderDetail order items",   order?.items);

    const handleOrderClick = (stutes) => {
        dispatch(setOrderShow(stutes));
    };
    const totalPrice = order?.items?.reduce((total, item) => total + (item.price || 0), 0);


    return (
        <div className='flex flex-col items-start gap-y-4'>
            <div className="font-bold">
                <button className="flex items-center" onClick={() => handleOrderClick(false)}>
                    {Language === "en" ?
                        <MdOutlineKeyboardArrowLeft size={24} />
                        :
                        <MdOutlineKeyboardArrowRight size={24} />
                    }
                    <span className='text-[18px]'>{Language === "en" ? "Back" : "الرجوع"}</span>
                </button>
            </div>
            <div className='flex justify-start items-center gap-3'>
                <div className="font-bold">(#{order?.id})</div>
                <StatusShape text={order?.status} />
            </div>
            <div className='w-[100%] bg-white drop-shadow-md rounded-md p-6 py-8'>
                <div className={`w-[100%] h-[220px] rounded-[4px]  bg-center bg-cover shadow-md`}
                    style={{ backgroundImage: `url(${order?.items[0]?.item?.photo})`, borderRadius: shapeImageShape }}>
                </div>
                <div className='grid grid-cols-2 px-6 mt-4'>
                    <div className='flex flex-col items-start justify-start text-start'>
                        <p className='font-bold'>
                            {t("Products")} ({order?.items?.length})
                        </p>
                        <div className='mt-2 flex flex-col gap-4'>
                            {order?.items?.map((item, index) => (
                                <div key={index}>
                                    <div className='mt-2 flex justify-start items-start gap-12 min-w-[250px]'>
                                        <p className=''>{t('Name')}: {item?.item?.name}</p>
                                        <p className=''>{t('Quantity')}: {item?.quantity}</p>
                                        <p className='font-bold'>{t('price')}: {item.price} {t('SAR')}</p>
                                    </div>
                                    <p className=''>{t('additional')}: {order?.items?.length - 1}</p>
                                    <div
                                        className={`w-[40px] h-[40px] rounded-[4px]  bg-center bg-cover shadow-md`}
                                        style={{ backgroundImage: `url(${item?.item?.photo})`, borderRadius: shapeImageShape }}>
                                    </div>
                                </div>
                            ))}
                        </div>
                        {/*<div className='mt-4 flex justify-start items-start gap-3 flex-wrap'>*/}
                        {/*    {order?.items?.map((item, index) => (*/}
                        {/*        */}
                        {/*    ))}*/}
                        {/*</div>*/}
                    </div>
                    <div className='flex flex-col items-start justify-start text-start'>
                        <p className='font-bold'>
                            {t("Delivery Details")}
                        </p>
                        <p className='mt-2'>
                            {order?.shipping_address}
                        </p>
                    </div>
                </div>
                <div className='my-6 font-bold w-[100%] h-2 bg-[var(--secondary)]'></div>
                <div className='flex flex-col items-center justify-start'>
                    <div className='flex flex-col items-start justify-start text-start'>
                        <p className='font-bold'>
                            {t("Summary")}
                        </p>
                        <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                            <p className=''>{t("Notes")}</p>
                            <p className=''>{order?.order_notes || t('N/A')}</p>
                        </div>
                        <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                            <p className=''>{t("Delivery")}</p>
                            <p className=''>{order?.delivery_cost || t('free')} {t('SAR')}</p>
                        </div>
                        <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                            <p className=''>{t("platform fee")}</p>
                            <p className=''>{order?.platform_fee || 0} {t('SAR')}</p>
                        </div>
                        <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                            <p className=''>{t("Products")}</p>
                            <p className=''>
                                {order?.total} {t('SAR')}
                            </p>
                        </div>
                        <div className='mt-2 flex justify-between items-start gap-6 min-w-[250px]'>
                            <p className='font-bold'>{t("Total")}</p>
                            <p className='font-bold'>{order?.total} {t('SAR')}</p>
                        </div>
                        <p className='mt-2'>({t(order?.payment_method)})</p>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default OrderDetail;
