import React, {useEffect, useRef, useState} from 'react';
import {useSelector} from 'react-redux';
import {useTranslation} from "react-i18next";
import AxiosInstance from "../../axios/axios";
import './Cart.css'
import {useNavigate} from "react-router-dom";
import {toast} from "react-toastify";

const Cart = () => {
    const [cartItems, setCartItems] = useState([]);
    const [loading, setLoading] = useState(false);
    const [paymentMethod, setPaymentMethod] = useState(null);
    const [paymentMethods, setPaymentMethods] = useState(null);
    const [deliveryType, setDeliveryType] = useState(null);
    const [address, setAddress] = useState(null);
    const [deliveryTypes, setDeliveryTypes] = useState(null);
    const [notes, setNotes] = useState("");
    const [couponCode, setCouponCode] = useState("");
    const [couponDiscountValue, setCouponDiscountValue] = useState(0);

    const [deliveryCost, setDeliveryCost] = useState(0);

    const navigate = useNavigate()
    const {t} = useTranslation();
    const Language = useSelector((state) => state.languageMode.languageMode);
    const isLoggedIn = useSelector((state) => state.auth.isLoggedIn)


    useEffect(() => {
        fetchCartData().then(r => null);
    }, []);


    const fetchCartData = async () => {
        if (loading) return;
        setLoading(true);

        try {
            const cartResponse = await AxiosInstance.get(`carts`);

            console.log("cart >>>", cartResponse.data)
            if (cartResponse.data) {
                setCartItems(cartResponse.data?.data.items);
                setPaymentMethods(cartResponse.data?.data?.payment_methods)
                setDeliveryTypes(cartResponse.data?.data?.delivery_types)
                setAddress(cartResponse.data?.data?.address ?? t('N/A'));
            }

        } catch (error) {
            // toast.error(`${t('Failed to send verification code')}`)
            console.log(error);
        } finally {
            setLoading(false);
        }
    };

    const handlePaymentMethodChange = (method) => {
        setPaymentMethod(method.name);
    }

    const handleDeliveryTypeChange = async (type) => {
        if (loading)return;
        setLoading(true);

        console.log(type?.cost)
        setDeliveryType(type.name);
        setDeliveryCost(type?.cost);

        setLoading(false);
    }

    const handlePlaceOrder = async () => {
        if (confirm(t('Are You sure you want to place the order?'))) {

            if (loading) return;
            setLoading(true);

            try {
                const cartResponse = await AxiosInstance.post(`/orders`,{
                    payment_method: paymentMethod,
                    delivery_type: deliveryType,
                    notes: notes,
                    couponCode: couponCode
                });
                if (cartResponse.data) {
                    toast.success(`${t('Order has been created successfully')}`);
                    navigate(`/dashboard#orders`);
                    // navigate(`/dashboard?OrderId=${cartResponse.data?.order?.id}#orders`);
                }
                setLoading(false);
            } catch (error) {
                toast.error(error.response.data.message);
                setLoading(false);
            }
        }
    }

    const getTotalPrice = () => {
        return parseFloat(cartItems.reduce((total, item) => total + (item.price + item.options_price) * item.quantity, 0)) + (deliveryCost / 100);
    };

    const handleRemoveItem =  async (cartItemId) => {

        if (loading) return;
        try {
            setLoading(true);
                const response = await AxiosInstance.delete(`/carts/`+cartItemId, {
            });
            if (response?.data) {
                const updatedCart = cartItems.filter(item => item.id != cartItemId);
                setCartItems(updatedCart);
                toast.success(`${t('Item removed from cart')}`)
            }
        }catch(error){

        }
        setLoading(false);
    };

    const handleQuantityChange = async (item, newQuantity) => {
        if (loading) return;
        try {
            setLoading(true);
            await AxiosInstance.post(`/carts`, {
                item_id : item?.item_id,
                quantity : newQuantity,
                branch_id: item?.item?.branch_id,
                notes: item?.notes
            }).then (e => {
                toast.success(`${t('Item quantity updated')}`)
            }) .finally(async () => {
                await fetchCartData().then(r => null);
            });
        }catch(error){

        }
        setLoading(false);
    };


    const handleEmptyCart = async () => {
        if (loading)return;

        if (!confirm(t("Are you sure to empty cart items?"))) {
           return;
        }

        try{
        setLoading(true);
        await AxiosInstance.delete(`/carts/trash`, {})
            .finally(async () => {
                await fetchCartData().then(r => null);
            });
        } catch(error){

        }
        setLoading(false);
    }

    if (!isLoggedIn) {
        confirm('You need to login first');
        navigate('/login')
        return;
    }

    const handleValidateCoupon = async () => {

    }

    return (
        <div className="cart-page">

            <div className={"cart-content"}>

                <h2 className={"text-center text-[25px] pb-4"}>🛒 {t("Your Cart")}
                    {loading && <div
                        style={{
                            zIndex: 999999
                        }}
                        role='status'
                        className='rounded-s-md   max-[860px]:rounded-b-lg max-[860px]:rounded-s-none absolute -translate-x-1/2 -translate-y-1/2 top-[44.1%] left-1/2 w-[100%] h-[100%] '
                    >
                        <div
                            className='rounded-s-md max-[860px]:rounded-b-lg max-[860px]:rounded-s-none relative bg-black opacity-25 flex justify-center items-center w-[100%] h-[100%]'/>
                        <div className='absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 '>
                            <svg
                                aria-hidden='true'
                                className='w-8 h-8 mr-2 text-gray-200 animate-spin fill-[var(--primary)]'
                                viewBox='0 0 100 101'
                                fill='none'
                                xmlns='http://www.w3.org/2000/svg'
                            >
                                <path
                                    d='M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z'
                                    fill='currentColor'
                                />
                                <path
                                    d='M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z'
                                    fill='currentFill'
                                />
                            </svg>
                        </div>
                    </div>}
                </h2>

                <hr/>

                {cartItems.length === 0 ? (
                            <p className={"text-center "}>{t('Your cart is empty')}</p>
                        ) : (
                            <div>
                                <ul className="cart-items">
                                    {cartItems.map(it => (
                                        <div key={it?.item_id}>
                                        <li>
                                            <img style={{
                                                border: '1px solid var(--primary)',
                                                borderRadius: '15%'
                                            }} src={it?.item?.photo} width={80} height={80}/>
                                            <span>{Language === "en" ? it?.item?.name?.en : it?.item?.name?.ar}
                                            <br />
                                            {!it.item.availability ? (
                                                <span className=' !text-[10px] !bg-[var(--danger)] !px-[6px] !py-[6px] rounded-[16px] !text-white'> {t('Not available')} </span>
                                            ) : null}
                                            </span>
                                            <span>{it?.price} {t('SAR')}</span>
                                            <span>
                      <label htmlFor={`quantity-${it?.item_id}`}>{t('Quantity')}: </label>
                      <input
                          id={`quantity-${it?.item_id}`}
                          className={"bg-[var(--primary)] border text-center"}
                          type="number"
                          min="1"
                          value={it?.quantity}
                          onChange={(e) => handleQuantityChange(it, parseInt(e.target.value))}
                      />
                    </span>

                                            <span>{t('Total')}: {it?.price * it?.quantity} {t('SAR')} {it.options_price > 0 &&
                                                <i> + {it.options_price} {t('SAR')}  ({t('Options')})</i>
                                            }</span>
                                            <button
                                                disabled={loading}
                                                className="p-[6px] text-black shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-y-1"
                                                onClick={() => handleRemoveItem(it?.id)}>❌ {t('Remove')}</button><br />
                                        </li>
                                            <span className={"flex cart-item-notes"}>{t('Notes item')}: <pre>{it?.notes || t('N/A')}</pre></span>
                                        </div>
                                    ))}
                                </ul>

                                <div className="cart-summary">

                                    {/* Payment Method and Delivery Type */}
                                    <div className={"flex justify-around"}>

                                        <div className="payment-section my-4 flex flex-col">
                                            <h3 className={"mb-2"}>{t('Select Payment Method')} <span style={{color: 'red'}}>*</span></h3>
                                            {paymentMethods?.map((method) => (
                                                    <label key={method.id}>
                                                        <input
                                                            type="radio"
                                                            name="paymentMethod"
                                                            value={method.name}
                                                            checked={paymentMethod === method.name}
                                                            onChange={() => handlePaymentMethodChange(method)}
                                                        /> {t(method.name)}
                                                    </label>
                                            ))}

                                        </div>

                                        {/*<hr />*/}

                                        <div className="payment-section my-4 flex flex-col">
                                            <h3 className={"mb-2"}>{t('Select Delivery Type')} <span style={{color: 'red'}}>*</span></h3>
                                            {deliveryTypes?.map((type) => (
                                                <label key={type.id}>
                                                    <input
                                                        type="radio"
                                                        name="deliveryType"
                                                        value={type.name}
                                                        checked={deliveryType === type.name}
                                                        onChange={() => handleDeliveryTypeChange(type)}
                                                    /> {t(type?.name)} <small>({type?.cost > 0 ? <>{type?.cost} {t('Halala')}</> : t('free')})</small>
                                                </label>
                                            ))}

                                        </div>

                                    </div>

                                    <hr />

                                    <div className={"flex justify-around"}>

                                        <div className="my-4">
                                            <div className="text-[15px] font-semibold mb-2">{t("Address")} <span style={{color: 'red'}}>*</span></div>
                                            <input className="w-[100%] p-1 my-1" style={{color: 'gray'}} value={address} disabled={true} readOnly={true}/>
                                            <button
                                                disabled={loading}
                                                onClick={() => navigate('/dashboard#Profile')}
                                                className={"text-[13px] text-black p-2 my-3 shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-x-1"}>
                                                <span>📍{t('Change My Address')} </span>
                                            </button>
                                        </div>

                                        {/*<hr />*/}

                                        <div className="my-4">
                                            <div className="text-[15px] font-semibold mb-2">{t("Coupon")}</div>
                                            <input className="border w-[100%] p-1" placeholder={t("Coupon")} value={couponCode} onChange={e => setCouponCode(e.target.value)}/>
                                            <button
                                                disabled={loading}
                                                onClick={() => handleValidateCoupon()}
                                                className={"text-[13px] text-black p-2 my-3 shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-x-1"}>
                                                <span>🏷️ {t('Validate coupon')} </span>
                                            </button>
                                        </div>

                                    </div>

                                    <hr />

                                    <div className="my-4">
                                        <div className="text-[15px] font-semibold mb-2">{t("Notes order")}</div>
                                        <textarea className="border w-[100%] p-1" placeholder={t("Notes order")} value={notes} onChange={e => setNotes(e.target.value)}/>
                                    </div>

                                    <hr />

                                    {deliveryCost > 0 &&
                                    <div className={"my-2"}>
                                        <h3>{t('Delivery cost')}: {deliveryCost} {t('SAR')}</h3>
                                    </div>}

                                    {couponDiscountValue > 0 &&
                                    <div className={"my-2"}>
                                        <h3>{t('Coupon cost')}: {couponDiscountValue} {t('SAR')}</h3>
                                    </div>}



                                    <div className={"my-2"}>
                                        <h3>{t('Total')}: {getTotalPrice()} {t('SAR')} <small><i>({t('Inclusive VAT')})</i></small></h3>
                                    </div>

                                    <hr />


                                    <div className={"flex justify-around"}>

                                        <button
                                            disabled={loading}
                                            onClick={() => handlePlaceOrder()}
                                            className={"text-[15px] text-black p-3 my-4 shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-x-1"}>
                                            {paymentMethod === 'cc' ? <span>🛍️ {t('Checkout')} {getTotalPrice()} {t('SAR')}</span> : <span>🛍️ {t('Place Order')}</span>}
                                        </button>

                                        <button
                                            disabled={cartItems?.length < 1}
                                            onClick={() => handleEmptyCart()}
                                            className={"text-[15px] text-black p-3 my-4 shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-x-1"}>
                                            <span>🗑️ {t('Empty Cart')}</span>
                                        </button>

                                    </div>

                                </div>
                            </div>
                    )}
            </div>
        </div>
    );

};

export default Cart;
