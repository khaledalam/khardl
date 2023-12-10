import React, {useEffect, useRef, useState} from 'react';
import {useSelector} from 'react-redux';
import {useTranslation} from "react-i18next";
import AxiosInstance from "../../axios/axios";
import Footer from "../Footer/Footer";
import './Cart.css'
import {useNavigate} from "react-router-dom";
import {toast} from "react-toastify";

const Cart = () => {

    const [cartItems, setCartItems] = useState([]);
    const [loading, setLoading] = useState(true);
    const [paymentMethod, setPaymentMethod] = useState(null);
    const [paymentMethods, setPaymentMethods] = useState(null);

    const navigate = useNavigate()
    const {t} = useTranslation();
    const Language = useSelector((state) => state.languageMode.languageMode);


    useEffect(() => {
        fetchCartData().then(r => null);
    }, []);


    const fetchCartData = async () => {
        try {
            const cartResponse = await AxiosInstance.get(`carts`);

            console.log("cart >>>", cartResponse.data)
            if (cartResponse.data) {
                setCartItems(cartResponse.data?.data.items);
                setPaymentMethods(cartResponse.data?.data.payment_methods)
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
    const handlePlaceOrder = async () => {

        if (confirm(t('Are You sure you want to place the order?'))) {
            try {
                setLoading(true);
                const cartResponse = await AxiosInstance.post(`/orders`,{
                    payment_method: paymentMethod,

                    // TODO @todo more info
                    shipping_address: '',
                    order_notes: '',
                    delivery_type:  ''
                });

                if (cartResponse.data) {
                    toast.success(`${t('Order has been created successfully')}`);
                    navigate('/');
                }
            } catch (error) {
                toast.error(`${t('Failed to processed the checkout')}`)
            } finally {
                setLoading(false);
            }
        }


    }

    const getTotalPrice = () => {
        return cartItems.reduce((total, item) => total + item.price * item.quantity, 0);
    };

    const handleRemoveItem = (itemId) => {
        setLoading(true);


        const updatedCart = cartItems.filter(item => item.id !== itemId);
        setCartItems(updatedCart);
    };

    const handleQuantityChange = (itemId, newQuantity) => {
        setLoading(true);

        const updatedCart = cartItems.map(item =>
            item.id === itemId ? {...item, quantity: newQuantity} : item
        );
        setCartItems(updatedCart);
    };

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
                                        <li key={it?.item_id}>
                                            <img style={{
                                                border: '1px solid var(--primary)',
                                                borderRadius: '15%'
                                            }} src={it?.item?.photo} width={80} height={80}/>
                                            <span>{Language === "en" ? it?.item?.description?.en : it?.item?.description?.ar}</span>
                                            <span>{it?.price} {t('SAR')}</span>
                                            <span>
                      <label htmlFor={`quantity-${it?.item_id}`}>{t('Quantity')}: </label>
                      <input
                          id={`quantity-${it?.item_id}`}
                          className={"bg-[var(--primary)] border text-center"}
                          type="number"
                          min="1"
                          value={it?.quantity}
                          onChange={(e) => handleQuantityChange(it?.item_id, parseInt(e.target.value))}
                      />
                    </span>

                                            <span>{t('Total')}: {it?.price * it?.quantity} {t('SAR')}</span>
                                            <button
                                                disabled={loading}
                                                className="p-[6px] text-black shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-y-1"
                                                onClick={() => handleRemoveItem(it?.item_id)}>❌ {t('Remove')}</button>
                                        </li>
                                    ))}
                                </ul>
                                <div className="cart-summary">

                                    <div className="payment-section my-4 flex flex-col">
                                        <h3 className={"mb-2"}>{t('Select Payment Method')}</h3>
                                        {paymentMethods.map((method) => (
                                                <label key={method.id}>
                                                <input
                                                    type="radio"
                                                    name="paymentMethod"
                                                    value={method.name}
                                                    checked={paymentMethod === method.name}
                                                    onChange={() => handlePaymentMethodChange(method)}
                                                    disabled={!method.pivot.is_active} // You can customize this based on your logic
                                                /> {t(method.name)}
                                                </label>
                                        ))}

                                    </div>

                                    <hr />

                                    <div className={"my-4"}>
                                        <h3>{t('Total')}: {getTotalPrice()} {t('SAR')} <small><i>({t('Inclusive VAT')})</i></small></h3>
                                    </div>

                                    <hr />

                                    <button
                                        disabled={loading}
                                        onClick={() => handlePlaceOrder()}
                                        className={"text-[15px] text-black p-3 my-4 shadow-[0_-1px_8px_#b8cb0aa4] cursor-pointer w-fit rounded-md bg-[#b8cb0aa4] flex items-center justify-center overflow-hidden transform transition-transform hover:-translate-x-1"}>
                                        {paymentMethod === 'cc' ? <span>🛍️ {t('Checkout')} {getTotalPrice()} {t('SAR')}</span> : <span>🛍️ {t('Place Order')}</span>}
                                    </button>
                                </div>
                            </div>
                    )}
            </div>
        </div>
    );

    const divWidth = useSelector((state) => state.divWidth.value);
    const divRef = useRef(null);
    const selectedFontFamily = useSelector((state) => state.fonts.selectedFontFamily);
    const selectedFontWeight = useSelector((state) => state.fonts.selectedFontWeight);
    const selectedAlignText = useSelector((state) => state.alignText?.selectedAlignText);

    const [cart, setCart] = useState([]);


    return (
        <div ref={divRef} className="w-[100%] bg-white h-[85vh] overflow-y-auto" style={{
            fontFamily: `${selectedFontFamily}`,
            fontWeight: `${selectedFontWeight}`,
            fontSize: `${selectedFontFamily}`
        }}>
            <div className={`mt-[30px] mb-[50px] ${divWidth >= 744 ? "mx-[40px]" : ""}`}>
                <div>
                    <div>
                        <div className={`px-[30px] text-xl`}>
                            {cart?.length > 0 ?
                                <>
                                    <h2>Cart Items:</h2>
                                </>
                                : <h2>No Items in cart yet!</h2>}
                        </div>
                    </div>
                </div>
            </div>
            <Footer/>
        </div>
    );
};

export default Cart;
